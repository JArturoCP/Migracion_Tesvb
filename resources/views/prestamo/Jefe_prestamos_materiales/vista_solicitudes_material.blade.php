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
@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <!--Solicitues por parte de los alumnos-->
            <div class="col-md-12">
                <div class="panel panel-info mb-4">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Solicitudes de alumnos existentes</h3>
                    </div>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-body p-4">
                        <div class="table-responsive">
                            <table id="table_env" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center align-middle">Estudiante</th>
                                    <th class="text-center align-middle">Semestre</th>
                                    <th class="text-center align-middle">Material solicitado</th>
                                    <th class="text-center align-middle">Estatus</th>
                                    <th class="text-center align-middle">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($solicitudes as $solicitud)
                                    <tr class="text-center align-middle">
                                        <td>{{$solicitud->nombre}} {{ $solicitud->apaterno }} {{ $solicitud->amaterno }}</td>
                                        <td>{{$solicitud->desc}}</td>
                                        <td>{{$solicitud->descripcion}}</td>
                                        <td>{{$solicitud->estatus}}</td>
                                        <td class="text-center align-middle"> <!-- Centrar vertical y horizontalmente -->
                                            <div class="d-flex justify-content-center"> <!-- Flexbox para alinear horizontalmente -->
                                                <form action="{{route('Jefe_prestamos_materiales.update', $solicitud->id_solicitud)}}" method="POST" style="display:inline;" id="rechazarform">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="action" value="rechazar">
                                                    <button type="button" class="btn btn-danger mr-2" onclick="confirmGuardar()">Rechazar Solicitud</button> <!-- Espaciado a la derecha -->
                                                </form>

                                                <!-- Formulario -->
                                                <form id="approveForm" action="{{ route('Jefe_prestamos_materiales.update', $solicitud->id_solicitud) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="action" value="aprobar">
                                                    <input type="hidden" name="codigo" id="codigoInput"> <!-- Campo oculto para enviar el código -->
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#codigoModal">Aprobar Solicitud</button>
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
        <div class="row justify-content-center">
            <!--Solicitudes docente-->
            <div class="col-md-12">
                <div class="panel panel-info mb-4">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Solicitudes de docentes existentes</h3>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-body p-4">
                        <div class="table-responsive">
                            <table id="table_envDoc" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center align-middle">Docente</th>
                                    <th class="text-center align-middle">Material solicitado</th>
                                    <th class="text-center align-middle">Estatus</th>
                                    <th class="text-center align-middle">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($solicitudesD as $solicitud2)
                                    <tr class="text-center align-middle">
                                        <td>{{$solicitud2->nombre}}</td>
                                        <td>{{$solicitud2->descripcion}}</td>
                                        <td>{{$solicitud2->estatus}}</td>
                                        <td class="text-center align-middle"> <!-- Centrar vertical y horizontalmente -->
                                            <div class="d-flex justify-content-center"> <!-- Flexbox para alinear horizontalmente -->
                                                <form action="{{route('solicitudes.updateDocente', $solicitud2->id_solicitud)}}" method="POST" style="display:inline;" id="rechazarform">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="action" value="rechazar">
                                                    <button type="button" class="btn btn-danger mr-2" onclick="confirmGuardar()">Rechazar Solicitud</button> <!-- Espaciado a la derecha -->
                                                </form>

                                                <!-- Formulario -->
                                                <form id="approveForm" action="{{ route('solicitudes.updateDocente', $solicitud2->id_solicitud) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="action" value="aprobar">
                                                    <input type="hidden" name="codigo" id="codigoInput"> <!-- Campo oculto para enviar el código -->
                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#codigoModal">Aprobar Solicitud</button>
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
        <div class="row justify-content-center">
            <!-- Columna para Historial de solicitudes aceptadas de los alumnos-->
            <div class="col-md-12">
                <div class="panel panel-info mb-4">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Estudiantes con adeudo </h3>
                    </div>
                    <div class="panel-body p-4">
                        <div class="table-responsive">
                            <table id="table_adeudos" class="table table-bordered text-center align-middle">
                                <thead>
                                <tr>
                                    <th class="text-center align-middle">Número de cuenta</th>
                                    <th class="text-center align-middle">Nombre del estudiante</th>
                                    <th class="text-center align-middle">Semestre</th>
                                    <th class="text-center align-middle">Adeudo</th>
                                    <th class="text-center align-middle">Código</th>
                                    <th class="text-center align-middle">Eliminar del adeudo</th>
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
                                                <button type="submit" class="btn btn-success">Liberar</button>
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
        <div class="row justify-content-center">
            <!-- Columna para Historial de solicitudes aceptadas de los docentes-->
            <div class="col-md-12">
                <div class="panel panel-info mb-4">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Docentes con adeudo </h3>
                    </div>
                    <div class="panel-body p-4">
                        <div class="table-responsive">
                            <table id="table_adeudos2" class="table table-bordered text-center align-middle">
                                <thead>
                                <tr>
                                    <th class="text-center align-middle">Nombre del docente</th>
                                    <th class="text-center align-middle">Adeudo</th>
                                    <th class="text-center align-middle">Código</th>
                                    <th class="text-center align-middle">Eliminar del adeudo</th>
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
                                                <button type="submit" class="btn btn-success">Liberar</button>
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
        <div class="modal fade" id="codigoModal" tabindex="-1" aria-labelledby="codigoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="codigoModalLabel">Ingrese el Código</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="codigoModalInput" class="form-control" placeholder="Ingrese el código aquí">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="submitApproveForm">Enviar</button>
                    </div>
                </div>
            </div>
        </div>



    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
@endsection
