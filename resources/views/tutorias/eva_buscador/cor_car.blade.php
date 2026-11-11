<head>
    <style>
        #lista-opciones {
            position: absolute;
            top: 32px;
            left: 0;
            right: 0;
            background-color: white;
            border: 1px solid #ccc;
            list-style: none;
            padding: 0;
            margin: 0;
            z-index: 1;
        }
    </style>
</head>
@extends('tutorias.app_tutorias')
@section('content')
    <div class="row">
        <div class="row">
            <div class="col-10 offset-1">
                <table class="table table-bordered table-responsive-lg">
                    <tr>
                        <th>PROGRAMA DE ESTUDIO</th>
                        <th>Total alumnos</th>
                        <th>Hombres</th>
                        <th>Mujeres</th>
                        <th>Discapacidad</th>
                        <th>Padres</th>
                        <th>Becados</th>
                        <th>Lengua</th>
                        <th>Etnia</th>
                        <th>Carrera</th>
                    </tr>
                @foreach($datos as $dato)
                    <tr>
                        <td>{{$dato->nombre}}</td>
                        <td>{{$dato->total}}</td>
                        <td>{{$dato->t_m}}</td>
                        <td>{{$dato->t_f}}</td>
                        <td>{{$dato->discapacidad}}</td>
                        <td>{{$dato->padres}}</td>
                        <td>{{$dato->beca}}</td>
                        <td>{{$dato->lengua}}</td>
                        <td>{{$dato->etina}}</td>
                        <th>
                            <a href="/tutorias/buscador/carrera/{{$dato->id_carrera}}" class="btn btn-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                                    <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                </svg>
                            </a>
                        </th>
                    </tr>
                @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
