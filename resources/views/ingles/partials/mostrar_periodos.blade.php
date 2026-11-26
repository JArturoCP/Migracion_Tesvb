@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Periodos de ingles')
@section('content')
    <main class="tw-modulo tw:mx-auto tw:max-w-5xl tw:min-w-0 tw:space-y-4 tw:rounded-2xl tw:bg-gray-50 tw:p-4 tw:sm:p-6 tw:dark:bg-gray-900">
        <h1 class="tw:m-0 tw:text-xl tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Periodos de inglés</h1>

        <div class="tesvb-tabla-scroll">
            <x-panel.tabla id="table_enviado" class="table tw:mb-0" desplazable="Periodos de inglés" aria-label="Periodos de inglés">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Periodo</th>
                        <th scope="col">Fecha inicial</th>
                        <th scope="col">Fecha final</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($periodos as $periodo)
                        <tr>
                            <td>{{ $periodo->id_periodo_ingles }}</td>
                            <td>{{ $periodo->periodo_ingles }}</td>
                            <td>{{ $periodo->fecha_inicio_ingles }}</td>
                            <td>{{ $periodo->fecha_final_ingles }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4">No hay periodos registrados.</td></tr>
                    @endforelse
                </tbody>
            </x-panel.tabla>
        </div>
    </main>
@endsection
