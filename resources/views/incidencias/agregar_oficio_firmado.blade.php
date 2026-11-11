{{--

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h1 class="panel-title text-center">Subir oficio firmado, formato de incidencia y evidencia en un pdf</h1>
            </div>
        </div>
    </div>
</div>
--}}
<div class="row">
    <div class="col-md-10 col-md-offset-1 ">
        <b>Articulo: </b><p>{{$solicitud->nombre_articulo}}</p>
        <b>Motivo de oficio: </b><p>{{$solicitud->motivo_oficio}}</p>
        <?php  $fecha_solicitud=date_format(new DateTime($solicitud->fecha_solicitud), 'd-m-Y H:i:s');?>
        <b>Fecha de la solicitud del oficio: </b><p>{{$fecha_solicitud}}</p>
        @if($solicitud->id_articulo==2 || $solicitud->id_articulo==8 || $solicitud->id_articulo==11)

        @else
            <?php
            $fecha_req= date('d-m-Y', strtotime($solicitud->fecha_req));
            ?>
            <b>Fecha de la incidencia: </b><p>{{$fecha_req}}</p>
        @endif

        @if($solicitud->id_articulo==5)
            <b>Hora entrada:</b><p>{{$solicitud->hora_e}}</p>
            <b>Hora llegada tarde:</b><p>{{$solicitud->hora_st}}</p>
        @endif
        @if($solicitud->id_articulo==8 || $solicitud->id_articulo==2 || $solicitud->id_articulo==11)
            <?php
            $fecha_inicial= date('d-m-Y', strtotime($solicitud->fecha_invac));
            $fecha_final= date('d-m-Y', strtotime($solicitud->fecha_tervac));
            ?>
            <b>Inician:</b><p>{{$fecha_inicial}}</p>
            <b>Finalizan:</b><p>{{$fecha_final}}</p>
        @endif
        @if($solicitud->id_articulo==9 || $solicitud->id_articulo==10)
            @if($solicitud->hora_e2 != "")

                <b>Hora entrada:</b><p>{{$solicitud->hora_e2}}</p>
                <b>Hora salida:</b><p>{{$solicitud->hora_s2}}</p>
            @endif
        @endif
        @if($solicitud->id_articulo==9 || $solicitud->id_articulo==10)
            @if($solicitud->hora_e1 != "")
                <b>Hora entrada:</b><p>{{$solicitud->hora_e1}}</p>
                <b>Hora salida:</b><p>{{$solicitud->hora_s1}}</p>
            @endif
        @endif

    </div>
</div>



    <form id="form_enviar_oficio" action="{{url('/incidencias/guardar_oficio/'.$solicitud->id_solicitud)}}" role="form" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-10 col-md-offset-1 ">
                <label>Instrucciones: </label><br>
                <label> Para poder subir las evidencias correspondiente es necesario que su archivo, que desea subir este en formato PDF y que este legible.</label>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <label for="archivo_subir">Archivo a subir:</label>
                <input  class="form-control" id="arch_solicitud" name="arch_solicitud" type="file" accept="application/pdf"    required/>
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
    <script>
        $("#enviar_oficio").click(function(){
            var arch_oficio = $('#arch_solicitud').val();
            if(arch_oficio == ''){
                swal({
                    position: "top",
                    type: "error",
                    title: "Selecciona oficio que desea subir",
                    showConfirmButton: false,
                    timer: 3500
                });
            } else{
                $("#form_enviar_oficio").submit();
                $("#enviar_oficio").attr("disableb", true);
                swal({
                    position: "top",
                    type: "success",
                    title: "Registro exitoso",
                    showConfirmButton: false,
                    timer: 3500
                });
            }

///////seecion de evidencia////
        });
    </script>