@extends('layouts.app')
@section('title', 'Evaluacion Docente')
@section('content')

    <main>

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center"><strong>EVALUACIÓN DOCENTE DE: {{ $docentes[0]->nombre }}</strong></h3>
                    <h3 class="panel-title text-center"><strong>CARRERA PERTENECIENTE: {{$carreras[0]->carrera}}</strong></h3>
                </div>
            </div>
        </div>
        </br></br></br></br></br>

        <div class="row col-md-10 col-md-offset-1">
            <div class="panel-group" id="semes_box">
                @foreach($semestres as $semestre)
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#semestre_{{$semestre->id_semestre}}_materia_{{$loop->index}}">
                                    {{ $semestre->semestre }} - {{ $semestre->materia }}
                                </a>
                            </h4>
                        </div>

                        <div id="semestre_{{$semestre->id_semestre}}_materia_{{$loop->index}}" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="container col-md-12">
                                    <ul class="nav nav-tabs">
                                        <li><a data-toggle="tab" href="#materia{{$semestre->id_semestre }}">Grupos</a></li>
                                    </ul>
                                    </br></br></br>
                                    <div class="tab-content">
                                        <div id="materia{{$semestre->id_semestre}}">
                                            <table id="table_mate{{$semestre->id_semestre}}" class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th style="text-align: center">#</th>
                                                    <th style="text-align: center">Grupos a Cargo</th>
                                                    <th style="text-align: center">Ver Comentarios de la Evaluación Docente</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($datos_grupos as $grupo)
                                                    @if($grupo['id_semestre'] == $semestre->id_semestre && $grupo['id_materia'] == $semestre->id_materia)
                                                        <tr data-id-materia="{{ $grupo['id_materia'] }}" data-semestre="{{ $semestre->id_semestre }}">
                                                            <th style="text-align: center">{{ $loop->iteration }}</th>
                                                            <th style="text-align: center">{{ $grupo['id_semestre'] }}0{{$grupo['id_grupo']}}</th>
                                                            <th style="text-align: center">
                                                                <a href="#" class="ver-comentario"
                                                                   data-id-personal="{{ $grupo['id_personal'] }}"
                                                                   data-id-grupo="{{ $grupo['id_grupo'] }}"
                                                                   data-grupo="{{ $grupo['grupo'] }}"
                                                                   data-id-materia="{{ $grupo['id_materia'] }}"
                                                                   data-semestre="{{ $semestre->id_semestre }}">
                                                                    <span class="glyphicon glyphicon-new-window"></span>
                                                                </a>
                                                            </th>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table_mate1').DataTable();
            $('#table_mate2').DataTable();
            $('#table_mate3').DataTable();
            $('#table_mate4').DataTable();
            $('#table_mate5').DataTable();
            $('#table_mate6').DataTable();
            $('#table_mate7').DataTable();
            $('#table_mate8').DataTable();
            $('#table_mate9').DataTable();
            $('#table_mate10').DataTable();
            $('#table_mate11').DataTable();
            $('#table_mate12').DataTable();
            $('#table_mate13').DataTable();
            $('#table_mate14').DataTable();
            $('#table_mate15').DataTable();
        });

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".ver-comentario").forEach(link => {
                link.addEventListener("click", function(event) {
                    event.preventDefault(); // Evita la navegación predeterminada

                    let id_personal = this.getAttribute("data-id-personal");
                    let id_grupo = this.getAttribute("data-id-grupo");
                    let grupo = this.getAttribute("data-grupo");
                    let id_materia = this.getAttribute("data-id-materia"); // Tomamos directamente desde el enlace

                    if (!id_materia) {
                        alert("No se pudo encontrar el ID de la materia correspondiente.");
                        return;
                    }

                    // Construir la URL dinámica
                    let url = `/ver_comentario_docente/${id_personal}/${id_grupo}/${grupo}/${id_materia}`;

                    // Redireccionar a la nueva URL
                    window.location.href = url;
                });
            });
        });
    </script>

@endsection