@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Niveles de inglés')
@section('content')
    <main class="tw-modulo tw:mx-auto tw:max-w-5xl tw:min-w-0 tw:space-y-4 tw:rounded-2xl tw:bg-gray-50 tw:p-4 tw:sm:p-6 tw:dark:bg-gray-900">
        <h1 class="tw:m-0 tw:text-xl tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Niveles de inglés</h1>

        <div class="tesvb-tabla-scroll">
            <x-panel.tabla id="table_enviado" class="table tw:mb-0" desplazable="Niveles de inglés" aria-label="Niveles de inglés">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nivel</th>
                        <th scope="col">Clave</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($niveles as $nivel)
                        <tr>
                            <td>{{ $nivel->id_niveles_ingles }}</td>
                            <td>{{ $nivel->descripcion }}</td>
                            <td>{{ $nivel->clave }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No hay niveles registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </x-panel.tabla>
        </div>
    </main>
@endsection
