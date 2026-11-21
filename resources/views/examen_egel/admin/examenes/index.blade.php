@extends('layouts.panel')
@section('title', 'Exámenes EGEL')
@include('partials.panel.recursos_app')
@section('content')

<main class="tw-pantalla">
    <x-panel.encabezado titulo="Exámenes EGEL" :migas="['Examen EGEL' => route('admin.dashboard')]" />

    <x-panel.tarjeta titulo="Listado de exámenes" sin-relleno>
        <x-slot:acciones>
            <x-panel.boton variante="secundario" href="{{ route('admin.dashboard') }}">
                <span class="fa fa-arrow-left" aria-hidden="true"></span> Regresar
            </x-panel.boton>
            <x-panel.boton href="{{ route('admin.examen.create') }}">
                <span class="fa fa-plus" aria-hidden="true"></span> Nuevo Examen
            </x-panel.boton>
        </x-slot:acciones>

        <x-panel.tabla class="tw:text-center">

            <thead>
                <tr>
                    <th class="tw:text-center">No.</th>
                    <th class="tw:text-center">Carrera</th>
                    <th class="tw:text-center">Nombre</th>
                    <th class="tw:w-[220px] tw:text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($examenes as $e)
                <tr>
                    <td><strong>{{ $e->id_examen_egel }}</strong></td>

                    <td>
                        <x-panel.badge tono="info">{{ $e->carrera }}</x-panel.badge>
                    </td>

                    <td>{{ $e->nombre }}</td>

                    <td>
                        <div class="tw:inline-flex tw:gap-1">
                            <a href="{{ route('admin.examen.edit',$e->id_examen_egel) }}"
                               class="tw:inline-flex tw:size-8 tw:items-center tw:justify-center tw:rounded-lg tw:text-amber-500 tw:hover:bg-amber-50 tw:dark:hover:bg-amber-500/15" title="Editar examen" aria-label="Editar examen">
                                <span class="fa fa-pencil" aria-hidden="true"></span>
                            </a>

                            <a href="{{ route('admin.examen.delete',$e->id_examen_egel) }}"
                               class="tw:inline-flex tw:size-8 tw:items-center tw:justify-center tw:rounded-lg tw:text-red-500 tw:hover:bg-red-50 tw:dark:hover:bg-red-500/15" title="Eliminar examen" aria-label="Eliminar examen"
                               onclick="return TNotify.confirmAction(event, this, '¿Seguro que deseas eliminar este examen?')">
                                <span class="fa fa-trash" aria-hidden="true"></span>
                            </a>

                            <a href="{{ route('admin.examen.rapido', $e->id_examen_egel) }}"
                               class="tw:inline-flex tw:size-8 tw:items-center tw:justify-center tw:rounded-lg tw:text-green-600 tw:hover:bg-green-50 tw:dark:hover:bg-green-500/15" title="Carga rápida" aria-label="Carga rápida">
                                <span class="fa fa-bolt" aria-hidden="true"></span>
                            </a>

                            <a href="{{ route('admin.examen.preguntas', $e->id_examen_egel) }}"
                               class="tw:inline-flex tw:size-8 tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:hover:bg-brand-50 tw:dark:hover:bg-brand-500/15" title="Ver preguntas" aria-label="Ver preguntas">
                                <span class="fa fa-list-alt" aria-hidden="true"></span>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </x-panel.tabla>
    </x-panel.tarjeta>
</main>

@if(($ver ?? null) === 'create')
    @include('examen_egel.admin.examenes.create')
@endif
@if(($ver ?? null) === 'edit')
    @include('examen_egel.admin.examenes.edit')
@endif

@include('partials.panel.validacion_envio')
@endsection
