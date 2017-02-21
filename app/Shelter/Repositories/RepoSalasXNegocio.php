<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 21/02/17
 * Time: 17:25
 */

namespace App\Shelter\Repositories;


use App\Shelter\Entities\SalasXNegocio;

class RepoSalasXNegocio extends Repo {

    function getModel()
    {
        return new SalasXNegocio();
    }
}