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

@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

@section('content')
    <main class="col-md-12 justify-content-center" >
            <div class="row justify-content-center" style="margin-bottom: 2rem; margin-left: 800px; width: 500px">
                <div class="col-md-6">
                    <button type="button" class="btn btn-success btn-block materiales" title="Agregar">Registrar Material</button>
                </div>
            </div>
            <!-- Modal para registrar los materiales-->
            <div id="modal_registrar_material" class="modal fade bs-example-modal-sm justify-content-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <div class="modal-header">
                                <h5 class="modal-title">Registro de Materiales</h5>
                            </div>
                            <!-- Contenido del modal -->
                            <form id="form_registro_material" method="POST" action="{{route('guardar_material')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="descripcion">Descripción:</label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion">
                                </div>
                                <div class="form-group">
                                    <label for="cantidad">Cantidad:</label>
                                    <input type="number" class="form-control" id="cantidad" name="cantidad">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal para editar los materiales-->
            <div class="modal fade" id="modal-editar-material" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Material</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="form-editar-material" action="{{ route('materiales.update') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="edit-descripcion">Descripción:</label>
                                    <input type="text" class="form-control" id="edit-descripcion" name="edit-descripcion">
                                </div>
                                <div class="form-group">
                                    <label for="edit-cantidad">Cantidad:</label>
                                    <input type="number" class="form-control" id="edit-cantidad" name="edit-cantidad">
                                </div>
                                <input type="hidden" id="edit-material-id" name="edit-material-id">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary" form="form-editar-material">Guardar Cambios</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <!-- Columna para Inventario de Materiales -->
                <div class="col-md-8" style="margin-left: 300px">
                    <div class="panel panel-info mb-4">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center">Inventario de Materiales</h3>
                        </div>
                        <div class="panel-body">
                            <table id="table_enviado" class="table table-bordered table-responsive text-center align-middle">
                                <thead>
                                <tr>
                                    <th>Descripcion</th>
                                    <th>Cantidad</th>
                                    <th>Editar</th>
                                    <th>Eliminar material</th>
                                    <th>Registrar códigos</th>
                                    <th>Mostrar códigos</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($materiales as $material)
                                    <tr>
                                        <td>{{$material->descripcion}}</td>
                                        <td>{{$material->cantidad}}</td>
                                        <td>
                                            <button class="btn btn-primary editar-material" data-id="{{$material->id_material}}" data-descripcion="{{$material->descripcion}}" data-cantidad="{{$material->cantidad}}">Editar</button>
                                        </td>
                                        <td>
                                            <form action="{{ route('materiales.destroy', $material->id_material) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </td>
                                        <td>
                                            @php
                                                $codes = DB::select('SELECT COUNT(*) as count FROM pmcodigos_material WHERE id_material = ? AND deleted_at IS NULL' , [$material->id_material]);
                                            @endphp
                                            @if($codes[0]->count < $material->cantidad)
                                                <button class="btn btn-success" data-toggle="modal" data-target="#materialModal{{$material->id_material}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                                                    </svg></button>
                                            @else
                                                <p>Los códigos han sido registrados</p>
                                            @endif
                                            <!--<button class="btn btn-success" data-toggle="modal" data-target="#materialModal{{$material->id_material}}">Agregar código</button>-->
                                            <!-- Modal para los codigos-->
                                            <div class="modal fade" id="materialModal{{$material->id_material}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Material</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form id="materialForm" action="{{ route('codigos.store') }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body align-content-start">
                                                                <input type="hidden" name="id_material" value="{{$material->id_material}}">
                                                                @php
                                                                    $codes2 = DB::select('SELECT COUNT(*) as count FROM pmcodigos_material WHERE id_material = ? AND deleted_at IS NULL' , [$material->id_material]);
                                                                    $faltantes = $material->cantidad - $codes2[0]->count;
                                                                @endphp
                                                                @for($i=0; $i<$faltantes; $i++)
                                                                        <label for="codigo{{ $i }}">Código {{ $i + 1 }}</label>
                                                                        <input type="text" class="form-control" name="codigo{{$i}}" id="codigo{{$i}}">
                                                                @endfor
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-info" data-toggle="modal" data-target="#codigoModal{{$material->id_material}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                                </svg></button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="codigoModal{{$material->id_material}}" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="showModalLabel">Listado de códigos del Material</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Aquí se cargarán los datos del material -->
                                                            @php
                                                                $cod = DB::select('
                                                                     SELECT * FROM pmcodigos_material
                                                                     WHERE id_material = ? AND deleted_at IS NULL
                                                                 ', [$material->id_material]);

                                                            @endphp

                                                            <table class="table table-bordered table-resposive">
                                                                <thead>
                                                                <tr>
                                                                    <th>Codigo</th>
                                                                    <th>Modificar</th>
                                                                    <th>Eliminar</th>
                                                                </tr>
                                                                </thead>

                                                                <tbody>
                                                                @foreach($cod as $codi)
                                                                    <tr>
                                                                        <td>{{$codi->codigo}}</td>
                                                                        <!--<td><a class=" editar" id=""><i class="glyphicon glyphicon-edit"></i></a></td>-->
                                                                        <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#secondModal" data-id="{{ $codi->id_codigo }}" data-descripcion="{{ $codi->codigo }}">Editar</button></td>
                                                                        <td>
                                                                            <form action="{{ route('codigos.destroy', $codi->id_codigo) }}" method="POST">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Segundo Modal: Formulario de edición de codigos-->
                <div class="modal fade" id="secondModal" tabindex="-1" role="dialog" aria-labelledby="secondModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="secondModalLabel">Editar Registro</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="editForm" action="{{ route('codigos.update', ':codigo') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="codigo" id="edit-codigo">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="edit-descripcion">Descripción</label>
                                        <input type="text" class="form-control" id="edit-descripcion" name="descripcion">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
    </main>

    <!-- Modal de Edición de Material -->
    <div class="modal fade" id="modal-editar-material" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Material</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-editar-material" action="{{ route('materiales.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="edit-descripcion">Descripción:</label>
                            <input type="text" class="form-control" id="edit-descripcion" name="edit-descripcion">
                        </div>
                        <div class="form-group">
                            <label for="edit-cantidad">Cantidad:</label>
                            <input type="number" class="form-control" id="edit-cantidad" name="edit-cantidad">
                        </div>
                        <input type="hidden" id="edit-material-id" name="edit-material-id">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $(document).ready(function()
        {
            // Inicializar DataTables
            $('#table_enviado').DataTable();

            // Mostrar modal para editar material
            $("#table_enviado").on('click', '.editar-material', function() {
                var id = $(this).data('id');
                var descripcion = $(this).data('descripcion');
                var cantidad = $(this).data('cantidad');

                $('#edit-material-id').val(id);
                $('#edit-descripcion').val(descripcion);
                $('#edit-cantidad').val(cantidad);
                $('#modal-editar-material').modal('show');
            });

            // Enviar modal
            $("#table_enviado").on('click', '.enviar', function() {
                var id = $(this).data('id_alumno');
                var nombre = $(this).data('nombre');
                $('#id_alumno').val(id);
                $('#nombre').val(nombre);
                $('#modal_enviar').modal('show');
            });

            // Mostrar modal para registrar material
            $(".materiales").click(function() {
                $('#modal_registrar_material').modal('show');
            });

            $('#secondModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Botón que abrió el modal
                var codigo = button.data('id'); // Extraer la información del atributo data-codigo
                var descripcion = button.data('descripcion'); // Extraer la información del atributo data-descripcion

                var modal = $(this);
                modal.find('#edit-codigo').val(codigo); // Poner el código en el campo oculto
                modal.find('#edit-descripcion').val(descripcion); // Poner la descripción en el campo de texto

                // Actualiza la acción del formulario para incluir el parámetro de código
                var formAction = "{{ route('codigos.update', ':codigo') }}";
                formAction = formAction.replace(':codigo', codigo);
                modal.find('form').attr('action', formAction);
            });

        });
    </script>
@endsection