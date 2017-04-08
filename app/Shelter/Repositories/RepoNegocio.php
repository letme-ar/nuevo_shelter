<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 21/02/17
 * Time: 17:07
 */

namespace App\Shelter\Repositories;


use App\Shelter\Entities\Negocio;

class RepoNegocio extends Repo {

    function getModel()
    {
        return new Negocio();
    }

    public function update($id, $data)
    {
        $negocio = $this->getModel()->find($id);

        $negocio->fill($data);
        $negocio->save();

        $this->saveFiles($id, $data);

    }

    public function saveFiles($id, $data)
    {
//        dd($data);
        if (isset($data['fotos'])) {
            $total = count($data['fotos']);
            for ($i = 0; $i < $total; $i++) {
                $path_foto = $this->guardarArchivo("fotos_negocios", $data['fotos'][$i], $id);
                $this->getRepoNegociosXFoto()->saveNew($id, $path_foto);
            }
        }
    }


}