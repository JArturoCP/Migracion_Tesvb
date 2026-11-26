@extends('layouts.panel')
@section('title', 'Calificaciones')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Calificaciones" :migas="['Estudiantes' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <p>Nombre del alumno: {{ $datos_alumno->nombre }}  {{ $datos_alumno->apaterno }} {{ $datos_alumno->amaterno }}</p>
        </div>

    </div>

        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <button type="button" class="acta_materias tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Boleta de calificaciones</button>
            </div>
        </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:w-full tw:px-2">

                <div class="tw:w-full tw:lg:w-full tw:px-2">
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla-centrada tw:w-full tw-tabla tw:lg:w-full tw:px-2">
                        <thead class="tw:bg-brand-500 tw:text-white" >
                        <tr class="tw:border-2 tw:border-blue-500">
                            <th class="tw:text-center">MATERIA</th>
                            @for ($i = 0; $i < $mayor_unidades; $i++)
                                <th class="tw:text-center">
                                    {{($i==0 ? 'I' : ($i==1 ? 'II' :($i==2 ? 'III' :($i==3 ? 'IV' :($i==4 ? 'V' :($i==5 ? 'VI' :($i==6 ? 'VII' :($i==7 ? 'VIII' :($i==8 ? 'IX' :($i==9 ? 'X' :($i==10 ? 'XI' :($i==11 ? 'XII' :($i==12 ? 'XIII' :($i==13 ? 'XIV' :($i==14 ? 'XV' : ' ' )))))))))))))))}}
                                </th>
                            @endfor
                            <th class="tw:text-center">PROMEDIO</th>
                            <th class="tw:text-center"> T.E.</th>
                        </tr>
                        </thead>
                        <tbody class="tw:border-2 tw:border-blue-500">
                        <?php $promedio_sum=0; $num_materias=0;?>
                        @foreach($array_materias as $materias)
                            <?php $cont_res=0;?>
                            <?php $cont_res = 0; ?>
                            {{-- Solo sumar materias válidas que no sean Servicio Social --}}
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
                                        <td style="background: {{ $calificaciones['calificacion'] >= 70 ? '' : '#FFEE62' }}">
                                            {{ $calificaciones['calificacion'] >= 70 ? $calificaciones['calificacion'] : 'N.A' }}
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
                                <td style="background: {{ $materias['promedio'] >= 70 ? '' : '#a94442; color:white;' }}">
                                    {{ $materias['promedio'] >= 70 ? $materias['promedio'] : 'N.A' }}
                                </td>
                                <td>
                                    {!! $materias['curso'] == 'NORMAL' && $materias['esc_alumno'] ? 'ESC' :
                                    ($materias['curso'] == 'NORMAL' ? 'O' :
                                    ($materias['curso'] == 'REPETICION' && $materias['esc_alumno'] ? 'ESC2' :
                                    ($materias['curso'] == 'REPETICION' ? 'O2' :
                                    ($materias['curso'] == 'ESPECIAL' ? 'CE' :
                                    ($materias['curso'] == 'GLOBAL' ? 'EG' : ''))))) !!}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="1"></td>
                            <td colspan="{{ $mayor_unidades }}" class="tw:text-center"><strong>PROMEDIO</strong></td>
                            <?php $promedio_final = $num_materias > 0 ? ($promedio_sum / $num_materias) : 0;; ?>
                            <td>{{ number_format($promedio_final, 2, '.', '') }}</td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
</div>
                </div>
                <div class="tw:w-full tw:px-2">
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw:w-full tw-tabla tw-tabla-rayas tw:lg:w-full tw:px-2">
                        <thead class="tw:bg-brand-500 tw:text-white" >
                        <tr class="tw:border-2 tw:border-blue-500">
                            <th class="tw:w-full tw:lg:w-4/12 tw:px-2">DOCENTE</th>
                            <th class="tw:w-full tw:lg:w-7/12 tw:px-2">MATERIA</th>
                            <th class="tw:w-full tw:lg:w-1/12 tw:px-2">GRUPO</th>
                        </tr>
                        </thead>
                        <tbody class="tw:border-2 tw:border-blue-500">
                        @foreach($profesores as $profesor)
                            <tr>
                                <td>{{$profesor->nombre}}</td>
                                <td>{{$profesor->materias}}</td>
                                <td>{{$profesor->id_semestre}}0{{$profesor->grupo}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
</div>
                </div>

        </div>
    </div>

    <x-panel.modal id="modal_calificar_residencia" tamano="md" sin-relleno aria-labelledby="mySmallModalLabel">
                <form  method="POST" role="form" action="{{url("/servicios_escolares/historial_academico/alumno/residencia/".$id_alumno)}}">
                    {{ csrf_field() }}
                    <div class="tw-modal-cuerpo tw:pt-14">

                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
                            <div class="tw:w-full tw:px-2"><h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Calificar residencia</h3></div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
                            <div class="tw:w-full tw:px-2">
                                <label>Calificación</label>
                                <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  type="number" max="100" min="0" id="cal_residencia" name="cal_residencia"  required>
                            </div>

                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
                            <div class="tw:w-full tw:px-2">
                                <label>Fecha de termino</label>
                                <input class="datepicker tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  type="text"  id="fecha_residencia" name="fecha_residencia" data-flatpickr-date="d/m/Y"  placeholder="dd/MM/YYYY" required>
                            </div>
                        </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <input  type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Aceptar"></input>
                    </div>
                </form>
            </x-panel.modal>

    <x-panel.modal id="modal_acta_materias" tamano="md" sin-relleno aria-labelledby="mySmallModalLabel">
                    {{ csrf_field() }}
                    <div class="tw-modal-cuerpo tw:pt-14">

                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
                            <div class="tw:w-full tw:px-2"><h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Registrar datos</h3></div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="exampleInputEmail1">ELIGE TURNO<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg" >*</b></label>
                                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="turno" name="turno" required>
                                        <option disabled selected hidden>Selecciona una opción</option>
                                        @foreach($turnos as $turno)
                                            <option value="{{$turno->id_turno}}">{{$turno->turno}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="exampleInputEmail1">ELIGE SEMESTRE<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg" >*</b></label>
                                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="semestre" name="semestre" required>
                                        <option disabled selected hidden>Selecciona una opción</option>
                                        @foreach($semestres as $semestre)
                                            <option value="{{$semestre->id_semestre}}">{{$semestre->descripcion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="exampleInputEmail1">ELIGE GRUPO<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg" >*</b></label>
                                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="grupo" name="grupo" required>
                                        <option disabled selected hidden>Selecciona una opción</option>
                                        @foreach($grupos as $grupo)
                                            <option value="{{$grupo->id_grupo}}">{{$grupo->grupo}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <input  type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="abrir_pdf" value="Aceptar"></input>
                    </div>

            </x-panel.modal>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#abrir_pdf").click(function(event) {
                var turno = $("#turno").val();
                var semestre = $("#semestre").val();
                var grupo = $("#grupo").val();

                if (turno!= null && semestre != null && grupo != null) {


                    var link="/acta_materias/{{$id_alumno}}/"+turno+"/"+semestre+"/"+grupo;
                    window.open(link);
                    $('#modal_acta_materias').modal('hide');


                } else {
                    swal({
                        position: "top",
                        type: "error",
                        title: "hay un campo vacio",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }

            });

            $(".calificar_residencia").click(function(event) {

                $('#modal_calificar_residencia').modal('show');
            });
            $(".acta_materias").click(function(event) {

                $('#modal_acta_materias').modal('show');
            });


        });

    </script>
</div>
@endsection
