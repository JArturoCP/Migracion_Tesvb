<div class="row">
    <input type="hidden" id="id_periodo_serv" name="id_periodo_serv" value="{{$registro->id_periodo_serv}}">
    <div class="col-md-10">
        @if($registro->mes == 1)
            <h2>Dar por terminado el periodo del mes de Enero del {{ $registro->year }}.</h2>
        @else
            <h2>Dar por terminado el periodo del mes de Julio del {{ $registro->year }}.</h2>
        @endif
    </div>
</div>