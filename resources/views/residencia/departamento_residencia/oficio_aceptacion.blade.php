@extends('layouts.panel')
@section('title', 'Anteproyecto Institucional')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado :titulo="'Proyectos de Residencia del periodo '.$periodo->periodo.' ( Oficio de aceptación de proyecto)'" :migas="['Residencia profesional' => null]" />

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:p-5 tw:sm:p-6">

                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_enviado" class="tw-tabla tw-tabla-bordes">
                        <thead>
                        <tr>
                            <th>No. cuenta</th>
                            <th>Nombre del alumno</th>
                            <th>Nombre del proyecto</th>
                            <th>Asesor</th>
                            <th>Ver calificaciones </th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($datos_alumn as $anteproyecto)

                            <tr>
                                <td>{{$anteproyecto['cuenta']}}</td>
                                <td>{{$anteproyecto['nombre']}} </td>
                                <td>{{$anteproyecto['nom_proyecto']}}</td>
                                <td>{{$anteproyecto['nombre_profesor']}}</td>
                                @if($anteproyecto['estado'] ==1)
                                    <td><button class="agregar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" id="{{ $anteproyecto['id_asesores'] }}">agregar no. oficio</button></td>
                                @else

                                <td class="tw:text-center">Numero oficio: <b>{{ $anteproyecto['numero_oficio'] }}</b> <br>
                                    <button class="edita tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" id="{{ $anteproyecto['id_asesores'] }}"><i class="fa fa-pencil-square-o"></i></button> <br>
                                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" onclick="window.open('{{url('/residentes/oficio_aceptacion_proyecto/'.$anteproyecto['id_asesores'])}}')">Imprimir</button>
                                </td>
                                @endif

                            </tr>


                        @endforeach
                        </tbody>
                    </table>
</div>
                </div>
            </div>
        </div>
    </div>
    <x-panel.modal id="modal_agregar" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Agregar número de oficio</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_agregar">
                    </div>
                </div>
                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button id="guardar_nuevo" class="acepta tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Aceptar</button>
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                </div>
            </x-panel.modal>
    <x-panel.modal id="modal_modificar" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar número de oficio</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_modificar">
                    </div>
                </div>
                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button id="guardar_modificar" class="acepta tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Aceptar</button>
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                </div>
            </x-panel.modal>
    <script type="text/javascript">
        $(document).ready(function() {

            $(".agregar").click(function (){
                var id_asesor=$(this).attr('id');

                $.get("/residencia/agregar_no_oficio_aceptacion/"+id_asesor,function (request) {
                    $("#contenedor_agregar").html(request);
                    $("#modal_agregar").modal('show');
                });
            });
            $("#guardar_nuevo").click(function (){
                var numero_oficio = $("#numero_oficio").val();
                if(numero_oficio != ''){
                    $("#guardar_no_oficio").submit();
                    $("#guardar_no_oficio").attr("disabled", true);
                    swal({
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }else{
                    swal({
                        position: "top",
                        type: "error",
                        title: "Ingresa número de oficio",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $(".edita").click(function (){
                var id_asesor=$(this).attr('id');

                $.get("/residencia/modificar_no_oficio_aceptacion/"+id_asesor,function (request) {
                    $("#contenedor_modificar").html(request);
                    $("#modal_modificar").modal('show');
                });
            });
            $("#guardar_modificar").click(function (){
                var numero_oficio = $("#mod_numero_oficio").val();
                if(numero_oficio != ''){
                    $("#guardar_mod_no_oficio").submit();
                    $("#guardar_modificar").attr("disabled", true);
                    swal({
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }else{
                    swal({
                        position: "top",
                        type: "error",
                        title: "Ingresa número de oficio",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });


        });
    </script>
</div>
@endsection