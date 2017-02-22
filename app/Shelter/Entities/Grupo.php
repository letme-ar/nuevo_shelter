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
    protected $fillable = ['nombre','estilo_id','integrantes','web','facebook','twitter','instasgram','youtube','vimeo','bandcamp','spotify','user_creador_id'];

} 