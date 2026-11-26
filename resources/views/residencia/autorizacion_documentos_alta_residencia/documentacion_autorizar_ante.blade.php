@extends('layouts.panel')
@section('title', 'Autorizar documentación Anteproyecto')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <p>
                <span class="fa fa-arrow-right"></span>
                <a class="tw:text-brand-500 tw:hover:underline" href="{{url("/residencia/autorizar_documentacion_anteproyecto")}}">Programas de Estudios</a>
                <span class="fa fa-chevron-right"></span>
                <span>Autorizar documentación</span>

            </p>
        </div>
    </div>
    <x-panel.encabezado :titulo="'Autorizar documentación de Alta de Residencia del periodo '.$nombre_periodo.' Carrreras'" :migas="['Residencia profesional' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:p-5 tw:sm:p-6">

                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_anteproyecto" class="tw-tabla tw-tabla-bordes">
                        <thead>
                        <tr>
                            <th>No. cuenta</th>
                            <th>Nombre del alumno</th>
                            <th>Nombre del anteproyecto</th>
                            <th>Autorizar documentación de alta de residencia</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($array_anteproyecto as $anteproyecto)

                            <tr>
                                <td>{{$anteproyecto['cuenta']}}</td>
                                <td>{{$anteproyecto['nombre']}}</td>
                                <td>{{ $anteproyecto['nom_proyecto']}}</td>

                                @if($anteproyecto['autorizacion_departamento'] == 0)
                                @if($anteproyecto['estado_empresa']== 2)
                                    <td>
                                        <button class="autorizar_documentos tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" id="{{ $anteproyecto['id_anteproyecto'] }}">Autorizar</button>
                                    </td>
                                @elseif($anteproyecto['estado_empresa']== 1)
                                    <td>
                                        No se le ha asignado asesor interno
                                    </td>

                                @elseif($anteproyecto['estado_empresa']== 0)
                                    <td>
                                        No ha registrado el alumno su empresa
                                    </td>
                                @endif
                                @else
                                    <td>Documentación Autorizada</td>
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
    <x-panel.modal id="modal_enviar" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Autorizar documentación de Alta de Residencia</h4>
                    </div>
                <form action="{{url("/residencia/guardar_autorizacion_documentacion_alumn/")}}" role="form" method="POST" >
                    {{ csrf_field() }}
                    <div id="contenedor_enviar">


                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <input  type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Aceptar"/>
                    </div>
                </form>
            </x-panel.modal>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table_anteproyecto').DataTable( {

            } );
            $("#table_anteproyecto").on('click','.autorizar_documentos',function(){
                var id_anteproyecto = $(this).attr('id');

                $.get("/residencia/ver_datos_anteproyecto_alum/"+id_anteproyecto,function (request) {
                    $("#contenedor_enviar").html(request);
                    $("#modal_enviar").modal('show');
                });
            });

        });
    </script>
</div>
@endsection

