@extends('layouts.panel')
@section('title', 'Historial académico')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado :titulo="'Historial académico '.$alumno" :migas="['Servicios escolares' => null]" />

    <x-panel.alerta tipo="error" class="tw:mb-4">@if($calificada == 1)
                        <br>Las materias de este periodo se tomarán en cuenta para el historial académico.

                    @elseif($calificada == 2)
                        <br>Las materias de este periodo no se tomarán en cuenta para el historial académico.

                    @endif</x-panel.alerta>
    @if($suma_mat == 0)
        <x-panel.alerta tipo="error" class="tw:mb-4">No hay materias registradas.</x-panel.alerta>
    @else
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                <button  class="pdf_historial tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Ver PDF</button>
                {{-- <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:text-center tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" onclick="window.open('{{url('/servicios_escolares/historial_academico/pdf_historial_academico/'.$id_alumno)}}')">Historial academico</button>
             --}}
            </div>
            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                <button  class="pdf_historial_excel tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Exportar a Excel</button>
                {{-- <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:text-center tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" onclick="window.open('{{url('/servicios_escolares/historial_academico/pdf_historial_academico/'.$id_alumno)}}')">Historial academico</button>
             --}}
            </div>
        </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">


                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" >
                    <thead>
                    <tr>
                        <th class="tw:text-center" >Sem.</th>
                        <th class="tw:text-center" >Clave</th>
                        <th class="tw:text-center" >Nombre de la materia</th>
                        <th class="tw:text-center" >Cr.</th>
                        <th class="tw:text-center" >Cal.</th>
                        <th class="tw:text-center" >Acr.</th>
                        <th class="tw:text-center" >Periodo</th>
                        <th class="tw:text-center" >Año</th>
                        <th class="tw:text-center" >Fec. Esp.</th>
                        <th class="tw:text-center" >Quitar materia duplicada</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($materias_actualizadas as $alumno)
                        <tr>
                            <td class="tw:text-center" >{{$alumno['id_semestre']}}</td>
                            <td class="tw:text-center" >{{$alumno['clave']}}</td>
                            <td class="tw:text-center" >{{$alumno['nombre_materia']}}</td>
                            <td class="tw:text-center" >{{$alumno['creditos']}}</td>
                            @if( $alumno['promedio'] < 70)
                                <td class="tw:text-center" >N. A.</td>
                            @else
                                <td>{{$alumno['promedio']}}</td>
                            @endif


                            <td class="tw:text-center" >{{$alumno['esc']}}</td>
                            <td class="tw:text-center" >{{$alumno['periodo']}}</td>
                            <td class="tw:text-center" >{{$alumno['year']}}</td>
                            <td> </td>
                            @if( $alumno['promedio'] < 70)
                                <td class="tw:text-center">
                                    <b><input type="button" class="quitar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap"
                                              data-id_carga="{{$alumno['id_carga_academica']}}"
                                              data-nombre_materia="{{$alumno['nombre_materia']}}"  value="Eliminar"></b>
                                </td>
                            @else
                                <td></td>
                            @endif

                        </tr>

                    @endforeach
                    @if($residencia ==0)
                    @else
                        <tr>
                            <td class="tw:text-center">9</td>
                            <td class="tw:text-center">RES-0001</td>
                            <td class="tw:text-center">RESIDENCIA PROFESIONAL</td>

                            @if($datos_residencia->calificacion< 70)
                                <td class="tw:text-center">0</td>
                                <td class="tw:text-center">N.A.</td>
                            @else
                                <td class="tw:text-center">10</td>
                                <td>{{$datos_residencia->calificacion}}</td>
                            @endif
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php  //$fecha_r=$datos_residencia->fecha_termino;
                            $num=$datos_residencia->fecha_termino;
                            $year =substr($num, 0,4);
                            $mes =substr($num, 5,2);
                            $dia =substr($num, 8,2);
                            $fecha_r= $dia.'/'.$mes.'/'.$year;
                            ?>
                            <td>{{$fecha_r}} </td>

                        </tr>

                    @endif
                    @if($servicio ==0)
                    @else
                        <tr>
                            <td class="tw:text-center">9</td>
                            <td class="tw:text-center">SSC-0001</td>
                            <td class="tw:text-center">SERVICIO SOCIAL</td>

                            @if($datos_servicio->calificacion < 70)
                                <td>0</td>
                                <td>N.A.</td>
                            @else
                                <td>10</td>
                                <td class="tw:text-center">{{$datos_servicio->calificacion}}</td>
                            @endif
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php  //$fecha_s=$datos_servicio->fecha_termino;
                            $num=$datos_servicio->fecha_termino;
                            $year =substr($num, 0,4);
                            $mes =substr($num, 5,2);
                            $dia =substr($num, 8,2);
                            $fecha_s= $dia.'/'.$mes.'/'.$year;
                            ?>
                           

                        </tr>

                    @endif
                    @if($actividades ==0)
                    @else
                        <tr>
                            <td class="tw:text-center">9</td>
                            <td class="tw:text-center">ACC-0001</td>
                            <td class="tw:text-center">ACTIVIDADES COMPLEMENTARIAS</td>
                            <td class="tw:text-center">5</td>
                            <td class="tw:text-center">ACA</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>

                    @endif

                    <tr>
                        <td class="tw:text-right tw:border-white tw:dark:border-gray-900" colspan="3" >Totales:</td>
                        <td>{{$contar_creditos}}</td>
                        <td>{{$promedio_f}}</td>
                    </tr>

                    </tbody>
                </table>
</div>
            </div>
        </div>



        @if($residencia ==0)
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    @if($verifi_reg_ante == 0)
                        @if($verificar_periodo_residencia == 0)
                            <x-panel.alerta tipo="advertencia" class="tw:mb-4">
                                <strong>¡Atención!</strong>El estudiante no tiene registro de residencia en sus cargas academicas
                            </x-panel.alerta>
                        @else
                            <x-panel.alerta tipo="advertencia" class="tw:mb-4">
                                <strong>¡Atención!</strong>El estudiante dio de alta su residencia en el o en los periodos:
                                @foreach($verificar_periodo_residencia as $per)
                                    {{ $per->periodo }},
                                @endforeach
                                <input type="button" class="calificar_residencia tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-id_carga="{{$id_alumno}}"   value="Calificar">
                            </x-panel.alerta>
                        @endif

                    @else
                        <x-panel.alerta tipo="advertencia" class="tw:mb-4">
                            <strong>¡Atención!</strong><br> El estudiante esta en proceso de seguimiento de residencia en el periodo {{ $periodo_seguimiento }}
                        </x-panel.alerta>
                    @endif
                </div>
            </div>
        @endif
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                @if($actividades ==0 )
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" Style="background: white;">
                        <thead>
                        <tr>
                            <th class="tw:text-center">Nombre</th>
                            <th class="tw:text-center">Calificación</th>
                            <th class="tw:text-center">Estado</th>

                        </tr>
                        </thead>
                        <tbody>
                        @if($actividades ==0)
                            <tr>
                                <td class ='text-center'> Actividades complementarias</td>

                                <td class="tw:text-center">0</td>
                                <td class="tw:text-center"><input type="button" class="calificar_actividades tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" data-id_carga="{{$id_alumno}}"   value="Calificar"></td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
</div>
                @endif
            </div>

        </div>
    @endif
    <x-panel.alerta tipo="exito" class="tw:mb-4">Materias eliminadas del historial</x-panel.alerta>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" Style="background: white;">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Clave</th>
                    <th>Nombre de la materia</th>
                    <th>Semestre</th>
                    <th>Periodo</th>
                    <th>Nombre del periodo</th>
                    <th>Fecha de eliminación</th>
                    <th>Volver a agregar al historial</th>
                </tr>
                </thead>
                <tbody>
                <?php $num=0; ?>
                @foreach($mat_eliminadas as $mat)
                    <?php $num++; ?>
                    <tr>
                        <td>{{$num}} </td>
                        <td>{{ $mat->clave }} </td>
                        <td>{{ $mat->nombre }} </td>
                        <td>{{ $mat->id_semestre }} </td>
                        <td>{{ $mat->id_periodo }} </td>
                        <td>{{ $mat->periodo }} </td>
                        <td>{{ $mat->fecha }} </td>
                        <td class="tw:text-center"><input type="button" class="agregar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" data-id_carga="{{$mat->id_carga_academica}}"  data-nombre_materia="{{$mat->nombre}}"  value="Agregar "></td>

                    </tr>
                @endforeach
                </tbody>
            </table>
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
                                <label>Fecha de término</label>
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

    <x-panel.modal id="modal_calificar_servicio" tamano="md" sin-relleno aria-labelledby="mySmallModalLabel">
                <form  method="POST" role="form" action="{{url("/servicios_escolares/historial_academico/alumno/servicio_social/".$id_alumno)}}">
                    {{ csrf_field() }}
                    <div class="tw-modal-cuerpo tw:pt-14">

                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2"><h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Calificar servicio social</h3></div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
                            <div class="tw:w-full tw:px-2">
                                <label>Calificación</label>
                                <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  type="number" max="100" min="0" id="cal_servicio" name="cal_servicio"  required>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
                            <div class="tw:w-full tw:px-2">
                                <label>Fecha de término</label>
                                <input class="datepicker tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  type="text"  id="fecha_servicio" name="fecha_servicio" data-flatpickr-date="d/m/Y"  placeholder="dd/MM/YYYY" required>
                            </div>
                        </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <input  type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Aceptar"></input>
                    </div>
                </form>
            </x-panel.modal>

    <x-panel.modal id="modal_calificar_actividades" tamano="md" sin-relleno aria-labelledby="mySmallModalLabel">
                <form  method="POST" role="form" action="{{url("/servicios_escolares/historial_academico/alumno/actividades/".$id_alumno)}}">
                    {{ csrf_field() }}
                    <div class="tw-modal-cuerpo tw:pt-14">

                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2"><h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Calificar actividades complementarias</h3></div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
                            <div class="tw:w-full tw:px-2">
                                <label>¿El estudiante ya acreditó las actividades complementarias? Si es así, selecciona «Aceptar».</label>
                            </div>
                        </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <input  type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Aceptar"></input>
                    </div>
                </form>
            </x-panel.modal>

    <x-panel.modal id="modal_pdf_historial" tamano="md" sin-relleno aria-labelledby="mySmallModalLabel">
                <form  method="POST" role="form" action="window.open('{{url('/servicios_escolares/historial_academico/pdf_historial_academico/'.$id_alumno)}}')">
                    {{ csrf_field() }}
                    <div class="tw-modal-cuerpo tw:pt-14">

                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2"><h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Historial académico</h3></div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="exampleInputEmail1">Elige especialidad<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg" >*</b></label>
                                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="Selecciona una opción" id="especialidad" name="especialidad" required>
                                        <option disabled selected hidden>Selecciona una opción</option>
                                        @foreach($especialidad as $especialidad)
                                            <option value="{{$especialidad->especialidad}}">{{$especialidad->especialidad}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="exampleInputEmail1">Elige plan<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg" >*</b></label>
                                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="Selecciona una opción" id="plan" name="plan" required>
                                        <option disabled selected hidden>Selecciona una opción</option>
                                        @foreach($plan as $plan)
                                            <option value="{{$plan->plan}}">{{$plan->plan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <input  type="button" class="link_pdf tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Aceptar"></input>
                    </div>
                </form>
            </x-panel.modal>

    <x-panel.modal id="modal_enviar" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">
                <form action="{{url("/servicios_escolares/historial_academico/alumno/eliminar/")}}" method="POST" role="form" >
                    <div class="tw-modal-cuerpo tw:pt-14">

                        {{ csrf_field() }}
                        ¿Realmente deseas quitar la materia  <input type="button" id="nombre_materia" name="nombre_materia" value=""> del historial académico?
                        <input type="hidden" id="id_carga_academica" name="id_carga_academica" value="">

                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <input  type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Aceptar"/>
                    </div>
                </form>
            </x-panel.modal>

    <x-panel.modal id="modal_agregar_nuevamente" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">
                <form action="{{url("/servicios_escolares/historial_academico/alumno/agregar_nuevamente/")}}" method="POST" role="form" >
                    <div class="tw-modal-cuerpo tw:pt-14">

                        {{ csrf_field() }}
                        ¿Realmente deseas agregar nuevamente la materia  <input type="button" id="nombre_materia_l" name="nombre_materia_l" value=""> al historial académico?
                        <input type="hidden" id="id_carga_academica_l" name="id_carga_academica_l" value="">

                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <input  type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Aceptar"/>
                    </div>
                </form>
            </x-panel.modal>
    {{--Excel historial--}}
    <x-panel.modal id="modal_pdf_historial_excel" tamano="md" sin-relleno aria-labelledby="mySmallModalLabel">

                <div class="tw-modal-cuerpo tw:pt-14">

                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2"><h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Historial académico en Excel</h3></div>
                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4">
                                <label for="exampleInputEmail1">Elige especialidad<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg" >*</b></label>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="Selecciona una opción" id="especialidad2" name="especialidad2" required>
                                    <option disabled selected hidden>Selecciona una opción</option>
                                    @foreach($especialidad2 as $especialidades)
                                        <option value="{{$especialidades->id_especialidad }}">{{$especialidades->especialidad}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4">
                                <label for="exampleInputEmail1">Elige plan<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg" >*</b></label>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="Selecciona una opción" id="plan2" name="plan2" required>
                                    <option disabled selected hidden>Selecciona una opción</option>
                                    @foreach($plan2 as $planes)
                                        <option value="{{$planes->id_plan}}">{{$planes->plan}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                    <input  type="button" class="link_excel tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Aceptar"></input>
                </div>

            </x-panel.modal>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".link_excel").click(function (){
                var especialidad2 = $("#especialidad2").val();
                var plan2 = $("#plan2").val();
                if (especialidad2 != null && plan2 != null) {


                    var link="/servicios_escolares/historial_academico/excel_historial_academico/{{$id_alumno}}/"+plan2+"/"+especialidad2+"/{{$calificada}}";
                    window.open(link);
                    $('#modal_pdf_historial_excel').modal('hide');


                } else {
                    swal({
                        position: "top",
                        type: "error",
                        title: "Hay un campo vacío.",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }

            });
            $(".link_pdf").click(function(event) {
                var especialidad = $("#especialidad").val();
                var plan = $("#plan").val();

                if (especialidad != null && plan != null) {


                    var link="/servicios_escolares/historial_academico/pdf_historial_academico/{{$id_alumno}}/"+plan+"/"+especialidad+"/{{$calificada}}";
                    window.open(link);
                    $('#modal_pdf_historial').modal('hide');


                } else {
                    swal({
                        position: "top",
                        type: "error",
                        title: "Hay un campo vacío.",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }

            });
            $('#tablas_alumnos').DataTable();
            $(".pdf_historial").click(function(event) {

                $('#modal_pdf_historial').modal('show');
            });
            $(".calificar_residencia").click(function(event) {

                $('#modal_calificar_residencia').modal('show');
            });
            $(".calificar_servicio").click(function(event) {

                $('#modal_calificar_servicio').modal('show');
            });
            $(".calificar_actividades").click(function(event) {

                $('#modal_calificar_actividades').modal('show');
            });
            $(".quitar").click(function(event) {

                var id_carga_academica=$(this).data("id_carga");
                var nombre_materia=$(this).data("nombre_materia");

                $('#id_carga_academica').val(id_carga_academica);
                $('#nombre_materia').val(nombre_materia);
                $('#modal_enviar').modal('show');
            });

            $(".agregar").click(function(event) {

                var id_carga_academica=$(this).data("id_carga");
                var nombre_materia=$(this).data("nombre_materia");
                $('#id_carga_academica_l').val(id_carga_academica);
                $('#nombre_materia_l').val(nombre_materia);
                $('#modal_agregar_nuevamente').modal('show');
            });
            $(".pdf_historial_excel").click(function (){
                $('#modal_pdf_historial_excel').modal('show');
            });

        });

    </script>
</div>
@endsection