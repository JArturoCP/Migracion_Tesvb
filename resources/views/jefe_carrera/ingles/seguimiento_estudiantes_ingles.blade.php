@extends('layouts.panel')
@section('title', 'Seguimiento de Ingles')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

    <main class="tw:w-full" style="margin-top:20px;">

        {{-- ===== TÍTULO ===== --}}
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-full tw:px-2">
                <x-panel.alerta tipo="info" class="tw:mb-4">
                    <strong>SEGUIMIENTO DE ESTUDIANTES CURSANDO INGLÉS</strong>
                    <i class="fa fa-archive"></i>
                </x-panel.alerta>
            </div>
        </div>

        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

            {{-- ===== MENÚ DE SEMESTRES ===== --}}
            <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4 tw:text-center">
                        <strong>SEMESTRES</strong>
                    </div>

                    <ul class="tw:divide-y tw:divide-gray-100 tw:rounded-lg tw:border tw:border-gray-200" style="margin-bottom:0;">
                        @foreach($semestres as $semestre)
                            <li class="semestre-item tw:block tw:px-4 tw:py-3">
                                <i class="fa fa-users tw:text-amber-600"></i>
                                {{ $semestre->descripcion }}

                                <a href="#"
                                   class="btn-ver-alumnos tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:gap-1 tw:px-2 tw:py-1 tw:text-xs tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:float-right"
                                   data-semestre="{{ $semestre->id_semestre }}">
                                    Ver alumnos
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- ===== CONTENIDO DERECHO ===== --}}
            <div class="tw:w-full tw:lg:w-9/12 tw:px-2">

                {{-- Mensaje inicial --}}
                <div id="mensajeInicial" class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                    <div class="tw:p-5 tw:sm:p-6 tw:text-center tw:text-gray-500">
                        <i class="fa fa-info-circle fa-3x"></i>
                        <br><br>
                        <strong>Seleccione un semestre para mostrar los alumnos</strong>
                    </div>
                </div>

                {{-- Tabla de alumnos (oculta) --}}
                <div id="panelAlumnos" class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white" style="display:none;">
                    <x-panel.encabezado titulo="ALUMNOS DEL SEMESTRE" />

                    <div class="tw:p-5 tw:sm:p-6">
                        <div class="tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200">
                            <table id="tabla-estudiantes" class="tw-tabla tw-tabla-bordes tw-tabla-rayas">
                                <thead>
                                <tr class="tw:bg-sky-50">
                                    <th class="tw:text-center">No. Cuenta</th>
                                    <th class="tw:text-center">Nombre</th>
                                    <th class="tw:text-center">Nivel</th>
                                    <th class="tw:text-center">Grupo</th>
                                </tr>
                                </thead>
                                <tbody id="tablaAlumnos">
                                {{-- Se llena por JS --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    {{-- ===== ESTILOS ===== --}}
    <style>
        .semestre-item {
            padding: 12px;
            transition: background 0.3s;
        }

        .semestre-item:hover {
            background: #f5f5f5;
        }
    </style>

    <script>
        let tablaEstudiantes;
        const alumnos = @json($alumnos);

        $(document).ready(function () {
            tablaEstudiantes = $('#tabla-estudiantes').DataTable({
                pageLength: 10,
                lengthChange: false,
                ordering: true,
                searching: true,
                language: {
                    search: "Buscar:",
                    paginate: {
                        previous: "Anterior",
                        next: "Siguiente"
                    },
                    emptyTable: "No hay alumnos para mostrar",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ alumnos",
                    infoEmpty: "Mostrando 0 alumnos"
                }
            });

            document.querySelectorAll('.btn-ver-alumnos').forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();

                    const idSemestre = this.dataset.semestre;
                    tablaEstudiantes.clear();

                    const alumnosFiltrados = alumnos.filter(
                        a => a.id_semestre == idSemestre
                    );

                    if (alumnosFiltrados.length === 0) {
                        tablaEstudiantes.draw();
                    } else {
                        alumnosFiltrados.forEach(a => {
                            tablaEstudiantes.row.add([
                                `<div class="tw:text-center">${a.cuenta}</div>`,
                                `${a.nombre} ${a.apaterno} ${a.amaterno}`,
                                `<div class="tw:text-center">${a.nivel ?? '-'}</div>`,
                                `<div class="tw:text-center">${a.id_grupo ?? '-'}</div>`
                            ]);
                        });

                        tablaEstudiantes.draw();
                    }

                    document.getElementById('mensajeInicial').style.display = 'none';
                    document.getElementById('panelAlumnos').style.display = 'block';
                });
            });

        });
    </script>

</div>
@endsection