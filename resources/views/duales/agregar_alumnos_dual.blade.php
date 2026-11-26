@extends('layouts.panel')
@section('title', 'Agregar Alumnos en Plantilla')

@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

<main class="tw:w-full tw:lg:w-full tw:px-2">
    {{-- ===================================================== --}}
    {{-- ENCABEZADO --}}
    {{-- ===================================================== --}}

    <x-panel.encabezado titulo="Gestión de alumnos duales" :migas="['Educación dual' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">

            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                

                <div class="tw:p-5 tw:sm:p-6 tw:text-center">
                    <p class="tw:text-gray-500 tw:dark:text-gray-400 tw:m-0">
                        Administra los alumnos candidatos y los alumnos registrados en la plantilla dual.
                    </p>
                </div>

            </div>

        </div>
    </div>

    @if(!empty($aviso))
        <x-panel.alerta tipo="advertencia" class="tw:mb-4">
            <span class="fa fa-info-circle"></span> {{ $aviso }}
        </x-panel.alerta>
    @endif

    {{-- ===================================================== --}}
    {{-- TABLAS --}}
    {{-- ===================================================== --}}

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        {{-- ================================================= --}}
        {{-- ALUMNOS CANDIDATOS --}}
        {{-- ================================================= --}}

        <div class="tw:w-full tw:lg:w-7/12 tw:px-2">

            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                    <h4 class="tw:text-center tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                        <span class="fa fa-user"></span>
                        ALUMNOS CANDIDATOS A SER DUALES
                    </h4>
                </div>

                <div class="tw:p-5 tw:sm:p-6">

                    @if($estado_periodo == 1)

                    <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800">
                        <span class="fa fa-check-circle"></span>
                        <strong>Periodo activo.</strong>
                        Puedes agregar alumnos a la plantilla.
                    </div>

                    @else

                    <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-amber-200 tw:bg-amber-50 tw:text-amber-800">
                        <span class="fa fa-exclamation-triangle"></span>
                        <strong>Periodo cerrado.</strong>
                        No es posible agregar alumnos.
                    </div>

                    @endif

                    <div class="tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800">

                        <table id="paginar_table" class="tw-tabla tw-tabla-bordes tw-tabla-rayas">

                            <thead>
                                <tr class="tw:bg-sky-50">

                                    <th>No. de Cuenta</th>
                                    <th>Nombre</th>
                                    <th>Apellido Paterno</th>
                                    <th>Apellido Materno</th>
                                    <th class="tw:w-22.5">Agregar</th>

                                </tr>
                            </thead>

                            <tbody>

                                @foreach($array_estudiantes as $estudiante)

                                <tr>

                                    <td>
                                        <strong>
                                            {{ $estudiante['cuenta'] }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $estudiante['nombre'] }}
                                    </td>

                                    <td>
                                        {{ $estudiante['apaterno'] }}
                                    </td>

                                    <td>
                                        {{ $estudiante['amaterno'] }}
                                    </td>

                                    <td class="tw:text-center">

                                        @if($estado_periodo == 1)

                                        <a href="javascript:void(0);" class="agrega tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"
                                            data-id="{{ $estudiante['id_alumno'] }}" title="Agregar alumno"><span class="fa fa-sign-in"></span></a>

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

        {{-- ================================================= --}}
        {{-- ALUMNOS EN PLANTILLA --}}
        {{-- ================================================= --}}

        <div class="tw:w-full tw:lg:w-5/12 tw:px-2">

            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                    <h4 class="tw:text-center tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                        <span class="fa fa-list-alt"></span>
                        ALUMNOS DUALES EN PLANTILLA
                    </h4>
                </div>

                <div class="tw:p-5 tw:sm:p-6">

                    @if($estado_periodo == 1)

                    <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800">
                        <span class="fa fa-check-circle"></span>
                        <strong>Periodo activo.</strong>
                        Puedes modificar la plantilla.
                    </div>

                    @else

                    <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-amber-200 tw:bg-amber-50 tw:text-amber-800">
                        <span class="fa fa-exclamation-triangle"></span>
                        <strong>Periodo cerrado.</strong>
                        No es posible modificar la plantilla.
                    </div>

                    @endif

                    <div class="tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800">

                        <table id="paginar_tabla" class="tw-tabla tw-tabla-bordes tw-tabla-rayas">

                            <thead>
                                <tr class="tw:bg-green-50">

                                    <th>No. Cuenta</th>
                                    <th>Nombre del alumno</th>
                                    <th class="tw:w-20">Eliminar</th>

                                </tr>
                            </thead>

                            <tbody>

                                @foreach($plantillas as $plantilla)

                                <tr>

                                    <td>
                                        <strong>
                                            {{ $plantilla->cuenta }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $plantilla->nombre }}
                                        {{ $plantilla->apaterno }}
                                        {{ $plantilla->amaterno }}
                                    </td>

                                    <td class="tw:text-center">

                                        @if($estado_periodo == 1)

                                        <a href="javascript:void(0);" class="elimina tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base"
                                            data-id_alumno="{{ $plantilla->id_duales_actuales }}"
                                            title="Eliminar alumno"><span class="fa fa-trash"></span></a>

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

    {{-- ===================================================== --}}
    {{-- MODAL AGREGAR ALUMNO --}}
    {{-- ===================================================== --}}

    <x-panel.modal id="modal_agrega" tamano="sm" sin-relleno clase-cerrar="close" aria-labelledby="modalAgregarLabel">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">

                    

                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="modalAgregarLabel">
                        <span class="fa fa-user"></span>
                        Agregar alumno
                    </h4>

                </div>

                <div class="tw-modal-cuerpo tw:text-center">

                    <form action="{{ url('/duales/guardar_alumno_dual') }}" method="POST" role="form"
                        id="form_alumno_crea">

                        {{ csrf_field() }}

                        <input type="hidden" id="alumno" name="alumno" value="">

                        <div class="tw:text-gray-600 tw:dark:text-gray-400">

                            <span class="fa fa-question-circle tw:text-sky-600"></span>

                            <br><br>

                            <strong>
                                ¿Realmente deseas agregar a este alumno a la plantilla?
                            </strong>

                        </div>

                    </form>

                </div>

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">

                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">

                        <span class="fa fa-times"></span>
                        Cancelar

                    </button>

                    <button id="confirma_agrega" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">

                        <span class="fa fa-check"></span>
                        Aceptar

                    </button>

                </div>

            </x-panel.modal>

    {{-- ===================================================== --}}
    {{-- MODAL ELIMINAR ALUMNO --}}
    {{-- ===================================================== --}}

    <x-panel.modal id="modal_elimina" tamano="sm" sin-relleno clase-cerrar="close" aria-labelledby="modalEliminarLabel">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">

                    

                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="modalEliminarLabel">
                        <span class="fa fa-trash"></span>
                        Eliminar alumno
                    </h4>

                </div>

                <div class="tw-modal-cuerpo tw:text-center">

                    <form action="" method="POST" role="form" id="form_delete">

                        {{ csrf_field() }}

                        <input type="hidden" id="eliminar_alumno" name="eliminar_alumno" value="">

                        <div class="tw:text-gray-600 tw:dark:text-gray-400">

                            <span class="fa fa-exclamation-triangle tw:text-red-600"></span>

                            <br><br>

                            <strong>
                                ¿Realmente deseas eliminar este alumno de la plantilla?
                            </strong>

                        </div>

                    </form>

                </div>

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">

                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">

                        <span class="fa fa-times"></span>
                        Cancelar

                    </button>

                    <button id="confirma_elimina" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">

                        <span class="fa fa-check"></span>
                        Aceptar

                    </button>

                </div>

            </x-panel.modal>

    {{-- ===================================================== --}}
    {{-- MODAL MATERIAS --}}
    {{-- ===================================================== --}}

    <form id="form_ver_materias" role="form" method="POST">

        <x-panel.modal id="modal_materias" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="modalMateriasLabel">

                    <div class="tw:px-6 tw:pt-6 tw:pr-14">

                        

                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="modalMateriasLabel">

                            <span class="fa fa-book"></span>
                            MATERIAS

                        </h4>

                    </div>

                    <div class="tw-modal-cuerpo">

                        {{ csrf_field() }}

                        <input type="hidden" id="alumnM" name="alumnM" value="">

                        <input type="hidden" id="materias" name="materias" value="">

                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                            <div class="tw:w-full tw:lg:w-full tw:px-2" id="contenedor_materias">

                            </div>

                        </div>

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">

                        <button type="button" class="acepta tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">

                            <span class="fa fa-plus"></span>
                            Agregar

                        </button>

                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">

                            Cerrar

                        </button>

                    </div>

                </x-panel.modal>

    </form>

</main>
<script>
    $(document).ready(function() {
        /* |-------------------------------------------------------------------------- | DATATABLES |-------------------------------------------------------------------------- */
        $('#paginar_table').DataTable({
            language: {
                search: "Buscar:",
                lengthMenu: "Mostrar _MENU_ registros",
                zeroRecords: "No se encontraron alumnos",
                info: "Mostrando _START_ a _END_ de _TOTAL_ alumnos",
                infoEmpty: "No hay alumnos disponibles",
                infoFiltered: "(filtrado de _MAX_ registros)",
                paginate: {
                    first: "Primero",
                    last: "Último",
                    next: "Siguiente",
                    previous: "Anterior"
                }
            }
        });
        $('#paginar_tabla').DataTable({
            language: {
                search: "Buscar:",
                lengthMenu: "Mostrar _MENU_ registros",
                zeroRecords: "No hay alumnos en plantilla",
                info: "Mostrando _START_ a _END_ de _TOTAL_ alumnos",
                infoEmpty: "No hay alumnos disponibles",
                infoFiltered: "(filtrado de _MAX_ registros)",
                paginate: {
                    first: "Primero",
                    last: "Último",
                    next: "Siguiente",
                    previous: "Anterior"
                }
            }
        }); /* |-------------------------------------------------------------------------- | AGREGAR ALUMNO |-------------------------------------------------------------------------- */
        $("#paginar_table").on('click', '.agrega', function() {
            var id_alumno = $(this).data('id');
            $('#alumno').val(id_alumno);
            $('#modal_agrega').modal({
                backdrop: 'static',
                keyboard: false
            });
        }); /* |-------------------------------------------------------------------------- | CONFIRMAR AGREGAR |-------------------------------------------------------------------------- */
        $("#confirma_agrega").click(function(event) {
            event.preventDefault();
            var boton = $(this);
            boton.prop('disabled', true);
            $("#form_alumno_crea").submit();
        }); /* |-------------------------------------------------------------------------- | ELIMINAR ALUMNO |-------------------------------------------------------------------------- */
        $("#paginar_tabla").on('click', '.elimina', function() {
            var id_duales_actuales = $(this).data('id_alumno');
            $('#eliminar_alumno').val(id_duales_actuales);
            $('#modal_elimina').modal({
                backdrop: 'static',
                keyboard: false
            });
        }); /* |-------------------------------------------------------------------------- | CONFIRMAR ELIMINAR |-------------------------------------------------------------------------- */
        $("#confirma_elimina").click(function(event) {
            event.preventDefault();
            var eliminar_alumno = $("#eliminar_alumno").val();
            if (!eliminar_alumno) {
                return;
            }
            var boton = $(this);
            boton.prop('disabled', true);
            $("#form_delete").attr("action", "/duales/Eliminar_dual/" + eliminar_alumno);
            $("#form_delete").submit();
        }); /* |-------------------------------------------------------------------------- | CERRAR MODALES - RESTABLECER BOTONES |-------------------------------------------------------------------------- */
        $('#modal_agrega').on('hidden.bs.modal', function() {
            $('#confirma_agrega').prop('disabled', false);
        });
        $('#modal_elimina').on('hidden.bs.modal', function() {
            $('#confirma_elimina').prop('disabled', false);
        });
    });
</script>
</div>
@endsection