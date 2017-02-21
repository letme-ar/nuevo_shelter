<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 21/02/17
 * Time: 17:27
 */

namespace App\Shelter\Repositories;


use App\Shelter\Entities\UsersXNegocio;

class RepoUsersXNegocio extends Repo{

    function getModel()
    {
        return new UsersXNegocio();
    }
}