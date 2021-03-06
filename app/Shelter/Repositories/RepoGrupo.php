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
        $grupo = $this->getModel()->firstOrNew(['id' => $data['id']]);
        if($data['id'] == "")
            $data['user_creador_id'] = auth()->user()->id;

        $grupo->fill($data);
        $grupo->save();
        return $grupo->id;
    }

    public function findAndPaginate(array $datos)
    {
//        dd($datos);
        $model = $this->getModel()
            ->join('gruposxnegocios','grupo_id',"=",'grupos.id')
            ->join('estilos','estilo_id',"=",'estilos.id')
//            ->join('gruposxnegociosxcontactos','gruposxnegocios.id',"=",'grupoxnegocio_id')
            ->select(['grupos.id as id','grupos.nombre as nombre','estilos.descripcion as estilo'])
            ->where('gruposxnegocios.negocio_id',auth()->user()->usersxnegocio->negocio_id);

        if(isset($datos['nombre']))
            $model = $model->where('grupos.nombre','like','%'.$datos['nombre'].'%');

        $model = $model->with(['gruposxnegocio'])->paginate(env('APP_CANT_PAGINATE',10));

        return $model;

    }

    public function getListImport($nombre)
    {
        return $this->getModel()
            ->join('gruposxnegocios','gruposxnegocios.grupo_id','=','grupos.id')
            ->where('nombre','like',"%$nombre%")
            ->select(['grupos.id','nombre as label'])->get();
    }

    public function findByName($nombre)
    {
        return $this->getModel()->where('nombre',$nombre)->first();
    }

    public function findWithRelations($id)
    {
        $grupo = $this->getModel()->where("id", $id)->first();
        if(is_object($grupo->gruposxnegocio))
            $grupo->contactos = $grupo->gruposxnegocio->gruposxnegociosxcontacto;

        return $grupo;
    }

    public function updateGrupoNegocioAndContactos($data)
    {
        $this->saveGrupo($data);
        $ids_gruposxnegociosxcontactos = $this->getRepoGruposXNegociosXContacto()->getIds($data['grupoxnegocio_id']);
        foreach($data['contactos'] as $contacto){
            if(isset($contacto['id_provisorio']))
            {
                $contacto = (object)$contacto;
                $this->getRepoGruposXNegociosXContacto()->saveNew($data['grupoxnegocio_id'],$contacto);
            }
            else
            {
                unset($ids_gruposxnegociosxcontactos[$contacto['id']]);
            }
        }
        $this->getRepoGruposXNegociosXContacto()->removeContacto($ids_gruposxnegociosxcontactos);
    }

    public function getImportOrUpdate($grupo_id,$negocio_id)
    {
        return $this->getRepoGruposXNegocios()->getImportOrUpdate($grupo_id,$negocio_id);
    }

    public function importGrupo($data)
    {
        $grupo_id = $this->saveGrupo($data);
        $grupoxnegocio_id = $this->getRepoGruposXNegocios()->saveNew($grupo_id,auth()->user()->usersxnegocio->negocio_id);
        $this->getRepoGruposXNegociosXContacto()->saveNew($grupoxnegocio_id,$data['contactos']);

    }
}