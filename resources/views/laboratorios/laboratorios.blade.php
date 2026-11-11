@extends('layouts.app')
@section('title', 'Laboratorios')
@section('content')
    <main class="col-md-12">

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class=" text-center">Horario del <b>{{$laboratorio->descripcion}}</b> del <?php  $fecha_1=date("d-m-Y ",strtotime($fecha_inicial)) ?><?php  $fecha_2=date("d-m-Y ",strtotime($fecha_final)) ?> {{$fecha_1}} al {{$fecha_2}}  </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-md-offset-5">
                <a href="/pdf-lab-horarios/{{ $laboratorio->id_laboratorio }}/{{ $fecha_inicial }}/{{ $fecha_final }}"
                   target="_blank" class="btn btn-warning btn-lg">
                    <span class="glyphicon glyphicon-print"></span> Imprimir
                </a>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#consultar_lab">Consultar otro laboratorio</button>
            </div>
        </div>

        <div class="modal fade" id="consultar_lab" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Consultar otro laboratorio</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="form-group">
                                    <div class="dropdown">
                                        <label for="laboratorio">Laboratorios</label>
                                        <select name="laboratorio" id="laboratorio" class="form-control " >
                                            <option  disabled selected hidden>Selecciona Laboratorio</option>
                                            @foreach($lab as $lab)
                                                @if($lab->id_laboratorio==$laboratorio->id_laboratorio)
                                                    <option value="{{$lab->id_laboratorio}}" selected="selected">{{$lab->descripcion}}</option>
                                                @else
                                                    <option value="{{$lab->id_laboratorio}}" >{{$lab->descripcion}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="deparamento">Selecciona fecha Inicial</label>
                                    <div class='input-group date' data-date-format="yyyy/mm/dd" id='datetimepicker11' >
                                        <input type='text' id="fecha_inicial" value="{{ $fecha_inicial }}" class="form-control" required />
                                        <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar">
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
                            <div id="mostrar_fecha_f" >
                                <div class="col-md-5">
                                    <label for="fecha final">Fecha final</label>
                                    <div id="soli" class="form-group">
                                        <input class="form-control" id="fecha_final" disabled value="{{ $fecha_final }}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="guardar_solicitud" class="btn btn-primary">Mostrar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> Cerrar</button>

                    </div>
                </div>

            </div>
        </div>

        <br>
        <br>
        <div class="row">
            <div class="col-md-11 col-md-offset-1">

                <table id="table_enviado" class="table table-bordered text-center" style="table-layout:fixed;">
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
                                <td class="horario" style="size: 20px">{{ $semana->hora }}</td>
                                @endif
                                <td id="{{ $semana->id_semana }}" class="horario">
                                    @foreach($array_laboratorios as $horario)
                                        @if($horario['id_semana']==$semana->id_semana)
                                            @if($horario['ofp'] ==2)
                                                <div class="bg-primary">{{$horario['nombre']}}<br>{{$horario['carrera']}}</div>
                                                <a class="eliminar_profesor" id="{{ $horario['registro']}}"><span class="glyphicon glyphicon-trash em2" aria-hidden="true"></span></a>

                                            @elseif($horario['ofp'] == 3)
                                                <div class="">  <button class="btn btn-success agregar" id="{{ $horario['id_semana'] }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                                    <button class="btn btn btn-primary profesor" id="{{ $horario['id_semana'] }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                                </div>
                                            @elseif($horario['ofp'] == 4)
                                                <div class="bg-info">{{$horario['nombre']}}<br>{{$horario['carrera']}}</div>
                                                <a class="eliminar" id="{{ $horario['registro']}}"><span class="glyphicon glyphicon-trash em2" aria-hidden="true"></span></a>
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

{{--registrar  en un periodo --}}

            <div class="modal fade bs-example-modal-lg" id="modal_profesor_periodo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog " role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">REGISTRAR EN PERIODO</h4>
                        </div>
                        <form id="form_registrar_profesor" action="{{url("/laboratorios/registrar/profesor/materia")}}" class="form" role="form" method="POST">
                        <div class="modal-body">
                            <div id="contenedor_profesor_periodo">
                            </div>
                        </div>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary " id="guardar_profesor">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>


        {{-- Modal para agragegar comicionados EN FECHA DETERMINADA--}}
        <form id="form_registrar" action="{{url("/laboratorios/registrar")}}" class="form" role="form" method="POST">
            <div class="modal fade bs-example-modal-lg" id="modal_agregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog " role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">REGISTRAR EN FECHA DETERMINADA</h4>
                        </div>
                        <div class="modal-body">
                            <div id="contenedor_agregar">

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary " id="guardar">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
    <div id="modal_eliminado" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="" method="POST" role="form" id="form_delete">
                        {{method_field('DELETE') }}
                        {{ csrf_field() }}
                        ¿Realmente deseas eliminar éste elemento?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <input id="confirma_eliminado" type="button" class="btn btn-danger" value="Aceptar"></input>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div id="modal_eliminado_profesor" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="" method="POST" role="form" id="form_delete_profesor">
                        {{method_field('DELETE') }}
                        {{ csrf_field() }}
                        ¿Realmente deseas eliminar éste elemento?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <input id="confirma_eliminado_profesor" type="button" class="btn btn-danger" value="Aceptar"></input>
                </div>
                </form>
            </div>
        </div>
    </div>
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
                $('#soli').append('<input class="form-control" id="fecha_final" disabled value="'+resultado+'"/>');
                // alert(resultado);

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
               // alert(id_semana_profesor);

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
@endsection