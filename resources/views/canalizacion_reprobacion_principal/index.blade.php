@extends('layouts.app')
@section('title', 'Canalización por reprobación')
@section('content')
    <style>
        .cr-semaforo-verde { background: #dff0d8 !important; }
        .cr-semaforo-amarillo { background: #fcf8e3 !important; }
        .cr-semaforo-rojo { background: #f2dede !important; }
        .cr-badge { display:inline-block; padding: 5px 9px; border-radius: 12px; font-weight: bold; }
        .cr-badge-verde { background:#5cb85c; color:white; }
        .cr-badge-amarillo { background:#f0ad4e; color:white; }
        .cr-badge-rojo { background:#d9534f; color:white; }
        .cr-table-small td, .cr-table-small th { font-size: 12px; vertical-align: middle !important; }
        .cr-card-number { font-size: 24px; font-weight: bold; }
        .cr-muted { color: #777; }
        .cr-text-wrap { white-space: normal; word-break: normal; overflow-wrap: break-word; }
        .cr-panel-title { font-weight: bold; }
    </style>

    <div class="row">
        <div class="col-md-10 col-xs-12 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">CANALIZACIÓN POR REPROBACIÓN</h3>
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
        @php
            $normalizarArea = function ($valor) {
                $valor = trim((string) $valor);
                $valor = strtr($valor, array(
                    'Á' => 'a', 'É' => 'e', 'Í' => 'i', 'Ó' => 'o', 'Ú' => 'u',
                    'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
                    'Ñ' => 'n', 'ñ' => 'n'
                ));

                return strtolower($valor);
            };

            $areaPedagogiaCanalizacion = null;
            foreach ($areasAtencion as $areaAtencionTmp) {
                $nombre = preg_replace('/\s+/', ' ', $normalizarArea($areaAtencionTmp->nombre));
                if (in_array($nombre, array('pedagogia'), true)) {
                    $areaPedagogiaCanalizacion = $areaAtencionTmp;
                    break;
                }
            }
        @endphp

        <div class="row">
            <div class="col-md-10 col-xs-12 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Datos del tutor</strong>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <strong>Tutor:</strong><br>
                                {{ $contexto['personal']->nombre }}
                            </div>
                            <div class="col-md-4">
                                <strong>Periodo académico vigente:</strong><br>
                                {{ $contexto['periodo']->periodo }}
                            </div>
                            <div class="col-md-4">
                                <strong>Carrera(s) / Grupo(s):</strong><br>
                                {{ $contexto['periodo']->carreras }}<br>
                                <small>Grupo tutoría: {{ $contexto['periodo']->grupos }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-xs-12 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Estudiantes asignados al tutor con unidades reprobadas</strong>
                    </div>
                    <div class="panel-body">
                        <p>
                            <span class="cr-badge cr-badge-verde">Verde: 1 asignatura</span>
                            <span class="cr-badge cr-badge-amarillo">Amarillo: 2 asignaturas</span>
                            <span class="cr-badge cr-badge-rojo">Rojo: más de 2 asignaturas</span>
                        </p>

                        <div class="alert alert-info">
                            Este módulo registra la canalización inicial del estudiante desde la pantalla principal. La canalización se enviará siempre a Pedagogía general y la fecha se guarda automáticamente al canalizar.
                        </div>

                        @if($causasReprobacion->isEmpty() || !$areaPedagogiaCanalizacion)
                            <div class="alert alert-warning">
                                Faltan causas de reprobación activas o el área Pedagogía general no existe en el catálogo. El sistema también requiere un área activa de Tutoría/Tutorías como origen.
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover cr-table-small">
                                <thead>
                                <tr style="background:#dddddd;color:black;">
                                    <th class="text-center">No. cuenta</th>
                                    <th class="text-center">Estudiante</th>
                                    <th class="text-center">Carrera</th>
                                    <th class="text-center">Grupo tutoría</th>
                                    <th class="text-center">Asignaturas reprobadas</th>
                                    <th class="text-center">Detalle de reprobación</th>
                                    <th class="text-center">Semáforo</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($alumnos as $alumno)
                                    <tr class="cr-semaforo-{{ $alumno->semaforo }}">
                                        <td class="text-center">{{ $alumno->cuenta }}</td>
                                        <td class="cr-text-wrap">
                                            <strong>{{ $alumno->alumno }}</strong>
                                        </td>
                                        <td class="cr-text-wrap">{{ $alumno->carrera }}</td>
                                        <td class="text-center">{{ $alumno->grupo_tutoria }}</td>
                                        <td class="text-center">
                                            <strong>{{ $alumno->asignaturas_reprobadas }}</strong><br>
                                            <small>{{ $alumno->asignaturas }}</small>
                                        </td>
                                        <td class="cr-text-wrap">{{ $alumno->detalle_reprobacion }}</td>
                                        <td class="text-center">
                                            <span class="cr-badge cr-badge-{{ $alumno->semaforo }}">
                                                {{ strtoupper($alumno->semaforo) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            @if((int)$alumno->canalizaciones_periodo > 0)
                                                <span class="label label-info">Canalizado</span><br>
                                                <small>
                                                    Última área: {{ $alumno->ultima_area_destino }}<br>
                                                    Fecha: {{ $alumno->fecha_ultima_canalizacion }}
                                                </small>
                                            @else
                                                <span class="label label-default">Sin canalizar</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button type="button"
                                                    class="btn btn-primary btn-sm"
                                                    data-id-periodo="{{ $alumno->id_periodo }}"
                                                    data-id-carrera="{{ $alumno->id_carrera }}"
                                                    data-id-alumno="{{ $alumno->id_alumno }}"
                                                    data-id-asigna-generacion="{{ $alumno->id_asigna_generacion }}"
                                                    data-id-asigna-tutor="{{ $alumno->id_asigna_tutor }}"
                                                    data-alumno="{{ e($alumno->alumno) }}"
                                                    data-cuenta="{{ e($alumno->cuenta) }}"
                                                    data-carrera="{{ e($alumno->carrera) }}"
                                                    data-grupo="{{ e($alumno->grupo_tutoria) }}"
                                                    data-asignaturas="{{ e($alumno->asignaturas) }}"
                                                    data-detalle="{{ e($alumno->detalle_reprobacion) }}"
                                                    data-semaforo="{{ e($alumno->semaforo) }}"
                                                    onclick="abrirModalCanalizacion(this)"
                                                    {{ $causasReprobacion->isEmpty() || !$areaPedagogiaCanalizacion ? 'disabled' : '' }}>
                                                <span class="glyphicon glyphicon-share-alt"></span> Canalizar
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">
                                            No hay estudiantes asignados al tutor con unidades reprobadas en el periodo académico vigente.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalCanalizacion" tabindex="-1" role="dialog" aria-labelledby="modalCanalizacionLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('canalizacion_reprobacion_principal.guardar') }}">
                        {{ csrf_field() }}

                        <div class="modal-header bg-info">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title text-center" id="modalCanalizacionLabel">Canalizar estudiante</h4>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" name="id_periodo" id="modal_id_periodo">
                            <input type="hidden" name="id_carrera" id="modal_id_carrera">
                            <input type="hidden" name="id_alumno" id="modal_id_alumno">
                            <input type="hidden" name="id_asigna_generacion" id="modal_id_asigna_generacion">
                            <input type="hidden" name="id_asigna_tutor" id="modal_id_asigna_tutor">

                            <div class="alert alert-warning">
                                <strong id="modal_alumno"></strong><br>
                                Cuenta: <span id="modal_cuenta"></span><br>
                                Carrera: <span id="modal_carrera"></span><br>
                                Grupo tutoría: <span id="modal_grupo"></span><br>
                                Semáforo: <span id="modal_semaforo"></span>
                            </div>

                            <div class="form-group">
                                <label>Asignaturas reprobadas</label>
                                <div class="well well-sm" id="modal_asignaturas"></div>
                            </div>

                            <div class="form-group">
                                <label>Detalle de reprobación</label>
                                <div class="well well-sm" id="modal_detalle"></div>
                            </div>

                            <div class="form-group">
                                <label>Causa de reprobación</label>
                                <select name="id_causa_reprobacion" id="modal_id_causa_reprobacion" class="form-control" required>
                                    <option value="">Seleccione una causa</option>
                                    @foreach($causasReprobacion as $causa)
                                        @php
                                            $idCausaOpcion = isset($causa->id_causa_reprobacion)
                                                ? $causa->id_causa_reprobacion
                                                : (isset($causa->id_ar_causa) ? $causa->id_ar_causa : '');
                                        @endphp
                                        <option value="{{ $idCausaOpcion }}">
                                            {{ $causa->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Área de canalización</label>
                                <input type="hidden" name="id_area_destino" id="modal_id_area_destino" value="{{ $areaPedagogiaCanalizacion ? $areaPedagogiaCanalizacion->id_area_atencion : '' }}">
                                <select id="modal_id_area_destino_visual" class="form-control" disabled>
                                    @if($areaPedagogiaCanalizacion)
                                        <option value="{{ $areaPedagogiaCanalizacion->id_area_atencion }}" selected>
                                            {{ $areaPedagogiaCanalizacion->nombre }}
                                        </option>
                                    @else
                                        <option value="" selected>Pedagogía general no disponible</option>
                                    @endif
                                </select>
                                <p class="help-block">La canalización inicial desde tutoría se envía exclusivamente a Pedagogía general.</p>
                            </div>

                            <div class="alert alert-info">
                                Al guardar, el sistema registrará automáticamente la fecha y hora de canalización. No se capturan observaciones ni seguimiento en este módulo.
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">
                                <span class="glyphicon glyphicon-floppy-disk"></span> Guardar canalización
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            function abrirModalCanalizacion(btn) {
                var $btn = $(btn);

                $('#modal_id_periodo').val($btn.data('id-periodo'));
                $('#modal_id_carrera').val($btn.data('id-carrera'));
                $('#modal_id_alumno').val($btn.data('id-alumno'));
                $('#modal_id_asigna_generacion').val($btn.data('id-asigna-generacion'));
                $('#modal_id_asigna_tutor').val($btn.data('id-asigna-tutor'));

                $('#modal_alumno').text($btn.data('alumno') || '');
                $('#modal_cuenta').text($btn.data('cuenta') || '');
                $('#modal_carrera').text($btn.data('carrera') || '');
                $('#modal_grupo').text($btn.data('grupo') || '');
                $('#modal_semaforo').text(String($btn.data('semaforo') || '').toUpperCase());
                $('#modal_asignaturas').text($btn.data('asignaturas') || 'Sin asignaturas registradas.');
                $('#modal_detalle').text($btn.data('detalle') || 'Sin detalle registrado.');

                $('#modal_id_causa_reprobacion').val('');
                $('#modal_id_area_destino').val('{{ $areaPedagogiaCanalizacion ? $areaPedagogiaCanalizacion->id_area_atencion : '' }}');
                $('#modal_id_area_destino_visual').val('{{ $areaPedagogiaCanalizacion ? $areaPedagogiaCanalizacion->id_area_atencion : '' }}');

                $('#modalCanalizacion').modal('show');
            }
        </script>
    @endif
@endsection
