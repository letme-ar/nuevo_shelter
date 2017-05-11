<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 21/02/17
 * Time: 17:07
 */

namespace App\Shelter\Repositories;


use App\Shelter\Entities\UsersXNegocio;

abstract class Repo {

    abstract function getModel();

    public function find($id)
    {
        return $this->getModel()->find($id);
    }

    public function all()
    {
        return $this->getModel()->all();
    }

    protected function getRepoUsersXNegocio()
    {
        return new UsersXNegocio();
    }

    protected function getRepoGruposXNegocios()
    {
        return new RepoGruposXNegocio();
    }

    protected function getRepoGruposXNegociosXContacto()
    {
        return new RepoGruposXNegociosXContacto();
    }

    protected function getRepoNegociosXFoto()
    {
        return new RepoNegociosXFoto();
    }

    protected function getRepoSalasXFoto()
    {
        return new RepoSalaXFotos();
    }

    public function guardarArchivo($carpeta,$archivo,$id)
    {
        if ($archivo)
        {
            $array = explode('.',$archivo->getClientOriginalName());
            $extension = end($array);

            $random_name = str_random(20).".".$extension;
            $archivo->move("$carpeta/",$id."-".$random_name);
            $path = "$carpeta/".$id."-".$random_name;
            return $path;
        }
    }



}