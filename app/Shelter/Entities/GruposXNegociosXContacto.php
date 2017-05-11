<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 22/02/17
 * Time: 09:25
 */

namespace App\Shelter\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GruposXNegociosXContacto extends Model {

    use SoftDeletes;

    protected $table = 'gruposxnegociosxcontactos';
    protected $fillable = ['grupoxnegocio_id','nombre','telefono'];

} 