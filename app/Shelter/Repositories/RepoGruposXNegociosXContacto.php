<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 22/02/17
 * Time: 09:58
 */

namespace App\Shelter\Repositories;


use App\Shelter\Entities\GruposXNegociosXContacto;

class RepoGruposXNegociosXContacto extends Repo {

    function getModel()
    {
        return new GruposXNegociosXContacto();
    }

    public function saveNew($grupoxnegocio_id, $contactos)
    {
        foreach($contactos as $contacto)
        {
            $this->getModel()->create([
                'grupoxnegocio_id' => $grupoxnegocio_id,
                'nombre' => $contacto['nombre'],
                'telefono' => $contacto['telefono']
            ]);
        }
    }
}