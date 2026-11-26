@extends('layouts.panel')
@section('title', 'Registro de Oficios enviados')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
<main class="tw:w-full tw:lg:w-full tw:px-2">
        <x-panel.encabezado titulo="Oficios recibidos" :migas="['Oficios de comisión' => null]" />
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <ul class="tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200 tw:dark:border-gray-800">
                    <li>
                        <a href="{{url('/oficios/evaluacion/historialrecibidos')}}">Historial de oficios Recibidos</a>
                    </li>

                    @if($ofic == 0)
                        <li class="active" ><a href="#">Oficios Recibidos</a></li>
                    @endif
                    @if($ofic > 0)
                    <li  class="active"><a href="#">Oficios Recibidos<button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-sky-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-sky-600 tw:gap-1 tw:px-2 tw:py-1 tw:text-xs">{{ $ofic }}</button></a></li>
                    @endif
                </ul>
            </div>
        </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Registro de Oficios recibidos {{-- {{Session::has("message")?Session::get("message"):"nada"}} --}}</h3>
                        <div class="tw:w-full tw:px-2">
                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="paginar_table" class="tw-tabla tw-tabla-bordes">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Fecha solicitud</th>
                                    <th>Nobre del solicitante de la comisión</th>
                                   {{-- <th>Descripción del oficio</th>--}}
                                    <th>Permiso de modificación</th>
                                    <th>Comisionados</th>
                                    <th>Mostrar oficio</th>
                                    <th>Evaluar oficio</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($solicitudes as $oficio)
                                    <tr>
                                        <td rowspan="{{$oficio->comisionados->count()+1}}">{{ $oficio->id_oficio }}</td>
                                        <?php  $fecha_hora=date("d-m-Y H:i",strtotime($oficio->fecha_hora)) ?>
                                        <td rowspan="{{$oficio->comisionados->count()+1}}">{{ $fecha_hora }}</td>
                                        @foreach($oficio->usuario as $usuario)

                                            @foreach($usuario->abreviaciones_prof as $abreviacion)
                                                @foreach($abreviacion->abreviaciones as $titulo)
                                            <td rowspan="{{$oficio->comisionados->count()+1}}"><b>{{ $titulo->titulo }}</b> {{ $usuario->nombre }}</td>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                      {{--   <td rowspan="{{$oficio->comisionados->count()+1}}">{{ $oficio->desc_comision }}</td>--}}

@if($oficio->comisiones->count() ==0)
                                            <td rowspan="{{$oficio->comisionados->count()+1}}" >
                                                <button class="modifica tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" id="{{$oficio->id_oficio}}"><i class="fa fa-cog "></i></button>
                                            </td>
                                            @else
                                            <td rowspan="{{$oficio->comisionados->count()+1}}" >
                                                  </td>
    @endif

                                    </tr>
                                            @foreach($oficio->comisionados as $ofic)

                                                @foreach($ofic->personal as $personal)
                                                    <tr>
                                                         <td> {{$personal->nombre}}</td>

                                                        <td class="tw:text-center">
                                                            <button class="edita tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" id="{{$ofic->id_oficio_personal}}"><i class="fa fa-list"></i></button>
                                                        </td>
                                                        <td class="tw:text-center">
                                                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" onclick="window.location='{{ url('/oficios/aceptado/'.$ofic->id_oficio_personal ) }}'" title="Autorizar"><i class="fa fa-check"></i></button>
                                                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:disabled:bg-amber-300 tw:size-9 tw:text-base" onclick="window.location='{{ url('/oficios/rechazado/'.$ofic->id_oficio_personal ) }}'" title="Rechazar"><i class="fa fa-times"></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                              @endforeach

                                @endforeach
                                </tbody>
                            </table>
</div>


                        </div>

                    </div>

        <x-panel.modal id="modal_mostrar" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">DATOS DEL COMISIONADO</h4>
                    </div>
                    <div class="tw-modal-cuerpo">

                        <div id="contenedor_mostrar">

                        </div>
                    </div> <!-- modal body  -->

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">

                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                    </div>

                </x-panel.modal>
    </main>
<form action="" method="POST" role="form" id="form_modificar">
    {{ csrf_field() }}
</form>
    <script type="text/javascript">
        $(document).ready(function() {

            $("#paginar_table").on('click','.edita',function(){
                var idof=$(this).attr('id');

                $.get("/oficios/vercomision/"+idof,function (request) {
                    $("#contenedor_mostrar").html(request);
                    $("#modal_mostrar").modal('show');
                });
            });
            $("#paginar_table").on('click','.modifica',function(){
                var idof=$(this).attr('id');


                swal({
                    title: "¿Seguro que desea dar permiso de modificar?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $("#form_modificar").attr("action","/oficios/comisionadosenviados/editar/"+idof)
                            $("#form_modificar").submit();
                        }
                    });
            });
            // Esta tabla agrupa a los comisionados de cada oficio con rowspan; DataTables no admite rowspan
            // en el cuerpo de la tabla (fallaba con "_DT_CellIndex" y dejaba la tabla incompleta), así que no se usa aquí.




        });

    </script>


</div>
@endsection