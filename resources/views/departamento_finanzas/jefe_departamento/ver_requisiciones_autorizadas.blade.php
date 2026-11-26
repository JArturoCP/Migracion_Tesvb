@extends('layouts.panel')
@section('title', 'Requisiciones autorizadas del anteproyecto')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado :titulo="'Requisiciones revisadas del anteproyecto del año '.$datos_req_envio->year_requisicion" :migas="['Finanzas' => null]" />

    <?php setlocale(LC_MONETARY, 'es_MX');

    ?>



    @foreach($requisiciones2 as $requisicion)
        @if($requisicion['id_autorizacion'] == 4 )

            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Requisición autorizada</h3>
                            </div>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                                <div class="tw:w-full tw:px-2">
                                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center tw:text-gray-800 tw:dark:text-white/90">PARTIDA PRESUPUESTAL: <b>{{ $requisicion['nombre_partida'] }}</b></h4>
                                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center tw:text-gray-800 tw:dark:text-white/90">MES: <b>{{ $requisicion['mes'] }}</b></h4>
                                    <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300 tw:text-center tw:text-gray-800 tw:dark:text-white/90">JUSTIFICACIÓN: <b>{{ $requisicion['justificacion'] }}</b></h5>
                                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center tw:text-gray-800 tw:dark:text-white/90">PROYECTO: <b>{{ $requisicion['nombre_proyecto'] }}</b></h4>
                                    <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300 tw:text-center tw:text-gray-800 tw:dark:text-white/90">META: <b>{{ $requisicion['meta'] }}</b></h5>
                                </div>
                            </div>


                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:lg:w-full tw:px-2">
                                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                                        <thead>
                                        <tr>
                                            <th class="tw:text-center" colspan="4">Documentación en pdf</th>
                                        </tr>
                                        <tr>
                                            <th>Requisición </th>
                                            <th>Anexo 1</th>
                                            <th>Oficio de suficiencia presupuestal</th>
                                            <th>Justificacion</th>
                                            <th>Cotización</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="tw:text-center">
                                                @if($requisicion['requisicion_pdf'] == '')
                                                    No hay documento registrado
                                                @else

                                                    <a  target="_blank" href="/finanzas/requisiciones/{{ $requisicion['requisicion_pdf'] }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>

                                                @endif
                                            </td>
                                            <td class="tw:text-center">
                                                @if($requisicion['anexo_1_pdf'] == '')
                                                    No hay documento registrado
                                                @else
                                                    <a  target="_blank" href="/finanzas/anexo1/{{ $requisicion['anexo_1_pdf'] }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>

                                                @endif
                                            </td>
                                            <td class="tw:text-center">
                                                @if($requisicion['oficio_suficiencia_presupuestal_pdf'] == '')
                                                    No hay documento registrado
                                                @else
                                                    <a  target="_blank" href="/finanzas/oficio_suficiencia/{{ $requisicion['oficio_suficiencia_presupuestal_pdf'] }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                                                @endif
                                            </td>
                                            <td class="tw:text-center">
                                                @if($requisicion['id_estado_justificacion'] == 0)
                                                    No se ha seleccionado respuesta
                                                @else
                                                    @if($requisicion['id_estado_justificacion'] == 1)
                                                        No
                                                    @else
                                                        <a  target="_blank" href="/finanzas/justificacion/{{ $requisicion['justificacion_pdf'] }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                                                    @endif

                                                @endif
                                            </td>
                                            <td class="tw:text-center">
                                                @if($requisicion['cotizacion_pdf'] == '')
                                                    No hay documento registrado
                                                @else
                                                    <a  target="_blank" href="/finanzas/cotizaciones/{{ $requisicion['cotizacion_pdf'] }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                                                @endif
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
</div>
                                </div>
                            </div>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:px-2">

                                    <hr>
                                </div>
                            </div>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:lg:w-full tw:px-2">
                                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                <div class="tw:w-full tw:px-2">
                                                    <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300 tw:text-center">BIENES O SERVICIOS, ETC.</h5>
                                                </div>
                                            </div>


                                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                <div class="tw:w-full tw:px-2">
                                                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                                                        <thead>
                                                        <tr>
                                                            <th>N. P</th>
                                                            <th>Descripcion</th>
                                                            <th>Unidad de medida</th>
                                                            <th>Cantidad</th>
                                                            <th>Precio unitario de referencia con IVA incluido</th>
                                                            <th>Importe</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $i=1; ?>
                                                        @foreach($requisicion['servicios'] as $servicio)
                                                            <tr>
                                                                <td>{{ $i++ }}</td>
                                                                <td>{{ $servicio['descripcion'] }}</td>
                                                                <td>{{ $servicio['unidad_medida'] }}</td>
                                                                <td class="tw:text-right"><h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $servicio['cantidad'] }}</h3></td>
                                                                <?php
                                                                $precio_unitario=$servicio['precio_unitario'];
                                                               // $precio_unitario= "$".number_format($precio_unitario, 2, '.', ',');
                                                                ?>
                                                                <td class="tw:text-right"><h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">${{ $precio_unitario}}</h3></td>
                                                                <?php
                                                                $importe=$servicio['importe'];
                                                               // $importe= "$".number_format($importe, 2, '.', ',');
                                                                ?>
                                                                <td class="tw:text-right"><h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">${{ $importe }}</h3></td>


                                                            </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td class="tw:text-right" colspan="5"> <h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Total importe</h3></td>
                                                            <?php

                                                            $total_req= "$".number_format($requisicion['total_importe'], 2, '.', ',');
                                                            ?>
                                                            <td class="tw:text-right" > <h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">${{ $requisicion['total_importe'] }}</h3></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
</div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        @endif
        @if( $requisicion['id_autorizacion'] == 3)
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <x-panel.alerta tipo="error" class="tw:mb-4"><h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">Requisición rechazada</h4></x-panel.alerta>
                            </div>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:px-2">
                                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center tw:text-gray-800 tw:dark:text-white/90">PARTIDA PRESUPUESTAL: <b>{{ $requisicion['nombre_partida'] }}</b></h4>
                                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center tw:text-gray-800 tw:dark:text-white/90">MES: <b>{{ $requisicion['mes'] }}</b></h4>
                                    <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300 tw:text-center tw:text-gray-800 tw:dark:text-white/90">JUSTIFICACIÓN: <b>{{ $requisicion['justificacion'] }}</b></h5>
                                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center tw:text-gray-800 tw:dark:text-white/90">PROYECTO: <b>{{ $requisicion['nombre_proyecto'] }}</b></h4>
                                    <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300 tw:text-center tw:text-gray-800 tw:dark:text-white/90">META: <b>{{ $requisicion['meta'] }}</b></h5>
                                </div>
                            </div>


                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:lg:w-full tw:px-2">
                                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                                        <thead>
                                        <tr>
                                            <th class="tw:text-center" colspan="4">Documentación en pdf</th>
                                        </tr>
                                        <tr>
                                            <th>Requisición </th>
                                            <th>Anexo 1</th>
                                            <th>Oficio de suficiencia presupuestal</th>
                                            <th>Justificacion</th>
                                            <th>Cotización</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="tw:text-center">
                                                @if($requisicion['requisicion_pdf'] == '')
                                                    No hay documento registrado
                                                @else

                                                    <a  target="_blank" href="/finanzas/requisiciones/{{ $requisicion['requisicion_pdf'] }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>

                                                @endif
                                            </td>
                                            <td class="tw:text-center">
                                                @if($requisicion['anexo_1_pdf'] == '')
                                                    No hay documento registrado
                                                @else
                                                    <a  target="_blank" href="/finanzas/anexo1/{{ $requisicion['anexo_1_pdf'] }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>

                                                @endif
                                            </td>
                                            <td class="tw:text-center">
                                                @if($requisicion['oficio_suficiencia_presupuestal_pdf'] == '')
                                                    No hay documento registrado
                                                @else
                                                    <a  target="_blank" href="/finanzas/oficio_suficiencia/{{ $requisicion['oficio_suficiencia_presupuestal_pdf'] }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                                                @endif
                                            </td>
                                            <td class="tw:text-center">
                                                @if($requisicion['id_estado_justificacion'] == 0)
                                                    No se ha seleccionado respuesta
                                                @else
                                                    @if($requisicion['id_estado_justificacion'] == 1)
                                                        No
                                                    @else
                                                        <a  target="_blank" href="/finanzas/justificacion/{{ $requisicion['justificacion_pdf'] }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                                                    @endif

                                                @endif
                                            </td>
                                            <td class="tw:text-center">
                                                @if($requisicion['cotizacion_pdf'] == '')
                                                    No hay documento registrado
                                                @else
                                                    <a  target="_blank" href="/finanzas/cotizaciones/{{ $requisicion['cotizacion_pdf'] }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                                                @endif
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
</div>
                                </div>
                            </div>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:px-2">

                                    <hr>
                                </div>
                            </div>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:lg:w-full tw:px-2">
                                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                <div class="tw:w-full tw:px-2">
                                                    <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300 tw:text-center">BIENES O SERVICIOS, ETC.</h5>
                                                </div>
                                            </div>


                                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                <div class="tw:w-full tw:px-2">
                                                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                                                        <thead>
                                                        <tr>
                                                            <th>N. P</th>
                                                            <th>Descripcion</th>
                                                            <th>Unidad de medida</th>
                                                            <th>Cantidad</th>
                                                            <th>Precio unitario de referencia con IVA incluido</th>
                                                            <th>Importe</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i=1; ?>
                                                        @foreach($requisicion['servicios'] as $servicio)
                                                            <tr>
                                                                <td>{{ $i++ }}</td>
                                                                <td>{{ $servicio['descripcion'] }}</td>
                                                                <td>{{ $servicio['unidad_medida'] }}</td>
                                                                <td class="tw:text-right"><h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $servicio['cantidad'] }}</h3></td>
                                                                    <?php
                                                                    $precio_unitario=$servicio['precio_unitario'];
                                                                    //$precio_unitario= "$".number_format($precio_unitario, 2, '.', ',');
                                                                    ?>
                                                                <td class="tw:text-right"><h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">${{ $precio_unitario}}</h3></td>
                                                                    <?php
                                                                    $importe=$servicio['importe'];
                                                                 //   $importe= "$".number_format($importe, 2, '.', ',');
                                                                    ?>
                                                                <td class="tw:text-right"><h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">${{ $importe }}</h3></td>


                                                            </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td class="tw:text-right" colspan="5"> <h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Total importe</h3></td>
                                                                <?php

                                                              //  $total_req= "$".number_format($requisicion['total_importe'], 2, '.', ',');
                                                                ?>
                                                            <td class="tw:text-right" > <h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $requisicion['total_importe'] }}</h3></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
</div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        @endif
    @endforeach






    {{-- modal crear proyecto--}}

    <x-panel.modal id="modal_crear_requisicion" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar nueva requisición de materiales</h4>
                </div>
                <div class="tw-modal-cuerpo">

                    <form id="form_agregar" class="" action="{{url("/presupuesto_anteproyecto/guardar_requisicion_materiales/".$datos_req_envio->id_req_mat_ante)}}" role="form" method="POST" >
                        {{ csrf_field() }}
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="exampleInputEmail1">Elige partida presupuestal</label>
                                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="partida_presupuestal" name="partida_presupuestal" required>
                                        <option disabled selected hidden>Selecciona una opción</option>
                                        @foreach($partidas_presupuestales as $partida)
                                            <option value="{{$partida->id_partida_pres}}" data-esta="{{$partida->nombre_partida}}">{{$partida->clave_presupuestal }}   {{$partida->nombre_partida }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="exampleInputEmail1">Elige mes de adquisición</label>
                                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="mes" name="mes" required>
                                        <option disabled selected hidden>Selecciona una opción</option>
                                        @foreach($meses as $mes)
                                            <option value="{{$mes->id_mes}}" data-esta="{{$mes->mes}}">{{$mes->mes}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="justificacion">Ingresa justificación</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="justificacion" name="justificacion" rows="3" placeholder="Ingresa juestificación" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="exampleInputEmail1">Elige proyecto</label>
                                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="proyecto" name="proyecto" required>
                                        <option disabled selected hidden>Selecciona una opción</option>
                                        @foreach($proyectos as $proyecto)
                                            <option value="{{$proyecto->id_proyecto}}" data-esta="{{$proyecto->nombre_proyecto }}">{{ $proyecto->nombre_proyecto }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">

                                <label for="exampleInputEmail1">Selecciona meta</label>
                                <div id="meta">

                                </div>

                            </div>
                        </div>




                    </form>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_partida_presupuestal"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>
    {{-- modal modificar requisicion de materiales--}}

    <x-panel.modal id="modal_modificacion_requisicion" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Modificar requisicion de materiales</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_modificacion_requisicion">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_modificacion_requisicion"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>
    {{-- modal eliminae requisicion de materiales--}}

    <x-panel.modal id="modal_eliminar_requisicion" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Eliminar requisicion de materiales</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_eliminar_requisicion">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_eliminar_requisicion"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                    </div>
                </div>
            </x-panel.modal>

    {{-- modal enviar requisiciones --}}

    <x-panel.modal id="modal_enviar_requisiciones" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Enviar requisiciones</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <form id="form_enviar_requisiciones" action="{{url("/presupuesto_anteproyecto/enviar_modificaciones_requisiciones/")}}" method="POST" role="form" >
                        {{ csrf_field() }}
                        <input type="hidden" id="id_req_mat_ante" name="id_req_mat_ante" value="">
                        <h2 class="tw:mb-4 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">¿ Seguro(a) que quieres enviar las modificaciones de las requiciones a la Dirección de administración y finanzas</h2>
                    </form>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_enviar_requisiciones"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                    </div>
                </div>
            </x-panel.modal>


    <script>
        $(document).ready(function() {
            $(".enviar_mod_requisiciones").click(function (){
                var id_req_mat_ante =$(this).attr('id');
                $('#id_req_mat_ante').val(id_req_mat_ante);
                $("#modal_enviar_requisiciones").modal('show');
            });
            $("#guardar_enviar_requisiciones").click(function (){
                $("#form_enviar_requisiciones").submit();
                $("#guardar_enviar_requisiciones").attr("disabled", true);
            });
            $(".eliminar_bien_servicio").click(function (){
                var id_reg_material_ant =$(this).attr('id');
                $.get("/presupuesto_anteproyecto/eliminar_servicio/"+id_reg_material_ant,function (request) {
                    $("#contenedor_eliminar_servicio").html(request);
                    $("#modal_eliminar_servicio").modal('show');
                });
            });
            $("#guardar_eliminar_servicio").click(function (){
                $("#form_mod_bien").submit();
                $("#guardar_eliminar_servicio").attr("disabled", true);
            });
            $(".agregar_bien").click(function (){
                var id_actividades_req_ante =$(this).attr('id');
                $('#id_act_req_ante').val(id_actividades_req_ante);
                $('#modal_crear_bien').modal('show');
            });
            $(".editar_bien_servicio").click(function (){
                var id_reg_material_ant =$(this).attr('id');
                $.get("/presupuesto_anteproyecto/modificar_servicio/"+id_reg_material_ant,function (request) {
                    $("#contenedor_mod_servicio").html(request);
                    $("#modal_mod_servicio").modal('show');
                });

            });
            $("#guardar_mod_servicio").click(function (){
                var bien_servicio = $("#bien_servicio_mod").val();
                if(bien_servicio != ''){
                    var unidad_medida = $("#unidad_medida_mod").val();
                    if( unidad_medida != ''){

                        var cantidad = $("#cantidad_mod").val();

                        if ( cantidad != ''){

                            var precio = $("#precio_mod").val();
                            if ( precio != ''){

                                $("#form_mod_bien").submit();
                                $("#guardar_mod_servicio").attr("disabled", true);
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
                                    title: "Ingresa precio unitario de referencia con iva incluido",
                                    showConfirmButton: false,
                                    timer: 3500
                                });
                            }

                        }else{
                            swal({
                                position: "top",
                                type: "error",
                                title: "Ingresa cantidad correcta",
                                showConfirmButton: false,
                                timer: 3500
                            });
                        }

                    }else{
                        swal({
                            position: "top",
                            type: "error",
                            title: "Ingresa unidad de medida",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }
                }else{
                    swal({
                        position: "top",
                        type: "error",
                        title: "Ingresar el nombre del bien o servicio",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#guardar_bien").click(function (){
                var bien_servicio = $("#bien_servicio").val();
                if(bien_servicio != ''){
                    var unidad_medida = $("#unidad_medida").val();
                    if( unidad_medida != ''){

                        var cantidad = $("#cantidad").val();

                        if ( cantidad != ''){

                            var precio = $("#precio").val();
                            if ( precio != ''){

                                $("#form_agregar_bien").submit();
                                $("#guardar_bien").attr("disabled", true);
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
                                    title: "Ingresa precio unitario de referencia con iva incluido",
                                    showConfirmButton: false,
                                    timer: 3500
                                });
                            }

                        }else{
                            swal({
                                position: "top",
                                type: "error",
                                title: "Ingresa cantidad correcta",
                                showConfirmButton: false,
                                timer: 3500
                            });
                        }

                    }else{
                        swal({
                            position: "top",
                            type: "error",
                            title: "Ingresa unidad de medida",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }
                }else{
                    swal({
                        position: "top",
                        type: "error",
                        title: "Ingresar el nombre del bien o servicio",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#proyecto").change(function (e) {

                var id_proyecto = e.target.value;
                $.get('/presupuesto_anteproyecto/ver_meta/' + id_proyecto, function (data) {

                    $('#meta').empty();
                    $.each(data, function (datos_alumno, subcatObj) {
                        //   TNotify.alert(subcatObj);
                        $('#meta').append('<div class="tw:flex tw:items-center tw:gap-2"><label><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500"  type="radio" name="meta1" value="'+subcatObj.id_meta+'" required>'+subcatObj.meta+'</label></div>');

                    });
                });
            });
            $("#guardar_partida_presupuestal").click(function (){
                var partida_presupuestal = $("#partida_presupuestal").val();
                if(partida_presupuestal != null){
                    var mes = $("#mes").val();
                    if( mes != null){
                        var justificacion = $("#justificacion").val();
                        if(justificacion != ''){
                            var proyecto = $("#proyecto").val();
                            if( proyecto != null){
                                var meta1 =$('input:radio[name=meta1]:checked').val();

                                if(meta1 != undefined){
                                    $("#form_agregar").submit();
                                    $("#guardar_partida_presupuestal").attr("disabled", true);
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
                                        title: "Selecciona meta",
                                        showConfirmButton: false,
                                        timer: 3500
                                    });
                                }
                            }else{
                                swal({
                                    position: "top",
                                    type: "error",
                                    title: "Selecciona proyecto",
                                    showConfirmButton: false,
                                    timer: 3500
                                });
                            }
                        }else{
                            swal({
                                position: "top",
                                type: "error",
                                title: "Ingresa justificación",
                                showConfirmButton: false,
                                timer: 3500
                            });
                        }
                    }
                    else{
                        swal({
                            position: "top",
                            type: "error",
                            title: "Selecciona mes",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }

                }else{
                    swal({
                        position: "top",
                        type: "error",
                        title: "Agregar partida presupuestal",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $(".editar_requisiciones").click(function (){
                var id_actividades_req_ante =$(this).attr('id');

                $.get("/presupuesto_anteproyecto/modificar_requisicion_material/"+id_actividades_req_ante,function (request) {
                    $("#contenedor_modificacion_requisicion").html(request);
                    $("#modal_modificacion_requisicion").modal('show');
                });
            });

            $(".eliminar_requisiciones").click(function (){
                var id_actividades_req_ante =$(this).attr('id');

                $.get("/presupuesto_anteproyecto/eliminar_requisicion_material/"+id_actividades_req_ante,function (request) {
                    $("#contenedor_eliminar_requisicion").html(request);
                    $("#modal_eliminar_requisicion").modal('show');
                });

            });
            $("#guardar_modificacion_requisicion").click(function (){
                var partida_presupuestal = $("#partida_presupuestal_mod").val();
                if(partida_presupuestal != ''){
                    var mes = $("#mes_mod").val();
                    if( mes != null){
                        justificacion_mod
                        var justificacion = $("#justificacion_mod").val();
                        if(justificacion != '') {
                            var proyecto = $("#proyecto_mod").val();
                            if (proyecto != null) {
                                var meta1 = $('input:radio[name=meta_mod]:checked').val();

                                if (meta1 != undefined) {
                                    $("#form_modificar_requisicion").submit();
                                    $("#guardar_modificacion_requisicion").attr("disabled", true);
                                    swal({
                                        position: "top",
                                        type: "success",
                                        title: "Registro exitoso",
                                        showConfirmButton: false,
                                        timer: 3500
                                    });
                                } else {
                                    swal({
                                        position: "top",
                                        type: "error",
                                        title: "Selecciona meta",
                                        showConfirmButton: false,
                                        timer: 3500
                                    });
                                }
                            } else {
                                swal({
                                    position: "top",
                                    type: "error",
                                    title: "Selecciona proyecto",
                                    showConfirmButton: false,
                                    timer: 3500
                                });
                            }
                        }else{
                            swal({
                                position: "top",
                                type: "error",
                                title: "Ingresa justificación",
                                showConfirmButton: false,
                                timer: 3500
                            });
                        }
                    }
                    else{
                        swal({
                            position: "top",
                            type: "error",
                            title: "Selecciona mes",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }

                }else{
                    swal({
                        position: "top",
                        type: "error",
                        title: "Agregar partida presupuestal",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#guardar_eliminar_requisicion").click(function (){

                $("#form_eliminar_requisicion").submit();
                $("#guardar_eliminar_requisicion").attr("disabled", true);
                swal({
                    position: "top",
                    type: "warning",
                    title: "Eliminacion exitosa",
                    showConfirmButton: false,
                    timer: 3500
                });
            });
            $(".agregar_requisicion").click(function (){
                var id_actividades_req_ante =$(this).attr('id');
                $.get("/presupuesto_anteproyecto/agregar_requisicion_pdf/"+id_actividades_req_ante,function (request) {
                    $("#contenedor_agregar_requisicion_pdf").html(request);
                    $("#modal_agregar_requisicion_pdf").modal('show');
                });

            });
            $("#guardar_requisicion_pdf").click(function (){
                var requisicion_pdf = $("#requisicion_pdf").val();
                if( requisicion_pdf != ''){
                    $("#form_guardar_req_pdf").submit();
                    $("#guardar_requisicion_pdf").attr("disabled", true);
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
                var id_actividades_req_ante =$(this).attr('id');
                $.get("/presupuesto_anteproyecto/agregar_anexo1_pdf/"+id_actividades_req_ante,function (request) {
                    $("#contenedor_agregar_anexo1_pdf").html(request);
                    $("#modal_agregar_anexo1_pdf").modal('show');
                });
            });
            $("#guardar_anexo1_pdf").click(function (){
                var anexo1_pdf = $("#anexo1_pdf").val();
                if( anexo1_pdf != ''){
                    $("#form_guardar_anexo1_pdf").submit();
                    $("#guardar_anexo1_pdf").attr("disabled", true);
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
                var id_actividades_req_ante =$(this).attr('id');
                $.get("/presupuesto_anteproyecto/agregar_suficiencia_pdf/"+id_actividades_req_ante,function (request) {
                    $("#contenedor_agregar_suficiencia_pdf").html(request);
                    $("#modal_agregar_suficiencia_pdf").modal('show');
                });
            });
            $("#guardar_suficiencia_pdf").click(function (){
                var suficiencia_pdf = $("#suficiencia_pdf").val();
                if( suficiencia_pdf != ''){
                    $("#form_guardar_deficiencia_pdf").submit();
                    $("#guardar_suficiencia_pdf").attr("disabled", true);
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
                var id_actividades_req_ante =$(this).attr('id');
                $.get("/presupuesto_anteproyecto/agregar_justificacion_pdf/"+id_actividades_req_ante,function (request) {
                    $("#contenedor_agregar_justificacion_pdf").html(request);
                    $("#modal_agregar_justificacion_pdf").modal('show');
                });
            });
            $("#guardar_justificacion_pdf").click(function (){
                var justificacion_pdf = $("#justificacion_pdf").val();

                if(justificacion_pdf != null){
                    if(justificacion_pdf == 1){
                        $("#form_guardar_justificacion_pdf").submit();
                        $("#guardar_justificacion_pdf").attr("disabled", true);
                        swal({
                            position: "top",
                            type: "success",
                            title: "Registro exitoso",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }
                    if(justificacion_pdf == 2){
                        var doc_justificacion_pdf = $("#doc_justificacion_pdf").val();
                        if(doc_justificacion_pdf == ''){
                            swal({
                                position: "top",
                                type: "error",
                                title: "Selecciona documento pdf",
                                showConfirmButton: false,
                                timer: 3500
                            });
                        }else{
                            $("#form_guardar_justificacion_pdf").submit();
                            $("#guardar_justificacion_pdf").attr("disabled", true);
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
            $(".editar_requisicion_pdf").click(function (){
                var id_actividades_req_ante =$(this).attr('id');
                $.get("/presupuesto_anteproyecto/modificar_req_mat_pdf/"+id_actividades_req_ante,function (request) {
                    $("#contenedor_modificar_requisicion_pdf").html(request);
                    $("#modal_modificar_requisicion_pdf").modal('show');
                });
            });
            $("#guardar_mod_requisicion_pdf").click(function (){
                var requisicion_pdf = $("#requisicion_pdf_mod").val();

                if( requisicion_pdf != ''){
                    $("#form_guardar_mod_req_pdf").submit();
                    $("#guardar_mod_requisicion_pdf").attr("disabled", true);
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
            $(".editar_anexo1_pdf").click(function (){
                var id_actividades_req_ante =$(this).attr('id');
                $.get("/presupuesto_anteproyecto/mod_anexo1_pdf/"+id_actividades_req_ante,function (request) {
                    $("#contenedor_mod_anexo1_pdf").html(request);
                    $("#modal_mod_anexo1_pdf").modal('show');
                });
            });
            $("#guardar_mod_anexo1_pdf").click(function (){
                var anexo1_pdf = $("#mod_anexo1_pdf").val();
                if( anexo1_pdf != ''){
                    $("#form_guardar_mod_anexo1_pdf").submit();
                    $("#guardar_mod_anexo1_pdf").attr("disabled", true);
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
            $(".editar_presupuestal_pdf").click(function (){
                var id_actividades_req_ante =$(this).attr('id');
                $.get("/presupuesto_anteproyecto/mod_suficiencia_pdf/"+id_actividades_req_ante,function (request) {
                    $("#contenedor_mod_suficiencia_pdf").html(request);
                    $("#modal_mod_suficiencia_pdf").modal('show');
                });
            });
            $("#guardar_mod_suficiencia_pdf").click(function (){
                var suficiencia_pdf = $("#mod_suficiencia_pdf").val();
                if( suficiencia_pdf != ''){
                    $("#form_guardar_mod_deficiencia_pdf").submit();
                    $("#guardar_mod_suficiencia_pdf").attr("disabled", true);
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
            $(".editar_justificacion_pdf").click(function (){
                var id_actividades_req_ante =$(this).attr('id');
                $.get("/presupuesto_anteproyecto/mod_justificacion_pdf/"+id_actividades_req_ante,function (request) {
                    $("#contenedor_mod_justificacion_pdf").html(request);
                    $("#modal_mod_justificacion_pdf").modal('show');
                });
            });
            $("#guardar_mod_justificacion_pdf").click(function (){
                var justificacion_pdf = $("#mod_justificacion_pdf").val();
                if(justificacion_pdf != null){
                    if(justificacion_pdf == 1){
                        $("#form_guardar_mod_justificacion_pdf").submit();
                        $("#guardar_mod_justificacion_pdf").attr("disabled", true);
                        swal({
                            position: "top",
                            type: "success",
                            title: "Registro exitoso",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }
                    if(justificacion_pdf == 2){
                        var doc_justificacion_pdf = $("#mod_doc_justificacion_pdf").val();
                        if(doc_justificacion_pdf == ''){
                            swal({
                                position: "top",
                                type: "error",
                                title: "Selecciona documento pdf",
                                showConfirmButton: false,
                                timer: 3500
                            });
                        }else{
                            $("#form_guardar_mod_justificacion_pdf").submit();
                            $("#guardar_mod_justificacion_pdf").attr("disabled", true);
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

        });
    </script>
</div>
@endsection