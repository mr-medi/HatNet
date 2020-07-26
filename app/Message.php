<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase que vincula todos los mensajes que los usuarios
 * pueden mandarse entre si
 */
class Message extends Model
{
    protected $table = "messages";

    /**
     * Obtiene el creador de un mensaje
     * @return App\User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'idReceptor', 'id');
    }
}
