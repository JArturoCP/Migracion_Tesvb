@extends('layouts.panel')

@section('title', 'Servicio Social Carrera')

@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

<?php $unidad = Session::get('id_unidad_admin'); ?>

<x-panel.encabezado titulo="Seguimientos de Estudiantes de Servicio Social por Carreras" :migas="['Residencia profesional' => null]" />
@if($unidad != 26)

<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:px-2">

            <a class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" href="#"><span class="fa fa-arrow-left"></span> Regresar

            </a>

        </div>

    </div>

</div>

@endif




@if($mostrar == 0)

<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

    <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">

        <div class="tw:mb-4">

            <label for="carrera">
                Elige carrera
                <b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b>
            </label>

            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="carrera" name="carrera" required>

                <option value="" disabled selected>
                    Selecciona una Opción
                </option>

                @foreach($carreras as $carrera)

                <option value="{{ $carrera->id_carrera }}">
                    {{ $carrera->nombre }}
                </option>

                @endforeach

            </select>


        </div>

    </div>

</div>

@endif


@if($mostrar == 1)

<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

    <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">

        <div class="tw:mb-4">

            <label for="carrera">
                Elige una carrera
                <b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b>
            </label>

            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="carrera" name="carrera" required>

                <option value="" disabled>
                    Selecciona una Opción
                </option>

                @foreach($carreras as $carrera)

                @if($carrera->id_carrera == $id_carrera)

                <option value="{{ $carrera->id_carrera }}" selected>
                    {{ $carrera->nombre }}
                </option>

                @else

                <option value="{{ $carrera->id_carrera }}">
                    {{ $carrera->nombre }}
                </option>

                @endif

                @endforeach

            </select>


        </div>

    </div>

</div>


<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

    <div class="tw:w-full tw:px-2">

        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center">

                <strong>
                    Estudiantes de Servicio Social
                </strong>

            </div>


            <div class="tw:p-5 tw:sm:p-6">

                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_enviado" class="tw-tabla tw-tabla-bordes tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800">

                    <thead>

                        <tr>

                            <th class="tw:text-center">
                                No. cuenta
                            </th>

                            <th class="tw:text-center">
                                Nombre del alumno
                            </th>

                            <th class="tw:text-center">
                                Calificación
                            </th>

                            <th class="tw:text-center">
                                Fecha término
                            </th>

                            <th class="tw:text-center">
                                Clave
                            </th>

                            <th class="tw:text-center">
                                Acción
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($estudiantes_servicio as $estudiante)

                        <tr>

                            <td class="tw:text-center">
                                {{ $estudiante->cuenta }}
                            </td>


                            <td class="tw:text-center">

                                {{ $estudiante->nombre }}
                                {{ $estudiante->apaterno }}
                                {{ $estudiante->amaterno }}

                            </td>


                            <td class="tw:text-center">

                                {{ $estudiante->calificacion }}

                            </td>


                            <td class="tw:text-center">

                                {{ $estudiante->fecha_termino }}

                            </td>


                            <td class="tw:text-center">

                                {{ $estudiante->clave }}

                            </td>


                            <td class="tw:text-center">

                                <button type="button" class="btn-calificar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" data-toggle="modal"
                                    data-target="#modalCalificar" data-id_alumno="{{ $estudiante->id_alumno }}"
                                    data-alumno="{{ $estudiante->nombre }} {{ $estudiante->apaterno }} {{ $estudiante->amaterno }}"
                                    data-calificacion="{{ $estudiante->calificacion }}"
                                    data-fecha_termino="{{ $estudiante->fecha_termino }}">

                                    <span class="fa fa-pencil"></span>

                                    Calificar

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

</div>

@endif



<!-- ========================================= -->
<!-- MODAL PARA CALIFICAR SERVICIO SOCIAL -->
<!-- ========================================= -->

<x-panel.modal id="modalCalificar" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="modalCalificarLabel">


            <form method="POST" action="{{ url('/servicio_social/calificar') }}">

                {{ csrf_field() }}


                <!-- HEADER -->

                <div class="tw:px-6 tw:pt-6 tw:pr-14">

                    


                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="modalCalificarLabel">

                        <span class="fa fa-graduation-cap"></span>

                        Calificar Servicio Social

                    </h4>

                </div>


                <!-- BODY -->

                <div class="tw-modal-cuerpo">


                    <!-- ID DEL ALUMNO -->

                    <input type="hidden" name="id_alumno" id="id_alumno">


                    <!-- NOMBRE DEL ALUMNO -->

                    <div class="tw:mb-4">

                        <label for="nombre_alumno">

                            Nombre del Estudiante

                        </label>


                        <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:text-center tw:font-semibold" id="nombre_alumno" readonly>

                    </div>


                    <!-- CALIFICACIÓN -->

                    <div class="tw:mb-4">

                        <label for="calificacion">

                            Calificación

                            <b class="tw:text-red-600 tw:dark:text-red-400">
                                *
                            </b>

                        </label>


                        <input type="number" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:text-center tw:font-semibold" name="calificacion"
                            id="calificacion" min="0" max="100" step="1" required>

                    </div>


                    <div class="tw:text-center">

                        <small class="tw:text-gray-500 tw:dark:text-gray-400">

                            La calificación debe estar entre 0 y 100.

                        </small>

                    </div>




                    <!-- FECHA DE TÉRMINO -->

                    <div class="tw:mb-4">

                        <label for="fecha_termino">

                            Fecha de término

                            <b class="tw:text-red-600 tw:dark:text-red-400">
                                *
                            </b>

                        </label>


                        <input type="date" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:text-center tw:font-semibold" name="fecha_termino" id="fecha_termino"
                            required>

                    </div>


                </div>


                <!-- FOOTER -->

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">


                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">

                        <span class="fa fa-times"></span>

                        Cancelar

                    </button>


                    <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">

                        <span class="fa fa-floppy-o"></span>

                        Guardar calificación

                    </button>


                </div>


            </form>

        </x-panel.modal>



<script type="text/javascript">
$(document).ready(function() {


    /*
    |--------------------------------------------------------------------------
    | DATATABLE
    |--------------------------------------------------------------------------
    */

    if ($('#table_enviado').length) {

        $('#table_enviado').DataTable();

    }


    /*
    |--------------------------------------------------------------------------
    | CAMBIO DE CARRERA
    |--------------------------------------------------------------------------
    */

    $('#carrera').on('change', function() {

        var carrera = $(this).val();

        if (carrera) {

            window.location.href =
                '/servicio_social/departamento_carreras/' + carrera;

        }

    });


    /*
    |--------------------------------------------------------------------------
    | ABRIR MODAL PARA CALIFICAR
    |--------------------------------------------------------------------------
    */

    $(document).on('click', '.btn-calificar', function() {

        // Limpiar campos
        $('#id_alumno').val('');

        $('#nombre_alumno').val('');

        $('#calificacion').val('');

        $('#fecha_termino').val('');


        // Obtener datos del botón

        var id_alumno =
            this.getAttribute('data-id_alumno');

        var alumno =
            this.getAttribute('data-alumno');

        var calificacion =
            this.getAttribute('data-calificacion');

        var fecha_termino =
            this.getAttribute('data-fecha_termino');


        // Colocar ID del alumno

        $('#id_alumno').val(id_alumno);


        // Colocar nombre

        $('#nombre_alumno').val(alumno);


        // Colocar calificación si existe

        if (calificacion !== null &&
            calificacion !== '') {

            $('#calificacion').val(calificacion);

        }


        // Colocar fecha si existe

        if (fecha_termino !== null &&
            fecha_termino !== '') {
            $('#fecha_termino').val(fecha_termino);

        }

    });


});
</script>


</div>
@endsection