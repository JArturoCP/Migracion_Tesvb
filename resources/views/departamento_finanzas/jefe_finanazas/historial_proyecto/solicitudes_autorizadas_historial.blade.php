@extends('layouts.panel')
@section('title', 'Revisión de solicitudes')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <p>
                <span class="fa fa-arrow-right"></span>
                <a class="tw:text-brand-500 tw:hover:underline" href="{{url("/presupuesto_autorizado/solicitudes_autorizadas_departamentos_historial/".$id_year)}}">Departamentos o jefaturas con solicitudes autorizadas</a>
                <span class="fa fa-arrow-right"></span>
                <a class="tw:text-brand-500 tw:hover:underline" href="{{url("/presupuesto_autorizado/solicitudes_ver_departamento_historial/".$id_unidad_admin."/".$id_year)}}">Solicitudes de requisiciones del departamento o de la jefatura</a>
                <span class="fa fa-chevron-right"></span>
                <span>Solicitud</span>
            </p>
        </div>
    </div>

    <x-panel.encabezado :titulo="'Historial de la documentacion de la solicitud del departamento o jefatura: '.$departamento->nom_departamento.' Nombre del jefe o de la jefa del departamento o jefatura: '.$departamento->titulo.' '.$departamento->nombre" :migas="['Finanzas' => null]" />
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
                                    <th class="tw:text-center tw:bg-sky-50 tw:dark:bg-sky-500/10" colspan="5">Documentación enviada por el departamento pdf</th>
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
                                            No hay documento
                                        </td>
                                    @else
                                        <td class="tw:text-center">
                                            <a  target="_blank" href="/finanzas/requisicion_pres_aut/{{ $documentos->requisicion_pdf }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                                        </td>
                                    @endif
                                    @if($documentos->anexo_1_pdf == '')
                                        <td class="tw:text-center">
                                            No hay documento
                                        </td>
                                    @else
                                        <td class="tw:text-center">
                                            <a  target="_blank" href="/finanzas/anexo1_pres_aut/{{ $documentos->anexo_1_pdf }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>

                                        </td>
                                    @endif
                                    @if($documentos->oficio_suficiencia_presupuestal_pdf == '')
                                        <td class="tw:text-center">
                                            No hay documento
                                        </td>
                                    @else
                                        <td class="tw:text-center">
                                            <a  target="_blank" href="/finanzas/suficiencia_pres_aut/{{ $documentos->oficio_suficiencia_presupuestal_pdf }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                                        </td>
                                    @endif
                                    @if($documentos->id_estado_justificacion == 0)
                                        <td class="tw:text-center">
                                            Sin justificacion de dictamen
                                        </td>
                                    @else
                                        <td class="tw:text-center">
                                            @if($documentos->id_estado_justificacion == 1)
                                                Sin justificacion de dictamen
                                            @else
                                                <a  target="_blank" href="/finanzas/justificacion_pres_aut/{{ $documentos->oficio_justificacion }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                                            @endif

                                        </td>
                                    @endif
                                    @if($documentos->cotizacion_pdf == '')
                                        <td class="tw:text-center">
                                            No hay documento
                                        </td>
                                    @else
                                        <td class="tw:text-center">
                                            <a  target="_blank" href="/finanzas/cotizacion_pres_aut/{{ $documentos->cotizacion_pdf }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                                        </td>

                                    @endif
                                </tr>


                                </tbody>
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
                                    <th class="tw:text-center tw:bg-sky-50 tw:dark:bg-sky-500/10" colspan="5">Registrar documentación</th>
                                </tr>
                                <tr>
                                    <th>Contrato</th>
                                    <th>Factura</th>
                                    <th>Pago</th>
                                    <th>Oficio de entrega</th>
                                    <th>Solicitud de pago</th>

                                </tr>
                                </thead>
                                <tbody>
                                @if($documentos->id_tipo_contrato == 0)
                                    <td class="tw:text-center">
                                        <button class="agregar_contrato tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" title="Agregar contrato pdf" id="{{ $documentos->id_solicitud_documento }}" ><span     class="fa fa-plus" aria-hidden="true"></span></button>

                                    </td>
                                @else
                                    <td class="tw:text-center">
                                        @if($documentos->id_tipo_contrato == 1)
                                            CONTRATO ADMINISTRATIVO
                                        @elseif($documentos->id_tipo_contrato == 2)
                                            CONTRATO PEDIDO
                                        @elseif($documentos->id_tipo_contrato == 3)
                                            ORDEN DE PEDIDO
                                        @elseif($documentos->id_tipo_contrato == 4)
                                            NOTA INFORMATIVA
                                        @endif
                                        <br>
                                        <a  target="_blank" href="/finanzas/contrato_pres_aut/{{ $documentos->pdf_tipo_contrato }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>

                                        <button title="Modificar tipo de contrato pdf" id="{{ $documentos->id_solicitud_documento }}"  class="editar_contrato tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" ><span class="fa fa-cog" aria-hidden="true"></span></button>
                                    </td>
                                @endif
                                @if($documentos->pdf_factura_comprado == '')
                                    <td class="tw:text-center">
                                        <button class="agregar_factura tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" title="Agregar factura pdf" id="{{ $documentos->id_solicitud_documento }}" ><span     class="fa fa-plus" aria-hidden="true"></span></button>

                                    </td>
                                @else
                                    <td class="tw:text-center">
                                        <br>
                                        <a  target="_blank" href="/finanzas/factura_pres_aut/{{ $documentos->pdf_factura_comprado }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>

                                        <button title="Modificar factura pdf" id="{{ $documentos->id_solicitud_documento }}"  class="editar_factura tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" ><span class="fa fa-cog" aria-hidden="true"></span></button>
                                    </td>
                                @endif
                                @if($documentos->pdf_pago_material_comprado == '')
                                    <td class="tw:text-center">
                                        <button class="agregar_pago tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" title="Agregar factura pdf" id="{{ $documentos->id_solicitud_documento }}" ><span     class="fa fa-plus" aria-hidden="true"></span></button>

                                    </td>
                                @else
                                    <td class="tw:text-center">
                                        <br>
                                        <a  target="_blank" href="/finanzas/pago_pres_aut/{{ $documentos->pdf_pago_material_comprado }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>

                                        <button title="Modificar pago pdf" id="{{ $documentos->id_solicitud_documento }}"  class="editar_pago tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" ><span class="fa fa-cog" aria-hidden="true"></span></button>
                                    </td>
                                @endif
                                @if($documentos->pdf_oficio_entrega == '')
                                    <td class="tw:text-center">
                                        <button class="agregar_oficio tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" title="Agregar oficio de entrega pdf" id="{{ $documentos->id_solicitud_documento }}" ><span     class="fa fa-plus" aria-hidden="true"></span></button>

                                    </td>
                                @else
                                    <td class="tw:text-center">
                                        <br>
                                        <a  target="_blank" href="/finanzas/oficio_pres_aut/{{ $documentos->pdf_oficio_entrega }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>

                                        <button title="Modificar oficio de  pdf" id="{{ $documentos->id_solicitud_documento }}"  class="editar_oficio tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" ><span class="fa fa-cog" aria-hidden="true"></span></button>
                                    </td>
                                @endif
                                @if($documentos->pdf_solicitud_pago == '')
                                    <td class="tw:text-center">
                                        <button class="agregar_solicitud_pago tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" title="Agregar solicitud de pago pdf" id="{{ $documentos->id_solicitud_documento }}" ><span     class="fa fa-plus" aria-hidden="true"></span></button>

                                    </td>
                                @else
                                    <td class="tw:text-center">
                                        <br>
                                        <a  target="_blank" href="/finanzas/solicitud_pago_pres_aut/{{ $documentos->pdf_solicitud_pago }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>

                                        <button title="Modificar solicitud de pago de  pdf" id="{{ $documentos->id_solicitud_documento }}"  class="editar_solicitud_pago tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" ><span class="fa fa-cog" aria-hidden="true"></span></button>
                                    </td>
                                @endif



                                </tbody>
                            </table>
</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    {{-- modal agregar contrato--}}

    <x-panel.modal id="modal_agregar_contrato" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar documento  pdf</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_agregar_contrato">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_agregar_contrato"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>
    {{-- modal modificar contrato--}}

    <x-panel.modal id="modal_modificar_contrato" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Modificar documento  pdf</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_modificar_contrato">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_modificar_contrato"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>
    {{-- modal agregar factura--}}

    <x-panel.modal id="modal_agregar_factura" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar documento  pdf</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_agregar_factura">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_agregar_factura"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>
    {{-- modal modificar factura--}}

    <x-panel.modal id="modal_modificar_factura" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Modificar documento  pdf</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_modificar_factura">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_modificar_factura"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>
    {{-- modal agregar pago--}}

    <x-panel.modal id="modal_agregar_pago" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar documento  pdf</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_agregar_pago">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_agregar_pago"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>
    {{-- modal modificar pago--}}

    <x-panel.modal id="modal_modificar_pago" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Modificar documento  pdf</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_modificar_pago">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_modificar_pago"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>

    {{-- modal agregar oficio--}}

    <x-panel.modal id="modal_agregar_oficio" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar documento  pdf</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_agregar_oficio">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_agregar_oficio"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>
    {{-- modal modificar oficio--}}

    <x-panel.modal id="modal_modificar_oficio" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Modificar documento  pdf</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_modificar_oficio">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_modificar_oficio"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>
    {{-- modal agregar solicitud de pago--}}

    <x-panel.modal id="modal_agregar_solicitud_pago" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar documento  pdf</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_agregar_solicitud_pago">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_agregar_solicitud_pago"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>
    {{-- modal modificar solicitud de pago--}}

    <x-panel.modal id="modal_modificar_solicitud_pago" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Modificar documento  pdf</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_modificar_solicitud_pago">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_modificar_solicitud_pago"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>
    <script>
        $(document).ready(function (){
            $(".agregar_solicitud_pago").click(function (){
                var id_solicitud_documento =$(this).attr('id');
                $.get("/presupuesto_autorizado/agregar_solicitud_pago/"+id_solicitud_documento,function (request) {
                    $("#contenedor_agregar_solicitud_pago").html(request);
                    $("#modal_agregar_solicitud_pago").modal('show');
                });
            });
            $("#guardar_agregar_solicitud_pago").click(function (){
                var doc_solicitud_pago = $("#doc_solicitud_pago").val();

                if(doc_solicitud_pago != ''){
                    $("#form_guardar_solicitud_pago").submit();
                    $("#guardar_agregar_solicitud_pago").attr("disabled", true);
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
                        title: "Selecciona  documento pdf de la solicitud de pago",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $(".editar_solicitud_pago").click(function (){
                var id_solicitud_documento =$(this).attr('id');

                $.get("/presupuesto_autorizado/modificar_solicitud_pago/"+id_solicitud_documento,function (request) {
                    $("#contenedor_modificar_solicitud_pago").html(request);
                    $("#modal_modificar_solicitud_pago").modal('show');
                });
            });
            $("#guardar_modificar_solicitud_pago").click(function (){
                var doc_solicitud_pago = $("#doc_solicitud_pago").val();


                if(doc_solicitud_pago != ''){
                    $("#form_guardar_mod_solicitud_pago").submit();
                    $("#guardar_modificar_solicitud_pago").attr("disabled", true);
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
                        title: "Selecciona  documento pdf de la solicitud de pago",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $(".editar_oficio").click(function (){
                var id_solicitud_documento =$(this).attr('id');
                $.get("/presupuesto_autorizado/modificar_oficio_solicitud/"+id_solicitud_documento,function (request) {
                    $("#contenedor_modificar_oficio").html(request);
                    $("#modal_modificar_oficio").modal('show');
                });
            });
            $("#guardar_modificar_oficio").click(function (){
                var doc_oficio = $("#doc_oficio").val();

                if(doc_oficio != ''){
                    $("#form_guardar_mod_oficio").submit();
                    $("#guardar_modificar_oficio").attr("disabled", true);
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
                        title: "Selecciona  documento pdf del oficio de entrega",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });

            $(".agregar_oficio").click(function (){
                var id_solicitud_documento =$(this).attr('id');
                $.get("/presupuesto_autorizado/agregar_oficio_solicitud/"+id_solicitud_documento,function (request) {
                    $("#contenedor_agregar_oficio").html(request);
                    $("#modal_agregar_oficio").modal('show');
                });
            });
            $("#guardar_agregar_oficio").click(function (){
                var doc_oficio = $("#doc_oficio").val();

                if(doc_oficio != ''){
                    $("#form_guardar_oficio").submit();
                    $("#guardar_agregar_oficio").attr("disabled", true);
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
                        title: "Selecciona  documento pdf del oficio de entrega",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $(".editar_pago").click(function (){
                var id_solicitud_documento =$(this).attr('id');
                $.get("/presupuesto_autorizado/modificar_pago_solicitud/"+id_solicitud_documento,function (request) {
                    $("#contenedor_modificar_pago").html(request);
                    $("#modal_modificar_pago").modal('show');
                });
            });
            $("#guardar_modificar_pago").click(function (){
                var doc_pago = $("#doc_pago").val();

                if(doc_pago != ''){
                    $("#form_guardar_mod_pago").submit();
                    $("#guardar_modificar_pago").attr("disabled", true);
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
                        title: "Selecciona  documento pdf del pago",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $(".agregar_pago").click(function (){
                var id_solicitud_documento =$(this).attr('id');
                $.get("/presupuesto_autorizado/agregar_pago_solicitud/"+id_solicitud_documento,function (request) {
                    $("#contenedor_agregar_pago").html(request);
                    $("#modal_agregar_pago").modal('show');
                });
            });
            $("#guardar_agregar_pago").click(function (){
                var doc_pago = $("#doc_pago").val();

                if(doc_pago != ''){
                    $("#form_guardar_pago").submit();
                    $("#guardar_agregar_pago").attr("disabled", true);
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
                        title: "Selecciona  documento pdf del pago",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $(".agregar_factura").click(function (){
                var id_solicitud_documento =$(this).attr('id');
                $.get("/presupuesto_autorizado/agregar_factura_solicitud/"+id_solicitud_documento,function (request) {
                    $("#contenedor_agregar_factura").html(request);
                    $("#modal_agregar_factura").modal('show');
                });
            });
            $("#guardar_agregar_factura").click(function (){
                var doc_factura = $("#doc_factura").val();
                if(doc_factura != ''){
                    $("#form_guardar_factura").submit();
                    $("#guardar_agregar_factura").attr("disabled", true);
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
                        title: "Selecciona documento pdf de la factura",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $(".editar_factura").click(function (){
                var id_solicitud_documento =$(this).attr('id');

                $.get("/presupuesto_autorizado/modificar_factura_solicitud/"+id_solicitud_documento,function (request) {
                    $("#contenedor_modificar_factura").html(request);
                    $("#modal_modificar_factura").modal('show');
                });
            });
            $("#guardar_modificar_factura").click(function (){
                var doc_factura = $("#doc_factura").val();
                if(doc_factura != ''){
                    $("#form_guardar_mod_factura").submit();
                    $("#guardar_modificar_factura").attr("disabled", true);
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
                        title: "Selecciona  factura",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });

            $(".editar_contrato").click(function (){
                var id_solicitud_documento =$(this).attr('id');

                $.get("/presupuesto_autorizado/modificar_contrato_solicitud/"+id_solicitud_documento,function (request) {
                    $("#contenedor_modificar_contrato").html(request);
                    $("#modal_modificar_contrato").modal('show');
                });
            });
            $(".agregar_contrato").click(function (){
                var id_solicitud_documento =$(this).attr('id');
                $.get("/presupuesto_autorizado/agregar_contrato_solicitud/"+id_solicitud_documento,function (request) {
                    $("#contenedor_agregar_contrato").html(request);
                    $("#modal_agregar_contrato").modal('show');
                });
            });
            $("#guardar_agregar_contrato").click(function (){
                var id_tipo_contrato = $("#id_tipo_contrato").val();
                if(id_tipo_contrato == null){
                    swal({
                        position: "top",
                        type: "error",
                        title: "Selecciona tipo de contrato",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }else{
                    var doc_contrato = $("#doc_contrato").val();
                    if(doc_contrato == ''){
                        swal({
                            position: "top",
                            type: "error",
                            title: "Selecciona  contrato",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }
                    else{
                        $("#form_guardar_contrato").submit();
                        $("#guardar_agregar_contrato").attr("disabled", true);
                        swal({
                            position: "top",
                            type: "success",
                            title: "Registro exitoso",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }

                }
            });
            $("#guardar_modificar_contrato").click(function (){
                var id_tipo_contrato = $("#id_tipo_contrato").val();
                if(id_tipo_contrato == null){
                    swal({
                        position: "top",
                        type: "error",
                        title: "Selecciona tipo de contrato",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }else{
                    var doc_contrato = $("#doc_contrato").val();
                    if(doc_contrato == ''){
                        swal({
                            position: "top",
                            type: "error",
                            title: "Selecciona  contrato",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }
                    else{
                        $("#form_guardar_mod_contrato").submit();
                        $("#guardar_modificar_contrato").attr("disabled", true);
                        swal({
                            position: "top",
                            type: "success",
                            title: "Registro exitoso",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }

                }
            });

        });
    </script>

</div>
@endsection