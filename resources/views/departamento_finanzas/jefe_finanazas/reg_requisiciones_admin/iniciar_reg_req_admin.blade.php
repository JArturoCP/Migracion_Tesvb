@extends('layouts.panel')
@section('title', 'Requisicion de materiales')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <p>
                <span class="fa fa-arrow-right"></span>
                <a class="tw:text-brand-500 tw:hover:underline" href="{{url("/presupuesto_anteproyecto/proyecto_inicio_anteproyecto/".$proyecto->id_presupuesto)}}">Menu del proyecto del anteproyecto </a>
                <span class="fa fa-chevron-right"></span>
                <span>Actividades de requisiciones del anteproyecto .</span>
            </p>
        </div>
    </div>
    <x-panel.encabezado :titulo="'Requisiciones de materiales del proyecto '.$proyecto->nombre_proyecto.' del anteproyecto del '.$proyecto->year" :migas="['Finanzas' => null]" />
    @if($estado_registro == 0)
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:text-center tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                    <div class="tw:p-5 tw:sm:p-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-toggle="modal" data-target="#modal_envia_requisicion">INICIAR REGISTRO DE REQUSICIONES DE MATERIALES</button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <button data-toggle="modal"  data-tooltip="true" data-placement="left" title="Agregar nueva requisición de materiales" data-target="#modal_crear_requisicion" type="button" class="flotante tw:fixed tw:right-6 tw:bottom-6 tw:z-40 tw:inline-flex tw:size-14 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-xl tw:text-white tw:shadow-theme-lg tw:hover:bg-brand-600">
                    <span class="fa fa-plus" aria-hidden="true"></span>
                </button>
            </div>

            <p class="tw:w-full"><br></p>
        </div>
        @foreach($requisiciones2 as $requisicion)
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                            @if($requisicion['id_autorizacion'] == 4)
                                <x-panel.alerta tipo="exito" class="tw:mb-4"><h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">Requisición autorizada</h4></x-panel.alerta>

                            @else
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:px-2">
                                    <button title="Modificar requisicion de materiales" id="{{ $requisicion['id_actividades_req_ante'] }}"  class="editar_requisiciones tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" ><span class="fa fa-cog" aria-hidden="true"></span></button>
                                    <button title="Eliminar requisicion de materiales" id="{{ $requisicion['id_actividades_req_ante'] }}"  class="eliminar_requisiciones tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" ><span class="fa fa-trash" aria-hidden="true"></span></button>
                                </div>
                            </div>
                            @endif

                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:px-2">
                                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center tw:text-gray-800 tw:dark:text-white/90">PARTIDA PRESUPUESTAL: <b>{{ $requisicion['nombre_partida'] }}</b></h4>
                                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center tw:text-gray-800 tw:dark:text-white/90">MES: <b>{{ $requisicion['mes'] }}</b></h4>
                                    <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300 tw:text-center tw:text-gray-800 tw:dark:text-white/90">JUSTIFICACIÓN: <b>{{ $requisicion['justificacion'] }}</b></h5>
                                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center tw:text-gray-800 tw:dark:text-white/90">PROYECTO: <b>{{ $requisicion['nombre_proyecto'] }}</b></h4>
                                    <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300 tw:text-center tw:text-gray-800 tw:dark:text-white/90">META: <b>{{ $requisicion['meta'] }}</b></h5>
                                </div>
                            </div>
                            @if($requisicion['id_autorizacion'] == 4)
                                @else
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:px-2">
                                    <button class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" onclick="window.location='{{ url('/presupuesto_anteproyecto/agregar_bienes_servicios_ant_admin/'.$requisicion['id_actividades_req_ante'] ) }}'">Agregar documentación o bienes o servicios, etc.</button>
                                </div>

                            </div>
                            @endif

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

                                                    <a  target="_blank" href="/finanzas/cotizaciones/{{ $requisicion['requisicion_pdf'] }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>

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
                                                                    //$precio_unitario= money_format('%n',$precio_unitario);
                                                                    ?>
                                                                <td class="tw:text-right"><h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">${{ $precio_unitario}}</h3></td>
                                                                    <?php
                                                                    $importe=$servicio['importe'];
                                                                  //  $importe= money_format('%n',$importe);
                                                                    ?>
                                                                <td class="tw:text-right"><h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">$ {{ $importe }}</h3></td>


                                                            </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td class="tw:text-right" colspan="5"> <h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Total importe</h3></td>
                                                                <?php

                                                               // $total_req= "$".number_format($requisicion['total_importe'], 2, '.', ',');
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

                @endforeach


        {{-- modal crear requisicion del proyecto--}}

        <x-panel.modal id="modal_crear_requisicion" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar nueva requisición de materiales</h4>
                    </div>
                    <div class="tw-modal-cuerpo">

                        <form id="form_agregar_requisicion" class="" action="{{url("/presupuesto_anteproyecto/guardar_req_mat_admin/".$requerimiento_material->id_req_mat_ante)}}" role="form" method="POST" >
                            {{ csrf_field() }}
                            <input type="hidden" id="id_presupuesto" name="id_presupuesto" value="{{ $proyecto->id_presupuesto}}">

                            <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Nombre del proyecto: {{ $proyecto->nombre_proyecto }}</h3>

                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:px-2">
                                    <div class="tw:mb-4">
                                        <label for="exampleInputEmail1">Elige mes de adquisición</label>
                                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="id_mes" name="id_mes" required>
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
                                        <label for="exampleInputEmail1">Elige partida presupuestal</label>
                                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="id_partida_pres" name="id_partida_pres" required>
                                            <option disabled selected hidden>Selecciona una opción</option>
                                            @foreach($partidas as $partida)
                                                <option value="{{$partida['id_partida_pres']}}" data-esta="{{$partida['nombre_partida']}}">{{$partida['clave_presupuestal']}} {{$partida['nombre_partida']}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:px-2">
                                    <div class="tw:mb-4">
                                        <label for="exampleInputEmail1">Elige partida presupuestal</label>
                                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="id_meta" name="id_meta" required>
                                            <option disabled selected hidden>Selecciona una opción</option>
                                            @foreach($metas as $meta)
                                                <option value="{{$meta->id_meta}}" data-esta="{{$meta->meta}}">{{$meta->meta}} </option>
                                            @endforeach
                                        </select>
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
        {{-- fin del modal crear requisicion del proyecto--}}
    @endif
    {{--modal de registro de requisiciones--}}
    <x-panel.modal id="modal_envia_requisicion" tamano="md" sin-relleno clase-cerrar="close">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Notificación de inicio de registro de requisiciones</h4>
                </div>
                <form id="form_envio" class="" action="{{url("/presupuesto_anteproyecto/registrar_inicio_req_ant_admin/".$proyecto->id_presupuesto)}}" role="form" method="POST" >
                    {{ csrf_field() }}
                    <div class="tw-modal-cuerpo">
                        <p>Iniciar registro de requisiciones de materiales </p>
                    </div>
                </form>
                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                    <button id="guardar_envio"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                </div>
            </x-panel.modal>
    {{-- modal fin de registro de requisiciones--}}

                {{-- modal modificar requisicion de materiales--}}

                <x-panel.modal id="modal_mod_req" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                
                                <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Modificar requisicion de materiales</h4>
                            </div>
                            <div class="tw-modal-cuerpo">
                                <div id="contenedor_mod_req">

                                </div>

                                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                                    <button id="guardar_mod_req"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                </div>
                            </div>
                        </x-panel.modal>
                {{-- fin modal modificar requisicion de materiales--}}

                {{-- modal eliminar requisicion de materiales--}}

                <x-panel.modal id="modal_eliminar_req" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                
                                <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Eliminar requisicion de materiales</h4>
                            </div>
                            <div class="tw-modal-cuerpo">
                                <div id="contenedor_eliminar_req">

                                </div>

                                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                                    <button id="guardar_eliminar_req"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                                </div>
                            </div>
                        </x-panel.modal>
                {{--fin modal eliminar requisicion--}}


                                <script type="text/javascript">
                                    $(document).ready( function() {
                                        $("#guardar_envio").click(function (){
                                            $("#form_envio").submit();
                                            $("#guardar_envio").attr("disabled", true);
                                        });
                                        $(".editar_requisiciones").click(function (){
                                            var id_actividades_req_ante =$(this).attr('id');

                                            $.get("/presupuesto_anteproyecto/mod_requisicion_mat_admin/"+id_actividades_req_ante+"/{{ $proyecto->id_presupuesto }}",function (request) {
                                                $("#contenedor_mod_req").html(request);
                                                $("#modal_mod_req").modal('show');
                                            });
                                        });
                                        $("#guardar_partida_presupuestal").click(function (){
                                            var id_mes = $("#id_mes").val();
                                            if(id_mes != null){
                                                var justificacion = $("#justificacion").val();
                                                if(justificacion !=''){
                                                    var id_partida_pres = $("#id_partida_pres").val();
                                                    if(id_partida_pres != null){
                                                        var id_meta = $("#id_meta").val();
                                                        if(id_meta != null){
                                                            $("#form_agregar_requisicion").submit();
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
                                                            title: "Selecciona partida presupuestal",
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

                                            }else{
                                                swal({
                                                    position: "top",
                                                    type: "error",
                                                    title: "Selecciona mes",
                                                    showConfirmButton: false,
                                                    timer: 3500
                                                });
                                            }
                                        });
                                        $("#guardar_mod_req").click(function (){
                                            $("#form_modificar_requisicion").submit();
                                            $("#guardar_mod_req").attr("disabled", true);
                                        });
                                        $(".eliminar_requisiciones").click(function (){
                                            var id_actividades_req_ante =$(this).attr('id');

                                            $.get("/presupuesto_anteproyecto/eliminar_requisicion_material/"+id_actividades_req_ante,function (request) {
                                                $("#contenedor_eliminar_req").html(request);
                                                $("#modal_eliminar_req").modal('show');
                                            });

                                        });
                                        $("#guardar_eliminar_req").click(function (){

                                            $("#form_eliminar_requisicion").submit();
                                            $("#guardar_eliminar_req").attr("disabled", true);
                                            swal({
                                                position: "top",
                                                type: "warning",
                                                title: "Eliminacion exitosa",
                                                showConfirmButton: false,
                                                timer: 3500
                                            });
                                        });
                                    });
                                </script>


                    </div>
@endsection