<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h4>Nombre: {{ $mantenimiento->nombre }}</h4>
        <h4>Fecha solicitud: {{ $mantenimiento->fecha_solicita }}</h4>
        <h4>Servicio solicitado: {{ $mantenimiento->servicio_solicita }}</h4>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">

                    <div class="row">
                        <div class="col-md-12">
                            <p><b>1.-El tiempo de respuesta a su Solicitud fue el adecuado<br></b></p>
                            @if($mantenimiento->cal_preg_1 == 5)
                            <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="5" checked>Excelente</label>
                            @elseif($mantenimiento->cal_preg_1 == 4)
                            <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="4" checked>Muy bueno</label>
                            @elseif($mantenimiento->cal_preg_1 == 3)
                            <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="3" checked>Bueno</label>
                            @elseif($mantenimiento->cal_preg_1 == 2)
                            <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="2" checked>Regular</label>
                            @elseif($mantenimiento->cal_preg_1 == 1)
                            <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="1" checked>Malo</label>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p><b>2.-La atención proporcionada por el personal de Mantemiento fue la adecuada.<br></b></p>
                            @if($mantenimiento->cal_preg_2 == 5)
                                <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="5" checked>Excelente</label>
                            @elseif($mantenimiento->cal_preg_2 == 4)
                            <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="4" checked>Muy bueno</label>
                            @elseif($mantenimiento->cal_preg_2 == 3)
                            <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="3" checked>Bueno</label>
                            @elseif($mantenimiento->cal_preg_2 == 2)
                            <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="2" checked>Regular</label>
                            @elseif($mantenimiento->cal_preg_2 == 1)
                            <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="1" checked>Malo</label>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p><b>3.-El personal técnico resolvió sus necesidades y dio respuesta a sus requerimientos.<br></b></p>
                            @if($mantenimiento->cal_preg_3 == 5)
                            <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="5" checked>Excelente</label>
                            @elseif($mantenimiento->cal_preg_3 == 4)
                            <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="4" checked>Muy bueno</label>
                            @elseif($mantenimiento->cal_preg_3 == 3)
                            <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="3" checked>Bueno</label>
                            @elseif($mantenimiento->cal_preg_3 == 2)
                            <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="2" checked>Regular</label>
                            @elseif($mantenimiento->cal_preg_3 == 1)
                            <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="1" checked>Malo</label>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p><b>4.-El equipo al que se dio mantenimiento se le entrego limpio.<br></b></p>
                            @if($mantenimiento->cal_preg_4 == 5)
                            <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="5" checked>Excelente</label>
                            @elseif($mantenimiento->cal_preg_4 == 4)
                            <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="4" checked>Muy bueno</label>
                            @elseif($mantenimiento->cal_preg_4 == 3)
                            <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="3" checked>Bueno</label>
                            @elseif($mantenimiento->cal_preg_4 == 2)
                            <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="2" checked>Regular</label>
                            @elseif($mantenimiento->cal_preg_4 == 1)
                            <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="1" checked>Malo</label>
                            @endif
                        </div>
                    </div>
                @if($mantenimiento->sugerencias != "")
                    <div class="row" style="">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="Motivo">5.-Sugerencias</label>
                               <h2>{{ $mantenimiento->sugerencias }}</h2>
                            </div>
                        </div>
                    </div>
                    @endif
            </div>
        </div>
    </div>
</div>
