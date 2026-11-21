@extends('layouts.panel')
@section('title', 'Reporte Final EGEL')
@include('partials.panel.recursos_app')
@section('content')

<main class="tw-pantalla tw:space-y-6">
    <x-panel.encabezado titulo="📄 Reporte Final EGEL" :migas="['Examen EGEL' => url('/examen_egel/dashboard')]" />

    {{-- INFO ALUMNO --}}
    <x-panel.tarjeta>
        <p class="tw:text-sm tw:font-medium tw:text-gray-500 tw:dark:text-gray-400">Estudiante:</p>
        <h4 class="tw:mt-1 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
            {{ $alumno->nombre }} {{ $alumno->apaterno }} {{ $alumno->amaterno }}
        </h4>

        @if($resultado)
            <div class="tw:mt-5 tw:grid tw:gap-4 tw:border-t tw:border-gray-100 tw:pt-5 tw:text-center tw:md:grid-cols-2 tw:dark:border-gray-800">
                <div>
                    <p class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-500 tw:dark:text-gray-400">Calificación general</p>
                    <x-panel.badge class="tw:px-3 tw:py-1.5">{{ $resultado->calificacion_general }}%</x-panel.badge>
                </div>

                <div>
                    <p class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-500 tw:dark:text-gray-400">Nivel</p>
                    <x-panel.badge tono="exito" class="tw:px-3 tw:py-1.5">{{ $resultado->nivel }}</x-panel.badge>
                </div>
            </div>
        @endif
    </x-panel.tarjeta>

    {{-- RESULTADOS --}}
    <x-panel.tarjeta titulo="📊 Resultados por módulo" sin-relleno>
        <x-panel.tabla class="tw:text-center">
            <thead>
                <tr>
                    <th class="tw:text-center">Módulo</th>
                    <th class="tw:text-center">Puntos obtenidos</th>
                    <th class="tw:text-center">Total puntos</th>
                    <th class="tw:text-center">%</th>
                </tr>
            </thead>

            <tbody>
            @foreach($porModulo as $m)
                <tr>
                    <td><b>{{ $m->nombre }}</b></td>
                    <td>{{ number_format($m->puntos, 2) }}</td>
                    <td>{{ number_format($m->total_valor, 2) }}</td>
                    <td>
                        <x-panel.badge tono="info">{{ $m->porcentaje }}%</x-panel.badge>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </x-panel.tabla>
    </x-panel.tarjeta>

    {{-- BOTÓN --}}
    <div class="tw:text-center">
        <x-panel.boton variante="peligro" tamano="lg" class="tw:rounded-full" href="{{ route('egel.pdf.oficial') }}" target="_blank">
            <span class="fa fa-file-pdf-o" aria-hidden="true"></span> Descargar Reporte Oficial
        </x-panel.boton>
    </div>
</main>

@endsection
