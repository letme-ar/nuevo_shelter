@if(isset($negocio))
    @if(count($negocio->negociosxfotos))
        @include('components.galeria',array("titulo"=>"Archivos cargados","fotos"=>$negocio->negociosxfotos))
    @endif
@endif