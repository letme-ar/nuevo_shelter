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
        if(is_array($contactos))
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
        else
        {
            $this->getModel()->create([
                'grupoxnegocio_id' => $grupoxnegocio_id,
                'nombre' => $contactos->nombre,
                'telefono' => $contactos->telefono
            ]);

        }
    }

    public function getIds($grupoxnegocio_id)
    {
        $ids = $this->getModel()->select(['id'])->where('grupoxnegocio_id',$grupoxnegocio_id)->get()->toArray();
        $array = [];
        foreach($ids as $id)
        {
            $array[ $id['id']] = $id['id'];
        }
        return $array;
    }

    public function removeContacto(array $ids_gruposxnegociosxcontactos)
    {
        $this->getModel()->whereIn('id',$ids_gruposxnegociosxcontactos)->delete();
    }
}