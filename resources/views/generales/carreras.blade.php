@extends('layouts.panel')
@section('title', 'Carreras')
@include('partials.panel.recursos_app', ['colorpicker' => true, 'validacion' => true])
@section('content')

<main class="tw:w-full tw:lg:w-full tw:px-2">
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
	<div class="tw:w-full tw:px-2">
    @if (session()->has('flash_notification.message'))
            <x-panel.alerta class="tw:mb-4" :tipo="['success' => 'exito', 'danger' => 'error', 'warning' => 'advertencia'][session('flash_notification.level')] ?? 'info'">{!! session('flash_notification.message') !!}</x-panel.alerta>
          @endif
		<x-panel.encabezado titulo="CARRERAS" />	
	</div>
  <div class="tw:w-full tw:lg:w-5/12 tw:lg:ml-[25%] tw:px-2">
    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="table-resposive tw-tabla tw-tabla-bordes">
                          <thead>
                            <tr>
                                <th>Descripcion</th>
                                <th>Color</th>
                                <th>Editar</th>  
                                <th>Eliminar</th> 
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($carreras as $carrera)
                            <tr>
                              <td>{{$carrera->nombre}}</td>
                              <td>
                                  <div class="colorpicker-component tw:flex tw:w-full tw:items-stretch">
                                    <input disabled value="{{ $carrera->COLOR }}" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" />
                                    <span disabled class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:bg-gray-50 tw:px-3 tw:text-sm tw:text-gray-600"><i></i></span>
                                  </div>
                              </td>
                              <td>
                                <a href="/generales/carreras/{{ $carrera->id_carrera }}/edit" class="tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:hover:bg-brand-50"><span class="fa fa-cog em2" aria-hidden="true"></span></a>
                              </td>
                              <td>
                                <a class="elimina tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-red-500 tw:hover:bg-red-50" id="{{ $carrera->id_carrera }}"><span class="fa fa-trash em2" aria-hidden="true"></span></a>
                              </td>
                            </tr>
                            @endforeach
                            
                          </tbody>
                        </table>
</div>  
  </div>
</div>	
      <div>
        <button data-toggle="modal"  data-tooltip="true" data-placement="left" title="AGREGA NUEVA CARRERA" data-target="#modal_crea" type="button" class="flotante tw:fixed tw:right-6 tw:bottom-6 tw:z-40 tw:inline-flex tw:size-14 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-xl tw:text-white tw:shadow-theme-lg tw:hover:bg-brand-600">
          <span class="fa fa-plus" aria-hidden="true"></span>
        </button>
      </div>

      @if(isset($edit))
      @section('modifica_carrera')
      @include('generales.partialsg.partial_mo_carrera')
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

<!-- Modal para crear-->
<form id="form_carrera_crea" class="" role="form" method="POST" >
<x-panel.modal id="modal_crea" tamano="md" sin-relleno aria-labelledby="exampleModalLabel">
      <div class="tw:px-6 tw:pt-6 tw:pr-14">
        
        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="exampleModalLabel">Agregar Carrera</h4>
      </div>
      <div class="tw-modal-cuerpo">
        {{-- (se quitó un <form> anidado sin atributos que el navegador ignoraba; el formulario real lo envuelve) --}}
          {{ csrf_field() }}
          <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-full tw:px-2">
                <div class="tw:w-full tw:lg:w-6/12 tw:lg:ml-[8.3333%] tw:px-2">
                     <div class="tw:mb-4">
                      <label for="nombre_carrera">Descripción</label>
                      <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="caja-error1" name="nombre_carrera" placeholder="Nombre..." style="text-transform:uppercase">
                      @if($errors -> has ('nombre_carrera'))
                          <span style="color:red;">{{ $errors -> first('nombre_carrera') }}</span>
                         <style>
                          #caja-error1
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
                    </div>
                </div>          
              <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                    <div class="tw:mb-4">
                      <label for="color">Color</label>
                      <div class="colorpicker-component tw:flex tw:w-full tw:items-stretch">
                        <input name="color" type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" style="text-transform:uppercase" />
                        <span class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:bg-gray-50 tw:px-3 tw:text-sm tw:text-gray-600"><i></i></span>
                      </div>
                     @if($errors -> has ('color'))
                          <span style="color:red;">{{ $errors -> first('color') }}</span>
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
        
      </div>
      <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
        <input id="save_carrera" type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Guardar"/>
      </div>
</x-panel.modal>
</form>

<script>

$('.colorpicker-component').colorpicker();

$(document).ready(function() {

  $(".elimina").click(function(){
            var id=$(this).attr('id');
            $('#confirma_elimina').data('id',id);
            //TNotify.alert(id);
            $('#modal_elimina').modal('show');
        });

   $("#save_carrera").click(function(event){
            $("#form_carrera_crea").submit();
    });

          $("#form_carrera_crea").validate({
            rules: {
           nombre_carrera: {
            required: true,
          }, 
         color: {
            required: true,
          },     
        },            
          });

                $("#confirma_elimina").click(function(event){
          var id_car=($(this).data('id'));
          $("#form_delete").attr("action","/generales/carreras/"+id_car)      
          $("#form_delete").submit();
          });

});
        </script>
@endsection


