@extends('layouts.panel')
@section('title', 'Jefaturas')
@include('partials.panel.recursos_app', ['validacion' => true])
@section('content')

<main class="tw:w-full tw:lg:w-full tw:px-2">
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
	<div class="tw:w-full tw:px-2">
     @if (session()->has('flash_notification.message'))
                <x-panel.alerta class="tw:mb-4" :tipo="['success' => 'exito', 'danger' => 'error', 'warning' => 'advertencia'][session('flash_notification.level')] ?? 'info'">{!! session('flash_notification.message') !!}</x-panel.alerta>
              @endif
		<x-panel.encabezado titulo="JEFATURAS DE DIVSIÓN" />
	</div>
  <div class="tw:w-full tw:lg:w-7/12 tw:lg:ml-[16.6667%] tw:px-2">
    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white tw:dark:bg-white/3 tw:dark:border-gray-800">
<table class="tw-tabla tw-tabla-bordes">
                          <thead>
                            <tr>
                                <th>Carrera</th>
                                <th>Jefe</th>
                                <th>Periodo</th>
                                <th>Cargo</th>  
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                          </thead>
                          <tbody>
                         @foreach($jefaturas as $jefatura)
                            <tr>
                              <td>{{$jefatura->carrera}}</td>
                              <td>{{$jefatura->nombre}}</td>
                              <td>{{$jefatura->periodo}}</td>
                              <td>@if($jefatura->tipo_cargo==1)
                                {{ "JEFE" }}
                                @else
                                {{ "ENCARGADO" }}
                                @endif</td>                   
                              <td class="tw:text-center">
                                <a href="/generales/jefaturas/{{ $jefatura->id_jefe_periodo }}/edit" class="tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:hover:bg-brand-50"><span class="fa fa-cog em2" aria-hidden="true"></span></a>
                              </td>
                              <td class="tw:text-center">
                                <a class="elimina tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-red-500 tw:hover:bg-red-50" id="{{ $jefatura->id_jefe_periodo }}"><span class="fa fa-trash em2" aria-hidden="true"></span></a>
                              </td>
                            </tr>
                          @endforeach
                          </tbody>
                        </table>
</div> 
  </div>	
</div>
            

                <div>
            <button data-toggle="modal"  data-tooltip="true" data-placement="left" title="AGREGA NUEVA JEFATURA" data-target="#modal_crea" type="button" class="flotante tw:fixed tw:right-6 tw:bottom-6 tw:z-40 tw:inline-flex tw:size-14 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-xl tw:text-white tw:shadow-theme-lg tw:hover:bg-brand-600">
      <span class="fa fa-plus" aria-hidden="true"></span>
        </button>
      </div>

@if(isset($edit))
      @section('modifica_jefatura')
      @include('generales.partialsg.partial_mo_jefe')
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
        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:dark:bg-white/3 tw:dark:text-gray-300" data-dismiss="modal">Cancelar</button>
        <input id="confirma_elimina" type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Aceptar"></input>
      </div>
</form>
      
    
  </x-panel.modal>
{{-- (se quitó un </div> sobrante del original que cerraba el área de contenido) --}}

<!-- Modal para crear-->
<form id="form_jefe_crea" class="" role="form" method="POST" >
<x-panel.modal id="modal_crea" tamano="md" sin-relleno aria-labelledby="exampleModalLabel">
      <div class="tw:px-6 tw:pt-6 tw:pr-14">
        
        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Creación de jefaturas</h4>
      </div>
      <div class="tw-modal-cuerpo">
        {{ csrf_field() }}
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
              <div class="tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:w-full tw:lg:w-8/12 tw:lg:ml-[16.6667%] tw:px-2">
            <div class="tw:mb-4"> 
                <label for="selectCarrera">Carrera</label> 
                <select name="selectCarrera" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700">
                <option disabled selected>Elige...</option>
                  @foreach($carreras as $carrera)
                  <option value="{{ $carrera->id_carrera }}">{{ $carrera->nombre }}</option>
                  @endforeach
                </select> 
            </div>
        </div>
            </div>
            <div class="tw:w-full tw:lg:w-full tw:px-2">
                      <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
            <div class="tw:mb-4"> 
                <label for="selectPersonal">Personal</label> 
                <select name="selectPersonal" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700">
                <option disabled selected>Elige...</option>
                  @foreach($docentes as $docente)
                  <option value="{{ $docente->id_personal }}">{{ $docente->nombre }}</option>
                  @endforeach
                </select> 
            </div>
        </div>
                              <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
            <div class="tw:mb-4"> 
                <label for="selectCargo">Cargo</label> 
                <select name="selectCargo" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700">
                <option disabled selected>Elige...</option>
                  <option value="1">JEFE</option>
                  <option value="2">ENCARGADO</option>
                </select> 
            </div>
        </div>
                  <div class="tw:w-full tw:lg:w-8/12 tw:lg:ml-[16.6667%] tw:px-2">
              <div class="tw:mb-4">
                  <label for="nombre_periodo">Periodo</label>
                  <input disabled type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700" name="nombre_periodo" value="{{ $periodo }}">
              </div>
          </div>
            </div>
</div>
      </div> 
      <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:dark:bg-white/3 tw:dark:text-gray-300" data-dismiss="modal">Cancelar</button>
        <button id="guarda_jefe" type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Guardar</button>
      </div>
    
  
</x-panel.modal>
</form>


<!-- Modal para periodo_igual-->

<form id="periodo_igual" class=""  role="form" method="POST" >
 {{ csrf_field() }}

</form>

<script>
$(document).ready(function() {

       $(".elimina").click(function(){
            var id=$(this).attr('id');
            $('#confirma_elimina').data('id',id);
            //TNotify.alert(id);
            $('#modal_elimina').modal('show');
        });

   $("#guarda_jefe").click(function(event){
            $("#form_jefe_crea").submit();
    });

          $("#form_jefe_crea").validate({
            rules: {
            nombre_jefe : "required",
            selectPersonal : "required",
            selectCarrera : "required", 
        },            
          });

        $("#confirma_elimina").click(function(event){
          var id_jefe=($(this).data('id'));
          $("#form_delete").attr("action","/generales/jefaturas/"+id_jefe)      
          $("#form_delete").submit();
        });

       

});
        </script>

@endsection
