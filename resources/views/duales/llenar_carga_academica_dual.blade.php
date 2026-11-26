@extends('layouts.panel')

@section('title', 'Registrar Carga Académica de los Alumnos Duales')

@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

<main class="tw:w-full tw:lg:w-full tw:px-2">

    <x-panel.encabezado titulo="Registrar carga académica de los alumnos duales" :migas="['Educación dual' => null]" />
    <div class="tw:w-full">

        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

            <div class="tw:w-full tw:lg:w-full tw:px-2">

                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                    <!-- =====================================================
                         ENCABEZADO
                    ====================================================== -->

                    

                    <!-- =====================================================
                         CUERPO
                    ====================================================== -->

                    <div class="tw:p-5 tw:sm:p-6">

                        <div class="tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800">

                            <table id="paginar_tabla" class="tw-tabla-centrada tw-tabla tw-tabla-bordes"
                               >

                                <thead>

                                    <tr>

                                        <th class="tw:text-center">
                                            No. cuenta
                                        </th>

                                        <th class="tw:text-center">
                                            Nombre del alumno
                                        </th>

                                        <th class="tw:text-center">

                                            <span class="fa fa-list-alt"></span>

                                            Llenar carga

                                        </th>

                                        <th class="tw:text-center">

                                            <span class="fa fa-check-circle-o"></span>

                                            Validar carga

                                        </th>

                                        <th class="tw:text-center">

                                            <span class="fa fa-trash"></span>

                                            Eliminar

                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach($plantillas as $plantilla)

                                    <tr>

                                        <!-- NO. CUENTA -->

                                        <td>

                                            <strong>
                                                {{ $plantilla->cuenta }}
                                            </strong>

                                        </td>

                                        <!-- NOMBRE -->

                                        <td class="tw:text-left">

                                            <span class="fa fa-user tw:text-gray-500 tw:dark:text-gray-400"></span>

                                            <span class="tw:font-medium">

                                                {{ $plantilla->nombre . " " . $plantilla->apaterno . " " . $plantilla->amaterno }}

                                            </span>

                                        </td>

                                        <!-- LLENAR CARGA -->

                                        <td class="tw:text-center">

                                            <a href="javascript:void(0);" class="materias tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"
                                                data-id_duales_actuales="{{ $plantilla->id_duales_actuales }}"
                                                title="Llenar carga académica"><span class="fa fa-list-alt"></span></a>

                                        </td>

                                        <!-- VALIDAR -->

                                        <td class="tw:text-center">

                                            <a href="{{ url('/duales/revision_control_escolar/'.$plantilla->id_alumno) }}"
                                                class="accion accion-validar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" title="Validar carga académica"><span class="fa fa-check-circle-o"></span></a>

                                        </td>

                                        <!-- ELIMINAR -->

                                        <td class="tw:text-center">

                                            @if($estado_periodo == 1)

                                            <a href="javascript:void(0);" class="elimina tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base"
                                                data-id_alumno="{{ $plantilla->id_duales_actuales }}"
                                                title="Eliminar alumno"><span class="fa fa-trash"></span></a>

                                            @else

                                            <span class="tw:inline-flex tw:size-9 tw:items-center tw:justify-center tw:rounded-full tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-400" title="No disponible durante este periodo">

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

    </div>


    <!-- =============================================================
         MODAL ELIMINAR ALUMNO
    ============================================================== -->

    <x-panel.modal id="modal_elimina" tamano="sm" sin-relleno clase-cerrar="close" aria-labelledby="modalEliminarLabel">

                <!-- HEADER -->

                <div class="tw:px-6 tw:pt-6 tw:pr-14">

                    

                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="modalEliminarLabel">

                        <span class="fa fa-exclamation-triangle"></span>

                        Confirmar eliminación

                    </h4>

                </div>

                <!-- BODY -->

                <div class="tw-modal-cuerpo tw:text-center">

                    <div class="tw:text-gray-600 tw:dark:text-gray-400">

                        <span class="fa fa-trash tw:text-3xl tw:text-red-600 tw:dark:text-red-400 tw:mb-4"
                            style="display:block">
                        </span>

                        <strong>
                            ¿Realmente deseas eliminar este elemento?
                        </strong>

                        <p class="tw:text-gray-500 tw:dark:text-gray-400">

                            Esta acción no podrá deshacerse.

                        </p>

                    </div>

                    <form action="" method="POST" role="form" id="form_delete">

                        {{ method_field('DELETE') }}

                        {{ csrf_field() }}

                        <input type="hidden" id="eliminar_alumno" name="eliminar_alumno" value="">

                    </form>

                </div>

                <!-- FOOTER -->

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">

                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">

                        <span class="fa fa-times"></span>

                        Cancelar

                    </button>

                    <button id="confirma_elimina" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">

                        <span class="fa fa-trash"></span>

                        Eliminar

                    </button>

                </div>

            </x-panel.modal>


    <!-- =============================================================
         MODAL MATERIAS
    ============================================================== -->

    <form id="form_ver_materias" role="form" method="POST">

        <x-panel.modal id="modal_materias" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="modalMateriasLabel">

                    <!-- HEADER -->

                    <div class="tw:px-6 tw:pt-6 tw:pr-14">

                        

                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="modalMateriasLabel">

                            <span class="fa fa-book"></span>

                            &nbsp; MATERIAS

                        </h4>

                    </div>

                    <!-- BODY -->

                    <div class="tw-modal-cuerpo">

                        {{ csrf_field() }}

                        <input type="hidden" id="alumnM" name="alumnM" value="">

                        <input type="hidden" id="materias" name="materias" value="">

                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                            <div class="tw:w-full tw:lg:w-full tw:px-2">

                                <div id="contenedor_materias">

                                    <div class="tw:text-center tw:text-gray-500 tw:dark:text-gray-400 tw:p-7.5">

                                        <span class="fa fa-refresh"></span>

                                        Cargando materias...

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- FOOTER -->

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">

                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">

                            <span class="fa fa-times"></span>

                            Cancelar

                        </button>

                        <button type="button" class="acepta tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">

                            <span class="fa fa-download"></span>

                            Agregar

                        </button>

                    </div>

                </x-panel.modal>

    </form>

</main>


<script>
$(document).ready(function() {

    /* ============================================================
       DATATABLE
    ============================================================ */

    $('#paginar_tabla').DataTable({

        language: {

            processing: "Procesando...",

            search: "Buscar:",

            lengthMenu: "Mostrar _MENU_ registros",

            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",

            infoEmpty: "Mostrando 0 a 0 de 0 registros",

            infoFiltered: "(filtrado de _MAX_ registros)",

            loadingRecords: "Cargando...",

            zeroRecords: "No se encontraron registros",

            emptyTable: "No hay alumnos registrados",

            paginate: {

                first: "Primero",

                previous: "Anterior",

                next: "Siguiente",

                last: "Último"

            }

        },

        pageLength: 10,

        responsive: true,

        order: [
            [1, 'asc']
        ]

    });


    /* ============================================================
       ABRIR MODAL ELIMINAR
    ============================================================ */

    $("#paginar_tabla").on('click', '.elimina', function() {

        var id_duales_actuales = $(this).data('id_alumno');

        $('#eliminar_alumno').val(id_duales_actuales);

        $('#modal_elimina').modal('show');

    });


    /* ============================================================
       CONFIRMAR ELIMINACIÓN
    ============================================================ */

    $("#confirma_elimina").click(function(event) {

        event.preventDefault();

        var eliminar_alumno = $("#eliminar_alumno").val();

        if (!eliminar_alumno) {

            return;

        }

        $("#form_delete").attr(
            "action",
            "/duales/Eliminar_dual/" + eliminar_alumno
        );

        $("#form_delete").submit();

    });


    /* ============================================================
       ABRIR MODAL DE MATERIAS
    ============================================================ */

    $("#paginar_tabla").on('click', '.materias', function() {

        var id_duales_actuales =
            $(this).data('id_duales_actuales');

        $('#alumnM').val(id_duales_actuales);

        $('#contenedor_materias').html(

            '<div class="tw:text-center tw:text-gray-500" style="padding:30px;">' +

            '<span class="fa fa-refresh"></span> ' +

            'Cargando materias...' +

            '</div>'

        );

        $('#modal_materias').modal('show');

        $.get(
            "/duales/alumnos/materias/" + id_duales_actuales,
            function(request) {

                $("#contenedor_materias").html(request);

            }
        );

    });


    /* ============================================================
       AGREGAR MATERIAS
    ============================================================ */

    $(".acepta").click(function() {

        var arreglo_materias = [];

        $('input[name="materia[]"]:checked').each(function() {

            arreglo_materias.push($(this).val());

        });


        /* --------------------------------------------------------
           VALIDAR MATERIAS
        -------------------------------------------------------- */

        if (arreglo_materias.length === 0) {

            TNotify.alert('Debes seleccionar al menos una materia.');

            return false;

        }


        /* --------------------------------------------------------
           GUARDAR MATERIAS
        -------------------------------------------------------- */

        $("#materias").val(
            arreglo_materias.join(',')
        );


        /* --------------------------------------------------------
           EVITAR DOBLE CLIC
        -------------------------------------------------------- */

        $(".acepta")
            .prop('disabled', true)
            .html(
                '<span class="fa fa-refresh"></span> Guardando...'
            );


        /* --------------------------------------------------------
           PETICIÓN
        -------------------------------------------------------- */

        $.post(
            "/duales/agrega/materias_alumnos",
            $("#form_ver_materias").serialize(),
            function(request) {

                window.location.href =
                    '/duales/llenar_carga_academica_dual';

            }
        ).fail(function() {

            $(".acepta")
                .prop('disabled', false)
                .html(
                    '<span class="fa fa-download"></span> Agregar'
                );

            TNotify.alert(
                'Ocurrió un error al guardar las materias.'
            );

        });

    });

});
</script>

</div>
@endsection