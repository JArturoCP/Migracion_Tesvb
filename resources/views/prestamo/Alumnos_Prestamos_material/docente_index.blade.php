@extends('layouts.app')
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
@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <main class="row" style="margin-left: 10rem">
        <div class="col-md-6 justify-content-center">
            <div class="container" style="width: 500px;">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Materiales existentes</h3>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-body">
                    <table id="table_enviado" class="table table-bordered table-responsive">
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
            <div class="container mt-3 text-center" style="margin-bottom: 20px; margin-right: 100px;">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#solicitudModal">
                    Solicitar Préstamo
                </button>
            </div>
            <div class="modal fade" id="solicitudModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Solicitud de Préstamo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('solicitar_material2.store2') }}" method="POST" id="solicitar-material">
                                @csrf
                                <div class="form-group">
                                    <label for="material">Material Disponible:</label>
                                    <select class="form-control" id="material" name="id_material" required>
                                        <option value="" disabled selected>Selecciona el material</option>
                                        @foreach($materiales_prestamos as $material)
                                            <option value="{{ $material->id_material }}">{{ $material->descripcion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" form="solicitar-material" onclick="confirmGuardar()">Solicitar Prestamo</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--tabla del historial de solicitudes-->
        <div class="col-md-5">
            <div class="container" style="width: 500px;">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Mis solicitudes</h3>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-body">
                    <table id="table_historial" class="table table-bordered table-responsive">
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
                                        <!--<button type="submit" class="btn btn-danger">Eliminar</button>-->
                                        <form action="{{ route('solicitudes.eliminarDocente', $histo->id_solicitud) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    @endif
                                    @if($histo->estatus == 'pendiente')
                                            <div class="d-flex justify-content-center"> <!-- Flexbox para alinear horizontalmente -->
                                                <!-- Formulario
                                                <form action="{{ route('solicitudes.editarDocente', $histo->id_solicitud) }}" method="POST" style="display:inline;" id="editformsolicitud">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success mr-2">Editar</button> Espaciado a la derecha
                                                    <button type="button" class="btn btn-success mr-2" onclick="openEditModal()">Editar</button>
                                                </form>-->
                                                <button type="button" class="btn btn-success mr-2"
                                                        onclick="openEditModal({{ $histo->id_solicitud }}, {{ $histo->id_material }})">
                                                    Editar
                                                </button>


                                                <!-- Formulario -->
                                                <form action="{{ route('solicitudes.eliminarDocente', $histo->id_solicitud) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Cancelar</button>
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

        <!-- Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Editar Material</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editForm" action="" method="POST">
                        @csrf
                        <div class="modal-body">
                            <!-- Select para seleccionar el material -->
                            <div class="form-group">
                                <label for="materialSelect">Material</label>
                                <select class="form-control" id="materialSelect" name="material">
                                    @foreach ($materialess as $materiall)
                                        <option value="{{ $materiall->id_material }}">{{ $materiall->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Campos ocultos para id de solicitud y id de material anterior -->
                            <input type="hidden" id="solicitudId" name="solicitud_id" value="">
                            <input type="hidden" id="materialAnteriorId" name="material_anterior_id" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </main>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
@endsection