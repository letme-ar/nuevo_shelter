@extends('layouts.app')

@include('servicios.scripts')

@section('content')

    <h1>@{{ titulo }} un servicio</h1>


    {!! Form::model(isset($servicio) ? $servicio:null,array('enctype' => 'multipart/form-data','id' => 'frmServicio')) !!}

    <input type="hidden" name="id" value="" v-model="servicio.id">

    <input type="hidden" name="_token" value="{{ csrf_token() }}" v-model="token">

    <div class="col-md-6">
        {!! Form::label('descripcion','Descripcion') !!}

        {!! Form::text('descripcion',null,['class' => 'form-control','v-model' => 'servicio.descripcion']) !!}
    </div>
    <div class="col-md-6">
        {!! Form::label('precio','Precio') !!}

        <div class="input-group">
                <span class="input-group-addon">
                    <span class="fa fa-usd"></span>
                </span>
            {!! Form::text('precio',null,['class' => 'form-control','v-model' => 'servicio.precio']) !!}
        </div>
    </div>

    <div class="col-md-6">
            {!! Form::label('fecha_desde','Fecha desde') !!}

            <div class="input-group">
                <span class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                </span>
                {!! Form::text('fecha_desde',null,['class' => 'form-control from_date fecha','v-model' => 'servicio.fecha_desde']) !!}
            </div>
    </div>

    <div class="col-md-6">
        {!! Form::label('fecha_hasta','Fecha hasta') !!}

        <div class="input-group">
            <span class="input-group-addon">
                <span class="fa fa-calendar"></span>
            </span>
            {!! Form::text('fecha_hasta',null,['class' => 'form-control from_date fecha','v-model' => 'servicio.fecha_hasta']) !!}
        </div>
    </div>
    {{--{!! Field::text('fecha_desde',null,['v-model' => 'servicio.fecha_desde','data-date-format' => "dd/mm/yyyy",'class' => 'from_date']) !!}--}}


    <div class="col-md-12 alert-danger" v-if="errors.length > 0" style="margin-top: 20px">
        <li v-for="error in errors" class="has-error">
            @{{ error.descripcion }}
        </li>
    </div>




    <div class="col-md-12" style="margin-top: 20px">
        {!! Form::button("Guardar", ['type' => 'submit', 'class' => 'btn btn-primary pull-right', '@click.prevent' => 'create()']) !!}
        <a href="{!! route('servicios.index') !!}" class="btn btn-success pull-right" style="margin-right: 10px">Cancelar</a>
    </div>

    {!! Form::close() !!}

    <pre> @{{ $data | json }} </pre>



@endsection