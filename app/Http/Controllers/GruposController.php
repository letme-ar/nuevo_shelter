<?php

namespace App\Http\Controllers;

use App\Shelter\Repositories\RepoGrupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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

    public function createGrupo()
    {
        $grupo = Input::get('grupo');
        $titulo = 'Agregar';
        return view($this->view."formulario.formulario",compact('titulo'));

    }

    /**
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
        //
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
