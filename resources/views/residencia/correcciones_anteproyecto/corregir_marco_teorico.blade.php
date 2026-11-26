@extends('layouts.panel')
@section('title', 'Registrar Anteproyecto')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

@php
/*OBTENER ESTADO DEL ANTEPROYECTO*/

$datos_anteproyecto = DB::table('resi_anteproyecto')
->where('id_anteproyecto', $marco_teorico->id_anteproyecto)
->first();

/*
ESTADOS

estado_permiso = 4
El alumno tiene permiso para corregir.

estado_enviado = 3
El alumno ya realizó la corrección con el permiso.

estado_aceptado_marco = 1
El Marco Teórico está autorizado.

IMPORTANTE:
Después de guardar con permiso 4, tu controlador NO cambia
estado_permiso. Cambia estado_enviado a 2.

Por eso NO usamos solamente estado_permiso para determinar
si debe aparecer "Marco Teórico autorizado".
*/

$tiene_permiso = false;
$marco_teorico_autorizado = false;

if ($datos_anteproyecto) {

/*
---------------------------------------------------------
TIENE PERMISO PARA CORREGIR
---------------------------------------------------------
*/

if (
$datos_anteproyecto->estado_permiso == 4 &&
$datos_anteproyecto->estado_enviado != 3
) {

$tiene_permiso = true;

}

/*
---------------------------------------------------------
MARCO TEÓRICO AUTORIZADO
---------------------------------------------------------
*/

if (
$marco_teorico->estado_aceptado_marco == 1 &&
$datos_anteproyecto->estado_enviado == 3
) {

$marco_teorico_autorizado = true;

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

                <span class="fa fa-pencil tw:text-lg">
                </span>

                <strong>

                    El Departamento de Servicio Social y Residencia Profesional
                    te ha otorgado permiso para modificar nuevamente tu
                    Marco Teórico.

                </strong>

                <br>

                Realiza las correcciones necesarias y presiona
                <strong>Guardar</strong>.

            </x-panel.alerta>

        </div>

    </div>

    @endif


    {{-- =========================================================
  MENSAJE MARCO TEÓRICO AUTORIZADO
  ========================================================== --}}

    @if($marco_teorico_autorizado)

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:px-2">

            <x-panel.alerta tipo="exito" class="tw:mb-4">

                <span class="fa fa-check-circle-o tw:text-lg">
                </span>

                <strong>

                    Tu Marco Teórico fue corregido y autorizado.

                </strong>

                <br>

                El Departamento de Servicio Social y Residencia Profesional
                ha validado nuevamente tu Marco Teórico.

            </x-panel.alerta>

        </div>

    </div>

    @endif


    {{-- =========================================================
  CONTENEDOR PRINCIPAL
  ========================================================== --}}

    <x-panel.encabezado titulo="Corregir Marco Teórico" :migas="['Residencia profesional' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:px-2">

            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">


                {{-- =================================================
        ENCABEZADO
        ================================================== --}}

                


                <div class="tw:p-5 tw:sm:p-6">


                    {{-- =================================================
          NAVEGACIÓN
          ================================================== --}}

                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                        {{-- ATRÁS --}}

                        <div class="tw:w-full tw:lg:w-6/12 tw:px-2 tw:text-center">

                            <a href="{{url('/residencia/anteproyecto/corregir_justificacion')}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"
                               >

                                <span class="fa fa-arrow-left">
                                </span>

                                Atrás

                            </a>

                        </div>


                        {{-- SIGUIENTE --}}

                        <div class="tw:w-full tw:lg:w-6/12 tw:px-2 tw:text-center">

                            <a href="{{url('/residencia/anteproyecto/corregir_cronograma')}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"
                               >

                                <span class="fa fa-arrow-right">
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
            FORMULARIO
            ================================================== --}}

                        <div class="tw:w-full tw:lg:w-7/12 tw:lg:grow tw:px-2">

                            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center">

                                    <span class="fa fa-list-alt"></span>

                                    Marco Teórico del Anteproyecto

                                </div>


                                <div class="tw:p-5 tw:sm:p-6">

                                    <form id="form_marco_teorico" role="form" method="POST"
                                        action="{{url('/residencia/guardar_correciones_marco_teorico/')}}">

                                        {{ csrf_field() }}


                                        {{-- =================================================
                    ID ANTEPROYECTO
                    ================================================== --}}

                                        <input type="hidden" id="id_anteproyecto" name="id_anteproyecto"
                                            value="{{ $marco_teorico->id_anteproyecto }}">


                                        {{-- =================================================
                    MARCO TEÓRICO
                    ================================================== --}}

                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                                            <div class="tw:w-full tw:lg:w-full tw:px-2">

                                                <div class="tw:mb-4">

                                                    <label for="marco_teorico">

                                                        <span class="fa fa-book"></span>

                                                        MARCO TEÓRICO

                                                    </label>

                                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="marco_teorico"
                                                        name="marco_teorico" rows="25"
                                                        placeholder="Ingresa el Marco Teórico de tu anteproyecto"
                                                        required @if($marco_teorico_autorizado) readonly
                                                        @endif>{{ $marco_teorico->marco_teorico }}</textarea>

                                                </div>

                                            </div>

                                        </div>


                                        {{-- =================================================
                    BOTÓN GUARDAR
                    ================================================== --}}

                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                                            <div class="tw:w-full tw:lg:w-full tw:text-center tw:px-2">

                                                @if($marco_teorico_autorizado)

                                                {{-- =================================================
                        MARCO TEÓRICO AUTORIZADO
                        ================================================== --}}

                                                <button id="guardar_marco_teorico" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:disabled:bg-green-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"
                                                    disabled>

                                                    <span class="fa fa-check"></span>

                                                    Marco Teórico autorizado

                                                </button>

                                                @else

                                                {{-- =================================================
                        PUEDE MODIFICAR
                        ================================================== --}}

                                                <button id="guardar_marco_teorico" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"
                                                   >

                                                    <span class="fa fa-floppy-o"></span>

                                                    Guardar

                                                </button>

                                                @endif

                                            </div>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
            COMENTARIOS
            ================================================== --}}

                        <div class="tw:w-full tw:lg:w-4/12 tw:lg:grow tw:px-2">

                            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center">

                                    <span class="fa fa-comment"></span>

                                    COMENTARIOS DE LOS REVISORES

                                </div>


                                <div class="tw:p-5 tw:sm:p-6">


                                    {{-- =================================================
                  MENSAJE DE ESTADO
                  ================================================== --}}

                                    @if($marco_teorico_autorizado)

                                    <x-panel.alerta tipo="exito" class="tw:mb-4">

                                        <span class="fa fa-check-circle-o"></span>

                                        <strong>

                                            Ya te autorizaron el Marco Teórico.

                                        </strong>

                                        <br>

                                        El Marco Teórico corregido fue
                                        registrado correctamente.

                                    </x-panel.alerta>


                                    @elseif($tiene_permiso)

                                    <x-panel.alerta tipo="advertencia" class="tw:mb-4">

                                        <span class="fa fa-pencil"></span>

                                        <strong>

                                            Tienes permiso para modificar nuevamente
                                            esta sección.

                                        </strong>

                                        <br>

                                        Realiza las correcciones necesarias y presiona
                                        <strong>Guardar</strong>.

                                    </x-panel.alerta>


                                    @else

                                    <x-panel.alerta tipo="error" class="tw:mb-4">

                                        <span class="fa fa-exclamation-triangle"></span>

                                        <strong>

                                            Corrige lo que se te pide en los comentarios
                                            de los revisores.

                                        </strong>

                                    </x-panel.alerta>

                                    @endif


                                    {{-- =================================================
                  COMENTARIOS DE DOCENTES
                  ================================================== --}}

                                    @foreach($comentarios_marco_teorico as $comentario)


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
MODAL ENVIAR ANTEPROYECTO
============================================================= --}}

<x-panel.modal id="modal_enviar" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">

            <form action="{{url('/residencia/enviar_anteproyecto_corregido/')}}" method="POST" role="form">

                {{ csrf_field() }}

                <div class="tw-modal-cuerpo tw:pt-14">

                    <p>
                        ¿Realmente deseas enviar tu anteproyecto?
                    </p>

                    <input type="hidden" id="id_anteproyecto_modal" name="id_anteproyecto" value="">

                </div>

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">

                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">

                        Cancelar

                    </button>

                    <input id="confirma_elimina_oficio" type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Aceptar">

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
    GUARDAR MARCO TEÓRICO
    =============================================================
    */

    $("#guardar_marco_teorico").click(function(event) {

        event.preventDefault();

        var marco_teorico = $("#marco_teorico").val();

        /*
        =========================================================
        VALIDAR CAMPO
        =========================================================
        */

        if ($.trim(marco_teorico) != "") {

            /*
            =====================================================
            EVITAR DOBLE ENVÍO
            =====================================================
            */

            $("#guardar_marco_teorico").attr("disabled", true);

            /*
            =====================================================
            ENVIAR FORMULARIO
            =====================================================
            */

            $("#form_marco_teorico").submit();

        } else {

            swal({

                position: "top",

                type: "warning",

                title: "El campo se encuentra vacío.",

                showConfirmButton: false,

                timer: 3500

            });

        }

    });


    /*
    =============================================================
    ENVIAR ANTEPROYECTO
    =============================================================
    */

    $(".enviar").click(function(event) {

        var id = $(this).attr('id');

        $('#id_anteproyecto_modal').val(id);

        $('#modal_enviar').modal('show');

    });

});
</script>

</div>
@endsection