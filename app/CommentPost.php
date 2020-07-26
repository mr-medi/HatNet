<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;

/**
 * Clase que se utiliza para definir los comentarios de un post
 */
class CommentPost extends Model
{
    protected $table = "commentsPost";

    /**
    * Un comentario pertenece a un post
    * @return App\Post
    */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
