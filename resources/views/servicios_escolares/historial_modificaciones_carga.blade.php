@extends('layouts.panel')
@section('title', 'S.Escolares')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Historial de modificaciones de cargas académicas" :migas="['Servicios escolares' => null]" />

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_historial_carga" class="tw-tabla tw-tabla-bordes">
            <thead class="">
                <tr class="tw:text-center">
                    <th class="tw:text-center">No.</th>
                    <th class="tw:text-center">NO. CUENTA</th>
                    <th class="tw:text-center">ALUMNO</th>
                    <th class="tw:text-center">PERSONAL QUE HIZO LA MODIFICACIÓN</th>
                    <th class="tw:text-center">FECHA</th>
                    <th class="tw:text-center">INSTRUCCIÓN</th>
                </tr>
                </thead>
                <?php $i=0; ?>
                @foreach($historial as $historial)
                    <?php $i++; ?>
                    <tr class="tw:text-center">
                        <td class="tw:text-center">{{$i}}</td>
                        <td class="tw:text-center">{{$historial->cuenta}}</td>
                        <td class="tw:text-center">{{$historial->alumno}} {{$historial->apaterno}} {{$historial->amaterno}}</td>
                        <td class="tw:text-center">{{$historial->nombre}}</td>
                        <td class="tw:text-center">{{$historial->fecha}}</td>
                        <td class="tw:text-center">{{$historial->estado}}</td>

                    </tr>
                @endforeach
            </table>
</div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table_historial_carga').DataTable( );

        });
    </script>
</div>
@endsection
