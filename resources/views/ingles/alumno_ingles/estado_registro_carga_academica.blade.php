@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Revisión de Carga academica ingles')
@section('content')
    @include('ingles.alumno_ingles.estilos')
    <main class="ingles-estudiante ingles-inicio">
        <h1 class="ingles-titulo">Carga académica de inglés</h1>

        <div class="ingles-tarjeta">
            <form id="form_carga" class="form" action="{{url("/ingles_horarios/guardar_iniciar_carga_academica/")}}" role="form" method="POST" >

                {{ csrf_field() }}
                <input type="hidden" id="id_periodo" name="id_periodo" value="{{ $periodo_ingles }}">
                <input type="hidden" id="id_alumno" name="id_alumno" value="{{ $alumno }}">
                </form>
            <p>Da clic para iniciar con el registro de carga académica.</p>
            <div class="ingles-acciones">
                <button class="btn btn-primary iniciar_registro ingles-boton">Iniciar registro de carga académica</button>
            </div>
        </div>
    </main>
    <script type="text/javascript">
        $(document).ready( function() {
            $(".iniciar_registro").click(function (){
               // TNotify.alert('hola');
                $("#iniciar_registro").attr("disabled", true);
                $("#form_carga").submit();

            });
        });
    </script>
@endsection
