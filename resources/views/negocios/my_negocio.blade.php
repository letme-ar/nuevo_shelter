@extends('layouts.app')

@section('scripts')
    {!! Html::script('js/photo-gallery.js') !!}

    <style>

        .redondeado{
            border-radius: 200px 200px 200px 200px;
            -moz-border-radius: 200px 200px 200px 200px;
            -webkit-border-radius: 200px 200px 200px 200px;
            border: 0px solid #000000;
            height: 400px;
            width: 100%;
        }

        .modal-body {
            padding:5px !important;
        }
        .modal-content {
            border-radius:0;
        }
        .modal-dialog img {
            text-align:center;
            margin:0 auto;
        }

        .controls2{
            width:50px;
            display:block;
            font-size:11px;
            padding-top:8px;
            font-weight:bold;
        }

        .next {
            float:right;
            text-align:right;
        }
        /*override modal for demo only*/
        .modal-dialog {
            max-width:500px;
            padding-top: 90px;
        }
        @media screen and (min-width: 768px){
            .modal-dialog {
                width:500px;
                padding-top: 90px;
            }
        }
        @media screen and (max-width:1500px){
            #ads {
                display:none;
            }
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
                            location.href = "{{ Route('master',3) }}";
                            HoldOn.close();
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


    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-36251023-1']);
        _gaq.push(['_setDomainName', 'jqueryscript.net']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>




@endsection


@section('content')

    <h1>Mi negocio
        @if($type_user_id == 1 || $type_user_id == 2)
            <a href="{!! route('usersxnegocio')!!}"><button class="btn btn-success pull-right" >Administración de usuarios</button></a>
        @endif
    </h1>

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
        {!! Field::text('facebook',$negocio->faceook,['v-model' => 'negocio.facebook']) !!}
    </div>

    <div class="col-md-6">
        {!! Field::text('twitter',$negocio->twitter,['v-model' => 'negocio.twitter']) !!}
    </div>

    <div class="col-md-6">
        {!! Field::text('instagram',$negocio->instagram,['v-model' => 'negocio.instagram']) !!}
    </div>

   <div class="col-md-6">
        {!! Field::text('direccion',$negocio->direccion,['v-model' => 'negocio.direccion']) !!}
    </div>

    <div class="col-md-12">
        <label>Cargar fotos del negocio</label>
        <input name="fotos[]" type="file" multiple="multiple" class="form-control" />
    </div>

    <ul class="row">
        @foreach($negocio->negociosxfotos as $fotos)
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img class="img-responsive" src="{{ $fotos->path_foto }}">
            </li>
        @endforeach
    </ul>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


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