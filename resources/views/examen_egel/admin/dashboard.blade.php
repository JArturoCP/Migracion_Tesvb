@extends('layouts.panel')
@section('title', 'Examen EGEL')
@include('partials.panel.recursos_app')
@section('content')

<main class="tw-pantalla">
    <x-panel.encabezado titulo="Examen EGEL" />

    <div class="tw:grid tw:gap-4 tw:sm:grid-cols-2 tw:xl:grid-cols-4">

        @foreach ([
            ['ruta' => route('admin.egel.resultados'), 'icono' => 'fa-bar-chart', 'texto' => 'Ver Resultados EGEL', 'tono' => 'tw:bg-brand-50 tw:text-brand-500 tw:dark:bg-brand-500/15 tw:dark:text-brand-400'],
            ['ruta' => route('admin.egel.alumno'), 'icono' => 'fa-user', 'texto' => 'Lista de Alumnos', 'tono' => 'tw:bg-green-50 tw:text-green-600 tw:dark:bg-green-500/15 tw:dark:text-green-500'],
            ['ruta' => route('admin.examenes.index'), 'icono' => 'fa-file-text-o', 'texto' => 'Administrar Exámenes', 'tono' => 'tw:bg-amber-50 tw:text-amber-600 tw:dark:bg-amber-500/15 tw:dark:text-amber-400'],
            ['ruta' => route('admin.periodos.index'), 'icono' => 'fa-calendar', 'texto' => 'Configurar Periodos', 'tono' => 'tw:bg-sky-50 tw:text-sky-600 tw:dark:bg-sky-500/15 tw:dark:text-sky-500'],
        ] as $opcion)
            <a href="{{ $opcion['ruta'] }}"
               class="tw:flex tw:items-center tw:gap-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:transition tw:hover:border-brand-300 tw:hover:shadow-theme-md tw:dark:border-gray-800 tw:dark:bg-white/[0.03] tw:dark:hover:border-brand-500/40">
                <span class="tw:flex tw:size-12 tw:shrink-0 tw:items-center tw:justify-center tw:rounded-xl tw:text-xl {{ $opcion['tono'] }}">
                    <span class="fa {{ $opcion['icono'] }}" aria-hidden="true"></span>
                </span>
                <span class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{ $opcion['texto'] }}</span>
            </a>
        @endforeach

    </div>
</main>

@endsection
