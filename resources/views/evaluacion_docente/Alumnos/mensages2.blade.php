@extends('layouts.panel')
@section('title', 'Inicio')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

<main>
<!-- Modal de mensaje de carga académica -->
<x-panel.modal id="modal_mensaje_carga" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
      <div class="tw:px-6 tw:pt-6 tw:pr-14">
        
        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Carga académica</h4>
      </div>
      <div class="tw-modal-cuerpo">
        @if($color==1)
          <x-panel.alerta tipo="error" class="tw:mb-4">{{$mensage_carga}}</x-panel.alerta>
        @else
          <x-panel.alerta tipo="exito" class="tw:mb-4">{{$mensage_carga}}</x-panel.alerta>
        @endif
      </div>
      <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Aceptar</button>
      </div>
    </x-panel.modal>
</main>
<?php
$direccion=Session::get('ip');
?>

<script>
  $(document).ready(function(){

    $("#modal_mensaje_carga").modal("show");

  });

  @if(isset($mensage_carga))
  var direccion="{{$direccion}}";
  setTimeout(myFunction, 1000);

  function myFunction(){
    window.location.href="/home/";
  }
  @endif

</script>

</div>
@endsection
