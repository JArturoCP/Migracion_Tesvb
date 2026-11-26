@extends('layouts.panel')
@section('title', 'Cronograma')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">



    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <x-panel.encabezado titulo="Cronograma de acciones" :migas="['Riesgos y oportunidades' => null]" />
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">

                <div>

                    <!-- Nav tabs -->
                    <ul class="tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200 tw:dark:border-gray-800" role="tablist">
                        @foreach($array_full as $data)

                          {{--  @if(count($data[2]["datos_oportunidad"])!=0) --}}
                        <li role="presentation" ><a href="#tab{{$data[1]}}" aria-controls="tab{{$data[1]}}" role="tab" data-toggle="tab" >{{ $data[0] }}</a></li>
                            {{--      @endif --}}
                          @endforeach

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        @foreach($array_full as $data)
                            {{--
                        @if(count($data[2]["datos_oportunidad"])!=0)
                        --}}

                    <div role="tabpanel" class="tab-pane" id="tab{{$data[1]}}">
                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla">
                            <thead>
                            <tr>
                                <th>Area Administrativa</th>
                                <th>Accion</th>
                                <th>Fecha Inicial</th>
                                <th>Fecha Final</th>
                                <th>Tipo</th>
                                <th>Observación</th>
                                <th>Evidencia</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data[2]["datos_oportunidad"] as $oportunidad)

                                <tr>
                                    <td>{{$oportunidad->nom_departamento}}</td>
                                    <td>{{$oportunidad->des_planseguimiento}}</td>
                                    <td>{{$oportunidad->fecha_inicial}}</td>
                                    <td>{{$oportunidad->fecha}}</td>
                                    <td>Oportunidad</td>
                                    <td>
                                        <form action="{{url("riesgos/seguimiento/tabla/".$oportunidad->id_planseguimiento)}}" method="post">
                                            @csrf
                                            @method("PUT")
                                                <input type="hidden" name="action" value="oportunidad">
                                            @if(!$oportunidad->released)
                                                <div class="tw:mb-4"><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><span class="fa fa-check"></span></button></div>
                                                <div class="tw:mb-4">
                                                    <label for="comments">Descripción: </label>
                                                    <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="comments" id="comments">
                                                </div>
                                            @else
                                                <div class="tw:mb-4"><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base"><span class="fa fa-times"></span></button></div>
                                                <div class="tw:mb-4">
                                                    <label for="comments">Descripción: </label>
                                                    <span>{{$oportunidad->comments}}</span>
                                                    <input type="hidden" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="comments" id="comments" value="" disabled>
                                                </div>
                                            @endif

                                        </form>
                                    </td>
                                    <td>
                                        @if($oportunidad->status!=0)
                                        <a class="tw:text-brand-500 tw:hover:underline" href="{{asset("storage")."/".$oportunidad->file}}" target="_blank">Ver evidencia</a>

                                           @else
                                            No hay evidencia
                                        @endif
                                        @if($oportunidad->status==2)
                                            <form action="{{url("riesgos/seguimiento/tabla_update/".$oportunidad->id_planseguimiento)}}" method="post">
                                                @csrf
                                                @method("PUT")
                                                <input type="hidden" name="action" value="oportunidad">
                                                <input type="hidden" name="value" value="1">
                                                <div class="tw:mb-4"><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-toggle="tooltip" data-placement="top" data-original-title="Aprobar"><span class="fa fa-check"></span></button></div>
                                            </form>
                                            <form action="{{url("riesgos/seguimiento/tabla_update/".$oportunidad->id_planseguimiento)}}" method="post">
                                                @csrf
                                                @method("PUT")
                                                <input type="hidden" name="action" value="oportunidad">
                                                <input type="hidden" name="value" value="0">
                                                <div class="tw:mb-4"><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base"><span class="fa fa-times" data-toggle="tooltip" data-placement="top" data-original-title="Rechazar"></span></button></div>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($data[2]["datos_riesgo"] as $riesgo)
                                <tr>
                                    <td>{{$riesgo->nom_departamento}}</td>
                                    <td>{{$riesgo->accion}}</td>
                                    <td>{{$riesgo->fecha}}</td>
                                    <td>{{$riesgo->fecha_final}}</td>
                                    <td>Riesgo</td>
                                    <td>
                                        <form action="{{url("riesgos/seguimiento/tabla/".$riesgo->id_estrategia_a)}}" method="post">
                                            @csrf
                                            @method("PUT")
                                            <input type="hidden" name="action" value="riesgo">
                                            @if(!$riesgo->released)
                                                <div class="tw:mb-4"><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><span class="fa fa-check"></span></button></div>
                                                <div class="tw:mb-4">
                                                    <label for="comments">Descripción: </label>
                                                    <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="comments" id="comments">
                                                </div>
                                            @else
                                                <div class="tw:mb-4"><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base"><span class="fa fa-times"></span></button></div>
                                                <div class="tw:mb-4">
                                                    <label for="comments">Descripción: </label>
                                                    <span>{{$riesgo->comments}}</span>
                                                    <input type="hidden" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="comments" id="comments" value="" disabled>
                                                </div>
                                            @endif

                                        </form>


                                    </td>
                                    <td>
                                        @if($riesgo->status!=0)
                                            <a class="tw:text-brand-500 tw:hover:underline" href="{{asset("storage")."/".$riesgo->file}}" target="_blank">Ver evidencia</a>

                                        @else
                                            No hay evidencia
                                        @endif
                                        @if($riesgo->status==2)
                                            <form action="{{url("riesgos/seguimiento/tabla_update/".$riesgo->id_estrategia_a)}}" method="post">
                                                @csrf
                                                @method("PUT")
                                                <input type="hidden" name="action" value="riesgo">
                                                <input type="hidden" name="value" value="1">
                                                <div class="tw:mb-4"><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-toggle="tooltip" data-placement="top" data-original-title="Aprobar"><span class="fa fa-check"></span></button></div>
                                            </form>
                                            <form action="{{url("riesgos/seguimiento/tabla_update/".$riesgo->id_estrategia_a)}}" method="post">
                                                @csrf
                                                @method("PUT")
                                                <input type="hidden" name="action" value="riesgo">
                                                <input type="hidden" name="value" value="0">
                                                <div class="tw:mb-4"><button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base"><span class="fa fa-times" data-toggle="tooltip" data-placement="top" data-original-title="Rechazar"></span></button></div>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
</div>

                    </div>
                            {{--       @endif --}}
                          @endforeach

                      </div>

                  </div>
                  {{--

                  --}}
            </div>
        </div>
    </main>
    <script>   $('[data-toggle="tooltip"]').tooltip();</script>
</div>
@endsection