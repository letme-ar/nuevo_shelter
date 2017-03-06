@extends('layouts.app')

@section('scripts')



@endsection


@section('content')

<h1>Grupos <a href="{!! route('grupos.find-grupo')!!}"><button class="btn btn-success pull-right" >Agregar</button></a></h1>

@include('components.message-confirmation')

@endsection

