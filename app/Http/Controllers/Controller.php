<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    var $redirigir = [
        1 => 'grupos.index',
        2 => 'profile',
        3 => 'negocio',
        4 => 'usersxnegocio'
    ];


    public function redirect($id)
    {
        return redirect(route($this->redirigir[$id]))->with('alert','Guardado correctamente');
    }


}
