@extends('layouts.panel')
@section('title', 'Asignar revisores')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">
    @if($maximorev==0)
    <x-panel.alerta tipo="error" class="tw:mb-4">Se deben asignar 3 revisores</x-panel.alerta>
    @endif
    <x-panel.encabezado titulo="Agregar revisores al periodo" :migas="['Residencia profesional' => null]" />
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        
        <div class="tw:w-full tw:px-2">
            <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Revisores en el periodo</h3>
        </div>
    </div>
    <div class="tw:p-5 tw:sm:p-6">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="asesores" class="tw-tabla tw-tabla-bordes">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Agregar revisores al periodo</th>

                    </tr>
                    </thead>

                    <tbody>
                    @foreach($plantillas as $plantilla)
                        <tr>
                            <td>{{ $plantilla->nombre }}</td>
                            @if($maximorev==1)
                            <td class="tw:text-center">
                                <a class="mensaje_revisores tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" ><i class="fa fa-sign-in "></i></a>
                            </td>
                                @else
                                <td class="tw:text-center">
                                    <a class="agregar_revisores tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" id="{{ $plantilla->id_personal }}"><i class="fa fa-sign-in "></i></a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
</div>
            </div>
            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="revisores" class="tw-tabla tw-tabla-bordes">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Eliminar</th>

                    </tr>
                    </thead>

                    <tbody>
                    @foreach($revisores as $revisor)
                        <tr>
                            <td>{{ $revisor->nombre }}</td>
                            <td class="tw:text-center">
                                <a class="eliminar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" id="{{ $revisor->id_revisores }}"><span class="fa fa-trash " aria-hidden="true"></span></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
</div>
            </div>

        </div>

    </div>

    <!-- Modal para agregar asesor-->
    <form role="form" action="{{url("/residencia/periodo_asesor")}}" method="POST">
        <x-panel.modal id="modal_asignar_asesor" tamano="sm" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Asignar revisores al periodo</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        {{ csrf_field() }}
                        <div id="contenedor_asignar_asesor">

                        </div>

                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="submit" class="acepta tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Agregar</button>
                    </div>
                </x-panel.modal>
    </form>

    <!-- eliminar revisores -->
    <x-panel.modal id="modal_eliminar_revisores" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">
                <form action="{{url("/residencia/eliminar_revisor")}}" method="POST" role="form" >
                    <div class="tw-modal-cuerpo tw:pt-14">
                        {{method_field('DELETE') }}
                        {{ csrf_field() }}
                        ¿Realmente deseas eliminar este revisor?
                        <input type="hidden" id="id_revisores" name="id_revisores" value="">
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <input id="confirma_elimina_oficio" type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Aceptar"/>
                    </div>
                </form>
            </x-panel.modal>
{{--Mensaje de maximo de revisores--}}
    <x-panel.modal id="modal_revisor_maximo" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">
                <div class="tw-modal-cuerpo tw:pt-14">

                    <p class="tw:text-center">El maximo de revisores son 3</p>
                </div>
                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>

                </div>
            </x-panel.modal>
    <script type="text/javascript">
        $(document).ready( function() {
            $("#asesores").on('click','.agregar_revisores',function(){
                var id_asesor=$(this).attr('id');
                $.get("/residencia/agregar_revisores/"+id_asesor,function (request) {
                    $("#contenedor_asignar_asesor").html(request);
                    $("#modal_asignar_asesor").modal('show');
                });


            });
            $("#asesores").on('click','.mensaje_revisores',function(){

                    $("#modal_revisor_maximo").modal('show');
            });
            $("#revisores").on('click','.eliminar',function(){
                var id_profesor=$(this).attr('id');
               $('#id_revisores').val(id_profesor);
              $('#modal_eliminar_revisores').modal('show');

            });

            $('#asesores').DataTable( {

            } );
            $('#revisores').DataTable( {

            } );
        });
    </script>

</div>
@endsection