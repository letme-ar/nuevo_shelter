@extends('layouts.app')


@section('scripts')
    {!! Html::script('js/jquery.bootcomplete.js') !!}
    {!! Html::style('css/bootcomplete.css', array('media' => 'screen')) !!}

    <script>
        $(document).ready(function(){
            $('input:text[name=nombre_grupo]').bootcomplete({
                url: "{{ Route('grupos.listImport') }}"
            });
        });
    </script>

@endsection

@section('content')


<h2>Encuentra un grupo ya existente, o bien, crea uno nuevo</h2>

{!! Form::open(array('route' => 'grupos.create-grupo','type' => 'POST')) !!}

<input type="hidden" name="_token" value="{{ csrf_token() }}" v-model="token">

{!! Field::text('nombre_grupo',null,[]) !!}

{!! Form::button('Siguiente',['type' => 'submit','class' => 'btn btn-primary pull-right']) !!}

{!! Form::close() !!}

@endsection
