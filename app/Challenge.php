<?php

namespace App;

use Auth;
use App\UsersChallenge;
use App\Project;
use App\Category;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Clase que vinculara todos los datos relaccionados
 * con los retos
 */
class Challenge extends Model
{
    /**
     * Devuelve el proyecto correspondiente a un reto
     * @return App\Project
     */
    public function project()
    {
        return $this->hasOne(Project::class, 'idProject', 'id');
    }

    /**
     * Retorna la categoria de un reto
     * @param int $idRetoCategoria
     * @return str Nombre de la categoria
     */
    public function getCategoria($idRetoCategoria)
    {
        $categorias = Category::all();
        foreach ($categorias as $categoria)
        {
            if ($categoria->id == $idRetoCategoria)
            {
                return $categoria->categoria;
            }
        }
        return null;
    }

    /**
     * Obtiene la ruta absoluta de la categoria
     * @param int $idCategoria ID categoria
     * @return str
     */
    public function getRutaCategoria($idCategoria)
    {
        $categorias = Category::all();
        foreach ($categorias as $categoria)
        {
            if ($categoria->id == $idCategoria)
            {
                return $categoria->rutaCategoriaServidor;
            }
        }
        return null;
    }

    /**
     * Devuelve los ficheros que conforman un reto
     * @return File[]
     */
    public function ficheros()
    {
         return $this->belongsToMany(
            File::class,
            'ficherosProyecto',
            'idReto',
            'idFichero');
    }

    /**
     * Retorna todos los usuarios que han completado un reto
     * @return App\User[]
     */
    public function usuariosCompleted()
    {
        return $this->belongsToMany(
            User::class,
            'usuariosReto',
            'idReto',
            'idUsuario');
    }

    /**
     * Devuelve el creador del reto
     * @return App\User
     */
   public function user()
   {
       return $this->belongsTo(User::class, 'idAutor', 'id');
   }

   /**
    * Relacciona la tabla usuarios con la de retos
    * @return App\UsuariosReto[]
    */
   public function reto()
   {
       return $this->belongsToMany(UsersChallenge::class, 'id', 'idReto');
   }
}
