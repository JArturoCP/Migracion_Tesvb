{{--
    Calificaciones de inglés del profesor (/ingles/Calificaciones, In_inicioController@inicio_calificaciones;
    también In_nivelesController para la coordinación). Diseño del panel; mismos datos, condiciones y enlaces
    (Periodos y Evaluaciones de cada nivel y grupo). Versión anterior: tests/Fixtures/vistas_antes.
--}}
@extends('layouts.panel')
@section('title', 'Calificaciones de ingles')
@include('partials.panel.recursos_app')
@section('content')
    <?php $moduloIngles = true; ?>
    <main>
        <x-panel.encabezado titulo="Calificaciones de ingles" :migas="['Inglés' => url('/ingles/')]" />

        <x-panel.tarjeta class="tw:mb-6">
            <p class="tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">Facilitador</p>
            <h3 class="tw:mt-1 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $nombre_profesor->nombre }} {{ $nombre_profesor->apellido_paterno }} {{ $nombre_profesor->apellido_materno }}</h3>
        </x-panel.tarjeta>

        @if($cuenta_niveles == 0)
            <x-panel.vacio titulo="No se le han asignado grupos en este periodo" />
        @else
            <div class="tw:grid tw:grid-cols-1 tw:gap-4 tw:sm:grid-cols-2 tw:xl:grid-cols-3 tw:md:gap-6">
                @foreach($niveles as $nivel)
                    <x-panel.tarjeta>
                        <p class="tw:text-xs tw:font-medium tw:tracking-wide tw:text-gray-500 tw:uppercase tw:dark:text-gray-400">Nivel</p>
                        <h3 class="tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">NIVEL: {{ $nivel->nivel }}</h3>
                        <p class="tw:mt-1 tw:text-sm tw:text-gray-600 tw:dark:text-gray-300">GRUPO: {{ $nivel->grupo }}</p>
                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:gap-2">
                            <x-panel.boton variante="contorno-primario" tamano="sm" href="/ingles/Calificaciones/periodos_ingles/{{ $nivel->id_nivel }}/{{ $nivel->id_grupo }}" class="tooltip-options link" title="Periodos">
                                <i class="fa fa-calendar" aria-hidden="true"></i> Periodos
                            </x-panel.boton>
                            <x-panel.boton tamano="sm" href="/ingles/Calificaciones/mostrar_alumnos/{{ $nivel->id_nivel }}/{{ $nivel->id_grupo }}" class="tooltip-options link" title="Evaluaciones">
                                <i class="fa fa-pencil" aria-hidden="true"></i> Evaluaciones
                            </x-panel.boton>
                        </div>
                    </x-panel.tarjeta>
                @endforeach
            </div>
        @endif
    </main>
@endsection
