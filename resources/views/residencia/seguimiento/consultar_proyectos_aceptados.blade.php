@extends('layouts.panel')
@section('title', 'Seguimiento')
@section('content')
    {{-- Encabezado de página --}}
    <div class="tw:mb-6">
        <h2 class="tw:text-xl tw:font-semibold tw:text-gray-800">Seguimiento de Residencia</h2>
        <p class="tw:mt-1 tw:text-sm tw:text-gray-500">Proyectos de residencia que tienes asignados como asesor.</p>
    </div>

    {{-- Tarjeta con la tabla --}}
    <div class="tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:md:p-6">
        <div class="tw:overflow-x-auto">
            <table id="table_enviado" class="tw:w-full tw:min-w-[640px]">
                <thead>
                <tr class="tw:border-b tw:border-gray-200">
                    <th class="tw:px-4 tw:py-3 tw:text-left tw:text-xs tw:font-medium tw:uppercase tw:text-gray-500">No. Cuenta</th>
                    <th class="tw:px-4 tw:py-3 tw:text-left tw:text-xs tw:font-medium tw:uppercase tw:text-gray-500">Nombre del alumno</th>
                    <th class="tw:px-4 tw:py-3 tw:text-left tw:text-xs tw:font-medium tw:uppercase tw:text-gray-500">Nombre del proyecto</th>
                    <th class="tw:px-4 tw:py-3 tw:text-center tw:text-xs tw:font-medium tw:uppercase tw:text-gray-500">Calificar</th>
                </tr>
                </thead>
                <tbody class="tw:divide-y tw:divide-gray-100">
                @foreach ($segumientos_proyectos as $anteproyecto)
                    <tr class="tw:hover:bg-gray-50">
                        <td class="tw:px-4 tw:py-4 tw:text-sm tw:text-gray-800">{{ $anteproyecto->cuenta }}</td>
                        <td class="tw:px-4 tw:py-4 tw:text-sm tw:text-gray-800">{{ $anteproyecto->nombre }} {{ $anteproyecto->apaterno }} {{ $anteproyecto->amaterno }}</td>
                        <td class="tw:px-4 tw:py-4 tw:text-sm tw:text-gray-600">{{ $anteproyecto->nom_proyecto }}</td>
                        @if($anteproyecto->autorizacion_departamento == 1)
                            <td class="tw:px-4 tw:py-4 tw:text-center">
                                <a href="{{ url('/residencia/seguimiento_alumno/'.$anteproyecto->id_anteproyecto) }}"
                                   title="Revisar anteproyecto"
                                   class="tw:inline-flex tw:size-9 tw:items-center tw:justify-center tw:rounded-lg tw:border tw:border-gray-200 tw:text-brand-500 tw:hover:bg-brand-50">
                                    <svg class="tw:size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/>
                                    </svg>
                                    <span class="tw:sr-only">Revisar anteproyecto</span>
                                </a>
                            </td>
                        @else
                            <td class="tw:px-4 tw:py-4">
                                <span class="tw:inline-block tw:rounded-lg tw:bg-amber-50 tw:px-3 tw:py-1.5 tw:text-xs tw:font-medium tw:text-amber-700">
                                    No han sido autorizado sus documentos por el Departamento de Servicio Social y Residencia Profesional
                                </span>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
