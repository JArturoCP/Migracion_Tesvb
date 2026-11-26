@extends('layouts.panel')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Programas de estudio" :migas="['Servicios escolares' => null]">
        <x-slot:extra>
            <input type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" data-toggle="modal" data-target="#modal_periodos_sumativas" value="Periodo de evaluaciones sumativas">
        </x-slot:extra>
    </x-panel.encabezado>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                
                <div class="tw:p-5 tw:sm:p-6">
                    @if($carreras!=null)
                        <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                            <ul class="tw:mb-6 tw:divide-y tw:divide-gray-100 tw:overflow-hidden tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                @foreach($carreras as $carrera)
                                    <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" data-toggle="pill" href="#" onclick="window.location='{{ url('/servicios_escolares/evaluaciones/'.$carrera->id_carrera ) }}'">   {{$carrera->carrera}}</a></li>

                                @endforeach
                            </ul>
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
    <div>


        <x-panel.modal id="modal_periodos_sumativas" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Periodo de evaluaciones sumativas</h4>
                    </div>
                    <div class="tw-modal-cuerpo tw:flex tw:flex-wrap tw:gap-y-4 tw:w-full tw:lg:w-full tw:px-2">
                        @if( $periodo_sumativas==0 )
                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                <label for="">Fecha de inicio</label>
                                <input type="date" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="fecha_inicio" name="fecha_inicio">
                            </div>
                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                <label for="">Fecha de finalización</label>
                                <input type="date" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="fecha_fin" name="fecha_fin">
                            </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="h-secondary_m tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button type="" class="h-primary_m tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" name="generar_periodo_sumativas" id="generar_periodo_sumativas">Aceptar</button>
                    </div>
                    @else
                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla-centrada border-table tw-tabla tw:my-0">
                            <thead>
                            <tr class="tw:text-center">
                                <th class="tw:text-center">Fecha de inicio</th>
                                <th class="tw:text-center">Fecha de finalización</th>
                                <th class="tw:text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td id="finicio_t" name="finicio_t">{{ $fsum_inicio}}</td>
                                <td id="ffin_t" name="ffin_t">{{$fsum_fin}}</td>
                                <td id="cont_btns" name="cont_btns">
                                    <input type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" id="modificav_sumativa" name="modificav_sumativa" value="Modificar">
                                    <input type="hidden" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" id="guarda_mods" name="guarda_mods" value="Guardar">
                                </td>
                            </tr>
                            </tbody>
                        </table>
</div>
                
                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                </div>
                @endif
            </x-panel.modal>
    </div>
    </div>
    <script>
        $("#generar_periodo_sumativas").on("click",function()
        {
            finicio=$("#fecha_inicio").val();
            ffin=$("#fecha_fin").val();
            if(finicio=="" || ffin=="")
            {
                swal({
                    position:"top",
                    type: "error",
                    title: "Deben llenarse todos los campos",
                    showConfirmButton: false,
                    timer: 2500
                });
            }
            else if(finicio == ffin)
            {
                swal({
                    position:"top",
                    type: "error",
                    title: "Las fechas no pueden ser iguales",
                    showConfirmButton: false,
                    timer: 2500
                });
            }
            else if(finicio >= ffin)
            {
                swal({
                    position:"top",
                    type: "error",
                    title: "la fecha inicial no puede ser mayor a la final",
                    showConfirmButton: false,
                    timer: 3000
                });
            }
            else
            {
                $.get('/servicios_escolares/genperiodoSumativas',{finicio:finicio,ffin:ffin},function(request){
                    $("#modal_periodos_sumativas").modal("hide");
                    swal({
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 1500
                    }). then(function(result)
                    {
                        location.reload(true);
                    });
                });
            }
        });
        $("#modificav_sumativa").on("click",function()
        {
            $("#finicio_t").html('<input  type="date" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:text-center" id="finicio_mod" name="finicio_mod" value="{{ $fsum_inicio}}">');
            $("#ffin_t").html('<input  type="date" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:text-center" id="ffin_mod" name="ffin_mod" value="{{ $fsum_fin}}">');
            $("#guarda_mods").get(0).type = 'button';
            $("#modificav_sumativa").get(0).type = 'hidden';
        });
        $("#guarda_mods").on("click",function()
        {
            finicio=$("#finicio_mod").val();
            ffin=$("#ffin_mod").val();
            fsum_inicio= "{{$fsum_inicio}}";
            fsum_fin= "{{$fsum_fin}}";
            if(finicio == fsum_inicio && ffin ==fsum_fin)
            {
                $("#modal_periodos_sumativas").modal("hide");
                swal({
                    type: "warning",
                    title: "No se realizarón modificaciones",
                    showConfirmButton: false,
                    timer: 1500
                }). then(function(result)
                {
                    $("#finicio_t").html('{{ $fsum_inicio}}');
                    $("#ffin_t").html('{{ $fsum_fin}}');
                    $("#guarda_mods").get(0).type = 'hidden';
                    $("#modificav_sumativa").get(0).type = 'button';

                });
            }
            else if(finicio=="" || ffin=="")
            {
                swal({
                    position:"top",
                    type: "error",
                    title: "Deben llenarse todos los campos",
                    showConfirmButton: false,
                    timer: 2500
                });
            }
            else if(finicio == ffin)
            {
                swal({
                    position:"top",
                    type: "error",
                    title: "Las fechas no pueden ser iguales",
                    showConfirmButton: false,
                    timer: 2500
                });
            }
            else if(finicio >= ffin)
            {
                swal({
                    position:"top",
                    type: "error",
                    title: "la fecha inicial no puede ser mayor a la final",
                    showConfirmButton: false,
                    timer: 3000
                });
            }
            else
            {
                $.get('/servicios_escolares/periodoSumativas/{{ $id_periodo_sum }}/modifica',{finicio:finicio,ffin:ffin},function(request){
                    $("#modal_periodos_sumativas").modal("hide");
                    swal({
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 1500
                    }). then(function(result)
                    {
                        location.reload(true);
                    });
                });
            }
        });



    </script>
</div>
@endsection