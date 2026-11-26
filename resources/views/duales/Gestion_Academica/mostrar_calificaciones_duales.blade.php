@extends('layouts.panel')
@section('title', 'Gestión Académica Calificaciones')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

<x-panel.encabezado :titulo="'Registro de calificaciones de '.$nombre_alumno" :migas="['Educación dual' => null]" />
    @if($calificar_dual == 0)
        <x-panel.alerta tipo="error" class="tw:mb-4"><b>NO HAY CALIFICACIONES REGISTRADAS<b></x-panel.alerta>
   
    @else
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla-centrada tw:w-full tw-tabla tw:lg:w-full tw:px-2">
                        <thead class="tw:bg-sky-100" >
                        <tr class="tw:border-2 tw:border-blue-500">
                            <th class="tw:text-center">MATERIA</th>
                            @for ($i = 0; $i < $mayor_unidades; $i++)
                                <th class="tw:text-center">
                                    {{($i==0 ? 'I' : ($i==1 ? 'II' :($i==2 ? 'III' :($i==3 ? 'IV' :($i==4 ? 'V' :($i==5 ? 'VI' :($i==6 ? 'VII' :($i==7 ? 'VIII' :($i==8 ? 'IX' :($i==9 ? 'X' :($i==10 ? 'XI' :($i==11 ? 'XII' :($i==12 ? 'XIII' :($i==13 ? 'XIV' :($i==14 ? 'XV' : ' ' )))))))))))))))}}
                                </th>
                            @endfor
                            <th class="tw:text-center">PROMEDIO</th>
                            <th class="tw:text-center"> T.E.</th>

                        </tr>
                        </thead>
                        <tbody class="tw:border-2 tw:border-blue-500">
                        <?php $promedio_sum=0; $num_materias=0;?>
                        @foreach($array_materias as $materias)
                                <?php $cont_res=0;?>
                            <tr>
                                <th class="tw:text-center">{{ $materias['materia'] }}</th>
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
                                        <td class="tw:bg-sky-100"></td>
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
                            <td colspan="{{$mayor_unidades}}" class="tw:text-center"><strong>PROMEDIO</strong></td>
                            <?php $promedio=$promedio_sum/($num_materias==0 ? 1 : $num_materias) ?>
                            <td>{{ $pro=number_format($promedio, 2, '.', '') }}</td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
</div>
                </div>
            </div>
@endif
</div>
@endsection