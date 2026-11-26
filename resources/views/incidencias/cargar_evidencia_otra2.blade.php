@extends('layouts.panel')
@section('title', 'Incidencias')
@include('partials.panel.recursos_app', ['datepicker' => true])
@section('content')
<div class="tw-pantalla">
    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <x-panel.encabezado :titulo="'Subir evidencia de conocimiento que no requiere autorización de jefe inmediato · Tipo de evidencia: '.$tipo_evidencia->nombre_evidencia" :migas="['Incidencias' => null]" />
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            
            <form class="tw:w-full" id="form_enviar_evidencia" action="{{url('/incidencias/guardar_evid_fecha_solicita2/'.$tipo_evidencia->id_tipo_evid.'/'.$tipo_fecha)}}" role="form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <label>Instrucciones: </label><br>
                        <label> Para poder subir la evidencia correspondiente es necesario que su archivo, que desea subir este en formato PDF y que este legible.</label>
                    </div>
                </div>

                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                        <label for="fecha_requerida">Fecha inicial:</label>
                        <div class="tw:mb-4">
                            <input class="datepicker fecha_requerida1 tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   type="text"  id="fecha_req1" name="fecha_req1" data-date-format="yyyy/mm/dd" placeholder="DD/MM/AAAA" >
                        </div>
                    </div>
                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                        <label for="fecha_requerida">Fecha final:</label>
                        <div class="tw:mb-4">
                            <input class="datepicker fecha_requerida2 tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   type="text"  id="fecha_req2" name="fecha_req2" data-date-format="yyyy/mm/dd" placeholder="DD/MM/AAAA" >
                        </div>
                    </div>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">
                        <span><label for="archivo_subir">Archivo a subir:</label></span>
                        <input  class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden" id="arch_evidencia" name="arch_evidencia" type="file" accept="application/pdf"    required />
                    </div>
                </div>
                @if($tipo_evidencia->id_tipo_evid == 1 || $tipo_evidencia->id_tipo_evid == 3 ||  $tipo_evidencia->id_tipo_evid == 5  ||  $tipo_evidencia->id_tipo_evid == 6)
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">
                            <label for="archivo_subir">Número de folio:</label>
                            <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" onkeyup="javascript:this.value=this.value.toUpperCase();"  id="no_folio" name="no_folio" type="text" placeholder="Ingresa numero de folio" required></input>
                        </div>
                    </div>
                @endif

            </form>
            <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" style="display: inline" id="subir">
                <div class="tw:w-full tw:px-2">
                    <button id="enviar_evidencia" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Guardar Evidencia</button>
                </div>
            </div>
        </div>
        <script>
            $(document).ready( function() {

                $( '.fecha_requerida1').datepicker({
                    pickTime: false,
                    autoclose: true,
                    language: 'es',
                    startDate: '-7d',
                });
                $( '.fecha_requerida2').datepicker({
                    pickTime: false,
                    autoclose: true,
                    language: 'es',
                    startDate: '-7d',
                });


                $("#enviar_evidencia").click(function(){

                    fecha_requerida = $('#fecha_req1').val();


                    if( fecha_requerida ==""){
                        swal({
                            position: "top",
                            type: "error",
                            title: "Selecciona fecha inicial",
                            showConfirmButton: false,
                            timer: 3500
                        });

                    }else{
                        fecha_requerida2 = $('#fecha_req2').val();
                        if(fecha_requerida2 == ""){
                            swal({
                                position: "top",
                                type: "error",
                                title: "Selecciona fecha final",
                                showConfirmButton: false,
                                timer: 3500
                            });
                        }else{
                            var arch_evidencia = $('#arch_evidencia').val();
                            if(arch_evidencia == ''){
                                swal({
                                    position: "top",
                                    type: "error",
                                    title: "Selecciona evidencia que desea subir",
                                    showConfirmButton: false,
                                    timer: 3500
                                });
                            }
                            else{
                                var tipo_evidencia="{{$tipo_evidencia->id_tipo_evid}}";

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
                                        $("#enviar_evidencia").attr("disableb", true);
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
                                    $("#enviar_evidencia").attr("disableb", true);
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


                    }
///////seecion de evidencia////
                });
            });
        </script>
    </main>
</div>
@endsection