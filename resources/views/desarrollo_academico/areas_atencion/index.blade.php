@extends('layouts.app')
@section('title', 'Áreas de atención')
@section('content')
    <?php
    $diasSemana = array(
        1 => 'Lunes',
        2 => 'Martes',
        3 => 'Miércoles',
        4 => 'Jueves',
        5 => 'Viernes',
        6 => 'Sábado',
        7 => 'Domingo',
    );

    $nombreAreaVisual = function($nombre) {
        $normalizado = strtolower(trim(strtr($nombre, array(
            'Á' => 'a', 'É' => 'e', 'Í' => 'i', 'Ó' => 'o', 'Ú' => 'u',
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
            'Ñ' => 'n', 'ñ' => 'n'
        ))));

        if ($normalizado === 'pedagogia') {
            return 'Pedagogía general';
        }

        return $nombre;
    };

    $horasInicio = array();
    for ($h = 7; $h <= 19; $h++) {
        $horasInicio[] = sprintf('%02d:00', $h);
    }

    $horasFin = array();
    for ($h = 8; $h <= 20; $h++) {
        $horasFin[] = sprintf('%02d:00', $h);
    }
    ?>

    <style>
        .panel-area-atencion {
            border-radius: 6px;
            box-shadow: 0 1px 4px rgba(0,0,0,.08);
        }
        .panel-area-atencion .panel-heading {
            font-weight: bold;
            font-size: 16px;
        }
        .panel-area-atencion .area-encabezado {
            cursor: pointer;
            width: 100%;
            background: transparent;
            border: 0;
            text-align: center;
            padding: 0;
            color: inherit;
        }
        .panel-area-atencion .area-encabezado:focus { outline: 2px solid #337ab7; }
        .panel-area-atencion .indicador-area { float: right; }
        .resultado-personal {
            border: 1px solid #ddd;
            border-radius: 4px;
            background: #fff;
            max-height: 220px;
            overflow-y: auto;
            display: none;
            position: absolute;
            z-index: 9999;
            width: 95%;
        }
        .resultado-personal a {
            display: block;
            padding: 8px 10px;
            border-bottom: 1px solid #eee;
            color: #333;
            text-decoration: none;
        }
        .resultado-personal a:hover {
            background: #f5f5f5;
        }
        .responsable-card {
            background: #f7f7f7;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 12px;
        }
        .responsable-card.responsable-principal {
            border-left: 5px solid #337ab7;
        }
        .responsable-card.responsable-apoyo {
            border-left: 5px solid #5bc0de;
        }
        .sin-responsable {
            color: #a94442;
            font-weight: bold;
        }
        .tabla-horarios th,
        .tabla-horarios td {
            vertical-align: middle !important;
        }
        .badge-responsables {
            background: #337ab7;
            font-size: 12px;
        }
        .bloque-horarios-responsable {
            border: 1px solid #e5e5e5;
            border-radius: 6px;
            padding: 12px;
            margin-bottom: 15px;
            background: #fff;
        }
        .titulo-responsable-horario {
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }
        .area-badge {
            display:inline-block;
            margin-left:5px;
            font-size:11px;
        }
        .panel-alta-area {
            border-left:5px solid #337ab7;
        }
        .area-descripcion {
            color:#666;
            font-size:12px;
            margin-top:6px;
        }
        .area-opciones label {
            margin-right:14px;
            font-weight: normal;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">
                        <h3 class="panel-title">GESTIÓN DE ÁREAS DE ATENCIÓN A ESTUDIANTES</h3>
                    </div>
                    <div class="panel-body">
                        <p class="text-muted text-center">
                            Desarrollo Académico puede asignar uno o varios responsables por área/periodo y capturar horarios de atención por cada responsable. Cada horario registrado representa una cita completa y solo puede ocuparse por un estudiante en una fecha específica. La captura se realiza únicamente por horas completas de 07:00 a 20:00.
                        </p>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <strong>Revisa la información capturada:</strong>
                                <ul style="margin-bottom:0;">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(!$periodoActual)
                            <div class="alert alert-warning">No se encontró un periodo vigente para la fecha del sistema. Selecciona un periodo para consultar información histórica.</div>
                        @endif
                        <form method="GET" action="{{ route('desarrollo_academico.areas_atencion.index') }}" class="form-inline text-center">
                            <div class="form-group">
                                <label for="id_periodo">Periodo:</label>
                                <select name="id_periodo" id="id_periodo" class="form-control" onchange="this.form.submit()">
                                    <option value="" {{ !$periodoSeleccionado ? 'selected' : '' }}>Selecciona un periodo</option>
                                    @foreach($periodos as $periodo)
                                        <option value="{{ $periodo->id_periodo }}" {{ $periodoSeleccionado == $periodo->id_periodo ? 'selected' : '' }}>
                                            {{ $periodo->periodo }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default panel-alta-area">
                    <div class="panel-heading">
                        <strong>Alta dinámica de área de atención</strong>
                    </div>
                    <div class="panel-body">
                        <p class="text-muted">
                            Las áreas registradas aquí se integran automáticamente al flujo de PIASE. Si el área requiere citas, aparecerá como destino operativo para canalizar estudiantes, siempre que tenga responsables y horarios activos.
                        </p>
                        <form method="POST" action="{{ route('desarrollo_academico.areas_atencion.area.guardar') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="id_periodo" value="{{ $periodoSeleccionado }}">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Nombre del área</label>
                                        <input type="text" name="nombre" class="form-control" maxlength="150" placeholder="Ej. Trabajo Social" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <input type="text" name="descripcion" class="form-control" maxlength="500" placeholder="Descripción breve del área">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Orden</label>
                                        <input type="number" name="orden" class="form-control" value="90" min="1" max="999">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Configuración</label>
                                    <div class="area-opciones">
                                        <label><input type="checkbox" name="requiere_citas" value="1" checked> Requiere citas</label><br>
                                        <label><input type="checkbox" name="requiere_actividades" value="1"> Maneja actividades</label><br>
                                        <label><input type="checkbox" name="maneja_datos_sensibles" value="1"> Datos sensibles</label>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-info" style="margin-bottom:10px;">
                                <strong>Nota:</strong> Pedagogía general se conserva como área coordinadora. Para atención directa utiliza Pedagogía para estudiantes u otra área operativa.
                            </div>

                            <button type="submit" class="btn btn-success">
                                <span class="glyphicon glyphicon-plus"></span>
                                Guardar área de atención
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @foreach($areas as $area)
                <?php
                $listaResponsables = isset($responsables[$area->id_area_atencion]) ? $responsables[$area->id_area_atencion] : array();
                $totalResponsables = isset($conteoResponsables[$area->id_area_atencion]) ? $conteoResponsables[$area->id_area_atencion] : 0;
                $requiereCitasArea = isset($area->requiere_citas) && (int)$area->requiere_citas === 1;
                $requiereActividadesArea = isset($area->requiere_actividades) && (int)$area->requiere_actividades === 1;
                $manejaDatosSensiblesArea = isset($area->maneja_datos_sensibles) && (int)$area->maneja_datos_sensibles === 1;
                $nombreAreaNormalizadoTmp = strtolower(trim(strtr($area->nombre, array(
                    'Á' => 'a', 'É' => 'e', 'Í' => 'i', 'Ó' => 'o', 'Ú' => 'u',
                    'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
                    'Ñ' => 'n', 'ñ' => 'n'
                ))));
                $esPedagogiaGeneralArea = $nombreAreaNormalizadoTmp === 'pedagogia';
                ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-warning panel-area-atencion" id="area-{{ $area->id_area_atencion }}" data-area-id="{{ $area->id_area_atencion }}">
                        <div class="panel-heading text-center">
                            <button type="button" class="area-encabezado" aria-expanded="{{ (int)$areaAbierta === (int)$area->id_area_atencion ? 'true' : 'false' }}" aria-controls="contenido-area-{{ $area->id_area_atencion }}">
                                {{ mb_strtoupper($nombreAreaVisual($area->nombre), 'UTF-8') }}
                                <span class="badge badge-responsables">{{ $totalResponsables }} responsable(s)</span>
                                @if($esPedagogiaGeneralArea)
                                    <span class="label label-primary area-badge">Coordinadora general</span>
                                @elseif($requiereCitasArea)
                                    <span class="label label-success area-badge">Operativa para citas</span>
                                @else
                                    <span class="label label-default area-badge">Sin citas</span>
                                @endif
                                @if($requiereActividadesArea)
                                    <span class="label label-info area-badge">Actividades</span>
                                @endif
                                @if($manejaDatosSensiblesArea)
                                    <span class="label label-danger area-badge">Datos sensibles</span>
                                @endif
                                <span class="indicador-area" aria-hidden="true">{{ (int)$areaAbierta === (int)$area->id_area_atencion ? '−' : '+' }}</span>
                            </button>
                        </div>
                        <div class="panel-body cuerpo-area" id="contenido-area-{{ $area->id_area_atencion }}" style="{{ (int)$areaAbierta === (int)$area->id_area_atencion ? '' : 'display:none;' }}">
                            @if(isset($area->descripcion) && trim($area->descripcion) != '')
                                <div class="area-descripcion">{{ $area->descripcion }}</div>
                                <hr style="margin:10px 0 15px 0;">
                            @endif
                            @if(!$esPedagogiaGeneralArea)
                                <form method="POST" action="{{ route('desarrollo_academico.areas_atencion.area.desactivar', $area->id_area_atencion) }}" class="text-right" style="margin-bottom:10px;">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id_periodo" value="{{ $periodoSeleccionado }}">
                                    <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('¿Deseas desactivar esta área? Se desactivarán sus responsables y horarios activos, pero se conserva el historial.')">
                                        Desactivar área
                                    </button>
                                </form>
                            @endif
                            <div class="row">
                                <div class="col-md-5">
                                    <h4>Agregar responsable del área</h4>
                                    <p class="text-muted">
                                        Puedes registrar más de una persona responsable para esta área durante el mismo periodo.
                                    </p>

                                    <form method="POST" action="{{ route('desarrollo_academico.areas_atencion.responsable.guardar') }}" class="form-responsable" style="margin-bottom:18px;">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id_periodo" value="{{ $periodoSeleccionado }}">
                                        <input type="hidden" name="id_area_atencion" value="{{ $area->id_area_atencion }}">
                                        <input type="hidden" name="id_personal" class="id_personal_seleccionado" value="">

                                        <div class="form-group" style="position:relative;">
                                            <label>Buscar personal</label>
                                            <input type="text" class="form-control buscar-personal" placeholder="Nombre, correo, RFC o clave" autocomplete="off">
                                            <div class="resultado-personal"></div>
                                            <p class="help-block personal-seleccionado">Selecciona una persona de la lista.</p>
                                        </div>

                                        <div class="form-group">
                                            <label>Rol</label>
                                            <select name="rol_area" class="form-control">
                                                <option value="responsable">Responsable</option>
                                                <option value="apoyo">Apoyo</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary">
                                            <span class="glyphicon glyphicon-plus"></span>
                                            Agregar responsable
                                        </button>
                                    </form>

                                    <h4>Responsables activos</h4>

                                    @forelse($listaResponsables as $responsable)
                                        <div class="responsable-card {{ $responsable->rol_area == 'responsable' ? 'responsable-principal' : 'responsable-apoyo' }}">
                                            <strong>{{ $responsable->nombre }}</strong><br>
                                            <span class="text-muted">
                                            Clave: {{ $responsable->clave ? $responsable->clave : 'S/D' }}<br>
                                            Correo: {{ $responsable->correo ? $responsable->correo : 'S/D' }}<br>
                                            Rol: {{ ucfirst($responsable->rol_area) }}
                                        </span>
                                            <form method="POST" action="{{ route('desarrollo_academico.areas_atencion.responsable.desactivar', $responsable->id_area_responsable_periodo) }}" style="margin-top:8px;">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id_periodo" value="{{ $periodoSeleccionado }}">
                                                <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('¿Deseas desactivar este responsable? También se desactivarán sus horarios activos.')">
                                                    Desactivar responsable
                                                </button>
                                            </form>
                                        </div>
                                    @empty
                                        <p class="sin-responsable">No hay responsables asignados para este periodo.</p>
                                    @endforelse
                                </div>

                                <div class="col-md-7">
                                    @if(!$requiereCitasArea)
                                        <h4>Horario de atención</h4>
                                        <div class="alert alert-info">
                                            Esta área no requiere citas ni horarios operativos.
                                            @if($esPedagogiaGeneralArea)
                                                Pedagogía general conserva su función de coordinación, búsqueda, canalización, seguimiento y cierre de casos.
                                            @else
                                                Puedes usarla para registro administrativo, pero no aparecerá como destino de cita en PIASE hasta activar "Requiere citas" desde el alta/actualización del área.
                                            @endif
                                        </div>
                                    @else
                                        <h4>Horario de atención a estudiantes por responsable</h4>

                                        @forelse($listaResponsables as $responsableHorario)
                                                <?php
                                                $listaHorarios = isset($horarios[$responsableHorario->id_area_responsable_periodo])
                                                    ? $horarios[$responsableHorario->id_area_responsable_periodo]
                                                    : array();
                                                ?>

                                            <div class="bloque-horarios-responsable">
                                                <div class="titulo-responsable-horario">
                                                    {{ $responsableHorario->nombre }}
                                                    <span class="label label-info">{{ ucfirst($responsableHorario->rol_area) }}</span>
                                                </div>

                                                <form method="POST" action="{{ route('desarrollo_academico.areas_atencion.horario.guardar') }}" class="form-inline" style="margin-bottom:12px;">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id_periodo" value="{{ $periodoSeleccionado }}">
                                                    <input type="hidden" name="id_area_responsable_periodo" value="{{ $responsableHorario->id_area_responsable_periodo }}">

                                                    <div class="form-group">
                                                        <label>Día</label>
                                                        <select name="dia_semana" class="form-control" required>
                                                            @foreach($diasSemana as $numDia => $nombreDia)
                                                                <option value="{{ $numDia }}">{{ $nombreDia }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Inicio</label>
                                                        <select name="hora_inicio" class="form-control" required>
                                                            <option value="">Inicio</option>
                                                            @foreach($horasInicio as $horaInicioOpcion)
                                                                <option value="{{ $horaInicioOpcion }}">{{ $horaInicioOpcion }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Fin</label>
                                                        <select name="hora_fin" class="form-control" required>
                                                            <option value="">Fin</option>
                                                            @foreach($horasFin as $horaFinOpcion)
                                                                <option value="{{ $horaFinOpcion }}">{{ $horaFinOpcion }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group" style="margin-top:8px;">
                                                        <label>Lugar</label>
                                                        <input type="text" name="lugar" class="form-control" maxlength="150" placeholder="Cubículo, oficina, aula...">
                                                    </div>

                                                    <button type="submit" class="btn btn-success" style="margin-top:8px;">
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                        Agregar horario
                                                    </button>
                                                </form>

                                                <table class="table table-bordered table-striped tabla-horarios">
                                                    <thead>
                                                    <tr>
                                                        <th>Día</th>
                                                        <th>Inicio</th>
                                                        <th>Fin</th>
                                                        <th>Lugar</th>
                                                        <th>Regla</th>
                                                        <th>Acción</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @forelse($listaHorarios as $horario)
                                                        <tr>
                                                            <td>{{ isset($diasSemana[$horario->dia_semana]) ? $diasSemana[$horario->dia_semana] : $horario->dia_semana }}</td>
                                                            <td>{{ substr($horario->hora_inicio, 0, 5) }}</td>
                                                            <td>{{ substr($horario->hora_fin, 0, 5) }}</td>
                                                            <td>{{ $horario->lugar ? $horario->lugar : 'S/D' }}</td>
                                                            <td>1 estudiante por horario y fecha</td>
                                                            <td class="text-center">
                                                                <form method="POST" action="{{ route('desarrollo_academico.areas_atencion.horario.desactivar', $horario->id_area_responsable_horario) }}">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="id_periodo" value="{{ $periodoSeleccionado }}">
                                                                    <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('¿Deseas desactivar este horario?')">
                                                                        Desactivar
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="6" class="text-center text-muted">Sin horarios registrados para este responsable.</td>
                                                        </tr>
                                                    @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        @empty
                                            <div class="alert alert-info">
                                                Primero asigna al menos un responsable para capturar horarios.
                                            </div>
                                        @endforelse
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        $(document).ready(function () {
            $('.area-encabezado').on('click', function () {
                var boton = $(this);
                var panel = boton.closest('.panel-area-atencion');
                var cuerpo = panel.find('.cuerpo-area').first();
                var abrir = !cuerpo.is(':visible');
                $('.panel-area-atencion .cuerpo-area').not(cuerpo).hide();
                $('.area-encabezado').attr('aria-expanded', 'false').find('.indicador-area').text('+');
                cuerpo.toggle(abrir);
                boton.attr('aria-expanded', abrir ? 'true' : 'false');
                boton.find('.indicador-area').text(abrir ? '−' : '+');
            });
            $('.panel-area-atencion form').on('submit', function () {
                var form = $(this);
                var areaId = form.closest('.panel-area-atencion').attr('data-area-id');
                var campo = form.find('input[name="area_abierta"]');
                if (!campo.length) {
                    campo = $('<input>', { type: 'hidden', name: 'area_abierta' }).appendTo(form);
                }
                campo.val(areaId);
            });
            var areaRestaurada = $('.area-encabezado[aria-expanded="true"]');
            if (areaRestaurada.length) {
                var panelRestaurado = areaRestaurada.closest('.panel-area-atencion');
                if (panelRestaurado.length && panelRestaurado.offset()) {
                    $('html, body').scrollTop(Math.max(0, panelRestaurado.offset().top - 20));
                }
            }
            $('.buscar-personal').on('keyup', function () {
                var input = $(this);
                var term = input.val();
                var form = input.closest('form');
                var contenedor = form.find('.resultado-personal');

                form.find('.id_personal_seleccionado').val('');
                form.find('.personal-seleccionado').text('Selecciona una persona de la lista.');

                if (term.length < 2) {
                    contenedor.hide().html('');
                    return;
                }

                $.get('{{ route('desarrollo_academico.areas_atencion.personal.buscar') }}', {term: term}, function (response) {
                    var html = '';

                    if (!response.items || response.items.length === 0) {
                        html = '<a href="#" class="text-muted">Sin resultados</a>';
                    } else {
                        $.each(response.items, function (i, item) {
                            var correo = item.correo ? item.correo : 'Sin correo';
                            var clave = item.clave ? item.clave : 'S/C';
                            var rfc = item.rfc ? item.rfc : 'S/RFC';
                            html += '<a href="#" class="seleccionar-personal" ' +
                                'data-id="' + item.id_personal + '" ' +
                                'data-nombre="' + item.nombre + '" ' +
                                'data-correo="' + correo + '" ' +
                                'data-clave="' + clave + '" ' +
                                'data-rfc="' + rfc + '">' +
                                '<strong>' + item.nombre + '</strong><br>' +
                                '<small>Clave: ' + clave + ' | RFC: ' + rfc + ' | Correo: ' + correo + '</small>' +
                                '</a>';
                        });
                    }

                    contenedor.html(html).show();
                });
            });

            $(document).on('click', '.seleccionar-personal', function (e) {
                e.preventDefault();
                var item = $(this);
                var form = item.closest('form');

                form.find('.id_personal_seleccionado').val(item.data('id'));
                form.find('.buscar-personal').val(item.data('nombre'));
                form.find('.personal-seleccionado').html(
                    '<strong>Seleccionado:</strong> ' + item.data('nombre') +
                    '<br><span class="text-muted">Clave: ' + item.data('clave') + ' | RFC: ' + item.data('rfc') + ' | Correo: ' + item.data('correo') + '</span>'
                );
                form.find('.resultado-personal').hide().html('');
            });

            $(document).on('click', function (e) {
                if (!$(e.target).closest('.form-responsable').length) {
                    $('.resultado-personal').hide();
                }
            });
        });
    </script>
@endsection
