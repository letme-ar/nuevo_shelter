<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 21/02/17
 * Time: 17:20
 */

namespace App\Shelter\Entities;


use Illuminate\Database\Eloquent\Model;

class SalasXNegocio extends Model {

    protected $table = 'salasxnegocios';
    protected $fillable = ['negocio_id','sala_id'];
} 