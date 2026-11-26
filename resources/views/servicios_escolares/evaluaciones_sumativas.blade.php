@extends('layouts.panel')
@section('title', 'Calificaciones')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Calificaciones sumativas" :migas="['Servicios escolares' => null]" />
    @if($estado_sumativa ==0)
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-2/12 tw:lg:grow tw:px-2">
                                <a class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" href="{{url('/servicios_escolares/evaluaciones/'.$id_carrera)}}"><span class="fa fa-arrow-left" aria-hidden="true"></span> Regresar</a>
                            </div>
                            <div class="tw:w-full tw:lg:w-4/12 tw:lg:grow tw:px-2 tw:text-center" >
                                <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90 tw:text-center">Calificaciones sumativas</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:lg:w-full tw:px-2">
                        <label for="" class="tw:w-full tw:lg:w-full tw:text-center tw:px-2">{{$nom_carrera}}</label>
                        <h4 class="tw:w-full tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><label for="" class="label tw:w-full tw:text-center tw:bg-green-50 tw:text-green-700 tw:px-2">{{$nom_docente}}</label></h4>
                        <label for="" class="tw:w-full tw:lg:w-6/12 tw:text-left tw:px-2">
                            Materia: {{$mat->nombre}}
                            <br>
                            Grupo: {{$grupo}}
                        </label>
                        <label for="" class="tw:w-full tw:lg:w-6/12 tw:text-right tw:px-2">
                            Clave: {{$mat->clave}}
                            <br>
                            No. Unidades: {{$mat->unidades}}
                        </label>
                    </div>
                </div>
            </div>
        </div>
        </div>
    <x-panel.alerta tipo="error" class="tw:mb-4">No se han registrado calificaciones sumativas.</x-panel.alerta>

    @else
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-2/12 tw:lg:grow tw:px-2">
                                <a class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" href="{{url('/servicios_escolares/evaluaciones/'.$id_carrera)}}"><span class="fa fa-arrow-left" aria-hidden="true"></span> Regresar</a>
                            </div>
                            <div class="tw:w-full tw:lg:w-4/12 tw:lg:grow tw:px-2 tw:text-center" >
                                <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90 tw:text-center">Calificaciones sumativas</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <a href="/generar_excel/acta_constitutiva_sumativa/{{ $id_docente }}/{{ $id_materia }}/{{ $id_grupo }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" target="_blank"><span class="fa fa-print"  aria-hidden="true"></span>Exportar a Excel</a>
            </div>
        </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                    <div class="tw:p-5 tw:sm:p-6">
                        <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:lg:w-full tw:px-2">
                            <label for="" class="tw:w-full tw:lg:w-full tw:text-center tw:px-2">{{$nom_carrera}}</label>
                            <h4 class="tw:w-full tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><label for="" class="label tw:w-full tw:text-center tw:bg-green-50 tw:text-green-700 tw:px-2">{{$nom_docente}}</label></h4>
                            <label for="" class="tw:w-full tw:lg:w-6/12 tw:text-left tw:px-2">
                                Materia: {{$mat->nombre}}
                                <br>
                                Grupo: {{$grupo}}
                            </label>
                            <label for="" class="tw:w-full tw:lg:w-6/12 tw:text-right tw:px-2">
                                Clave: {{$mat->clave}}
                                <br>
                                No. Unidades: {{$mat->unidades}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                    <div class="tw:p-5 tw:sm:p-6">
                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw:w-full tw-tabla tw-tabla-rayas tw:lg:w-full tw:px-2">
                            <thead class="">
                            <tr class="tw:text-center">
                                <th class="tw:text-center"></th>
                                <th class="tw:text-center">NP.</th>
                                <th class="tw:text-center">No. CTA</th>
                                <th class="tw:text-center">ALUMNO</th>
                                @for ($i = 0; $i < $mat->unidades; $i++)
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
                                <th class="tw:text-center">ACCIONES</th>
                            </tr>
                            <tbody>
                            <?php  $porcentaje_gen=0; $cont_gen=0;?>
                            @foreach($alumnos as $alumno)
                                <tr class="tw:text-center">
                                    @if($alumno['estado_validacion'] == 9)
                                        <td class="tw:text-center tw:bg-sky-600 tw:text-white">Dual--></td>
                                    @else
                                        <td ></td>
                                    @endif
                                    @if($alumno['estado_validacion'] == 9)
                                        <td class="tw:text-center tw:bg-sky-600 tw:text-white">{{$alumno['np']}}</td>
                                    @else
                                        <td class="tw:text-center">{{$alumno['np']}}</td>
                                    @endif
                                    <td class="tw:text-center" style=" {!! $alumno['curso']=='REPETICION' ? 'background:#ffee62; color:orange' : ($alumno['curso']=='ESPECIAL' ? 'background:#a94442; color:white' : '') !!} "> {{$alumno['cuenta']}}</td>
                                    @if($alumno['estado_validacion'] == 9)
                                        <td class="tw:text-left tw:bg-sky-600 tw:text-white">{{$alumno['nombre']}}</td>
                                    @else
                                        <td class="tw:text-left">{{$alumno['nombre']}}</td>
                                    @endif
                                    <?php  $cont=0; ?>
                                    @forelse($alumno['calificaciones'] as $calificacion)
                                        <?php  $cont++; ?>
                                        @if(($cont)<=$mat->unidades)
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
                                    <?php  $unidades_restantes=$mat->unidades-$cont; ?>
                                    @for ($i = 0; $i < $unidades_restantes; $i++)
                                        @if($alumno['baja'] == 1)
                                            <td class="tw:bg-yellow-200 tw:dark:bg-yellow-500/20" >N.A</td>
                                        @else
                                            <td>0</td>
                                        @endif
                                    @endfor
                                    @if($alumno['estado_validacion'] == 10)
                                        <td class="tw:bg-red-700 tw:text-white">BAJA</td>
                                    @else

                                        <td style="background: {{ $alumno['sumativa'] == false ? '' : '#a94442;color:white;' }}">{{  $alumno['sumativa'] == false ? $alumno['promedio'] : 'N.A' }}</td>
                                    @endif
                                    <td>{!! $alumno['curso']=='NORMAL' && $alumno['esc_alumno'] ? 'ESC'  : ( $alumno['curso']=='NORMAL' ? 'O'  : ($alumno['curso']=='REPETICION' && $alumno['esc_alumno'] ? 'ESC2' : ($alumno['curso']=='REPETICION' ? 'O2' : ($alumno['curso']=='ESPECIAL' ? 'CE' : ($alumno['curso']=='GLOBAL' ? 'EG': '' )))))!!}</td>
                                    <td><span data-toggle="modal" data-target="#modifica_cal_{{$alumno['cuenta']}}"><a href="#!" class="tooltip-options link tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-token="{{ csrf_token() }}" data-toggle="tooltip" data-placement="top" title="Modificar calificaciones"><span class="fa fa-pencil"></span></a></span></td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4"></td>
                                @foreach($porcentajes as $porcentaje)
                                    <td class="tw:text-center" style="background: {{ $porcentaje['porcentaje']>=70 ? '#3c763d' : '#a94442' }}; color: #ffffff">{{round( $porcentaje['porcentaje'],2) }}%</td>
                                @endforeach

                                <td class="tw:text-center" style="background: {{ $imp_porcentaje>=70 ? '#3c763d' : '#a94442' }}; color: #ffffff">{{  round($imp_porcentaje,2) }} %</td>
                            </tr>
                            </tbody>
                        </table>
</div>
                    </div>
                </div>
            </div>
            <div class="tw:w-full tw:px-2">
                @foreach($alumnos as $alumno)
                    <x-panel.modal id="modifica_cal_{{$alumno['cuenta']}}" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                    
                                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar calificación</h4>
                                </div>
                                <div class="tw-modal-cuerpo">
                                    <div class="tw:mb-4 tw:text-center">
                                        <label class="tw:text-right">Alumno: {{ $alumno['nombre'] }}</label>
                                    </div>
                                    <div class="tw:mb-4">
                                        <label for="fecha_inicio" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Seleccionar calificación que desea modificar:</label>
                                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="calificacion{{$alumno['cuenta']}}" id="calificacion{{$alumno['cuenta']}}">
                                            @forelse($alumno['calificaciones'] as $calificacion)
                                                <option data-calificacion="{{$calificacion['calificacion']}}" value="{{ $calificacion['id_evaluacion'] }}">Unidad {{ $calificacion['id_unidad'] }} / Calificación = {{ $calificacion['calificacion'] }} </option>
                                            @empty
                                            @endforelse
                                        </select>
                                        <label for="fecha_inicio" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Ingrese la nueva calificación:</label>
                                        <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="cal_update{{$alumno['cuenta']}}" name="cal_update{{$alumno['cuenta']}}">
                                    </div>
                                </div>
                                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                    <button type="button" class="h-secondary_m tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                                    <button type="" class="h-primary_m tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" name="modifica_calificacion{{$alumno['cuenta']}}" id="modifica_calificacion{{$alumno['cuenta']}}">Aceptar</button>
                                </div>
                            </x-panel.modal>
                @endforeach
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function()
            {
                @foreach($alumnos as $alumno)
                $("#modifica_calificacion{{$alumno['cuenta']}}").on("click",function()
                {
                   // TNotify.alert('hola');
                    //aqui modifica
                    var docente="{{$nom_docente}}";
                    var id_materia="{{$id_materia}}";
                    var id_evaluacion=$("#calificacion{{$alumno['cuenta']}}").val();
                    var cal_anterior=$("#calificacion{{$alumno['cuenta']}}").children('option:selected').data("calificacion");
                    var calificacion=$("#cal_update{{$alumno['cuenta']}}").val();
                    if(cal_anterior==calificacion)
                    {
                        swal({
                            position:"",
                            type: "error",
                            title: "Error",
                            text: 'Está intentando guardar la misma calificación.',
                            showConfirmButton: true,
                        });
                    }
                    else if(calificacion<0 || calificacion>100 || !/^([0-9])*$/.test(calificacion))
                    {
                        swal({
                            position:"",
                            type: "error",
                            title: "Error",
                            text: 'La calificación que intenta ingresar está fuera del rango válido.',
                            showConfirmButton: true,
                        });
                    }
                    /*
										condicion para no permitir que se modifique de aprobatoria a reprobatoria
										else if(cal_anterior>=70 && calificacion<70)
                    {
                        swal({
                            position:"",
                            type: "error",
                            title: "Error",
                            text: 'No puede colocar calificación reprobatoria, cuando previamente ya ha sido aprobado',
                            showConfirmButton: true,
                        });
                    }*/
                    else if(calificacion>0 && calificacion<70)
                    {
                        Swal({
                            title: 'Ingresó una calificación reprobatoria',
                            text: "¿Está seguro de que desea continuar?",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sí, continuar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.value) {
                                $.get('/servicios_escolares/modificaCalificacionSumativa',{id_evaluacion:id_evaluacion,calificacion:calificacion,id_materia:id_materia,docente:docente},function(request)
                                {
                                    swal({
                                        type: "success",
                                        title: "Registro exitoso",
                                        showConfirmButton: false,
                                        timer: 1500
                                    }). then(function(result)
                                    {
                                        location.reload(true);
                                    });
                                });
                            }
                        })
                    }
                    else
                    {
                        $.get('/servicios_escolares/modificaCalificacionSumativa',{id_evaluacion:id_evaluacion,calificacion:calificacion,id_materia:id_materia,docente:docente},function(request)
                        {
                            swal({
                                type: "success",
                                title: "Registro exitoso",
                                showConfirmButton: false,
                                timer: 1500
                            }). then(function(result)
                            {
                                location.reload(true);
                            });
                        });
                    }
                });
                @endforeach
            });
        </script>
    @endif

    </div>
@endsection