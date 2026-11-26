@extends('layouts.panel')
@section('title', 'Incidencias')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
<main class="tw:w-full tw:lg:w-full tw:px-2">
<x-panel.encabezado titulo="Editar evidencia de conocimiento que no requiere autorización de jefe inmediato" :migas="['Incidencias' => null]" />
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    
    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
     <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
          <h3  class="tw:text-center tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"> Tipo de evidencia enviada: {{ $evidencia->nombre_evidencia }}</h3>
            <?php
            $fecha= date('d-m-Y', strtotime($evidencia->fecha_solicita));
            ?>
            <h2 class="tw:mb-4 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center" >Fecha: {{ $fecha }}</h2>
             @if($evidencia->id_tipo_evid == 1 || $evidencia->id_tipo_evid == 3 || $evidencia->id_tipo_evid == 5 || $evidencia->id_tipo_evid == 6)
            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center" >No. folio: {{ $evidencia->no_folio }}</h4>
            @endif
          <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:text-center tw:px-2">

          <a  target="_blank" href="/incidencias/{{$evidencia->arch_evidencia}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"> <i class="fa fa-book em128" title="Ver PDF"> </i> Ver evidencia </a>
          <button id="{{$evidencia->id_evid}}" class="editar_evid tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"> Editar </button>
        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-toggle="modal" data-target="#enviar">Enviar</button>
        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-toggle="modal" data-target="#cancelar">Cancelar</button>
       {{--  <a href="{{url('/incidencias/historial_docentesEv')}}" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Enviar</a> --}}
        </div>  
    </div>  
    </div>  
    </div>
  <x-panel.modal id="modal_editar" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
        <div class="tw:px-6 tw:pt-6 tw:pr-14">
          
            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">EDITAR EVIDENCIA DE CONOCIMIENTO QUE NO REQUIERE AUTORIZACIÓN DE JEFE INMEDIATO</h4>
        </div>
      <div class="tw-modal-cuerpo">
    <div id="contenedor_editar">
  </div>
</div> <!-- modal body  -->
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                       
                        <button type="button" id="guardar_mod"class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" >Guardar</button>
                   </div>
 
                </x-panel.modal>

        <x-panel.modal id="enviar" tamano="sm" sin-relleno clase-cerrar="close">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Enviar evidencia</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        <p>Seguro(a) que quiere enviar la evidencia.</p>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>

                        <button type="button" id="enviar_evid"class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" >Enviar</button>
                    </div>
                </x-panel.modal>

        <x-panel.modal id="cancelar" tamano="sm" sin-relleno clase-cerrar="close">
                <form  action="{{url("/incidencias/eliminar_evidencia/".$evidencia->id_evid)}}" role="form" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div class="modal-content">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Cancelar evidencia</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        <p>Seguro(a) que quiere cancelar la evidencia.</p>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>

                        <button type="submit"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>

                    </div>
                </div>
                </form>
            </x-panel.modal>

     <script>
$(document).ready(function(){

    $("#enviar_evid").click(function (){
        window.location.href='/incidencias/enviar_evidencia_fecha/{{$evidencia->id_evid}}';
    });
  $(".editar_evid").click(function(){
        //TNotify.alert("HOLA");
    var id_evid = $(this).attr('id');
    $.get("/incidencias/modificar_evidencia/"+id_evid,function(request){
    $("#contenedor_editar").html(request);
    $("#modal_editar").modal('show');
    });
  }); 
  $("#guardar_mod").click(function(){


//TNotify.alert(id_tipo_evid);

    var fecha_mod_requerida = $('#fecha_mod_requerida').val();
    if(fecha_mod_requerida == ""){
        swal({
            position: "top",
            type: "error",
            title: "Selecciona una fecha",
            showConfirmButton: false,
            timer: 3500
        });
    }else {
        var arch_evidencia = $('#arch_evidencia').val();

        if (arch_evidencia == '') {
            swal({
                position: "top",
                type: "error",
                title: "Selecciona evidencia que desea subir",
                showConfirmButton: false,
                timer: 3500
            });
        } else {
            var tipo_evidencia="{{$evidencia->id_tipo_evid}}";

            if(tipo_evidencia == 1 ||  tipo_evidencia== 3 || tipo_evidencia== 5 || tipo_evidencia==6)
            {
                var no_folio = $('#no_folio').val();
                if(no_folio == ""){
                    swal({
                        position: "top",
                        type: "error",
                        title: "Ingresa el número de folio",
                        showConfirmButton: false,
                        timer: 3500
                    });

                }else{
                    $("#form_enviar_evidencia").submit();
                    $("#guardar_mod").attr("disableb", true);
                    swal({
                        position: "top",
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }


            }else {

                $("#form_enviar_evidencia").submit();
                $("#guardar_mod").attr("disableb", true);
                swal({
                    position: "top",
                    type: "success",
                    title: "Registro exitoso",
                    showConfirmButton: false,
                    timer: 3500
                });
            }
        }
    }

///////seecion de evidencia////
    });

/////////Sigue script//////
});   
</script>


</main>
</div>
@endsection