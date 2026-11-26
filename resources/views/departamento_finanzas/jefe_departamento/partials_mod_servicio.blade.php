<?php setlocale(LC_MONETARY, 'es_MX');

?>


<form id="form_mod_bien" class="" action="{{url("/presupuesto_anteproyecto/guardar_mod_bien/".$servicio->id_reg_material_ant)}}" role="form" method="POST" >
    {{ csrf_field() }}

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4">
                <label>Ingresar el nombre del bien o servicio, etc.</label>
                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="bien_servicio_mod" name="bien_servicio_mod" rows="3" onkeyup="javascript:this.value=this.value.toUpperCase();" required>{{ $servicio->descripcion }}</textarea>
            </div>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4">
                <label>Ingresa unidad de medida</label>
                <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="unidad_medida_mod" name="unidad_medida_mod" type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ $servicio->unidad_medida }}" required></input>
            </div>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4">
                <label>Ingresa cantidad del bien o servicio, etc.</label>
                <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="cantidad_mod" name="cantidad_mod" type="number" pattern="[0-9]+" value="{{ $servicio->cantidad }}" required></input>
            </div>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4">
                <label>Ingresa precio unitario de referencia con iva incluido</label>
                <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="precio_mod" name="precio_mod" type="number-only"  value="{{ $servicio->precio_unitario }}" required></input>
            </div>
            <?php
            $precio_unitario_p=$servicio->precio_unitario;
            $precio_unitario_p= "$".number_format($precio_unitario_p, 2, '.', ',');
            ?>
            <div id="pesos_precio_mod">
                <h2 class="tw:mb-4 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"> {{ $precio_unitario_p }}</h2>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $("#precio_mod").change(function (event) {
            var precio = event.target.value;
            if (isNaN(precio)) {
                TNotify.alert("el precio debe ser un numero");
                $('#pesos_precio_mod').empty();

            } else {

                var p_precio = new Intl.NumberFormat("es-MX", {
                    style: "currency",
                    currency: "MXN"
                }).format(precio);


                $('#pesos_precio_mod').empty();
                $('#pesos_precio_mod').append('<h2>' + p_precio + '</option>');
            }
        });
    });
</script>