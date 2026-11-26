@extends('layouts.panel')
@section('title', 'Inicio')
@include('partials.panel.recursos_app', ['validacion' => true])
@section('content')
<div class="tw-pantalla">
    <?php
    $ver_carga=session()->has('ver_carga')?session()->has('ver_carga'):false;
    $escolar = session()->has('escolar');
    ?>

    <main class="tw:flex tw:flex-wrap tw:gap-y-4">

        <x-panel.encabezado titulo="Ver carga académica" :migas="['Servicios escolares' => null]" />
        @if($usuario == 2)
            @if( $validaciones[0]->estado_validacion==3)
                <div class="tw:w-full tw:px-2">
                    <label class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700"  data-toggle="tab" >{{ $validaciones[0]->descripcion }}</label>
                </div>
            @endif
            @if($validaciones[0]->estado_validacion == 0 || $validaciones[0]->estado_validacion == 3)
                {{--@if($creditoss == 1)
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center">
                                <label data-toggle="tab">El maximo  de creditos es de 38, verifica tu carga academica, gracias.</label>
                            </div>
                        </div>
                    </div>
                @endif--}}
                @if($creditoss == 2)
                    <div class="tw:w-full tw:px-2">
                        <label class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700"  data-toggle="tab" >El minimo de creditos  de creditos es de 22, verifica  tu carga academica  para poder ser enviada, gracias.</label>
                    </div>
                @endif
                @if($creditoss == 4)
                    <div class="tw:w-full tw:px-2">
                        <label class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700"  data-toggle="tab" >El maximo  de creditos con una materia en especial es de 24 creditos, debes modificar tu carga académica  para poder ser enviada, gracias.</label>
                    </div>
                @endif
                @if($creditoss == 5)
                    <div class="tw:w-full tw:px-2">
                        <label class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700"  data-toggle="tab" >Solamente puedes dar de alta dos especiales o menos, debes modificar tu carga académica  para poder ser enviada, gracias.</label>
                    </div>
                @endif
                @if($creditoss == 6)
                    <div class="tw:w-full tw:px-2">
                        <label class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700"  data-toggle="tab" >Solamente puedes dar de alta las dos especiales, debes modificar tu carga académica  para poder ser enviada, gracias.</label>
                    </div>
                @endif
            @endif
        @endif

        @if($usuario == 2)
            <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center" >{{ $cuenta_y_nom }}</h4>

                    </div>
                </div>
            </div>
        @endif

        <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:w-full tw:lg:w-full tw:px-2">
            @if($usuario==2)
                @if($validaciones[0]->estado_validacion==0 || $validaciones[0]->estado_validacion==3 || $validaciones[0]->estado_validacion==1)

                    @if($adeudo == 0)
                        <div class="tw:w-full tw:px-2">
                            <x-panel.alerta tipo="exito" class="tw:mb-4">No tiene adeudo</x-panel.alerta>
                        </div>
                    @else
                        <div class="tw:w-full tw:px-2">
                            <x-panel.alerta tipo="error" class="tw:mb-4">Tiene adeudo con los siguientes departamentos o carreras:<br>
                                    @foreach($departamento_carrera as $departamento_carrera)
                                        <p class="tw:text-center" >{{$departamento_carrera['nombre']}}:- {{$departamento_carrera['comentario']}}</p>
                                    @endforeach</x-panel.alerta>
                        </div>
                    @endif

                    @if($escolar == true)
                        {{--  autorizar semestre al estudiante--}}
                        <x-panel.modal id="modal_autorizar_estudiante" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                        
                                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Autorizar registro del estudiante</h4>
                                    </div>
                                    <div class="tw-modal-cuerpo">
                                        <div id="contenedor_autorizar_estudiante">

                                        </div>

                                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                                            <button id="guardar_autorizar_estudiante"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                                        </div>
                                    </div>
                                </x-panel.modal>
                        @if($estado_sem_act == 0)
                            <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:px-2">
                                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                        <div class="tw:p-5 tw:sm:p-6">
                                            <form  id="form_guardar_semestre" action="{{url("/servicios_escolares/guardar_semestre_al/".$alumno."/2")}}" role="form" method="POST" enctype="multipart/form-data" >
                                                {{ csrf_field() }}
                                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                    <div class="tw:w-full tw:px-2">
                                                        <div class="tw:mb-4">
                                                            <label for="exampleInputEmail1">Selecciona periodo que ingreso el estudiante al TESVB</label>
                                                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="id_periodo" name="id_periodo" required>
                                                                <option disabled selected hidden>Selecciona una opción</option>
                                                                @foreach($periodos as $periodo)
                                                                    <option value="{{$periodo->id_periodo}}" data-esta="{{$periodo->periodo }}">{{ $periodo->periodo }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                    <div class="tw:w-full tw:px-2">
                                                        <div class="tw:mb-4">
                                                            <label for="exampleInputEmail1">Selecciona semestre que ingreso el estudiante al TESVB</label>
                                                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="id_semestre" name="id_semestre" required>
                                                                <option disabled selected hidden>Selecciona una opción</option>
                                                                @foreach($semestres as $semestre)
                                                                    <option value="{{$semestre->id_semestre}}" data-esta="{{$semestre->descripcion }}">{{ $semestre->descripcion }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>
                                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                <div class="tw:w-full tw:px-2">
                                                    <button id="guardar_agregar_semestre"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                                @if($datos_actu->id_estado_rev == 1)
                                    <form class="tw:w-full" role="form" method="POST" action="/duales/validacion_de_carga/{{ $id }}" novalidate id="formupdate">
                                        <input type="hidden" name="_method" value="PUT" />
                                        {{ csrf_field() }}
                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                            <div class="tw:w-full tw:lg:max-w-2xl tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800 tw:px-2">
                                                <p class="tw:text-center" >
                                                    <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300">
                                                        <input type="radio" id="optradio1" name="optradio" value="1"> Autorizar
                                                    </label>
                                                </p>
                                                <p>
                                                    <input type="hidden" id="estado" name="estado" value="2">
                                                </p>
                                                <p class="tw:text-center" >
                                                    <button class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="aceptar">Aceptar</button>
                                                </p>
                                            </div>
                                        </div>
                                    </form>
                                @endif

                            @endif
                        @endif
                    @endif
            @endif

            @if($usuario == 1)
                @if($validaciones[0]->estado_validacion==0)

                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div  class="tw:w-full tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800 tw:px-2" >
                            <strong>La carga académica se envió correctamente, está en proceso de revisión por la Subdirección de Servicios Escolares, una vez aprobada podrás imprimirla.<br></strong>

                            <p class="tw:text-center" >
                                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:size-9 tw:text-base" disabled><span class="fa fa-print em"  aria-hidden="true" ></span></button>
                            </p>
                        </div>
                    </div>
                @elseif($validaciones[0]->estado_validacion==2 || $validaciones[0]->estado_validacion==8 || $validaciones[0]->estado_validacion==9)
                    <div class="tw:w-full">
                        <div  class="tw:w-full tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800 tw:px-2" id="notificciones">
                            <p class="tw:text-center" >
                                <strong>Carga Academica Aceptada</strong>
                            </p>
                            <p class="tw:text-center"  >
                                <a class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" href="/duales/imprime_carga" target="_blank"><span class="fa fa-print em"  aria-hidden="true"></span></a>
                            </p>
                            <p class="tw:text-center" >
                                <a class="tw:text-brand-500 tw:hover:underline" href="/duales/imprime_carga"><strong >Imprimir</strong></a>
                            </p>
                        </div>
                    </div>
                @endif
            @endif
            @if($usuario == 2)
                @if($ls == 2 || $ls == 8 || $ls == 9 )

                    <div  class="tw:w-full tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800 tw:px-2" id="notificciones">
                        <p class="tw:text-center" >
                            <strong>Carga Academica Aceptada</strong>
                        </p>
                        <p class="tw:text-center"  >
                            <a class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" href="/duales/imprime_control/{{$id}}" target="_blank"><span class="fa fa-print em"  aria-hidden="true"></span></a>
                        </p>
                        <p class="tw:text-center" >
                            <a class="tw:text-brand-500 tw:hover:underline" href="/duales/imprime_control/{{$id}}"><strong >Imprimir</strong></a>
                        </p>
                    </div>
                @endif
            @endif
        </div>


        <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" Style="background: white;">
                    <thead>
                    <tr class="tw:bg-sky-50">
                        <th class="tw:text-center" >CLAVE DE LA MATERIA</th>
                        <th class="tw:text-center" >NOMBRE DE LA MATERIA</th>
                        <th class="tw:text-center" >CREDITOS</th>
                        <th class="tw:text-center" >STATUS</th>
                        <th class="tw:text-center" >TIPO CURSA</th>
                        <th class="tw:text-center" >GRUPO</th>
                        @if($validaciones[0]->estado_validacion==0 || $validaciones[0]->estado_validacion==3  || $validaciones[0]->estado_validacion==4)
                            <th class="tw:text-center"  >ELIMINAR</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datos_carga as $consulta1)
                        @if($consulta1['id_materia'] == 2258)
                            <tr>
                                <th></th>
                                <th class="tw:text-center" >{{$consulta1['clave']}}</th>
                                <td class="tw:text-center" >{{$consulta1['nombre']}}</td>
                                <td></td>
                                <td class="tw:text-center" >ALTA</td>
                                <td></td>
                                <td></td>

                                @if($validaciones[0]->estado_validacion==0 || $validaciones[0]->estado_validacion==3 || $validaciones[0]->estado_validacion==4)
                                    <th class="tw:text-center" >
                                        <a class="elimina tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" data-id_carga_academica="{{$consulta1['id_carga_academica']}}" ><span class="fa fa-trash em" aria-hidden="true" ></span></a>
                                    </th
                                @endif
                            </tr>
                        @else
                            <tr>
                                <th class="tw:text-center" >{{$consulta1['clave']}}</th>
                                <td class="tw:text-center" >{{$consulta1['nombre']}}</td>
                                <td class="tw:text-center" >{{$consulta1['creditos']}}</td>
                                <td class="tw:text-center" >{{$consulta1['nombre_status']}}</td>
                                <td class="tw:text-center" >{{$consulta1['nombre_curso']}}</td>
                                <td class="tw:text-center" >{{$consulta1['id_semestre']}}0{{$consulta1['grupo']}}</td>
                                @if($validaciones[0]->estado_validacion==0 || $validaciones[0]->estado_validacion==3 || $validaciones[0]->estado_validacion==4)
                                    <th class="tw:text-center" >
                                        <a class="elimina tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" data-id_carga_academica="{{$consulta1['id_carga_academica']}}" ><span class="fa fa-trash em" aria-hidden="true" ></span></a>
                                    </th>
                                @endif
                            </tr>
                        @endif
                    @endforeach
                    <tr>
                        <th></th>
                        <th></th>
                        <td class="tw:text-center" ><b>Total de creditos:</b></td>
                        <td class="tw:text-center" >{{$suma}}</td>
                        <td></td>
                        @if($validaciones[0]->estado_validacion==0 || $validaciones[0]->estado_validacion==3 || $validaciones[0]->estado_validacion==4)
                            <td></td>
                            <td></td>
                        @endif

                    </tr>



                    </tbody>
                </table>
</div>


            </div>
        </div>
        @if($validaciones[0]->estado_validacion==0  || $validaciones[0]->estado_validacion==3 || $validaciones[0]->estado_validacion==4)
            @if($usuario == 1)
                @if($creditoss == 3 || $creditoss == 7 )
                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">

                            <div class="tw:text-center">
                                <button type="button" class="tw:w-full tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" onclick="window.location='{{ url('/duales/enviar_carga/'. $id_alu ) }}'" title="Enviar">Enviar</button>
                            </div>

                        </div>
                    </div>
                @endif
                @if($creditoss == 1 || $creditoss == 2 || $creditoss == 4 || $creditoss == 5 || $creditoss == 6)
                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">

                            <div class="tw:text-center">
                                <button type="button" class="tw:w-full tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"  title="Enviar" disabled>Enviar</button>
                            </div>

                        </div>
                    </div>
                    @endif
                    @endif
                    @endif

                    

                    <x-panel.modal id="modal_elimina" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">
                                <div class="tw-modal-cuerpo tw:pt-14">
                                    <form action="" method="POST" role="form" id="form_delete">
                                        {{method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <input type="hidden" id="id_carga_academica" name="id_carga_academica" value="">
                                        <b>¿Realmente deseas eliminar éste elemento?</b>
                                </div>
                                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">
                                        Cancelar <span class="fa fa-times-circle"></span></button></button>
                                    <button id="confirma_elimina" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Aceptar <span class="fa fa-check"></span></button>
                                </div>
                                </form>
                            </x-panel.modal>
                    
    </main>

    <script>
        $(document).ready(function(){
            $(".elimina").click(function(){
                var id_carga_academica=$(this).data('id_carga_academica');
                //TNotify.alert(id_carga_academica);
                $('#id_carga_academica').val(id_carga_academica);
                $('#modal_elimina').modal('show');
            });
            $(".editar_semestre").click(function(){
                var id_semestres_al=$(this).attr('id');
                $.get("/servicios_escolares/actualizar_semestre_al/"+id_semestres_al,function (request) {
                    $("#contenedor_actualizar_estudiante").html(request);
                    $("#modal_actualizar_estudiante").modal('show');
                });
            });
            $(".autorizar_semestre").click(function (){
                var id_semestres_al=$(this).attr('id');
                $.get("/servicios_escolares/autorizar_semestre_al/"+id_semestres_al,function (request) {
                    $("#contenedor_autorizar_estudiante").html(request);
                    $("#modal_autorizar_estudiante").modal('show');
                });
            });
            $("#aceptar").click(function(event){
                $("#formupdate").submit();
            });
            $("#formupdate").validate({
                rules: {
                    optradio: {
                        required: true,
                    },
                },
                messages: {
                    optradio: {
                    },
                },
            });


            $("#confirma_elimina").click(function(event){
                var id_carga_academica = $("#id_carga_academica").val()
                //TNotify.alert(id_carga_academica);
                $("#form_delete").attr("action","/duales/eliminar_carga_academica/"+id_carga_academica)
                $("#form_delete").submit();
            });
            $("#optradio1").change(function() {
                var validez=$(this).val();
                $("#observacion").css("display", "none");
                $("#status").css("display", "inline");
            });
            $("#optradio2").change(function() {
                var validez=$(this).val();
                $("#observacion").css("display", "inline");
                $("#status").css("display", "none");
            });
            $("#guardar_actualizar_estudiante").click(function (){
                $("#form_guardar_mod_semestre").submit();
                $("#guardar_actualizar_estudiante").attr("disabled", true);
            });
            $("#guardar_autorizar_estudiante").click(function (){
                $("#form_autorizar_semestre").submit();
                $("#guardar_autorizar_estudiante").attr("disabled", true);
            });
            $("#guardar_agregar_semestre").click(function (){
                var id_periodo = $("#id_periodo").val();
                if(id_periodo != null){
                    var id_semestre = $("#id_semestre").val();
                    if(id_semestre != null){
                        $("#form_guardar_semestre").submit();
                        $("#guardar_agregar_semestre").attr("disabled", true);
                        swal({
                            position: "top",
                            type: "success",
                            title: "Registro exitoso",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }else{
                        swal({
                            position:"top",
                            type: "error",
                            title: "Selecciona semestre que ingreso",
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                }else{
                    swal({
                        position:"top",
                        type: "error",
                        title: "Selecciona periodo que ingreso el estudiante",
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            });

        });
    </script>

</div>
@endsection