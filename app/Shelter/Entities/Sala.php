<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 21/02/17
 * Time: 17:23
 */

namespace App\Shelter\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sala extends Model {

    use SoftDeletes;

    protected $table = 'salas';
    protected $fillable = ['nombre','descripcion','negocio_id','user_creador_id','principal'];


    public function salasxfotos()
    {
        return $this->hasMany('App\Shelter\Entities\SalaXFoto','sala_id','id');
    }
} 