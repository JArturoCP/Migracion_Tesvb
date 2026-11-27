@extends('layouts.panel')
@section('title', 'Historial de encuestas de Servicio Social')

@section('content')
    <div class="tw:mx-auto tw:max-w-3xl">
        <x-panel.encabezado titulo="Historial de encuestas de Servicio Social" />
        <x-panel.tarjeta titulo="Años disponibles">
            @if (count($year_historial))
                <ul class="tw:grid tw:gap-3 tw:sm:grid-cols-3">
                    @foreach ($year_historial as $year)
                        <li>
                            <x-panel.boton :href="url('/encuestas_satisfaccion/menu_historial_servicio_s_year/'.$year->year)"
                                variante="contorno-primario" class="tw:w-full">{{ $year->year }}</x-panel.boton>
                        </li>
                    @endforeach
                </ul>
            @else
                <x-panel.vacio titulo="Sin periodos en el historial" />
            @endif
        </x-panel.tarjeta>
    </div>
@endsection
