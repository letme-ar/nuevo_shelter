<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 21/02/17
 * Time: 17:07
 */

namespace App\Shelter\Repositories;


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

} 