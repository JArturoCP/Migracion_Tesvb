@extends('layouts.panel')
@section('title', 'Calificaciones')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

    @php
        $numeros_romanos = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII','XIII','XIV','XV'];
    @endphp

    <x-panel.encabezado :titulo="'Registro de calificaciones de '.$nombre_alumno" :migas="['Cómputo' => null]" />

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla-centrada tw:w-full tw-tabla tw:lg:w-full tw:px-2">
                <thead class="tw:bg-sky-100">
                <tr class="tw:border-2 tw:border-blue-500">
                    <th class="tw:text-center">MATERIA</th>
                    @for ($i = 0; $i < $mayor_unidades; $i++)
                        <th class="tw:text-center">{{ $numeros_romanos[$i] ?? '' }}</th>
                    @endfor
                    <th class="tw:text-center">PROMEDIO</th>
                    <th class="tw:text-center">T.E.</th>
                    <th class="tw:text-center">Calificar</th>
                </tr>
                </thead>
                <tbody class="tw:border-2 tw:border-blue-500">
                <?php $promedio_sum=0; $num_materias=0;?>
                @foreach($array_materias as $materias)
                        <?php $cont_res = 0; ?>
                    @if($materias['id_materia'] != '2258')
                            <?php
                            $promedio_sum += $materias['promedio'];
                            $num_materias++;
                            ?>
                    @endif

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

                        @for ($i = 0; $i < ($mayor_unidades - $cont_res); $i++)
                            @if($materias['unidades'] <= ($cont_res + $i))
                                <td class="tw:bg-sky-100"></td>
                            @else
                                <td>0</td>
                            @endif
                        @endfor

                        <td>{{ $materias['promedio'] ?? 0 }}</td>

                        <td>
                            {!! $materias['curso'] == 'NORMAL' && $materias['esc_alumno'] ? 'ESC' :
                                ($materias['curso'] == 'NORMAL' ? 'O' :
                                ($materias['curso'] == 'REPETICION' && $materias['esc_alumno'] ? 'ESC2' :
                                ($materias['curso'] == 'REPETICION' ? 'O2' :
                                ($materias['curso'] == 'ESPECIAL' ? 'CE' :
                                ($materias['curso'] == 'GLOBAL' ? 'EG' : ''))))) !!}
                        </td>

                        <td class="tw:text-center">
                            <input type="button" class="calificar_dual tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" data-id_carga="{{ $materias['id_carga_academica'] }}" value="Calificar">
                        </td>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="1"></td>
                    <td colspan="{{ $mayor_unidades }}" class="tw:text-center"><strong>PROMEDIO</strong></td>
                    <?php $promedio = $promedio_sum / ($num_materias == 0 ? 1 : $num_materias); ?>
                    <td>{{ number_format($promedio, 2, '.', '') }}</td>
                    <td></td>
                </tr>
                </tbody>
            </table>
</div>
        </div>
    </div>

    <x-panel.modal id="modal_calificar_dual_actual" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                <form id="calificar_duales_actuales" class="" action="{{url("/registrar_cal_duales/")}}" method="POST">
                    {{ csrf_field() }}
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Calificar a estudiante dual</h4>
                    </div>
                    <div id="contenedor_cal_dual_actual"></div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                                <button id="calificacion_duales_actuales" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </x-panel.modal>

   <script type="text/javascript">
$(document).ready(function () {

    $(".calificar_dual").click(function () {

        var id_carga_academica = $(this).data("id_carga");

        $.get("/calificar_estudiante_duales_actuales/" + id_carga_academica, function (request) {

            $("#contenedor_cal_dual_actual").html(request);

            function bloquearUnidades() {

                let inputs = $("#contenedor_cal_dual_actual input.calificacion_unidad");

                inputs.each(function (index) {

                    if (index === 0) {

                        $(this).prop("disabled", false)
                                 .css("background-color", "#fff");

                    } else {

                        let anterior = inputs.eq(index - 1).val();

                        if (anterior !== "" && anterior != 0) {

                            $(this).prop("disabled", false)
                                     .css("background-color", "#fff");

                        } else {

                            $(this).prop("disabled", true)
                                     .css("background-color", "#e9ecef");

                        }
                    }

                });

            }

            bloquearUnidades();

            $("#contenedor_cal_dual_actual").off("input", "input.calificacion_unidad");

            $("#contenedor_cal_dual_actual").on("input", "input.calificacion_unidad", function () {

                bloquearUnidades();

            });

            $("#modal_calificar_dual_actual").modal('show');

        });

    });


    $("#calificacion_duales_actuales").click(function () {

        let permitir = true;

        let inputs = $("#contenedor_cal_dual_actual input.calificacion_unidad");

        inputs.each(function (index) {

            let valor = $(this).val();

            if (index > 0) {

                let anterior = inputs.eq(index - 1).val();

                if ((anterior === "" || anterior == 0) && valor > 0) {

                    permitir = false;

                    TNotify.alert("Debe calificar la unidad " + index + " antes de la unidad " + (index + 1));

                    return false;

                }

            }

        });

        if (permitir) {

            // ❗ evitar enviar unidades sin cambios
            inputs.each(function () {

                let valor = $(this).val();

                if (valor === "" || valor == 0) {

                    $(this).prop("disabled", true);

                }

            });

            $("#calificacion_duales_actuales").attr("disabled", true);

            $("#calificar_duales_actuales").submit();

        }

    });

});
</script>

</div>
@endsection