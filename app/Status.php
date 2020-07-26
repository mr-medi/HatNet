<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase usada para relaccionar todos los usuarios
 * con un status.
 * Este ira variando en funcion de los puntos obtenidos.
 */
class Status extends Model
{
    protected $table = "status";
}
