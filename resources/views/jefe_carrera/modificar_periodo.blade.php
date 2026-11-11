<div class="modal-body">

    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-8">

            <div class="mb-4">

                <label for="fecha_s" class="form-label fw-semibold">
                    <i class="bi bi-calendar-event me-2 text-primary"></i>
                    Fecha de evaluación
                </label>

                <div class="input-group">
                    <span class="input-group-text bg-light">
                        <i class="bi bi-calendar3"></i>
                    </span>

                    <?php $fecha_periodo = date("d-m-Y", strtotime($fecha_final)); ?>

                    <input
                        class="form-control datepicker"
                        type="text"
                        id="fecha_s"
                        name="fecha_s"
                        value="{{ $fecha_periodo }}"
                        placeholder="Seleccionar fecha"
                        autocomplete="off"
                    >
                </div>

                <div class="form-text">
                    Seleccione la fecha en la que se realizará la evaluación.
                </div>

            </div>

            {{-- OBSERVACIONES --}}
            <div class="mb-3">

                <label for="observaciones" class="form-label fw-semibold">
                    <i class="bi bi-chat-left-text me-2 text-primary"></i>
                    Observaciones
                </label>

                <textarea
                    class="form-control"
                    id="observaciones"
                    name="observaciones"
                    rows="3"
                    placeholder="Escriba las observaciones..."
                ></textarea>

                <div class="form-text">
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

<div class="modal-footer bg-light">

    <button
        type="button"
        class="btn btn-secondary"
        data-bs-dismiss="modal"
    >
        <i class="bi bi-x-circle me-1"></i>
        Cancelar
    </button>

    <button
        id="modificar_periodo"
        style="display: none"
        type="submit"
        class="btn btn-primary boton"
    >
        <i class="bi bi-check-circle me-1"></i>
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
            //   alert(dias_p);
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
            // alert(resultado);
        });
    });
</script>