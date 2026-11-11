<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <input class="form-control" type="hidden"  id="id_periodo_mantenimiento" name="id_periodo_mantenimiento"  value="{{ $periodo->id_periodo_mantenimiento }}">
        <h3> <b>Seguro(a) que quieres terminar el periodo de @if($periodo->mes == 1) enero @else julio @endif de {{ $periodo->year }} </b> </h3>

    </div>
</div>