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
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:px-2">
                                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $evid->nombre_articulo }}</h4>
                                </div>
                            </div>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:px-2">
                                    <p><b>Fecha solicitada: </b>{{ $evid->fecha_req }}</p>
                                </div>
                            </div>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:px-2">
                                    <p><b>Motivo del oficio: </b>{{ $evid->motivo_oficio }}</p>
                                </div>
                            </div>

                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:px-2">
                                    <a  target="_blank" href="/incidencias/{{$evid->arch_evidencia}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"> <i class="fa fa-book em128" title="Ver PDF"> </i> Ver evidencia </a>
                                    <button id="{{$evid->id_evid}}" class="editar_evid tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"> Editar </button>
                                    <a href="{{url('/incidencias/historial_docentesSo')}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Regresar </a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <form id="form_registrar" action="{{url("/incidencias/cargando_evidencia_oficio")}}" role="form" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <x-panel.modal id="modal_agregar" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                        
                                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">EDITAR EVIDENCIA DE CONOCIMIENTO QUE NO REQUIERE AUTORIZACIÓN DE JEFE INMEDIATO</h4>
                                    </div>
                                    <div class="tw-modal-cuerpo">
                                        <div id="contenedor_agregar">

                                        </div>

                                    </div>
                                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                        <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                                    </div>
                                </x-panel.modal>
                    </form>

                    <script>
                        $(document).ready(function(){
                            $(".editar_evid").click(function(){
                                //TNotify.alert("HOLA");
                                var id_evid=$(this).attr('id');

                                $.get("/incidencias/ver_datos_oficio_evidencia/"+id_evid,function (request) {
                                    $("#contenedor_agregar").html(request);
                                    $("#modal_agregar").modal('show');
                                });
                            });
                            $("#guardar_mod").click(function(){

                                var id_tipo_evid= $('#id_tipo_evid').val();
//TNotify.alert(id_tipo_evid);
                                if(id_tipo_evid == null)
                                {
                                    swal({
                                        position: "top",
                                        type: "error",
                                        title: "Selecciona tipo de evidencia",
                                        showConfirmButton: false,
                                        timer: 3500
                                    });
                                }else{
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