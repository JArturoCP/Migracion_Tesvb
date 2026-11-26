@extends('layouts.panel')
@section('title', 'S.Escolares')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado :titulo="'Registro de semestre que ingresó al TESVB los estudiantes '.$carrera->nombre.' (estudiantes)'" :migas="['Servicios escolares' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                <div class="tw:p-5 tw:sm:p-6">
                    <h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:bg-blue-500 tw:text-white" > Estudiantes sin semestre</h3>

                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" Style="background: white;" id="tablas_alumnos">
                        <thead>
                        <tr>
                            <th>No. CUENTA</th>
                            <th>NOMBRE DE ALUMNO(A)</th>
                            <th>AGREGAR SEMESTRE</th>
                            {{--
                            <th>DESACTIVAR</th>
                            --}}

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($alumnos as $alumno)
                            <tr>
                                <th>{{$alumno->cuenta}}</th>
                                <td>{{$alumno->nombre}} {{$alumno->apaterno}} {{$alumno->amaterno}}</td>
                                <td class="tw:text-center" >
                                    <button title="Agregar semestre" id="{{ $alumno->id_alumno }}"  class="agregar_semestre tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >
                                      Agregar
                                    </button>
                                    </td>
                                {{--
                                <td class="tw:text-center" >
                                    <button title="Desactivar estudiante" id="{{ $alumno->id_alumno }}"  class="desactivar_alumno tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" >
                                        Desactivar
                                    </button>
                                </td>
                                --}}
                            </tr>
                        @endforeach



                        </tbody>
                    </table>
</div>

                </div>
            </div>
        </div>
        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                <div class="tw:p-5 tw:sm:p-6">
                    <h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:bg-blue-500 tw:text-white" > Estudiantes con semestre registrado</h3>
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" Style="background: white;" id="tablas_alumnos_reg">
                        <thead>
                        <tr>
                            <th>No. CUENTA</th>
                            <th>NOMBRE DE ALUMNO(A)</th>
                            <th>SEMESTRE</th>
                            <th>PERIODO DE INGRESO AL TESVB</th>
                            <th>ELIMINAR</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($reg_alumnos as $alumn)
                            <tr>
                                <th>{{$alumn->cuenta}}</th>
                                <td>{{$alumn->nombre}} {{$alumn->apaterno}} {{$alumn->amaterno}}</td>
                                <td>{{$alumn->semestre}}</td>
                                <td>{{$alumn->periodo}}</td>
                                <td class="tw:text-center" >
                                    <button title="Eliminar registro" id="{{ $alumn->id_semestres_al }}"  class="eliminar_registro tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" ><span class="fa fa-trash" aria-hidden="true"></span></button>
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
    {{-- agregar semestre a estudiante--}}
    <x-panel.modal id="modal_agregar_semestre" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar semestre al estudiante</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_agregar_semestre">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_agregar_semestre"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>
    {{-- eliminar semestre a estudiante--}}
    <x-panel.modal id="modal_eliminar_semestre" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Eliminar registro del estudiante</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_eliminar_semestre">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_eliminar_semestre"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                    </div>
                </div>
            </x-panel.modal>
    {{--  desactivar estudiante--}}
    <x-panel.modal id="modal_desactivar_estudiante" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Desactivar estudiante</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_desactivar_estudiante">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_desactivar_estudiante"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                    </div>
                </div>
            </x-panel.modal>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#tablas_alumnos').DataTable();
            $('#tablas_alumnos_reg').DataTable();
        });
        $("#tablas_alumnos").on('click','.agregar_semestre',function(){
            var id_alumno=$(this).attr('id');
            $.get("/servicios_escolares/agregar_semestre_al/"+id_alumno,function (request) {
                $("#contenedor_agregar_semestre").html(request);
                $("#modal_agregar_semestre").modal('show');
            });
        });
        $("#tablas_alumnos").on('click','.desactivar_alumno',function(){
            var id_alumno=$(this).attr('id');

            $.get("/servicios_escolares/desactivar_al/"+id_alumno,function (request) {
                $("#contenedor_desactivar_estudiante").html(request);
                $("#modal_desactivar_estudiante").modal('show');
            });
        });
        $("#guardar_agregar_semestre").click(function (){
            var id_periodo = $("#id_periodo").val();
            if(id_periodo != null){
                var id_semestre = $("#id_semestre").val();
                if(id_semestre != null){
                    $("#form_guardar_semestre").submit();
                    $("#guardar_agregar_semestre").attr("disabled", true);
                    swal({
                        position: "top",
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }else{
                    swal({
                        position:"top",
                        type: "error",
                        title: "Selecciona semestre que ingreso",
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            }else{
                swal({
                    position:"top",
                    type: "error",
                    title: "Selecciona periodo que ingreso el estudiante",
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        });
       $("#tablas_alumnos_reg").on('click','.eliminar_registro',function (){
           var id_semestre_al=$(this).attr('id');

           $.get("/servicios_escolares/eliminar_semestre_al/"+id_semestre_al,function (request) {
               $("#contenedor_eliminar_semestre").html(request);
               $("#modal_eliminar_semestre").modal('show');
           });
       });
       $("#guardar_eliminar_semestre").click(function (){
           $("#form_guardar_eliminar_sem").submit();
           $("#guardar_eliminar_semestre").attr("disabled", true);
           swal({
               position: "top",
               type: "success",
               title: "Eliminación exitosa",
               showConfirmButton: false,
               timer: 3500
           });
       });
       $("#guardar_desactivar_estudiante").click(function (){
           $("#form_guardar_desactivar_est").submit();
           $("#guardar_desactivar_estudiante").attr("disabled", true);
           swal({
               position: "top",
               type: "success",
               title: "Desactivación exitosa",
               showConfirmButton: false,
               timer: 3500
           });
       });


    </script>
</div>
@endsection