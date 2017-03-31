@extends('layouts.app')

@section('scripts')
    <style>

        .redondeado{
            border-radius: 200px 200px 200px 200px;
            -moz-border-radius: 200px 200px 200px 200px;
            -webkit-border-radius: 200px 200px 200px 200px;
            border: 0px solid #000000;
            height: 100%;
            width: 100%;
        }

    </style>
<script>


    vm = new Vue({
        el: '#main',
        data:{
            datos : {
                id: '',
                nombre: '',
                apellido: '',
                email: ''
            },
            errors: [],
            token: ''

        },
        methods:{
            update: function(){
                $(".form-control").removeClass("marcarError");
                cargando("sk-folding-cube",'Guardando...');
                var datos = this.datos;
                datos._token = this.token;
                vm.errors = [];
                $.ajax({
                    url: "{{ Route('account.update') }}",
                    method: 'POST',
                    data: datos,
                    dataType: 'json',
                    success: function (data) {
                        location.href = "{{ Route('master',2) }}";
                    },
                    error: function (jqXHR) {
                        vm.errors = [];

                        $.each(jqXHR.responseJSON,function(code,obj){
                            $("#"+code).addClass("marcarError");
                            vm.errors.push({ 'descripcion':  obj });
                            HoldOn.close();
                        });
                    }
                });

            }

        }
    });

    /*function guardar()
    {
        cargando("sk-folding-cube",'Guardando...');
        var nombre = $("input:text[name=nombre]").val();
        var apellido = $("input:text[name=apellido]").val();
        var email = $("input:text[name=email]").val();
        var token = $("input:hidden[name=_token]").val();

        $.ajax({
            url: "{{ Route('account.update') }}",
            method: 'POST',
            data: "nombre="+nombre+"&apellido="+apellido+"&email="+email+"&_token="+token,
            dataType: 'json',
            success: function (data) {
                location.href = "{{ Route('master',2) }}";
            },
            error: function (jqXHR) {

            }
        });
    }*/

    $(document).ready(function(){



    });


</script>
    <script>
        document.getElementById("file").onchange = function () {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("image").src = e.target.result;
            }
            reader.readAsDataURL(this.files[0]);
        }
    </script>

@endsection


@section('content')

    <h1>Mi perfil</h1>

    @include('components.message-confirmation')

    {!! Form::open(array('route' => 'account.update','type' => 'POST')) !!}

    <input type="hidden" name="_token" value="{{ csrf_token() }}" v-model="token">

    <input type="hidden" name="id" value="{{ $user->id }}" v-model="datos.id">

    <div class="col-md-6">
        {!! Field::text('nombre',$user->nombre,['v-model' => 'datos.nombre']) !!}

        {!! Field::text('apellido',$user->apellido,['v-model' => 'datos.apellido']) !!}

        {!! Field::text('email',$user->email,['v-model' => 'datos.email']) !!}

        <label for="file">Foto de perfil</label>
        <input type="file" id="file" />
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="col-md-12">
                <img id="image"  class="redondeado" />
            </div>
        </div>
    </div>


    {!! Form::button('Actualizar',['type' => 'submit','class' => 'btn btn-primary pull-right', '@click.prevent' => 'update()']) !!}

    {!! Form::close() !!}

    <div class="col-md-12 alert-danger" v-if="errors.length > 0">
        <li v-for="error in errors" class="has-error">
            @{{ error.descripcion }}
        </li>
    </div>



@endsection