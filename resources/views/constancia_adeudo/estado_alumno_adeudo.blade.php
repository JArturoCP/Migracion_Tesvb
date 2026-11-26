@extends('layouts.panel')
@section('title', 'Constancias de no adeudo')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

<main>
<!-- Modal de verificación de adeudo -->
<x-panel.modal id="modal_estado_adeudo" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
      <div class="tw:px-6 tw:pt-6 tw:pr-14">
        
        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Consulta de adeudos</h4>
      </div>
      <div class="tw-modal-cuerpo">
        @if($adeudo == 0)
          <x-panel.alerta tipo="exito" class="tw:mb-4">
            <h4 class="tw:text-center tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">No tienes adeudos. Puedes solicitar tu constancia en las siguientes áreas: </h4>
            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Subdirección de Servicios Escolares:</h4>
            <p>-  Para tramite de Credencial</p>
            <p>-  Para tramite Certificado </p>
            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Departamento de Titulación:</h4>
            <p>-  Para el trámite de titulación</p>
          </x-panel.alerta>
        @elseif($adeudo == 1)
          <x-panel.alerta tipo="error" class="tw:mb-4">
            <h4 class="tw:text-center tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Para tramitar tu constancia de no adeudo, primero resuelve los adeudos con las siguientes áreas: </h4>
            @foreach($departamento_carrera as $departamento)
              <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $departamento['nombre'] }}</h4>
              <p>{{$departamento['comentario']}}</p>
            @endforeach
          </x-panel.alerta>
        @endif
      </div>
      <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Aceptar</button>
      </div>
    </x-panel.modal>
</main>

<script>
  $(document).ready(function(){

    $("#modal_estado_adeudo").modal("show");

  });

</script>

</div>
@endsection
