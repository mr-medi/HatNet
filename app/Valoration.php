<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase que se utiliza para vincular un proyecto con
 * sus valoraciones
 */
class Valoration extends Model
{
    protected $table = 'valoraciones_proyecto';

    /**
     * Obtiene todos los usuarios que han valorado algun proyecto
     * @return App\Project|\Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(Project::class,'idProyecto');
    }
}
