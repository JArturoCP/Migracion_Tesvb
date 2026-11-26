@extends('layouts.panel')
@section('title', 'Autorizar Documentos de Liberación de Residencia')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

    <x-panel.encabezado :titulo="'Documentos de Liberación de Residencia Autorizados por Carreras del Periodo '.$nombre_periodo" :migas="['Residencia profesional' => null]" />
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
    @elseif($mostrar == 1)
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
                <li>
                    <a href="{{ url('/residencia/revision_doc_finales/'.$id_carrera ) }}" >Autorizar Documentación</a>
                </li>
                <li>
                    <a href="{{ url('/residencia/proceso_mod_doc_finales/'.$id_carrera ) }}" >En proceso de Modificación</a>
                </li>
                <li class="active"><a href="#">Documentación Autorizada</a></li>





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
<table id="table_doc_autorizados" class="tw-tabla tw-tabla-bordes">
                            <thead>
                            <tr>
                                <th>No. cuenta</th>
                                <th>Nombre del alumno</th>
                                <th>Ver documentación</th>



                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($alumnos as $alumno)

                                <tr>
                                    <td>{{$alumno->cuenta}}</td>
                                    <td>{{ $alumno->alumno }} {{$alumno->apaterno}}  {{$alumno->amaterno}}</td>
                                    <td>
                                        <button class="ver_documentos tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" id="{{ $alumno->id_liberacion_documentos }}">Ver documentación</button>
                                    </td>


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
    <x-panel.modal id="doc_autorizados" tamano="xl" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Documentación Autorizada</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_doc_autorizados">
                    </div>
                </div>

            </x-panel.modal>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table_doc_autorizados').DataTable( );
            $("#carrera").on('change',function(e){
                var id_carrera= $("#carrera").val();
                window.location.href='/residencia/proceso_mod_doc_finales/'+id_carrera ;
            });
            $("#table_doc_autorizados").on('click','.ver_documentos',function(){
                var id_liberacion_documentos=$(this).attr('id');
                $.get("/residencia/ver_doc_finales_aut/doc/"+id_liberacion_documentos,function (request) {
                    $("#contenedor_doc_autorizados").html(request);
                    $("#doc_autorizados").modal('show');
                });

            });
        });
    </script>
</div>
@endsection