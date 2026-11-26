@extends('layouts.panel')
@section('title', 'S.Escolares')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

    <x-panel.encabezado :titulo="'Concentrado de calificaciones duales materia: '.$materia_seleccionada[0]->materias.' clave de la materia: '.$materia_seleccionada[0]->clave" :migas="['Educación dual' => null]" />

    <x-panel.alerta tipo="exito" class="tw:mb-4">Concentrado de Calificaciones Completo</x-panel.alerta>

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw:w-full tw-tabla tw-tabla-bordes tw:lg:w-full tw:px-2">
                <thead class="">
                <tr class="tw:bg-sky-50 tw:text-center">
                    <th class="tw:text-center" >PROFESOR</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datos as $dato)
                    <tr>
                        <td class="tw:text-center">{{ $dato->titulo . " " . $dato->profesor }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
</div>
        </div>
    </div>

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw:w-full tw-tabla tw-tabla-bordes tw:lg:w-full tw:px-2">
                        <thead class="">
                        <tr class="tw:bg-sky-50 tw:text-center">
                            <th class="tw:text-center">NP.</th>
                            <th class="tw:text-center">No. CTA</th>
                            <th class="tw:text-center">ALUMNO</th>
                            <th class="tw:text-center">PROMEDIO MATERIA</th>
                            <th class="tw:text-center">TE</th>
                            <th class="tw:text-center">PROMEDIO GENERAL</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($materias_calificaciones as $alumno)
                            <tr class="tw:text-center">
                                <td>{{$alumno['numero']}}</td>
                                <td class="tw:text-center" style=" {!! $alumno['estado_alumno']==2 ? 'background:#ffee62; color:orange' : ($alumno['estado_alumno']==3 ? 'background:#a94442; color:white' : '') !!} "> {{$alumno['cuenta']}}</td>
                                <td>{{$alumno['nombre']}}</td>
                                @foreach($alumno['l'] as $calificacion)
                                    @if($calificacion['estado'] == 1)

                                        <td class="tw:bg-gray-900 tw:text-white tw:text-center">NO cursa</td>
                                        <td class="tw:bg-gray-900 tw:text-white tw:text-center"></td>
                                    @else
                                        @if($calificacion['promedio'] < 70)
                                            <td class="tw:bg-red-600 tw:text-white tw:text-center">N.A.</td>
                                        @else
                                            <td class="tw:text-center">{{$calificacion['promedio']}}</td>
                                        @endif
                                        <td class="tw:text-center">{{$calificacion['te']}}</td>
                                    @endif

                                @endforeach
                                @if($alumno['estado_validacion'] == 10)
                                    <td class="tw:bg-red-600 tw:text-white tw:text-center">BAJA</td>

                                @else
                                    @if($alumno['promedio_f'] < 70)
                                        <td class="tw:bg-red-600 tw:text-white tw:text-center">{{ $alumno['promedio_f']  }}</td>
                                    @else
                                        <td class="tw:text-center">{{$alumno['promedio_f']}}</td>
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
                            <td colspan="3" class="tw:text-right" >
                                Meta Real
                            </td>
                            @foreach($com as $califi)
                                <td class="tw:text-center" >
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
                            <td class="tw:text-center"><?php $indice_final_aprobacion=$numero_alumno ? ($numero_promedio_aprobado*100)/$numero_alumno : 0;
                                                    $indice_final_aprobacion=number_format($indice_final_aprobacion, 2, '.', ' ');?>
                                {{ $indice_final_aprobacion }}%
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="tw:text-right" >
                                Alumnos Que Cursan La Materia
                            </td>
                            @foreach($com as $califi)
                                <td class="tw:text-center">
                                    {{$califi['total']}}
                                </td>
                                <td></td>
                            @endforeach
                            <td class="tw:text-center">{{ $numero_alumno }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="tw:text-right" >
                                Alumnos Aprobados
                            </td>
                            @foreach($com as $califi)
                                <td class="tw:text-center">
                                    {{$califi['aprobados']}}
                                </td>
                                <td></td>
                            @endforeach
                            <td class="tw:text-center">{{ $numero_promedio_aprobado }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="tw:text-right" >
                                Alumnos Reprobados
                            </td>
                            @foreach($com as $califi)
                                <td class="tw:text-center">
                                    {{$califi['reprobados']}}
                                </td>
                                <td></td>
                            @endforeach
                            <td class="tw:text-center">{{ $numero_promedio_reprobado }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="tw:text-right" >
                                Indice de Reprobación
                            </td>
                            @foreach($com as $califi)
                                <td class="tw:text-center">
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
                            <td class="tw:text-center">
                                <?php $indice_final_reprobacion=$numero_alumno ? ($numero_promedio_reprobado*100)/$numero_alumno : 0;
                                $indice_final_reprobacion=number_format($indice_final_reprobacion, 2, '.', ' ');?>

                                {{ $indice_final_reprobacion }}%
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="tw:text-right" >
                                Promedio De La Materia
                            </td>
                            @foreach($com as $califi)
                                <td class="tw:text-center">
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
                            <td class="tw:text-center">
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
                            <td colspan="3" class="tw:text-right" >
                                Alumnos Baja
                            </td>
                            @foreach($com as $califi)
                                <td class="tw:text-center">
                                    {{$califi['bajas']}}
                                </td>
                                <td></td>
                            @endforeach
                            <td class="tw:text-center"> {{ $bajas }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="tw:text-right" >
                                Indice de Deserción
                            </td>
                            @foreach($com as $califi)
                                <td class="tw:text-center">
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
                            <td class="tw:text-center">
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
                            <td colspan="3" class="tw:text-right" >
                                Creditos Por Materia
                            </td>
                            @foreach($com as $califi)
                                <td class="tw:text-center">
                                    {{$califi['creditos']}}
                                </td>
                                <td></td>
                            @endforeach
                            <td class="tw:text-center">{{ $creditos_finales }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="tw:text-right" >
                                Total De Créditos Cursados En La Materia
                            </td>
                            @foreach($com as $califi)
                                <td class="tw:text-center">
                                        <?php $total_creditos=$califi['creditos']*$califi['total']; $total_creditos_grupo+=$total_creditos;?>{{$total_creditos}}
                                </td>
                                <td></td>
                            @endforeach
                            <td class="tw:text-center">{{$total_creditos_grupo}}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="tw:text-right" >
                                Total De Créditos Aprobados
                            </td>
                            @foreach($com as $califi)
                                <td class="tw:text-center">
                                        <?php $total_creditos_a=$califi['creditos']*$califi['aprobados']; $total_aprobados_grupo+=$total_creditos_a;?>{{$total_creditos_a}}  </td>
                                <td></td>
                            @endforeach
                            <td class="tw:text-center">{{ $total_aprobados_grupo }}</td>
                        </tr>
                        <tr>
                        <tr>
                        </tbody>
                    </table>
</div>
                </div>
            </div>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            @foreach($array_materias as $materia)
                <a href="{{ url('/duales/concentrado_calificaciones_duales/concentrado_excel/'. $materia['id_materia']) }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">
                    Exportar Concentrado <span class="oi oi-document tw:p-1"></span>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection