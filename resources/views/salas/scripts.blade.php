@section('scripts')

    {!! Html::script('js/photo-gallery.js') !!}


    <script>

        vm = new Vue({
            el: '#main',
            data:{
                sala : {
                    id: '',
                    nombre: '',
                    descripcion: '',
                    principal: 0,
                    salasxfotos: []
                },
                errors: [],
                token: ''

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