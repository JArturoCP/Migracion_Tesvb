@extends('layouts.panel')
@section('title', 'Anteproyecto autorizar')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

    <x-panel.encabezado :titulo="'Autorizar Documentos de Alta de Residencia por Carreras del Periodo '.$nombre_periodo" :migas="['Residencia profesional' => null]" />
    @if($mostrar == 0)
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">
                <div class="tw:mb-4">
                    <label for="exampleInputEmail1">Elige carrrera<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="carrera" name="carrera" required>
                        <option disabled selected hidden>Selecciona una opción</option>
                        @foreach($carreras as $carrera)
                            <option value="{{$carrera->id_carrera}}" data-esta="{{$carrera->nombre}}">{{$carrera->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    @endif
    @if($mostrar == 1)
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">
                <div class="tw:mb-4">
                    <label for="exampleInputEmail1">Elige carrrera<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="carrera" name="carrera" required>
                        <option disabled selected hidden>Selecciona una opción</option>
                        @foreach($carreras as $carrera)
                            @if($carrera->id_carrera==$id_carrera)
                                <option value="{{$carrera->id_carrera}}" selected="selected">{{$carrera->nombre}}</option>
                            @else
                                <option value="{{$carrera->id_carrera}}" >{{$carrera->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:px-2">
            <ul class="tw:w-full tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200 tw:dark:border-gray-800">
                <li class="active"><a href="#">Autorizar Documentación</a></li>
                <li>
                    <a href="{{ url('/residencia/autorizar_anteproyecto/anteproyecto_proceso_modificacion/'.$id_carrera ) }}" >En proceso de Modificación</a>
                </li>




            </ul>
            <p class="tw:w-full">
                <br>
            </p>
        </div>
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
                                <th>Autorizar anteproyecto</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($anteproyectos_alumn as $anteproyecto)

                                <tr>
                                    <td>{{$anteproyecto['cuenta']}}</td>
                                    <td>{{$anteproyecto['alumno']}} {{$anteproyecto['apaterno']}}  {{$anteproyecto['amaterno']}}</td>
                                    <td>{{$anteproyecto['nom_proyecto']}}</td>
                                    @if($anteproyecto['estado_alumno']== 1)
                                <td>
                                        <button class="autorizar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" id="{{ $anteproyecto['id_anteproyecto'] }}">Autorizar</button>
                                </td>
                                        @elseif($anteproyecto['estado_alumno']== 4)
                                        <td>
                                            <button class="autorizar_modificacion tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" id="{{ $anteproyecto['id_anteproyecto'] }}">Autorizar modificación</button>
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
    @endif


    <!-- Modal -->
    <x-panel.modal id="autorizar_documento" tamano="xl" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Autorización de documentación</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_documento">
                    </div>
                </div>

            </x-panel.modal>

    <x-panel.modal id="autorizar_documento_modificado" tamano="xl" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Autorización de documentación</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_documento_modificado">
                    </div>
                </div>

            </x-panel.modal>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table_enviado').DataTable( );
            $("#carrera").on('change',function(e){
                var carrera= $("#carrera").val();
                window.location.href='/residencia/autorizar_anteproyecto/anteproyecto_autorizar/'+carrera ;


            });

            $("#table_enviado").on('click','.autorizar',function(){
                var id_anteproyecto=$(this).attr('id');
                $.get("/residencia/autorizacion_documentacion/"+id_anteproyecto,function (request) {
                    $("#contenedor_documento").html(request);
                    $("#autorizar_documento").modal('show');
                });
                });
            $("#table_enviado").on('click','.autorizar_modificacion',function(){
                var id_anteproyecto=$(this).attr('id');
                $.get("/residencia/autorizacion_documentacion_modificada/"+id_anteproyecto,function (request) {
                    $("#contenedor_documento_modificado").html(request);
                    $("#autorizar_documento_modificado").modal('show');
                });
            });
        });
    </script>
</div>
@endsection