<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">PARTIDA PRESUPUESTAL: {{ $requisicion->clave_presupuestal }}  {{ $requisicion->nombre_partida }}</h4>
        <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">MES Y AÑO DE ADQUISICIÓN: {{ $requisicion->mes }}</h4>
        <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">PROYECTO: {{ $requisicion->nombre_proyecto }}</h4>
        <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300">META: {{ $requisicion->meta }}</h5>
    </div>
</div>
<form  id="form_guardar_mod_justificacion_pdf" action="{{url("/presupuesto_anteproyecto/guardar_mod_justificacion_pdf/".$requisicion->id_actividades_req_ante)}}" role="form" method="POST" enctype="multipart/form-data" >
    {{ csrf_field() }}
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4">
                <label for="exampleInputEmail1">Va ingresar justificación para dictamen pdf </label>
                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="mod_justificacion_pdf" name="mod_justififcacion_pdf" required>
                    <option disabled selected hidden>Selecciona una opción</option>
                    @foreach($respuestas as $respuesta)
                        @if($requisicion->id_estado_justificacion==$respuesta->id_respuesta)
                            <option value="{{$respuesta->id_respuesta}}" selected="selected" >{{$respuesta->respuesta}}</option>
                        @else
                            <option value="{{$respuesta->id_respuesta}}"> {{$respuesta->respuesta}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    @if($requisicion->id_estado_justificacion == 1)
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" style="display: none" id="ver_opciones_mod">
        <x-panel.alerta tipo="exito" class="tw:mb-4"><label>Seleccionar  justificación para dictamen pdf</label>
                    <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="mod_doc_justificacion_pdf" name="doc_justificacion_pdf" type="file"   accept="application/pdf" required/></x-panel.alerta>
    </div>
        @else
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" style="display:inline" id="ver_opciones_mod">
            <x-panel.alerta tipo="exito" class="tw:mb-4"><label>Seleccionar  justificación para dictamen pdf</label>
                        <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="mod_doc_justificacion_pdf" name="doc_justificacion_pdf" type="file"   accept="application/pdf" required/></x-panel.alerta>
        </div>
        @endif
</form>
<script>
    $(document).ready(function() {
        $("#mod_justificacion_pdf").change(function (e) {

            var justificacion_pdf = e.target.value;

            if(justificacion_pdf == 1){
                $("#ver_opciones_mod").css("display", "none");
            }
            if(justificacion_pdf == 2){
                $("#ver_opciones_mod").css("display", "inline");
            }
        });
    });
</script>
