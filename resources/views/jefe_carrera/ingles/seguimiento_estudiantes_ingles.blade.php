@extends('layouts.app')
@section('title', 'Seguimiento de Ingles')
@section('content')

    <main class="container" style="margin-top:20px;">

        {{-- ===== TÍTULO ===== --}}
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info text-center" style="font-size:16px;">
                    <strong>SEGUIMIENTO DE ESTUDIANTES CURSANDO INGLÉS</strong>
                    <i class="fa fa-archive"></i>
                </div>
            </div>
        </div>

        <div class="row">

            {{-- ===== MENÚ DE SEMESTRES ===== --}}
            <div class="col-md-3">
                <div class="panel panel-info">
                    <div class="panel-heading text-center">
                        <strong>SEMESTRES</strong>
                    </div>

                    <ul class="list-group" style="margin-bottom:0;">
                        @foreach($semestres as $semestre)
                            <li class="list-group-item semestre-item">
                                <i class="fa fa-users text-warning"></i>
                                {{ $semestre->descripcion }}

                                <a href="#"
                                   class="btn btn-xs btn-primary btn-ver-alumnos pull-right"
                                   data-semestre="{{ $semestre->id_semestre }}">
                                    Ver alumnos
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- ===== CONTENIDO DERECHO ===== --}}
            <div class="col-md-9">

                {{-- Mensaje inicial --}}
                <div id="mensajeInicial" class="panel panel-default">
                    <div class="panel-body text-center text-muted" style="padding:80px 20px;">
                        <i class="fa fa-info-circle fa-3x"></i>
                        <br><br>
                        <strong>Seleccione un semestre para mostrar los alumnos</strong>
                    </div>
                </div>

                {{-- Tabla de alumnos (oculta) --}}
                <div id="panelAlumnos" class="panel panel-default" style="display:none;">
                    <div class="panel panel-info">
                        <div class="panel-heading text-center">
                            <strong>ALUMNOS DEL SEMESTRE</strong>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="tabla-estudiantes" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr class="info">
                                    <th class="text-center">No. Cuenta</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Nivel</th>
                                    <th class="text-center">Grupo</th>
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
                                `<div class="text-center">${a.cuenta}</div>`,
                                `${a.nombre} ${a.apaterno} ${a.amaterno}`,
                                `<div class="text-center">${a.nivel ?? '-'}</div>`,
                                `<div class="text-center">${a.id_grupo ?? '-'}</div>`
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

@endsection