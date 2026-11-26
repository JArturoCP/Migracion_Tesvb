@extends('layouts.panel')
@section('title', 'Categorias')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">


    <main class="main">

        <div class="tw:w-full">
            <x-panel.encabezado titulo="Gestionar categorías del TESVB" :migas="['Recursos materiales' => null]" />
            <div class="tw:w-full">
                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-toggle="modal" data-target="#myModal" id="open">Agregar Categoría</button>


                <form id="form" name="formmarca" method="post" action="{{route('guardarcat')}}">
                    @csrf
                    <div class="tw:text-green-600">
                        @if(Session::has('message'))
                            {{Session::get('message')}}
                        @endif
                    </div>

                    <!-- Modal Insertar -->
                    <x-panel.modal id="myModal" tamano="md" sin-relleno>
                                <div class="alert-danger tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" style="display:none"></div>
                                <div class="tw:px-6 tw:pt-6 tw:pr-14">

                                    <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Agregar Nueva Categoría</h3>
                                </div>
                                <div class="tw-modal-cuerpo">
                                    <div class="alert-danger tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" style="display: none"></div>

                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2">
                                            <label for="Name">Nombre de la Categoria:</label>
                                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="nombre" id="nombre" required>

                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:mb-4 tw:lg:w-full tw:px-2">
                                            <label for="Name">Descripción de la Categoría:</label>
                                            <input type="text" name="descripcion" id="descripcion" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                        </div>
                                    </div>


                                </div>
                                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                                    <button type="submit"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar Categoria</button>

                                </div>
                            </x-panel.modal>
                </form>
            </div>
            <!--Modal Insertar-->

        </div>
        <!-- listado de marcas -->
        <div class="tw:w-full" >
            <div class="tw:w-full">

                <div class="tw:p-5 tw:sm:p-6">
                    @if($categorias->isEmpty())
                        <div class="tw:text-center tw:bg-amber-50 tw:dark:bg-amber-500/15">No hay Categorías</div>
                    @else
                        @if(Session::has('message'))
                            {!! Session::get('message') !!}
                        @endif
                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla-centrada tw-tabla tw-tabla-bordes tw-tabla-rayas tw-tabla-compacta" >
                            <thead>
                            <tr>

                                <th class="tw:text-center">No.de Categoria</th>
                                <th class="tw:text-center">Nombre</th>
                                <th class="tw:text-center">Descripción</th>
                                <th class="tw:text-center">Opciones</th>
                                <th class="tw:text-center">Estado</th>
                            </tr>
                            </thead>
                            @foreach($categorias as $categoria)<!-- se crea un objeto para acceder a los datos-->
                            <tbody>
                            <tr>

                                <td>{{$categoria->id}}</td>
                                <td>{{$categoria->nombre}}</td>
                                <td>{{$categoria->descripcion}}</td>
                                <td>

                                @if($categoria-> condicion == 1)
                                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" data-toggle="modal" data-target="#editModal{{$categoria->id}}">Editar</button> <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" data-toggle="modal" data-target='#desModal{{$categoria->id}}'>Desactivar</button>
                                    <!--Modal Editar -->
                                    <form method="POST" action="{{route('editarcat',$categoria->id)}}" >
                                        @csrf @method('PUT')

                                        <x-panel.modal id="editModal{{$categoria->id}}" tamano="md" sin-relleno clase-cerrar="close">
                                                    <div class="alert-danger tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" style="display:none"></div>
                                                    <div class="tw:px-6 tw:pt-6 tw:pr-14">

                                                        <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" >Actualizar Categoría</h3>
                                                        
                                                    </div>
                                                    <div class="tw-modal-cuerpo">
                                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                            <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2">
                                                                <label for="Name">Nombre de la Categoria:</label>
                                                                <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="nombre" value="{{$categoria->nombre}}" id="nombre">
                                                            </div>
                                                        </div>
                                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                            <div class="tw:w-full tw:mb-4 tw:lg:w-full tw:px-2">
                                                                <label for="Name">Descripción de la Categoría:</label>
                                                                <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="descripcion" id="descripcion" value="{{$categoria->descripcion}}">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                                                        <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" type="submit">Actualizar Categoría</button>

                                                    </div>
                                                </x-panel.modal>
                                    </form>
                                    <!--Modal Editar -->
                                    <!--Modal Desactivar -->
                                        <form method="POST" action="{{route('desactivarcat',$categoria->id)}}" >
                                            @csrf @method('PUT')

                                            <x-panel.modal id="desModal{{$categoria->id}}" tamano="md" sin-relleno>
                                                        <div class="alert-danger tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" style="display:none"></div>
                                                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" >Desactivar Categoría</h4>
                                                        </div>
                                                        <div class="tw-modal-cuerpo">
                                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-600 tw:dark:text-red-400">¿Desea Desactivar la Categoría?</h4>
                                                        </div>
                                                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" type="submit">Desactivar Categoría</button>
                                                        </div>
                                                    </x-panel.modal>
                                        </form>
                                        <!--Modal Desactivar -->
                                @else
                                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" data-toggle="modal" data-target='#actModal{{$categoria->id}}'>Activar</button>

                                        <!--Modal Activar -->
                                        <form method="POST" action="{{route('activarcat',$categoria->id)}}" >
                                            @csrf @method('PUT')

                                            <x-panel.modal id="actModal{{$categoria->id}}" tamano="md" sin-relleno>
                                                        <div class="alert-danger tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" style="display:none"></div>
                                                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" >Activar Categoría</h4>
                                                        </div>
                                                        <div class="tw-modal-cuerpo">
                                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">¿Desea Activar la Categoría?</h4>
                                                        </div>
                                                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" type="submit">Activar Categoría</button>


                                                        </div>
                                                    </x-panel.modal>
                                        </form>
                                        <!--Modal Activar -->

                                    @endif

                                </td>
                                <td>
                                    @if($categoria-> condicion == 1)
                                        <span class="tw:text-green-600 tw:text-green-700 tw:dark:text-green-400">Activada</span>
                                    @else
                                        <span class="tw:text-red-600">Desactivada</span>
                                    @endif
                                </td>

                            </tr>
                            @endforeach
                        </table>
</div>
                        {{$categorias->links()}}<!--para la paginacion-->
                    @endif
                </div>
            </div>
        </div>
        <script >
        /*
            $('#deleteModal').on('show.bs.modal', function (event)
            {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.data('id') // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

                action = $('#formDelete').attr('data-action').slice(0,-1);
                action+= id;
                $('#formDelete').attr('action',action);
                var modal = $(this)
                modal.find('.modal-title').text('Se va a eliminar la Categoría seleccionada ' )

            });*/
        </script>
        <script>
        /*
            jQuery(document).ready(function ()
            {
                jQuery('#ajaxSubmit').click(function (e) {
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    jQuery.ajax({
                        url: "{{'/Agregar-Categoria'}}",
                        method: 'post',
                        data: {
                            name: jQuery('#nombre').val(),
                        },
                        success: function (result) {
                            if(result.errors)
                            {
                                jQuery('.alert-danger').html('');
                                jQuery.each(result.errors,function (key, value) {
                                    jQuery('.alert-danger').show();
                                    jQuery('.alert-danger').append('<li>'+value+'<li>');
                                });
                            }
                            else
                            {
                                jQuery('.alert-danger').hide();
                                $('#open').hide();
                                $('#myModal').modal({show: true});
                            }
                        }});
                });
            });
        */
        </script>


    </main>



</div>
@endsection