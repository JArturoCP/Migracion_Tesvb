@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Calificaciones de Ingles')
@section('content')
    @include('ingles.alumno_ingles.estilos')
    <main class="ingles-estudiante ingles-notas">
        <h1 class="ingles-titulo">Calificaciones del periodo {{$periodo->periodo_ingles}}</h1>
        @if($estado_calificacion_ingles == 0)
            <p class="ingles-aviso ingles-aviso--error">No hay calificaciones en este periodo.</p>
        @else
            <div class="ingles-tabs-notas tesvb-tabla-scroll">
                <table id="table_calificacion" class="table table-bordered text-center">
                    <thead>
                    <tr>
                        <th scope="col">Skill</th>
                        <th scope="col">Grade</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $promedio=0 ?>
                    @foreach($ver_estado_cal as $ver_estado_calicacion)
                        <tr>
                            <?php $promedio=$promedio+$ver_estado_calicacion->calificacion ?>
                            @if($ver_estado_calicacion->id_unidad == 1)
                            <td>Speaking</td>
                            @if($ver_estado_calicacion->calificacion<80)
                            <td class="ingles-nota-baja">{{$ver_estado_calicacion->calificacion}}</td>
                            @else
                            <td><b>{{$ver_estado_calicacion->calificacion}}</b></td>
                            @endif
                            @elseif($ver_estado_calicacion->id_unidad == 2)
                            <td>Writing</td>
                            @if($ver_estado_calicacion->calificacion<80)
                            <td class="ingles-nota-baja">{{$ver_estado_calicacion->calificacion}}</td>
                            @else
                            <td><b>{{$ver_estado_calicacion->calificacion}}</b></td>
                            @endif
                            @elseif($ver_estado_calicacion->id_unidad == 3)
                            <td>Reading</td>
                            @if($ver_estado_calicacion->calificacion<80)
                            <td class="ingles-nota-baja">{{$ver_estado_calicacion->calificacion}}</td>
                            @else
                            <td><b>{{$ver_estado_calicacion->calificacion}}</b></td>
                            @endif
                            @elseif($ver_estado_calicacion->id_unidad == 4)
                            <td>Listening</td>
                            @if($ver_estado_calicacion->calificacion<80)
                            <td class="ingles-nota-baja">{{$ver_estado_calicacion->calificacion}}</td>
                            @else
                            <td><b>{{$ver_estado_calicacion->calificacion}}</b></td>
                            @endif
                            @endif
                        </tr>
                    @endforeach
                    <tr><td><b>Promedio General</b></td><td><b>{{round($promedio/4)}}</b></td></tr>
                    </tbody>
                </table>
                <div class="ingles-acciones">
                    <button type="button" class="btn ingles-boton"
                             onclick="window.open('{{url('/ingles/imprimir_calificacion_ingles_alumno/'.$alumnoscal->id_alumno)}}')">
                                Imprimir boleta
                        </button>
                </div>
            </div>
        @endif
    </main>

@endsection
