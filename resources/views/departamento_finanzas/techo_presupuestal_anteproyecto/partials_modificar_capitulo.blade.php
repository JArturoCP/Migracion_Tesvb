<?php setlocale(LC_MONETARY, 'es_MX');
?>
<form id="form_modificar_capitulo" class="" action="{{url("/presupuesto_anteproyecto/techo_presupuestal/guardar_mod_capitulo/".$capitulo->id_fuente_financiamiento )}}" role="form" method="POST" >
    {{ csrf_field() }}

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">AÑO: {{ $capitulo->year}} </h4>
                <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">NOMBRE DEL PROYECTO: {{ $capitulo->nombre_proyecto }} </h4>
                @if($capitulo->id_capitulo == 1)
                <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">CAPITULO: 1000 </h4>
                @endif
                @if($capitulo->id_capitulo == 2)
                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">CAPITULO: 2000 </h4>
                @endif
                @if($capitulo->id_capitulo == 3)
                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">CAPITULO: 3000 </h4>
                @endif
                @if($capitulo->id_capitulo == 4)
                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">CAPITULO: 4000 </h4>
                @endif
                @if($capitulo->id_capitulo == 5)
                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">CAPITULO: 5000 </h4>
                @endif
                @if($capitulo->id_capitulo == 6)
                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">CAPITULO: 6000 </h4>
                @endif
            </div>
        </div>
    </div>

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4">
                <label>Ingresa importe de fuente de financiamiento estatal </label>
                <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="presupuesto_estatal_mod"  name="presupuesto_estatal_mod" type="number-only" value="{{ $capitulo->presupuesto_estatal  }}"   required />
                <div id="pesos_presupuesto_estatal">
                    <?php
                    $presupuesto_estatal=$capitulo->presupuesto_estatal ;
                    $presupuesto_estatal= "$ ".number_format($presupuesto_estatal, 2, '.', ',');
                    ?>
                    <h2 class="tw:mb-4 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $presupuesto_estatal }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4">
                <label>Ingresa importe de fuente de financiamiento federal</label>
                <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="presupuesto_federal_mod" name="presupuesto_federal_mod" type="number-only" value="{{ $capitulo->presupuesto_federal  }}"   required />
                <div id="pesos_presupuesto_federal">
                    <?php
                    $presupuesto_federal=$capitulo->presupuesto_federal ;
                    $presupuesto_federal= "$ ".number_format($presupuesto_federal, 2, '.', ',');
                    ?>
                    <h2 class="tw:mb-4 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $presupuesto_federal }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4">
                <label>Ingresa importe de fuente de financiamiento propios </label>
                <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="presupuesto_propios_mod" name="presupuesto_propios_mod" type="number-only" value="{{ $capitulo->presupuesto_propios  }}"  required />
                <div id="pesos_presupuesto_propios">
                    <?php
                    $presupuesto_propios=$capitulo->presupuesto_propios ;
                    $presupuesto_propios= "$ ".number_format($presupuesto_propios, 2, '.', ',');
                    ?>
                    <h2 class="tw:mb-4 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $presupuesto_propios }}</h2>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready( function() {
        $("#presupuesto_estatal_mod").change(function (event){
            var presupuesto_estatal_pesos= event.target.value;
            if(isNaN(presupuesto_estatal_pesos)){
                TNotify.alert( "La cantidad de fuente de financiamiento estatal debe ser un número");
                $('#pesos_presupuesto_estatal').empty();

            }else {
                var p_estatal_peso_mexicano = new Intl.NumberFormat("es-MX", {
                    style: "currency",
                    currency: "MXN"
                }).format(presupuesto_estatal_pesos);


             //   TNotify.alert(presupuesto_estatal_pesos);
                $('#pesos_presupuesto_estatal').empty();
                $('#pesos_presupuesto_estatal').append('<h2>' + p_estatal_peso_mexicano + '</option>');
            }
        });
        $("#presupuesto_federal_mod").change(function (event){
            var presupuesto_federal_pesos= event.target.value;
            if(isNaN(presupuesto_federal_pesos)){
                TNotify.alert( "La cantidad de fuente de financiamiento federal debe ser un número");
                $('#pesos_presupuesto_federal').empty();

            }else {
                var p_federal_peso_mexicano = new Intl.NumberFormat("es-MX", {
                    style: "currency",
                    currency: "MXN"
                }).format(presupuesto_federal_pesos);


                $('#pesos_presupuesto_federal').empty();
                $('#pesos_presupuesto_federal').append('<h2>' + p_federal_peso_mexicano + '</option>');
            }
        });
        $("#presupuesto_propios_mod").change(function (event){
            var presupuesto_propios_pesos= event.target.value;
            if(isNaN(presupuesto_propios_pesos)){
                TNotify.alert( "La cantidad de fuente de financiamiento propios debe ser un número");
                $('#pesos_presupuesto_propios').empty();

            }else {
                var p_propios_peso_mexicano = new Intl.NumberFormat("es-MX", {
                    style: "currency",
                    currency: "MXN"
                }).format(presupuesto_propios_pesos);


                $('#pesos_presupuesto_propios').empty();
                $('#pesos_presupuesto_propios').append('<h2>' + p_propios_peso_mexicano + '</option>');
            }
        });
    });
</script>