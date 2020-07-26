<?php

namespace App;

use App\Challenge;
use App\Project;
use Illuminate\Database\Eloquent\Model;

/**
*     Clase que se utiliza para filtrar los distintos retos
*     en categorias
*/
class Category extends Model
{
    /**
     * Devuelve el numero total de retos en base a una categoria
     * facilitada
     * @param str $category Nombre de una categoria sobre la que se
     * procedera a calcular el total
     * @return int Devolvera un numero entero, significando el total
     * calculado
     */
    public function getCountRetos($category)
    {
        $total = 0;
        $id = Category::where('categoria', $category)
            ->pluck('id')
            ->all()[0];
        $projects = Project::where('idCategoria', $id)->get();
        foreach ($projects as $project)
        {
            if ($project->reto instanceof Challenge)
                $total = $total + 1;
        }
        return $total;
    }
}
