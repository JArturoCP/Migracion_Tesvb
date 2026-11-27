@extends('layouts.panel')
@section('title', 'Incidencias')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

<main class="tw:w-full tw:lg:w-full tw:px-2">
            <x-panel.encabezado titulo="Historial de oficios enviados" :migas="['Incidencias' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_enviado2" class="tw-tabla tw-tabla-bordes">
                    <thead>
                     <tr>
                         <th class="tw:text-center">No.</th>
                         <th class="tw:text-center">Artículo aplicado</th>
                         <th class="tw:text-center">Motivo de oficio</th>
                         <th class="tw:text-center">Fecha de la solicitud del oficio</th>
                         <th class="tw:text-center">Fecha de la incidencia</th>
                         <th class="tw:text-center">Nombre del personal</th>
                         <th class="tw:text-center">Ver oficio completo</th>
                         <th class="tw:text-center">Oficio firmado, formato de incidencia y evidencia en un pdf</th>
                     </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @foreach($solicitud as $solicita)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$solicita->nombre_articulo}}</td>
                                <td>{{$solicita->motivo_oficio}}</td>

                                <?php  $fecha_solicitud=date_format(new DateTime($solicita->fecha_solicitud), 'd-m-Y H:i:s');?>
                                <td>{{$fecha_solicitud}}</td>
                                @if($solicita->id_articulo == 2  || $solicita->id_articulo == 11 || $solicita->id_articulo == 8)
                                    <td>
                                        <?php
                                        $fecha_inicial= date('d-m-Y', strtotime($solicita->fecha_invac));
                                        $fecha_final= date('d-m-Y', strtotime($solicita->fecha_tervac));
                                        ?>
                                        <b>

                                            {{ $fecha_inicial }} al  {{ $fecha_final }}
                                        </b>
                                    </td>
                                @else
                                    <?php
                                    $fecha_req= date('d-m-Y', strtotime($solicita->fecha_req));
                                    ?>
                                    <td>
                                        <b>{{ $fecha_req }}</b>
                                    </td>
                                @endif
                                <td>{{ $solicita->titulo }} {{ $solicita->nombre }}</td>
                                <th>
                                    <button class="edita2 tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" id="{{ $solicita->id_solicitud }}"><i class="fa fa-list"></i></button>
                                </th>

                                @if($solicita->id_estado_solicitud==2)
                                    <td>
                                        @if($solicita->arch_solicitud=="")
                                            <b>PDF no agregado</b><br><br>
                                            {{--
                                            <a class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" href="{{url('incidencias/cargar_oficio',$hist->id_solicitud)}}">Agregar oficio</a>
                                             --}}
                                        @else
                                            <a  target="_blank" href="/incidencias_oficios/{{$solicita->arch_solicitud}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap">Ver PDF </a>
                                        <br><br>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
</div>
            </div>
        </div>
        <x-panel.modal id="modal_mostrar2" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Oficio de Incidencia</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        <div id="contenedor_mostrar2">
                        </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                    </div>
                </x-panel.modal>
<script type="text/javascript">
  $(document).ready(function() { 
    //id de la tabla                 //class de boton
    $("#table_enviado2").on('click','.edita2',function(){
        //TNotify.alert("HOLA");
        var soli=$(this).attr('id');
       // TNotify.alert(soli);
        //url de web
        $.get("/oficios/ver/"+soli,function (request) {
            //contenido del modal
            $("#contenedor_mostrar2").html(request);
            //id del modal
            $("#modal_mostrar2").modal('show');
        });    
    });
    $('#table_enviado2').DataTable( {

} );
});
</script>
</main>

</div>
@endsection