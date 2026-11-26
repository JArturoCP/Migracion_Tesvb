@extends('layouts.panel')
@section('title', 'Laboratorios')
@include('partials.panel.recursos_app', ['datepicker' => true])
@section('content')
<div class="tw-pantalla">
    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <x-panel.encabezado titulo="Consultar Laboratorios" :migas="['Laboratorios' => null]" />
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">
                <div class="tw:mb-4">
                    <div class="tw:mb-4">
                        <label for="laboratorio">Laboratorios</label>
                        <select name="laboratorio" id="laboratorio" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" >
                            <option  disabled selected hidden>Selecciona Laboratorio</option>
                            @foreach($laboratorios as $laboratorio)

                                <option value="{{$laboratorio->id_laboratorio}}" >{{$laboratorio->descripcion}}</option>

                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="tw:w-full" id="mostrar" style="display:none;">
                <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
                    <div class="tw:mb-4">
                        <label for="deparamento">Selecciona fecha Inicial</label>
                        <div class='date tw:flex tw:w-full tw:items-stretch' data-date-format="yyyy/mm/dd" id='datetimepicker11' >
                            <input type='text' id="fecha_inicial" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required />
                            <span class="input-group-addon tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-3 tw:text-sm tw:text-gray-600 tw:dark:text-gray-400">
                                        <span class="fa fa-calendar">
                                     </span>
                                    </span>
                        </div>
                    </div>

                    <script type="text/javascript">
                        $(function () {
                            $('#datetimepicker11').datepicker({
                                daysOfWeekDisabled: [0,2,3,4,5,6],
                                autoclose: true,
                                language: 'es'
                            });
                        });

                    </script>
                </div>
            </div>
            <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4" id="mostrar_fecha_f" style="display:none;">
                <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
                    <label for="fecha final">Fecha final</label>
                    <div id="soli" class="tw:mb-4"></div>
                </div>
                <div class="tw:w-full tw:lg:w-1/12 tw:px-2">
                    <button id="guardar_solicitud" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Mostrar</button>
                </div>
            </div>




        </div>





    </main>

    <script type="text/javascript">

        $(document).ready( function() {
            $("#guardar_solicitud").click(function (event) {
                var laboratorio=$("#laboratorio").val();
                var fecha_i=$("#fecha_inicial").val();
                var fecha_f=$("#fecha_final").val();
                var fecha_inicial = fecha_i.split("/").reverse().join("-");
                var fecha_final = fecha_f.split("/").reverse().join("-");

                window.location.href='/laboratorios/mostrar/'+laboratorio+'/'+fecha_inicial+'/'+fecha_final ;
            });
            $("#laboratorio").change(function() {
                $("#mostrar").css("display", "inline");
            });
            $("#datetimepicker11").change(function(e){
                $("#mostrar_fecha_f").css("display", "inline");
                var fech= e.target.value;
                var TuFecha = new Date(fech);
                var dias = 5;
                //nueva fecha sumada
                TuFecha.setDate(TuFecha.getDate() + dias);
                //formato de salida para la fecha
                var  resultado = TuFecha.getFullYear() + '/' +
                    (TuFecha.getMonth() + 1) + '/' + TuFecha.getDate();
                $('#soli').empty();
                $('#soli').append('<input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="fecha_final" disabled value="'+resultado+'"/>');
                // TNotify.alert(resultado);

            });


        });
    </script>

</div>
@endsection