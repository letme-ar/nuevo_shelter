<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 22/02/17
 * Time: 09:57
 */

namespace App\Shelter\Repositories;


use App\Shelter\Entities\GruposXNegocio;

class RepoGruposXNegocio extends Repo {

    function getModel()
    {
        return new GruposXNegocio();
    }

    public function saveNew($grupo_id,$negocio_id)
    {
        $grupoxnegocio = $this->getModel()->create([
            'grupo_id' => $grupo_id,
            'negocio_id' => $negocio_id
        ]);

        return $grupoxnegocio->id;
    }

    public function getImportOrUpdate($grupo_id, $negocio_id)
    {
        return $this->getModel()->where('grupo_id',$grupo_id)->where('negocio_id',$negocio_id)->first();
    }
}