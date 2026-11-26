<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">AÑO: {{ $solicitud->year_presupuesto }} </h4>
            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">NO. SOLICITUD: {{ $solicitud->numero_solicitud }} </h4>
            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">NOMBRE DEL PROYECTO: {{ $solicitud->nombre_proyecto }} </h4>
            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">MES: {{ $solicitud->mes }}</h4>
        </div>
    </div>
</div>
<input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="id_solicitud" name="id_solicitud" type="hidden"  value="{{ $id_solicitud }}" required>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <div class="tw:mb-4">
            <label for="exampleInputEmail1">Selecciona partida presupuestal</label>
            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="id_presupuesto_aut_copia" name="id_presupuesto_aut_copia" required>
                <option disabled selected hidden>Selecciona una opción</option>
                @foreach($partidas as $partida)
                    <option value="{{ $partida->id_presupuesto_aut_copia }}" data-esta="{{ $partida->nombre_partida }}">{{ $partida->clave_presupuestal }} {{ $partida->nombre_partida }} </option>
                @endforeach
            </select>
        </div>
    </div>
</div>


<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">

        <div id="pesos_sobrante">

        </div>
    </div>

</div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <div id="pesos_presupuesto_dado">

        </div>
    </div>
</div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <label for="presupuesto_dar">Ingresar presupuesto a dar</label>
        <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="presupuesto_dar" name="presupuesto_dar" type="number" step=".01" value="" required>
    </div>
</div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <div id="pesos_presupuesto_dar">

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#id_presupuesto_aut_copia").change(function(e) {
            var id_presupuesto = e.target.value;
            var id_mes = {{ $solicitud->id_mes }};
            if(id_mes !== null ){
                $.get('/presupuesto_autorizado/ver_presupuesto_partida/' + id_presupuesto+'/'+id_mes,function(data){
                    var  presupuesto_sobrante = data;
                    var p_sobrante = new Intl.NumberFormat("es-MX", {
                        style: "currency",
                        currency: "MXN"
                    }).format(presupuesto_sobrante);
                    $('#pesos_sobrante').empty();
                    if(presupuesto_sobrante > 0){
                        $('#pesos_sobrante').append(' <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800"><h5 style="text-align: center">Presupuesto sobrante<br>'+ p_sobrante + '</h5></div> ' +
                            ' <br>' +
                            '<input class="required tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="id_estado_sobrante" name="id_estado_sobrante" value="1"  type="hidden"   />'+
                            '<input class="required tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="presupuesto_s" name="presupuesto_s" value="'+presupuesto_sobrante+'" type="hidden" />');
                    }else{
                        $('#pesos_sobrante').append(' <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700"><h5 style="text-align: center">' + p_sobrante + '<br>No alcanza el presupuesto</h5></div>' +
                            ' <input class="required tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="id_estado_sobrante" name="id_estado_sobrante" value="2" type="hidden" />');
                    }

                });
            }
        });

        $("#presupuesto_dar").change(function (event) {
            var p_dar = event.target.value;
            if (isNaN(p_dar)) {
                TNotify.alert("el presupuesto debe ser un numero");
                $('#pesos_presupuesto_dar').empty();
            } else {
                var p_dar1 = new Intl.NumberFormat("es-MX", {
                    style: "currency",
                    currency: "MXN"
                }).format(p_dar);
                $('#pesos_presupuesto_dar').empty();
                $('#pesos_presupuesto_dar').append('<h2>' + p_dar1 + '</option>');
            }
        });

    });

</script>
