@extends('layouts.panel')
@section('title', 'Docentes en Plantilla')
@include('partials.panel.recursos_app', ['blockui' => true, 'graficas' => true])
@section('content')

    <script>
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            e.target // newly activated tab
            e.relatedTarget // previous active tab
        })
    </script>

    <div id="contenedor_horarios">

    </div>

    <main class="tw:w-full tw:lg:w-full tw:px-2">

        <?php $jefe_division=session()->has('jefe_division')?session()->has('jefe_division'):false;
        $directivo=session()->has('directivo')?session()->has('directivo'):false;
        $consultas=session()->has('consultas')?session()->has('consultas'):false; ?>

        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                        <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">PLANTILLA</h3>
                    </div>
                    <div class="tw:grid tw:grid-cols-1 tw:gap-4 tw:p-5 tw:sm:grid-cols-2 tw:sm:p-6">
                        @if($directivo==1 ||$consultas==1)
                            <input type="hidden" id="tipo" name="tipo" value="1">
                            <div class="tw:min-w-0">
                                <div class="dropdown">
                                    <label for="dropdownMenu1">Carrera</label>
                                    <select name="selectCarrera" id="selectCarrera" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                        <option disabled selected>Selecciona carrera...</option>
                                        @foreach($carreras as $carrera)
                                            @if($carrera->id_carrera==$id_carrera)
                                                <option value="{{$id_carrera}}" selected="selected">{{$carrera->nombre}}</option>
                                            @else
                                                <option value="{{$carrera->id_carrera}}" >{{$carrera->nombre}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @if(isset($ver))
                                <div class="tw:min-w-0" id="div_cargo">
                                    <div class="dropdown-center">
                                        <label for="selectCargo">Cargo</label>
                                        <select name="selectCargo" id="selectCargo" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                            <option disabled selected>Selecciona cargo...</option>
                                            @foreach($cargos as $cargo)
                                                @if($cargo->id_cargo==$id_cargo)
                                                    <option value="{{$cargo->id_cargo}}" selected="selected">{{$cargo->cargo}}</option>
                                                @else
                                                    <option value="{{$cargo->id_cargo}}" >{{$cargo->cargo}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @else
                                <div class="tw:min-w-0" id="div_cargo" style="display:none;">
                                    <div class="dropdown-center">
                                        <label for="selectCargo">Cargo</label>
                                        <select name="selectCargo" id="selectCargo" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                            <option disabled selected>Selecciona cargo...</option>
                                            @foreach($cargos as $cargo)
                                                <option value="{{$cargo->id_cargo}}" >{{$cargo->cargo}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                        @else
                            <input type="hidden" id="tipo" name="tipo" value="2">
                            <div class="tw:min-w-0" id="div_cargo">
                                <div class="dropdown-center">
                                    <label for="selectCargo">Cargo</label>
                                    <select name="selectCargo" id="selectCargo" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                        <option disabled selected>Selecciona cargo...</option>
                                        @foreach($cargos as $cargo)
                                            @if($cargo->id_cargo==$id_cargo)
                                                <option value="{{$cargo->id_cargo}}" selected="selected">{{$cargo->cargo}}</option>
                                            @else
                                                <option value="{{$cargo->id_cargo}}" >{{$cargo->cargo}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @if(isset($ver))
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="contenedor_p">
                    <div class="tw:w-full tw:lg:w-11/12 tw:px-2" >
                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tabla-grande tw-tabla tw-tabla-bordes">
                            <tr>
                                <th>Nombre</th>
                                <th>Asignatura</th>
                                <th>Actividad</th>
                                <th>No. Grupos</th>
                                <th>NO. HORAS X ASIGNATURA</th>
                                <th>TOTAL HORAS X ASIGNATURA</th>
                                <th>TOTAL HORAS DOCENTE</th>
                                <th>RFC</th>
                                <th>CLAVE ISSEMYM</th>
                                <th>FECHA INGRESO TESVB</th>
                                <th>FECHA NUEVO C.</th>
                                <th>PERFIL</th>
                                <th>OBSERVACIONES</th>
                            </tr>

                            @foreach($docentes as $docente)
                                <?php
                                $num_col=count($docente["materias"]);
                                $first=true;
                                ?>
                                @foreach($docente["materias"] as $dat_materia)

                                    @if($first)
                                        <?php $first=false;?>
                                        <tr>
                                            <td class="horario_prof" id="{{ $docente["id_personal"]}}" rowspan="{{ $num_col }}" valign="middle">{{ $docente["nombre"]}}</td>

                                            <td>{{ $dat_materia['nombre_materia'] }}</td>
                                            <td>{{ $dat_materia['actividad'] }}</td>
                                            <td>{{ $dat_materia['no_grupos'] }}</td>
                                            <td>{{ $dat_materia['horas_totales'] }}</td>
                                            <td>{{ $dat_materia['total'] }}</td>
                                            <td id="{{ $docente["id_personal"]}}" class="graficas" rowspan="{{ $num_col }}">{{ $docente["f_total"]}}</td>
                                            <td rowspan="{{ $num_col }}">{{ $docente["rfc"]}}</td>
                                            <td rowspan="{{ $num_col }}">{{ $docente["clave"]}}</td>
                                            <td rowspan="{{ $num_col }}">{{ $docente['fch_ingreso_tesvb'] }}</td>
                                            <td rowspan="{{ $num_col }}">
                                                @if($fecha_nuevo > $docente['fch_ingreso_tesvb'])
                                                    {{ $fecha_nuevo }}
                                                @else
                                                {{ $docente['fch_ingreso_tesvb'] }}
                                                @endif
                                            </td>
                                            <td rowspan="{{ $num_col }}">{{ $docente["descripcion"]}}</td>
                                            <td rowspan="{{ $num_col }}">{{ $docente["observaciones"] }}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>{{ $dat_materia['nombre_materia'] }}</td>
                                            <td>{{ $dat_materia['actividad'] }}</td>
                                            <td>{{ $dat_materia['no_grupos'] }}</td>
                                            <td>{{ $dat_materia['horas_totales'] }}</td>
                                            <td>{{ $dat_materia['total'] }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </table>
</div>
                    </div>

                    <div class="tw:w-full tw:lg:w-3/12 tw:lg:ml-[41.6667%] tw:px-2">
                        TOTAL HORAS PLANTILLA: {{ $total_plantilla }}
                    </div>
                </div>
                <br>
                <div class="regis tw:w-full tw:lg:w-1/12 tw:lg:ml-[41.6667%] tw:px-2">
                    <a href="/excel_plantilla/{{ $id_carrera }}/{{ $id_cargo }}" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" target="_blank"><span class="fa fa-print"  aria-hidden="true"></span>   Imprimir</a>
                </div>
            <!--<div class="cont tw:w-full tw:lg:w-2/12 tw:px-2">
  <a href="/pdf_plantilla/{{ $id_cargo }}" class="crear tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" target="_blank"><span class="fa fa-print"  aria-hidden="true"></span> Imprimir</a>
                        </div>-->
            @endif
        </div>



        <!-- Modal para ver graficas -->
        <x-panel.modal id="modal_graficas" tamano="lg" sin-relleno clase-cerrar="close" id-cerrar="acepta2" aria-labelledby="myModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="myModalLabel">HISTORIAL DE HORAS DOCENTE</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        {{ csrf_field() }}
                        <input type="hidden" id="prof" name="prof" value="">
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-4/12 tw:lg:ml-[33.3333%] tw:px-2">
                                <div class="dropdown">
                                    <select name="selectCiclo" id="selectCiclo" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                        <option disabled selected>Selecciona ciclo...</option>
                                        <option value="1" >{{ "Marzo-Agosto" }}</option>
                                        <option value="2" >{{ "Septiembre-Febrero" }}</option>
                                    </select>
                                </div>
                            </div>
                            <div id="contenedor_graficas">

                            </div>
                        </div>
                    </div>
                    <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button id="acepta" type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Aceptar</button>
                    </div>
                
            
        </x-panel.modal>

    </main>



    <script>
        function bloqueo()
        {
            $.blockUI({
            });
        }

        $(document).ready(function() {

            $(".horario_prof").click(function()
            {
                $("#contenedor_horarios").empty();
                var id=$(this).attr('id');

                $.get("/plantilla/horario/"+id,function(request)
                {
                    $("#contenedor_horarios").html(request);
                });
            });

            $(".graficas").click(function()
            {
                var idp=$(this).attr('id');
                $('#selectCiclo').data('idp',idp);
                $('#modal_graficas').modal('show');
            });

            $("#selectCiclo").on('change',function(e)
            {
                bloqueo();
                var idp=($(this).data('idp'));
                var idc= $("#selectCiclo").val();

                $("#contenedor_graficas").empty();
                $.get("/graficas/"+idp+"/"+idc,function(request)
                {
                    $("#contenedor_graficas").html(request);
                    $.unblockUI();
                });
            });

            $("#acepta").click(function()
            {
                $("#contenedor_graficas").empty();
                $('#selectCiclo').val($('#selectCiclo > option:first').val());
            });
            $("#acepta2").click(function()
            {
                $("#contenedor_graficas").empty();
                $('#selectCiclo').val($('#selectCiclo > option:first').val());
            });

            $("#selectCarrera").on('change',function(e){
                $("#div_cargo").show(1000);
                $('#selectCargo').val($('#selectCargo > option:first').val());
                $("#contenedor_p").hide();

            });

            $("#selectCargo").on('change',function(e){
                bloqueo();
                var tipo=$("#tipo").val();
                if(tipo==1)//directivo
                {
                    var id_carrera= $("#selectCarrera").val();
                    var id_cargo= $("#selectCargo").val();
                    window.location.href='/plantilla/datos/'+id_carrera +'/'+id_cargo;
                    $.unblockUI();
                }
                else if(tipo==2)
                {
                    bloqueo();
                    var id_carrera=0;
                    var id_cargo= $("#selectCargo").val();
                    window.location.href='/plantilla/datos/'+id_carrera +'/'+id_cargo;
                    $.unblockUI();
                }

            });
        });

    </script>

@endsection
