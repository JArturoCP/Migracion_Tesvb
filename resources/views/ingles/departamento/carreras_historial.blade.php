@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Historial de Calificaciones de ingles')
@section('content')
    <main class="tw-modulo tw:mx-auto tw:max-w-5xl tw:min-w-0 tw:space-y-4 tw:rounded-2xl tw:bg-gray-50 tw:p-4 tw:sm:p-6 tw:dark:bg-gray-900">
        <h1 class="tw:m-0 tw:text-xl tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Historial de calificaciones de inglés</h1>

        <x-panel.tarjeta titulo="Programas de estudio">
            <ul class="tw:m-0 tw:grid tw:list-none tw:gap-3 tw:p-0 tw:sm:grid-cols-2">
                @forelse($carreras as $carrera)
                    <li class="tw:min-w-0">
                        <x-panel.boton variante="secundario" href="#" data-toggle="pill"
                            onclick="window.location='{{ url('/ingles/historial/ver_alumnos_carrera/'.$carrera->id_carrera ) }}'"
                            class="tw:w-full tw:justify-start tw:break-words tw:text-left">
                            {{ $carrera->nombre }}
                        </x-panel.boton>
                    </li>
                @empty
                    <li>No hay programas de estudio disponibles.</li>
                @endforelse
            </ul>
        </x-panel.tarjeta>
    </main>
@endsection
