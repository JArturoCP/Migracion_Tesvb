@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Constancias de Ingles')

@section('content')
    <main class="tw-modulo tw:mx-auto tw:max-w-5xl tw:min-w-0 tw:space-y-4 tw:rounded-2xl tw:bg-gray-50 tw:p-4 tw:sm:p-6 tw:dark:bg-gray-900">
        <header>
            <h1 class="tw:m-0 tw:text-xl tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Constancias de inglés</h1>
            <p class="tw:mt-1 tw:text-gray-600 tw:dark:text-gray-400">{{ $carrera->nombre }}</p>
        </header>

        <x-panel.tarjeta :sin-relleno="true">
            <x-panel.tabla id="mostrar_calificaciones" class="table tw:mb-0" aria-label="Constancias de inglés">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" class="text-center">No. CTA</th>
                            <th scope="col" class="text-center">ALUMNO</th>
                            <th scope="col" class="text-center">Constancia</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($array_alumnos as $alumno)
                            <tr class="align-middle">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $alumno['cuenta'] }}</td>
                                <td>{{ $alumno['nombre'] }}</td>
                                <td class="text-center">

                                    {{-- TODOS ya son nivel 10 --}}
                                    <a href="{{ route('ingles.constancia', $alumno['id_alumno']) }}"
                                       target="_blank" rel="noopener"
                                       class="btn btn-danger btn-sm shadow-sm">
                                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Ver Constancia
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </x-panel.tabla>
        </x-panel.tarjeta>
    </main>

    <style>

        .dark #mostrar_calificaciones tbody tr {
            background-color: transparent;
        }

        .dark #mostrar_calificaciones_paginate a.paginate_button {
            background: transparent;
            color: var(--tw-color-gray-300) !important;
            border-color: var(--tw-color-gray-700);
        }

        .dark #mostrar_calificaciones_paginate a.paginate_button.current,
        .dark #mostrar_calificaciones_paginate a.paginate_button:not(.disabled):hover {
            background: var(--tw-color-brand-500);
            color: #fff !important;
        }

        .dark #mostrar_calificaciones_paginate a.paginate_button.disabled {
            color: var(--tw-color-gray-400) !important;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#mostrar_calificaciones').DataTable({
                language: {
                    search: "Buscar:",
                    lengthMenu: "Mostrar _MENU_ registros",
                    zeroRecords: "No se encontraron resultados",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ alumnos",
                    paginate: {
                        next: "Siguiente",
                        previous: "Anterior"
                    }
                }
            });
            $('#mostrar_calificaciones').closest('.tesvb-dt-scroll').attr({
                tabindex: 0,
                role: 'region',
                'aria-label': 'Tabla de constancias'
            });
        });
    </script>
@endsection
