@extends('layouts.panel')
@section('title', 'Residencia')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Autorizar impresión de acta de residencia" :migas="['Residencia profesional' => null]" />



    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:p-5 tw:sm:p-6">

                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_enviado" class="tw-tabla tw-tabla-bordes">
                        <thead>
                        <tr>
                            <th>No. cuenta</th>
                            <th>Nombre del estudiante</th>
                            <th>Carrera</th>
                            <th>Calificar</th>



                        </tr>
                        </thead>
                        <tbody>
                        @foreach($array_alumn as $alumnos)

                            <tr>
                                <td>{{ $alumnos['cuenta'] }}</td>
                                <td>{{ $alumnos['nombre'] }}</td>
                                <td>{{ $alumnos['carrera'] }}</td>
                                @if($alumnos['id_calificar_departamento'] == 0)

                                <td>
                                    @if($alumnos['estado_encuesta'] == 0)
                                        No se le registro encuesta
                                    <button class="edita tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" id="{{ $alumnos['id_promedio_general'] }}">Autorizar</button><br>
                                        @elseif($alumnos['estado_encuesta'] == 1)
                                    No ha contestado la encuesta
                                    @elseif($alumnos['estado_encuesta'] == 2)
                                        Encuesta contestada
                                        <button class="edita tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" id="{{ $alumnos['id_promedio_general'] }}">Autorizar</button><br>
                                    @else
                                        Encuesta rechazada
                                        <button class="edita tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" id="{{ $alumnos['id_promedio_general'] }}">Autorizar</button><br>

                                    @endif

                                </td>
                                @else
                                    <td>
                                        Autorizado
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
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2" id="container">

        </div>
    </div>

    {{-- Modal para poder imprimir la acta de residencia y registrar su calificacion --}}
    <form id="form_registar_calificacion" action="{{url("/residencia/registrar_estado_acta/")}}" class="" role="form" method="POST">
        <x-panel.modal id="modal_agregar" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Autorizar</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        {{ csrf_field() }}

                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full" id="contenedor_agregar">

                            </div>
                        </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="aceptar">Aceptar</button>
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                    </div>
                </x-panel.modal>
    </form>
    <script language="JavaScript">
        $(document).ready(function() {
            $("#table_enviado").DataTable( {
            } );

            $("#table_enviado").on('click','.edita',function(){
                var id_promedio_general=$(this).attr('id');

                $.get("/residencia/autorizacion_acta_alumno/"+id_promedio_general,function (request) {
                    $("#contenedor_agregar").html(request);
                    $("#modal_agregar").modal('show');
                });
            });
            $("#aceptar").click(function (){
                $("#aceptar").attr("disabled", true);
                $("#form_registar_calificacion").submit();
                swal({
                    position: "top",
                    type: "success",
                    title: "Autorización exitosa",
                    showConfirmButton: false,
                    timer: 3500
                });
            });



        });
    </script>


</div>
@endsection