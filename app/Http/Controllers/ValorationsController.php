<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Valoration;
use App\Project;

/**
 * Clase cuya funcion es administrar la funcionalidad
 * de las valoraciones en los proyectos
 */
class ValorationsController extends Controller
{
    /**
     * Cumple la funcion de valorar positivamente
     * un proyecto
     * @param  Request $r Peticion POST HTTP
     * @return redirect
     */
    public function postLike(Request $r)
    {
        $user = Auth::user();
        $idProject = $r->idProject;

        if ($user && isset($idProject))
        {
            //PROJECT OBJ
            $p = Project::where('id', $idProject)->firstOrFail();

            //IF PROJECT EXISTS
            if ($p !== null)
            {
                //COMPROBANDO SI YA DIO LIKE
                $isLike =
                    Valoration::where(
                        [
                            ['idUser', $user->id],
                            ['idProyecto', $p->id]])
                            ->exists();



                //SI YA DIO LIKE NO LO INSERTAMOS....
                if (!$isLike)
                {
                    //VALORACION OBJ
                    $v = new Valoration();
                    $v->idUser = $user->id;
                    $v->idProyecto = $p->id;
                    $v->save();
                    return redirect()->back();
                }
                return redirect()->back();
            }
        }
        else
        {
            return redirect()->back();
        }
    }
}
