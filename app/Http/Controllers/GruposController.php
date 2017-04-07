<?php

namespace App\Http\Controllers;

use App\Shelter\Repositories\RepoGrupo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

class GruposController extends Controller
{
    var $repo;
    var $view;

    public function __construct(RepoGrupo $repoGrupo)
    {
        $this->repo = $repoGrupo;
        $this->view = "grupos.";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->view."listado.index");
    }

    public function findGrupo()
    {
        return view($this->view."find-grupo");
    }

    public function listImport()
    {
        $nombre = Input::get("query");
        return $this->repo->getListImport($nombre);
    }

    public function createGrupo()
    {
        $grupo_id = null;
        $nombre = Input::get('nombre_grupo');
        $grupo = $this->repo->findByName($nombre);
//        $grupo->contactos = json_encode($grupo->gruposxnegocio->gruposxnegociosxcontacto);
        if(is_object($grupo))
            $grupo_id = $grupo->id;

        $titulo = 'Agregar';
        return view($this->view."formulario.formulario",compact('grupo_id','titulo'));
    }

    public function getDataGrupo()
    {
        $grupo = $this->repo->findWithRelations(Input::get("grupo_id"));
        return $grupo;
    }

    public function buscar()
    {
        return $this->repo->findAndPaginate(Input::all());
    }

    /**
     * Show the form for creating a new resource.
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->get('id'));
        $this->validate($request,$this->getValidaciones($request),$this->getMessagesError());
        $data = $request->all();
        if($request->get('id'))
        {
//            dd(auth()->user()->usersxnegocio);
            $isUpdate = $this->repo->getImportOrUpdate($request->get('id'),auth()->user()->usersxnegocio->negocio_id);
            if($isUpdate)
                $this->repo->updateGrupoNegocioAndContactos($data);
            else
            {
                $this->repo->createGrupoNegocioAndContactos($data);
            }
        }
        else
            $this->repo->createGrupoNegocioAndContactos($data);
        return \Response()->json(['success' => true],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grupo = $this->repo->find($id);
        $grupo_id = $grupo->id;

        $titulo = 'Agregar';
        return view("grupos.formulario.formulario",compact('grupo','titulo','grupo_id'));
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

    private function getValidaciones($request)
    {
        return  [
            'nombre' => 'required|unique:grupos,nombre,'.$request->get('id').'|max:255',
//            'nombre' => 'required|max:255|'.Rule::unique('grupos')->ignore(11, 'id'),
            'estilo_id' => 'required',
            'contactos' => 'required'
        ];
    }

    private function getMessagesError()
    {
        return [
            'nombre.unique' => 'Un grupo con ese nombre ya ha sido registrado',
            'estilo_id.required' => 'El campo estilo es obligatorio',
            'contactos.required' => 'Debe ingresar al menos un contacto'
        ];
    }

}
