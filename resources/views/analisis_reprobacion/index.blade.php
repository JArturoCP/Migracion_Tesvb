@extends('layouts.app')
@section('title', 'Análisis de reprobación')
@section('content')
    <style>
        .ar-semaforo-sin_riesgo { background: #f9f9f9 !important; }
        .ar-semaforo-verde { background: #dff0d8 !important; }
        .ar-semaforo-amarillo { background: #fcf8e3 !important; }
        .ar-semaforo-rojo { background: #f2dede !important; }
        .ar-badge { display:inline-block; padding: 5px 9px; border-radius: 12px; font-weight: bold; }
        .ar-badge-sin_riesgo { background:#777; color:white; }
        .ar-badge-verde { background:#5cb85c; color:white; }
        .ar-badge-amarillo { background:#f0ad4e; color:white; }
        .ar-badge-rojo { background:#d9534f; color:white; }
        .ar-table-small td, .ar-table-small th { font-size: 12px; vertical-align: middle !important; }
    </style>

    <div class="row">
        <div class="col-md-10 col-xs-12 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">ANÁLISIS DE REPROBACIÓN</h3>
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

    @if(!$contexto['permitido'])
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="alert alert-danger text-center">
                    <h4>No se puede mostrar el módulo</h4>
                    <p>{{ $contexto['mensaje'] }}</p>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-10 col-xs-12 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Filtros</strong></div>
                    <div class="panel-body">
                        <form method="GET" action="{{ route('j_carrera.analisis_reprobacion.index') }}">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Periodo</label>
                                    <select name="id_periodo" class="form-control" onchange="this.form.submit()">
                                        @foreach($periodos as $periodo)
                                            <option value="{{ $periodo->id_periodo }}" {{ (int)$filtros['id_periodo'] === (int)$periodo->id_periodo ? 'selected' : '' }}>
                                                {{ $periodo->periodo }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Programa educativo</label>
                                    <select name="id_carrera" class="form-control" onchange="this.form.submit()">
                                        @foreach($carreras as $carrera)
                                            <option value="{{ $carrera->id_carrera }}" {{ (int)$filtros['id_carrera'] === (int)$carrera->id_carrera ? 'selected' : '' }}>
                                                {{ $carrera->carrera }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Asignatura</label>
                                    <select name="id_materia" class="form-control" onchange="this.form.submit()">
                                        <option value="">Todas</option>
                                        @foreach($materias->unique('id_materia') as $materia)
                                            <option value="{{ $materia->id_materia }}" {{ (int)$filtros['id_materia'] === (int)$materia->id_materia ? 'selected' : '' }}>
                                                {{ $materia->materia }} {{ $materia->clave ? '(' . $materia->clave . ')' : '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Grupo</label>
                                    <select name="grupo" class="form-control" onchange="this.form.submit()">
                                        <option value="">Todos</option>
                                            <?php $materiasParaGrupo = $filtros['id_materia'] ? $materias->where('id_materia', $filtros['id_materia']) : $materias; ?>
                                        @foreach($materiasParaGrupo->unique('grupo') as $materiaGrupo)
                                            <option value="{{ $materiaGrupo->grupo }}" {{ (int)$filtros['grupo'] === (int)$materiaGrupo->grupo ? 'selected' : '' }}>
                                                {{ $materiaGrupo->grupo }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row" style="margin-top:15px;">
                                <div class="col-md-3">
                                    <label>Unidad</label>
                                    <select name="id_unidad" class="form-control">
                                        <option value="">Todas</option>
                                        @foreach($unidades as $unidad)
                                            <option value="{{ $unidad->id_unidad }}" {{ (int)$filtros['id_unidad'] === (int)$unidad->id_unidad ? 'selected' : '' }}>
                                                Unidad {{ $unidad->id_unidad }} {{ $unidad->descripcion ? '- ' . $unidad->descripcion : '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5" style="margin-top:24px;">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-search"></span> Consultar
                                    </button>
                                    <a href="{{ route('j_carrera.analisis_reprobacion.index') }}" class="btn btn-default">Limpiar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-xs-12 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Resumen por asignatura</strong></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover ar-table-small">
                                <thead>
                                <tr style="background:#dddddd;color:black;">
                                    <th class="text-center">Asignatura</th>
                                    <th class="text-center">Grupo</th>
                                    <th class="text-center">Docente</th>
                                    <th class="text-center">Inscritos</th>
                                    <th class="text-center">Reprobados</th>
                                    <th class="text-center">% Reprobación</th>
                                    <th class="text-center">Gráfica</th>
                                    <th class="text-center">Corte</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($resumenMaterias as $resumen)
                                        <?php
                                        $docenteIds = explode(',', (string) $resumen->docentes_ids);
                                        $docenteId = count($docenteIds) && $docenteIds[0] !== '' ? (int) $docenteIds[0] : 0;
                                        $porcentaje = (float) $resumen->porcentaje_reprobacion;
                                        $clasePorcentaje = $porcentaje < 10 ? 'label-success' : ($porcentaje == 10 ? 'label-warning' : 'label-danger');
                                        ?>
                                    <tr>
                                        <td><strong>{{ $resumen->materia }}</strong><br><small>{{ $resumen->clave }}</small></td>
                                        <td class="text-center">{{ $resumen->grupo }}</td>
                                        <td>{{ $resumen->docentes ?: 'Sin docente identificado' }}</td>
                                        <td class="text-center">{{ $resumen->total_inscritos }}</td>
                                        <td class="text-center">{{ $resumen->total_reprobados }}</td>
                                        <td class="text-center"><span class="label {{ $clasePorcentaje }}">{{ number_format($porcentaje, 2) }}%</span></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-info btn-sm" onclick="cargarGrafica({{ $resumen->id_materia }}, '{{ addslashes($resumen->materia) }}', {{ (int)$resumen->grupo }})">
                                                <span class="glyphicon glyphicon-stats"></span>
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            @if($filtros['id_materia'] && $filtros['grupo'])
                                                <form method="POST" action="{{ route('j_carrera.analisis_reprobacion.corte') }}" style="display:inline;">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id_periodo" value="{{ $filtros['id_periodo'] }}">
                                                    <input type="hidden" name="id_carrera" value="{{ $filtros['id_carrera'] }}">
                                                    <input type="hidden" name="id_materia" value="{{ $resumen->id_materia }}">
                                                    <input type="hidden" name="grupo" value="{{ $resumen->grupo }}">
                                                    <input type="hidden" name="id_unidad" value="{{ $filtros['id_unidad'] ?: 0 }}">
                                                    <input type="hidden" name="id_personal_docente" value="{{ $docenteId }}">
                                                    <button type="submit" class="btn btn-success btn-sm" title="Guardar corte histórico">
                                                        <span class="glyphicon glyphicon-floppy-disk"></span>
                                                    </button>
                                                </form>
                                            @else
                                                <small>Seleccione asignatura y grupo</small>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="8" class="text-center">No hay información para los filtros seleccionados.</td></tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-xs-12 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-8 col-xs-12">
                                <strong>Estudiantes con unidades o asignaturas reprobadas</strong>
                            </div>
                            <div class="col-md-4 col-xs-12 text-right">
                                @php
                                    $parametrosExcel = array(
                                        'id_periodo' => (int) ($filtros['id_periodo'] ?? 0),
                                        'id_carrera' => (int) ($filtros['id_carrera'] ?? 0),
                                    );

                                    if (!empty($filtros['id_materia'])) {
                                        $parametrosExcel['id_materia'] = (int) $filtros['id_materia'];
                                    }

                                    if (!empty($filtros['grupo'])) {
                                        $parametrosExcel['grupo'] = (int) $filtros['grupo'];
                                    }

                                    if (!empty($filtros['id_unidad'])) {
                                        $parametrosExcel['id_unidad'] = (int) $filtros['id_unidad'];
                                    }
                                @endphp
                                <a href="{{ route('j_carrera.analisis_reprobacion.exportar_reprobados', $parametrosExcel) }}"
                                   class="btn btn-success btn-sm"
                                   title="Descargar información de estudiantes reprobados en Excel">
                                    <span class="glyphicon glyphicon-download-alt"></span>
                                    Descargar Excel
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <p>
                            <span class="ar-badge ar-badge-verde">Verde: 1 asignatura</span>
                            <span class="ar-badge ar-badge-amarillo">Amarillo: 2 asignaturas</span>
                            <span class="ar-badge ar-badge-rojo">Rojo: más de 2 asignaturas</span>
                        </p>

                        @php
                            $alumnosRiesgoAgrupados = $alumnosRiesgo->groupBy('id_alumno');
                        @endphp

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover ar-table-small">
                                <thead>
                                <tr style="background:#dddddd;color:black;">
                                    <th class="text-center">No. Cuenta</th>
                                    <th class="text-center">Estudiante</th>
                                    <th class="text-center">Asignatura</th>
                                    <th class="text-center">Grupo</th>
                                    <th class="text-center">Unidad</th>
                                    <th class="text-center">Calificación</th>
                                    <th class="text-center">No. asignaturas reprobadas</th>
                                    <th class="text-center">Semáforo</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($alumnosRiesgoAgrupados as $idAlumno => $filasAlumno)
                                    @php
                                        /*
                                         * Se conserva una sola fila visual por estudiante y se subagrupa por
                                         * asignatura/grupo para evitar repetir el nombre de la asignatura cuando
                                         * el estudiante reprueba varias unidades de la misma materia.
                                         */
                                        $alumnoPrincipal = $filasAlumno->first();
                                        $rowspanAlumno = $filasAlumno->count();
                                        $filasPorAsignaturaGrupo = $filasAlumno->groupBy(function ($fila) {
                                            return $fila->id_materia . '_' . $fila->grupo;
                                        });
                                        $primeraFilaAlumno = true;
                                    @endphp

                                    @foreach($filasPorAsignaturaGrupo as $grupoAsignatura => $filasAsignatura)
                                        @php
                                            $asignaturaPrincipal = $filasAsignatura->first();
                                            $rowspanAsignatura = $filasAsignatura->count();
                                        @endphp

                                        @php
                                            $primeraFilaAsignatura = true;
                                        @endphp

                                        @foreach($filasAsignatura as $alumno)
                                            <tr class="ar-semaforo-{{ $alumnoPrincipal->semaforo }}">
                                                @if($primeraFilaAlumno)
                                                    <td class="text-center" rowspan="{{ $rowspanAlumno }}">
                                                        {{ $alumnoPrincipal->cuenta }}
                                                    </td>

                                                    <td rowspan="{{ $rowspanAlumno }}">
                                                        <strong>{{ $alumnoPrincipal->estudiante }}</strong>

                                                        @if($alumnoPrincipal->semaforo === 'amarillo' || $alumnoPrincipal->semaforo === 'rojo')
                                                            <br><br>
                                                            <button type="button"
                                                                    class="btn btn-primary btn-xs"
                                                                    data-id-alumno="{{ $alumnoPrincipal->id_alumno }}"
                                                                    data-estudiante="{{ e($alumnoPrincipal->estudiante) }}"
                                                                    data-semaforo="{{ e($alumnoPrincipal->semaforo) }}"
                                                                    data-materias="{{ e($alumnoPrincipal->materias_reprobadas) }}"
                                                                    data-estrategia="{{ e($alumnoPrincipal->estrategia_registrada ?? '') }}"
                                                                    data-seguimiento="{{ e($alumnoPrincipal->seguimiento_registrado ?? '') }}"
                                                                    data-responsable="{{ e($alumnoPrincipal->responsable_texto ?? '') }}"
                                                                    data-fecha-compromiso="{{ e($alumnoPrincipal->fecha_compromiso ?? '') }}"
                                                                    data-fecha-seguimiento="{{ e($alumnoPrincipal->fecha_seguimiento ?? '') }}"
                                                                    onclick="abrirModalEstrategia(this)">
                                                                {{ $alumnoPrincipal->id_ar_estrategia ? 'Actualizar' : 'Registrar' }} estrategia
                                                            </button>

                                                            @if($alumnoPrincipal->id_ar_estrategia)
                                                                <br>
                                                                <button type="button"
                                                                        class="btn btn-info btn-xs"
                                                                        style="margin-top:5px;"
                                                                        data-estudiante="{{ e($alumnoPrincipal->estudiante) }}"
                                                                        data-semaforo="{{ e($alumnoPrincipal->semaforo) }}"
                                                                        data-materias="{{ e($alumnoPrincipal->materias_reprobadas) }}"
                                                                        data-estrategia="{{ e($alumnoPrincipal->estrategia_registrada ?? '') }}"
                                                                        data-seguimiento="{{ e($alumnoPrincipal->seguimiento_registrado ?? '') }}"
                                                                        data-responsable="{{ e($alumnoPrincipal->responsable_texto ?? '') }}"
                                                                        data-fecha-compromiso="{{ e($alumnoPrincipal->fecha_compromiso ?? '') }}"
                                                                        data-fecha-seguimiento="{{ e($alumnoPrincipal->fecha_seguimiento ?? '') }}"
                                                                        data-estado="{{ e($alumnoPrincipal->estado_estrategia) }}"
                                                                        data-evidencia-url="{{ !empty($alumnoPrincipal->evidencia_ruta) ? asset($alumnoPrincipal->evidencia_ruta) : '' }}"
                                                                        data-evidencia-nombre="{{ e($alumnoPrincipal->evidencia_nombre ?? '') }}"
                                                                        onclick="abrirModalVerSeguimiento(this)">
                                                                    Ver estrategia
                                                                </button>

                                                                <br><small>Estado: {{ $alumnoPrincipal->estado_estrategia }}</small>
                                                            @endif
                                                        @endif
                                                    </td>
                                                @endif

                                                @if($primeraFilaAsignatura)
                                                    <td rowspan="{{ $rowspanAsignatura }}">
                                                        {{ $asignaturaPrincipal->materia }}
                                                        <br>
                                                        <small>Semestre: {{ $asignaturaPrincipal->id_semestre }}</small>
                                                    </td>
                                                    <td class="text-center" rowspan="{{ $rowspanAsignatura }}">{{ $asignaturaPrincipal->grupo }}</td>
                                                @endif

                                                <td class="text-center">{{ $alumno->id_unidad }}</td>
                                                <td class="text-center"><strong>{{ $alumno->calificacion }}</strong></td>

                                                @if($primeraFilaAlumno)
                                                    <td class="text-center" rowspan="{{ $rowspanAlumno }}">
                                                        {{ $alumnoPrincipal->materias_reprobadas }}
                                                    </td>

                                                    <td class="text-center" rowspan="{{ $rowspanAlumno }}">
                                                        <span class="ar-badge ar-badge-{{ $alumnoPrincipal->semaforo }}">
                                                            {{ strtoupper($alumnoPrincipal->semaforo) }}
                                                        </span>
                                                    </td>
                                                @endif

                                                @php
                                                    $primeraFilaAlumno = false;
                                                    $primeraFilaAsignatura = false;
                                                @endphp
                                            </tr>
                                        @endforeach
                                    @endforeach

                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No hay estudiantes reprobados en los filtros seleccionados.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalGraficaReprobacion" tabindex="-1" role="dialog" aria-labelledby="modalGraficaLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="modalGraficaLabel">Comparativo histórico</h4>
                    </div>
                    <div class="modal-body"><div id="contenedorGraficaReprobacion"><div class="text-center">Cargando...</div></div></div>
                    <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button></div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalEstrategiaReprobacion" tabindex="-1" role="dialog" aria-labelledby="modalEstrategiaLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('j_carrera.analisis_reprobacion.estrategia') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-header bg-info">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title text-center" id="modalEstrategiaLabel">Estrategia de seguimiento</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_periodo" value="{{ $filtros['id_periodo'] }}">
                            <input type="hidden" name="id_carrera" value="{{ $filtros['id_carrera'] }}">
                            <input type="hidden" name="id_alumno" id="modal_id_alumno">

                            <div class="alert alert-warning">
                                <strong id="modal_nombre_estudiante"></strong><br>
                                Semáforo: <span id="modal_semaforo"></span> — Asignaturas reprobadas: <span id="modal_materias"></span>
                            </div>

                            <div class="form-group">
                                <label>Estrategia para disminuir la reprobación</label>
                                <textarea name="estrategia" id="modal_estrategia" class="form-control" rows="4" required>{{ old('estrategia') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Seguimiento / observaciones</label>
                                <textarea name="seguimiento" id="modal_seguimiento" class="form-control" rows="3">{{ old('seguimiento') }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fecha compromiso</label>
                                        <input type="date" name="fecha_compromiso" id="modal_fecha_compromiso" class="form-control" value="{{ old('fecha_compromiso') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fecha de seguimiento</label>
                                        <input type="date" name="fecha_seguimiento" id="modal_fecha_seguimiento" class="form-control" value="{{ old('fecha_seguimiento') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Responsable</label>
                                <input type="text" name="responsable_texto" id="modal_responsable" class="form-control" value="{{ old('responsable_texto') }}" placeholder="Nombre del responsable del seguimiento">
                            </div>

                            <div class="form-group">
                                <label>Archivo de evidencia</label>
                                <input type="file" name="evidencia" id="modal_evidencia" class="form-control">
                                <small>Formatos permitidos: PDF, JPG, PNG, DOC, DOCX. Tamaño máximo: 10 MB. Al actualizar, puedes conservar la evidencia anterior.</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar seguimiento</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalVerSeguimiento" tabindex="-1" role="dialog" aria-labelledby="modalVerSeguimientoLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="modalVerSeguimientoLabel">Seguimiento del estudiante</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning">
                            <strong id="ver_estudiante"></strong><br>
                            Semáforo: <span id="ver_semaforo"></span><br>
                            Asignaturas reprobadas: <span id="ver_materias"></span><br>
                            Estado: <span id="ver_estado"></span>
                        </div>
                        <div class="form-group"><label>Estrategia registrada</label><div class="well well-sm" id="ver_estrategia"></div></div>
                        <div class="form-group"><label>Seguimiento / observaciones</label><div class="well well-sm" id="ver_seguimiento"></div></div>
                        <div class="row">
                            <div class="col-md-6"><label>Fecha compromiso</label><div class="well well-sm" id="ver_fecha_compromiso"></div></div>
                            <div class="col-md-6"><label>Fecha seguimiento</label><div class="well well-sm" id="ver_fecha_seguimiento"></div></div>
                        </div>
                        <div class="form-group"><label>Responsable</label><div class="well well-sm" id="ver_responsable"></div></div>
                        <div class="form-group"><label>Evidencia</label><div id="ver_evidencia"></div></div>
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button></div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            function escaparHtml(texto) {
                return $('<div>').text(texto || '').html();
            }

            function cargarGrafica(idMateria, materia, grupo) {
                var url = '{{ url('/analisis-reprobacion/grafica') }}/' + idMateria
                    + '?id_periodo={{ $filtros['id_periodo'] }}&grupo=' + encodeURIComponent(grupo || '');

                $('#modalGraficaLabel').text('Comparativo histórico: ' + materia);
                $('#contenedorGraficaReprobacion').html('<div class="text-center">Cargando...</div>');
                $('#modalGraficaReprobacion').modal('show');

                $.get(url, function (respuesta) {
                    if (!respuesta.ok) {
                        $('#contenedorGraficaReprobacion').html('<div class="alert alert-danger">' + escaparHtml(respuesta.message) + '</div>');
                        return;
                    }

                    if (!respuesta.data || respuesta.data.length === 0) {
                        $('#contenedorGraficaReprobacion').html('<div class="alert alert-warning">No hay información histórica para esta asignatura.</div>');
                        return;
                    }

                    var html = '<table class="table table-bordered table-striped ar-table-small">' +
                        '<thead><tr style="background:#dddddd;color:black;">' +
                        '<th>Periodo</th><th>Docente(s)</th><th>Inscritos</th><th>Reprobados</th><th>% Reprobación</th><th>Gráfica</th>' +
                        '</tr></thead><tbody>';

                    respuesta.data.forEach(function (item) {
                        var porcentaje = parseFloat(item.porcentaje_reprobacion || 0);
                        html += '<tr>' +
                            '<td>' + escaparHtml(item.periodo) + '</td>' +
                            '<td>' + escaparHtml(item.docentes || 'Sin docente identificado') + '</td>' +
                            '<td class="text-center">' + escaparHtml(item.total_inscritos) + '</td>' +
                            '<td class="text-center">' + escaparHtml(item.total_reprobados) + '</td>' +
                            '<td class="text-center"><strong>' + porcentaje.toFixed(2) + '%</strong></td>' +
                            '<td><div class="progress" style="margin-bottom:0;">' +
                            '<div class="progress-bar" role="progressbar" aria-valuenow="' + porcentaje + '" aria-valuemin="0" aria-valuemax="100" style="width:' + Math.min(porcentaje, 100) + '%;">' + porcentaje.toFixed(2) + '%</div>' +
                            '</div></td>' +
                            '</tr>';
                    });

                    html += '</tbody></table>';
                    $('#contenedorGraficaReprobacion').html(html);
                }).fail(function () {
                    $('#contenedorGraficaReprobacion').html('<div class="alert alert-danger">No se pudo cargar la gráfica.</div>');
                });
            }

            function abrirModalEstrategia(btn) {
                var $btn = $(btn);
                $('#modal_id_alumno').val($btn.data('id-alumno'));
                $('#modal_nombre_estudiante').text($btn.data('estudiante') || '');
                $('#modal_semaforo').text(String($btn.data('semaforo') || '').toUpperCase());
                $('#modal_materias').text($btn.data('materias') || '');
                $('#modal_estrategia').val($btn.data('estrategia') || '');
                $('#modal_seguimiento').val($btn.data('seguimiento') || '');
                $('#modal_responsable').val($btn.data('responsable') || '');
                $('#modal_fecha_compromiso').val($btn.data('fecha-compromiso') || '');
                $('#modal_fecha_seguimiento').val($btn.data('fecha-seguimiento') || '');
                $('#modal_evidencia').val('');
                $('#modalEstrategiaReprobacion').modal('show');
            }

            function abrirModalVerSeguimiento(btn) {
                var $btn = $(btn);
                $('#ver_estudiante').text($btn.data('estudiante') || '');
                $('#ver_semaforo').text(String($btn.data('semaforo') || '').toUpperCase());
                $('#ver_materias').text($btn.data('materias') || '');
                $('#ver_estado').text($btn.data('estado') || '');
                $('#ver_estrategia').text($btn.data('estrategia') || 'Sin estrategia registrada.');
                $('#ver_seguimiento').text($btn.data('seguimiento') || 'Sin seguimiento registrado.');
                $('#ver_fecha_compromiso').text($btn.data('fecha-compromiso') || 'Sin fecha registrada.');
                $('#ver_fecha_seguimiento').text($btn.data('fecha-seguimiento') || 'Sin fecha registrada.');
                $('#ver_responsable').text($btn.data('responsable') || 'Sin responsable registrado.');

                var evidenciaUrl = $btn.data('evidencia-url');
                var evidenciaNombre = $btn.data('evidencia-nombre') || 'Ver evidencia';

                if (evidenciaUrl) {
                    $('#ver_evidencia').html('<a href="' + evidenciaUrl + '" target="_blank" class="btn btn-success btn-sm">' + escaparHtml(evidenciaNombre) + '</a>');
                } else {
                    $('#ver_evidencia').html('<span class="text-muted">Sin evidencia registrada.</span>');
                }

                $('#modalVerSeguimiento').modal('show');
            }
        </script>
    @endif
@endsection
