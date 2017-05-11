<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 11/05/17
 * Time: 17:47
 */


namespace App\Shelter\Entities;


use Illuminate\Database\Eloquent\Model;

class SalaXFoto extends Model {

    protected $table = 'salasxfotos';
    protected $fillable = ['sala_id','path_foto'];



}