<form id="form_enviar_evidencia" action="{{url("/incidencias/guardar_mod_evidencia2/".$evidencia->id_evid."/".$evidencia->id_tipo_evid)}}" role="form" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <label>Instrucciones: </label><br>
            <label> Para poder subir la evidencia correspondiente es necesario que su archivo, que desea subir este en formato PDF y que este legible.</label>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <h2 class="tw:mb-4 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Tipo de evidencia:{{ $evidencia->nombre_evidencia }}</h2>
        </div>

    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
            <label for="fecha_requerida">Fecha inicial:</label>
            <div class="tw:mb-4">
                <input class="datepicker fecha_mod_requerida1 tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   type="text"  id="mod_fecha_req1" name="mod_fecha_req1" data-date-format="yyyy/mm/dd" placeholder="DD/MM/AAAA" value="{{ $evidencia->fecha_solicita }}" >
            </div>
        </div>
        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
            <label for="fecha_requerida">Fecha final:</label>
            <div class="tw:mb-4">
                <input class="datepicker fecha_mod_requerida2 tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   type="text"  id="mod_fecha_req2" name="mod_fecha_req2" data-date-format="yyyy/mm/dd" placeholder="DD/MM/AAAA" value="{{ $evidencia->fecha_solicita_2 }}" >
            </div>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
        <span><label for="archivo_subir">Archivo a subir:</label>
            <input  class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden" id="arch_evidencia" name="arch_evidencia" type="file" accept="application/pdf"    required/></span>
        </div>
    </div>
    @if($evidencia->id_tipo_evid == 1 || $evidencia->id_tipo_evid == 3 ||  $evidencia->id_tipo_evid == 5  ||  $evidencia->id_tipo_evid == 6)
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <label for="archivo_subir">Número de folio:</label>
                <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" onkeyup="javascript:this.value=this.value.toUpperCase();"  id="no_folio" name="no_folio" type="text" placeholder="Ingresa numero de folio" value="{{ $evidencia->no_folio }}" required></input>
            </div>
        </div>
    @endif
</form>

<script>
    $( '.fecha_mod_requerida1').datepicker({
        pickTime: false,
        autoclose: true,
        language: 'es',
        startDate: '-7d',
    });

    $( '.fecha_mod_requerida2').datepicker({
        pickTime: false,
        autoclose: true,
        language: 'es',
        startDate: '-7d',
    });
</script>