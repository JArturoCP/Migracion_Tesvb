@extends('layouts.panel')
@section('title', 'Agregar Mentores duales en Plantilla')

@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

<main>
<div>

    {{-- ============================= --}}
    {{-- ENCABEZADO --}}
    {{-- ============================= --}}
    <x-panel.encabezado titulo="Agregar profesores duales a alumnos" :migas="['Educación dual' => null]" />


    @if(!empty($aviso))
        <x-panel.alerta tipo="advertencia" class="tw:mb-4">
            <span class="fa fa-info-circle"></span> {{ $aviso }}
        </x-panel.alerta>
    @endif

    {{-- ============================= --}}
    {{-- BOTÓN AGREGAR --}}
    {{-- ============================= --}}
    @if($estado_periodo == 1)
        <div class="tw:mb-4 tw:text-right">

            <button type="button"
                    class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"
                    data-toggle="modal"
                    data-target="#myModal">

                <span class="fa fa-plus"></span>
                Agregar Mentor al Alumno Dual

            </button>

        </div>
    @endif


    {{-- ============================= --}}
    {{-- TABLA --}}
    {{-- ============================= --}}
    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
            <strong>
                <span class="fa fa-list"></span>
                Mentores asignados
            </strong>
        </div>

        <div class="tw:p-5 tw:sm:p-6">

            <div>

                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="paginar_table"
                       class="tw-tabla tw-tabla-bordes tw-tabla-rayas">

                    <thead>
                    <tr class="tw:bg-sky-50">

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

                                    <a class="elimina tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base"
                                       data-id_duales_actuales="{{ $dato->id_duales_actuales }}"><span class="fa fa-trash tw:text-lg tw:text-red-600"></span></a>

                                @else

                                    <span class="tw:text-gray-500 tw:dark:text-gray-400">
                                        <span class="fa fa-lock"></span>
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


{{-- ================================================= --}}
{{-- MODAL AGREGAR MENTOR --}}
{{-- ================================================= --}}

<x-panel.modal id="myModal" tamano="md" sin-relleno clase-cerrar="close">

            <div class="tw:px-6 tw:pt-6 tw:pr-14">

                

                <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                    <span class="fa fa-graduation-cap"></span>
                    Agregar Mentor Dual
                </h4>

            </div>


            <div class="tw-modal-cuerpo">

                <form action="{{ url('/duales/guardar_mentor_dual') }}"
                      method="POST"
                      id="form_guardar_dual">

                    {{ csrf_field() }}


                    {{-- DOCENTE --}}
                    <div class="tw:mb-4">

                        <label for="id_profesor">

                            <span class="fa fa-user"></span>
                            Seleccione el docente que será mentor dual

                        </label>

                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"
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
                    <div class="tw:mb-4">

                        <label for="id_alumno">

                            <span class="fa fa-graduation-cap"></span>
                            Seleccione el alumno Dual

                        </label>

                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"
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


            <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">

                <button type="button"
                        class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"
                        id="btn_guardar">

                    <span class="fa fa-floppy-o"></span>
                    Guardar

                </button>

                <button type="button"
                        class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"
                        data-dismiss="modal">

                    <span class="fa fa-times"></span>
                    Salir

                </button>

            </div>

        </x-panel.modal>


{{-- ================================================= --}}
{{-- MODAL ELIMINAR --}}
{{-- ================================================= --}}

<x-panel.modal id="modal_elimina" tamano="sm" sin-relleno>

            <div class="tw-modal-cuerpo tw:pt-14 tw:text-center">

                <form method="POST"
                      role="form"
                      id="form_delete">

                    {{ csrf_field() }}

                    <input type="hidden"
                           id="eliminar_alumno"
                           name="eliminar_alumno"
                           value="">

                    <span class="fa fa-trash"
                         >
                    </span>

                    <br>
                    <br>

                    <strong>
                        ¿Realmente deseas eliminar este mentor?
                    </strong>


                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">

                        <button type="button"
                                class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"
                                data-dismiss="modal">

                            <span class="fa fa-times"></span>
                            Cancelar

                        </button>

                        <button id="confirma_elimina"
                                type="button"
                                class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">

                            <span class="fa fa-check"></span>
                            Aceptar

                        </button>

                    </div>

                </form>

            </div>

        </x-panel.modal>

</main> <script> $(document).ready(function () { /* |-------------------------------------------------------------------------- | DATATABLE |-------------------------------------------------------------------------- */ $('#paginar_table').DataTable({ pageLength: 10, language: { search: "Buscar:", lengthMenu: "Mostrar _MENU_ registros", info: "Mostrando _START_ a _END_ de _TOTAL_ registros", infoEmpty: "No hay registros", zeroRecords: "No se encontraron registros", paginate: { first: "Primero", last: "Último", next: "Siguiente", previous: "Anterior" } } }); /* |-------------------------------------------------------------------------- | GUARDAR MENTOR |-------------------------------------------------------------------------- */ $("#btn_guardar").click(function () { var id_profesor = $("#id_profesor").val(); var id_alumno = $("#id_alumno").val(); if (!id_profesor) { swal({ position: "top", type: "warning", title: "Selecciona un docente", showConfirmButton: false, timer: 2500 }); return false; } if (!id_alumno) { swal({ position: "top", type: "warning", title: "Selecciona un alumno", showConfirmButton: false, timer: 2500 }); return false; } $("#btn_guardar").prop("disabled", true); $("#form_guardar_dual").submit(); }); /* |-------------------------------------------------------------------------- | ABRIR MODAL ELIMINAR |-------------------------------------------------------------------------- */ $("#paginar_table").on("click", ".elimina", function () { var id_duales_actuales = $(this).data("id_duales_actuales"); $("#eliminar_alumno").val(id_duales_actuales); $("#modal_elimina").modal("show"); }); /* |-------------------------------------------------------------------------- | CONFIRMAR ELIMINACIÓN |-------------------------------------------------------------------------- */ $("#confirma_elimina").click(function () { var eliminar_alumno = $("#eliminar_alumno").val(); if (!eliminar_alumno) { return false; } $("#confirma_elimina").prop("disabled", true); $("#form_delete") .attr( "action", "/duales/eliminacion_dual/" + eliminar_alumno ); $("#form_delete").submit(); }); }); </script>

</div>
@endsection