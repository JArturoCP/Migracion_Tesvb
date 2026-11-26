
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <div class="tw:mb-4">
            <label for="descripcion_oficio">Nombre del comisionado</label>
            <input type="hidden" id="id_oficio_comisionado" name="id_oficio_comisionado" value="{{ $comisionado->id_oficio_personal }}">
            <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="text" id="nombre" readonly="readonly" name="nombre" value="{{ $comisionado->nombre }}">

        </div>
    </div>
</div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
        <div class="tw:mb-4">
            <label for="selectLugar_s">Viaticos</label>
            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="viaticos" name="viaticos"  required >
                <option disabled selected hidden>Selecciona una opción</option>
                @foreach($respuestas as $respuestas)
                    @if($comisionado->viaticos==$respuestas->id_respuesta)
                        <option value="{{$respuestas->id_respuesta}}" selected="selected" >{{$respuestas->respuesta}}</option>
                    @else
                        <option value="{{$respuestas->id_respuesta}}"> {{$respuestas->respuesta}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
        <div class="tw:mb-4">
            <label for="selectLugar_s">Automovil</label>
            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="automoviles" name="automoviles"  required >
                <option disabled selected>Selecciona...</option>
                @foreach($respuestass as $respuestass)
                    @if($comisionado->automovil==$respuestass->id_respuesta)
                        <option value="{{$respuestass->id_respuesta}}" selected="selected" >{{$respuestass->respuesta}}</option>
                    @else
                        <option value="{{$respuestass->id_respuesta}}"> {{$respuestass->respuesta}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
</div>
@if($auto ==1)
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" style="display: none" id="lleva_auto">
    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
        <div class="tw:mb-4">
            <label for="automovil">Automovil</label>

                <select class="required tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="selecciona una Opcion" id="automovil" name="automovil"  >
                    <option disabled selected hidden>Selecciona una opción</option>
                    @foreach($automoviles as $automoviles)
                        <option value="{{$automoviles->id_vehiculo}}" data-esta="{{$automoviles->modelo}}">{{$automoviles->modelo}} {{$automoviles->placas}}</option>
                    @endforeach
                </select>



        </div>
    </div>
    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
        <div class="tw:mb-4">
            <label for="licencia">licencia</label>
            <input class="required tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="licencia" name="licencia" />
        </div>
    </div>
</div>
    @elseif($auto ==2)
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" style="display: inline" id="lleva_auto">
        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
            <div class="tw:mb-4">
                <label for="automovil">Automovil</label>
                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="automovil" name="automovil" >
                    @foreach($automoviles as $automoviles)
                        @if($auto_comisionado->id_vehiculo==$automoviles->id_vehiculo)
                            <option value="{{$automoviles->id_vehiculo}}" selected="selected" >{{$automoviles->modelo}} {{$automoviles->placas}}</option>
                        @else
                            <option value="{{$automoviles->id_vehiculo}}"> {{$automoviles->modelo}} {{$automoviles->placas}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
            <div class="tw:mb-4">
                <label for="licencia">licencia</label>
                <input class="required tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="licencia" name="licencia" value="{{$auto_comisionado->licencia}}" />
            </div>
        </div>
    </div>
@endif
<script>

    $(document).ready(function() {

        $("#automoviles").change(function() {
            var auto=$(this).val();
            if(auto ==2){
                $("#lleva_auto").css("display", "block");




            } if(auto ==1){
                $("#lleva_auto").css("display", "none");




            }
        });
    });

</script>