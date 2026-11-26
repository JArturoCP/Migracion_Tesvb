@extends('layouts.panel')
@section('title', 'Evaluaciones Sumativas')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Registro de calificaciones" :migas="['Jefatura de división' => null]" />
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
                        <label for="" class="tw:w-full tw:lg:w-full tw:text-right tw:px-2">

                            <input type="{{  ($calificada_sumativa==1 ? 'button' : 'hidden') }}" class="tooltip-options link tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="link_genera_pdf" name="link_genera_pdf" data-toggle="tooltip" data-placement="top" title="Generar acta de calificaciones" target="_blank" value="Imprimir PDF">
                            <input type="{{  ($calificada_sumativa==1 ? 'button' : 'hidden') }}"class="tooltip-options link tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-sky-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-sky-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" id="link_genera_pdf_jc" name="link_genera_pdf_jc" data-toggle="tooltip" data-placement="top" title="Generar acta de calificaciones" target="_blank" value="Imprimir PDF con nuevo responsable">
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

                                                        <tr class="tw:text-center tw:text-gray-800 tw:dark:text-white/90 tw:bg-gray-200 tw:dark:bg-gray-700">
                                                            <th rowspan="2" class="tw:text-center tw:align-middle"></th>
																<th rowspan="2" class="tw:text-center tw:align-middle">NP</th>
																<th rowspan="2" class="tw:text-center tw:align-middle">No. CTA</th>
																<th rowspan="2" class="tw:text-center tw:align-middle">Nombre del estudiante</th>
																<th colspan="{{ $unidades+2 }}" class="tw:text-center">UNIDADES</th>
														</tr>
														<tr>
																@for ($i = 0; $i < $unidades; $i++)
																		<th class="tw:text-center">
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
												</thead>
                        <tbody>
                        <?php  $porcentaje_gen=0; $cont_gen=0;?>
                        @foreach($alumnos as $alumno)
                            <tr class="tw:text-center">
                                @if($alumno['estado_validacion'] == 9)
                                    <td class="tw:text-center tw:bg-sky-600 tw:text-white">A. Dual--></td>
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
                                <?php  $cont=0;?>
                                @forelse($alumno['calificaciones'] as $calificacion)
                                    <?php  $cont++;?>
                                    @if(($cont)<=$unidades)
                                        @if( ($cont)==$calificacion['id_unidad'])

																					@if($alumno['especial_bloq']==1)
																						<td class="tw:bg-yellow-200 tw:text-gray-800">N.A</td>
																					@else
																							@if($esc_pormateria)
																									<td style="background: {{ $calificacion['calificacion']>=70 ? ' ' : '#FFEE62' }}">{{$calificacion['calificacion'] >= 70 ? $calificacion['calificacion'] : "N.A"}}</td>
																							@else
      	                                          @if($calificacion['calificacion']<70 && $calificacion['esc'])
																											<td><input id="error_{{$calificacion['id_evaluacion']}}" type="text" class="calificacion_sumativa tw:text-center tw:w-28 tw:rounded tw:bg-yellow-200 tw:text-gray-800" value="{{$calificacion['calificacion']}}" data-id="{{$alumno['id_carga_academica']}}" data-id-unidad="{{ $calificacion['id_unidad'] }}" name="calificacion_sumativa" data-id-eval="{{ $calificacion['id_evaluacion'] }}"></td>
																									@else
																											<td style="background: {{ $calificacion['calificacion']>=70 ? ' ' : '#FFEE62' }}">{{$calificacion['calificacion']}}</td>
            	                                    @endif
                                              @endif
																					@endif
                                        @else

                                        @endif
                                    @else

                                    @endif
                                @empty


                                @endforelse
                                    @if($alumno['estado_validacion'] ==10)

                                        <?php $comparar=$unidades-1; ?>
                                        @if($cont == $comparar )
                                        @else
                                            @for($i=0; $i<=$comparar-$cont;$i++)
                                                <td class="tw:bg-yellow-200 tw:text-gray-800">N.A</td>
                                            @endfor
                                        @endif
                                    @endif
                                <?php  $porcentaje_gen+=$alumno['repeticion'] == false ? '1' : '0'; $cont_gen++;?>
                                    @if($alumno['estado_validacion'] ==10)
                                        <td class="tw:bg-red-700 tw:text-white">BAJA</td>
                                        @else
                                @if($alumno['promedio']>=70 and $alumno['repeticion'] == false)
                                    <td class="tw:bg-white tw:dark:bg-white/[0.03]" >{{ $alumno['promedio'] }}</td>
                                @else
                                    <td class="tw:bg-red-700 tw:text-white">N.A</td>
                                @endif
                                    @endif
                                    <td>{!! $alumno['curso']=='NORMAL' && $alumno['esc_alumno'] ? 'ESC'  : ( $alumno['curso']=='NORMAL' ? 'O'  : ($alumno['curso']=='REPETICION' && $alumno['esc_alumno'] ? 'ESC2' : ($alumno['curso']=='REPETICION' ? 'O2' : ($alumno['curso']=='ESPECIAL' ? 'CE' : ($alumno['curso']=='GLOBAL' ? 'EG': '' )))))!!}</td>
                            </tr>
                        @endforeach
                        <tr>
                            @if($calificada_sumativa ==0)
                            <td colspan="{{4+($cont ?? 0)}}"></td>
                            <td class="tw:text-center" ><input type="button" class="tooltip-options link tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" id="guardar_cal" name="guardar_cal" data-token="{{ csrf_token() }}" data-id_unidad="unidades" data-toggle="tooltip" data-placement="top" title="Guardar evaluación sumativa" value="guardar" ></td>
                           @endif
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                            @foreach($porcentajes as $porcentaje)
                                <td class="tw:text-center" style="background: {{ $porcentaje['porcentaje']>=70 ? '#3c763d' : '#a94442' }}; color: #ffffff">{{ round($porcentaje['porcentaje'],2) }}%</td>
                            @endforeach

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
            $("#link_genera_pdf").click(function(event) {
                var link="/generar_pdf_sumativas?id_docente="+ {{ $id_docente }} +"&id_materia="+ {{ $id_materia }} +"&unidades="+ {{ $unidades }}+"&id_grupo="+ {{ $id_grupo }}+"";
                window.open(link);
            });
            $("#link_genera_pdf_jc").click(function(event) {
                var link="/generar_pdf_sumativas/jc?id_docente="+ {{ $id_docente }} +"&id_materia="+ {{ $id_materia }} +"&unidades="+ {{ $unidades }}+"&id_grupo="+ {{ $id_grupo }}+"&nomjefe={{ Session::get('nombre') }}";
                window.open(link);
            });
            $("#guardar_cal").click(function ()
            {
                var calificaciones= { alumno:[] };
                var token=$(this).data("token");
                cal_noValida=false;
                cal_reprobatoria=false;
                var cal_rep=0;
                $(".calificacion_sumativa").each(function () {
                    var id_carga_academica=$(this).data("id");
                    var calificacion=$(this).val();
                    var id_unidad=$(this).data("id-unidad");
                    var id_eval=$(this).data("id-eval");
                    document.getElementById("error_"+id_eval).style.backgroundColor = "white";
                    document.getElementById("error_"+id_eval).style.color = "black";
                    if(calificacion<0 || calificacion>100 || !/^([0-9])*$/.test(calificacion))
                    {
                        cal_noValida=true;
                        document.getElementById("error_"+id_eval).style.color = "white";
                        document.getElementById("error_"+id_eval).style.backgroundColor = "#cd4545";
                    }
                    else if(calificacion>=0 && calificacion<70)
                    {
                        cal_reprobatoria=true;
                        cal_rep++;
                        document.getElementById("error_"+id_eval).style.color = "white";
                        document.getElementById("error_"+id_eval).style.backgroundColor = "#f3a333";
                    }
                    calificaciones.alumno.push({
                        "id_eval" : id_eval,
                        "calificacion" : calificacion,
                        "id_unidad" : id_unidad
                    });
                });
                var data_cal = JSON.stringify(calificaciones);
                if(cal_noValida)
                {
                    swal({
                        type: "error",
                        title: "Existen calificaciones erroneas",
                        text: 'las calificaciones erroneas estan marcadas en rojo',
                        showConfirmButton: true,
                    });
                }
                else
                {
                    if(cal_reprobatoria)
                    {
                        //pide confirmacion
                        Swal({
                            title: 'Ingreso '+(cal_rep==1 ? ''+cal_rep+' calificación reprobatoria': ''+cal_rep+' calificaciones reprobatorias'),
                            text: "¿Esta seguro que desea continuar?",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, continuar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.value) {
                                $("#guardar_cal").attr("disabled", true);
                                $.post('/docente/acciones/{{ $id_docente }}/{{ $id_materia }}/{{ $id_grupo }}/sumativas',{_token:token,calificaciones:data_cal},function(request)
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
                        $("#guardar_cal").attr("disabled", true);
                        $.post('/docente/acciones/{{ $id_docente }}/{{ $id_materia }}/{{ $id_grupo }}/sumativas',{_token:token,calificaciones:data_cal},function(request)
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
                }
            });
        });
    </script>
</div>
@endsection
