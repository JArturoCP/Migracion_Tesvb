@if($estado_alumno->estado_validacion == 8)
    <x-panel.alerta tipo="error" class="tw:mb-4"><h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center" >La carga academica ha sido autorizada no puede hacer modificaciones</h3></x-panel.alerta>
@else
    <input type="hidden" id="id_duales_actuales" name="id_duales_actuales" value="{{$id_duales_actuales}}">
    @foreach($reticulas as $reti)
        <div class="tw:w-full tw:px-2 tw:text-center" id="accordion" >
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                    <h4 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">
                        <a class="tw:text-brand-500 tw:hover:underline" data-toggle="collapse" data-parent="#accordion" href="#{{ $reti ["id_reticula"]}}r">
                            {{ $reti ["reticula"]}}</a>
                    </h4>
                </div>
                <div id="{{ $reti ["id_reticula"]}}r" class="collapse">
                    <div class="tw:p-5 tw:sm:p-6">

                        <div class="cont ml tw:w-full tw:divide-y tw:divide-gray-100 tw:rounded-lg tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:lg:w-4/12 tw:px-2">
                            @foreach($reti["semestres"] as $semes)
                                <a href="#tab{{ $reti ["id_reticula"]}}{{ $semes["id_semestre"] }}" role="tab" data-toggle="tab" class="tw:block tw:px-4 tw:py-3">{{ $semes ["semestre"]}}</a>
                            @endforeach
                        </div>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            @foreach($reti["semestres"] as $semes)
                                <div role="tabpanel" class="tab-pane fade" id="tab{{ $reti ["id_reticula"]}}{{ $semes["id_semestre"] }}">
                                    <div class="tw:w-full tw:px-2">
                                        <div class="tw:w-full tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03] tw:text-center tw:px-2">
                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" >Materias {{ $semes["semestre"] }}</h4>
                                        </div>
                                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="pagina ml tw-tabla tw-tabla-bordes">
                                            <thead>
                                            <tr class="tw:bg-sky-50">
                                                <th></th>
                                                <th class="tw:text-center" >Materia</th>
                                                <th class="tw:text-center" >Clave</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($semes["materias"] as $materias)
                                                <?php $bandera=false; ?>
                                                <tr>
                                                    <td>
                                                        @foreach($materias_alumnos_duales as $ma_al_du)
                                                            @if($ma_al_du->id_materia==$materias["id_materia"])
                                                                <?php $bandera=true ?>
                                                            @endif

                                                        @endforeach
                                                        @if($bandera)
                                                            <input type="checkbox" checked="checked" name="materia[]" id="{{ $materias["id_materia"]}}" value="{{ $materias["id_materia"]}}">
                                                        @else
                                                            <input type="checkbox" name="materia[]" id="{{ $materias["id_materia"]}}" value="{{ $materias["id_materia"]}}">
                                                        @endif
                                                    </td>
                                                    <td>{{ $materias["materia"]}}</td>
                                                    <td>{{ $materias["clave"] }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

