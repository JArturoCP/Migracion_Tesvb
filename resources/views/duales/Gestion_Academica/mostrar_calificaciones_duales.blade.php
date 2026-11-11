@extends('layouts.app')
@section('title', 'Gestión Académica Calificaciones')
@section('content')

<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center"><b>REGISTRO DE CALIFICACIONES DE <br> {{$nombre_alumno}}</b></h3>
                </div>
            </div>
        </div>
    </div>
    @if($calificar_dual == 0)
        <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title text-center"><b>NO HAY CALIFICACIONES REGISTRADAS<b></h3>
                </div>
            </div>
        </div>
    </div>
   
    @else
        <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <table class="table text-center col-md-12">
                        <thead class="bg-info" >
                        <tr style="border: 2px solid #3097d1">
                            <th class="text-center ">MATERIA</th>
                            @for ($i = 0; $i < $mayor_unidades; $i++)
                                <th class="text-center">
                                    {{($i==0 ? 'I' : ($i==1 ? 'II' :($i==2 ? 'III' :($i==3 ? 'IV' :($i==4 ? 'V' :($i==5 ? 'VI' :($i==6 ? 'VII' :($i==7 ? 'VIII' :($i==8 ? 'IX' :($i==9 ? 'X' :($i==10 ? 'XI' :($i==11 ? 'XII' :($i==12 ? 'XIII' :($i==13 ? 'XIV' :($i==14 ? 'XV' : ' ' )))))))))))))))}}
                                </th>
                            @endfor
                            <th class="text-center">PROMEDIO</th>
                            <th class="text-center"> T.E.</th>

                        </tr>
                        </thead>
                        <tbody style="border: 2px solid #3097d1">
                        <?php $promedio_sum=0; $num_materias=0;?>
                        @foreach($array_materias as $materias)
                                <?php $cont_res=0;?>
                            <tr>
                                <th class="text-center">{{ $materias['materia'] }}</th>
                                @foreach($materias['calificaciones'] as $calificaciones)
                                    @if($calificaciones != null)
                                        <td style="background: {{ $calificaciones['calificacion']>=70 ? ' ' : '#FFEE62' }}">
                                            {{ $calificaciones['calificacion']>=70 ? $calificaciones['calificacion'] : 'N.A'  }}
                                        </td>
                                            <?php $cont_res++; ?>
                                    @else
                                    @endif
                                @endforeach
                                @for ($i = 0; $i < ($mayor_unidades-$cont_res); $i++)
                                    @if($materias['unidades'] <= ($cont_res+$i) )
                                        <td class="bg-info"></td>
                                    @else
                                        <td>0</td>
                                    @endif
                                @endfor
                                <td style="background: {{ $materias['promedio']>=70 ? '' : '#a94442;color:white;' }}">{{ $materias['promedio']>=70 ?  $materias['promedio'] : 'N.A' }}</td>
                                    <?php $materias['promedio'] !=0 ? $promedio_sum+=$materias['promedio']  : 0 ; $num_materias++; ?>
                                <td>{!! $materias['curso']=='NORMAL' && $materias['esc_alumno'] ? 'ESC'  : ( $materias['curso']=='NORMAL' ? 'O'  : ($materias['curso']=='REPETICION' && $materias['esc_alumno'] ? 'ESC2' : ($materias['curso']=='REPETICION' ? 'O2' : ($materias['curso']=='ESPECIAL' ? 'CE' : ($materias['curso']=='GLOBAL' ? 'EG': '' )))))!!}</td>
                            
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="1" ></td>
                            <td colspan="{{$mayor_unidades}}" class="text-center"><strong>PROMEDIO</strong></td>
                            <?php $promedio=$promedio_sum/($num_materias==0 ? 1 : $num_materias) ?>
                            <td>{{ $pro=number_format($promedio, 2, '.', '') }}</td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
@endif
@endsection