<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 21/02/17
 * Time: 17:25
 */

namespace App\Shelter\Repositories;


use App\Shelter\Entities\Sala;

class RepoSala extends Repo {

    function getModel()
    {
        return new Sala();
    }

    public function find($id)
    {
        return $this->getModel()->with(['salasxfotos'])->find($id);
    }

    public function createOrUpdate($data)
    {

        $sala = $this->getModel()->firstOrNew(['id' => $data['id']]);

//        dd($data);
        $data = $this->setNegocioIdAndUserCreadorId($data);
        $data = $this->updatePrincipalProperty($data);

        $sala->fill($data);
        $sala->save();

        $this->saveFotos($sala->id,$data);

        return $sala->id;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function updatePrincipalProperty($data)
    {
        if (isset($data['principal'])) {
            $data['principal'] = 1;
            $this->setPrincipalZero();
            return $data;
        } else
            $data['principal'] = 0;

        return $data;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function setNegocioIdAndUserCreadorId($data)
    {
        if ($data['id'] == "") {
            $data['negocio_id'] = auth()->user()->usersxnegocio->negocio_id;
            $data['user_creador_id'] = auth()->user()->id;
            return $data;
        }
        return $data;
    }

    public function saveFotos($id, $data)
    {
        if (isset($data['fotos'])) {
            $total = count($data['fotos']);
            for ($i = 0; $i < $total; $i++) {
                $path_foto = $this->guardarArchivo("fotos_salas", $data['fotos'][$i], $id);
                $this->getRepoSalasXFoto()->saveNew($id, $path_foto);
            }
        }
    }

    public function findAndPaginate(array $datos)
    {
        $model = $this->getModel();

        if(isset($datos['nombre']))
            $model = $model->where('nombre','like','%'.$datos['nombre'].'%');
        if(isset($datos['descripcion']))
            $model = $model->where('descripcion','like','%'.$datos['apellido'].'%');

        $model = $model->paginate(env('APP_CANT_PAGINATE',10));

        return $model;

    }

    public function setPrincipalZero()
    {
        $this->getModel()->where('negocio_id', auth()->user()->usersxnegocio->negocio_id)->update(['principal' => 0]);
    }


}