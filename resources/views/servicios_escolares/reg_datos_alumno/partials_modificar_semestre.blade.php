<form  id="form_guardar_mod_semestre" action="{{url("/servicios_escolares/guardar_mod_semestre_al/".$datos_actu->id_semestres_al)}}" role="form" method="POST" enctype="multipart/form-data" >
    {{ csrf_field() }}
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <div class="tw:mb-4">
            <label for="exampleInputEmail1">Selecciona periodo que ingreso el estudiante al TESVB </label>
            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="mod_id_periodo" name="mod_id_periodo" required>
                <option disabled selected hidden>Selecciona una opción</option>
                @foreach($periodos as $periodo)
                    @if($periodo->id_periodo==$datos_actu->id_periodo)
                        <option value="{{$periodo->id_periodo}}" selected="selected" >{{$periodo->periodo}}</option>
                    @else
                        <option value="{{$periodo->id_periodo}}"> {{$periodo->periodo}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <div class="tw:mb-4">
            <label for="exampleInputEmail1">Selecciona semestre que ingreso el estudiante al TESVB </label>
            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="mod_id_semestre" name="mod_id_semestre" required>
                <option disabled selected hidden>Selecciona una opción</option>
                @foreach($semestres as $semestre)
                    @if($semestre->id_semestre==$datos_actu->id_semestre)
                        <option value="{{$semestre->id_semestre}}" selected="selected" >{{$semestre->descripcion}}</option>
                    @else
                        <option value="{{$semestre->id_semestre}}"> {{$semestre->descripcion}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
</div>
</form>