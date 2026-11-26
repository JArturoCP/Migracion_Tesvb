@extends('layouts.panel')
@section('title', 'Carreras')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Programas de estudio" :migas="['Docentes' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                
            <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                @if($carreras!=null)
                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:lg:w-full tw:px-2">
                        <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4">
                            <ul class="tw:mb-6 tw:divide-y tw:divide-gray-100 tw:overflow-hidden tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03] tw:w-full tw:lg:w-4/12 tw:px-2">
                                @foreach($carreras as $carrera)
                                    <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" data-toggle="pill" data-toggle="pill" href="#{{ $carrera ["id_carrera"] }}">{{ $carrera ["nombre_carrera"] }}</a></li>
                                @endforeach
                            </ul>
                            <div class="tab-content tw:w-full tw:lg:w-8/12 tw:px-2">
                                <div class="tab-pane fade in active tw:text-center">
                                    <div class="tw:w-full tw:px-2">
                                        <label class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800"  data-toggle="tab" >Seleccione una carrera para consultar sus materias disponibles
                                        </label>
                                    </div>
                                </div>
                                @foreach($carreras as $carrera)
                                    <div id="{{$carrera ["id_carrera"] }}" class="tab-pane">
                                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla-centrada border-table tw-tabla tw:my-0">
                                            <thead>
                                            <tr class="tw:text-center">
                                                <th class="tw:text-center">NP.</th>
                                                <th class="tw:text-center">Materias</th>
                                                <th class="tw:text-center">Semestre</th>
                                                <th class="tw:text-center">Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($carrera['materias']   as $materia)
                                                <tr>
                                                    <td>{{$materia['contador'] }}</td>
                                                    <td><label for="" class="border-success tw:rounded-lg tw:px-4 tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:text-green-600"><strong>{{$materia["nombre_materia"]}}</strong></label></td>
                                                    <td>{{$materia['nombre_semestre']}}</td>
                                                    <td>
                                                        <span data-toggle="modal" data-target="#modal_grupos_{{$materia['id_materia']}}" data-id=""><a href="#!" class="tooltip-options link tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-toggle="tooltip" data-placement="top" title="ver"><span class="oi oi-eye"></span></a></span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:lg:w-full tw:px-2">
                        <div class="tw:w-full tw:px-2">
                            <label class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700 tw:text-center"  data-toggle="tab" ><h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">No tiene materias asignadas para el periodo seleccionado
                            </h3></label>
                        </div>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
    <div>
        @foreach($carreras as $carrera)
            @foreach($carrera['materias']   as $materia)
                <x-panel.modal id="modal_grupos_{{$materia['id_materia']}}" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                
                                <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">{{$materia['nombre_materia']}}</h4>
                            </div>
                                <div class="tw-modal-cuerpo">
                                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla-centrada border-table tw-tabla tw:my-0">
                                        <thead>
                                        <tr class="tw:text-center">
                                            <th class="tw:text-center">Grupo</th>
                                            <th class="tw:text-center">Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($materia['grupos'] as $grupo)
                                                <tr>
                                                    <td>{{$grupo['grupos']}}</td>
                                                    <td>
                                                        <a href="/docente/acciones/periodo/{{$id_docente}}/{{$materia['id_materia']}}/{{$grupo['id_grupo']}}" class="tooltip-options link tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-toggle="tooltip" data-placement="top" title="Periodos"><span class="oi oi-calendar"></span></a>
                                                        <a href="/docente/acciones/calificacion/{{$id_docente}}/{{$materia['id_materia']}}/{{$grupo['id_grupo']}}" class="tooltip-options link tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-toggle="tooltip" data-placement="top" title="Evaluaciones"><span class="oi oi-pencil"></span></a>
                                                        @if($periodo_sumativas)
                                                            <a href="/docente/{{$id_docente}}/{{$materia['id_materia']}}/{{$materia ['id_semestre']}}/{{$grupo['id_grupo']}}/{{$carrera['nombre_carrera']}}/sumativas" class="tooltip-options link tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-toggle="tooltip" data-placement="top" title="Evaluación sumativa de complementación"><span class="oi oi-pencil"></span></a>
                                                        @else
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
</div>
                                </div>
                                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                </div>
                        </x-panel.modal>
            @endforeach
        @endforeach
    </div>
</div>
@endsection