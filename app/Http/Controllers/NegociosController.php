<?php

namespace App\Http\Controllers;

use App\Shelter\Repositories\RepoNegocio;
use App\Shelter\Repositories\RepoUsersXNegocio;
use Illuminate\Http\Request;

class NegociosController extends Controller
{
    private $repoNegocio;
    private $repoUsersXNegocio;

    public function __construct(RepoNegocio $repoNegocio, RepoUsersXNegocio $repoUsersXNegocio)
    {
        $this->repoNegocio = $repoNegocio;
        $this->repoUsersXNegocio = $repoUsersXNegocio;
    }

    public function showMyNegocio()
    {
        $negocio = auth()->user()->usersxnegocio->negocio;
        $type_user_id = auth()->user()->type_user_id;
        return view("negocios.my_negocio",compact('negocio','type_user_id'));
    }

    public function usersxnegocio()
    {
        $negocio_id = auth()->user()->usersxnegocio->negocio_id;
        $usuarios = $this->repoUsersXNegocio->getUsersByNegocio($negocio_id);
        return view("negocios.listado_usuarios",compact('usuarios'));
    }

    public function update(Request $request)
    {
        $this->validate($request,$this->getValidaciones());

        $this->repoNegocio->update(auth()->user()->id,$request->all());
        return \Response()->json(['success' => true],200);
    }

    protected function getValidaciones()
    {
        return [
            'descripcion' => 'required|max:255',
            'mail' => 'required|email|max:255'
        ];
    }

}
