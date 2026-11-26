@extends('layouts.panel')
@section('title', 'Servicios Escolares Agregar Alumnos en Plantilla')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <x-panel.encabezado titulo="Estudiantes candidatos" :migas="['Servicios escolares' => null]" />
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:w-full tw:lg:w-full tw:px-2">
                <div class="tw:w-full tw:lg:w-6/12 tw:lg:grow tw:px-2">
                    
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="paginar_table" class="tw-tabla-centrada tw-tabla tw-tabla-bordes">
                        <thead >
                        <tr class="tw:bg-sky-50">
                            <th class="tw:text-center" >No. de Cuenta</th>
                            <th class="tw:text-center" >Nombre</th>
                            <th class="tw:text-center" >Apellido Paterno</th>
                            <th class="tw:text-center" >Apellido Materno</th>
                            <th class="tw:text-center" >A Plantilla</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($array_estudiantes as $estudiante)
                            <tr>
                                <b><td>{{ $estudiante['cuenta'] }}</td></b>
                                <b><td>{{ $estudiante['nombre'] }}</td></b>
                                <b><td>{{ $estudiante['apaterno'] }}</td></b>
                                <b><td>{{ $estudiante['amaterno'] }}</td></b>
                                <b><td class="tw:text-center">
                                        @if($estado_periodo == 1)
                                            <a class="agrega tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-id="{{ $estudiante['id_alumno'] }}"><span class="fa fa-sign-in " aria-hidden="true"></span></a>
                                        @endif
                                    </td>
                                </b>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
</div>
                </div>
                <div class="tw:w-full tw:lg:w-4/12 tw:lg:grow tw:px-2">
                    <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">ESTUDIANTES EN PLANTILLA</h3>

                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="paginar_tabla" class="tw-tabla-centrada tw-tabla tw-tabla-bordes">
                        <thead>
                        <tr class="tw:bg-sky-50">
                            <th class="tw:text-center" >No. Cuenta</th>
                            <th class="tw:text-center" >Nombre del alumno</th>
                            <th class="tw:text-center" >Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($plantillas as $plantilla)
                            <tr>
                                <td>{{ $plantilla->cuenta }}</td>
                                <td>{{$plantilla->nombre ." ". $plantilla->apaterno ." ". $plantilla->amaterno}}</td>
                                <td class="tw:text-center">
                                    @if($estado_periodo == 1)
                                        <a class="elimina tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" data-id_alumno="{{ $plantilla->id_duales_actuales }}"><span class="fa fa-trash " aria-hidden="true"></span></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
</div>
                </div>
            </div>
        </div>

        <!-- MODAL PARA AGREGAR ALUMNOS A PLANTILLA -->
        <x-panel.modal id="modal_agrega" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">
                    <div class="tw-modal-cuerpo tw:pt-14 tw:text-center">
                        <form action="{{url("/duales/guardar_alumno_dual")}}" method="POST" role="form" id="form_alumno_crea">
                            {{ csrf_field() }}
                            <input type="hidden" id="alumno" name="alumno" value="" />
                            <b>¿Realmente deseas agregar a éste alumno a plantilla?</b>
                        </form>
                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar <span class="fa fa-times-circle"></span></button>
                            <button id="confirma_agrega" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Aceptar <span class="fa fa-check"></span></button>
                        </div>
                    </div>
                </x-panel.modal>

        <!-- MODAL PARA ELIMINAR ALUMNOS-->
        <x-panel.modal id="modal_elimina" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">
                    <div class="tw-modal-cuerpo tw:pt-14 tw:text-center">
                        <form action="" method="POST" role="form" id="form_delete">
                            {{ csrf_field() }}
                            <b>¿Realmente deseas eliminar éste elemento?</b>
                            <input type="hidden" id="eliminar_alumno" name="eliminar_alumno" value="">
                        </form>
                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar
                                <span class="fa fa-times-circle"></span></button>
                            <button id="confirma_elimina" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Aceptar <span class="fa fa-check"></span></button>
                        </div>

                    </div>
                </x-panel.modal>

        <!-- MODAL PARA AGREGAR MATERIAS -->
        <form id="form_ver_materias" role="form" method="POST">
            <x-panel.modal id="modal_materias" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                        <div class="tw:px-6 tw:pt-6 tw:pr-14 tw:text-center" >
                            
                            <b><h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">MATERIAS</h4></b>
                        </div>
                        <div class="tw-modal-cuerpo">
                            {{ csrf_field() }}
                            <input type="hidden" id="alumnM" name="alumnM" value="">
                            <input type="hidden" id="materias" name="materias" value="">
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full" id="contenedor_materias">
                                </div>
                            </div>
                        </div>
                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                            <button type="button" class="acepta tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Agregar</button>
                        </div>
                    </x-panel.modal>
        </form>
    </main>

    <script>
        $(document).ready(function() {
            $('#paginar_table').DataTable();
            $('#paginar_tabla').DataTable();
            $("#paginar_table").on('click', '.agrega', function () {
                var id_alumno = $(this).data('id');
                //TNotify.alert(id_alumno);
                $('#alumno').val(id_alumno);
                $('#modal_agrega').modal('show');
            });
            $("#paginar_tabla").on('click', '.elimina', function () {
                var id_duales_actuales=$(this).data('id_alumno');
                //TNotify.alert(id_duales_actuales);
                $('#eliminar_alumno').val(id_duales_actuales);
                $('#modal_elimina').modal('show');
            });
            $("#confirma_agrega").click(function(event){
                $("#confirma_agrega").attr("disabled", true);
                $("#form_alumno_crea").submit();
            });
            $("#confirma_elimina").click(function(event){
                var eliminar_alumno = $("#eliminar_alumno").val()
                // TNotify.alert(eliminar_alumno);
                $("#form_delete").attr("action","/duales/Eliminar_dual/"+eliminar_alumno)
                $("#form_delete").submit();
            });
        });
    </script>

</div>
@endsection

