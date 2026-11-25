@extends('layouts.panel')
@section('title', 'Envío de documentación')

@section('content')
    <x-panel.encabezado titulo="ENVÍO DE DOCUMENTACIÓN" :migas="['Procedimiento Ambiental' => '#procedimientos']" />

    <div class="tw:space-y-6">
        <x-panel.tarjeta titulo="Periodo ambiental activo">
            <p class="tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-white/90">
                {{ $periodo[0]->nombre_periodo_amb }}
            </p>
        </x-panel.tarjeta>

        <x-panel.tarjeta id="procedimientos" titulo="Procedimientos asignados">
            @if ($procedimientos->isEmpty())
                <x-panel.vacio titulo="Sin procedimientos asignados" />
            @else
                <ul class="tw:grid tw:gap-4 tw:sm:grid-cols-2 tw:xl:grid-cols-3">
                    @foreach ($procedimientos as $procedimiento)
                        <li class="tw:min-w-0">
                            <x-panel.boton
                                variante="secundario"
                                :href="url('/ambiental/ver_estado_documentacion/'.$procedimiento->id_encargado)"
                                class="tw:h-full tw:w-full tw:text-center tw:wrap-break-word"
                            >
                                {{ $procedimiento->nom_procedimiento }}
                            </x-panel.boton>
                        </li>
                    @endforeach
                </ul>
            @endif
        </x-panel.tarjeta>
    </div>
@endsection
