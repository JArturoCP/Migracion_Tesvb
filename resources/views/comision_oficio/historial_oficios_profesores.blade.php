@extends('layouts.panel')
@section('title', 'Registro de Oficios enviados')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">
    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <x-panel.encabezado titulo="Historial de oficios recibidos por los profesores" :migas="['Oficios de comisión' => null]" />
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <ul class="tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200 tw:dark:border-gray-800">
                    <li class="active" ><a href="#">Historial de oficios Recibidos </a>
                    </li>

                    @if($ofic === 0)
                        <li  > <a href="{{url('/oficios/evaluacionsubdirecion')}}">Oficios Recibidos</a></li>
                    @endif
                    @if($ofic > 0)
                        <li  > <a href="{{url('/oficios/evaluacionsubdirecion')}}">Oficios Recibidos<button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-sky-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-sky-600 tw:gap-1 tw:px-2 tw:py-1 tw:text-xs">{{ $ofic }}</button></a></li>
                    @endif
                </ul>
            </div>
        </div>
        <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{-- {{dd(session()->all())}}--}}
                        Registro de Oficios recibidos por los profesores {{-- {{Session::has("message")?Session::get("message"):"nada"}} --}}</h3>
            @if($mostrar == 0)
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
                    <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">
                        <div class="tw:mb-4">
                            <div class="tw:mb-4">
                                <label for="ano_oficio">Seleccionar año para ver oficios</label>
                                <select name="ano_oficio" id="ano_oficio" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                    @foreach($anos_oficios as $anos_oficio)
                                        <option disabled selected hidden>Selecciona una opción</option>
                                        <option value="{{$anos_oficio->id_ano}}" >{{$anos_oficio->descripcion}} </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if($mostrar == 1)
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
                    <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">
                        <div class="tw:mb-4">
                            <div class="tw:mb-4">
                                <label for="ano_oficio">Seleccionar año para ver oficios</label>
                                <select name="ano_oficio" id="ano_oficio" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                    @foreach($anos_oficios as $anos_oficio)
                                        @if($anos_oficio->id_ano==$id_anos)
                                            <option value="{{$id_anos}}" selected="selected">{{$anos_oficio->descripcion}}</option>
                                        @else
                                            <option value="{{$anos_oficio->id_ano}}" >{{$anos_oficio->descripcion}} </option>
                                        @endif
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="tw:w-full tw:px-2">
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="paginar_table" class="tw-tabla tw-tabla-bordes">
                    <thead>
                    <tr>
                        <th>Numero</th>
                        <th>Nombre del comisionado</th>
                        <th>Descripcion del oficio</th>
                        <th>Fecha  oficio</th>
                        <th>Ver oficio</th>
                        <th>Estado de oficio</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($oficioss as $historial)
                        <tr>
                            <td>{{$historial->no_oficio}}</td>
                            <td>{{$historial->titulo}} {{$historial->nombre}}</td>
                            <td>{{$historial->desc_comision}}</td>
                            <?php  $fecha_hora=date("d-m-Y H:i",strtotime($historial->fecha_hora)) ?>
                            <td>{{$fecha_hora}}</td>
                            <td class="tw:text-center">
                                <button class="edita tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" id="{{ $historial->id_oficio_personal }}"><i class="fa fa-list"></i></button>
                            </td>

                            @if($historial->id_notificacion==2)
                                <td>Autorizado</td>
                            @endif

                            @if($historial->id_notificacion==3)
                                <td>Rechazado por el D. A. de Personal </td>
                            @endif
                            @if($historial->id_notificacion==6)
                            <td>Rechazado por la sudirección </td>
                            @endif
                            @if($historial->id_notificacion==1)
                                <td>Solicitado al D. A. de personal</td>
                            @endif


                        </tr>

                    @endforeach
                    </tbody>
                </table>
</div>

            </div>

        
        @endif

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
    <script type="text/javascript">
        $(document).ready(function() {

            $("#paginar_table").on('click','.edita',function(){
                var idof=$(this).attr('id');

                $.get("/oficios/vercomision/"+idof,function (request) {
                    $("#contenedor_mostrar").html(request);
                    $("#modal_mostrar").modal('show');
                });
            });
            $('#paginar_table').DataTable( {
                "order": [[ 4, "desc" ]]
            } );

            $("#ano_oficio").on('change',function(e) {
                // TNotify.alert($("#grupos").val());
                var id_anos = $("#ano_oficio").val();
                window.location.href='/oficios/evaluacion/historial_mostrar_profesores/'+id_anos;



            });

        });

    </script>


</div>
@endsection