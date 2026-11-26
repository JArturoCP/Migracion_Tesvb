@extends('layouts.panel')
@section('title', 'Corregir Anteproyecto')
@include('partials.panel.recursos_app', ['datepicker' => true])
@section('content')
<div class="tw-pantalla">

@php

/*
=============================================================
OBTENER ANTEPROYECTO
=============================================================
*/

$id_anteproyecto = null;

if (isset($cronograma) && count($cronograma) > 0) {
    $id_anteproyecto = $cronograma[0]->id_anteproyecto;
}

$datos_anteproyecto = null;

if ($id_anteproyecto) {

    $datos_anteproyecto = DB::table('resi_anteproyecto')
        ->where('id_anteproyecto', $id_anteproyecto)
        ->first();

}

/*
=============================================================
ESTADOS
=============================================================

estado_permiso = 4
El alumno tiene permiso para corregir.

estado_enviado = 3
El alumno ya realizó la corrección con el permiso.

estado_aceptado_cronograma = 1
El cronograma está autorizado.

IMPORTANTE:
La autorización se revisa POR ACTIVIDAD.
No se debe deshabilitar todo el cronograma porque
una sola actividad esté autorizada.
*/

$tiene_permiso = false;

if ($datos_anteproyecto) {

    if (
        $datos_anteproyecto->estado_permiso == 4 &&
        $datos_anteproyecto->estado_enviado != 3
    ) {

        $tiene_permiso = true;

    }

}

/*
=============================================================
VERIFICAR SI TODO EL CRONOGRAMA ESTÁ AUTORIZADO
=============================================================
*/

$cronograma_autorizado = false;

if (isset($cronograma) && count($cronograma) > 0) {

    $cronograma_autorizado = true;

    foreach ($cronograma as $semana) {

        if ($semana->estado_aceptado_cronograma != 1) {

            $cronograma_autorizado = false;
            break;

        }

    }

}

@endphp


<div class="tw:w-full">

    {{-- =========================================================
    MENSAJE DE PERMISO ESPECIAL
    ========================================================== --}}

    @if($tiene_permiso)

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:px-2">

            <x-panel.alerta tipo="advertencia" class="tw:mb-4">

                <span class="fa fa-pencil tw:text-lg"
                     >
                </span>

                <strong>
                    El Departamento de Servicio Social y Residencia Profesional
                    te ha otorgado permiso para modificar nuevamente tu
                    cronograma.
                </strong>

                <br>

                Realiza las correcciones necesarias y presiona
                <strong>Guardar</strong>.

            </x-panel.alerta>

        </div>

    </div>

    @endif


    {{-- =========================================================
    MENSAJE CRONOGRAMA AUTORIZADO
    ========================================================== --}}

    @if($cronograma_autorizado)

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:px-2">

            <x-panel.alerta tipo="exito" class="tw:mb-4">

                <span class="fa fa-check-circle-o tw:text-lg"
                     >
                </span>

                <strong>
                    Tu cronograma fue corregido y autorizado.
                </strong>

                <br>

                El Departamento de Servicio Social y Residencia Profesional
                ha validado nuevamente tu cronograma.

            </x-panel.alerta>

        </div>

    </div>

    @endif


    {{-- =========================================================
    CONTENEDOR PRINCIPAL
    ========================================================== --}}

    <x-panel.encabezado titulo="Corregir Cronograma" :migas="['Residencia profesional' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:px-2">

            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]"
                >

                {{-- ENCABEZADO --}}

                


                <div class="tw:p-5 tw:sm:p-6">

                    {{-- =================================================
                    NAVEGACIÓN
                    ================================================== --}}

                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                        {{-- ATRÁS --}}

                        <div class="tw:w-full tw:lg:w-6/12 tw:px-2 tw:text-center"
                            >

                            <a href="{{url('/residencia/anteproyecto/corregir_marco_teorico')}}"
                               class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"
                              >

                                <span class="fa fa-arrow-left"
                                     >
                                </span>

                                Atrás

                            </a>

                        </div>


                        {{-- SIGUIENTE --}}

                        <div class="tw:w-full tw:lg:w-6/12 tw:px-2 tw:text-center"
                            >

                            <a href="{{url('/residencia/anteproyecto/corregir_enviar_anteproyecto')}}"
                               class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"
                              >

                                <span class="fa fa-arrow-right"
                                     >
                                </span>

                                Siguiente

                            </a>

                        </div>

                    </div>



                    {{-- =================================================
                    CONTENIDO
                    ================================================== --}}

                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">


                        {{-- =================================================
                        CRONOGRAMA
                        ================================================== --}}

                        <div class="tw:w-full tw:lg:w-8/12 tw:px-2">

                            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]"
                                >

                                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center">

                                    <span class="fa fa-calendar"></span>

                                    Cronograma de Actividades

                                </div>


                                <div class="tw:p-5 tw:sm:p-6">

                                    @foreach($cronograma as $semana)

                                    @php

                                        $fecha_inicial =
                                            date(
                                                "d-m-Y",
                                                strtotime($semana->f_inicio)
                                            );

                                        $fecha_final =
                                            date(
                                                "d-m-Y",
                                                strtotime($semana->f_termino)
                                            );

                                    @endphp


                                    <div class="tw:w-full tw:lg:w-full tw:text-center tw:px-2 tw:mb-2.5"
                                        >

                                        <div class="tw:border-3 tw:border-sky-100 tw:dark:border-sky-500/20 tw:rounded-md tw:p-2.5">

                                            {{-- SEMANA --}}

                                            <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300">

                                                <strong>
                                                    SEMANA {{$semana->no_semana}}
                                                </strong>

                                            </h5>


                                            {{-- FECHAS --}}

                                            <p>

                                                <b>
                                                    {{$fecha_inicial}}
                                                </b>

                                                al

                                                <b>
                                                    {{$fecha_final}}
                                                </b>

                                            </p>


                                            {{-- ACTIVIDAD --}}

                                            <p>

                                                <b>
                                                    Actividad(es)
                                                </b>

                                                <br>

                                                {{$semana->actividad}}

                                            </p>


                                            {{-- =================================================
                                            BOTÓN DE ESTA ACTIVIDAD
                                            ================================================== --}}

                                            @if($semana->estado_aceptado_cronograma == 1)

                                                <button
                                                    type="button"
                                                    class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:disabled:bg-green-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"
                                                    disabled
                                                   >

                                                    <span class="fa fa-check"></span>

                                                    Autorizado

                                                </button>

                                            @else

                                                <button
                                                    type="button"
                                                    class="modificar_actividad tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"
                                                    data-id="{{$semana->id_cronograma}}"
                                                    data-semana="{{$semana->no_semana}}"
                                                    data-fecha-inicial="{{$semana->f_inicio}}"
                                                    data-fecha-final="{{$semana->f_termino}}"
                                                    data-actividad="{{htmlspecialchars($semana->actividad, ENT_QUOTES, 'UTF-8')}}">

                                                    <span class="fa fa-cog"></span>

                                                    Modificar

                                                </button>

                                            @endif

                                        </div>

                                    </div>

                                    @endforeach

                                    <div class="tw:clear-both"></div>

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                        COMENTARIOS
                        ================================================== --}}

                        <div class="tw:w-full tw:lg:w-4/12 tw:px-2">

                            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]"
                                >

                                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center"
                                    >

                                    <span class="fa fa-comment"></span>

                                    COMENTARIOS DE LOS REVISORES

                                </div>


                                <div class="tw:p-5 tw:sm:p-6">


                                    {{-- MENSAJE DE ESTADO --}}

                                    @if($cronograma_autorizado)

                                        <x-panel.alerta tipo="exito" class="tw:mb-4">

                                            <span class="fa fa-check-circle-o"></span>

                                            <strong>
                                                Ya te autorizaron el cronograma.
                                            </strong>

                                            <br>

                                            El cronograma corregido fue
                                            registrado correctamente.

                                        </x-panel.alerta>


                                    @elseif($tiene_permiso)

                                        <x-panel.alerta tipo="advertencia" class="tw:mb-4">

                                            <span class="fa fa-pencil"></span>

                                            <strong>
                                                Tienes permiso para modificar
                                                nuevamente esta sección.
                                            </strong>

                                            <br>

                                            Realiza las correcciones necesarias
                                            y presiona <strong>Guardar</strong>.

                                        </x-panel.alerta>


                                    @else

                                        <x-panel.alerta tipo="error" class="tw:mb-4">

                                            <span class="fa fa-exclamation-triangle"></span>

                                            <strong>
                                                Corrige lo que se te pide en los
                                                comentarios de los revisores.
                                            </strong>

                                        </x-panel.alerta>

                                    @endif


                                    {{-- =================================================
                                    COMENTARIOS DE DOCENTES
                                    ================================================== --}}

                                    @foreach($comentarios_cronograma as $comentario)


                                        {{-- AUTORIZADO --}}

                                        @if($comentario->id_estado_evaluacion == 1)

                                            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                                                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center">

                                                    <strong>
                                                        NOMBRE DEL DOCENTE:
                                                    </strong>

                                                    {{$comentario->nombre}}

                                                    <br>

                                                    <strong>
                                                        STATUS DEL ANTEPROYECTO:
                                                    </strong>

                                                    AUTORIZADO

                                                </div>

                                                <div class="tw:p-5 tw:sm:p-6">

                                                    {{$comentario->comentario}}

                                                </div>

                                            </div>


                                        {{-- ACEPTADO CON CAMBIOS --}}

                                        @elseif($comentario->id_estado_evaluacion == 2)

                                            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                                                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center">

                                                    <strong>
                                                        NOMBRE DEL DOCENTE:
                                                    </strong>

                                                    {{$comentario->nombre}}

                                                    <br>

                                                    <strong>
                                                        STATUS DEL ANTEPROYECTO:
                                                    </strong>

                                                    ACEPTADO CON CAMBIOS

                                                </div>

                                                <div class="tw:p-5 tw:sm:p-6">

                                                    {{$comentario->comentario}}

                                                </div>

                                            </div>


                                        {{-- RECHAZADO --}}

                                        @elseif($comentario->id_estado_evaluacion == 3)

                                            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                                                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center">

                                                    <strong>
                                                        NOMBRE DEL DOCENTE:
                                                    </strong>

                                                    {{$comentario->nombre}}

                                                    <br>

                                                    <strong>
                                                        STATUS DEL ANTEPROYECTO:
                                                    </strong>

                                                    RECHAZADO

                                                </div>

                                                <div class="tw:p-5 tw:sm:p-6">

                                                    {{$comentario->comentario}}

                                                </div>

                                            </div>

                                        @endif

                                    @endforeach

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =============================================================
MODAL MODIFICAR ACTIVIDAD
============================================================= --}}

<x-panel.modal id="modal_modificar_actividad" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="modalActividad">

            <form
                id="form_modificar_actividades"
                class=""
                action="{{url('/residencia/guardar_correciones_cronograma/')}}"
                method="POST">

                {{ csrf_field() }}

                {{-- =================================================
                ENCABEZADO
                ================================================== --}}

                <div class="tw:px-6 tw:pt-6 tw:pr-14 tw:text-white tw:bg-brand-500 tw:text-white tw:border-b-0 tw:py-4.5 tw:px-5"
                    >

                    

                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">

                        <span class="fa fa-pencil-square-o"></span>

                        &nbsp;Modificar actividad

                    </h4>

                </div>


                {{-- =================================================
                CUERPO
                ================================================== --}}

                <div class="tw-modal-cuerpo tw:bg-gray-50 tw:dark:bg-gray-800 tw:p-6.25"
                    >

                    {{-- ID CRONOGRAMA --}}

                    <input
                        type="hidden"
                        id="modal_id_cronograma"
                        name="id_cronograma"
                        value="">


                    {{-- =================================================
                    FECHA INICIAL
                    ================================================== --}}

                    <div class="tw:mb-4">

                        <label for="modal_fecha_inicial">

                            <span class="fa fa-calendar tw:text-blue-700 tw:dark:text-blue-400"
                                 >
                            </span>

                            Fecha inicial

                        </label>

                        <input
                            type="date"
                            class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:bg-gray-50 tw:dark:bg-gray-800 tw:cursor-not-allowed tw:h-10.5 tw:rounded-md"
                            id="modal_fecha_inicial"
                            name="fecha_inicial"
                            readonly
                           >

                        <small class="tw:text-gray-500 tw:dark:text-gray-400">
                            La fecha de inicio de la semana no puede modificarse.
                        </small>

                    </div>


                    {{-- =================================================
                    FECHA FINAL
                    ================================================== --}}

                    <div class="tw:mb-4">

                        <label for="modal_fecha_final">

                            <span class="fa fa-calendar tw:text-blue-700 tw:dark:text-blue-400"
                                 >
                            </span>

                            Fecha final

                        </label>

                        <input
                            type="date"
                            class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:bg-gray-50 tw:dark:bg-gray-800 tw:cursor-not-allowed tw:h-10.5 tw:rounded-md"
                            id="modal_fecha_final"
                            name="fecha_s"
                            readonly
                           >

                        <small class="tw:text-gray-500 tw:dark:text-gray-400">
                            La fecha de término de la semana no puede modificarse.
                        </small>

                    </div>


                    {{-- =================================================
                    ACTIVIDAD
                    ================================================== --}}

                    <div class="tw:mb-4">

                        <label for="modal_actividades">

                            <span class="fa fa-tasks tw:text-blue-700 tw:dark:text-blue-400"
                                 >
                            </span>

                            Actividad(es)

                        </label>

                        <textarea
                            class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:rounded-md tw:resize-y"
                            id="modal_actividades"
                            name="actividades"
                            rows="8"
                            placeholder="Ingresa la actividad correspondiente a esta semana"
                            required
                           ></textarea>

                        <small class="tw:text-gray-500 tw:dark:text-gray-400">

                            Aquí puedes corregir las actividades
                            correspondientes únicamente a esta semana.

                        </small>

                    </div>

                </div>


                {{-- =================================================
                PIE DEL MODAL
                ================================================== --}}

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6 tw:bg-gray-50 tw:dark:bg-gray-800 tw:border-t tw:border-gray-200 tw:dark:border-gray-800 tw:py-3.75 tw:px-5"
                    >

                    <button
                        type="button"
                        class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"
                        data-dismiss="modal"
                       >

                        <span class="fa fa-times"></span>

                        Cancelar

                    </button>

                    <button
                        type="button"
                        id="guarda_actividades"
                        class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"
                       >

                        <span class="fa fa-floppy-o"></span>

                        Guardar

                    </button>

                </div>

            </form>

        </x-panel.modal>




{{-- =============================================================
JAVASCRIPT
============================================================= --}}

<script type="text/javascript">

$(document).ready(function() {


    /*
    =============================================================
    ABRIR MODAL DE LA ACTIVIDAD SELECCIONADA
    =============================================================
    */

    $(".modificar_actividad").click(function(event) {

        event.preventDefault();


        /*
        ---------------------------------------------------------
        OBTENER DATOS DE LA ACTIVIDAD SELECCIONADA
        ---------------------------------------------------------
        */

        var id_cronograma =
            $(this).attr("data-id");

        var semana =
            $(this).attr("data-semana");

        var fecha_inicial =
            $(this).attr("data-fecha-inicial");

        var fecha_final =
            $(this).attr("data-fecha-final");

        var actividad =
            $(this).attr("data-actividad");


        /*
        ---------------------------------------------------------
        COLOCAR DATOS EN EL MODAL
        ---------------------------------------------------------
        */

        $("#modal_id_cronograma")
            .val(id_cronograma);

        $("#modal_fecha_inicial")
            .val(fecha_inicial);

        $("#modal_fecha_final")
            .val(fecha_final);

        $("#modal_actividades")
            .val(actividad);


        /*
        ---------------------------------------------------------
        CAMBIAR TÍTULO
        ---------------------------------------------------------
        */

        $("#modal_modificar_actividad .modal-title")
            .html(
                "Modificar actividad - Semana " + semana
            );


        /*
        ---------------------------------------------------------
        HABILITAR BOTÓN
        ---------------------------------------------------------
        */

        $("#guarda_actividades")
            .prop("disabled", false);


        /*
        ---------------------------------------------------------
        ABRIR MODAL
        ---------------------------------------------------------
        */

        $("#modal_modificar_actividad")
            .modal("show");

    });


    /*
    =============================================================
    GUARDAR ACTIVIDAD SELECCIONADA
    =============================================================
    */

    $("#guarda_actividades").click(function(event) {

        event.preventDefault();


        /*
        ---------------------------------------------------------
        OBTENER DATOS
        ---------------------------------------------------------
        */

        var id_cronograma =
            $.trim($("#modal_id_cronograma").val());

        var fecha_inicial =
            $.trim($("#modal_fecha_inicial").val());

        var fecha_final =
            $.trim($("#modal_fecha_final").val());

        var actividades =
            $.trim($("#modal_actividades").val());


        /*
        ---------------------------------------------------------
        VALIDAR ID
        ---------------------------------------------------------
        */

        if (id_cronograma == "") {

            swal({
                position: "top",
                type: "warning",
                title: "No se identificó la actividad.",
                showConfirmButton: false,
                timer: 3500
            });

            return false;

        }


        /*
        ---------------------------------------------------------
        VALIDAR FECHA INICIAL
        ---------------------------------------------------------
        */

        if (fecha_inicial == "") {

            swal({
                position: "top",
                type: "warning",
                title: "Selecciona la fecha inicial.",
                showConfirmButton: false,
                timer: 3500
            });

            return false;

        }


        /*
        ---------------------------------------------------------
        VALIDAR FECHA FINAL
        ---------------------------------------------------------
        */

        if (fecha_final == "") {

            swal({
                position: "top",
                type: "warning",
                title: "Selecciona la fecha final.",
                showConfirmButton: false,
                timer: 3500
            });

            return false;

        }


        /*
        ---------------------------------------------------------
        VALIDAR ACTIVIDAD
        ---------------------------------------------------------
        */

        if (actividades == "") {

            swal({
                position: "top",
                type: "warning",
                title: "El campo de actividad se encuentra vacío.",
                showConfirmButton: false,
                timer: 3500
            });

            return false;

        }


        /*
        ---------------------------------------------------------
        VALIDAR FECHAS
        ---------------------------------------------------------
        */

        if (fecha_final < fecha_inicial) {

            swal({
                position: "top",
                type: "warning",
                title: "La fecha final no puede ser menor que la fecha inicial.",
                showConfirmButton: false,
                timer: 3500
            });

            return false;

        }


        /*
        ---------------------------------------------------------
        EVITAR DOBLE ENVÍO
        ---------------------------------------------------------
        */

        $("#guarda_actividades")
            .prop("disabled", true);


        /*
        ---------------------------------------------------------
        ENVIAR FORMULARIO
        ---------------------------------------------------------
        */

        $("#form_modificar_actividades")
            .submit();

    });


    /*
    =============================================================
    LIMPIAR MODAL AL CERRAR
    =============================================================
    */

    $("#modal_modificar_actividad").on(
        "hidden.bs.modal",
        function() {

            $("#modal_id_cronograma").val("");

            $("#modal_fecha_inicial").val("");

            $("#modal_fecha_final").val("");

            $("#modal_actividades").val("");

            $("#guarda_actividades")
                .prop("disabled", false);

        }
    );


});

</script>

</div>
@endsection
