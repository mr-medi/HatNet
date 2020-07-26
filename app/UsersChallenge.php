<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Challenge;

/**
 * Clase que relacciona los usuarios con los
 * retos completados
 */
class UsersChallenge extends Model
{
    protected $table = "usuariosReto";

    /**
     * Obtiene todos los retos completados de un determinado usuario
     * @return App\Reto[]
     */
    public function completedRetos()
    {
        return $this->hasMany(Challenge::class, 'id', 'idUsuario');
    }
}
