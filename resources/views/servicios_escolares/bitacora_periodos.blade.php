@extends('layouts.panel')
@section('title', 'S.Escolares')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Periodos modificados" :migas="['Servicios escolares' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_enviado" class="tw-tabla-centrada border-table tw-tabla tw:my-0">
                        <thead>
                            <tr class="tw:text-center">
                                <th class="tw:text-center">Carrera</th>
                                <th class="tw:text-center">Docente</th>
                                <th class="tw:text-center">Materia</th>
                                <th class="tw:text-center">Grupo</th>
                                <th class="tw:text-center">Unidad</th>
                                <th class="tw:text-center">Fecha anterior</th>
                                <th class="tw:text-center">fecha actual</th>
                                <th class="tw:text-center">Observaciones</th>
                                <th class="tw:text-center">Fecha en la que se realizo el cambio</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($array_periodos as $bt_periodo)
                            <tr>
                                <td>{{$bt_periodo->{'carrera'} }}</td>
                                <td>{{$bt_periodo->{'docente'} }}</td>
                                <td>{{$bt_periodo->{'materia'} }}</td>
                                <td>{{$bt_periodo->{'semestre'} }}0{{$bt_periodo->{'id_grupo'} }}</td>
                                <td>Unidad {{$bt_periodo->{'unidad'} }}</td>
                                <td>{{$bt_periodo->{'fecha_antigua'} }}</td>
                                <td>{{$bt_periodo->{'fecha_nueva'} }}</td>
                                <td>{{$bt_periodo->{'observaciones'} }}</td>
                                <td>{{$bt_periodo->{'created_at'} }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
</div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table_enviado').DataTable( );
          //$('#table_enviado').reverse( );



        });
    </script>
</div>
@endsection