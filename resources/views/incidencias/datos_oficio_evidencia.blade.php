<input type="hidden"  id="id_evid" name="id_evid"  value="{{  $evid->id_evid }}">
<div class="row">
    <div class="col-md-10 col-md-offset-1">
       <h4>{{ $evid->nombre_articulo }}</h4>
    </div>
</div>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <p><b>Fecha solicitada: </b>{{ $evid->fecha_req }}</p>
    </div>
</div>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <p><b>Motivo del oficio: </b>{{ $evid->motivo_oficio }}</p>
    </div>
</div>

<div class="row">
    <div class="col-md-10 col-md-offset-1">
                    <label>Archivo a subir:</label>
                    <input  class="form-control" id="arch_evidencia" name="arch_evidencia" type="file" accept="application/pdf"    required/>
    </div>
</div>