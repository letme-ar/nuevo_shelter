@extends('layouts.app')

@include('grupos.formulario.scripts')


@section('content')

    <h1>@{{ titulo }} un grupo</h1>
    <input type="hidden" name="_token" value="{{ csrf_token() }}" v-model="token">
    <input type="hidden" name="id" value="" v-model="id">
    <div class="col-md-6">
        {!! Form::label('nombre','Nombre') !!}
        {!! Form::text('nombre',null,['class' => 'form-control','v-model' => 'grupo.nombre','required','v-bind:disabled' => 'importar == true']) !!}
{{--        {!! Field::text('nombre',null,['v-model' => 'grupo.nombre','required' => 'required']) !!}--}}
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="estilo_id" class="control-label">Estilo</label>

            <select class="form-control" name="estilo_id" v-model="grupo.estilo_id" id="estilo_id">
                <option></option>
                <option v-for="estilo in estilos" value="@{{ estilo.id }}" >@{{ estilo.descripcion }}</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        {!! Field::text('integrantes',null,['v-model' => 'grupo.integrantes']) !!}
    </div>
    <div class="col-md-6">
        {!! Field::text('web',null,['v-model' => 'grupo.web','style' => 'padding-bottom: 0px']) !!}
    </div>
    <div class="col-md-6">
        <div class="panel panel-primary" style="min-height: 300px">
            <div class="panel-heading">Contactos</div>
            <div class="panel-body" >
                <label>Contacto</label>
                <div class="form-inline">
                    {!! Form::text('nombre_contacto',null,['class' => 'form-control','placeholder' => 'Nombre','v-model' => 'nombre_contacto','@keyup'=>"allowAdd()", 'id' => 'contactos']) !!}
                    {!! Form::text('telefono',null,['class' => 'form-control','placeholder' => 'Telefono','v-model' => 'telefono','@keyup'=>"allowAdd()"]) !!}
                    {!! Form::button('agregar',['class' => 'btn btn-success','@click' => 'agregarContacto(nombre_contacto,telefono)','v-bind:disabled' => 'add_contact == true']) !!}
                </div>
                <table class="table" v-show="grupo.contactos.length > 0" style="margin-top: 10px">
                    <tr>
                        <th>Nombre del contacto</th>
                        <th>Telefono</th>
                        <th>Eliminar</th>
                    </tr>
                    <tr v-for="contacto in grupo.contactos">
                        <td>@{{ contacto.nombre }}</td>
                        <td>@{{ contacto.telefono }}</td>
                        <td><a title='Eliminar' href="#" @click.prevent='deleteContact(contacto)'><i class='glyphicon glyphicon-remove' ></i></a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    @include('grupos.formulario.social')

    
    <div class="col-md-12 alert-danger" v-if="errors.length > 0">
        <li v-for="error in errors" class="has-error">
            @{{ error.descripcion }}
        </li>
    </div>

    <div class="col-md-12" style="">
        {!! Form::button("Guardar", ['type' => 'submit', 'class' => 'btn btn-primary pull-right', '@click' => 'createGrupo()']) !!}
        <a href="{!! route('grupos.index') !!}" class="btn btn-success pull-right" style="margin-right: 10px">Cancelar</a>
    </div>


    <pre> @{{ $data | json }} </pre>
@endsection

