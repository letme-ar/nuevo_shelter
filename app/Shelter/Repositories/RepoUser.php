<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 21/02/17
 * Time: 18:09
 */

namespace App\Shelter\Repositories;


use App\User;

class RepoUser extends Repo {

    function getModel()
    {
        return new User();
    }

    public function update($id,$data)
    {
        $user = $this->getModel()->find($id);
        if(isset($data['foto']))
            $data['path_foto'] = $this->guardarArchivo("foto_perfil",$data['foto'],$id);

        $user->fill($data);
        $user->save();
    }
}