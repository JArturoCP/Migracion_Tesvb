@extends('layouts.app')
@section('title', 'S.Escolares')
@section('content')

    <div class="row">
        <div class="col-md-10 col-xs-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">CONCENTRADO DE CALIFICACIONES DUALES</h3>
                    <h3 class="panel-title text-center">MATERIA: {{ $materia_seleccionada[0]->materias }}</h3>
                    <h3 class="panel-title text-center">CLAVE DE LA MATERIA: {{ $materia_seleccionada[0]->clave }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-xs-10 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Concentrado de Calificaciones Completo</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-xs-10 col-md-offset-2">
            <table class="table table-bordered col-md-12">
                <thead class="">
                <tr class="text-center info">
                    <th class="text-center" >PROFESOR</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datos as $dato)
                    <tr>
                        <td style="text-align:center">{{ $dato->titulo . " " . $dato->profesor }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-xs-10 col-md-offset-1">
            <div class="panel">
                <div class="panel-body">
                    <table class="table table-bordered col-md-12">
                        <thead class="">
                        <tr class="text-center info">
                            <th class="text-center">NP.</th>
                            <th class="text-center">No. CTA</th>
                            <th class="text-center">ALUMNO</th>
                            <th class="text-center">PROMEDIO MATERIA</th>
                            <th class="text-center">TE</th>
                            <th class="text-center">PROMEDIO GENERAL</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($materias_calificaciones as $alumno)
                            <tr class="text-center">
                                <td>{{$alumno['numero']}}</td>
                                <td class="text-center" style=" {!! $alumno['estado_alumno']==2 ? 'background:#ffee62; color:orange' : ($alumno['estado_alumno']==3 ? 'background:#a94442; color:white' : '') !!} "> {{$alumno['cuenta']}}</td>
                                <td>{{$alumno['nombre']}}</td>
                                @foreach($alumno['l'] as $calificacion)
                                    @if($calificacion['estado'] == 1)

                                        <td style="background: black; color: white; text-align: center;">NO cursa</td>
                                        <td style="background: black; color: white;text-align: center;"></td>
                                    @else
                                        @if($calificacion['promedio'] < 70)
                                            <td style="background: red; color: white;text-align: center;">N.A.</td>
                                        @else
                                            <td style="text-align: center;">{{$calificacion['promedio']}}</td>
                                        @endif
                                        <td style="text-align: center;">{{$calificacion['te']}}</td>
                                    @endif

                                @endforeach
                                @if($alumno['estado_validacion'] == 10)
                                    <td style="background: red; color:black;text-align: center;">BAJA</td>

                                @else
                                    @if($alumno['promedio_f'] < 70)
                                        <td style="background: red; color:black;text-align: center;">{{ $alumno['promedio_f']  }}</td>
                                    @else
                                        <td style="text-align: center;">{{$alumno['promedio_f']}}</td>
                                    @endif
                                @endif

                            </tr>
                        @endforeach
                        <?php  $numero_materia=0;
                        $creditos_finales=0;
                        $total_creditos_grupo=0;
                        $total_aprobados_grupo=0;
                        ?>
                        <tr>
                            <td colspan="3" class="text-right" >
                                Meta Real
                            </td>
                            @foreach($com as $califi)
                                <td class="text-center" >
                                        <?php
                                        $numero_materia++;
                                        $creditos_finales+=$califi['creditos'];
                                        ?>

                                    @if($califi['aprobados']==0)
                                        0%
                                    @else
                                            <?php $meta_real=($califi['aprobados']*100)/$califi['total'];
                                            $meta_real=number_format($meta_real, 2, '.', ' ');?>
                                        {{ $meta_real }}%
                                    @endif


                                </td>
                                <td></td>
                            @endforeach
                            <td class="text-center"><?php $indice_final_aprobacion=($numero_promedio_aprobado*100)/$numero_alumno;
                                                    $indice_final_aprobacion=number_format($indice_final_aprobacion, 2, '.', ' ');?>
                                {{ $indice_final_aprobacion }}%
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right" >
                                Alumnos Que Cursan La Materia
                            </td>
                            @foreach($com as $califi)
                                <td class="text-center">
                                    {{$califi['total']}}
                                </td>
                                <td></td>
                            @endforeach
                            <td class="text-center">{{ $numero_alumno }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right" >
                                Alumnos Aprobados
                            </td>
                            @foreach($com as $califi)
                                <td class="text-center">
                                    {{$califi['aprobados']}}
                                </td>
                                <td></td>
                            @endforeach
                            <td class="text-center">{{ $numero_promedio_aprobado }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right" >
                                Alumnos Reprobados
                            </td>
                            @foreach($com as $califi)
                                <td class="text-center">
                                    {{$califi['reprobados']}}
                                </td>
                                <td></td>
                            @endforeach
                            <td class="text-center">{{ $numero_promedio_reprobado }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right" >
                                Indice de Reprobación
                            </td>
                            @foreach($com as $califi)
                                <td class="text-center">
                                    @if($califi['reprobados']==0)
                                        0%
                                    @else
                                            <?php $indice_r=($califi['reprobados']*100)/$califi['total'];
                                            $indice_r=number_format($indice_r, 2, '.', ' ');?>
                                        {{ $indice_r }}%
                                    @endif
                                </td>
                                <td></td>
                            @endforeach
                            <td class="text-center">
                                <?php $indice_final_reprobacion=($numero_promedio_reprobado*100)/$numero_alumno;
                                $indice_final_reprobacion=number_format($indice_final_reprobacion, 2, '.', ' ');?>

                                {{ $indice_final_reprobacion }}%
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right" >
                                Promedio De La Materia
                            </td>
                            @foreach($com as $califi)
                                <td class="text-center">
                                    @if($califi['total']==0)
                                        0.00
                                    @else
                                            <?php $promedio=($califi['suma_promedios'])/$califi['total'];
                                            $promedio=number_format($promedio, 2, '.', ' '); ?>
                                        {{ $promedio }}
                                    @endif
                                </td>
                                <td></td>
                            @endforeach
                            <td class="text-center">
                                @if($promedio_general ==0)
                                    0.00
                                @else
                                        <?php  $pro_f=$promedio_general;
                                        $pro_f=number_format($pro_f, 2, '.', ' ');?>
                                    {{$pro_f}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right" >
                                Alumnos Baja
                            </td>
                            @foreach($com as $califi)
                                <td class="text-center">
                                    {{$califi['bajas']}}
                                </td>
                                <td></td>
                            @endforeach
                            <td class="text-center"> {{ $bajas }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right" >
                                Indice de Deserción
                            </td>
                            @foreach($com as $califi)
                                <td class="text-center">
                                    @if($califi['bajas']==0)
                                        0%
                                    @else
                                            <?php $indice_desercion=($califi['bajas']*100)/($califi['total']+$califi['bajas']);
                                            $indice_desercion=number_format($indice_desercion, 2, '.', ' ');?>
                                        {{ $indice_desercion }}%
                                    @endif
                                </td>
                                <td></td>
                            @endforeach
                            <td class="text-center">
                                @if($bajas ==0)
                                    0.00 %
                                @else
                                        <?php  $total_al=$numero_alumno+$bajas;
                                        $indice_desercion_final=($bajas*100)/$total_al;
                                        $indice_desercion_final=number_format($indice_desercion_final, 2, '.', ' ');?>
                                    {{ $indice_desercion_final }} %
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right" >
                                Creditos Por Materia
                            </td>
                            @foreach($com as $califi)
                                <td class="text-center">
                                    {{$califi['creditos']}}
                                </td>
                                <td></td>
                            @endforeach
                            <td class="text-center">{{ $creditos_finales }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right" >
                                Total De Créditos Cursados En La Materia
                            </td>
                            @foreach($com as $califi)
                                <td class="text-center">
                                        <?php $total_creditos=$califi['creditos']*$califi['total']; $total_creditos_grupo+=$total_creditos;?>{{$total_creditos}}
                                </td>
                                <td></td>
                            @endforeach
                            <td class="text-center">{{$total_creditos_grupo}}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right" >
                                Total De Créditos Aprobados
                            </td>
                            @foreach($com as $califi)
                                <td class="text-center">
                                        <?php $total_creditos_a=$califi['creditos']*$califi['aprobados']; $total_aprobados_grupo+=$total_creditos_a;?>{{$total_creditos_a}}  </td>
                                <td></td>
                            @endforeach
                            <td class="text-center">{{ $total_aprobados_grupo }}</td>
                        </tr>
                        <tr>
                        <tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="padding: 1.0em">
        <div class="col-md-10 col-xs-10 col-md-offset-5">
            @foreach($array_materias as $materia)
                <a href="{{ url('/duales/concentrado_calificaciones_duales/concentrado_excel/'. $materia['id_materia']) }}" class="btn btn-warning" style="color:black">
                    Exportar Concentrado <span class="oi oi-document p-1"></span>
                </a>
            @endforeach
        </div>
    </div>
@endsection