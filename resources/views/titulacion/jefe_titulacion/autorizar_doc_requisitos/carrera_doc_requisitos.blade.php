@extends('layouts.panel')
@section('title', 'Documentación de requisitos de titulación')

@section('content')
    <x-panel.encabezado titulo="Documentación de requisitos de titulación" />

    <x-panel.tarjeta titulo="Selecciona un programa de estudio">
        @if (count($carreras))
            <ul class="tw:grid tw:gap-3 tw:sm:grid-cols-2">
                @foreach ($carreras as $carrera)
                    <li>
                        <x-panel.boton :href="url('/titulacion/autorizar_alumnos_doc_requisitos/'.$carrera->id_carrera)"
                            variante="secundario" class="tw:h-full tw:w-full tw:justify-start tw:text-left">
                            {{ $carrera->nombre }}
                        </x-panel.boton>
                    </li>
                @endforeach
            </ul>
        @else
            <x-panel.vacio titulo="Sin programas de estudio" />
        @endif
    </x-panel.tarjeta>
@endsection
