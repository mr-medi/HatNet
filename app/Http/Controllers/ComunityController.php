<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Post;

/**
 * Clase que se encargara de llevar a cabo toda la logica
 * relaccionada con el apartado de Comunidad
 */
class ComunityController extends Controller
{
    /**
     * Mostrara la pagina principal del apartado de
     * Comunidad
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return view('comunity.index');
    }

    /**
     * Devuelve la vista que mostrara el ranking de usuarios
     * @return \Illuminate\View\View
     */
    public function getRanking()
    {
        $users = User::orderBy('puntos', 'desc')
            ->orderBy('created_at')
            ->orderBy('name')
            ->get();
        return view('comunity.ranking', array('users' => $users));
    }

    /**
     * Devuelve la vista que mostrara el foro
     * dando la posibilidad al usuario de dejar su opinion.
     * @return \Illuminate\View\View
     */
    public function getForo()
    {
        return view(
            'comunity.foro',
            array('posts' => Post::orderBy('created_at', 'desc')->get())
        );
    }
}
