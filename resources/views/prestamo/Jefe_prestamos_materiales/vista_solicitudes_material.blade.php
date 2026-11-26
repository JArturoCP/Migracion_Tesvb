@extends('layouts.panel')
<script>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            @php
                toastr()->error ($error, "Error");
            @endphp
        @endforeach
    @endif
</script>

@if (Session::has('toast_success'))
    <script>
        toastr.success("{{ Session::get('toast_success') }}");
    </script>
@endif
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">
    <div class="tw:w-full tw:my-6">
        <x-panel.encabezado titulo="Solicitudes de alumnos existentes" :migas="['Préstamo de material' => null]" />
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:justify-center">
            <!--Solicitues por parte de los alumnos-->
            <div class="tw:w-full tw:lg:w-full tw:px-2">
                

                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                    <div class="tw:p-5 tw:sm:p-6 tw:p-6">
                        <div class="tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800">
                            <table id="table_env" class="tw-tabla tw-tabla-bordes">
                                <thead>
                                <tr>
                                    <th class="tw:text-center tw:align-middle">Estudiante</th>
                                    <th class="tw:text-center tw:align-middle">Semestre</th>
                                    <th class="tw:text-center tw:align-middle">Material solicitado</th>
                                    <th class="tw:text-center tw:align-middle">Estatus</th>
                                    <th class="tw:text-center tw:align-middle">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($solicitudes as $solicitud)
                                    <tr class="tw:text-center tw:align-middle">
                                        <td>{{$solicitud->nombre}} {{ $solicitud->apaterno }} {{ $solicitud->amaterno }}</td>
                                        <td>{{$solicitud->desc}}</td>
                                        <td>{{$solicitud->descripcion}}</td>
                                        <td>{{$solicitud->estatus}}</td>
                                        <td class="tw:text-center tw:align-middle"> <!-- Centrar vertical y horizontalmente -->
                                            <div class="tw:flex tw:justify-center"> <!-- Flexbox para alinear horizontalmente -->
                                                <form action="{{route('Jefe_prestamos_materiales.update', $solicitud->id_solicitud)}}" method="POST" style="display:inline;" id="rechazarform">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="action" value="rechazar">
                                                    <button type="button" class="tw:mr-2 tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" onclick="confirmGuardar()">Rechazar Solicitud</button> <!-- Espaciado a la derecha -->
                                                </form>

                                                <!-- Formulario -->
                                                <form id="approveForm" action="{{ route('Jefe_prestamos_materiales.update', $solicitud->id_solicitud) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="action" value="aprobar">
                                                    <input type="hidden" name="codigo" id="codigoInput"> <!-- Campo oculto para enviar el código -->
                                                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:disabled:bg-amber-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" data-toggle="modal" data-target="#codigoModal">Aprobar Solicitud</button>
                                                </form>
                                            </div>
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
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:justify-center">
            <!--Solicitudes docente-->
            <div class="tw:w-full tw:lg:w-full tw:px-2">
                <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Solicitudes de docentes existentes</h3>
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                    <div class="tw:p-5 tw:sm:p-6 tw:p-6">
                        <div class="tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800">
                            <table id="table_envDoc" class="tw-tabla tw-tabla-bordes">
                                <thead>
                                <tr>
                                    <th class="tw:text-center tw:align-middle">Docente</th>
                                    <th class="tw:text-center tw:align-middle">Material solicitado</th>
                                    <th class="tw:text-center tw:align-middle">Estatus</th>
                                    <th class="tw:text-center tw:align-middle">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($solicitudesD as $solicitud2)
                                    <tr class="tw:text-center tw:align-middle">
                                        <td>{{$solicitud2->nombre}}</td>
                                        <td>{{$solicitud2->descripcion}}</td>
                                        <td>{{$solicitud2->estatus}}</td>
                                        <td class="tw:text-center tw:align-middle"> <!-- Centrar vertical y horizontalmente -->
                                            <div class="tw:flex tw:justify-center"> <!-- Flexbox para alinear horizontalmente -->
                                                <form action="{{route('solicitudes.updateDocente', $solicitud2->id_solicitud)}}" method="POST" style="display:inline;" id="rechazarform">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="action" value="rechazar">
                                                    <button type="button" class="tw:mr-2 tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" onclick="confirmGuardar()">Rechazar Solicitud</button> <!-- Espaciado a la derecha -->
                                                </form>

                                                <!-- Formulario -->
                                                <form id="approveForm" action="{{ route('solicitudes.updateDocente', $solicitud2->id_solicitud) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="action" value="aprobar">
                                                    <input type="hidden" name="codigo" id="codigoInput"> <!-- Campo oculto para enviar el código -->
                                                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" data-toggle="modal" data-target="#codigoModal">Aprobar Solicitud</button>
                                                </form>
                                            </div>
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
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:justify-center">
            <!-- Columna para Historial de solicitudes aceptadas de los alumnos-->
            <div class="tw:w-full tw:lg:w-full tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03] tw:mb-6">
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                        <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90 tw:text-center">Estudiantes con adeudo </h3>
                    </div>
                    <div class="tw:p-5 tw:sm:p-6 tw:p-6">
                        <div class="tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800">
                            <table id="table_adeudos" class="tw-tabla-centrada tw-tabla tw-tabla-bordes tw:align-middle">
                                <thead>
                                <tr>
                                    <th class="tw:text-center tw:align-middle">Número de cuenta</th>
                                    <th class="tw:text-center tw:align-middle">Nombre del estudiante</th>
                                    <th class="tw:text-center tw:align-middle">Semestre</th>
                                    <th class="tw:text-center tw:align-middle">Adeudo</th>
                                    <th class="tw:text-center tw:align-middle">Código</th>
                                    <th class="tw:text-center tw:align-middle">Eliminar del adeudo</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($solicitudesA as $aceptadas)
                                    <tr>
                                        <td>{{$aceptadas->cuenta}}</td>
                                        <td>{{$aceptadas->nombre}} {{ $aceptadas->apaterno }} {{ $aceptadas->amaterno }}</td>
                                        <td>{{$aceptadas->desc}}</td>
                                        <td>{{$aceptadas->descripcion}}</td>
                                        <td>{{$aceptadas->codigo}}</td>

                                        <td>
                                            <form action="{{ route('liberar_adeudo', ['id' => $aceptadas->id_adeudo_departamento]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap">Liberar</button>
                                            </form>
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
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:justify-center">
            <!-- Columna para Historial de solicitudes aceptadas de los docentes-->
            <div class="tw:w-full tw:lg:w-full tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03] tw:mb-6">
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                        <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90 tw:text-center">Docentes con adeudo </h3>
                    </div>
                    <div class="tw:p-5 tw:sm:p-6 tw:p-6">
                        <div class="tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800">
                            <table id="table_adeudos2" class="tw-tabla-centrada tw-tabla tw-tabla-bordes tw:align-middle">
                                <thead>
                                <tr>
                                    <th class="tw:text-center tw:align-middle">Nombre del docente</th>
                                    <th class="tw:text-center tw:align-middle">Adeudo</th>
                                    <th class="tw:text-center tw:align-middle">Código</th>
                                    <th class="tw:text-center tw:align-middle">Eliminar del adeudo</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($solicitudesD2 as $aceptadas2)
                                    <tr>
                                        <td>{{$aceptadas2->nombre}}</td>
                                        <td>{{$aceptadas2->descripcion}}</td>
                                        <td>{{$aceptadas2->codigo}}</td>

                                        <td>
                                            <form action="{{ route('solicitudes.destroy', ['id' => $aceptadas2->id_solicitud]) }}" method="POST">
                                            @csrf
                                            @method('DELETE') <!-- Esto es importante para indicar que se está utilizando el método DELETE -->
                                                <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap">Liberar</button>
                                            </form>
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

        <!-- Modal para aprobar el prestamo-->
        <x-panel.modal id="codigoModal" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="codigoModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="codigoModalLabel">Ingrese el Código</h5>
                        
                    </div>
                    <div class="tw-modal-cuerpo">
                        <input type="text" id="codigoModalInput" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Ingrese el código aquí">
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="submitApproveForm">Enviar</button>
                    </div>
                </x-panel.modal>



    </div>

    <script type="text/javascript">

        $(document).ready(function() {
            $('#table_env').DataTable({
                "pageLength": 5,
                "lengthMenu": [[5, 10, 25, 50], [5, 10, 25, 50]] // Opciones de selección: 5, 10, 25, 50
            });
            $('#table_rechazadas').DataTable({
                "pageLength": 5,
                "lengthMenu": [[5, 10, 25, 50], [5, 10, 25, 50]] // Opciones de selección: 5, 10, 25, 50
            });
            $('#table_adeudos').DataTable({
                "pageLength": 5,
                "lengthMenu": [[5, 10, 25, 50], [5, 10, 25, 50]] // Opciones de selección: 5, 10, 25, 50
            });
            $('#table_adeudos2').DataTable({
                "pageLength": 5,
                "lengthMenu": [[5, 10, 25, 50], [5, 10, 25, 50]] // Opciones de selección: 5, 10, 25, 50
            });
            $('#table_envDoc').DataTable({
                "pageLength": 5,
                "lengthMenu": [[5, 10, 25, 50], [5, 10, 25, 50]] // Opciones de selección: 5, 10, 25, 50
            });

            $("#table_adeudos").on('click', '.eliminar', function() {
                var id = $(this).attr('id');
                $('#id_adeudo_carrera').val(id);
                $('#modal_eliminar').modal('show');
            });
        });

        document.getElementById('submitApproveForm').addEventListener('click', function () {
            // Obtener el valor del input del modal
            const codigo = document.getElementById('codigoModalInput').value;

            // Asignar el valor al campo oculto del formulario
            document.getElementById('codigoInput').value = codigo;

            // Enviar el formulario
            document.getElementById('approveForm').submit();
        });

        function confirmGuardar() {
            Swal.fire({
                title: '¿Rechazar solicitud?',
                text: "¿Estás seguro de que quieres rechazar la solicitud?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, rechazar',
                cancelButtonText: 'No, cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('rechazarform').submit();
                }
            });
        }


    </script>
</div>
@endsection
