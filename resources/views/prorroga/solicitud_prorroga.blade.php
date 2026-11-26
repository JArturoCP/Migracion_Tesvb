@extends('layouts.panel')
@section('title', 'Solicitud de prórroga')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <main class="tw:w-full tw:lg:w-full tw:px-2">

        <x-panel.encabezado titulo="Solicitud de prórroga" :migas="['Prórrogas' => null]" />
        @if( $estado_periodo_prorroga == 0)
            <x-panel.alerta tipo="error" class="tw:mb-4"><?php  $fecha_inicial=date("d-m-Y ",strtotime($periodo_p->fecha_inicial)) ?>
                            <?php  $fecha_final=date("d-m-Y ",strtotime($periodo_p->fecha_final)) ?>
                            El periodo de solicitudes de prórroga es del {{ $fecha_inicial }} al {{ $fecha_final }} en el periodo {{ $periodo_p->periodo }}. Si estás dentro de las fechas de solicitud, verifica que esté seleccionado el periodo indicado. Puedes cambiarlo desde el icono del calendario en el menú.</x-panel.alerta>

            @else

        @if($estado_solicitud == 0 and $fecha > 0)
            <form id="form_solicitud_prorroga" action="{{url("/solicitud/enviar_solicitud_prorroga/".$id_alumno)}}"class="" role="form" method="POST">
                {{ csrf_field() }}
                <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><p>L. C. MA. ESTHER RODRIGUEZ GÓMEZ</p>
                                <p>DIRECTORA GENERAL DEL TECNOLÓGICO</p>
                                <p>DE ESTUDIOS SUPERIORES DE VALLE DE BRAVO</p>
                                <p><BR></p>
                                <p>El que suscribe <b>{{ $nombre_alumno }}</b> estudiante de la carrera de <b>{{ $carrera }}</b> con
                                    número de cuenta <b>{{$no_cuenta}}</b>, por este medio, se dirige a usted, para solicitar me autorice,
                                    la prórroga de pago de la colegiatura semestral al

                                    <select class="tw:text-gray-800 tw:dark:text-white/90 tw:bg-cyan-100 tw:text-gray-800" name="id_semestre" id="id_semestre"  size="1" required>
                                        <option disabled selected hidden>Selecciona semestre</option>
                                        @foreach($semestres as $semestre)

                                            <option value="{{$semestre->id_semestre}}" >{{$semestre->descripcion}}</option>

                                        @endforeach
                                        <?php  $fecha_ul=date("d/m/Y ",strtotime($periodo_p->fecha_ult_num)) ?>
                                    </select> semestre, mi compromiso es efectuar el depósito correspondiente  a más tardar el dia <b>{{$periodo_p->fecha_ultima}}</b>

                                    <input type='hidden' name="fecha_registrada"id="fecha_inicial" title="dd/mm/YYYY" placeholder="dd/mm/YYYY"  value="{{$fecha_ul}}" />
                                    <span class="fa fa-calendar"></span>.
                                    <br><br>Estoy consciente que de no realizar el trámite en la fecha pactada se procederá a la suspensión de mis derechos
                                    como estudiante y este mismo documento fungirá como solicitud de baja temporal.
                                    <br><br>Sin otro particular por el momento, agradezco la atención que se sirva dar a la presente solicitud.




                                </p>
                                <p><br><br></p>
                                <p class="tw:text-center" >ATENTAMENTE</p>
                                <p class="tw:text-center" >{{$nombre_alumno}}</p></h3>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                    <div class="m tw:w-full tw:px-2">
                        <button  type="button" id="enviar_prorroga" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Enviar solicitud</button>
                    </div>
                    <p class="tw:w-full"><br></p>
                </div>
            </form>


        @elseif($estado_solicitud == 1)
            <x-panel.alerta tipo="error" class="tw:mb-4"><br>Tu solicitud de prórroga se envió correctamente. <br><br></x-panel.alerta>

                <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><p>L. C. MA. ESTHER RODRIGUEZ GÓMEZ</p>
                                <p>DIRECTORA GENERAL DEL TECNOLÓGICO</p>
                                <p>DE ESTUDIOS SUPERIORES DE VALLE DE BRAVO</p>
                                <p><BR></p>
                                <p>El que suscribe <b>{{ $nombre_alumno }}</b> estudiante de la carrera de <b>{{ $carrera }}</b> con
                                    número de cuenta <b>{{$no_cuenta}}</b>, por este medio, se dirige a usted, para solicitar me autorice,
                                    la prórroga de pago de la colegiatura semestral al <b>{{$prorroga_solicitudes->semestre}}</b> semestre, mi compromiso es efectuar el depósito correspondiente  a más tardar el dia
                                  {{$prorroga_solicitudes->fecha_efectuar}}.
                                    <br><br>Estoy consciente que de no realizar el trámite en la fecha pactada se procederá a la suspensión de mis derechos
                                    como estudiante y este mismo documento fungirá como solicitud de baja temporal.
                                    <br><br>Sin otro particular por el momento, agradezco la atención que se sirva dar a la presente solicitud.




                                </p>
                                <p><br><br></p>
                                <p class="tw:text-center" >ATENTAMENTE</p>
                                <p class="tw:text-center" >{{$nombre_alumno}}</p></h3>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">


                    <p class="tw:w-full"><br></p>
                </div>

         @else
                <x-panel.alerta tipo="error" class="tw:mb-4"><?php  $fecha_inicial=date("d-m-Y ",strtotime($periodo_p->fecha_inicial)) ?>
                                <?php  $fecha_final=date("d-m-Y ",strtotime($periodo_p->fecha_final)) ?>
                                El periodo de solicitudes de prórroga es del {{ $fecha_inicial }} al {{ $fecha_final }} en el periodo {{ $periodo_p->periodo }}. Si estás dentro de las fechas de solicitud, verifica que esté seleccionado el periodo indicado. Puedes cambiarlo desde el icono del calendario en el menú.</x-panel.alerta>

        @endif
@endif




    </main>
    <script type="text/javascript">

        $(document).ready( function() {

            $("#enviar_prorroga").click(function(event) {
                var id_semestre = $("#id_semestre").val();
                if (id_semestre != null) {


                    $("#form_solicitud_prorroga").submit();
                    $("#enviar_prorroga").attr("disabled", true);

                } else {
                    swal({
                        position: "top",
                        type: "error",
                        title: "selecciona el semestre",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });

        });
    </script>
</div>
@endsection
