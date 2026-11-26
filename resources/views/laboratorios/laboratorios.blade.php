@extends('layouts.panel')
@section('title', 'Laboratorios')
@include('partials.panel.recursos_app', ['datepicker' => true, 'validacion' => true])
@section('content')
<div class="tw-pantalla">
    <main class="tw:w-full tw:lg:w-full tw:px-2">

        <x-panel.encabezado :titulo="'Horario del '.$laboratorio->descripcion.' del '.$fecha_1.' al '.$fecha_2" :migas="['Laboratorios' => null]" />
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                <a href="/pdf-lab-horarios/{{ $laboratorio->id_laboratorio }}/{{ $fecha_inicial }}/{{ $fecha_final }}"
                   target="_blank" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">
                    <span class="fa fa-print"></span> Imprimir
                </a>
            </div>
            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-toggle="modal" data-target="#consultar_lab">Consultar otro laboratorio</button>
            </div>
        </div>

        <x-panel.modal id="consultar_lab" tamano="md" sin-relleno clase-cerrar="close">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Consultar otro laboratorio</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <div class="tw:mb-4">
                                        <label for="laboratorio">Laboratorios</label>
                                        <select name="laboratorio" id="laboratorio" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" >
                                            <option  disabled selected hidden>Selecciona Laboratorio</option>
                                            @foreach($lab as $lab)
                                                @if($lab->id_laboratorio==$laboratorio->id_laboratorio)
                                                    <option value="{{$lab->id_laboratorio}}" selected="selected">{{$lab->descripcion}}</option>
                                                @else
                                                    <option value="{{$lab->id_laboratorio}}" >{{$lab->descripcion}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="deparamento">Selecciona fecha Inicial</label>
                                    <div class='date tw:flex tw:w-full tw:items-stretch' data-date-format="yyyy/mm/dd" id='datetimepicker11' >
                                        <input type='text' id="fecha_inicial" value="{{ $fecha_inicial }}" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required />
                                        <span class="input-group-addon tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-3 tw:text-sm tw:text-gray-600 tw:dark:text-gray-400">
                                        <span class="fa fa-calendar">
                                     </span>
                                    </span>
                                    </div>
                                </div>

                                <script type="text/javascript">
                                    $(function () {
                                        $('#datetimepicker11').datepicker({
                                            daysOfWeekDisabled: [0,2,3,4,5,6],
                                            autoclose: true,
                                            language: 'es'
                                        });
                                    });

                                </script>
                            </div>
                            <div class="tw:w-full" id="mostrar_fecha_f" >
                                <div class="tw:w-full tw:lg:w-5/12 tw:px-2">
                                    <label for="fecha final">Fecha final</label>
                                    <div id="soli" class="tw:mb-4">
                                        <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="fecha_final" disabled value="{{ $fecha_final }}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button id="guardar_solicitud" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Mostrar</button>
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal"> Cerrar</button>

                    </div>
                </x-panel.modal>

        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">

                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_enviado" class="tw-tabla-centrada tw-tabla tw-tabla-bordes">
                    <thead>
                    <tr>
                        <th>Hora/Día</th>
                        <th style>Lunes <br> {{$fecha_1}}</th>
                        <?php $nueva1 = strtotime ( '+1 day' , strtotime ( $fecha_inicial ) ) ;
                        $nueva1 = date ( 'd-m-Y' , $nueva1 );?>
                        <th>Martes <br> {{$nueva1}}</th>
                        <?php $nueva2 = strtotime ( '+2 day' , strtotime ( $fecha_inicial ) ) ;
                        $nueva2 = date ( 'd-m-Y' , $nueva2 );?>
                        <th>Miercoles <br>{{$nueva2}}</th>
                        <?php $nueva3 = strtotime ( '+3 day' , strtotime ( $fecha_inicial ) ) ;
                        $nueva3 = date ( 'd-m-Y' , $nueva3 );?>
                        <th>Jueves <br> {{$nueva3}}</th>
                        <?php $nueva4 = strtotime ( '+4 day' , strtotime ( $fecha_inicial ) ) ;
                        $nueva4 = date ( 'd-m-Y' , $nueva4 );?>
                        <th>Viernes <br> {{$nueva4}}</th>
                        <?php $nueva5 = strtotime ( '+5 day' , strtotime ( $fecha_inicial ) ) ;
                        $nueva5 = date ( 'd-m-Y' , $nueva5 );?>
                        <th>Sabado<br> {{$nueva5}}</th>


                    </tr>
                    </thead>
                    <tbody>
                    <?php $contador=1 ?>

                    @foreach($semanas as $semana)
                        @if($contador==1)
                            <tr>
                                <td class="horario">{{ $semana->hora }}</td>
                                @endif
                                <td id="{{ $semana->id_semana }}" class="horario">
                                    @foreach($array_laboratorios as $horario)
                                        @if($horario['id_semana']==$semana->id_semana)
                                            @if($horario['ofp'] ==2)
                                                <div class="tw:bg-brand-500 tw:text-white">{{$horario['nombre']}}<br>{{$horario['carrera']}}</div>
                                                <a class="eliminar_profesor tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" id="{{ $horario['registro']}}"><span class="fa fa-trash " aria-hidden="true"></span></a>

                                            @elseif($horario['ofp'] == 3)
                                                <div>  <button class="agregar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" id="{{ $horario['id_semana'] }}"><span class="fa fa-plus" aria-hidden="true"></span></button>
                                                    <button class="profesor tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" id="{{ $horario['id_semana'] }}"><span class="fa fa-plus" aria-hidden="true"></span></button>
                                                </div>
                                            @elseif($horario['ofp'] == 4)
                                                <div class="tw:bg-sky-100">{{$horario['nombre']}}<br>{{$horario['carrera']}}</div>
                                                <a class="eliminar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" id="{{ $horario['registro']}}"><span class="fa fa-trash " aria-hidden="true"></span></a>
                                            @endif



                                        @endif
                                    @endforeach

                                </td>


                                <?php $contador++?>
                                @if($contador==7)
                                <?php $contador=1 ?>
                                </td>


                            </tr>
                        @endif

                    @endforeach


                    </tbody>
                </table>
</div>
            </div>
        </div>

{{--registrar  en un periodo --}}

            <x-panel.modal id="modal_profesor_periodo" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                            
                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">REGISTRAR EN PERIODO</h4>
                        </div>
                        <form id="form_registrar_profesor" action="{{url("/laboratorios/registrar/profesor/materia")}}" class="" role="form" method="POST">
                        <div class="tw-modal-cuerpo">
                            <div id="contenedor_profesor_periodo">
                            </div>
                        </div>
                        </form>
                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="guardar_profesor">Agregar</button>
                        </div>
                    </x-panel.modal>


        {{-- Modal para agragegar comicionados EN FECHA DETERMINADA--}}
        <form id="form_registrar" action="{{url("/laboratorios/registrar")}}" class="" role="form" method="POST">
            <x-panel.modal id="modal_agregar" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                            
                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">REGISTRAR EN FECHA DETERMINADA</h4>
                        </div>
                        <div class="tw-modal-cuerpo">
                            <div id="contenedor_agregar">

                            </div>

                        </div>
                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="guardar">Agregar</button>
                        </div>
                    </x-panel.modal>
        </form>
    </main>
    <x-panel.modal id="modal_eliminado" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">
                <form action="" method="POST" role="form" id="form_delete"><div class="tw-modal-cuerpo tw:pt-14">
                    
                        {{method_field('DELETE') }}
                        {{ csrf_field() }}
                        ¿Realmente deseas eliminar éste elemento?
                </div>
                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                    <input id="confirma_eliminado" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Aceptar"></input>
                </div>
                </form>
            </x-panel.modal>
    <x-panel.modal id="modal_eliminado_profesor" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">
                <form action="" method="POST" role="form" id="form_delete_profesor"><div class="tw-modal-cuerpo tw:pt-14">
                    
                        {{method_field('DELETE') }}
                        {{ csrf_field() }}
                        ¿Realmente deseas eliminar éste elemento?
                </div>
                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                    <input id="confirma_eliminado_profesor" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Aceptar"></input>
                </div>
                </form>
            </x-panel.modal>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
    <script type="text/javascript">

        $(document).ready( function() {
            $("#guardar_solicitud").click(function (event) {
                var laboratorio=$("#laboratorio").val();
                var fecha_i=$("#fecha_inicial").val();
                var fecha_f=$("#fecha_final").val();
                var fecha_inicial = fecha_i.split("/").reverse().join("-");
                var fecha_final = fecha_f.split("/").reverse().join("-");

                if(fecha_i== "")
                {
                    swal({
                        position: "top",
                        type: "warning",
                        title: "El campo fecha esta vacio.",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }else{
                    window.location.href='/laboratorios/mostrar/'+laboratorio+'/'+fecha_inicial+'/'+fecha_final ;
                }


            });
            $("#laboratorio").change(function() {
                $("#mostrar").css("display", "inline");
            });
            $("#datetimepicker11").change(function(e){
                $("#mostrar_fecha_f").css("display", "inline");
                var fech= e.target.value;
                var TuFecha = new Date(fech);
                var dias = 5;
                //nueva fecha sumada
                TuFecha.setDate(TuFecha.getDate() + dias);
                //formato de salida para la fecha
                var  resultado = TuFecha.getFullYear() + '/' +
                    (TuFecha.getMonth() + 1) + '/' + TuFecha.getDate();
                $('#soli').empty();
                $('#soli').append('<input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="fecha_final" disabled value="'+resultado+'"/>');
                // TNotify.alert(resultado);

            });


        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            sumaFecha = function(d, fecha)
            {
                var Fecha = new Date();
                var sFecha = fecha || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
                var sep = sFecha.indexOf('/') != -1 ? '/' : '-';
                var aFecha = sFecha.split(sep);
                var fecha = aFecha[2]+'/'+aFecha[1]+'/'+aFecha[0];
                fecha= new Date(fecha);
                fecha.setDate(fecha.getDate()+parseInt(d));
                var anno=fecha.getFullYear();
                var mes= fecha.getMonth()+1;
                var dia= fecha.getDate();
                mes = (mes < 10) ? ("0" + mes) : mes;
                dia = (dia < 10) ? ("0" + dia) : dia;
                var fechaFinal = dia+sep+mes+sep+anno;
                return (fechaFinal);
            }
            $("#table_enviado").on('click','.agregar',function(){
                var idof=$(this).attr('id');


                var fecha_inicial1 = "<?php  echo $fecha_inicial;?>";
                var info = fecha_inicial1.split('-');
                var fec1= info[2] + '/' + info[1] + '/' + info[0];

              var  fecha_inicial=fec1;



                if( idof <=15){

                    var resultado= fecha_inicial;
                }
                if( idof >15 && idof <=30){
                    var TuFecha =fecha_inicial;

                    var dias = 1;
                    //nueva fecha sumada

                    var  resultado =  sumaFecha(dias,TuFecha);


                }
                if( idof >30 && idof <=45){
                    var TuFecha = fecha_inicial;

                    var dias = 2;
                    var  resultado =  sumaFecha(dias,TuFecha);

                }
                if( idof >45 && idof <=60){
                    var TuFecha = fecha_inicial;
                    var dias = 3;
                    var  resultado =  sumaFecha(dias,TuFecha);
                }
                if( idof >60 && idof <=75){
                    var TuFecha = fecha_inicial;
                    var dias = 4;
                    var  resultado =  sumaFecha(dias,TuFecha);
                }
                if( idof >75 && idof <=90){
                    var TuFecha = fecha_inicial;
                    var dias = 5;
                    var  resultado =  sumaFecha(dias,TuFecha);

                }
                $('#id_semana').val(idof);
                var res = resultado.split('/').reverse().join('-');;

              //  $('#fecha_registro').val(res);
              //  $('#modal_agregar').modal('show');  

                /********/
                var id_semana=idof;
                var fecha_registro=res;

                $.get("/laboratorios/reg_lab_fecha/"+id_semana+"/{{$laboratorio->id_laboratorio}}/"+fecha_registro,function (request) {
                    $("#contenedor_agregar").html(request);
                    $("#modal_agregar").modal('show');
                });
                /**************/
            });
            $("#table_enviado").on('click','.profesor',function(){
                var id_semana_profesor=$(this).attr('id');

                $.get("/laboratorios/verificacion_dia_lab/"+id_semana_profesor+"/{{$laboratorio->id_laboratorio}}",function (request) {
                    $("#contenedor_profesor_periodo").html(request);
                    $("#modal_profesor_periodo").modal('show');
                });
               // TNotify.alert(id_semana_profesor);

            });
            $("#guardar").click(function (event) {
                $("#form_registrar").submit();
            });
            $("#form_registrar").validate({
                rules: {

                    personal: "required",
                    descripcion: "required",



                },
            });
            $("#guardar_profesor").click(function (event) {
                $("#form_registrar_profesor").submit();
            });
            $("#form_registrar_profesor").validate({
                rules: {

                    personal: "required",
                    descripcion: "required",



                },
            });
            $("#table_enviado").on('click','.eliminar',function() {
                var id = $(this).attr('id');
                $('#confirma_eliminado').data('id',id);
                $('#modal_eliminado').modal('show');
            });
            $("#confirma_eliminado").click(function(event){
                var id=($(this).data('id'));
                $("#form_delete").attr("action","/laboratorios/eliminar/"+id)
                $("#form_delete").submit();
            });

            $("#table_enviado").on('click','.eliminar_profesor',function() {
                var id = $(this).attr('id');
                $('#confirma_eliminado_profesor').data('id',id);
                $('#modal_eliminado_profesor').modal('show');
            });
            $("#confirma_eliminado_profesor").click(function(event){
                var id=($(this).data('id'));
                $("#form_delete_profesor").attr("action","/laboratorios/eliminar/profesores/"+id)
                $("#form_delete_profesor").submit();
            });
        });
    </script>
</div>
@endsection