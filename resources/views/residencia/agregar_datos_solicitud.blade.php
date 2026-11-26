@extends('layouts.panel')
@section('title', ' solicitud para residencia profesional')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <main class="tw:w-full tw:lg:w-full tw:px-2">

        @if($estado_reg_soli == 0)
            <x-panel.encabezado titulo="Agregar datos de la solicitud para residencia profesional" :migas="['Residencia profesional' => null]" />
            <form id="form_registro_solicitud" class="" action="{{url("/residencia/guardar_solicitud_residencia/".$anteproyecto->id_anteproyecto)}}" role="form" method="POST" >
                {{ csrf_field() }}
              <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                    <div class="tw:p-5 tw:sm:p-6">
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                                <p>Lugar:	VALLE DE BRAVO, ESTADO DE MÉXICO</p>
                            </div>
                            <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                <?php
                                $fecha_hoy = date("d-m-Y");
                                ?>
                                <p >Fecha: {{ $fecha_hoy }}</p>

                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                                <p>{{ $datos_jefe->titulo }} {{ $datos_jefe->nombre }}</p>
                                <p><b>JEFE DE DIVISIÓN DE  {{ $datos_jefe->carrera }} </b></p>
                                <p>PRESENTE</p>
                            </div>

                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <p><b>NOMBRE DEL PROYECTO: </b> <br> {{ $nombre_proyecto }}</p>
                            </div>
                        </div>

                                <div class="tw:rounded-lg tw:bg-brand-50 tw:py-3 tw:dark:bg-brand-500/10 tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-10/12 tw:px-2">
                                        <p></p><b>Selecciona  la opción del proyecto       <br></b></p>
                                        @foreach($opciones_proyecto as $opcion)
                                              <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input   type="radio" name="id_opcion_proyecto" id="id_opcion_proyecto" value="{{ $opcion->id_opcion_proy }}">{{ $opcion->nombre_opcion }}</label>
                                        @endforeach
                                    </div>
                                </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-10/12 tw:px-2">
                                <p><b>PERIODO PROYECTADO: </b>  {{ $nombre_periodo_seguimiento->periodo }}</p>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <hr size="11">
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <p><b>Datos de la empresa</b> </p>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <p><b>Nombre de la empresa: </b> {{ $datos_empresa->nombre }}</p>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <p><b>Giro de la empresa: </b> {{ $datos_empresa->giro }}</p>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <p><b>Sector de la empresa: </b> {{ $datos_empresa->sector }}</p>
                            </div>
                        </div>

                                <div class="tw:rounded-lg tw:bg-brand-50 tw:py-3 tw:dark:bg-brand-500/10 tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="rfc_empresa">Ingresa el RFC de la empresa:</label>
                                            <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" onkeyup="javascript:this.value=this.value.toUpperCase();"  id="rfc_empresa" name="rfc_empresa" type="text" placeholder="Ingresa RFC de la empresa" required></input>
                                        </div>
                                    </div>
                                </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <p><b>Domicilio de la empresa: </b> {{ $domicilio_empresa }}</p>
                            </div>
                        </div>
                            <div class="tw:rounded-lg tw:bg-brand-50 tw:py-3 tw:dark:bg-brand-500/10 tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                    <div class="tw:mb-4">
                                        <label for="colonia_empresa">Ingresa colonia donde se encuentra la empresa</label>
                                        <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   id="colonia_empresa" name="colonia_empresa" type="text" placeholder="Ingresa la colonia donde se encuentra la empresa" required></input>
                                    </div>
                                </div>
                                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                    <div class="tw:mb-4">
                                        <label for="codigo_postal">Ingresa Codigo Postal donde se encuentra la empresa:</label>
                                        <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   id="codigo_postal" name="codigo_postal" type="int" placeholder="Ingresa codigo postal donde se encuentra la empresa" required></input>
                                    </div>
                                </div>
                            </div>
                            <div class="tw:rounded-lg tw:bg-brand-50 tw:py-3 tw:dark:bg-brand-500/10 tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                    <div class="tw:mb-4">
                                        <label for="municipio_empresa">Ingresa Ciudad o Municipio donde se encuentra la empresa:</label>
                                        <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   id="municipio_empresa" name="municipio_empresa" type="text" placeholder="Ingresa municipio o ciudad donde se encuentra la empresa" required></input>
                                    </div>
                                </div>
                                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                    <div class="tw:mb-4">
                                        <label for="telefono_empresa">Ingresa telefono (no celular) de la empresa:</label>
                                        <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   id="telefono_empresa" name="telefono_empresa" type="tel" placeholder="Ingresa telefono de la empresa" required></input>
                                    </div>
                                </div>
                            </div>
                            <div class="tw:rounded-lg tw:bg-brand-50 tw:py-3 tw:dark:bg-brand-500/10 tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:lg:w-full tw:px-2">
                                    <div class="tw:mb-4">
                                        <label for="mision_empresa">Ingresa la misión de la empresa:</label>
                                        <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"  id="mision_empresa" name="mision_empresa" rows="5" placeholder="Ingresa misión de la empresa" required></textarea>
                                    </div>
                                </div>
                            </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <hr size="11">
                            </div>
                        </div>

                            <div  class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                    <p><b>Nombre del titular de la empresa o institución: </b> {{ $datos_empresa->dir_gral }}</p>
                                </div>
                                <div class="tw:rounded-lg tw:bg-brand-50 tw:py-3 tw:dark:bg-brand-500/10 tw:w-full tw:lg:w-6/12 tw:px-2">
                                    <div class="tw:mb-4">
                                        <label for="puesto_titular_empresa">Ingresa el puesto del titular de la empresa o institución :</label>
                                        <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   id="puesto_titular_empresa" name="puesto_titular_empresa" type="text" placeholder="Ingresa el puesto del titular de la empresa o institución" required></input>
                                    </div>
                                </div>
                            </div>


                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                <p><b>Nombre del Asesor Externo:: </b> {{ $datos_empresa->asesor }}</p>
                            </div>
                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                <p><b>Puesto: </b> {{ $datos_empresa->puesto }}</p>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <hr size="11">
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <p><b>Datos del Residente:</b> </p>
                            </div>
                        </div>

                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <p><b>Nombre del residente: </b> {{ $datos_alumn->nombre }} {{ $datos_alumn->apaterno }} {{ $datos_alumn->amaterno }}</p>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                <p><b>Carrera: </b> {{ $datos_alumn->carrera }} </p>
                            </div>
                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                <p><b>No. cuenta: </b> {{ $datos_alumn->cuenta }} </p>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:bg-sky-100 tw:dark:bg-sky-500/15">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="domiclio_estudiante">Ingresa tu domicilio:</label>
                                    <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   id="domiclio_estudiante" name="domiclio_estudiante" type="text" placeholder="Ingresa tu domicilio" required></input>
                                </div>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                <p><b>E-mail: </b> {{ $datos_alumn->email }} </p>
                            </div>
                            <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                <p><b>Para Seguridad Social acudir: </b> {{ $datos_alumn->seguro_social }} </p>
                            </div>
                            <div class="tw:rounded-lg tw:bg-brand-50 tw:py-3 tw:dark:bg-brand-500/10 tw:w-full tw:lg:w-3/12 tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="no_seguro">No. seguro social:</label>
                                    <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   id="no_seguro" name="no_seguro" type="text" placeholder="Ingresa tu número de seguro social" value="{{ $datos_alumn->numero_seguro_social }}" required></input>
                                </div>

                            </div>
                        </div>

                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                <p><b>Ciudad o municipio: </b> {{ $datos_alumn->nombre_municipio }} </p>
                            </div>
                            <div class="tw:rounded-lg tw:bg-brand-50 tw:py-3 tw:dark:bg-brand-500/10 tw:w-full tw:lg:w-6/12 tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="telefono_estudiante">Ingresa tu telefono:</label>
                                    <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   id="telefono_estudiante" name="telefono_estudiante" type="tel" placeholder="Ingresa tu telefono"  required></input>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
            </form>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="registrar_datos">Guardar Datos</button>
                </div>
            </div>
        @else
            <x-panel.encabezado titulo="Modificar datos de la solicitud para residencia profesional" :migas="['Residencia profesional' => null]" />
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <a class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" onclick="window.open('{{url('/residencia/pdf_solicitud_residencia/'.$anteproyecto->id_anteproyecto)}}')">Imprimir Solicitud para residencia profesional</a>
            </div>
        </div>
            <form id="form_modificar_solicitud" class="" action="{{url("/residencia/guardar_mod_solicitud_residencia/".$anteproyecto->id_anteproyecto)}}" role="form" method="POST" >
                {{ csrf_field() }}
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6">
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                                        <p>Lugar:	VALLE DE BRAVO, ESTADO DE MÉXICO</p>
                                    </div>
                                    <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                        <?php
                                        $fecha_hoy = date("d-m-Y");
                                        ?>
                                        <p >Fecha: {{ $fecha_hoy }}</p>

                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                                        <p>{{ $datos_jefe->titulo }} {{ $datos_jefe->nombre }}</p>
                                        <p><b>JEFE DE DIVISIÓN DE  {{ $datos_jefe->carrera }} </b></p>
                                        <p>PRESENTE</p>
                                    </div>

                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <p><b>NOMBRE DEL PROYECTO: </b> <br> {{ $nombre_proyecto }}</p>
                                    </div>
                                </div>

                                <div class="tw:rounded-lg tw:bg-brand-50 tw:py-3 tw:dark:bg-brand-500/10 tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-10/12 tw:px-2">
                                        <p></p><b>Selecciona  la opción del proyecto       <br></b></p>
                                        @foreach($opciones_proyecto as $opcion)
                                            @if($opcion->id_opcion_proy == $reg_solicitud->id_opcion_proyecto)
                                                <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input   type="radio" name="id_opcion_proyecto" id="id_opcion_proyecto" value="{{ $opcion->id_opcion_proy }}" checked>{{ $opcion->nombre_opcion }}</label>
                                            @else
                                            <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input   type="radio" name="id_opcion_proyecto" id="id_opcion_proyecto" value="{{ $opcion->id_opcion_proy }}">{{ $opcion->nombre_opcion }}</label>
                                             @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-10/12 tw:px-2">
                                        <p><b>PERIODO PROYECTADO: </b>  {{ $nombre_periodo_seguimiento->periodo }}</p>
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <hr size="11">
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <p><b>Datos de la empresa</b> </p>
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <p><b>Nombre de la empresa: </b> {{ $datos_empresa->nombre }}</p>
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <p><b>Giro de la empresa: </b> {{ $datos_empresa->giro }}</p>
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <p><b>Sector de la empresa: </b> {{ $datos_empresa->sector }}</p>
                                    </div>
                                </div>

                                <div class="tw:rounded-lg tw:bg-brand-50 tw:py-3 tw:dark:bg-brand-500/10 tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="rfc_empresa">Ingresa el RFC de la empresa:</label>
                                            <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" onkeyup="javascript:this.value=this.value.toUpperCase();"  id="rfc_empresa" name="rfc_empresa" type="text" placeholder="Ingresa RFC de la empresa" value="{{ $reg_solicitud->rfc_empresa }}" required></input>
                                        </div>
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <p><b>Domicilio de la empresa: </b> {{ $domicilio_empresa }}</p>
                                    </div>
                                </div>
                                <div class="tw:rounded-lg tw:bg-brand-50 tw:py-3 tw:dark:bg-brand-500/10 tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="colonia_empresa">Ingresa colonia donde se encuentra la empresa</label>
                                            <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   id="colonia_empresa" name="colonia_empresa" type="text" placeholder="Ingresa la colonia donde se encuentra la empresa" value="{{ $reg_solicitud->colonia_empresa }}" required></input>
                                        </div>
                                    </div>
                                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="codigo_postal">Ingresa Codigo Postal donde se encuentra la empresa:</label>
                                            <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   id="codigo_postal" name="codigo_postal" type="int" placeholder="Ingresa codigo postal donde se encuentra la empresa" value="{{ $reg_solicitud->codigo_postal_empresa }}" required></input>
                                        </div>
                                    </div>
                                </div>
                                <div class="tw:rounded-lg tw:bg-brand-50 tw:py-3 tw:dark:bg-brand-500/10 tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="municipio_empresa">Ingresa Ciudad o Municipio donde se encuentra la empresa:</label>
                                            <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   id="municipio_empresa" name="municipio_empresa" type="text" placeholder="Ingresa municipio o ciudad donde se encuentra la empresa" value="{{ $reg_solicitud->ciudad_municipio_empresa }}" required></input>
                                        </div>
                                    </div>
                                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="telefono_empresa">Ingresa telefono (no celular) de la empresa:</label>
                                            <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   id="telefono_empresa" name="telefono_empresa" type="tel" placeholder="Ingresa telefono de la empresa" value="{{ $reg_solicitud->telefono_empresa }}" required></input>
                                        </div>
                                    </div>
                                </div>
                                <div class="tw:rounded-lg tw:bg-brand-50 tw:py-3 tw:dark:bg-brand-500/10 tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="mision_empresa">Ingresa la misión de la empresa:</label>
                                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"  id="mision_empresa" name="mision_empresa" rows="5" placeholder="Ingresa misión de la empresa"  required>{{ $reg_solicitud->mision_empresa }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <hr size="11">
                                    </div>
                                </div>

                                <div  class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                        <p><b>Nombre del titular de la empresa o institución: </b> {{ $datos_empresa->dir_gral }}</p>
                                    </div>
                                    <div class="tw:rounded-lg tw:bg-brand-50 tw:py-3 tw:dark:bg-brand-500/10 tw:w-full tw:lg:w-6/12 tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="puesto_titular_empresa">Ingresa el puesto del titular de la empresa o institución :</label>
                                            <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   id="puesto_titular_empresa" name="puesto_titular_empresa" type="text" placeholder="Ingresa el puesto del titular de la empresa o institución" value="{{ $reg_solicitud->puesto_titular_empresa }}" required></input>
                                        </div>
                                    </div>
                                </div>


                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                        <p><b>Nombre del Asesor Externo:: </b> {{ $datos_empresa->asesor }}</p>
                                    </div>
                                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                        <p><b>Puesto: </b> {{ $datos_empresa->puesto }}</p>
                                    </div>
                                </div>

                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <hr size="11">
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <p><b>Datos del Residente:</b> </p>
                                    </div>
                                </div>

                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <p><b>Nombre del residente: </b> {{ $datos_alumn->nombre }} {{ $datos_alumn->apaterno }} {{ $datos_alumn->amaterno }}</p>
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                        <p><b>Carrera: </b> {{ $datos_alumn->carrera }} </p>
                                    </div>
                                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                        <p><b>No. cuenta: </b> {{ $datos_alumn->cuenta }} </p>
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:bg-sky-100 tw:dark:bg-sky-500/15">
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="domiclio_estudiante">Ingresa tu domicilio:</label>
                                            <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   id="domiclio_estudiante" name="domiclio_estudiante" type="text" placeholder="Ingresa tu domicilio" value="{{ $reg_solicitud->domiclio_estudiante }}" required></input>
                                        </div>
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                        <p><b>E-mail: </b> {{ $datos_alumn->email }} </p>
                                    </div>
                                    <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                        <p><b>Para Seguridad Social acudir: </b> {{ $datos_alumn->seguro_social }} </p>
                                    </div>
                                    <div class="tw:rounded-lg tw:bg-brand-50 tw:py-3 tw:dark:bg-brand-500/10 tw:w-full tw:lg:w-3/12 tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="no_seguro">No. seguro social:</label>
                                            <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   id="no_seguro" name="no_seguro" type="text" placeholder="Ingresa tu número de seguro social" value="{{ $reg_solicitud->no_seguro_estudiante }}" required></input>
                                        </div>

                                    </div>
                                </div>

                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                        <p><b>Ciudad o municipio: </b> {{ $datos_alumn->nombre_municipio }} </p>
                                    </div>
                                    <div class="tw:rounded-lg tw:bg-brand-50 tw:py-3 tw:dark:bg-brand-500/10 tw:w-full tw:lg:w-6/12 tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="telefono_estudiante">Ingresa tu telefono:</label>
                                            <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   id="telefono_estudiante" name="telefono_estudiante" type="tel" placeholder="Ingresa tu telefono" value="{{ $reg_solicitud->telefono_estudiante }}"  required></input>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>
            </form>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="modificar_datos">Modificar Datos</button>
                </div>
            </div>
        @endif

    </main>
    <script type="text/javascript">


        $(document).ready(function() {
           $("#registrar_datos").click(function (){

               var id_opcion_proyecto = $("input[type='radio'][name='id_opcion_proyecto']:checked").val();
             //  TNotify.alert(id_opcion_proyecto);
               if(id_opcion_proyecto != undefined){
                   var rfc_empresa = $("#rfc_empresa").val();
                   if(rfc_empresa != "") {
                       var colonia_empresa = $("#colonia_empresa").val();
                       if (colonia_empresa != "") {
                           var codigo_postal = $("#codigo_postal").val();
                           if (codigo_postal != "") {
                               var municipio_empresa = $("#municipio_empresa").val();
                               if (municipio_empresa != "") {
                                   var telefono_empresa = $("#telefono_empresa").val();
                                   if (telefono_empresa != "") {
                                       var mision_empresa = $("#mision_empresa").val();
                                       if (mision_empresa != "") {
                                           var titular_empresa = $("#titular_empresa").val();
                                           if (titular_empresa != "") {
                                               var puesto_titular_empresa = $("#puesto_titular_empresa").val();
                                               if (puesto_titular_empresa != "") {
                                                           var domiclio_estudiante = $("#domiclio_estudiante").val();
                                                           if (domiclio_estudiante != "") {
                                                               var no_seguro = $("#no_seguro").val();
                                                               if (no_seguro != "") {
                                                                   var telefono_estudiante = $("#telefono_estudiante").val();
                                                                   if (telefono_estudiante != "") {
                                                                       $("#registrar_datos").attr("disabled", true);
                                                                       $("#form_registro_solicitud").submit();
                                                                       swal({
                                                                           position: "top",
                                                                           type: "success",
                                                                           title: "Registro exitoso",
                                                                           showConfirmButton: false,
                                                                           timer: 3500
                                                                       });
                                                                   } else {
                                                                       swal({
                                                                           position: "top",
                                                                           type: "warning",
                                                                           title: "Ingresa tu telefono",
                                                                           showConfirmButton: false,
                                                                           timer: 3500
                                                                       });
                                                                   }

                                                               } else {
                                                                   swal({
                                                                       position: "top",
                                                                       type: "warning",
                                                                       title: "Ingresa tu no. seguro social",
                                                                       showConfirmButton: false,
                                                                       timer: 3500
                                                                   });
                                                               }
                                                           } else {
                                                               swal({
                                                                   position: "top",
                                                                   type: "warning",
                                                                   title: "Ingresa tu domicilio",
                                                                   showConfirmButton: false,
                                                                   timer: 3500
                                                               });
                                                           }





                                               } else {
                                                   swal({
                                                       position: "top",
                                                       type: "warning",
                                                       title: "Ingresa el puesto del titular de la empresa o institución",
                                                       showConfirmButton: false,
                                                       timer: 3500
                                                   });
                                               }

                                           } else {
                                               swal({
                                                   position: "top",
                                                   type: "warning",
                                                   title: "Ingresa el nombre del titular de la empresa o institución",
                                                   showConfirmButton: false,
                                                   timer: 3500
                                               });
                                           }
                                       } else {
                                           swal({
                                               position: "top",
                                               type: "warning",
                                               title: "Ingresa la misión de la empresa",
                                               showConfirmButton: false,
                                               timer: 3500
                                           });
                                       }

                                   } else {
                                       swal({
                                           position: "top",
                                           type: "warning",
                                           title: "Ingresa telefono (no celular) de la empresa",
                                           showConfirmButton: false,
                                           timer: 3500
                                       });
                                   }

                               } else {
                                   swal({
                                       position: "top",
                                       type: "warning",
                                       title: "Ingresa Ciudad o Municipio donde se encuentra la empresa",
                                       showConfirmButton: false,
                                       timer: 3500
                                   });
                               }
                           } else {
                               swal({
                                   position: "top",
                                   type: "warning",
                                   title: "Ingresa Codigo Postal donde se encuentra la empresa",
                                   showConfirmButton: false,
                                   timer: 3500
                               });
                           }

                       } else {
                           swal({
                               position: "top",
                               type: "warning",
                               title: "Ingresa colonia donde se encuentra la empresa",
                               showConfirmButton: false,
                               timer: 3500
                           });
                       }
                   }else{
                       swal({
                           position: "top",
                           type: "warning",
                           title: "Ingresa el RFC de la empresa",
                           showConfirmButton: false,
                           timer: 3500
                       });
                   }
               }else {
                   swal({
                       position: "top",
                       type: "warning",
                       title: "Selecciona  la opción del proyecto ",
                       showConfirmButton: false,
                       timer: 3500
                   });
               }

             /*  var nombre_proyecto = $("#nombre_proyecto").val();
               if (nombre_proyecto != "") {
                   $("#guardar_solicitud").attr("disabled", true);
                   $("#form_portada").submit();
                   swal({
                       position: "top",
                       type: "success",
                       title: "Registro exitoso",
                       showConfirmButton: false,
                       timer: 3500
                   });

               }
               else{
                   swal({
                       position: "top",
                       type: "warning",
                       title: "Selecciona  la opción del proyecto ",
                       showConfirmButton: false,
                       timer: 3500
                   });
               }

              */

           });
            $("#modificar_datos").click(function (){

                var id_opcion_proyecto = $("input[type='radio'][name='id_opcion_proyecto']:checked").val();
                //  TNotify.alert(id_opcion_proyecto);
                if(id_opcion_proyecto != undefined){
                    var rfc_empresa = $("#rfc_empresa").val();
                    if(rfc_empresa != "") {
                        var colonia_empresa = $("#colonia_empresa").val();
                        if (colonia_empresa != "") {
                            var codigo_postal = $("#codigo_postal").val();
                            if (codigo_postal != "") {
                                var municipio_empresa = $("#municipio_empresa").val();
                                if (municipio_empresa != "") {
                                    var telefono_empresa = $("#telefono_empresa").val();
                                    if (telefono_empresa != "") {
                                        var mision_empresa = $("#mision_empresa").val();
                                        if (mision_empresa != "") {
                                            var titular_empresa = $("#titular_empresa").val();
                                            if (titular_empresa != "") {
                                                var puesto_titular_empresa = $("#puesto_titular_empresa").val();
                                                if (puesto_titular_empresa != "") {
                                                            var domiclio_estudiante = $("#domiclio_estudiante").val();
                                                            if (domiclio_estudiante != "") {
                                                                var no_seguro = $("#no_seguro").val();
                                                                if (no_seguro != "") {
                                                                    var telefono_estudiante = $("#telefono_estudiante").val();
                                                                    if (telefono_estudiante != "") {
                                                                        $("#modificar_datos").attr("disabled", true);
                                                                        $("#form_modificar_solicitud").submit();
                                                                        swal({
                                                                            position: "top",
                                                                            type: "success",
                                                                            title: "Registro exitoso",
                                                                            showConfirmButton: false,
                                                                            timer: 3500
                                                                        });
                                                                    } else {
                                                                        swal({
                                                                            position: "top",
                                                                            type: "warning",
                                                                            title: "Ingresa tu telefono",
                                                                            showConfirmButton: false,
                                                                            timer: 3500
                                                                        });
                                                                    }

                                                                } else {
                                                                    swal({
                                                                        position: "top",
                                                                        type: "warning",
                                                                        title: "Ingresa tu no. seguro social",
                                                                        showConfirmButton: false,
                                                                        timer: 3500
                                                                    });
                                                                }
                                                            } else {
                                                                swal({
                                                                    position: "top",
                                                                    type: "warning",
                                                                    title: "Ingresa tu domicilio",
                                                                    showConfirmButton: false,
                                                                    timer: 3500
                                                                });
                                                            }





                                                } else {
                                                    swal({
                                                        position: "top",
                                                        type: "warning",
                                                        title: "Ingresa el puesto del titular de la empresa o institución",
                                                        showConfirmButton: false,
                                                        timer: 3500
                                                    });
                                                }

                                            } else {
                                                swal({
                                                    position: "top",
                                                    type: "warning",
                                                    title: "Ingresa el nombre del titular de la empresa o institución",
                                                    showConfirmButton: false,
                                                    timer: 3500
                                                });
                                            }
                                        } else {
                                            swal({
                                                position: "top",
                                                type: "warning",
                                                title: "Ingresa la misión de la empresa",
                                                showConfirmButton: false,
                                                timer: 3500
                                            });
                                        }

                                    } else {
                                        swal({
                                            position: "top",
                                            type: "warning",
                                            title: "Ingresa telefono (no celular) de la empresa",
                                            showConfirmButton: false,
                                            timer: 3500
                                        });
                                    }

                                } else {
                                    swal({
                                        position: "top",
                                        type: "warning",
                                        title: "Ingresa Ciudad o Municipio donde se encuentra la empresa",
                                        showConfirmButton: false,
                                        timer: 3500
                                    });
                                }
                            } else {
                                swal({
                                    position: "top",
                                    type: "warning",
                                    title: "Ingresa Codigo Postal donde se encuentra la empresa",
                                    showConfirmButton: false,
                                    timer: 3500
                                });
                            }

                        } else {
                            swal({
                                position: "top",
                                type: "warning",
                                title: "Ingresa colonia donde se encuentra la empresa",
                                showConfirmButton: false,
                                timer: 3500
                            });
                        }
                    }else{
                        swal({
                            position: "top",
                            type: "warning",
                            title: "Ingresa el RFC de la empresa",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }
                }else {
                    swal({
                        position: "top",
                        type: "warning",
                        title: "Selecciona  la opción del proyecto ",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }

                /*  var nombre_proyecto = $("#nombre_proyecto").val();
                  if (nombre_proyecto != "") {
                      $("#guardar_solicitud").attr("disabled", true);
                      $("#form_portada").submit();
                      swal({
                          position: "top",
                          type: "success",
                          title: "Registro exitoso",
                          showConfirmButton: false,
                          timer: 3500
                      });

                  }
                  else{
                      swal({
                          position: "top",
                          type: "warning",
                          title: "Selecciona  la opción del proyecto ",
                          showConfirmButton: false,
                          timer: 3500
                      });
                  }

                 */

            });
        });
    </script>

</div>
@endsection