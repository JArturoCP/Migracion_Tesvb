<div class="tw-modal-cuerpo">

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:justify-center">
        <div class="tw:w-full tw:lg:w-9/12 tw:xl:w-8/12 tw:px-2">

            <div class="tw:mb-6">

                <label for="fecha_s" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-400">
                    <i class="fa fa-calendar tw:mr-2 tw:text-brand-500"></i>
                    Fecha de evaluación
                </label>

                <div class="tw:flex tw:w-full tw:items-stretch">
                    <span class="tw:inline-flex tw:h-full tw:items-center tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-3 tw:text-sm tw:text-gray-600 tw:dark:text-gray-400">
                        <i class="fa fa-calendar"></i>
                    </span>

                    <?php $fecha_periodo = date("d-m-Y", strtotime($fecha_final)); ?>

                    <input
                        class="datepicker tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"
                        type="text"
                        id="fecha_s"
                        name="fecha_s"
                        value="{{ $fecha_periodo }}"
                        placeholder="Seleccionar fecha"
                        autocomplete="off"
                    >
                </div>

                <div class="tw:mt-1 tw:block tw:text-xs">
                    Seleccione la fecha en la que se realizará la evaluación.
                </div>

            </div>

            {{-- OBSERVACIONES --}}
            <div class="tw:mb-4">

                <label for="observaciones" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-400">
                    <i class="fa fa-comment-o tw:mr-2 tw:text-brand-500"></i>
                    Observaciones
                </label>

                <textarea
                    class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"
                    id="observaciones"
                    name="observaciones"
                    rows="3"
                    placeholder="Escriba las observaciones..."
                ></textarea>

                <div class="tw:mt-1 tw:block tw:text-xs">
                    Agregue cualquier observación relacionada con la evaluación.
                </div>

            </div>

            <input
                type="hidden"
                id="id_periodo_cal"
                name="id_periodo_cal"
                value="{{ $id_periodo_cal }}"
            >

            <input
                type="hidden"
                id="id_docente"
                name="id_docente"
                value="{{ $id_docente }}"
            >

        </div>
    </div>

</div>

<div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:pb-2 tw:bg-gray-50 tw:dark:bg-gray-900">

    <button
        type="button"
        class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"
        data-bs-dismiss="modal"
    >
        <i class="fa fa-times-circle tw:mr-1"></i>
        Cancelar
    </button>

    <button
        id="modificar_periodo"
        style="display: none"
        type="submit"
        class="boton tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"
    >
        <i class="fa fa-check-circle tw:mr-1"></i>
        Guardar
    </button>

</div>
<script type="text/javascript">
    $(document).ready(function() {
        var numero = "<?php  echo $unidad;?>";
        var dia = "<?php  echo $di;?>";
        var posterior = "<?php  echo $numero;?>";
        if (numero == 1) {
            var dias_p = "<?php  echo $dias_p;?>";
            //   TNotify.alert(dias_p);
            if (dias_p == 1) {
                if (dia == 1) {
                    var fec = "<?php  echo $dias;?>";
                    var fecha = '+' + fec + 'd';
                    var fecho = posterior - 1;
                    var post = '+' + fecho + 'd';
                    $('#fecha_s').datepicker({
                        pickTime: false,
                        autoclose: true,
                        language: 'es',
                        startDate: fecha,
                        endDate: post,
                    });
                }
                if (dia == 2) {
                    var fec = "<?php  echo $dias;?>";
                    var fecha = '-' + fec + 'd';
                    var fecho = posterior - 1;
                    var post = '+' + fecho + 'd';
                    $('#fecha_s').datepicker({
                        pickTime: false,
                        autoclose: true,
                        language: 'es',
                        startDate: fecha,
                        endDate: post,
                    });
                }
            }
            if (dias_p == 2) {
                if (dia == 1) {
                    var fec = "<?php  echo $dias;?>";
                    var fecha = '+' + fec + 'd';
                    var fecho = posterior;
                    var post = '-' + fecho + 'd';
                    $('#fecha_s').datepicker({
                        pickTime: false,
                        autoclose: true,
                        language: 'es',
                        startDate: fecha,
                        endDate: post,
                    });
                }
                if (dia == 2) {
                    var fec = "<?php  echo $dias;?>";
                    var fecha = '-' + fec + 'd';
                    var fecho = posterior;
                    var post = '-' + fecho + 'd';
                    $('#fecha_s').datepicker({
                        pickTime: false,
                        autoclose: true,
                        language: 'es',
                        startDate: fecha,
                        endDate: post,
                    });
                }
            }
        }
        if (numero == 0) {
            if (dia == 1) {
                var fec = "<?php  echo $dias;?>";
                var fecha = '+' + fec + 'd';
                $('#fecha_s').datepicker({
                    pickTime: false,
                    autoclose: true,
                    language: 'es',
                    startDate: fecha,
                });
            }
            if (dia == 2) {
                var fec = "<?php  echo $dias;?>";
                var fecha = '-' + fec + 'd';
                $('#fecha_s').datepicker({
                    pickTime: false,
                    autoclose: true,
                    language: 'es',
                    startDate: fecha,
                });
            }
        }
        $("#fecha_s").change(function(e) {
            console.log(e);
            var fecha_i = "<?php  echo $fecha_i;?>";
            var fech = e.target.value;
            if (fech != "") {
                var f = fech.split("/").reverse().join("/")
                var fi = f.split("/").reverse().join("-")
                var fio = fi.split("-").reverse().join("-")
                if (fio >= fecha_i) {
                    $(".boton").css("display", "inline");
                } else {
                    swal({
                        position: "top",
                        type: "error",
                        title: "La fecha no debe menor a la de hoy",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            } else {
                swal({
                    position: "top",
                    type: "error",
                    title: "La fecha no debe ser vacia",
                    showConfirmButton: false,
                    timer: 3500
                });
            }
            // TNotify.alert(resultado);
        });
    });
</script>