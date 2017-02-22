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
}