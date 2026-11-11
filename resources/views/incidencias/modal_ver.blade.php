<div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <b>Solicitante: </b>
                <p>{{$oficios->nombre}}</p>
                <b>Articulo: </b><p>{{$oficios->nombre_articulo}}</p>
                
                <b>Descripción de artículo: </b><p align="justify">{{$oficios->descripcion_art}}</p>
                
                <b>Motivo de oficio: </b><p>{{$oficios->motivo_oficio}}</p>
                <?php  $fecha_solicitud=date_format(new DateTime($oficios->fecha_solicitud), 'd-m-Y H:i:s');?>
                <b>Fecha de la solicitud del oficio: </b><p>{{$fecha_solicitud}}</p>
                @if($oficios->id_articulo==2 || $oficios->id_articulo==8 || $oficios->id_articulo==11)

                @else
                    <?php
                    $fecha_req= date('d-m-Y', strtotime($oficios->fecha_req));
                    ?>
                    <b>Fecha de la incidencia: </b><p>{{$fecha_req}}</p>
                    @endif

                @if($oficios->id_articulo==5)
                    <b>Hora entrada:</b><p>{{$oficios->hora_e}}</p>
                    <b>Hora llegada tarde:</b><p>{{$oficios->hora_st}}</p>
                @endif
                @if($oficios->id_articulo==8 || $oficios->id_articulo==2 || $oficios->id_articulo==11)
                    <?php
                    $fecha_inicial= date('d-m-Y', strtotime($oficios->fecha_invac));
                    $fecha_final= date('d-m-Y', strtotime($oficios->fecha_tervac));
                    ?>
                    <b>Inician:</b><p>{{$fecha_inicial}}</p>
                    <b>Finalizan:</b><p>{{$fecha_final}}</p>
                @endif
                @if($oficios->id_articulo==9 || $oficios->id_articulo==10)
                    @if($oficios->hora_e2 != "")

                    <b>Hora entrada:</b><p>{{$oficios->hora_e2}}</p>
                    <b>Hora salida:</b><p>{{$oficios->hora_s2}}</p>
                        @endif
                @endif
                @if($oficios->id_articulo==9 || $oficios->id_articulo==10)
                    @if($oficios->hora_e1 != "")
                    <b>Hora entrada:</b><p>{{$oficios->hora_e1}}</p>
                    <b>Hora salida:</b><p>{{$oficios->hora_s1}}</p>
                    @endif
                @endif
            </div>
        </div>
</div>