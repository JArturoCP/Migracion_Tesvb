@extends('layouts.app')

@section('title', 'Registrar Carga Académica de los Alumnos Duales')

@section('content')

<style>
/* =========================================================
       CONTENEDOR PRINCIPAL
    ========================================================= */

.card-dual {
    margin-top: 25px;
    margin-bottom: 30px;
}

.panel-dual {
    border: 0;
    border-radius: 10px;
    background: #fff;
    box-shadow: 0 3px 15px rgba(0, 0, 0, .10);
    overflow: hidden;
}

/* =========================================================
       ENCABEZADO
    ========================================================= */

.panel-dual .panel-heading {
    background: linear-gradient(135deg, #337ab7, #286090);
    color: #fff;
    padding: 20px 25px;
    border: none;
    border-radius: 0;
}

.panel-dual .panel-title {
    margin: 0;
    font-size: 19px;
    font-weight: 600;
    letter-spacing: .2px;
}

.panel-dual .panel-title .glyphicon {
    font-size: 20px;
    vertical-align: middle;
}

/* =========================================================
       CUERPO DEL PANEL
    ========================================================= */

.panel-dual .panel-body {
    padding: 25px;
    background: #fff;
}

/* =========================================================
       TABLA
    ========================================================= */

.tabla-dual {
    margin-bottom: 0 !important;
    border: 1px solid #e5e5e5;
    background: #fff;
}

.tabla-dual thead th {
    background: #337ab7 !important;
    color: #fff !important;
    vertical-align: middle !important;
    text-align: center;
    font-weight: 600;
    font-size: 13px;
    padding: 13px 10px !important;
    border-color: #286090 !important;
    white-space: nowrap;
}

.tabla-dual thead th .glyphicon {
    margin-right: 4px;
    font-size: 13px;
}

.tabla-dual tbody td {
    vertical-align: middle !important;
    padding: 12px 10px !important;
    border-color: #e9e9e9 !important;
    color: #444;
    background: #fff;
}

.tabla-dual tbody tr {
    transition: background-color .2s ease;
}

.tabla-dual tbody tr:hover td {
    background-color: #f5f9fd !important;
}

.tabla-dual tbody tr:nth-child(even) td {
    background-color: #fafafa;
}

.tabla-dual tbody tr:nth-child(even):hover td {
    background-color: #f5f9fd !important;
}

/* =========================================================
       DATOS DEL ALUMNO
    ========================================================= */

.tabla-dual tbody td:first-child {
    color: #337ab7;
    font-size: 14px;
    white-space: nowrap;
}

.nombre-alumno {
    font-weight: 500;
    color: #333;
}

.tabla-dual .text-muted {
    color: #999;
}

.tabla-dual .glyphicon-user {
    margin-right: 6px;
    color: #999;
}

/* =========================================================
       BOTONES DE ACCIÓN
    ========================================================= */

.accion {
    display: inline-block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    border-radius: 50%;
    text-align: center;
    cursor: pointer;
    text-decoration: none !important;
    transition: all .2s ease;
    border: 1px solid transparent;
}

.accion:hover,
.accion:focus {
    transform: translateY(-2px);
    text-decoration: none !important;
    box-shadow: 0 4px 9px rgba(0, 0, 0, .12);
}

.accion:active {
    transform: translateY(0);
    box-shadow: none;
}

.accion .glyphicon {
    font-size: 16px;
}

/* =========================================================
       BOTÓN CARGA
    ========================================================= */

.accion-carga {
    background: #e8f5e9;
    color: #388e3c;
    border-color: #c8e6c9;
}

.accion-carga:hover,
.accion-carga:focus {
    background: #43a047;
    color: #fff;
}

/* =========================================================
       BOTÓN VALIDAR
    ========================================================= */

.accion-validar {
    background: #e3f2fd;
    color: #1976d2;
    border-color: #bbdefb;
}

.accion-validar:hover,
.accion-validar:focus {
    background: #1976d2;
    color: #fff;
}

/* =========================================================
       BOTÓN ELIMINAR
    ========================================================= */

.accion-eliminar {
    background: #ffebee;
    color: #e53935;
    border-color: #ffcdd2;
}

.accion-eliminar:hover,
.accion-eliminar:focus {
    background: #e53935;
    color: #fff;
}

/* =========================================================
       ACCIÓN BLOQUEADA
    ========================================================= */

.accion-bloqueada {
    display: inline-block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    border-radius: 50%;
    text-align: center;
    background: #f3f3f3;
    color: #aaa;
    border: 1px solid #e5e5e5;
}

.accion-bloqueada .glyphicon {
    font-size: 15px;
}

/* =========================================================
       MODALES
    ========================================================= */

.modal-content {
    border: 0;
    border-radius: 8px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, .20);
    overflow: hidden;
}

.modal-header-dual {
    background: linear-gradient(135deg, #337ab7, #286090);
    color: #fff;
    border: none;
    padding: 18px 22px;
    border-radius: 0;
}

.modal-header-dual .modal-title {
    font-size: 17px;
    font-weight: 600;
    text-align: center;
    margin: 0;
}

.modal-header-dual .modal-title .glyphicon {
    margin-right: 5px;
}

.modal-header-dual .close {
    color: #fff;
    opacity: .9;
    text-shadow: none;
    font-size: 25px;
    transition: opacity .2s ease;
}

.modal-header-dual .close:hover {
    color: #fff;
    opacity: 1;
}

.modal-body {
    padding: 25px;
}

.modal-footer {
    padding: 15px 20px;
    background: #fafafa;
    border-top: 1px solid #eee;
}

/* =========================================================
       MODAL ELIMINAR
    ========================================================= */

.mensaje-eliminar {
    font-size: 16px;
    color: #555;
    padding: 8px 0 5px;
}

.mensaje-eliminar>.glyphicon-trash {
    width: 65px;
    height: 65px;
    line-height: 65px;
    border-radius: 50%;
    background: #ffebee;
    color: #e53935 !important;
    font-size: 28px !important;
    margin: 0 auto 18px !important;
}

.mensaje-eliminar strong {
    display: block;
    color: #444;
    font-size: 16px;
}

.mensaje-eliminar p {
    font-size: 13px;
    margin-top: 10px !important;
}

/* =========================================================
       BOTONES
    ========================================================= */

.modal-footer .btn {
    border-radius: 5px;
    padding: 8px 16px;
    font-weight: 500;
    transition: all .2s ease;
}

.modal-footer .btn-default:hover {
    background: #f1f1f1;
}

.btn-agregar {
    min-width: 120px;
}

.btn-success {
    background: #43a047;
    border-color: #388e3c;
}

.btn-success:hover,
.btn-success:focus {
    background: #388e3c;
    border-color: #2e7d32;
}

/* =========================================================
       RESPONSIVE
    ========================================================= */

@media (max-width: 767px) {

    .card-dual {
        margin-top: 15px;
    }

    .panel-dual {
        border-radius: 7px;
    }

    .panel-dual .panel-heading {
        padding: 16px 15px;
    }

    .panel-dual .panel-title {
        font-size: 15px;
        line-height: 1.5;
    }

    .panel-dual .panel-title .glyphicon {
        font-size: 16px;
    }

    .panel-dual .panel-body {
        padding: 12px;
    }

    .tabla-dual {
        font-size: 12px;
    }

    .tabla-dual thead th {
        padding: 10px 7px !important;
        font-size: 11px;
    }

    .tabla-dual tbody td {
        padding: 9px 7px !important;
    }

    .nombre-alumno {
        font-size: 12px;
    }

    .accion,
    .accion-bloqueada {
        width: 34px;
        height: 34px;
        line-height: 34px;
    }

    .accion .glyphicon,
    .accion-bloqueada .glyphicon {
        font-size: 13px;
    }

    .modal-body {
        padding: 20px 15px;
    }

    .modal-footer {
        padding: 12px 15px;
    }
}
</style>

<main class="col-md-12">

    <div class="container">

        <div class="row card-dual">

            <div class="col-md-12">

                <div class="panel panel-dual">

                    <!-- =====================================================
                         ENCABEZADO
                    ====================================================== -->

                    <div class="panel-heading">

                        <h3 class="panel-title text-center">

                            <span class="glyphicon glyphicon-education"></span>

                            &nbsp; REGISTRAR CARGA ACADÉMICA DE LOS ALUMNOS DUALES

                        </h3>

                    </div>

                    <!-- =====================================================
                         CUERPO
                    ====================================================== -->

                    <div class="panel-body">

                        <div class="table-responsive">

                            <table id="paginar_tabla" class="table table-bordered table-hover tabla-dual"
                                style="text-align:center; width:100%;">

                                <thead>

                                    <tr>

                                        <th class="text-center">
                                            No. cuenta
                                        </th>

                                        <th class="text-center">
                                            Nombre del alumno
                                        </th>

                                        <th class="text-center">

                                            <span class="glyphicon glyphicon-list-alt"></span>

                                            Llenar carga

                                        </th>

                                        <th class="text-center">

                                            <span class="glyphicon glyphicon-ok-circle"></span>

                                            Validar carga

                                        </th>

                                        <th class="text-center">

                                            <span class="glyphicon glyphicon-trash"></span>

                                            Eliminar

                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach($plantillas as $plantilla)

                                    <tr>

                                        <!-- NO. CUENTA -->

                                        <td>

                                            <strong>
                                                {{ $plantilla->cuenta }}
                                            </strong>

                                        </td>

                                        <!-- NOMBRE -->

                                        <td class="text-left">

                                            <span class="glyphicon glyphicon-user text-muted"></span>

                                            <span class="nombre-alumno">

                                                {{ $plantilla->nombre . " " . $plantilla->apaterno . " " . $plantilla->amaterno }}

                                            </span>

                                        </td>

                                        <!-- LLENAR CARGA -->

                                        <td class="text-center">

                                            <a href="javascript:void(0);" class="materias accion accion-carga"
                                                data-id_duales_actuales="{{ $plantilla->id_duales_actuales }}"
                                                title="Llenar carga académica">

                                                <span class="glyphicon glyphicon-list-alt"></span>

                                            </a>

                                        </td>

                                        <!-- VALIDAR -->

                                        <td class="text-center">

                                            <a href="{{ url('/duales/revision_control_escolar/'.$plantilla->id_alumno) }}"
                                                class="accion accion-validar" title="Validar carga académica">

                                                <span class="glyphicon glyphicon-ok-circle"></span>

                                            </a>

                                        </td>

                                        <!-- ELIMINAR -->

                                        <td class="text-center">

                                            @if($estado_periodo == 1)

                                            <a href="javascript:void(0);" class="elimina accion accion-eliminar"
                                                data-id_alumno="{{ $plantilla->id_duales_actuales }}"
                                                title="Eliminar alumno">

                                                <span class="glyphicon glyphicon-trash"></span>

                                            </a>

                                            @else

                                            <span class="accion-bloqueada" title="No disponible durante este periodo">

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

    </div>


    <!-- =============================================================
         MODAL ELIMINAR ALUMNO
    ============================================================== -->

    <div id="modal_elimina" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">

        <div class="modal-dialog modal-sm" role="document">

            <div class="modal-content">

                <!-- HEADER -->

                <div class="modal-header modal-header-dual">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">

                        <span aria-hidden="true">
                            &times;
                        </span>

                    </button>

                    <h4 class="modal-title" id="modalEliminarLabel">

                        <span class="glyphicon glyphicon-warning-sign"></span>

                        Confirmar eliminación

                    </h4>

                </div>

                <!-- BODY -->

                <div class="modal-body text-center">

                    <div class="mensaje-eliminar">

                        <span class="glyphicon glyphicon-trash"
                            style="font-size:35px; color:#e53935; display:block; margin-bottom:15px;">
                        </span>

                        <strong>
                            ¿Realmente deseas eliminar este elemento?
                        </strong>

                        <p class="text-muted">

                            Esta acción no podrá deshacerse.

                        </p>

                    </div>

                    <form action="" method="POST" role="form" id="form_delete">

                        {{ method_field('DELETE') }}

                        {{ csrf_field() }}

                        <input type="hidden" id="eliminar_alumno" name="eliminar_alumno" value="">

                    </form>

                </div>

                <!-- FOOTER -->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">

                        <span class="glyphicon glyphicon-remove"></span>

                        Cancelar

                    </button>

                    <button id="confirma_elimina" type="button" class="btn btn-danger">

                        <span class="glyphicon glyphicon-trash"></span>

                        Eliminar

                    </button>

                </div>

            </div>

        </div>

    </div>


    <!-- =============================================================
         MODAL MATERIAS
    ============================================================== -->

    <form id="form_ver_materias" class="form" role="form" method="POST">

        <div class="modal fade" id="modal_materias" tabindex="-1" role="dialog" aria-labelledby="modalMateriasLabel">

            <div class="modal-dialog modal-lg" role="document">

                <div class="modal-content">

                    <!-- HEADER -->

                    <div class="modal-header modal-header-dual">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">

                            <span aria-hidden="true">
                                &times;
                            </span>

                        </button>

                        <h4 class="modal-title" id="modalMateriasLabel">

                            <span class="glyphicon glyphicon-book"></span>

                            &nbsp; MATERIAS

                        </h4>

                    </div>

                    <!-- BODY -->

                    <div class="modal-body">

                        {{ csrf_field() }}

                        <input type="hidden" id="alumnM" name="alumnM" value="">

                        <input type="hidden" id="materias" name="materias" value="">

                        <div class="row">

                            <div class="col-md-12">

                                <div id="contenedor_materias">

                                    <div class="text-center text-muted" style="padding:30px;">

                                        <span class="glyphicon glyphicon-refresh"></span>

                                        Cargando materias...

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- FOOTER -->

                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">

                            <span class="glyphicon glyphicon-remove"></span>

                            Cancelar

                        </button>

                        <button type="button" class="btn btn-success acepta btn-agregar">

                            <span class="glyphicon glyphicon-save"></span>

                            Agregar

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>

</main>


<script>
$(document).ready(function() {

    /* ============================================================
       DATATABLE
    ============================================================ */

    $('#paginar_tabla').DataTable({

        language: {

            processing: "Procesando...",

            search: "Buscar:",

            lengthMenu: "Mostrar _MENU_ registros",

            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",

            infoEmpty: "Mostrando 0 a 0 de 0 registros",

            infoFiltered: "(filtrado de _MAX_ registros)",

            loadingRecords: "Cargando...",

            zeroRecords: "No se encontraron registros",

            emptyTable: "No hay alumnos registrados",

            paginate: {

                first: "Primero",

                previous: "Anterior",

                next: "Siguiente",

                last: "Último"

            }

        },

        pageLength: 10,

        responsive: true,

        order: [
            [1, 'asc']
        ]

    });


    /* ============================================================
       ABRIR MODAL ELIMINAR
    ============================================================ */

    $("#paginar_tabla").on('click', '.elimina', function() {

        var id_duales_actuales = $(this).data('id_alumno');

        $('#eliminar_alumno').val(id_duales_actuales);

        $('#modal_elimina').modal('show');

    });


    /* ============================================================
       CONFIRMAR ELIMINACIÓN
    ============================================================ */

    $("#confirma_elimina").click(function(event) {

        event.preventDefault();

        var eliminar_alumno = $("#eliminar_alumno").val();

        if (!eliminar_alumno) {

            return;

        }

        $("#form_delete").attr(
            "action",
            "/duales/Eliminar_dual/" + eliminar_alumno
        );

        $("#form_delete").submit();

    });


    /* ============================================================
       ABRIR MODAL DE MATERIAS
    ============================================================ */

    $("#paginar_tabla").on('click', '.materias', function() {

        var id_duales_actuales =
            $(this).data('id_duales_actuales');

        $('#alumnM').val(id_duales_actuales);

        $('#contenedor_materias').html(

            '<div class="text-center text-muted" style="padding:30px;">' +

            '<span class="glyphicon glyphicon-refresh"></span> ' +

            'Cargando materias...' +

            '</div>'

        );

        $('#modal_materias').modal('show');

        $.get(
            "/duales/alumnos/materias/" + id_duales_actuales,
            function(request) {

                $("#contenedor_materias").html(request);

            }
        );

    });


    /* ============================================================
       AGREGAR MATERIAS
    ============================================================ */

    $(".acepta").click(function() {

        var arreglo_materias = [];

        $('input[name="materia[]"]:checked').each(function() {

            arreglo_materias.push($(this).val());

        });


        /* --------------------------------------------------------
           VALIDAR MATERIAS
        -------------------------------------------------------- */

        if (arreglo_materias.length === 0) {

            alert('Debes seleccionar al menos una materia.');

            return false;

        }


        /* --------------------------------------------------------
           GUARDAR MATERIAS
        -------------------------------------------------------- */

        $("#materias").val(
            arreglo_materias.join(',')
        );


        /* --------------------------------------------------------
           EVITAR DOBLE CLIC
        -------------------------------------------------------- */

        $(".acepta")
            .prop('disabled', true)
            .html(
                '<span class="glyphicon glyphicon-refresh"></span> Guardando...'
            );


        /* --------------------------------------------------------
           PETICIÓN
        -------------------------------------------------------- */

        $.post(
            "/duales/agrega/materias_alumnos",
            $("#form_ver_materias").serialize(),
            function(request) {

                window.location.href =
                    '/duales/llenar_carga_academica_dual';

            }
        ).fail(function() {

            $(".acepta")
                .prop('disabled', false)
                .html(
                    '<span class="glyphicon glyphicon-save"></span> Agregar'
                );

            alert(
                'Ocurrió un error al guardar las materias.'
            );

        });

    });

});
</script>

@endsection