@extends('layouts.panel')
@section('title', 'Inicio')
@section('sin_pie', '1')

@push('cabeza')
    @include('panel.dashboard.estudiante.estilos')
@endpush

@section('content')
    <div data-panel-estudiante style="--td-accent: var(--tema-visual-color, #153653)">
        <div class="td-backdrop" aria-hidden="true">
            <svg focusable="false" viewBox="0 0 1100 680" preserveAspectRatio="none">
                <path fill="currentColor" opacity=".04" d="M0 150c192-120 354 110 556 55C776 145 843 26 1100 60v264C876 205 744 390 515 377 294 364 213 198 0 300Z"/>
                <path fill="currentColor" opacity=".035" d="M0 485c248-154 364 41 605 27 217-12 309-145 495-128v296H0Z"/>
            </svg>
        </div>
        @if($estudiante)
            @include('panel.dashboard.estudiante.bienvenida')
            @include('panel.dashboard.estudiante.accesos')
            @include('panel.dashboard.estudiante.progreso')
            @include('panel.dashboard.estudiante.novedades')
        @else
            <section class="tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-6 tw:dark:border-gray-800 tw:dark:bg-gray-800">
                <h1 class="tw:text-xl tw:font-semibold tw:text-gray-900 tw:dark:text-white">Inicio estudiantil</h1>
                <p class="tw:mt-2 tw:text-sm tw:text-gray-600 tw:dark:text-gray-300">No pudimos verificar tu registro estudiantil. Consulta con Servicios Escolares.</p>
            </section>
        @endif
    </div>
@endsection
