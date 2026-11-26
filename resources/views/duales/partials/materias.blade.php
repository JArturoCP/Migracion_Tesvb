@if($estado_alumno->estado_validacion == 8)

<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">

        <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700 tw:text-center tw:border-green-200 tw:bg-green-50 tw:text-green-800">

            <span class="fa fa-lock tw:mb-2 tw:block tw:text-2xl"></span>

            <strong>La carga académica ha sido autorizada.</strong>

            <br>

            <span>
                No es posible realizar modificaciones.
            </span>

        </div>

    </div>
</div>

@else

<input type="hidden" id="id_duales_actuales" name="id_duales_actuales" value="{{ $id_duales_actuales }}">

@foreach($reticulas as $reti)

<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

    <div class="tw:w-full tw:px-2">

        <div class="reticula-container tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

            <!-- ENCABEZADO RETÍCULA -->

            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">

                <h4 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">

                    <a class="tw:text-brand-500 tw:hover:underline" data-toggle="collapse" data-parent="#accordion-reticulas"
                        href="#reticula{{ $reti["id_reticula"] }}">

                        <span class="fa fa-graduation-cap"></span>

                        {{ $reti["reticula"] }}

                        <span class="fa fa-chevron-down tw:float-right"></span>

                    </a>

                </h4>

            </div>

            <!-- CONTENIDO RETÍCULA -->

            <div id="reticula{{ $reti["id_reticula"] }}" class="collapse">

                <div class="tw:p-5 tw:sm:p-6">

                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                        <!-- ================================= -->
                        <!-- SEMESTRES -->
                        <!-- ================================= -->

                        <div class="semestres tw:w-full tw:lg:w-3/12 tw:px-2 tw:p-3">

                            <div class="list-group tw-lista-pestanas tw:divide-y tw:divide-gray-100 tw:rounded-lg tw:border tw:border-gray-200 tw:dark:border-gray-800">

                                @foreach($reti["semestres"] as $semes)

                                <a href="#tab{{ $reti["id_reticula"] }}{{ $semes["id_semestre"] }}" role="tab"
                                    data-toggle="tab" class="list-group-item tw:block tw:px-4 tw:py-3">

                                    <span class="fa fa-calendar"></span>

                                    {{ $semes["semestre"] }}

                                </a>

                                @endforeach

                            </div>

                        </div>

                        <!-- ================================= -->
                        <!-- MATERIAS -->
                        <!-- ================================= -->

                        <div class="tw:w-full tw:lg:w-9/12 tw:px-2">

                            <div class="tab-content">

                                @foreach($reti["semestres"] as $semes)

                                <div role="tabpanel" class="tab-pane fade"
                                    id="tab{{ $reti["id_reticula"] }}{{ $semes["id_semestre"] }}">

                                    <div class="tw:p-3">

                                        <h4 class="tw:mb-4 tw:font-semibold tw:text-gray-800 tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">

                                            <span class="fa fa-book"></span>

                                            Materias de
                                            <strong>
                                                {{ $semes["semestre"] }}
                                            </strong>

                                        </h4>

                                        <div class="tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800">

                                            <table class="tw-tabla tw-tabla-bordes">

                                                <thead>

                                                    <tr>

                                                        <th>
                                                            Seleccionar
                                                        </th>

                                                        <th>
                                                            Materia
                                                        </th>

                                                        <th class="tw:w-30">
                                                            Clave
                                                        </th>

                                                    </tr>

                                                </thead>

                                                <tbody>

                                                    @foreach($semes["materias"] as $materias)

                                                    <?php $bandera = false; ?>

                                                    @foreach($materias_alumnos_duales as $ma_al_du)

                                                    @if($ma_al_du->id_materia == $materias["id_materia"])

                                                    <?php $bandera = true; ?>

                                                    @endif

                                                    @endforeach

                                                    <tr>

                                                        <!-- CHECKBOX -->

                                                        <td class="check-materia">

                                                            <input type="checkbox" name="materia[]"
                                                                id="materia{{ $materias["id_materia"] }}"
                                                                value="{{ $materias["id_materia"] }}"
                                                                {{ $bandera ? 'checked' : '' }}>

                                                        </td>

                                                        <!-- MATERIA -->

                                                        <td>

                                                            <label class="tw:cursor-pointer tw:m-0 tw:w-full" for="materia{{ $materias["id_materia"] }}"
                                                               >

                                                                <span class="tw:font-medium">

                                                                    {{ $materias["materia"] }}

                                                                </span>

                                                            </label>

                                                        </td>

                                                        <!-- CLAVE -->

                                                        <td class="tw:text-center">

                                                            <span class="tw:font-semibold tw:text-gray-500 tw:dark:text-gray-400">

                                                                {{ $materias["clave"] }}

                                                            </span>

                                                        </td>

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

        </div>

    </div>

</div>

@endforeach

<script>
    $(document).ready(function() {
        /*
         * ====================================================
         * ABRIR AUTOMÁTICAMENTE EL PRIMER SEMESTRE
         * ====================================================
         */
        $('.reticula-container').each(function() {
            var primerSemestre = $(this)
                .find('.list-group-item')
                .first();
            if (primerSemestre.length) {
                primerSemestre.addClass('active');
                var target = primerSemestre.attr('href');
                $(target).addClass('in active');
            }
        });
        /*
         * ====================================================
         * CAMBIAR SEMESTRE
         * ====================================================
         */
        $('.semestres .list-group-item').on('click', function() {
            $(this)
                .closest('.list-group')
                .find('.list-group-item')
                .removeClass('active');
            $(this).addClass('active');
        });
    });
</script>

@endif