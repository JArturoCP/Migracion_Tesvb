@extends('layouts.panel')
@section('title', 'Editar Periodo EGEL')
@include('partials.panel.recursos_app')
@section('content')

<main class="tw-pantalla tw:space-y-6">
    <x-panel.encabezado titulo="Editar Periodo EGEL" :migas="['Examen EGEL' => route('admin.dashboard'), 'Periodos' => route('admin.periodos.index')]">
        <x-slot:extra>
            <x-panel.boton variante="secundario" tamano="sm" href="{{ route('admin.periodos.index') }}">
                <span class="fa fa-arrow-left" aria-hidden="true"></span>
                Regresar
            </x-panel.boton>
        </x-slot:extra>
    </x-panel.encabezado>

    <!-- Mensajes -->
    @if(session('success'))
        <x-panel.alerta tipo="exito">{{ session('success') }}</x-panel.alerta>
    @endif

    @if($errors->any())
        <x-panel.alerta tipo="error">
            <ul class="tw:list-disc tw:pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-panel.alerta>
    @endif

    <!-- PANEL -->
    <x-panel.tarjeta titulo="Actualizar periodo">

        <form action="{{ route('admin.periodos.update', $periodoExamen->id_periodo_examen) }}" method="POST" class="tw:space-y-5">
            @csrf
            @method('PUT')

            <x-panel.input etiqueta="Nombre del periodo" type="text" name="periodo" id="periodo"
                value="{{ $periodoExamen->periodo }}" required />

            <div class="tw:grid tw:gap-5 tw:md:grid-cols-2">

                <!-- Aplicación -->
                <fieldset class="tw:rounded-xl tw:border tw:border-gray-200 tw:p-4 tw:dark:border-gray-800">
                    <legend class="tw:flex tw:items-center tw:gap-2 tw:px-1 tw:text-sm tw:font-medium tw:text-brand-500">
                        <span class="fa fa-pencil-square-o" aria-hidden="true"></span> Periodo de Aplicación
                    </legend>
                    <div class="tw:grid tw:gap-4 tw:sm:grid-cols-2">
                        <x-panel.input etiqueta="Inicio" type="date" name="periodo_examen_inicio" id="periodo_examen_inicio"
                            value="{{ \Carbon\Carbon::parse($periodoExamen->fecha_inicio)->format('Y-m-d') }}" required />
                        <x-panel.input etiqueta="Fin" type="date" name="periodo_examen_fin" id="periodo_examen_fin"
                            value="{{ \Carbon\Carbon::parse($periodoExamen->fecha_fin)->format('Y-m-d') }}" required />
                    </div>
                </fieldset>

                <!-- Resultados -->
                <fieldset class="tw:rounded-xl tw:border tw:border-gray-200 tw:p-4 tw:dark:border-gray-800">
                    <legend class="tw:flex tw:items-center tw:gap-2 tw:px-1 tw:text-sm tw:font-medium tw:text-green-600">
                        <span class="fa fa-bullhorn" aria-hidden="true"></span> Publicación de Resultados
                    </legend>
                    <div class="tw:grid tw:gap-4 tw:sm:grid-cols-2">
                        <x-panel.input etiqueta="Inicio" type="date" name="periodo_resultado_inicio" id="periodo_resultado_inicio"
                            value="{{ \Carbon\Carbon::parse($periodoResultado->fecha_inicio)->format('Y-m-d') }}" required />
                        <x-panel.input etiqueta="Fin" type="date" name="periodo_resultado_fin" id="periodo_resultado_fin"
                            value="{{ \Carbon\Carbon::parse($periodoResultado->fecha_fin)->format('Y-m-d') }}" required />
                    </div>
                </fieldset>

            </div>

            <!-- GUARDAR (el original anidaba el formulario de eliminar dentro de este; aquí van uno después del otro) -->
            <div class="tw:flex tw:justify-end tw:border-t tw:border-gray-100 tw:pt-5 tw:dark:border-gray-800">
                <x-panel.boton type="submit" title="Guardar" aria-label="Guardar periodo">
                    <span class="fa fa-floppy-o" aria-hidden="true"></span> Guardar
                </x-panel.boton>
            </div>
        </form>

        <!-- ELIMINAR -->
        <form action="{{ route('admin.periodos.destroy', $periodoExamen->id_periodo_examen) }}"
              method="POST"
              class="tw:-mt-11 tw:max-w-max"
              onsubmit="return TNotify.confirmAction(event, this, '¿Deseas eliminar este periodo?')">

            @csrf
            @method('DELETE')

            <x-panel.boton type="submit" variante="contorno-peligro" title="Eliminar" aria-label="Eliminar periodo">
                <span class="fa fa-trash" aria-hidden="true"></span> Eliminar
            </x-panel.boton>
        </form>

    </x-panel.tarjeta>
</main>

@endsection
