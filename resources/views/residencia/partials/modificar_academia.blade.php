
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   type="hidden"  id="id_academica" name="id_academica"  value="{{ $academia->id_academia }}"  required>

    <div class="tw:w-full tw:px-2">
        <div class="tw:mb-4">
            <label for="exampleInputEmail1">Nombre del profesor</label>
            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="id_profesor" name="id_profesor" >
                <option disabled selected hidden>Selecciona una opción</option>
                @foreach($plantillas as $plantilla)
                    @if($plantilla->id_personal==$academia->id_profesor)
                        <option value="{{$academia->id_profesor}}" selected="selected">{{$plantilla->nombre}}</option>
                    @else
                        <option value="{{$plantilla->id_personal}}">{{$plantilla->nombre}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <div class="tw:mb-4">
            <div class="tw:mb-4">
                <label for="exampleInputEmail1">Cargos de Academia<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="id_cargo" name="id_cargo" value="" required>
                    <option disabled selected hidden>Selecciona una opción</option>
                    @foreach($cargos_academia as $cargos_academia)
                        @if($cargos_academia->id_cargo_academia==$academia->id_cargo_academia)
                            <option value="{{$academia->id_cargo_academia}}" selected="selected">{{$cargos_academia->cargo}}</option>
                        @else
                            <option value="{{$cargos_academia->id_cargo_academia}}">{{$cargos_academia->cargo}}</option>
                        @endif
                    @endforeach

                </select>
            </div>
        </div>
    </div>
</div>