@extends('layouts.panel')
@section('title', 'Registrar estudiantes con adeudo')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">
    <main class="tw:w-full tw:lg:w-full tw:px-2">

        <x-panel.encabezado titulo="Registrar estudiante con adeudo" :migas="['Constancias de no adeudo' => null]" />

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
                    <div class="tw:w-full tw:lg:w-5/12 tw:px-2">
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
                                        <th>Agregar Estudiante deudor</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($alumnos as $alumno)

                                        <tr>
                                            <td>{{ $alumno->cuenta }}</td>
                                            <td> {{ $alumno->apaterno }} {{ $alumno->amaterno }} {{ $alumno->nombre }}</td>
                                            <td>{{ $alumno->semestre }}</td>
                                            <td>  <button type="button" class="enviar tw:w-full tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" data-id_alumno="{{$alumno->id_alumno}}" data-nombre="{{ $alumno->apaterno }} {{ $alumno->amaterno }} {{ $alumno->nombre }}" title="Agregar ">Agregar</button></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
</div>
                            </div>
                        </div>
                    </div>
                    <div class="tw:w-full tw:lg:w-7/12 tw:px-2">
                        <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Estudiantes con adeudo</h3>
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6">

                                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_adeudos" class="tw-tabla tw-tabla-bordes">
                                    <thead>
                                    <tr>
                                        <th>No. Cuenta</th>
                                        <th>Nombre del Estudiante</th>
                                        <th>Semestre</th>
                                        <th>Fecha de registro</th>
                                        <th>Adeudo</th>
                                        <th>Editar</th>
                                        <th>Eliminar del adeudo</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($alumnos_adeudo as $alumnos_adeudo)

                                        <tr>
                                            <td>{{ $alumnos_adeudo->cuenta }}</td>
                                            <td> {{ $alumnos_adeudo->apaterno }} {{ $alumnos_adeudo->amaterno }} {{ $alumnos_adeudo->nombre }}</td>
                                            <td>{{ $alumnos_adeudo->semestre }}</td>
                                            <td>{{ $alumnos_adeudo->fecha_registro }}</td>
                                            <td>{{ $alumnos_adeudo->comentario }}</td>

                                            <td>   <a class="editar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" id="{{ $alumnos_adeudo->id_adeudo_departamento }}"><i class="fa fa-pencil-square-o"></i></a>
                                            </td>
                                            <td>  <button type="button" class="eliminar tw:w-full tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" id="{{$alumnos_adeudo->id_adeudo_departamento}}" title="Eliminar de adeudo">Eliminar </button></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
</div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-panel.modal id="modal_enviar" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">
                                 <div class="tw-modal-cuerpo tw:pt-14">
                                    {{ csrf_field() }}
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:lg:w-full tw:px-2">
                                    <input type="button" id="nombre" name="nombre" value=""> se registrara por adeudo de?
                                    <input type="hidden" id="id_alumno" name="id_alumno" value="">
                                        <input type="hidden" id="id_carrera" name="id_carrera" value="{{$id_carrera}}">
                                    </div>
                                    </div>

                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:lg:w-full tw:px-2">
                                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" type="text" id="comentario" name="comentario" required></textarea>
                                        </div>
                                    </div>

                                     </div>
                                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                                    <button id="aceptar_registro"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Aceptar">Aceptar</button>
                                </div>

                        </x-panel.modal>

                <x-panel.modal id="modal_eliminar" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">
                            <form action="{{url("/eliminar_alumno_adeudo/$id_carrera")}}" method="POST" role="form" >
                                <div class="tw-modal-cuerpo tw:pt-14">
                                    {{ csrf_field() }}
                                    ¿Eliminar alumno del adeudo?
                                    <input type="hidden" id="id_adeudo_carrera" name="id_adeudo_carrera" value="">

                                </div>
                                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                                    <input  type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Aceptar"/>
                                </div>
                            </form>
                        </x-panel.modal>

                @endif




    </main>
    <x-panel.modal id="modal_editar" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Editar comentario</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_editar">
                    </div>
                </div>

            </x-panel.modal>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table_enviado').DataTable( );
            $('#table_adeudos').DataTable( );
            $("#carrera").on('change',function(e){
                var carrera= $("#carrera").val();
                window.location.href='/solicitud_alumno_adeudo/'+carrera ;


            });
            $("#aceptar_registro").click(function ()
            {
                var comentario = $("#comentario").val();
               if(comentario == ""){
                   swal({
                       position: "top",
                       type: "error",
                       title: "hay un campo vacio",
                       showConfirmButton: false,
                       timer: 3500
                   });
               }
               else{
                   $("#aceptar_registro").attr("disabled", true);
                   var id_alumno = $("#id_alumno").val();
                   var id_carrera = $("#id_carrera").val();
                   window.location.href='/registrar_alumno_adeudo/'+id_carrera+"/"+id_alumno+"/"+comentario;
               }
            });

            $("#table_enviado").on('click','.enviar',function(){
                var id=$(this).data('id_alumno');
                var nombre= $(this).data('nombre');

                $('#id_alumno').val(id);
                $('#nombre').val(nombre);
                $('#modal_enviar').modal('show');
            });


            $("#table_adeudos").on('click','.eliminar',function(){
                var id=$(this).attr('id');
                $('#id_adeudo_carrera').val(id);
                $('#modal_eliminar').modal('show');
            });


            $("#table_adeudos").on('click','.editar',function(){
                var id=$(this).attr('id');

                $.get("/constancia_alumno_editar/"+id,function (request) {
                    $("#contenedor_editar").html(request);
                    $("#modal_editar").modal('show');
                });
            });

        });
    </script>

</div>
@endsection