<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    {!! Html::script('js/jquery.js') !!}
    {!! Html::script('js/vue.js') !!}
    {!! Html::script('js/bootstrap.min.js') !!}
    {!! Html::script('js/HoldOn.js') !!}
    {!! Html::script('js/jquery.mask.js') !!}
    {!! Html::style('css/app.css', array('media' => 'screen')) !!}
    {!! Html::style('css/HoldOn.css', array('media' => 'screen')) !!}
    {!! Html::style('css/font-awesome.css', array('media' => 'screen')) !!}
    {!! Html::style('css/style.css', array('media' => 'screen')) !!}

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>


        /*
         Possible types: "sk-cube-grid", "sk-bounce", "sk-folding-cube","sk-circle","sk-dot","sk-falding-circle"
         "sk-cube-grid", "custom"
         */
        function cargando(type,message){
            HoldOn.open({
                theme: type,
                message:"<h4>"+message+"</h4>"
            });

            setTimeout(function(){
                HoldOn.close();
            },300000);
        }

        function peticionAjax(destino,datos)
        {
            redireccionar = redireccionar || 0;
            cargando("sk-folding-cube",'Guardando...');
            $.ajax({
                type: "Post",
                url: destino,
                data: datos,
                assync: true,
                dataType: "html",
                cache: false,
                contentType: false,
                processData: false,
                success: function(respuesta){
                    location.href = "{{ Route('master',4) }}";
                },
                error: function(result) {
                    var mensaje = "";
                    $.each(JSON.parse(result.responseText),function(code,obj){
                        mensaje += "<li>"+obj[0]+"</li><br>";
                    });
                    $("#contenido-modal-").html(mensaje);
                    $("#confirmacion-").modal(function(){show:true});
                    HoldOn.close();
                }


            });
        }
    </script>

    <style>

        .marcarError{
            background-color: red;
            color: white;
        }

    </style>


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    @if (!Auth::guest())
                    <ul class="nav navbar-nav">
                        <li><a href="{{ route('grupos.index') }}">Grupos</a></li>
                        <li><a href="#">Productos</a></li>
                        <li><a href="#">Servicios</a></li>
                        <li><a href="#">Calendario</a></li>
                        <li><a href="{{ url('salas') }}">Salas</a></li>
                        <li><a href="#">Reportes</a></li>
                    </ul>
                    @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Ingresar</a></li>
                            <li><a href="{{ url('/register') }}">Registrarse</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/profile') }}">Mi perfil</a></li>
                                    <li><a href="{{ url('/negocio') }}">Mi negocio</a></li>
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Cerrar sesión
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

    </div>
    <div class="container" id="main">
        @yield('content')
    </div>
    <!-- Scripts -->


</body>
@yield('scripts')
</html>
