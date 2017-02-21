<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 21/02/17
 * Time: 17:25
 */

namespace App\Shelter\Repositories;


use App\Shelter\Entities\Sala;

class RepoSala extends Repo {

    function getModel()
    {
        return new Sala();
    }
}