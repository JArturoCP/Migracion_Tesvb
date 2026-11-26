@extends('layouts.panel')

@section('title', 'Anteproyectos en Proceso de Modificación')

@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

<div>

    {{-- =========================================================
         ENCABEZADO PRINCIPAL
    ========================================================== --}}

    <x-panel.encabezado titulo="Status de los Anteproyectos" :migas="['Residencia profesional' => null]"><x-slot:extra><x-panel.badge>Periodo {{ $nombre_periodo }}</x-panel.badge></x-slot:extra></x-panel.encabezado>
    <p class="tw:mb-6 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">Seguimiento de anteproyectos en proceso de modificación</p>


    {{-- =========================================================
         SELECTOR DE CARRERA
    ========================================================== --}}

    <div class="tw:mb-6 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

        <div class="tw:flex tw:items-center tw:gap-3 tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:px-5 tw:py-4">

            <div class="tw:flex tw:size-10 tw:shrink-0 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-50 tw:text-brand-500">

                <span class="fa fa-graduation-cap"></span>

            </div>

            <div>

                <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                    Selección de carrera
                </h4>

                <small>
                    Selecciona la carrera que deseas consultar
                </small>

            </div>

        </div>


        <div class="tw:p-5 tw:sm:p-6">

            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">

                    <div class="tw:mb-4">

                        <label for="carrera">

                            Carrera

                            <span class="tw:text-red-600">*</span>

                        </label>


                        <div class="tw:relative tw:[&>.fa]:absolute tw:[&>.fa]:top-3.5 tw:[&>.fa]:left-3 tw:[&>.fa]:text-gray-400">

                            <span class="fa fa-graduation-cap"></span>

                            <select
                                class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:pl-10"
                                id="carrera"
                                name="carrera"
                                required>

                                <option
                                    disabled
                                    hidden
                                    {{ $mostrar == 0 ? 'selected' : '' }}>

                                    Selecciona una carrera

                                </option>


                                @foreach($carreras as $carrera)

                                    <option
                                        value="{{ $carrera->id_carrera }}"
                                        {{ ($mostrar == 1 && $carrera->id_carrera == $id_carrera) ? 'selected' : '' }}>

                                        {{ $carrera->nombre }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    @if($mostrar == 1)


        {{-- =====================================================
             TARJETAS DE ESTADO
        ====================================================== --}}

        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:mb-6">

            <div class="tw:w-full tw:lg:w-4/12 tw:px-2">

                <div class="tw:flex tw:items-center tw:gap-3 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03] tw:p-4 tw:[&_span]:block tw:[&_span]:text-xs tw:[&_span]:text-gray-500 tw:[&_.fa]:text-brand-500">

                    <div class="tw:flex tw:size-10 tw:shrink-0 tw:items-center tw:justify-center tw:rounded-full tw:text-white">

                        <span class="fa fa-search"></span>

                    </div>

                    <div>

                        <span>
                            ESTADO
                        </span>

                        <strong>
                            Revisión
                        </strong>

                    </div>

                </div>

            </div>


            <div class="tw:w-full tw:lg:w-4/12 tw:px-2">

                <div class="tw:flex tw:items-center tw:gap-3 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03] tw:p-4 tw:[&_span]:block tw:[&_span]:text-xs tw:[&_span]:text-gray-500 tw:[&_.fa]:text-amber-500 tw:border-amber-300">

                    <div class="tw:flex tw:size-10 tw:shrink-0 tw:items-center tw:justify-center tw:rounded-full tw:text-white">

                        <span class="fa fa-pencil-square-o"></span>

                    </div>

                    <div>

                        <span>
                            ESTADO ACTUAL
                        </span>

                        <strong>
                            Modificación
                        </strong>

                    </div>

                </div>

            </div>


            <div class="tw:w-full tw:lg:w-4/12 tw:px-2">

                <div class="tw:flex tw:items-center tw:gap-3 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03] tw:p-4 tw:[&_span]:block tw:[&_span]:text-xs tw:[&_span]:text-gray-500 tw:[&_.fa]:text-green-600">

                    <div class="tw:flex tw:size-10 tw:shrink-0 tw:items-center tw:justify-center tw:rounded-full tw:text-white">

                        <span class="fa fa-check"></span>

                    </div>

                    <div>

                        <span>
                            ESTADO
                        </span>

                        <strong>
                            Autorizados
                        </strong>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             TABS
        ====================================================== --}}

        <div>

            <div class="tw:mb-2">

                <div class="tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">

                    <span class="fa fa-tasks"></span>

                    Seguimiento de anteproyectos

                </div>

            </div>


            <ul class="tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200 tw:dark:border-gray-800">

                {{-- =================================================
                     TAB REVISIÓN
                ================================================== --}}

                <li>

                    <a
                        href="{{ url('/residencia/proceso_revision_anteproyecto/'.$id_carrera) }}">

                        <span class="tw:mr-2 tw:inline-flex tw:size-8 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-50 tw:text-brand-500">

                            <span class="fa fa-search"></span>

                        </span>

                        <span class="tw:inline-block tw:text-left tw:[&_strong]:block tw:[&_small]:text-gray-500">

                            <strong>
                                En revisión
                            </strong>

                            <small>
                                Anteproyectos pendientes
                            </small>

                        </span>

                    </a>

                </li>


                {{-- =================================================
                     TAB MODIFICACIÓN
                ================================================== --}}

                <li class="active">

                    <a href="#">

                        <span class="tw:mr-2 tw:inline-flex tw:size-8 tw:items-center tw:justify-center tw:rounded-full tw:bg-amber-50 tw:text-amber-600">

                            <span class="fa fa-pencil-square-o"></span>

                        </span>

                        <span class="tw:inline-block tw:text-left tw:[&_strong]:block tw:[&_small]:text-gray-500">

                            <strong>
                                En modificación
                            </strong>

                            <small>
                                Requieren cambios
                            </small>

                        </span>

                    </a>

                </li>


                {{-- =================================================
                     TAB AUTORIZADOS
                ================================================== --}}

                <li>

                    <a
                        href="{{ url('/residencia/ver_estados_alumnos/'.$id_carrera) }}">

                        <span class="tw:mr-2 tw:inline-flex tw:size-8 tw:items-center tw:justify-center tw:rounded-full tw:bg-green-50 tw:text-green-600">

                            <span class="fa fa-check"></span>

                        </span>

                        <span class="tw:inline-block tw:text-left tw:[&_strong]:block tw:[&_small]:text-gray-500">

                            <strong>
                                Autorizados
                            </strong>

                            <small>
                                Anteproyectos aprobados
                            </small>

                        </span>

                    </a>

                </li>

            </ul>

        </div>


        {{-- =====================================================
             INFORMACIÓN
        ====================================================== --}}

        <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:flex tw:items-start tw:gap-3 tw:border-amber-200 tw:bg-amber-50 tw:text-amber-800">

            <div class="tw:text-xl">

                <span class="fa fa-pencil-square-o"></span>

            </div>

            <div>

                <strong>
                    Anteproyectos en proceso de modificación
                </strong>

                <p>

                    En esta sección aparecen los anteproyectos que
                    requieren modificaciones por parte del estudiante.

                    Una vez realizadas las modificaciones, el estudiante
                    deberá enviarlo nuevamente a sus revisores.

                </p>

            </div>

        </div>


        {{-- =====================================================
             TABLA
        ====================================================== --}}

        <div class="tw:mb-6 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

            <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-between tw:gap-3 tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:px-5 tw:py-4">

                <div>

                    <span class="fa fa-list-alt"></span>

                    <strong>
                        Lista de anteproyectos en modificación
                    </strong>

                </div>

                <span class="status-general-orange tw:inline-flex tw:items-center tw:gap-1 tw:rounded-full tw:bg-green-50 tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:text-green-700">

                    <span class="fa fa-pencil-square-o"></span>

                    En modificación

                </span>

            </div>


            <div class="tw:p-5 tw:sm:p-6">

                <div class="tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800">

                    <table
                        id="table_revision_asesor"
                        class="tw-tabla tw-tabla-bordes">

                        <thead>

                        <tr>

                            <th>

                                <span class="fa fa-credit-card"></span>

                                No. cuenta

                            </th>


                            <th>

                                <span class="fa fa-user"></span>

                                Nombre del alumno

                            </th>


                            <th>

                                <span class="fa fa-book"></span>

                                Nombre del anteproyecto

                            </th>


                            <th>

                                <span class="fa fa-info-circle"></span>

                                Estado

                            </th>

                        </tr>

                        </thead>


                        <tbody>

                        @foreach ($anteproyecto_autorizados as $anteproyecto)

                            <tr>


                                {{-- =========================================
                                     CUENTA
                                ========================================== --}}

                                <td class="tw:text-center">

                                    <span class="tw:inline-flex tw:rounded-full tw:bg-brand-50 tw:px-2.5 tw:py-0.5 tw:font-medium tw:text-brand-500">

                                        {{ $anteproyecto->cuenta }}

                                    </span>

                                </td>


                                {{-- =========================================
                                     ALUMNO
                                ========================================== --}}

                                <td>

                                    <div class="tw:flex tw:items-center tw:gap-3 tw:[&_strong]:block tw:[&_small]:text-gray-500">

                                        <div class="tw:flex tw:size-10 tw:shrink-0 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-50 tw:text-brand-500">

                                            <span class="fa fa-user"></span>

                                        </div>

                                        <div>

                                            <strong>

                                                {{ $anteproyecto->nombre }}
                                                {{ $anteproyecto->apaterno }}
                                                {{ $anteproyecto->amaterno }}

                                            </strong>

                                            <small>
                                                Alumno de residencia
                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- =========================================
                                     PROYECTO
                                ========================================== --}}

                                <td>

                                    <div class="tw:flex tw:items-start tw:gap-2">

                                        <span class="fa fa-book"></span>

                                        <span>

                                            {{ $anteproyecto->nom_proyecto }}

                                        </span>

                                    </div>

                                </td>


                                {{-- =========================================
                                     ESTADO
                                ========================================== --}}

                                <td class="tw:text-center">


                                    @if($anteproyecto->estado_enviado == 0)

                                        <div class="estado-card estado-danger">

                                            <div class="estado-icon">

                                                <span class="fa fa-paper-plane"></span>

                                            </div>

                                            <div>

                                                <strong>
                                                    NO ENVIADO
                                                </strong>

                                                <small>

                                                    El estudiante aún no ha
                                                    enviado su proyecto a sus
                                                    revisores.

                                                </small>

                                            </div>

                                        </div>


                                    @elseif($anteproyecto->estado_enviado == 2)

                                        <div class="estado-card estado-warning">

                                            <div class="estado-icon">

                                                <span class="fa fa-pencil-square-o"></span>

                                            </div>

                                            <div>

                                                <strong>
                                                    EN MODIFICACIÓN
                                                </strong>

                                                <small>

                                                    El estudiante debe realizar
                                                    las modificaciones y enviarlo
                                                    nuevamente a sus revisores.

                                                </small>

                                            </div>

                                        </div>

                                        
                                    @elseif($anteproyecto->estado_enviado == 4)

                                        <div class="estado-card estado-warning">

                                            <div class="estado-icon">

                                                <span class="fa fa-pencil-square-o"></span>

                                            </div>

                                            <div>

                                                <strong>
                                                    EN MODIFICACIÓN 
                                                </strong>

                                                <small>

                                                    El estudiante debe realizar
                                                    las modificaciones y enviarlo
                                                    nuevamente para que el departamento de servicio social y residencia lo autorice.

                                                </small>

                                            </div>

                                        </div>




                                    @else

                                        <div class="estado-card estado-default">

                                            <div class="estado-icon">

                                                <span class="fa fa-question-circle"></span>

                                            </div>

                                            <div>

                                                <strong>
                                                    ESTADO DESCONOCIDO
                                                </strong>

                                                <small>
                                                    Consulte la información del proyecto.
                                                </small>

                                            </div>

                                        </div>

                                    @endif


                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


    @endif


</div>


{{-- =============================================================
     ESTILOS
============================================================= --}}

{{-- =============================================================
     JAVASCRIPT
============================================================= --}}

<script>

$(document).ready(function () {


    /*
    =============================================================
    DATATABLE
    =============================================================
    */

    $('#table_revision_asesor').DataTable({

        language: {

            search: "Buscar:",

            lengthMenu:
                "Mostrar _MENU_ registros",

            zeroRecords:
                "No se encontraron resultados",

            info:
                "Mostrando _START_ a _END_ de _TOTAL_ registros",

            infoEmpty:
                "No hay registros disponibles",

            infoFiltered:
                "(filtrado de _MAX_ registros)",

            paginate: {

                first: "Primero",

                last: "Último",

                next: "Siguiente",

                previous: "Anterior"

            }

        }

    });


    /*
    =============================================================
    CAMBIO DE CARRERA
    =============================================================
    */

    $("#carrera").on('change', function () {

        var id_carrera = $(this).val();


        if (id_carrera) {

            window.location.href =
                '/residencia/proceso_mod_anteproyecto/' +
                id_carrera;

        }

    });

});

</script>

</div>
@endsection
