<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 21/02/17
 * Time: 17:24
 */

namespace App\Shelter\Entities;


use Illuminate\Database\Eloquent\Model;

class UsersXNegocio extends Model {

    protected $table = 'usersxnegocios';
    protected $fillable = ['user_creador_id','negocio_id'];



} 