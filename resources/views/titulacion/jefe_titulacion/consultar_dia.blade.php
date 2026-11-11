@extends('layouts.app')

@section('title', 'Titulación')

@section('content')

<style>
    /* =========================================
TÍTULO PRINCIPAL
========================================= */

    .titulo-principal {
        margin-bottom: 25px;
    }

    .titulo-principal .panel-heading {
        background: #d9edf7;
        color: #095b9f;
        border-color: #d9edf7;
    }

    .titulo-principal h3 {
        margin: 5px 0;
        font-weight: bold;
    }

    /* =========================================
CONSULTA DE FECHA
========================================= */

    .panel-consulta {
        border-radius: 6px;
    }

    .panel-consulta .panel-heading {
        background: #2ab27b ;
        border-bottom: 1px solid #ddd;
    }

    .fecha-titulo {
        font-size: 13px;
        font-weight: bold;
        color: #fafafa;
    }

    /* =========================================
FECHA DE TITULACIÓN
========================================= */

    .titulo-fecha {
        text-align: center;
        margin: 25px 0;
        padding: 20px;
        color: #095b9f;
        font-size: 24px;
        font-weight: normal;
        border-radius: 6px;
    }

    .titulo-fecha strong {
        font-weight: bold;
    }

    /* =========================================
SALA DE AUDITORIO - AZUL
========================================= */

    .sala-auditorio {
        background: #095b9f;
        color: #fff;
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        padding: 12px 10px;
        border-radius: 4px 4px 0 0;
        margin: 0;
    }

    .horario-auditorio .panel-heading {
        background: #337ab7;
        color: #fff;
        font-weight: bold;
        text-align: center;
        font-size: 17px;
    }

    .registro-auditorio {
        border-left: 4px solid #337ab7;
    }

    /* =========================================
SALA DE VINCULACIÓN - VERDE
========================================= */

    .sala-vinculacion {
        background: #198754;
        color: #fff;
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        padding: 12px 10px;
        border-radius: 4px 4px 0 0;
        margin: 0;
    }

    .horario-vinculacion .panel-heading {
        background: #28a745;
        color: #fff;
        font-weight: bold;
        text-align: center;
        font-size: 17px;
    }

    .registro-vinculacion {
        border-left: 4px solid #28a745;
    }

    /* =========================================
HORARIOS
========================================= */

    .horario-panel {
        margin-bottom: 20px;
    }

    /* =========================================
REGISTROS
========================================= */

    .registro .panel-body {
        padding: 15px;
    }

    .registro .numero-cuenta {
        color: #095b9f;
        font-size: 18px;
        font-weight: bold;
        margin-top: 0;
    }

    .registro .nombre-estudiante {
        font-size: 16px;
        font-weight: bold;
        color: #333;
    }

    .registro .carrera {
        color: #666;
        margin-bottom: 12px;
    }

    .jurado {
        margin: 4px 0;
    }

    .jurado strong {
        color: #333;
    }

    /* =========================================
BOTÓN MODIFICAR
========================================= */

    .btn-modificar {
        margin-top: 12px;
    }

    /* =========================================
SIN REGISTRO
========================================= */

    .sin-registro {
        text-align: center;
        color: #999;
        padding: 18px;
        background: #fafafa;
        border: 1px dashed #ddd;
    }

    /* =========================================
MODAL
========================================= */

    .modal-header {
        background: #337ab7;
        color: #fff;
    }

    .modal-header .close {
        color: #fff;
        opacity: .9;
    }

    .modal-footer .btn {
        margin-left: 5px;
    }

    /* =========================================
ESTADOS DE HORARIOS
========================================= */

    .leyenda-horarios {
        margin-bottom: 10px;
    }

    .leyenda-horarios .label {
        display: inline-block;
        margin-right: 5px;
        font-size: 12px;
    }

    .horario-disponible {
        color: #198754;
        font-weight: bold;
    }

    .horario-ocupado {
        color: #d9534f;
        font-weight: bold;
    }

    .horario-actual {
        color: #337ab7;
        font-weight: bold;
    }

    /* =========================================
RESPONSIVE
========================================= */

    @media (max-width: 767px) {

        .sala-auditorio,
        .sala-vinculacion {
            font-size: 17px;
        }

        .titulo-fecha {
            font-size: 22px;
            padding: 18px;
        }

    }
</style>
<main class="container-fluid">
    {{-- =========================================
     TÍTULO PRINCIPAL
========================================== --}}

    <div class="row titulo-principal">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading text-center">
                    <h3>TITULACIONES AUTORIZADAS</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- =========================================
     CONSULTA DE FECHA
========================================== --}}

    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default panel-consulta">
                <div class="panel-heading text-center">
                    <span class="fecha-titulo">Selecciona la fecha del día a consultar</span>
                </div>

                <div class="panel-body">
                    <div class="form-group">
                        <div class="input-group date" id="fecha_dia" data-date-format="dd/mm/yyyy">
                            @if($estado_consulta_dia == 0)
                            <input type="text" id="fecha_dia1" class="form-control" autocomplete="off" required>
                            @else
                            <input type="text" id="fecha_dia2" class="form-control" value="{{ $fecha_dia }}"
                                autocomplete="off" required>
                            @endif
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    @if($estado_consulta_dia == 0)
                    <button type="button" id="ver_consulta_fecha" class="btn btn-info btn-block">
                        <span class="glyphicon glyphicon-search"></span>
                        Consultar
                    </button>
                    @else
                    <button type="button" id="ver_consulta_fecha2" class="btn btn-success btn-block">
                        <span class="glyphicon glyphicon-search"></span>
                        Consultar otra fecha
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($estado_consulta_dia == 1)

    {{-- =========================================
         MENSAJE SUCCESS
    ========================================== --}}

    @if(session('success'))

    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <div class="alert alert-success alert-dismissible text-center">

                <button type="button" class="close" data-dismiss="alert">

                    &times;

                </button>

                <span class="glyphicon glyphicon-ok"></span>

                {{ session('success') }}

            </div>

        </div>

    </div>

    @endif

    {{-- =========================================
         MENSAJE ERROR
    ========================================== --}}

    @if(session('error'))

    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <div class="alert alert-danger alert-dismissible text-center">

                <button type="button" class="close" data-dismiss="alert">

                    &times;

                </button>

                <span class="glyphicon glyphicon-warning-sign"></span>

                {{ session('error') }}

            </div>

        </div>

    </div>

    @endif

    {{-- =========================================
         FECHA DE TITULACIÓN
    ========================================== --}}

    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <div class="alert alert-info titulo-fecha">

                <span class="glyphicon glyphicon-calendar"></span>

                <strong>Día de Titulación:</strong>

                {{ $fecha_dia }}

            </div>

        </div>

    </div>

    {{-- =========================================
         SALAS
    ========================================== --}}

    <div class="row">

        {{-- =====================================
             SALA 1 - AUDITORIO
        ====================================== --}}

        <div class="col-md-6">

            <div class="sala-auditorio">

                <span class="glyphicon glyphicon-home"></span>

                SALA DE AUDITORIO

            </div>

            @foreach($horas as $hora)

            <div class="panel panel-default horario-panel horario-auditorio">

                <div class="panel-heading">

                    <span class="glyphicon glyphicon-time"></span>

                    {{ $hora->horario_dia }}

                    @if(isset($hora->hora))

                    - {{ $hora->hora }}

                    @endif

                </div>

                <div class="panel-body">

                    @php

                    $registrosSala1 = collect($sala1)->where(
                    'id_horarios_dias',
                    $hora->id_horarios_dias
                    );

                    @endphp

                    @if($registrosSala1->count() > 0)

                    @foreach($registrosSala1 as $index => $alumno)

                    <div class="panel panel-default registro registro-auditorio">

                        <div class="panel-body">

                            <h4 class="numero-cuenta">

                                NO. CUENTA:
                                {{ $alumno['no_cuenta'] }}

                            </h4>

                            <div class="nombre-estudiante">

                                {{ $alumno['nombre_al'] }}
                                {{ $alumno['apaterno'] }}
                                {{ $alumno['amaterno'] }}

                            </div>

                            <div class="carrera">

                                <strong>Carrera:</strong>
                                {{ $alumno['carrera'] }}

                            </div>

                            <hr>

                            <div class="jurado">

                                <strong>Presidente:</strong>
                                {{ $alumno['presidente'] }}

                            </div>

                            <div class="jurado">

                                <strong>Secretario:</strong>
                                {{ $alumno['secretario'] }}

                            </div>

                            <div class="jurado">

                                <strong>Vocal:</strong>
                                {{ $alumno['vocal'] }}

                            </div>

                            <div class="jurado">

                                <strong>Suplente:</strong>
                                {{ $alumno['suplente'] }}

                            </div>

                            <button type="button" class="btn btn-primary btn-sm btn-modificar" data-toggle="modal"
                                data-target="#modalEditar{{ $alumno['id_fecha_jurado_alumn'] }}">

                                <span class="glyphicon glyphicon-cog"></span>

                                Modificar Registro

                            </button>

                        </div>

                    </div>

                    {{-- =====================================
                                     MODAL SALA 1
                                ====================================== --}}

                    <div class="modal fade" id="modalEditar{{ $alumno['id_fecha_jurado_alumn'] }}" tabindex="-1"
                        role="dialog">

                        <div class="modal-dialog modal-md" role="document">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal">

                                        <span>&times;</span>

                                    </button>

                                    <h4 class="modal-title">

                                        <span class="glyphicon glyphicon-cog"></span>

                                        Modificar Registro

                                    </h4>

                                </div>

                                <form action="{{ route('guardar_editar_registro_calendario') }}" method="POST">

                                    @csrf

                                    <input type="hidden" name="id_fecha_jurado_alumn"
                                        value="{{ $alumno['id_fecha_jurado_alumn'] }}">

                                    <div class="modal-body">

                                        <div class="alert alert-info">

                                            <strong>

                                                {{ $alumno['nombre_al'] }}
                                                {{ $alumno['apaterno'] }}
                                                {{ $alumno['amaterno'] }}

                                            </strong>

                                        </div>

                                        {{-- FECHA --}}

                                        <div class="form-group">

                                            <label>
                                                Fecha de Titulación
                                            </label>

                                            <input type="date" name="fecha_titulacion" class="form-control"
                                                value="{{ \Carbon\Carbon::createFromFormat('d-m-Y', $alumno['fecha_titulacion'])->format('Y-m-d') }}"
                                                required>

                                        </div>

                                        {{-- SALA --}}

                                        <div class="form-group">

                                            <label>
                                                Sala
                                            </label>

                                            <select name="id_sala" class="form-control select-sala"
                                                data-alumno="{{ $alumno['id_fecha_jurado_alumn'] }}" required>

                                                <option value="1" {{ $alumno['id_sala'] == 1 ? 'selected' : '' }}>

                                                    Sala de Auditorio

                                                </option>

                                                <option value="2" {{ $alumno['id_sala'] == 2 ? 'selected' : '' }}>

                                                    Sala de Vinculación

                                                </option>

                                            </select>

                                        </div>

                                        {{-- HORARIO --}}

                                        <div class="form-group">

                                            <label>
                                                Horario
                                            </label>

                                            <div class="leyenda-horarios">

                                                <span class="label label-success">
                                                    <span class="glyphicon glyphicon-ok"></span>
                                                    Disponible
                                                </span>

                                                <span class="label label-danger">
                                                    <span class="glyphicon glyphicon-remove"></span>
                                                    Ocupado
                                                </span>

                                                <span class="label label-primary">
                                                    <span class="glyphicon glyphicon-time"></span>
                                                    Actual
                                                </span>

                                            </div>

                                            <select name="id_horarios_dias" class="form-control select-horario"
                                                data-sala="{{ $alumno['id_sala'] }}" required>

                                                @foreach($horas as $horaModal)

                                                @php

                                                $idHorarioSala =
                                                $horaModal->id_horarios_dias . '-' . $alumno['id_sala'];

                                                $ocupado = in_array(
                                                $idHorarioSala,
                                                $horarios_ocupados
                                                );

                                                $esActual =
                                                $alumno['id_horarios_dias'] ==
                                                $horaModal->id_horarios_dias;

                                                @endphp

                                                <option value="{{ $horaModal->id_horarios_dias }}"
                                                    data-sala="{{ $alumno['id_sala'] }}"
                                                    data-ocupado="{{ $ocupado ? '1' : '0' }}"
                                                    {{ $esActual ? 'selected' : '' }}
                                                    {{ $ocupado && !$esActual ? 'disabled' : '' }}>

                                                    {{ $horaModal->horario_dia }}

                                                    @if(isset($horaModal->hora))

                                                    - {{ $horaModal->hora }}

                                                    @endif

                                                    @if($esActual)

                                                    — ACTUAL

                                                    @elseif($ocupado)

                                                    — OCUPADO

                                                    @else

                                                    — DISPONIBLE

                                                    @endif

                                                </option>

                                                @endforeach

                                            </select>

                                        </div>

                                    </div>

                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-default" data-dismiss="modal">

                                            Cancelar

                                        </button>

                                        <button type="submit" class="btn btn-success">

                                            <span class="glyphicon glyphicon-floppy-disk"></span>

                                            Guardar cambios

                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                    @endforeach

                    @else

                    <div class="sin-registro">

                        <span class="glyphicon glyphicon-calendar"></span>

                        Sin titulación programada

                    </div>

                    @endif

                </div>

            </div>

            @endforeach

        </div>

        {{-- =====================================
             SALA 2 - VINCULACIÓN
        ====================================== --}}

        <div class="col-md-6">

            <div class="sala-vinculacion">

                <span class="glyphicon glyphicon-home"></span>

                SALA DE VINCULACIÓN

            </div>

            @foreach($horas as $hora)

            <div class="panel panel-default horario-panel horario-vinculacion">

                <div class="panel-heading">

                    <span class="glyphicon glyphicon-time"></span>

                    {{ $hora->horario_dia }}

                    @if(isset($hora->hora))

                    - {{ $hora->hora }}

                    @endif

                </div>

                <div class="panel-body">

                    @php

                    $registrosSala2 = collect($sala2)->where(
                    'id_horarios_dias',
                    $hora->id_horarios_dias
                    );

                    @endphp

                    @if($registrosSala2->count() > 0)

                    @foreach($registrosSala2 as $index => $alumno)

                    <div class="panel panel-default registro registro-vinculacion">

                        <div class="panel-body">

                            <h4 class="numero-cuenta">

                                NO. CUENTA:
                                {{ $alumno['no_cuenta'] }}

                            </h4>

                            <div class="nombre-estudiante">

                                {{ $alumno['nombre_al'] }}
                                {{ $alumno['apaterno'] }}
                                {{ $alumno['amaterno'] }}

                            </div>

                            <div class="carrera">

                                <strong>Carrera:</strong>
                                {{ $alumno['carrera'] }}

                            </div>

                            <hr>

                            <div class="jurado">

                                <strong>Presidente:</strong>
                                {{ $alumno['presidente'] }}

                            </div>

                            <div class="jurado">

                                <strong>Secretario:</strong>
                                {{ $alumno['secretario'] }}

                            </div>

                            <div class="jurado">

                                <strong>Vocal:</strong>
                                {{ $alumno['vocal'] }}

                            </div>

                            <div class="jurado">

                                <strong>Suplente:</strong>
                                {{ $alumno['suplente'] }}

                            </div>

                            <button type="button" class="btn btn-success btn-sm btn-modificar" data-toggle="modal"
                                data-target="#modalEditar{{ $alumno['id_fecha_jurado_alumn'] }}">

                                <span class="glyphicon glyphicon-cog"></span>

                                Modificar Registro

                            </button>

                        </div>

                    </div>

                    {{-- =====================================
                                     MODAL SALA 2
                                ====================================== --}}

                    <div class="modal fade" id="modalEditar{{ $alumno['id_fecha_jurado_alumn'] }}" tabindex="-1"
                        role="dialog">

                        <div class="modal-dialog modal-md" role="document">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal">

                                        <span>&times;</span>

                                    </button>

                                    <h4 class="modal-title">

                                        <span class="glyphicon glyphicon-cog"></span>

                                        Modificar Registro

                                    </h4>

                                </div>

                                <form action="{{ route('guardar_editar_registro_calendario') }}" method="POST">

                                    @csrf

                                    <input type="hidden" name="id_fecha_jurado_alumn"
                                        value="{{ $alumno['id_fecha_jurado_alumn'] }}">

                                    <div class="modal-body">

                                        <div class="alert alert-info">

                                            <strong>

                                                {{ $alumno['nombre_al'] }}
                                                {{ $alumno['apaterno'] }}
                                                {{ $alumno['amaterno'] }}

                                            </strong>

                                        </div>

                                        {{-- FECHA --}}

                                        <div class="form-group">

                                            <label>
                                                Fecha de Titulación
                                            </label>

                                            <input type="date" name="fecha_titulacion" class="form-control"
                                                value="{{ \Carbon\Carbon::createFromFormat('d-m-Y', $alumno['fecha_titulacion'])->format('Y-m-d') }}"
                                                required>

                                        </div>

                                        {{-- SALA --}}

                                        <div class="form-group">

                                            <label>
                                                Sala
                                            </label>

                                            <select name="id_sala" class="form-control select-sala"
                                                data-alumno="{{ $alumno['id_fecha_jurado_alumn'] }}" required>

                                                <option value="1" {{ $alumno['id_sala'] == 1 ? 'selected' : '' }}>

                                                    Sala de Auditorio

                                                </option>

                                                <option value="2" {{ $alumno['id_sala'] == 2 ? 'selected' : '' }}>

                                                    Sala de Vinculación

                                                </option>

                                            </select>

                                        </div>

                                        {{-- HORARIO --}}

                                        <div class="form-group">

                                            <label>
                                                Horario
                                            </label>

                                            <div class="leyenda-horarios">

                                                <span class="label label-success">
                                                    <span class="glyphicon glyphicon-ok"></span>
                                                    Disponible
                                                </span>

                                                <span class="label label-danger">
                                                    <span class="glyphicon glyphicon-remove"></span>
                                                    Ocupado
                                                </span>

                                                <span class="label label-primary">
                                                    <span class="glyphicon glyphicon-time"></span>
                                                    Actual
                                                </span>

                                            </div>

                                            <select name="id_horarios_dias" class="form-control select-horario"
                                                data-sala="{{ $alumno['id_sala'] }}" required>

                                                @foreach($horas as $horaModal)

                                                @php

                                                $idHorarioSala =
                                                $horaModal->id_horarios_dias . '-' . $alumno['id_sala'];

                                                $ocupado = in_array(
                                                $idHorarioSala,
                                                $horarios_ocupados
                                                );

                                                $esActual =
                                                $alumno['id_horarios_dias'] ==
                                                $horaModal->id_horarios_dias;

                                                @endphp

                                                <option value="{{ $horaModal->id_horarios_dias }}"
                                                    data-sala="{{ $alumno['id_sala'] }}"
                                                    data-ocupado="{{ $ocupado ? '1' : '0' }}"
                                                    {{ $esActual ? 'selected' : '' }}
                                                    {{ $ocupado && !$esActual ? 'disabled' : '' }}>

                                                    {{ $horaModal->horario_dia }}

                                                    @if(isset($horaModal->hora))

                                                    - {{ $horaModal->hora }}

                                                    @endif

                                                    @if($esActual)

                                                    — ACTUAL

                                                    @elseif($ocupado)

                                                    — OCUPADO

                                                    @else

                                                    — DISPONIBLE

                                                    @endif

                                                </option>

                                                @endforeach

                                            </select>

                                        </div>

                                    </div>

                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-default" data-dismiss="modal">

                                            Cancelar

                                        </button>

                                        <button type="submit" class="btn btn-success">

                                            <span class="glyphicon glyphicon-floppy-disk"></span>

                                            Guardar cambios

                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                    @endforeach

                    @else

                    <div class="sin-registro">

                        <span class="glyphicon glyphicon-calendar"></span>

                        Sin titulación programada

                    </div>

                    @endif

                </div>

            </div>

            @endforeach

        </div>

    </div>

    @endif

</main>
<script type="text/javascript">
    $(document).ready(function() {
        /* =========================================
           DATEPICKER
        ========================================== */
        $('#fecha_dia').datepicker({
            daysOfWeekDisabled: [0, 6],
            autoclose: true,
            language: 'es',
            todayHighlight: true
        });
        /* =========================================
           CONSULTAR FECHA
        ========================================== */
        $('#ver_consulta_fecha').click(function() {
            var fecha_dia = $('#fecha_dia1').val();
            if (!fecha_dia) {
                alert('Selecciona una fecha.');
                return;
            }
            fecha_dia = fecha_dia.split('/').reverse().join('-');
            window.location.href =
                '/titulacion/consultar_fecha_dia_titulacion_autorizadas/' + fecha_dia;
        });
        /* =========================================
           CONSULTAR OTRA FECHA
        ========================================== */
        $('#ver_consulta_fecha2').click(function() {
            var fecha_dia = $('#fecha_dia2').val();
            if (!fecha_dia) {
                alert('Selecciona una fecha.');
                return;
            }
            fecha_dia = fecha_dia.split('/').reverse().join('-');
            window.location.href =
                '/titulacion/consultar_fecha_dia_titulacion_autorizadas/' + fecha_dia;
        });
        /* =========================================
           CAMBIO DE SALA
        ========================================== */
        $('.select-sala').change(function() {
            var salaSeleccionada = $(this).val();
            var modal = $(this).closest('.modal');
            var selectHorario = modal.find('.select-horario');
            var horarioActual = selectHorario.val();
            selectHorario.find('option').each(function() {
                var option = $(this);
                var salaOption = option.attr('data-sala');
                var ocupado = option.attr('data-ocupado') === '1';
                var horarioOption = option.val();
                if (salaOption == salaSeleccionada) {
                    option.show();
                    if (ocupado && horarioOption != horarioActual) {
                        option.prop('disabled', true);
                    } else {
                        option.prop('disabled', false);
                    }
                } else {
                    option.hide();
                    option.prop('disabled', true);
                }
            });
            /*
             * Si el horario actual no pertenece a la nueva sala,
             * seleccionamos el primer horario disponible.
             */
            var horarioDisponible = selectHorario.find(
                'option[data-sala="' + salaSeleccionada + '"]:not(:disabled)'
            ).first();
            if (horarioDisponible.length > 0) {
                selectHorario.val(horarioDisponible.val());
            }
        });
        /* =========================================
           INICIALIZAR HORARIOS DE CADA MODAL
        ========================================== */
        $('.select-sala').each(function() {
            var selectSala = $(this);
            var salaSeleccionada = selectSala.val();
            var modal = selectSala.closest('.modal');
            var selectHorario = modal.find('.select-horario');
            var horarioActual = selectHorario.val();
            selectHorario.find('option').each(function() {
                var option = $(this);
                var salaOption = option.attr('data-sala');
                var ocupado = option.attr('data-ocupado') === '1';
                var horarioOption = option.val();
                if (salaOption == salaSeleccionada) {
                    option.show();
                    if (ocupado && horarioOption != horarioActual) {
                        option.prop('disabled', true);
                    } else {
                        option.prop('disabled', false);
                    }
                } else {
                    option.hide();
                    option.prop('disabled', true);
                }
            });
        });
    });
</script>
@endsection