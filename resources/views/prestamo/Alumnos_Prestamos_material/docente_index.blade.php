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
@section('title', 'Prestamos')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

    @if (session('success'))
        <x-panel.alerta tipo="exito" class="tw:mb-4">
            {{ session('success') }}
        </x-panel.alerta>
    @endif

    <x-panel.encabezado titulo="Materiales existentes" :migas="['Préstamo de material' => null]" />
    <main class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
<div class="tw:w-full tw:lg:w-6/12 tw:justify-center tw:px-2">
            <div class="tw:w-full">
                
            </div>
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_enviado" class="tw-tabla tw-tabla-bordes tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800">
                        <thead>
                        <tr>
                            <th>Descripcion</th>
                            <th>Cantidad</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($materiales_prestamos as $materiales)
                            <tr>
                                <td>{{ $materiales->descripcion }}</td>
                                <td>{{ $materiales->cantidad }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
</div>
                </div>
            </div>
            <div class="tw:w-full tw:mt-4 tw:text-center tw:mb-5">
                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-toggle="modal" data-target="#solicitudModal">
                    Solicitar Préstamo
                </button>
            </div>
            <x-panel.modal id="solicitudModal" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                            <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Solicitud de Préstamo</h5>
                            
                        </div>
                        <div class="tw-modal-cuerpo">
                            <form action="{{ route('solicitar_material2.store2') }}" method="POST" id="solicitar-material">
                                @csrf
                                <div class="tw:mb-4">
                                    <label for="material">Material Disponible:</label>
                                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="material" name="id_material" required>
                                        <option value="" disabled selected>Selecciona el material</option>
                                        @foreach($materiales_prestamos as $material)
                                            <option value="{{ $material->id_material }}">{{ $material->descripcion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>

                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" form="solicitar-material" onclick="confirmGuardar()">Solicitar Prestamo</button>
                        </div>
                    </x-panel.modal>
        </div>
        <!--tabla del historial de solicitudes-->
        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
            <div class="tw:w-full">
                <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Mis solicitudes</h3>
            </div>
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_historial" class="tw-tabla tw-tabla-bordes tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800">
                        <thead>
                        <tr>
                            <th>Material</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($historial as $histo)
                            <tr>
                                <td>{{ $histo->descripcion }}</td>
                                <td>{{ $histo->estatus }}</td>
                                <td>
                                    @if($histo->estatus == 'Rechazado')
                                        <!--<button type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Eliminar</button>-->
                                        <form action="{{ route('solicitudes.eliminarDocente', $histo->id_solicitud) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap">Eliminar</button>
                                        </form>
                                    @endif
                                    @if($histo->estatus == 'pendiente')
                                            <div class="tw:flex tw:justify-center"> <!-- Flexbox para alinear horizontalmente -->
                                                <!-- Formulario
                                                <form action="{{ route('solicitudes.editarDocente', $histo->id_solicitud) }}" method="POST" style="display:inline;" id="editformsolicitud">
                                                    @csrf
                                                    <button type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:mr-2 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Editar</button> Espaciado a la derecha
                                                    <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:mr-2 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" onclick="openEditModal()">Editar</button>
                                                </form>-->
                                                <button type="button" class="tw:mr-2 tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap"
                                                        onclick="openEditModal({{ $histo->id_solicitud }}, {{ $histo->id_material }})">
                                                    Editar
                                                </button>


                                                <!-- Formulario -->
                                                <form action="{{ route('solicitudes.eliminarDocente', $histo->id_solicitud) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap">Cancelar</button>
                                                </form>
                                            </div>


                                        @endif
                                    @if($histo->estatus == 'Aprobado')
                                        <small><p>Si desea devolver el material</p>
                                            <p>acuda a su jefatura.</p></small>
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

        <!-- Modal -->
        <x-panel.modal id="editModal" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="editModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="editModalLabel">Editar Material</h5>
                        
                    </div>
                    <form id="editForm" action="" method="POST">
                        @csrf
                        <div class="tw-modal-cuerpo">
                            <!-- Select para seleccionar el material -->
                            <div class="tw:mb-4">
                                <label for="materialSelect">Material</label>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="materialSelect" name="material">
                                    @foreach ($materialess as $materiall)
                                        <option value="{{ $materiall->id_material }}">{{ $materiall->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Campos ocultos para id de solicitud y id de material anterior -->
                            <input type="hidden" id="solicitudId" name="solicitud_id" value="">
                            <input type="hidden" id="materialAnteriorId" name="material_anterior_id" value="">
                        </div>
                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Guardar Cambios</button>
                        </div>
                    </form>
                </x-panel.modal>


    </main>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table_enviado').DataTable();
            $('#table_adeudos').DataTable();
            $('#table_historial').DataTable();
        });

        function openEditModal(id_solicitud, id_material) {
            // Establece la acción del formulario para que incluya el ID correcto de la solicitud
            const formAction = "{{ route('solicitudes.editarDocente', ':id') }}".replace(':id', id_solicitud);
            document.getElementById('editForm').action = formAction;

            // Selecciona el material correcto en el select
            const materialSelect = document.getElementById('materialSelect');
            materialSelect.value = id_material;

            // Establecer el ID de la solicitud y el ID del material anterior
            document.getElementById('solicitudId').value = id_solicitud;
            document.getElementById('materialAnteriorId').value = id_material; // ID del material que se está editando

            // Abre el modal
            $('#editModal').modal('show');
        }


        function cancelarFormulario() {
            document.getElementById('solicitar-material').reset();
        }

        function confirmGuardar() {
            Swal.fire({
                title: '¿Solicitar prestamo?',
                text: "¿Estás seguro de que quieres solicitar el prestamo?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, solicitar',
                cancelButtonText: 'No, cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('solicitar-material').submit();
                }
            });
        }
    </script>
</div>
@endsection