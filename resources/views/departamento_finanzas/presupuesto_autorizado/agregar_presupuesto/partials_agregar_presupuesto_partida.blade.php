<form id="form_guardar_presupuesto_dado" class="" action="{{url("/presupuesto_autorizado/guardar_presupuesto_dado/".$partida->id_solicitud_partida)}}" role="form" method="POST" >
    {{ csrf_field() }}

<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <p><b>PARTIDA PRESUPUESTAL: </b>{{ $partida->clave_presupuestal }}  {{ $partida->nombre_partida }}</p>
    </div>
</div>
@if($partida->id_tipo_requisicion == 1)
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <p><b>TIPO DE SOLICITUD:  </b>ANTEPROYECTO</p>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <p><b>PRESUPUESTO PEDIDO: </b>${{ number_format($partida->importe_total, 2, '.', ',')  }}</p>
        </div>
    </div>
@endif
@if($partida->id_tipo_requisicion == 2)
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <p><b>TIPO DE SOLICITUD:  </b>PROYECTO AUTORIZADO</p>
        </div>
    </div>
@endif
@if($resto_presupuesto <= 0)
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <x-panel.alerta tipo="error" class="tw:mb-4">
                <strong>No hay presupuesto en este mes en esta partida</strong> .
            </x-panel.alerta>
        </div>
    </div>
    <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="estado_pre" name="estado_pre" type="hidden"  value="1" required>
@else
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <x-panel.alerta tipo="exito" class="tw:mb-4">
                <strong>PRESUPUESTO RESTANTE AUTORIZADO: {{ $resto_presupuesto }}</strong> .
            </x-panel.alerta>
        </div>
    </div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <label for="pres_dar">Ingresar presupuesto a dar</label>
        <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="pres_dar" name="pres_dar" type="number" step=".01" value="{{ $partida->presupuesto_dado }}" required>
    </div>
</div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <div id="pesos_mod">
            <h2 class="tw:mb-4 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"> {{ "$".number_format($partida->presupuesto_dado, 2, '.', ',') }}</h2>
        </div>
    </div>
</div>
    <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="estado_pre" name="estado_pre" type="hidden"  value="2" required>
    <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="resto_pres" name="resto_pres" type="hidden"  value="{{ $resto_presupuesto }}" required>

    <script>
        $(document).ready(function() {
            $("#pres_dar").change(function (event) {
                var p_dar = event.target.value;

                if (isNaN(p_dar)) {
                    TNotify.alert("el presupuesto debe ser un numero");
                    $('#pesos_mod').empty();

                } else {
                    var p_dar1 = new Intl.NumberFormat("es-MX", {
                        style: "currency",
                        currency: "MXN"
                    }).format(p_dar);
                    $('#pesos_mod').empty();
                    $('#pesos_mod').append('<h2>' + p_dar1 + '</option>');
                }
            });
        });
    </script>
    @endif