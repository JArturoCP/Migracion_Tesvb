@extends('layouts.panel')
@section('title', 'Constancias de no adeudo')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">
    <main class="tw:w-full tw:lg:w-full tw:px-2">

        <x-panel.encabezado titulo="Descargar constancias de no adeudo" :migas="['Constancias de no adeudo' => null]" />

        @if($estado == 1)
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">
                    <div class="tw:mb-4">
                        <label for="exampleInputEmail1">Elige una carrera<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg" >*</b></label>
                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="carrera" name="carrera" required>
                            <option disabled selected hidden>Selecciona una opción</option>
                            @foreach($carreras as $carrera)
                                <option value="{{$carrera->id_carrera}}" data-esta="{{$carrera->nombre}}">{{$carrera->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        @elseif($estado == 2)
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">
                    <div class="tw:mb-4">
                        <label for="exampleInputEmail1">Elige una carrera<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg" >*</b></label>
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
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Estudiantes de la carrera</h3>
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:p-5 tw:sm:p-6">

                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_enviado" class="tw-tabla tw-tabla-bordes">
                                <thead>
                                <tr>
                                    <th>No. Cuenta</th>
                                    <th>Nombre del Estudiante</th>
                                    <th>Semestre</th>
                                    <th>Carrera</th>
                                    <th>Constancias</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($alumnos as $alumno)

                                    <tr>
                                        <td>{{ $alumno->cuenta }}</td>
                                        <td> {{ $alumno->apaterno }} {{ $alumno->amaterno }} {{ $alumno->nombre }}</td>
                                        <td>{{ $alumno->semestre }}</td>
                                        <td>{{ $alumno->carrera }}</td>
                                        <td class="tw:text-center" >  <button type="button" class="btn-small enviar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-id_alumno="{{$alumno->id_alumno}}" ><i class="fa fa-pencil "></i></button></td>
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


        <x-panel.modal id="modal_constancia" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Constancias de no adeudo</h4>
                    </div>
                    <div id="contenedor_constancia">


                    </div>



                </x-panel.modal>

    </main>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table_enviado').DataTable( );
            $('#table_adeudos').DataTable( );
            $("#carrera").on('change',function(e){
                var id_carrera= $("#carrera").val();
                window.location.href='/constancia_carrera/'+id_carrera ;


            });


            $("#table_enviado").on('click','.enviar',function(){
                var id=$(this).data('id_alumno');
                $.get("/ver_estado_alumno/"+id,function(request){
                    $("#contenedor_constancia").html(request);
                    $("#modal_constancia").modal('show');

                });


            });




        });
    </script>

</div>
@endsection