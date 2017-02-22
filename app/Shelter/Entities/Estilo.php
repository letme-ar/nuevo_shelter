<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 22/02/17
 * Time: 09:24
 */

namespace App\Shelter\Entities;


use Illuminate\Database\Eloquent\Model;

class Estilo extends Model {

    protected $table = 'estilos';
    protected $fillable = ['descripcion'];
} 