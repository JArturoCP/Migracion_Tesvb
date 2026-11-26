<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:lg:w-full tw:px-2">

        <h3 class="tw:text-center tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-blue-700 tw:dark:text-blue-400">{{$lab->descripcion}} ( {{$hora->dia}}- {{ $hora->hora }})</h3>

    </div>
</div>
@if($estado_hora == 0)
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <x-panel.alerta tipo="exito" class="tw:mb-4">
              Disponible
            </x-panel.alerta>
        </div>

    </div>

@else
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <x-panel.alerta tipo="error" class="tw:mb-4">
                Esta apartado por:
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                    <thead>
                    <tr>
                        <th>Personal del TESVB</th>
                        <th>Fecha</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($personas as $persona)
                    <tr>
                        <td>{{ $persona->nombre }}</td>
                        <td>{{{ $persona->fecha_registro }}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
</div>
            </x-panel.alerta>
        </div>

    </div>
@endif

{{ csrf_field() }}

<input type="hidden" id="id_laboratorio1" name="id_laboratorio1" value="{{ $id_laboratorio }}">
<input type="hidden" id="id_semana1" name="id_semana1" value="{{ $id_semana_profesor }}">
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
            <label for="descripcion1">Descripción</label>
            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="descripcion" name="descripcion" rows="3" placeholder="Ingresa el motivo ">{{ $com_lab }}</textarea>
        </div>
    </div>
</div>
