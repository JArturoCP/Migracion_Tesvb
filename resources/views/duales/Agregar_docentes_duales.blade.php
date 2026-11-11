@extends('layouts.app')
@section('title', 'Agregar Mentores duales en Plantilla')

@section('content')

<style> /* CONTENEDOR PRINCIPAL */ .dual-container { width: 95%; max-width: 1400px; margin: 20px auto; } /* ENCABEZADO */ .dual-header { margin-bottom: 15px; } .dual-header .panel-heading { padding: 12px 15px; } .dual-header h3 { margin: 0; font-size: 18px; } /* BOTÓN AGREGAR */ .dual-actions { text-align: right; margin-bottom: 15px; } .btn-dual { background: #198754; border-color: #157347; color: white; border-radius: 25px; padding: 9px 18px; font-weight: bold; } .btn-dual:hover { background: #157347; color: white; } /* TABLA */ .dual-table-container { width: 100%; overflow-x: auto; } #paginar_table { width: 100% !important; margin-bottom: 0; } #paginar_table th { text-align: center; vertical-align: middle; white-space: nowrap; } #paginar_table td { text-align: center; vertical-align: middle; } /* ICONO ELIMINAR */ .elimina { cursor: pointer; } .icon-delete { color: crimson; font-size: 18px; } /* MODAL */ .modal-header-dual { background: #337ab7; color: white; padding: 12px 15px; } .modal-header-dual .close { color: white; opacity: 1; } .modal-header-dual h4 { margin: 0; text-align: center; } .dual-form-group { margin-bottom: 18px; } .dual-form-group label { margin-bottom: 7px; font-weight: bold; } .dual-select { height: 38px; } .btn-modal-save { border-radius: 20px; padding: 8px 18px; } .btn-modal-close { border-radius: 20px; padding: 8px 18px; background: crimson; color: white; } .btn-modal-close:hover { background: #a94442; color: white; } /* MODAL ELIMINAR */ #modal_elimina .modal-dialog { margin-top: 120px; } #modal_elimina .modal-body { padding: 25px; } /* EN PANTALLAS PEQUEÑAS */ @media (max-width: 768px) { .dual-container { width: 98%; margin: 10px auto; } .dual-actions { text-align: center; } .dual-header h3 { font-size: 16px; } .btn-dual { width: 100%; } } </style> <main>
<div class="dual-container">

    {{-- ============================= --}}
    {{-- ENCABEZADO --}}
    {{-- ============================= --}}
    <div class="panel panel-info dual-header">
        <div class="panel-heading">
            <h3 class="text-center">
                <span class="glyphicon glyphicon-education"></span>
                AGREGAR PROFESORES DUALES A ALUMNOS
            </h3>
        </div>
    </div>


    {{-- ============================= --}}
    {{-- BOTÓN AGREGAR --}}
    {{-- ============================= --}}
    @if($estado_periodo == 1)
        <div class="dual-actions">

            <button type="button"
                    class="btn btn-dual"
                    data-toggle="modal"
                    data-target="#myModal">

                <span class="glyphicon glyphicon-plus"></span>
                Agregar Mentor al Alumno Dual

            </button>

        </div>
    @endif


    {{-- ============================= --}}
    {{-- TABLA --}}
    {{-- ============================= --}}
    <div class="panel panel-default">

        <div class="panel-heading">
            <strong>
                <span class="glyphicon glyphicon-list"></span>
                Mentores asignados
            </strong>
        </div>

        <div class="panel-body" style="padding: 10px;">

            <div class="dual-table-container">

                <table id="paginar_table"
                       class="table table-bordered table-striped table-hover">

                    <thead>
                    <tr class="info">

                        <th>Nombre del Docente</th>
                        <th>No. Cuenta</th>
                        <th>Nombre del Alumno Dual</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Acciones</th>

                    </tr>
                    </thead>

                    <tbody>

                    @foreach($datos as $dato)

                        <tr>

                            <td>
                                {{ $dato->titulo }} {{ $dato->profesor }}
                            </td>

                            <td>
                                {{ $dato->cuenta }}
                            </td>

                            <td>
                                {{ $dato->nombre }}
                            </td>

                            <td>
                                {{ $dato->apaterno }}
                            </td>

                            <td>
                                {{ $dato->amaterno }}
                            </td>

                            <td>

                                @if($estado_periodo == 1)

                                    <a class="elimina"
                                       data-id_duales_actuales="{{ $dato->id_duales_actuales }}">

                                        <span class="glyphicon glyphicon-trash icon-delete"></span>

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
{{-- MODAL AGREGAR MENTOR --}}
{{-- ================================================= --}}

<div class="modal fade"
     id="myModal"
     tabindex="-1"
     role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header modal-header-dual">

                <button type="button"
                        class="close"
                        data-dismiss="modal">

                    &times;

                </button>

                <h4>
                    <span class="glyphicon glyphicon-education"></span>
                    Agregar Mentor Dual
                </h4>

            </div>


            <div class="modal-body">

                <form action="{{ url('/duales/guardar_mentor_dual') }}"
                      method="POST"
                      id="form_guardar_dual">

                    {{ csrf_field() }}


                    {{-- DOCENTE --}}
                    <div class="dual-form-group">

                        <label for="id_profesor">

                            <span class="glyphicon glyphicon-user"></span>
                            Seleccione el docente que será mentor dual

                        </label>

                        <select class="form-control dual-select"
                                id="id_profesor"
                                name="id_profesor"
                                required>

                            <option value="" selected disabled>
                                Selecciona una opción
                            </option>

                            @foreach($docentes as $docente)

                                <option value="{{ $docente->id_personal }}">

                                    {{ $docente->nombre }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- ALUMNO --}}
                    <div class="dual-form-group">

                        <label for="id_alumno">

                            <span class="glyphicon glyphicon-education"></span>
                            Seleccione el alumno Dual

                        </label>

                        <select class="form-control dual-select"
                                id="id_alumno"
                                name="id_alumno"
                                required>

                            <option value="" selected disabled>
                                Selecciona una opción
                            </option>

                            @foreach($estudiantes as $estudiante)

                                <option value="{{ $estudiante->id_alumno }}">

                                    {{ $estudiante->nombre }}
                                    {{ $estudiante->apaterno }}
                                    {{ $estudiante->amaterno }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                </form>

            </div>


            <div class="modal-footer">

                <button type="button"
                        class="btn btn-success btn-modal-save"
                        id="btn_guardar">

                    <span class="glyphicon glyphicon-floppy-disk"></span>
                    Guardar

                </button>

                <button type="button"
                        class="btn btn-modal-close"
                        data-dismiss="modal">

                    <span class="glyphicon glyphicon-remove"></span>
                    Salir

                </button>

            </div>

        </div>

    </div>

</div>


{{-- ================================================= --}}
{{-- MODAL ELIMINAR --}}
{{-- ================================================= --}}

<div id="modal_elimina"
     class="modal fade"
     tabindex="-1"
     role="dialog">

    <div class="modal-dialog modal-sm">

        <div class="modal-content">

            <div class="modal-body text-center">

                <form method="POST"
                      role="form"
                      id="form_delete">

                    {{ csrf_field() }}

                    <input type="hidden"
                           id="eliminar_alumno"
                           name="eliminar_alumno"
                           value="">

                    <span class="glyphicon glyphicon-trash"
                          style="font-size:40px;color:crimson;">
                    </span>

                    <br>
                    <br>

                    <strong>
                        ¿Realmente deseas eliminar este mentor?
                    </strong>


                    <div class="modal-footer">

                        <button type="button"
                                class="btn btn-default"
                                data-dismiss="modal">

                            <span class="glyphicon glyphicon-remove"></span>
                            Cancelar

                        </button>

                        <button id="confirma_elimina"
                                type="button"
                                class="btn btn-danger">

                            <span class="glyphicon glyphicon-ok"></span>
                            Aceptar

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

</main> <script> $(document).ready(function () { /* |-------------------------------------------------------------------------- | DATATABLE |-------------------------------------------------------------------------- */ $('#paginar_table').DataTable({ pageLength: 10, language: { search: "Buscar:", lengthMenu: "Mostrar _MENU_ registros", info: "Mostrando _START_ a _END_ de _TOTAL_ registros", infoEmpty: "No hay registros", zeroRecords: "No se encontraron registros", paginate: { first: "Primero", last: "Último", next: "Siguiente", previous: "Anterior" } } }); /* |-------------------------------------------------------------------------- | GUARDAR MENTOR |-------------------------------------------------------------------------- */ $("#btn_guardar").click(function () { var id_profesor = $("#id_profesor").val(); var id_alumno = $("#id_alumno").val(); if (!id_profesor) { swal({ position: "top", type: "warning", title: "Selecciona un docente", showConfirmButton: false, timer: 2500 }); return false; } if (!id_alumno) { swal({ position: "top", type: "warning", title: "Selecciona un alumno", showConfirmButton: false, timer: 2500 }); return false; } $("#btn_guardar").prop("disabled", true); $("#form_guardar_dual").submit(); }); /* |-------------------------------------------------------------------------- | ABRIR MODAL ELIMINAR |-------------------------------------------------------------------------- */ $("#paginar_table").on("click", ".elimina", function () { var id_duales_actuales = $(this).data("id_duales_actuales"); $("#eliminar_alumno").val(id_duales_actuales); $("#modal_elimina").modal("show"); }); /* |-------------------------------------------------------------------------- | CONFIRMAR ELIMINACIÓN |-------------------------------------------------------------------------- */ $("#confirma_elimina").click(function () { var eliminar_alumno = $("#eliminar_alumno").val(); if (!eliminar_alumno) { return false; } $("#confirma_elimina").prop("disabled", true); $("#form_delete") .attr( "action", "/duales/eliminacion_dual/" + eliminar_alumno ); $("#form_delete").submit(); }); }); </script>

@endsection