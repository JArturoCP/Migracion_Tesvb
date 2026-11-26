@extends('layouts.panel')
@section('title', 'Solicitud de Prorroga')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">



    <main>


        <x-panel.encabezado titulo="Solicitud de prórroga" :migas="['Prórrogas' => null]" />

        <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><a href="/solicitud/exportar_solicitudes_prorroga" class="tooltip-options link tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-toggle="tooltip" data-placement="top" title="Exportar a excel"><span class="oi oi-pencil"></span>Exportar a Excel</a></h3>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" Style="background: white;" id="solicitudes">
            <thead>
            <tr>
                <th>No. CUENTA</th>
                <th>NOMBRE DE ALUMNO(A)</th>
                <th>CURP</th>
                <th>CARRERA</th>
                <th>CORREO</th>
                <th>SEMESTRE AL QUE INGRESARÁ</th>
                <th>FECHA EFECTUADA PARA EL PAGO DE COLEGIATURA SEMESTRAL</th>
                <th>IMPRIMIR</th>

            </tr>
            </thead>
            <tbody>

            @foreach($solicitudes_prorroga as $solicitudes_prorroga)
                <tr>
                    <th>{{$solicitudes_prorroga->cuenta}}</th>
                    <td>{{$solicitudes_prorroga->nombre}} {{$solicitudes_prorroga->apaterno}} {{$solicitudes_prorroga->amaterno}}</td>
                    <td>{{$solicitudes_prorroga->curp_al}}</td>
                    <td>{{$solicitudes_prorroga->carrera}}</td>
                    <td>{{$solicitudes_prorroga->correo_al}}</td>
                    <td>{{$solicitudes_prorroga->semestre}}</td>
                    <td>{{$solicitudes_prorroga->fecha_efectuar}}</td>
                    <td> <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" onclick="window.open('{{ url('/solicitud/pdf_prorroga/'.$solicitudes_prorroga->id_alumno ) }}')">Imprimir</button></td>



                </tr>
            @endforeach



            </tbody>
        </table>
</div>
            </div>
        </div>
    </main>
    <script type="text/javascript">
        $(document).ready(function() {


            $('#solicitudes').DataTable(  );





        });

    </script>
</div>
@endsection