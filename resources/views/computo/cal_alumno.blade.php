@extends('layouts.app')
@section('title', 'Calificaciones')
@section('content')

    @php
        $numeros_romanos = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII','XIII','XIV','XV'];
    @endphp

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">
                        REGISTRO DE CALIFICACIONES DE <br> {{$nombre_alumno}}
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table class="table text-center col-md-12">
                <thead class="bg-info">
                <tr style="border: 2px solid #3097d1">
                    <th class="text-center">MATERIA</th>
                    @for ($i = 0; $i < $mayor_unidades; $i++)
                        <th class="text-center">{{ $numeros_romanos[$i] ?? '' }}</th>
                    @endfor
                    <th class="text-center">PROMEDIO</th>
                    <th class="text-center">T.E.</th>
                    <th class="text-center">Calificar</th>
                </tr>
                </thead>
                <tbody style="border: 2px solid #3097d1">
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

                        @for ($i = 0; $i < ($mayor_unidades - $cont_res); $i++)
                            @if($materias['unidades'] <= ($cont_res + $i))
                                <td class="bg-info"></td>
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

                        <td class="text-center">
                            <input style="width: 7em" type="button" class="btn btn-primary calificar_dual" data-id_carga="{{ $materias['id_carga_academica'] }}" value="Calificar">
                        </td>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="1"></td>
                    <td colspan="{{ $mayor_unidades }}" class="text-center"><strong>PROMEDIO</strong></td>
                    <?php $promedio = $promedio_sum / ($num_materias == 0 ? 1 : $num_materias); ?>
                    <td>{{ number_format($promedio, 2, '.', '') }}</td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modal_calificar_dual_actual" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="calificar_duales_actuales" class="form" action="{{url("/registrar_cal_duales/")}}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-header bg-info">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="myModalLabel">Calificar a estudiante dual</h4>
                    </div>
                    <div id="contenedor_cal_dual_actual"></div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button id="calificacion_duales_actuales" type="button" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

                    alert("Debe calificar la unidad " + index + " antes de la unidad " + (index + 1));

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

@endsection