<?php
//https://www.cam4.es/rileeyfoster
namespace App\Http\Controllers;

use Auth;
use Redirect;
use App\UsersChallenge;
use App\User;
use App\Language;
use App\Project;
use App\File;
use App\FilesProject;
use App\Challenge;
use App\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Clase que se encargara de gestionar toda la logica
 * relaccionada con los retos
 */
class ChallengeController extends Controller
{
    /**
     * Mostrara la pantalla de preguntas frecuentes
     * @return \Illuminate\View\View
     */
    public function getFAQ()
    {
        return view('index.faq');
    }

    /**
     * Devuelve la pantalla del mapa web
     * @return \Illuminate\View\View
     */
    public function getSitemap()
    {
        return view('index.sitemap');
    }

    /**
     * Retorna la pagina principal
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return view('index.index');
    }

    /**
     * Mostrara la pantalla de crear un reto
     * @return \Illuminate\View\View
     */
    public function getCrear()
    {
        return view('retos.addReto');
    }

    /**
     * Funcionalidad para crear un reto
     * @param  Request $request
     * @return \Illuminate\View\View
     */
    public function postCrear(Request $request)
    {
        $nombre = $request->nombre;
        $descripcion = $request->descripcion;
        $categoria = $request->categoria;
        $clave = $request->clave;
        if (
            isset($nombre)
            && isset($descripcion)
            && isset($categoria)
            && isset($clave)
        )
        {
            $name = $nombre;
            $descripcion = $descripcion;
            $categoria = $categoria;
            $idCategoria =
                Category::where('categoria', $categoria)
                    ->pluck('id')
                    ->all()[0];
            $rutaCategoria =
                Category::where('categoria', $categoria)
                    ->pluck('rutaCategoriaServidor')
                    ->all()[0];
            $idRetoMaxCategoria =
                Project::where('idCategoria', $idCategoria)
                    ->count();
            $fichero = $request->proyecto;
            $autor = Auth::id();
            $puntos = $request->puntos;
            $val = 5;

            //PROJECT OBJECT
            $p = new Project();
            $p->nombre = $name;
            $p->slug = Str::slug($name);
            $p->descripcion = $descripcion;
            $p->idAutor = $autor;
            $p->valoracion = $val;
            $p->idCategoria = $idCategoria;
            $p->save();

            //RETO OBJECT
            $reto = new Challenge();
            $reto->idProject = $p->id;
            $reto->puntos = $puntos;
            $reto->flag = $clave;
            $reto->rutaReto = "reto".$idRetoMaxCategoria;
            Storage::disk('custom')->makeDirectory($categoria."/".$reto->rutaReto);

            //FILE ATTR
            $path_parts = pathinfo($fichero->getClientOriginalName());
            $ext = isset($path_parts['extension']) ? $path_parts['extension'] : '';
            $lenguaje = 1;

            //SAVING FILE IN THE OTHER SERVER
            $path = $fichero
                ->storeAs($categoria."/".$reto->rutaReto, 'index.'.$ext, 'custom');

            //FILE OBJECT
            $f = new File();
            $f->ruta = $path;
            $f->code = file_get_contents($fichero);
            $f->name = isset($path_parts['basename']) ? $path_parts['basename'] : '';
            $f->idLenguaje = $lenguaje;
            $f->save();
            //CAMBIANDO STATUS USER(si fuese necesario)...
            /**
             * STATUS GUIDE:
             * NEWBIE => 0 - 25% total puntos de todos los retos
             * PROGRAMMER => 25 - 50% total puntos de todos los retos
             * HACKER => 50 - 75% total puntos de todos los retos
             * BOSS => 75 - 100% total puntos de todos los retos
             */
            $user = Auth::user();
            $totalPuntosRetos = Challenge::sum('puntos');
            if ($user->puntos > 0)
            {
                $porcent = ($user->puntos * 100) / $totalPuntosRetos;
                if ($porcent <= 25)
                    $user->idStatus = 1;
                elseif ($porcent > 25 && $porcent <= 50)
                    $user->idStatus = 2;
                elseif ($porcent > 50 && $porcent <= 75)
                    $user->idStatus = 3;
                elseif ($porcent > 75 && $porcent <= 100)
                    $user->idStatus = 4;
                $user->save();
            }
             //
            if ($reto->save())
            {
                $p->ficheros()->attach($f);
                return view('retos.index', array('categorias' => Category::all()));
            }
            return Redirect::back();
        }
        return Redirect::back();
    }

    /**
     * Mostrara una pagina para editar un reto en concreto
     * (funcion no implementada!)
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function editReto($id)
    {
        return view('retos.editReto', array('reto' => $this->retos[$id]));
    }

    /**
     * Funcionalidad de borrar un reto
     * (funcion no implementada!)
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function deleteReto($id)
    {
        return view('retos.deleteReto', array('reto' => $this->retos[$id]));
    }

    /**
     * Mostrara un reto en especifico
     * @param str $categoria
     * @param str $reto Slug del reto
     * @return \Illuminate\View\View
     */
    public function getReto($categoria, $reto)
    {
        if (
            isset(Project::where('slug', $reto)
            ->pluck('id')
            ->all()[0])
        )
        {
            $idReto = Project::where('slug', $reto)->pluck('id')->all()[0];

            return view('retos.mostrar',
                array('reto' => Project::findOrFail($idReto)));
        }
        return redirect()->back();
    }

    /**
     * Gestiona la funcion de mostrar una vista
     * con todos los retos pertenecientes a una categoria
     * @param str $categoria Nombre de la categoria
     * @return \Illuminate\View\View
     */
    public function getRetosCategoria($categoria)
    {
        if (
            isset(Category::where('categoria', $categoria)
             ->pluck('id')
             ->all()[0])
        )
        {
              $id =
                  Category::where('categoria', $categoria)
                      ->pluck('id')
                      ->all()[0];
              return view('retos.retosCategoria',
                array(
                    'retos' => Project::where('idCategoria', $id)->get(),
                    'cat' => $categoria)
                );
        }
        return redirect('retos/crear');
    }

    /**
     * Devuelve una vista con todas las categorias
     * @return \Illuminate\View\View
     */
    public function getRetos()
    {
        return view('retos.index',
            array('categorias' => Category::all()));
    }

    /**
     * Comprobara si un usuario ha introducido la flag
     * correcta del reto
     * @param  Request $request
     * @return Redirect
     */
    public function postIsValidFlag(Request $request)
    {
        $flag = $request->flag;
        $user = Auth::user();
        $puntosUser = User::where('id', $user->id)
            ->pluck('puntos')->all()[0];
        $id = $request->idReto;
        $reto = Challenge::where('idProject', $id)->firstOrFail();
        $flagReto = $reto->flag;
        $isRetoCompleted = UsersChallenge::where(
            [
                ['idUsuario', $user->id],
                ['idReto', $id]
            ])
            ->exists();
        //SI YA COMPLETO EL RETO NO LO INSERTAMOS....
        if ($flagReto == $flag && !$isRetoCompleted)
        {
            if (isset($puntosUser))
            {
                $user->puntos = $puntosUser + $reto->puntos;
                $user->retosCompleted()->attach($reto);
                //CAMBIANDO STATUS USER(si fuese necesario)...
                /**
                * STATUS NOTES:
                * NEWBIE => 0 - 25% total puntos de todos los retos
                * PROGRAMMER => 25 - 50% total puntos de todos los retos
                * HACKER => 50 - 75% total puntos de todos los retos
                * BOSS => 75 - 100% total puntos de todos los retos
                */
                $totalPuntosRetos = Challenge::sum('puntos');
                $porcent = ($user->puntos * 100) / $totalPuntosRetos;
                if ($porcent <= 25)
                    $user->idStatus = 1;
                elseif ($porcent > 25 && $porcent <= 50)
                    $user->idStatus = 2;
                elseif ($porcent > 50 && $porcent <= 75)
                    $user->idStatus = 3;
                elseif ($porcent > 75 && $porcent <= 100)
                    $user->idStatus = 4;

                //INSERTANDO EN RETOS COMPLETADOS DEL USER
                if ($user->save())
                    return Redirect::back()->with('mensaje','Reto completado!');
            }
            else
                $user->puntos = Challenge::where('id', $id)->pluck('puntos')->all()[0];
        }
        return Redirect::back()->with('mensaje', 'Flag incorrecta o reto ya completado...');
    }

    /**
     * Retorna una pagina mostrando todos los usuario que
     * han completado un determinado reto
     * @param str $reto
     * @return \Illuminate\View\View
     */
    public function getValidations($reto)
    {
        $objReto = Project::where('nombre', $reto)->firstOrFail();
        $r2 = UsersChallenge::
            join('retos', 'usuariosReto.idReto', '=', 'retos.id')
            ->join('projects','retos.idProject', '=', 'projects.id')
            ->join('users','usuariosReto.idUsuario', '=', 'users.id')
            ->select('users.*')
            ->where('projects.nombre', $objReto->nombre)
            ->get();


        return view('retos.validations', array('users' => $r2, 'reto' => $objReto));
    }
}
