@extends('layouts.panel')
@section('title', 'Centro de Computo')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

<main>
<!-- Modal de notificación -->
<x-panel.modal id="modal_notificacion" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
      <div class="tw:px-6 tw:pt-6 tw:pr-14">
        
        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Contraseña incorrecta</h4>
      </div>
      <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Aceptar</button>
      </div>
    </x-panel.modal>
</main>

<script>
  $(document).ready(function(){

    $("#modal_notificacion").modal("show");

  });

</script>

</div>
@endsection
