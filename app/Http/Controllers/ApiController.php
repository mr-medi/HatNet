<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Clase que se encargara de toda la logica relaccionada
 * con la API
 */
class ApiController extends Controller
{
    /**
     * Devuelve la pagina principal de la API
     * @return \Illuminate\View\View
     */
    public function getApi()
    {
        return view('api.index');
    }

    /**
     * Retorna el apartado de usar nuestra API
     * mediante la tecnologia REST
     * @return \Illuminate\View\View
     */
    public function getRest()
    {
        return view('api.rest');
    }

    /**
     * Retorna el apartado de usar nuestra API
     * mediante la tecnologia SOAP
     * @return \Illuminate\View\View
     */
    public function getSoap()
    {
        return view('api.soap');
    }
}
