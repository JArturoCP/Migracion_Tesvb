@extends('layouts.app')
@section('title', 'Evaluacion Docente')
@section('content')

    <main>

        <div class="col-md-8 col-md-offset-1">
            <button class="btn btn-success" onclick="window.history.back();">
                <span class="glyphicon glyphicon-arrow-left"></span> Regresar
            </button>
        </div>


    @foreach($grupos_materias as $grupo_materia)
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center"><strong>EVALUACIÓN DOCENTE DE: {{ $grupo_materia->profesor }}</strong></h3>
                        <h3 class="panel-title text-center"><strong>SEMESTRE: {{ $grupo_materia->semestre }}</strong></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">GRUPO: {{$grupo_materia->id_semestre}}0{{$grupo_materia->id_grupo}}</h3>
                        <h3 class="panel-title text-center">MATERIA: {{$grupo_materia->materia}}</h3>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="container">
            <div>
                <table class="table table-bordered" id="tab_comment">
                    <thead>
                    <tr>
                        <th style="text-align: center">#</th>
                        <th style="text-align: center">Comentario por alumno</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($eva_comentarios as $eva_comentario)
                        <tr>
                            <th style="text-align: center">{{ $loop->iteration }}</th>
                            <th style="text-align: center">{{ $eva_comentario->comentario}}</th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#tab_comment').DataTable();
        });
    </script>

@endsection