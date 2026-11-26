@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Desactivación de grupos')
@section('content')
    <main class="tw-modulo tw:mx-auto tw:max-w-5xl tw:min-w-0 tw:space-y-4 tw:rounded-2xl tw:bg-gray-50 tw:p-4 tw:sm:p-6 tw:dark:bg-gray-900">
        <h1 class="tw:m-0 tw:text-xl tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Desactivación de grupos</h1>
        <p class="tw:text-gray-600 tw:dark:text-gray-400">Facilitador: {{ $nombre_profesor->nombre }} {{ $nombre_profesor->apellido_paterno }} {{ $nombre_profesor->apellido_materno }}</p>

        @if($cuenta_niveles == 0)
            <x-panel.vacio titulo="No se le han asignado grupos en este periodo" />
        @else
            <ul class="tw:m-0 tw:grid tw:list-none tw:gap-3 tw:p-0 tw:sm:grid-cols-2">
                @forelse($niveles as $nivel)
                    <li>
                        <x-panel.tarjeta>
                            <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-between tw:gap-3">
                                <h2 class="tw:m-0 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                                    Nivel {{ $nivel->nivel }} · Grupo {{ $nivel->grupo }}
                                </h2>
                                @if($nivel->id_estado == 0)
                                    <x-panel.boton variante="peligro" href="/ingles/profesores/desactivar_grupo_prof/{{ $nivel->id_nivel }}/{{ $nivel->id_grupo }}"
                                        class="btn btn-danger tooltip-options link" data-toggle="tooltip" data-placement="top" title="Desactivar"
                                        aria-label="Desactivar grupo {{ $nivel->grupo }} de nivel {{ $nivel->nivel }}">Desactivar</x-panel.boton>
                                @else
                                    <x-panel.boton variante="secundario" href="/ingles/profesores/activar_grupo_prof/{{ $nivel->id_nivel }}/{{ $nivel->id_grupo }}"
                                        class="btn btn-primary tooltip-options link" data-toggle="tooltip" data-placement="top" title="activar"
                                        aria-label="Activar grupo {{ $nivel->grupo }} de nivel {{ $nivel->nivel }}">Activar</x-panel.boton>
                                @endif
                            </div>
                        </x-panel.tarjeta>
                    </li>
                @empty
                    <li>No hay grupos disponibles para mostrar en este periodo.</li>
                @endforelse
            </ul>
        @endif
    </main>
@endsection
