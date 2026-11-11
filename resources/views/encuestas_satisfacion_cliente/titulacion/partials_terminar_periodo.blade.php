
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <input class="form-control" type="hidden"  id="id_periodo_titulacion" name="id_periodo_titulacion"  value="{{ $periodo->id_periodo_titulacion }}">
     <h4>Nombre del periodo: {{ $periodo->year }}</h4>
        <h5>Mes: @if($periodo->mes == 1) Enero @else Julio @endif</h5>
    </div>
</div>