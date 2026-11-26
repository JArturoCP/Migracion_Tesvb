<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <div class="tw:mb-4">
            <label for="dependencia">Dependencia de la comisión</label>
            <input type="hidden"  id="id_oficio" name="id_oficio"  value="{{  $dependencias->id_oficio }}">
            <input type="hidden"  id="id_dependencia_domicilio" name="id_dependecia_domicilio"  value="{{  $dependencias->id_depend_domicilio }}">
            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="dependencia" name="dependencia" rows="2"  required >{{ $dependencias->dependencia }}</textarea>
        </div>
    </div>
</div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <div class="tw:mb-4">
            <label for="dependencia">Domicilio de la dependencia de la comisión</label>
             <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="domiclio" name="domicilio" rows="2"  required >{{ $dependencias->domicilio }}</textarea>
        </div>
    </div>
</div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <div class="tw:mb-4">
            <label for="exampleInputEmail1">Estado de la  dependencia de la comisión<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="estadss" name="estadss" >
                <option disabled selected hidden>Selecciona una opción</option>
                @foreach($estados as $estados)
                    @if($dependencias->id_estado==$estados->id_estado)
                        <option value="{{$estados->id_estado}}" selected="selected">{{$estados->nombre_estado}}</option>
                    @else
                        <option value="{{$estados->id_estado}}">{{$estados->nombre_estado}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <div class="tw:mb-4">
            <div class="tw:mb-4">
                <label for="exampleInputEmail1">Municipio o Ciudad de la comisión<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="municipios" name="municipios" value="" required>
                    <option disabled selected hidden>Selecciona una opción</option>
                    @foreach($municipios as $municipios)
                        @if($dependencias->id_municipio==$municipios->id_municipio)
                            <option value="{{$municipios->id_municipio}}" selected="selected">{{$municipios->nombre_municipio}}</option>
                        @else
                            <option value="{{$municipios->id_municipio}}">{{$municipios->nombre_municipio}}</option>
                        @endif
                    @endforeach

                </select>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready( function() {

        $("#estadss").change(function (e) {
            console.log(e);
            var id_estado = e.target.value;
            $.get('/ajax-subcat?id_estado=' + id_estado, function (data) {

                $('#municipios').empty();
                $.each(data, function (datos_alumno, subcatObj) {
                    //  TNotify.alert(subcatObj);
                    $('#municipios').append('<option value="' + subcatObj.id_municipio + '" data-muni="' + subcatObj.nombre_municipio + '" >' + subcatObj.nombre_municipio + '</option>');
                });
            });
        });
    });
</script>