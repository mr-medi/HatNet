<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Valoration ;

/**
 * Clase que asocia todos los proyectos.
 * De esta heredan la clase 'Reto' y 'Herramienta'
 */
class Project extends Model
{
    protected $table = "projects";

    /**
     * Devuelve todos los ficheros asociados a un proyecto
     * @return App\Fichero[]
     */
    public function ficheros()
    {
        return $this->belongsToMany(
            File::class,
            'ficherosProyecto',
            'idProject',
            'idFichero');
    }

    /**
     * Devuelve el reto asociado a un proyecto
     * @return App\Reto
     */
    public function reto()
    {
        return $this->hasOne(Challenge::class, 'idProject', 'id');
    }

    /**
     * Retorna la herramienta asociada a un proyecto
     * @return App\Herramienta
     */
    public function tool()
    {
        return $this->hasOne(Tool::class, 'id', 'idProject');
    }

    /**
     * Devuelve la categoria asociada a un proyecto
     * @return App\Categoria
     */
    public function categoria()
    {
        return $this->hasOne(Category::class, 'id', 'idCategoria');
    }

    /**
     * Comprobacion para saber si el usuario actual
     * ha completado un reto o no
     * @param int  $id ID del reto
     * @return boolean
     */
    public function isRetoCompleted($id)
    {
        if (Auth::user() !== null)
        {
            $user = Auth::user();
            $isRetoCompleted = UsersChallenge::
                where(
                    [
                        ['idUsuario', $user->id],
                        ['idReto', $id]
                    ])
                ->exists();

            return $isRetoCompleted;
        }
    }

    /**
     * Retorna el creador de un proyecto
     * @return App\User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'idAutor', 'id');
    }

    /**
    * Devuelve el nombre de un usuario dado su ID
    * @param int $id ID del usuario
    * @return str Nombre del usuario
    */
    public function getUser($id)
    {
        $user = User::where('id', $id)
            ->pluck('name')
            ->all()[0];
        return $user;
    }

    /**
    * Devuelve la ruta absoluta de la categoria
    * pasando como parametro el ID de esta
    * @param int $idCategoria ID de la categoria
    * @return str Ruta donde se encuentra el reto
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
    * Devuelve todos los usuarios que han completado
    * un reto
    * @return App\User
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
    * Retorna todos los retos
    * @param App\Reto $objReto
    * @return App\UsuariosReto
    */
    public function usuariosCompleted2($objReto)
    {
        $r2 = UsersChallenge::
            join('retos', 'usuariosReto.idReto', '=', 'retos.id')
            ->join('projects', 'retos.idProject', '=', 'projects.id')
            ->join('users', 'usuariosReto.idUsuario', '=', 'users.id')
            ->select('users.*')
            ->where('projects.nombre', $objReto->nombre)
            ->get();
        return $r2;
    }

    /**
    * Devuelve todas las valoraciones de un proyecto
    * @return App\Valoracion[]
    */
    public function valoraciones()
    {
        return $this->hasMany(Valoration::class, 'idProyecto', 'id');
    }

    /**
    * Determina si el usuario actual ha valorado
    * positivamente un proyecto o no
    * @param int  $id ID del proyecto
    * @return boolean
    */
    public function isLike($id)
    {
        if (Auth::user() !== null)
        {
            $user = Auth::user();
            $isLike = Valoration::
                where(
                [
                    ['idUser', $user->id],
                    ['idProyecto', $id]
                ])
                ->exists();

            return $isLike;
        }
    }
}
