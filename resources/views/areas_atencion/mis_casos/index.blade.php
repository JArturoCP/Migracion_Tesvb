@extends('layouts.app')
@section('title', 'PIASE')
@section('content')
    {{-- PIASE-V3.9.9-ESTRELLAS-VISIBLES --}}
    <style>
        .piase-title-panel { margin-top: 10px; }
        .piase-main-wrap { width: 98%; margin: 0 auto; }
        .piase-table { table-layout: fixed; min-width: 1250px; width: 100%; }
        .piase-table td, .piase-table th { font-size: 11px; vertical-align: middle !important; }
        .piase-table th { white-space: nowrap; }
        .piase-col-alumno { min-width: 170px; max-width: 230px; }
        .piase-col-carrera { min-width: 130px; max-width: 190px; }
        .piase-col-semestre { width: 65px; }
        .piase-col-asignatura { min-width: 150px; max-width: 230px; }
        .piase-col-docente { min-width: 145px; max-width: 210px; }
        .piase-col-unidad { width: 62px; }
        .piase-col-estado { width: 90px; }
        .piase-col-accion { width: 150px; }
        .piase-wrap { white-space: normal; word-break: normal; overflow-wrap: break-word; }
        .piase-card { border:1px solid #ddd; border-radius:6px; padding:12px; margin-bottom:10px; background:#f9f9f9; min-height:100px; }
        .piase-card-number { font-size:24px; font-weight:bold; display:block; }
        .piase-cal { display:inline-block; min-width:38px; padding:3px 5px; border-radius:4px; color:#fff; font-weight:bold; text-align:center; }
        .piase-cal-ok { background:#337ab7; }
        .piase-cal-bad { background:#d9534f; }
        .piase-cal-empty { background:#999; }
        .piase-muted { color:#777; }
        .piase-actions .btn { margin-bottom:4px; white-space: normal; }
        .piase-tabs { margin-top:15px; }
        .piase-pending { padding:30px; border:1px dashed #bbb; background:#fafafa; text-align:center; color:#777; }
        .piase-modal .modal-dialog { max-width: 820px; width: calc(100% - 30px); }
        .piase-help { font-size:12px; color:#777; margin-top:4px; display:block; }
        .piase-dias-box { border:1px solid #d9edf7; background:#f5fbfe; border-radius:4px; padding:8px 10px; margin-bottom:8px; font-size:12px; color:#31708f; }
        .piase-dia-badge { display:inline-block; padding:3px 8px; margin:2px 3px 2px 0; border-radius:12px; background:#337ab7; color:#fff; font-weight:bold; font-size:11px; }
        .piase-dia-pendiente { color:#777; }
        .piase-slot-warning { display:none; margin-top:8px; }
        .piase-sticky-info { background:#f7f7f7; }
        .piase-student-cell { background:#fffdf5; }
        .piase-ruta { margin:0; padding-left:16px; font-size:11px; }
        .piase-ruta li { margin-bottom:4px; }
        .piase-stars { color:#d58512; font-size:16px; letter-spacing:1px; }
        .piase-rating-btn { margin-right:4px; margin-bottom:5px; letter-spacing:1px; }
        .piase-rating-btn.active { background:#f0ad4e; border-color:#eea236; color:#fff; }
        .piase-rating-text { margin-top:6px; display:block; color:#8a6d3b; }
        .piase-mini { font-size:11px; }

        .piase-agenda-card { border:1px solid #d9edf7; border-radius:8px; background:#fafdff; padding:10px; margin-bottom:8px; box-shadow:0 1px 3px rgba(0,0,0,.08); }
        .piase-agenda-date { display:inline-block; min-width:58px; border-radius:6px; background:#337ab7; color:#fff; text-align:center; padding:6px 5px; margin-right:8px; vertical-align:top; }
        .piase-agenda-day { display:block; font-size:20px; font-weight:bold; line-height:20px; }
        .piase-agenda-month { display:block; font-size:10px; text-transform:uppercase; }
        .piase-agenda-body { display:inline-block; width:calc(100% - 72px); vertical-align:top; }
        .piase-agenda-time { font-size:14px; font-weight:bold; color:#333; }
        .piase-agenda-place { color:#666; font-size:11px; }
        .piase-student-panel { border-left:5px solid #337ab7; }
        .piase-student-panel .panel-heading { background:#f7fbff; }
        .piase-ruta-modal .modal-dialog { width: calc(100% - 40px); max-width: 980px; }
        .piase-ruta-road { position:relative; padding:25px 10px 10px 10px; background:#f4f9fd; border-radius:10px; overflow:hidden; }
        .piase-ruta-road:before { content:''; position:absolute; left:35px; right:35px; top:78px; height:16px; background:#337ab7; border-radius:20px; box-shadow:0 2px 5px rgba(0,0,0,.2); }
        .piase-ruta-steps { position:relative; z-index:2; display:flex; flex-wrap:wrap; justify-content:space-between; gap:16px; }
        .piase-ruta-step { width:190px; min-height:170px; text-align:center; position:relative; margin-bottom:15px; }
        .piase-ruta-num { width:38px; height:38px; line-height:38px; border-radius:50%; background:#337ab7; color:#fff; font-weight:bold; font-size:18px; margin:0 auto 8px auto; box-shadow:0 1px 4px rgba(0,0,0,.25); }
        .piase-ruta-icon { width:72px; height:72px; line-height:72px; border-radius:50%; background:#eaf4ff; color:#337ab7; font-size:30px; margin:0 auto 8px auto; }
        .piase-ruta-label { display:inline-block; background:#d9edf7; border:1px solid #bce8f1; border-radius:18px; padding:7px 12px; font-weight:bold; color:#1f5f8b; margin-bottom:7px; }
        .piase-ruta-desc { font-size:11px; color:#333; background:rgba(255,255,255,.75); border-radius:6px; padding:6px; }
        .piase-ruta-empty { padding:30px; text-align:center; color:#777; }
        .piase-evo-section { margin-bottom:18px; }
        .piase-evo-title { margin:0 0 10px 0; font-weight:bold; color:#23527c; }
        .piase-evo-card { border:1px solid #d9edf7; background:#f5fbfe; border-radius:6px; padding:10px; margin-bottom:10px; min-height:76px; }
        .piase-evo-card strong { display:block; font-size:18px; color:#23527c; }
        .piase-evo-chart-wrap { border:1px solid #ddd; border-radius:6px; background:#fff; padding:10px; overflow-x:auto; }
        .piase-evo-chart-svg text { font-size:11px; fill:#333; }
        .piase-evo-chart-svg .axis { stroke:#555; stroke-width:1; }
        .piase-evo-chart-svg .grid { stroke:#e5e5e5; stroke-width:1; }
        .piase-evo-chart-svg .risk-line { stroke:#d9534f; stroke-width:1.5; stroke-dasharray:5 4; }
        .piase-evo-point { stroke:#fff; stroke-width:1.5; cursor:default; }
        .piase-evo-legend { margin-top:8px; font-size:11px; }
        .piase-evo-legend span { display:inline-block; margin-right:10px; margin-bottom:4px; }
        .piase-evo-dot { display:inline-block; width:10px; height:10px; border-radius:50%; margin-right:4px; vertical-align:middle; }
        .piase-evo-empty { padding:16px; text-align:center; color:#777; background:#fafafa; border:1px dashed #bbb; border-radius:6px; }
        .piase-tab-recordatorio { font-size:11px; color:#777; margin-top:6px; }

        .piase-search-box { position: relative; }
        .resultado-estudiante-piase { display:none; position:absolute; z-index:9999; width:100%; max-height:310px; overflow:auto; background:#fff; border:1px solid #ddd; box-shadow:0 3px 8px rgba(0,0,0,.15); }
        .resultado-estudiante-piase a { display:block; padding:8px 10px; border-bottom:1px solid #eee; color:#333; text-decoration:none; }
        .resultado-estudiante-piase a:hover { background:#f5f5f5; text-decoration:none; }
        .resultado-estudiante-piase small { color:#666; }
        .piase-estudiante-seleccionado { margin-top:6px; }
        .piase-focus-highlight { box-shadow:0 0 0 3px rgba(51,122,183,.35) !important; border-color:#337ab7 !important; background:#f0f8ff !important; transition:all .25s ease-in-out; }
        .piase-link-actividades { display:inline-block; margin-top:4px; font-size:11px; }
        .piase-buscador-citas { margin: 10px 0 15px 0; }
        .piase-buscador-citas .form-control { max-width: 520px; display:inline-block; }
        .piase-contador-citas { display:inline-block; margin-left:10px; color:#31708f; font-weight:bold; }
        .piase-buscador-tab { margin: 10px 0 15px 0; padding: 10px; border: 1px solid #d9edf7; background: #f5fbfe; border-radius: 6px; }
        .piase-buscador-tab .input-group { max-width: 620px; }
        .piase-buscador-tab .piase-contador-tab { display:inline-block; margin-top:6px; color:#31708f; font-weight:bold; font-size:12px; }
        .piase-buscador-tab .piase-limpiar-busqueda { margin-left:6px; }
        .piase-sin-resultados-tab { display:none; margin-top:8px; }
        .piase-label-programada { background:#5bc0de; }
        .piase-label-en-atencion { background:#337ab7; }
        .piase-label-atendida { background:#5cb85c; }
        .piase-label-cancelada { background:#777; }
        .piase-btn-stars { font-weight:bold; letter-spacing:.5px; }

        .piase-progress-mini { display:inline-block; padding:2px 7px; border-radius:12px; background:#e7f3fb; border:1px solid #b9def0; color:#21618c; font-size:11px; font-weight:bold; margin-top:3px; }
        .piase-progress-mini-ok { background:#e8f8f5; border-color:#a3e4d7; color:#117a65; }
        .piase-progress-mini-warn { background:#fcf3cf; border-color:#f7dc6f; color:#9a7d0a; }
        .piase-fechas-asignadas { margin-top:8px; border:1px solid #d9edf7; background:#f5fbfe; border-radius:6px; padding:8px 10px; }
        .piase-fechas-asignadas ul { margin-bottom:0; padding-left:18px; }
        .piase-fechas-asignadas li { margin-bottom:4px; }

        /* PIASE: solo Estudiantes canalizados. Evita que Responsable / sesiones
           se comprima cuando la pantalla tiene menos espacio disponible. */
        #tab-canalizados .piase-table-canalizados {
            table-layout: auto;
            min-width: 1850px;
            width: 100%;
        }
        #tab-canalizados .piase-table-canalizados .piase-col-responsable-sesiones {
            width: 330px;
            min-width: 330px;
            max-width: none;
            white-space: normal;
            overflow-wrap: anywhere;
        }
        #tab-canalizados .piase-table-canalizados .piase-col-area-destino {
            min-width: 120px;
            white-space: normal;
        }
        #tab-canalizados .piase-table-canalizados .piase-col-accion {
            min-width: 155px;
        }
        #tab-canalizados .piase-table-canalizados .piase-agenda-card {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            min-width: 0;
        }
        #tab-canalizados .piase-table-canalizados .piase-agenda-date {
            flex: 0 0 48px;
            margin-right: 0;
        }
        #tab-canalizados .piase-table-canalizados .piase-agenda-body {
            display: block;
            flex: 1 1 auto;
            width: auto;
            min-width: 0;
            overflow-wrap: anywhere;
        }
        #tab-canalizados .piase-table-canalizados .piase-agenda-body .btn {
            white-space: normal;
            margin: 2px 3px 2px 0;
        }

        .piase-fechas-asignadas .label { display:inline-block; margin-left:4px; }

        /* Distribución por estudiante: sin tabla desbordada, ancho flexible */
        .piase-canalizado-panel { max-width:100%; overflow:hidden; }
        .piase-canalizado-encabezado { display:flex; flex-wrap:wrap; align-items:center; gap:8px; }
        .piase-dato-etiqueta { display:inline-block; padding:3px 7px; border:1px solid #d5e6f3; background:#fff; border-radius:12px; font-size:11px; }
        .piase-canalizado-grid { display:grid; grid-template-columns:minmax(190px,1.1fr) minmax(320px,2.4fr) minmax(112px,.65fr); gap:12px; }
        .piase-materia-resumen { margin-top:7px; padding:8px; border-bottom:1px solid #e6edf3; font-size:12px; }
        .piase-materia-resumen small { display:block; overflow-wrap:anywhere; }
        .piase-unidad-compacta { display:inline-block; margin:3px 5px 0 0; white-space:nowrap; font-size:11px; }
        .piase-bloque-canalizacion { padding:9px; background:#f9fcff; border:1px solid #d8e6f3; border-radius:7px; margin-bottom:8px; }
        .piase-bloque-cabecera { display:flex; flex-wrap:wrap; gap:6px 12px; align-items:center; margin-bottom:7px; font-size:12px; }
        .piase-bloque-cabecera small { color:#666; }
        .piase-nota-interna { margin:6px 0; padding:7px; background:#fff8e8; border-left:3px solid #f0ad4e; font-size:12px; overflow-wrap:anywhere; }
        .piase-sesion-linea { display:flex; align-items:center; flex-wrap:wrap; gap:7px 12px; border-top:1px solid #e4eaf0; padding:8px 2px; font-size:12px; }
        .piase-sesion-botones { display:flex; flex-wrap:wrap; gap:4px; }
        .piase-canalizado-acciones { display:flex; flex-direction:column; align-items:stretch; gap:7px; }
        .piase-canalizado-acciones .btn { white-space:normal; }
        @media (max-width:1200px) { .piase-canalizado-grid { grid-template-columns:minmax(160px,1fr) minmax(260px,2fr); } .piase-canalizado-acciones { grid-column:1 / -1; flex-direction:row; flex-wrap:wrap; } }
        @media (max-width:730px) { .piase-canalizado-grid { display:block; } .piase-canalizado-materias, .piase-canalizado-sesiones, .piase-canalizado-acciones { margin-bottom:12px; } .piase-canalizado-encabezado { align-items:flex-start; } }
        #tab-citas .piase-agenda-card { min-height:175px; height:100%; }
        #tab-citas .row > [class*="col-"] { margin-bottom:10px; }

        /* Corrección conservadora: presentación tabular original para asignaturas/unidades. */
        #tab-canalizados .table-responsive { max-width:100%; overflow-x:auto; }
        #tab-canalizados .piase-table { table-layout:fixed; width:100%; min-width:1070px; }
        #tab-canalizados .piase-table .piase-col-alumno { width:155px; }
        #tab-canalizados .piase-table .piase-col-asignatura { width:155px; }
        #tab-canalizados .piase-table .piase-col-docente { width:140px; }
        #tab-canalizados .piase-table .piase-col-unidad { width:38px; }
        #tab-canalizados .piase-table td { overflow-wrap:break-word; }
        #tab-canalizados .piase-table .piase-agenda-body { width:calc(100% - 66px); }
        #tab-canalizados .piase-table .piase-actions { width:135px; }
        /* Ajuste de densidad: preservar materias y unidades; dar espacio a citas. */
        #tab-canalizados .piase-table { min-width: 1040px; }
        #tab-canalizados .piase-table .piase-col-alumno { width:175px; }
        #tab-canalizados .piase-table .piase-col-asignatura { width:150px; }
        #tab-canalizados .piase-table .piase-col-docente { width:125px; }
        #tab-canalizados .piase-table .piase-col-unidad { width:36px; }
        #tab-canalizados .piase-agenda-card { margin-top:2px; }

        /* Ajuste fino solicitado: encabezado del estudiante y citas más compactas */
        #tab-canalizados .piase-col-alumno { width: 230px; }
        #tab-canalizados .piase-student-cell { min-width: 220px; }
        #tab-canalizados .piase-student-head { display:flex; align-items:flex-start; justify-content:space-between; gap:8px; margin-bottom:6px; }
        #tab-canalizados .piase-student-name { font-size:22px; line-height:1.15; font-weight:700; display:block; }
        #tab-canalizados .piase-semestre-chip { display:inline-block; padding:4px 10px; border-radius:14px; background:#f1f1f1; font-weight:700; white-space:nowrap; }
        #tab-canalizados .piase-student-meta { font-size:12px; color:#666; margin-bottom:6px; }
        #tab-canalizados .piase-student-tags .label { display:inline-block; margin:0 6px 6px 0; }
        #tab-canalizados .piase-col-responsable-sesiones { width: 390px; min-width: 390px; }
        #tab-canalizados .piase-table .piase-col-asignatura { width: 165px; }
        #tab-canalizados .piase-table .piase-col-docente { width: 120px; }
        #tab-canalizados .piase-table .piase-col-unidad { width: 34px; }
        #tab-canalizados .piase-agenda-lista { margin-top:6px; display:flex; flex-direction:column; align-items:flex-start; gap:6px; }
        #tab-canalizados .piase-agenda-card { display:inline-flex; width:auto; max-width:100%; padding:5px 8px !important; margin-bottom:0 !important; border-radius:8px; }
        #tab-canalizados .piase-agenda-date { min-width:44px !important; padding:4px !important; }
        #tab-canalizados .piase-agenda-day { font-size:16px; line-height:1; }
        #tab-canalizados .piase-agenda-month { font-size:11px; line-height:1; }
        #tab-canalizados .piase-agenda-body { width:auto !important; max-width:315px; font-size:12px; line-height:1.25; }
        #tab-canalizados .piase-agenda-time { font-size:14px; font-weight:700; }
        #tab-canalizados .piase-agenda-line { display:block; margin-top:2px; }
        #tab-canalizados .piase-agenda-line .label { margin-right:4px; }
        #tab-canalizados .piase-agenda-place { display:block; margin-top:2px; }
        #tab-canalizados .piase-agenda-actions { display:flex; flex-wrap:wrap; gap:4px; margin-top:4px; }
        #tab-canalizados .piase-agenda-actions .btn, #tab-canalizados .piase-agenda-actions form { margin:0; }
        @media (max-width: 1500px) {
            #tab-canalizados .piase-col-responsable-sesiones { width: 350px; min-width:350px; }
            #tab-canalizados .piase-agenda-body { max-width:280px; }
        }


        /* Una sola fila combinada por estudiante; no modifica asignaturas, docente ni notas. */
        #tab-canalizados .piase-canalizado-fila-estudiante > td {
            background:#f7fbff; border-top:2px solid #b8d7ed;
            padding:11px 14px;
        }
        #tab-canalizados .piase-canalizado-fila-estudiante .piase-student-head {
            justify-content:flex-start; align-items:center; flex-wrap:wrap; gap:8px 14px;
        }
        #tab-canalizados .piase-canalizado-fila-estudiante .piase-student-name { font-size:18px; }
        #tab-canalizados .piase-table { width:100%; min-width:930px; table-layout:fixed; }
        #tab-canalizados .piase-table .piase-col-asignatura { width:175px; }
        #tab-canalizados .piase-table .piase-col-docente { width:145px; }
        #tab-canalizados .piase-table .piase-col-unidad { width:38px; }
        #tab-canalizados .piase-table .piase-col-responsable-sesiones {
            width:310px; min-width:0; max-width:310px;
        }
        #tab-canalizados .piase-table .piase-col-accion { width:135px; }
        #tab-canalizados .piase-table .piase-agenda-card { width:100%; max-width:100%; }
        #tab-canalizados .piase-table .piase-agenda-body { min-width:0; max-width:235px; }
        #tab-canalizados .piase-table .piase-agenda-date { flex-shrink:0; }
        #tab-canalizados .piase-table .piase-agenda-line,
        #tab-canalizados .piase-table .piase-agenda-place { overflow-wrap:anywhere; }


        /* Cabecera PIASE compacta: no cambia datos, búsquedas, rutas ni pestañas. */
        .piase-cabecera-compacta .panel,
        .piase-responsable-compacto .panel,
        .piase-filtros-compactos .panel,
        .piase-busqueda-compacta .panel,
        .piase-resumen-compacto .panel { margin-bottom: 10px; }
        .piase-cabecera-compacta .panel-heading { padding: 5px 12px; }
        .piase-cabecera-compacta .panel-body { padding: 7px 12px; font-size: 12px; line-height: 1.4; }
        .piase-cabecera-compacta .panel-body br { display:none; }
        .piase-cabecera-compacta .panel-body .piase-muted:before { content: ' · '; }
        .piase-responsable-compacto .panel-heading,
        .piase-filtros-compactos .panel-heading,
        .piase-busqueda-compacta .panel-heading,
        .piase-resumen-compacto .panel-heading { padding: 7px 12px; }
        .piase-responsable-compacto .panel-body,
        .piase-filtros-compactos .panel-body,
        .piase-busqueda-compacta .panel-body,
        .piase-resumen-compacto .panel-body { padding: 9px 12px; }
        .piase-responsable-compacto .panel-body { font-size: 12px; }
        .piase-responsable-compacto .panel-body .col-md-4 { padding-top:1px; padding-bottom:1px; }
        .piase-responsable-compacto .panel-body .col-md-4 > strong { display:inline; }
        .piase-responsable-compacto .panel-body .col-md-4 > br { display:none; }
        .piase-responsable-compacto .panel-body .col-md-4 > br + small { display:inline; }
        .piase-filtros-compactos label { margin-bottom:3px; font-size:12px; }
        .piase-filtros-compactos .form-control { height:31px; padding:4px 9px; }
        .piase-filtros-compactos .btn { padding:5px 12px; }
        .piase-filtros-compactos .col-md-3[style] { margin-top:19px !important; }
        .piase-busqueda-compacta .panel-body > p.piase-muted { margin-bottom:6px; font-size:12px; }
        .piase-busqueda-compacta label { margin-bottom:3px; font-size:12px; }
        .piase-busqueda-compacta #buscar_estudiante_piase { height:32px; }
        .piase-busqueda-compacta .piase-help { margin-top:3px; }
        .piase-busqueda-compacta #estudiante_seleccionado_piase { margin:4px 0 0; }
        .piase-busqueda-compacta .alert-info { padding:8px 10px; margin-top:15px !important; font-size:12px; }
        .piase-resumen-compacto .piase-card { min-height:0; margin-bottom:6px; padding:7px 9px; }
        .piase-resumen-compacto .piase-card-number { display:inline; font-size:17px; margin-right:6px; }
        @media (max-width:991px) {
            .piase-responsable-compacto .panel-body .col-md-4 { margin-bottom:5px; }
            .piase-filtros-compactos .col-md-3[style] { margin-top:8px !important; }
            .piase-busqueda-compacta .alert-info { margin-top:8px !important; }
        }

        /* Observaciones internas: sin ampliar las columnas de la tabla. */
        .piase-observacion-interna { margin:6px 0 2px; padding:6px 9px; border-left:3px solid #e5a74a; background:#fff9ed; font-size:12px; font-weight:normal; overflow-wrap:anywhere; }
        .piase-observacion-interna strong { color:#805411; }
    </style>

    <?php
    $gruposEstudiantes = array();
    foreach ($filasEstudiantes as $fila) {
        $key = $fila->id_ar_caso;
        if (!isset($gruposEstudiantes[$key])) {
            $gruposEstudiantes[$key] = array('base' => $fila, 'filas' => array());
        }
        $gruposEstudiantes[$key]['filas'][] = $fila;
    }

    $gruposCanalizados = array();
    foreach ($filasCanalizados as $fila) {
        $key = (int) $fila->id_ar_caso;
        if (!isset($gruposCanalizados[$key])) {
            $gruposCanalizados[$key] = array('base' => $fila, 'filas' => array(), 'materias_ids' => array(), 'canalizaciones' => array());
        }
        $canalizacionId = isset($fila->id_ar_caso_canalizacion) ? (int)$fila->id_ar_caso_canalizacion : 0;
        if ($canalizacionId && !isset($gruposCanalizados[$key]['canalizaciones'][$canalizacionId])) {
            $gruposCanalizados[$key]['canalizaciones'][$canalizacionId] = $fila;
        }
        $materiaKey = isset($fila->id_materia) ? (int)$fila->id_materia : 0;
        if (!isset($gruposCanalizados[$key]['materias_ids'][$materiaKey])) {
            $gruposCanalizados[$key]['materias_ids'][$materiaKey] = true;
            $gruposCanalizados[$key]['filas'][] = $fila;
        }
    }

    $gruposCerrados = array();
    foreach ($filasCerrados as $fila) {
        $key = $fila->id_ar_caso;
        if (!isset($gruposCerrados[$key])) {
            $gruposCerrados[$key] = array('base' => $fila, 'filas' => array());
        }
        $gruposCerrados[$key]['filas'][] = $fila;
    }

    $gruposCitas = array();
    foreach ($citasAsignadas as $cita) {
        $key = $cita->id_ar_caso;
        if (!isset($gruposCitas[$key])) {
            $gruposCitas[$key] = array('base' => $cita, 'citas' => array());
        }
        $gruposCitas[$key]['citas'][] = $cita;
    }

    $gruposActividadesCarreras = array();
    foreach ($actividadesSeguimiento as $actividad) {
        $carreraKey = trim((string)$actividad->carrera);
        if ($carreraKey == '') {
            $carreraKey = 'Sin carrera registrada';
        }
        if (!isset($gruposActividadesCarreras[$carreraKey])) {
            $gruposActividadesCarreras[$carreraKey] = array(
                'carrera' => $carreraKey,
                'estudiantes' => array(),
                'total_actividades' => 0,
                'total_sin_evidencia' => 0
            );
        }
        $casoKey = $actividad->id_ar_caso;
        if (!isset($gruposActividadesCarreras[$carreraKey]['estudiantes'][$casoKey])) {
            $gruposActividadesCarreras[$carreraKey]['estudiantes'][$casoKey] = array('base' => $actividad, 'actividades' => array());
        }
        $gruposActividadesCarreras[$carreraKey]['estudiantes'][$casoKey]['actividades'][] = $actividad;
        $gruposActividadesCarreras[$carreraKey]['total_actividades']++;
        if (empty($actividad->id_ar_entrega)) {
            $gruposActividadesCarreras[$carreraKey]['total_sin_evidencia']++;
        }
    }

    $citasPorCanalizacion = isset($citasPorCanalizacion) ? $citasPorCanalizacion : array();
    $diasSemanaPIASE = array(1 => 'Lunes', 2 => 'Martes', 3 => 'Miércoles', 4 => 'Jueves', 5 => 'Viernes', 6 => 'Sábado', 7 => 'Domingo');
    $mesesPIASE = array(1 => 'ENE', 2 => 'FEB', 3 => 'MAR', 4 => 'ABR', 5 => 'MAY', 6 => 'JUN', 7 => 'JUL', 8 => 'AGO', 9 => 'SEP', 10 => 'OCT', 11 => 'NOV', 12 => 'DIC');
    $tabActivo = isset($filtros['tab']) && $filtros['tab'] ? $filtros['tab'] : ($esResponsablePedagogia ? 'tab-estudiantes' : 'tab-canalizados');
    if (!in_array($tabActivo, array('tab-estudiantes', 'tab-canalizados', 'tab-citas', 'tab-cerrados', 'tab-actividades'))) {
        $tabActivo = $esResponsablePedagogia ? 'tab-estudiantes' : 'tab-canalizados';
    }
    if (!$esResponsablePedagogia && $tabActivo === 'tab-estudiantes') { $tabActivo = 'tab-canalizados'; }
    $focusActivo = isset($filtros['focus']) ? preg_replace('/[^A-Za-z0-9_\-]/', '', $filtros['focus']) : '';
    $filtroIdCarreraValor = isset($filtros['id_carrera']) ? (int)$filtros['id_carrera'] : 0;
    $buscarEstudianteValor = isset($filtros['buscar_estudiante']) ? $filtros['buscar_estudiante'] : '';
    $claseEstadoCitaPIASE = function($estado) {
        $estado = strtolower(trim((string)$estado));
        if ($estado == 'atendida' || $estado == 'atendido') { return 'label-success piase-label-atendida'; }
        if ($estado == 'en_atencion' || $estado == 'en atención') { return 'label-primary piase-label-en-atencion'; }
        if ($estado == 'cancelada' || $estado == 'cancelado') { return 'label-default piase-label-cancelada'; }
        return 'label-info piase-label-programada';
    };
    ?>

    <div class="piase-main-wrap">
        <div class="row piase-title-panel piase-cabecera-compacta">
            <div class="col-md-10 col-xs-12 col-md-offset-1">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">PIASE</h3>
                    </div>
                    <div class="panel-body text-center">
                        <strong>Programa Institucional de Atención y Seguimiento a Estudiantes</strong><br>
                        <span class="piase-muted">Atención, canalización, sesiones y seguimiento de estudiantes con problemas de reprobación.</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-xs-12 col-md-offset-1">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <strong>Revisa la información:</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        @if(!$permitido)
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="alert alert-danger text-center">
                        <h4>No se puede mostrar PIASE</h4>
                        <p>{{ $mensaje }}</p>
                    </div>
                </div>
            </div>
        @else
            <div class="row piase-responsable-compacto">
                <div class="col-md-10 col-xs-12 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong>Responsable de atención</strong></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Usuario:</strong><br>
                                    {{ $personal->nombre }}
                                </div>
                                <div class="col-md-4">
                                    <strong>Periodo:</strong><br>
                                    {{ $periodoSeleccionado ? $periodoSeleccionado->periodo : 'Sin periodo' }}
                                </div>
                                <div class="col-md-4">
                                    <strong>Área(s) asignada(s):</strong><br>
                                    @foreach($areasResponsable as $area)
                                        <span class="label label-primary">{{ $area->nombre }}</span>
                                    @endforeach
                                    @if($esResponsablePedagogia)
                                        <br><small class="piase-muted">Pedagogía puede ver todas las carreras y canalizar a cualquier área activa.</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row piase-filtros-compactos">
                <div class="col-md-10 col-xs-12 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong>Filtros</strong></div>
                        <div class="panel-body">
                            <form method="GET" action="{{ route('areas_atencion.mis_casos.index') }}">
                                <input type="hidden" name="tab" class="piase-active-tab" value="{{ $tabActivo }}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Periodo</label>
                                        <select name="id_periodo" class="form-control" onchange="this.form.submit()">
                                            @foreach($periodos as $periodo)
                                                <option value="{{ $periodo->id_periodo }}" {{ (int)$filtros['id_periodo'] === (int)$periodo->id_periodo ? 'selected' : '' }}>
                                                    {{ $periodo->periodo }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Carrera</label>
                                        <select name="id_carrera" class="form-control" onchange="this.form.submit()">
                                            <option value="0">Todas las carreras</option>
                                            @foreach($resumenCarreras as $carrera)
                                                <option value="{{ $carrera->id_carrera }}" {{ (int)$filtros['id_carrera'] === (int)$carrera->id_carrera ? 'selected' : '' }}>
                                                    {{ $carrera->carrera }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3" style="margin-top:24px;">
                                        <button type="submit" class="btn btn-primary">
                                            <span class="glyphicon glyphicon-search"></span> Consultar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if($esResponsablePedagogia)
                <div class="row piase-busqueda-compacta">
                    <div class="col-md-10 col-xs-12 col-md-offset-1">
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <strong>Agregar canalización desde Pedagogía</strong>
                            </div>
                            <div class="panel-body">
                                <p class="piase-muted">
                                    Busca al estudiante por nombre, apellidos o número de cuenta. Se listan estudiantes con carga académica en el periodo seleccionado, aunque no tengan asignaturas reprobadas.
                                </p>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label>Buscar estudiante</label>
                                        <div class="piase-search-box">
                                            <input type="text" id="buscar_estudiante_piase" class="form-control" value="" placeholder="Nombre, apellidos o cuenta del estudiante" autocomplete="off">
                                            <div id="resultado_estudiante_piase" class="resultado-estudiante-piase"></div>
                                        </div>
                                        <span class="piase-help">Escribe al menos 2 caracteres y selecciona al estudiante de la lista.</span>
                                        <p class="help-block piase-estudiante-seleccionado" id="estudiante_seleccionado_piase">Selecciona un estudiante de la lista para iniciar la canalización.</p>
                                        <div id="fechas_asignadas_estudiante_piase" class="piase-fechas-asignadas" style="display:none;"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="alert alert-info" style="margin-top:24px;margin-bottom:0;">
                                            <strong>Funcionamiento:</strong><br>
                                            Al seleccionar un estudiante se abrirá el formulario para canalizarlo y asignar su primera sesión.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row piase-resumen-compacto">
                    <div class="col-md-10 col-xs-12 col-md-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading"><strong>Estudiantes canalizados por carrera</strong></div>
                            <div class="panel-body">
                                <div class="row">
                                    @forelse($resumenCarreras as $carrera)
                                        <div class="col-md-4 col-sm-6">
                                            <a href="{{ route('areas_atencion.mis_casos.index', array('id_periodo' => $filtros['id_periodo'], 'id_carrera' => $carrera->id_carrera)) }}" style="text-decoration:none;color:inherit;">
                                                <div class="piase-card">
                                                    <span class="piase-card-number">{{ $carrera->total_estudiantes }}</span>
                                                    <strong>{{ $carrera->carrera }}</strong><br>
                                                    <small>estudiante(s) canalizado(s)</small>
                                                </div>
                                            </a>
                                        </div>
                                    @empty
                                        <div class="col-md-12">
                                            <div class="alert alert-info">Aún no hay estudiantes canalizados a Pedagogía para el periodo seleccionado.</div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row piase-tabs">
                <div class="col-md-12 col-xs-12">
                    <ul class="nav nav-tabs" role="tablist" id="piaseTabs">
                        @if($esResponsablePedagogia)
                            <li role="presentation" class="{{ $tabActivo == 'tab-estudiantes' ? 'active' : '' }}"><a href="#tab-estudiantes" aria-controls="tab-estudiantes" role="tab" data-toggle="tab">Estudiantes</a></li>
                        @endif
                        <li role="presentation" class="{{ $tabActivo == 'tab-canalizados' ? 'active' : '' }}"><a href="#tab-canalizados" aria-controls="tab-canalizados" role="tab" data-toggle="tab">Estudiantes canalizados</a></li>
                        <li role="presentation" class="{{ $tabActivo == 'tab-citas' ? 'active' : '' }}"><a href="#tab-citas" aria-controls="tab-citas" role="tab" data-toggle="tab">Citas</a></li>
                        <li role="presentation" class="{{ $tabActivo == 'tab-cerrados' ? 'active' : '' }}"><a href="#tab-cerrados" aria-controls="tab-cerrados" role="tab" data-toggle="tab">Casos cerrados</a></li>
                        <li role="presentation" class="{{ $tabActivo == 'tab-actividades' ? 'active' : '' }}"><a href="#tab-actividades" aria-controls="tab-actividades" role="tab" data-toggle="tab">Calificaciones de actividades</a></li>
                    </ul>

                    <div class="tab-content" style="padding-top:15px;">
                        <div role="tabpanel" class="tab-pane {{ $tabActivo == 'tab-estudiantes' ? 'active' : '' }}" id="tab-estudiantes">
                            <div class="piase-buscador-tab" data-piase-buscador-tab="tab-estudiantes">
                                <label for="buscador-tab-estudiantes" style="margin-bottom:6px;">Buscar estudiante:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                                    <input type="text" id="buscador-tab-estudiantes" class="form-control piase-busqueda-tab" data-target-tab="tab-estudiantes" placeholder="Buscar por estudiante, cuenta, carrera, asignatura, docente o estado...">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default piase-limpiar-busqueda" data-target-tab="tab-estudiantes">Limpiar</button>
                                    </span>
                                </div>
                                <span class="piase-contador-tab" data-target-tab="tab-estudiantes"></span>
                                <div class="alert alert-warning piase-sin-resultados-tab" data-target-tab="tab-estudiantes">No se encontraron registros con el texto capturado.</div>
                            </div>
                            @if(!$esResponsablePedagogia)
                                <div class="alert alert-info">Esta pestaña es exclusiva para Pedagogía. Tu área verá los casos que Pedagogía te canalice en la pestaña <strong>Estudiantes canalizados</strong>.</div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover table-condensed piase-table">
                                        <thead>
                                        <tr style="background:#dddddd;color:black;">
                                            <th class="piase-col-alumno">Nombre completo</th>
                                            <th class="piase-col-carrera">Carrera</th>
                                            <th class="piase-col-semestre text-center">Sem.</th>
                                            <th class="piase-col-asignatura">Asignatura</th>
                                            <th class="piase-col-docente">Docente</th>
                                            @foreach($unidades as $unidad)
                                                <th class="piase-col-unidad text-center">U{{ $unidad }}</th>
                                            @endforeach
                                            <th class="piase-col-estado text-center">Estado</th>
                                            <th class="piase-col-accion text-center">Acción</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($gruposEstudiantes as $grupo)
                                                <?php
                                                $rowspan = count($grupo['filas']); $primera = true; $base = $grupo['base'];
                                                ?>
                                            @foreach($grupo['filas'] as $fila)
                                                <tr data-piase-group="estudiantes-{{ $base->id_ar_caso }}">
                                                    @if($primera)
                                                        <td rowspan="{{ $rowspan }}" class="piase-wrap piase-student-cell">
                                                            <strong>{{ $base->alumno }}</strong><br>
                                                            <small>Cuenta: {{ $base->cuenta }}</small>
                                                            @if($esResponsablePedagogia && isset($rutasCasos[$base->id_ar_caso]))
                                                                @foreach($rutasCasos[$base->id_ar_caso] as $pasoObservacion)
                                                                    @if(isset($pasoObservacion->tipo_paso) && $pasoObservacion->tipo_paso === 'canalizacion' && isset($pasoObservacion->observaciones) && trim((string)$pasoObservacion->observaciones) !== '' && isset($pasoObservacion->area_destino) && in_array($pasoObservacion->area_destino, array('Pedagogía', 'Pedagogia')))
                                                                        <div class="piase-observacion-interna"><strong>Observación recibida:</strong> {{ $pasoObservacion->observaciones }}</div>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                        <td rowspan="{{ $rowspan }}" class="piase-wrap">{{ $base->carrera }}</td>
                                                        <td rowspan="{{ $rowspan }}" class="text-center">{{ $base->id_semestre }}</td>
                                                    @endif
                                                    <td class="piase-wrap">
                                                        <strong>{{ $fila->materia }}</strong><br>
                                                        <small>{{ $fila->clave_materia }}</small>
                                                    </td>
                                                    <td class="piase-wrap">{{ isset($fila->docente_asignatura) ? $fila->docente_asignatura : 'Sin docente registrado' }}</td>
                                                    @foreach($unidades as $unidad)
                                                        <td class="text-center">
                                                            @if(isset($fila->calificaciones[$unidad]))
                                                                @if((int)$fila->calificaciones[$unidad] >= 70)
                                                                    <span class="piase-cal piase-cal-ok">{{ $fila->calificaciones[$unidad] }}</span>
                                                                @else
                                                                    <span class="piase-cal piase-cal-bad">{{ $fila->calificaciones[$unidad] }}</span>
                                                                @endif
                                                            @else
                                                                <span class="piase-cal piase-cal-empty">-</span>
                                                            @endif
                                                        </td>
                                                    @endforeach
                                                    @if($primera)
                                                            <?php $labelEstado = $base->estado_caso == 'abierto' ? 'label-warning' : ($base->estado_caso == 'en_proceso' ? 'label-info' : ($base->estado_caso == 'cerrado' ? 'label-success' : 'label-default')); ?>
                                                        <td rowspan="{{ $rowspan }}" class="text-center"><span class="label {{ $labelEstado }}">{{ $base->estado_caso }}</span></td>
                                                        <td rowspan="{{ $rowspan }}" class="text-center piase-actions">
                                                            <button type="button" class="btn btn-warning btn-sm"
                                                                    data-id-periodo="{{ $base->id_periodo }}"
                                                                    data-id-caso="{{ $base->id_ar_caso }}"
                                                                    data-alumno="{{ e($base->alumno) }}"
                                                                    onclick="abrirModalCanalizar(this)"
                                                                    {{ $horariosDisponibles->isEmpty() ? 'disabled' : '' }}>
                                                                <span class="glyphicon glyphicon-share-alt"></span> Canalizar
                                                            </button>
                                                            @if($horariosDisponibles->isEmpty())
                                                                <br><small class="text-danger">Sin horarios disponibles</small>
                                                            @endif
                                                        </td>
                                                            <?php $primera = false; ?>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @empty
                                            <tr>
                                                <td colspan="{{ 7 + count($unidades) }}" class="text-center">No hay estudiantes pendientes de canalizar en Pedagogía para el periodo seleccionado.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>

                        <div role="tabpanel" class="tab-pane {{ $tabActivo == 'tab-canalizados' ? 'active' : '' }}" id="tab-canalizados">
                            <div class="piase-buscador-tab" data-piase-buscador-tab="tab-canalizados">
                                <label for="buscador-tab-canalizados" style="margin-bottom:6px;">Buscar estudiante canalizado:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                                    <input type="text" id="buscador-tab-canalizados" class="form-control piase-busqueda-tab" data-target-tab="tab-canalizados" placeholder="Buscar por estudiante, cuenta, carrera, área, responsable, sesión, estado o asignatura...">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default piase-limpiar-busqueda" data-target-tab="tab-canalizados">Limpiar</button>
                                    </span>
                                </div>
                                <span class="piase-contador-tab" data-target-tab="tab-canalizados"></span>
                                <div class="alert alert-warning piase-sin-resultados-tab" data-target-tab="tab-canalizados">No se encontraron registros con el texto capturado.</div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover table-condensed piase-table">
                                    <thead>
                                    <tr style="background:#dddddd;color:black;">

                                        <th class="piase-col-asignatura">Asignatura</th>
                                        <th class="piase-col-docente">Docente</th>
                                        @foreach($unidades as $unidad)
                                            <th class="piase-col-unidad text-center">U{{ $unidad }}</th>
                                        @endforeach

                                        <th class="piase-col-responsable-sesiones text-center">Responsable / sesiones</th>

                                        <th class="piase-col-accion text-center">Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($gruposCanalizados as $grupo)
                                            <?php
                                            $rowspan = count($grupo['filas']); $primera = true; $base = $grupo['base'];
                                            $citasGrupo = array();
                                            foreach ($grupo['canalizaciones'] as $idCanalizacionGrupo => $canalizacionGrupo) {
                                                foreach (isset($citasPorCanalizacion[$idCanalizacionGrupo]) ? $citasPorCanalizacion[$idCanalizacionGrupo] : array() as $citaGrupo) {
                                                    $citasGrupo[(int)$citaGrupo->id_ar_cita] = $citaGrupo;
                                                }
                                            }
                                            uasort($citasGrupo, function ($a, $b) {
                                                $cmp = strcmp((string)$a->fecha_cita, (string)$b->fecha_cita);
                                                return $cmp !== 0 ? $cmp : ((int)$a->id_ar_cita - (int)$b->id_ar_cita);
                                            });
                                            ?>
                                        <tr class="piase-canalizado-fila-estudiante" data-focus-id="caso-{{ $base->id_ar_caso }}" data-piase-group="canalizados-{{ $base->id_ar_caso }}">
                                            <td colspan="{{ 4 + count($unidades) }}" class="piase-wrap piase-student-cell">
                                                <div class="piase-student-head">
                                                    <span class="piase-student-name">{{ $base->alumno }}</span>
                                                    <span class="piase-semestre-chip">{{ $base->id_semestre }}.° semestre</span>
                                                </div>
                                                <div class="piase-student-meta">Cuenta: {{ $base->cuenta }}</div>
                                                <div class="piase-student-tags">
                                                    <span class="label label-default">{{ $base->carrera }}</span>
                                                    <span class="label label-info">{{ $base->estado_caso }}</span>
                                                </div>
                                                @foreach($grupo['canalizaciones'] as $canalizacionObservacion)
                                                    @if(isset($canalizacionObservacion->observaciones_canalizacion) && trim((string)$canalizacionObservacion->observaciones_canalizacion) !== '')
                                                        <div class="piase-observacion-interna">
                                                            <strong>Observación para {{ $canalizacionObservacion->area_destino }}:</strong>
                                                            {{ $canalizacionObservacion->observaciones_canalizacion }}
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                        @foreach($grupo['filas'] as $fila)
                                            <tr data-piase-group="canalizados-{{ $base->id_ar_caso }}">
                                                <td class="piase-wrap">
                                                    <strong>{{ $fila->materia }}</strong><br>
                                                    <small>{{ $fila->clave_materia }}</small>
                                                </td>
                                                <td class="piase-wrap">{{ isset($fila->docente_asignatura) ? $fila->docente_asignatura : 'Sin docente registrado' }}</td>
                                                @foreach($unidades as $unidad)
                                                    <td class="text-center">
                                                        @if(isset($fila->calificaciones[$unidad]))
                                                            @if((int)$fila->calificaciones[$unidad] >= 70)
                                                                <span class="piase-cal piase-cal-ok">{{ $fila->calificaciones[$unidad] }}</span>
                                                            @else
                                                                <span class="piase-cal piase-cal-bad">{{ $fila->calificaciones[$unidad] }}</span>
                                                            @endif
                                                        @else
                                                            <span class="piase-cal piase-cal-empty">-</span>
                                                        @endif
                                                    </td>
                                                @endforeach
                                                @if($primera)
                                                    <td rowspan="{{ $rowspan }}" class="piase-wrap">
                                                        <small class="piase-muted">Citas por fecha</small>
                                                        @if(count($citasGrupo) > 0)
                                                            <div class="piase-agenda-lista">
                                                                @foreach($citasGrupo as $citaCanalizada)
                                                                        <?php $fechaTs = strtotime($citaCanalizada->fecha_cita); $mesNum = $fechaTs ? (int)date('n', $fechaTs) : 0; ?>
                                                                    <div class="piase-agenda-card" data-focus-id="cita-{{ $citaCanalizada->id_ar_cita }}">
                                                                        <span class="piase-agenda-date">
                                                                            <span class="piase-agenda-day">{{ $fechaTs ? date('d', $fechaTs) : '--' }}</span>
                                                                            <span class="piase-agenda-month">{{ isset($mesesPIASE[$mesNum]) ? $mesesPIASE[$mesNum] : '' }}</span>
                                                                        </span>
                                                                        <span class="piase-agenda-body">
                                                                            <span class="piase-agenda-time">{{ substr($citaCanalizada->hora_inicio_cita,0,5) }} - {{ substr($citaCanalizada->hora_fin_cita,0,5) }}</span>
                                                                            <small class="piase-agenda-line"><strong>{{ $citaCanalizada->area_destino }}</strong> · {{ $citaCanalizada->responsable_destino }}</small>
                                                                            <small class="piase-agenda-line">{{ isset($diasSemanaPIASE[(int)$citaCanalizada->dia_semana]) ? $diasSemanaPIASE[(int)$citaCanalizada->dia_semana] : '' }} | Sesión {{ $citaCanalizada->numero_sesion }}</small>
                                                                            <?php $estadoCitaCanalizada = isset($citaCanalizada->estado_cita) ? $citaCanalizada->estado_cita : $citaCanalizada->estado; ?>
                                                                            <span class="piase-agenda-line"><span class="label {{ $claseEstadoCitaPIASE($estadoCitaCanalizada) }}">{{ $estadoCitaCanalizada }}</span></span>
                                                                            <?php
                                                                                $totalSesionCanalizada = isset($citaCanalizada->total_actividades) ? (int)$citaCanalizada->total_actividades : 0;
                                                                                $cumplidasSesionCanalizada = isset($citaCanalizada->actividades_con_evidencia) ? (int)$citaCanalizada->actividades_con_evidencia : 0;
                                                                                $citaCanceladaCanalizada = in_array($estadoCitaCanalizada, array('cancelada', 'cancelado'));
                                                                                ?>
                                                                            <span class="piase-agenda-line">
                                                                                @if($citaCanceladaCanalizada)
                                                                                    <span class="piase-progress-mini piase-progress-mini-warn">Sesión cancelada</span>
                                                                                @else
                                                                                    <span class="piase-progress-mini {{ $cumplidasSesionCanalizada >= $totalSesionCanalizada && $totalSesionCanalizada > 0 ? 'piase-progress-mini-ok' : 'piase-progress-mini-warn' }}">Actividades: {{ $cumplidasSesionCanalizada }}/{{ $totalSesionCanalizada }}</span>
                                                                                @endif
                                                                                <a class="piase-link-actividades" href="{{ route('areas_atencion.mis_casos.index', array('id_periodo' => $filtros['id_periodo'], 'id_carrera' => $filtros['id_carrera'], 'tab' => 'tab-actividades', 'focus' => 'caso-' . $base->id_ar_caso)) }}#tab-actividades">Ver actividades</a>
                                                                            </span>
                                                                            <small class="piase-agenda-place">{{ $citaCanalizada->lugar }}</small>
                                                                            @if((int)$citaCanalizada->id_personal_responsable_destino === (int)$personal->id_personal)
                                                                                <span class="piase-agenda-actions">
                                                                                    <button type="button" class="btn btn-primary btn-xs"
                                                                                            data-id-periodo="{{ $citaCanalizada->id_periodo }}"
                                                                                            data-id-cita="{{ $citaCanalizada->id_ar_cita }}"
                                                                                            data-alumno="{{ e($citaCanalizada->alumno) }}"
                                                                                            data-fecha="{{ date('Y-m-d', strtotime($citaCanalizada->fecha_cita)) }}"
                                                                                            data-horario="{{ $citaCanalizada->id_area_responsable_horario }}"
                                                                                            data-estado="{{ $estadoCitaCanalizada }}"
                                                                                            data-lugar="{{ e($citaCanalizada->lugar) }}"
                                                                                            data-observaciones="{{ e($citaCanalizada->motivo) }}"
                                                                                            data-return-tab="tab-canalizados"
                                                                                            onclick="abrirModalEditarSesion(this)">Editar sesión</button>
                                                                                    @if(!in_array($estadoCitaCanalizada, array('cancelada', 'cancelado')))
                                                                                        <button type="button" class="btn btn-success btn-xs"
                                                                                                data-id-periodo="{{ $citaCanalizada->id_periodo }}"
                                                                                                data-id-cita="{{ $citaCanalizada->id_ar_cita }}"
                                                                                                data-alumno="{{ e($citaCanalizada->alumno) }}"
                                                                                                data-return-tab="tab-canalizados"
                                                                                                onclick="abrirModalActividad(this)">Agregar actividad</button>
                                                                                        <form method="POST" action="{{ route('piase.sesion.cancelar') }}" style="display:inline;" onsubmit="return confirm('¿Deseas cancelar esta cita? La cita quedará en historial como cancelada.');">
                                                                                            {{ csrf_field() }}
                                                                                            <input type="hidden" name="id_periodo" value="{{ $citaCanalizada->id_periodo }}">
                                                                                            <input type="hidden" name="id_ar_cita" value="{{ $citaCanalizada->id_ar_cita }}">
                                                                                            <input type="hidden" name="motivo_cancelacion" value="Cancelada desde Estudiantes canalizados">
                                                                                            <input type="hidden" name="active_tab" value="tab-canalizados">
                                                                                            <input type="hidden" name="tab" value="tab-canalizados">
                                                                                            <input type="hidden" name="active_focus" value="cita-{{ $citaCanalizada->id_ar_cita }}">
                                                                                            <input type="hidden" name="focus" value="cita-{{ $citaCanalizada->id_ar_cita }}">
                                                                                            <input type="hidden" name="id_carrera" value="{{ $filtros['id_carrera'] }}">
                                                                                            <input type="hidden" name="filtro_id_carrera" value="{{ $filtros['id_carrera'] }}">
                                                                                            <button type="submit" class="btn btn-danger btn-xs">Cancelar cita</button>
                                                                                        </form>
                                                                                    @endif
                                                                                </span>
                                                                            @endif
                                                                        </span>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @else
                                                            <br><small class="piase-muted">Sin sesiones registradas.</small>
                                                        @endif
                                                    </td>
                                                    <td rowspan="{{ $rowspan }}" class="text-center piase-actions">
                                                        <button type="button" class="btn btn-info btn-sm"
                                                                data-id-caso="{{ $base->id_ar_caso }}"
                                                                data-alumno="{{ e($base->alumno) }}"
                                                                onclick="abrirRutaVisual(this)">
                                                            <span class="glyphicon glyphicon-road"></span> Ver ruta
                                                        </button>
                                                        @if($esResponsablePedagogia)
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                    data-id-periodo="{{ $base->id_periodo }}"
                                                                    data-id-caso="{{ $base->id_ar_caso }}"
                                                                    data-id-canalizacion="{{ $base->id_ar_caso_canalizacion }}"
                                                                    data-id-area="{{ $base->id_area_destino }}"
                                                                    data-area="{{ e($base->area_destino) }}"
                                                                    data-alumno="{{ e($base->alumno) }}"
                                                                    onclick="abrirModalSesion(this)">
                                                                <span class="glyphicon glyphicon-plus"></span> Agregar sesión
                                                            </button>
                                                        @else
                                                            <span class="label label-default">Solo Pedagogía general puede asignar sesiones</span>
                                                        @endif

                                                        @if($esResponsablePedagogia)
                                                            <button type="button" class="btn btn-success btn-sm"
                                                                    data-id-periodo="{{ $base->id_periodo }}"
                                                                    data-id-caso="{{ $base->id_ar_caso }}"
                                                                    data-alumno="{{ e($base->alumno) }}"
                                                                    onclick="abrirModalCerrar(this)">
                                                                <span class="glyphicon glyphicon-ok"></span> Cerrar caso
                                                            </button>
                                                        @endif
                                                    </td>
                                                        <?php $primera = false; ?>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @empty
                                        <tr>
                                            <td colspan="{{ 4 + count($unidades) }}" class="text-center">No hay estudiantes canalizados para el periodo seleccionado.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane {{ $tabActivo == 'tab-citas' ? 'active' : '' }}" id="tab-citas">
                            <div class="piase-buscador-tab" data-piase-buscador-tab="tab-citas">
                                <label for="buscador-tab-citas" style="margin-bottom:6px;">Buscar cita:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                                    <input type="text" id="buscador-tab-citas" class="form-control piase-busqueda-tab" data-target-tab="tab-citas" placeholder="Buscar por estudiante, cuenta, carrera, área, estado, fecha, horario o actividad...">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default piase-limpiar-busqueda" data-target-tab="tab-citas">Limpiar</button>
                                    </span>
                                </div>
                                <span class="piase-contador-tab" data-target-tab="tab-citas"></span>
                                <div class="alert alert-warning piase-sin-resultados-tab" data-target-tab="tab-citas">No se encontraron registros con el texto capturado.</div>
                            </div>
                            <div class="alert alert-info">
                                En esta pestaña cada responsable ve únicamente sus citas asignadas. La información se presenta en modo agenda y se agrupa por estudiante para evitar repetir datos.
                            </div>


                            @forelse($gruposCitas as $grupoCita)
                                    <?php $baseCita = $grupoCita['base']; ?>
                                <div class="panel panel-default piase-student-panel piase-cita-grupo" data-focus-id="caso-{{ $baseCita->id_ar_caso }}" data-search="{{ e(strtolower($baseCita->alumno.' '.$baseCita->cuenta.' '.$baseCita->carrera.' '.$baseCita->area_destino)) }}">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <strong>{{ $baseCita->alumno }}</strong><br>
                                                <small>Cuenta: {{ $baseCita->cuenta }} | Semestre: {{ $baseCita->id_semestre }}</small>
                                            </div>
                                            <div class="col-md-4">
                                                <strong>Carrera:</strong> {{ $baseCita->carrera }}<br>
                                                <small>Área: {{ $baseCita->area_destino }}</small>
                                            </div>
                                            <div class="col-md-3 text-right">
                                                <button type="button" class="btn btn-info btn-sm"
                                                        data-id-caso="{{ $baseCita->id_ar_caso }}"
                                                        data-alumno="{{ e($baseCita->alumno) }}"
                                                        onclick="abrirRutaVisual(this)">
                                                    <span class="glyphicon glyphicon-road"></span> Ver ruta
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            @foreach($grupoCita['citas'] as $cita)
                                                    <?php $fechaTs = strtotime($cita->fecha_cita); $mesNum = $fechaTs ? (int)date('n', $fechaTs) : 0; ?>
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="piase-agenda-card" data-focus-id="cita-{{ $cita->id_ar_cita }}">
                                                        <span class="piase-agenda-date">
                                                            <span class="piase-agenda-day">{{ $fechaTs ? date('d', $fechaTs) : '--' }}</span>
                                                            <span class="piase-agenda-month">{{ isset($mesesPIASE[$mesNum]) ? $mesesPIASE[$mesNum] : '' }}</span>
                                                        </span>
                                                        <span class="piase-agenda-body">
                                                            <span class="piase-agenda-time">{{ substr($cita->hora_inicio_cita,0,5) }} - {{ substr($cita->hora_fin_cita,0,5) }}</span><br>
                                                            <?php $estadoCitaAgenda = isset($cita->estado_cita) ? $cita->estado_cita : $cita->estado; ?>
                                                            <span class="label label-info">Sesión {{ $cita->numero_sesion }}</span>
                                                            <span class="label {{ $claseEstadoCitaPIASE($estadoCitaAgenda) }}">{{ $estadoCitaAgenda }}</span><br>
                                                            <?php
                                                                $totalSesionCita = isset($cita->total_actividades) ? (int)$cita->total_actividades : 0;
                                                                $cumplidasSesionCita = isset($cita->actividades_con_evidencia) ? (int)$cita->actividades_con_evidencia : 0;
                                                                $citaCanceladaCita = in_array($estadoCitaAgenda, array('cancelada', 'cancelado'));
                                                                ?>
                                                            @if($citaCanceladaCita)
                                                                <span class="piase-progress-mini piase-progress-mini-warn">Sesión cancelada</span><br>
                                                            @else
                                                                <span class="piase-progress-mini {{ $cumplidasSesionCita >= $totalSesionCita && $totalSesionCita > 0 ? 'piase-progress-mini-ok' : 'piase-progress-mini-warn' }}">Actividades: {{ $cumplidasSesionCita }}/{{ $totalSesionCita }}</span><br>
                                                            @endif
                                                            <small>{{ isset($diasSemanaPIASE[(int)$cita->dia_semana]) ? $diasSemanaPIASE[(int)$cita->dia_semana] : '' }} | {{ date('d/m/Y', strtotime($cita->fecha_cita)) }}</small><br>
                                                            <a class="piase-link-actividades" href="{{ route('areas_atencion.mis_casos.index', array('id_periodo' => $filtros['id_periodo'], 'id_carrera' => $filtros['id_carrera'], 'tab' => 'tab-actividades', 'focus' => 'caso-' . $baseCita->id_ar_caso)) }}#tab-actividades">Ver actividades asignadas</a><br>
                                                            <small class="piase-agenda-place">{{ $cita->lugar }}</small>
                                                        </span>
                                                        <div class="text-center piase-actions" style="margin-top:8px;">
                                                            @if(!$esResponsablePedagogia)
                                                                <button type="button" class="btn btn-primary btn-xs"
                                                                        data-id-periodo="{{ $cita->id_periodo }}"
                                                                        data-id-cita="{{ $cita->id_ar_cita }}"
                                                                        data-alumno="{{ e($cita->alumno) }}"
                                                                        data-fecha="{{ date('Y-m-d', strtotime($cita->fecha_cita)) }}"
                                                                        data-horario="{{ $cita->id_area_responsable_horario }}"
                                                                        data-estado="{{ $estadoCitaAgenda }}"
                                                                        data-lugar="{{ e($cita->lugar) }}"
                                                                        data-observaciones="{{ e($cita->motivo) }}"
                                                                        data-return-tab="tab-citas"
                                                                        onclick="abrirModalEditarSesion(this)">
                                                                    Editar sesión
                                                                </button>
                                                            @endif
                                                            @if(!$esResponsablePedagogia && !in_array($estadoCitaAgenda, array('cancelada', 'cancelado')))
                                                                <button type="button" class="btn btn-success btn-xs"
                                                                        data-id-periodo="{{ $cita->id_periodo }}"
                                                                        data-id-cita="{{ $cita->id_ar_cita }}"
                                                                        data-alumno="{{ e($cita->alumno) }}"
                                                                        data-return-tab="tab-citas"
                                                                        onclick="abrirModalActividad(this)">
                                                                    Agregar actividad
                                                                </button>
                                                                @if(!$esResponsablePedagogia)
                                                                    <form method="POST" action="{{ route('piase.sesion.cancelar') }}" style="display:inline;" onsubmit="return confirm('¿Deseas cancelar esta cita? La cita quedará en historial como cancelada.');">
                                                                        {{ csrf_field() }}
                                                                        <input type="hidden" name="id_periodo" value="{{ $cita->id_periodo }}">
                                                                        <input type="hidden" name="id_ar_cita" value="{{ $cita->id_ar_cita }}">
                                                                        <input type="hidden" name="motivo_cancelacion" value="Cancelada desde Citas">
                                                                        <input type="hidden" name="active_tab" value="tab-citas">
                                                                        <input type="hidden" name="tab" value="tab-citas">
                                                                        <input type="hidden" name="active_focus" value="cita-{{ $cita->id_ar_cita }}">
                                                                        <input type="hidden" name="focus" value="cita-{{ $cita->id_ar_cita }}">
                                                                        <input type="hidden" name="id_carrera" value="{{ $filtros['id_carrera'] }}">
                                                                        <button type="submit" class="btn btn-danger btn-xs">Cancelar cita</button>
                                                                    </form>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-warning text-center">No tienes citas asignadas para el periodo seleccionado.</div>
                            @endforelse
                        </div>

                        <div role="tabpanel" class="tab-pane {{ $tabActivo == 'tab-cerrados' ? 'active' : '' }}" id="tab-cerrados">
                            <div class="piase-buscador-tab" data-piase-buscador-tab="tab-cerrados">
                                <label for="buscador-tab-cerrados" style="margin-bottom:6px;">Buscar caso cerrado:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                                    <input type="text" id="buscador-tab-cerrados" class="form-control piase-busqueda-tab" data-target-tab="tab-cerrados" placeholder="Buscar por estudiante, cuenta, carrera, asignatura, docente, resultado o estado...">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default piase-limpiar-busqueda" data-target-tab="tab-cerrados">Limpiar</button>
                                    </span>
                                </div>
                                <span class="piase-contador-tab" data-target-tab="tab-cerrados"></span>
                                <div class="alert alert-warning piase-sin-resultados-tab" data-target-tab="tab-cerrados">No se encontraron registros con el texto capturado.</div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover table-condensed piase-table">
                                    <thead>
                                    <tr style="background:#dddddd;color:black;">
                                        <th class="piase-col-alumno">Nombre completo</th>
                                        <th class="piase-col-carrera">Carrera</th>
                                        <th class="piase-col-asignatura">Asignatura</th>
                                        <th class="piase-col-docente">Docente</th>
                                        @foreach($unidades as $unidad)
                                            <th class="piase-col-unidad text-center">U{{ $unidad }}</th>
                                        @endforeach
                                        <th class="text-center">Fecha cierre</th>
                                        <th class="text-center">Resultado</th>
                                        <th class="text-center">Ruta</th>
                                        <th class="text-center">Gráfica</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($gruposCerrados as $grupo)
                                            <?php $rowspan = count($grupo['filas']); $primera = true; $base = $grupo['base']; ?>
                                        @foreach($grupo['filas'] as $fila)
                                            <tr data-focus-id="caso-{{ $base->id_ar_caso }}" data-piase-group="cerrados-{{ $base->id_ar_caso }}">
                                                @if($primera)
                                                    <td rowspan="{{ $rowspan }}" class="piase-wrap piase-student-cell">
                                                        <strong>{{ $base->alumno }}</strong><br>
                                                        <small>Cuenta: {{ $base->cuenta }}</small>
                                                    </td>
                                                    <td rowspan="{{ $rowspan }}" class="piase-wrap">{{ $base->carrera }}</td>
                                                    <td rowspan="{{ $rowspan }}" class="text-center">{{ $base->id_semestre }}</td>
                                                @endif
                                                <td class="piase-wrap"><strong>{{ $fila->materia }}</strong><br><small>{{ $fila->clave_materia }}</small></td>
                                                <td class="piase-wrap">{{ isset($fila->docente_asignatura) ? $fila->docente_asignatura : 'Sin docente registrado' }}</td>
                                                @foreach($unidades as $unidad)
                                                    <td class="text-center">
                                                        @if(isset($fila->calificaciones[$unidad]))
                                                            @if((int)$fila->calificaciones[$unidad] >= 70)
                                                                <span class="piase-cal piase-cal-ok">{{ $fila->calificaciones[$unidad] }}</span>
                                                            @else
                                                                <span class="piase-cal piase-cal-bad">{{ $fila->calificaciones[$unidad] }}</span>
                                                            @endif
                                                        @else
                                                            <span class="piase-cal piase-cal-empty">-</span>
                                                        @endif
                                                    </td>
                                                @endforeach
                                                @if($primera)
                                                    <td rowspan="{{ $rowspan }}" class="text-center">{{ $base->fecha_cierre }}</td>
                                                    <td rowspan="{{ $rowspan }}" class="piase-wrap">{{ $base->resultado_cierre }}</td>
                                                    <td rowspan="{{ $rowspan }}" class="text-center">
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                                data-id-caso="{{ $base->id_ar_caso }}"
                                                                data-alumno="{{ e($base->alumno) }}"
                                                                onclick="abrirRutaVisual(this)">
                                                            <span class="glyphicon glyphicon-road"></span> Ver ruta
                                                        </button>
                                                    </td>
                                                    <td rowspan="{{ $rowspan }}" class="text-center">
                                                        <button type="button" class="btn btn-info btn-sm" onclick="abrirGrafica({{ $base->id_ar_caso }})">
                                                            <span class="glyphicon glyphicon-stats"></span> Ver evolución
                                                        </button>
                                                    </td>
                                                        <?php $primera = false; ?>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @empty
                                        <tr>
                                            <td colspan="{{ 10 + count($unidades) }}" class="text-center">No hay casos cerrados para el periodo seleccionado.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane {{ $tabActivo == 'tab-actividades' ? 'active' : '' }}" id="tab-actividades">
                            <div class="piase-buscador-tab" data-piase-buscador-tab="tab-actividades">
                                <label for="buscador-tab-actividades" style="margin-bottom:6px;">Buscar actividad asignada/calificación:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                                    <input type="text" id="buscador-tab-actividades" class="form-control piase-busqueda-tab" data-target-tab="tab-actividades" placeholder="Buscar por estudiante, cuenta, carrera, área, categoría, actividad asignada, evidencia, archivo, estado o estrellas...">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default piase-limpiar-busqueda" data-target-tab="tab-actividades">Limpiar</button>
                                    </span>
                                </div>
                                <span class="piase-contador-tab" data-target-tab="tab-actividades"></span>
                                <div class="alert alert-warning piase-sin-resultados-tab" data-target-tab="tab-actividades">No se encontraron actividades asignadas con el texto capturado.</div>
                            </div>
                            @forelse($gruposActividadesCarreras as $grupoCarreraActividad)
                                <div class="panel panel-primary piase-career-panel" data-search="{{ e(strtolower($grupoCarreraActividad['carrera'])) }}">
                                    <div class="panel-heading" style="background:#337ab7;border-color:#337ab7;">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <strong>{{ $grupoCarreraActividad['carrera'] }}</strong>
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <span class="label label-info">{{ $grupoCarreraActividad['total_actividades'] }} actividad(es)</span>
                                                @if($grupoCarreraActividad['total_sin_evidencia'] > 0)
                                                    <span class="label label-warning">{{ $grupoCarreraActividad['total_sin_evidencia'] }} sin evidencia</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body" style="background:#f7fbff;">
                                        @foreach($grupoCarreraActividad['estudiantes'] as $grupoActividad)
                                                <?php $baseActividad = $grupoActividad['base']; ?>
                                            <div class="panel panel-default piase-student-panel" data-focus-id="caso-{{ $baseActividad->id_ar_caso }}" data-search="{{ e(strtolower($baseActividad->alumno.' '.$baseActividad->cuenta.' '.$baseActividad->carrera)) }}">
                                                <div class="panel-heading">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <strong>{{ $baseActividad->alumno }}</strong><br>
                                                            <small>Cuenta: {{ $baseActividad->cuenta }}</small>
                                                        </div>
                                                        <div class="col-md-4 text-right">
                                                            <button type="button" class="btn btn-info btn-sm"
                                                                    data-id-caso="{{ $baseActividad->id_ar_caso }}"
                                                                    data-alumno="{{ e($baseActividad->alumno) }}"
                                                                    onclick="abrirRutaVisual(this)">
                                                                <span class="glyphicon glyphicon-road"></span> Ver ruta
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped table-hover table-condensed piase-table" style="margin-bottom:0;">
                                                        <thead>
                                                        <tr style="background:#dddddd;color:black;">
                                                            <th>Área</th>
                                                            <th>Categoría</th>
                                                            <th>Actividad asignada</th>
                                                            <th class="text-center">Fecha límite</th>
                                                            <th>Actividad entregada por el estudiante</th>
                                                            <th class="text-center">Archivo</th>
                                                            <th class="text-center">Estrellas</th>
                                                            <th class="text-center">Estado entrega</th>
                                                            <th class="text-center">Acciones</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($grupoActividad['actividades'] as $actividad)
                                                                <?php
                                                                $tieneEvidencia = !empty($actividad->id_ar_entrega);
                                                                $estrellasActuales = (int) $actividad->calificacion_estrellas;
                                                                $idRevisionActual = isset($actividad->id_ar_revision) ? (int) $actividad->id_ar_revision : 0;
                                                                ?>
                                                            <tr data-focus-id="actividad-{{ $actividad->id_ar_actividad }}">
                                                                <td>{{ $actividad->area }}</td>
                                                                <td>{{ $actividad->categoria }}</td>
                                                                <td class="piase-wrap">
                                                                    <strong>{{ $actividad->titulo }}</strong><br>
                                                                    @if(trim((string)$actividad->descripcion) != '')
                                                                        <small>{{ $actividad->descripcion }}</small>
                                                                    @else
                                                                        <small class="text-muted">Sin descripción capturada por el responsable.</small>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if($actividad->fecha_limite)
                                                                        {{ $actividad->fecha_limite }}
                                                                    @else
                                                                        <span class="text-muted">Sin fecha límite</span>
                                                                    @endif
                                                                </td>
                                                                <td class="piase-wrap">
                                                                    @if($tieneEvidencia)
                                                                        <strong>Entregada:</strong> {{ $actividad->fecha_entrega }}<br>
                                                                        @if(trim((string)$actividad->texto_evidencia) != '')
                                                                            <div style="background:#f5f9ff;border:1px solid #c9def5;border-radius:4px;padding:7px;margin-top:5px;">
                                                                                {{ $actividad->texto_evidencia }}
                                                                            </div>
                                                                        @else
                                                                            <span class="text-muted">El estudiante entregó archivo sin descripción adicional.</span>
                                                                        @endif
                                                                    @else
                                                                        <span class="label label-warning">Sin evidencia</span><br>
                                                                        <small class="text-muted">La actividad ya está asignada, pero el estudiante todavía no ha cargado evidencia.</small>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if($tieneEvidencia && $actividad->ruta_archivo)
                                                                        <a href="{{ asset($actividad->ruta_archivo) }}" target="_blank" class="btn btn-default btn-xs">
                                                                            <span class="glyphicon glyphicon-paperclip"></span> Ver evidencia
                                                                        </a>
                                                                        <br><small class="text-muted">{{ basename($actividad->ruta_archivo) }}</small>
                                                                    @elseif($tieneEvidencia)
                                                                        <span class="label label-info">Solo texto</span>
                                                                    @else
                                                                        <span class="label label-warning">Sin evidencia</span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if($estrellasActuales > 0)
                                                                        <span class="piase-stars" title="Última revisión #{{ $idRevisionActual }}">
                                                                            @for($i = 1; $i <= 5; $i++)
                                                                                @if($i <= $estrellasActuales)★@else☆@endif
                                                                            @endfor
                                                                        </span>
                                                                        <br>
                                                                        <small class="text-muted">{{ $estrellasActuales }}/5</small>
                                                                    @elseif($tieneEvidencia)
                                                                        <span class="label label-warning">Sin calificar</span>
                                                                    @else
                                                                        <span class="text-muted">No aplica</span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if($tieneEvidencia)
                                                                        <span class="label label-default">{{ $actividad->estado_entrega }}</span>
                                                                    @else
                                                                        <span class="label label-warning">Sin evidencia</span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center piase-actions">
                                                                    @if($tieneEvidencia)
                                                                        @if(!$actividad->calificacion_estrellas)
                                                                            <button type="button" class="btn btn-warning btn-xs piase-btn-stars"
                                                                                    data-id-periodo="{{ $actividad->id_periodo }}"
                                                                                    data-id-entrega="{{ $actividad->id_ar_entrega }}"
                                                                                    data-id-actividad="{{ $actividad->id_ar_actividad }}"
                                                                                    data-actividad="{{ e($actividad->titulo) }}"
                                                                                    data-estrellas="{{ (int) $actividad->calificacion_estrellas }}"
                                                                                    data-estado-revision="{{ e($actividad->estado_revision ? $actividad->estado_revision : 'revisada') }}"
                                                                                    data-comentarios="{{ e($actividad->comentarios_revision ? $actividad->comentarios_revision : '') }}"
                                                                                    onclick="abrirModalRevisarEvidencia(this)">Calificar ★★★★★</button>
                                                                        @else
                                                                            <button type="button" class="btn btn-default btn-xs piase-btn-stars"
                                                                                    data-id-periodo="{{ $actividad->id_periodo }}"
                                                                                    data-id-entrega="{{ $actividad->id_ar_entrega }}"
                                                                                    data-id-actividad="{{ $actividad->id_ar_actividad }}"
                                                                                    data-actividad="{{ e($actividad->titulo) }}"
                                                                                    data-estrellas="{{ (int) $actividad->calificacion_estrellas }}"
                                                                                    data-estado-revision="{{ e($actividad->estado_revision ? $actividad->estado_revision : 'revisada') }}"
                                                                                    data-comentarios="{{ e($actividad->comentarios_revision ? $actividad->comentarios_revision : '') }}"
                                                                                    onclick="abrirModalRevisarEvidencia(this)">Actualizar calificación</button>
                                                                        @endif
                                                                    @else
                                                                        <span class="label label-warning">Pendiente de evidencia</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-warning text-center">No hay actividades asignadas para el periodo seleccionado.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('piase.agregar_canalizacion') }}" id="formNuevoCanalizar" data-url-primera="{{ route('piase.agregar_canalizacion') }}" data-url-sesion="{{ route('piase.sesion') }}">
                {{ csrf_field() }}
                <input type="hidden" name="active_tab" class="piase-active-tab" value="{{ $tabActivo }}">
                <input type="hidden" name="tab" class="piase-tab-hidden" value="{{ $tabActivo }}">
                <input type="hidden" name="active_focus" class="piase-active-focus" value="{{ $focusActivo }}">
                <input type="hidden" name="focus" class="piase-focus-hidden" value="{{ $focusActivo }}">
                <input type="hidden" name="filtro_id_carrera" value="{{ $filtroIdCarreraValor }}">
                <input type="hidden" name="buscar_estudiante" value="{{ e($buscarEstudianteValor) }}">
                <input type="hidden" name="id_periodo" id="nuevo_id_periodo" value="{{ $filtros['id_periodo'] }}">
                <input type="hidden" name="id_alumno" id="nuevo_id_alumno">
                <input type="hidden" name="id_carrera" id="nuevo_id_carrera">
                <input type="hidden" name="id_ar_caso" id="nuevo_id_caso">
                <input type="hidden" name="id_ar_caso_canalizacion" id="nuevo_id_canalizacion">
                <input type="hidden" name="mantener_modal" value="1">
                <input type="hidden" name="hora_inicio_slot" id="nuevo_hora_inicio_slot">
                <input type="hidden" name="hora_fin_slot" id="nuevo_hora_fin_slot">
                <div class="modal fade piase-modal" id="modalNuevoCanalizar" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-warning">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Agregar canalización desde Pedagogía</h4>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-info">
                                    Al guardar se registrará el caso, la canalización y la primera sesión/cita con el responsable seleccionado.
                                </div>
                                <p><strong>Estudiante:</strong> <span id="nuevo_alumno"></span></p>
                                <div id="nuevo_fechas_previas_box" class="piase-fechas-asignadas" style="display:none;margin-bottom:12px;"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Área destino</label>
                                        <select name="id_area_destino" id="nuevo_area" class="form-control" required onchange="actualizarResponsables('nuevo')">
                                            <option value="">Selecciona...</option>
                                            @foreach($areasActivas as $area)
                                                <option value="{{ $area->id_area_atencion }}">{{ $area->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Responsable</label>
                                        <select name="id_area_responsable_periodo_destino" id="nuevo_responsable" class="form-control" required onchange="actualizarHorarios('nuevo')">
                                            <option value="">Selecciona área primero</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px;">
                                    <div class="col-md-6">
                                        <label>Día de atención</label>
                                        <div class="piase-dias-box" id="nuevo_dias_box">
                                            <strong>Antes de elegir la fecha puedes seleccionar:</strong><br>
                                            <span id="nuevo_dias_lista" class="piase-dia-pendiente">Selecciona área y responsable para ver los días permitidos.</span>
                                        </div>
                                        <input type="date" name="fecha_cita" id="nuevo_fecha" class="form-control" required disabled min="{{ $periodoSeleccionado && isset($periodoSeleccionado->fecha_inicio) && $periodoSeleccionado->fecha_inicio ? date('Y-m-d', strtotime($periodoSeleccionado->fecha_inicio)) : '' }}" max="{{ $periodoSeleccionado && isset($periodoSeleccionado->fecha_termino) && $periodoSeleccionado->fecha_termino ? date('Y-m-d', strtotime($periodoSeleccionado->fecha_termino)) : '' }}" onchange="actualizarHorarios('nuevo')">
                                        <span class="piase-help" id="nuevo_dias_disponibles">Selecciona área y responsable para conocer días disponibles.</span>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Horario disponible</label>
                                        <select name="id_area_responsable_horario" id="nuevo_horario" class="form-control" required onchange="seleccionarSlot('nuevo')">
                                            <option value="">Selecciona responsable y día</option>
                                        </select>
                                        <div class="alert alert-warning piase-slot-warning" id="nuevo_warning"></div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px;">
                                    <div class="col-md-12">
                                        <label>Observaciones</label>
                                        <textarea name="observaciones" class="form-control" rows="3" maxlength="500"></textarea>
                                    </div>
                                </div>
                                <div class="alert alert-success" id="nuevo_ajax_ok" style="display:none;margin-top:12px;"></div>
                                <div class="alert alert-danger" id="nuevo_ajax_error" style="display:none;margin-top:12px;"></div>
                                <div class="panel panel-info" id="nuevo_citas_box" style="display:none;margin-top:12px;">
                                    <div class="panel-heading"><strong>Citas agendadas en esta captura</strong></div>
                                    <div class="panel-body" style="padding:10px 15px;">
                                        <ul id="nuevo_citas_lista" style="margin-bottom:6px;"></ul>
                                        <small class="text-muted">El modal permanecerá abierto para que puedas agregar otra fecha. Usa <strong>Cerrar citas</strong> cuando termines.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar citas</button>
                                <button type="submit" class="btn btn-warning" id="nuevo_btn_guardar">Guardar canalización</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <form method="POST" action="{{ route('piase.canalizar') }}" id="formCanalizar" data-url-primera="{{ route('piase.canalizar') }}" data-url-sesion="{{ route('piase.sesion') }}">
                {{ csrf_field() }}
                <input type="hidden" name="active_tab" class="piase-active-tab" value="{{ $tabActivo }}">
                <input type="hidden" name="tab" class="piase-tab-hidden" value="{{ $tabActivo }}">
                <input type="hidden" name="active_focus" class="piase-active-focus" value="{{ $focusActivo }}">
                <input type="hidden" name="focus" class="piase-focus-hidden" value="{{ $focusActivo }}">
                <input type="hidden" name="filtro_id_carrera" value="{{ $filtroIdCarreraValor }}">
                <input type="hidden" name="buscar_estudiante" value="{{ e($buscarEstudianteValor) }}">
                <input type="hidden" name="id_periodo" id="canalizar_id_periodo" value="{{ $filtros['id_periodo'] }}">
                <input type="hidden" name="id_ar_caso" id="canalizar_id_caso">
                <input type="hidden" name="id_ar_caso_canalizacion" id="canalizar_id_canalizacion">
                <input type="hidden" name="mantener_modal" value="1">
                <input type="hidden" name="hora_inicio_slot" id="canalizar_hora_inicio_slot">
                <input type="hidden" name="hora_fin_slot" id="canalizar_hora_fin_slot">
                <div class="modal fade piase-modal" id="modalCanalizar" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-warning">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Canalizar estudiante</h4>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-info">
                                    Al guardar se registrará la canalización y la primera sesión/cita con el responsable seleccionado.
                                </div>
                                <p><strong>Estudiante:</strong> <span id="canalizar_alumno"></span></p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Área destino</label>
                                        <select name="id_area_destino" id="canalizar_area" class="form-control" required onchange="actualizarResponsables('canalizar')">
                                            <option value="">Selecciona...</option>
                                            @foreach($areasActivas as $area)
                                                <option value="{{ $area->id_area_atencion }}">{{ $area->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Responsable</label>
                                        <select name="id_area_responsable_periodo_destino" id="canalizar_responsable" class="form-control" required onchange="actualizarHorarios('canalizar')">
                                            <option value="">Selecciona área primero</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px;">
                                    <div class="col-md-6">
                                        <label>Día de atención</label>
                                        <div class="piase-dias-box" id="canalizar_dias_box">
                                            <strong>Antes de elegir la fecha puedes seleccionar:</strong><br>
                                            <span id="canalizar_dias_lista" class="piase-dia-pendiente">Selecciona área y responsable para ver los días permitidos.</span>
                                        </div>
                                        <input type="date" name="fecha_cita" id="canalizar_fecha" class="form-control" required disabled min="{{ $periodoSeleccionado && isset($periodoSeleccionado->fecha_inicio) && $periodoSeleccionado->fecha_inicio ? date('Y-m-d', strtotime($periodoSeleccionado->fecha_inicio)) : '' }}" max="{{ $periodoSeleccionado && isset($periodoSeleccionado->fecha_termino) && $periodoSeleccionado->fecha_termino ? date('Y-m-d', strtotime($periodoSeleccionado->fecha_termino)) : '' }}" onchange="actualizarHorarios('canalizar')">
                                        <span class="piase-help" id="canalizar_dias_disponibles">Selecciona área y responsable para conocer días disponibles.</span>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Horario disponible</label>
                                        <select name="id_area_responsable_horario" id="canalizar_horario" class="form-control" required onchange="seleccionarSlot('canalizar')">
                                            <option value="">Selecciona responsable y día</option>
                                        </select>
                                        <div class="alert alert-warning piase-slot-warning" id="canalizar_warning"></div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px;">
                                    <div class="col-md-12">
                                        <label>Observaciones</label>
                                        <textarea name="observaciones" class="form-control" rows="3" maxlength="500"></textarea>
                                    </div>
                                </div>
                                <div class="alert alert-success" id="canalizar_ajax_ok" style="display:none;margin-top:12px;"></div>
                                <div class="alert alert-danger" id="canalizar_ajax_error" style="display:none;margin-top:12px;"></div>
                                <div class="panel panel-info" id="canalizar_citas_box" style="display:none;margin-top:12px;">
                                    <div class="panel-heading"><strong>Citas agendadas en esta captura</strong></div>
                                    <div class="panel-body" style="padding:10px 15px;">
                                        <ul id="canalizar_citas_lista" style="margin-bottom:6px;"></ul>
                                        <small class="text-muted">El modal permanecerá abierto para que puedas agregar otra fecha. Usa <strong>Cerrar citas</strong> cuando termines.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar citas</button>
                                <button type="submit" class="btn btn-warning" id="canalizar_btn_guardar">Guardar canalización</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <form method="POST" action="{{ route('piase.sesion') }}" id="formSesion">
                {{ csrf_field() }}
                <input type="hidden" name="active_tab" class="piase-active-tab" value="{{ $tabActivo }}">
                <input type="hidden" name="tab" class="piase-tab-hidden" value="{{ $tabActivo }}">
                <input type="hidden" name="active_focus" class="piase-active-focus" value="{{ $focusActivo }}">
                <input type="hidden" name="focus" class="piase-focus-hidden" value="{{ $focusActivo }}">
                <input type="hidden" name="filtro_id_carrera" value="{{ $filtroIdCarreraValor }}">
                <input type="hidden" name="buscar_estudiante" value="{{ e($buscarEstudianteValor) }}">
                <input type="hidden" name="id_periodo" id="sesion_id_periodo" value="{{ $filtros['id_periodo'] }}">
                <input type="hidden" name="id_ar_caso" id="sesion_id_caso">
                <input type="hidden" name="id_ar_caso_canalizacion" id="sesion_id_canalizacion">
                <input type="hidden" name="hora_inicio_slot" id="sesion_hora_inicio_slot">
                <input type="hidden" name="hora_fin_slot" id="sesion_hora_fin_slot">
                <div class="modal fade piase-modal" id="modalSesion" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Agregar sesión</h4>
                            </div>
                            <div class="modal-body">
                                <p><strong>Estudiante:</strong> <span id="sesion_alumno"></span></p>
                                <div class="alert alert-info" style="margin-bottom:12px;">
                                    Pedagogía general puede agregar una nueva sesión en cualquier área activa. Selecciona el área, responsable, fecha y horario disponible.
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Área destino</label>
                                        <select name="id_area_destino" id="sesion_area" class="form-control" required onchange="actualizarResponsables('sesion')">
                                            <option value="">Selecciona...</option>
                                            @foreach($areasActivas as $area)
                                                <option value="{{ $area->id_area_atencion }}">{{ $area->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Responsable</label>
                                        <select name="id_area_responsable_periodo_destino" id="sesion_responsable" class="form-control" required onchange="actualizarHorarios('sesion')">
                                            <option value="">Selecciona área primero</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px;">
                                    <div class="col-md-6">
                                        <label>Día de atención</label>
                                        <div class="piase-dias-box" id="sesion_dias_box">
                                            <strong>Antes de elegir la fecha puedes seleccionar:</strong><br>
                                            <span id="sesion_dias_lista" class="piase-dia-pendiente">Selecciona área y responsable para ver los días permitidos.</span>
                                        </div>
                                        <input type="date" name="fecha_cita" id="sesion_fecha" class="form-control" required disabled min="{{ $periodoSeleccionado && isset($periodoSeleccionado->fecha_inicio) && $periodoSeleccionado->fecha_inicio ? date('Y-m-d', strtotime($periodoSeleccionado->fecha_inicio)) : '' }}" max="{{ $periodoSeleccionado && isset($periodoSeleccionado->fecha_termino) && $periodoSeleccionado->fecha_termino ? date('Y-m-d', strtotime($periodoSeleccionado->fecha_termino)) : '' }}" onchange="actualizarHorarios('sesion')">
                                        <span class="piase-help" id="sesion_dias_disponibles">Selecciona responsable para conocer días disponibles.</span>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px;">
                                    <div class="col-md-6">
                                        <label>Horario disponible</label>
                                        <select name="id_area_responsable_horario" id="sesion_horario" class="form-control" required onchange="seleccionarSlot('sesion')">
                                            <option value="">Selecciona responsable y día</option>
                                        </select>
                                        <div class="alert alert-warning piase-slot-warning" id="sesion_warning"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Observaciones</label>
                                        <textarea name="observaciones" class="form-control" rows="2" maxlength="500"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar sesión</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <form method="POST" action="{{ route('piase.cerrar') }}" id="formCerrar">
                {{ csrf_field() }}
                <input type="hidden" name="active_tab" class="piase-active-tab" value="{{ $tabActivo }}">
                <input type="hidden" name="tab" class="piase-tab-hidden" value="{{ $tabActivo }}">
                <input type="hidden" name="active_focus" class="piase-active-focus" value="{{ $focusActivo }}">
                <input type="hidden" name="focus" class="piase-focus-hidden" value="{{ $focusActivo }}">
                <input type="hidden" name="filtro_id_carrera" value="{{ $filtroIdCarreraValor }}">
                <input type="hidden" name="buscar_estudiante" value="{{ e($buscarEstudianteValor) }}">
                <input type="hidden" name="id_periodo" id="cerrar_id_periodo" value="{{ $filtros['id_periodo'] }}">
                <input type="hidden" name="id_ar_caso" id="cerrar_id_caso">
                <div class="modal fade" id="modalCerrar" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Cerrar caso</h4>
                            </div>
                            <div class="modal-body">
                                <p><strong>Estudiante:</strong> <span id="cerrar_alumno"></span></p>

                                <div class="alert alert-info" style="margin-bottom:12px;">
                                    El cierre del caso se realizará con un diagnóstico final. La última canalización solo se registrará como recomendación, no generará citas ni seguimiento adicional.
                                </div>

                                <div class="form-group">
                                    <label>Diagnóstico de cierre <span class="text-danger">*</span></label>
                                    <textarea name="resultado_cierre" id="cerrar_resultado_cierre" class="form-control" rows="4" maxlength="1000" required placeholder="Describe el diagnóstico final, avances observados, conclusión y recomendaciones generales."></textarea>
                                </div>

                                <div class="form-group">
                                    <label>¿Requiere una última canalización como recomendación?</label><br>
                                    <label class="radio-inline">
                                        <input type="radio" name="requiere_canalizacion_final" value="no" checked onchange="toggleCanalizacionFinal()"> No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="requiere_canalizacion_final" value="si" onchange="toggleCanalizacionFinal()"> Sí
                                    </label>
                                </div>

                                <div id="cerrar_canalizacion_final_box" class="well" style="display:none; margin-bottom:0;">
                                    <div class="form-group">
                                        <label>Área sugerida para canalización final</label>
                                        <select name="id_area_canalizacion_final" id="cerrar_area_final" class="form-control">
                                            <option value="">Selecciona...</option>
                                            @foreach($areasActivas as $area)
                                                <option value="{{ $area->id_area_atencion }}">{{ $area->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" style="margin-bottom:0;">
                                        <label>Motivo / indicaciones de la recomendación</label>
                                        <textarea name="motivo_canalizacion_final" id="cerrar_motivo_final" class="form-control" rows="3" maxlength="1000" placeholder="Indica por qué se recomienda esta canalización final. Esta recomendación no genera cita."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Cerrar caso</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <form method="POST" action="{{ route('piase.sesion.editar') }}" id="formEditarSesion" data-piase-tab-forzar="tab-citas">
                {{ csrf_field() }}
                <input type="hidden" name="active_tab" class="piase-active-tab" value="{{ $tabActivo }}">
                <input type="hidden" name="tab" class="piase-tab-hidden" value="{{ $tabActivo }}">
                <input type="hidden" name="active_focus" class="piase-active-focus" value="{{ $focusActivo }}">
                <input type="hidden" name="focus" class="piase-focus-hidden" value="{{ $focusActivo }}">
                <input type="hidden" name="filtro_id_carrera" value="{{ $filtroIdCarreraValor }}">
                <input type="hidden" name="buscar_estudiante" value="{{ e($buscarEstudianteValor) }}">
                <input type="hidden" name="id_periodo" id="edit_sesion_id_periodo">
                <input type="hidden" name="id_ar_cita" id="edit_sesion_id_cita">
                <input type="hidden" name="estado_cita" id="edit_sesion_estado_hidden">
                <input type="hidden" name="hora_inicio_slot" id="edit_sesion_hora_inicio_slot">
                <input type="hidden" name="hora_fin_slot" id="edit_sesion_hora_fin_slot">
                <div class="modal fade piase-modal" id="modalEditarSesion" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document"><div class="modal-content">
                            <div class="modal-header bg-info"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Editar sesión</h4></div>
                            <div class="modal-body">
                                <p><strong>Estudiante:</strong> <span id="edit_sesion_alumno"></span></p>
                                <div class="row">
                                    <div class="col-md-5"><label>Horario del responsable</label><select name="id_area_responsable_horario" id="edit_sesion_horario" class="form-control" required>
                                            <option value="">Selecciona horario</option>
                                            @foreach($horariosDisponibles as $h)
                                                @if((int)$h->id_personal === (int)$personal->id_personal)
                                                    <option value="{{ $h->id_area_responsable_horario }}" data-inicio="{{ $h->hora_inicio }}" data-fin="{{ $h->hora_fin }}" data-dia="{{ $h->dia_semana }}">{{ $h->area }} | {{ $h->responsable }} | Día {{ $h->dia_semana }} | {{ substr($h->hora_inicio,0,5) }} - {{ substr($h->hora_fin,0,5) }}</option>
                                                @endif
                                            @endforeach
                                        </select><small class="piase-help">El horario completo se ocupa para un solo estudiante por fecha.</small></div>
                                    <div class="col-md-3"><label>Fecha</label><input type="date" name="fecha_cita" id="edit_sesion_fecha" class="form-control" required></div>
                                    <div class="col-md-4"><label>Estado</label><select name="estado" id="edit_sesion_estado" class="form-control" required><option value="programada">Programada</option><option value="en_atencion">En atención</option><option value="atendida">Atendida</option><option value="cancelada">Cancelada</option></select></div>
                                </div>
                                <div class="row" style="margin-top:10px;"><div class="col-md-6"><label>Lugar</label><input type="text" name="lugar" id="edit_sesion_lugar" class="form-control"></div><div class="col-md-6"><label>Observaciones / motivo de cancelación</label><textarea name="observaciones" id="edit_sesion_observaciones" class="form-control" rows="2"></textarea></div></div>
                                <div class="alert alert-warning" style="margin-top:10px;margin-bottom:0;">
                                    Para cancelar una cita, cambia el estado a <strong>Cancelada</strong> y guarda la sesión. La cita permanecerá visible como historial.
                                </div>
                            </div>
                            <div class="modal-footer"><button type="submit" class="btn btn-primary">Guardar sesión</button></div>
                        </div></div>
                </div>
            </form>

            <form method="POST" action="{{ route('piase.actividad.guardar') }}" id="formActividad">
                {{ csrf_field() }}
                <input type="hidden" name="active_tab" class="piase-active-tab" value="{{ $tabActivo }}">
                <input type="hidden" name="tab" class="piase-tab-hidden" value="{{ $tabActivo }}">
                <input type="hidden" name="active_focus" class="piase-active-focus" value="{{ $focusActivo }}">
                <input type="hidden" name="focus" class="piase-focus-hidden" value="{{ $focusActivo }}">
                <input type="hidden" name="filtro_id_carrera" value="{{ $filtroIdCarreraValor }}">
                <input type="hidden" name="buscar_estudiante" value="{{ e($buscarEstudianteValor) }}">
                <input type="hidden" name="id_periodo" id="actividad_id_periodo">
                <input type="hidden" name="id_ar_cita" id="actividad_id_cita">
                <div class="modal fade piase-modal" id="modalActividad" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document"><div class="modal-content">
                            <div class="modal-header bg-success"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Agregar actividad</h4></div>
                            <div class="modal-body">
                                <p><strong>Estudiante:</strong> <span id="actividad_alumno"></span></p>
                                <label>Actividad del catálogo</label>
                                <select name="id_actividad_catalogo" class="form-control" required>
                                    <option value="">Selecciona actividad</option>
                                    @foreach($catalogoActividades as $act)
                                        <option value="{{ $act->id_actividad_catalogo }}">{{ $act->categoria }} - {{ $act->nombre }}</option>
                                    @endforeach
                                </select>
                                <div class="row" style="margin-top:10px;"><div class="col-md-4"><label>Fecha límite</label><input type="date" name="fecha_limite" class="form-control"></div><div class="col-md-8"><label>Indicaciones</label><textarea name="descripcion" class="form-control" rows="3"></textarea></div></div>
                                <div class="alert alert-info" style="margin-top:10px;">La actividad quedará ligada a la cita seleccionada y solo podrá calificarla el responsable que la asignó.</div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-success">Guardar actividad</button></div>
                        </div></div>
                </div>
            </form>

            <form method="POST" action="{{ route('piase.actividad.actualizar') }}" id="formEditarActividad">
                {{ csrf_field() }}
                <input type="hidden" name="active_tab" class="piase-active-tab" value="{{ $tabActivo }}">
                <input type="hidden" name="tab" class="piase-tab-hidden" value="{{ $tabActivo }}">
                <input type="hidden" name="active_focus" class="piase-active-focus" value="{{ $focusActivo }}">
                <input type="hidden" name="focus" class="piase-focus-hidden" value="{{ $focusActivo }}">
                <input type="hidden" name="filtro_id_carrera" value="{{ $filtroIdCarreraValor }}">
                <input type="hidden" name="buscar_estudiante" value="{{ e($buscarEstudianteValor) }}">
                <input type="hidden" name="id_periodo" id="edit_actividad_id_periodo">
                <input type="hidden" name="id_ar_actividad" id="edit_actividad_id">
                <div class="modal fade piase-modal" id="modalEditarActividad" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document"><div class="modal-content">
                            <div class="modal-header bg-info"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Editar actividad</h4></div>
                            <div class="modal-body">
                                <label>Actividad del catálogo</label>
                                <select name="id_actividad_catalogo" id="edit_actividad_catalogo" class="form-control" required>
                                    @foreach($catalogoActividades as $act)
                                        <option value="{{ $act->id_actividad_catalogo }}">{{ $act->categoria }} - {{ $act->nombre }}</option>
                                    @endforeach
                                </select>
                                <div class="row" style="margin-top:10px;"><div class="col-md-4"><label>Fecha límite</label><input type="date" name="fecha_limite" id="edit_actividad_fecha_limite" class="form-control"></div><div class="col-md-4"><label>Estado</label><select name="estado" id="edit_actividad_estado" class="form-control"><option value="asignada">Asignada</option><option value="en_proceso">En proceso</option><option value="entregada">Entregada</option><option value="revisada">Revisada</option><option value="cancelada">Cancelada</option></select></div></div>
                                <label style="margin-top:10px;">Indicaciones</label><textarea name="descripcion" id="edit_actividad_descripcion" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-primary">Actualizar actividad</button></div>
                        </div></div>
                </div>
            </form>

            <form method="POST" action="{{ route('piase.evidencia.revisar') }}" id="formRevisarEvidencia">
                {{ csrf_field() }}
                <input type="hidden" name="active_tab" class="piase-active-tab" value="{{ $tabActivo }}">
                <input type="hidden" name="tab" class="piase-tab-hidden" value="{{ $tabActivo }}">
                <input type="hidden" name="active_focus" class="piase-active-focus" value="{{ $focusActivo }}">
                <input type="hidden" name="focus" class="piase-focus-hidden" value="{{ $focusActivo }}">
                <input type="hidden" name="filtro_id_carrera" value="{{ $filtroIdCarreraValor }}">
                <input type="hidden" name="buscar_estudiante" value="{{ e($buscarEstudianteValor) }}">
                <input type="hidden" name="id_periodo" id="revision_id_periodo">
                <input type="hidden" name="id_ar_entrega" id="revision_id_entrega">
                <div class="modal fade piase-modal" id="modalRevisarEvidencia" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document"><div class="modal-content">
                            <div class="modal-header bg-warning"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Calificar evidencia</h4></div>
                            <div class="modal-body">
                                <p><strong>Actividad:</strong> <span id="revision_actividad"></span></p>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label>Estrellas</label>
                                        <div id="revision_rating_buttons" class="piase-rating">
                                            <label class="btn btn-default btn-sm piase-rating-btn" data-value="1" onclick="seleccionarEstrellasRevision(1)">
                                                <input type="radio" name="calificacion_estrellas" value="1" autocomplete="off" style="display:none;"> ★☆☆☆☆
                                            </label>
                                            <label class="btn btn-default btn-sm piase-rating-btn" data-value="2" onclick="seleccionarEstrellasRevision(2)">
                                                <input type="radio" name="calificacion_estrellas" value="2" autocomplete="off" style="display:none;"> ★★☆☆☆
                                            </label>
                                            <label class="btn btn-default btn-sm piase-rating-btn" data-value="3" onclick="seleccionarEstrellasRevision(3)">
                                                <input type="radio" name="calificacion_estrellas" value="3" autocomplete="off" style="display:none;"> ★★★☆☆
                                            </label>
                                            <label class="btn btn-default btn-sm piase-rating-btn" data-value="4" onclick="seleccionarEstrellasRevision(4)">
                                                <input type="radio" name="calificacion_estrellas" value="4" autocomplete="off" style="display:none;"> ★★★★☆
                                            </label>
                                            <label class="btn btn-default btn-sm piase-rating-btn" data-value="5" onclick="seleccionarEstrellasRevision(5)">
                                                <input type="radio" name="calificacion_estrellas" value="5" autocomplete="off" style="display:none;"> ★★★★★
                                            </label>
                                        </div>
                                        <strong id="revision_rating_text" class="piase-rating-text">Sin seleccionar</strong>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Estado</label>
                                        <select name="estado_revision" id="revision_estado_revision" class="form-control" required>
                                            <option value="revisada">Revisada</option>
                                            <option value="requiere_correccion">Requiere corrección</option>
                                            <option value="validada">Validada</option>
                                        </select>
                                    </div>
                                </div>
                                <label style="margin-top:10px;">Comentarios / recomendaciones</label><textarea name="comentarios" id="revision_comentarios" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-warning" id="btnGuardarRevision">Guardar calificación</button></div>
                        </div></div>
                </div>
            </form>


            <div class="modal fade piase-ruta-modal" id="modalRutaVisual" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background:#337ab7;color:#fff;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#fff;opacity:.9;"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><span class="glyphicon glyphicon-road"></span> Ruta de atención PIASE</h4>
                        </div>
                        <div class="modal-body">
                            <h4 id="ruta_visual_alumno" style="margin-top:0;"></h4>
                            <div id="contenidoRutaVisual" class="piase-ruta-road"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalGrafica" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><span class="glyphicon glyphicon-stats"></span> Evolución del caso PIASE</h4>
                        </div>
                        <div class="modal-body" id="contenidoGrafica"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                var horariosPIASE = {!! $horariosDisponiblesJson !!};
                var ocupacionPIASE = {!! $citasOcupadasJson !!};
                var periodoRangoPIASE = {!! $periodoRangoJson !!};
                var graficasCerrados = {!! $graficasCerradosJson !!};
                var rutasCasosPIASE = {!! json_encode($rutasCasos) !!};
                var filtroIdCarreraPIASE = '{{ $filtroIdCarreraValor }}';
                var buscarEstudianteFiltroPIASE = {!! json_encode($buscarEstudianteValor) !!};
                var tabActivoInicialPIASE = '{{ $tabActivo }}';
                var focoInicialPIASE = '{{ $focusActivo }}';
                var piaseFocusActual = focoInicialPIASE || '';

                function obtenerTabActivaPIASE() {
                    var tabId = $('#piaseTabs li.active a').attr('href');
                    return tabId ? tabId.replace('#', '') : 'tab-estudiantes';
                }

                function establecerFocoPIASE(focusId) {
                    focusId = focusId || '';
                    piaseFocusActual = focusId;
                    if (focusId !== '') {
                        try { localStorage.setItem('piase_focus_activo', focusId); } catch(err) {}
                    }
                }

                function fijarRetornoPIASE(tabId, focusId) {
                    if (!tabId || tabId.substring(0,4) !== 'tab-') {
                        tabId = obtenerTabActivaPIASE();
                    }
                    $('.piase-active-tab').val(tabId);
                    $('.piase-tab-hidden').val(tabId);
                    try { localStorage.setItem('piase_tab_activa', tabId); } catch(err) {}
                    if (focusId) {
                        establecerFocoPIASE(focusId);
                        $('.piase-active-focus').val(focusId);
                        $('.piase-focus-hidden').val(focusId);
                    }
                }

                function enfocarObjetoPIASE() {
                    var params = new URLSearchParams(window.location.search);
                    var focus = params.get('focus') || focoInicialPIASE || '';
                    if (!focus) {
                        try { focus = localStorage.getItem('piase_focus_activo') || ''; } catch(err) { focus = ''; }
                    }
                    if (!focus) { return; }
                    var target = $('[data-focus-id="' + focus + '"]').first();
                    if (target.length) {
                        $('html, body').animate({scrollTop: Math.max(target.offset().top - 110, 0)}, 350);
                        target.addClass('piase-focus-highlight');
                        setTimeout(function(){ target.removeClass('piase-focus-highlight'); }, 4500);
                    }
                }

                function activarTabPIASE(tabId) {
                    if (!tabId || tabId.substring(0,4) !== 'tab-') { tabId = 'tab-estudiantes'; }
                    var enlace = $('#piaseTabs a[href="#' + tabId + '"]');
                    if (enlace.length) {
                        enlace.tab('show');
                        $('.piase-active-tab').val(tabId);
                        try { localStorage.setItem('piase_tab_activa', tabId); } catch(e) {}
                    }
                }

                $(function() {
                    var tabUrl = new URLSearchParams(window.location.search).get('tab');
                    var tabHash = window.location.hash ? window.location.hash.replace('#', '') : '';
                    var tabGuardada = '';
                    try { tabGuardada = localStorage.getItem('piase_tab_activa') || ''; } catch(e) {}
                    activarTabPIASE(tabUrl || tabHash || tabGuardada || tabActivoInicialPIASE || 'tab-estudiantes');
                    setTimeout(enfocarObjetoPIASE, 450);

                    $('#piaseTabs a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                        var tabId = $(e.target).attr('href').replace('#', '');
                        $('.piase-active-tab').val(tabId);
                        try { localStorage.setItem('piase_tab_activa', tabId); } catch(err) {}
                    });

                    $(document).on('click', '[data-focus-id]', function() {
                        establecerFocoPIASE($(this).data('focus-id'));
                    });

                    $(document).on('click', 'button[type=submit], input[type=submit]', function() {
                        var contenedor = $(this).closest('[data-focus-id]');
                        if (contenedor.length) {
                            establecerFocoPIASE(contenedor.data('focus-id'));
                        }
                    });

                    $(document).on('submit', 'form', function() {
                        var tabForzada = $(this).attr('data-piase-tab-forzar') || '';
                        var tabId = tabForzada || $(this).find('input[name="tab"]').val() || obtenerTabActivaPIASE();
                        if (!tabId || tabId.substring(0,4) !== 'tab-') { tabId = obtenerTabActivaPIASE(); }
                        var focusId = $(this).find('input[name="focus"]').val() || piaseFocusActual || $(this).closest('[data-focus-id]').data('focus-id') || '';

                        if ($(this).find('input[name="active_tab"]').length === 0) {
                            $(this).append('<input type="hidden" name="active_tab" value="' + tabId + '">');
                        } else {
                            $(this).find('input[name="active_tab"]').val(tabId);
                        }

                        if ($(this).find('input[name="tab"]').length === 0) {
                            $(this).append('<input type="hidden" name="tab" value="' + tabId + '">');
                        } else {
                            $(this).find('input[name="tab"]').val(tabId);
                        }

                        if ($(this).find('input[name="filtro_id_carrera"]').length === 0) {
                            $(this).append('<input type="hidden" name="filtro_id_carrera" value="' + escapeHtmlPIASE(filtroIdCarreraPIASE) + '">');
                        }

                        if ($(this).find('input[name="buscar_estudiante"]').length === 0) {
                            $(this).append('<input type="hidden" name="buscar_estudiante" value="' + escapeHtmlPIASE(buscarEstudianteFiltroPIASE) + '">');
                        }

                        if (focusId !== '') {
                            if ($(this).find('input[name="active_focus"]').length === 0) {
                                $(this).append('<input type="hidden" name="active_focus" value="' + focusId + '">');
                            } else {
                                $(this).find('input[name="active_focus"]').val(focusId);
                            }
                            if ($(this).find('input[name="focus"]').length === 0) {
                                $(this).append('<input type="hidden" name="focus" value="' + focusId + '">');
                            } else {
                                $(this).find('input[name="focus"]').val(focusId);
                            }
                            try { localStorage.setItem('piase_focus_activo', focusId); } catch(err) {}
                        }

                        try { localStorage.setItem('piase_tab_activa', tabId); } catch(err) {}
                    });

                    // Los enlaces de actividades deben funcionar incluso al pulsarlos varias veces.
                    $(document).on('click', '.piase-ir-actividades, .piase-link-actividades', function(e) {
                        e.preventDefault();
                        var url = new URL($(this).attr('href'), window.location.href);
                        url.searchParams.set('tab', 'tab-actividades');
                        url.searchParams.set('active_tab', 'tab-actividades');
                        try { localStorage.setItem('piase_tab_activa', 'tab-actividades'); } catch(err) {}
                        activarTabPIASE('tab-actividades');
                        if (url.pathname + url.search !== window.location.pathname + window.location.search) {
                            window.location.assign(url.toString());
                        } else {
                            enfocarObjetoPIASE();
                            window.location.hash = 'tab-actividades';
                        }
                    });

                    $('.piase-busqueda-tab').on('keyup change', function() {
                        filtrarTabPIASE($(this).data('target-tab'), $(this).val());
                    });

                    $('.piase-limpiar-busqueda').on('click', function() {
                        var tabId = $(this).data('target-tab');
                        $('#buscador-' + tabId).val('');
                        filtrarTabPIASE(tabId, '');
                        $('#buscador-' + tabId).focus();
                    });

                    $('.piase-busqueda-tab').each(function() {
                        filtrarTabPIASE($(this).data('target-tab'), $(this).val());
                    });
                });

                function normalizarTextoPIASE(texto) {
                    texto = (texto || '').toString().toLowerCase();
                    if (texto.normalize) {
                        texto = texto.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
                    }
                    return $.trim(texto);
                }

                function filtrarTablaPIASE(tab, texto) {
                    var visibles = 0;
                    tab.find('table').each(function() {
                        var table = $(this);
                        var rows = table.find('tbody > tr');
                        if (!rows.length) { return; }

                        var filasAgrupadas = rows.filter('[data-piase-group]');
                        if (filasAgrupadas.length > 0) {
                            var gruposPorId = {};
                            rows.each(function() {
                                var row = $(this);
                                if (row.find('td[colspan]').length) {
                                    row.toggle(texto === '');
                                    return;
                                }
                                var grupoId = row.data('piase-group') || ('row-' + row.index());
                                if (!gruposPorId[grupoId]) {
                                    gruposPorId[grupoId] = [];
                                }
                                gruposPorId[grupoId].push(row);
                            });
                            $.each(gruposPorId, function(grupoId, grupo) {
                                var textoGrupo = '';
                                $.each(grupo, function(j, row) { textoGrupo += ' ' + row.text(); });
                                var coincide = texto === '' || normalizarTextoPIASE(textoGrupo).indexOf(texto) !== -1;
                                $.each(grupo, function(j, row) { row.toggle(coincide); });
                                if (coincide) { visibles++; }
                            });
                            return;
                        }

                        var tieneRowspan = rows.find('td[rowspan]').length > 0;
                        if (!tieneRowspan) {
                            rows.each(function() {
                                var row = $(this);
                                if (row.find('td[colspan]').length) {
                                    row.toggle(texto === '');
                                    return;
                                }
                                var coincide = texto === '' || normalizarTextoPIASE(row.text()).indexOf(texto) !== -1;
                                row.toggle(coincide);
                                if (coincide) { visibles++; }
                            });
                            return;
                        }

                        var grupos = [];
                        var actual = null;
                        rows.each(function() {
                            var row = $(this);
                            if (row.find('td[colspan]').length) {
                                row.toggle(texto === '');
                                return;
                            }
                            if (actual === null || row.find('td[rowspan]').length > 0) {
                                actual = [];
                                grupos.push(actual);
                            }
                            actual.push(row);
                        });

                        $.each(grupos, function(i, grupo) {
                            var textoGrupo = '';
                            $.each(grupo, function(j, row) { textoGrupo += ' ' + row.text(); });
                            var coincide = texto === '' || normalizarTextoPIASE(textoGrupo).indexOf(texto) !== -1;
                            $.each(grupo, function(j, row) { row.toggle(coincide); });
                            if (coincide) { visibles++; }
                        });
                    });
                    return visibles;
                }

                function filtrarPanelesPIASE(tab, texto) {
                    var paneles = tab.find('.piase-student-panel, .piase-canalizado-panel');
                    if (!paneles.length) { return null; }
                    var visibles = 0;
                    paneles.each(function() {
                        var panel = $(this);
                        var base = (panel.data('search') || '').toString();
                        var textoPanel = normalizarTextoPIASE(base + ' ' + panel.text());
                        var coincide = texto === '' || textoPanel.indexOf(texto) !== -1;
                        panel.toggle(coincide);
                        if (coincide) { visibles++; }
                    });
                    tab.find('.piase-career-panel').each(function() {
                        var carrera = $(this);
                        var visiblesCarrera = carrera.find('.piase-student-panel:visible').length;
                        carrera.toggle(texto === '' || visiblesCarrera > 0);
                    });
                    return visibles;
                }

                function filtrarTabPIASE(tabId, valor) {
                    var tab = $('#' + tabId);
                    if (!tab.length) { return; }
                    var texto = normalizarTextoPIASE(valor);
                    var visiblesPaneles = filtrarPanelesPIASE(tab, texto);
                    var visibles = visiblesPaneles !== null ? visiblesPaneles : filtrarTablaPIASE(tab, texto);

                    var etiqueta = 'registro(s) encontrado(s)';
                    if (tabId === 'tab-estudiantes' || tabId === 'tab-canalizados' || tabId === 'tab-cerrados') {
                        etiqueta = 'estudiante(s) encontrado(s)';
                    } else if (tabId === 'tab-citas') {
                        etiqueta = 'estudiante(s) con cita encontrado(s)';
                    } else if (tabId === 'tab-actividades') {
                        etiqueta = 'estudiante(s) con actividad encontrado(s)';
                    }

                    $('.piase-contador-tab[data-target-tab="' + tabId + '"]').text(visibles + ' ' + etiqueta);
                    var sinResultados = $('.piase-sin-resultados-tab[data-target-tab="' + tabId + '"]');
                    if (texto !== '' && visibles === 0) { sinResultados.show(); } else { sinResultados.hide(); }
                }

                function nombreDia(dia) {
                    var nombres = {1:'Lunes',2:'Martes',3:'Miércoles',4:'Jueves',5:'Viernes',6:'Sábado',7:'Domingo'};
                    return nombres[dia] || 'Día ' + dia;
                }

                function fechaADiaSemana(fecha) {
                    if (!fecha) { return null; }
                    var partes = fecha.split('-');
                    if (partes.length !== 3) { return null; }
                    var d = new Date(parseInt(partes[0],10), parseInt(partes[1],10)-1, parseInt(partes[2],10));
                    if (isNaN(d.getTime())) { return null; }
                    var dia = d.getDay();
                    return dia === 0 ? 7 : dia;
                }

                function fechaDentroPeriodo(fecha) {
                    if (!fecha) { return false; }
                    if (!periodoRangoPIASE || !periodoRangoPIASE.inicio || !periodoRangoPIASE.fin) { return true; }
                    return fecha >= periodoRangoPIASE.inicio && fecha <= periodoRangoPIASE.fin;
                }

                function rangoPeriodoTexto() {
                    if (!periodoRangoPIASE || !periodoRangoPIASE.inicio || !periodoRangoPIASE.fin) {
                        return 'El periodo no tiene rango de fechas configurado.';
                    }
                    return 'Rango permitido: ' + periodoRangoPIASE.inicio + ' a ' + periodoRangoPIASE.fin + '.';
                }

                function horaAMinutos(hora) {
                    if (!hora) { return 0; }
                    var partes = hora.split(':');
                    return (parseInt(partes[0], 10) * 60) + parseInt(partes[1], 10);
                }

                function minutosAHora(minutos) {
                    var h = Math.floor(minutos / 60);
                    var m = minutos % 60;
                    var hh = h < 10 ? '0' + h : '' + h;
                    var mm = m < 10 ? '0' + m : '' + m;
                    return hh + ':' + mm + ':00';
                }

                function horaCorta(hora) {
                    if (!hora) { return ''; }
                    return String(hora).substring(0, 5);
                }

                function normalizarHoraJS(hora) {
                    if (!hora) { return ''; }
                    var texto = String(hora);
                    if (texto.length >= 5) {
                        return texto.substring(0, 5) + ':00';
                    }
                    return texto;
                }

                function horariosPorArea(areaId) {
                    return horariosPIASE.filter(function(h) {
                        return parseInt(h.id_area_atencion) === parseInt(areaId);
                    });
                }

                function responsablesUnicos(areaId) {
                    var lista = horariosPorArea(areaId);
                    var mapa = {};
                    var salida = [];
                    lista.forEach(function(h) {
                        if (!mapa[h.id_area_responsable_periodo]) {
                            mapa[h.id_area_responsable_periodo] = true;
                            salida.push(h);
                        }
                    });
                    return salida;
                }

                function horariosPorResponsable(areaId, responsablePeriodoId) {
                    return horariosPIASE.filter(function(h) {
                        return parseInt(h.id_area_atencion) === parseInt(areaId)
                            && parseInt(h.id_area_responsable_periodo) === parseInt(responsablePeriodoId);
                    });
                }

                function diasDisponiblesArray(areaId, responsablePeriodoId) {
                    var mapa = {};
                    horariosPorResponsable(areaId, responsablePeriodoId).forEach(function(h) {
                        mapa[parseInt(h.dia_semana)] = true;
                    });
                    return Object.keys(mapa).map(function(d) { return parseInt(d); }).sort(function(a,b){ return a-b; });
                }

                function diasDisponiblesTexto(areaId, responsablePeriodoId) {
                    var dias = diasDisponiblesArray(areaId, responsablePeriodoId);
                    if (dias.length === 0) { return 'El responsable no tiene horarios activos.'; }
                    return 'Días disponibles: ' + dias.map(nombreDia).join(', ');
                }

                function pintarDiasPermitidos(prefijo, areaId, responsablePeriodoId) {
                    var lista = $('#' + prefijo + '_dias_lista');
                    var ayuda = $('#' + prefijo + '_dias_disponibles');
                    var fecha = $('#' + prefijo + '_fecha');

                    if (!areaId || !responsablePeriodoId) {
                        lista.attr('class', 'piase-dia-pendiente').html('Selecciona área y responsable para ver los días permitidos.');
                        ayuda.text('Selecciona responsable para conocer días disponibles.');
                        fecha.prop('disabled', true).val('');
                        return;
                    }

                    var dias = diasDisponiblesArray(areaId, responsablePeriodoId);
                    if (dias.length === 0) {
                        lista.attr('class', 'text-danger').html('El responsable seleccionado no tiene días de atención activos en este periodo.');
                        ayuda.text('No hay días disponibles para este responsable.');
                        fecha.prop('disabled', true).val('');
                        return;
                    }

                    var html = dias.map(function(dia) {
                        return '<span class="piase-dia-badge">' + nombreDia(dia) + '</span>';
                    }).join(' ');

                    lista.attr('class', '').html(html);
                    ayuda.text('Solo puedes elegir fechas que caigan en: ' + dias.map(nombreDia).join(', ') + '. ' + rangoPeriodoTexto());
                    fecha.prop('disabled', false);
                }

                function llenarResponsables(prefijo, areaId) {
                    var select = $('#' + prefijo + '_responsable');
                    select.html('<option value="">Selecciona...</option>');
                    responsablesUnicos(areaId).forEach(function(h) {
                        select.append('<option value="' + h.id_area_responsable_periodo + '">' + h.responsable + '</option>');
                    });
                    pintarDiasPermitidos(prefijo, areaId, '');
                }

                function limpiarSlot(prefijo) {
                    $('#' + prefijo + '_hora_inicio_slot').val('');
                    $('#' + prefijo + '_hora_fin_slot').val('');
                }

                function claveOcupacion(idHorario, fecha) {
                    return idHorario + '|' + fecha;
                }

                function llenarHorarios(prefijo, areaId, responsablePeriodoId) {
                    var select = $('#' + prefijo + '_horario');
                    var fecha = $('#' + prefijo + '_fecha').val();
                    var warning = $('#' + prefijo + '_warning');
                    limpiarSlot(prefijo);
                    warning.hide().text('');
                    select.html('<option value="">Selecciona...</option>');

                    if (!areaId || !responsablePeriodoId) {
                        pintarDiasPermitidos(prefijo, areaId, responsablePeriodoId);
                        select.html('<option value="">Selecciona responsable primero</option>');
                        return;
                    }

                    pintarDiasPermitidos(prefijo, areaId, responsablePeriodoId);

                    if (!fecha) {
                        select.html('<option value="">Selecciona día de atención</option>');
                        return;
                    }

                    if (!fechaDentroPeriodo(fecha)) {
                        $('#' + prefijo + '_fecha').val('');
                        select.html('<option value="">Selecciona una fecha dentro del periodo</option>');
                        warning.text('La fecha seleccionada está fuera del periodo académico. ' + rangoPeriodoTexto()).show();
                        return;
                    }

                    var diaFecha = fechaADiaSemana(fecha);
                    var horarios = horariosPorResponsable(areaId, responsablePeriodoId).filter(function(h) {
                        return parseInt(h.dia_semana) === parseInt(diaFecha);
                    });

                    if (horarios.length === 0) {
                        $('#' + prefijo + '_fecha').val('');
                        select.html('<option value="">Selecciona una fecha válida</option>');
                        warning.text('La fecha seleccionada no corresponde a los días de atención del responsable.').show();
                        return;
                    }

                    var agregados = 0;
                    horarios.forEach(function(h) {
                        var hi = normalizarHoraJS(h.hora_inicio);
                        var hf = normalizarHoraJS(h.hora_fin);
                        var key = claveOcupacion(h.id_area_responsable_horario, fecha);
                        var ocupados = ocupacionPIASE[key] ? parseInt(ocupacionPIASE[key], 10) : 0;

                        if (ocupados <= 0) {
                            var texto = nombreDia(parseInt(h.dia_semana)) + ' | ' + horaCorta(hi) + ' - ' + horaCorta(hf);
                            if (h.lugar) { texto += ' | ' + h.lugar; }
                            select.append('<option value="' + h.id_area_responsable_horario + '" data-inicio="' + hi + '" data-fin="' + hf + '">' + texto + '</option>');
                            agregados++;
                        }
                    });

                    if (agregados === 0) {
                        warning.text('No hay horarios disponibles para el día seleccionado. Los horarios ocupados no se muestran.').show();
                    }
                }

                function seleccionarSlot(prefijo) {
                    var option = $('#' + prefijo + '_horario option:selected');
                    $('#' + prefijo + '_hora_inicio_slot').val(option.data('inicio') || '');
                    $('#' + prefijo + '_hora_fin_slot').val(option.data('fin') || '');
                }

                function actualizarResponsables(prefijo) {
                    var areaId = $('#' + prefijo + '_area').val();
                    llenarResponsables(prefijo, areaId);
                    $('#' + prefijo + '_horario').html('<option value="">Selecciona responsable y día</option>');
                    $('#' + prefijo + '_fecha').val('').prop('disabled', true);
                    limpiarSlot(prefijo);
                }

                function actualizarHorarios(prefijo) {
                    var areaId = $('#' + prefijo + '_area').val();
                    var responsablePeriodoId = $('#' + prefijo + '_responsable').val();
                    llenarHorarios(prefijo, areaId, responsablePeriodoId);
                }
                var timerBusquedaEstudiantePIASE = null;

                function escapeHtmlPIASE(valor) {
                    if (valor === null || valor === undefined) { return ''; }
                    return String(valor)
                        .replace(/&/g, '&amp;')
                        .replace(/</g, '&lt;')
                        .replace(/>/g, '&gt;')
                        .replace(/"/g, '&quot;')
                        .replace(/'/g, '&#039;');
                }

                window.piaseCitasBusqueda = {};

                function resumenFechasAsignadasPIASE(citas) {
                    if (!citas || citas.length === 0) {
                        return '<strong>Fechas asignadas:</strong><br><span class="text-muted">Sin fechas asignadas para este estudiante en el periodo seleccionado.</span>';
                    }

                    var html = '<strong>Fechas asignadas:</strong><ul>';
                    $.each(citas, function(i, cita) {
                        html += '<li>' +
                            escapeHtmlPIASE(cita.fecha_texto || cita.fecha || 'Sin fecha') + ' · ' +
                            escapeHtmlPIASE(cita.hora_inicio || '') + ' - ' + escapeHtmlPIASE(cita.hora_fin || '') +
                            ' · ' + escapeHtmlPIASE(cita.area_destino || 'Sin área') +
                            ' · ' + escapeHtmlPIASE(cita.responsable_destino || 'Sin responsable') +
                            ' <span class="label label-info">' + escapeHtmlPIASE(cita.estado || '') + '</span>' +
                            '</li>';
                    });
                    html += '</ul>';
                    return html;
                }

                function pintarFechasAsignadasPIASE(contenedor, citas) {
                    var html = resumenFechasAsignadasPIASE(citas);
                    $(contenedor).html(html).show();
                }

                function limpiarBusquedaEstudiantePIASE() {
                    $('#resultado_estudiante_piase').hide().html('');
                    $('#estudiante_seleccionado_piase').text('Selecciona un estudiante de la lista para iniciar la canalización.');
                    $('#fechas_asignadas_estudiante_piase').hide().html('');
                }

                $('#buscar_estudiante_piase').on('keyup', function() {
                    var input = $(this);
                    var term = $.trim(input.val());
                    var contenedor = $('#resultado_estudiante_piase');
                    $('#estudiante_seleccionado_piase').text('Selecciona un estudiante de la lista para iniciar la canalización.');
                    $('#fechas_asignadas_estudiante_piase').hide().html('');

                    if (timerBusquedaEstudiantePIASE) {
                        clearTimeout(timerBusquedaEstudiantePIASE);
                    }

                    if (term.length < 2) {
                        contenedor.hide().html('');
                        return;
                    }

                    contenedor.html('<a href="#" class="text-muted">Buscando estudiantes...</a>').show();

                    timerBusquedaEstudiantePIASE = setTimeout(function() {
                        $.get('{{ route('piase.estudiantes.buscar') }}', {
                            term: term,
                            id_periodo: '{{ $filtros['id_periodo'] }}',
                            id_carrera: '{{ $filtroIdCarreraValor }}'
                        }, function(response) {
                            var html = '';
                            if (!response.items || response.items.length === 0) {
                                html = '<a href="#" class="text-muted">Sin resultados en el periodo seleccionado.</a>';
                            } else {
                                $.each(response.items, function(i, item) {
                                    var estado = item.estado_caso ? item.estado_caso : 'Sin caso';
                                    var bloqueado = item.bloqueado ? 1 : 0;
                                    var claseEstado = bloqueado ? 'label label-success' : 'label label-info';
                                    var citasAsignadas = item.citas_asignadas || [];
                                    window.piaseCitasBusqueda[item.id_alumno] = citasAsignadas;
                                    html += '<a href="#" class="seleccionar-estudiante-piase" ' +
                                        'data-id-periodo="' + escapeHtmlPIASE(item.id_periodo) + '" ' +
                                        'data-id-alumno="' + escapeHtmlPIASE(item.id_alumno) + '" ' +
                                        'data-id-carrera="' + escapeHtmlPIASE(item.id_carrera) + '" ' +
                                        'data-alumno="' + escapeHtmlPIASE(item.alumno) + '" ' +
                                        'data-cuenta="' + escapeHtmlPIASE(item.cuenta) + '" ' +
                                        'data-carrera="' + escapeHtmlPIASE(item.carrera) + '" ' +
                                        'data-semestre="' + escapeHtmlPIASE(item.semestre) + '" ' +
                                        'data-asignaturas="' + escapeHtmlPIASE(item.asignaturas) + '" ' +
                                        'data-estado="' + escapeHtmlPIASE(estado) + '" ' +
                                        'data-bloqueado="' + bloqueado + '">' +
                                        '<strong>' + escapeHtmlPIASE(item.alumno) + '</strong><br>' +
                                        '<small>Cuenta: ' + escapeHtmlPIASE(item.cuenta) +
                                        ' | Carrera: ' + escapeHtmlPIASE(item.carrera) +
                                        ' | Semestre: ' + escapeHtmlPIASE(item.semestre) + '</small><br>' +
                                        '<small><strong>Asignaturas:</strong> ' + escapeHtmlPIASE(item.asignaturas) + '</small><br>' +
                                        '<span class="' + claseEstado + '">' + escapeHtmlPIASE(estado) + '</span>';
                                    if (citasAsignadas.length > 0) {
                                        html += '<br><small><strong>Fechas asignadas:</strong> ' + citasAsignadas.length + ' cita(s)</small>';
                                    } else {
                                        html += '<br><small><strong>Fechas asignadas:</strong> sin fechas registradas</small>';
                                    }
                                    html += '</a>';
                                });
                            }
                            contenedor.html(html).show();
                        }).fail(function(xhr) {
                            var msg = 'No se pudo realizar la búsqueda.';
                            if (xhr.responseJSON && xhr.responseJSON.mensaje) {
                                msg = xhr.responseJSON.mensaje;
                            }
                            contenedor.html('<a href="#" class="text-danger">' + escapeHtmlPIASE(msg) + '</a>').show();
                        });
                    }, 250);
                });

                $(document).on('click', '.seleccionar-estudiante-piase', function(e) {
                    e.preventDefault();
                    var item = $(this);
                    var alumno = item.data('alumno');
                    var cuenta = item.data('cuenta');
                    var carrera = item.data('carrera');
                    var semestre = item.data('semestre');
                    var asignaturas = item.data('asignaturas');
                    var estado = item.data('estado');
                    var bloqueado = parseInt(item.data('bloqueado'), 10) === 1;
                    var citasAsignadas = window.piaseCitasBusqueda[item.data('id-alumno')] || [];

                    $('#buscar_estudiante_piase').val(alumno);
                    $('#resultado_estudiante_piase').hide().html('');
                    $('#estudiante_seleccionado_piase').html(
                        '<strong>Seleccionado:</strong> ' + escapeHtmlPIASE(alumno) +
                        '<br><span class="text-muted">Cuenta: ' + escapeHtmlPIASE(cuenta) +
                        ' | Carrera: ' + escapeHtmlPIASE(carrera) +
                        ' | Semestre: ' + escapeHtmlPIASE(semestre) +
                        ' | Estado: ' + escapeHtmlPIASE(estado) + '</span>' +
                        '<br><span class="text-muted"><strong>Asignaturas:</strong> ' + escapeHtmlPIASE(asignaturas) + '</span>'
                    );
                    pintarFechasAsignadasPIASE('#fechas_asignadas_estudiante_piase', citasAsignadas);

                    if (bloqueado) {
                        alert('El estudiante tiene el caso cerrado. Revisa Casos cerrados antes de abrir una nueva atención.');
                        return;
                    }

                    abrirModalNuevoCanalizarDatos(
                        item.data('id-periodo'),
                        item.data('id-alumno'),
                        item.data('id-carrera'),
                        alumno,
                        citasAsignadas
                    );
                });

                $(document).on('click', function(e) {
                    if (!$(e.target).closest('.piase-search-box').length) {
                        $('#resultado_estudiante_piase').hide();
                    }
                });

                function abrirModalNuevoCanalizarDatos(idPeriodo, idAlumno, idCarrera, alumno, citasAsignadas) {
                    fijarRetornoPIASE('tab-estudiantes', 'estudiante-' + idAlumno);
                    $('#nuevo_id_periodo').val(idPeriodo);
                    $('#nuevo_id_alumno').val(idAlumno);
                    $('#nuevo_id_carrera').val(idCarrera);
                    $('#nuevo_id_caso').val('');
                    $('#nuevo_id_canalizacion').val('');
                    $('#nuevo_alumno').text(alumno);
                    pintarFechasAsignadasPIASE('#nuevo_fechas_previas_box', citasAsignadas || []);
                    prepararCapturaCitasPIASE('nuevo', $('#formNuevoCanalizar').data('url-primera'));
                    $('#nuevo_area').val('');
                    $('#nuevo_responsable').html('<option value="">Selecciona un área primero</option>');
                    $('#nuevo_horario').html('<option value="">Selecciona responsable y día</option>');
                    $('#nuevo_fecha').val('').prop('disabled', true);
                    $('#nuevo_warning').hide().text('');
                    $('#nuevo_dias_disponibles').text('Selecciona área y responsable para conocer días disponibles.');
                    $('#nuevo_dias_lista').attr('class', 'piase-dia-pendiente').html('Selecciona área y responsable para ver los días permitidos.');
                    limpiarSlot('nuevo');
                    $('#modalNuevoCanalizar').modal('show');
                }

                function abrirModalNuevoCanalizar(btn) {
                    abrirModalNuevoCanalizarDatos(
                        $(btn).data('id-periodo'),
                        $(btn).data('id-alumno'),
                        $(btn).data('id-carrera'),
                        $(btn).data('alumno')
                    );
                }

                function abrirModalCanalizar(btn) {
                    fijarRetornoPIASE(obtenerTabActivaPIASE(), 'caso-' + $(btn).data('id-caso'));
                    $('#canalizar_id_periodo').val($(btn).data('id-periodo'));
                    $('#canalizar_id_caso').val($(btn).data('id-caso'));
                    $('#canalizar_id_canalizacion').val('');
                    $('#canalizar_alumno').text($(btn).data('alumno'));
                    prepararCapturaCitasPIASE('canalizar', $('#formCanalizar').data('url-primera'));
                    $('#canalizar_area').val('');
                    $('#canalizar_responsable').html('<option value="">Selecciona un área primero</option>');
                    $('#canalizar_horario').html('<option value="">Selecciona responsable y día</option>');
                    $('#canalizar_fecha').val('').prop('disabled', true);
                    $('#canalizar_warning').hide().text('');
                    $('#canalizar_dias_disponibles').text('Selecciona área y responsable para conocer días disponibles.');
                    $('#canalizar_dias_lista').attr('class', 'piase-dia-pendiente').html('Selecciona área y responsable para ver los días permitidos.');
                    limpiarSlot('canalizar');
                    $('#modalCanalizar').modal('show');
                }

                function abrirModalSesion(btn) {
                    fijarRetornoPIASE(obtenerTabActivaPIASE(), 'caso-' + $(btn).data('id-caso'));
                    $('#sesion_id_periodo').val($(btn).data('id-periodo'));
                    $('#sesion_id_caso').val($(btn).data('id-caso'));
                    $('#sesion_id_canalizacion').val($(btn).data('id-canalizacion'));
                    $('#sesion_alumno').text($(btn).data('alumno'));
                    $('#sesion_area').val($(btn).data('id-area') || '');
                    $('#sesion_fecha').val('').prop('disabled', true);
                    $('#sesion_warning').hide().text('');
                    $('#sesion_dias_disponibles').text('Selecciona área y responsable para conocer días disponibles.');
                    $('#sesion_dias_lista').attr('class', 'piase-dia-pendiente').html('Selecciona área y responsable para ver los días permitidos.');
                    llenarResponsables('sesion', $('#sesion_area').val());
                    $('#sesion_horario').html('<option value="">Selecciona responsable y día</option>');
                    limpiarSlot('sesion');
                    $('#modalSesion').modal('show');
                }

                function toggleCanalizacionFinal() {
                    var requiere = $('input[name="requiere_canalizacion_final"]:checked').val() === 'si';
                    $('#cerrar_canalizacion_final_box').toggle(requiere);
                    $('#cerrar_area_final').prop('required', requiere);
                    $('#cerrar_motivo_final').prop('required', requiere);
                    if (!requiere) {
                        $('#cerrar_area_final').val('');
                        $('#cerrar_motivo_final').val('');
                    }
                }

                function abrirModalCerrar(btn) {
                    fijarRetornoPIASE(obtenerTabActivaPIASE(), 'caso-' + $(btn).data('id-caso'));
                    $('#cerrar_id_periodo').val($(btn).data('id-periodo'));
                    $('#cerrar_id_caso').val($(btn).data('id-caso'));
                    $('#cerrar_alumno').text($(btn).data('alumno'));
                    $('#cerrar_resultado_cierre').val('');
                    $('input[name="requiere_canalizacion_final"][value="no"]').prop('checked', true);
                    toggleCanalizacionFinal();
                    $('#modalCerrar').modal('show');
                }


                function prepararCapturaCitasPIASE(prefijo, urlPrimera) {
                    var form = prefijo === 'nuevo' ? $('#formNuevoCanalizar') : $('#formCanalizar');
                    form.attr('action', urlPrimera);
                    form.data('piase-guardado', 0);
                    form.data('piase-focus-caso', '');
                    $('#' + prefijo + '_ajax_ok').hide().text('');
                    $('#' + prefijo + '_ajax_error').hide().text('');
                    $('#' + prefijo + '_citas_lista').html('');
                    $('#' + prefijo + '_citas_box').hide();
                    $('#' + prefijo + '_btn_guardar').prop('disabled', false).text('Guardar canalización');
                    if (prefijo === 'nuevo') {
                        $('#nuevo_id_caso').val('');
                        $('#nuevo_id_canalizacion').val('');
                    } else {
                        $('#canalizar_id_canalizacion').val('');
                    }
                }

                function obtenerResumenCitaPIASE(prefijo) {
                    var fecha = $('#' + prefijo + '_fecha').val();
                    var horario = $('#' + prefijo + '_horario option:selected').text() || '';
                    var responsable = $('#' + prefijo + '_responsable option:selected').text() || '';
                    var area = $('#' + prefijo + '_area option:selected').text() || '';
                    return {
                        fecha: fecha,
                        horario: $.trim(horario),
                        responsable: $.trim(responsable),
                        area: $.trim(area)
                    };
                }

                function registrarOcupacionCitaPIASE(cita) {
                    if (!cita || !cita.id_area_responsable_horario || !cita.fecha) { return; }
                    var key = claveOcupacion(cita.id_area_responsable_horario, cita.fecha);
                    ocupacionPIASE[key] = 1;
                }

                function agregarCitaResumenModalPIASE(prefijo, cita, resumen) {
                    resumen = resumen || {};
                    var numero = cita && cita.numero_sesion ? cita.numero_sesion : ($('#' + prefijo + '_citas_lista li').length + 1);
                    var fecha = cita && cita.fecha ? cita.fecha : (resumen.fecha || '');
                    var inicio = cita && cita.hora_inicio ? horaCorta(cita.hora_inicio) : '';
                    var fin = cita && cita.hora_fin ? horaCorta(cita.hora_fin) : '';
                    var responsable = resumen.responsable || '';
                    var area = resumen.area || '';
                    var horario = resumen.horario || '';

                    var texto = '<li><strong>Sesión ' + escapeHtmlPIASE(numero) + ':</strong> ' + escapeHtmlPIASE(fecha);
                    if (inicio || fin) {
                        texto += ' | ' + escapeHtmlPIASE(inicio) + ' - ' + escapeHtmlPIASE(fin);
                    } else if (horario) {
                        texto += ' | ' + escapeHtmlPIASE(horario);
                    }
                    if (area) { texto += ' | ' + escapeHtmlPIASE(area); }
                    if (responsable && responsable !== 'Selecciona...') { texto += ' | ' + escapeHtmlPIASE(responsable); }
                    texto += '</li>';

                    $('#' + prefijo + '_citas_lista').append(texto);
                    $('#' + prefijo + '_citas_box').show();
                }

                function limpiarCapturaFechaHorarioPIASE(prefijo) {
                    $('#' + prefijo + '_fecha').val('');
                    $('#' + prefijo + '_horario').html('<option value="">Selecciona día de atención</option>');
                    $('#' + prefijo + '_warning').hide().text('');
                    limpiarSlot(prefijo);
                }

                function enviarCapturaCitaAjaxPIASE(form, prefijo) {
                    if (!validarFormularioSlot(prefijo)) { return false; }

                    var resumen = obtenerResumenCitaPIASE(prefijo);
                    var boton = $('#' + prefijo + '_btn_guardar');
                    var urlSesion = form.data('url-sesion');
                    $('#' + prefijo + '_ajax_ok').hide().text('');
                    $('#' + prefijo + '_ajax_error').hide().text('');
                    boton.prop('disabled', true).text('Guardando...');

                    $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: form.serialize(),
                        dataType: 'json',
                        headers: {'X-Requested-With': 'XMLHttpRequest'},
                        success: function(response) {
                            if (!response || !response.ok) {
                                $('#' + prefijo + '_ajax_error').text((response && response.mensaje) ? response.mensaje : 'No se pudo guardar la cita.').show();
                                boton.prop('disabled', false).text('Guardar canalización');
                                return;
                            }

                            if (response.id_ar_caso) {
                                $('#' + prefijo + '_id_caso').val(response.id_ar_caso);
                                form.data('piase-focus-caso', 'caso-' + response.id_ar_caso);
                            }
                            if (response.id_ar_caso_canalizacion) {
                                $('#' + prefijo + '_id_canalizacion').val(response.id_ar_caso_canalizacion);
                            }
                            form.data('piase-guardado', 1);

                            form.attr('action', urlSesion);
                            registrarOcupacionCitaPIASE(response.cita);
                            agregarCitaResumenModalPIASE(prefijo, response.cita, resumen);
                            limpiarCapturaFechaHorarioPIASE(prefijo);
                            $('#' + prefijo + '_ajax_ok').text(response.mensaje || 'Cita registrada correctamente. Puedes agregar otra fecha o cerrar citas.').show();
                            boton.prop('disabled', false).text('Guardar otra cita');
                        },
                        error: function(xhr) {
                            var msg = 'No se pudo guardar la cita.';
                            if (xhr.responseJSON && xhr.responseJSON.mensaje) {
                                msg = xhr.responseJSON.mensaje;
                            } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                                var errores = [];
                                $.each(xhr.responseJSON.errors, function(k, arr) {
                                    if ($.isArray(arr)) { errores = errores.concat(arr); }
                                });
                                if (errores.length > 0) { msg = errores.join(' '); }
                            }
                            $('#' + prefijo + '_ajax_error').text(msg).show();
                            boton.prop('disabled', false).text(form.attr('action') === urlSesion ? 'Guardar otra cita' : 'Guardar canalización');
                        }
                    });

                    return false;
                }

                function validarFormularioSlot(prefijo) {
                    if (!$('#' + prefijo + '_hora_inicio_slot').val() || !$('#' + prefijo + '_hora_fin_slot').val()) {
                        $('#' + prefijo + '_warning').text('Selecciona un horario disponible.').show();
                        return false;
                    }
                    return true;
                }


                $('#modalNuevoCanalizar, #modalCanalizar').on('hidden.bs.modal', function() {
                    var prefijo = this.id === 'modalNuevoCanalizar' ? 'nuevo' : 'canalizar';
                    var form = prefijo === 'nuevo' ? $('#formNuevoCanalizar') : $('#formCanalizar');
                    if (parseInt(form.data('piase-guardado') || 0, 10) !== 1) {
                        return;
                    }

                    var focus = form.data('piase-focus-caso') || $('#' + prefijo + '_id_caso').val();
                    if (focus && String(focus).indexOf('caso-') !== 0) {
                        focus = 'caso-' + focus;
                    }

                    var url = new URL(window.location.href);
                    url.searchParams.set('tab', 'tab-canalizados');
                    url.searchParams.set('active_tab', 'tab-canalizados');
                    if (focus) {
                        url.searchParams.set('focus', focus);
                    }
                    window.location.href = url.toString() + '#tab-canalizados';
                });

                $('#formNuevoCanalizar').on('submit', function(e) {
                    e.preventDefault();
                    enviarCapturaCitaAjaxPIASE($(this), 'nuevo');
                });

                $('#formCanalizar').on('submit', function(e) {
                    e.preventDefault();
                    enviarCapturaCitaAjaxPIASE($(this), 'canalizar');
                });

                $('#formSesion').on('submit', function(e) {
                    if (!validarFormularioSlot('sesion')) { e.preventDefault(); }
                });

                function abrirModalEditarSesion(btn) {
                    var tabActual = ($(btn).attr('data-return-tab') || $(btn).data('return-tab') || obtenerTabActivaPIASE() || 'tab-citas') + '';
                    if (tabActual !== 'tab-citas' && tabActual !== 'tab-canalizados') {
                        tabActual = 'tab-citas';
                    }
                    $('#formEditarSesion').attr('data-piase-tab-forzar', tabActual);
                    fijarRetornoPIASE(tabActual, 'cita-' + $(btn).data('id-cita'));
                    $('#edit_sesion_id_periodo').val($(btn).data('id-periodo'));
                    $('#edit_sesion_id_cita').val($(btn).data('id-cita'));
                    $('#edit_sesion_alumno').text($(btn).data('alumno'));
                    $('#edit_sesion_fecha').val($(btn).data('fecha'));
                    var estadoActual = (($(btn).attr('data-estado') || $(btn).data('estado') || 'programada') + '').trim().toLowerCase().replace(' ', '_');
                    if (estadoActual === 'programado') { estadoActual = 'programada'; }
                    if (estadoActual === 'atendido') { estadoActual = 'atendida'; }
                    if (estadoActual === 'cancelado') { estadoActual = 'cancelada'; }
                    if (estadoActual !== 'programada' && estadoActual !== 'en_atencion' && estadoActual !== 'atendida' && estadoActual !== 'cancelada') { estadoActual = 'programada'; }
                    $('#edit_sesion_estado').val(estadoActual);
                    $('#edit_sesion_estado_hidden').val(estadoActual);
                    $('#edit_sesion_lugar').val($(btn).data('lugar'));
                    $('#edit_sesion_observaciones').val($(btn).data('observaciones'));
                    $('#edit_sesion_horario').val($(btn).data('horario')).trigger('change');
                    $('#modalEditarSesion').modal('show');
                    setTimeout(function(){ $('#edit_sesion_estado').val(estadoActual); $('#edit_sesion_estado_hidden').val(estadoActual); }, 150);
                }

                $('#edit_sesion_horario').on('change', function() {
                    var opt = $(this).find('option:selected');
                    $('#edit_sesion_hora_inicio_slot').val(opt.data('inicio') || '');
                    $('#edit_sesion_hora_fin_slot').val(opt.data('fin') || '');
                });

                $('#edit_sesion_estado').on('change', function() {
                    $('#edit_sesion_estado_hidden').val($(this).val());
                });

                $('#formEditarSesion').on('submit', function() {
                    var estadoElegido = $('#edit_sesion_estado').val() || 'programada';
                    $('#edit_sesion_estado_hidden').val(estadoElegido);
                    var tabForzada = $(this).attr('data-piase-tab-forzar') || 'tab-citas';
                    fijarRetornoPIASE(tabForzada, 'cita-' + $('#edit_sesion_id_cita').val());
                    $(this).find('input[name="tab"], input[name="active_tab"]').val(tabForzada);
                    $(this).find('input[name="focus"], input[name="active_focus"]').val('cita-' + $('#edit_sesion_id_cita').val());
                });

                function abrirModalActividad(btn) {
                    var tabRetornoActividad = ($(btn).attr('data-return-tab') || $(btn).data('return-tab') || obtenerTabActivaPIASE() || 'tab-citas') + '';
                    if (tabRetornoActividad !== 'tab-citas' && tabRetornoActividad !== 'tab-canalizados') { tabRetornoActividad = 'tab-citas'; }
                    $('#formActividad').attr('data-piase-tab-forzar', tabRetornoActividad);
                    fijarRetornoPIASE(tabRetornoActividad, 'cita-' + $(btn).data('id-cita'));
                    $('#actividad_id_periodo').val($(btn).data('id-periodo'));
                    $('#actividad_id_cita').val($(btn).data('id-cita'));
                    $('#actividad_alumno').text($(btn).data('alumno'));
                    $('#modalActividad').modal('show');
                }

                function abrirModalEditarActividad(btn) {
                    fijarRetornoPIASE('tab-actividades', 'actividad-' + $(btn).data('id-actividad'));
                    $('#edit_actividad_id_periodo').val($(btn).data('id-periodo'));
                    $('#edit_actividad_id').val($(btn).data('id-actividad'));
                    $('#edit_actividad_catalogo').val($(btn).data('id-catalogo'));
                    $('#edit_actividad_fecha_limite').val($(btn).data('fecha-limite'));
                    $('#edit_actividad_descripcion').val($(btn).data('descripcion'));
                    $('#edit_actividad_estado').val($(btn).data('estado'));
                    $('#modalEditarActividad').modal('show');
                }

                function estrellasTextoPIASE(valor) {
                    valor = parseInt(valor, 10) || 0;
                    var texto = '';
                    for (var i = 1; i <= 5; i++) {
                        texto += (i <= valor) ? '★' : '☆';
                    }
                    return texto;
                }

                function seleccionarEstrellasRevision(valor) {
                    valor = parseInt(valor, 10) || 0;
                    $('#revision_rating_buttons .piase-rating-btn').removeClass('active btn-warning').addClass('btn-default');
                    $('#revision_rating_buttons input[name="calificacion_estrellas"]').prop('checked', false);

                    if (valor >= 1 && valor <= 5) {
                        $('#revision_rating_buttons input[name="calificacion_estrellas"][value="' + valor + '"]').prop('checked', true);
                        $('#revision_rating_buttons .piase-rating-btn[data-value="' + valor + '"]').removeClass('btn-default').addClass('btn-warning active');
                        $('#revision_rating_text').text(valor + '/5 ' + estrellasTextoPIASE(valor));
                    } else {
                        $('#revision_rating_text').text('Sin seleccionar');
                    }
                }

                function datoBotonPIASE(btn, nombre, defecto) {
                    var valor = $(btn).attr('data-' + nombre);
                    if (typeof valor === 'undefined' || valor === null || valor === '') {
                        valor = defecto;
                    }
                    return valor;
                }

                function abrirModalRevisarEvidencia(btn) {
                    var estrellas = parseInt(datoBotonPIASE(btn, 'estrellas', '0'), 10) || 0;
                    var estadoRevision = datoBotonPIASE(btn, 'estado-revision', 'revisada');
                    var comentarios = datoBotonPIASE(btn, 'comentarios', '');
                    var idActividad = datoBotonPIASE(btn, 'id-actividad', '');
                    var idPeriodo = datoBotonPIASE(btn, 'id-periodo', '');
                    var idEntrega = datoBotonPIASE(btn, 'id-entrega', '');
                    var actividad = datoBotonPIASE(btn, 'actividad', '');

                    fijarRetornoPIASE('tab-actividades', 'actividad-' + idActividad);
                    $('#revision_id_periodo').val(idPeriodo);
                    $('#revision_id_entrega').val(idEntrega);
                    $('#revision_actividad').text(actividad);
                    seleccionarEstrellasRevision(estrellas);
                    $('#revision_estado_revision').val(estadoRevision);
                    $('#revision_comentarios').val(comentarios);
                    $('#btnGuardarRevision').text(estrellas ? 'Actualizar calificación' : 'Guardar calificación');
                    $('#modalRevisarEvidencia').modal('show');
                }


                $('#formRevisarEvidencia').on('submit', function(e) {
                    var valor = parseInt($('#revision_rating_buttons input[name="calificacion_estrellas"]:checked').val(), 10) || 0;
                    if (valor < 1 || valor > 5) {
                        e.preventDefault();
                        alert('Selecciona el nuevo puntaje de estrellas antes de guardar.');
                        return false;
                    }
                    var idEntregaRevision = $('#revision_id_entrega').val();
                    fijarRetornoPIASE('tab-actividades', idEntregaRevision ? ('actividad-' + $('.piase-btn-stars[data-id-entrega="' + idEntregaRevision + '"]').attr('data-id-actividad')) : '');
                });


                function iconoRutaPIASE(indice, paso) {
                    if ((paso.tipo_paso || '') === 'recomendacion_final') { return 'glyphicon-send'; }
                    var destino = (paso.area_destino || '').toLowerCase();
                    if (destino.indexOf('psic') >= 0) { return 'glyphicon-heart'; }
                    if (destino.indexOf('enfer') >= 0) { return 'glyphicon-plus-sign'; }
                    if (destino.indexOf('pedagog') >= 0) { return 'glyphicon-education'; }
                    if (destino.indexOf('ases') >= 0) { return 'glyphicon-book'; }
                    return indice === 0 ? 'glyphicon-flag' : 'glyphicon-share-alt';
                }

                function abrirRutaVisual(btn) {
                    establecerFocoPIASE('caso-' + $(btn).data('id-caso'));
                    var idCaso = String($(btn).data('id-caso'));
                    var alumno = $(btn).data('alumno') || 'Estudiante';
                    var pasos = rutasCasosPIASE[idCaso] || [];
                    $('#ruta_visual_alumno').text(alumno);

                    if (!pasos || pasos.length === 0) {
                        $('#contenidoRutaVisual').html('<div class="piase-ruta-empty">No hay ruta registrada para este caso.</div>');
                        $('#modalRutaVisual').modal('show');
                        return;
                    }

                    var html = '<div class="piase-ruta-steps">';
                    $.each(pasos, function(i, paso) {
                        var icono = iconoRutaPIASE(i, paso);
                        var esRecomendacionFinal = (paso.tipo_paso || '') === 'recomendacion_final';
                        html += '<div class="piase-ruta-step">' +
                            '<div class="piase-ruta-num">' + (i + 1) + '</div>' +
                            '<div class="piase-ruta-icon"><span class="glyphicon ' + icono + '"></span></div>';

                        if (esRecomendacionFinal) {
                            html += '<div class="piase-ruta-label">Cierre del caso → Recomendación final</div>' +
                                '<div class="piase-ruta-desc">' +
                                '<strong>Fecha de cierre:</strong> ' + escapeHtmlPIASE(paso.fecha_canalizacion || '') + '<br>' +
                                '<strong>Área sugerida:</strong> ' + escapeHtmlPIASE(paso.area_recomendada_final || 'Área no especificada') + '<br>' +
                                '<strong>Motivo / indicaciones:</strong><br>' + escapeHtmlPIASE(paso.motivo_recomendacion_final || 'Sin motivo registrado') + '<br>' +
                                '<span class="label label-info">No genera cita ni seguimiento operativo</span>' +
                                '</div>';
                        } else {
                            html += '<div class="piase-ruta-label">' + escapeHtmlPIASE(paso.area_origen || 'Origen') + ' → ' + escapeHtmlPIASE(paso.area_destino || 'Destino') + '</div>' +
                                '<div class="piase-ruta-desc">' +
                                '<strong>Fecha:</strong> ' + escapeHtmlPIASE(paso.fecha_canalizacion || '') + '<br>' +
                                '<strong>Canaliza:</strong> ' + escapeHtmlPIASE(paso.personal_canaliza || '') + '<br>' +
                                '<strong>Responsable:</strong> ' + escapeHtmlPIASE(paso.responsable_destino || '') + '<br>' +
                                '<strong>Citas:</strong> ' + escapeHtmlPIASE(paso.total_citas || '0') + ' | <strong>Estado:</strong> ' + escapeHtmlPIASE(paso.estado || '') +
                                (paso.observaciones && String(paso.observaciones).trim() !== '' ? '<div class="piase-observacion-interna"><strong>Observaciones de canalización:</strong> ' + escapeHtmlPIASE(paso.observaciones) + '</div>' : '') +
                                '</div>';
                        }

                        html += '</div>';
                    });
                    html += '</div>';
                    $('#contenidoRutaVisual').html(html);
                    $('#modalRutaVisual').modal('show');
                }

                function formatearNumeroPIASE(valor, decimales) {
                    var n = parseFloat(valor);
                    if (!isFinite(n)) { return '0'; }
                    return n.toFixed(decimales).replace(/\.00$/, '');
                }

                function estrellasTextoPIASE(valor) {
                    var n = parseFloat(valor);
                    if (!isFinite(n) || n <= 0) { return 'Sin calificar'; }
                    var redondeado = Math.round(n);
                    if (redondeado < 1) { redondeado = 1; }
                    if (redondeado > 5) { redondeado = 5; }
                    var texto = '';
                    for (var i = 1; i <= 5; i++) {
                        texto += i <= redondeado ? '★' : '☆';
                    }
                    return texto + ' (' + formatearNumeroPIASE(n, 1) + '/5)';
                }

                function construirGraficaPuntosPIASE(data) {
                    var materias = data && data.materias ? data.materias : [];
                    var unidadesMap = {};
                    var puntos = [];
                    var suma = 0;
                    var total = 0;
                    var materiasRiesgo = {};

                    materias.forEach(function(materia, indiceMateria) {
                        var calificaciones = materia.calificaciones || {};
                        Object.keys(calificaciones).forEach(function(unidadKey) {
                            var cal = parseFloat(calificaciones[unidadKey]);
                            var unidad = parseInt(unidadKey, 10);
                            if (!isFinite(cal) || !isFinite(unidad)) { return; }
                            unidadesMap[unidad] = unidad;
                            puntos.push({
                                materiaIndex: indiceMateria,
                                materia: materia.materia || 'Asignatura',
                                unidad: unidad,
                                calificacion: cal
                            });
                            suma += cal;
                            total++;
                            if (cal < 70) {
                                materiasRiesgo[materia.materia || ('Asignatura ' + (indiceMateria + 1))] = true;
                            }
                        });
                    });

                    var unidades = Object.keys(unidadesMap).map(function(u) { return parseInt(u, 10); }).sort(function(a, b) { return a - b; });
                    var promedio = total > 0 ? (suma / total) : 0;
                    var totalRiesgo = Object.keys(materiasRiesgo).length;

                    if (!materias.length || !puntos.length) {
                        return {
                            html: '<div class="piase-evo-empty">No hay calificaciones registradas para construir la gráfica.</div>',
                            promedio: promedio,
                            totalPuntos: total,
                            totalRiesgo: totalRiesgo
                        };
                    }

                    var marginLeft = 58;
                    var marginRight = 28;
                    var marginTop = 25;
                    var marginBottom = 88;
                    var width = Math.max(760, materias.length * 145);
                    var height = 360;
                    var plotWidth = width - marginLeft - marginRight;
                    var plotHeight = height - marginTop - marginBottom;
                    var colores = ['#337ab7', '#5bc0de', '#f0ad4e', '#5cb85c', '#d9534f', '#777777', '#8a6d3b', '#2c3e50'];
                    var unitSlot = unidades.length > 1 ? Math.min(16, 52 / unidades.length) : 0;

                    function xPos(materiaIndex, unidad) {
                        var base = marginLeft + ((materiaIndex + 0.5) * (plotWidth / materias.length));
                        var unitIndex = unidades.indexOf(unidad);
                        var offset = (unitIndex - ((unidades.length - 1) / 2)) * unitSlot;
                        return base + offset;
                    }

                    function yPos(calificacion) {
                        return marginTop + ((100 - calificacion) * (plotHeight / 100));
                    }

                    var svg = '<div class="piase-evo-chart-wrap"><svg class="piase-evo-chart-svg" viewBox="0 0 ' + width + ' ' + height + '" width="' + width + '" height="' + height + '" role="img" aria-label="Gráfica de puntos de calificaciones por asignatura">';

                    for (var y = 0; y <= 100; y += 10) {
                        var py = yPos(y);
                        var gridClass = y === 70 ? 'risk-line' : 'grid';
                        svg += '<line class="' + gridClass + '" x1="' + marginLeft + '" y1="' + py + '" x2="' + (width - marginRight) + '" y2="' + py + '"></line>';
                        svg += '<text x="' + (marginLeft - 10) + '" y="' + (py + 4) + '" text-anchor="end">' + y + '</text>';
                    }

                    svg += '<line class="axis" x1="' + marginLeft + '" y1="' + marginTop + '" x2="' + marginLeft + '" y2="' + (height - marginBottom) + '"></line>';
                    svg += '<line class="axis" x1="' + marginLeft + '" y1="' + (height - marginBottom) + '" x2="' + (width - marginRight) + '" y2="' + (height - marginBottom) + '"></line>';
                    svg += '<text x="' + marginLeft + '" y="16" font-weight="bold">Calificación</text>';
                    svg += '<text x="' + (width - marginRight) + '" y="16" text-anchor="end">Línea roja: mínimo aprobatorio 70</text>';

                    materias.forEach(function(materia, indiceMateria) {
                        var x = marginLeft + ((indiceMateria + 0.5) * (plotWidth / materias.length));
                        var etiqueta = materia.materia || 'Asignatura';
                        var etiquetaCorta = etiqueta.length > 24 ? etiqueta.substring(0, 23) + '…' : etiqueta;
                        svg += '<line class="grid" x1="' + x + '" y1="' + marginTop + '" x2="' + x + '" y2="' + (height - marginBottom) + '"></line>';
                        svg += '<text x="' + x + '" y="' + (height - marginBottom + 18) + '" text-anchor="middle">' + escapeHtmlPIASE(etiquetaCorta) + '</text>';
                    });

                    puntos.forEach(function(p) {
                        var unitIndex = unidades.indexOf(p.unidad);
                        var color = colores[unitIndex % colores.length];
                        var cx = xPos(p.materiaIndex, p.unidad);
                        var cy = yPos(p.calificacion);
                        var title = escapeHtmlPIASE(p.materia + ' | U' + p.unidad + ': ' + p.calificacion);
                        svg += '<circle class="piase-evo-point" cx="' + cx + '" cy="' + cy + '" r="6" fill="' + color + '"><title>' + title + '</title></circle>';
                        svg += '<text x="' + cx + '" y="' + (cy - 9) + '" text-anchor="middle" font-size="10">' + p.calificacion + '</text>';
                    });

                    svg += '</svg>';
                    svg += '<div class="piase-evo-legend">';
                    unidades.forEach(function(unidad, index) {
                        svg += '<span><i class="piase-evo-dot" style="background:' + colores[index % colores.length] + '"></i>Unidad ' + unidad + '</span>';
                    });
                    svg += '</div></div>';

                    return {
                        html: svg,
                        promedio: promedio,
                        totalPuntos: total,
                        totalRiesgo: totalRiesgo
                    };
                }

                function construirTablaCalificacionesPIASE(data) {
                    var materias = data && data.materias ? data.materias : [];
                    if (!materias.length) {
                        return '<div class="piase-evo-empty">No hay asignaturas para mostrar.</div>';
                    }

                    var unidadesMap = {};
                    materias.forEach(function(materia) {
                        var calificaciones = materia.calificaciones || {};
                        Object.keys(calificaciones).forEach(function(unidadKey) {
                            var unidad = parseInt(unidadKey, 10);
                            if (isFinite(unidad)) { unidadesMap[unidad] = unidad; }
                        });
                    });
                    var unidades = Object.keys(unidadesMap).map(function(u) { return parseInt(u, 10); }).sort(function(a, b) { return a - b; });

                    var html = '<div class="table-responsive"><table class="table table-bordered table-striped table-condensed"><thead><tr><th>Asignatura</th><th>Docente</th>';
                    unidades.forEach(function(unidad) {
                        html += '<th class="text-center">Unidad ' + unidad + '</th>';
                    });
                    html += '<th class="text-center">Promedio</th></tr></thead><tbody>';

                    materias.forEach(function(materia) {
                        var calificaciones = materia.calificaciones || {};
                        var suma = 0;
                        var total = 0;
                        html += '<tr><td><strong>' + escapeHtmlPIASE(materia.materia || 'Sin asignatura') + '</strong></td><td>' + escapeHtmlPIASE(materia.docente_asignatura || 'Sin docente registrado') + '</td>';
                        unidades.forEach(function(unidad) {
                            var cal = calificaciones[unidad];
                            if (cal === undefined) { cal = calificaciones[String(unidad)]; }
                            var numero = parseFloat(cal);
                            if (!isFinite(numero)) {
                                html += '<td class="text-center">-</td>';
                            } else {
                                suma += numero;
                                total++;
                                var clase = numero >= 70 ? 'text-primary' : 'text-danger';
                                html += '<td class="text-center ' + clase + '"><strong>' + numero + '</strong></td>';
                            }
                        });
                        var promedio = total > 0 ? (suma / total) : 0;
                        var clasePromedio = promedio >= 70 ? 'text-primary' : 'text-danger';
                        html += '<td class="text-center ' + clasePromedio + '"><strong>' + (total > 0 ? formatearNumeroPIASE(promedio, 1) : '-') + '</strong></td></tr>';
                    });

                    html += '</tbody></table></div>';
                    return html;
                }

                function construirResumenCategoriasPIASE(data) {
                    var categorias = data && data.categorias_actividades ? data.categorias_actividades : [];
                    var resumen = data && data.resumen_actividades ? data.resumen_actividades : {
                        actividades_asignadas: 0,
                        actividades_con_evidencia: 0,
                        actividades_calificadas: 0,
                        promedio_global_estrellas: 0
                    };

                    var html = '<div class="row">' +
                        '<div class="col-sm-3"><div class="piase-evo-card"><span>Actividades asignadas</span><strong>' + escapeHtmlPIASE(resumen.actividades_asignadas || 0) + '</strong></div></div>' +
                        '<div class="col-sm-3"><div class="piase-evo-card"><span>Con evidencia</span><strong>' + escapeHtmlPIASE(resumen.actividades_con_evidencia || 0) + '</strong></div></div>' +
                        '<div class="col-sm-3"><div class="piase-evo-card"><span>Calificadas</span><strong>' + escapeHtmlPIASE(resumen.actividades_calificadas || 0) + '</strong></div></div>' +
                        '<div class="col-sm-3"><div class="piase-evo-card"><span>Promedio global</span><strong>' + estrellasTextoPIASE(resumen.promedio_global_estrellas || 0) + '</strong></div></div>' +
                        '</div>';

                    if (!categorias.length) {
                        html += '<div class="piase-evo-empty">No hay actividades asignadas para calcular promedio por categoría.</div>';
                        return html;
                    }

                    html += '<div class="table-responsive"><table class="table table-bordered table-striped table-condensed"><thead><tr>' +
                        '<th>Categoría</th><th class="text-center">Asignadas</th><th class="text-center">Con evidencia</th><th class="text-center">Calificadas</th><th class="text-center">Promedio de estrellas</th>' +
                        '</tr></thead><tbody>';
                    categorias.forEach(function(categoria) {
                        html += '<tr>' +
                            '<td><strong>' + escapeHtmlPIASE(categoria.categoria || 'Sin categoría') + '</strong></td>' +
                            '<td class="text-center">' + escapeHtmlPIASE(categoria.actividades_asignadas || 0) + '</td>' +
                            '<td class="text-center">' + escapeHtmlPIASE(categoria.actividades_con_evidencia || 0) + '</td>' +
                            '<td class="text-center">' + escapeHtmlPIASE(categoria.actividades_calificadas || 0) + '</td>' +
                            '<td class="text-center"><span class="piase-stars">' + escapeHtmlPIASE(estrellasTextoPIASE(categoria.promedio_estrellas || 0)) + '</span></td>' +
                            '</tr>';
                    });
                    html += '</tbody></table></div>';
                    return html;
                }

                function abrirGrafica(idCaso) {
                    var data = graficasCerrados[idCaso];
                    if (!data) {
                        $('#contenidoGrafica').html('<div class="alert alert-warning">No hay datos para mostrar la evolución de este caso.</div>');
                        $('#modalGrafica').modal('show');
                        return;
                    }

                    var grafica = construirGraficaPuntosPIASE(data);
                    var promedioClase = grafica.promedio >= 70 ? 'text-primary' : 'text-danger';

                    var html = '<h4 style="margin-top:0;">' + escapeHtmlPIASE(data.alumno || 'Estudiante') + '</h4>' +
                        '<p><strong>Carrera:</strong> ' + escapeHtmlPIASE(data.carrera || 'Sin carrera registrada') + '</p>';

                    html += '<div class="row piase-evo-section">' +
                        '<div class="col-sm-4"><div class="piase-evo-card"><span>Promedio académico</span><strong class="' + promedioClase + '">' + (grafica.totalPuntos > 0 ? formatearNumeroPIASE(grafica.promedio, 1) : '-') + '</strong></div></div>' +
                        '<div class="col-sm-4"><div class="piase-evo-card"><span>Asignaturas en riesgo</span><strong>' + grafica.totalRiesgo + '</strong></div></div>' +
                        '<div class="col-sm-4"><div class="piase-evo-card"><span>Evaluaciones registradas</span><strong>' + grafica.totalPuntos + '</strong></div></div>' +
                        '</div>';

                    html += '<div class="piase-evo-section"><h4 class="piase-evo-title">Evolución académica por asignatura</h4>' + grafica.html + '</div>';
                    html += '<div class="piase-evo-section"><h4 class="piase-evo-title">Detalle de calificaciones</h4>' + construirTablaCalificacionesPIASE(data) + '</div>';
                    html += '<div class="piase-evo-section"><h4 class="piase-evo-title">Promedio de estrellas por categoría de actividades</h4>' + construirResumenCategoriasPIASE(data) + '</div>';

                    $('#contenidoGrafica').html(html);
                    $('#modalGrafica').modal('show');
                }
            </script>
        @endif
    </div>
@endsection

