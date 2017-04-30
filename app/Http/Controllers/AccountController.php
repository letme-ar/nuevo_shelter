<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 29/03/17
 * Time: 17:51
 */

namespace App\Http\Controllers;


use App\Shelter\Repositories\RepoUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class AccountController extends Controller{

    private $repoUser;

    public function __construct(RepoUser $repoUser)
    {
        $this->repoUser = $repoUser;
    }

    public function showMyProfile()
    {
        $user = auth()->user();
        return View("perfil.account",compact('user'));
    }

    public function update(Request $request)
    {
        $this->validate($request,$this->getValidaciones(auth()->user()->id));

//        $this->validator($request->all())->validate();
        $this->repoUser->update(auth()->user()->id,$request->all());
        return \Response()->json(['success' => true],200);
    }

    protected function getValidaciones($id)
    {
        return [
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$id,
        ];
    }

}