@extends('layouts.panel')
@section('title', 'S.Escolares')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado :titulo="'Estudiantes inactivos (que no se le agregaría semestre) '.$carrera->nombre.' (estudiantes)'" :migas="['Servicios escolares' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                <div class="tw:p-5 tw:sm:p-6">

                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" Style="background: white;" id="tablas_alumnos">
                        <thead>
                        <tr>
                            <th>No. CUENTA</th>
                            <th>NOMBRE DE ALUMNO(A)</th>
                            <th>ACTIVAR</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($alumnos as $alumno)
                            <tr>
                                <th>{{$alumno->cuenta}}</th>
                                <td>{{$alumno->nombre}} {{$alumno->apaterno}} {{$alumno->amaterno}}</td>
                                <td class="tw:text-center" >
                                    <button title="Activar estudiante" id="{{ $alumno->id_alumno }}"  class="activar_estudiante tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" >
                                        Activar
                                    </button>
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
    {{--  activar estudiante--}}
    <x-panel.modal id="modal_activacion_estudiante" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Activar estudiante</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_activacion_estudiante">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_activar_estudiante"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                    </div>
                </div>
            </x-panel.modal>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tablas_alumnos').DataTable();
            $('#tablas_alumnos_reg').DataTable();
        });
        $("#tablas_alumnos").on('click','.activar_estudiante',function(){
            var id_alumno=$(this).attr('id');
            $.get("/servicios_escolares/activacion_estudiante_seme/"+id_alumno,function (request) {
                $("#contenedor_activacion_estudiante").html(request);
                $("#modal_activacion_estudiante").modal('show');
            });
            $("#guardar_activar_estudiante").click(function (){
                $("#form_guardar_activar_est").submit();
                $("#guardar_activar_estudiante").attr("disabled", true);
                swal({
                    position: "top",
                    type: "success",
                    title: "Activación exitosa",
                    showConfirmButton: false,
                    timer: 3500
                });
            });
        });
    </script>
</div>
@endsection