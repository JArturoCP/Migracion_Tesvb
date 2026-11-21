@extends('layouts.panel')
@section('title', 'Notas')

@include('partials.panel.recursos_app')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        .nota-periodo-btn {
            color: #fff;
            text-decoration: none;
            width: 100%;
        }

        .nota-periodo-btn:hover,
        .nota-periodo-btn:focus {
            color: #fff;
            text-decoration: none;
            outline: none;
        }

        .nota-periodo-row td {
            background: #2f6f8f !important;
            color: #fff;
        }

        .nota-periodo-row small {
            color: #eaf6ff;
            font-weight: 600;
        }

        .nota-toggle-container {
            padding: 15px !important;
            background: #f7f7f7;
        }

        .nota-toggle-container .btn {
            min-width: 120px;
            margin: 3px 5px;
        }

        .nota-empty-row {
            background: #fafafa;
            color: #777;
            font-style: italic;
        }

        .nota-acciones .btn {
            margin-bottom: 4px;
        }

        .js-grupo-periodo,
        .js-detalle-nota {
            display: none;
        }
        .acciones-cerradas-box {
            max-width: 900px;
            margin: 20px auto;
            border-left: 6px solid #d9534f;
        }

        .acciones-cerradas-box h4 {
            margin-top: 0;
            font-weight: bold;
        }

    </style>

    <main class="tw-pantalla tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-6/12 tw:lg:ml-[25%] tw:px-2">
                @if (session()->has('flash_notification.message'))
                    <x-panel.alerta class="tw:mb-4" :tipo="['success' => 'exito', 'danger' => 'error', 'warning' => 'advertencia'][session('flash_notification.level')] ?? 'info'">{!! session('flash_notification.message') !!}</x-panel.alerta>
                @endif

                @if(session('success'))
                    <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800">
                        <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700">
                        <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>

        @if(isset($moduloAccionesCerrado) && $moduloAccionesCerrado)
            <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                <div class="acciones-cerradas-box tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700 tw:text-center">
                    <h4>
                        <i class="fa fa-lock"></i>
                        Sistema cerrado
                    </h4>
                    <p style="font-size: 16px; margin-bottom: 0;">
                        {{ $mensajeCierreAcciones ?? 'El sistema fue cerrado. Contacte al líder.' }}
                    </p>
                </div>
            </div>
        @else

            <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                        <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Notas Auditorías</h3>
                    </div>

                    <div class="tw:p-5 tw:sm:p-6">
                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla tw-tabla-bordes">
                            <thead>
                            <tr>
                                <th class="tw:lg:w-4/12">Criterio</th>
                                <th class="tw:lg:w-7/12">Nota</th>
                                <th class="tw:lg:w-1/12 tw:text-center">Acciones</th>
                            </tr>
                            </thead>

                            @forelse($datos_nota as $periodo => $notas)
                                @php
                                    /*
                                     * Se usa únicamente el índice del ciclo para evitar IDs con caracteres especiales.
                                     * Esto corrige el problema del botón NC/OM cuando el periodo contiene guiones,
                                     * espacios o caracteres no compatibles con selectores HTML/JS.
                                     */
                                    $periodoKey = 'periodo-' . $loop->index;
                                    $grupoId = 'grupo-' . $periodoKey;
                                    $ncId = 'nc-' . $periodoKey;
                                    $omId = 'om-' . $periodoKey;

                                    $notasNc = $notas->where('id_clasificacion', 1);
                                    $notasOm = $notas->where('id_clasificacion', 2);
                                @endphp

                                {{-- Fila del periodo --}}
                                <tbody>
                                <tr class="active nota-periodo-row">
                                    <td colspan="3" class="tw:text-center">
                                        <button
                                                type="button"
                                                class="nota-periodo-btn btn-toggle-periodo tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:text-brand-500 tw:hover:underline tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm"
                                                data-target="#{{ $grupoId }}"
                                                data-detalles="#{{ $ncId }}, #{{ $omId }}"
                                                aria-expanded="false">
                                            <h4 class="tw:m-0">
                                                <strong>{{ $periodo }}</strong>
                                                <br>
                                                <small>
                                                    NC: {{ $notasNc->count() }} &nbsp; | &nbsp; OM: {{ $notasOm->count() }}
                                                </small>
                                            </h4>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>

                                {{-- Botones NC / OM --}}
                                <tbody id="{{ $grupoId }}" class="js-grupo-periodo">
                                <tr>
                                    <td colspan="3" class="nota-toggle-container tw:text-center">
                                        <button
                                                type="button"
                                                class="btn-toggle-nota tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm"
                                                data-target="#{{ $ncId }}"
                                                data-other="#{{ $omId }}"
                                                @if($notasNc->count() === 0) disabled @endif>
                                            NC
                                            <span class="tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-sm tw:font-medium">{{ $notasNc->count() }}</span>
                                        </button>

                                        <button
                                                type="button"
                                                class="btn-toggle-nota tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm"
                                                data-target="#{{ $omId }}"
                                                data-other="#{{ $ncId }}"
                                                @if($notasOm->count() === 0) disabled @endif>
                                            OM
                                            <span class="tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-sm tw:font-medium">{{ $notasOm->count() }}</span>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>

                                {{-- Bloque NC --}}
                                <tbody id="{{ $ncId }}" class="js-detalle-nota">
                                @forelse($notasNc as $datos)
                                    @php
                                        $modalId = 'modalObservacion-nc-' . $datos->id_responsable;
                                    @endphp

                                    <tr>
                                        <td>{{ $datos->criterio }} (NC)</td>
                                        <td>{{ $datos->resultado }}</td>
                                        <td class="nota-acciones tw:text-center">
                                            @if($datos->estado == null || $datos->estado == 1 || $datos->estado == 2 || $datos->estado == 5 || $datos->estado == 7)
                                                <a class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm"
                                                   href="{{ url('/auditorias/notas_auditorias', $datos->id_responsable) }}"
                                                   title="Capturar acciones correctivas">
                                                    <span class="fa fa-check-circle"></span>
                                                </a>
                                            @endif

                                            @if($datos->estado == 5 || $datos->estado == 7)
                                                <button
                                                        type="button"
                                                        class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm"
                                                        data-toggle="modal"
                                                        data-target="#{{ $modalId }}"
                                                        title="Observaciones">
                                                    <i class="fa fa-eye"></i>
                                                </button>

                                                <x-panel.modal id="{{ $modalId }}" tamano="md" sin-relleno clase-cerrar="close">
                                                            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                                                <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800">Observaciones</h5>
                                                                
                                                            </div>

                                                            <div class="tw-modal-cuerpo tw:text-left">
                                                                @if($datos->estado == 5)
                                                                    {{ $datos->observaciones_responsable ?? 'Sin observaciones registradas.' }}
                                                                @elseif($datos->estado == 7)
                                                                    {{ $datos->observaciones_lideres ?? 'Sin observaciones registradas.' }}
                                                                @endif
                                                            </div>

                                                            <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                                                <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">
                                                                    Cerrar
                                                                </button>
                                                            </div>
                                                        
                                                    
                                                </x-panel.modal>
                                            @endif

                                            @switch($datos->estado)
                                                @case(3)
                                                    <span class="tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:bg-gray-100 tw:text-gray-700">Enviado</span>
                                                    @break
                                                @case(6)
                                                    <span class="tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:bg-green-50 tw:text-green-700">Aceptado</span>
                                                    @break
                                                @case(7)
                                                    <span class="tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:bg-red-50 tw:text-red-600">Rechazado</span>
                                                    @break
                                                @case(5)
                                                    <span class="tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:bg-amber-50 tw:text-amber-700">Con observaciones</span>
                                                    @break
                                                @default
                                                    <span class="tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:bg-sky-50 tw:text-sky-600">Pendiente</span>
                                            @endswitch
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="nota-empty-row">
                                        <td colspan="3" class="tw:text-center">No hay No Conformidades en este periodo.</td>
                                    </tr>
                                @endforelse
                                </tbody>

                                {{-- Bloque OM --}}
                                <tbody id="{{ $omId }}" class="js-detalle-nota">
                                @forelse($notasOm as $datos)
                                    @php
                                        $modalId = 'modalObservacion-om-' . $datos->id_responsable;
                                    @endphp

                                    <tr>
                                        <td>{{ $datos->criterio }} (OM)</td>
                                        <td>{{ $datos->resultado }}</td>
                                        <td class="nota-acciones tw:text-center">
                                            @if($datos->estado == null || $datos->estado == 1 || $datos->estado == 2 || $datos->estado == 5 || $datos->estado == 7)
                                                <a class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm"
                                                   href="{{ url('/auditorias/notas_auditorias', $datos->id_responsable) }}"
                                                   title="Capturar oportunidad de mejora">
                                                    <span class="fa fa-check-circle"></span>
                                                </a>
                                            @endif

                                            @if($datos->estado == 5 || $datos->estado == 7)
                                                <button
                                                        type="button"
                                                        class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm"
                                                        data-toggle="modal"
                                                        data-target="#{{ $modalId }}"
                                                        title="Observaciones">
                                                    <i class="fa fa-eye"></i>
                                                </button>

                                                <x-panel.modal id="{{ $modalId }}" tamano="md" sin-relleno clase-cerrar="close">
                                                            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                                                <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800">Observaciones</h5>
                                                                
                                                            </div>

                                                            <div class="tw-modal-cuerpo tw:text-left">
                                                                @if($datos->estado == 5)
                                                                    {{ $datos->observaciones_responsable ?? 'Sin observaciones registradas.' }}
                                                                @elseif($datos->estado == 7)
                                                                    {{ $datos->observaciones_lideres ?? 'Sin observaciones registradas.' }}
                                                                @endif
                                                            </div>

                                                            <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                                                <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">
                                                                    Cerrar
                                                                </button>
                                                            </div>
                                                        
                                                    
                                                </x-panel.modal>
                                            @endif

                                            @switch($datos->estado)
                                                @case(3)
                                                    <span class="tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:bg-gray-100 tw:text-gray-700">Enviado</span>
                                                    @break
                                                @case(6)
                                                    <span class="tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:bg-green-50 tw:text-green-700">Aceptado</span>
                                                    @break
                                                @case(7)
                                                    <span class="tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:bg-red-50 tw:text-red-600">Rechazado</span>
                                                    @break
                                                @case(5)
                                                    <span class="tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:bg-amber-50 tw:text-amber-700">Con observaciones</span>
                                                    @break
                                                @default
                                                    <span class="tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:bg-sky-50 tw:text-sky-600">Pendiente</span>
                                            @endswitch
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="nota-empty-row">
                                        <td colspan="3" class="tw:text-center">No hay Oportunidades de Mejora en este periodo.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            @empty
                                <tbody>
                                <tr>
                                    <td colspan="3" class="tw:text-center">No hay notas asignadas.</td>
                                </tr>
                                </tbody>
                            @endforelse
                        </table>
</div>
                    </div>
                </div>
            </div>
        @endif
    </main>

    <script>
        $(document).ready(function () {
            $('.btn-toggle-periodo').on('click', function (event) {
                event.preventDefault();

                var target = $(this).data('target');
                var detalles = $(this).data('detalles');
                var $target = $(target);

                if ($target.is(':visible')) {
                    $target.hide();
                    $(detalles).hide();
                    $(this).attr('aria-expanded', 'false');
                } else {
                    $target.show();
                    $(this).attr('aria-expanded', 'true');
                }
            });

            $('.btn-toggle-nota').on('click', function (event) {
                event.preventDefault();

                var target = $(this).data('target');
                var other = $(this).data('other');
                var $target = $(target);

                $(other).hide();

                if ($target.is(':visible')) {
                    $target.hide();
                } else {
                    $target.show();
                }
            });
        });
    </script>
@endsection
