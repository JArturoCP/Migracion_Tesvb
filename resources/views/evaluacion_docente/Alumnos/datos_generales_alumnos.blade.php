@extends('layouts.panel')
@section('title', 'Datos Generales')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">
    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <x-panel.encabezado titulo="Alumnos por carreras" :migas="['Estudiantes' => null]" />
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">

            <a href="/servicios_escolares/excel_datos" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Exportar Datos Generales de los Estudiantes <span class="oi oi-document tw:p-1"></span></a>
            </div>
        </div>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">
                    <div class="tw:mb-4">
                        <div class="tw:mb-4">
                            <label for="deparamento">Carreras</label>
                            <select name="carrera" id="carrera" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                <option>Selecciona carrera</option>
                                @foreach($carreras as $carrera)
                                    @if($carrera->id_carrera==$carrerita)
                                        <option value="{{$carrera->id_carrera}}" selected="selected">{{$carrera->nombre}}</option>
                                    @else
                                        <option value="{{$carrera->id_carrera}}" >{{$carrera->nombre}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
            </div>
        @if($ver == 1)
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" id="paginar_table">
                        <thead>
                        <tr>
                            <th>Cuenta</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Ver datos del alumno</th>
                            <th>Mostrar calificaciones</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($alumnos as $alumno)
                            <tr>
                                <td>{{$alumno->cuenta}}</td>
                                <td>{{$alumno->nombre}}</td>
                                <td>{{$alumno->apaterno}} {{$alumno->amaterno}} </td>
                                <td class="tw:text-center">
                                    <button class="mostrar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" id="{{ $alumno->id_alumno }}"><i class="fa fa-list"></i></button>
                                </td>
                                <td class="tw:text-center">
                                    <a class="tw:text-brand-500 tw:hover:underline" onclick="window.open('{{url('/servicios_escolares/alumnos/mostrar_calificaciones/'.$alumno->id_alumno)}}')"><i class="fa em2"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
</div>
                </div>
            </div>
        @endif



    </main>
    <x-panel.modal id="modal_mostrar" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Datos de  Alumno</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_mostrar">
                    </div>
                </div>
                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                </div>
            </x-panel.modal>

    <script type="text/javascript">
        $(document).ready( function() {
            $("#carrera").on('change',function(e){
                var id_carrera= $("#carrera").val();
//TNotify.alert(id_carrera);
                window.location.href='/servicios_escolares/alumnos/generales/'+id_carrera ;
                //  }

            });
            $('#paginar_table').DataTable();
            $("#paginar_table").on('click','.mostrar',function(){
                var idof=$(this).attr('id');

                $.get("/servicios_escolares/alumnos/mostrar/"+idof,function (request) {
                    $("#contenedor_mostrar").html(request);
                    $("#modal_mostrar").modal('show');
                });
            });
        });
    </script>
</div>
@endsection