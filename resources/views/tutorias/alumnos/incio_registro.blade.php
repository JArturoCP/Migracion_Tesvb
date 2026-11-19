@extends('layouts.panel')
@section('title', 'Expediente')
@include('tutorias.partials.recursos_panel')
@section('content')
    @include('tutorias.alumnos.partial.navegacion_panel', ['titulo' => 'Expediente', 'activa' => '/tutorias/inicioalu'])

    <x-panel.tarjeta class="tw:mx-auto tw:max-w-xl" titulo="Expediente de Tutorías" subtitulo="Para comenzar, inicia el registro de tu expediente.">
        <form id="form_registrar" action="{{url("/tutorias/registrar_inicio_expediente")}}" class="" role="form" method="POST">

            {{ csrf_field() }}
        </form>
        <div class="tw:flex tw:justify-center">
            <x-panel.boton id="registro" tamano="lg">Iniciar registro de expediente</x-panel.boton>
        </div>
    </x-panel.tarjeta>
    <script type="text/javascript">
        $(document).ready(function()
        {
            $("#registro").click(function(event) {
                $("#registro").attr("disabled", true);
                $("#form_registrar").submit();
            });
        });
    </script>
@endsection
