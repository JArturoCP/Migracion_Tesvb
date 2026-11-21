@extends('layouts.panel')
@section('title', 'Resultados EGEL')
@include('partials.panel.recursos_app')
@section('content')

<main class="tw-pantalla">
    <x-panel.encabezado titulo="Resultados EGEL" :migas="['Examen EGEL' => route('admin.dashboard')]">
        <x-slot:extra>
            <x-panel.boton variante="secundario" tamano="sm" href="{{ route('admin.dashboard') }}">
                <span class="fa fa-arrow-left" aria-hidden="true"></span>
                Regresar
            </x-panel.boton>
        </x-slot:extra>
    </x-panel.encabezado>

    <div class="tw:grid tw:gap-6 tw:xl:grid-cols-2">

        @foreach([
            ['titulo' => 'Turismo', 'carrera' => 'turismo', 'id_carrera' => '8'],
            ['titulo' => 'Forestal', 'carrera' => 'forestal', 'id_carrera' => '6'],
        ] as $col)
        <x-panel.tarjeta titulo="{{ $col['titulo'] }}" sin-relleno>
            <x-slot:acciones>
                <x-panel.boton variante="contorno-peligro" tamano="sm" href="{{ route('admin.egel.pdf', ['carrera' => $col['carrera']]) }}">
                    <span class="fa fa-download" aria-hidden="true"></span>
                    PDF
                </x-panel.boton>
            </x-slot:acciones>

            <x-panel.tabla class="tw:text-center">

                <thead>
                    <tr>
                        <th class="tw:text-center">No Control</th>
                        <th class="tw:text-center">Alumno</th>
                        <th class="tw:text-center">Calificación</th>
                        <th class="tw:text-center">Nivel</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($alumnos->where('id_carrera', $col['id_carrera']) as $a)
                    <tr>
                        <td><strong>{{ $a->cuenta }}</strong></td>
                        <td>{{ $a->nombre }} {{ $a->apaterno }} {{ $a->amaterno }}</td>
                        <td>
                            <x-panel.badge>{{ $a->calificacion_general }}%</x-panel.badge>
                        </td>
                        <td>
                            @if($a->nivel == 'Sobresaliente')
                                <x-panel.badge tono="exito">Sobresaliente</x-panel.badge>
                            @elseif($a->nivel == 'Satisfactorio')
                                <x-panel.badge tono="info">Satisfactorio</x-panel.badge>
                            @else
                                <x-panel.badge tono="gris">{{ $a->nivel }}</x-panel.badge>
                            @endif
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
