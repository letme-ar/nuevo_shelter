@extends('layouts.app')

@section('scripts')

    <script>

        function filtrar() {
            var params = "";

            if($('input:text[name=nro_cuenta]').val() != "")
                params += "&like[nro_cuenta]="+ $('input:text[name=nro_cuenta]').val();
            if($('input:text[name=nombre_cuenta]').val() != "")
                params += "&like[nombre_cuenta]="+ $('input:text[name=nombre_cuenta]').val();
            if($('input:text[name=dominio]').val() != "")
                params += "&like[dominio]="+ $('input:text[name=dominio]').val();

            return params;
        }

        vm = new Vue({
            el: '#main',
            data:{
                grupo : {
                    nombre: ''
                },
                pagina_actual: 0,
                first: '',
                prev: '',
                next: '',
                last: '',
                lista: [],
                busqueda: true,
                token: ''

            },
            methods:{
                buscar: function(url){
//                    var filtro = filtrar();
                    if(url == undefined)
                        var url = "{{route('grupos.buscar')}}" + "?" + "page=1";

                    var grupo = this.grupo;
                    grupo._token = this.token;


//                    var cuenta = JSON.stringify(this.cuenta);
                    cargando('sk-circle','Buscando');
                    $.ajax({
                        url: url,
                        method: 'GET',
                        dataType: 'json',
                        assync: true,
                        data: grupo,
                        success: function (data) {
                            vm.pagina_actual = 'Página '+ data.current_page + ' de '+ data.last_page + '. Cantidad de registros: ' + data.total;
                            vm.lista = data.data;
                            vm.first = "{{route('grupos.buscar')}}" + "?page=1";
                            vm.next = data.next_page_url;

//                            $("#pagina_actual").text('Página '+ data.current_page + ' de '+ data.last_page + '. Cantidad de registros: ' + data.total);

                            if(data.total < {{ env('APP_CANT_PAGINATE') }})
                            {
                                $("#next").addClass("hidden");
                                $("#first").addClass("hidden");
                                $("#prev").addClass("hidden");
                                $("#last").addClass("hidden");
                            }
                            else
                            {
                                $("#next").removeClass("hidden");
                                $("#first").removeClass("hidden");
                                $("#prev").removeClass("hidden");
                                $("#last").removeClass("hidden");
                            }

                            vm.prev = data.prev_page_url
                            vm.last = "{{route('grupos.buscar')}}" + "?page="+data.last_page;
                            HoldOn.close();
                        },
                        error: function (respuesta) {

                            HoldOn.close();
                        }
                    });
                    vm.busqueda = false;
//                console.log(filtrar());

                }
            }
        });


    </script>

@endsection


@section('content')

<h1>Grupos <a href="{!! route('grupos.find-grupo')!!}"><button class="btn btn-success pull-right" >Agregar</button></a></h1>

@include('components.message-confirmation')


<div class="form-inline">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" v-model="token">

    {{ method_field('PUT') }}

    {{ Form::text('nombre',null,['class' => 'form-control','placeholder' => 'Nombre del grupo','v-model' => 'grupo.nombre']) }}

    {{--{{ Form::text('nombre_cuenta',null,['class' => 'form-control','placeholder' => 'Nombre de la cuenta','v-model' => 'cuenta.nombre_cuenta']) }}--}}

    {{--{{ Form::text('dominio',null,['class' => 'form-control','placeholder' => 'Dominio','v-model' => 'cuenta.dominio']) }}--}}

    {{ Form::button('buscar',['class' => 'btn btn-success', '@click.prevent'=>'buscar()']) }}

</div>

<div v-show="lista.length > 0">
    {{ Form::button('Primera',['id' => 'first','class' => 'btn btn-success',''=>'', '@click.prevent'=>'buscar(first)']) }}
    {{ Form::button('Anterior',['id' => 'prev','class' => 'btn btn-success', '@click.prevent'=>'buscar(prev)']) }}
    {{ Form::button('Última',['id' => 'last','class' => 'btn btn-success pull-right', '@click.prevent'=>'buscar(last)']) }}
    {{ Form::button('Siguiente',['id' => 'next','class' => 'btn btn-success pull-right', '@click.prevent'=>'buscar(next)']) }}
    <table class="table responsive table-bordered table-hover table-striped" >
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Estilo</th>
            <th>Contacto</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="table">
        <tr v-for="registro in lista">
            <td>@{{ registro.nombre }}</td>
            <td>@{{ registro.estilo.descripcion }}</td>
            <td>@{{ registro.contacto }}</td>
            <td><a title='Editar' href="{{route('grupos.index')}}/@{{ registro.id }}/edit"><i class='glyphicon glyphicon-edit' ></i></a></td>
        </tr>
        </tbody>
    </table>
    <label id="pagina_actual" class="pull-right" >@{{ pagina_actual }}</label>
</div>
<h2 v-show="busqueda == false && lista.length == 0">No se encontraron resultados</h2>

{{--<pre> @{{ $data | json }} </pre>--}}

@endsection

