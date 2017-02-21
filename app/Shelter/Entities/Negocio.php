<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 21/02/17
 * Time: 16:59
 */

namespace App\Shelter\Entities;


use Illuminate\Database\Eloquent\Model;

class Negocio extends Model {

    protected $table = 'negocios';
    protected $fillable = ['descripcion','user_creador_id'];



} 