@extends('layouts.panel')
@include('partials.panel.recursos_app')
@section('title', 'Incidencias')
@section('content')
    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-4/12 tw:lg:ml-[33.3333%] tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                        <h1 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">EDITAR OFICIO FIRMADO</h1>
                    </div>
                </div>
            </div>
        </div>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:lg:w-4/12 tw:lg:ml-[33.3333%] tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                        <div class="tw:p-5 tw:sm:p-6 tw:text-center">
                    <b>Articulo: </b><p>{{$solicitud->nombre_articulo}}</p>
                    <b>Motivo de oficio: </b><p>{{$solicitud->motivo_oficio}}</p>
                            <?php  $fecha_solicitud=date_format(new DateTime($solicitud->fecha_solicitud), 'd-m-Y H:i:s');?>
                            <b>Fecha de la solicitud del oficio: </b><p>{{$fecha_solicitud}}</p>
                            @if($solicitud->id_articulo==2 || $solicitud->id_articulo==8 || $solicitud->id_articulo==11)

                            @else
                                <?php
                                $fecha_req= date('d-m-Y', strtotime($solicitud->fecha_req));
                                ?>
                                <b>Fecha de la incidencia: </b><p>{{$fecha_req}}</p>
                            @endif

                            @if($solicitud->id_articulo==5)
                                <b>Hora entrada:</b><p>{{$solicitud->hora_e}}</p>
                                <b>Hora llegada tarde:</b><p>{{$solicitud->hora_st}}</p>
                            @endif
                            @if($solicitud->id_articulo==8 || $solicitud->id_articulo==2 || $solicitud->id_articulo==11)
                                <?php
                                $fecha_inicial= date('d-m-Y', strtotime($solicitud->fecha_invac));
                                $fecha_final= date('d-m-Y', strtotime($solicitud->fecha_tervac));
                                ?>
                                <b>Inician:</b><p>{{$fecha_inicial}}</p>
                                <b>Finalizan:</b><p>{{$fecha_final}}</p>
                            @endif
                            @if($solicitud->id_articulo==9 || $solicitud->id_articulo==10)
                                @if($solicitud->hora_e2 != "")

                                    <b>Hora entrada:</b><p>{{$solicitud->hora_e2}}</p>
                                    <b>Hora salida:</b><p>{{$solicitud->hora_s2}}</p>
                                @endif
                            @endif
                            @if($solicitud->id_articulo==9 || $solicitud->id_articulo==10)
                                @if($solicitud->hora_e1 != "")
                                    <b>Hora entrada:</b><p>{{$solicitud->hora_e1}}</p>
                                    <b>Hora salida:</b><p>{{$solicitud->hora_s1}}</p>
                                @endif
                            @endif
                            <br>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                                    <a  target="_blank" href="/incidencias_oficios/{{$solicitud->arch_solicitud}}" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm"> <i class="fa em128 fa-book" title="Ver PDF"> </i> Ver evidencia </a>
                                    <button id="{{$solicitud->id_solicitud}}" class="editar_oficio tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm"> Editar </button>
                                    <a href="{{url('/incidencias/historial_docentesSo')}}" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Enviar</a>

                            </div>
                        </div>
                </div>
            </div>
            </div>




            <div class="modal fade bs-example-modal-lg tw-modal-compat" id="modal_editar_oficio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-panel-modal hidden>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header tw:bg-brand-500 tw:text-white">
                            <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Editar oficio firmado</h4>
                        </div>
                        <div class="modal-body">
                            <form id="form_enviar_oficio" action="{{url('/incidencias/guardar_oficio/'.$solicitud->id_solicitud)}}" role="form" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                                        <label>Instrucciones: </label><br>
                                        <label> Para poder subir la evidencia correspondiente es necesario que su archivo, que desea subir este en formato PDF y que este legible.</label>
                                    </div>
                                </div>

                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                                        <label for="archivo_subir">Archivo a subir:</label>
                                        <input  class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden" id="arch_solicitud" name="arch_solicitud" type="file" accept="application/pdf"    required/>
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <p><br></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                                    <button  type="submit"  class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" >Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    $(".editar_oficio").click(function () {
                        //TNotify.alert("HOLA")
                            $("#modal_editar_oficio").modal('show');
                    });
                });

///////seecion de evidencia////

            </script>
    </main>
@endsection