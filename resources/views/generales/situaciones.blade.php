@extends('layouts.panel')
@section('title', 'Situación Profesional')
@include('partials.panel.recursos_app', ['validacion' => true])
@section('content')

<main class="tw:w-full tw:lg:w-full tw:px-2">
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
	<div class="tw:w-full tw:px-2">
     @if (session()->has('flash_notification.message'))
            <x-panel.alerta class="tw:mb-4" :tipo="['success' => 'exito', 'danger' => 'error', 'warning' => 'advertencia'][session('flash_notification.level')] ?? 'info'">{!! session('flash_notification.message') !!}</x-panel.alerta>
          @endif
		<x-panel.encabezado titulo="SITUACIÓN PROFESIONAL" />	
	</div>
  <div class="tw:w-full tw:lg:w-5/12 tw:lg:ml-[25%] tw:px-2">
                  <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="table-resposive tw-tabla tw-tabla-bordes">
                          <thead>
                            <tr>
                                <th>Descripcion</th>
                                <th>Abreviacion</th>
                                <th>Editar</th>  
                                <th>Eliminar</th> 
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($situaciones as $situacion)
                            <tr>
                              <td>{{$situacion->situacion}}</td>
                              <td>{{$situacion->abrevia}}</td>
                              <td class="tw:text-center">
                                <a href="/generales/situaciones/{{ $situacion->id_situacion }}/edit" class="tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:hover:bg-brand-50"><span class="fa fa-cog em2" aria-hidden="true"></span></a>
                              </td>
                              <td class="tw:text-center">
                                <a class="elimina tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-red-500 tw:hover:bg-red-50" id="{{ $situacion->id_situacion }}"><span class="fa fa-trash em2" aria-hidden="true"></span></a>
                              </td>
                            </tr>
                            @endforeach
                            
                          </tbody>
                        </table>
</div>  
  </div>
</div>	
      <div>
        <button data-toggle="modal"  data-tooltip="true" data-placement="left" title="AGREGA NUEVA SITUACION" data-target="#modal_crea" type="button" class="flotante tw:fixed tw:right-6 tw:bottom-6 tw:z-40 tw:inline-flex tw:size-14 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-xl tw:text-white tw:shadow-theme-lg tw:hover:bg-brand-600">
          <span class="fa fa-plus" aria-hidden="true"></span>
        </button>
      </div>

@if(isset($edit))
      @section('modifica_situacion')
      @include('generales.partialsg.partial_mo_situacion')
      @show
@endif

</main>
<!-- MODAL PARA ELIMINAR -->
<x-panel.modal id="modal_elimina" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">
      <form action="" method="POST" role="form" id="form_delete">
<div class="tw-modal-cuerpo tw:pt-12">

 {{method_field('DELETE') }}
  {{ csrf_field() }}
        ¿Realmente deseas eliminar éste elemento?
      </div>
            <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
        <input id="confirma_elimina" type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Aceptar"></input>
      </div>
</form>
      
    
  </x-panel.modal>
{{-- (se quitó un </div> sobrante del original que cerraba el área de contenido) --}}

<!-- *************Modal para crear*************-->
<form id="form_situacion_crea" class="" role="form" method="POST" >
<x-panel.modal id="modal_crea" tamano="md" sin-relleno aria-labelledby="exampleModalLabel">
      <div class="tw:px-6 tw:pt-6 tw:pr-14">
        
        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="exampleModalLabel">Agregar Situación Profesional</h4>
      </div>
      <div class="tw-modal-cuerpo">
        {{-- (se quitó un <form> anidado sin atributos que el navegador ignoraba; el formulario real lo envuelve) --}}
          {{ csrf_field() }}
          <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-6/12 tw:lg:ml-[8.3333%] tw:px-2">
                     <div class="tw:mb-4">
                      <label for="nombre_situacion">Descripción</label>
                      <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="caja-error1" name="nombre_situacion" placeholder="Nombre..." style="text-transform:uppercase">
                      @if($errors -> has ('nombre_situacion'))
                        <span style="color:red;">{{ $errors -> first('nombre_situacion') }}</span>
                         <style>
                          #caja-error1
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
                    </div>
                  </div>          
                  <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                    <div class="tw:mb-4">
                      <label for="abre_situacion">Abreviatura</label>
                      <input type="text" maxlength="5" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="caja-error" name="abre_situacion" placeholder="Abreviacion..." style="text-transform:uppercase">
                     @if($errors -> has ('abre_situacion'))
                          <span style="color:red;">{{ $errors -> first('abre_situacion') }}</span>
                         <style>
                          #caja-error
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
                    </div>
                  </div>
          </div>
      </div>
      <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
        <input id="save_situacion" type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Guardar"/>
      </div>
</x-panel.modal>
</form>

<!-- **************SCRIPTS************** -->
<script>
$(document).ready(function() {

     $(".elimina").click(function(){
            var id=$(this).attr('id');
            $('#confirma_elimina').data('id',id);
            //TNotify.alert(id);
            $('#modal_elimina').modal('show');
        });

   $("#save_situacion").click(function(event){
            $("#form_situacion_crea").submit();
    });

          $("#form_situacion_crea").validate({
            rules: {
           nombre_situacion: {
            required: true,
          }, 
         abre_situacion: {
            required: true,
          },     
        },            
          });

      $("#confirma_elimina").click(function(event){
          var id_sit=($(this).data('id'));
          $("#form_delete").attr("action","/generales/situaciones/"+id_sit)      
          $("#form_delete").submit();
          });

});
        </script>
@endsection


