@extends('layouts.panel')
@section('title', 'Estímulo al Desempeño escolar')
@push('cabeza')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}?v=11.26.25">
    <script src="{{ asset('js/sweetalert2.min.js') }}?v=11.26.25"></script>
    <style>
        .beca-calificaciones .tw-tabla .beca-materia {
            text-align: left;
        }
        .beca-calificaciones .tw-tabla-desplazable:focus-visible {
            outline: 3px solid #465fff;
            outline-offset: -3px;
        }
        .dark .beca-calificaciones .tw-tabla-desplazable:focus-visible {
            outline-color: #a4bcfd;
        }
    </style>
@endpush

@section('content')
    <div class="tw:min-w-0 tw:space-y-4">
        <x-panel.encabezado titulo="Solicitud del Estímulo al Desempeño Escolar" />

        @if($alta_carga == 0)
            @if($periodo_beca == 0)
                <x-panel.alerta tipo="advertencia">
                    <p class="tw:font-semibold">El periodo de solicitud de Estimulo al Desempeño Escolar fue o sera del {{ $peri->fecha_inicial }} al  {{ $peri->fecha_final }} del periodo {{$peri->periodo}} </p>
                </x-panel.alerta>
            @endif
            <x-panel.alerta tipo="advertencia">
                <p class="tw:font-semibold">Tu carga académica aún no está autorizada.</p>
            </x-panel.alerta>
        @else

            @if($estado_beca == 0)
                @if($periodo_beca == 0)
                    <x-panel.alerta tipo="advertencia">
                        <p class="tw:font-semibold">El periodo de solicitud de Estimulo al Desempeño Escolar fue o sera del {{ $peri->fecha_inicial }} al  {{ $peri->fecha_final }} del periodo {{$peri->periodo}} </p>
                    </x-panel.alerta>
                @else
                    <x-panel.tarjeta>
                        <p class="tw:font-semibold">REQUISITOS PARA ESTUDIANTE CON UNA CONDICIÓN DE VULNERABILIDAD: <br></p>

                        @if($vulnerabilidad->id_estado == 1)
                            <p>
                                <b>a) Ser madre de familia:</b> Para este caso se deberá entregar la siguiente documentación:<br>
                                I. Copia del acta de nacimiento de los hijos.
                            </p>
                            <p>En caso de que te declares como un estudiante con una condición de vulnerabilidad tal como se establece en el articulo 3 de estos criterios, deberas presentar la documentaciòn oficial que justifique dicha condición en la Subdirección de Estudios Profesionalesen las fechas señaladasen la convocatoria.
                            </p>
                        @endif

                        @if($vulnerabilidad->id_estado == 2)
                            <p>

                                <b>b)Tener una discapacidad:</b> Para este  se debera entregar  la siguiente documentación:<br>
                                I. Constancia emitida por una institución gubernamental competente que determine la condición de discapacidad.
                            </p>
                            <p>En caso de que te declares como un estudiante con una condición de vulnerabilidad tal como se establece en el articulo 3 de estos criterios, deberas presentar la documentaciòn oficial que justifique dicha condición en la Subdirección de Estudios Profesionales en las fechas señaladas en la convocatoria.
                            </p>
                        @endif
                        <div class="tw:mt-3">
                            <b> Requisitos para el 100 % descuento:</b><br><br>
                            - Ser alumno regular:<br>
                            -Tu promedio debe ser mayor a 90 y menor a 100 si ninguna sumativa<br>
                            <br>

                            <b>Requisitos para el 50 % descuento:</b><br><br>
                            - Ser alumno regular:<br>
                            -Tu promedio debe ser mayor a 85 a 89 sin sumativa o tambien contar con un promedio de 90 a 100 con una evaluacion sumativa.<br><br>
                            <b>Nota importante: Antes de enviar tu solicitud, selecciona el semestre que cursaste</b>
                        </div>
                    </x-panel.tarjeta>

                    @if($estado_estimulo == 1 )

                        @if($descuento_estimulo==4)
                            <x-panel.alerta tipo="error">
                                <p class="tw:font-semibold">No cumples con los requisitos.</p>
                            </x-panel.alerta>
                        @elseif($descuento_estimulo==1)
                            <x-panel.tarjeta>
                                <p class="tw:font-semibold">NO.CUENTA: {{$datosalumno[0]->cuenta }} <br>
                                    NOMBRE DEL ESTUDIANTE: {{$datosalumno[0]->nombre}} {{$datosalumno[0]->apaterno}}  {{$datosalumno[0]->amaterno}}<br>
                                    PROGRAMA DE ESTUDIOS: {{$datosalumno[0]->carrera}}<br>
                                    CURP: {{$datosalumno[0]->curp_al}}</p>
                            </x-panel.tarjeta>
                            <x-panel.alerta tipo="exito">
                                <p class="tw:font-semibold">El porcentaje del estímulo es del 100 %.</p>
                            </x-panel.alerta>
                            <x-panel.select etiqueta="Elige el semestre que cursaste *" id="id_semestre" name="id_semestre">
                                <option  disabled selected hidden>Selecciona semestre</option>
                                @foreach($semestres as $semestre)
                                    <option value="{{$semestre->id_semestre}}">{{$semestre->descripcion}}</option>
                                @endforeach

                            </x-panel.select>
                            <x-panel.boton id="enviar" type="button" title="Enviar" class="tw:w-full tw:sm:w-auto">Enviar solicitud</x-panel.boton>

                        @elseif($descuento_estimulo==2)
                            <x-panel.tarjeta>
                                <p class="tw:font-semibold">NO.CUENTA: {{$datosalumno[0]->cuenta }} <br>
                                    NOMBRE DEL ESTUDIANTE: {{$datosalumno[0]->nombre}} {{$datosalumno[0]->apaterno}}  {{$datosalumno[0]->amaterno}}<br>
                                    PROGRAMA DE ESTUDIOS: {{$datosalumno[0]->carrera}}<br>
                                    CURP: {{$datosalumno[0]->curp_al}}</p>
                            </x-panel.tarjeta>
                            <x-panel.alerta tipo="exito">
                                <p class="tw:font-semibold">El porcentaje del estímulo es del 50 %.</p>
                            </x-panel.alerta>
                            <x-panel.select etiqueta="Elige el semestre que cursaste *" id="id_semestre" name="id_semestre">
                                <option  disabled selected hidden>Selecciona semestre</option>
                                @foreach($semestres as $semestre)
                                    <option value="{{$semestre->id_semestre}}">{{$semestre->descripcion}}</option>
                                @endforeach

                            </x-panel.select>
                            <x-panel.boton id="enviar" type="button" title="Enviar" class="tw:w-full tw:sm:w-auto">Enviar solicitud</x-panel.boton>
                        @elseif($descuento_estimulo==3)
                            <x-panel.tarjeta>
                                <p class="tw:font-semibold">NO.CUENTA: {{$datosalumno[0]->cuenta }} <br>
                                    NOMBRE DEL ESTUDIANTE: {{$datosalumno[0]->nombre}} {{$datosalumno[0]->apaterno}}  {{$datosalumno[0]->amaterno}}<br>
                                    PROGRAMA DE ESTUDIOS: {{$datosalumno[0]->carrera}}<br>
                                    CURP: {{$datosalumno[0]->curp_al}}</p>
                            </x-panel.tarjeta>
                            <x-panel.alerta tipo="exito">
                                <p class="tw:font-semibold">El porcentaje del estímulo es del 50 %.</p>
                            </x-panel.alerta>
                            <x-panel.select etiqueta="Elige el semestre que cursaste *" id="id_semestre" name="id_semestre">
                                <option  disabled selected hidden>Selecciona semestre</option>
                                @foreach($semestres as $semestre)
                                    <option value="{{$semestre->id_semestre}}">{{$semestre->descripcion}}</option>
                                @endforeach

                            </x-panel.select>
                            <x-panel.boton id="enviar" type="button" title="Enviar" class="tw:w-full tw:sm:w-auto">Enviar solicitud</x-panel.boton>

                        @endif

                        <x-panel.tarjeta titulo="Calificaciones por materia" class="beca-calificaciones">
                            <x-panel.tabla compacta class="tw-tabla-centrada" desplazable="Calificaciones por materia" aria-label="Calificaciones por materia">
                                <thead>
                                    <tr>
                                        <th scope="col">SEMESTRE</th>
                                        <th scope="col" class="beca-materia">MATERIA</th>
                                        @for ($i = 0; $i < $mayor_unidades; $i++)
                                            <th scope="col">
                                                {{($i==0 ? 'I' : ($i==1 ? 'II' :($i==2 ? 'III' :($i==3 ? 'IV' :($i==4 ? 'V' :($i==5 ? 'VI' :($i==6 ? 'VII' :($i==7 ? 'VIII' :($i==8 ? 'IX' :($i==9 ? 'X' :($i==10 ? 'XI' :($i==11 ? 'XII' :($i==12 ? 'XIII' :($i==13 ? 'XIV' :($i==14 ? 'XV' : ' ' )))))))))))))))}}
                                            </th>
                                        @endfor
                                        <th scope="col">PROMEDIO</th>
                                        <th scope="col"> T.E.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $promedio_sum=0; $num_materias=0;?>
                                    @foreach($array_materias as $materias)
                                        <?php $cont_res=0;?>
                                        <tr>
                                            @if($materias['id_semestre'] ==1)
                                                <td>PRIMERO</td>
                                            @elseif($materias['id_semestre'] ==2)
                                                <td>SEGUNDO</td>
                                            @elseif($materias['id_semestre'] ==3)
                                                <td>TERCERO</td>
                                            @elseif($materias['id_semestre'] ==4)
                                                <td>CUARTO</td>
                                            @elseif($materias['id_semestre'] ==5)
                                                <td>QUINTO</td>
                                            @elseif($materias['id_semestre'] ==6)
                                                <td>SEXTO</td>
                                            @elseif($materias['id_semestre'] ==7)
                                                <td>SEPTIMO</td>
                                            @elseif($materias['id_semestre'] ==8)
                                                <td>OCTAVO</td>
                                            @elseif($materias['id_semestre'] ==9)
                                                <td>NOVENO</td>
                                            @elseif($materias['id_semestre'] ==10)
                                                <td>DECIMO</td>
                                            @elseif($materias['id_semestre'] ==11)
                                                <td>ONCEAVO</td>
                                            @elseif($materias['id_semestre'] ==12)
                                                <td>DOCEAVO</td>
                                            @elseif($materias['id_semestre'] ==13)

                                            @endif
                                            <th scope="row" class="beca-materia">{{ $materias['materia'] }}</th>
                                            @foreach($materias['calificaciones'] as $calificaciones)
                                                @if($calificaciones != null)
                                                    <td>
                                                        <x-panel.badge tono="{{ $calificaciones['calificacion']>=70 ? 'gris' : 'advertencia' }}">{{ $calificaciones['calificacion']>=70 ? $calificaciones['calificacion'] : 'N.A'  }}</x-panel.badge>
                                                    </td>
                                                    <?php $cont_res++; ?>
                                                @else
                                                @endif
                                            @endforeach
                                            @for ($i = 0; $i < ($mayor_unidades-$cont_res); $i++)
                                                @if($materias['unidades'] <= ($cont_res+$i) )
                                                    <td class="tw:bg-gray-50 tw:dark:bg-gray-800"></td>
                                                @else
                                                    <td>0</td>
                                                @endif
                                            @endfor
                                            @if( $materias['reprobada'] == true || $materias['promedio'] < 70)
                                                <td><x-panel.badge tono="error">N.A</x-panel.badge></td>
                                            @else
                                                <td>{{$materias['promedio']}}</td>
                                            @endif
                                            <?php $materias['promedio'] !=0 ? $promedio_sum+=$materias['promedio']  : 0 ; $num_materias++; ?>
                                            <td>{!! $materias['curso']=='NORMAL' && $materias['esc_alumno'] ? 'ESC'  : ( $materias['curso']=='NORMAL' ? 'O'  : ($materias['curso']=='REPETICION' && $materias['esc_alumno'] ? 'ESC2' : ($materias['curso']=='REPETICION' ? 'O2' : ($materias['curso']=='ESPECIAL' ? 'CE' : ($materias['curso']=='GLOBAL' ? 'EG': '' )))))!!}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="1"></td>
                                        <td colspan="{{$mayor_unidades+1}}"><strong>PROMEDIO</strong></td>
                                        <td>{{$promedio_final }}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </x-panel.tabla>
                        </x-panel.tarjeta>
                    @endif
                @endif

            @else
                <x-panel.tarjeta>
                    <p class="tw:font-semibold">NO.CUENTA: {{$datosalumno[0]->cuenta }} <br>
                        NOMBRE DEL ESTUDIANTE: {{$datosalumno[0]->nombre}} {{$datosalumno[0]->apaterno}}  {{$datosalumno[0]->amaterno}}<br>
                        PROGRAMA DE ESTUDIOS: {{$datosalumno[0]->carrera}}<br>
                        SEMESTRE: {{$registro_estado->semestre}}<br>
                        CURP: {{$datosalumno[0]->curp_al}}</p>
                    PROMEDIO: {{ $registro_estado->promedio }}
                </x-panel.tarjeta>
                @if($registro_estado->id_estado == 1 || $registro_estado->id_estado == 3)
                    <x-panel.alerta tipo="advertencia">
                        <p class="tw:font-semibold">
                            Se envio correctamente tu solicitud, del
                            @if($registro_estado->id_descuento == 1)
                                100 %,
                            @elseif($registro_estado->id_descuento == 2)
                                50 %,
                            @elseif($registro_estado->id_descuento == 3)
                                50 %
                            @endif
                            a la Subdirección de Servicio Escolares.
                            Espera la publicacion de resultados en la fechas programadas.
                        </p>

                    </x-panel.alerta>

                @elseif($registro_estado->id_estado == 2)
                    <x-panel.alerta tipo="error">
                        <p class="tw:font-semibold">
                            Tu solicitud fue rechazada.
                        </p>

                    </x-panel.alerta>

                @elseif($registro_estado->id_estado == 4)
                    <x-panel.alerta tipo="error">
                        <p class="tw:font-semibold">
                            Tu solicitud fue rechazada.
                        </p>

                    </x-panel.alerta>
                @elseif($registro_estado->id_estado == 5)
                    <x-panel.alerta tipo="exito">
                        <p class="tw:font-semibold">
                            Felicidades. Tu solicitud fue autorizada, del
                            @if($registro_estado->id_descuento == 1)
                                100 % DE DESCUENTO.
                            @elseif($registro_estado->id_descuento == 2)
                                50 % DE DESCUENTO.
                            @elseif($registro_estado->id_descuento == 3)
                                50 % DE DESCUENTO.
                            @endif
                        </p>

                    </x-panel.alerta>
                @endif

            @endif

        @endif
    </div>
    <script type="text/javascript">
        $(document).ready(function()
        {
            $("#enviar").click(function(event) {
                var id_semestre = $("#id_semestre").val();
                if(id_semestre != null) {
                    $("#enviar").attr("disabled", true);
                    window.location.href = '/beca_estimulo/enviar_solicitud/{{$datosalumno[0]->id_alumno}}/{{$descuento_estimulo}}/{{$promedio_final}}/' + id_semestre;

                }else{
                    swal({
                        position: "top",
                        type: "error",
                        title: "No elegiste el semestre",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
        });
    </script>

@endsection
