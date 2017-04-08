<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 07/04/17
 * Time: 23:49
 */

namespace App\Shelter\Repositories;


use App\Shelter\Entities\NegocioXFoto;

class RepoNegociosXFoto extends Repo
{

    function getModel()
    {
        return new NegocioXFoto();
    }

    public function saveNew($negocio_id,$path_foto)
    {
        $negocioxfoto = $this->getModel()->create([
            'negocio_id' => $negocio_id,
            'path_foto' => $path_foto,
        ]);

        return $negocioxfoto->id;
    }
}