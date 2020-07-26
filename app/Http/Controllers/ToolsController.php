<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tool;
use Auth;
use Illuminate\Support\Str;
use App\User;
use App\File;
use App\Project;
use App\Language;
use App\Category;

/**
 * Clase que se encargara de toda la logica relaccionada con
 * este apartado
 */
class ToolsController extends Controller
{
    /**
     * Devuelve una vista con la pagina principal
     * dedicada a las herramientas
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return view('tools.index');
    }

    /**
     * Devuelve una vista con todas las
     * herramientas creadas
     * @return \Illuminate\View\View
     */
    public function getMostrar()
    {
        return view('tools.mostrar');
    }

    /**
     * Devuelve una vista con la pagina para crear
     * herramientas
     * @return \Illuminate\View\View
     */
    public function getCrear()
    {
    	return view('tools.crear');
    }

    /**
     * Retorna una vista con informacion detallada de
     * la herramienta
     * @param str $tool Slug de la herramienta
     * @return \Illuminate\View\View
     */
    public function getHerramienta($tool)
    {
        $herramienta = Project::where('slug', $tool)->firstOrFail();
        return view('tools.ver', array('tool' => $herramienta));
    }

    /**
     * Metodo para crear una nueva Herramienta
     * @param  Request $request Peticion HTTP
     * @return \Illuminate\View\View
     */
    public function postCrear(Request $request)
    {
        //USER OBJECT
        $user = Auth::user();
        if (
            $user
            && $request->has('logo')
            && isset($request->nombre)
            && isset($request->categoria)
            && isset($request->descripcion)
        )
        {
            $logo = $request->logo;
            $name = $request->nombre;
            $idCategoria = $request->categoria;
            $descripcion = $request->descripcion;
            $path = $logo->store('', 'imagenes');

            //PROJECT OBJECT
            $exists = isset(
                Category::where('id', $idCategoria)
                ->pluck('id')
                ->all()[0]);
            if ($exists)
            {
                $p = new Project();
                $idCategoria =
                    Category::where('id', $idCategoria)
                    ->pluck('id')
                    ->all()[0];
                $p->nombre = $name;
                $p->slug = Str::slug($name);
                $p->descripcion = $descripcion;
                $p->idAutor = $user->id;
                $p->valoracion = 5.0;
                $p->idCategoria = $idCategoria;
                $p->save();

                //TOOL OBJECT
                $herramienta = new Tool();
                $herramienta->rutaImagen = $path;
                $herramienta->idProject = $p->id;
                $herramienta->idLenguaje = 1;
                $herramienta->save();

                //FILES OBJECT
                $files = $request->file('proyecto');

                foreach ($files as $file)
                {
                    $path_parts = pathinfo(
                        $file->getClientOriginalName()
                    );
                    $ext = $path_parts['extension'];
                    if (
                        isset(Language::where('ext', $ext)
                            ->pluck('id')
                            ->all()[0])
                    )
                    {
                        $lenguaje = Language::where('ext', $ext)
                                ->pluck('id')
                                ->all()[0];

                        if ($lenguaje !== null)
                        {
                            //FILE OBJECT
                            $f = new File();
                            $f->ruta = "";
                            $f->code = file_get_contents($file);
                            $f->name = $path_parts['basename'];
                            $f->idLenguaje = $lenguaje;
                            $f->save();
                            $p->ficheros()->attach($f);
                        }
                    }
                    else
                    {
                        return redirect('/herramientas');
                    }
                }

            }
            return view('tools.index');
        }
}
