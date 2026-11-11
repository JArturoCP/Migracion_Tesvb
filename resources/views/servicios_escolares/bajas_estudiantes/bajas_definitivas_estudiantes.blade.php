@extends('layouts.app')
@section('title', 'Bajas Definitivas Estudiantes')
@section('content')
    @if($ver == 0)
        <!-- Selección de carrera -->
        <div class="row">
            <div class="col-md-10 col-xs-10 col-md-offset-1">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">BAJAS DEFINITIVAS DE LOS ESTUDIANTES</h3>
                        <h5 class="panel-title text-center">(PROGRAMAS DE ESTUDIO)</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="dropdown">
                    <label>Elige carrera<b style="color:red; font-size:23px;">*</b></label>
                    <select class="form-control" id="carrera" name="carrera" required>
                        <option disabled selected hidden>Selecciona una opción</option>
                        @foreach($carreras as $carrera)
                            <option value="{{$carrera->id_carrera}}" data-esta="{{$carrera->nombre}}">{{$carrera->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    @else
        <!-- Carrera seleccionada -->
        <div class="row">
            <div class="col-md-10 col-xs-10 col-md-offset-1">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">BAJAS DEFINITIVAS DE LOS ESTUDIANTES</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="dropdown">
                    <label>Elige carrera<b style="color:red; font-size:23px;">*</b></label>
                    <select class="form-control" id="carrera" name="carrera" required>
                        <option disabled hidden>Selecciona una opción</option>
                        @foreach($carreras as $carrera)
                            <option value="{{$carrera->id_carrera}}" {{ $carrera->id_carrera == $id_carrera ? 'selected' : '' }}>{{$carrera->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Tabla de alumnos -->
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <table id="table_enviado" class="table table-bordered table-responsive">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">NO.CUENTA</th>
                                <th class="text-center">NOMBRE DEL ALUMNO</th>
                                <th class="text-center">ACCIONES</th>
                                <th class="text-center">SOLICITUD DE BAJA</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($alumnos as $alumno)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{ $alumno->cuenta }}</td>
                                    <td class="text-center">{{ $alumno->nombre }} {{ $alumno->apaterno }} {{ $alumno->amaterno }}</td>
                                    <td style="text-align: center">
                                        <button class="btn btn-primary btn-xs btn-round btn-edit"
                                                data-toggle="modal"
                                                data-target="#modalEditar"
                                                data-cuenta="{{ $alumno->cuenta }}"
                                                data-nombre="{{ $alumno->nombre }}"
                                                data-apaterno="{{ $alumno->apaterno }}"
                                                data-amaterno="{{ $alumno->amaterno }}"
                                                data-id = "{{$alumno->id}}"
                                                data-id-alumno = "{{$alumno->id_alumno}}">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </button>

                                        <style>
                                            .btn-round {
                                                border-radius: 50%;
                                                width: 30px;
                                                height: 30px;
                                                padding: 5px 0;
                                                text-align: center;
                                            }
                                        </style>
                                    </td>
                                    <td style="text-align: center">
                                        <button type="button" class="btn btn-default btn-imprimir-baja"
                                                data-id-alumno="{{ $alumno->id_alumno }}"
                                                data-id="{{ $alumno->id }}"
                                                data-tipo="definitiva">
                                            <span class="glyphicon glyphicon-print"></span>
                                        </button>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal para registrar observación -->
        <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ url('/guardar-baja-definitiva') }}" method="POST">
                    @csrf
                    <div class="modal-content">

                        <div class="modal-header bg-info">
                            <h4 class="modal-title" style="text-align: center">Registrar Oficio para activacion de Alumnos</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" name="id_alumno" id="idAlumnoHidden">
                            <input type="hidden" name="id" id="idHidden">

                            <div class="form-group">
                                <label>No. Cuenta:</label>
                                <input type="text" class="form-control" id="editcuenta" disabled>
                            </div>
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" class="form-control" id="editnombre" disabled>
                            </div>
                            <div class="form-group">
                                <label>Apellido Paterno:</label>
                                <input type="text" class="form-control" id="editApaterno" disabled>
                            </div>
                            <div class="form-group">
                                <label>Apellido Materno:</label>
                                <input type="text" class="form-control" id="editAmaterno" disabled>
                            </div>
                            <div class="form-group">
                                <label>Número de Oficio:</label>
                                <input type="text" class="form-control" name="observacion" id="observacion" required placeholder="Porfavor ingresa el número de oficio para activacion de alumno">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">
                                <span class="glyphicon glyphicon-floppy-disk"></span> Guardar Cambios
                            </button>
                        </div>

                    </div> 
                </form>
            </div> 
        </div>

        <!-- Modal de Adeudo -->
        <div class="modal fade" id="modalAdeudo" tabindex="-1" role="dialog" aria-labelledby="modalAdeudoLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="border-radius: 6px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.15);">

                    <div class="modal-body" style="text-align: center; padding: 30px 25px 20px;">
                        <span class="glyphicon glyphicon-remove-circle" style="font-size: 48px; color: #d9534f;"></span>
                        <h4 style="margin-top: 15px; margin-bottom: 5px; font-weight: 600; color: #333;">
                            Adeudo pendiente
                        </h4>
                        <p style="color: #777; font-size: 13px; margin-bottom: 18px;">
                            No se puede generar la solicitud de baja
                        </p>
                        <p id="contadorAdeudos" style="color: #d9534f; font-size: 12px; font-weight: 600; margin-bottom: 8px;"></p>

                        <ul id="listaDepartamentosAdeudo" style="
                            list-style: none;
                            padding: 0;
                            margin: 0 0 5px;
                            text-align: left;
                            background: #f9f9f9;
                            border-radius: 4px;
                            border: 1px solid #eee;
                            max-height: 260px;
                            overflow-y: auto;
                        ">
                            <!-- Se llena por JS -->
                        </ul>
                    </div>

                    <div class="modal-footer" style="border-top: 1px solid #eee; text-align: center; padding: 12px;">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="min-width: 100px;">
                            Cerrar
                        </button>
                    </div>

                </div>
            </div>
        </div>

    @endif

    <script type="text/javascript">
        $(document).ready(function() {
            // Cambio de carrera
            $("#carrera").on('change', function() {
                var id_carrera = $(this).val();
                window.location.href = '/servicios_escolares/bajas_definitivas/ver/' + id_carrera;
            });

            // DataTable
            $('#table_enviado').DataTable();

            // Llenar modal al hacer clic en botón editar
            $(document).on('click', '.btn-edit', function () {
                $('#idAlumnoHidden').val($(this).data('id-alumno'));
                $('#idHidden').val($(this).data('id'));
                $('#editcuenta').val($(this).data('cuenta'));
                $('#editnombre').val($(this).data('nombre'));
                $('#editApaterno').val($(this).data('apaterno'));
                $('#editAmaterno').val($(this).data('amaterno'));
            });

            // Verificar adeudo antes de imprimir la solicitud de baja
            $(document).on('click', '.btn-imprimir-baja', function () {
                var $btn = $(this);
                var idAlumno = $btn.data('id-alumno');
                var id = $btn.data('id');
                var tipo = $btn.data('tipo');

                $btn.prop('disabled', true);

                $.ajax({
                    url: '/servicios_escolares/baja/verificar-adeudo/' + idAlumno,
                    method: 'GET',
                    success: function (data) {
                        $btn.prop('disabled', false);

                        if (data.tiene_adeudo) {
                            var $lista = $('#listaDepartamentosAdeudo');
                            $lista.empty();

                            var total = data.departamentos.length;
                            $('#contadorAdeudos').text(
                                total + (total === 1 ? ' departamento pendiente' : ' departamentos pendientes')
                            );

                            data.departamentos.forEach(function (depto) {
                                $lista.append(
                                    '<li style="padding: 8px 12px; border-bottom: 1px solid #eee; font-size: 13px; color: #555;">' +
                                    '<span class="glyphicon glyphicon-exclamation-sign" style="color: #d9534f; margin-right: 6px; font-size: 11px;"></span>' +
                                    depto +
                                    '</li>'
                                );
                            });
                            $lista.find('li').last().css('border-bottom', 'none');

                            $('#modalAdeudo').modal('show');
                        } else {
                            window.location.href = '/servicios_escolares/baja/imprimir/' + idAlumno + '/' + id + '/' + tipo;
                        }
                    },
                    error: function () {
                        $btn.prop('disabled', false);
                        $('#listaDepartamentosAdeudo').html(
                            '<li style="padding: 10px; font-size: 13px; color: #d9534f;">Ocurrió un error al verificar el adeudo. Intenta nuevamente.</li>'
                        );
                        $('#modalAdeudo').modal('show');
                    }
                });
            });
        });
    </script>
@endsection