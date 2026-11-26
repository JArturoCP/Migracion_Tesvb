@extends('layouts.panel')

@section('title', 'Status de los Anteproyectos')

@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

<div class = "main">
    <div>

    {{-- =========================================================
         ENCABEZADO PRINCIPAL
    ========================================================== --}}

    <x-panel.encabezado titulo="Status de los Anteproyectos" :migas="['Residencia profesional' => null]"><x-slot:extra><x-panel.badge>Periodo {{ $nombre_periodo }}</x-panel.badge></x-slot:extra></x-panel.encabezado>
    <p class="tw:mb-6 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">Gestión y seguimiento de los anteproyectos de los alumnos</p>


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
                                    {{ $mostrar == 0 ? 'selected' : '' }}
                                    hidden>

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
             RESUMEN
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

                <div class="tw:flex tw:items-center tw:gap-3 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03] tw:p-4 tw:[&_span]:block tw:[&_span]:text-xs tw:[&_span]:text-gray-500 tw:[&_.fa]:text-amber-500">

                    <div class="tw:flex tw:size-10 tw:shrink-0 tw:items-center tw:justify-center tw:rounded-full tw:text-white">

                        <span class="fa fa-pencil-square-o"></span>

                    </div>

                    <div>

                        <span>
                            ESTADO
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
             TABS PRINCIPALES
        ====================================================== --}}

        <div>

            <div class="tw:mb-2">

                <div class="tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">

                    <span class="fa fa-tasks"></span>

                    Seguimiento de anteproyectos

                </div>

            </div>


            <ul class="tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200 tw:dark:border-gray-800">

                {{-- TAB 1 --}}

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


                {{-- TAB 2 --}}

                <li>

                    <a
                        href="{{ url('/residencia/proceso_mod_anteproyecto/'.$id_carrera) }}">

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


                {{-- TAB 3 --}}

                <li class="active">

                    <a href="#">

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

        <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:flex tw:items-start tw:gap-3">

            <div class="tw:text-xl">

                <span class="fa fa-info-circle"></span>

            </div>

            <div>

                <strong>
                    Anteproyectos autorizados
                </strong>

                <p>

                    Los anteproyectos que aparecen en esta sección
                    han sido autorizados por los revisores.

                    También puedes administrar el permiso de modificación.

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
                        Lista de anteproyectos autorizados
                    </strong>

                </div>

                <span class="tw:inline-flex tw:items-center tw:gap-1 tw:rounded-full tw:bg-green-50 tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:text-green-700">

                    <span class="fa fa-check-circle-o"></span>

                    Autorizados

                </span>

            </div>


            <div class="tw:p-5 tw:sm:p-6">

                <div class="tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800">

                    <table
                        id="table_autorizar_doc_final"
                        class="tw-tabla tw-tabla-bordes">

                        <thead>

                        <tr>

                            <th>
                                <span class="fa fa-credit-card"></span>
                                No. cuenta
                            </th>

                            <th>
                                <span class="fa fa-user"></span>
                                Alumno
                            </th>

                            <th>
                                <span class="fa fa-book"></span>
                                Anteproyecto
                            </th>

                            <th>
                                <span class="fa fa-file"></span>
                                Documento
                            </th>

                            <th>
                                <span class="fa fa-pencil-square-o"></span>
                                Permiso de modificación
                            </th>

                        </tr>

                        </thead>


                        <tbody>

                        @foreach ($array_anteproyecto as $anteproyecto)

                            <tr>


                                {{-- ================================================
                                     CUENTA
                                ================================================= --}}

                                <td class="tw:text-center">

                                    <span class="tw:inline-flex tw:rounded-full tw:bg-brand-50 tw:px-2.5 tw:py-0.5 tw:font-medium tw:text-brand-500">

                                        {{ $anteproyecto['cuenta'] }}

                                    </span>

                                </td>


                                {{-- ================================================
                                     ALUMNO
                                ================================================= --}}

                                <td>

                                    <div class="tw:flex tw:items-center tw:gap-3 tw:[&_strong]:block tw:[&_small]:text-gray-500">

                                        <div class="tw:flex tw:size-10 tw:shrink-0 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-50 tw:text-brand-500">

                                            <span class="fa fa-user"></span>

                                        </div>

                                        <div>

                                            <strong>

                                                {{ $anteproyecto['nombre'] }}

                                            </strong>

                                            <small>
                                                Alumno de residencia
                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- ================================================
                                     PROYECTO
                                ================================================= --}}

                                <td>

                                    <div class="tw:flex tw:items-start tw:gap-2">

                                        <span class="fa fa-book"></span>

                                        <span>

                                            {{ $anteproyecto['nom_proyecto'] }}

                                        </span>

                                    </div>

                                </td>


                                {{-- ================================================
                                     DOCUMENTO
                                ================================================= --}}

                                <td class="tw:text-center">

                                    @if($anteproyecto['estado_empresa'] == 2)

                                        <button
                                            type="button"
                                            class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap"
                                            onclick="window.open('{{ url('/pdf_documento_presentacion_residencia/'.$anteproyecto['id_anteproyecto']) }}')">

                                            <span class="fa fa-print"></span>

                                            Imprimir

                                        </button>


                                    @elseif($anteproyecto['estado_empresa'] == 1)

                                        <span class="tw:inline-flex tw:items-center tw:gap-1 tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:bg-amber-50 tw:text-amber-700">

                                            <span class="fa fa-exclamation-triangle"></span>

                                            Sin asesor interno

                                        </span>


                                    @elseif($anteproyecto['estado_empresa'] == 0)

                                        <span class="tw:inline-flex tw:items-center tw:gap-1 tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:bg-red-50 tw:text-red-600">

                                            <span class="fa fa-times"></span>

                                            Sin empresa

                                        </span>

                                    @else

                                        <span class="tw:inline-flex tw:items-center tw:gap-1 tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-700 tw:dark:text-gray-300">

                                            <span class="fa fa-minus"></span>

                                            No disponible

                                        </span>

                                    @endif

                                </td>


                                {{-- ================================================
                                     PERMISO
                                ================================================= --}}

                                <td class="tw:text-center">

                                    @if(
                                        isset($anteproyecto['permiso_modificacion']) &&
                                        $anteproyecto['permiso_modificacion'] == 1
                                    )

                                        <div class="tw:rounded-xl tw:border tw:p-3 tw:border-green-200 tw:bg-green-50">

                                            <div class="tw:mb-2 tw:flex tw:items-center tw:justify-center tw:gap-2 tw:text-left tw:[&_strong]:block tw:[&_small]:block">

                                                <span class="tw:flex tw:size-10 tw:shrink-0 tw:items-center tw:justify-center tw:rounded-full tw:text-white tw:bg-green-600">

                                                    <span class="fa fa-check"></span>

                                                </span>

                                                <div>

                                                    <strong>
                                                        PERMISO ACTIVO
                                                    </strong>

                                                    <small>
                                                        Puede modificar
                                                    </small>

                                                </div>

                                            </div>


                                            <button
                                                type="button"
                                                class="btn-quitar-permiso tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap"
                                                data-id="{{ $anteproyecto['id_anteproyecto'] }}"
                                                data-nombre="{{ $anteproyecto['nombre'] }}">

                                                <span class="fa fa-lock"></span>

                                                Quitar permiso

                                            </button>

                                        </div>


                                    @else

                                        <div class="tw:rounded-xl tw:border tw:p-3 tw:border-gray-200 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900">

                                            <div class="tw:mb-2 tw:flex tw:items-center tw:justify-center tw:gap-2 tw:text-left tw:[&_strong]:block tw:[&_small]:block">

                                                <span class="tw:flex tw:size-10 tw:shrink-0 tw:items-center tw:justify-center tw:rounded-full tw:text-white tw:bg-gray-500">

                                                    <span class="fa fa-lock"></span>

                                                </span>

                                                <div>

                                                    <strong>
                                                        SIN PERMISO
                                                    </strong>

                                                    <small>
                                                        Modificación bloqueada
                                                    </small>

                                                </div>

                                            </div>


                                           <button
    type="button"
    class="btn-permiso-modificacion tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap"
    data-id="{{ $anteproyecto['id_anteproyecto'] }}"
    data-nombre="{{ $anteproyecto['nombre'] }}"
    data-proyecto="{{ $anteproyecto['nom_proyecto'] }}">

    <span class="fa fa-pencil"></span>

    Dar permiso

</button>


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


    {{-- =========================================================
         MODAL DAR PERMISO
    ========================================================== --}}

    <x-panel.modal id="modalPermisoModificacion" tamano="md" sin-relleno clase-cerrar="close">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">

                    

                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">

                        <span class="fa fa-pencil-square-o"></span>

                        Dar permiso de modificación

                    </h4>

                </div>


                <div class="tw-modal-cuerpo">

                    <div class="tw:mx-auto tw:mb-4 tw:flex tw:size-16 tw:items-center tw:justify-center tw:rounded-full tw:text-2xl tw:bg-amber-50 tw:text-amber-600">

                        <span class="fa fa-pencil"></span>

                    </div>


                    <h3 class="tw:text-center tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">

                        ¿Dar permiso de modificación?

                    </h3>


                    <p class="tw:text-center tw:text-gray-500 tw:dark:text-gray-400">

                        El alumno podrá modificar su anteproyecto.

                    </p>


                    <div class="tw:my-4 tw:flex tw:items-center tw:gap-3 tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:p-4 tw:[&_strong]:block tw:[&_small]:block">

                        <div class="tw:flex tw:size-10 tw:shrink-0 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-white">

                            <span class="fa fa-user"></span>

                        </div>

                        <div>

                            <small>
                                ALUMNO
                            </small>

                            <strong id="nombreAlumno">
                                -
                            </strong>

                        </div>

                    </div>


                    <x-panel.alerta tipo="advertencia" class="tw:mb-4">

                        <span class="fa fa-exclamation-triangle"></span>

                        <strong>Importante:</strong>

                        Al otorgar el permiso, el alumno podrá realizar
                        modificaciones a su anteproyecto.

                    </x-panel.alerta>


                    <input
                        type="hidden"
                        id="id_anteproyecto_modificacion">

                </div>


                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">

                    <button
                        type="button"
                        class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"
                        data-dismiss="modal">

                        <span class="fa fa-times"></span>

                        Cancelar

                    </button>


                    <button
                        type="button"
                        class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:disabled:bg-amber-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"
                        id="btnConfirmarPermiso">

                        <span class="fa fa-check"></span>

                        Sí, dar permiso

                    </button>

                </div>

            </x-panel.modal>


    {{-- =========================================================
         MODAL QUITAR PERMISO
    ========================================================== --}}

    <x-panel.modal id="modalQuitarPermiso" tamano="md" sin-relleno clase-cerrar="close">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">

                    

                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">

                        <span class="fa fa-lock"></span>

                        Quitar permiso de modificación

                    </h4>

                </div>


                <div class="tw-modal-cuerpo">

                    <div class="tw:mx-auto tw:mb-4 tw:flex tw:size-16 tw:items-center tw:justify-center tw:rounded-full tw:text-2xl tw:bg-red-50 tw:text-red-600">

                        <span class="fa fa-lock"></span>

                    </div>


                    <h3 class="tw:text-center tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">

                        ¿Quitar permiso?

                    </h3>


                    <p class="tw:text-center tw:text-gray-500 tw:dark:text-gray-400">

                        El alumno dejará de poder modificar su anteproyecto.

                    </p>


                    <div class="tw:my-4 tw:flex tw:items-center tw:gap-3 tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:p-4 tw:[&_strong]:block tw:[&_small]:block">

                        <div class="tw:flex tw:size-10 tw:shrink-0 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-white">

                            <span class="fa fa-user"></span>

                        </div>

                        <div>

                            <small>
                                ALUMNO
                            </small>

                            <strong id="nombreAlumnoQuitar">
                                -
                            </strong>

                        </div>

                    </div>


                    <x-panel.alerta tipo="error" class="tw:mb-4">

                        <span class="fa fa-exclamation-triangle"></span>

                        <strong>Atención:</strong>

                        Se desactivará el permiso de modificación.

                    </x-panel.alerta>


                    <input
                        type="hidden"
                        id="id_anteproyecto_quitar">

                </div>


                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">

                    <button
                        type="button"
                        class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"
                        data-dismiss="modal">

                        <span class="fa fa-times"></span>

                        Cancelar

                    </button>


                    <button
                        type="button"
                        class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"
                        id="btnConfirmarQuitarPermiso">

                        <span class="fa fa-lock"></span>

                        Quitar permiso

                    </button>

                </div>

            </x-panel.modal>


</div>
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

    $('#table_autorizar_doc_final').DataTable({

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
                '/residencia/ver_estados_alumnos/' +
                id_carrera;

        }

    });


    /*
    =============================================================
    DAR PERMISO
    =============================================================
    */

    $("#table_autorizar_doc_final").on(
        'click',
        '.btn-permiso-modificacion',
        function () {

            var id =
                $(this).data('id');

            var nombre =
                $(this).data('nombre');


            $("#id_anteproyecto_modificacion")
                .val(id);


            $("#nombreAlumno")
                .text(nombre);


            $("#modalPermisoModificacion")
                .modal('show');

        }
    );


    /*
    =============================================================
    CONFIRMAR DAR PERMISO
    =============================================================
    */

    $("#btnConfirmarPermiso").on(
        'click',
        function () {

            var boton = $(this);

            var id =
                $("#id_anteproyecto_modificacion")
                .val();


            if (!id) {

                TNotify.alert(
                    "No se encontró el anteproyecto."
                );

                return;

            }


            boton.prop(
                'disabled',
                true
            );


            boton.html(
                '<span class="fa fa-refresh"></span> Guardando...'
            );


            $.ajax({

                url:
                    "{{ url('/residencia/permiso_modificacion_anteproyecto') }}",

                type: "POST",

                data: {

                    id_anteproyecto: id,

                    _token:
                        "{{ csrf_token() }}"

                },


                success: function (response) {

                    $("#modalPermisoModificacion")
                        .modal('hide');


                    location.reload();

                },


                error: function (xhr) {

                    console.log(
                        xhr.responseText
                    );


                    TNotify.alert(
                        "Ocurrió un error al otorgar el permiso."
                    );


                    boton.prop(
                        'disabled',
                        false
                    );


                    boton.html(
                        '<span class="fa fa-check"></span> Sí, dar permiso'
                    );

                }

            });

        }
    );


    /*
    =============================================================
    QUITAR PERMISO
    =============================================================
    */

    $("#table_autorizar_doc_final").on(
        'click',
        '.btn-quitar-permiso',
        function () {

            var id =
                $(this).data('id');

            var nombre =
                $(this).data('nombre');


            $("#id_anteproyecto_quitar")
                .val(id);


            $("#nombreAlumnoQuitar")
                .text(nombre);


            $("#modalQuitarPermiso")
                .modal('show');

        }
    );


    /*
    =============================================================
    CONFIRMAR QUITAR
    =============================================================
    */

    $("#btnConfirmarQuitarPermiso").on(
        'click',
        function () {

            var boton = $(this);

            var id =
                $("#id_anteproyecto_quitar")
                .val();


            if (!id) {

                TNotify.alert(
                    "No se encontró el anteproyecto."
                );

                return;

            }


            boton.prop(
                'disabled',
                true
            );


            boton.html(
                '<span class="fa fa-refresh"></span> Guardando...'
            );


            $.ajax({

                url:
                    "{{ url('/residencia/quitar_permiso_modificacion_anteproyecto') }}",

                type: "POST",

                data: {

                    id_anteproyecto: id,

                    _token:
                        "{{ csrf_token() }}"

                },


                success: function (response) {

                    $("#modalQuitarPermiso")
                        .modal('hide');


                    location.reload();

                },


                error: function (xhr) {

                    console.log(
                        xhr.responseText
                    );


                    TNotify.alert(
                        "Ocurrió un error al quitar el permiso."
                    );


                    boton.prop(
                        'disabled',
                        false
                    );


                    boton.html(
                        '<span class="fa fa-lock"></span> Quitar permiso'
                    );

                }

            });

        }
    );

});

</script>

</div>
@endsection
