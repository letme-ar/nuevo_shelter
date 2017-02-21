<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 21/02/17
 * Time: 17:23
 */

namespace App\Shelter\Entities;


use Illuminate\Database\Eloquent\Model;

class Sala extends Model {

    protected $table = 'salas';
    protected $fillable = ['descripcion','user_creador_id'];
} 