@extends('layouts.app')

@section('content')
    @php
        $modoConsulta = isset($modoConsulta) ? $modoConsulta : (request()->get('modo_consulta') == 1);
        $urlRegresar = isset($urlRegresar) && $urlRegresar
            ? $urlRegresar
            : route('auditorias.lider_acciones');

        $estadoCierre = isset($accion->estado_cierre) ? (int) $accion->estado_cierre : 0;

        $folioRequisicion = isset($accion->folio_requisicion) && $accion->folio_requisicion
            ? $accion->folio_requisicion
            : ($formatoNc['folio_requisicion'] ?? '');

        $fechaRequisicion = isset($accion->fecha_requisicion) && $accion->fecha_requisicion
            ? $accion->fecha_requisicion
            : ($formatoNc['fecha_registro'] ?? date('Y-m-d'));

        $origenNoConformidad = isset($accion->origen_no_conformidad) && $accion->origen_no_conformidad
            ? $accion->origen_no_conformidad
            : 'Auditoría Interna';

        $definioAccion = isset($accion->definio_accion) && $accion->definio_accion
            ? $accion->definio_accion
            : ($formatoNc['responsable_tratamiento'] ?? 'No disponible');

        $planes = isset($planes) ? collect($planes) : collect();
        $evidenciasAcciones = isset($evidenciasAcciones) ? collect($evidenciasAcciones) : collect();
        $evidenciasRevision = isset($evidenciasRevision) ? collect($evidenciasRevision) : collect();
        $evidenciasCorrecciones = isset($evidenciasCorrecciones) ? collect($evidenciasCorrecciones) : collect();

        $todasEvidencias = $evidenciasAcciones
            ->merge($evidenciasRevision)
            ->merge($evidenciasCorrecciones)
            ->unique('id_plan_acciones')
            ->values();

        /*
         * En este sistema la evidencia autorizada viene de aud_plan_acciones.estado = 1.
         */
        $evidenciasPendientes = $todasEvidencias->filter(function ($evidencia) {
            return isset($evidencia->estado) && (int) $evidencia->estado !== 1;
        });

        $reporteCerrado = $estadoCierre === 3;

        $puedeCerrarReporte = !$reporteCerrado
            && $todasEvidencias->count() > 0
            && $evidenciasPendientes->count() === 0;

        $origenesF28 = [
            'Quejas y sugerencias',
            'Auditoría Interna',
            'Análisis de Indicadores',
            'Auditoría Externa',
            'Especificaciones de Calidad no cumplidas'
        ];

        $f28Checked = function ($valorActual, $valorEsperado) {
            return trim(strtolower($valorActual ?: '')) === trim(strtolower($valorEsperado ?: '')) ? 'X' : '';
        };

        $esOtroOrigen = !in_array($origenNoConformidad, $origenesF28);

        $evidenciaUrl = function ($evidencia) {
            if (isset($evidencia->id_plan_acciones)
                && \Illuminate\Support\Facades\Route::has('aud_seguimiento.descargar')) {
                return route('aud_seguimiento.descargar', $evidencia->id_plan_acciones);
            }

            if (!empty($evidencia->path_evidencia)) {
                $path = $evidencia->path_evidencia;

                if (preg_match('/^https?:\/\//', $path) || substr($path, 0, 1) === '/') {
                    return $path;
                }

                return asset('storage/' . ltrim($path, '/'));
            }

            return null;
        };

        $evidenciaNombre = function ($evidencia) {
            if (!empty($evidencia->path_evidencia)) {
                return basename($evidencia->path_evidencia);
            }

            return 'Ver PDF autorizado';
        };
    @endphp

    <style>
        .f28-wrapper {
            background: #fff;
            padding: 20px;
            color: #000;
        }

        .f28-page {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
            border: 2px solid #000;
            padding: 14px;
            background: #fff;
        }

        .f28-actions {
            max-width: 1100px;
            margin: 0 auto 15px auto;
            text-align: right;
        }

        .f28-header {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .f28-header td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: middle;
            font-size: 12px;
        }

        .f28-logo {
            width: 25%;
            text-align: center;
        }

        .f28-logo img {
            max-width: 220px;
            max-height: 85px;
            width: auto;
            height: auto;
        }

        .f28-title {
            text-align: center;
            font-weight: bold;
            font-size: 15px;
            line-height: 1.25;
        }

        .f28-meta {
            width: 22%;
            font-size: 11px;
        }

        .f28-subtitle {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            margin: 12px 0;
            text-transform: uppercase;
        }

        .f28-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .f28-table th,
        .f28-table td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
            font-size: 12px;
        }

        .f28-table th {
            background: #f2f2f2;
            text-align: center;
            font-weight: bold;
        }

        .f28-label {
            background: #f2f2f2;
            font-weight: bold;
        }

        .f28-center {
            text-align: center;
        }

        .f28-section-title {
            background: #d9d9d9;
            font-weight: bold;
            text-align: left;
            text-transform: uppercase;
        }

        .f28-box {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 1px solid #000;
            text-align: center;
            line-height: 14px;
            font-weight: bold;
            margin-right: 5px;
        }

        .f28-text-block {
            min-height: 65px;
            white-space: pre-line;
        }

        .f28-large-block {
            min-height: 95px;
            white-space: pre-line;
        }

        .f28-signature {
            height: 80px;
            vertical-align: bottom !important;
            text-align: center;
        }

        .f28-code-footer {
            text-align: right;
            font-size: 11px;
            margin-top: 8px;
            font-weight: bold;
        }

        .f28-status {
            max-width: 1100px;
            margin: 0 auto 15px auto;
        }

        .f28-evidence-link {
            display: inline-block;
            margin-top: 5px;
            margin-bottom: 4px;
        }

        .f28-evidence-item {
            margin-bottom: 12px;
        }

        @media print {
            body * {
                visibility: hidden;
            }

            .f28-wrapper,
            .f28-wrapper * {
                visibility: visible;
            }

            .f28-wrapper {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                padding: 0;
            }

            .f28-actions,
            .f28-status,
            .navbar,
            .sidebar,
            header,
            footer {
                display: none !important;
            }

            .f28-page {
                max-width: 100%;
                border: 2px solid #000;
                padding: 10px;
            }

            .f28-table th,
            .f28-table td,
            .f28-header td {
                font-size: 10px;
                padding: 4px;
            }

            .f28-logo img {
                max-width: 170px;
                max-height: 70px;
            }
        }
    </style>

    <div class="container">

        <div class="f28-status">
            @if($modoConsulta)
                <div class="alert alert-info">
                    <strong>Vista de consulta.</strong>
                    Este reporte se abrió desde Seguimiento de auditorías; no se permiten cambios desde esta pantalla.
                </div>
            @elseif($reporteCerrado)
                <div class="alert alert-success">
                    <strong>Reporte cerrado.</strong>
                    Las evidencias fueron autorizadas.
                </div>
            @elseif($puedeCerrarReporte)
                <div class="alert alert-success">
                    <strong>Evidencias autorizadas.</strong>
                    Este reporte ya puede cerrarse.
                </div>
            @elseif($todasEvidencias->count() > 0)
                <div class="alert alert-info">
                    <strong>Reporte con evidencias autorizadas.</strong>
                    Se muestran únicamente las evidencias aprobadas.
                </div>
            @elseif($estadoCierre === 1)
                <div class="alert alert-info">
                    <strong>Reporte validado.</strong>
                    Pendiente de evidencias autorizadas.
                </div>
            @else
                <div class="alert alert-default" style="border: 1px solid #ddd;">
                    <strong>Reporte abierto.</strong>
                    Aún no se ha cerrado el proceso.
                </div>
            @endif
        </div>

        <div class="f28-actions">
            <a href="{{ $urlRegresar }}" class="btn btn-default">
                Regresar
            </a>

            @if(!$modoConsulta)
                @if(\Illuminate\Support\Facades\Route::has('auditorias.lider_acciones.reporte_nc_pdf'))
                    <a href="{{ route('auditorias.lider_acciones.reporte_nc_pdf', $accion->id_responsable) }}"
                       class="btn btn-danger">
                        Descargar PDF
                    </a>
                @endif

                @if($puedeCerrarReporte && \Illuminate\Support\Facades\Route::has('auditorias.lider_acciones.cerrar_reporte_f28'))
                    <form method="POST"
                          action="{{ route('auditorias.lider_acciones.cerrar_reporte_f28', $accion->id_responsable) }}"
                          style="display: inline-block;">
                        @csrf

                        <button type="submit"
                                class="btn btn-success"
                                onclick="return confirm('¿Confirmas que las evidencias son correctas y deseas cerrar esta No Conformidad?')">
                            Cerrar NC
                        </button>
                    </form>
                @endif

                <button type="button" class="btn btn-primary" id="btnImprimirF28">
                    Imprimir
                </button>
            @endif
        </div>

        <div class="f28-wrapper">
            <div class="f28-page">

                <table class="f28-header">
                    <tr>
                        <td class="f28-logo">
                            <img src="{{ asset('img/logos/tesvb.png') }}" alt="Logo TESVB">
                        </td>

                        <td>
                            <div class="f28-title">
                                TECNOLÓGICO DE ESTUDIOS SUPERIORES DE VALLE DE BRAVO<br>
                                No conformidad y acciones correctivas
                            </div>
                        </td>

                        <td class="f28-meta">
                            <strong>Formato:</strong> F28-PSGOE-05<br>
                            <strong>Versión:</strong> V.1<br>
                            <strong>Fecha:</strong> 24/01/2024
                        </td>
                    </tr>
                </table>

                <div class="f28-subtitle">
                    No conformidad y acciones correctivas
                </div>

                <table class="f28-table">
                    <tr>
                        <td style="width: 33%;">
                            <strong>SGOE (1):</strong>
                            <span class="f28-box">X</span>
                        </td>

                        <td style="width: 33%;">
                            <strong>Fecha (2):</strong>
                            {{ $fechaRequisicion }}
                        </td>

                        <td style="width: 34%;">
                            <strong>Folio de Requisición (3):</strong>

                            <span id="folio_requisicion_impresion">
                                {{ $folioRequisicion ?: 'Pendiente' }}
                            </span>

                            <input type="hidden"
                                   id="folio_requisicion_valor"
                                   value="{{ $folioRequisicion }}">

                            <input type="hidden"
                                   id="folio_requisicion_guardar_url"
                                   value="{{ route('auditorias.lider_acciones.actualizar_folio_f28', $accion->id_responsable) }}">

                            <input type="hidden"
                                   id="csrf_token_folio"
                                   value="{{ csrf_token() }}">
                        </td>
                    </tr>
                </table>

                <table class="f28-table">
                    <tr>
                        <th colspan="3">
                            La No Conformidad Proviene de: (4)
                        </th>
                    </tr>

                    <tr>
                        <td>
                            <span class="f28-box">{{ $f28Checked($origenNoConformidad, 'Quejas y sugerencias') }}</span>
                            Quejas y sugerencias del personal, estudiantes y otros beneficiarios
                        </td>

                        <td>
                            <span class="f28-box">{{ $f28Checked($origenNoConformidad, 'Auditoría Interna') }}</span>
                            Auditoría Interna
                        </td>

                        <td>
                            <span class="f28-box">{{ $f28Checked($origenNoConformidad, 'Análisis de Indicadores') }}</span>
                            Análisis de Indicadores
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <span class="f28-box">{{ $f28Checked($origenNoConformidad, 'Auditoría Externa') }}</span>
                            Auditoría Externa
                        </td>

                        <td>
                            <span class="f28-box">{{ $f28Checked($origenNoConformidad, 'Especificaciones de Calidad no cumplidas') }}</span>
                            Especificaciones de Calidad no cumplidas
                        </td>

                        <td>
                            <span class="f28-box">{{ $esOtroOrigen ? 'X' : '' }}</span>
                            Otro, especifique:
                            {{ $esOtroOrigen ? $origenNoConformidad : '' }}
                        </td>
                    </tr>
                </table>

                <table class="f28-table">
                    <tr>
                        <td colspan="2" class="f28-section-title">
                            SOLICITUD:
                        </td>
                    </tr>

                    <tr>
                        <td class="f28-label" style="width: 28%;">
                            Descripción (5)
                        </td>

                        <td class="f28-large-block">
                            {{ $formatoNc['descripcion_senc'] ?? 'Sin descripción registrada' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="f28-label">
                            Dueña o Dueño del Proceso responsable de definir la(s) acción(es) correctiva y/o correcciones para eliminar la No Conformidad y/o Salida no conforme identificada. (5)
                        </td>

                        <td class="f28-text-block">
                            {{ $formatoNc['responsable_tratamiento'] ?? 'No disponible' }}
                        </td>
                    </tr>
                </table>

                <table class="f28-table">
                    <tr>
                        <td colspan="4" class="f28-section-title">
                            REPORTE:
                        </td>
                    </tr>

                    <tr>
                        <td class="f28-label" style="width: 25%;">
                            Requiere Acción Correctiva (6)
                        </td>

                        <td style="width: 25%;">
                            <span class="f28-box">{{ isset($accion->requiere_accion) && (int) $accion->requiere_accion === 1 ? 'X' : '' }}</span>
                            Sí

                            <span class="f28-box" style="margin-left: 20px;">{{ isset($accion->requiere_accion) && (int) $accion->requiere_accion !== 1 ? 'X' : '' }}</span>
                            No
                        </td>

                        <td class="f28-label" style="width: 25%;">
                            Requiere Corrección (6)
                        </td>

                        <td style="width: 25%;">
                            <span class="f28-box">{{ isset($accion->requiere_correccion) && (int) $accion->requiere_correccion === 1 ? 'X' : '' }}</span>
                            Sí

                            <span class="f28-box" style="margin-left: 20px;">{{ isset($accion->requiere_correccion) && (int) $accion->requiere_correccion !== 1 ? 'X' : '' }}</span>
                            No
                        </td>
                    </tr>
                </table>

                <table class="f28-table">
                    <tr>
                        <td colspan="2" class="f28-section-title">
                            ANÁLISIS DE DATOS:
                        </td>
                    </tr>

                    <tr>
                        <td class="f28-label" style="width: 28%;">
                            Causa raíz identificada (7)<br>
                            Técnica estadística utilizada:
                        </td>

                        <td class="f28-large-block">
                            {{ $accion->analisis ?? 'Sin análisis registrado' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="f28-label">
                            Acción Correctiva a realizar: (8)
                        </td>

                        <td class="f28-text-block">
                            {{ $accion->accion_correctiva ?? 'No aplica' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="f28-label">
                            Corrección a realizar: (9)
                        </td>

                        <td class="f28-text-block">
                            {{ $accion->causa_raiz ?? 'No aplica' }}
                        </td>
                    </tr>
                </table>

                <table class="f28-table">
                    <tr>
                        <td colspan="5" class="f28-section-title">
                            PLAN ACCIONES CORRECTIVAS
                        </td>
                    </tr>

                    <tr>
                        <th>Acciones (10)</th>
                        <th>Responsable de la acción a implantar (11)</th>
                        <th>Fecha programada para implantar la acción (12)</th>
                        <th>Responsable de revisar la eficacia de las acciones correctivas tomadas (13)</th>
                        <th>Fecha programada de la verificación (14)</th>
                    </tr>

                    @forelse($planes as $plan)
                        <tr>
                            <td>
                                @if((int) $plan->tipo === 1)
                                    <strong>Acción correctiva:</strong><br>
                                @elseif((int) $plan->tipo === 2)
                                    <strong>Corrección:</strong><br>
                                @elseif((int) $plan->tipo === 3)
                                    <strong>Acción de oportunidad de mejora:</strong><br>
                                @endif

                                {{ $plan->acciones ?? 'Sin descripción' }}
                            </td>

                            <td>{{ $plan->responsable_implantar ?? 'No disponible' }}</td>
                            <td>{{ $plan->fecha_implantar_accion ?? 'No disponible' }}</td>
                            <td>{{ $plan->responsable_revisar ?? 'No disponible' }}</td>
                            <td>{{ $plan->fecha_verificacion ?? 'No disponible' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="f28-center">
                                No hay acciones registradas.
                            </td>
                        </tr>
                    @endforelse
                </table>

                <table class="f28-table">
                    <tr>
                        <td class="f28-section-title">
                            EVIDENCIAS DE LAS ACCIONES CORRECTIVAS REALIZADAS: (15)
                        </td>
                    </tr>

                    <tr>
                        <td class="f28-large-block">
                            @forelse($evidenciasAcciones as $evidencia)
                                <div class="f28-evidence-item">
                                    <div>
                                        <strong>Acción correctiva:</strong><br>
                                        {{ $evidencia->acciones ?? 'Sin descripción' }}
                                    </div>

                                    <div>
                                        <strong>Responsable que cargó la evidencia:</strong>
                                        {{ $evidencia->responsable_implantar ?? 'No disponible' }}
                                    </div>

                                    <div>
                                        <strong>Fecha programada de implantación:</strong>
                                        {{ $evidencia->fecha_implantar_accion ?? 'No disponible' }}
                                    </div>

                                    <div>
                                        <strong>Medio de verificación:</strong>
                                        {{ $evidencia->evidencia ?? 'No especificado' }}
                                    </div>

                                    <div>
                                        <strong>Estado:</strong>
                                        Autorizada
                                    </div>

                                    @php
                                        $url = $evidenciaUrl($evidencia);
                                    @endphp

                                    @if($url)
                                        <a href="{{ $url }}"
                                           target="_blank"
                                           class="f28-evidence-link">
                                            {{ $evidenciaNombre($evidencia) }}
                                        </a>
                                    @else
                                        <div class="text-muted">
                                            PDF no disponible.
                                        </div>
                                    @endif
                                </div>

                                <hr>
                            @empty
                                No hay evidencias de acciones correctivas autorizadas.
                            @endforelse
                        </td>
                    </tr>

                    <tr>
                        <td class="f28-section-title">
                            EVIDENCIAS DE LA O EL RESPONSABLE DE REVISAR LA EFICACIA DE LAS ACCIONES CORRECTIVAS TOMADAS: (16)
                        </td>
                    </tr>

                    <tr>
                        <td class="f28-large-block">
                            @forelse($evidenciasRevision as $evidencia)
                                <div class="f28-evidence-item">
                                    <div>
                                        <strong>Acción revisada:</strong><br>
                                        {{ $evidencia->acciones ?? 'Sin descripción' }}
                                    </div>

                                    <div>
                                        <strong>Responsable de revisar la eficacia:</strong>
                                        {{ $evidencia->responsable_revisar ?? 'No disponible' }}
                                    </div>

                                    <div>
                                        <strong>Fecha programada de verificación:</strong>
                                        {{ $evidencia->fecha_verificacion ?? 'No disponible' }}
                                    </div>

                                    <div>
                                        <strong>Resultado:</strong>
                                        Evidencia revisada y autorizada.
                                    </div>

                                    @php
                                        $url = $evidenciaUrl($evidencia);
                                    @endphp

                                    @if($url)
                                        <a href="{{ $url }}"
                                           target="_blank"
                                           class="f28-evidence-link">
                                            {{ $evidenciaNombre($evidencia) }}
                                        </a>
                                    @else
                                        <div class="text-muted">
                                            PDF no disponible.
                                        </div>
                                    @endif
                                </div>

                                <hr>
                            @empty
                                No hay evidencias autorizadas por el responsable de revisar la eficacia.
                            @endforelse
                        </td>
                    </tr>

                    <tr>
                        <td class="f28-section-title">
                            EVIDENCIAS DE LAS CORRECCIONES REALIZADAS: (17)
                        </td>
                    </tr>

                    <tr>
                        <td class="f28-large-block">
                            @forelse($evidenciasCorrecciones as $evidencia)
                                <div class="f28-evidence-item">
                                    <div>
                                        <strong>Corrección:</strong><br>
                                        {{ $evidencia->acciones ?? 'Sin descripción' }}
                                    </div>

                                    <div>
                                        <strong>Responsable que cargó la evidencia:</strong>
                                        {{ $evidencia->responsable_implantar ?? 'No disponible' }}
                                    </div>

                                    <div>
                                        <strong>Fecha programada de implantación:</strong>
                                        {{ $evidencia->fecha_implantar_accion ?? 'No disponible' }}
                                    </div>

                                    <div>
                                        <strong>Medio de verificación:</strong>
                                        {{ $evidencia->evidencia ?? 'No especificado' }}
                                    </div>

                                    <div>
                                        <strong>Estado:</strong>
                                        Autorizada
                                    </div>

                                    @php
                                        $url = $evidenciaUrl($evidencia);
                                    @endphp

                                    @if($url)
                                        <a href="{{ $url }}"
                                           target="_blank"
                                           class="f28-evidence-link">
                                            {{ $evidenciaNombre($evidencia) }}
                                        </a>
                                    @else
                                        <div class="text-muted">
                                            PDF no disponible.
                                        </div>
                                    @endif
                                </div>

                                <hr>
                            @empty
                                No hay evidencias de correcciones autorizadas.
                            @endforelse
                        </td>
                    </tr>
                </table>

                <table class="f28-table">
                    <tr>
                        <td colspan="2" class="f28-section-title">
                            ACTUALIZACIÓN DE RIESGOS Y OPORTUNIDADES: (18)
                        </td>
                    </tr>

                    <tr>
                        <td style="width: 20%;">
                            <span class="f28-box">{{ isset($accion->actualizacion_riesgos) && (int) $accion->actualizacion_riesgos === 1 ? 'X' : '' }}</span>
                            Sí

                            <span class="f28-box" style="margin-left: 20px;">{{ isset($accion->actualizacion_riesgos) && (int) $accion->actualizacion_riesgos !== 1 ? 'X' : '' }}</span>
                            No
                        </td>

                        <td class="f28-text-block">
                            <strong>¿Por qué?</strong><br>
                            {{ $accion->valor_actr ?? 'Sin información registrada' }}
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" class="f28-section-title">
                            CAMBIOS AL SISTEMA PARA ORGANIZACIONES EDUCATIVAS: (19)
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <span class="f28-box">{{ isset($accion->cambios_sistema) && (int) $accion->cambios_sistema === 1 ? 'X' : '' }}</span>
                            Sí

                            <span class="f28-box" style="margin-left: 20px;">{{ isset($accion->cambios_sistema) && (int) $accion->cambios_sistema !== 1 ? 'X' : '' }}</span>
                            No
                        </td>

                        <td class="f28-text-block">
                            <strong>¿Por qué?</strong><br>
                            {{ $accion->valor_cambios ?? 'Sin información registrada' }}
                        </td>
                    </tr>
                </table>

                <table class="f28-table">
                    <tr>
                        <td class="f28-section-title">
                            DEFINIÓ LA ACCIÓN CORRECTIVA O CORRECCIÓN: (20)
                        </td>
                    </tr>

                    <tr>
                        <td class="f28-signature">
                            {{ $definioAccion }}<br><br>
                            <strong>Nombre y firma</strong>
                        </td>
                    </tr>
                </table>

                <div class="f28-code-footer">
                    F28-PSGOE-05 &nbsp;&nbsp; V.1 &nbsp;&nbsp; 24/01/2024
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var botonImprimir = document.getElementById('btnImprimirF28');

            if (!botonImprimir) {
                return;
            }

            botonImprimir.addEventListener('click', function () {
                solicitarFolioEImprimir();
            });
        });

        function solicitarFolioEImprimir() {
            var folioActualInput = document.getElementById('folio_requisicion_valor');
            var folioSpan = document.getElementById('folio_requisicion_impresion');
            var urlInput = document.getElementById('folio_requisicion_guardar_url');
            var tokenInput = document.getElementById('csrf_token_folio');

            if (!folioActualInput || !folioSpan || !urlInput || !tokenInput) {
                alert('Faltan datos para guardar el folio. Revisa la vista del reporte F28.');
                return;
            }

            var folioActual = folioActualInput.value || '';
            var folio = prompt('Ingrese el Folio de Requisición:', folioActual);

            if (folio === null) {
                return;
            }

            folio = folio.trim();

            if (folio === '') {
                alert('Debe ingresar el Folio de Requisición para imprimir el formato.');
                return;
            }

            guardarFolioEImprimir(folio, folioActualInput, folioSpan, urlInput.value, tokenInput.value);
        }

        function guardarFolioEImprimir(folio, folioActualInput, folioSpan, url, token) {
            var formData = new FormData();
            formData.append('_token', token);
            formData.append('folio_requisicion', folio);

            fetch(url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json'
                },
                body: formData,
                credentials: 'same-origin'
            })
                .then(function (response) {
                    return response.json().then(function (data) {
                        if (!response.ok || !data.ok) {
                            throw new Error(data.message || 'No se pudo guardar el folio.');
                        }

                        return data;
                    });
                })
                .then(function (data) {
                    folioActualInput.value = data.folio_requisicion;
                    folioSpan.innerText = data.folio_requisicion;

                    alert('Folio guardado correctamente.');

                    setTimeout(function () {
                        window.print();
                    }, 300);
                })
                .catch(function (error) {
                    alert(error.message || 'Ocurrió un error al guardar el Folio de Requisición.');
                });
        }
    </script>
@endsection
