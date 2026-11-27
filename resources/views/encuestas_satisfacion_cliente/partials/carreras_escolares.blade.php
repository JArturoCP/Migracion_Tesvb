@if ($mostrarEncabezado ?? true)
    <x-panel.encabezado titulo="Programas de estudio" :migas="['Periodos de las encuestas' => $urlPeriodos]" />
@endif

<x-panel.tarjeta :titulo="$titulo" :subtitulo="$periodo_nom ? 'Periodo '.$periodo_nom->periodo : null">
    @if (count($carreras))
        <ul class="tw:grid tw:gap-3 tw:sm:grid-cols-2">
            @foreach ($carreras as $carrera)
                <li>
                    <a href="{{ $urlAlumnos.'/'.$carrera->id_carrera.($sufijoRuta ?? '') }}"
                        class="tw:flex tw:h-full tw:items-center tw:justify-between tw:gap-3 tw:rounded-xl tw:border tw:border-gray-200 tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:text-gray-800 tw:transition-colors tw:hover:border-brand-300 tw:hover:bg-brand-50 tw:hover:text-brand-700 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:text-gray-200 tw:dark:hover:bg-brand-500/10 tw:dark:hover:text-brand-300">
                        <span>{{ $carrera->nombre }}</span>
                        <svg class="tw:size-4 tw:shrink-0 tw:stroke-current" aria-hidden="true" viewBox="0 0 20 20" fill="none">
                            <path d="m7 4 6 6-6 6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <x-panel.vacio titulo="Sin programas de estudio" />
    @endif
</x-panel.tarjeta>
