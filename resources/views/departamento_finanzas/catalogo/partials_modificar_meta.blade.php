<form id="form_modificar_meta" class="" action="{{url("/presupuesto_anteproyecto/guardar_modificacion_meta/".$meta->id_meta)}}" role="form" method="POST" >
    {{ csrf_field() }}

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4">
                <label>Agregar nombre de la meta</label>
                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="nombre_meta_mod" name="nombre_meta_mod" rows="3" onkeyup="javascript:this.value=this.value.toUpperCase();" required>{{ $meta->meta }}</textarea>


            </div>
        </div>
    </div>

</form>
