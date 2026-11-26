@extends('layouts.panel')
@section('title', 'Oficios')
@push('styles')
    @vite('resources/css/marco.css')
@endpush
@include('partials.panel.recursos_app', ['datepicker' => true, 'pickatime' => true])
@section('content')
<div class="tw-pantalla">
    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <x-panel.encabezado titulo="Solicitud de Oficio de Comisión" :migas="['Oficios de comisión' => null]" />
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            
            <div class="tw:w-full tw:p-5 tw:sm:p-6">
    <div data-stepper-secciones  class="tw:space-y-5" data-stepper-errores="{{ json_encode($errors->messages()) }}">
        <x-panel.stepper id="comision" :pasos="['Datos de la comisión', 'Destinos', 'Fechas y horarios']" externo />
            <form data-stepper-formulario id="form_solicitud_oficio" action="{{url("/oficios/solicitud/creada")}}"class="" role="form" method="POST">

                {{ csrf_field() }}
    <section id="comision-paso-0" data-stepper-seccion  class="tw:space-y-4 tw:motion-safe:animate-in tw:motion-safe:fade-in tw:motion-safe:duration-200">
        <h4 data-stepper-titulo tabindex="-1" class="tw:text-sm tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Datos de la comisión</h4>
             <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
             <div class="tw:w-full tw:px-2">
                     <div class="tw:mb-4">
                         <label for="descripcion_oficio">Motivo de la comisión </label>
                        <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="descripcion_oficio" name="descripcion_oficio" data-stepper-requerido="Ingresa el motivo de la comisión." rows="3" placeholder="Ingresa el motivo de la comisión (Utilizar letras mayusculas y minusculas), por ejemplo:
 Entregar documentación"></textarea>

                     </div>
             </div>
             </div>
                <style>
                    .depe {
                        background-color:#e8eaf6;

                    }


                </style>
    </section>
    <section id="comision-paso-1" data-stepper-seccion  class="tw:space-y-4 tw:motion-safe:animate-in tw:motion-safe:fade-in tw:motion-safe:duration-200">
        <h4 data-stepper-titulo tabindex="-1" class="tw:text-sm tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Destinos</h4>
                <div class="depe">
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                        <div class="tw:mb-4">
                            <label for="dependencia">Dependencia de la comisión</label>
                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="dependencia" name="dependencia" data-stepper-requerido="Ingresa la dependencia." rows="3"  placeholder="Ingresa la dependencia de la comisión (La primera palabra que debe utilizar es 'en'), Ejemplo: en la Dirección General de Personal y la Subsecretaria de Educación Superior y Normal"></textarea>
                        </div>
                    </div>
                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                        <div class="tw:mb-4">
                            <label for="domicilio">Dirección de la dependencia de la comisión (calle y numero)</label>
                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="domicilio" name="domicilio" data-stepper-requerido="Ingresa el domicilio." rows="3" placeholder="Ingresa domicilio (calle y  número de la dependencia de la comisión) (La primera palabra que debe utilizar es 'en'), Ejemplo: en Lerdo No. 216"></textarea>
                        </div>
                    </div>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
                    <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                        <div class="tw:mb-4">
                            <label for="exampleInputEmail1">Estado de la comisión<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="estados" name="estados" data-stepper-requerido="Selecciona el estado." >
                                <option disabled selected hidden>Selecciona una opción</option>
                                @foreach($estados_alu as $estados_alu)
                                    <option value="{{$estados_alu->id_estado}}" data-esta="{{$estados_alu->nombre_estado}}">{{$estados_alu->nombre_estado}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                        <div class="tw:mb-4">
                            <label for="exampleInputEmail1">Municipio o Ciudad de la comisión<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="municipios" name="municipios" data-stepper-requerido="Selecciona el municipio." value="">
                                <option disabled selected hidden>Selecciona una opción</option>
                            </select>
                        </div>
                    </div>
                    <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                        <div class="tw:mb-4">
                            <label for="segunda_dependencia">¿Acude a otra dependencia?<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg"></b></label>
                            <select name="segunda_dependencia" data-stepper-requerido="Indica si acudes a otra dependencia." id="segunda_dependencia" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                <option disabled selected>Selecciona...</option>
                                <option value="2">SI</option>
                                <option value="1">NO</option>
                            </select>
                        </div>
                    </div>
                </div>
                    <hr >
                </div>

                {{---segunda dependencia---}}
                <div class="dependencia_dos" style="display:none; ">
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                            <div class="tw:mb-4">
                                <label for="dependencia2">Segunda Dependencia de la comisión</label>
                                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="dependencia2" name="dependencia2" data-stepper-requerido="Ingresa la segunda dependencia." data-stepper-omitir rows="2" placeholder="Ingresa la segunda dependencia de la comisión (La primera palabra que debe utilizar es 'en'), Ejemplo: en las Oficinas de Seguros y Finanzas"  required></textarea>
                            </div>
                        </div>
                        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                            <div class="tw:mb-4">
                                <label for="domicilio2">Dirección de la Segunda  dependencia de la comisión (calle y numero)</label>
                                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="domicilio2" name="domicilio2" data-stepper-requerido="Ingresa el domicilio de la segunda dependencia." data-stepper-omitir rows="2" placeholder="Ingresa domicilio de la segunda dependencia de la comisión (calle y  número de la dependencia de la comisión) (La primera palabra que debe utilizar es 'en'), Ejemplo: en Urawa No. 100 " required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
                        <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2">
                            <div class="tw:mb-4">
                                <label for="exampleInputEmail1">Estado de la comisión<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="estados2" name="estados2" data-stepper-requerido="Selecciona el estado de la segunda dependencia." data-stepper-omitir required>
                                    <option disabled selected hidden>Selecciona una opción</option>
                                    @foreach($estados_segundo  as $estados_segundo)
                                        <option value="{{$estados_segundo->id_estado}}" data-esta="{{$estados_segundo->nombre_estado}}">{{$estados_segundo->nombre_estado}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2">
                            <div class="tw:mb-4">
                                <label for="exampleInputEmail1">Municipio o Ciudad de la Segunda dependencia<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="selecciona una Opcion" id="municipio2" name="municipio2" data-stepper-requerido="Selecciona el municipio de la segunda dependencia." data-stepper-omitir value="" required>
                                    <option disabled selected hidden>Selecciona una opción</option>
                                </select>
                            </div>
                        </div>
                        <div class="tw:w-full tw:lg:w-2/12 tw:lg:grow tw:px-2">
                            <div class="tw:mb-4">
                                <label for="tercera_dependencia">¿Acude a otra dependencia?<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg"></b></label>
                                <select name="tercera_dependencia" data-stepper-requerido="Indica si acudes a una tercera dependencia." data-stepper-omitir id="tercera_dependencia" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                    <option disabled selected>Selecciona...</option>
                                    <option value="2">SI</option>
                                    <option value="1">NO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                {{---termino de la segunda dependencia--}}
                {{---tercera dependencia---}}
                <div class="dependencia_tres" style="display: none;">
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                            <div class="tw:mb-4">
                                <label for="dependencia3">Tercera Dependencia de la comisión</label>
                                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="dependencia3" name="dependencia3" data-stepper-requerido="Ingresa la tercera dependencia." data-stepper-omitir rows="2" placeholder="Ingresa la tercera dependencia de la comisión (La primera palabra que debe utilizar es 'en'), Ejemplo: en la Secretaria de la Contraloria" required></textarea>
                            </div>
                        </div>
                        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                            <div class="tw:mb-4">
                                <label for="domicilio3">Dirección de la tercera dependencia de la comisión (calle y numero)</label>
                                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="domicilio3" name="domicilio3" data-stepper-requerido="Ingresa el domicilio de la tercera dependencia." data-stepper-omitir rows="2" placeholder="Ingresa domicilio de la tercera dependencia de la comisión (calle y  número de la dependencia de la comisión) (La primera palabra que debe utilizar es 'en'), Ejemplo: en 1 de Mayo esquina Robert Boch" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >

                        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                            <div class="tw:mb-4">
                                <label for="exampleInputEmail1">Estado de la comisión<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="estados3" name="estados3" data-stepper-requerido="Selecciona el estado de la tercera dependencia." data-stepper-omitir required>
                                    <option disabled selected hidden>Selecciona una opción</option>
                                    @foreach($estados_tercero  as $estados_tercero)
                                        <option value="{{$estados_tercero->id_estado}}" data-esta="{{$estados_tercero->nombre_estado}}">{{$estados_tercero->nombre_estado}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                            <div class="tw:mb-4">
                                <label for="exampleInputEmail1">Municipio o Ciudad de tercera dependencia la comisión<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="municipio3" name="municipio3" data-stepper-requerido="Selecciona el municipio de la tercera dependencia." data-stepper-omitir value="" required>
                                    <option disabled selected hidden>Selecciona una opción</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                {{---termino de la tercera dependencia--}}

    </section>
    <section id="comision-paso-2" data-stepper-seccion  class="tw:space-y-4 tw:motion-safe:animate-in tw:motion-safe:fade-in tw:motion-safe:duration-200">
        <h4 data-stepper-titulo tabindex="-1" class="tw:text-sm tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Fechas y horarios</h4>
             <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                 <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                     <label for="fechadesalida">Horario de salida de la comisión</label>
                     <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                     <div class="tw:mb-4">
                             <input id="hora_s" class="time tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="text" name="hora_s" data-stepper-requerido="Ingresa la hora de salida." placeholder="HORA" />
                     </div>
                     </div>
                     <div class="tw:w-full tw:lg:w-5/12 tw:px-2">
                     <div class="tw:mb-4">
                         <input class="datepicker fecha_salida tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   type="text"  id="fecha_s" name="fecha_salida" data-stepper-requerido="Ingresa la fecha de salida." data-date-format="yyyy/mm/dd" placeholder="AAAA/MM/DD" >
                     </div>
                     </div>
                 </div>
                  <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                      <label for="fecha_regreso">Horario de regreso de la comisión</label>
                      <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                      <div class="tw:mb-4">
                          <input id="hora_r" type="text" class="time tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="hora_r" data-stepper-requerido="Ingresa la hora de regreso." placeholder="HORA" />

                      </div>
                      </div>
                      <div class="tw:w-full tw:lg:w-5/12 tw:px-2">
                      <div class="tw:mb-4">
                      <input class="datepicker fecha_regreso tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="text" id="fecha_r" name="fecha_regreso" data-stepper-requerido="Ingresa la fecha de regreso." data-date-format="yyyy/mm/dd" placeholder="AAAA/MM/DD">

                      </div>

                      </div>
                  </div>
             </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                    <div class="tw:mb-4">
                        <label for="selectLugar_s">Lugar de salida</label>
                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="selectLugar_s" name="selectLugar_s" data-stepper-requerido="Selecciona el lugar de salida." >
                            <option disabled selected hidden>Selecciona una opción</option>
                            @foreach($lugares as $lugar)
                                <option value="{{$lugar->id_lugar}}" data-esta="{{$lugar->descripcion}}"> {{$lugar->descripcion}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                    <div class="tw:mb-4">
                        <label for="selectLugar_r">Lugar de regreso</label>
                        <select name="selectLugar_r" data-stepper-requerido="Selecciona el lugar de regreso." id="selectLugar_r" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                            <option disabled selected hidden>Selecciona una opción</option>
                            @foreach($lugares as $lugar)
                                <option value="{{$lugar->id_lugar}}" data-esta="{{$lugar->descripcion}}"> {{$lugar->descripcion}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                </div>
    </section>

            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" style="display: inline" id="aceptar">
                <div class="m tw:w-full tw:px-2">
                    <button id="guardar_solicitud" type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Aceptar</button>
                </div>

            </div>
            </form>
        <x-panel.stepper-navegacion />
    </div>
        </div>
        </div>

    @include('partials.panel.stepper-secciones')


         <script type="text/javascript">
        $(document).ready( function() {
            var getDate = function (input) {
                return new Date(input.date.valueOf());
            }
            $( '.fecha_salida').datepicker({
                pickTime: false,
                autoclose: true,
                language: 'es',
                startDate: '+0d',
            }).on('changeDate',
                function (selected) {
                    $('.fecha_regreso').datepicker('setStartDate', getDate(selected));
                });
            $( '.fecha_regreso' ).datepicker({
                pickTime: false,
                autoclose: true,
                language: 'es',
                startDate: '+0d',
            }).on('changeDate',
                function (selected) {
                    $('.fecha_salida').datepicker('setEndDate', getDate(selected));
                });
            $('#hora_s').pickatime({
                format: 'HH:i',

            });
            $('#hora_r').pickatime({

                format: 'HH:i',
            });

           });
        $("#estados").change(function(e){
            console.log(e);
            var id_estado= e.target.value;

            $.get('/ajax-subcat?id_estado=' + id_estado,function(data){

                $('#municipios').empty();
                ;
                $.each(data,function(datos_alumno,subcatObj){
                    //  TNotify.alert(subcatObj);
                    $('#municipios').append('<option value="'+subcatObj.id_municipio+'" data-muni="'+subcatObj.nombre_municipio+'" >'+subcatObj.nombre_municipio+'</option>');
                });
                $('#municipios').trigger('change');
            });

        });
        $("#estados2").change(function(e){
            console.log(e);
            var id_estado= e.target.value;

            $.get('/ajax-subcat?id_estado=' + id_estado,function(data){


                $('#municipio2').empty();

                $.each(data,function(datos_alumno,subcatObj){
                    //  TNotify.alert(subcatObj);
                    $('#municipio2').append('<option value="'+subcatObj.id_municipio+'" data-muni="'+subcatObj.nombre_municipio+'" >'+subcatObj.nombre_municipio+'</option>');

                });
                $('#municipio2').trigger('change');
            });

        });
        $("#estados3").change(function(e){
            console.log(e);
            var id_estado= e.target.value;
            $.get('/ajax-subcat?id_estado=' + id_estado,function(data){


                $('#municipio3').empty();

                $.each(data,function(datos_alumno,subcatObj){
                    //  TNotify.alert(subcatObj);
                    $('#municipio3').append('<option value="'+subcatObj.id_municipio+'" data-muni="'+subcatObj.nombre_municipio+'" >'+subcatObj.nombre_municipio+'</option>');

                });
                $('#municipio3').trigger('change');
            });

        });

        function actualizarDestinos() {
            const segundo = $('#segunda_dependencia').val() === '2';
            const tercero = segundo && $('#tercera_dependencia').val() === '2';
            $('.dependencia_dos').toggle(segundo).find('[data-stepper-requerido]')
                .each(function () { this.toggleAttribute('data-stepper-omitir', !segundo); });
            $('.dependencia_tres').toggle(tercero).find('[data-stepper-requerido]')
                .each(function () { this.toggleAttribute('data-stepper-omitir', !tercero); });
            $('#form_solicitud_oficio').trigger('stepper:revisar');
        }
        $('#segunda_dependencia, #tercera_dependencia').on('change', actualizarDestinos);
        actualizarDestinos();

         </script>


    </main>
    </div>
@endsection