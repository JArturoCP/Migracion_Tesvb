<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="dropdown">
            <label for="selectLugar_s">Seleccion año</label>
            <select class="form-control" id="id_year" name="id_year"  required >
                <option disabled selected hidden>Selecciona una opción</option>
                @foreach($anos as $ano)
                    <option value="{{$ano->id_ano}}"> {{$ano->descripcion}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>