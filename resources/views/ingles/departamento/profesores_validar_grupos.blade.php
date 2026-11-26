@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Validar grupos')
@section('content')
    <main class="tw-modulo tw:mx-auto tw:max-w-5xl tw:min-w-0 tw:space-y-4 tw:rounded-2xl tw:bg-gray-50 tw:p-4 tw:sm:p-6 tw:dark:bg-gray-900">
        <header>
            <h1 class="tw:m-0 tw:text-xl tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Desactivación de grupos</h1>
        </header>

        <div class="tesvb-tabla-scroll">
            <x-panel.tabla id="paginar_table" class="table table-bordered tw:mb-0" desplazable="Desactivación de grupos" aria-label="Desactivación de grupos">
                <thead>
                    <tr>
                        <th scope="col">Nombre del facilitador</th>
                        <th scope="col">Mostrar grupos</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($profesores as $profesor)
                        <tr>
                            <td>{{ $profesor->apellido_paterno . ' ' . $profesor->apellido_materno . ' ' . $profesor->nombre }}</td>
                            <td>
                                <x-panel.boton variante="secundario" href="/ingles/profesores/desactivar_grupos_profesor/{{ $profesor->id_profesores }}"
                                    aria-label="Ver grupos de {{ $profesor->apellido_paterno . ' ' . $profesor->apellido_materno . ' ' . $profesor->nombre }}">
                                    <span class="glyphicon glyphicon-list-alt em6" aria-hidden="true"></span>
                                    Ver grupos
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
