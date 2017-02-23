@extends('layouts.app')


@section('scripts')

@endsection

@section('content')


<h2>Encuentra un grupo ya existente, o bien, crea uno nuevo</h2>

{!! Form::open(array('route' => 'grupos.create-grupo','type' => 'POST')) !!}

{!! Field::text('grupo',null,[]) !!}

{!! Form::button('Siguiente',['type' => 'submit','class' => 'btn btn-primary pull-right']) !!}

{!! Form::close() !!}

@endsection
