@extends('layouts.panel')
@section('title', 'Inicio')
@section('sin_pie', '1')

@section('content')
    <div class="tw:grid tw:min-w-0 tw:gap-6" data-panel-estudiante>
        @if($estudiante)
            @include('panel.dashboard.estudiante.bienvenida')
            @include('panel.dashboard.estudiante.accesos')
            @include('panel.dashboard.estudiante.novedades')
        @else
            <section class="tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-6 tw:dark:border-gray-800 tw:dark:bg-gray-800">
                <h1 class="tw:text-xl tw:font-semibold tw:text-gray-900 tw:dark:text-white">Inicio estudiantil</h1>
                <p class="tw:mt-2 tw:text-sm tw:text-gray-600 tw:dark:text-gray-300">No pudimos verificar tu registro estudiantil. Consulta con Servicios Escolares.</p>
            </section>
        @endif
    </div>
@endsection
