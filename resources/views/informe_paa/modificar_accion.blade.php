
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <div class="tw:mb-4">
            <label for="dependencia">Descripcion de la Accion</label>
            <input type="hidden"  id="id_accion" name="id_accion"  value="{{  $accion->id_accion }}">
            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="accion" name="accion" rows="2"  required >{{ $accion->nom_accion }}</textarea>
        </div>
    </div>
</div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <div class="tw:mb-4">
            <label for="unidad">Unidad de Medida</label>
            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="select_unidad" name="select_unidad" required>
                <option disabled selected hidden>Selecciona una opción</option>
                @foreach($unidades as $unidad)
                    @if($accion->id_unimed==$unidad->id_unimed)
                        <option value="{{$unidad->id_unimed}}" selected="selected" >{{$unidad->nom_unimed}}</option>
                    @else
                        <option value="{{$unidad->id_unimed}}"> {{$unidad->nom_unimed}}</option>
                    @endif
                @endforeach
            </select>
        </div>



    </div>
</div>
