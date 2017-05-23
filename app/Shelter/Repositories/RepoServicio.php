<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 23/05/17
 * Time: 18:44
 */

namespace App\Shelter\Repositories;

use App\Shelter\Entities\Servicio;

class RepoServicio extends Repo {

    function getModel()
    {
        return new Servicio();
    }

    public function update($id, $data)
    {
        $negocio = $this->getModel()->firstOrNew($id);

        $negocio->fill($data);
        $negocio->save();
    }

}