<div class="row">
    <div class="col-md-12">

        <h3 class=" text-center" style="color: blue">{{$lab->descripcion}} ( {{$hora->dia}}- {{ $hora->hora }})</h3>

    </div>
</div>
@if($estado_hora == 0)
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="alert alert-success">
              Disponible
            </div>
        </div>

    </div>

@else
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="alert alert-danger">
                Esta apartado por:
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Personal del TESVB</th>
                        <th>Fecha</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($personas as $persona)
                    <tr>
                        <td>{{ $persona->nombre }}</td>
                        <td>{{{ $persona->fecha_registro }}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endif

{{ csrf_field() }}

<input type="hidden" id="id_laboratorio1" name="id_laboratorio1" value="{{ $id_laboratorio }}">
<input type="hidden" id="id_semana1" name="id_semana1" value="{{ $id_semana_profesor }}">
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
            <label for="descripcion1">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Ingresa el motivo " style="">{{ $com_lab }}</textarea>
        </div>
    </div>
</div>
