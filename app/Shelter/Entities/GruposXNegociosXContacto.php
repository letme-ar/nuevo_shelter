<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 22/02/17
 * Time: 09:25
 */

namespace App\Shelter\Entities;


use Illuminate\Database\Eloquent\Model;

class GruposXNegociosXContacto extends Model {

    protected $table = 'gruposxnegociosxcontactos';
    protected $fillable = ['grupoxnegocio_id','nombre','telefono'];

} 