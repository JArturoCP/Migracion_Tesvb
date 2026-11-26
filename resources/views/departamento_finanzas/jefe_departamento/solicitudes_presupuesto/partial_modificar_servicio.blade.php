<form id="form_mod_material_servicio" class="" action="{{url("/presupuesto_autorizado/guardar_mod_material_solicitud/".$id_material_partida)}}" role="form" method="POST" >
    {{ csrf_field() }}

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4">
                <label>Ingresar el nombre del bien o servicio, etc.</label>
                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="bien_servicio" name="bien_servicio" rows="3" onkeyup="javascript:this.value=this.value.toUpperCase();" required>{{ $servicio->descripcion }}</textarea>
            </div>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4">
                <label>Ingresa unidad de medida</label>
                <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="unidad_medida" name="unidad_medida" type="text" value="{{ $servicio->unidad_medida }}" onkeyup="javascript:this.value=this.value.toUpperCase();" required></input>
            </div>
        </div>
    </div>


    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4">
                <label>Ingresa cantidad del bien o servicio, etc.</label>
                <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="cantidad" name="cantidad"  value="{{ $servicio->cantidad }}" type="number" pattern="[0-9]+"  required></input>
            </div>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="mostrar_precio">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4">
                <label>Ingresa precio unitario de referencia con iva incluido</label>
                <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="precio" name="precio" value="{{ $servicio->precio_unitario }}" type="number" step=".01"  required></input>
            </div>
            <div id="pesos_precio">
             <h2 class="tw:mb-4 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{  "$".number_format($servicio->precio_unitario, 2, '.', ',') }}</h2>
            </div>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="mensaje_no_pre" style="display: none;">
        <div class="tw:w-full tw:px-2">
            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-600 tw:dark:text-red-400">No alcanza el presupuesto dado</h4>
        </div>
    </div>
</form>
<div id="mostrar_cerrar" style="display: none;">
    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:pb-2">
        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
    </div>
</div>
<div id="mostrar_guardar" style="display: block;">
    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:pb-2">
        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
        <button id="guardar_material_partida"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#cantidad").change(function (){
            var cantidad = event.target.value;

            if(cantidad == '')
            {
                swal({
                    position: "top",
                    type: "error",
                    title: "La cantidad debe ser un número",
                    showConfirmButton: false,
                    timer: 3500
                });
            }else{
                var precio = $("#precio").val();
                if(precio !=''){
                    var precio_total = cantidad*precio;
                    var resto_presupuesto = {{ $resto_presupuesto }};
                    if( precio_total <= resto_presupuesto) {
                        $("#mensaje_no_pre").css("display", "none");
                        $("#mostrar_guardar").css("display", "block");
                        $("#mostrar_cerrar").css("display", "none");
                    }
                    else{
                        $("#mensaje_no_pre").css("display","block");
                        $("#mostrar_guardar").css("display","none");
                        $("#mostrar_cerrar").css("display","block");
                    }
                }
            }

        });
        $("#precio").change(function (event) {
            var precio = event.target.value;

            if (isNaN(precio)) {
                TNotify.alert("el precio debe ser un numero");
                $('#pesos_precio').empty();

            } else {
                var cantidad = $("#cantidad").val();

                var precio_total = cantidad*precio;
                var resto_presupuesto = {{ $resto_presupuesto }};
                if( precio_total <= resto_presupuesto){
                    $("#mensaje_no_pre").css("display","none");
                    $("#mostrar_guardar").css("display","block");
                    $("#mostrar_cerrar").css("display","none");
                    var p_precio = new Intl.NumberFormat("es-MX", {
                        style: "currency",
                        currency: "MXN"
                    }).format(precio);
                    $('#pesos_precio').empty();
                    $('#pesos_precio').append('<h2>' + p_precio + '</option>');
                }else {
                    $("#mensaje_no_pre").css("display","block");
                    $("#mostrar_guardar").css("display","none");
                    $("#mostrar_cerrar").css("display","block");
                }

            }
        });
        $("#guardar_material_partida").click(function (){

            var bien_servicio = $("#bien_servicio").val();
            if(bien_servicio != ''){
                var unidad_medida = $("#unidad_medida").val();
                if( unidad_medida != ''){

                    var cantidad = $("#cantidad").val();

                    if ( cantidad != ''){

                        var precio = $("#precio").val();
                        if ( precio != ''){

                            $("#form_mod_material_servicio").submit();
                            $("#guardar_material_partida").attr("disabled", true);
                            swal({
                                position: "top",
                                type: "success",
                                title: "Registro exitoso",
                                showConfirmButton: false,
                                timer: 3500
                            });
                        }else{
                            swal({
                                position: "top",
                                type: "error",
                                title: "Ingresa precio unitario de referencia con iva incluido",
                                showConfirmButton: false,
                                timer: 3500
                            });
                        }

                    }else{
                        swal({
                            position: "top",
                            type: "error",
                            title: "Ingresa cantidad correcta",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }

                }else{
                    swal({
                        position: "top",
                        type: "error",
                        title: "Ingresa unidad de medida",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            }else{
                swal({
                    position: "top",
                    type: "error",
                    title: "Ingresar el nombre del bien o servicio",
                    showConfirmButton: false,
                    timer: 3500
                });
            }
        });

    });
</script>