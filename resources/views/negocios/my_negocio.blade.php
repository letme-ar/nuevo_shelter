@extends('layouts.app')

@section('scripts')
    <style>

        .redondeado{
            border-radius: 200px 200px 200px 200px;
            -moz-border-radius: 200px 200px 200px 200px;
            -webkit-border-radius: 200px 200px 200px 200px;
            border: 0px solid #000000;
            height: 400px;
            width: 100%;
        }

    </style>
    <script>


        vm = new Vue({
            el: '#main',
            data:{
                negocio : {
                    id: '',
                    descripcion: '',
                    mail: '',
                    web: '',
                    facebook: '',
                    twitter: '',
                    instagram: '',
                    direccion: ''
                },
                errors: [],
                token: ''

            },
            methods:{
                update: function(){
                    $(".form-control").removeClass("marcarError");
                    cargando("sk-folding-cube",'Guardando...');
//                var nombre = this.datos.nombre;
//                var apellido = this.datos.apellido;
//                var email = this.datos.email;
//                var foto = $("#file").get(0).files;
                    var formData = new FormData(document.getElementById("frmPerfil"));
//                datos._token = this.token;
                    var token = this.token;
                    vm.errors = [];
                    $.ajax({
                        type: "Post",
                        url: "{{ Route('negocio.update') }}",
                        data: formData,
                        assync: true,
                        dataType: "json",
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            location.href = "{{ Route('master',2) }}";
                        },
                        error: function (jqXHR) {
                            vm.errors = [];

                            console.log(jqXHR);
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

    <h1>Mi negocio</h1>

    @include('components.message-confirmation')

    {!! Form::model($negocio,array('route' => 'account.update','enctype' => 'multipart/form-data','id' => 'frmPerfil')) !!}

    <input type="hidden" name="_token" value="{{ csrf_token() }}" v-model="token">

    <input type="hidden" name="id" value="{{ $negocio->id }}" v-model="negocio.id">

    <div class="col-md-6">
        {!! Field::text('descripcion',$negocio->descripcion,['v-model' => 'negocio.descripcion']) !!}
    </div>
    <div class="col-md-6">
        {!! Field::text('mail',$negocio->mail,['v-model' => 'negocio.mail']) !!}
    </div>

    <div class="col-md-6">
        {!! Field::text('web',$negocio->web,['v-model' => 'negocio.web']) !!}
    </div>

    <div class="col-md-6">
        {!! Field::text('facebook',$negocio->web,['v-model' => 'negocio.facebook']) !!}
    </div>

    <div class="col-md-6">
        {!! Field::text('twitter',$negocio->web,['v-model' => 'negocio.twitter']) !!}
    </div>

    <div class="col-md-6">
        {!! Field::text('instagram',$negocio->web,['v-model' => 'negocio.instagram']) !!}
    </div>

    <div class="col-md-6">
        {!! Field::text('direccion',$negocio->web,['v-model' => 'negocio.direccion']) !!}
    </div>



    <div class="col-md-12 alert-danger" v-if="errors.length > 0">
        <li v-for="error in errors" class="has-error">
            @{{ error.descripcion }}
        </li>
    </div>

    <div class="col-md-12">
        {!! Form::button('Actualizar',['type' => 'submit','class' => 'btn btn-primary pull-right', '@click.prevent' => 'update()']) !!}
    </div>

    {!! Form::close() !!}




@endsection