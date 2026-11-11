@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .lider-nc-container {
            width: 100%;
            max-width: 1500px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 12px;
            padding-right: 12px;
        }

        .lider-table-wrapper {
            width: 100%;
            overflow-x: visible;
        }

        .lider-acciones-table {
            width: 100% !important;
            table-layout: fixed;
            font-size: 12px;
            margin-bottom: 0;
        }

        .lider-acciones-table th,
        .lider-acciones-table td {
            white-space: normal !important;
            word-break: normal;
            overflow-wrap: break-word;
            vertical-align: top !important;
            padding: 6px 5px !important;
        }

        .lider-acciones-table th {
            line-height: 1.25;
        }

        .lider-acciones-table .btn {
            max-width: 100%;
            white-space: normal;
            line-height: 1.15;
            padding: 6px 7px;
        }

        .lider-acciones-table select.form-control {
            width: 100%;
            min-width: 0;
            height: 30px;
            padding-left: 3px;
            padding-right: 3px;
            font-size: 12px;
        }

        .reporte-auditor-scroll {
            max-height: 115px;
            width: 100%;
            min-width: 0;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 7px;
            background: #fff;
            border: 1px solid #e5e5e5;
            border-radius: 4px;
            line-height: 1.28;
        }

        .reporte-auditor-scroll::-webkit-scrollbar {
            width: 7px;
        }

        .reporte-auditor-scroll::-webkit-scrollbar-thumb {
            background: #b7c4cc;
            border-radius: 6px;
        }

        .om-cerrada-label,
        .nc-cerrada-label {
            display: inline-block;
            margin-top: 4px;
        }

        .lider-acciones-table td:nth-child(5),
        .lider-acciones-table td:nth-child(6),
        .lider-acciones-table td:nth-child(10),
        .lider-acciones-table th:nth-child(5),
        .lider-acciones-table th:nth-child(6),
        .lider-acciones-table th:nth-child(10) {
            text-align: center;
        }

        .lider-acciones-table td:nth-child(11) .btn {
            width: 100%;
            margin-top: 4px;
        }

        .lider-acciones-table td:nth-child(7) .btn,
        .lider-acciones-table td:nth-child(8) .btn,
        .lider-acciones-table td:nth-child(9) .btn {
            width: 100%;
        }


        .auditoria-panel {
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 2px 7px rgba(0, 0, 0, 0.08);
        }

        .auditoria-heading {
            cursor: pointer;
            user-select: none;
            transition: background 0.2s ease;
        }

        .auditoria-heading:hover {
            background: #257fb0 !important;
        }

        .auditoria-heading .panel-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .auditoria-title-main {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .auditoria-badge {
            background: #fff !important;
            color: #2f97ce !important;
            font-weight: 700;
            padding: 5px 9px;
        }

        .auditoria-help {
            font-size: 12px;
            font-weight: 600;
            opacity: 0.95;
            white-space: nowrap;
        }

        .auditoria-chevron {
            margin-right: 5px;
            transition: transform 0.2s ease;
        }

        .auditoria-heading[aria-expanded="true"] .auditoria-chevron {
            transform: rotate(180deg);
        }

        .auditoria-collapse {
            border-top: 1px solid #d9edf7;
        }

        .bloque-sin-atender {
            max-width: 1500px;
            margin: 0 auto 25px auto;
        }

        .sin-atender-header {
            background: #8a5a00;
            color: #fff;
            padding: 14px 18px;
            border-radius: 8px 8px 0 0;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sin-atender-header:hover {
            background: #704800;
        }

        .sin-atender-body {
            border: 1px solid #d6c28a;
            border-top: 0;
            padding: 15px;
            background: #fffdf7;
            border-radius: 0 0 8px 8px;
            display: none;
        }

        .sin-atender-resumen {
            margin-bottom: 15px;
        }

        .sin-atender-badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 14px;
            font-size: 12px;
            font-weight: bold;
            margin-right: 8px;
        }

        .sin-atender-badge-nc {
            background: #b94a48;
            color: #fff;
        }

        .sin-atender-badge-om {
            background: #31708f;
            color: #fff;
        }

        .auditoria-pendiente-card {
            margin-bottom: 15px;
            border: 1px solid #d6c28a;
            border-radius: 6px;
            background: #fff;
        }

        .auditoria-pendiente-title {
            background: #f3e3b1;
            color: #4d3500;
            padding: 10px 12px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .auditoria-pendiente-title:hover {
            background: #ead38c;
        }

        .auditoria-pendiente-body {
            display: none;
            padding: 12px;
        }

        .tabla-sin-atender {
            width: 100%;
            table-layout: fixed;
            font-size: 12px;
        }

        .tabla-sin-atender th,
        .tabla-sin-atender td {
            vertical-align: top !important;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .tabla-sin-atender th:nth-child(1),
        .tabla-sin-atender td:nth-child(1) {
            width: 8%;
        }

        .tabla-sin-atender th:nth-child(2),
        .tabla-sin-atender td:nth-child(2) {
            width: 10%;
        }

        .tabla-sin-atender th:nth-child(3),
        .tabla-sin-atender td:nth-child(3) {
            width: 15%;
        }

        .tabla-sin-atender th:nth-child(4),
        .tabla-sin-atender td:nth-child(4) {
            width: 32%;
        }

        .tabla-sin-atender th:nth-child(5),
        .tabla-sin-atender td:nth-child(5) {
            width: 14%;
        }

        .tabla-sin-atender th:nth-child(6),
        .tabla-sin-atender td:nth-child(6) {
            width: 10%;
        }

        .tabla-sin-atender th:nth-child(7),
        .tabla-sin-atender td:nth-child(7) {
            width: 11%;
        }

        .reporte-auditor-scroll {
            max-height: 90px;
            overflow-y: auto;
            overflow-x: hidden;
            padding-right: 5px;
            text-align: justify;
        }

        .estado-sin-atender {
            display: inline-block;
            background: #f0ad4e;
            color: #fff;
            padding: 4px 7px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
        }

        .estado-en-captura {
            display: inline-block;
            background: #5bc0de;
            color: #fff;
            padding: 4px 7px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
        }

        .texto-ayuda-sin-atender {
            color: #6f5b24;
            font-size: 12px;
            margin-bottom: 12px;
        }

        /* ============================
           Ajuste jerárquico por auditoría
           Auditoría -> Sin atender / En seguimiento
           ============================ */

        .auditoria-panel {
            border: 1px solid #c7d7e2;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .auditoria-heading {
            background: #1f4e79 !important;
            color: #fff !important;
            cursor: pointer;
        }

        .auditoria-heading:hover {
            background: #173b5c !important;
        }

        .auditoria-titulo-principal {
            font-size: 17px;
            font-weight: 700;
            margin-right: 10px;
        }

        .auditoria-badge-pendiente {
            background: #f0ad4e !important;
            color: #fff !important;
            font-weight: 700;
            padding: 6px 10px;
        }

        .auditoria-badge-seguimiento {
            background: #5cb85c !important;
            color: #fff !important;
            font-weight: 700;
            padding: 6px 10px;
        }

        .seccion-auditoria {
            border: 1px solid #d8e2ea;
            border-radius: 6px;
            margin-bottom: 18px;
            background: #fff;
        }

        .seccion-auditoria-header {
            padding: 11px 14px;
            font-size: 14px;
            border-bottom: 1px solid #d8e2ea;
        }

        .seccion-auditoria-header small {
            display: block;
            margin-top: 3px;
            font-size: 12px;
            font-weight: 600;
        }

        .seccion-auditoria-body {
            padding: 14px;
        }

        .seccion-sin-atender {
            border-left: 5px solid #f0ad4e;
        }

        .seccion-sin-atender .seccion-auditoria-header {
            background: #fff7e8;
            color: #6b4300;
        }

        .seccion-seguimiento {
            border-left: 5px solid #5cb85c;
        }

        .seccion-seguimiento .seccion-auditoria-header {
            background: #eef9ef;
            color: #2f6627;
        }

        .tabla-sin-atender {
            width: 100%;
            table-layout: fixed;
            font-size: 12px;
        }

        .tabla-sin-atender th,
        .tabla-sin-atender td {
            vertical-align: top !important;
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal !important;
            padding: 6px 5px !important;
        }

        .tabla-sin-atender th:nth-child(1),
        .tabla-sin-atender td:nth-child(1) {
            width: 9%;
        }

        .tabla-sin-atender th:nth-child(2),
        .tabla-sin-atender td:nth-child(2) {
            width: 16%;
        }

        .tabla-sin-atender th:nth-child(3),
        .tabla-sin-atender td:nth-child(3) {
            width: 35%;
        }

        .tabla-sin-atender th:nth-child(4),
        .tabla-sin-atender td:nth-child(4) {
            width: 15%;
        }

        .tabla-sin-atender th:nth-child(5),
        .tabla-sin-atender td:nth-child(5) {
            width: 10%;
            text-align: center;
        }

        .tabla-sin-atender th:nth-child(6),
        .tabla-sin-atender td:nth-child(6) {
            width: 15%;
        }

        .tabla-sin-atender thead tr {
            background: #f7f7f7;
        }

        .estado-sin-atender {
            display: inline-block;
            background: #f0ad4e;
            color: #fff;
            padding: 4px 7px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
        }

        .estado-en-captura {
            display: inline-block;
            background: #5bc0de;
            color: #fff;
            padding: 4px 7px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
        }

        .texto-seccion-vacia {
            margin-bottom: 0;
        }

        .panel-control-acciones {
            border-left: 5px solid #337ab7;
            margin-bottom: 18px;
        }

        .panel-control-acciones.panel-cerrado {
            border-left-color: #d9534f;
        }

        .panel-control-acciones.panel-abierto {
            border-left-color: #5cb85c;
        }

        .btn-quitar-validacion {
            width: 100%;
            margin-top: 6px;
            white-space: normal;
        }

    </style>

    <div class="container-fluid lider-nc-container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h2 class="panel-title text-center">Acciones de Responsables</h2>
            </div>
        </div>
        @php
            $accionesAgrupadas = isset($accionesAgrupadas) ? collect($accionesAgrupadas) : collect();
            $asignadasSinAtender = isset($asignadasSinAtender) ? collect($asignadasSinAtender) : collect();
            $ncSinAtender = isset($ncSinAtender) ? collect($ncSinAtender) : collect();
            $omSinAtender = isset($omSinAtender) ? collect($omSinAtender) : collect();
            $sinAtenderAgrupadas = isset($sinAtenderAgrupadas) ? collect($sinAtenderAgrupadas) : collect();
            $moduloAccionesCerrado = isset($moduloAccionesCerrado) ? $moduloAccionesCerrado : false;
            $mensajeCierreAcciones = isset($mensajeCierreAcciones) ? $mensajeCierreAcciones : 'El sistema fue cerrado. Contacte al líder.';
        @endphp

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

        @if(session('warning'))
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('warning') }}
            </div>
        @endif

        @if($esLiderActivo)
            <div class="panel panel-default panel-control-acciones {{ $moduloAccionesCerrado ? 'panel-cerrado' : 'panel-abierto' }}">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8">
                            <strong>Estado del módulo No conformidades y acciones correctivas:</strong>
                            @if($moduloAccionesCerrado)
                                <span class="label label-danger">Cerrado</span>
                                <p style="margin-top: 8px; margin-bottom: 0;">
                                    {{ $mensajeCierreAcciones }}
                                </p>
                            @else
                                <span class="label label-success">Activo</span>
                                <p style="margin-top: 8px; margin-bottom: 0;">
                                    Los responsables pueden capturar y actualizar acciones correctivas.
                                </p>
                            @endif
                        </div>

                        <div class="col-md-4 text-right">
                            @if($moduloAccionesCerrado)
                                <form method="POST"
                                      action="{{ route('auditorias.lider_acciones.reactivar_acciones_correctivas') }}"
                                      onsubmit="return confirm('¿Deseas reactivar el sistema de acciones correctivas?');">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-unlock"></i>
                                        Reactivar sistema
                                    </button>
                                </form>
                            @else
                                <form method="POST"
                                      action="{{ route('auditorias.lider_acciones.cerrar_acciones_correctivas') }}"
                                      onsubmit="return confirm('¿Deseas cerrar el sistema de acciones correctivas para los responsables?');">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-lock"></i>
                                        Cerrar sistema
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(!$esLiderActivo)
            <div class="alert alert-info text-center mt-4">
                <h4>Hola, aún no estás asignado como líder.</h4>
                <p>Una vez que se te asigne como líder de acciones, podrás ver aquí las actividades correspondientes.</p>
            </div>

        @elseif($accionesAgrupadas->isEmpty() && $sinAtenderAgrupadas->isEmpty())
            <div class="alert alert-warning text-center">
                No hay no conformidades u oportunidades de mejora asignadas, sin atender o enviadas para revisión.
            </div>

        @else
            @php
                $auditoriasCombinadas = $accionesAgrupadas
                    ->keys()
                    ->merge($sinAtenderAgrupadas->keys())
                    ->unique()
                    ->sort(function ($a, $b) {
                        return strnatcasecmp($b, $a);
                    })
                    ->values();
            @endphp

            @foreach($auditoriasCombinadas as $numeroAuditoria)
                @php
                    $bloques = $accionesAgrupadas->get($numeroAuditoria, [
                        'NC' => collect(),
                        'OM' => collect(),
                    ]);

                    $bloquesPendientes = $sinAtenderAgrupadas->get($numeroAuditoria, [
                        'NC' => collect(),
                        'OM' => collect(),
                    ]);

                    $accionesNC = collect($bloques['NC'] ?? []);
                    $accionesOM = collect($bloques['OM'] ?? []);

                    $pendientesNC = collect($bloquesPendientes['NC'] ?? []);
                    $pendientesOM = collect($bloquesPendientes['OM'] ?? []);

                    $totalSinAtender = $pendientesNC->count() + $pendientesOM->count();
                    $totalSeguimiento = $accionesNC->count() + $accionesOM->count();

                    $collapseId = 'auditoria-collapse-' . $loop->iteration;
                @endphp

                <div class="panel panel-primary auditoria-panel" style="margin-top: 18px;">
                    <div class="panel-heading auditoria-heading"
                         role="button"
                         data-toggle="collapse"
                         data-target="#{{ $collapseId }}"
                         aria-expanded="false"
                         aria-controls="{{ $collapseId }}">
                        <h3 class="panel-title">
                            <span class="auditoria-title-main">
                                <span class="auditoria-titulo-principal">
                                    Auditoría: {{ $numeroAuditoria }}
                                </span>

                                <span class="badge auditoria-badge-pendiente">
                                    Sin atender: {{ $totalSinAtender }}
                                </span>

                                <span class="badge auditoria-badge-seguimiento">
                                    En seguimiento: {{ $totalSeguimiento }}
                                </span>
                            </span>

                            <span class="auditoria-help">
                                <i class="fa fa-chevron-down auditoria-chevron"></i>
                                Clic para desplegar
                            </span>
                        </h3>
                    </div>

                    <div id="{{ $collapseId }}" class="panel-collapse collapse auditoria-collapse" role="tabpanel">
                        <div class="panel-body">

                            <div class="seccion-auditoria seccion-sin-atender">
                                <div class="seccion-auditoria-header">
                                    <div>
                                        <strong>1. Asignadas sin atender</strong>
                                        <small>
                                            NC: {{ $pendientesNC->count() }} |
                                            OM: {{ $pendientesOM->count() }}
                                        </small>
                                    </div>
                                </div>

                                <div class="seccion-auditoria-body">
                                    @if($totalSinAtender === 0)
                                        <div class="alert alert-success texto-seccion-vacia">
                                            No hay NC u OM asignadas sin atender en esta auditoría.
                                        </div>
                                    @else
                                        @foreach([
                                            'NC' => 'No conformidades sin atender',
                                            'OM' => 'Oportunidades de mejora sin atender'
                                        ] as $categoriaPendiente => $tituloPendiente)

                                            @php
                                                $pendientesCategoria = $categoriaPendiente === 'NC' ? $pendientesNC : $pendientesOM;
                                                $labelClasePendiente = $categoriaPendiente === 'NC' ? 'danger' : 'info';
                                            @endphp

                                            @if($pendientesCategoria->count() > 0)
                                                <h4 style="margin-top: 15px;">
                                                    <span class="label label-{{ $labelClasePendiente }}">
                                                        {{ $categoriaPendiente }}
                                                    </span>
                                                    {{ $tituloPendiente }}
                                                </h4>

                                                <table class="table table-bordered table-condensed tabla-sin-atender">
                                                    <thead>
                                                    <tr>
                                                        <th>Clave</th>
                                                        <th>Responsable asignado</th>
                                                        <th>Reporte levantado por el auditor</th>
                                                        <th>Punto / proceso</th>
                                                        <th>Plan</th>
                                                        <th>Situación</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    @foreach($pendientesCategoria as $accion)
                                                        <tr>
                                                            <td>{{ $accion->clave_nota ?? 'Sin clave' }}</td>

                                                            <td>{{ $accion->responsable_nombre ?? 'Sin responsable' }}</td>

                                                            <td>
                                                                <div class="reporte-auditor-scroll">
                                                                    @if(!empty($accion->reporte_auditor))
                                                                        {!! nl2br(e($accion->reporte_auditor)) !!}
                                                                    @elseif(!empty($accion->observaciones_auditor))
                                                                        {!! nl2br(e($accion->observaciones_auditor)) !!}
                                                                    @else
                                                                        <span class="text-muted">Sin reporte registrado</span>
                                                                    @endif
                                                                </div>
                                                            </td>

                                                            <td>{{ $accion->punto_proceso ?? 'No especificado' }}</td>

                                                            <td>
                                                                @if((int) $accion->total_acciones_plan === 0)
                                                                    <span class="label label-default">Sin plan</span>
                                                                @else
                                                                    <span class="label label-info">
                                                                        {{ $accion->total_acciones_plan }} acción(es)
                                                                    </span>
                                                                @endif
                                                            </td>

                                                            <td>
                                                                @if((int) $accion->total_acciones_plan === 0)
                                                                    <span class="estado-sin-atender">
                                                                        {{ $accion->situacion }}
                                                                    </span>
                                                                @else
                                                                    <span class="estado-en-captura">
                                                                        {{ $accion->situacion }}
                                                                    </span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="seccion-auditoria seccion-seguimiento">
                                <div class="seccion-auditoria-header">
                                    <div>
                                        <strong>2. En seguimiento / atendidas</strong>
                                        <small>
                                            NC: {{ $accionesNC->count() }} |
                                            OM: {{ $accionesOM->count() }}
                                        </small>
                                    </div>
                                </div>

                                <div class="seccion-auditoria-body">
                                    @if($totalSeguimiento === 0)
                                        <div class="alert alert-info texto-seccion-vacia">
                                            No hay NC u OM en seguimiento o atendidas en esta auditoría.
                                        </div>
                                    @else
                                        @foreach([
                                            'NC' => 'No conformidades',
                                            'OM' => 'Oportunidades de mejora'
                                        ] as $categoria => $tituloCategoria)

                                            @php
                                                $accionesCategoria = collect($bloques[$categoria] ?? []);
                                            @endphp

                                            <h4 style="margin-top: 20px;">
                                                @if($categoria == 'NC')
                                                    <span class="label label-danger">NC</span>
                                                @else
                                                    <span class="label label-success">OM</span>
                                                @endif

                                                {{ $tituloCategoria }}
                                            </h4>

                                            @if($accionesCategoria->isEmpty())
                                                <div class="alert alert-info">
                                                    No hay registros en esta categoría.
                                                </div>
                                            @else
                                                <div class="lider-table-wrapper">
                                                    <table class="table table-bordered table-striped lider-acciones-table">
                                                        <colgroup>
                                                            <col style="width: 3%;">
                                                            <col style="width: 6%;">
                                                            <col style="width: 11%;">
                                                            <col style="width: 22%;">
                                                            <col style="width: 5%;">
                                                            <col style="width: 6%;">
                                                            <col style="width: 8%;">
                                                            <col style="width: 9%;">
                                                            <col style="width: 11%;">
                                                            <col style="width: 7%;">
                                                            <col style="width: 12%;">
                                                        </colgroup>
                                                        <thead>
                                                        <tr>
                                                            <th style="width: 40px;">#</th>
                                                            <th>Clave</th>
                                                            <th>Responsable</th>
                                                            <th>Reporte levantado por el auditor</th>
                                                            <th>Requiere Acción</th>
                                                            <th>Requiere Corrección</th>
                                                            <th>Detalles</th>
                                                            <th>Reporte</th>
                                                            <th>Ver Plan de Acciones</th>
                                                            <th>Estado</th>
                                                            <th>Evaluar</th>
                                                        </tr>
                                                        </thead>

                                                        <tbody>
                                                        @foreach($accionesCategoria as $index => $accion)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>

                                                                <td>
                                                                    {{ $accion->clave_nota ?? 'Sin clave' }}
                                                                </td>

                                                                <td>
                                                                    {{ $accion->responsable_nombre ?? 'No disponible' }}
                                                                </td>

                                                                <td>
                                                                    <div class="reporte-auditor-scroll">
                                                                        @if(!empty($accion->reporte_auditor))
                                                                            {!! nl2br(e($accion->reporte_auditor)) !!}
                                                                        @elseif(!empty($accion->observaciones_auditor))
                                                                            {!! nl2br(e($accion->observaciones_auditor)) !!}
                                                                        @else
                                                                            <span class="text-muted">Sin reporte registrado</span>
                                                                        @endif
                                                                    </div>
                                                                </td>

                                                                <td>{{ $accion->requiere_accion ? 'Sí' : 'No' }}</td>

                                                                <td>{{ $accion->requiere_correccion ? 'Sí' : 'No' }}</td>

                                                                <td>
                                                                    <button class="btn btn-sm btn-success"
                                                                            data-toggle="modal"
                                                                            data-target="#modal{{ $accion->id_responsable }}">
                                                                        Ver más detalles
                                                                    </button>

                                                                    <div class="modal fade" id="modal{{ $accion->id_responsable }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $accion->id_responsable }}" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="modalLabel{{ $accion->id_responsable }}">
                                                                                        Detalles de la Acción
                                                                                    </h5>

                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>

                                                                                <div class="modal-body">
                                                                                    <p><strong>Análisis:</strong> {{ $accion->analisis ?? 'Sin Análisis' }}</p>
                                                                                    <p><strong>Acción correctiva a realizar:</strong> {{ $accion->accion_correctiva ?? 'Sin Acción correctiva' }}</p>
                                                                                    <p><strong>Corrección a realizar:</strong> {{ $accion->causa_raiz ?? 'Sin corrección' }}</p>
                                                                                    <p><strong>Actualización de riesgos y oportunidades:</strong> {{ $accion->actualizacion_riesgos ? 'Sí' : 'No' }}</p>
                                                                                    <p><strong>¿Por qué?:</strong> {{ $accion->valor_actr ?? 'Sin Valor ACTR' }}</p>
                                                                                    <p><strong>Cambios al sistema de gestión para organizaciones educativas:</strong> {{ $accion->cambios_sistema ? 'Sí' : 'No' }}</p>
                                                                                    <p><strong>¿Por qué?:</strong> {{ $accion->valor_cambios ?? 'Sin Valor Cambios' }}</p>
                                                                                </div>

                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                                        Cerrar
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    @if((int) $accion->id_clasificacion === 1)
                                                                        @if((int) $accion->estado === 6)
                                                                            <a href="{{ route('auditorias.lider_acciones.reporte_nc', $accion->id_responsable) }}"
                                                                               class="btn btn-info btn-sm">
                                                                                Ver reporte NC
                                                                            </a>
                                                                        @else
                                                                            <button type="button" class="btn btn-default btn-sm" disabled>
                                                                                Pendiente de validación
                                                                            </button>
                                                                        @endif
                                                                    @else
                                                                        @if((int) $accion->estado === 6 && \Illuminate\Support\Facades\Route::has('auditorias.lider_acciones.reporte_om'))
                                                                            <a href="{{ route('auditorias.lider_acciones.reporte_om', $accion->id_responsable) }}"
                                                                               class="btn btn-success btn-sm">
                                                                                Ver reporte OM
                                                                            </a>
                                                                        @else
                                                                            <button type="button" class="btn btn-default btn-sm" disabled>
                                                                                Pendiente de validación
                                                                            </button>
                                                                        @endif
                                                                    @endif
                                                                </td>

                                                                <td>
                                                                    <button class="btn btn-warning btn-sm"
                                                                            data-toggle="modal"
                                                                            data-target="#modalDetalle{{ $accion->id_responsable }}">
                                                                        Ver Plan de Acciones
                                                                    </button>

                                                                    @php
                                                                        $planAcciones = \DB::table('aud_plan_acciones')
                                                                            ->where('id_responsable', $accion->id_responsable)
                                                                            ->whereNull('deleted_at')
                                                                            ->get();

                                                                        $accionesCorrectivas = $planAcciones->where('tipo', 1);
                                                                        $correcciones = $planAcciones->where('tipo', 2);
                                                                        $accionesOMPlan = $planAcciones->where('tipo', 3);
                                                                    @endphp

                                                                    <div class="modal fade" id="modalDetalle{{ $accion->id_responsable }}" tabindex="-1" role="dialog" aria-labelledby="modalDetalleLabel{{ $accion->id_responsable }}" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="modalDetalleLabel{{ $accion->id_responsable }}">
                                                                                        Actividades y Correcciones
                                                                                    </h5>

                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>

                                                                                <div class="modal-body">
                                                                                    @if($planAcciones->isEmpty())
                                                                                        <div class="alert alert-info">
                                                                                            No hay acciones ni correcciones registradas.
                                                                                        </div>
                                                                                    @else
                                                                                        <table class="table table-sm table-bordered">
                                                                                            <thead>
                                                                                            <tr>
                                                                                                <th>Acción / Corrección</th>
                                                                                                <th>Responsable de Implantar</th>
                                                                                                <th>Fecha de Implantación</th>
                                                                                                <th>Responsable de Revisar</th>
                                                                                                <th>Fecha de Verificación</th>
                                                                                                <th>Evidencia</th>
                                                                                            </tr>
                                                                                            </thead>

                                                                                            <tbody>
                                                                                            @if($accionesCorrectivas->count() > 0)
                                                                                                <tr class="table-primary">
                                                                                                    <td colspan="6">
                                                                                                        <strong style="color:blue;">Acciones Correctivas NC</strong>
                                                                                                    </td>
                                                                                                </tr>

                                                                                                @foreach($accionesCorrectivas as $plan)
                                                                                                    @php
                                                                                                        $implantador = \DB::table('gnral_personales')->where('id_personal', $plan->id_responsable_implantar)->value('nombre');
                                                                                                        $revisor = \DB::table('gnral_personales')->where('id_personal', $plan->id_responsable_revisar)->value('nombre');
                                                                                                        $evidencia = \DB::table('aud_evidencias')->where('id_evidencia', $plan->id_evidencia)->value('descripcion');
                                                                                                    @endphp

                                                                                                    <tr>
                                                                                                        <td>{{ $plan->acciones ?? 'Sin descripción' }}</td>
                                                                                                        <td>{{ $implantador ?? 'Sin responsable' }}</td>
                                                                                                        <td>{{ $plan->fecha_implantar_accion ?? 'Sin fecha' }}</td>
                                                                                                        <td>{{ $revisor ?? 'Sin responsable' }}</td>
                                                                                                        <td>{{ $plan->fecha_verificacion ?? 'Sin fecha' }}</td>
                                                                                                        <td>
                                                                                                            <div>{{ $evidencia ?? 'Sin evidencia' }}</div>

                                                                                                            @if(!empty($plan->path_evidencia))
                                                                                                                @if(\Illuminate\Support\Facades\Route::has('aud_seguimiento.descargar'))
                                                                                                                    <a href="{{ route('aud_seguimiento.descargar', $plan->id_plan_acciones) }}"
                                                                                                                       target="_blank"
                                                                                                                       class="btn btn-xs btn-info"
                                                                                                                       style="margin-top: 4px;">
                                                                                                                        Ver PDF
                                                                                                                    </a>
                                                                                                                @else
                                                                                                                    <a href="{{ asset('storage/' . ltrim($plan->path_evidencia, '/')) }}"
                                                                                                                       target="_blank"
                                                                                                                       class="btn btn-xs btn-info"
                                                                                                                       style="margin-top: 4px;">
                                                                                                                        Ver PDF
                                                                                                                    </a>
                                                                                                                @endif
                                                                                                            @else
                                                                                                                <div class="text-muted" style="margin-top: 4px;">Sin PDF cargado</div>
                                                                                                            @endif

                                                                                                            @if(isset($plan->estado) && (int) $plan->estado === 1)
                                                                                                                <span class="label label-success" style="display: inline-block; margin-top: 4px;">Autorizada</span>
                                                                                                            @elseif(isset($plan->estado) && (int) $plan->estado === 2)
                                                                                                                <span class="label label-warning" style="display: inline-block; margin-top: 4px;">En revisión</span>
                                                                                                            @elseif(isset($plan->estado) && (int) $plan->estado === 3)
                                                                                                                <span class="label label-danger" style="display: inline-block; margin-top: 4px;">Rechazada</span>
                                                                                                            @else
                                                                                                                <span class="label label-default" style="display: inline-block; margin-top: 4px;">Pendiente</span>
                                                                                                            @endif
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                @endforeach
                                                                                            @endif

                                                                                            @if($correcciones->count() > 0)
                                                                                                <tr class="table-warning">
                                                                                                    <td colspan="6">
                                                                                                        <strong style="color:blue;">Correcciones NC</strong>
                                                                                                    </td>
                                                                                                </tr>

                                                                                                @foreach($correcciones as $plan)
                                                                                                    @php
                                                                                                        $implantador = \DB::table('gnral_personales')->where('id_personal', $plan->id_responsable_implantar)->value('nombre');
                                                                                                        $revisor = \DB::table('gnral_personales')->where('id_personal', $plan->id_responsable_revisar)->value('nombre');
                                                                                                        $evidencia = \DB::table('aud_evidencias')->where('id_evidencia', $plan->id_evidencia)->value('descripcion');
                                                                                                    @endphp

                                                                                                    <tr>
                                                                                                        <td>{{ $plan->acciones ?? 'Sin descripción' }}</td>
                                                                                                        <td>{{ $implantador ?? 'Sin responsable' }}</td>
                                                                                                        <td>{{ $plan->fecha_implantar_accion ?? 'Sin fecha' }}</td>
                                                                                                        <td>{{ $revisor ?? 'Sin responsable' }}</td>
                                                                                                        <td>{{ $plan->fecha_verificacion ?? 'Sin fecha' }}</td>
                                                                                                        <td>
                                                                                                            <div>{{ $evidencia ?? 'Sin evidencia' }}</div>

                                                                                                            @if(!empty($plan->path_evidencia))
                                                                                                                @if(\Illuminate\Support\Facades\Route::has('aud_seguimiento.descargar'))
                                                                                                                    <a href="{{ route('aud_seguimiento.descargar', $plan->id_plan_acciones) }}"
                                                                                                                       target="_blank"
                                                                                                                       class="btn btn-xs btn-info"
                                                                                                                       style="margin-top: 4px;">
                                                                                                                        Ver PDF
                                                                                                                    </a>
                                                                                                                @else
                                                                                                                    <a href="{{ asset('storage/' . ltrim($plan->path_evidencia, '/')) }}"
                                                                                                                       target="_blank"
                                                                                                                       class="btn btn-xs btn-info"
                                                                                                                       style="margin-top: 4px;">
                                                                                                                        Ver PDF
                                                                                                                    </a>
                                                                                                                @endif
                                                                                                            @else
                                                                                                                <div class="text-muted" style="margin-top: 4px;">Sin PDF cargado</div>
                                                                                                            @endif

                                                                                                            @if(isset($plan->estado) && (int) $plan->estado === 1)
                                                                                                                <span class="label label-success" style="display: inline-block; margin-top: 4px;">Autorizada</span>
                                                                                                            @elseif(isset($plan->estado) && (int) $plan->estado === 2)
                                                                                                                <span class="label label-warning" style="display: inline-block; margin-top: 4px;">En revisión</span>
                                                                                                            @elseif(isset($plan->estado) && (int) $plan->estado === 3)
                                                                                                                <span class="label label-danger" style="display: inline-block; margin-top: 4px;">Rechazada</span>
                                                                                                            @else
                                                                                                                <span class="label label-default" style="display: inline-block; margin-top: 4px;">Pendiente</span>
                                                                                                            @endif
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                @endforeach
                                                                                            @endif

                                                                                            @if($accionesOMPlan->count() > 0)
                                                                                                <tr class="table-success">
                                                                                                    <td colspan="6">
                                                                                                        <strong style="color:blue;">Acciones de oportunidad de mejora</strong>
                                                                                                    </td>
                                                                                                </tr>

                                                                                                @foreach($accionesOMPlan as $plan)
                                                                                                    @php
                                                                                                        $implantador = \DB::table('gnral_personales')->where('id_personal', $plan->id_responsable_implantar)->value('nombre');
                                                                                                        $revisor = \DB::table('gnral_personales')->where('id_personal', $plan->id_responsable_revisar)->value('nombre');
                                                                                                        $evidencia = \DB::table('aud_evidencias')->where('id_evidencia', $plan->id_evidencia)->value('descripcion');
                                                                                                    @endphp

                                                                                                    <tr>
                                                                                                        <td>{{ $plan->acciones ?? 'Sin descripción' }}</td>
                                                                                                        <td>{{ $implantador ?? 'Sin responsable' }}</td>
                                                                                                        <td>{{ $plan->fecha_implantar_accion ?? 'Sin fecha' }}</td>
                                                                                                        <td>{{ $revisor ?? 'Sin responsable' }}</td>
                                                                                                        <td>{{ $plan->fecha_verificacion ?? 'Sin fecha' }}</td>
                                                                                                        <td>
                                                                                                            <div>{{ $evidencia ?? 'Sin evidencia' }}</div>

                                                                                                            @if(!empty($plan->path_evidencia))
                                                                                                                @if(\Illuminate\Support\Facades\Route::has('aud_seguimiento.descargar'))
                                                                                                                    <a href="{{ route('aud_seguimiento.descargar', $plan->id_plan_acciones) }}"
                                                                                                                       target="_blank"
                                                                                                                       class="btn btn-xs btn-info"
                                                                                                                       style="margin-top: 4px;">
                                                                                                                        Ver PDF
                                                                                                                    </a>
                                                                                                                @else
                                                                                                                    <a href="{{ asset('storage/' . ltrim($plan->path_evidencia, '/')) }}"
                                                                                                                       target="_blank"
                                                                                                                       class="btn btn-xs btn-info"
                                                                                                                       style="margin-top: 4px;">
                                                                                                                        Ver PDF
                                                                                                                    </a>
                                                                                                                @endif
                                                                                                            @else
                                                                                                                <div class="text-muted" style="margin-top: 4px;">Sin PDF cargado</div>
                                                                                                            @endif

                                                                                                            @if(isset($plan->estado) && (int) $plan->estado === 1)
                                                                                                                <span class="label label-success" style="display: inline-block; margin-top: 4px;">Autorizada</span>
                                                                                                            @elseif(isset($plan->estado) && (int) $plan->estado === 2)
                                                                                                                <span class="label label-warning" style="display: inline-block; margin-top: 4px;">En revisión</span>
                                                                                                            @elseif(isset($plan->estado) && (int) $plan->estado === 3)
                                                                                                                <span class="label label-danger" style="display: inline-block; margin-top: 4px;">Rechazada</span>
                                                                                                            @else
                                                                                                                <span class="label label-default" style="display: inline-block; margin-top: 4px;">Pendiente</span>
                                                                                                            @endif
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                @endforeach
                                                                                            @endif

                                                                                            @if($accionesCorrectivas->count() == 0 && $correcciones->count() == 0 && $accionesOMPlan->count() == 0)
                                                                                                <tr>
                                                                                                    <td colspan="6" class="text-center text-muted">
                                                                                                        No hay acciones registradas.
                                                                                                    </td>
                                                                                                </tr>
                                                                                            @endif
                                                                                            </tbody>
                                                                                        </table>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    @php
                                                                        if (isset($accion->estado_cierre) && (int) $accion->estado_cierre === 3) {
                                                                            $estadoTexto = (int) $accion->id_clasificacion === 1 ? 'NC cerrada' : 'OM cerrada';
                                                                            $labelClass = 'success';
                                                                        } else {
                                                                            switch((int) $accion->estado) {
                                                                                case 3:
                                                                                    $estadoTexto = 'Sin revisar';
                                                                                    $labelClass = 'default';
                                                                                    break;
                                                                                case 6:
                                                                                    $estadoTexto = 'Validado';
                                                                                    $labelClass = 'primary';
                                                                                    break;
                                                                                case 7:
                                                                                    $estadoTexto = 'Regresado';
                                                                                    $labelClass = 'danger';
                                                                                    break;
                                                                                default:
                                                                                    $estadoTexto = 'Desconocido';
                                                                                    $labelClass = 'default';
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    <span class="label label-{{ $labelClass }}">{{ $estadoTexto }}</span>

                                                                    @if((int) $accion->estado === 6 && (!isset($accion->estado_cierre) || (int) $accion->estado_cierre !== 3))
                                                                        <form method="POST"
                                                                              action="{{ route('auditorias.lider_acciones.quitar_validacion', $accion->id_responsable) }}"
                                                                              onsubmit="return confirm('¿Deseas quitar la validación y regresar este registro a estado Sin revisar?');">
                                                                            @csrf
                                                                            <button type="submit" class="btn btn-warning btn-xs btn-quitar-validacion">
                                                                                Quitar validación
                                                                            </button>
                                                                        </form>
                                                                    @endif

                                                                    @if($accion->estado == 7)
                                                                        <div style="margin-top: 5px;">
                                                                            <button class="btn btn-sm btn-danger"
                                                                                    title="Ver observaciones del líder"
                                                                                    data-toggle="modal"
                                                                                    data-target="#modalObsLider{{ $accion->id_responsable }}">
                                                                                <i class="fa fa-eye"></i>
                                                                            </button>
                                                                        </div>

                                                                        <div class="modal fade" id="modalObsLider{{ $accion->id_responsable }}" tabindex="-1" role="dialog" aria-labelledby="obsLabel{{ $accion->id_responsable }}" aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header bg-danger text-white">
                                                                                        <h5 class="modal-title" id="obsLabel{{ $accion->id_responsable }}">
                                                                                            Observaciones del líder
                                                                                        </h5>

                                                                                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>

                                                                                    <div class="modal-body">
                                                                                        <p>{{ $accion->observaciones_lider ?? 'Sin observaciones.' }}</p>
                                                                                    </div>

                                                                                    <div class="modal-footer">
                                                                                        <button class="btn btn-secondary" data-dismiss="modal">
                                                                                            Cerrar
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </td>

                                                                <td>
                                                                    <form id="form-{{ $accion->id_responsable }}"
                                                                          method="POST"
                                                                          action="{{ route('auditorias.evaluar', $accion->id_responsable) }}">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        <select class="form-control form-control-sm"
                                                                                name="estado"
                                                                                {{ in_array($accion->estado, [6, 7]) ? 'disabled' : '' }}
                                                                                required>
                                                                            <option value="">-- Selecciona --</option>
                                                                            <option value="6">Validar</option>
                                                                            <option value="7">Rechazar</option>
                                                                        </select>

                                                                        <input type="hidden"
                                                                               name="observaciones_lider"
                                                                               id="observaciones_lider_{{ $accion->id_responsable }}">

                                                                        <button type="button"
                                                                                class="btn btn-primary btn-sm mt-1"
                                                                                onclick="evaluarAccion({{ $accion->id_responsable }})"
                                                                                {{ in_array($accion->estado, [6, 7]) ? 'disabled' : '' }}>
                                                                            Guardar
                                                                        </button>
                                                                    </form>

                                                                    <div class="modal fade" id="modalObservaciones{{ $accion->id_responsable }}" tabindex="-1" role="dialog" aria-labelledby="modalObsLabel{{ $accion->id_responsable }}" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="modalObsLabel{{ $accion->id_responsable }}">
                                                                                        Observaciones del Rechazo
                                                                                    </h5>

                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>

                                                                                <div class="modal-body">
                                                            <textarea id="textareaObs{{ $accion->id_responsable }}"
                                                                      class="form-control"
                                                                      rows="4"
                                                                      placeholder="Escribe las observaciones..."></textarea>
                                                                                </div>

                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                                        Cancelar
                                                                                    </button>

                                                                                    <button type="button"
                                                                                            class="btn btn-primary"
                                                                                            onclick="guardarObservaciones({{ $accion->id_responsable }})">
                                                                                        Guardar Observaciones
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
    <script>
        function evaluarAccion(id) {
            const select = document.querySelector(`#form-${id} select[name="estado"]`);
            const valor = select.value;

            if (valor === "7") {
                // Abrir el modal para observaciones
                $('#modalObservaciones' + id).modal('show');
            } else if (valor === "6") {
                // Enviar el formulario directamente
                document.getElementById('form-' + id).submit();
            } else {
                alert('Por favor selecciona una opción de evaluación.');
            }
        }

        function guardarObservaciones(id) {
            const observacion = document.getElementById('textareaObs' + id).value.trim();

            if (observacion === "") {
                alert('Escribe una observación antes de continuar.');
                return;
            }

            // Rellenar el input oculto con la observación
            document.getElementById('observaciones_lider_' + id).value = observacion;

            // Enviar el formulario después de cerrar el modal
            const form = document.getElementById('form-' + id);

            // Espera 200ms para evitar problemas al cerrar el modal
            $('#modalObservaciones' + id).modal('hide');

            setTimeout(() => {
                form.submit();
            }, 200);
        }

        $(document).on('shown.bs.collapse', '.auditoria-collapse', function () {
            var heading = $('[data-target="#' + this.id + '"]');
            heading.attr('aria-expanded', 'true');
            heading.find('.auditoria-help').html('<i class="fa fa-chevron-down auditoria-chevron"></i> Clic para contraer');
        });

        $(document).on('hidden.bs.collapse', '.auditoria-collapse', function () {
            var heading = $('[data-target="#' + this.id + '"]');
            heading.attr('aria-expanded', 'false');
            heading.find('.auditoria-help').html('<i class="fa fa-chevron-down auditoria-chevron"></i> Clic para desplegar');
        });
    </script>
    {{--<script>
        function handleEvaluacion(select, id) {
            const estado = select.value;
            if (estado == "7") {
                $('#modalObservaciones' + id).modal('show');
            }
        }

        function guardarObservaciones(id) {
            const texto = document.getElementById('textareaObs' + id).value;
            document.getElementById('observaciones_lider_' + id).value = texto;
            $('#modalObservaciones' + id).modal('hide');
        }
    </script>--}}

@endsection