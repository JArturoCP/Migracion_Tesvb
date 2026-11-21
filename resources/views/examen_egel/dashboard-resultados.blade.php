@extends('layouts.panel')
@section('title', 'Resultado EGEL')
@include('partials.panel.recursos_app')
@section('content')

<main class="tw-pantalla tw:space-y-6">
    <x-panel.encabezado titulo="📊 Resultado EGEL" :migas="['Examen EGEL' => url('/examen_egel/dashboard')]" />

    <!-- Resultado general -->
    <x-panel.tarjeta titulo="Resultado General" class="tw:text-center">
        @if($resultado)
            <p class="tw:my-2.5 tw:text-6xl tw:font-bold tw:text-brand-500">
                {{ $resultado->calificacion_general }}%
            </p>
            <p class="tw:text-lg tw:text-gray-700 tw:dark:text-gray-300">
                Nivel: <strong>{{ $resultado->nivel }}</strong>
            </p>
        @else
            <p class="tw:text-gray-500 tw:dark:text-gray-400">Aún no hay resultado generado</p>
        @endif
    </x-panel.tarjeta>

    <!-- Resultados por módulo -->
    <x-panel.tarjeta titulo="📚 Resultados por módulo" sin-relleno>
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
                        <td>{{ $m->nombre }}</td>
                        <td>{{ number_format($m->puntos, 2) }}</td>
                        <td>{{ number_format($m->total_valor, 2) }}</td>
                        <td>
                            <x-panel.badge>{{ $m->porcentaje }}%</x-panel.badge>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-panel.tabla>
    </x-panel.tarjeta>

    <!-- Resultados por sección -->
    <x-panel.tarjeta titulo="📑 Resultados por sección" sin-relleno>
        <x-panel.tabla class="tw:text-center">
            <thead>
                <tr>
                    <th class="tw:text-center">Sección</th>
                    <th class="tw:text-center">Puntos obtenidos</th>
                    <th class="tw:text-center">Total puntos</th>
                    <th class="tw:text-center">%</th>
                </tr>
            </thead>
            <tbody>
                @foreach($porSeccion as $s)
                    <tr>
                        <td>Sección {{ $s->id_seccion }}</td>
                        <td>{{ number_format($s->puntos, 2) }}</td>
                        <td>{{ number_format($s->total_valor, 2) }}</td>
                        <td>
                            <x-panel.badge tono="exito">{{ $s->porcentaje }}%</x-panel.badge>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-panel.tabla>
    </x-panel.tarjeta>

    <!-- Botón final -->
    <div class="tw:text-center">
        <x-panel.boton tamano="lg" href="{{ route('egel.resultados.reporte') }}">
            📄 Reporte final
        </x-panel.boton>
    </div>
</main>

@endsection
