<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 22/02/17
 * Time: 09:57
 */

namespace App\Shelter\Repositories;


use App\Shelter\Entities\GruposXNegocio;

class RepoGruposXNegocio extends Repo {

    function getModel()
    {
        return new GruposXNegocio();
    }
}