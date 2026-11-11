<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <input type="hidden" id="id" name="id" value="{{ $reg_user->id }}">
        </div>
        <h3 style="text-align: center;">Correo electronico: {{ $reg_user->email }}</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
@if($reg_user->info_ok == 0)
   <h4>Sin datos</h4>
@else
    <h4>Con datos</h4>
@endif
    </div>
</div>
<div class="row">
    <p><br></p>
</div>