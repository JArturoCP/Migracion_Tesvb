@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .seguimiento-container { max-width: 1600px; margin: 0 auto; }
        .seguimiento-title { margin-top: 10px; margin-bottom: 20px; font-weight: 700; color: #1f4e79; }
        .auditor-panel { border: 1px solid #c7d7e2; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,.08); margin-bottom: 18px; background: #fff; }
        .auditor-heading { background: #1f4e79 !important; color: #fff !important; padding: 14px 16px; cursor: pointer; border-bottom: 1px solid #173b5c; }
        .auditor-heading:hover { background: #173b5c !important; }
        .auditor-heading small { color: #e8f2fa; font-weight: 600; }
        .auditor-nombre { font-size: 16px; font-weight: 700; }
        .auditor-detalle { display: none; background: #f8fbfd; padding: 15px; }
        .icono-auditor { font-size: 18px; margin-left: 8px; }
        .nota-responsable-box { border-left: 5px solid #1f4e79; background: #f4f8fb; padding: 10px 12px; margin-bottom: 14px; border-radius: 4px; }
        .nota-responsable-box .responsable-actual { font-size: 13px; }
        .nota-responsable-box .btn-toggle-cambio-responsable { margin-top: -2px; }
        .form-cambio-responsable { display: none; margin-top: 10px; padding: 12px; border: 1px dashed #b9cbd8; background: #fff; border-radius: 4px; }
        .resultado-personal-lista { max-height: 190px; overflow-y: auto; border: 1px solid #d8e2ea; border-radius: 4px; background: #fff; margin-top: 6px; display: none; }
        .resultado-personal-item { display: block; width: 100%; text-align: left; border: 0; border-bottom: 1px solid #eef2f5; background: #fff; padding: 7px 10px; font-size: 12px; color: #333; }
        .resultado-personal-item:hover { background: #eef5fa; color: #1f4e79; }
        .resultado-personal-item:last-child { border-bottom: 0; }
        .resultado-personal-vacio { padding: 8px 10px; font-size: 12px; color: #777; }
        .responsable-seleccionado-box { display: none; margin-top: 8px; padding: 7px 9px; border-left: 4px solid #5cb85c; background: #f4fbf4; border-radius: 4px; font-size: 12px; }
        .btn-guardar-responsable:disabled { opacity: .55; cursor: not-allowed; }
        .auditoria-panel { border: 1px solid #d8e2ea; border-radius: 6px; margin-bottom: 18px; background: #fff; }
        .auditoria-heading { background: #eef5fa !important; color: #1f4e79 !important; font-weight: 700; padding: 10px 13px; border-bottom: 1px solid #d8e2ea; }
        .nota-card { border: 1px solid #e2e2e2; border-radius: 6px; margin-bottom: 16px; background: #fff; }
        .nota-header { background: #f7f7f7; padding: 10px 12px; border-bottom: 1px solid #e2e2e2; }
        .nota-body { padding: 13px; }
        .reporte-auditor-box { max-height: 100px; overflow-y: auto; overflow-x: hidden; border: 1px solid #e3e3e3; background: #fbfbfb; padding: 9px; border-radius: 4px; text-align: justify; margin-bottom: 12px; }
        .tabla-acciones { table-layout: fixed; width: 100%; font-size: 12px; }
        .tabla-acciones th, .tabla-acciones td { vertical-align: top !important; word-wrap: break-word; overflow-wrap: break-word; }
        .tabla-acciones th:nth-child(1), .tabla-acciones td:nth-child(1) { width: 20%; }
        .tabla-acciones th:nth-child(2), .tabla-acciones td:nth-child(2) { width: 13%; }
        .tabla-acciones th:nth-child(3), .tabla-acciones td:nth-child(3) { width: 13%; }
        .tabla-acciones th:nth-child(4), .tabla-acciones td:nth-child(4) { width: 9%; }
        .tabla-acciones th:nth-child(5), .tabla-acciones td:nth-child(5) { width: 9%; }
        .tabla-acciones th:nth-child(6), .tabla-acciones td:nth-child(6) { width: 12%; }
        .tabla-acciones th:nth-child(7), .tabla-acciones td:nth-child(7) { width: 12%; }
        .tabla-acciones th:nth-child(8), .tabla-acciones td:nth-child(8) { width: 12%; }
        .seguimiento-nota-box { max-height: 80px; overflow-y: auto; border: 1px solid #e6e6e6; padding: 6px; background: #fbfbfb; border-radius: 4px; }
        .label-semaforo { display: inline-block; white-space: normal; line-height: 1.25; padding: 6px 8px; }
        .semaforo-fechas { min-width: 145px; }
        .semaforo-fecha-item { margin-bottom: 6px; }
        .semaforo-fecha-item:last-child { margin-bottom: 0; }
        .semaforo-fecha-item .label-semaforo { display: block; text-align: left; }
        .btn-ver-detalle-semaforo { margin-top: 6px; display: inline-block; font-size: 11px; }
        .form-integrar-informe { margin-top: 6px; }
        .btn-integrar-informe {
            display: inline-block;
            width: auto;
            max-width: 100%;
            padding: 2px 7px;
            font-size: 10px;
            white-space: normal;
            line-height: 1.15;
        }
        .texto-muted { color: #777; }
        .badge-resumen { background: #5bc0de; padding: 6px 9px; font-size: 12px; margin-left: 4px; }
        .badge-resumen-verde { background: #5cb85c; }
        .badge-resumen-rojo { background: #d9534f; }
        .badge-resumen-amarillo { background: #f0ad4e; }
        .ayuda-clic { font-size: 12px; color: #e8f2fa; margin-top: 3px; }
    </style>


    <div class="container-fluid seguimiento-container">
        <h3 class="seguimiento-title">
            <i class="fa fa-search"></i>
            Seguimiento de auditorías
        </h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if(!$puedeVerSeguimiento)
            <div class="alert alert-warning">
                No tiene auditorías asignadas para seguimiento.
            </div>
        @else
            @if($seguimientosAgrupados->isEmpty())
                <div class="alert alert-info">
                    No existen notas o planes para seguimiento.
                </div>
            @endif

            @foreach($seguimientosAgrupados as $grupoAuditor)
                @php
                    $auditor = $grupoAuditor['auditor'];
                    $auditorias = collect($grupoAuditor['auditorias']);

                    $totalNotasAuditor = 0;
                    $totalAccionesAuditor = 0;
                    $totalNCAuditor = 0;
                    $totalOMAuditor = 0;

                    foreach ($auditorias as $notasAuditoria) {
                        $notasAuditoria = collect($notasAuditoria);
                        $totalNotasAuditor += $notasAuditoria->count();

                        foreach ($notasAuditoria as $bloqueConteo) {
                            $notaConteo = isset($bloqueConteo['nota']) ? $bloqueConteo['nota'] : null;
                            $accionesConteo = isset($bloqueConteo['acciones']) ? collect($bloqueConteo['acciones']) : collect();

                            $totalAccionesAuditor += $accionesConteo->count();

                            if ($notaConteo && isset($notaConteo->tipo_hallazgo) && $notaConteo->tipo_hallazgo == 'NC') {
                                $totalNCAuditor++;
                            }

                            if ($notaConteo && isset($notaConteo->tipo_hallazgo) && $notaConteo->tipo_hallazgo == 'OM') {
                                $totalOMAuditor++;
                            }
                        }
                    }

                    $responsableActualId = isset($auditor->id_personal_seguimiento_efectivo) ? $auditor->id_personal_seguimiento_efectivo : 0;
                    $idResponsableBase = isset($auditor->id_responsable) ? $auditor->id_responsable : 0;
                    $idAuditorOriginal = isset($auditor->auditor_grupo_id) ? $auditor->auditor_grupo_id : 0;
                    $nombreAuditor = isset($auditor->auditor_grupo_nombre) ? $auditor->auditor_grupo_nombre : 'Auditor no identificado';
                    $responsableSeguimientoTexto = isset($grupoAuditor['responsable_seguimiento_texto']) ? $grupoAuditor['responsable_seguimiento_texto'] : 'Sin responsable de seguimiento';
                    $seguimientoPorDefecto = isset($auditor->seguimiento_por_defecto) ? $auditor->seguimiento_por_defecto : false;
                    $idPanelAuditor = 'auditor-panel-' . md5($nombreAuditor . '_' . $idAuditorOriginal . '_' . $loop->iteration);
                @endphp

                <div class="auditor-panel" id="{{ $idPanelAuditor }}">
                    <div class="auditor-heading auditor-toggle">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="auditor-nombre">
                                    <i class="fa fa-user"></i>
                                    Auditor registrado:
                                    {{ $nombreAuditor }}
                                </div>

                                <div class="ayuda-clic">
                                    Clic para desplegar auditorías, notas, planes y seguimiento.
                                </div>
                            </div>

                            <div class="col-md-5 text-right">
                                <span class="badge badge-resumen">Auditorías: {{ $auditorias->count() }}</span>
                                <span class="badge badge-resumen badge-resumen-verde">Notas: {{ $totalNotasAuditor }}</span>
                                <span class="badge badge-resumen badge-resumen-rojo">NC: {{ $totalNCAuditor }}</span>
                                <span class="badge badge-resumen">OM: {{ $totalOMAuditor }}</span>
                                <span class="badge badge-resumen badge-resumen-amarillo">Acciones: {{ $totalAccionesAuditor }}</span>
                                <span class="icono-auditor">▼</span>
                            </div>
                        </div>
                    </div>

                    <div class="auditor-detalle">

                        @foreach($auditorias as $numeroAuditoria => $notas)
                            @php $notas = collect($notas); @endphp

                            <div class="auditoria-panel">
                                <div class="auditoria-heading">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <i class="fa fa-folder-open"></i>
                                            Auditoría: {{ $numeroAuditoria }}
                                        </div>

                                        <div class="col-md-4 text-right">
                                            <span class="label label-primary">Notas: {{ $notas->count() }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    @foreach($notas as $bloque)
                                        @php
                                            $nota = $bloque['nota'];
                                            $acciones = collect($bloque['acciones']);
                                            $idNotaCard = 'nota-seguimiento-' . (isset($nota->id_responsable) ? $nota->id_responsable : md5($numeroAuditoria . '_' . $loop->iteration));
                                            $idFormCambioNota = 'form-cambio-nota-' . md5($idNotaCard);
                                            $responsableSeguimientoNotaTexto = isset($nota->persona_seguimiento_efectiva)
                                                ? $nota->persona_seguimiento_efectiva
                                                : 'Sin responsable de seguimiento';
                                            $responsableActualNotaId = isset($nota->id_personal_seguimiento_efectivo)
                                                ? $nota->id_personal_seguimiento_efectivo
                                                : 0;
                                        @endphp

                                        <div class="nota-card" id="{{ $idNotaCard }}">
                                            <div class="nota-header">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <strong>{{ $nota->tipo_hallazgo }} {{ $nota->clave_nota }}</strong>
                                                        <span class="label label-{{ $nota->tipo_hallazgo == 'NC' ? 'danger' : 'info' }}">{{ $nota->tipo_hallazgo }}</span>
                                                    </div>


                                                </div>
                                            </div>

                                            <div class="nota-body">
                                                <p>
                                                    <strong>Punto / proceso:</strong>
                                                    {{ $nota->punto_proceso ?: 'No especificado' }}
                                                </p>

                                                <strong>Reporte levantado por el auditor:</strong>
                                                <div class="reporte-auditor-box">
                                                    @if($nota->reporte_auditor)
                                                        {!! nl2br(e($nota->reporte_auditor)) !!}
                                                    @elseif($nota->observaciones_auditor)
                                                        {!! nl2br(e($nota->observaciones_auditor)) !!}
                                                    @else
                                                        Sin reporte registrado.
                                                    @endif
                                                </div>

                                                <div class="nota-responsable-box">
                                                    <div class="row">
                                                        <div class="col-md-8 responsable-actual">
                                                            <strong>Responsable de seguimiento actual:</strong>
                                                            {{ $responsableSeguimientoNotaTexto }}
                                                        </div>

                                                        <div class="col-md-4 text-right">
                                                            @if($esLiderActivo && isset($nota->id_responsable) && (int) $nota->id_responsable > 0)
                                                                <button type="button"
                                                                        class="btn btn-warning btn-sm btn-toggle-cambio-responsable"
                                                                        data-target="#{{ $idFormCambioNota }}">
                                                                    <i class="fa fa-pencil"></i>
                                                                    Cambiar Responsable
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    @if($esLiderActivo && isset($nota->id_responsable) && (int) $nota->id_responsable > 0)
                                                        <div class="form-cambio-responsable" id="{{ $idFormCambioNota }}">
                                                            <form method="POST" action="{{ route('auditorias.seguimiento_auditorias.asignar', $nota->id_responsable) }}">
                                                                {{ csrf_field() }}

                                                                <input type="hidden"
                                                                       name="id_personal_seguimiento"
                                                                       class="input-personal-seguimiento"
                                                                       value="">

                                                                <input type="hidden"
                                                                       name="observaciones"
                                                                       value="Cambio de responsable de seguimiento de la nota {{ $nota->clave_nota }}">

                                                                <input type="hidden"
                                                                       name="return_anchor"
                                                                       value="{{ $idNotaCard }}">

                                                                <div class="row">
                                                                    <div class="col-md-9">
                                                                        <label>Buscar nuevo responsable</label>
                                                                        <input type="text"
                                                                               class="form-control input-sm buscador-personal-seguimiento"
                                                                               placeholder="Escriba el nombre del nuevo responsable"
                                                                               autocomplete="off">

                                                                        <div class="resultado-personal-lista">
                                                                            @foreach($personales as $personal)
                                                                                <button type="button"
                                                                                        class="resultado-personal-item"
                                                                                        data-id-personal="{{ $personal->id_personal }}"
                                                                                        data-nombre-personal="{{ $personal->nombre }}">
                                                                                    {{ $personal->nombre }}
                                                                                </button>
                                                                            @endforeach

                                                                            <div class="resultado-personal-vacio" style="display: none;">
                                                                                No se encontraron coincidencias.
                                                                            </div>
                                                                        </div>

                                                                        <div class="responsable-seleccionado-box">
                                                                            <strong>Nuevo responsable seleccionado:</strong>
                                                                            <span class="nombre-responsable-seleccionado"></span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-3">
                                                                        <label>&nbsp;</label>
                                                                        <button type="submit"
                                                                                class="btn btn-primary btn-sm btn-block btn-guardar-responsable"
                                                                                disabled>
                                                                            <i class="fa fa-save"></i>
                                                                            Guardar
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </div>

                                                @if($acciones->isEmpty())
                                                    <div class="alert alert-warning" style="margin-bottom: 0;">
                                                        No se registraron acciones en el procedimiento de No Conformidades y Acciones Correctivas
                                                    </div>

                                                    @php
                                                        $integrarNotaInforme = isset($nota->integrar_informe_nota)
                                                            && (int) $nota->integrar_informe_nota === 1;
                                                    @endphp

                                                    <form method="POST"
                                                          class="form-integrar-informe"
                                                          action="{{ route('auditorias.seguimiento_auditorias.integrar_informe_nota', $nota->id_responsable) }}">
                                                        {{ csrf_field() }}
                                                        <input type="hidden"
                                                               name="integrar_informe"
                                                               value="{{ $integrarNotaInforme ? 0 : 1 }}">
                                                        <input type="hidden"
                                                               name="return_anchor"
                                                               value="{{ $idNotaCard }}">

                                                        <button type="submit"
                                                                class="btn btn-{{ $integrarNotaInforme ? 'success' : 'danger' }} btn-xs btn-integrar-informe"
                                                                title="{{ $integrarNotaInforme ? 'Presione para excluir la nota del informe.' : 'Presione para integrar la nota al informe.' }}">
                                                            <i class="fa {{ $integrarNotaInforme ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                                                            Integrar al informe: {{ $integrarNotaInforme ? 'Sí' : 'No' }}
                                                        </button>
                                                    </form>
                                                @else
                                                    <table class="table table-bordered table-condensed tabla-acciones">
                                                        <thead>
                                                        <tr>
                                                            <th>Acción del plan</th>
                                                            <th>Responsable implantar</th>
                                                            <th>Responsable revisar</th>
                                                            <th>Fecha implantar</th>
                                                            <th>Fecha verificar</th>
                                                            <th>Semáforo</th>
                                                            <th>Última nota</th>
                                                            <th>Calificar</th>
                                                        </tr>
                                                        </thead>

                                                        <tbody>
                                                        @foreach($acciones as $accion)
                                                            @php
                                                                $idAccionSeguimiento = 'accion-seguimiento-' . $accion->id_plan_acciones;
                                                            @endphp
                                                            <tr id="{{ $idAccionSeguimiento }}">
                                                                <td>{!! nl2br(e($accion->acciones)) !!}</td>
                                                                <td>{{ $accion->responsable_implantar ?: 'No asignado' }}</td>
                                                                <td>{{ $accion->responsable_revisar ?: 'No asignado' }}</td>
                                                                <td>{{ $accion->fecha_implantar_accion ?: 'Sin fecha' }}</td>
                                                                <td>{{ $accion->fecha_verificacion ?: 'Sin fecha' }}</td>
                                                                <td>
                                                                    <div class="semaforo-fechas">
                                                                        <div class="semaforo-fecha-item">
                                                                            <span class="label label-{{ $accion->semaforo_implantacion_clase ?? $accion->semaforo_clase }} label-semaforo">
                                                                                {{ $accion->semaforo_implantacion_texto ?? ('Implantación: ' . $accion->semaforo_texto) }}
                                                                            </span>
                                                                        </div>

                                                                        <div class="semaforo-fecha-item">
                                                                            <span class="label label-{{ $accion->semaforo_verificacion_clase ?? $accion->semaforo_clase }} label-semaforo">
                                                                                {{ $accion->semaforo_verificacion_texto ?? ('Verificación: ' . $accion->semaforo_texto) }}
                                                                            </span>
                                                                        </div>
                                                                    </div>

                                                                    @php
                                                                        $rutaDetalleReporte = null;

                                                                        if (($nota->tipo_hallazgo ?? '') == 'NC' && Route::has('auditorias.lider_acciones.reporte_nc')) {
                                                                            $rutaDetalleReporte = route('auditorias.lider_acciones.reporte_nc', $accion->id_responsable);
                                                                        } elseif (($nota->tipo_hallazgo ?? '') == 'OM' && Route::has('auditorias.lider_acciones.reporte_om')) {
                                                                            $rutaDetalleReporte = route('auditorias.lider_acciones.reporte_om', $accion->id_responsable);
                                                                        }

                                                                        if ($rutaDetalleReporte) {
                                                                            $urlRetornoDetalle = url()->full() . '#' . $idNotaCard;

                                                                            $rutaDetalleReporte .= '?' . http_build_query([
                                                                                'modo_consulta' => 1,
                                                                                'return_url' => $urlRetornoDetalle,
                                                                            ]);
                                                                        }
                                                                    @endphp

                                                                    @if($rutaDetalleReporte)
                                                                        <a href="{{ $rutaDetalleReporte }}"
                                                                           data-retorno-panel="{{ $idNotaCard }}"
                                                                           class="btn btn-default btn-xs btn-ver-detalle-semaforo">
                                                                            <i class="fa fa-eye"></i>
                                                                            Ver detalle
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <div class="seguimiento-nota-box">
                                                                        @if($accion->nota_seguimiento)
                                                                            {!! nl2br(e($accion->nota_seguimiento)) !!}<br>
                                                                            <small class="texto-muted">{{ $accion->fecha_revision ?: '' }}</small>
                                                                        @else
                                                                            Sin nota de seguimiento.
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <form method="POST" action="{{ route('auditorias.seguimiento_auditorias.guardar_nota', $accion->id_plan_acciones) }}">
                                                                        {{ csrf_field() }}
                                                                        <input type="hidden"
                                                                               name="return_anchor"
                                                                               value="{{ $idAccionSeguimiento }}">

                                                                        <select name="estado_cumplimiento" class="form-control input-sm" required>
                                                                            <option value="0" {{ (int) $accion->estado_cumplimiento === 0 ? 'selected' : '' }}>Sin revisar</option>
                                                                            <option value="1" {{ (int) $accion->estado_cumplimiento === 1 ? 'selected' : '' }}>Concluido</option>
                                                                            <option value="2" {{ (int) $accion->estado_cumplimiento === 2 ? 'selected' : '' }}>En proceso</option>
                                                                            <option value="3" {{ (int) $accion->estado_cumplimiento === 3 ? 'selected' : '' }}>Sin cumplimiento</option>
                                                                        </select>

                                                                        <textarea name="nota_seguimiento" class="form-control input-sm" rows="2" placeholder="Nota de seguimiento" style="margin-top: 5px;">{{ $accion->nota_seguimiento }}</textarea>

                                                                        <button type="submit" class="btn btn-success btn-xs" style="margin-top: 5px;">
                                                                            <i class="fa fa-save"></i> Guardar
                                                                        </button>
                                                                    </form>

                                                                    @php
                                                                        $integrarInforme = isset($accion->integrar_informe)
                                                                            && (int) $accion->integrar_informe === 1;
                                                                    @endphp

                                                                    <form method="POST"
                                                                          class="form-integrar-informe"
                                                                          action="{{ route('auditorias.seguimiento_auditorias.integrar_informe', $accion->id_plan_acciones) }}">
                                                                        {{ csrf_field() }}
                                                                        <input type="hidden"
                                                                               name="integrar_informe"
                                                                               value="{{ $integrarInforme ? 0 : 1 }}">
                                                                        <input type="hidden"
                                                                               name="return_anchor"
                                                                               value="{{ $idAccionSeguimiento }}">

                                                                        <button type="submit"
                                                                                class="btn btn-{{ $integrarInforme ? 'success' : 'danger' }} btn-xs btn-integrar-informe"
                                                                                title="{{ $integrarInforme ? 'La acción aparecerá en el informe. Presione para excluirla.' : 'La acción no aparecerá en el informe. Presione para integrarla.' }}">
                                                                            <i class="fa {{ $integrarInforme ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                                                                            Integrar al informe:
                                                                            {{ $integrarInforme ? 'Sí' : 'No' }}
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <script>
        $(document).ready(function () {
            $(document).on('click', '.auditor-toggle', function (e) {
                if ($(e.target).closest('button, a, input, select, textarea, form').length > 0) {
                    return;
                }

                var panel = $(this).closest('.auditor-panel');
                var detalle = panel.children('.auditor-detalle');
                var icono = panel.find('.icono-auditor').first();

                detalle.slideToggle(180);
                icono.text(icono.text() === '▼' ? '▲' : '▼');
            });

            $(document).on('click', '.btn-toggle-cambio-responsable', function (e) {
                e.preventDefault();
                e.stopPropagation();

                var target = $(this).data('target');
                var form = target ? $(target) : $(this).closest('.nota-card').find('.form-cambio-responsable').first();

                form.slideToggle(180, function () {
                    if (form.is(':visible')) {
                        form.find('.buscador-personal-seguimiento').val('').focus();
                        form.find('.input-personal-seguimiento').val('');
                        form.find('.nombre-responsable-seleccionado').text('');
                        form.find('.responsable-seleccionado-box').hide();
                        form.find('.btn-guardar-responsable').prop('disabled', true);
                        form.find('.resultado-personal-item').show();
                        form.find('.resultado-personal-vacio').hide();
                        form.find('.resultado-personal-lista').show();
                    }
                });
            });

            $(document).on('keyup focus', '.buscador-personal-seguimiento', function () {
                var texto = $.trim($(this).val().toLowerCase());
                var contenedor = $(this).closest('.form-cambio-responsable');
                var lista = contenedor.find('.resultado-personal-lista');
                var visibles = 0;

                contenedor.find('.input-personal-seguimiento').val('');
                contenedor.find('.nombre-responsable-seleccionado').text('');
                contenedor.find('.responsable-seleccionado-box').hide();
                contenedor.find('.btn-guardar-responsable').prop('disabled', true);

                contenedor.find('.resultado-personal-item').each(function () {
                    var item = $(this);
                    var nombre = item.data('nombre-personal').toString().toLowerCase();
                    var coincide = texto === '' || nombre.indexOf(texto) >= 0;

                    if (coincide) {
                        item.show();
                        visibles++;
                    } else {
                        item.hide();
                    }
                });

                contenedor.find('.resultado-personal-vacio').toggle(visibles === 0);
                lista.show();
            });

            $(document).on('click', '.resultado-personal-item', function (e) {
                e.preventDefault();
                e.stopPropagation();

                var item = $(this);
                var contenedor = item.closest('.form-cambio-responsable');
                var idPersonal = item.data('id-personal');
                var nombrePersonal = item.data('nombre-personal');

                contenedor.find('.input-personal-seguimiento').val(idPersonal);
                contenedor.find('.buscador-personal-seguimiento').val(nombrePersonal);
                contenedor.find('.nombre-responsable-seleccionado').text(nombrePersonal);
                contenedor.find('.responsable-seleccionado-box').show();
                contenedor.find('.resultado-personal-lista').hide();
                contenedor.find('.btn-guardar-responsable').prop('disabled', false);
            });

            $(document).on('click', '.btn-ver-detalle-semaforo', function () {
                var idRetorno = $(this).data('retorno-panel');

                if (idRetorno && window.history && window.history.replaceState) {
                    window.history.replaceState(null, null, '#' + idRetorno);
                }
            });

            function abrirPanelRetorno() {
                var hash = window.location.hash;

                if (!hash || hash.length <= 1) {
                    return;
                }

                var destino = $(hash);

                if (!destino.length) {
                    return;
                }

                var panelAuditor = destino.closest('.auditor-panel');

                if (panelAuditor.length) {
                    panelAuditor.children('.auditor-detalle').show();
                    panelAuditor.find('.icono-auditor').first().text('▲');
                }

                setTimeout(function () {
                    $('html, body').animate({
                        scrollTop: destino.offset().top - 20
                    }, 250);
                }, 180);
            }

            abrirPanelRetorno();
        });
    </script>
@endsection
