<?php
if($solicitud->id_articulo ==2){
    $date_now = $solicitud->fecha_tervac;
    $fecha2=$date_now;
}else{
    $date_now = $solicitud->fecha_req;
    $fecha2=$date_now;
}



$date_future = strtotime('+7 days', strtotime($date_now));
$date_future = date('Y-m-d', $date_future);
?>
@if($solicitud->arch_solicitud==null)
    @if( $fechaact>=$solicitud->fecha_req  && $fechaact<= $date_future)
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:text-center">Agregar evidencia</h3>
            </div>
        </div>

    </div>
</div>
    @else
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                        <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:text-center">Agregar evidencia</h3>
                    </div>
                </div>

            </div>
        </div>
        @endif
@else
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                    <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:text-center">Ver evidencia</h3>
                </div>
            </div>

        </div>
    </div>

    @endif
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
        <b>Articulo: </b><p>{{$solicitud->nombre_articulo}}</p>
        <b>Motivo de oficio: </b><p>{{$solicitud->motivo_oficio}}</p>
        @if($solicitud->id_articulo == 2 || $solicitud->id_articulo == 8 || $solicitud->id_articulo == 11)
            <b>Fecha solicitud: </b><p>{{$solicitud->fecha_req}}</p
        @else
        <b>Fecha requerida: </b><p>{{$solicitud->fecha_req}}</p>
        @endif
        <b>Fecha ultima para subir la evidencia</b><p>{{ $date_future}}</p>
        @if($solicitud->id_articulo==5)
            <b>Hora entrada:</b><p>{{$solicitud->hora_e}}</p>
            <b>Hora llegada tarde:</b><p>{{$solicitud->hora_st}}</p>
        @endif
        @if($solicitud->id_articulo == 2 || $solicitud->id_articulo == 8 || $solicitud->id_articulo == 11)
            <b>Inician:</b><p>{{$solicitud->fecha_invac}}</p>
            <b>Finalizan:</b><p>{{$solicitud->fecha_tervac}}</p>

        @endif
        @if($solicitud->id_articulo==9)
            @if($solicitud->hora_e2 != "")
            <b>Hora entrada:</b><p>{{$solicitud->hora_e2}}</p>
            <b>Hora salida:</b><p>{{$solicitud->hora_s2}}</p>
            @endif
        @endif
        @if($solicitud->id_articulo==9)
            @if($solicitud->hora_e1 != "")
            <b>Hora entrada:</b><p>{{$solicitud->hora_e1}}</p>
            <b>Hora salida:</b><p>{{$solicitud->hora_s1}}</p>
            @endif
        @endif
    </div>
</div>

        @if($solicitud->arch_evidencia==null)
            @if( $fechaact>=$fecha2  && $fechaact<= $date_future)
                <form id="form_registrar" action="{{url("/incidencias/cargando_evidencia_oficio")}}" role="form" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden"  id="id_evid" name="id_evid"  value="{{  $solicitud->id_evid }}">
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                        <label for="archivo_subir">Archivo a subir:</label>
                        <input  class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden" id="arch_evidencia" name="arch_evidencia" type="file" accept="application/pdf"    required/>
                    </div>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <p><br></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                    <button  type="submit"  class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" >Guardar</button>
                </div>
                </form>
            @elseif($fechaact> $date_future)
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                        <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700">
                            Has olvidado subir tu evidencia
                        </div>
                    </div>
                </div>

                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <p><br></p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                </div>
            @else
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                        <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-sky-200 tw:bg-sky-50 tw:text-sky-800">
                            Podras subir tu evidencia el dia requerido hasta 5 dias habiles despues
                        </div>
                    </div>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <p><br></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                </div>

            @endif

        @else

            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                    <a  target="_blank" href="/incidencias/{{ $solicitud->arch_evidencia }}" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Ver evidencia </a>
                </div>
            </div>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <p><br></p>
            </div>

            <div class="modal-footer">
                <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
            </div>

        @endif

