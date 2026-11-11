@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Constancias de Ingles')

@section('content')

    <main class="mt-4">
        <div class="container">

            {{-- TÍTULO --}}
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center">
                                Generar Constancias de Inglés <br>
                                de la carrera: {{ $carrera->nombre }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TABLA --}}
            <div class="card shadow-lg">
                <div class="card-body">

                    <table class="table table-striped table-hover" id="mostrar_calificaciones">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">No. CTA</th>
                            <th class="text-center">ALUMNO</th>
                            <th class="text-center">Constancia</th>
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
                                       target="_blank"
                                       class="btn btn-danger btn-sm shadow-sm">
                                        <i class="fa fa-file-pdf-o"></i> Ver Constancia
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </main>

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
        });
    </script>

@endsection