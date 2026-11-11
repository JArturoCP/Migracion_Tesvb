@extends('layouts.app')
@section('title', 'Inicio')
@section('content')

<?php
$ver_carga = session()->has('ver_carga') ? session()->has('ver_carga') : false;
$escolar = session()->has('escolar') ? session()->has('escolar') : false;
?>

<style>
    .carga-alerta {
        margin-top: 25px;
        margin-bottom: 25px;
        border-radius: 8px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.12);
        border-width: 0;
        overflow: hidden;
    }

    .carga-alerta .panel-heading {
        font-size: 16px;
        padding: 15px 20px;
    }

    .carga-alerta .panel-body {
        padding: 30px;
        font-size: 15px;
        color: #555;
    }

    .carga-alerta h4 {
        font-weight: 600;
        margin-top: 15px;
        margin-bottom: 15px;
        color: #333;
    }

    .carga-alerta p {
        line-height: 1.7;
    }

    .mensaje-validacion {
        background: #f9f9f9;
        border-left: 4px solid #d9534f;
        padding: 15px;
        text-align: left;
        margin: 20px 0;
    }

    .icono-estado {
        width: 75px;
        height: 75px;
        border-radius: 50%;
        margin: 0 auto 15px auto;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 38px;
    }

    .estado-success {
        background: #dff0d8;
        color: #3c763d;
    }

    .estado-error {
        background: #f2dede;
        color: #a94442;
    }

    .estado-warning {
        background: #fcf8e3;
        color: #8a6d3b;
    }

    .estado-info {
        background: #d9edf7;
        color: #31708f;
    }

    .carga-alerta .alert {
        margin-top: 20px;
        margin-bottom: 0;
        border-radius: 5px;
    }

    .panel-autorizacion {
        margin-top: 25px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.12);
        border-radius: 8px;
        overflow: hidden;
    }

    .panel-autorizacion .panel-heading {
        padding: 15px;
    }

    .panel-autorizacion .panel-body {
        padding: 30px;
    }
</style>

<script>
    $(document).ready(function() {
        $(".elimina").click(function() {
            var id = $(this).attr('id');
            $('#confirma_elimina').data('id', id);
            $('#modal_elimina').modal('show');
        });
        $(".editar_semestre").click(function() {
            var id_semestres_al = $(this).attr('id');
            $.get(
                "/servicios_escolares/actualizar_semestre_al/" + id_semestres_al,
                function(request) {
                    $("#contenedor_actualizar_estudiante").html(request);
                    $("#modal_actualizar_estudiante").modal('show');
                }
            );
        });
        $(".autorizar_semestre").click(function() {
            var id_semestres_al = $(this).attr('id');
            $.get(
                "/servicios_escolares/autorizar_semestre_al/" + id_semestres_al,
                function(request) {
                    $("#contenedor_autorizar_estudiante").html(request);
                    $("#modal_autorizar_estudiante").modal('show');
                }
            );
        });
        $("#aceptar").click(function(event) {
            event.preventDefault();
            $("#formupdate").submit();
        });
        $("#formupdate").validate({
            rules: {
                optradio: {
                    required: true,
                },
                obser: {
                    required: true,
                },
                estado: {
                    required: true,
                },
            },
        });
        $("#confirma_elimina").click(function(event) {
            var id_sit = $(this).data('id');
            $("#form_delete")
                .attr("action", "/checar_carga/" + id_sit);
            $("#form_delete").submit();
        });
        $("#optradio1").change(function() {
            $("#observacion").css("display", "none");
            $("#status").css("display", "inline");
        });
        $("#optradio2").change(function() {
            $("#observacion").css("display", "inline");
            $("#status").css("display", "none");
        });
        $("#guardar_actualizar_estudiante").click(function() {
            $("#form_guardar_mod_semestre").submit();
            $("#guardar_actualizar_estudiante").attr("disabled", true);
        });
        $("#guardar_autorizar_estudiante").click(function() {
            $("#form_autorizar_semestre").submit();
            $("#guardar_autorizar_estudiante").attr("disabled", true);
        });
        $("#guardar_agregar_semestre").click(function() {
            var id_periodo = $("#id_periodo").val();
            if (id_periodo != null) {
                var id_semestre = $("#id_semestre").val();
                if (id_semestre != null) {
                    $("#form_guardar_semestre").submit();
                    $("#guardar_agregar_semestre").attr("disabled", true);
                    swal({
                        position: "top",
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 3500
                    });
                } else {
                    swal({
                        position: "top",
                        type: "error",
                        title: "Selecciona semestre que ingreso",
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            } else {
                swal({
                    position: "top",
                    type: "error",
                    title: "Selecciona periodo que ingreso el estudiante",
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        });
    });
</script>

<main>

    {{-- ===================================================== --}}
    {{-- MODAL AUTORIZAR SEMESTRE --}}
    {{-- ===================================================== --}}

    <div class="modal fade" id="modal_autorizar_estudiante" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                    <h4 class="modal-title">
                        Autorizar registro del estudiante
                    </h4>

                </div>

                <div class="modal-body">

                    <div id="contenedor_autorizar_estudiante"></div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">

                            Cancelar

                        </button>

                        <button id="guardar_autorizar_estudiante" class="btn btn-primary">

                            Aceptar

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- ===================================================== --}}
    {{-- MODAL ACTUALIZAR SEMESTRE --}}
    {{-- ===================================================== --}}

    <div class="modal fade" id="modal_actualizar_estudiante" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                    <h4 class="modal-title">
                        Modificar registro del estudiante
                    </h4>

                </div>

                <div class="modal-body">

                    <div id="contenedor_actualizar_estudiante"></div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">

                            Cancelar

                        </button>

                        <button id="guardar_actualizar_estudiante" class="btn btn-primary">

                            Aceptar

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- ===================================================== --}}
    {{-- TITULO --}}
    {{-- ===================================================== --}}

    <div class="row">

        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-info">

                <div class="panel-heading">

                    <h3 class="panel-title text-center">
                        VER CARGA ACADÉMICA
                    </h3>

                </div>

            </div>

        </div>

    </div>

    {{-- ===================================================== --}}
    {{-- ALUMNO --}}
    {{-- ===================================================== --}}

    @if($usuario == 1)

    @if(isset($validaciones[0]))

    {{-- ============================================= --}}
    {{-- ESTADO 100 --}}
    {{-- ============================================= --}}

    @if($validaciones[0]->estado_validacion == 100)

    <div class="col-md-8 col-md-offset-2">

        <div class="panel panel-info carga-alerta">

            <div class="panel-heading">

                <i class="fa fa-info-circle"></i>

                <strong>Nota importante</strong>

            </div>

            <div class="panel-body text-center">

                <div class="icono-estado estado-info">

                    <i class="fa fa-check-circle"></i>

                </div>

                <h4>
                    ¡Carga académica enviada correctamente!
                </h4>

                <p>
                    Tu carga académica se encuentra en proceso de revisión
                    por el jefe de división.
                </p>

                <p>
                    Después será enviada a la Subdirección de Servicios Escolares.
                    Una vez aprobada, podrás imprimirla.
                </p>

                <span class="label label-info">
                    En proceso de revisión
                </span>

            </div>

        </div>

    </div>

    {{-- ============================================= --}}
    {{-- ESTADO 3 --}}
    {{-- ============================================= --}}

    @elseif($validaciones[0]->estado_validacion == 3)

    <div class="col-md-8 col-md-offset-2">

        <div class="panel panel-danger carga-alerta">

            <div class="panel-heading">

                <i class="fa fa-exclamation-triangle"></i>

                <strong>
                    Se requiere modificar tu carga
                </strong>

            </div>

            <div class="panel-body text-center">

                <div class="icono-estado estado-error">

                    <i class="fa fa-times-circle"></i>

                </div>

                <h4>
                    Tu carga académica tiene observaciones
                </h4>

                <p class="mensaje-validacion">
                    {{ $validaciones[0]->descripcion }}
                </p>

                <div class="alert alert-warning">

                    <i class="fa fa-lightbulb-o"></i>

                    Modifica tu carga académica de acuerdo con
                    la observación antes de volver a enviarla.

                </div>

            </div>

        </div>

    </div>

    {{-- ============================================= --}}
    {{-- ESTADO 0 --}}
    {{-- ============================================= --}}

    @elseif($validaciones[0]->estado_validacion == 0)

    @if($creditoss == 1)

    <div class="col-md-8 col-md-offset-2">

        <div class="panel panel-danger carga-alerta">

            <div class="panel-heading">

                <i class="fa fa-ban"></i>

                <strong>
                    Carga académica no válida
                </strong>

            </div>

            <div class="panel-body text-center">

                <div class="icono-estado estado-error">

                    <i class="fa fa-exclamation-circle"></i>

                </div>

                <h4>
                    Has excedido el máximo de créditos
                </h4>

                <p>
                    El máximo permitido es de
                    <strong>38 créditos</strong>.
                </p>

                <p>
                    Verifica y modifica tu carga académica
                    para poder enviarla.
                </p>

            </div>

        </div>

    </div>

    @elseif($creditoss == 2)

    <div class="col-md-8 col-md-offset-2">

        <div class="panel panel-warning carga-alerta">

            <div class="panel-heading">

                <i class="fa fa-exclamation-triangle"></i>

                <strong>
                    Créditos insuficientes
                </strong>

            </div>

            <div class="panel-body text-center">

                <div class="icono-estado estado-warning">

                    <i class="fa fa-arrow-down"></i>

                </div>

                <h4>
                    No alcanzas el mínimo de créditos
                </h4>

                <p>
                    El mínimo permitido es de
                    <strong>22 créditos</strong>.
                </p>

                <p>
                    Verifica tu carga académica para poder enviarla.
                </p>

            </div>

        </div>

    </div>

    @elseif($creditoss == 4)

    <div class="col-md-8 col-md-offset-2">

        <div class="panel panel-danger carga-alerta">

            <div class="panel-heading">

                <i class="fa fa-book"></i>

                <strong>
                    Límite de créditos con materia especial
                </strong>

            </div>

            <div class="panel-body text-center">

                <div class="icono-estado estado-error">

                    <i class="fa fa-exclamation-circle"></i>

                </div>

                <h4>
                    Has excedido el límite permitido
                </h4>

                <p>
                    El máximo de créditos con una materia especial
                    es de <strong>22 créditos</strong>.
                </p>

                <p>
                    Debes modificar tu carga académica
                    antes de enviarla.
                </p>

            </div>

        </div>

    </div>

    @elseif($creditoss == 5)

    <div class="col-md-8 col-md-offset-2">

        <div class="panel panel-danger carga-alerta">

            <div class="panel-heading">

                <i class="fa fa-bookmark"></i>

                <strong>
                    Límite de materias especiales
                </strong>

            </div>

            <div class="panel-body text-center">

                <div class="icono-estado estado-error">

                    <i class="fa fa-times-circle"></i>

                </div>

                <h4>
                    Has excedido el número de materias especiales
                </h4>

                <p>
                    Solamente puedes dar de alta
                    <strong>dos materias especiales o menos</strong>.
                </p>

                <p>
                    Modifica tu carga académica para poder enviarla.
                </p>

            </div>

        </div>

    </div>

    @elseif($creditoss == 6)

    <div class="col-md-8 col-md-offset-2">

        <div class="panel panel-danger carga-alerta">

            <div class="panel-heading">

                <i class="fa fa-bookmark-o"></i>

                <strong>
                    Materias especiales
                </strong>

            </div>

            <div class="panel-body text-center">

                <div class="icono-estado estado-error">

                    <i class="fa fa-exclamation-circle"></i>

                </div>

                <h4>
                    Límite de materias especiales
                </h4>

                <p>
                    Solamente puedes dar de alta
                    <strong>dos materias especiales</strong>.
                </p>

                <p>
                    No puedes tomar materias
                    <strong>Normales</strong>.
                </p>

                <p>
                    Debes modificar tu carga académica
                    para poder enviarla.
                </p>

            </div>

        </div>

    </div>

    @else

    <div class="col-md-8 col-md-offset-2">

        <div class="panel panel-success carga-alerta">

            <div class="panel-heading">

                <i class="fa fa-check"></i>

                <strong>
                    Carga académica válida
                </strong>

            </div>

            <div class="panel-body text-center">

                <div class="icono-estado estado-success">

                    <i class="fa fa-check-circle"></i>

                </div>

                <h4>
                    ¡Todo está correcto!
                </h4>

                <p>
                    Tu carga académica cumple con las condiciones
                    necesarias para ser enviada.
                </p>

                <div class="alert alert-success">

                    <i class="fa fa-send"></i>

                    <strong>
                        Puedes enviar tu carga académica
                        al departamento de Servicios Escolares.
                    </strong>

                </div>

            </div>

        </div>

    </div>

    @endif

    @endif

    @else

    <div class="col-md-8 col-md-offset-2">

        <div class="panel panel-warning carga-alerta">

            <div class="panel-heading">

                <i class="fa fa-question-circle"></i>

                <strong>
                    Información no disponible
                </strong>

            </div>

            <div class="panel-body text-center">

                <div class="icono-estado estado-warning">

                    <i class="fa fa-info-circle"></i>

                </div>

                <h4>
                    No se encontró información de validación
                </h4>

                <p>
                    No fue posible determinar el estado de tu carga académica.
                </p>

            </div>

        </div>

    </div>

    @endif

    @endif

    {{-- ===================================================== --}}
    {{-- SERVICIOS ESCOLARES --}}
    {{-- ===================================================== --}}

    @if($usuario == 2)

    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-primary">

                <h4 style="text-align: center;">
                    {{ $cuenta_y_nom }}
                </h4>

            </div>

        </div>

    </div>

    {{-- ================================================= --}}
    {{-- ESTADO NORMAL = 1 --}}
    {{-- ================================================= --}}

    @if(isset($validaciones[0]) &&
    $validaciones[0]->estado_validacion == 1)

    @if($adeudo == 0)

    <div class="col-md-6 col-md-offset-3">

        <div class="panel panel-success">

            <div class="panel-heading">

                <h3 class="panel-title text-center">
                    No tiene adeudo
                </h3>

            </div>

        </div>

    </div>

    @else

    <div class="col-md-6 col-md-offset-3">

        <div class="panel panel-danger">

            <div class="panel-heading">

                <h3 class="panel-title text-center">

                    Tiene adeudo con los siguientes
                    departamentos o carreras:

                </h3>

                <br>

                @foreach($departamento_carrera as $departamento_carrera)

                <p style="text-align: center">

                    {{ $departamento_carrera['nombre'] }}
                    :-
                    {{ $departamento_carrera['comentario'] }}

                </p>

                @endforeach

            </div>

        </div>

    </div>

    @endif

    {{-- ============================================= --}}
    {{-- DATOS DEL SEMESTRE --}}
    {{-- ============================================= --}}

    @if($escolar == true)

    @if($estado_sem_act == 0)

    <div class="row">

        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-primary">

                <div class="panel-body">

                    <form id="form_guardar_semestre"
                        action="{{ url('/servicios_escolares/guardar_semestre_al/'.$alumno.'/2') }}" role="form"
                        method="POST" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="row">

                            <div class="col-md-10 col-md-offset-1">

                                <label>
                                    Selecciona periodo que ingreso
                                    el estudiante al TESVB
                                </label>

                                <select class="form-control" id="id_periodo" name="id_periodo" required>

                                    <option disabled selected hidden>
                                        Selecciona una opción
                                    </option>

                                    @foreach($periodos as $periodo)

                                    <option value="{{ $periodo->id_periodo }}">

                                        {{ $periodo->periodo }}

                                    </option>

                                    @endforeach

                                </select>

                                <br>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-10 col-md-offset-1">

                                <label>
                                    Selecciona el semestre que ingreso
                                    el estudiante al TESVB
                                </label>

                                <select class="form-control" id="id_semestre" name="id_semestre" required>

                                    <option disabled selected hidden>
                                        Selecciona una opción
                                    </option>

                                    @foreach($semestres as $semestre)

                                    <option value="{{ $semestre->id_semestre }}">

                                        {{ $semestre->descripcion }}

                                    </option>

                                    @endforeach

                                </select>

                                <br>

                            </div>

                        </div>

                    </form>

                    <div class="row">

                        <div class="col-md-2 col-md-offset-5">

                            <button id="guardar_agregar_semestre" class="btn btn-primary">

                                Guardar

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    @else

    @if($datos_actu->id_estado_rev == 2)

    <div class="row">

        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-primary">

                <div class="panel-body">

                    <h4>
                        Periodo que ingreso el estudiante al TESVB:
                        <b>{{ $datos_actu->periodo }}</b>
                    </h4>

                    <h4>
                        Semestre que ingreso el estudiante al TESVB:
                        <b>{{ $datos_actu->semestre }}</b>
                    </h4>

                    <p style="text-align: right">

                        <button class="btn btn-success autorizar_semestre" id="{{ $datos_actu->id_semestres_al }}">

                            Autorizar

                        </button>

                        <button class="btn btn-primary editar_semestre" id="{{ $datos_actu->id_semestres_al }}">

                            <span class="glyphicon glyphicon-cog"></span>

                        </button>

                    </p>

                </div>

            </div>

        </div>

    </div>

    @elseif($datos_actu->id_estado_rev == 1)

    <form class="form-horizontal" role="form" method="POST" action="/validacion_de_carga/{{ $id }}" novalidate
        id="formupdate">

        <input type="hidden" name="_method" value="PUT" />

        {{ csrf_field() }}

        <div class="row">

            <div class="col-md-4 col-md-offset-4 alert alert-success">

                <p style="text-align: center">

                    <label class="radio-inline">

                        <input type="radio" id="optradio1" name="optradio" value="1">

                        Autorizar

                    </label>

                    <label class="radio-inline">

                        <input type="radio" id="optradio2" name="optradio" value="2">

                        No autorizar

                    </label>

                </p>

                <div id="status" style="display: none">

                    <label>
                        Estado del alumno
                        <b style="color:red; font-size:23px;">*</b>
                    </label>

                    <select class="form-control" name="estado" id="estado" required>

                        <option disabled selected hidden>
                            Selecciona una opción
                        </option>

                        <option value="1">
                            NORMAL
                        </option>

                        <option value="2">
                            DUAL NUEVA VERSIÓN
                        </option>

                    </select>

                </div>

                <div id="observacion" style="display: none">

                    <label>
                        Observaciones:
                    </label>

                    <textarea class="form-control rounded-0" id="obser" rows="2" name="obser"></textarea>

                </div>

                <p style="text-align: center">

                    <button class="btn btn-primary" id="aceptar">

                        Aceptar

                    </button>

                </p>

            </div>

        </div>

    </form>

    @endif

    @endif

    @endif

    @endif

    {{-- ================================================= --}}
    {{-- ⭐ ESTADO 888 - DUAL --}}
    {{-- ================================================= --}}
    {{-- IMPORTANTE:
             ESTE IF ESTÁ FUERA DEL IF estado_validacion == 1
             PARA QUE EL DUAL PUEDA APARECER --}}
    {{-- ================================================= --}}

    @if(isset($validaciones[0]) &&
    $validaciones[0]->estado_validacion == 888)

    <div class="row">

        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-success panel-autorizacion">

                <div class="panel-heading">

                    <h4 class="text-center">

                        <span class="glyphicon glyphicon-check"></span>

                        Autorizar Carga Académica DUAL

                    </h4>

                </div>

                <div class="panel-body text-center">

                    <div class="icono-estado estado-success">

                        <span class="glyphicon glyphicon-ok"></span>

                    </div>

                    <h4>
                        Carga DUAL lista para autorización
                    </h4>

                    <p>
                        El Jefe de División ha dado de alta y revisado
                        la carga académica de este estudiante DUAL.
                    </p>

                    <p>
                        La carga se encuentra pendiente de autorización
                        por Servicios Escolares.
                    </p>

                    <hr>

                    <form method="POST" action="{{ url('/autorizar_carga_dual/'.$id) }}">

                        {{ csrf_field() }}

                        {{ method_field('PUT') }}

                        <button type="submit" class="btn btn-success btn-lg">

                            <span class="glyphicon glyphicon-ok"></span>

                            Autorizar carga DUAL

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

    @endif

    @endif

    {{-- ===================================================== --}}
    {{-- MENSAJE DE CARGA CREADA --}}
    {{-- ===================================================== --}}

    @if(isset($validaciones[0]))

    <div class="row">

        @if($validaciones[0]->estado_validacion == 0)

        @if($creditoss == 3)

        <div class="col-md-5 col-md-offset-3">

            <label class="alert alert-success">

                Tu carga académica se creó correctamente,
                verifica si tus materias son las que tomarás
                en el semestre, si es así, dar clic en enviar.

            </label>

        </div>

        @endif

        @if($creditoss == 5)

        <div class="col-md-5 col-md-offset-3">

            <label class="alert alert-success">

                Tu carga académica se creó correctamente,
                verifica si tus materias son las que tomarás
                en el semestre, si es así, dar clic en enviar.

            </label>

        </div>

        @endif

        @endif

    </div>

    @endif

    {{-- ===================================================== --}}
    {{-- ESTADOS DE CARGA --}}
    {{-- ===================================================== --}}

    @if($usuario == 1)

    @if(isset($validaciones[0]))

    @if($validaciones[0]->estado_validacion == 1)

    <div class="row">

        <div class="col-md-4 col-md-offset-4 alert alert-success">

            <strong>

                La carga académica se envió correctamente,
                está en proceso de revisión por la Subdirección
                de Servicios Escolares, una vez aprobada podrás imprimirla.

            </strong>

            <p style="text-align: center">

                <button type="button" class="btn btn-default" disabled>

                    <span class="glyphicon glyphicon-print"></span>

                </button>

            </p>

        </div>

    </div>

    @elseif(
    $validaciones[0]->estado_validacion == 2 ||
    $validaciones[0]->estado_validacion == 8 ||
    $validaciones[0]->estado_validacion == 9
    )

    <div class="row">

        <div class="col-md-3 col-md-offset-4 alert alert-success">

            <p style="text-align: center">

                <strong>
                    Carga Académica Aceptada
                </strong>

            </p>

            <p style="text-align: center">

                <a href="/imprime_carga" target="_blank">

                    <span class="glyphicon glyphicon-print"></span>

                </a>

            </p>

            <p style="text-align: center">

                <a href="/imprime_carga">

                    <strong>
                        Imprimir
                    </strong>

                </a>

            </p>

        </div>

    </div>

    @endif

    @endif

    @endif

    @if($usuario == 2)

    @if($ls == 2 || $ls == 8 || $ls == 9)

    <div class="col-md-3 col-md-offset-4 alert alert-success">

        <p style="text-align: center">

            <strong>
                Carga Académica Aceptada
            </strong>

        </p>

        <p style="text-align: center">

            <a href="/imprime_control/{{$id_alumno}}" target="_blank">

                <span class="glyphicon glyphicon-print"></span>

            </a>

        </p>

        <p style="text-align: center">

            <a href="/imprime_control/{{$id_alumno}}">

                <strong>
                    Imprimir
                </strong>

            </a>

        </p>

    </div>

    @endif

    @endif

    {{-- ===================================================== --}}
    {{-- TABLA DE CARGA --}}
    {{-- ===================================================== --}}

    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <table class="table table-bordered" style="background: white;">

                <thead class="bg bg-info">
                    <tr>
                        <th class="text-center">NOMBRE DEL PROFESOR</th>
                        <th class="text-center">CLAVE DE LA MATERIA</th>
                        <th class="text-center">NOMBRE DE LA MATERIA</th>
                        <th class="text-center">CREDITOS</th>
                        <th class="text-center">STATUS</th>
                        <th class="text-center">TIPO CURSA</th>
                        <th class="text-center">GRUPO</th>
                        @if($validaciones[0]->estado_validacion == 0 || $validaciones[0]->estado_validacion == 3 ||
                        $validaciones[0]->estado_validacion == 4 )
                        <th class="text-center">ELIMINAR</th>
                        <th class="text-center">MODIFICAR</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($datos_carga as $consulta)
                    @if($consulta['id_materia'] == 2258)
                    <tr>
                        <th></th>
                        <th class="text-center">{{ $consulta['clave'] }}</th>
                        <td class="text-center">{{ $consulta['nombre'] }}</td>
                        <td></td>
                        <td class="text-center">ALTA</td>
                        <td></td>
                        <td></td>
                        @if($validaciones[0]->estado_validacion == 0 || $validaciones[0]->estado_validacion == 3 ||
                        $validaciones[0]->estado_validacion == 4)
                        <th>
                            <a class="elimina" id="{{ $consulta['id_carga_academica'] }}">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </th>
                        <th></th>
                        @endif
                    </tr>
                    @else
                    <tr>
                        <th>
                            @foreach($consulta['profesores'] as $profesor)
                            <p class="text-center">
                                @if(is_object($profesor))
                                {{ $profesor->titulo ?? '' }}
                                {{ $profesor->docente ?? $profesor->nombre_profesor ?? '' }}
                                @else
                                {{ $profesor['titulo'] ?? '' }}
                                {{ $profesor['nombre_profesor'] ?? $profesor['docente'] ?? '' }}
                                @endif
                            </p>
                            @endforeach

                        </th>
                        <th class="text-center">{{ $consulta['clave'] }}</th>
                        <td class="text-center">{{ $consulta['nombre'] }}</td>
                        <td class="text-center">{{ $consulta['creditos'] }}</td>
                        <td class="text-center">{{ $consulta['nombre_status'] }}</td>
                        <td class="text-center">{{ $consulta['nombre_curso'] }}</td>
                        <td class="text-center">{{ $consulta['id_semestre'] }}0{{ $consulta['grupo'] }}</td>
                        @if($validaciones[0]->estado_validacion == 0 || $validaciones[0]->estado_validacion == 3 ||
                        $validaciones[0]->estado_validacion == 4)
                        <th>
                            <a class="elimina" id="{{ $consulta['id_carga_academica'] }}">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </th>
                        <th>
                            <a href="/checar_carga/{{ $consulta['id_carga_academica'] }}/edit">
                                <span class="glyphicon glyphicon-cog"></span>
                            </a>
                        </th>
                        @endif
                    </tr>
                    @endif
                    @endforeach
                    <tr>
                        <th></th>
                        <th></th>
                        <td class="text-center"><strong>Total de creditos:</strong></td>
                        <td class="text-center">{{ $suma }}</td>
                        <td></td>
                        @if($validaciones[0]->estado_validacion == 0 || $validaciones[0]->estado_validacion == 3 ||
                        $validaciones[0]->estado_validacion == 4)
                        <td></td>
                        <td></td>
                        @endif
                        @if($usuario == 2)
                        <td></td>
                        <td></td>
                        @else
                        @if($ver_carga == false)
                        <td></td>
                        <td></td>
                        @endif
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- ===================================================== --}}
    {{-- BOTON ENVIAR CARGA --}}
    {{-- ===================================================== --}}

    @if(
    $validaciones[0]->estado_validacion == 0 ||
    $validaciones[0]->estado_validacion == 3 ||
    $validaciones[0]->estado_validacion == 4
    )

    @if($usuario == 1)

    @if($creditoss == 3 || $creditoss == 7)

    @if($datos_alumn->id_carrera == 3)

    <div class="row">

        <div class="col-md-2 col-md-offset-5">

            <div class="text-center">

                <button type="button" class="btn btn-success btn-lg btn-block"
                    onclick="window.location='{{ url('/enviar_carga_jefe_division/'.$id_alu) }}'" title="Enviar">

                    Enviar al jefe de división

                </button>

            </div>

        </div>

    </div>

    @else

    <div class="row">

        <div class="col-md-2 col-md-offset-5">

            <div class="text-center">

                <button type="button" class="btn btn-success btn-lg btn-block"
                    onclick="window.location='{{ url('/enviar_carga/'.$id_alu) }}'" title="Enviar">

                    Enviar

                </button>

            </div>

        </div>

    </div>

    @endif

    @endif

    @if(
    $creditoss == 1 ||
    $creditoss == 2 ||
    $creditoss == 4 ||
    $creditoss == 5 ||
    $creditoss == 6
    )

    <div class="row">

        <div class="col-md-2 col-md-offset-5">

            <div class="text-center">

                <button type="button" class="btn btn-success btn-lg btn-block" title="Enviar" disabled>

                    Enviar

                </button>

            </div>

        </div>

    </div>

    @endif

    @endif

    @endif

    {{-- ===================================================== --}}
    {{-- EDITAR CARGA --}}
    {{-- ===================================================== --}}

    @if(isset($edit))

    @section('editar_carga')

    @include('evaluacion_docente.Alumnos.editar_carga')

    @show

    @endif

</main>

{{-- ===================================================== --}}
{{-- MODAL ELIMINAR --}}
{{-- ===================================================== --}}

<div id="modal_elimina" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel">

    <div class="modal-dialog modal-sm" role="document">

        <div class="modal-content">

            <div class="modal-body">

                <form action="" method="POST" role="form" id="form_delete">

                    {{ method_field('DELETE') }}

                    {{ csrf_field() }}

                    ¿Realmente deseas eliminar este elemento?

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">

                    Cancelar

                </button>

                <input id="confirma_elimina" type="button" class="btn btn-danger" value="Aceptar">

            </div>

            </form>

        </div>

    </div>

</div>

{{-- ===================================================== --}}
{{-- BOTON FLOTANTE --}}
{{-- ===================================================== --}}

@if(
$validaciones[0]->estado_validacion == 0 ||
$validaciones[0]->estado_validacion == 3 ||
$validaciones[0]->estado_validacion == 4
)

<div>

    <a class="btn btn-primary flotante" id="enviar" type="button" href="/carga_academica">

        <span class="glyphicon glyphicon-plus"></span>

    </a>

</div>

@endif

@endsection