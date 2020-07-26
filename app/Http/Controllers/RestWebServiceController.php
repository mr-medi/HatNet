<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Challenge;

/**
 * Clase que se encargara de gestionar la API
 * usando la tecnologia REST
 */
class RestWebServiceController extends Controller
{
    /*
    public function getUsers()
    {
        return response()->json(User::select('name', 'status', 'puntos'));
    }
    */

    /**
     * Devuelve el nombre, puntos y status
     * de un usuario
     * @param str $name Nombre del usuario
     * @return json
     */
    public function getUser($name)
    {
        $user = User::where('name', $name)->firstOrFail();
        return response()
            ->json(
                [
                    'nombre' => $user->name,
                    'puntos' => $user->puntos,
                    'status' => $user->status
                ]);
    }

    /**
     * Retorna todos los retos en formato json
     * @return json
     */
    public function getChallenges()
    {
        $data = [];
        foreach (Challenge::all() as $r)
        {
            $buffer = ['id' => $r->id, 'ruta' => $r->rutaReto];
            $data[] = $buffer;
        }
        return json_encode($data);
    }

    /**
     * Metodo que servira para obtener informacion de un
     * determinado reto
     * @param int $id ID del reto
     * @return json
     */
    public function getChallenge($id)
    {
        $r = Challenge::where('id', $id)->firstOrFail();
        return response()
            ->json(["id" => $r->id, "ruta" => $r->rutaReto]);
    }
}
