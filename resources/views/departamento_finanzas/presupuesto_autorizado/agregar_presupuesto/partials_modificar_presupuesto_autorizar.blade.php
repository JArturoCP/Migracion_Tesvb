<form id="form_mod_mes_partida" class="" action="{{url("/presupuesto_autorizado/guardar_mod_partida_mes_presupuesto/".$id_presupuesto_aut_copia."/".$id_mes)}}" role="form" method="POST" >
    {{ csrf_field() }}

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">Nombre de la partida: {{ $requisicion->clave_presupuestal}} {{ $requisicion->nombre_partida}}</h4>
    </div>
</div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">Nombre del mes: {{ $nombre_mes }}</h4>
    </div>
</div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">Presupuesto sobrante: ${{ number_format($presupuesto_sobrante, 2, '.', ',') }}</h4>
        <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="presupuesto_sobrante" name="presupuesto_sobrante" type="hidden" value="{{ $presupuesto_sobrante }}"></input>
    </div>
</div>

<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <div class="tw:mb-4">
            <label for="exampleInputEmail1">Seleccionar mes a dar presupesto</label>
            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="id_mes" name="id_mes" required>
                <option disabled selected hidden>Selecciona una opción</option>
                @foreach($meses as $mes)
                    <option value="{{$mes->id_mes}}" data-esta="{{$mes->mes }}">{{ $mes->mes }} </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <div class="tw:mb-4">
            <label>Ingresa presupuesto a dar</label>
            <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="presupuesto_dado" name="presupuesto_dado" type="number-only"    required></input>
        </div>
    </div>
</div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <div id="pesos_precio">

        </div>
    </div>
</div>
</form>
<script>
    $(document).ready(function() {

            $("#presupuesto_dado").change(function (event){
                    var presupuesto_dado= event.target.value;
                    //
                // dd(presupuesto_dado);

                    if(isNaN(presupuesto_dado)){
                    TNotify.alert( "el precio debe ser un numero");
                    $('#pesos_precio').empty();

                    }else {
                        var presupuesto_sobrante={{ $presupuesto_sobrante }};

                        if(presupuesto_dado > presupuesto_sobrante){
                            swal({
                                position: "top",
                                type: "error",
                                title: "No alcanza el presupuesto",
                                showConfirmButton: false,
                                timer: 3500
                            });
                            $('#pesos_precio').empty();
                        }
                        else{
                            var p_precio= new Intl.NumberFormat("es-MX", {
                                style: "currency",
                                currency: "MXN"
                            }).format(presupuesto_dado);
                            $('#pesos_precio').empty();
                            $('#pesos_precio').append('<h2>' + p_precio+ '</option>');
                        }
                        }
            });

    });
</script>