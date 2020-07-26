<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use Redirect;

/**
 * Clase que tramitara toda la funcionalidad asociada
 * a los comentarios publicos
 */
class PostController extends Controller
{
    /**
     * Recibe una peticion con todos los datos
     * para crear un comentario publico.
     * @param  Request $request Peticion POST HTTP
     * @return \Illuminate\View\View
     */
    public function postCrear(Request $request)
    {
        $post = new Post();
        if (isset($request->titulo))
        {
            $post->titulo = $request->titulo;
            $post->idAutor = Auth::user()->id;
            if ($post->save())
            {
                return Redirect::back()->with('mensaje', 'Post creado con exito');
            }
        }
        return Redirect::back()->with('mensaje', 'Fallo!');
    }
}
