<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <input type="hidden" id="id" name="id" value="{{ $usuario->id }}">
        </div>
        <h3 style="text-align: center;">Correo electronico: {{ $usuario->email }}</h3>
    </div>
</div>
<div class="row">
    <p><br></p>
</div>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="form-group">
        <select class="form-control "  name="tipo"  required>
        <option disabled selected hidden>Selecciona una opción</option>
        <option  value="1">ESTUDIANTE</option>
        <option  value="2">PERSONAL DEL TESVB</option>
        <option  value="2">FACILITADOR</option>
        </select>
        </div>
    </div>
</div>
<div class="row">
    <p><br></p>
</div>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="form-group">
        <label for="password-confirm" class="control-label">ingresa contraseña</label>

            <input id="password" type="password" class="form-control" name="password" required>
        </div>
    </div>
</div>