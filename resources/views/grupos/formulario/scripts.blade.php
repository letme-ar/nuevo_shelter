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
                        console.log(data);
                        location.href = "{{ Route('master',1) }}";
                    },
                    error: function (jqXHR) {
                        /*var mensaje = "";
                        vm.saving = false;
                        $.each(respuesta.responseJSON.errores,function(code,obj){
                            vm.errors.push({ 'descripcion':  obj });
                        });
                        HoldOn.close();*/
                        vm.errors = [];

                        $.each(jqXHR.responseJSON,function(code,obj){
//                            console.log(obj);
                            $("#"+code).addClass("marcarError");
                            vm.errors.push({ 'descripcion':  obj });
                            HoldOn.close();
                        });
                    }
                });

            },
            permitirGuardar: function()
            {
//                var puede_guardar = true;
//                    console.log(vm.cuenta.nro_cuenta);
//                    if(vm.cuenta.nro_cuenta == "")
//                        puede_guardar = false;
//                    if(vm.cuenta.nombre_cuenta == "")
//                        puede_guardar = false;
//                    if(vm.cuenta.dominio == "")
//                        puede_guardar = false;
//                    if(vm.cuenta.nombre_server_principal == "")
//                        puede_guardar = false;
//                    if(vm.cuenta.nombre_server_backup == "")
//                        puede_guardar = false;

//                if(puede_guardar)
//                    vm.saving = false;
//                else
//                    vm.saving = true;
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
                console.log(vm.grupo.contactos);
            }


        }
    });

    vm.cargarEstilos();

    $(document).ready(function(){

        $("input:text[name=telefono]").mask("00000000000000000000");


    });
</script>

@endsection