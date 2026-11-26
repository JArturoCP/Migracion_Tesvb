
<form id="form_agregar_capitulo" class="" action="{{url("/presupuesto_anteproyecto/techo_presupuestal/guardar_fuentes_financiamiento/".$proyecto->id_presupuesto )}}" role="form" method="POST" >
    {{ csrf_field() }}

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">AÑO: {{ $proyecto->year}} </h4>
                <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">NOMBRE DEL PROYECTO: {{ $proyecto->nombre_proyecto }} </h4>
            </div>
        </div>
    </div>

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4">
                <label for="exampleInputEmail1">Selecciona capitulo</label>
                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="id_capitulo" name="id_capitulo" required>
                    <option disabled selected hidden>Selecciona una opción</option>
                    @foreach($capitulos as $capitulo)
                        <option value="{{ $capitulo->id_capitulo }}" data-esta="{{ $capitulo->capitulo }}">{{ $capitulo->capitulo }} </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4">
                <label>Ingresa importe de fuente de financiamiento estatal </label>
                <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="presupuesto_estatal"  name="presupuesto_estatal" type="number-only"   required />
                <div id="pesos_presupuesto_estatal">

                </div>
            </div>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4">
                <label>Ingresa importe de fuente de financiamiento federal</label>
                <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="presupuesto_federal" name="presupuesto_federal" type="number-only"   required />
                <div id="pesos_presupuesto_federal">

                </div>
            </div>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4">
                <label>Ingresa importe de fuente de financiamiento propios </label>
                <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="presupuesto_propios" name="presupuesto_propios" type="number-only"  required />
                <div id="pesos_presupuesto_propios">

                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready( function() {
       $("#presupuesto_estatal").change(function (event){
           var presupuesto_estatal_pesos= event.target.value;
           if(isNaN(presupuesto_estatal_pesos)){
               TNotify.alert( "La cantidad de fuente de financiamiento estatal debe ser un número");
               $('#pesos_presupuesto_estatal').empty();

           }else {
               var p_estatal_peso_mexicano = new Intl.NumberFormat("es-MX", {
                   style: "currency",
                   currency: "MXN"
               }).format(presupuesto_estatal_pesos);


               $('#pesos_presupuesto_estatal').empty();
               $('#pesos_presupuesto_estatal').append('<h2>' + p_estatal_peso_mexicano + '</option>');
           }
       });
        $("#presupuesto_federal").change(function (event){
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
        $("#presupuesto_propios").change(function (event){
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
