@extends('layouts.panel')
@section('title', 'Personal en Plantilla')
@include('partials.panel.recursos_app', ['datatables' => true, 'validacion' => true])
@section('content')
<div class="tw-pantalla">

    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <x-panel.encabezado titulo="Personal" :migas="['Plantilla de personal' => null]" />
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:w-full tw:lg:w-full tw:px-2">
                <div class="tw:w-full tw:lg:w-6/12 tw:lg:grow tw:px-2">
                    
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="paginar_table" class="tw-tabla tw-tabla-bordes">
                        <thead>
                        <tr>
                          {{--  <th>Eliminar</th>--}}
                            <th>Clave</th>
                            <th>Nombre</th>
                            <th>Perfil</th>
                            <th>Agregar a una unidad</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($personal as $personal)
                            <tr>

                                <td>{{ $personal->clave }}</td>
                                <td>{{ $personal->nombre }}</td>
                                <td>{{ $personal->descripcion }}</td>
                           {{--     <td class="tw:text-center"> <a class="eliminarpersonal" id="{{ $personal->id_personal }}"><span class="fa fa-trash em2" aria-hidden="true"></span></a>
                                </td> --}}
                                <td class="tw:text-center">
                                    <a class="agrega tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" id="{{ $personal->id_personal }}"><span class="fa fa-sign-in " aria-hidden="true"></span></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
</div>
                </div>
                <div class="tw:w-full tw:lg:w-4/12 tw:lg:grow tw:px-2">
                    <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">PERSONAL EN UNA UNIDAD</h3>
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="agregados" class="tw-tabla tw-tabla-bordes">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Nombre de la unidad</th>
                            <th>Eliminar</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($plantillas as $plantilla)
                            <tr>
                                <td>{{ $plantilla->nombre }}</td>
                                <td>{{$plantilla->nom_departamento}}</td>
                                <td class="tw:text-center">
                                    <a class="elimina tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" id="{{ $plantilla->id_personal }}"><span class="fa fa-trash " aria-hidden="true"></span></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
</div>
                </div>
            </div>
        </div>

        <!-- MODAL PARA ELIMINAR -->
        <x-panel.modal id="modal_elimina" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">
                    <div class="tw-modal-cuerpo tw:pt-14">
                        <form action="" method="POST" role="form" id="form_delete">
                            {{method_field('DELETE') }}
                            {{ csrf_field() }}
                            ¿Realmente deseas eliminar éste elemento?
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <input id="confirma_elimina" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Aceptar"></input>
                    </div>
                    </form>
            </x-panel.modal>

        <!-- MODAL PARA ELIMINAR -->
        <x-panel.modal id="modal_eliminado" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">
                    <div class="tw-modal-cuerpo tw:pt-14">
                        <form action="" method="POST" role="form" id="form_delete">
                            {{method_field('DELETE') }}
                            {{ csrf_field() }}
                            ¿Realmente deseas eliminar éste elemento?
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <input id="confirma_eliminado" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Aceptar"></input>
                    </div>
                    </form>
                </x-panel.modal>


        <!-- MODAL PARA AGREGAR personal A unidades -->

        <form id="form_agregar" class=""  role="form" method="POST" >
            <x-panel.modal id="modal_agrega" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                            
                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar a la unidad</h4>
                        </div>
                        <div class="tw-modal-cuerpo">
                         <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            {{ csrf_field() }}
                            <input type="hidden" id="idpersonal" name="idpersonal" value="">

                                <div class="tw:w-full tw:px-2">

                                    <div class="tw:mb-4">
                                        <label for="unidad">Unidad Administrativa</label>
                                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="selecciona una Opcion" id="unidad" name="unidad" >
                                            <option disabled selected>Selecciona una opción</option>
                                            @foreach($unidades as $unidad)
                                                <option value="{{$unidad->id_unidad_admin}}" data-esta="{{$unidad->nom_departamento}}"> {{$unidad->nom_departamento}}</option>
                                            @endforeach
                                        </select>


                                    </div>
                                </div>
                            </div>
                    </div>

                            <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                                <button id="guardar_agregado"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Agregar</button>
                            </div>
                        </x-panel.modal>
        </form>

    </main>

    <script>
        $(document).ready(function() {
            $('#paginar_table').DataTable();
            $(".elimina").click(function(){
                var id=$(this).attr('id');
                $('#confirma_elimina').data('id',id);
                $('#modal_elimina').modal('show');
            });
            $('#agregados').DataTable( {
                "order": [[ 0, "desc" ]]
            } );

            $("#paginar_table").on('click','.agrega',function(){
                var id=$(this).attr('id');
                $('#idpersonal').val(id);
                $('#modal_agrega').modal('show');
            });
            $("#guardar_agregado").click(function(event){
                $("#form_agregar").submit();
            });
            $("#form_agregar").validate({
                rules: {

                    unidad: "required",
                },
            });

            $("#confirma_elimina").click(function(event){
                var id_personal=($(this).data('id'));
                $("#form_delete").attr("action","/departamento/plantilla/"+id_personal)
                $("#form_delete").submit();
            });

            $("#paginar_table").on('click','.eliminarpersonal',function(){
                var id=$(this).attr('id');
                $('#confirma_eliminado').data('id',id);
                $('#modal_eliminado').modal('show');
            });
            $("#confirma_eliminado").click(function(event){
                var id=($(this).data('id'));
                $("#form_delete").attr("action","/departamentoplantilla/elimina/"+id)
                $("#form_delete").submit();
            });

        });

    </script>

</div>
@endsection
