@extends('layouts.app')
@section('title', 'Evaluacion Docente')
@section('content')

    <main>


        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">COMENTARIOS EVALUACIÓN DOCENTE</h3>
                </div>
            </div>
        </div>


        <div class=" col-md-8 col-md-offset-2">
            <table id="tab_comment" class="table table-bordered">
                <thead>
                <tr>
                    <th style="text-align: center">DOCENTES EVALUADOS</th>
                    <th style="text-align: center">CONSULTAR COMENTARIO</th>
                </tr>
                </thead>
                <tbody>
                @foreach($docentes as $docente)
                    <tr>
                        <th style="text-align: center">{{$docente->nombre}}</th>
                        <th class="text-center"><a href="/reporte_comentario_docente/{{$docente->id_personal}}" target="_blank"><span class="glyphicon glyphicon-list-alt em6" aria-hidden="true" ></span></a></th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </main>

    <script>
        $(document).ready(function() {
            $('#tab_comment').DataTable();
        });
    </script>
@endsection
