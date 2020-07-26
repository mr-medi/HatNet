<?php

namespace App;

use App\CommentPost;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Clase que se utiliza para asociar todos los comentarios
 * creados por los usuarios
 */
class Post extends Model
{
    protected $table = "posts";

    /**
     * Metodo que devuelve todos los comentarios
     * @return App\CommentPost[]
     */
    public function comments()
    {
        return $this->hasMany('App\CommentPost', 'idPost', 'id');
    }

    /**
     * Devuelve el autor del comentario
     * @return App\User
     */
    public function autor()
    {
        return $this->hasOne(User::class, 'id', 'idAutor');
    }
}
