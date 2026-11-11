@extends('layouts.app')
@section('title', 'Agregar Alumnos en Plantilla')

@section('content')

<style>
    .plantilla-container {
        padding-top: 20px;
        padding-bottom: 30px;
    }

    .titulo-principal {
        margin-bottom: 25px;
    }

    .titulo-principal .panel-heading {
        padding: 15px;
    }

    .titulo-principal h3 {
        margin: 0;
        font-weight: bold;
    }

    .panel-tabla {
        border-radius: 4px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .08);
    }

    .panel-tabla .panel-heading {
        font-weight: bold;
    }

    .panel-tabla .panel-heading h4 {
        margin: 0;
        font-weight: bold;
    }

    .table {
        margin-bottom: 0;
    }

    .table thead th {
        text-align: center;
        vertical-align: middle !important;
    }

    .table tbody td {
        vertical-align: middle !important;
    }

    .accion {
        cursor: pointer;
        font-size: 18px;
        transition: all .2s ease;
    }

    .accion-agregar {
        color: #337ab7;
    }

    .accion-agregar:hover {
        color: #23527c;
        transform: scale(1.15);
    }

    .accion-eliminar {
        color: #d9534f;
    }

    .accion-eliminar:hover {
        color: #a94442;
        transform: scale(1.15);
    }

    .modal-header-info {
        background: #d9edf7;
        color: #31708f;
        border-radius: 4px 4px 0 0;
    }

    .modal-header-danger {
        background: #f2dede;
        color: #a94442;
        border-radius: 4px 4px 0 0;
    }

    .modal-title {
        font-weight: bold;
        text-align: center;
    }

    .mensaje-confirmacion {
        font-size: 16px;
        padding: 15px 5px;
        line-height: 1.5;
    }

    .modal-footer {
        border-top: 1px solid #eee;
    }

    .btn-cancelar {
        background: #d9534f;
        color: #fff;
        border-color: #d43f3a;
    }

    .btn-cancelar:hover,
    .btn-cancelar:focus {
        background: #c9302c;
        color: #fff;
    }

    .estado-periodo {
        margin-bottom: 15px;
    }

    .dataTables_wrapper {
        padding-bottom: 10px;
    }

    .dataTables_filter input {
        margin-left: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 5px 8px;
    }

    .dataTables_length select {
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 4px;
    }

    @media (max-width: 991px) {
        .columna-tabla {
            margin-bottom: 25px;
        }
    }
</style>
<main class="col-md-12 plantilla-container">
    {{-- ===================================================== --}}
    {{-- ENCABEZADO --}}
    {{-- ===================================================== --}}

    <div class="row titulo-principal">
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-info">

                <div class="panel-heading text-center">
                    <h3>
                        <span class="glyphicon glyphicon-education"></span>
                        GESTIÓN DE ALUMNOS DUALES
                    </h3>
                </div>

                <div class="panel-body text-center">
                    <p class="text-muted" style="margin: 0;">
                        Administra los alumnos candidatos y los alumnos registrados en la plantilla dual.
                    </p>
                </div>

            </div>

        </div>
    </div>

    {{-- ===================================================== --}}
    {{-- TABLAS --}}
    {{-- ===================================================== --}}

    <div class="row">

        {{-- ================================================= --}}
        {{-- ALUMNOS CANDIDATOS --}}
        {{-- ================================================= --}}

        <div class="col-md-7 columna-tabla">

            <div class="panel panel-info panel-tabla">

                <div class="panel-heading">
                    <h4 class="text-center">
                        <span class="glyphicon glyphicon-user"></span>
                        ALUMNOS CANDIDATOS A SER DUALES
                    </h4>
                </div>

                <div class="panel-body">

                    @if($estado_periodo == 1)

                    <div class="alert alert-success estado-periodo">
                        <span class="glyphicon glyphicon-ok-sign"></span>
                        <strong>Periodo activo.</strong>
                        Puedes agregar alumnos a la plantilla.
                    </div>

                    @else

                    <div class="alert alert-warning estado-periodo">
                        <span class="glyphicon glyphicon-warning-sign"></span>
                        <strong>Periodo cerrado.</strong>
                        No es posible agregar alumnos.
                    </div>

                    @endif

                    <div class="table-responsive">

                        <table id="paginar_table" class="table table-bordered table-striped table-hover">

                            <thead>
                                <tr class="info">

                                    <th>No. de Cuenta</th>
                                    <th>Nombre</th>
                                    <th>Apellido Paterno</th>
                                    <th>Apellido Materno</th>
                                    <th style="width: 90px;">Agregar</th>

                                </tr>
                            </thead>

                            <tbody>

                                @foreach($array_estudiantes as $estudiante)

                                <tr>

                                    <td>
                                        <strong>
                                            {{ $estudiante['cuenta'] }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $estudiante['nombre'] }}
                                    </td>

                                    <td>
                                        {{ $estudiante['apaterno'] }}
                                    </td>

                                    <td>
                                        {{ $estudiante['amaterno'] }}
                                    </td>

                                    <td class="text-center">

                                        @if($estado_periodo == 1)

                                        <a href="javascript:void(0);" class="agrega accion accion-agregar"
                                            data-id="{{ $estudiante['id_alumno'] }}" title="Agregar alumno">

                                            <span class="glyphicon glyphicon-log-in"></span>

                                        </a>

                                        @else

                                        <span class="text-muted">
                                            <span class="glyphicon glyphicon-lock"></span>
                                        </span>

                                        @endif

                                    </td>

                                </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

        {{-- ================================================= --}}
        {{-- ALUMNOS EN PLANTILLA --}}
        {{-- ================================================= --}}

        <div class="col-md-5 columna-tabla">

            <div class="panel panel-success panel-tabla">

                <div class="panel-heading">
                    <h4 class="text-center">
                        <span class="glyphicon glyphicon-list-alt"></span>
                        ALUMNOS DUALES EN PLANTILLA
                    </h4>
                </div>

                <div class="panel-body">

                    @if($estado_periodo == 1)

                    <div class="alert alert-success estado-periodo">
                        <span class="glyphicon glyphicon-ok-sign"></span>
                        <strong>Periodo activo.</strong>
                        Puedes modificar la plantilla.
                    </div>

                    @else

                    <div class="alert alert-warning estado-periodo">
                        <span class="glyphicon glyphicon-warning-sign"></span>
                        <strong>Periodo cerrado.</strong>
                        No es posible modificar la plantilla.
                    </div>

                    @endif

                    <div class="table-responsive">

                        <table id="paginar_tabla" class="table table-bordered table-striped table-hover">

                            <thead>
                                <tr class="success">

                                    <th>No. Cuenta</th>
                                    <th>Nombre del alumno</th>
                                    <th style="width: 80px;">Eliminar</th>

                                </tr>
                            </thead>

                            <tbody>

                                @foreach($plantillas as $plantilla)

                                <tr>

                                    <td>
                                        <strong>
                                            {{ $plantilla->cuenta }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $plantilla->nombre }}
                                        {{ $plantilla->apaterno }}
                                        {{ $plantilla->amaterno }}
                                    </td>

                                    <td class="text-center">

                                        @if($estado_periodo == 1)

                                        <a href="javascript:void(0);" class="elimina accion accion-eliminar"
                                            data-id_alumno="{{ $plantilla->id_duales_actuales }}"
                                            title="Eliminar alumno">

                                            <span class="glyphicon glyphicon-trash"></span>

                                        </a>

                                        @else

                                        <span class="text-muted">
                                            <span class="glyphicon glyphicon-lock"></span>
                                        </span>

                                        @endif

                                    </td>

                                </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- ===================================================== --}}
    {{-- MODAL AGREGAR ALUMNO --}}
    {{-- ===================================================== --}}

    <div id="modal_agrega" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalAgregarLabel">

        <div class="modal-dialog modal-sm" role="document">

            <div class="modal-content">

                <div class="modal-header modal-header-info">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                    <h4 class="modal-title" id="modalAgregarLabel">
                        <span class="glyphicon glyphicon-user"></span>
                        Agregar alumno
                    </h4>

                </div>

                <div class="modal-body text-center">

                    <form action="{{ url('/duales/guardar_alumno_dual') }}" method="POST" role="form"
                        id="form_alumno_crea">

                        {{ csrf_field() }}

                        <input type="hidden" id="alumno" name="alumno" value="">

                        <div class="mensaje-confirmacion">

                            <span class="glyphicon glyphicon-question-sign text-info" style="font-size: 35px;"></span>

                            <br><br>

                            <strong>
                                ¿Realmente deseas agregar a este alumno a la plantilla?
                            </strong>

                        </div>

                    </form>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-cancelar" data-dismiss="modal">

                        <span class="glyphicon glyphicon-remove"></span>
                        Cancelar

                    </button>

                    <button id="confirma_agrega" type="button" class="btn btn-success">

                        <span class="glyphicon glyphicon-ok"></span>
                        Aceptar

                    </button>

                </div>

            </div>

        </div>

    </div>

    {{-- ===================================================== --}}
    {{-- MODAL ELIMINAR ALUMNO --}}
    {{-- ===================================================== --}}

    <div id="modal_elimina" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">

        <div class="modal-dialog modal-sm" role="document">

            <div class="modal-content">

                <div class="modal-header modal-header-danger">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                    <h4 class="modal-title" id="modalEliminarLabel">
                        <span class="glyphicon glyphicon-trash"></span>
                        Eliminar alumno
                    </h4>

                </div>

                <div class="modal-body text-center">

                    <form action="" method="POST" role="form" id="form_delete">

                        {{ csrf_field() }}

                        <input type="hidden" id="eliminar_alumno" name="eliminar_alumno" value="">

                        <div class="mensaje-confirmacion">

                            <span class="glyphicon glyphicon-warning-sign text-danger" style="font-size: 35px;"></span>

                            <br><br>

                            <strong>
                                ¿Realmente deseas eliminar este alumno de la plantilla?
                            </strong>

                        </div>

                    </form>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-cancelar" data-dismiss="modal">

                        <span class="glyphicon glyphicon-remove"></span>
                        Cancelar

                    </button>

                    <button id="confirma_elimina" type="button" class="btn btn-success">

                        <span class="glyphicon glyphicon-ok"></span>
                        Aceptar

                    </button>

                </div>

            </div>

        </div>

    </div>

    {{-- ===================================================== --}}
    {{-- MODAL MATERIAS --}}
    {{-- ===================================================== --}}

    <form id="form_ver_materias" class="form" role="form" method="POST">

        <div class="modal fade" id="modal_materias" tabindex="-1" role="dialog" aria-labelledby="modalMateriasLabel">

            <div class="modal-dialog modal-lg" role="document">

                <div class="modal-content">

                    <div class="modal-header modal-header-info">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                            <span aria-hidden="true">&times;</span>

                        </button>

                        <h4 class="modal-title" id="modalMateriasLabel">

                            <span class="glyphicon glyphicon-book"></span>
                            MATERIAS

                        </h4>

                    </div>

                    <div class="modal-body">

                        {{ csrf_field() }}

                        <input type="hidden" id="alumnM" name="alumnM" value="">

                        <input type="hidden" id="materias" name="materias" value="">

                        <div class="row">

                            <div class="col-md-12" id="contenedor_materias">

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-success acepta">

                            <span class="glyphicon glyphicon-plus"></span>
                            Agregar

                        </button>

                        <button type="button" class="btn btn-default" data-dismiss="modal">

                            Cerrar

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>

</main>
<script>
    $(document).ready(function() {
        /* |-------------------------------------------------------------------------- | DATATABLES |-------------------------------------------------------------------------- */
        $('#paginar_table').DataTable({
            language: {
                search: "Buscar:",
                lengthMenu: "Mostrar _MENU_ registros",
                zeroRecords: "No se encontraron alumnos",
                info: "Mostrando _START_ a _END_ de _TOTAL_ alumnos",
                infoEmpty: "No hay alumnos disponibles",
                infoFiltered: "(filtrado de _MAX_ registros)",
                paginate: {
                    first: "Primero",
                    last: "Último",
                    next: "Siguiente",
                    previous: "Anterior"
                }
            }
        });
        $('#paginar_tabla').DataTable({
            language: {
                search: "Buscar:",
                lengthMenu: "Mostrar _MENU_ registros",
                zeroRecords: "No hay alumnos en plantilla",
                info: "Mostrando _START_ a _END_ de _TOTAL_ alumnos",
                infoEmpty: "No hay alumnos disponibles",
                infoFiltered: "(filtrado de _MAX_ registros)",
                paginate: {
                    first: "Primero",
                    last: "Último",
                    next: "Siguiente",
                    previous: "Anterior"
                }
            }
        }); /* |-------------------------------------------------------------------------- | AGREGAR ALUMNO |-------------------------------------------------------------------------- */
        $("#paginar_table").on('click', '.agrega', function() {
            var id_alumno = $(this).data('id');
            $('#alumno').val(id_alumno);
            $('#modal_agrega').modal({
                backdrop: 'static',
                keyboard: false
            });
        }); /* |-------------------------------------------------------------------------- | CONFIRMAR AGREGAR |-------------------------------------------------------------------------- */
        $("#confirma_agrega").click(function(event) {
            event.preventDefault();
            var boton = $(this);
            boton.prop('disabled', true);
            $("#form_alumno_crea").submit();
        }); /* |-------------------------------------------------------------------------- | ELIMINAR ALUMNO |-------------------------------------------------------------------------- */
        $("#paginar_tabla").on('click', '.elimina', function() {
            var id_duales_actuales = $(this).data('id_alumno');
            $('#eliminar_alumno').val(id_duales_actuales);
            $('#modal_elimina').modal({
                backdrop: 'static',
                keyboard: false
            });
        }); /* |-------------------------------------------------------------------------- | CONFIRMAR ELIMINAR |-------------------------------------------------------------------------- */
        $("#confirma_elimina").click(function(event) {
            event.preventDefault();
            var eliminar_alumno = $("#eliminar_alumno").val();
            if (!eliminar_alumno) {
                return;
            }
            var boton = $(this);
            boton.prop('disabled', true);
            $("#form_delete").attr("action", "/duales/Eliminar_dual/" + eliminar_alumno);
            $("#form_delete").submit();
        }); /* |-------------------------------------------------------------------------- | CERRAR MODALES - RESTABLECER BOTONES |-------------------------------------------------------------------------- */
        $('#modal_agrega').on('hidden.bs.modal', function() {
            $('#confirma_agrega').prop('disabled', false);
        });
        $('#modal_elimina').on('hidden.bs.modal', function() {
            $('#confirma_elimina').prop('disabled', false);
        });
    });
</script>
@endsection