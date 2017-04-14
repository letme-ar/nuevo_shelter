<?php

namespace App\Http\Controllers;

use App\Shelter\Mail\ShelterMailer;
use App\Shelter\Repositories\RepoUser;
use App\Shelter\Repositories\RepoUsersXNegocio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    private $repoUser;
    private $repoUsersXNegocio;

    public function __construct(RepoUser $repoUser,RepoUsersXNegocio $repoUsersXNegocio)
    {
        $this->repoUser = $repoUser;
        $this->repoUsersXNegocio = $repoUsersXNegocio;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users.formulario");
    }

    protected function getRules()
    {
        return [
            'username' => 'required|max:255|unique:users',
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ];
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,$this->getRules());
        /*if($request->get('id'))
        {
            $isUpdate = $this->repo->getImportOrUpdate($request->get('id'),auth()->user()->usersxnegocio->negocio_id);
            if($isUpdate)
                $this->repo->updateGrupoNegocioAndContactos($data);
            else
            {
                $this->repo->createGrupoNegocioAndContactos($data);
            }
        }
        else*/
        {
            $user = $this->repoUser->createUser($request->toArray());
            $this->repoUsersXNegocio->getModel()->firstOrCreate(['user_creador_id' => $user->id,'negocio_id' => auth()->user()->usersxnegocio->negocio_id]);
            $mail = new ShelterMailer();
            $mail->sendMailWelcome($user);

        }
        return redirect(route('usersxnegocio'))->with('alert','Guardado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
