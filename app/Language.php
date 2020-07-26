<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase que se usa para vincular un fichero
 * con su extension
*/
class Language extends Model
{
    protected $table = "lenguajes";

    /**
     * Devuelve todos los ficheros que han sido escritos
     * en un lenguaje
     * @return App\Fichero[]
     */
    public function ficheros()
    {
        return $this->belongsToMany(File::class, 'id', 'idLenguaje');
    }
}
