{{--
    Mensaje de Complementarias ($mensaje_evidencias). Diseño del panel; mismo texto, misma lógica y mismo script.
    Vista COMPARTIDA (solo cambia el diseño para todos):
      - EvidenciasAlumnosController@index (alumno, /evidencias_alumnos): "AÚN NO HA SIDO ACEPTADA TU ACTIVIDAD";
      - DocenteActividadJefeController (jefe de división, /docente_actividad): "NO EXISTE ACTIVIDAD", "NO EXISTEN DOCENTES";
      - PlaneaActividadProfController@index (docente con actividad, /planeacion_actividad): "NO EXISTE ASIGNACIÓN DE ACTIVIDAD";
      - HomeController@index (/home, personal sin ninguna acción asignada): "NO TIENES NINGUNA ACCION".
    Tono de la alerta (solo diseño): aviso cuando la actividad del alumno aún no se acepta; error en los demás casos
    (el original los mostraba todos en rojo). Versión anterior: tests/Fixtures/vistas_antes.
--}}
@extends('layouts.panel')
@section('title', 'Inicio')
@include('partials.panel.recursos_app')
@section('content')

<main>
  <?php
    $tonoMensaje = (isset($mensaje_evidencias) && $mensaje_evidencias === 'AÚN NO HA SIDO ACEPTADA TU ACTIVIDAD') ? 'advertencia' : 'error';
  ?>
  <x-panel.encabezado titulo="Actividades Complementarias" />
  <div class="tw:mx-auto tw:max-w-2xl">
    <x-panel.tarjeta>
      <x-panel.alerta :tipo="$tonoMensaje" data-panel-mensaje>
        <span class="tw:font-semibold">{{$mensaje_evidencias}}</span>
      </x-panel.alerta>
    </x-panel.tarjeta>
  </div>
</main>
<?php
	$direccion=Session::get('ip');
?>
<script>
	$(document).ready(function(){
		@if(isset($mensaje_evidencias))
		var direccion="{{$direccion}}";
		//setTimeout(myFunction, 2000);

		function myFunction(){
		window.location.href=direccion+"/evidencias_alumnos/";
		}

	@endif
});
</script>
@endsection
