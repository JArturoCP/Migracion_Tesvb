<form id="form_modificar_proyecto" class="" action="{{url("/presupuesto_anteproyecto/guardar_modificacion_proyecto/".$proyecto->id_proyecto)}}" role="form" method="POST" >
    {{ csrf_field() }}
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4">
                <label>Agregar nombre del proyecto</label>
                <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   type="text"  id="nombre_proyecto_mod"  onkeyup="javascript:this.value=this.value.toUpperCase();" name="nombre_proyecto_mod" value="{{ $proyecto->nombre_proyecto }}"  >
            </div>
        </div>
    </div>

</form>

