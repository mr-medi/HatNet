<?php

namespace App\Http\Controllers;

use Auth;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Clase que se encargara de la gestion de usuarios
 */
class UserController extends Controller
{
    /**
    * Busca a usuarios en base a un patron.
    * Esto se usa a la hora de mandar un mensajes para que te
    * autocomplete el destinatario
    * @param Request $request
    * @return json
    */
    public function postAjax(Request $request)
    {
        $b = $request->busqueda;
        return json_encode(User::where('name', 'like', '%'.$b.'%')->get());
    }

    /**
    * Se encarga de mostrar el perfil de un usuario
    * @param str $slug SLUG del usuario
    * @return \Illuminate\View\View
    */
    public function getProfile($slug)
    {
        if (isset(User::where('slug', $slug)->pluck('id')->all()[0]))
        {
            $idUser = User::where('slug', $slug)->pluck('id')->all()[0];
            return view('user.mostrar', array('user' => User::findOrFail($idUser)));
        }
        return redirect('retos')->with('mensaje', 'Usuario ' . $slug . ' no encontrado');
    }

    /**
    * Mostrara la pagina para que el usuario
    * pueda editar su perfil
    * @return \Illuminate\View\View
    */
    public function getEditar()
    {
        return view('user.editar');
    }

    /**
    * Hace la funcion de editar el perfil de un usuario
    * @param  Request $request
    * @return Redirect
    */
    public function postEditar(Request $request)
    {
        $white = ['jpg', 'png', 'svg'];
        $idUser = Auth::id();
        $user = User::findOrFail($idUser);
        $user->name = $request->nombre;
        $user->slug = Str::slug($request->nombre);
        if ($request->has('imagen'))
        {
            $extension = $request->file('imagen')->extension();
            if (in_array($extension, $white))
            {
                $path = $request->imagen
                ->store('', 'imagenes');
                $user->rutaImagen = $path;
                if ($user->save())
                return redirect('/retos');
            }
        }
        if (Str::slug($request->nombre) != "")
        {
            $user->slug = Str::slug($request->nombre);
            if ($user->save())
                return redirect('/retos');
        }
        return redirect('/retos');
    }

    /**
    * Se encargara de recibir una peticion HTTP
    * y enviar el mensaje al usuario correspondiente
    * @param  Request $request Peticion con los datos del mensaje
    * @return Redirect
    */
    public function postSend(Request $request)
    {
        $idUser = Auth::id();
        $user = User::findOrFail($idUser);
        $mensaje = $request->mensaje;
        $nameReceptor = $request->receptor;
        $receptor = User::select('id')
                    ->where('name', $nameReceptor)->firstOrFail();
        //MENSAJE OBJECT
        $m = new Message();
        $m->mensaje = $mensaje;
        $m->idEmisor = $idUser;
        $m->idReceptor = $receptor->id;
        if ($m->save())
        {
            return redirect('/');
        }
    }

    /**
    * Mostrara la pagina donde se encuentran todos los mensajes
    * enviados/recibidos
    * @return \Illuminate\View\View
    */
    public function getMensajes()
    {
        return view('user.mensajes');
    }
}
