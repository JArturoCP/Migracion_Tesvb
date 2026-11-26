@extends('layouts.panel')
@include('partials.panel.recursos_app', ['ordenable' => true])
@section('title', 'Reporte final')
@section('content')
    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-6/12 tw:lg:ml-[25%] tw:px-2">
                @if (session()->has('flash_notification.message'))
                    <div class="alert alert-{{ session('flash_notification.level') }} tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm">
                        <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {!! session('flash_notification.message') !!}
                    </div>
                @endif
            </div>
        </div>
        <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                @foreach($programas as $programa)
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                    <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:text-center">Reporte final del programa de auditorias
                    <strong>
                        {{\Carbon\Carbon::parse($programa->fecha_i)->locale('es')->translatedFormat('F')}} - {{\Carbon\Carbon::parse($programa->fecha_f)->locale('es')->translatedFormat('F Y')}}
                    </strong></h3>
                </div>
                <div class="tw:p-5 tw:sm:p-6">
                    <ul class="droptrue tw:divide-y tw:divide-gray-100 tw:rounded-lg tw:border tw:border-gray-200" id="sortable2">
                        @foreach($notas as $nota)
                            <li class="nota_final tw:block tw:px-4 tw:py-3" contenteditable="true">
                                <strong>{{$nota->proceso}}</strong>
                                <p>{{$nota->descripcion}}</p>
                            </li>
                        @endforeach
                    </ul>
                    <button class="guarda_informe tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Guardar e Imprimir</button>
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
@endsection