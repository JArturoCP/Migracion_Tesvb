@extends('layouts.panel')
@section('title', 'Calendario de Actividades')
@include('tutorias.partials.recursos_panel', ['calendario' => true])
@section('content')
    @include('tutorias.alumnos.partial.navegacion_panel', ['titulo' => 'Calendario de Actividades', 'activa' => '/tutorias/calendario'])

    <div id="content-info">
        <form id="form-acti" >
            {{ csrf_field() }}
            <x-panel.tarjeta>
                {{-- FullCalendar 3 (mismas opciones y eventos); estilos del tema en resources/css/panel/librerias.css. --}}
                <div id="calendar" class="tw-calendario"></div>
            </x-panel.tarjeta>
        </form>
    </div>

    <x-panel.modal id="myModal">
        <x-slot:encabezado>
            <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="tituloEvento"></h5>
        </x-slot:encabezado>
        <ul class="tw:divide-y tw:divide-gray-100 tw:rounded-xl tw:border tw:border-gray-200">
            <li class="tw:px-4 tw:py-3">
                <p class="tw:text-xs tw:font-medium tw:text-gray-500">Objetivo:</p>
                <p class="tw:text-sm tw:text-gray-800" id="objetivoEvento"></p>
            </li>
            <li class="tw:px-4 tw:py-3">
                <p class="tw:text-xs tw:font-medium tw:text-gray-500">Estrategia:</p>
                <p class="tw:text-sm tw:text-gray-800" id="descEvento"></p>
            </li>
        </ul>
        <x-slot:pie>
            <x-panel.boton variante="secundario" data-dismiss="modal">Cerrar</x-panel.boton>
        </x-slot:pie>
    </x-panel.modal>

    <script src="{{asset('/js/js_tutorias/js/jquery.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                buttonIcons: true,
                weekNumbers: false,
                editable: true,
                eventLimit: true,
                events: [
                        @foreach ($evento as $even)
                    {
                        title: '{{ $even->desc_actividad }}',
                        allDay: true,
                        start: '{{ $even->fi_actividad }}',
                        end:'{{ $even->ff_actividad}}',
                        color: '#6dad75',
                        textColor: '#080808',

                    },
                    @endforeach

                ],
                eventClick:function (calEvent,jsEvent,view) {
                    $('#tituloEvento').html(calEvent.title);
                    $('#objetivoEvento').html(calEvent.objetivo);
                    $('#descEvento').html(calEvent.estrategia);
                    $('#myModal').modal('show');
                }
            });
        });
    </script>
@endsection
