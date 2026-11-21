{{--
    Mensaje de Complementarias ($mensaje_evidencias). Diseño del panel; mismo texto, misma lógica y mismo script.
    Vista COMPARTIDA (solo cambia el diseño para todos):
      - EvidenciasAlumnosController@index (alumno, /evidencias_alumnos): "AÚN NO HA SIDO ACEPTADA TU ACTIVIDAD";
      - DocenteActividadJefeController (jefe de división, /docente_actividad): "NO EXISTE ACTIVIDAD", "NO EXISTEN DOCENTES";
      - PlaneaActividadProfController@index (docente con actividad, /planeacion_actividad): "NO EXISTE ASIGNACIÓN DE ACTIVIDAD";
      - HomeController@index (/home, personal sin ninguna acción asignada): "NO TIENES NINGUNA ACCION".
    Tono de la alerta (solo diseño): aviso cuando la actividad del alumno aún no se acepta; error en los demás casos
    (el original los mostraba todos en rojo). Versión anterior: tests/Fixtures/vistas_antes.
    El mensaje se muestra en un modal que se abre al cargar la página (formato de modal_horas).
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

<!-- Modal de mensaje -->
<x-panel.modal id="modal_mensaje" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel"><div id="modal_mensaje_contenido">
      <div class="tw:px-6 tw:pt-6 tw:pr-14">
        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Actividades Complementarias</h4>
      </div>
      <div class="tw-modal-cuerpo">
        <x-panel.alerta :tipo="$tonoMensaje" data-panel-mensaje>
          <span class="tw:font-semibold">{{$mensaje_evidencias}}</span>
        </x-panel.alerta>
      </div>
      <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
          <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Aceptar</button>
      </div>
</div></x-panel.modal>
</main>
<?php
	$direccion=Session::get('ip');
?>
<script>
	$(document).ready(function(){

		$("#modal_mensaje").modal("show");

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
