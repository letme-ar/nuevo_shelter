@extends('layouts.app')

@section('scripts')

    <script>

        vm = new Vue({
            el: '#main',
            data:{
                sala : {
                    nombre: '',
                    descripcion: ''
                },
                pagina_actual: 0,
                first: '',
                prev: '',
                next: '',
                last: '',
                lista: [],
                busqueda: true,
                id_seleccionado: 0,
                token: ''

            },
            watch:{
                lista:function(){
                    $('[data-toggle="tooltip"]').tooltip();
                }
            },
            methods:{
                eliminar: function(id,nombre)
                {
                    $("#pregunta-1").modal(function(){show:true});

                    $("#contenido-pregunta-1").html("");
                    $("#contenido-pregunta-1").append("<h3>¿Eliminar sala <strong>"+nombre+"</strong>?</h2>");
                    $("#pregunta-1").modal(function(){show:true});
                    $("input:hidden[name=id_seleccionado]").val(id);
                },
                buscar: function(url){
                    $("#message-confirmation").addClass("hidden");
                    if(url == undefined)
                        var url = "{{route('salas.buscar')}}" + "?" + "page=1&nombre="+this.sala.nombre+"&apellido="+this.sala.descripcion;

                    var sala = this.sala;
                    sala._token = this.token;

                    cargando('sk-circle','Buscando');
                    $.ajax({
                        url: url,
                        method: 'GET',
                        dataType: "json",
                        assync: true,
                        data: sala,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            vm.pagina_actual = 'Página '+ data.current_page + ' de '+ data.last_page + '. Cantidad de registros: ' + data.total;
                            vm.lista = data.data;
                            vm.first = "{{route('salas.buscar')}}" + "?page=1";
                            vm.next = data.next_page_url;
                            if(data.total <= "{{ env('APP_CANT_PAGINATE',10) }}")
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
                            vm.last = "{{route('salas.buscar')}}" + "?page="+data.last_page;
                            HoldOn.close();
                            vm.busqueda = false;
                        },
                        error: function (respuesta) {
                            HoldOn.close();
                        }
                    });
                }
            }
        });

        $(document).ready(function(){

            $("#eliminar-1").click(function(){
                var id = $("input:hidden[name=id_seleccionado]").val();
                var urlDelete = "{{route('salas.eliminar')}}";
                var token = $("input:hidden[name=_token]").val();
                cargando("sk-folding-cube",'Guardando...');
                $.ajax({
                    type: "Post",
                    url : urlDelete,
                    data: "id="+id+"&_token="+token,
                    success: function(respuesta)
                    {
                        HoldOn.close();
                        $("#pregunta-1").modal("hide");
                        $("#contenido-modal-1").html("Se ha eliminado la sala");
                        $("#confirmacion-1").modal(function(){show:true});
                        location.href = "{{ Route('master',5) }}";

                    }
                });
            });
        });
    </script>


@endsection


@section('content')

    <h1>Salas
        <a href="{!! route('salas.create')!!}"><button class="btn btn-success pull-right" >Agregar</button></a>
    </h1>

    @include('components.message-confirmation')

    {{ Form::hidden('id_seleccionado',null,['id' => 'id_seleccionado']) }}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    {{ method_field('PUT') }}
    <div class="form-inline" style="margin-bottom: 10px">

        {{ Form::text('nombre',null,['class' => 'form-control','placeholder' => 'Nombre','v-model' => 'sala.nombre','autofocus']) }}

        {{ Form::text('descripcion',null,['class' => 'form-control','placeholder' => 'Descripcion','v-model' => 'sala.descripcion','autofocus']) }}

        {{ Form::button('buscar',['class' => 'btn btn-info', '@click.prevent'=>'buscar()','autofocus' ]) }}
    </div>

    <div v-show="lista.length > 0">
        {{ Form::button('Primera',['id' => 'first','class' => 'btn btn-warning',''=>'', '@click.prevent'=>'buscar(first)']) }}
        {{ Form::button('Anterior',['id' => 'prev','class' => 'btn btn-warning', '@click.prevent'=>'buscar(prev)']) }}
        {{ Form::button('Última',['id' => 'last','class' => 'btn btn-warning pull-right','style' => 'margin-left: 5px', '@click.prevent'=>'buscar(last)']) }}
        {{ Form::button('Siguiente',['id' => 'next','class' => 'btn btn-warning pull-right', '@click.prevent'=>'buscar(next)']) }}
        <table class="table responsive table-bordered table-hover table-striped" style="margin-top: 10px" >
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>¿Principal?</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody id="table">
            <tr v-for="registro in lista" class="@{{ registro.principal ? 'principal' : '' }}">
                <td>@{{ registro.nombre }}</td>
                <td>@{{ registro.descripcion }}</td>
                <td v-show="registro.principal">
                    Si
                </td>
                <td v-show="!registro.principal">
                    No
                </td>
                <td>
                    <a data-toggle="tooltip" data-placement="top"  title='Editar' href="{{route('salas.index')}}/@{{ registro.id }}/edit"><i class='glyphicon glyphicon-edit' ></i></a>

                    <a data-toggle="tooltip" data-placement="top" v-show="!registro.principal" title='Eliminar' style="cursor: pointer" @click='eliminar(registro.id,registro.nombre)' ><i class='glyphicon glyphicon-trash' ></i></a>
                    <a data-toggle="tooltip" data-placement="top"   v-show="registro.deleted_at" title='Activar' style="cursor: pointer" @click='activar(registro.id,registro.dni)' ><i class='glyphicon glyphicon-thumbs-up' ></i></a>
                </td>
            </tr>
            </tbody>
        </table>
        <label id="pagina_actual" class="pull-right" >@{{ pagina_actual }}</label>
    </div>
    <h2 v-show="busqueda == false && lista.length == 0">No se encontraron resultados</h2>

    @include('components.modal',['accion' => 'Eliminar','id' => 1])

    @include('components.modal',['accion' => 'Activar','id' => 2])



@endsection

