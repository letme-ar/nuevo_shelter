<?php

namespace App\Http\Controllers;

use App\Shelter\Repositories\RepoNegocio;
use Illuminate\Http\Request;

class NegociosController extends Controller
{
    private $repoNegocio;

    public function __construct(RepoNegocio $repoNegocio)
    {
        $this->repoNegocio = $repoNegocio;
    }


    public function showMyNegocio()
    {
        $negocio = auth()->user()->usersxnegocio->negocio;
        return view("negocios.my_negocio",compact('negocio'));
    }

    public function update(Request $request)
    {
        $this->validate($request,$this->getValidaciones());

//        $this->validator($request->all())->validate();
//        $this->repoUser->update(auth()->user()->id,$request->all());
//        return \Response()->json(['success' => true],200);
    }

    protected function getValidaciones()
    {
        return [
            'descripcion' => 'required|max:255',
            'mail' => 'required|email|max:255'
        ];
    }

}
