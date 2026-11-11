<div class="row">
    <div class="col-md-12">

                <h3 class=" text-center" style="color: #1c7430">{{$lab->descripcion}} ( {{$hora_semana->dia}}- {{ $hora_semana->hora }})</h3>

    </div>
</div>
{{ csrf_field() }}

<input type="hidden" id="id_laboratorio" name="id_laboratorio" value="{{ $lab->id_laboratorio }}">
<input type="hidden" id="id_semana" name="id_semana" value="{{ $id_semana }}">
<input type="hidden" id="fecha_registro" name="fecha_registro" value="{{ $fecha_registro }}">
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="form-group">
            <div class="dropdown">
                <label for="personal">Personal TESVB</label>
                <select name="personal" id="personal" class="form-control ">
                    <option disabled selected hidden>Selecciona personal</option>
                    @foreach($personales as $personal)
                        @if($personal->id_personal == $id_personal_lab)
                            <option value="{{$personal->id_personal}}" selected="selected">{{$personal->nombre}}</option>
                        @else
                        <option value="{{$personal->id_personal}}" >{{$personal->nombre}}</option>
                        @endif

                    @endforeach
                </select>
                <br>
            </div>
        </div>
    </div>
</div>
<div class="row" >
    <div class="col-md-6 col-md-offset-3">
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Ingresa el motivo " style="">{{ $com_lab }}</textarea>
        </div>
    </div>
</div>