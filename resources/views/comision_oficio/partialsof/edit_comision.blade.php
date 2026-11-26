

                @if($mensaje == 1)
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <label class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700 tw:text-center"  data-toggle="tab" ><h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300">Si requiere modificar el dia  del horario de salida o el dia  del horario de regreso se eliminaran el comisionado o los comisionados agregados a esta comisión los cuales son:<br>
                               @foreach($comisionadosauto as $comisionado)
                                   <p>{{$comisionado->nombre}}</p>
                                @endforeach</h5></label>
                        </div>
                    </div>
                @endif
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4">
                                <label for="descripcion_oficio">Motivo de la comisión</label>
                                <input type="hidden" id="id_oficio" name="id_oficio" value="{{ $oficio->id_oficio }}">
                                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="descripcion_oficio" name="descripcion_oficio" rows="3"  required>{{ $oficio->desc_comision }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <label for="fechadesalida">Horario de salida a la comisión</label>
                            <div class="tw:w-full tw:lg:w-5/12 tw:px-2">
                                <div class="tw:mb-4">
                                    <input  id="hora_s" type="text" class="time tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="hora_s"  value="{{ $oficio->hora_s }}"  required />
                                </div>
                            </div>
                            <div class="tw:w-full tw:lg:w-5/12 tw:px-2">
                                <div class="tw:mb-4">
                                    <input class="datepicker fecha_salida tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   type="text"  id="fecha_s" name="fecha_salida" data-date-format="yyyy/mm/dd" value="{{ $oficio->fecha_salida }}"  required>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <label for="fecha_regreso">Horario de regreso de la comisión</label>
                            <div class="tw:w-full tw:lg:w-5/12 tw:px-2">
                                <div class="tw:mb-4">
                                    <input id="hora_r" type="text" class="time tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="hora_r" value="{{ $oficio->hora_r }}"   required />
                                </div>
                            </div>
                            <div class="tw:w-full tw:lg:w-5/12 tw:px-2">
                                <div class="tw:mb-4">
                                    <input class="datepicker fecha_regreso tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="text" id="fecha_r" name="fecha_regreso" data-date-format="yyyy/mm/dd" value="{{ $oficio->fecha_regreso }}"  required>
                                </div>

                            </div>
                        </div>
                        <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="selectLugar_s">Lugar de salida</label>
                                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="selectLugar_s" name="selectLugar_s"  required >
                                        <option disabled selected hidden>Selecciona una opción</option>
                                        @foreach($lugares as $lugar)
                                            @if($oficio->id_lugar_salida==$lugar->id_lugar)
                                                <option value="{{$lugar->id_lugar}}" selected="selected" >{{$lugar->descripcion}}</option>
                                            @else
                                                <option value="{{$lugar->id_lugar}}"> {{$lugar->descripcion}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="selectLugar_r">Lugar de regreso</label>
                                    <select name="selectLugar_r" id="selectLugar_r" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  required>
                                        <option disabled selected hidden>Selecciona una opción</option>
                                        @foreach($lugares as $lugar)
                                            @if($oficio->id_lugar_entrada==$lugar->id_lugar)
                                                <option value="{{$lugar->id_lugar}}" selected="selected" >{{$lugar->descripcion}}</option>
                                            @else
                                                <option value="{{$lugar->id_lugar}}"> {{$lugar->descripcion}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
        <script type="text/javascript">
            $(document).ready( function() {

                var getDate = function (input) {
                    return new Date(input.date.valueOf());
                }
                $( '.fecha_salida').datepicker({
                    pickTime: false,
                    autoclose: true,
                    language: 'es',
                    startDate: '+0d',
                }).on('changeDate',
                    function (selected) {
                        $('.fecha_regreso').datepicker('setStartDate', getDate(selected));
                    });
                $( '.fecha_regreso' ).datepicker({
                    pickTime: false,
                    autoclose: true,
                    language: 'es',
                    startDate: '+0d',
                }).on('changeDate',
                    function (selected) {
                        $('.fecha_salida').datepicker('setEndDate', getDate(selected));
                    });

                $('#hora_s').pickatime({
                    format: 'HH:i',
                    container: 'body',
                    autoclose: true,
                    vibrate: false,

                });
                $('#hora_r').pickatime({

                    format: 'HH:i',
                    container: 'body',
                    autoclose: true,
                    vibrate: false,
                });
            });
        </script>