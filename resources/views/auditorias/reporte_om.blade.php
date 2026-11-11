@extends('layouts.app')

@section('content')
    @php
        $modoConsulta = isset($modoConsulta) ? $modoConsulta : (request()->get('modo_consulta') == 1);
        $urlRegresar = isset($urlRegresar) && $urlRegresar
            ? $urlRegresar
            : route('auditorias.lider_acciones');

        $planes = isset($planes) ? collect($planes) : collect();
        $planesConEvidenciaAutorizada = isset($planesConEvidenciaAutorizada) ? collect($planesConEvidenciaAutorizada) : collect();
        $planesPendientes = isset($planesPendientes) ? collect($planesPendientes) : collect();

        $estadoCierre = isset($accion->estado_cierre) ? (int) $accion->estado_cierre : 0;
        $reporteCerrado = $estadoCierre === 3;
        $puedeCerrarOm = !$reporteCerrado
            && $planes->count() > 0
            && $planesPendientes->count() === 0;

        $evidenciaUrl = function ($plan) {
            if (isset($plan->id_plan_acciones)
                && \Illuminate\Support\Facades\Route::has('aud_seguimiento.descargar')) {
                return route('aud_seguimiento.descargar', $plan->id_plan_acciones);
            }

            if (!empty($plan->path_evidencia)) {
                $path = $plan->path_evidencia;

                if (preg_match('/^https?:\/\//', $path) || substr($path, 0, 1) === '/') {
                    return $path;
                }

                return asset('storage/' . ltrim($path, '/'));
            }

            return null;
        };

        $nombreEvidencia = function ($plan) {
            if (!empty($plan->path_evidencia)) {
                return basename($plan->path_evidencia);
            }

            return 'Ver PDF';
        };
    @endphp

    <style>
        .om-wrapper {
            background: #fff;
            padding: 20px;
            color: #333;
        }

        .om-card {
            max-width: 1150px;
            margin: 0 auto 15px auto;
            border: 1px solid #ddd;
            border-radius: 6px;
            background: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .om-card-header {
            padding: 14px 18px;
            border-bottom: 1px solid #ddd;
            background: #2f6f8f;
            color: #fff;
            border-radius: 6px 6px 0 0;
        }

        .om-card-header h3,
        .om-card-header h4 {
            margin: 0;
        }

        .om-card-body {
            padding: 18px;
        }

        .om-info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .om-info-table th,
        .om-info-table td {
            border: 1px solid #ddd;
            padding: 8px;
            vertical-align: top;
        }

        .om-info-table th {
            background: #f5f5f5;
            width: 25%;
        }

        .om-report-scroll {
            max-height: 150px;
            overflow-y: auto;
            padding: 8px;
            border: 1px solid #e5e5e5;
            background: #fafafa;
            border-radius: 4px;
            line-height: 1.35;
        }

        .om-status-box {
            max-width: 1150px;
            margin: 0 auto 15px auto;
        }

        .om-actions-bar {
            max-width: 1150px;
            margin: 0 auto 15px auto;
            text-align: right;
        }

        .om-table th {
            background: #f2f2f2;
            text-align: center;
        }

        .om-evidence-link {
            display: inline-block;
            margin-top: 4px;
        }

        @media print {
            .om-actions-bar,
            .om-status-box,
            .navbar,
            .sidebar,
            header,
            footer {
                display: none !important;
            }

            .om-card {
                box-shadow: none;
                border: 1px solid #000;
            }
        }
    </style>

    <div class="container om-wrapper">
        <div class="om-status-box">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if($modoConsulta)
                <div class="alert alert-info">
                    <strong>Vista de consulta.</strong>
                    Este reporte se abrió desde Seguimiento de auditorías; no se permiten cambios desde esta pantalla.
                </div>
            @elseif($reporteCerrado)
                <div class="alert alert-success">
                    <strong>OM cerrada.</strong>
                    Todas las acciones cuentan con evidencia autorizada.
                    @if(!empty($accion->cerrado_at))
                        <br>Fecha de cierre: {{ $accion->cerrado_at }}
                    @endif
                </div>
            @elseif($puedeCerrarOm)
                <div class="alert alert-success">
                    <strong>Lista para cierre.</strong>
                    Todas las acciones de la OM tienen evidencia PDF autorizada.
                </div>
            @elseif($planes->count() > 0)
                <div class="alert alert-warning">
                    <strong>OM pendiente de cierre.</strong>
                    Aún hay acciones sin evidencia PDF autorizada.
                </div>
            @else
                <div class="alert alert-info">
                    <strong>Sin acciones registradas.</strong>
                    No se puede cerrar la OM hasta que exista al menos una acción registrada.
                </div>
            @endif
        </div>

        <div class="om-actions-bar">
            <a href="{{ $urlRegresar }}" class="btn btn-default">
                Regresar
            </a>

            @if(!$modoConsulta)
                <button type="button" class="btn btn-primary" onclick="window.print()">
                    Imprimir
                </button>

                @if($puedeCerrarOm && \Illuminate\Support\Facades\Route::has('auditorias.lider_acciones.cerrar_reporte_om'))
                    <form method="POST"
                          action="{{ route('auditorias.lider_acciones.cerrar_reporte_om', $accion->id_responsable) }}"
                          style="display: inline-block;">
                        @csrf

                        <button type="submit"
                                class="btn btn-success"
                                onclick="return confirm('¿Confirmas que todas las acciones y evidencias de esta OM están completas y deseas cerrarla?')">
                            Cerrar OM
                        </button>
                    </form>
                @endif
            @endif
        </div>

        <div class="om-card">
            <div class="om-card-header">
                <h3>Reporte de Oportunidad de Mejora</h3>
                <h4>{{ $accion->clave_nota ?? 'Sin clave' }}</h4>
            </div>

            <div class="om-card-body">
                <table class="om-info-table">
                    <tr>
                        <th>Clasificación</th>
                        <td>Oportunidad de Mejora</td>
                    </tr>
                    <tr>
                        <th>Criterio de auditoría</th>
                        <td>{{ $accion->criterio_auditoria ?? 'No disponible' }}</td>
                    </tr>
                    <tr>
                        <th>Responsable asignado</th>
                        <td>{{ $accion->responsable_tratamiento ?? 'No disponible' }}</td>
                    </tr>
                    <tr>
                        <th>Fecha de registro</th>
                        <td>{{ $accion->fecha_registro ?? 'No disponible' }}</td>
                    </tr>
                    <tr>
                        <th>Reporte levantado por el auditor</th>
                        <td>
                            <div class="om-report-scroll">
                                @if(!empty($accion->resultado))
                                    {!! nl2br(e($accion->resultado)) !!}
                                @elseif(!empty($accion->observaciones))
                                    {!! nl2br(e($accion->observaciones)) !!}
                                @else
                                    <span class="text-muted">Sin reporte registrado.</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Análisis / causa</th>
                        <td>{{ $accion->analisis ?? 'Sin análisis registrado' }}</td>
                    </tr>
                    <tr>
                        <th>Acción propuesta</th>
                        <td>{{ $accion->accion_correctiva ?? 'No aplica' }}</td>
                    </tr>
                    <tr>
                        <th>Observaciones del líder</th>
                        <td>{{ $accion->observaciones_lider ?? 'Sin observaciones.' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="om-card">
            <div class="om-card-header">
                <h3>Acciones, responsables y evidencias de la OM</h3>
            </div>

            <div class="om-card-body">
                @if($planes->isEmpty())
                    <div class="alert alert-info">
                        No hay acciones registradas para esta Oportunidad de Mejora.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped om-table">
                            <thead>
                            <tr>
                                <th style="width: 45px;">#</th>
                                <th>Acción</th>
                                <th>Responsable de implantar</th>
                                <th>Fecha de implantación</th>
                                <th>Responsable de revisar eficacia</th>
                                <th>Fecha de verificación</th>
                                <th>Medio de verificación</th>
                                <th>Evidencia PDF</th>
                                <th>Estado evidencia</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($planes as $index => $plan)
                                @php
                                    $url = $evidenciaUrl($plan);
                                @endphp

                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $plan->acciones ?? 'Sin descripción' }}</td>
                                    <td>{{ $plan->responsable_implantar ?? 'No disponible' }}</td>
                                    <td>{{ $plan->fecha_implantar_accion ?? 'No disponible' }}</td>
                                    <td>{{ $plan->responsable_revisar ?? 'No disponible' }}</td>
                                    <td>{{ $plan->fecha_verificacion ?? 'No disponible' }}</td>
                                    <td>{{ $plan->evidencia ?? 'No especificado' }}</td>
                                    <td>
                                        @if($url)
                                            <a href="{{ $url }}"
                                               target="_blank"
                                               class="btn btn-xs btn-info om-evidence-link">
                                                {{ $nombreEvidencia($plan) }}
                                            </a>
                                        @else
                                            <span class="text-muted">Sin PDF cargado</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if(!empty($plan->path_evidencia) && (int) $plan->estado === 1)
                                            <span class="label label-success">Autorizada</span>
                                        @elseif(!empty($plan->path_evidencia))
                                            <span class="label label-warning">Pendiente de autorización</span>
                                        @else
                                            <span class="label label-default">Sin evidencia</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

