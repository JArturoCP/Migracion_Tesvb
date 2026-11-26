@extends('layouts.panel')
@section('title', 'Inicio')
@include('partials.panel.recursos_app', ['validacion' => true])
@section('content')
<div class="tw-pantalla">

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

<main class="tw:flex tw:flex-wrap tw:gap-y-4">

    {{-- ===================================================== --}}
    {{-- MODAL AUTORIZAR SEMESTRE --}}
    {{-- ===================================================== --}}

    <x-panel.modal id="modal_autorizar_estudiante" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">

                    

                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                        Autorizar registro del estudiante
                    </h4>

                </div>

                <div class="tw-modal-cuerpo">

                    <div id="contenedor_autorizar_estudiante"></div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">

                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">

                            Cancelar

                        </button>

                        <button id="guardar_autorizar_estudiante" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">

                            Aceptar

                        </button>

                    </div>

                </div>

            </x-panel.modal>

    {{-- ===================================================== --}}
    {{-- MODAL ACTUALIZAR SEMESTRE --}}
    {{-- ===================================================== --}}

    <x-panel.modal id="modal_actualizar_estudiante" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">

                    

                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                        Modificar registro del estudiante
                    </h4>

                </div>

                <div class="tw-modal-cuerpo">

                    <div id="contenedor_actualizar_estudiante"></div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">

                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">

                            Cancelar

                        </button>

                        <button id="guardar_actualizar_estudiante" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">

                            Aceptar

                        </button>

                    </div>

                </div>

            </x-panel.modal>

    {{-- ===================================================== --}}
    {{-- TITULO --}}
    {{-- ===================================================== --}}

    <x-panel.encabezado titulo="Ver carga académica" :migas="['Estudiantes' => null]" />

    {{-- ===================================================== --}}
    {{-- ALUMNO --}}
    {{-- ===================================================== --}}

    @if($usuario == 1)

    @if(isset($validaciones[0]))

    {{-- ============================================= --}}
    {{-- ESTADO 100 --}}
    {{-- ============================================= --}}

    @if($validaciones[0]->estado_validacion == 100)

    <div class="tw:w-full tw:px-2">

        <div class="carga-alerta tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">

                <i class="fa fa-info-circle"></i>

                <strong>Nota importante</strong>

            </div>

            <div class="tw:p-5 tw:sm:p-6 tw:text-center">

                <div class="icono-estado estado-info">

                    <i class="fa fa-check-circle"></i>

                </div>

                <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
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

                <span class="tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:bg-sky-50 tw:text-sky-600">
                    En proceso de revisión
                </span>

            </div>

        </div>

    </div>

    {{-- ============================================= --}}
    {{-- ESTADO 3 --}}
    {{-- ============================================= --}}

    @elseif($validaciones[0]->estado_validacion == 3)

    <div class="tw:w-full tw:px-2">

        <div class="carga-alerta tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">

                <i class="fa fa-exclamation-triangle"></i>

                <strong>
                    Se requiere modificar tu carga
                </strong>

            </div>

            <div class="tw:p-5 tw:sm:p-6 tw:text-center">

                <div class="icono-estado estado-error">

                    <i class="fa fa-times-circle"></i>

                </div>

                <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                    Tu carga académica tiene observaciones
                </h4>

                <p class="mensaje-validacion">
                    {{ $validaciones[0]->descripcion }}
                </p>

                <x-panel.alerta tipo="advertencia" class="tw:mb-4">

                    <i class="fa fa-lightbulb-o"></i>

                    Modifica tu carga académica de acuerdo con
                    la observación antes de volver a enviarla.

                </x-panel.alerta>

            </div>

        </div>

    </div>

    {{-- ============================================= --}}
    {{-- ESTADO 0 --}}
    {{-- ============================================= --}}

    @elseif($validaciones[0]->estado_validacion == 0)

    @if($creditoss == 1)

    <div class="tw:w-full tw:px-2">

        <div class="carga-alerta tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">

                <i class="fa fa-ban"></i>

                <strong>
                    Carga académica no válida
                </strong>

            </div>

            <div class="tw:p-5 tw:sm:p-6 tw:text-center">

                <div class="icono-estado estado-error">

                    <i class="fa fa-exclamation-circle"></i>

                </div>

                <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
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

    <div class="tw:w-full tw:px-2">

        <div class="carga-alerta tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">

                <i class="fa fa-exclamation-triangle"></i>

                <strong>
                    Créditos insuficientes
                </strong>

            </div>

            <div class="tw:p-5 tw:sm:p-6 tw:text-center">

                <div class="icono-estado estado-warning">

                    <i class="fa fa-arrow-down"></i>

                </div>

                <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
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

    <div class="tw:w-full tw:px-2">

        <div class="carga-alerta tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">

                <i class="fa fa-book"></i>

                <strong>
                    Límite de créditos con materia especial
                </strong>

            </div>

            <div class="tw:p-5 tw:sm:p-6 tw:text-center">

                <div class="icono-estado estado-error">

                    <i class="fa fa-exclamation-circle"></i>

                </div>

                <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
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

    <div class="tw:w-full tw:px-2">

        <div class="carga-alerta tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">

                <i class="fa fa-bookmark"></i>

                <strong>
                    Límite de materias especiales
                </strong>

            </div>

            <div class="tw:p-5 tw:sm:p-6 tw:text-center">

                <div class="icono-estado estado-error">

                    <i class="fa fa-times-circle"></i>

                </div>

                <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
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

    <div class="tw:w-full tw:px-2">

        <div class="carga-alerta tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">

                <i class="fa fa-bookmark-o"></i>

                <strong>
                    Materias especiales
                </strong>

            </div>

            <div class="tw:p-5 tw:sm:p-6 tw:text-center">

                <div class="icono-estado estado-error">

                    <i class="fa fa-exclamation-circle"></i>

                </div>

                <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
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

    <div class="tw:w-full tw:px-2">

        <div class="carga-alerta tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">

                <i class="fa fa-check"></i>

                <strong>
                    Carga académica válida
                </strong>

            </div>

            <div class="tw:p-5 tw:sm:p-6 tw:text-center">

                <div class="icono-estado estado-success">

                    <i class="fa fa-check-circle"></i>

                </div>

                <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                    ¡Todo está correcto!
                </h4>

                <p>
                    Tu carga académica cumple con las condiciones
                    necesarias para ser enviada.
                </p>

                <x-panel.alerta tipo="exito" class="tw:mb-4">

                    <i class="fa fa-send"></i>

                    <strong>
                        Puedes enviar tu carga académica
                        al departamento de Servicios Escolares.
                    </strong>

                </x-panel.alerta>

            </div>

        </div>

    </div>

    @endif

    @endif

    @else

    <div class="tw:w-full tw:px-2">

        <div class="carga-alerta tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">

                <i class="fa fa-question-circle"></i>

                <strong>
                    Información no disponible
                </strong>

            </div>

            <div class="tw:p-5 tw:sm:p-6 tw:text-center">

                <div class="icono-estado estado-warning">

                    <i class="fa fa-info-circle"></i>

                </div>

                <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
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

    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:px-2">

            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center" >
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

    <div class="tw:w-full tw:px-2">

        <x-panel.alerta tipo="exito" class="tw:mb-4">No tiene adeudo</x-panel.alerta>

    </div>

    @else

    <div class="tw:w-full tw:px-2">

        <x-panel.alerta tipo="error" class="tw:mb-4">Tiene adeudo con los siguientes
                    departamentos o carreras:

                

                <br>

                @foreach($departamento_carrera as $departamento_carrera)

                <p class="tw:text-center" >

                    {{ $departamento_carrera['nombre'] }}
                    :-
                    {{ $departamento_carrera['comentario'] }}

                </p>

                @endforeach</x-panel.alerta>

    </div>

    @endif

    {{-- ============================================= --}}
    {{-- DATOS DEL SEMESTRE --}}
    {{-- ============================================= --}}

    @if($escolar == true)

    @if($estado_sem_act == 0)

    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:px-2">

            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                <div class="tw:p-5 tw:sm:p-6">

                    <form id="form_guardar_semestre"
                        action="{{ url('/servicios_escolares/guardar_semestre_al/'.$alumno.'/2') }}" role="form"
                        method="POST" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                            <div class="tw:w-full tw:px-2">

                                <label>
                                    Selecciona periodo que ingreso
                                    el estudiante al TESVB
                                </label>

                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="id_periodo" name="id_periodo" required>

                                    <option disabled selected hidden>
                                        Selecciona una opción
                                    </option>

                                    @foreach($periodos as $periodo)

                                    <option value="{{ $periodo->id_periodo }}">

                                        {{ $periodo->periodo }}

                                    </option>

                                    @endforeach

                                </select>


                            </div>

                        </div>

                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                            <div class="tw:w-full tw:px-2">

                                <label>
                                    Selecciona el semestre que ingreso
                                    el estudiante al TESVB
                                </label>

                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="id_semestre" name="id_semestre" required>

                                    <option disabled selected hidden>
                                        Selecciona una opción
                                    </option>

                                    @foreach($semestres as $semestre)

                                    <option value="{{ $semestre->id_semestre }}">

                                        {{ $semestre->descripcion }}

                                    </option>

                                    @endforeach

                                </select>


                            </div>

                        </div>

                    </form>

                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                        <div class="tw:w-full tw:px-2">

                            <button id="guardar_agregar_semestre" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">

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

    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:px-2">

            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                <div class="tw:p-5 tw:sm:p-6">

                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                        Periodo que ingreso el estudiante al TESVB:
                        <b>{{ $datos_actu->periodo }}</b>
                    </h4>

                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                        Semestre que ingreso el estudiante al TESVB:
                        <b>{{ $datos_actu->semestre }}</b>
                    </h4>

                    <p class="tw:text-right" >

                        <button class="autorizar_semestre tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="{{ $datos_actu->id_semestres_al }}">

                            Autorizar

                        </button>

                        <button class="editar_semestre tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" id="{{ $datos_actu->id_semestres_al }}"><span class="fa fa-cog"></span></button>

                    </p>

                </div>

            </div>

        </div>

    </div>

    @elseif($datos_actu->id_estado_rev == 1)

    <form class="tw:w-full" role="form" method="POST" action="/validacion_de_carga/{{ $id }}" novalidate
        id="formupdate">

        <input type="hidden" name="_method" value="PUT" />

        {{ csrf_field() }}

        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

            <div class="tw:w-full tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800 tw:px-2">

                <p class="tw:text-center" >

                    <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300">

                        <input type="radio" id="optradio1" name="optradio" value="1">

                        Autorizar

                    </label>

                    <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300">

                        <input type="radio" id="optradio2" name="optradio" value="2">

                        No autorizar

                    </label>

                </p>

                <div id="status" style="display: none">

                    <label>
                        Estado del alumno
                        <b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg" >*</b>
                    </label>

                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="estado" id="estado" required>

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

                    <textarea class="rounded-0 tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="obser" rows="2" name="obser"></textarea>

                </div>

                <p class="tw:text-center" >

                    <button class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="aceptar">

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

    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:px-2">

            <div class="panel-autorizacion tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">

                    <h4 class="tw:text-center tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">

                        <span class="fa fa-check-square-o"></span>

                        Autorizar Carga Académica DUAL

                    </h4>

                </div>

                <div class="tw:p-5 tw:sm:p-6 tw:text-center">

                    <div class="icono-estado estado-success">

                        <span class="fa fa-check"></span>

                    </div>

                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
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

                        <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">

                            <span class="fa fa-check"></span>

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

    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        @if($validaciones[0]->estado_validacion == 0)

        @if($creditoss == 3)

        <div class="tw:w-full tw:px-2">

            <label class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800">

                Tu carga académica se creó correctamente,
                verifica si tus materias son las que tomarás
                en el semestre, si es así, dar clic en enviar.

            </label>

        </div>

        @endif

        @if($creditoss == 5)

        <div class="tw:w-full tw:px-2">

            <label class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800">

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

    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800 tw:px-2">

            <strong>

                La carga académica se envió correctamente,
                está en proceso de revisión por la Subdirección
                de Servicios Escolares, una vez aprobada podrás imprimirla.

            </strong>

            <p class="tw:text-center" >

                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:size-9 tw:text-base" disabled><span class="fa fa-print"></span></button>

            </p>

        </div>

    </div>

    @elseif(
    $validaciones[0]->estado_validacion == 2 ||
    $validaciones[0]->estado_validacion == 8 ||
    $validaciones[0]->estado_validacion == 9
    )

    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800 tw:px-2">

            <p class="tw:text-center" >

                <strong>
                    Carga Académica Aceptada
                </strong>

            </p>

            <p class="tw:text-center" >

                <a class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" href="/imprime_carga" target="_blank"><span class="fa fa-print"></span></a>

            </p>

            <p class="tw:text-center" >

                <a class="tw:text-brand-500 tw:hover:underline" href="/imprime_carga">

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

    <div class="tw:w-full tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800 tw:px-2">

        <p class="tw:text-center" >

            <strong>
                Carga Académica Aceptada
            </strong>

        </p>

        <p class="tw:text-center" >

            <a class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" href="/imprime_control/{{$id_alumno}}" target="_blank"><span class="fa fa-print"></span></a>

        </p>

        <p class="tw:text-center" >

            <a class="tw:text-brand-500 tw:hover:underline" href="/imprime_control/{{$id_alumno}}">

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

    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:px-2">

            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">

                <thead class="bg tw:bg-sky-100">
                    <tr>
                        <th class="tw:text-center">NOMBRE DEL PROFESOR</th>
                        <th class="tw:text-center">CLAVE DE LA MATERIA</th>
                        <th class="tw:text-center">NOMBRE DE LA MATERIA</th>
                        <th class="tw:text-center">CREDITOS</th>
                        <th class="tw:text-center">STATUS</th>
                        <th class="tw:text-center">TIPO CURSA</th>
                        <th class="tw:text-center">GRUPO</th>
                        @if($validaciones[0]->estado_validacion == 0 || $validaciones[0]->estado_validacion == 3 ||
                        $validaciones[0]->estado_validacion == 4 )
                        <th class="tw:text-center">ELIMINAR</th>
                        <th class="tw:text-center">MODIFICAR</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($datos_carga as $consulta)
                    @if($consulta['id_materia'] == 2258)
                    <tr>
                        <th></th>
                        <th class="tw:text-center">{{ $consulta['clave'] }}</th>
                        <td class="tw:text-center">{{ $consulta['nombre'] }}</td>
                        <td></td>
                        <td class="tw:text-center">ALTA</td>
                        <td></td>
                        <td></td>
                        @if($validaciones[0]->estado_validacion == 0 || $validaciones[0]->estado_validacion == 3 ||
                        $validaciones[0]->estado_validacion == 4)
                        <th>
                            <a class="elimina tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" id="{{ $consulta['id_carga_academica'] }}"><span class="fa fa-trash"></span></a>
                        </th>
                        <th></th>
                        @endif
                    </tr>
                    @else
                    <tr>
                        <th>
                            @foreach($consulta['profesores'] as $profesor)
                            <p class="tw:text-center">
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
                        <th class="tw:text-center">{{ $consulta['clave'] }}</th>
                        <td class="tw:text-center">{{ $consulta['nombre'] }}</td>
                        <td class="tw:text-center">{{ $consulta['creditos'] }}</td>
                        <td class="tw:text-center">{{ $consulta['nombre_status'] }}</td>
                        <td class="tw:text-center">{{ $consulta['nombre_curso'] }}</td>
                        <td class="tw:text-center">{{ $consulta['id_semestre'] }}0{{ $consulta['grupo'] }}</td>
                        @if($validaciones[0]->estado_validacion == 0 || $validaciones[0]->estado_validacion == 3 ||
                        $validaciones[0]->estado_validacion == 4)
                        <th>
                            <a class="elimina tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" id="{{ $consulta['id_carga_academica'] }}"><span class="fa fa-trash"></span></a>
                        </th>
                        <th>
                            <a class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" href="/checar_carga/{{ $consulta['id_carga_academica'] }}/edit"><span class="fa fa-cog"></span></a>
                        </th>
                        @endif
                    </tr>
                    @endif
                    @endforeach
                    <tr>
                        <th></th>
                        <th></th>
                        <td class="tw:text-center"><strong>Total de creditos:</strong></td>
                        <td class="tw:text-center">{{ $suma }}</td>
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

    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:px-2">

            <div class="tw:text-center">

                <button type="button" class="tw:w-full tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"
                    onclick="window.location='{{ url('/enviar_carga_jefe_division/'.$id_alu) }}'" title="Enviar">

                    Enviar al jefe de división

                </button>

            </div>

        </div>

    </div>

    @else

    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:px-2">

            <div class="tw:text-center">

                <button type="button" class="tw:w-full tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"
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

    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:px-2">

            <div class="tw:text-center">

                <button type="button" class="tw:w-full tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" title="Enviar" disabled>

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

<x-panel.modal id="modal_elimina" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">

            <div class="tw-modal-cuerpo tw:pt-14">

                <form action="" method="POST" role="form" id="form_delete">

                    {{ method_field('DELETE') }}

                    {{ csrf_field() }}

                    ¿Realmente deseas eliminar este elemento?

            </div>

            <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">

                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">

                    Cancelar

                </button>

                <input id="confirma_elimina" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Aceptar">

            </div>

            </form>

        </x-panel.modal>

{{-- ===================================================== --}}
{{-- BOTON FLOTANTE --}}
{{-- ===================================================== --}}

@if(
$validaciones[0]->estado_validacion == 0 ||
$validaciones[0]->estado_validacion == 3 ||
$validaciones[0]->estado_validacion == 4
)

<div>

    <a class="flotante tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" id="enviar" type="button" href="/carga_academica"><span class="fa fa-plus"></span></a>

</div>

@endif

</div>
@endsection