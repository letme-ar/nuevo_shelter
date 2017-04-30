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

    public function getUsersByNegocio($negocio_id)
    {
        return $this->getModel()->join('users','users.id','=','usersxnegocios.user_creador_id')
            ->where('negocio_id',$negocio_id)
            ->select(['users.id as user_id','users.username','users.nombre','users.apellido','users.email','users.deleted_at'])
            ->get();
    }
}