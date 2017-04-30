<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 21/02/17
 * Time: 16:59
 */

namespace App\Shelter\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Negocio extends Model {

    protected $table = 'negocios';
    protected $fillable = ['descripcion','mail','path_foto','web','facebook','twitter','instagram','direccion','user_creador_id'];
    use SoftDeletes;

    public function negociosxfotos()
    {
        return $this->hasMany('App\Shelter\Entities\NegocioXFoto','negocio_id','id');
    }

} 