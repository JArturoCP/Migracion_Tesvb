{{--
    Encabezado de página: título y breadcrumb de la plantilla (TailAdmin "PageBreadcrumb").
    <x-panel.encabezado titulo="Actividades" :migas="['Tutorías' => url('/tutorias/inicioalu')]">
        <x-slot:extra><x-panel.badge>Periodo 2026-1</x-panel.badge></x-slot:extra>
    </x-panel.encabezado>
    migas: [texto => url] entre "Inicio" (/inicio, siempre primero) y el título.
    extra (opcional): insignias o botones junto al título.
--}}
@props(['titulo', 'migas' => []])
<div {{ $attributes->class(['tw:mb-6 tw:flex tw:flex-wrap tw:items-center tw:justify-between tw:gap-3']) }}>
    <div class="tw:flex tw:flex-wrap tw:items-center tw:gap-3">
        <h2 class="tw:text-xl tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $titulo }}</h2>
        @isset($extra)
            <div class="tw:flex tw:flex-wrap tw:items-center tw:gap-2">{{ $extra }}</div>
        @endisset
    </div>
    <nav aria-label="Ruta de navegación">
        <ol class="tw:flex tw:flex-wrap tw:items-center tw:gap-1.5">
            @foreach (['Inicio' => url('/inicio')] + $migas as $texto => $url)
                <li>
                    <a class="tw:inline-flex tw:items-center tw:gap-1.5 tw:text-sm tw:text-gray-500 tw:hover:text-brand-500 tw:dark:text-gray-400" href="{{ $url }}">
                        {{ $texto }}
                        <svg class="tw:stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none" aria-hidden="true"><path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                    </a>
                </li>
            @endforeach
            <li class="tw:text-sm tw:text-gray-800 tw:dark:text-white/90">{{ $titulo }}</li>
        </ol>
    </nav>
</div>
