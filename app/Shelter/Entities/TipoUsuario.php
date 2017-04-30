<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 14/04/17
 * Time: 09:12
 */

namespace App\Shelter\Entities;


use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model {

    protected $table = 'tipos_usuarios';
    protected $fillable = ['descripcion'];
}