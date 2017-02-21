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
}