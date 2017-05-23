<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 23/05/17
 * Time: 18:43
 */
namespace App\Shelter\Entities;


use Illuminate\Database\Eloquent\Model;

class Servicio extends Model {

    protected $table = 'servicios';
    protected $fillable = ['descripcion','fecha_inicio','fecha_fin','precio','negocio_id'];
}