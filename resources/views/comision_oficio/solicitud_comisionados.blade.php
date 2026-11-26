@extends('layouts.panel')
@section('title', 'Personal comisionado')
@include('partials.panel.recursos_app', ['validacion' => true, 'pickatime' => true])
@section('content')
<div class="tw-pantalla">
    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <x-panel.encabezado titulo="Datos de la solicitud de la comisión" :migas="['Oficios de comisión' => null]" />

                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    @if($dependencias_r->dependenciasr == 3)
                        <p class="tw:w-full tw:text-center">Agregar otra dependencia <button data-toggle="modal"  data-tooltip="true" data-placement="left" title="Agregar otra dependencia" data-target="#modal_dependencia_agregar" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" disabled="disabled"><span class="fa fa-plus" aria-hidden="true"></span></button></p>
                        @elseif($dependencias_r->dependenciasr == 0 || $dependencias_r->dependenciasr == 1|| $dependencias_r->dependenciasr == 2)


<p class="tw:w-full tw:text-center">Agregar otra dependencia <button data-toggle="modal"  data-tooltip="true" data-placement="left" title="Agregar otra dependencia" data-target="#modal_dependencia_agregar" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><span class="fa fa-plus" aria-hidden="true"></span></button></p>
                    @endif
                    <div class="tw:w-full tw:px-2">
                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                            <thead>
                            <tr>
                                <th>Dependencia </th>
                                <th>Domicilio</th>
                                <th>Municipio</th>
                                <th>Estado</th>
                                <th>Modificar</th>
                                <th>Eliminar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dependencias as $dependencias)
                                <tr>

                                    <td>{{$dependencias->dependencia}}</td>
                                    <td>{{$dependencias->domicilio}}</td>
                                    <td>{{$dependencias->nombre_municipio }}</td>
                                    <td>{{$dependencias->nombre_estado }}</td>
                                    <td>
                                        <a href="#!" class="modificar_dependencia tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-id="{{ $dependencias->id_depend_domicilio}}"><span class="fa fa-cog " aria-hidden="true"></span></a>
                                    </td>

                                    <td>
                                        <a class="eliminar_dependencia tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" data-id="{{ $dependencias->id_depend_domicilio}}"><span class="fa fa-trash " aria-hidden="true"></span></a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>

                        </table>
</div>

                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                    <thead>
                    <tr>
                        <th>Motivo de la comisión </th>
                        <th>Fecha de salida</th>
                        <th>Hora de salida</th>
                        <th>Fecha de regreso</th>
                        <th>Hora de regreso</th>
                        <th>Lugar de salida</th>
                        <th>Lugar de regreso</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>{{$solicitudes->desc_comision}}</td>
                            <?php  $fecha_salida=date("d-m-Y",strtotime($solicitudes->fecha_salida )) ?>
                            <td>{{$fecha_salida  }}</td>
                            <td>{{$solicitudes->hora_s  }}</td>
                            <?php  $fecha_regreso=date("d-m-Y",strtotime($solicitudes->fecha_regreso )) ?>
                            <td>{{$fecha_regreso  }}</td>
                            <td>{{$solicitudes->hora_r  }}</td>
                            <td>{{$lugar_salida->descripcion}}</td>
                            <td>{{$lugar_regreso->descripcion}}</td>
                            <td>
                                <a href="#!" class="modificar_oficio tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-id="{{ $solicitudes->id_oficio }}"><span class="fa fa-cog " aria-hidden="true"></span></a>
                            </td>

                            <td>
                                <a class="eliminar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" data-id="{{ $solicitudes->id_oficio}}"><span class="fa fa-trash " aria-hidden="true"></span></a>
                            </td>

                        </tr>
                    </tbody>

                </table>
</div>
            </div>


        </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Personal comisionado</h3>
            <div class="tw:w-full tw:lg:w-1/12 tw:lg:grow tw:px-2" >
            <button data-toggle="modal"  data-tooltip="true" data-placement="left" title="Agregar comisionado" data-target="#modal_crear" type="button" class="flotante tw:fixed tw:right-6 tw:bottom-6 tw:z-40 tw:inline-flex tw:size-14 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-xl tw:text-white tw:shadow-theme-lg tw:hover:bg-brand-600">
                <span class="fa fa-plus" aria-hidden="true"></span>
            </button>
            </div>
            <div class="tw:w-full tw:lg:w-6/12 tw:lg:grow tw:px-2">
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Viaticos</th>
                        <th>Vehiculo</th>
                        <th>Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($comisionados as $comisionado)
                        <tr>
                            <td>{{$comisionado->titulo}} {{$comisionado->nombre}}</td>
                            @if($comisionado->viaticos == 2)
                                <td>SI</td>
                            @endif
                            @if($comisionado->viaticos == 1)
                                <td>NO</td>
                            @endif
                            @if($comisionado->automovil == 2)
                                <td><b>Placas: </b>{{$comisionado->placas}}<br><b>Modelo: </b>{{$comisionado->modelo}}<br><b>Licencia: </b>{{$comisionado->licencia}}</td>
                            @endif
                            @if($comisionado->automovil == 1)
                                <td>NO</td>
                            @endif

                            <td>
                                <a class="eliminado tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" data-id="{{ $comisionado->id_oficio_personal}}"><span class="fa fa-trash " aria-hidden="true"></span></a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
</div>
            </div>
        </div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2 tw:text-right">
        @if($encontrado ==1 and $dependencias_r->dependenciasr > 0 )
        <td class="tw:text-center">
            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" onclick="window.location='{{ url('/oficios/solicitudenviar/'. $solicitudes->id_oficio ) }}'" title="Enviar">Enviar</button>
        </td>
        @endif
        @if($encontrado ==0 || $dependencias_r->dependenciasr == 0 )
                <td class="tw:text-center">
                    <button id="mensaje" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" title="Enviar">Enviar</button>
                </td>
            @endif
    </div>
</div>


            <x-panel.modal id="modal_crear" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                            
                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar comisionado</h4>
                        </div>
                        <div class="tw-modal-cuerpo">

                            <form id="form_agregar" class="" action="{{url("/oficios/comisionado/agregarcomisionados")}}" role="form" method="POST" >
                                {{ csrf_field() }}
                            <input type="hidden" id="id_oficio" name="id_oficio" value="{{$oficios->id_oficio}}">
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">

                                    <div class="tw:mb-4">
                                        <label for="selectPersonal">Personal comisionado</label>
                                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="selectPersonal" name="selectPersonal" >
                                            <option disabled selected hidden>Selecciona una opción</option>
                                            @foreach($personales as $personal)
                                                <option value="{{$personal->id_personal}}"> {{$personal->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                    <div class="tw:mb-4">
                                        <label for="selectViatico">Requiere viaticos</label>
                                        <select name="selectViatico" id="selectViatico" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">


                                        </select>
                                    </div>
                                </div>
                                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                    <div class="tw:mb-4">
                                        <label for="selectAutomovil">Requiere automovil</label>
                                        <select name="selectAutomovil" id="selectAutomovil" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                            <option disabled selected>Selecciona...</option>
                                            <option value="2">SI</option>
                                            <option value="1">NO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" style="display: none" id="siguiente">
                                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                    <div class="tw:mb-4">
                                        <label for="automovil">Automovil</label>
                                        <select class="required tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="automoviles" name="automoviles" >
                                            <option disabled selected>Selecciona...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                    <div class="tw:mb-4">
                                        <label for="licencia">licencia</label>
                                        <input class="required tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="licencia" name="licencia" />
                                    </div>
                                </div>
                            </div>
                            </form>
                            <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                                <button id="guardar_agregado"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                            </div>
                        </div>
                    </x-panel.modal>
{{---agregar dependencia----}}
        <x-panel.modal id="modal_dependencia_agregar" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                    <form id="form_agregar" class="" action="{{url("/oficio/dependencia/crear/")}}" role="form" method="POST" >
                        {{ csrf_field() }}
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar otra dependencia</h4>
                    </div>
                    <div class="tw-modal-cuerpo">


                            <input type="hidden" id="id_oficio" name="id_oficio" value="{{$oficios->id_oficio}}">
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:px-2">
                                    <div class="tw:mb-4">
                                        <label for="dependencia">Dependencia de la  comisión</label>
                                        <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="dependencia" name="dependencia" rows="2" placeholder="Ingresa la dependencia de la comisión:
 en la Dirección de institutos Tecnologicos Descentralizados" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:px-2">
                                    <div class="tw:mb-4">
                                        <label for="domicilio3">Dirección de la dependencia de la comisión (calle y numero)</label>
                                        <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="domicilio" name="domicilio" rows="2" placeholder="Ingresa el domicilio de la comisión:
 en Felipe Villanueva No. 535, Col. Centro. " required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >

                                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                    <div class="tw:mb-4">
                                        <label for="exampleInputEmail1">Estado de la comisión<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="estados" name="estados" required>
                                            <option disabled selected hidden>Selecciona una opción</option>
                                            @foreach($estados as $estados)
                                                <option value="{{$estados->id_estado}}" data-esta="{{$estados->nombre_estado}}">{{$estados->nombre_estado}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                    <div class="tw:mb-4">
                                        <label for="exampleInputEmail1">Municipio o Ciudad de dependencia la comisión<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="municipio" name="municipio" value="" required>
                                            <option disabled selected hidden>Selecciona una opción</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                    </div>
                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                            <button type="submit"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                        </div>
                    </form>
                    </x-panel.modal>
        
        {{----fin deendencia---}}
        <x-panel.modal id="modal_modificar_dependencia" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                    <form action="{{url("/oficios/dependencia/editar")}}" role="form" method="POST" >
                        {{ csrf_field() }}
                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                            
                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar oficio</h4>
                        </div>
                        <div id="contenedor_modificar_dependencia">


                        </div>

                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                            <input  type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Guardar"/>
                        </div>
                    </form>
                </x-panel.modal>
        {{---modificar oficio--}}
        <x-panel.modal id="modal_modificar_oficio" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                    <form action="{{url("/oficios/solicitud/modificar")}}" role="form" method="POST" >
                        {{ csrf_field() }}
                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                            
                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar solicitud de oficio</h4>
                        </div>
                        <div id="contenedor_modificar_oficio">


                        </div>

                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                            <input  type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Guardar"/>
                        </div>
                    </form>
                </x-panel.modal>
        <form action="" method="POST" role="form" id="">
            {{method_field('DELETE') }}
            {{ csrf_field() }}
        </form>
        <!-- eliminar dependencia -->
        <x-panel.modal id="modal_eliminar_dependencia" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">
                    <form action="{{url("/oficios/eliminar_dependencia/")}}" method="POST" role="form" id="form_eliminar_dependencia">
                    <div class="tw-modal-cuerpo tw:pt-14">
                        {{method_field('DELETE') }}
                            {{ csrf_field() }}
                            ¿Realmente deseas eliminar esta dependencia?
                        <input type="hidden" id="id_dependencia" name="id_dependencia" value="">
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <input id="confirma_elimina_dependencia" type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Aceptar"/>
                    </div>
                    </form>
                </x-panel.modal>
        <!-- eliminar oficio -->
        <x-panel.modal id="modal_eliminar_oficio" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">
                    <form action="{{url("/oficios/eliminar/")}}" method="POST" role="form" >
                        <div class="tw-modal-cuerpo tw:pt-14">
                            {{method_field('DELETE') }}
                            {{ csrf_field() }}
                            ¿Realmente deseas eliminar esta dependencia?
                            <input type="hidden" id="id_oficio_dep" name="id_oficio_dep" value="">
                        </div>
                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                            <input id="confirma_elimina_oficio" type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Aceptar"/>
                        </div>
                    </form>
                </x-panel.modal>

        <!-- Mensaje de no agregar comisionado -->
        <x-panel.modal id="modal_agrega" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">
                    <div class="tw-modal-cuerpo tw:pt-14">

                        <p class="tw:text-center">No se a agregado <br> ningun comisionado o <br> ninguna dependencia</p>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>

                    </div>
                </x-panel.modal>

    </main>
    <form action="" method="POST" role="form" id="form_eliminado">
        {{method_field('DELETE') }}
        {{ csrf_field() }}
    </form>
    <form action="" method="POST" role="form" id="form_delete">
        {{method_field('DELETE') }}
        {{ csrf_field() }}
    </form>

    <script>

        $(document).ready(function() {
            $(".modificar_dependencia").click(function(){
                var id=$(this).data("id");
                $.get("/oficio/dependencia/modificar/"+id,function(request){
                    $("#contenedor_modificar_dependencia").html(request);
                    $("#modal_modificar_dependencia").modal('show');

                });
            });
            $(".modificar_oficio").click(function(){
                var id=$(this).data("id");
                $.get("/oficios/solicitud_oficio/"+id,function(request){
                    $("#contenedor_modificar_oficio").html(request);
                    $("#modal_modificar_oficio").modal('show');

                });

            });


            $("#selectAutomovil").change(function() {
                var auto=$(this).val();
                if(auto ==2){
                    $("#aceptar").css("display", "none");
                    $("#siguiente").css("display", "inline");



                } if(auto ==1){
                    $("#aceptar").css("display", "inline");
                    $("#siguiente").css("display", "none");



                }
            });

            $("#mensaje").click(function(){

                $('#modal_agrega').modal('show');
            });
            $("#guardar_agregado").click(function(event){
                $("#form_agregar").submit();
            });

            $("#form_agregar").validate({
                rules: {
                    selectPersonal : "required",
                    selectViatico: "required",
                    selectAutomovil: "required",
                },
            });
            $(".eliminar_dependencia").click(function(){
                var id=$(this).data('id');
                $('#id_dependencia').val(id);
                $('#modal_eliminar_dependencia').modal('show');
            });
            $(".eliminar").click(function(){
                var id_oficio=$(this).data('id');
                $('#id_oficio_dep').val(id_oficio);
                $('#modal_eliminar_oficio').modal('show');


            });

            $(".eliminado").click(function(){
                var id=$(this).data('id');

                swal({
                    title: "¿Seguro que desea eliminar?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $("#form_delete").attr("action","/oficios/eliminado/"+id)
                            $("#form_delete").submit();
                        }
                    });
            });

            $("#selectPersonal").change(function(){
                var id_oficio = $('#id_oficio').val();
                var id_personal = $( this ).val();

                $.get("/automovil/"+id_personal+"/"+id_oficio+"",function(response,state){
                  $("#automoviles").empty();
                    $('#automoviles').append('<option disabled selected>Selecciona...</option>');
                    for(i=0; i<response.length; i++)
                  {
                        //  TNotify.alert(subcatObj);
                        $('#automoviles').append("<option value='"+response[i].id_vehiculo+"'>"+response[i].modelo+""+response[i].placas+"</option>");
                    }
                });
                $.get("/viaticos/"+id_personal+"/"+id_oficio+"",function(response,state){
                    $("#selectViatico").empty();
                    $('#selectViatico').append('<option disabled selected>Selecciona...</option>');
                    for(i=0; i<response.length; i++)
                    {

                        $('#selectViatico').append("<option value='"+response[i].id_respuesta+"'>"+response[i].respuesta+"</option>");
                    }
                });
            });


            $("#estados").change(function(e){
                console.log(e);
                var id_estado= e.target.value;
                $.get('/ajax-subcat?id_estado=' + id_estado,function(data){

                    $('#municipio').empty();
                    $.each(data,function(datos_alumno,subcatObj){
                        //  TNotify.alert(subcatObj);
                        $('#municipio').append('<option value="'+subcatObj.id_municipio+'" data-muni="'+subcatObj.nombre_municipio+'" >'+subcatObj.nombre_municipio+'</option>');
                    });
                });
            });

        });
    </script>
</div>
@endsection