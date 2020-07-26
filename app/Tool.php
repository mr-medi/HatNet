<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase que alude a las herramientas que los usuarios
 * pueden crear en el proyecto
 */
class Tool extends Model
{
    protected $table = "herramientas";

    /**
     * Devuelve el proyecto correspondiente a la herramienta
     * @return App\Project
     */
    public function project()
    {
        return $this->hasOne(Project::class, 'id', 'idProject');
    }

    /**
     * Devuelve el creador de la herramienta
     * @return App\User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'idAutor', 'id');
    }

    /**
     * Retorna el lenguaje en el que ha sido escrito
     * una herramienta
     * @return App\Lenguaje
     */
    public function lenguaje()
    {
        return $this->hasOne(Language::class, 'id', 'idLenguaje');
    }
}
