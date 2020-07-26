<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase que alude a los distintas ficheros
 * que pueden tener un proyecto, ya sea un reto
 * o herramienta
 */
class File extends Model
{
    protected $table = 'ficheros';

    /**
     * Devuelve todos los retos que tienen un mismo fichero
     * @return App\Reto[]
     */
    public function retos()
    {
        return $this->belongsToMany(
            Challenge::class,
            'retos',
            'idFichero',
            'idReto');
    }

    /**
     * Devuelve todos los ficheros que pertenecen
     * a un mismo proyecto
     * @return App\Project[]
     */
    public function projects()
    {
        return $this->belongsToMany(
            Project::class,
            'ficherosProyecto',
            'idFichero',
            'idProject');
    }

    /**
     * Retorna el lenguaje que tiene un fichero.
     * Esto se determina mediante la extension del mismo
     * @return App\Lenguaje
     */
    public function lenguaje()
    {
        return $this->hasOne(Language::class, 'id', 'idLenguaje');
    }
}
