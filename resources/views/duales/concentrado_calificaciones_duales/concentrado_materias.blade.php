@extends('layouts.panel')
@section('title', 'S.Escolares')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
<x-panel.encabezado :titulo="'Concentrado de calificaciones duales '.$nombre_carrera.' '.$id_semestre.'0'.$grupo.' (materias)'" :migas="['Educación dual' => null]" />
@if($materias == null)
<x-panel.alerta tipo="error" class="tw:mb-4">No Hay Materias Cargadas en esta Carrera</x-panel.alerta>

@else
<x-panel.alerta tipo="exito" class="tw:mb-4">Concentrado de Calificaciones por Materia</x-panel.alerta>
@endif
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                     <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw:w-full tw-tabla tw-tabla-bordes tw:lg:w-full tw:px-2" >
                        <thead>
                        <tr class="tw:bg-sky-50">
                            <th class="tw:text-center">CLAVE</th>
                            <th class="tw:text-center">MATERIA</th>
                            <th class="tw:text-center">CONCENTRADO DE CALIFICACIONES</th>
                        </tr>
                        </thead>
                        <tbody>
                      @foreach($array_materias as $materia)
                        <tr class="tw:text-center">
                            <td>{{ $materia['clave'] }}</td>
                            <td>{{ $materia['nombre'] }}</td>
                            <td colspan="3">
                                <a href="{{ url('/duales/concentrado_calificaciones_duales/concentrado_alumnos_materias/' . $materia['id_materia']) }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap">
                                    Concentrado de Calificaciones <span class="oi oi-book tw:p-1"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                        </tbody>
                    </table>
</div>
                </div>
            </div>

</div>
@endsection