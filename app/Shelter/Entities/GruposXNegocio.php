<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 22/02/17
 * Time: 09:25
 */

namespace App\Shelter\Entities;


use Illuminate\Database\Eloquent\Model;

class GruposXNegocio extends Model {

    protected $table = 'gruposxnegocios';
    protected $fillable = ['grupo_id','negocio_id'];

    private function getModel()
    {
        return new GruposXNegocio();
    }

    public function gruposxnegociosxcontacto()
    {
        return $this->hasMany('App\Shelter\Entities\GruposXNegociosXContacto', 'grupoxnegocio_id', 'id');
    }




} 