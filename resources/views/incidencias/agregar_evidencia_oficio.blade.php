<?php
if($solicitud->id_articulo ==2){
    $date_now = $solicitud->fecha_tervac;
    $fecha2=$date_now;
}else{
    $date_now = $solicitud->fecha_req;
    $fecha2=$date_now;
}



$date_future = strtotime('+7 days', strtotime($date_now));
$date_future = date('Y-m-d', $date_future);
?>
@if($solicitud->arch_solicitud==null)
    @if( $fechaact>=$solicitud->fecha_req  && $fechaact<= $date_future)
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Agregar evidencia</h3>
            </div>
        </div>

    </div>
</div>
    @else
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Agregar evidencia</h3>
                    </div>
                </div>

            </div>
        </div>
        @endif
@else
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Ver evidencia</h3>
                </div>
            </div>

        </div>
    </div>

    @endif
<div class="row">
    <div class="col-md-10 col-md-offset-1 ">
        <b>Articulo: </b><p>{{$solicitud->nombre_articulo}}</p>
        <b>Motivo de oficio: </b><p>{{$solicitud->motivo_oficio}}</p>
        @if($solicitud->id_articulo == 2 || $solicitud->id_articulo == 8 || $solicitud->id_articulo == 11)
            <b>Fecha solicitud: </b><p>{{$solicitud->fecha_req}}</p
        @else
        <b>Fecha requerida: </b><p>{{$solicitud->fecha_req}}</p>
        @endif
        <b>Fecha ultima para subir la evidencia</b><p>{{ $date_future}}</p>
        @if($solicitud->id_articulo==5)
            <b>Hora entrada:</b><p>{{$solicitud->hora_e}}</p>
            <b>Hora llegada tarde:</b><p>{{$solicitud->hora_st}}</p>
        @endif
        @if($solicitud->id_articulo == 2 || $solicitud->id_articulo == 8 || $solicitud->id_articulo == 11)
            <b>Inician:</b><p>{{$solicitud->fecha_invac}}</p>
            <b>Finalizan:</b><p>{{$solicitud->fecha_tervac}}</p>

        @endif
        @if($solicitud->id_articulo==9)
            @if($solicitud->hora_e2 != "")
            <b>Hora entrada:</b><p>{{$solicitud->hora_e2}}</p>
            <b>Hora salida:</b><p>{{$solicitud->hora_s2}}</p>
            @endif
        @endif
        @if($solicitud->id_articulo==9)
            @if($solicitud->hora_e1 != "")
            <b>Hora entrada:</b><p>{{$solicitud->hora_e1}}</p>
            <b>Hora salida:</b><p>{{$solicitud->hora_s1}}</p>
            @endif
        @endif
    </div>
</div>

        @if($solicitud->arch_evidencia==null)
            @if( $fechaact>=$fecha2  && $fechaact<= $date_future)
                <form id="form_registrar" action="{{url("/incidencias/cargando_evidencia_oficio")}}" role="form" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden"  id="id_evid" name="id_evid"  value="{{  $solicitud->id_evid }}">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <label for="archivo_subir">Archivo a subir:</label>
                        <input  class="form-control" id="arch_evidencia" name="arch_evidencia" type="file" accept="application/pdf"    required/>
                    </div>
                </div>
                <div class="row">
                    <p><br></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button  type="submit"  class="btn btn-primary" >Guardar</button>
                </div>
                </form>
            @elseif($fechaact> $date_future)
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="alert alert-danger">
                            Has olvidado subir tu evidencia
                        </div>
                    </div>
                </div>

                <div class="row">
                    <p><br></p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            @else
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="alert alert-info">
                            Podras subir tu evidencia el dia requerido hasta 5 dias habiles despues
                        </div>
                    </div>
                </div>
                <div class="row">
                    <p><br></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>

            @endif

        @else

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <a  target="_blank" href="/incidencias/{{ $solicitud->arch_evidencia }}" class="btn btn-primary">Ver evidencia </a>
                </div>
            </div>
            <div class="row">
                <p><br></p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>

        @endif

