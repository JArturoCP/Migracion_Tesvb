<form  id="form_guardar_mod_justificacion" action="{{url("/presupuesto_autorizado/guardar_justificacion/".$id_solicitud)}}" role="form" method="POST" enctype="multipart/form-data" >
    {{ csrf_field() }}
    <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="estado_solicitud" name="estado_solicitud" type="hidden"  value="{{ $estado_solicitud }}" required>
    <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="id_solicitud_documento" name="id_solicitud_documento" type="hidden"  value="{{ $id_solicitud_documento}}" required>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4">
                <label for="exampleInputEmail1">Va ingresar justificación para dictamen pdf</label>
                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="selecciona una Opcion" id="mod_justificacion" name="mod_justififcacion" required>
                    <option disabled selected hidden>Selecciona una opción</option>
                    @foreach($respuestas as $respuesta)
                        @if($documento->id_estado_justificacion==$respuesta->id_respuesta)
                            <option value="{{$respuesta->id_respuesta}}" selected="selected" >{{$respuesta->respuesta}}</option>
                        @else
                            <option value="{{$respuesta->id_respuesta}}"> {{$respuesta->respuesta}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" style="display: none" id="ver_opciones">
        <x-panel.alerta tipo="exito" class="tw:mb-4"><label>Seleccionar  justificacion para dictamen pdf</label>
                    <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="doc_justificacion_mod" name="doc_justificacion_mod" type="file"   accept="application/pdf" required/></x-panel.alerta>
    </div>
</form>
<script>
    $(document).ready(function() {
        $("#mod_justificacion").change(function (e) {

            var justificacion = e.target.value;
            if(justificacion == 1){
                $("#ver_opciones").css("display", "none");
            }
            if(justificacion == 2){
                $("#ver_opciones").css("display", "inline");
            }
        });
    });
</script>