<div class="tw:px-6 tw:pt-6 tw:pr-14 tw:bg-sky-100">
    <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center" id="myModalLabel">Agregar actividad(es) en la  semana {{ $no_semana }} </h4>
</div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">

        <div class="tw:mb-4">
            <label>Fecha inicial de la(s) actividad(es):</label>

                 <input type='text' readonly="readonly" id="fecha_inicial" name="fecha_inicial" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="yyyy/mm/dd" required value="{{  $fecha_semana->fecha }}" />

              <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="hidden"  id="id_anteproyecto" name="id_anteproyecto"  value="{{ $id_anteproyecto }}">
            <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="hidden"  id="no_semana" name="no_semana"  value="{{ $no_semana }}">

        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker11').datepicker({
                daysOfWeekDisabled: [0,2,3,4,5,6],
                startDate: '+0d',
                autoclose: true,
                language: 'es'
            });
        });

    </script>
    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">

        <div class="tw:mb-4">
            <label for="fecha final">Fecha final de la(s) actividad(es)</label>

            <div id="soli" class="tw:mb-4"></div>


        </div>
    </div>
</div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <div class="tw:mb-4">
            <label for="actividad">Ingresa actividad(es)</label>
            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="actividad" name="actividad"  rows="4" placeholder="Ingresa actividad(es)" required></textarea>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready( function() {


            var fech= "<?php  echo $fecha_semana->fecha ?>";
           // TNotify.alert(fech);
            var TuFecha = new Date(fech);
            var dias = 5;
            //nueva fecha sumada
            TuFecha.setDate(TuFecha.getDate() + dias);
            //formato de salida para la fecha
            var  resultado = TuFecha.getFullYear() + '/' +
                (TuFecha.getMonth() + 1) + '/' + TuFecha.getDate();
            $('#soli').empty();
            $('#soli').append('<input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="fecha_final" readonly="readonly" name="fecha_final" value="'+resultado+'"/>');
            // TNotify.alert(resultado);



    });
</script>