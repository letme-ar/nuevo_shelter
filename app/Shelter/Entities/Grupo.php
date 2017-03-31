<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 22/02/17
 * Time: 09:25
 */

namespace App\Shelter\Entities;


use Illuminate\Database\Eloquent\Model;

class Grupo extends Model {

    protected $table = 'grupos';
    protected $fillable = ['nombre','estilo_id','integrantes','web','facebook','twitter','instagram','youtube','vimeo','bandcamp','spotify','user_creador_id'];

    public function estilo()
    {
        return $this->hasOne('App\Shelter\Entities\Estilo', 'id', 'estilo_id');
    }

    public function gruposxnegocio()
    {
        return $this->hasOne('App\Shelter\Entities\GruposXNegocio', 'grupo_id', 'id')->where('negocio_id',auth()->user()->usersxnegocio->negocio_id);
    }

}