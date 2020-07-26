<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;
use DB;
use App\Tool;
use App\Project;
use App\Post;
use App\Status;

/**
 * Clase que vinculara todos los datos relaccionados
 * con los usuarios
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =
    [
        'name', 'email', 'password','slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden =
    [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts =
    [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Metodo que devuelve todos los retos creados
     * por el usuario actual
     * @return App\Reto[]
     */
    public function reto()
    {
        return $this->hasMany(Challenge::class, 'id', 'id');
    }

    /**
     * Metodo que devuelve todos los mensajes de un usuario
     * @return App\Mensaje[]
     */
    public function mensaje()
    {
        return $this->hasMany(Message::class, 'idReceptor', 'id');
    }

    /**
     * Devuelve el usuario receptor de un mensaje
     * @param int $idReceptor ID del usuario
     * @return App\User
     */
    public static function getReceptorMensaje($idReceptor)
    {
        return User::where('id', $idReceptor)->firstOrFail();
    }

    /**
     * Se encarga de obtener todos los proyectos creados por
     * un usuario
     * @return App\Project[]
     */
    public function tool()
    {
        return $this->hasMany(Project::class, 'idAutor', 'id');
    }

    /**
     * Se encarga de retorna el status del usuario actual
     * @return App\Status
     */
    public function status()
    {
        return $this->hasOne(Status::class, 'id', 'idStatus');
    }

    /**
     * Devuelve todos los retos completados por un usuario
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function retosCompleted()
    {
        return $this->belongsToMany(
            Challenge::class,
            'usuariosReto',
            'idUsuario',
            'idReto');
    }

    /**
     * Indica el total de herramientas creadas por un usuario
     * @param int $idUser
     * @return int
     */
    public function totalTools($idUser)
    {
        $total = 0;
        $tools = Tool::all();
        foreach ($tools as $t)
        {
            $proyecto = $t->project;
            $idAutor = $proyecto->idAutor;
            if ($idAutor == $idUser)
            {
                $total += 1;
            }
        }
        return $total;
    }

    /**
     * Retorna la posicion de un usuario en el ranking
     * @param int $idUser
     * @return int
     */
    public function positionRanking($idUser)
    {
        $usersRank = collect(DB::select('select id, name, RANK() OVER
               (
                     ORDER BY
                     puntos DESC, created_at, name
                ) rank_user  from users;'));
        $pos = -1;
        foreach ($usersRank as $user)
        {
            $pos = $user->rank_user;
            if ($idUser == $user->id)
                return $pos;
        }
        return $pos;
    }

    /**
     * Devuelve los posts creados por un usuario
     * @return App\Post
     */
    public function autor()
    {
        return $this->hasOne(Post::class, 'id', 'idAutor');
    }

    /**
     * Devuelve todos los proyectos creados por un usuario
     * @return App\Project[]
     */
    public function herramientas()
    {
        return $this->hasMany(Project::class, 'idAutor', 'id');
    }

    /**
     * Devuelve el total de puntos de una determinada categoria
     * para un usuario
     * @param int $idCategoria indica el id de la categoria
     * @param int $user indica el id del usuario
     * @return App\UsuariosReto
     */
    public function getPuntosCategoria($idCategoria,$user)
    {
        return UsersChallenge::
            join('retos', 'usuariosReto.idReto', '=', 'retos.id')
            ->join('projects', 'projects.id', '=', 'retos.idProject')
            ->select('retos.*')
            ->whereRaw('usuariosReto.idUsuario = '.$user.'
                        AND projects.idCategoria = '.$idCategoria)
            ->sum('puntos');
    }

    /**
     * Se encargara de obtener el total de retos
     * que ha validado el usuario actual dada una categoria
     * @param int $idCategoria ID categoria
     * @param int $user ID usuario actual
     * @return int
     */
    public function getRetosCategoria($idCategoria,$user)
    {
        return UsersChallenge::
            join('projects', 'usuariosReto.idReto', '=', 'projects.id')
            ->select('projects.*', 'usuariosReto.*')
            ->whereRaw('usuariosReto.idUsuario = '.$user.'
                        AND projects.idCategoria = '.$idCategoria)
            ->get()
            ->count();
    }

    /**
     * Se encargara de obtener el nombre del
     * usuario en bas
     * @param int $idUser ID del usuario
     * @return str Nombre del usuario
     */
    public function getIdByPosition($idUser)
    {
        $usersRank = collect(DB::select('select id, name, RANK() OVER
               (
                     ORDER BY
                     puntos DESC, created_at, name
                ) rank_user from users;'));
        $pos = -1;
        foreach ($usersRank as $user)
        {
            $name = $user->name;
            if ($idUser == $user->id)
                return $name;
        }
        return $pos;
    }

    /**
     * Retorna el usuario dado la posicion del ranking
     * @param int $position
     * @return App\User
     */
    public function getUserByPosition($position)
    {
        $users =
        collect(
            DB::select('select id,
                rutaImagen,
                puntos,
                idStatus,
                name,
                email,
                slug,
                RANK() OVER
               (
                     ORDER BY
                     puntos DESC
                ) rank_user from users'));
        $i = 1;
        $isRepeat = false;
        foreach ($users as $user)
        {
            if ($position == $user->rank_user)
                return $user;
            $i++;
        }
        return null;
    }

}
