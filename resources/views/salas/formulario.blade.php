@extends('layouts.app')

@include('salas.scripts')

@section('content')

    <h1>Agregar una sala</h1>


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

    <ul class="row col-md-12">
        <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4" v-for="foto in sala.salasxfotos">
            <img class="img-responsive" src="../../@{{ foto.path_foto }}">
        </li>
    </ul>

    <div class="col-md-12 alert-danger" v-if="errors.length > 0" style="margin-top: 20px">
        <li v-for="error in errors" class="has-error">
            @{{ error.descripcion }}
        </li>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="col-md-12" style="margin-top: 20px">
        {!! Form::button("Guardar", ['type' => 'submit', 'class' => 'btn btn-primary pull-right', '@click.prevent' => 'create()']) !!}
        <a href="{!! route('salas.index') !!}" class="btn btn-success pull-right" style="margin-right: 10px">Cancelar</a>
    </div>

    {!! Form::close() !!}

        <pre> @{{ $data | json }} </pre>



@endsection