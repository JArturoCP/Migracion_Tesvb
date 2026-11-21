@extends('layouts.panel')
@section('title', 'Evaluación al Tutor')
@include('tutorias.partials.recursos_panel')
@section('content')
    @include('tutorias.alumnos.partial.navegacion_panel', ['titulo' => 'Evaluación al Tutor', 'activa' => '/tutoras_evaluacion/evaluacion_al_tutor/'])

<main>
<!-- Modal de encuesta realizada -->
<x-panel.modal id="modal_mensaje" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel"><div id="modal_mensaje_contenido">
      <div class="tw:px-6 tw:pt-6 tw:pr-14">
        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Evaluación al Tutor</h4>
      </div>
      <div class="tw-modal-cuerpo">
        <x-panel.alerta tipo="exito">
            <h3 class="tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Encuesta realizada</h3>
        </x-panel.alerta>
      </div>
      <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
          <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Aceptar</button>
      </div>
</div></x-panel.modal>
</main>

<script>
  $(document).ready(function(){

    $("#modal_mensaje").modal("show");

  });

</script>
@endsection
