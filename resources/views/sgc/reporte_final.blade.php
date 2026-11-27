@extends('layouts.panel')
@section('title', 'Reporte final')
@include('partials.panel.recursos_app', ['ordenable' => true])
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Reporte final del programa de auditorías" :migas="['Sistema de gestión de calidad' => null]" />
    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                @if (session()->has('flash_notification.message'))
                    <x-panel.alerta :tipo="['success' => 'exito', 'danger' => 'error', 'warning' => 'advertencia'][session('flash_notification.level')] ?? 'info'" class="tw:mb-4">{!! session('flash_notification.message') !!}</x-panel.alerta>
                @endif
            </div>
        </div>
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                @foreach($programas as $programa)
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                    <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90 tw:text-center">Reporte final del programa de auditorias
                    <strong>
                        {{\Carbon\Carbon::parse($programa->fecha_i)->locale('es')->translatedFormat('F')}} - {{\Carbon\Carbon::parse($programa->fecha_f)->locale('es')->translatedFormat('F Y')}}
                    </strong></h3>
                </div>
                <div class="tw:p-5 tw:sm:p-6">
                    <ul class="droptrue tw:divide-y tw:divide-gray-100 tw:rounded-lg tw:border tw:border-gray-200 tw:dark:border-gray-800" id="sortable2">
                        @foreach($notas as $nota)
                            <li class="nota_final tw:block tw:px-4 tw:py-3" contenteditable="true">
                                <strong>{{$nota->proceso}}</strong>
                                <p>{{$nota->descripcion}}</p>
                            </li>
                        @endforeach
                    </ul>
                    <button class="guarda_informe tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Guardar e Imprimir</button>
                </div>
                @endforeach
            </div>
        </div>
    </main>
    <script>
        $(document).ready(function () {
            $('.guarda_informe').click(function () {
                var notas_finales=[];
                @foreach($programas as $programa)
                    notas_finales[notas_finales.length]="{{\Carbon\Carbon::parse($programa->fecha_i)->locale('es')->translatedFormat('F')}} - {{\Carbon\Carbon::parse($programa->fecha_f)->locale('es')->translatedFormat('F Y')}}";

                    $('.nota_final').each(function () {
                        var datos={"proceso":$(this).find('strong').text(),"descripcion":$(this).find('p').text()}
                        notas_finales.push(datos);
                    });
                    notas_finales=JSON.stringify(notas_finales);
                    window.open('{{url('sgc/print_reporte')}}/'+notas_finales,'_blank',"fullscreen=yes");
                @endforeach
                console.log(notas_finales);
            });
            $( "ul.droptrue" ).sortable({
                connectWith: "ul",
                cursor: 'grabbing',
                placeholder: "alert alert-success",
                forcePlaceholderSize: true
            });
        })
    </script>
</div>
@endsection