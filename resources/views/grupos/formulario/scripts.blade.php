@section('scripts')

<script>

    vm = new Vue({
        el: '#main',
        data:{
            grupo : {
                id: '',
                nombre: '',
                estilo_id: '',
                integrantes: '',
                web: '',
                contactos: [],
                facebook: '',
                twitter: '',
                instagram: '',
                youtube: '',
                vimeo: '',
                bandcamp: '',
                spotify: '',
                otro: ''
            },
            importar: false,
            estilos: [],
            titulo: "{!! $titulo !!}",
            nombre_contacto: '',
            telefono: '',
            add_contact: true,
            errors: [],
//            saving: false,
//            errors: [],
            token: ''

        },
        methods:{
            createGrupo: function(){
                $(".form-control").removeClass("marcarError");
                cargando("sk-folding-cube",'Guardando...');
                var grupo = this.grupo;
                grupo._token = this.token;
                vm.errors = [];
                $.ajax({
                    url: "{{ Route('grupos.store') }}",
                    method: 'POST',
                    data: grupo,
                    dataType: 'json',
                    success: function (data) {
                        location.href = "{{ Route('master',1) }}";
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
            cargarEstilos: function()
            {
                $.ajax({
                    url: "{{ Route('estilos.all') }}",
                    method: 'get',
                    dataType: 'json',
                    success: function (data) {
                        $.each(data,function(k,v){
                            vm.estilos.push({'id':v.id,'descripcion':v.descripcion});
                        });
                    }
                });
            },
            cargarDatos: function () {

                cargando("sk-circle",'Cargando...');
                $.ajax({
                    url: "{{ Route('grupos.getDataGrupo') }}",
                    method: 'get',
                    dataType: 'json',
                    data: "grupo_id={!! $grupo_id !!}",
                    success: function (data) {
                        vm.grupo.id = data.id;
                        vm.grupo.nombre = data.nombre;
                        vm.grupo.estilo_id = data.estilo_id;
                        vm.grupo.integrantes = data.integrantes;
                        vm.grupo.web = data.web;
                        vm.grupo.facebook = data.facebook;
                        vm.grupo.twitter = data.twitter;
                        vm.grupo.instagram = data.instagram;
                        vm.grupo.youtube = data.youtube;
                        vm.grupo.vimeo = data.vimeo;
                        vm.grupo.bandcamp = data.bandcamp;
                        vm.grupo.spotify = data.spotify;
                        vm.grupo.otro = data.otro;
                        vm.importar = true;
                        $.each(data.contactos,function(k,v){
                            vm.grupo.contactos.push({'id':v.id,'nombre':v.nombre,'telefono': v.telefono});
//                            console.log(v);
                        });

                        HoldOn.close();
                    }
                });
{{--              console.log("{!! $grupo_id !!}");--}}
            },
            agregarContacto: function(nombre, telefono){
                var id = vm.grupo.contactos.length + 1;
                vm.grupo.contactos.push({
                    'id_provisorio': id,
                    'nombre': nombre,
                    'telefono': telefono
                });
                vm.nombre_contacto = '';
                vm.telefono = '';
                vm.add_contact = true;
            },
            allowAdd: function()
            {
                var puede_agregar = true;
                if(vm.nombre_contacto == "")
                    puede_agregar = false;
                if(vm.telefono.length < 8)
                    puede_agregar = false;

                if(puede_agregar)
                    vm.add_contact = false;
                else
                    vm.add_contact = true;
            },
            deleteContact: function(contacto)
            {
                vm.grupo.contactos.$remove(contacto);
            }


        }
    });

    vm.cargarEstilos();
    @if($grupo_id)
    vm.cargarDatos();
    @endif

    $(document).ready(function(){

        $("input:text[name=telefono]").mask("00000000000000000000");


    });
</script>

@endsection