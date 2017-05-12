@extends('layouts.app')

@include('salas.scripts')

@section('content')

    <h1>@{{ titulo }} una sala</h1>


    {!! Form::model(isset($sala) ? $sala:null,array('enctype' => 'multipart/form-data','id' => 'frmSala')) !!}

    <input type="hidden" name="id" value="" v-model="sala.id">

    <input type="hidden" name="_token" value="{{ csrf_token() }}" v-model="token">

    <div class="col-md-6">
        {!! Field::text('nombre',null,['v-model' => 'sala.nombre', 'autofocus']) !!}
    </div>

    <div class="col-md-6">
        {!! Field::text('descripcion',null,['v-model' => 'sala.descripcion']) !!}
    </div>


    <div class="col-md-6">
        <label>Cargar fotos de la sala</label>
        <input name="fotos[]" type="file" multiple="multiple" class="form-control" />
    </div>

    <div class="checkbox col-md-6">
        <label>
            <input type="checkbox" name="principal" v-model="sala.principal" value="1"> ¿Es la sala principal?
        </label>
    </div>

    <hr>
    <div class="row" style="margin-top: 10px" v-if="salasxfotos.length > 0">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info" style="min-height: 300px">
                <div class="panel-heading">Fotos cargadas</div>
                <div class="col-md-12 form-inline" style="margin-top: 10px">
                    <ul class="bxslider">
                        <li v-for="foto in salasxfotos"><img src="../../@{{ foto.path_foto }}" style="max-height: 300px" /></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 alert-danger" v-if="errors.length > 0" style="margin-top: 20px">
        <li v-for="error in errors" class="has-error">
            @{{ error.descripcion }}
        </li>
    </div>




    <div class="col-md-12" style="margin-top: 20px">
        {!! Form::button("Guardar", ['type' => 'submit', 'class' => 'btn btn-primary pull-right', '@click.prevent' => 'create()']) !!}
        <a href="{!! route('salas.index') !!}" class="btn btn-success pull-right" style="margin-right: 10px">Cancelar</a>
    </div>

    {!! Form::close() !!}

        <pre> @{{ $data | json }} </pre>



@endsection