@extends('layouts.panel')
@section('title', 'Calificaciones')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado :titulo="'Registro de calificaciones de '.$nombre_alumno" :migas="['Educación dual' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">
            <input type="{{ ($calificar_dual==0 ? 'button' : 'hidden') }}" class="tooltip-options tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="cal_dual" name="cal_duales" data-toggle="tooltip" data-placement="top" title="Terminar calificar dual" target="_blank" value="Terminar de calificar dual">

            @if($calificar_dual == 1)
                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" onclick="window.open('{{url('/acta_dual_actual/'.$id_alumno.'/'.$id_periodo)}}')">
                    Acta dual
                <span class="fa fa-print"></span>
                </button>
            @endif
        </div>
    </div>
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
                    @if($calificar_dual == 0)
                        <th class="tw:text-center">Calificar</th>
                    @endif

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
                        @if($calificar_dual == 0)
                            <td class="tw:text-center"><input type="button" class="calificar_dual tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" data-id_carga="{{$materias['id_carga_academica']}}"   value="Calificar"></td>
                        @endif
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

    <x-panel.modal id="modal_calificar_dual_actual" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                <form id="calificar_duales_actuales" class=""  action="{{url("/registrar_cal_duales/")}}" role="form" method="POST" >
                    {{ csrf_field() }}
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Calificar a estudiante dual</h4>
                    </div>
                    <div id="contenedor_cal_dual_actual">

                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar <span class="fa fa-times-circle"></span></button>
                                <button  id="calificacion_duales_actuales" type="button"   class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar <span class="fa fa-check"></span></button>
                            </div>
                        </div>
                    </div>
                </form>
            </x-panel.modal>
    <x-panel.modal id="modal_termino_calificar_dual" tamano="md" sin-relleno aria-labelledby="mySmallModalLabel">
                <form action="" method="POST"  role="form" id="form_termino_calificar_actuales">
                    {{ csrf_field() }}
                    <!-- Agrega un input hidden para mentor con valor null cuando no esté presente -->
                    <input type="hidden" name="mentor" value="{{ $mentor ?? null }}">

                    <div class="tw-modal-cuerpo tw:pt-14 tw:text-center">
                        <b>¿Ya terminó de evaluar al estudiante dual?</b>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar <span class="fa fa-times-circle-o"></span></button>
                        <button id="confirma_termino_dual" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Aceptar <span class="fa fa-download"></span></button>
                    </div>
                </form>
            </x-panel.modal>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".calificar_dual").click(function (event) {
                var id_carga_academica = $(this).data("id_carga");
                // TNotify.alert(id_carga_academica);
                $.get("/calificar_estudiante_duales_actuales/" + id_carga_academica, function (request) {
                    $("#contenedor_cal_dual_actual").html(request);
                    $("#modal_calificar_dual_actual").modal('show');
                });
            });
            $("#calificacion_duales_actuales").click(function(event){
                $("#calificacion_duales_actuales").attr("disabled", true);
                $("#calificar_duales_actuales").submit();
            });
            $("#modificar_mentor").click(function(event) {

                $('#modal_modificar_mentor').modal('show');
            });
            $("#cal_dual").click(function(event) {

                //TNotify.alert("HOLA");
                $('#modal_termino_calificar_dual').modal('show');
            });
            $("#confirma_termino_dual").click(function(event){
                var id_alumno="{{ $id_alumno }}";
                var id_periodo="{{ $id_periodo }}";
                $("#form_termino_calificar_actuales").attr("action","/terminar_calificar/duales_actuales/"+id_alumno+"/"+id_periodo)
                $("#form_termino_calificar_actuales").submit();
                //$("#confirma_termino_dual").attr("disabled", true);
            });
        });
    </script>
</div>
@endsection