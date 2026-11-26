@extends('layouts.panel')
@section('title', 'Requisiciones del departamento')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado :titulo="'Agregar presupuesto a la requisición del departamento o jefatura de división del año '.$year.' Nombre del departamento o jefatura: '.$unidad->nom_departamento.' Nombre del jefe: '.$unidad->titulo.' '.$unidad->nombre" :migas="['Finanzas' => null]" />

    @if($estado_anteproyecto == 1)
        <x-panel.alerta tipo="advertencia" class="tw:mb-4"><h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">Sin requisiciones autorizadas del anteproyecto {{ $year }}</h4></x-panel.alerta>
    @endif
    @if($estado_anteproyecto == 2)
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">Requisiciones autorizadas del anteproyecto {{ $year }}</h4>
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                        <thead>
                        <tr>
                            <th>CLAVE PRESUPUESTAL</th>
                            <th>DENOMINACIÓN</th>
                            <th>MATERIALES O SERVICIO</th>
                            <th>TOTAL</th>
                            <th>MES</th>
                            <th>AUTORIZAR</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($array_requisiciones as $requisicion)
                        <tr>
                            <td>{{ $requisicion['clave_presupuestal'] }}</td>
                            <td>{{ $requisicion['nombre_partida'] }}</td>
                            <td>
                                    <?php
                                    $total_req=0;
                                    ?>
                                    @foreach($requisicion['materiales'] as $material)
                                        <?php
                                            $importe=$material['cantidad']*$material['precio_unitario'];
                                        $total_req=$total_req+$importe;
                                        ?>
                                    <x-panel.alerta tipo="exito" class="tw:mb-4"><b class="tw:text-gray-800 tw:dark:text-white/90">Materiales o servicios:  </b> <i class="tw:text-base tw:text-blue-700 tw:dark:text-blue-400">{{ $material['descripcion'] }}</i> <b class="tw:text-gray-800 tw:dark:text-white/90">Cantidad:  </b> <i class="tw:text-lg tw:text-blue-700 tw:dark:text-blue-400">{{ $material['cantidad'] }} </i><b class="tw:text-gray-800 tw:dark:text-white/90">Precio unitario: </b> <i class="tw:text-lg tw:text-blue-700 tw:dark:text-blue-400">{{ number_format($material['precio_unitario'], 2, '.', ',')  }}</i> <b class="tw:text-red-600 tw:dark:text-red-400">Importe:</b><i class="tw:text-lg tw:text-blue-700 tw:dark:text-blue-400">{{ number_format($importe, 2, '.', ',')  }}</i></x-panel.alerta>
                                    @endforeach
                                </ul>
                            </td>
                            <td><b>{{ number_format($total_req, 2, '.', ',')  }}</b>
                            </td>
                                @if($requisicion['id_mes'] == 1)
                                    <td>Enero</td>
                                @endif
                                @if($requisicion['id_mes'] == 2)
                                    <td>Febrero</td>
                                @endif
                                @if($requisicion['id_mes'] == 3)
                                    <td>Marzo</td>
                                @endif
                                @if($requisicion['id_mes'] == 4)
                                    <td>Abril</td>
                                @endif
                                @if($requisicion['id_mes'] == 5)
                                    <td>Mayo</td>
                                @endif
                                @if($requisicion['id_mes'] == 6)
                                    <td>Junio</td>
                                @endif
                                @if($requisicion['id_mes'] == 7)
                                    <td>Julio</td>
                                @endif
                                @if($requisicion['id_mes'] == 8)
                                    <td>Agosto</td>
                                @endif
                                @if($requisicion['id_mes'] == 9)
                                    <td>Septiembre</td>
                                @endif
                                @if($requisicion['id_mes'] == 10)
                                    <td>Octubre</td>
                                @endif
                                @if($requisicion['id_mes'] == 11)
                                    <td>Noviembre</td>
                                @endif
                                @if($requisicion['id_mes'] == 12)
                                    <td>Diciembre</td>
                                @endif
                            <td> <button data-toggle="tooltip" data-placement="top" id="{{$requisicion['id_actividades_req_ante'] }}" title="Autorizar requisición" class="h-primary_m autorizar_req tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap">Autorizar requisición</button>
                            </td>

                        </tr>
                        @endforeach

                        </tbody>
                    </table>
</div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <button data-toggle="modal"  data-tooltip="true" data-placement="left" title="Agregar nueva solicitud" data-target="#modal_agregar_solicitud" type="button" class="flotante tw:fixed tw:right-6 tw:bottom-6 tw:z-40 tw:inline-flex tw:size-14 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-xl tw:text-white tw:shadow-theme-lg tw:hover:bg-brand-600">
                <span class="fa fa-plus" aria-hidden="true"></span>
            </button>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:p-5 tw:sm:p-6">
                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">Solicitudes de partidas presupuestales</h4>
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                        <thead>
                        <tr>
                            <th>NO. SOLICITUD</th>
                            <th>PARTIDAS PRESUPUESTALES</th>
                            <th>TOTAL</th>
                            <th>ENVIAR</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($array_solicitudes as $solicitud)
                        <tr>

                            <td>
                                @if($solicitud['id_estado_enviado'] == 0)
                                <p class="tw:text-right"> <button class="eliminar_solicitud tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base"  data-id="{{ $solicitud['id_solicitud']}}"><span class="fa fa-trash em8"data-toggle="tooltip" title="Eliminar solicitud" aria-hidden="true"></span></button></p>
                                @endif
                                NÚMERO DE SOLICITUD: <b>{{ $solicitud['numero_solicitud'] }}</b> <br>
                            NOMBRE DEL PROYECTO: <b>{{ $solicitud['nombre_proyecto'] }} </b><br>
                            MES: <b>{{ $solicitud['mes'] }} </b><br>
                            META: <b>{{ $solicitud['meta'] }}</b><br>
                            DESCRIPCIÓN DE LA SOLICITUD: <b>{{ $solicitud['descripcion_solicitud'] }}</b>


                        </td>
                        <td>
                            @if($solicitud['id_estado_enviado'] == 0)
                            <p class="tw:text-right">  <button title="Agregar partida presupuestal" id="{{ $solicitud['id_solicitud'] }}"   type="button" class="agregar_partida tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><span class="fa fa-plus" aria-hidden="true"></span></button></p>
                            @endif
                                @if($solicitud['contar_partidas'] == 0)
                                    <?php $suma_total=0; ?>
                                 <p><x-panel.alerta tipo="error" class="tw:mb-4">
                               No se ha agregado ninguna partida.
                                </x-panel.alerta></p>
                                @else
                                    <?php $suma_total=0; ?>
                                @foreach($solicitud['partidas'] as $partida)
                                        <?php $suma_total=$suma_total+$partida['presupuesto_dado']; ?>
                                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                        <div class="tw:p-5 tw:sm:p-6">
                                            <p>{{ $partida['clave_presupuestal'] }} {{ $partida['nombre_partida'] }}</p>
                                            @if($partida['id_tipo_requisicion'] == 1)
                                                <p>PRESUPUESTO PEDIDO: <b>${{ number_format( $partida['importe_total'], 2, '.', ',')}}</b></p>
                                            @endif
                                            <p>PRESUPUESTO DADO: <b>${{ number_format( $partida['presupuesto_dado'], 2, '.', ',')}}</b>
                                                @if($solicitud['id_estado_enviado'] == 0)
                                                <a class="editar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-id="{{ $partida['id_solicitud_partida']}}"><span class="fa fa-pencil-square-o " aria-hidden="true"></span></a>
                                                @endif
                                            </p>
                                            <p>TIPO DE SOLICITUD: @if($partida['id_tipo_requisicion'] == 1)<b>ANTEPROYECTO</b>@endif @if($partida['id_tipo_requisicion'] == 2)<b>PROYECTO AUTORIZADO</b>@endif
                                            </p>
                                            @if($solicitud['id_estado_enviado'] == 0)
                                            <p class="tw:text-center"> <button class="eliminar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" data-id="{{ $partida['id_solicitud_partida']}}"><span class="fa fa-trash em8"data-toggle="tooltip" title="Eliminar partida" aria-hidden="true"></span></button></p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                                @endif
                        </td>
                        <td> <b>${{   number_format( $suma_total, 2, '.', ',')}} </b></td>
                            @if($solicitud['id_estado_enviado'] == 0)
                        <td><button data-toggle="tooltip" data-placement="top" id="{{$solicitud['id_solicitud'] }}" title="Enviar solicitud" class="h-primary_m enviar_solicitud tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap">Enviar solicitud</button>
                        </td>
                            @endif
                            @if($solicitud['id_estado_enviado'] == 1)
                                <td>Se envio correctamente la solicitud</td>
                            @endif

                        </tr>
                            @endforeach
                        </tbody>
                    </table>
</div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal autorizacion de requisición--}}

    <x-panel.modal id="modal_aut_req" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Autorizar requisición</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_aut_req">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="aceptar_aut_req"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                    </div>
                </div>
            </x-panel.modal>
    {{-- modal agregar solicitud--}}

    <x-panel.modal id="modal_agregar_solicitud" tamano="xl" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar solicitud</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <form id="form_guardar_nueva_solicitud" class="" action="{{url("/presupuesto_autorizado/guardar_nueva_solicitud/".$year."/".$id_unidad_admin )}}" role="form" method="POST" >
                        {{ csrf_field() }}
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label>Ingresar descripcion solicitud</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="descripcion_solicitud" name="descripcion_solicitud" rows="3" onkeyup="javascript:this.value=this.value.toUpperCase();" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="exampleInputEmail1">Selecciona mes</label>
                                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="id_mes" name="id_mes" required>
                                        <option disabled selected hidden>Selecciona una opción</option>
                                        @foreach($meses as $mes)
                                            <option value="{{ $mes->id_mes }}" data-esta="{{ $mes->mes }}">{{ $mes->mes }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="exampleInputEmail1">Selecciona proyecto</label>
                                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="id_proyecto" name="id_proyecto" required>
                                        <option disabled selected hidden>Selecciona una opción</option>
                                        @foreach($proyectos as $proyecto)
                                            <option value="{{ $proyecto->id_proyecto }}" data-esta="{{ $proyecto->nombre_proyecto }}">{{ $proyecto->nombre_proyecto }} </option>
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
                        <button id="guardar_agregar_solicitud"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                    </div>
                </div>
            </x-panel.modal>
    {{-- modal agregar partida--}}

    <x-panel.modal id="modal_agregar_partida" tamano="xl" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar partida presupuestal a la solicitud</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <form id="form_agregar_partida_solicitud" class="" action="{{url("/presupuesto_autorizado/guardar_partida_solicitud/")}}" role="form" method="POST" >
                        {{ csrf_field() }}
                    <div id="contenedor_agregar_partida">

                    </div>
                    </form>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="aceptar_agregar_partida"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                    </div>
                </div>
            </x-panel.modal>
    {{-- modal enviar solicitud--}}

    <x-panel.modal id="modal_enviar_solicitud" tamano="xl" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Enviar solicitud</h4>
                </div>
                <div class="tw-modal-cuerpo">

                        <div id="contenedor_enviar_solicitud">

                        </div>


                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="aceptar_enviar_solicitud"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                    </div>
                </div>
            </x-panel.modal>

    {{-- modal editar presupuesto--}}

    <x-panel.modal id="modal_editar_pre" tamano="xl" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Editar presupuesto dado</h4>
                </div>
                <div class="tw-modal-cuerpo">

                    <div id="contenedor_editar_pre">

                    </div>


                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="aceptar_editar_pre"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                    </div>
                </div>
            </x-panel.modal>
    {{-- modal eliminar partida--}}

    <x-panel.modal id="modal_eliminar_partida" tamano="xl" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Eliminar partida presupuestal de la solicitud</h4>
                </div>
                <div class="tw-modal-cuerpo">

                    <div id="contenedor_eliminar_partida">

                    </div>


                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="aceptar_eliminar_partida_sol"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                    </div>
                </div>
            </x-panel.modal>
    {{-- modal eliminar solicitud--}}

    <x-panel.modal id="modal_eliminar_solicitud" tamano="xl" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Eliminar solicitud</h4>
                </div>
                <div class="tw-modal-cuerpo">

                    <div id="contenedor_eliminar_solicitud">

                    </div>


                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="aceptar_eliminar_solicitud"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                    </div>
                </div>
            </x-panel.modal>
    <script>
        $(document).ready(function() {
            $(".eliminar_solicitud").click(function (){
                var id_solicitud = $(this).data('id');

                $.get("/presupuesto_autorizado/eliminacion_solicitud/" + id_solicitud, function (request) {
                    $("#contenedor_eliminar_solicitud").html(request);
                    $("#modal_eliminar_solicitud").modal('show');
                });
            });
            $("#aceptar_eliminar_solicitud").click(function (){
                $("#form_guardar_eliminacion_solicitud").submit();
                $("#aceptar_eliminar_solicitud").attr("disabled", true);
            });

            $("#aceptar_eliminar_partida_sol").click(function (){
                $("#form_eliminar_partida_solicitud").submit();
                $("#aceptar_eliminar_partida_sol").attr("disabled", true);
            });
            $(".eliminar").click(function (){
                var id_solicitud_partida = $(this).data('id');
                $.get("/presupuesto_autorizado/eliminacion_partida_solicitud/" + id_solicitud_partida, function (request) {
                    $("#contenedor_eliminar_partida").html(request);
                    $("#modal_eliminar_partida").modal('show');
                });
            });

            $("#aceptar_editar_pre").click(function (){
                var estado_pre = $('#estado_pre').val();

                if(estado_pre == 1){
                    swal({
                        position: "top",
                        type: "error",
                        title: "No hay presupuesto en el mes en esta partida",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
                if(estado_pre == 2){
                    var resto_pres =$('#resto_pres').val();
                    var pres_dar =$('#pres_dar').val();
                     var resta_presupuesto = resto_pres - pres_dar;
                    if( resta_presupuesto < 0 ){
                        swal({
                            position: "top",
                            type: "error",
                            title: "No alcanza el presupuesto autorizado del mes de esta partida",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    } else{
                        $("#form_guardar_presupuesto_dado").submit();
                        $("#aceptar_editar_pre").attr("disabled", true);

                    }
                }



            });
            $(".editar").click(function () {
                var id_solicitud_partida = $(this).data('id');

                $.get("/presupuesto_autorizado/editar_presupuesto_partida_dep/" + id_solicitud_partida, function (request) {
                    $("#contenedor_editar_pre").html(request);
                    $("#modal_editar_pre").modal('show');
                });
            });
            $("#id_proyecto").change(function (e) {

                var id_proyecto = e.target.value;
                $.get('/presupuesto_anteproyecto/ver_meta/' + id_proyecto, function (data) {

                    $('#meta').empty();
                    $.each(data, function (datos_alumno, subcatObj) {
                        //   TNotify.alert(subcatObj);
                        $('#meta').append('<div class="tw:flex tw:items-center tw:gap-2"><label><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500"  type="radio" name="meta1" value="'+subcatObj.id_meta+'" required>'+subcatObj.meta+'</label></div>');

                    });
                });
            });

            $(".enviar_solicitud").click(function (){
                var id_solicitud = $(this).attr('id');
                $.get("/presupuesto_autorizado/enviar_solicitud_departamento/"+id_solicitud,function (request) {
                    $("#contenedor_enviar_solicitud").html(request);
                    $("#modal_enviar_solicitud").modal('show');
                });
            });
            $("#aceptar_enviar_solicitud").click(function (){
                var contar_req = $('#contar_req').val();
                var presupuesto_dado = $('#presupuesto_dado').val();
                if( contar_req == 0){
                    swal({
                        position: "top",
                        type: "error",
                        title: "No tiene requisiciones registradas",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }else{
                    if(presupuesto_dado > 0){
                        swal({
                            position: "top",
                            type: "error",
                            title: "No se le ha agregado presupuesto alguna requisición",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }else{
                        $("#form_enviar_partida_solicitud").submit();
                        $("#aceptar_enviar_solicitud").attr("disabled", true);
                    }

                }

            })
            $(".autorizar_req").click(function () {

                var id_actividades_req_ante = $(this).attr('id');
                $.get("/presupuesto_autorizado/departamento_ver_pres_autorizar/"+id_actividades_req_ante,function (request) {
                    $("#contenedor_aut_req").html(request);
                    $("#modal_aut_req").modal('show');
                });

            });
            $("#aceptar_aut_req").click(function (){
                var des_solicitud = $('#des_solicitud').val();

                if(des_solicitud != '')
                {
                    $("#form_guardar_aut_req").submit();
                    $("#aceptar_aut_req").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "error",
                        title: "Ingresar descripción de la solicitud",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }

            });
            $("#guardar_agregar_solicitud").click(function (){
                var id_proyecto = $('#id_proyecto').val();
                var descripcion_solicitud = $('#descripcion_solicitud').val();
                var id_mes = $('#id_mes').val();
                var id_meta = $('input:radio[name=meta1]:checked').val();


                    if(descripcion_solicitud == ''){
                        swal({
                            position: "top",
                            type: "error",
                            title: "Ingresar descripción de la solicitud",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }else {
                        if(id_mes == null){
                            swal({
                                position: "top",
                                type: "error",
                                title: "Selecciona  mes",
                                showConfirmButton: false,
                                timer: 3500
                            });
                        }else{
                        if(id_proyecto == null){
                            swal({
                                position: "top",
                                type: "error",
                                title: "Selecciona  proyecto",
                                showConfirmButton: false,
                                timer: 3500
                            });
                        }else {
                            if (id_meta != undefined) {
                                $("#form_guardar_nueva_solicitud").submit();
                                $("#guardar_agregar_solicitud").attr("disabled", true);
                            } else {
                                swal({
                                    position: "top",
                                    type: "error",
                                    title: "Selecciona meta",
                                    showConfirmButton: false,
                                    timer: 3500
                                });
                            }
                        }
                    }
                }

            });
            $(".agregar_partida").click(function (){
                var id_solicitud = $(this).attr('id');
                $.get("/presupuesto_autorizado/agregar_partida_solicitud/"+id_solicitud,function (request) {
                    $("#contenedor_agregar_partida").html(request);
                    $("#modal_agregar_partida").modal('show');
                });
            });
            $("#aceptar_agregar_partida").click(function (){

                var id_presupuesto_aut_copia = $('#id_presupuesto_aut_copia').val();

                var id_estado_sobrante = $('#id_estado_sobrante').val();

                var presupuesto_s = $('#presupuesto_s').val();
                var presupuesto_dar = $('#presupuesto_dar').val();


                    if (id_presupuesto_aut_copia == null) {
                        swal({
                            position: "top",
                            type: "error",
                            title: "Selecciona  partida presupuestal",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    } else {

                            if (id_estado_sobrante == 2) {
                                swal({
                                    position: "top",
                                    type: "error",
                                    title: "No alcanza el presupuesto",
                                    showConfirmButton: false,
                                    timer: 3500
                                });
                            }
                            if (id_estado_sobrante == 1) {
                                var var_resultado = presupuesto_s - presupuesto_dar;
                                if (var_resultado >= 0 ) {
                                    if(presupuesto_dar != '') {
                                        $("#form_agregar_partida_solicitud").submit();
                                        $("#aceptar_agregar_partida").attr("disabled", true);
                                    } else {
                                        swal({
                                            position: "top",
                                            type: "error",
                                            title: "Ingresa el presupuesto a dar",
                                            showConfirmButton: false,
                                            timer: 3500
                                        });
                                    }

                                } else {
                                    swal({
                                        position: "top",
                                        type: "error",
                                        title: "No alcanza el presupuesto",
                                        showConfirmButton: false,
                                        timer: 3500
                                    });
                                }
                    }
                }
            });
        });
    </script>


</div>
@endsection