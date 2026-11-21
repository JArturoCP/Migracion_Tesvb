@extends('layouts.panel')
@section('title', 'Periodos EGEL')
@include('partials.panel.recursos_app')
@section('content')

<main class="tw-pantalla tw:space-y-6">
    <x-panel.encabezado titulo="Configuración de Periodos EGEL" :migas="['Examen EGEL' => route('admin.dashboard')]">
        <x-slot:extra>
            <x-panel.boton variante="secundario" tamano="sm" href="{{ route('admin.dashboard') }}">
                <span class="fa fa-arrow-left" aria-hidden="true"></span> Regresar
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

    <!-- FORMULARIO -->
    <x-panel.tarjeta titulo="Definir nuevo periodo">
        <form action="{{ route('admin.periodos.guardar') }}" method="POST" class="tw:space-y-5">
            @csrf
            <x-panel.input etiqueta="Nombre del periodo" type="text" name="periodo" id="periodo" required />

            <div class="tw:grid tw:gap-5 tw:md:grid-cols-2">

                <fieldset class="tw:rounded-xl tw:border tw:border-gray-200 tw:p-4 tw:dark:border-gray-800">
                    <legend class="tw:flex tw:items-center tw:gap-2 tw:px-1 tw:text-sm tw:font-medium tw:text-brand-500">
                        <span class="fa fa-pencil-square-o" aria-hidden="true"></span> Periodo de Aplicación
                    </legend>
                    <div class="tw:grid tw:gap-4 tw:sm:grid-cols-2">
                        <x-panel.input etiqueta="Inicio" type="date" name="periodo_examen_inicio" id="periodo_examen_inicio" required />
                        <x-panel.input etiqueta="Fin" type="date" name="periodo_examen_fin" id="periodo_examen_fin" required />
                    </div>
                </fieldset>

                <fieldset class="tw:rounded-xl tw:border tw:border-gray-200 tw:p-4 tw:dark:border-gray-800">
                    <legend class="tw:flex tw:items-center tw:gap-2 tw:px-1 tw:text-sm tw:font-medium tw:text-green-600">
                        <span class="fa fa-bullhorn" aria-hidden="true"></span> Publicación de Resultados
                    </legend>
                    <div class="tw:grid tw:gap-4 tw:sm:grid-cols-2">
                        <x-panel.input etiqueta="Inicio" type="date" name="periodo_resultado_inicio" id="periodo_resultado_inicio" required />
                        <x-panel.input etiqueta="Fin" type="date" name="periodo_resultado_fin" id="periodo_resultado_fin" required />
                    </div>
                </fieldset>

            </div>

            <div class="tw:flex tw:justify-end tw:border-t tw:border-gray-100 tw:pt-5 tw:dark:border-gray-800">
                <x-panel.boton type="submit">
                    <span class="fa fa-floppy-o" aria-hidden="true"></span> Guardar
                </x-panel.boton>
            </div>
        </form>
    </x-panel.tarjeta>

    <!-- HISTORIAL -->
    <div class="tw:grid tw:gap-6 tw:xl:grid-cols-2">

        @foreach([
            ['titulo' => 'Historial - Periodos de Aplicación', 'periodos' => $periodosExamen],
            ['titulo' => 'Historial - Resultados', 'periodos' => $periodosResultados],
        ] as $historial)
        <x-panel.tarjeta titulo="{{ $historial['titulo'] }}" sin-relleno>
            <x-panel.tabla class="tw:text-center">
                <thead>
                    <tr>
                        <th class="tw:text-center">Periodo</th>
                        <th class="tw:text-center">Inicio</th>
                        <th class="tw:text-center">Fin</th>
                        <th class="tw:text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($historial['periodos'] as $p)
                        <tr>
                            <td>{{ $p->periodo }}</td>
                            <td>{{ $p->fecha_inicio }}</td>
                            <td>{{ $p->fecha_fin }}</td>
                            <td>
                                <div class="tw:flex tw:justify-center tw:gap-1">
                                    <a href="{{ route('admin.periodos.edit', $p->id_periodo_examen) }}"
                                       class="tw:inline-flex tw:size-8 tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:hover:bg-brand-50 tw:dark:hover:bg-brand-500/15" title="Editar" aria-label="Editar periodo">
                                        <span class="fa fa-pencil-square-o" aria-hidden="true"></span>
                                    </a>

                                    <form action="{{ route('admin.periodos.destroy', $p->id_periodo_examen) }}"
                                          method="POST" class="tw:inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-red-500 tw:hover:bg-red-50 tw:dark:hover:bg-red-500/15" title="Eliminar" aria-label="Eliminar periodo"
                                                onclick="return TNotify.confirmAction(event, this, '¿Deseas eliminar este periodo?')">
                                            <span class="fa fa-trash" aria-hidden="true"></span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-panel.tabla>
        </x-panel.tarjeta>
        @endforeach

    </div>
</main>

@endsection
