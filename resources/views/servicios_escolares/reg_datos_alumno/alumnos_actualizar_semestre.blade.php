@extends('layouts.panel')
@section('title', 'S.Escolares')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado :titulo="'Actualización de semestre a estudiantes '.$carrera->nombre.' periodo activo '.$periodo_activo->periodo.' (estudiantes)'" :migas="['Servicios escolares' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">

                    <button data-toggle="modal"  data-tooltip="true" data-placement="left" title="Actualizacion del semestre" data-target="#modal_actualizacion_sem" type="button" class="flotante tw:fixed tw:right-6 tw:bottom-6 tw:z-40 tw:inline-flex tw:size-14 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-xl tw:text-white tw:shadow-theme-lg tw:hover:bg-brand-600">
                     Actualizar semestre
                    </button>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
            <h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:bg-blue-500 tw:text-white" > Estudiantes sin semestre actualizado en este periodo</h3>

            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                <div class="tw:p-5 tw:sm:p-6">

                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" Style="background: white;" id="tablas_alumnos">
                        <thead>
                        <tr>
                            <th>No. CUENTA</th>
                            <th>NOMBRE DE ALUMNO(A)</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($reg_alumnos as $alum)
                            <tr>
                                <th>{{$alum->cuenta}}</th>
                                <td>{{$alum->nombre}} {{$alum->apaterno}} {{$alum->amaterno}}</td>


                            </tr>
                        @endforeach



                        </tbody>
                    </table>
</div>

                </div>
            </div>
        </div>
        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
            <h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:bg-blue-500 tw:text-white" > Estudiantes con semestre actualizado en este periodo</h3>

            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                <div class="tw:p-5 tw:sm:p-6">

                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" Style="background: white;" id="tablas_alumnos_act">
                        <thead>
                        <tr>
                            <th>No. CUENTA</th>
                            <th>NOMBRE DE ALUMNO(A)</th>
                            <th>SEMESTRE</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($alumnos_act as $alumno)
                            <tr>
                                <th>{{$alumno->cuenta}}</th>
                                <td>{{$alumno->nombre}} {{$alumno->apaterno}} {{$alumno->amaterno}}</td>
                                <td>{{$alumno->semestre}}</td>


                            </tr>
                        @endforeach



                        </tbody>
                    </table>
</div>

                </div>
            </div>
        </div>
    </div>
    {{--  activar estudiante--}}
    <x-panel.modal id="modal_actualizacion_sem" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Actualizar semestre</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <form  id="form_guardar_actualizacion" action="{{url("/servicios_escolares/guardar_act_sem_al/".$periodo_activo->id_periodo."/".$carrera->id_carrera)}}" role="form" method="POST" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                    <h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center" >¿Seguro(a) que quieres actualizar el semestre a los estudiantes?</h3>
                    </form>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_actualizacion"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                    </div>
                </div>
            </x-panel.modal>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#tablas_alumnos').DataTable();
            $('#tablas_alumnos_act').DataTable();

            $("#guardar_actualizacion").click(function (){
                $("#form_guardar_actualizacion").submit();
                $("#guardar_actualizacion").attr("disabled", true);
                swal({
                    position: "top",
                    type: "success",
                    title: "Actualización exitosa",
                    showConfirmButton: false,
                    timer: 3500
                });
            });
        });
    </script>
</div>
@endsection