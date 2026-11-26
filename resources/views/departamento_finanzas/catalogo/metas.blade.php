@extends('layouts.panel')
@section('title', 'Metas del Proyecto')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <p>
                <span class="fa fa-arrow-right"></span>
                <a class="tw:text-brand-500 tw:hover:underline" href="{{url("/presupuesto_anteproyecto/proyectos_metas")}}">Proyectos registrados</a>
                <span class="fa fa-chevron-right"></span>
                <span>Metas del proyecto</span>

            </p>
        </div>
    </div>
    <x-panel.encabezado :titulo="'Metas del proyecto '.$proyecto->nombre_proyecto" :migas="['Finanzas' => null]" />

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <button data-toggle="modal"  data-tooltip="true" data-placement="left" title="Agregar nueva meta" data-target="#modal_crear_meta" type="button" class="flotante tw:fixed tw:right-6 tw:bottom-6 tw:z-40 tw:inline-flex tw:size-14 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-xl tw:text-white tw:shadow-theme-lg tw:hover:bg-brand-600">
                <span class="fa fa-plus" aria-hidden="true"></span>
            </button>
        </div>
    </div>

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" id="registros_metas">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Nombre de la meta</th>
                    <th>Modificar</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; ?>
                @foreach($metas as $meta)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $meta->meta }}</td>
                        <td>
                            <button data-toggle="tooltip" data-placement="top" id="{{$meta->id_meta }}" title="Modificar meta" class="h-primary_m modificar_meta tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap">Modificar meta</button>
                        </td>

                    </tr>
                @endforeach



                </tbody>
            </table>
</div>
        </div>
    </div>

    {{-- modal crear proyecto--}}

    <x-panel.modal id="modal_crear_meta" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar meta</h4>
                </div>
                <div class="tw-modal-cuerpo">

                    <form id="form_agregar" class="" action="{{url("/presupuesto_anteproyecto/guardar_meta/".$proyecto->id_proyecto)}}" role="form" method="POST" >
                        {{ csrf_field() }}

                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label>Agregar nombre de la meta</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="nombre_meta" name="nombre_meta" rows="3" onkeyup="javascript:this.value=this.value.toUpperCase();" required></textarea>
                                </div>
                            </div>
                        </div>

                    </form>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_meta"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>

    {{-- modal modificar proyecto--}}

    <x-panel.modal id="modal_modificacion_meta" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Modificar meta</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_modificacion_meta">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_modificacion_meta"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>


    <script type="text/javascript">
        $(document).ready( function() {

            $("#guardar_meta").click(function (){
                var nombre_meta = $('#nombre_meta').val();

                if( nombre_meta != ''){

                    $("#form_agregar").submit();
                    $("#guardar_meta").attr("disabled", true);
                }else{
                    swal({
                        position: "top",
                        type: "error",
                        title: "El campo nombre de la meta no debe ser vacio",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#registros_metas").on('click','.modificar_meta',function(){
                var id_meta =$(this).attr('id');

                $.get("/presupuesto_anteproyecto/modificar_meta/"+id_meta,function (request) {
                    $("#contenedor_modificacion_meta").html(request);
                    $("#modal_modificacion_meta").modal('show');
                });
            });

            $("#registros_periodos").on('click','.modificar_periodo',function(){
                var id_periodo =$(this).attr('id');

                $.get("/presupuesto_anteproyecto/modificar_periodos_anteproyecto/"+id_periodo,function (request) {
                    $("#contenedor_modificacion").html(request);
                    $("#modal_modificacion").modal('show');
                });
            });
            $("#guardar_modificacion_meta").click(function (){
                $("#form_modificar_meta").submit();
                $("#guardar_modificacion_meta").attr("disabled", true);
            });


        });
    </script>
</div>
@endsection