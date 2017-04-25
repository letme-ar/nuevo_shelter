@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Agregar usuario al negocio</div>
                    <div class="panel-body">
{{--                        {!! Form::model($user,$data_form, ['role' => 'form']) !!}--}}
                        {!! Form::model(isset($user) ? $user:null ,$data_form, ['role' => 'form']) !!}

                        {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $user->id }}" />

                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="username" class="col-md-4 control-label">Nombre de usuario</label>

                                <div class="col-md-6">
                                    {{--<input id="username" type="text" class="form-control" name="username" value="{{ old('nombre') }}"  required autofocus>--}}
                                    {{ Form::text('username',null,['class' => 'form-control','required','autofocus']) }}
                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                                <label for="nombre" class="col-md-4 control-label">Nombre</label>

                                <div class="col-md-6">
                                    {{--<input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required autofocus>--}}
                                    {{ Form::text('nombre',null,['class' => 'form-control','required','autofocus']) }}

                                    @if ($errors->has('nombre'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('apellido') ? ' has-error' : '' }}">
                                <label for="apellido" class="col-md-4 control-label">Apellido</label>

                                <div class="col-md-6">
                                    {{--<input id="apellido" type="text" class="form-control" name="apellido" value="{{ old('apellido') }}" required autofocus>--}}
                                    {{ Form::text('apellido',null,['class' => 'form-control','required','autofocus']) }}

                                    @if ($errors->has('apellido'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('apellido') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Correo electrónico</label>

                                <div class="col-md-6">
                                    {{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>--}}
                                    {{ Form::text('email',null,['class' => 'form-control','required','autofocus']) }}

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="type_user_id" class="col-md-4 control-label">Tipo de usuario</label>
                                <div class="col-md-6">
                                    {!! Form::select('type_user_id',[2 => 'Administrador de negocio',3 => 'Gestor de negocio'],null,['class' => 'form-control']) !!}
                                </div>
                            </div>

                            @if(!isset($user))
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Password</label>

                                    <div class="col-md-6">
                                        {{--<input id="password" type="password" class="form-control" name="password" required>--}}
                                        {{ Form::password('username',['class' => 'form-control','required','autofocus']) }}

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="password-confirm" class="col-md-4 control-label">Repetir Password</label>

                                    <div class="col-md-6">
                                        {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>--}}
                                        {{ Form::password('password-confirmation',['class' => 'form-control','required']) }}
                                    </div>
                                </div>
                            @endif
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
