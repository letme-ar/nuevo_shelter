@extends('layouts.app')

@section('scripts')

@endsection


@section('content')

    <h1>Usuarios
        <a href="{!! route('users.create')!!}"><button class="btn btn-success pull-right" >Agregar</button></a>
    </h1>

    @include('components.message-confirmation')


    <table class="table responsive table-bordered table-hover table-striped" >
        <thead>
        <tr>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="table">
        @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->username }}</td>
                <td>{{ $usuario->nombre }}</td>
                <td>{{ $usuario->apellido }}</td>
                <td>{{ $usuario->email }}</td>
                <td><a title='Editar' href="{{route('users.index')}}/{{ $usuario->user_id }}/edit"><i class='glyphicon glyphicon-edit' ></i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection

