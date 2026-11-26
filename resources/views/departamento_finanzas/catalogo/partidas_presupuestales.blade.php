@extends('layouts.panel')
@section('title', 'Partidas presupuestales')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Partidas presupuestales" :migas="['Finanzas' => null]" />

        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <button data-toggle="modal"  data-tooltip="true" data-placement="left" title="Agregar nueva partida presupuestal" data-target="#modal_crear_partida_presupuestal" type="button" class="flotante tw:fixed tw:right-6 tw:bottom-6 tw:z-40 tw:inline-flex tw:size-14 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-xl tw:text-white tw:shadow-theme-lg tw:hover:bg-brand-600">
                    <span class="fa fa-plus" aria-hidden="true"></span>
                </button>
            </div>
        </div>

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" id="registros_partidas">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Clave  de la partida presupuestal</th>
                    <th>Nombre  de la partida presupuestal</th>
                    <th>Modificar</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; ?>
                @foreach($partidas as $partida)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $partida->clave_presupuestal }}</td>
                        <td>{{ $partida->nombre_partida }}</td>
                        <td>
                            <button data-toggle="tooltip" data-placement="top" id="{{$partida->id_partida_pres }}" title="Modificar partida presupuestal" class="h-primary_m modificar_partida tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap">Modificar partida</button>
                        </td>

                    </tr>
                @endforeach



                </tbody>
            </table>
</div>
        </div>
    </div>

    {{-- modal crear partida--}}

    <x-panel.modal id="modal_crear_partida_presupuestal" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar partida presupuestal</h4>
                </div>
                <div class="tw-modal-cuerpo">

                    <form id="form_agregar" class="" action="{{url("/presupuesto_anteproyecto/guardar_partida_presupuestal/")}}" role="form" method="POST" >
                        {{ csrf_field() }}
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label>Agregar clave de la partida presupuestal</label>
                                    <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   type="number"  id="clave_partida" name="clave_partida"  >
                                </div>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label>Agregar nombre de la partida presupuestal</label>
                                    <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   type="text"  id="nombre_partida"  onkeyup="javascript:this.value=this.value.toUpperCase();" name="nombre_partida"  >
                                </div>
                            </div>
                        </div>

                    </form>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_partida"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>

    {{-- modal modificar partida--}}

    <x-panel.modal id="modal_modificacion_partida" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Modificar partida presupuestal </h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_modificacion_partida">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_modificacion_partida"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>


    <script type="text/javascript">
        $(document).ready( function() {
            $("#registros_partidas").dataTable();

            $("#guardar_partida").click(function (){
                var clave_partida = $('#clave_partida').val();

                if( clave_partida != ''){
                    var nombre_partida = $('#nombre_partida').val();
                    if(nombre_partida != ''){
                        $("#form_agregar").submit();
                        $("#guardar_partida").attr("disabled", true);
                    }else{
                        swal({
                            position: "top",
                            type: "error",
                            title: "El nombre de partida presupuestal no debe ser vacia",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }
                }else{
                    swal({
                        position: "top",
                        type: "error",
                        title: "La clave de la partida presupuestal no debe ser vacia",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#registros_partidas").on('click','.modificar_partida',function(){
                var id_partida =$(this).attr('id');

                $.get("/presupuesto_anteproyecto/modificar_partida_presupuestal/"+id_partida,function (request) {
                    $("#contenedor_modificacion_partida").html(request);
                    $("#modal_modificacion_partida").modal('show');
                });
            });

            $("#registros_periodos").on('click','.modificar_periodo',function(){
                var id_periodo =$(this).attr('id');

                $.get("/presupuesto_anteproyecto/modificar_periodos_anteproyecto/"+id_periodo,function (request) {
                    $("#contenedor_modificacion").html(request);
                    $("#modal_modificacion").modal('show');
                });
            });
            $("#guardar_modificacion_partida").click(function (){
                $("#form_modificar_partida").submit();
                $("#guardar_modificacion_partida").attr("disabled", true);
            });


        });
    </script>
</div>
@endsection