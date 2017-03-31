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
        $data = Input::all();
        dd($request->all());
        $this->validator($request->all())->validate();
        $this->repoUser->update(auth()->user()->id,$request->all());
        return \Response()->json(['success' => true],200);
    }

    protected function validator(array $data)
    {
//        dd($data);
        return Validator::make($data, [
//            'username' => 'required|max:255|unique:users',
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
//            'nombre_negocio' => 'required|max:255',
//            'web' => 'url',
            'email' => 'required|email|max:255|unique:users,email,'.$data['id'],
//            'password' => 'required|min:6|confirmed',
        ]);
    }

}