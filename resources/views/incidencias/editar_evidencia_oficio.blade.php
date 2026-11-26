@extends('layouts.panel')
@include('partials.panel.recursos_app')
@section('title', 'Incidencias')
@section('content')
    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-5/12 tw:lg:ml-[33.3333%] tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                        <h1 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">EDITAR EVIDENCIA DE CONOCIMIENTO QUE NO REQUIERE AUTORIZACIÓN DE JEFE INMEDIATO</h1>
                    </div>
                </div>
            </div>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:lg:w-5/12 tw:lg:ml-[33.3333%] tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                                    <h4>{{ $evid->nombre_articulo }}</h4>
                                </div>
                            </div>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                                    <p><b>Fecha solicitada: </b>{{ $evid->fecha_req }}</p>
                                </div>
                            </div>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                                    <p><b>Motivo del oficio: </b>{{ $evid->motivo_oficio }}</p>
                                </div>
                            </div>

                            <br>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:lg:w-5/12 tw:lg:ml-[33.3333%] tw:px-2">
                                    <a  target="_blank" href="/incidencias/{{$evid->arch_evidencia}}" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm"> <i class="fa em128 fa-book" title="Ver PDF"> </i> Ver evidencia </a>
                                    <button id="{{$evid->id_evid}}" class="editar_evid tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm"> Editar </button>
                                    <a href="{{url('/incidencias/historial_docentesSo')}}" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Regresar </a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <form id="form_registrar" action="{{url("/incidencias/cargando_evidencia_oficio")}}" role="form" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal fade bs-example-modal-lg tw-modal-compat" id="modal_agregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-panel-modal hidden>
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header tw:bg-brand-500 tw:text-white">
                                        <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">EDITAR EVIDENCIA DE CONOCIMIENTO QUE NO REQUIERE AUTORIZACIÓN DE JEFE INMEDIATO</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div id="contenedor_agregar">

                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-sky-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-sky-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" >Aceptar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
@endsection