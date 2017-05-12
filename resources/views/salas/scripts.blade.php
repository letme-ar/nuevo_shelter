@section('scripts')

    {!! Html::script('js/jquery.bxslider.min.js') !!}

    {!! Html::style('css/jquery.bxslider.min.css', array('media' => 'screen')) !!}


    <script>

        vm = new Vue({
            el: '#main',
            data:{
                sala : {
                    id: '',
                    nombre: '',
                    descripcion: '',
                    principal: 0

                },
                errors: [],
                token: '',
                salasxfotos: [],
                titulo: "{{ $titulo }}"

            },
            watch:{
                salasxfotos:function(){
                    $('.bxslider').bxSlider({
                        mode: 'fade',
                        captions: true
                    });
                }
            },
            methods:{
                create: function(){
                    $(".form-control").removeClass("marcarError");
                    cargando("sk-folding-cube",'Guardando...');
                    var formData = new FormData(document.getElementById("frmSala"));

                    var sala = this.sala;
                    sala._token = this.token;
                    vm.errors = [];

                    $.ajax({
                        type: "Post",
                        url: "{{ Route('salas.store') }}",
                        data: formData,
                        assync: true,
                        dataType: "json",
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            location.href = "{{ Route('master',5) }}";
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

                },
                cargarDatos: function () {

                    cargando("sk-circle",'Cargando...');
                    $.ajax({
                        url: "{{ Route('salas.getDataSala') }}",
                        method: 'get',
                        dataType: 'json',
                        data: "sala_id={!! isset($sala_id) ? $sala_id : null !!}",
                        success: function (data) {
                            vm.sala = data;
                            vm.salasxfotos = data.salasxfotos;
                            HoldOn.close();
                        }
                    });
                }
            }
        });

        @if(isset($sala_id))
            vm.cargarDatos();
        @endif

    </script>


@endsection