<?php

namespace App\Http\Controllers;

use App\Shelter\Repositories\RepoSala;
use Illuminate\Http\Request;

class SalasController extends Controller
{
    private $repoSala;

    public function __construct(RepoSala $repoSala)
    {
        $this->repoSala = $repoSala;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View("salas.index");
    }

    public function buscar(Request $request)
    {
        return $this->repoSala->findAndPaginate($request->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $titulo = "Agregar";
        return View("salas.formulario",compact("titulo"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,$this->getValidaciones($request));
        $data = $request->all();
        $this->repoSala->createOrUpdate($data);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $sala_id
     * @return \Illuminate\Http\Response
     */
    public function edit($sala_id)
    {
        $titulo = "Editar";
        return View("salas.formulario",compact("titulo","sala_id"));
    }

    public function getDataSala(Request $request)
    {
        return $this->repoSala->find($request->get('sala_id'));
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
            'nombre' => 'required',
            'descripcion' => 'required',
        ];
    }

    public function eliminar(Request $request)
    {
        $user = $this->repoSala->find($request->get('id'));
        $user->delete();
        return \Response()->json(['success' => true],200);
    }


}
