@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Grupos de ingles')
@section('content')
    <main class="tw-modulo tw:mx-auto tw:max-w-5xl tw:min-w-0 tw:space-y-4 tw:rounded-2xl tw:bg-gray-50 tw:p-4 tw:sm:p-6 tw:dark:bg-gray-900">
        <h1 class="tw:m-0 tw:text-xl tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Grupos de inglés</h1>

        <div class="tesvb-tabla-scroll">
            <x-panel.tabla id="table_enviado" class="table tw:mb-0" desplazable="Grupos de inglés" aria-label="Grupos de inglés">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Grupo</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($grupos as $grupo)
                        <tr>
                            <td>{{ $grupo->id_grupo_ingles }}</td>
                            <td>{{ $grupo->descripcion }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">No hay grupos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </x-panel.tabla>
        </div>
    </main>
@endsection
