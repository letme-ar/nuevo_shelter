<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 07/04/17
 * Time: 23:48
 */

namespace App\Shelter\Entities;


use Illuminate\Database\Eloquent\Model;

class NegocioXFoto extends Model {

    protected $table = 'negociosxfotos';
    protected $fillable = ['negocio_id','path_foto'];



}