@extends('layouts.panel')
@section('title', 'Solicitudes de requisiciones')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Registrar documentos de la solicitud" :migas="['Finanzas' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                    <p><span class="fa fa-file"></span> Solicitud: <b>{{ $solicitud->descripcion_solicitud }}</b></p>
                    <p>Proyecto: <b>{{ $solicitud->nombre_proyecto }}</b></p>
                    <p>Meta: <b>{{ $solicitud->meta }}</b></p>
                    <p>Mes: <b>{{ $solicitud->mes }}</b></p>

                </div>
                <div class="tw:p-5 tw:sm:p-6">
                    @if($estado_solicitud == 0)
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">

                                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                                    <thead>
                                    <tr>
                                        <th class="tw:text-center tw:bg-sky-50 tw:dark:bg-sky-500/10" colspan="7">
                                            <b>PARTIDAS PRESUPUESTALES</b>
                                        </th>
                                    </tr>
                                    @foreach($partidas as $partida)
                                        <tr>

                                            <th class="tw:text-center" colspan="7">
                                                {{ $partida->clave_presupuestal }} {{ $partida->nombre_partida }}..............................................................
                                                <b class="tw:text-red-600 tw:dark:text-red-400">PRESUPUESTO DADO: {{ "$".number_format($partida->presupuesto_dado, 2, '.', ',') }}</b>
                                            </th>
                                        </tr>
                                    @endforeach
                                    </thead>
                                </table>
</div>


                            </div>
                        </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:lg:w-full tw:px-2">
                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                                <thead>
                                <tr>
                                    <th class="tw:text-center" colspan="5">Documentación en pdf</th>
                                </tr>
                                <tr>
                                    <th>Requisición </th>
                                    <th>Anexo 1</th>
                                    <th>Oficio de suficiencia presupuestal</th>
                                    <th>Justificación para dictamen</th>
                                    <th>Cotización</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="tw:text-center">
                                        <button class="agregar_requisicion tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" title="Agregar requisición pdf" id="{{ $solicitud->id_solicitud }}" ><span     class="fa fa-plus" aria-hidden="true"></span></button>

                                    </td>
                                    <td class="tw:text-center">
                                        <button  class="agregar_anexo1 tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" title="Agregar anexo 1 pdf" id="{{ $solicitud->id_solicitud }}" ><span     class="fa fa-plus" aria-hidden="true"></span></button>
                                    </td>
                                    <td class="tw:text-center">

                                        <button  class="agregar_suficiencia tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" title="Agregar oficio de suficiencia presupuestal pdf" id="{{ $solicitud->id_solicitud }}" ><span     class="fa fa-plus" aria-hidden="true"></span></button>
                                    </td>
                                    <td class="tw:text-center">

                                        <button  class="agregar_justificacion tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" title="Agregar justificacion pdf" id="{{ $solicitud->id_solicitud }}" ><span     class="fa fa-plus" aria-hidden="true"></span></button>
                                    </td>
                                    <td class="tw:text-center">
                                        <button  class="agregar_cotizacion tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" title="Agregar cotización pdf" id="{{ $solicitud->id_solicitud }}" ><span     class="fa fa-plus" aria-hidden="true"></span></button>

                                    </td>
                                </tr>


                                </tbody>
                            </table>
</div>
                        </div>
                    </div>

                    @endif
                        @if($estado_solicitud == 1)
                            @if($solicitud->comentario_solicitud !='')
                                <x-panel.alerta tipo="error" class="tw:mb-4">Comentario: {{ $solicitud->comentario_solicitud }}</x-panel.alerta>
                            @endif
                                <div class="tw:p-5 tw:sm:p-6">
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:lg:w-full tw:px-2">

                                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                                                <thead>
                                                <tr>
                                                    <th class="tw:text-center tw:bg-sky-50 tw:dark:bg-sky-500/10" colspan="7">
                                                        <b>PARTIDAS PRESUPUESTALES</b>
                                                    </th>
                                                </tr>
                                                @foreach($partidas as $partida)
                                                    <tr>

                                                        <th class="tw:text-center" colspan="7">
                                                            {{ $partida->clave_presupuestal }} {{ $partida->nombre_partida }}..............................................................
                                                            <b class="tw:text-red-600 tw:dark:text-red-400">PRESUPUESTO DADO: {{ "$".number_format($partida->presupuesto_dado, 2, '.', ',') }}</b>
                                                        </th>
                                                    </tr>
                                                @endforeach
                                                </thead>
                                            </table>
</div>


                                        </div>
                                    </div>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:lg:w-full tw:px-2">
                                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                                        <thead>
                                        <tr>
                                            <th class="tw:text-center tw:bg-sky-50 tw:dark:bg-sky-500/10" colspan="5">Documentación en pdf</th>
                                        </tr>
                                        <tr>
                                            <th>Requisición </th>
                                            <th>Anexo 1</th>
                                            <th>Oficio de suficiencia presupuestal</th>
                                            <th>Justificación para dictamen</th>
                                            <th>Cotización</th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            @if($documentos->requisicion_pdf == '')
                                            <td class="tw:text-center">
                                                <button class="agregar_requisicion tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" title="Agregar requisición pdf" id="{{ $solicitud->id_solicitud }}" ><span     class="fa fa-plus" aria-hidden="true"></span></button>

                                            </td>
                                            @else
                                                <td class="tw:text-center">
                                                    <a  target="_blank" href="/finanzas/requisicion_pres_aut/{{ $documentos->requisicion_pdf }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>

                                                    <button title="Modificar requisicion pdf" id="{{ $documentos->id_solicitud_documento }}"  class="editar_requisicion tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" ><span class="fa fa-cog" aria-hidden="true"></span></button>
                                                </td>
                                            @endif
                                                @if($documentos->anexo_1_pdf == '')
                                                <td class="tw:text-center">
                                                    <button  class="agregar_anexo1 tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" title="Agregar anexo 1 pdf" id="{{ $solicitud->id_solicitud }}" ><span     class="fa fa-plus" aria-hidden="true"></span></button>
                                                </td>
                                                @else
                                                    <td class="tw:text-center">
                                                        <a  target="_blank" href="/finanzas/anexo1_pres_aut/{{ $documentos->anexo_1_pdf }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>

                                                        <button title="Modificar anexo 1 pdf" id="{{ $documentos->id_solicitud_documento }}"  class="editar_anexo1 tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" ><span class="fa fa-cog" aria-hidden="true"></span></button>
                                                    </td>
                                                @endif
                                                @if($documentos->oficio_suficiencia_presupuestal_pdf == '')
                                                <td class="tw:text-center">

                                                    <button  class="agregar_suficiencia tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" title="Agregar oficio de suficiencia presupuestal pdf" id="{{ $solicitud->id_solicitud }}" ><span     class="fa fa-plus" aria-hidden="true"></span></button>
                                                </td>
                                                @else
                                                    <td class="tw:text-center">
                                                        <a  target="_blank" href="/finanzas/suficiencia_pres_aut/{{ $documentos->oficio_suficiencia_presupuestal_pdf }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>

                                                        <button title="Modificar oficio de suficiencia pdf" id="{{ $documentos->id_solicitud_documento }}"  class="editar_suficiencia tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" ><span class="fa fa-cog" aria-hidden="true"></span></button>
                                                    </td>
                                                @endif
                                                @if($documentos->id_estado_justificacion == 0)
                                            <td class="tw:text-center">
                                                <button  class="agregar_justificacion tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" title="Agregar justificacion pdf" id="{{ $solicitud->id_solicitud }}" ><span     class="fa fa-plus" aria-hidden="true"></span></button>
                                            </td>
                                                @else
                                                    <td class="tw:text-center">
                                                    @if($documentos->id_estado_justificacion == 1)
                                                        No
                                                    @else
                                                        <a  target="_blank" href="/finanzas/justificacion_pres_aut/{{ $documentos->oficio_justificacion }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                                                    @endif
                                                    <button title="Modificar justificacion pdf" id="{{ $documentos->id_solicitud_documento }}"  class="editar_justificacion tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" ><span class="fa fa-cog" aria-hidden="true"></span></button>
                                                    </td>
                                                @endif
                                                @if($documentos->cotizacion_pdf == '')
                                                    <td class="tw:text-center">
                                                        <button  class="agregar_cotizacion tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" title="Agregar cotización pdf" id="{{ $solicitud->id_solicitud }}" ><span     class="fa fa-plus" aria-hidden="true"></span></button>
                                                    </td>
                                                @else
                                                    <td class="tw:text-center">
                                                    <a  target="_blank" href="/finanzas/cotizacion_pres_aut/{{ $documentos->cotizacion_pdf }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                                                    <button title="Modificar cotización pdf" id="{{ $documentos->id_solicitud_documento }}"  class="editar_cotizacion tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" ><span class="fa fa-cog" aria-hidden="true"></span></button>
                                                    </td>

                                                @endif
                                        </tr>


                                        </tbody>
                                    </table>
</div>
                                </div>
                            </div>

                                @if($documentos->cotizacion_pdf != '')
                                    @if($documentos->requisicion_pdf != '')
                                        @if($documentos->anexo_1_pdf !='')
                                            @if($documentos->oficio_suficiencia_presupuestal_pdf !='')
                                                @if($documentos->id_estado_justificacion != 0)
                                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                        <div class="tw:w-full tw:px-2 tw:text-center">
                                                            <button  id="{{ $id_solicitud }}"  class="enviar_solicitud tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Enviar solicitud
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                @endif
                        @endif
                </div>
            </div>
        </div>
    </div>




    {{-- modal agregar requisicion pdf--}}

    <x-panel.modal id="modal_agregar_requisicion_pdf" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Requisicion pdf</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_agregar_requisicion_pdf">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_req"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>

    {{-- modal agregar agregar_anexo1--}}

    <x-panel.modal id="modal_agregar_anexo1_pdf" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Anexo 1 pdf</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_agregar_anexo1_pdf">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_anexo1"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>

    {{-- modal agregar suficiencia  pdf--}}

    <x-panel.modal id="modal_agregar_suficiencia" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Oficio de suficiencia presupuestal pdf</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_agregar_suficiencia">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_suficiencia"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>

    {{-- modal agregar justificacion  pdf--}}

    <x-panel.modal id="modal_agregar_justificacion" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Justificación pdf</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_agregar_justificacion">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_justificacion"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>
    {{-- modal agregar cotizacion  --}}

    <x-panel.modal id="modal_agregar_cotizacion" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Cotización pdf</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_agregar_cotizacion">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_cotizacion"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>

    {{-- modal modificar requisicion--}}

    <x-panel.modal id="modal_modificar_req" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Modificar requisicion  pdf</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_modificar_req">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_modificar_req"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>
    {{-- modal modificar anexo1--}}

    <x-panel.modal id="modal_mod_anexo1" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Modificar requisicion  pdf</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_mod_anexo1">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_mod_anexo1"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>

    {{-- modal modificar oficio de suficiencia pdfp--}}

    <x-panel.modal id="modal_mod_suficiencia" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Modificar oficio de suficiencia presupuestal  pdf</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_mod_suficiencia">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_mod_suficiencia"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>

    {{-- modal modificar justificacion pdf--}}

    <x-panel.modal id="modal_mod_justificacion" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Modificar justificación  pdf</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_mod_justificacion">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_mod_justificacion"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>

    {{-- modal modificar cotizacion  --}}

    <x-panel.modal id="modal_modificar_cotizacion" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Modificar cotización pdf</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_modificar_cotizacion">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_modificar_cotizacion"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>
    {{-- modal agregar material partida  --}}

    <x-panel.modal id="modal_agregar_material_partida" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar material o servicio a la partida</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_material_partida">

                    </div>


                </div>
            </x-panel.modal>

    {{-- modal enviar solicitud --}}

    <x-panel.modal id="modal_enviar_solicitud" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Enviar solicitud</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <form id="form_enviar_solicitud" class="" action="{{url("/presupuesto_autorizado/enviar_solicitud/".$id_solicitud)}}" role="form" method="POST" >
                    {{ csrf_field() }}
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">¿Deseas enviar tu solicitud?</h4>
                            </div>
                        </div>
                    </form>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_enviar_solicitud"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Enviar</button>
                    </div>
                </div>
            </x-panel.modal>
    {{-- modal agregar material partida  --}}

    <x-panel.modal id="modal_modificar_material_partida" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Modificar material o servicio a la partida</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_modificar_material_partida">

                    </div>


                </div>
            </x-panel.modal>

    {{-- modal eliminar material o servicio --}}

    <x-panel.modal id="modal_eliminar_material" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Notificación.</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <form id="form_eliminar_material" class="" action="{{url("/presupuesto_autorizado/eliminar_material_solicitud/")}}" role="form" method="POST" >
                        {{ csrf_field() }}
                        <input type="hidden" id="id_material_part" name="id_material_part" value="">
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">¿Deseas eliminar material o servicio, etc.?</h4>
                            </div>
                        </div>
                    </form>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_eliminar_material"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                    </div>
                </div>
            </x-panel.modal>

    <script type="text/javascript">
        $(document).ready( function() {
            $("#guardar_eliminar_material").click(function (){
                $("#guardar_eliminar_material").attr("disabled", true);
                $("#form_eliminar_material").submit();
                swal({
                    position: "top",
                    type: "success",
                    title: "Eliminaciòn exitosa",
                    showConfirmButton: false,
                    timer: 3500
                });
            });
            $(".eliminar_servicio").click(function (){
                var id_material_partida =$(this).attr('id');
                $("#id_material_part").val(id_material_partida);
                $("#modal_eliminar_material").modal("show");
                });
            $(".editar_servicio").click(function (){
                var id_material_partida =$(this).attr('id');
                $.get("/presupuesto_autorizado/modificar_servicio_solicitud/"+id_material_partida,function (request) {
                    $("#contenedor_modificar_material_partida").html(request);
                    $("#modal_modificar_material_partida").modal('show');
                });
            });
            $("#guardar_enviar_solicitud").click(function (){
                $("#form_enviar_solicitud").submit();
                $("#guardar_enviar_solicitud").attr("disabled", true);
            });
            $(".enviar_solicitud").click(function (){
                $("#modal_enviar_solicitud").modal('show');
            });

            $(".agregar_requisicion").click(function (){
                var id_solicitud =$(this).attr('id');
                $.get("/presupuesto_autorizado/registrar_requisicion/"+id_solicitud,function (request) {
                    $("#contenedor_agregar_requisicion_pdf").html(request);
                    $("#modal_agregar_requisicion_pdf").modal('show');
                });
            });
            $("#guardar_req").click(function (){

                    var requisicion_pdf = $("#requisicion_pdf").val();
                    if( requisicion_pdf != ''){
                        $("#form_guardar_requisicion").submit();
                        $("#guardar_req").attr("disabled", true);
                        swal({
                            position: "top",
                            type: "success",
                            title: "Registro exitoso",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }else{
                        swal({
                            position: "top",
                            type: "error",
                            title: "Selecciona documento pdf",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }
            });
            $(".agregar_anexo1").click(function (){
                var id_solicitud =$(this).attr('id');
                $.get("/presupuesto_autorizado/registrar_agregar_anexo1/"+id_solicitud,function (request) {
                    $("#contenedor_agregar_anexo1_pdf").html(request);
                    $("#modal_agregar_anexo1_pdf").modal('show');
                });
            });
            $("#guardar_anexo1").click(function (){

                var anexo_pdf = $("#anexo_pdf").val();
                if( anexo_pdf != ''){
                    $("#form_guardar_anexo1").submit();
                    $("#guardar_anexo1").attr("disabled", true);
                    swal({
                        position: "top",
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }else{
                    swal({
                        position: "top",
                        type: "error",
                        title: "Selecciona documento pdf",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $(".agregar_suficiencia").click(function (){
                var id_solicitud =$(this).attr('id');
                $.get("/presupuesto_autorizado/registrar_oficio_suficiencia/"+id_solicitud,function (request) {
                    $("#contenedor_agregar_suficiencia").html(request);
                    $("#modal_agregar_suficiencia").modal('show');
                });
            });
            $("#guardar_suficiencia").click(function (){
                var suficiencia_pdf = $("#suficiencia_pdf").val();
                if( suficiencia_pdf != ''){
                    $("#form_guardar_suficiencia").submit();
                    $("#guardar_suficiencia").attr("disabled", true);
                    swal({
                        position: "top",
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }else{
                    swal({
                        position: "top",
                        type: "error",
                        title: "Selecciona documento pdf",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $(".agregar_justificacion").click(function (){
                var id_solicitud =$(this).attr('id');
                $.get("/presupuesto_autorizado/registrar_justificacion/"+id_solicitud,function (request) {
                    $("#contenedor_agregar_justificacion").html(request);
                    $("#modal_agregar_justificacion").modal('show');
                });
            });
            $("#guardar_justificacion").click(function (){
                var justificacion = $("#justificacion").val();

                if(justificacion != null){
                    if(justificacion == 1){
                        $("#form_guardar_justificacion").submit();
                        $("#guardar_justificacion").attr("disabled", true);
                        swal({
                            position: "top",
                            type: "success",
                            title: "Registro exitoso",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }
                    if(justificacion == 2){
                        var doc_justificacion = $("#doc_justificacion").val();

                        if(doc_justificacion == ''){
                            swal({
                                position: "top",
                                type: "error",
                                title: "Selecciona documento pdf",
                                showConfirmButton: false,
                                timer: 3500
                            });
                        }else{
                            $("#form_guardar_justificacion").submit();
                            $("#guardar_justificacion").attr("disabled", true);
                            swal({
                                position: "top",
                                type: "success",
                                title: "Registro exitoso",
                                showConfirmButton: false,
                                timer: 3500
                            });
                        }
                    }
                }else{
                    swal({
                        position: "top",
                        type: "error",
                        title: "Selecciona una opcion",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $(".agregar_cotizacion").click(function (){
                var id_solicitud =$(this).attr('id');
                $.get("/presupuesto_autorizado/registrar_cotizacion/"+id_solicitud,function (request) {
                    $("#contenedor_agregar_cotizacion").html(request);
                    $("#modal_agregar_cotizacion").modal('show');
                });
            });
            $("#guardar_cotizacion").click(function (){
                var cotizacion_pdf = $("#cotizacion_pdf").val();
                if( cotizacion_pdf != ''){
                    $("#form_guardar_cotizacion").submit();
                    $("#guardar_cotizacion").attr("disabled", true);
                    swal({
                        position: "top",
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }else{
                    swal({
                        position: "top",
                        type: "error",
                        title: "Selecciona documento pdf",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $(".editar_requisicion").click(function (){
                var id_solicitud_documento =$(this).attr('id');
                $.get("/presupuesto_autorizado/modificar_requisicion/"+id_solicitud_documento,function (request) {
                    $("#contenedor_modificar_req").html(request);
                    $("#modal_modificar_req").modal('show');
                });
            });
            $("#guardar_modificar_req").click(function (){

                var requisicion_mod_pdf = $("#requisicion_mod_pdf").val();
                if( requisicion_mod_pdf != ''){
                    $("#form_guardar_mod_requisicion").submit();
                    $("#guardar_modificar_req").attr("disabled", true);
                    swal({
                        position: "top",
                        type: "success",
                        title: "Modificacion exitosa",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }else{
                    swal({
                        position: "top",
                        type: "error",
                        title: "Selecciona documento pdf",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $(".editar_anexo1").click(function (){
                var id_solicitud_documento =$(this).attr('id');

                $.get("/presupuesto_autorizado/modificar_anexo1/"+id_solicitud_documento,function (request) {
                    $("#contenedor_mod_anexo1").html(request);
                    $("#modal_mod_anexo1").modal('show');
                });
            });
            $("#guardar_mod_anexo1").click(function (){

                var anexo_mod_pdf = $("#anexo_mod_pdf").val();

                if( anexo_mod_pdf != ''){
                    $("#form_guardar_mod_anexo1").submit();
                    $("#guardar_mod_anexo1").attr("disabled", true);
                    swal({
                        position: "top",
                        type: "success",
                        title: "Modificacion exitosa",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }else{
                    swal({
                        position: "top",
                        type: "error",
                        title: "Selecciona documento pdf",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $(".editar_suficiencia").click(function (){
                var id_solicitud_documento =$(this).attr('id');

                $.get("/presupuesto_autorizado/modificar_oficio_suficiencia/"+id_solicitud_documento,function (request) {
                    $("#contenedor_mod_suficiencia").html(request);
                    $("#modal_mod_suficiencia").modal('show');
                });
            });
            $("#guardar_mod_suficiencia").click(function (){
                var suficiencia_mod_pdf = $("#suficiencia_mod_pdf").val();

                if( suficiencia_mod_pdf != ''){
                    $("#form_guardar_mod_suficiencia").submit();
                    $("#guardar_mod_suficiencia").attr("disabled", true);
                    swal({
                        position: "top",
                        type: "success",
                        title: "Modificacion exitosa",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }else{
                    swal({
                        position: "top",
                        type: "error",
                        title: "Selecciona documento pdf",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $(".editar_justificacion").click(function (){
                var id_solicitud_documento =$(this).attr('id');

                $.get("/presupuesto_autorizado/modificar_justificacion/"+id_solicitud_documento,function (request) {
                    $("#contenedor_mod_justificacion").html(request);
                    $("#modal_mod_justificacion").modal('show');
                });
            });
            $("#guardar_mod_justificacion").click(function (){
                var justificacion = $("#mod_justificacion").val();

                if(justificacion != null){
                    if(justificacion == 1){
                        $("#form_guardar_mod_justificacion").submit();
                        $("#guardar_mod_justificacion").attr("disabled", true);
                        swal({
                            position: "top",
                            type: "success",
                            title: "Registro exitoso",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }
                    if(justificacion == 2){
                        var doc_justificacion = $("#doc_justificacion_mod").val();

                        if(doc_justificacion == ''){
                            swal({
                                position: "top",
                                type: "error",
                                title: "Selecciona documento pdf",
                                showConfirmButton: false,
                                timer: 3500
                            });
                        }else{
                            $("#form_guardar_mod_justificacion").submit();
                            $("#guardar_mod_justificacion").attr("disabled", true);
                            swal({
                                position: "top",
                                type: "success",
                                title: "Registro exitoso",
                                showConfirmButton: false,
                                timer: 3500
                            });
                        }
                    }
                }else{
                    swal({
                        position: "top",
                        type: "error",
                        title: "Selecciona una opcion",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $(".editar_cotizacion").click(function (){
                var id_solicitud_documento =$(this).attr('id');

                $.get("/presupuesto_autorizado/modificar_cotizacion_pdf/"+id_solicitud_documento,function (request) {
                    $("#contenedor_modificar_cotizacion").html(request);
                    $("#modal_modificar_cotizacion").modal('show');
                });

            });
            $("#guardar_modificar_cotizacion").click(function (){
                var cotizacion_mod_pdf = $("#cotizacion_mod_pdf").val();

                if( cotizacion_mod_pdf != ''){
                    $("#form_guardar_mod_cotizacion").submit();
                    $("#guardar_modificar_cotizacion").attr("disabled", true);
                    swal({
                        position: "top",
                        type: "success",
                        title: "Modificacion exitosa",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }else{
                    swal({
                        position: "top",
                        type: "error",
                        title: "Selecciona documento pdf",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $(".agregar_material").click(function (){
              var id_solicitud_partida = $(this).attr('id');
                $.get("/presupuesto_autorizado/agregar_material_partida_solicitud/"+id_solicitud_partida,function (request) {
                    $("#contenedor_material_partida").html(request);
                    $("#modal_agregar_material_partida").modal('show');
                });

            });
        });
    </script>


</div>
@endsection