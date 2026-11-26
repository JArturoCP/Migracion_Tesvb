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

@if (session('message'))
    <x-panel.alerta tipo="exito" class="tw:mb-4">
        {{ session('message') }}
    </x-panel.alerta>
@endif

@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Inventario de Materiales" :migas="['Préstamo de material' => null]" />
    <main class="tw:w-full">
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:justify-end">
                <div class="tw:px-2">
                    <button type="button" class="materiales tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" title="Agregar">Registrar Material</button>
                </div>
            </div>
            <!-- Modal para registrar los materiales-->
            <x-panel.modal id="modal_registrar_material" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">
                        <div class="tw-modal-cuerpo">
                            {{ csrf_field() }}
                            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Registro de Materiales</h5>
                            </div>
                            <!-- Contenido del modal -->
                            <form id="form_registro_material" method="POST" action="{{route('guardar_material')}}">
                                @csrf
                                <div class="tw:mb-4">
                                    <label for="descripcion">Descripción:</label>
                                    <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="descripcion" name="descripcion">
                                </div>
                                <div class="tw:mb-4">
                                    <label for="cantidad">Cantidad:</label>
                                    <input type="number" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="cantidad" name="cantidad">
                                </div>
                                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Guardar</button>
                                </div>
                            </form>

                        </div>
                    </x-panel.modal>
            <!-- Modal para editar los materiales-->
            <x-panel.modal id="modal-editar-material" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                            <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Editar Material</h5>
                            
                        </div>
                        <div class="tw-modal-cuerpo">
                            <form id="form-editar-material" action="{{ route('materiales.update') }}" method="POST">
                                @csrf
                                <div class="tw:mb-4">
                                    <label for="edit-descripcion">Descripción:</label>
                                    <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="edit-descripcion" name="edit-descripcion">
                                </div>
                                <div class="tw:mb-4">
                                    <label for="edit-cantidad">Cantidad:</label>
                                    <input type="number" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="edit-cantidad" name="edit-cantidad">
                                </div>
                                <input type="hidden" id="edit-material-id" name="edit-material-id">
                            </form>
                        </div>
                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" form="form-editar-material">Guardar Cambios</button>
                        </div>
                    </x-panel.modal>

<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:justify-center">
                <!-- Columna para Inventario de Materiales -->
                
    <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03] tw:mb-6">
                        
                        <div class="tw:p-5 tw:sm:p-6">
                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_enviado" class="tw-tabla-centrada tw-tabla tw-tabla-bordes tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:align-middle">
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
                                            <button class="editar-material tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" data-id="{{$material->id_material}}" data-descripcion="{{$material->descripcion}}" data-cantidad="{{$material->cantidad}}">Editar</button>
                                        </td>
                                        <td>
                                            <form action="{{ route('materiales.destroy', $material->id_material) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap">Eliminar</button>
                                            </form>
                                        </td>
                                        <td>
                                            @php
                                                $codes = DB::select('SELECT COUNT(*) as count FROM pmcodigos_material WHERE id_material = ? AND deleted_at IS NULL' , [$material->id_material]);
                                            @endphp
                                            @if($codes[0]->count < $material->cantidad)
                                                <button class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm" data-toggle="modal" data-target="#materialModal{{$material->id_material}}"><span class="fa fa-plus"></span></button>
                                            @else
                                                <p>Los códigos han sido registrados</p>
                                            @endif
                                            <!--<button class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-toggle="modal" data-target="#materialModal{{$material->id_material}}">Agregar código</button>-->
                                            <!-- Modal para los codigos-->
                                            <x-panel.modal id="materialModal{{$material->id_material}}" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                                                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                                            <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Material</h5>
                                                            
                                                        </div>
                                                        <form id="materialForm" action="{{ route('codigos.store') }}" method="POST">
                                                            @csrf
                                                            <div class="tw-modal-cuerpo align-content-start">
                                                                <input type="hidden" name="id_material" value="{{$material->id_material}}">
                                                                @php
                                                                    $codes2 = DB::select('SELECT COUNT(*) as count FROM pmcodigos_material WHERE id_material = ? AND deleted_at IS NULL' , [$material->id_material]);
                                                                    $faltantes = $material->cantidad - $codes2[0]->count;
                                                                @endphp
                                                                @for($i=0; $i<$faltantes; $i++)
                                                                        <label for="codigo{{ $i }}">Código {{ $i + 1 }}</label>
                                                                        <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="codigo{{$i}}" id="codigo{{$i}}">
                                                                @endfor
                                                            </div>
                                                            <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                                                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Guardar cambios</button>
                                                            </div>
                                                        </form>
                                                    </x-panel.modal>
                                        </td>
                                        <td>
                                            <button class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm" data-toggle="modal" data-target="#codigoModal{{$material->id_material}}"><span class="fa fa-eye"></span></button>
                                            <!-- Modal -->
                                            <x-panel.modal id="codigoModal{{$material->id_material}}" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="showModalLabel">
                                                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                                            <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="showModalLabel">Listado de códigos del Material</h5>
                                                            
                                                        </div>
                                                        <div class="tw-modal-cuerpo">
                                                            <!-- Aquí se cargarán los datos del material -->
                                                            @php
                                                                $cod = DB::select('
                                                                     SELECT * FROM pmcodigos_material
                                                                     WHERE id_material = ? AND deleted_at IS NULL
                                                                 ', [$material->id_material]);

                                                            @endphp

                                                            <table class="tw-tabla tw-tabla-bordes">
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
                                                                        <!--<td><a class="editar" id=""><i class="fa fa-pencil-square-o"></i></a></td>-->
                                                                        <td><button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" data-toggle="modal" data-target="#secondModal" data-id="{{ $codi->id_codigo }}" data-descripcion="{{ $codi->codigo }}">Editar</button></td>
                                                                        <td>
                                                                            <form action="{{ route('codigos.destroy', $codi->id_codigo) }}" method="POST">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap">Eliminar</button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
</div>
                                                        
                                                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </x-panel.modal>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Segundo Modal: Formulario de edición de codigos-->
                <x-panel.modal id="secondModal" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="secondModalLabel">
                            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="secondModalLabel">Editar Registro</h5>
                                
                            </div>
                            <form id="editForm" action="{{ route('codigos.update', ':codigo') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="codigo" id="edit-codigo">
                                <div class="tw-modal-cuerpo">
                                    <div class="tw:mb-4">
                                        <label for="edit-descripcion">Descripción</label>
                                        <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="edit-descripcion" name="descripcion">
                                    </div>
                                </div>
                                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Guardar cambios</button>
                                </div>
                            </form>

                        </x-panel.modal>
            </div>
</div>
    </main>

    <!-- Modal de Edición de Material -->
    <x-panel.modal id="modal-editar-material" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Editar Material</h5>
                    
                </div>
                <div class="tw-modal-cuerpo">
                    <form id="form-editar-material" action="{{ route('materiales.update') }}" method="POST">
                        @csrf
                        <div class="tw:mb-4">
                            <label for="edit-descripcion">Descripción:</label>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="edit-descripcion" name="edit-descripcion">
                        </div>
                        <div class="tw:mb-4">
                            <label for="edit-cantidad">Cantidad:</label>
                            <input type="number" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="edit-cantidad" name="edit-cantidad">
                        </div>
                        <input type="hidden" id="edit-material-id" name="edit-material-id">
                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </x-panel.modal>

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
</div>
@endsection