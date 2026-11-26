@extends('layouts.panel')
@section('title', 'Proyectos')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado :titulo="'Proyectos del '.$year" :migas="['Finanzas' => null]" />

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <button data-toggle="modal"  data-tooltip="true" data-placement="left" title="Agregar nuevo proyecto" data-target="#modal_crear_proyecto" type="button" class="flotante tw:fixed tw:right-6 tw:bottom-6 tw:z-40 tw:inline-flex tw:size-14 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-xl tw:text-white tw:shadow-theme-lg tw:hover:bg-brand-600">
                <span class="fa fa-plus" aria-hidden="true"></span>
            </button>
        </div>
    </div>

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" id="registros_proyectos">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Nombre del proyecto</th>
                    <th>Modificar</th>
                    <th>Estado</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; ?>
                @foreach($proyectos as $proyecto)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $proyecto->nombre_proyecto }}</td>
                        <td>
                            <button data-toggle="tooltip" data-placement="top" id="{{$proyecto->id_proyecto }}" title="Modificar proyecto" class="h-primary_m modificar_proyecto tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap">Modificar proyecto</button>
                        </td>
                        <td class="tw:text-center">
                            @if($proyecto->id_estado == 0)
                            <button data-toggle="tooltip" data-placement="top" id="{{$proyecto->id_proyecto }}" title="Activar" class="h-primary_m activar_proy tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap">Activar</button>
                                @elseif($proyecto->id_estado == 1)
                                <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">Activado</h4>
                                <button data-toggle="tooltip" data-placement="top" id="{{$proyecto->id_proyecto }}" title="Desactivar" class="h-primary_m desactivar_proy tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap">Desactivar</button>

                            @endif
                        </td>

                    </tr>
                @endforeach



                </tbody>
            </table>
</div>
        </div>
    </div>

    {{-- modal crear proyecto--}}

    <x-panel.modal id="modal_crear_proyecto" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar proyecto</h4>
                </div>
                <div class="tw-modal-cuerpo">

                    <form id="form_agregar" class="" action="{{url("/presupuesto_anteproyecto/guardar_proyecto/")}}" role="form" method="POST" >
                        {{ csrf_field() }}

                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label>Agregar nombre del proyecto</label>
                                    <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   type="text"  id="nombre_proyecto"  onkeyup="javascript:this.value=this.value.toUpperCase();" name="nombre_proyecto"  >
                                </div>
                            </div>
                        </div>

                    </form>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_proyecto"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>

    {{-- modal modificar proyecto--}}

    <x-panel.modal id="modal_modificacion_proyecto" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Modificar proyecto</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_modificacion_proyecto">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_modificacion_proyecto"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>

    {{-- modal activar proyecto--}}

    <x-panel.modal id="modal_activar_proyecto" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Activar proyecto</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_activar_proyecto">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_activar_proyecto"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                    </div>
                </div>
            </x-panel.modal>
    {{-- modal desactivar proyecto--}}

    <x-panel.modal id="modal_desactivar_proyecto" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Desactivar proyecto</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_desactivar_proyecto">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_desactivar_proyecto"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                    </div>
                </div>
            </x-panel.modal>




    <script type="text/javascript">
        $(document).ready( function() {

            $("#guardar_proyecto").click(function (){
                var nombre_proyecto = $('#nombre_proyecto').val();

                if( nombre_proyecto != ''){

                        $("#form_agregar").submit();
                        $("#guardar_proyecto").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "error",
                        title: "El campo nombre del proyecto no debe ser vacio",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#registros_proyectos").on('click','.modificar_proyecto',function(){
                var id_proyecto =$(this).attr('id');

                $.get("/presupuesto_anteproyecto/modificar_proyecto/"+id_proyecto,function (request) {
                    $("#contenedor_modificacion_proyecto").html(request);
                    $("#modal_modificacion_proyecto").modal('show');
                });
            });

            $("#registros_periodos").on('click','.modificar_periodo',function(){
                var id_periodo =$(this).attr('id');

                $.get("/presupuesto_anteproyecto/modificar_periodos_anteproyecto/"+id_periodo,function (request) {
                    $("#contenedor_modificacion").html(request);
                    $("#modal_modificacion").modal('show');
                });
            });
            $("#guardar_modificacion_proyecto").click(function (){
                $("#form_modificar_proyecto").submit();
                $("#guardar_modificacion_proyecto").attr("disabled", true);
            });
            $(".activar_proy").click(function (){
                var id_proyecto =$(this).attr('id');

                $.get("/presupuesto_anteproyecto/activar_proyecto/"+id_proyecto,function (request) {
                    $("#contenedor_activar_proyecto").html(request);
                    $("#modal_activar_proyecto").modal('show');
                });
            });

            $("#guardar_activar_proyecto").click(function (){
                $("#form_activar_proyecto").submit();
                $("#guardar_activar_proyecto").attr("disabled", true);
            });
            $(".desactivar_proy").click(function (){
                var id_proyecto =$(this).attr('id');

                $.get("/presupuesto_anteproyecto/desactivar_proyecto/"+id_proyecto,function (request) {
                    $("#contenedor_desactivar_proyecto").html(request);
                    $("#modal_desactivar_proyecto").modal('show');
                });
            });
            $("#guardar_desactivar_proyecto").click(function (){
                $("#form_desactivar_proyecto").submit();
                $("#guardar_desactivar_proyecto").attr("disabled", true);
            });


        });
    </script>
</div>
@endsection