@extends('layouts.panel')
@section('title', 'Servicios Escolares')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Periodos para evaluar unidades" :migas="['Servicios escolares' => null]" />
    <?php $hoy = date("Y-m-d");?>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                        <div class="tw:w-full tw:lg:w-2/12 tw:lg:grow tw:px-2">
                            <a class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" href="{{url('/servicios_escolares/evaluaciones/'.$id_carrera)}}"><span class="fa fa-arrow-left" aria-hidden="true"></span> Regresar</a>
                        </div>
                        <div class="tw:w-full tw:lg:w-4/12 tw:lg:grow tw:px-2 tw:text-center" >
                            <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90 tw:text-center">Periodos para evaluar unidades</h3>
                        </div>

                    </div>

                </div>
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:lg:w-full tw:px-2">
                        <label for="" class="tw:w-full tw:lg:w-full tw:text-center tw:px-2">{{$nom_carrera}}</label>
                        <h4 class="tw:w-full tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><label for="" class="label tw:w-full tw:text-center tw:bg-green-50 tw:text-green-700 tw:px-2">{{$nom_docente}}</label></h4>
                        <label for="" class="tw:w-full tw:lg:w-6/12 tw:text-left tw:px-2">
                            Materia: {{ $tot_unidades->nombre }}
                            <br>
                            Grupo: {{$grupo}}
                        </label>
                        <label for="" class="tw:w-full tw:lg:w-6/12 tw:text-right tw:px-2">
                            Clave: {{ $tot_unidades->clave }}
                            <br>
                            No. Unidades: {{ $tot_unidades->unidades }}
                        </label>
                    </div>
                    <hr class="tw:border tw:border-gray-400 tw:dark:border-gray-600"/>
                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:lg:w-full tw:px-2">
                        <div class="tw-tabla-contenedor tw:mx-2 tw:w-full tw:flex-1 tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla-centrada border-table tw:w-full tw-tabla tw:my-0">
                            <thead>
                            <tr class="tw:text-center">
                                <th class="tw:text-center">Unidad</th>
                                <th class="tw:text-center">Fecha de evaluación</th>
                                <th class="tw:text-center">Estado</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($array_perio as $periodo)
                                <tr>
                                    <td> <strong>UNIDAD {{($periodo['id_unidad']==1 ? 'I' :
                                                ($periodo['id_unidad']==2 ? 'II' :
                                                    ($periodo['id_unidad']==3 ? 'III' :
                                                        ($periodo['id_unidad']==4 ? 'IV' :
                                                            ($periodo['id_unidad']==5 ? 'V' :
                                                                ($periodo['id_unidad']==6 ? 'VI' :
                                                                    ($periodo['id_unidad']==7 ? 'VII' :
                                                                        ($periodo['id_unidad']==8 ? 'VIII' :
                                                                            ($periodo['id_unidad']==9 ? 'IX' :
                                                                                ($periodo['id_unidad']==10 ? 'X' :
                                                                                    ($periodo['id_unidad']==11 ? 'XI' :
                                                                                        ($periodo['id_unidad']==12 ? 'XII' :
                                                                                            ($periodo['id_unidad']==13 ? 'XIII' :
                                                                                                ($periodo['id_unidad']==14 ? 'XIV' :
                                                                                                    ($periodo['id_unidad']==15 ? 'XV' : ' ' )))))))))))))))}}
                                        </strong></td>

                                    @if($periodo['status']==1)
                                        <?php  $fecha_periodo=date("d-m-Y ",strtotime($periodo['fecha'])) ?>
                                        <td><strong>{{$fecha_periodo}} </strong>{!! $hoy==$periodo['fecha'] ? '<span class="oi oi-info tooltip-options link tw:text-white tw:bg-orange-700 tw:text-white tw:rounded-full tw:p-1.25" data-toggle="tooltip" data-placement="top" title="La fecha para registrar calificaciones finaliza hoy"></span>' : ''  !!} </td>

                                        @if($periodo['evaluada']==1)
                                            <td><a href="#!" class="tooltip-options link tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-toggle="tooltip" data-placement="top" title="Evaluación realizada"><span class="oi oi-check tw:p-1"></span></a></td>
                                        @elseif($periodo['evaluada']==0)
                                            <td><a href="#!" class="tooltip-options link tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" data-toggle="tooltip" data-placement="top" title="Evaluación pendiente"><span class="oi oi-clock"></span></a></td>
                                        @endif
                                    @else
                                        <td class="tw:text-center"><strong>No asignado</strong></td>
                                        <td><a href="#!" class="tooltip-options link tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:disabled:bg-amber-300 tw:size-9 tw:text-base" data-toggle="tooltip" data-placement="top" title="Aun no se ha asignado la fecha de evaluación"><span class="oi oi-warning tw:p-1"></span></a></td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection