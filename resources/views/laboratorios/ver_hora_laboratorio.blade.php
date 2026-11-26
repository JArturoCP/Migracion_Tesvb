<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:lg:w-full tw:px-2">

                <h3 class="tw:text-center tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-green-700 tw:dark:text-green-400">{{$lab->descripcion}} ( {{$hora_semana->dia}}- {{ $hora_semana->hora }})</h3>

    </div>
</div>
{{ csrf_field() }}

<input type="hidden" id="id_laboratorio" name="id_laboratorio" value="{{ $lab->id_laboratorio }}">
<input type="hidden" id="id_semana" name="id_semana" value="{{ $id_semana }}">
<input type="hidden" id="fecha_registro" name="fecha_registro" value="{{ $fecha_registro }}">
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">
        <div class="tw:mb-4">
            <div class="tw:mb-4">
                <label for="personal">Personal TESVB</label>
                <select name="personal" id="personal" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                    <option disabled selected hidden>Selecciona personal</option>
                    @foreach($personales as $personal)
                        @if($personal->id_personal == $id_personal_lab)
                            <option value="{{$personal->id_personal}}" selected="selected">{{$personal->nombre}}</option>
                        @else
                        <option value="{{$personal->id_personal}}" >{{$personal->nombre}}</option>
                        @endif

                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
    <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">
        <div class="tw:mb-4">
            <label for="descripcion">Descripción</label>
            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="descripcion" name="descripcion" rows="3" placeholder="Ingresa el motivo ">{{ $com_lab }}</textarea>
        </div>
    </div>
</div>