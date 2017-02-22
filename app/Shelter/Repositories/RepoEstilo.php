<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 22/02/17
 * Time: 09:55
 */

namespace App\Shelter\Repositories;


use App\Shelter\Entities\Estilo;

class RepoEstilo extends Repo {

    function getModel()
    {
        return new Estilo();
    }
}