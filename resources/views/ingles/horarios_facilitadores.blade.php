@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Facilitadores de ingles')
@section('content')
    <main class="tw-modulo tw:mx-auto tw:max-w-5xl tw:min-w-0 tw:space-y-4 tw:rounded-2xl tw:bg-gray-50 tw:p-4 tw:sm:p-6 tw:dark:bg-gray-900">
        <header>
            <h1 class="tw:m-0 tw:text-xl tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Horarios de facilitadores</h1>
            <p class="tw:m-0 tw:mt-1 tw:text-gray-600 tw:dark:text-gray-400">{{ $periodo->periodo_ingles }}</p>
        </header>

        <div class="tesvb-tabla-scroll">
            <x-panel.tabla id="paginar_table" class="table table-bordered tw:mb-0" desplazable="Horarios de facilitadores" aria-label="Horarios de facilitadores">
                <thead>
                    <tr>
                        <th scope="col">Nombre del facilitador</th>
                        <th scope="col">Mostrar horario</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($profesores as $profesor)
                        <tr>
                            <td>{{ $profesor->nombre . ' ' . $profesor->apellido_paterno . ' ' . $profesor->apellido_materno }}</td>
                            <td>
                                <x-panel.boton variante="secundario" href="/ingles/mostrar_horario_profesor/{{ $profesor->id_profesores }}"
                                    aria-label="Ver horario de {{ $profesor->nombre . ' ' . $profesor->apellido_paterno . ' ' . $profesor->apellido_materno }}">
                                    <span class="glyphicon glyphicon-list-alt em6" aria-hidden="true"></span>
                                    Ver horario
                                </x-panel.boton>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">No hay facilitadores para mostrar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </x-panel.tabla>
        </div>
    </main>
@endsection
