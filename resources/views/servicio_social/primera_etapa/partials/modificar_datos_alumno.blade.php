<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  id="id_datos_alumnos" name="id_datos_alumnos" type="hidden"  value="{{$registro_tipo_empresa[0]->id_datos_alumnos  }}" required/>

    <div class="tw:w-full tw:px-2">
        <div class="tw:mb-4">
            <label for="nombre_proyecto">Ingresa tu correo electronico. (En el se te notificará, el estado que se encuentra tu documentación, si tienes que corregir o se encuentra autorizada).<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
            <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  id="correo_electronico" name="correo_electronico" type="email"  placeholder="Ingresa tu correo electronico" value="{{$registro_tipo_empresa[0]->correo_electronico  }}" required/>
        </div>
    </div>
</div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2" >
        <div class="tw:mb-4">
            <label for="exampleInputEmail1">La empresa donde llevaras a cabo tu servicio social es:<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="tipo_empresa" name="tipo_empresa" required>
                <option disabled selected hidden>Selecciona una opción</option>
                @foreach($tipos_empresas as $tipo_empresa)
                    @if($tipo_empresa->id_tipo_empresa==$registro_tipo_empresa[0]->id_tipo_empresa)
                        <option value="{{$tipo_empresa->id_tipo_empresa}}" selected="selected" >{{$tipo_empresa->tipo_empresa}}</option>
                    @else
                        <option value="{{$tipo_empresa->id_tipo_empresa}}"> {{$tipo_empresa->tipo_empresa}}</option>
                    @endif
                   @endforeach
            </select>
        </div>
    </div>
</div>