<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 11/05/17
 * Time: 17:47
 */

namespace App\Shelter\Repositories;


use App\Shelter\Entities\NegocioXFoto;
use App\Shelter\Entities\SalaXFoto;

class RepoSalaXFotos extends Repo
{

    function getModel()
    {
        return new SalaXFoto();
    }

    public function saveNew($sala_id,$path_foto)
    {
        $salaxfoto = $this->getModel()->create([
            'sala_id' => $sala_id,
            'path_foto' => $path_foto,
        ]);

        return $salaxfoto->id;
    }
}