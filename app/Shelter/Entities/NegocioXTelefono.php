<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 07/04/17
 * Time: 17:47
 */

namespace App\Shelter\Entities;


use Illuminate\Database\Eloquent\Model;

class NegocioXTelefono extends Model {

    protected $table = 'negociosxtelefonos';
    protected $fillable = ['negocio_id','telefono'];



}