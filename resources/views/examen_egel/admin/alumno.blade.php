@extends('layouts.panel')
@section('title', 'Lista de Alumnos EGEL')
@include('partials.panel.recursos_app')
@section('content')

<main class="tw-pantalla">
    <x-panel.encabezado titulo="Lista de Alumnos - Licenciatura en Turismo e Ingeniería en Forestal" :migas="['Examen EGEL' => route('admin.dashboard')]">
        <x-slot:extra>
            <x-panel.boton variante="secundario" tamano="sm" href="{{ route('admin.dashboard') }}">
                <span class="fa fa-arrow-left" aria-hidden="true"></span> Regresar
            </x-panel.boton>
        </x-slot:extra>
    </x-panel.encabezado>

    <div class="tw:grid tw:gap-6 tw:2xl:grid-cols-2">

        <!-- SIN EXAMEN -->
        <x-panel.tarjeta sin-relleno>
            <div class="tw:flex tw:items-center tw:justify-between tw:gap-3 tw:px-5 tw:py-4 tw:sm:px-6">
                <h3 class="tw:flex tw:items-center tw:gap-2 tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">
                    <span class="fa fa-clock-o tw:text-amber-500" aria-hidden="true"></span>
                    Alumnos sin Examen EGEL
                </h3>
                <x-panel.badge tono="gris">{{ $alumnos_sin_examen->total() }}</x-panel.badge>
            </div>

            <x-panel.tabla compacta class="tw:text-[13px]">
                <thead>
                    <tr>
                        <th class="tw:text-center">Nombre</th>
                        <th class="tw:text-center">No. Control</th>
                        <th class="tw:text-center">Correo</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($alumnos_sin_examen as $alumno)
                    <tr>
                        <td>{{ $alumno->nombre }} {{ $alumno->apaterno }} {{ $alumno->amaterno }}</td>
                        <td><x-panel.badge tono="gris">{{ $alumno->cuenta }}</x-panel.badge></td>
                        <td class="tw:max-w-[150px] tw:truncate" title="{{ $alumno->correo_al ?? '' }}">
                            {{ $alumno->correo_al ?? '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="tw:text-center tw:text-gray-500">
                            Sin registros
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </x-panel.tabla>

            <div class="tw:px-5 tw:py-4">
                {!! $alumnos_sin_examen->appends(request()->query())->links('pagination::panel') !!}
            </div>
        </x-panel.tarjeta>

        <!-- CON EXAMEN -->
        <x-panel.tarjeta sin-relleno>
            <div class="tw:flex tw:items-center tw:justify-between tw:gap-3 tw:px-5 tw:py-4 tw:sm:px-6">
                <h3 class="tw:flex tw:items-center tw:gap-2 tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">
                    <span class="fa fa-check tw:text-green-500" aria-hidden="true"></span>
                    Alumnos con Examen EGEL
                </h3>
                <x-panel.badge tono="gris">{{ $alumnos_con_examen->total() }}</x-panel.badge>
            </div>

            <x-panel.tabla compacta class="tw:text-[13px]">
                <thead>
                    <tr>
                        <th class="tw:text-center">Nombre</th>
                        <th class="tw:text-center">No. Control</th>
                        <th class="tw:text-center">Correo</th>
                        <th class="tw:text-center">Calificación</th>
                        <th class="tw:text-center">Nivel</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($alumnos_con_examen as $alumno)
                    <tr>
                        <td>{{ $alumno->nombre }} {{ $alumno->apaterno }} {{ $alumno->amaterno }}</td>

                        <td>
                            <x-panel.badge>{{ $alumno->cuenta }}</x-panel.badge>
                        </td>

                        <td class="tw:max-w-[150px] tw:truncate" title="{{ $alumno->correo_al ?? '' }}">
                            {{ $alumno->correo_al ?? '-' }}
                        </td>

                        <td class="tw:text-center">
                            <strong>{{ $alumno->calificacion_general }}</strong>
                        </td>

                        <td class="tw:text-center">
                            @if($alumno->nivel == 'Sobresaliente')
                                <x-panel.badge tono="exito">{{ $alumno->nivel }}</x-panel.badge>
                            @elseif($alumno->nivel == 'Satisfactorio')
                                <x-panel.badge tono="advertencia">{{ $alumno->nivel }}</x-panel.badge>
                            @else
                                <x-panel.badge tono="error">{{ $alumno->nivel }}</x-panel.badge>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="tw:text-center tw:text-gray-500">
                            Sin registros
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </x-panel.tabla>

            <div class="tw:px-5 tw:py-4">
                {!! $alumnos_con_examen->appends(request()->query())->links('pagination::panel') !!}
            </div>
        </x-panel.tarjeta>

    </div>
</main>

@endsection
