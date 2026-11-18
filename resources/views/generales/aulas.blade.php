@extends('layouts.panel')
@section('title', 'Aulas')
@include('partials.panel.recursos_app', ['validacion' => true, 'datatables' => true, 'blockui' => true])
@section('content')


<main class="tw:w-full tw:lg:w-full tw:px-2">

 <?php $jefe_division=session()->has('jefe_division')?session()->has('jefe_division'):false;
 $directivo=session()->has('directivo')?session()->has('directivo'):false; 
 $consultas=session()->has('consultas')?session()->has('consultas'):false;?>


<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
	<div class="tw:w-full tw:px-2">
		<x-panel.encabezado titulo="AULAS" />
	</div>
  <div class="tw:w-full tw:lg:w-7/12 tw:lg:ml-[16.6667%] tw:px-2">
    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table id="paginar_table" class="tw-tabla tw-tabla-bordes">
                          <thead>
                            <tr>
                                <th>Aula</th>
                                <th>Edificio</th>
                                <th>Carrera</th>  
                                <th>Estado</th>
                                @if($directivo!=null || $consultas!=null)
                                <th>Editar</th>
                                <th>Eliminar</th>
                                @endif
                            </tr>
                          </thead>
                          <tbody>
                         @foreach($aulas as $aula)
                            <tr>
                              <td>{{$aula->aula}}</td>
                              <td>{{$aula->edificio}}</td>
                              <td>{{$aula->carrera}}</td>
                              @if($aula->estado==1)
  <td class="tw:text-center" data-toggle="tooltip" data-placement="left" title="Aula Compartida"><a href = '/aulas/estados/{{ $aula->id_aula }}'><span style="color:green;" class="fa fa-check-circle-o em2" aria-hidden="true"></span></a></td>
                              @else
  <td class="tw:text-center" data-toggle="tooltip" data-placement="left" title="Aula No Compartida"><a href = '/aulas/estados/{{ $aula->id_aula }}'><span style="color:red;" class="fa fa-ban em2" aria-hidden="true"></span></a></td>
                              @endif 
                              @if($directivo==1 || $consultas==1)                   
                              <td class="tw:text-center">
                                <a href="/generales/aulas/{{ $aula->id_aula }}/edit" class="tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:hover:bg-brand-50"><span class="fa fa-cog em2" aria-hidden="true"></span></a>
                              </td>
                              <td class="tw:text-center">
                                <a class="elimina tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-red-500 tw:hover:bg-red-50" id="{{ $aula->id_aula }}"><span class="fa fa-trash em2" aria-hidden="true"></span></a>
                              </td>
                              @endif
                            </tr>
                          @endforeach
                          </tbody>
                        </table>
</div> 
  </div>	
</div>
@if($directivo!=null || $consultas!=null)
                <div>
            <button data-toggle="modal"  data-tooltip="true" data-placement="left" title="AGREGA NUEVA AULA" data-target="#modal_crea" type="button" class="flotante tw:fixed tw:right-6 tw:bottom-6 tw:z-40 tw:inline-flex tw:size-14 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-xl tw:text-white tw:shadow-theme-lg tw:hover:bg-brand-600">
      <span class="fa fa-plus" aria-hidden="true"></span>
        </button>
      </div>
@endif
@if(isset($edit))
      @section('modifica_aula')
      @include('generales.partialsg.partial_mo_aula')
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
<form id="form_aula_crea" class="" role="form" method="POST" >
<x-panel.modal id="modal_crea" tamano="md" sin-relleno aria-labelledby="exampleModalLabel">
      <div class="tw:px-6 tw:pt-6 tw:pr-14">
        
        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="exampleModalLabel">Creación de Aulas</h4>
      </div>
      <div class="tw-modal-cuerpo">
          {{ csrf_field() }}
          @if (session()->has('flash_notification.message'))
          <x-panel.alerta class="tw:mb-4" :tipo="['success' => 'exito', 'danger' => 'error', 'warning' => 'advertencia'][session('flash_notification.level')] ?? 'info'">{!! session('flash_notification.message') !!}</x-panel.alerta>
          @endif
          <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-full tw:px-2">
              <div class="tw:w-full tw:lg:w-5/12 tw:lg:ml-[8.3333%] tw:px-2">
                <div class="tw:mb-4">
                    <label for="nombre_aula">Nombre del Aula</label>
                    <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="caja-error" name="nombre_aula" placeholder="Nombre..." style="text-transform:uppercase">
                    @if($errors -> has ('nombre_aula'))
                        <span style="color:red;">{{ $errors -> first('nombre_aula') }}</span>
                        <style>
                        #caja-error
                        {
                          border:solid 1px red;
                        }
                        </style>
                    @endif
                </div>
              </div>
                      <div class="tw:w-full tw:lg:w-5/12 tw:px-2" >
                        <div class="tw:inline-flex tw:gap-2">
                          <label for="selectEstado">Estado</label>
                                <select name="selectEstado" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                  <option disabled selected>Selecciona...........</option>
                                  <option value="1">Compartida</option>
                                  <option value="0">No Compartida</option>
                                </select>
                        </div>
                      </div>
            </div>
            <div class="tw:w-full tw:lg:w-full tw:px-2">
                <div class="tw:w-full tw:lg:w-5/12 tw:lg:ml-[8.3333%] tw:px-2" >
                        <div class="tw:inline-flex tw:gap-2">
                          <label for="selectEdificio">Edificio</label>
                                <select name="selectEdificio" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                  <option disabled selected>Selecciona...</option>
                                    @foreach($edificios as $edificio)
                                            <option value="{{$edificio->id_edificio}}" >{{$edificio->nombre}}</option>
                                    @endforeach
                                </select>
                        </div>
                      </div>
                      <div class="tw:w-full tw:lg:w-4/12 tw:px-2" >
                        <div class="tw:inline-flex tw:gap-2">
                          <label for="dropdown">Carrera</label>
                                <select name="selectCarrera" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                  <option disabled selected>Selecciona...</option>
                                    @foreach($carreras as $carrera)
                                            <option value="{{$carrera->id_carrera}}" >{{$carrera->nombre}}</option>
                                    @endforeach
                                </select>
                        </div>
                      </div> 
            </div>
          </div>
      </div>
      <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
        <button id="guarda_aula" type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Guardar</button>
      </div>
    
  
</x-panel.modal>
</form>

<script>
function bloqueo()
{
    $.blockUI({
    //message: '<img src="/img/cargando.gif" />',
  });
        //setTimeout($.unblockUI, 4000); 
}
$(document).ready(function() {
$('#paginar_table').DataTable();

       $("#paginar_table").on('click','.elimina',function(){
            var id=$(this).attr('id');
            $('#confirma_elimina').data('id',id);
            //TNotify.alert(id);
            $('#modal_elimina').modal('show');
        });

   $("#guarda_aula").click(function(event){
            $("#form_aula_crea").submit();
    });

          $("#form_aula_crea").validate({
            rules: {
           nombre_aula: {
            required: true,
          },
            selectCarrera : "required",
            selectEstado : "required",
            selectEdificio : "required",    
        },            
          });

        $("#confirma_elimina").click(function(event){
          var id_aula=($(this).data('id'));
          $("#form_delete").attr("action","/generales/aulas/"+id_aula);     
          $("#form_delete").submit();
        });
});
        </script>

@endsection
