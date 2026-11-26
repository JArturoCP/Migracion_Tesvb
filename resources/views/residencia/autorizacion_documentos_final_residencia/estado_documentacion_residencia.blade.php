@extends('layouts.panel')
@section('title', 'Documentación final de residenciaa')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

<main>
<!-- Modal de estado de documentación -->
<x-panel.modal id="modal_estado_documentacion" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
      <div class="tw:px-6 tw:pt-6 tw:pr-14">
        
        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Enviar Documentación de Liberación de Residencia</h4>
      </div>
      <div class="tw-modal-cuerpo">
        @if( $estado_calificado == 0)
          <x-panel.alerta tipo="error" class="tw:mb-4">No se ha terminado de calificar tu Seguimiento de Residencia</x-panel.alerta>
        @elseif( $estado_calificado == 1)
          @if($estado_enviado == 1 || $estado_enviado == 3)
            <x-panel.alerta tipo="exito" class="tw:mb-4">Se envió correctamente tu documentación al Departamento de Servicio Social y Residencia Profesional para su revisión</x-panel.alerta>
          @elseif($estado_enviado == 4)
            <x-panel.alerta tipo="exito" class="tw:mb-4">Tu documentación de Liberación de Residencia fue autorizada por el Departamento de Servicio Social y Residencia Profesional.</x-panel.alerta>
          @endif
        @endif
      </div>
      <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Aceptar</button>
      </div>
    </x-panel.modal>
</main>

<script>
  $(document).ready(function(){

    $("#modal_estado_documentacion").modal("show");

  });

</script>

</div>
@endsection
