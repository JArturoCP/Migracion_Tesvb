


<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">

    <div class="tw:mb-4">
        <label>Seleccionar fecha de evaluación:</label>

        <input class="datepicker tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  type="text"  id="fecha_s" name="fecha_s"  placeholder="dd/MM/YYYY" required>
        <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="hidden"  id="id_materia" name="id_materia"  value="{{ $id_materia }}">
        <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="hidden"  id="id_unidad" name="id_unidad"  value="{{ $id_unidad }}">
        <input  class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="hidden"  id="id_grupo" name="id_grupo"  value="{{ $id_grupo }}">
    </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready( function() {
        var dia="<?php  echo $di;?>";
        if(dia== 1){
            var fec="<?php  echo $dias;?>";
            var fecha='+'+fec+'d';
            $('#fecha_s').datepicker({
                pickTime: false,
                autoclose: true,
                language: 'es',
                startDate: fecha,
            });

        }
        if(dia== 2){
            var fec="<?php  echo $dias;?>";
            var fecha='+'+fec+'d';
            $('#fecha_s').datepicker({
                pickTime: false,
                autoclose: true,
                language: 'es',
                startDate: fecha,
            });

        }
        if(dia== 3){
            //var fec="<?php  echo $dias;?>";
            var fecha='+'+0+'d';
            $('#fecha_s').datepicker({
                pickTime: false,
                autoclose: true,
                language: 'es',
                startDate: fecha,
            });

        }

    });
</script>