@extends('layouts.panel')
@section('title', 'S.Escolares')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Calificaciones" :migas="['Servicios escolares' => null]" />
    @if(!isset($nom_materia))
        <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:lg:w-full tw:px-2">
            <div class="tw:w-full tw:px-2">
                <label class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700 tw:text-center"  data-toggle="tab" ><h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">No hay alumnos inscritos en esta materia
                    </h3></label>
            </div>
        </div>
    @else
        <div class=" tw:w-10/12 tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:lg:w-full tw:px-2">
                        <label for="" class="tw:w-full tw:lg:w-full tw:text-center tw:px-2">{{$nom_carrera}}</label>
                        <h4 class="tw:w-full tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><label for="" class="label tw:w-full tw:text-center tw:bg-green-50 tw:text-green-700 tw:px-2">{{$nom_docente}}</label></h4>
                        <label for="" class="tw:w-full tw:lg:w-6/12 tw:text-left tw:px-2">
                            Materia: {{$nom_materia}}
                            <br>
                            Grupo: {{$grupo}}
                        </label>
                        <label for="" class="tw:w-full tw:lg:w-6/12 tw:text-right tw:px-2">
                            Clave: {{$clave_m}}
                            <br>
                            No. Unidades: {{$unidades}}
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class=" tw:w-10/12 tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw:w-full tw-tabla tw-tabla-rayas tw:lg:w-full tw:px-2">
                        <thead class="">
                        <tr class="tw:text-center">
                            <th class="tw:text-center">NP.</th>
                            <th class="tw:text-center">No. CTA</th>
                            <th class="tw:text-center">ALUMNO</th>
                            @for ($i = 0; $i < $unidades; $i++)
                                <th class="tw:text-center">UNIDAD
                                    {{($i==0 ? 'I' :
                                        ($i==1 ? 'II' :
                                            ($i==2 ? 'III' :
                                                ($i==3 ? 'IV' :
                                                    ($i==4 ? 'V' :
                                                        ($i==5 ? 'VI' :
                                                            ($i==6 ? 'VII' :
                                                                ($i==7 ? 'VIII' :
                                                                    ($i==8 ? 'IX' :
                                                                        ($i==9 ? 'X' :
                                                                            ($i==10 ? 'XI' :
                                                                                ($i==11 ? 'XII' :
                                                                                    ($i==12 ? 'XIII' :
                                                                                        ($i==13 ? 'XIV' :
                                                                                            ($i==14 ? 'XV' : ' ' )))))))))))))))}}
                                </th>
                            @endfor
                            <th class="tw:text-center">PROMEDIO</th>
                            <th class="tw:text-center">T.E.</th>
                        </tr>
                        <tbody>
                        <?php  $porcentaje_gen=0; $cont_gen=0;?>
                        @foreach($alumnos as $alumno)
                            <tr class="tw:text-center">
                                <td class="tw:text-center">{{$alumno['np']}}</td>
                                <td class="tw:text-center" style=" {!! $alumno['curso']=='REPETICION' ? 'background:#ffee62; color:orange' : ($alumno['curso']=='ESPECIAL' ? 'background:#a94442; color:white' : '') !!} "> {{$alumno['cuenta']}}</td>
                                <td class="tw:text-left">{{$alumno['nombre']}}</td>
                                <?php  $cont=0; ?>
                                @forelse($alumno['calificaciones'] as $calificacion)
                                    <?php  $cont++; ?>
                                    @if(($cont)<=$unidades)
                                        @if( ($cont)==$calificacion['id_unidad'])
                                            <td style="background: {{ $calificacion['calificacion']>=70 ? ' ' : '#FFEE62' }}" data-id-eval="{{ $calificacion['id_evaluacion'] }}" data-id-unidad="{{ $calificacion['id_unidad'] }}">
                                                {{ $calificacion['calificacion']>=70 ? $calificacion['calificacion'] : 'N.A'  }}
                                                {!! $calificacion['modificado']==1 ? '<span class="oi oi-info tooltip-options link tw:text-white tw:bg-orange-700 tw:text-white tw:rounded-full tw:p-1.25 tw:text-[7px]" data-toggle="tooltip" data-placement="top" title="La calificación fue modificada"></span>' : ''  !!}
                                            </td>
                                        @else

                                        @endif
                                    @else

                                    @endif
                                @empty

                                @endforelse
                                <?php  $unidades_restantes=$unidades-$cont; ?>
                                @for ($i = 0; $i < $unidades_restantes; $i++)
                                    <td>0</td>
                                @endfor
                                <?php  $porcentaje_gen+=$alumno['promedio']>=70 ? '1' : '0'; $cont_gen++;?>
                                <td style="background: {{ $alumno['promedio']>=70 ? '' : '#a94442;color:white;' }}">{{ $alumno['promedio'] }}</td>
                                <td>{!! $alumno['curso']=='NORMAL' && $alumno['esc_alumno'] ? 'ESC'  : ( $alumno['curso']=='NORMAL' ? 'O'  : ($alumno['curso']=='REPETICION' && $alumno['esc_alumno'] ? 'ESC2' : ($alumno['curso']=='REPETICION' ? 'O2' : ($alumno['curso']=='ESPECIAL' ? 'CE' : ($alumno['curso']=='GLOBAL' ? 'EG': '' )))))!!}</td>
                                 </tr>
                        @endforeach
                        <tr>
                            <td colspan="3"></td>
                            @foreach($porcentajes as $porcentaje)
                                <td class="tw:text-center" style="background: {{ $porcentaje['porcentaje']>=70 ? '#3c763d' : '#a94442' }}; color: #ffffff">{{ $porcentaje['porcentaje'] }}%</td>
                            @endforeach
                            <?php  $imp_porcentaje=(($porcentaje_gen*100)/$cont_gen);?>
                            <td class="tw:text-center" style="background: {{ $imp_porcentaje>=70 ? '#3c763d' : '#a94442' }}; color: #ffffff">{{ round($imp_porcentaje,2) }}%</td>
                        </tr>
                        </tbody>
                    </table>
</div>
                </div>
            </div>
        </div>

    @endif
    <script type="text/javascript">
        $(document).ready(function()
        {

        });
    </script>
</div>
@endsection
