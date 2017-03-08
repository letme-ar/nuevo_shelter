<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 22/02/17
 * Time: 09:57
 */

namespace App\Shelter\Repositories;


use App\Shelter\Entities\Grupo;

class RepoGrupo extends Repo{

    function getModel()
    {
        return new Grupo();
    }

    public function createGrupoNegocioAndContactos($data)
    {
        $grupo_id = $this->saveGrupo($data);
        $grupoxnegocio_id = $this->getRepoGruposXNegocios()->saveNew($grupo_id,auth()->user()->usersxnegocio->negocio_id);
        $this->getRepoGruposXNegociosXContacto()->saveNew($grupoxnegocio_id,$data['contactos']);
    }

    public function saveGrupo($data)
    {
        $grupo = $this->getModel();
        $data['user_creador_id'] = auth()->user()->id;
        $grupo->fill($data);
        $grupo->save();
        return $grupo->id;
    }

    public function findAndPaginate(array $datos)
    {
        $nombre = $datos['nombre'];
        return $this->getModel()->where('nombre','like','%'.$nombre.'%')->with(['estilo'])->paginate(env('APP_CANT_PAGINATE',10));
    }
}