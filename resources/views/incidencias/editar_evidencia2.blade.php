@extends('layouts.panel')
@include('partials.panel.recursos_app')
@section('title', 'Incidencias')
@section('content')
    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-5/12 tw:lg:ml-[33.3333%] tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                        <h1 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">EDITAR EVIDENCIA DE CONOCIMIENTO QUE NO REQUIERE AUTORIZACIÓN DE JEFE INMEDIATO </h1>
                    </div>
                </div>
            </div>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:lg:w-5/12 tw:lg:ml-[33.3333%] tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                            <h3  class="tw:text-center"> Tipo de evidencia enviada: {{ $evidencia->nombre_evidencia }}</h3>
                            <?php
                            $fecha= date('d-m-Y', strtotime($evidencia->fecha_solicita));
                            $fecha2= date('d-m-Y', strtotime($evidencia->fecha_solicita_2));
                            ?>
                            <h2 style="text-align: center">Periodo: <br>{{ $fecha }} al {{ $fecha2 }}</h2>
                            @if($evidencia->id_tipo_evid == 1 || $evidencia->id_tipo_evid == 3 || $evidencia->id_tipo_evid == 5 || $evidencia->id_tipo_evid == 6)
                                <h4 style="text-align: center">No. folio: {{ $evidencia->no_folio }}</h4>
                            @endif
                            <br>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:text-center tw:px-2">

                                    <a  target="_blank" href="/incidencias/{{$evidencia->arch_evidencia}}" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm"> <i class="fa em128 fa-book" title="Ver PDF"> </i> Ver evidencia </a>
                                    <button id="{{$evidencia->id_evid}}" class="editar_evid tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm"> Editar </button>
                                    <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-toggle="modal" data-target="#enviar">Enviar</button>
                                    <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-toggle="modal" data-target="#cancelar">Cancelar</button>
                                    {{--  <a href="{{url('/incidencias/historial_docentesEv')}}" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Enviar</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade tw-modal-compat" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-panel-modal hidden>
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header tw:bg-sky-100">
                                    <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title tw:text-center" id="myModalLabel">EDITAR EVIDENCIA DE CONOCIMIENTO QUE NO REQUIERE AUTORIZACIÓN DE JEFE INMEDIATO</h4>
                                </div>
                                <div class="modal-body">
                                    <div id="contenedor_editar">
                                    </div>
                                </div> <!-- modal body  -->
                                <div class="modal-footer">

                                    <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cerrar</button>

                                    <button type="button" id="guardar_mod"class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" >Guardar</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal fade tw-modal-compat" id="enviar" role="dialog" tabindex="-1" data-panel-modal hidden>
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Enviar evidencia</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Seguro(a) que quiere enviar la evidencia.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cerrar</button>

                                    <button type="button" id="enviar_evid"class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" >Enviar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade tw-modal-compat" id="cancelar" role="dialog" tabindex="-1" data-panel-modal hidden>
                        <div class="modal-dialog modal-sm">
                            <form  action="{{url("/incidencias/eliminar_evidencia/".$evidencia->id_evid)}}" role="form" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Cancelar evidencia</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Seguro(a) que quiere cancelar la evidencia.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cerrar</button>

                                        <button type="submit"  class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" >Aceptar</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <script>
                        $(document).ready(function(){

                            $("#enviar_evid").click(function (){
                                window.location.href='/incidencias/enviar_evidencia_fecha/{{$evidencia->id_evid}}';
                            });
                            $(".editar_evid").click(function(){
                                //TNotify.alert("HOLA");
                                var id_evid = $(this).attr('id');
                                $.get("/incidencias/modificar_evidencia2/"+id_evid,function(request){
                                    $("#contenedor_editar").html(request);
                                    $("#modal_editar").modal('show');
                                });
                            });
                            $("#guardar_mod").click(function(){

                                var mod_fecha_req1 = $('#mod_fecha_req1').val();

                                if(mod_fecha_req1 == ""){
                                    swal({
                                        position: "top",
                                        type: "error",
                                        title: "Selecciona fecha inicial",
                                        showConfirmButton: false,
                                        timer: 3500
                                    });
                                }else {
                                    var mod_fecha_req2 = $('#mod_fecha_req2').val();
                                    if(mod_fecha_req2 == ""){
                                        swal({
                                            position: "top",
                                            type: "error",
                                            title: "Selecciona fecha final",
                                            showConfirmButton: false,
                                            timer: 3500
                                        });
                                    }else{

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
                                        var tipo_evidencia="<?php echo $evidencia->id_tipo_evid;?>";

                                        if(tipo_evidencia == 1 ||  tipo_evidencia== 3 || tipo_evidencia== 5 || tipo_evidencia==6)
                                        {
                                            var no_folio = $('#no_folio').val();
                                            if(no_folio == ""){
                                                swal({
                                                    position: "top",
                                                    type: "error",
                                                    title: "Ingresa el número de oficio",
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
                                }

///////seecion de evidencia////
                            });

/////////Sigue script//////
                        });
                    </script>


    </main>
@endsection