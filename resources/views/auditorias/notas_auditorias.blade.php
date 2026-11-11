@extends('layouts.app')

@section('title', 'Notas')

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

    <main class="col-md-12">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @if (session()->has('flash_notification.message'))
                    <div class="alert alert-{{ session('flash_notification.level') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {!! session('flash_notification.message') !!}
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>

        @if(isset($moduloAccionesCerrado) && $moduloAccionesCerrado)
            <div class="col-md-10 col-md-offset-1">
                <div class="alert alert-danger acciones-cerradas-box text-center">
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

            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Notas Auditorías</h3>
                    </div>

                    <div class="panel-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="col-md-4">Criterio</th>
                                <th class="col-md-7">Nota</th>
                                <th class="col-md-1 text-center">Acciones</th>
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
                                    <td colspan="3" class="text-center">
                                        <button
                                                type="button"
                                                class="btn btn-link nota-periodo-btn btn-toggle-periodo"
                                                data-target="#{{ $grupoId }}"
                                                data-detalles="#{{ $ncId }}, #{{ $omId }}"
                                                aria-expanded="false">
                                            <h4 class="m-0">
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
                                    <td colspan="3" class="text-center nota-toggle-container">
                                        <button
                                                type="button"
                                                class="btn btn-primary btn-toggle-nota"
                                                data-target="#{{ $ncId }}"
                                                data-other="#{{ $omId }}"
                                                @if($notasNc->count() === 0) disabled @endif>
                                            NC
                                            <span class="badge">{{ $notasNc->count() }}</span>
                                        </button>

                                        <button
                                                type="button"
                                                class="btn btn-warning btn-toggle-nota"
                                                data-target="#{{ $omId }}"
                                                data-other="#{{ $ncId }}"
                                                @if($notasOm->count() === 0) disabled @endif>
                                            OM
                                            <span class="badge">{{ $notasOm->count() }}</span>
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
                                        <td class="text-center nota-acciones">
                                            @if($datos->estado == null || $datos->estado == 1 || $datos->estado == 2 || $datos->estado == 5 || $datos->estado == 7)
                                                <a class="btn btn-success"
                                                   href="{{ url('/auditorias/notas_auditorias', $datos->id_responsable) }}"
                                                   title="Capturar acciones correctivas">
                                                    <span class="glyphicon glyphicon-ok-sign"></span>
                                                </a>
                                            @endif

                                            @if($datos->estado == 5 || $datos->estado == 7)
                                                <button
                                                        type="button"
                                                        class="btn btn-danger btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#{{ $modalId }}"
                                                        title="Observaciones">
                                                    <i class="fa fa-eye"></i>
                                                </button>

                                                <div class="modal fade" id="{{ $modalId }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Observaciones</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body text-left">
                                                                @if($datos->estado == 5)
                                                                    {{ $datos->observaciones_responsable ?? 'Sin observaciones registradas.' }}
                                                                @elseif($datos->estado == 7)
                                                                    {{ $datos->observaciones_lideres ?? 'Sin observaciones registradas.' }}
                                                                @endif
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                    Cerrar
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            @switch($datos->estado)
                                                @case(3)
                                                    <span class="label label-default">Enviado</span>
                                                    @break
                                                @case(6)
                                                    <span class="label label-success">Aceptado</span>
                                                    @break
                                                @case(7)
                                                    <span class="label label-danger">Rechazado</span>
                                                    @break
                                                @case(5)
                                                    <span class="label label-warning">Con observaciones</span>
                                                    @break
                                                @default
                                                    <span class="label label-info">Pendiente</span>
                                            @endswitch
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="nota-empty-row">
                                        <td colspan="3" class="text-center">No hay No Conformidades en este periodo.</td>
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
                                        <td class="text-center nota-acciones">
                                            @if($datos->estado == null || $datos->estado == 1 || $datos->estado == 2 || $datos->estado == 5 || $datos->estado == 7)
                                                <a class="btn btn-success"
                                                   href="{{ url('/auditorias/notas_auditorias', $datos->id_responsable) }}"
                                                   title="Capturar oportunidad de mejora">
                                                    <span class="glyphicon glyphicon-ok-sign"></span>
                                                </a>
                                            @endif

                                            @if($datos->estado == 5 || $datos->estado == 7)
                                                <button
                                                        type="button"
                                                        class="btn btn-danger btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#{{ $modalId }}"
                                                        title="Observaciones">
                                                    <i class="fa fa-eye"></i>
                                                </button>

                                                <div class="modal fade" id="{{ $modalId }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Observaciones</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body text-left">
                                                                @if($datos->estado == 5)
                                                                    {{ $datos->observaciones_responsable ?? 'Sin observaciones registradas.' }}
                                                                @elseif($datos->estado == 7)
                                                                    {{ $datos->observaciones_lideres ?? 'Sin observaciones registradas.' }}
                                                                @endif
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                    Cerrar
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            @switch($datos->estado)
                                                @case(3)
                                                    <span class="label label-default">Enviado</span>
                                                    @break
                                                @case(6)
                                                    <span class="label label-success">Aceptado</span>
                                                    @break
                                                @case(7)
                                                    <span class="label label-danger">Rechazado</span>
                                                    @break
                                                @case(5)
                                                    <span class="label label-warning">Con observaciones</span>
                                                    @break
                                                @default
                                                    <span class="label label-info">Pendiente</span>
                                            @endswitch
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="nota-empty-row">
                                        <td colspan="3" class="text-center">No hay Oportunidades de Mejora en este periodo.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            @empty
                                <tbody>
                                <tr>
                                    <td colspan="3" class="text-center">No hay notas asignadas.</td>
                                </tr>
                                </tbody>
                            @endforelse
                        </table>
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
