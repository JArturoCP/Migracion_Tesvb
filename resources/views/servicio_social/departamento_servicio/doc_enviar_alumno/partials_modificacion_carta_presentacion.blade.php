
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
<div class="tw:w-full tw:px-2">
<p>NO. CUENTA: <b>{{ $alumno[0]->cuenta }}</b></p>
    <p>NOMBRE DEL ESTUDIANTE: <b>{{ $alumno[0]->nombre }} {{ $alumno[0]->apaterno }} {{ $alumno[0]->amaterno }}</b></p>
</div>
</div>

<form id="form_rechar_carta_presentcion" action="{{url("/servicio_social/envio_rechazar_cartapresentacion/")}}" class="" role="form" method="POST">
    {{ csrf_field() }}
    <input type="hidden" id="id_constancia_presentacion_alumno" name="id_constancia_presentacion_alumno" value="{{ $constancia_presentacion[0]->id_constancia_presentacion_alumno }}">
    <input type="hidden" id="id_dat_alumn" name="id_dat_alumn" value="{{ $id_datos_alumnos }}">

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
    <div class="tw:w-full tw:px-2">
        <div class="tw:mb-4">
            <label for="descripcion">Ingresa la correción que debe hacer en el documento el estudiante</label>
            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario_carta" name="comentario_carta" rows="3" placeholder="Ingresa la correción que debe hacer en el documento el estudiante " required></textarea>
        </div>
    </div>
</div>
</form>