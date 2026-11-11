<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4>Fecha solicitud: {{ $mantenimiento->fecha_solicita }}</h4>
        <h4>Servicio solicitado: {{ $mantenimiento->servicio_solicita }}</h4>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <p>
                  Por favor en el siguiente cuestionario califique el trabajo realizado por el área de mantenimiento.
                </p>
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <form id="form_enviar_encuesta" class="form" action="{{url("/encuestas_satisfaccion/enviar_encuesta_mantenimiento/".$mantenimiento->id_servicio_mantenimiento)}}" role="form" method="POST" >
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <p><b>1.-El tiempo de respuesta a su Solicitud fue el adecuado<br></b></p>
                            <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="5">Excelente</label>
                            <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="4">Muy bueno</label>
                            <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="3">Bueno</label>
                            <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="2">Regular</label>
                            <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="1">Malo</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p><b>2.-La atención proporcionada por el personal de Mantemiento fue la adecuada.<br></b></p>
                            <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="5">Excelente</label>
                            <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="4">Muy bueno</label>
                            <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="3">Bueno</label>
                            <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="2">Regular</label>
                            <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="1">Malo</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p><b>3.-El personal técnico resolvió sus necesidades y dio respuesta a sus requerimientos.<br></b></p>
                            <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="5">Excelente</label>
                            <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="4">Muy bueno</label>
                            <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="3">Bueno</label>
                            <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="2">Regular</label>
                            <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="1">Malo</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p><b>4.-El equipo al que se dio mantenimiento se le entrego limpio.<br></b></p>
                            <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="5">Excelente</label>
                            <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="4">Muy bueno</label>
                            <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="3">Bueno</label>
                            <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="2">Regular</label>
                            <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="1">Malo</label>
                        </div>
                    </div>

                    <div class="row" style="">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="Motivo">5.-Sugerencias</label>
                                <textarea class="form-control" id="sugerencias" name="sugerencias" rows="2" placeholder=""  ></textarea>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
