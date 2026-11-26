@extends('layouts.panel')

@section('title', 'Validar Carga Académica Estudiante Dual')

@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

<?php

$escolar = session()->has('escolar');
$jefe_division = session()->has('jefe_division');

$estado = isset($validaciones[0])
    ? (int) $validaciones[0]->estado_validacion
    : 0;

?>

<main>

    {{-- =========================================================
    MENSAJES
    ========================================================== --}}

    @if (session('error'))

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">

            <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:flex tw:items-center tw:gap-4 tw:border-red-200 tw:bg-red-50 tw:text-red-700">

                <div class="tw:flex tw:size-10 tw:shrink-0 tw:items-center tw:justify-center tw:rounded-full tw:bg-red-600 tw:text-xl tw:text-white">
                    <span class="fa fa-exclamation-triangle"></span>
                </div>

                <div>

                    <h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                        No se puede enviar la carga académica
                    </h3>

                    <p>
                        {{ session('error') }}
                    </p>

                </div>

            </div>

        </div>
    </div>

    @endif


    @if (session('success'))

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">

            <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:flex tw:items-center tw:gap-4 tw:border-green-200 tw:bg-green-50 tw:text-green-800">

                <span class="fa fa-check-circle"></span>

                <div>

                    <h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                        ¡Carga enviada correctamente!
                    </h3>

                    <p>
                        {{ session('success') }}
                    </p>

                </div>

            </div>

        </div>
    </div>

    @endif


    {{-- =========================================================
    TÍTULO
    ========================================================== --}}

    <x-panel.encabezado titulo="Ver carga académica" :migas="['Educación dual' => null]" />


    {{-- =========================================================
    DATOS DEL ESTUDIANTE
    ========================================================== --}}

    @if ($usuario == 2)

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:px-2">

            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center">

                    <h4 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">

                        <span class="fa fa-user"></span>

                        &nbsp; DATOS DEL ESTUDIANTE

                    </h4>

                </div>

                <div class="tw:p-5 tw:sm:p-6 tw:text-center">

                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                        {{ $cuenta_y_nom }}
                    </h4>

                </div>

            </div>

        </div>

    </div>

    @endif


    {{-- =========================================================
    ESTADO DE LA CARGA
    ========================================================== --}}

    @if ($estado == 0)

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:px-2">

            <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-amber-200 tw:bg-amber-50 tw:text-center tw:text-amber-800">

                <div class="tw:mb-2 tw:flex tw:items-center tw:justify-center tw:gap-2">

                    <div class="tw:text-lg">
                        <i class="fa fa-clock-o"></i>
                    </div>

                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                        Carga Académica Pendiente
                    </h4>

                </div>

                <p>
                    La carga académica aún no ha sido enviada
                    a Servicios Escolares.
                </p>

            </div>

        </div>

    </div>

    @elseif ($estado == 888)

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:px-2">

            <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:text-center tw:border-amber-200 tw:bg-amber-50 tw:text-amber-800">

                <div class="tw:mb-2 tw:flex tw:items-center tw:justify-center tw:gap-2">

                    <div class="tw:text-lg">
                        <i class="fa fa-refresh"></i>
                    </div>

                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                        Validación por Servicios Escolares
                    </h4>

                </div>

                <p>
                    La carga académica fue enviada correctamente
                    y se encuentra en proceso de validación por
                    Servicios Escolares.
                </p>

            </div>

        </div>

    </div>

    @elseif ($estado == 1)

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:px-2">

            <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:text-center tw:border-sky-200 tw:bg-sky-50 tw:text-sky-800">

                <div class="tw:mb-2 tw:flex tw:items-center tw:justify-center tw:gap-2">

                    <div class="tw:text-lg">
                        <i class="fa fa-user"></i>
                    </div>

                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                        Pendiente de autorización del Jefe de División
                    </h4>

                </div>

                <p>
                    Servicios Escolares validó la carga académica.
                    Ahora corresponde al Jefe de División autorizarla.
                </p>

            </div>

        </div>

    </div>

    @elseif ($estado == 2)

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:px-2">

            <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:text-center tw:border-green-200 tw:bg-green-50 tw:text-green-800">

                <div class="tw:mb-2 tw:flex tw:items-center tw:justify-center tw:gap-2">

                    <div class="tw:text-lg">
                        <i class="fa fa-check"></i>
                    </div>

                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                        Carga Académica Autorizada
                    </h4>

                </div>

                <p>
                    La carga académica ha sido autorizada correctamente.
                </p>

            </div>

        </div>

    </div>

    @endif


    {{-- =========================================================
    ADEUDOS
    ========================================================== --}}

    @if ($usuario == 2)

    @if ($estado == 0 || $estado == 3 || $estado == 888)

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:px-2">

            @if ($adeudo == 0)

            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center">

                    <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">

                        <span class="fa fa-check-circle"></span>

                        &nbsp; ESTADO DE ADEUDOS

                    </h3>

                </div>

                <div class="tw:p-5 tw:sm:p-6 tw:text-center">

                    <span class="fa fa-check-circle-o tw:text-4xl tw:text-green-600"></span>

                    <h4 class="tw:text-green-600 tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                        ¡No tiene adeudo!
                    </h4>

                    <p class="tw:text-gray-500 tw:dark:text-gray-400">
                        <span class="fa fa-check-square-o"></span>
                        No se encontraron adeudos pendientes.
                    </p>

                </div>

            </div>

            @else

            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center">

                    <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">

                        <span class="fa fa-exclamation-triangle"></span>

                        &nbsp; ESTADO DE ADEUDOS

                    </h3>

                </div>

                <div class="tw:p-5 tw:sm:p-6 tw:text-center">

                    <span class="fa fa-times-circle-o tw:text-4xl tw:text-red-600"></span>

                    <h4 class="tw:text-red-600 tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                        Tiene adeudos pendientes
                    </h4>

                    <p class="tw:text-gray-500 tw:dark:text-gray-400">
                        <span class="fa fa-info-circle"></span>

                        Tiene adeudo con los siguientes
                        departamentos o carreras:
                    </p>

                    <div class="tw:mt-4">

                        @foreach ($departamento_carrera as $adeudo_item)

                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:p-5 tw:mb-2 tw:rounded-lg tw:border tw:border-red-200 tw:bg-red-50 tw:p-3 tw:text-center">

                            <h4 class="tw:text-red-600 tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">

                                <span class="fa fa-briefcase"></span>

                                &nbsp;
                                {{ $adeudo_item['nombre'] }}

                            </h4>

                            <p>

                                <span class="fa fa-comment"></span>

                                &nbsp;
                                {{ $adeudo_item['comentario'] }}

                            </p>

                        </div>

                        @endforeach

                    </div>

                </div>

            </div>

            @endif

        </div>

    </div>

    @endif

    @endif


    {{-- =========================================================
    TABLA DE CARGA ACADÉMICA
    ========================================================== --}}

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:px-2">

            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">

                <thead>

                    <tr class="tw:bg-sky-50">

                        <th class="tw:text-center">
                            CLAVE DE LA MATERIA
                        </th>

                        <th class="tw:text-center">
                            NOMBRE DE LA MATERIA
                        </th>

                        <th class="tw:text-center">
                            CRÉDITOS
                        </th>

                        <th class="tw:text-center">
                            STATUS
                        </th>

                        <th class="tw:text-center">
                            TIPO CURSA
                        </th>

                        <th class="tw:text-center">
                            GRUPO
                        </th>

                        @if ($estado == 0 || $estado == 3)

                        <th class="tw:text-center">
                            ELIMINAR
                        </th>

                        @endif

                    </tr>

                </thead>

                <tbody>

                    @foreach ($datos_carga as $consulta1)

                    @if ($consulta1['id_materia'] == 2258)

                    <tr>

                        <th></th>

                        <th class="tw:text-center">
                            {{ $consulta1['clave'] }}
                        </th>

                        <td class="tw:text-center">
                            {{ $consulta1['nombre'] }}
                        </td>

                        <td></td>

                        <td class="tw:text-center">
                            ALTA
                        </td>

                        <td></td>

                        @if ($estado == 0 || $estado == 3)

                        <th class="tw:text-center">

                            <a href="javascript:void(0)" class="elimina tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base"
                                data-id_carga_academica="{{ $consulta1['id_carga_academica'] }}"><span class="fa fa-trash">
                                </span></a>

                        </th>

                        @endif

                    </tr>

                    @else

                    <tr>

                        <th class="tw:text-center">
                            {{ $consulta1['clave'] }}
                        </th>

                        <td class="tw:text-center">
                            {{ $consulta1['nombre'] }}
                        </td>

                        <td class="tw:text-center">
                            {{ $consulta1['creditos'] }}
                        </td>

                        <td class="tw:text-center">
                            {{ $consulta1['nombre_status'] }}
                        </td>

                        <td class="tw:text-center">
                            {{ $consulta1['nombre_curso'] }}
                        </td>

                        <td class="tw:text-center">
                            {{ $consulta1['id_semestre'] }}0{{ $consulta1['grupo'] }}
                        </td>

                        @if ($estado == 0 || $estado == 3)

                        <th class="tw:text-center">

                            <a href="javascript:void(0)" class="elimina tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base"
                                data-id_carga_academica="{{ $consulta1['id_carga_academica'] }}"><span class="fa fa-trash">
                                </span></a>

                        </th>

                        @endif

                    </tr>

                    @endif

                    @endforeach


                    {{-- TOTAL --}}

                    <tr>

                        <th></th>
                        <th></th>

                        <td class="tw:text-center">
                            <b>Total de créditos:</b>
                        </td>

                        <td class="tw:text-center">
                            {{ $suma }}
                        </td>

                        <td></td>

                        @if ($estado == 0 || $estado == 3)

                        <td></td>
                        <td></td>

                        @endif

                    </tr>

                </tbody>

            </table>
</div>

        </div>

    </div>


    {{-- =========================================================
    BOTÓN ENVIAR A SERVICIOS ESCOLARES
     
    IMPORTANTE:
     
    NO SE VALIDA $creditoss.
     
    SOLO:
     
    estado 0 o 3
     
    Y EL CONTROL REAL DE ADEUDO ESTÁ EN EL CONTROLADOR.
    ========================================================== --}}

    @if ($estado == 0 || $estado == 3)

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:px-2">

            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center">

                    <h4 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">

                        <span class="fa fa-paper-plane"></span>

                        ENVIAR CARGA ACADÉMICA

                    </h4>

                </div>

                <div class="tw:p-5 tw:sm:p-6 tw:text-center">

                    @if ($adeudo == 1)

                    <x-panel.alerta tipo="error" class="tw:mb-4">

                        <span class="fa fa-exclamation-triangle"></span>

                        <strong>
                            No puede enviar la carga.
                        </strong>

                        <p class="tw:mt-2">
                            El estudiante tiene adeudos pendientes.
                            Debe regularizar su situación antes
                            de continuar.
                        </p>

                    </x-panel.alerta>

                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" disabled>

                        <span class="fa fa-lock"></span>

                        Envío bloqueado por adeudo

                    </button>

                    @else

                    <p>
                        La carga académica está lista para ser
                        enviada a Servicios Escolares.
                    </p>

                    <a href="{{ url('/duales/enviar_carga/' . ($id_alu ?? $alumno)) }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"
                        id="btnEnviar">

                        <span class="fa fa-paper-plane"></span>

                        Enviar a Servicios Escolares

                    </a>


                    @endif

                </div>

            </div>

        </div>

    </div>

    @endif


    {{-- =========================================================
    AUTORIZACIÓN JEFE DE DIVISIÓN
    ========================================================== --}}

    @if ($usuario == 2 && $jefe_division)

    @if ($estado == 1)

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:px-2">

            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center">

                    <h4 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">

                        <span class="fa fa-user"></span>

                        AUTORIZACIÓN DEL JEFE DE DIVISIÓN

                    </h4>

                </div>

                <div class="tw:p-5 tw:sm:p-6 tw:text-center">

                    <p>
                        Servicios Escolares ya validó esta
                        carga académica.
                    </p>

                    <p>
                        El siguiente paso corresponde al
                        Jefe de División.
                    </p>

                    <form method="POST" action="{{ url('/duales/validacion_de_carga/' . $id) }}" id="formupdate">

                        <input type="hidden" name="_method" value="PUT">

                        {{ csrf_field() }}

                        <input type="hidden" name="estado" value="2">

                        <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">

                            <span class="fa fa-check"></span>

                            Autorizar Carga Académica

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

    @endif

    @endif


    {{-- =========================================================
    IMPRESIÓN
    ========================================================== --}}

    @if ($usuario == 2)

    @if ($estado == 2 || $estado == 8 || $estado == 9)

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:px-2">

            <x-panel.alerta tipo="exito" class="tw:mb-4">

                <p>
                    <strong>
                        Carga Académica Aceptada
                    </strong>
                </p>

                <a href="/duales/imprime_control/{{ $id }}" target="_blank" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">

                    <span class="fa fa-print"></span>

                    Imprimir

                </a>

            </x-panel.alerta>

        </div>

    </div>

    @endif

    @endif


    {{-- =========================================================
    MODAL ELIMINAR
    ========================================================== --}}

    <x-panel.modal id="modal_elimina" tamano="sm" sin-relleno>

                <div class="tw-modal-cuerpo tw:pt-14">

                    <form action="" method="POST" id="form_delete">

                        {{ method_field('DELETE') }}

                        {{ csrf_field() }}

                        <input type="hidden" id="id_carga_academica" name="id_carga_academica">

                        <b>
                            ¿Realmente deseas eliminar este elemento?
                        </b>

                    </form>

                </div>

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">

                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">

                        Cancelar

                    </button>

                    <button id="confirma_elimina" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">

                        Aceptar

                    </button>

                </div>

            </x-panel.modal>

</main>


{{-- =============================================================
ESTILOS
============================================================= --}}

{{-- =============================================================
JAVASCRIPT
============================================================= --}}

<script>
$(document).ready(function() {

    /*
     * ============================================================
     * ELIMINAR CARGA
     * ============================================================
     */

    $(".elimina").click(function() {

        var id_carga_academica =
            $(this).data('id_carga_academica');

        $('#id_carga_academica')
            .val(id_carga_academica);

        $('#modal_elimina').modal('show');

    });


    /*
     * ============================================================
     * CONFIRMAR ELIMINACIÓN
     * ============================================================
     */

    $("#confirma_elimina").click(function() {

        var id_carga_academica =
            $("#id_carga_academica").val();

        $("#form_delete").attr(
            "action",
            "/duales/eliminar_carga_academica/" +
            id_carga_academica
        );

        $("#form_delete").submit();

    });


    /*
     * ============================================================
     * EVITAR DOBLE ENVÍO
     * ============================================================
     */

    $("#btnEnviar").click(function() {

        var boton = $(this);

        boton.css(
            "pointer-events",
            "none"
        );

        boton.html(
            '<span class="fa fa-refresh"></span> Enviando...'
        );

    });


    /*
     * ============================================================
     * EVITAR DOBLE AUTORIZACIÓN
     * ============================================================
     */

    $("#formupdate").submit(function() {

        $(this)
            .find('button[type="submit"]')
            .prop('disabled', true);

    });

});
</script>

</div>
@endsection