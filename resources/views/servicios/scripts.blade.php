@section('scripts')

    {!! Html::script('js/bootstrap-datepicker.js') !!}
    {!! Html::script('js/bootstrap-datepicker.es.js') !!}
    {!! Html::style('css/bootstrap-datepicker.css', array('media' => 'screen')) !!}

    <script>
        vm = new Vue({
            el: '#main',
            data:{
                servicio: {
                    id: '',
                    descripcion: '',
                    precio: 0,
                    fecha_desde: '',
                    fecha_hasta: ''
                },
                errors: [],
                token: '',
                serviciosxfotos: [],
                titulo: "{{ $titulo }}"
            },
            methods:{
                create: function(){
                    $(".form-control").removeClass("marcarError");
                    cargando("sk-folding-cube",'Guardando...');
                    var formData = new FormData(document.getElementById("frmServicio"));
                    var servicio = this.servicio;
                    servicio._token = this.token;
                    vm.errors = [];
                    $.ajax({
                        type: "Post",
                        url: "{{ Route('servicios.store') }}",
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
                        url: "{{ Route('servicios.getDataServicio') }}",
                        method: 'get',
                        dataType: 'json',
                        data: "servicio_id={!! isset($servicio_id) ? $servicio_id : null !!}",
                        success: function (data) {
                            vm.servicio = data;
                            HoldOn.close();
                        }
                    });
                }
            }
        });
        @if(isset($servicio_id))
        vm.cargarDatos();
        @endif

        $().ready(function (){

            $(".fecha").mask("00/00/0000");

            $(".from_date").datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                language: 'es'
            }).on('changeDate', function (selected) {
                var startDate = new Date(selected.date.valueOf());
                $('.to_date').datepicker('setStartDate', startDate);
            }).on('clearDate', function (selected) {
                $('.to_date').datepicker('setStartDate', null);
            });

            $(".to_date").datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                language: 'es'
            }).on('changeDate', function (selected) {
                var endDate = new Date(selected.date.valueOf());
                $('.from_date').datepicker('setEndDate', endDate);
            }).on('clearDate', function (selected) {
                $('.from_date').datepicker('setEndDate', null);
            });
        });

    </script>


@endsection