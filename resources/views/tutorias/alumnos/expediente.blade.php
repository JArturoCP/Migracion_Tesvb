@extends('layouts.panel')
@section('title', 'Llenar expediente')
@include('tutorias.partials.recursos_panel')
@section('content')
    @include('tutorias.alumnos.partial.navegacion_panel', ['titulo' => 'Llenar expediente', 'activa' => '/tutorias/inicioalu'])

    {{-- #expediente: aquí monta Vue (mismos v-model, @click y validaciones). x-ignore: Alpine no procesa la plantilla Vue. --}}
    <x-panel.tarjeta class="tw-pantalla">
<div id="expediente" x-ignore>
        <div class="tw:w-full tw:px-2">
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <nav>
                        <div class="tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200" id="nav-tab" role="tablist">
                            <a class="tw-pestana" @click="categoria('generales')" v-bind:class="{active:actgenerales}" id="exp-generales-tab" data-toggle="tab" href="#exp-generales" role="tab" aria-controls="exp-generales" aria-selected="true">Datos Generales</a>
                            <a class="tw-pestana" @click="categoria('academico')" v-bind:class="{active:actacademico, disabled:disacademico}" id="exp-antecedentes-tab" data-toggle="tab" href="#exp-antecedentes" role="tab" aria-controls="exp-antecedentes" aria-selected="false">Antecedentes Académicos</a>
                            <a class="tw-pestana" @click="categoria('familiares')" v-bind:class="{active:actfamiliares, disabled:disfamiliares}" id="exp-familiares-tab" data-toggle="tab" href="#exp-familiares" role="tab" aria-controls="exp-familiares" aria-selected="false">Datos Familiares</a>
                            <a class="tw-pestana" @click="categoria('estudio')" v-bind:class="{active:actestudio, disabled:disestudio}"   id="exp-habitos-tab" data-toggle="tab" href="#exp-habitos" role="tab" aria-controls="exp-habitos" aria-selected="false">Hábitos de Estudio</a>
                            <a class="tw-pestana" @click="categoria('integral')" v-bind:class="{active:actintegral, disabled:disintegral}" id="formacion-tab" data-toggle="tab" href="#exp-formacion" role="tab" aria-controls="exp-formacion" aria-selected="false">Formación Integral/Salud</a>
                            <a class="tw-pestana" @click="categoria('area')" v-bind:class="{active:actarea, disabled:disarea}" id="exp-area-tab" data-toggle="tab" href="#exp-area" role="tab" aria-controls="exp-area" aria-selected="false">Área Psicopedagógica</a>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    {{ csrf_field() }}
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade" v-bind:class="{show:actgenerales,active:actgenerales}" id="exp-generales" role="tabpanel" aria-labelledby="exp-generales-tab">
                            <div class="" >
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:pt-4 tw:pr-4 tw:pl-4">
                                    <div class="tw:w-full tw:content-center tw:px-2">
                                        <h4 class="tw:text-center tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-brand-200 tw:bg-brand-50 tw:text-brand-700 tw:pt-6"><b>Datos Generales</b></h4>
                                    </div>
                                </div>
                                <div class="tw:p-5 tw:sm:p-6">
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-5/12 tw:px-2">
                                            <label for="foto">Fotografía personal * <p class="tw:font-semibold">Nota: Solo una única vez subes la fotografía</p></label>
                                            <input type="file" class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden" accept="image/jpeg,image/png" @change="ObtenerImagen" required>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='imagenMiniatura==null'>Subir fotografía personal</small>
                                        </div>
                                        <div class="tw:w-4/12 tw:px-2">
                                            <img :src="imagenMiniatura" alt="" width="150px">
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="nombre">Estudiante </label>
                                            <input type="text" id="nombre" name="nombre" v-model="alu.generales.nombre" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Nombre" required disabled>
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="sexo">Sexo *</label>
                                            <select name="sexo" id="sexo"  class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" v-model="alu.generales.sexo" required>
                                                <option value="null" selected>Elija un sexo</option>
                                                <option value="M">Masculino</option>
                                                <option value="F">Femenino</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.generales.sexo==null || alu.generales.sexo=="null"'>Elija un sexo</small>
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="fn">Fecha de nacimiento </label>
                                            <input type="date" v-model="alu.generales.fecha_nacimientos" id="fn" name="fecha_nacimiento" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Fecha de Nacimiento" required disabled>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="edad">Edad</label>
                                            <input type="number" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" v-model="alu.generales.edad" id="edad" name="edad" placeholder="Edad">
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="ln">Lugar de nacimiento</label>
                                            <input type="text" id="ln" v-model="alu.generales.lugar_nacimientos" name="lugar_nacimiento" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Lugar de Nacimiento">
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="direccion">Dirección *</label>
                                            <input type="text" v-model="alu.generales.direccion"  id="direccion" name="direccion" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="Dirección" required>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.generales.direccion==null || alu.generales.direccion=="" '>Colocar una dirección</small>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="EC">Estado civil *</label>
                                            <select name="estado_civil" id="EC" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" v-model="alu.generales.id_estado_civil" required>
                                                <option value="null" selected >Elija el estado civil</option>
                                                <option v-bind:value="es.id_estado_civil" v-for="es in estadociv">@{{es.desc_ec}}</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.generales.id_estado_civil==null || alu.generales.id_estado_civil=="null"'>Elija una opción</small>
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="estado">No. Hijos *</label>
                                            <select id="nh" name="no_hijos" v-model="alu.generales.no_hijos" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="1">0</option>
                                                <option value="2">1</option>
                                                <option value="3">2</option>
                                                <option value="4">3</option>
                                                <option value="5">4 o más</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.generales.no_hijos=="null" || alu.generales.no_hijos==null '>Colocar un número de hijos</small>
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="correo">e-mail </label>
                                            <input type="text" v-model="alu.generales.correo"  id="correo" name="correo" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Correo" required disabled>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="tel-casa">Tel. Casa</label>
                                            <input type="tel" title="Sólo números, máximo 10 dígitos." pattern="[0-9]{10}"  v-model="alu.generales.tel_casa" id="tel-casa" name="tel_casa" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Tel. Casa">
                                        </div>
                                        <div class="tw:w-full tw:md:w-3/12 tw:px-2">
                                            <label for="cel">Celular *</label>
                                            <input type="tel" title="Sólo números, máximo 10 dígitos." pattern="[0-9]{10}" v-model="alu.generales.cel"  id="cel" name="cel" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Cel" required>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.generales.cel==null || alu.generales.cel==""'>Colocar un número celular</small>
                                        </div>
                                        <div class="tw:w-full tw:md:w-5/12 tw:px-2">
                                            <label for="carrera">Programa educativo </label>
                                            <select name="carrera" id="carrera" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" v-model="alu.generales.id_carrera" required disabled>
                                                <option value="null" >Elija una opción</option>
                                                <option v-bind:value="car.id_carrera" v-for="car in carreras">@{{car.nombre}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="periodo">Periodo </label>
                                            <select name="periodo" id="periodo" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" v-model="alu.generales.id_periodo" required disabled>
                                                <option value="null" selected>Elija un periodo</option>
                                                <option v-bind:value="period.id_periodo" v-for="period in periodos">@{{period.periodo}}</option>
                                            </select>
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="semestre">Semestre </label>
                                            <select name="semestre" id="semestre" v-model="alu.generales.id_semestre" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required disabled>
                                                <option value="null" selected>Elija un semestre</option>
                                                <option v-bind:value="sem.id_semestre" v-for="sem in semestres">@{{sem.descripcion}}</option>
                                            </select>
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="grupo">Grupo *</label>
                                            <select name="grupo" id="grupo" v-model="alu.generales.id_grupo" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija un grupo</option>
                                                <option v-bind:value="gru.id_grupo" v-for="gru in grupo">@{{gru.grupo}}</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.generales.id_grupo==null || alu.generales.id_grupo=="null"'>Elija un grupo</small>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="turno">Turno *</label>
                                            <select name="turno" id="turno" v-model="alu.generales.turno" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija turno</option>
                                                <option v-bind:value="turn.id_turno" v-for="turn in turno">@{{turn.descripcion_turno}}</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.generales.turno==null || alu.generales.turno=="null"'>Elija una opción</small>
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="estado">Estado académico *</label>
                                            <select id="estado" name="estado" v-model="alu.generales.estado" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija estado académico</option>
                                                <option value="1">Regular</option>
                                                <option value="2">Irregular</option>
                                                <option value="3">Suspensión</option>
                                                <option value="4">Baja temporal</option>
                                                <option value="5">Baja definitiva</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='(alu.generales.estado==null || alu.generales.estado=="null")'>Elija un estado académico</small>
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="noC">No. Cuenta</label>
                                            <input type="text" id="noC"  name="no_cuenta" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" v-model="alu.generales.no_cuenta"  placeholder="No. Cuenta" disabled>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="poblacion">Tipo de población</label>
                                            <select name="poblacion" id="poblacion" v-model="alu.generales.poblacion" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="Rural">Rural</option>
                                                <option value="Urbana">Urbana</option>
                                            </select>
                                        </div>
                                        <div class="tw:w-full tw:md:w-3/12 tw:px-2">
                                            <label for="nivel_economico">Nivel Socio-Económico *</label>
                                            <input disabled type="text" v-model="alu.generales.nivel_economico"  id="nivel_economico" name="nivel_economico" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Nivel Socio-Económico" required>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if="alu.generales.nivel_economico==null">Realizar test</small>
                                        </div>
                                        <div class="tw:w-1/12 tw:text-left tw:pt-4 tw:px-2" v-if="alu.generales.nivel_economico==null">
                                            <button class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm"  data-toggle="modal" data-target="#modalNSE"><i class="fa fa-file"></i></button>
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="trabaja">Trabaja *</label>
                                            <select name="trabaja" id="trabaja" v-model="alu.generales.trabaja" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija Opción</option>
                                                <option value="1">Si</option>
                                                <option value="2" @click="borra_trabaja()">No</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.generales.trabaja==null || alu.generales.trabaja=="null"'>Elija una opción</small>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" v-if="alu.generales.trabaja==1">
                                        <div class="tw:w-full tw:md:w-6/12 tw:px-2">
                                            <label for="ocupacion">Ocupación</label>
                                            <input type="text" v-model="alu.generales.ocupacion"  name="ocupacion" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Ocupación">
                                        </div>
                                        <div class="tw:w-full tw:md:w-6/12 tw:px-2">
                                            <label for="horario">Horario de trabajo</label>
                                            <input type="text" v-model="alu.generales.horario"  id="horario" name="horario" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Horario">
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="ant_inst">Antecedentes institucionales</label>
                                            <select name="ant_inst" id="ant_inst" v-model="alu.generales.ant_inst" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="Continuación de estudios">Continuación de estudios</option>
                                                <option value="Cambio de carrera/institución">Cambio de carrera/institución</option>
                                            </select>
                                        </div>
                                        <div class="tw:w-full tw:md:w-5/12 tw:px-2">
                                            <label for="satisfaccion_c">Nivel de satisfacción con el programa educativo</label>
                                            <select name="satisfaccion_c" id="satisfaccion_c" v-model="alu.generales.satisfaccion_c" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="Muy satisfecho">Muy satisfecho</option>
                                                <option value="Satisfecho">Satisfecho</option>
                                                <option value="Regular">Regular</option>
                                                <option value="Inconforme">Inconforme</option>
                                            </select>
                                        </div>
                                        <div class="tw:w-full tw:md:w-3/12 tw:px-2">
                                            <label for="beca">¿Cuenta con beca? *</label>
                                            <select name="beca" id="beca" v-model="alu.generales.beca" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2"  @click="borra_beca()">No</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.generales.beca==null || alu.generales.beca=="null"'>Elija una opción</small>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2" v-if="alu.generales.beca==1">
                                            <label for="tbeca">¿Qué tipo de beca? *</label>
                                            <select name="tbeca" id="tbeca" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" v-model="alu.generales.id_expbeca" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option v-bind:value="bec.id_expbeca" v-for="bec in becas">@{{bec.descripcion_beca}}</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.generales.id_expbeca==null || alu.generales.id_expbeca=="null"'>Elija una opción</small>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="materias_repeticion">Materias en repeticion *</label>
                                            <select name="materias_repeticion" id="materias_repeticion" v-model="alu.generales.materias_repeticion" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2"  @click="alu.generales.tot_repe=null">No</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.generales.materias_repeticion==null || alu.generales.materias_repeticion=="null"'>Elija una opción</small>
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2" v-if="alu.generales.materias_repeticion==1">
                                            <label for="tot_repe">Número de materias en repetición</label>
                                            <select name="tot_repe" v-model="alu.generales.tot_repe" id="tot_repe" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="1">0</option>
                                                <option value="2">1</option>
                                                <option value="3">2</option>
                                                <option value="4">3 o más</option>
                                            </select>
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="materias_especial">Materias en especial *</label>
                                            <select name="materias_especial" v-model="alu.generales.materias_especial" id="materias_especial" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2"  @click="alu.generales.tot_espe=null">No</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.generales.materias_especial==null || alu.generales.materias_especial=="null"'>Elija una opción</small>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-6/12 tw:px-2" v-if="alu.generales.materias_especial==1">
                                            <label for="tot_espe">Número de materias en especial</label>
                                            <select name="tot_espe" id="tot_espe" v-model="alu.generales.tot_espe" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="1">0</option>
                                                <option value="2">1</option>
                                                <option value="3">2</option>
                                                <option value="4">3 o más</option>
                                            </select>
                                        </div>
                                        <div class="tw:w-full tw:md:w-6/12 tw:px-2">
                                            <label for="gen_espe">Número de especiales totales</label>
                                            <select name="gen_espe" v-model="alu.generales.gen_espe" id="gen_espe" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="1">0</option>
                                                <option value="2">1</option>
                                                <option value="3">2</option>
                                                <option value="4">3 o más</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="tw:w-full tw:pt-6 tw:px-2" v-if="llenogen==false">
                                    <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700 tw:text-center">
                                        Por favor, llena todos los campos requeridos para poder pasar al llenado de la siguiente área del expediente. Gracias.
                                    </div>
                                </div>
                                <div class="tw:w-full tw:pt-6 tw:px-2">
                                    <button class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:w-full tw:px-2 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" @click="siguiente('academico')">Siguiente</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" v-bind:class="{show:actacademico,active:actacademico}" id="exp-antecedentes" role="tabpanel" aria-labelledby="exp-antecedentes-tab">
                            <div class="" >
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:pt-4 tw:pr-4 tw:pl-4">
                                    <div class="tw:w-full tw:content-center tw:px-2">
                                        <h4 class="tw:text-center tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-brand-200 tw:bg-brand-50 tw:text-brand-700 tw:pt-6"><b>Antecedentes Académicos</b></h4>
                                    </div>
                                </div>
                                <div class="tw:p-5 tw:sm:p-6">

                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:pt-4 tw:pr-4 tw:pl-4">
                                        <div class="tw:w-full tw:content-center tw:px-2">
                                            <h5 class="tw:text-center tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-gray-200 tw:bg-gray-50 tw:text-gray-700 tw:pt-2"><b>Nivel Medio-Superior</b></h5>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="bachillerato">Tipo de bachillerato</label>
                                            <select name="bachillerato" v-model="alu.academicos.id_bachillerato" id="bachillerato" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                                <option value="null" selected>Elija una opción</option>
                                                <option v-bind:value="bach.id_bachillerato" v-for="bach in bachiller">@{{bach.desc_bachillerato}}</option>
                                            </select>
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="cb">Años en que cursó el bachillerato</label>
                                            <select v-model="alu.academicos.anos_curso_bachillerato" id="cb" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">Más de 5</option>
                                            </select>
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="at">Año de terminación</label>
                                            <input type="number" v-model="alu.academicos.ano_terminacion" name="ano_terminacion" id="at" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Año de terminación">
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="epro">Escuela de procedencia</label>
                                            <input type="text" v-model="alu.academicos.escuela_procedente" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="epro" name="escuela_procedencia" placeholder="Escuela de procedencia">
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="promedio">Promedio</label>
                                            <input type="number" name="promedio" v-model="alu.academicos.promedio" id="promedio" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Promedio">
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="mrb">Materias reprobadas en bachillerato</label>
                                            <input type="text" v-model="alu.academicos.materias_reprobadas" id="mrb" name="materias_reprobadas" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Materias reprobadas en bachillerato">
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-6/12 tw:px-2">
                                            <label for="sus">Suspensión de estudios después de terminado el bachillerato</label>
                                            <select id="sus" v-model="alu.academicos.suspension_estudios_bachillerato" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2" @click="alu.academicos.razones_suspension_estudios=null">No</option>
                                            </select>
                                        </div>
                                        <div class="tw:w-full tw:md:w-6/12 tw:px-2" v-if="alu.academicos.suspension_estudios_bachillerato==1">
                                            <label for="razonesSus">Razones de suspensión de estudios</label>
                                            <input type="text" v-model="alu.academicos.razones_suspension_estudios" name="razonesSus" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Razones">
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:pt-4 tw:pr-4 tw:pl-4">
                                        <div class="tw:w-full tw:content-center tw:px-2">
                                            <h5 class="tw:text-center tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-gray-200 tw:bg-gray-50 tw:text-gray-700 tw:pt-2"><b>Nivel Superior</b></h5>
                                        </div>
                                    </div>

                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2">
                                            <label for="rde">¿Cuál fue la razón por la que decidiste estudiar en el TESVB?</label>
                                            <input type="text" v-model="alu.academicos.razon_descide_estudiar_tesvb" id="rde" name="razon_decide_estudiar_tesvb" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Cuál fue la razón por la que decidiste estudiar en el TESVB">
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2">
                                            <label for="perfil">¿Tienes información sobre el perfil profesional del programa educativo?</label>
                                            <input type="text" v-model="alu.academicos.sabedel_perfil_profesional" id="perfil" name="perfil" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Tienes información sobre el perfil profesional de la carrera">
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2">
                                            <label for="cae">¿Te gusta el programa educativo elegido? *</label>
                                            <select v-model="alu.academicos.tegusta_carrera_elegida" id="cae" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2" @click="alu.academicos.porque_carrera_elegida=null">No</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.academicos.tegusta_carrera_elegida==null || alu.academicos.tegusta_carrera_elegida=="null"'>Elija una opción</small>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2" id="pq" v-if="alu.academicos.tegusta_carrera_elegida==1 ||alu.academicos.tegusta_carrera_elegida==2">
                                            <label for="pq">¿Por qué?</label>
                                            <input type="text" v-model="alu.academicos.porque_carrera_elegida" name="pq" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="¿Por qué?">
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2">
                                            <label for="ie">Interrupciones en los estudios</label>
                                            <select  id="ie" v-model="alu.academicos.interrupciones_estudios" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2" @click="alu.academicos.razones_interrupcion=null">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2" id="razones" v-if="alu.academicos.interrupciones_estudios==1">
                                            <label for="razones">Razones de la interrupción en los estudios</label>
                                            <input type="text" v-model="alu.academicos.razones_interrupcion" id="razones" name="razones_interrupcion" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Razones">
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="tefe">¿Te motiva tu familia en tus estudios? *</label>
                                            <select v-model="alu.academicos.teestimula_familia" id="tefe" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2">No</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.academicos.teestimula_familia==null || alu.academicos.teestimula_familia=="null"'>Elija una opción</small>
                                        </div>
                                        <div class="tw:w-full tw:md:w-8/12 tw:px-2">
                                            <label for="ov">¿Tuviste otras opciones vocacionales o preferencias por otros programas educativos?</label>
                                            <select id="ov" v-model="alu.academicos.otras_opciones_vocales" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2" @click="alu.academicos.cuales_otras_opciones_vocales=null">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2"  id="cuales" v-if="alu.academicos.otras_opciones_vocales==1">
                                            <label for="cuales">¿Cuales?</label>
                                            <input name="cuales" v-model="alu.academicos.cuales_otras_opciones_vocales" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="¿Cuales?">
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:pt-4 tw:pr-4 tw:pl-4">
                                        <div class="tw:w-full tw:content-center tw:px-2">
                                            <h5 class="tw:text-center tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-gray-200 tw:bg-gray-50 tw:text-gray-700 tw:pt-2"><b>Otros estudios</b></h5>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2">
                                            <label for="oti">Otro programa educativo iniciado *</label>
                                            <select v-model="alu.academicos.otra_carrera_ini" id="oti" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2" @click="borra_institucion()">No</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.academicos.otra_carrera_ini==null || alu.academicos.otra_carrera_ini=="null"'>Elija una opción</small>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" v-if="alu.academicos.otra_carrera_ini==1">
                                        <div class="tw:w-full tw:md:w-8/12 tw:px-2">
                                            <label for="institucion">Institución</label>
                                            <input name="institucion" v-model="alu.academicos.institucion" id="institucion" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Institución">
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="SC">Semestres cursados</label>
                                            <select v-model="alu.academicos.semestres_cursados" id="SC" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                                <option value="null" selected >Elija una opción</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">Más de 5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2">
                                            <label for="oe">Otros Estudios</label>
                                            <select v-model="alu.academicos.otros_estudios" id="oe" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="tw:w-full tw:pt-6 tw:px-2" v-if="llenoant==false">
                                    <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700 tw:text-center">
                                        Por favor, llena todos los campos requeridos para poder pasar al llenado de la siguiente área del expediente. Gracias.
                                    </div>
                                </div>
                                <div class="tw:w-full tw:pt-6 tw:px-2">
                                    <button class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:w-full tw:px-2 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" @click="siguiente('familiares')">Siguiente</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" v-bind:class="{show:actfamiliares,active:actfamiliares}" id="exp-familiares" role="tabpanel" aria-labelledby="exp-familiares-tab">
                            <div class="" >
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:pt-4 tw:pr-4 tw:pl-4">
                                    <div class="tw:w-full tw:content-center tw:px-2">
                                        <h4 class="tw:text-center tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-brand-200 tw:bg-brand-50 tw:text-brand-700 tw:pt-6"><b>Datos Familiares</b></h4>
                                    </div>
                                </div>
                                <div class="tw:p-5 tw:sm:p-6">
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="np">Nombre del padre *</label>
                                            <input name="nombre_padre" v-model="alu.familiares.nombre_padre" id="np" type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Nombre del padre" required>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.familiares.nombre_padre==null || alu.familiares.nombre_padre=="" '>Colocar nombre del padre</small>
                                        </div>
                                        <div class="tw:w-full tw:md:w-2/12 tw:px-2">
                                            <label for="edadP">Edad</label>
                                            <input type="number" v-model="alu.familiares.edad_padre" name="edad_padre" id="edadP" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Edad">
                                        </div>
                                        <div class="tw:w-full tw:md:w-2/12 tw:px-2">
                                            <label for="ocupacionP">Ocupación</label>
                                            <input name="ocupacion_padre" v-model="alu.familiares.ocupacion_padre" id="ocupacionP" type="text" placeholder="Ocupación" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="LRP">Lugar de residencia *</label>
                                            <input v-model="alu.familiares.lugar_residencia_padre" name="lugar_residencia_padre" id="LRP" placeholder="Lugar de residencia" type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.familiares.lugar_residencia_padre==null || alu.familiares.lugar_residencia_padre=="" '>Colocar un lugar de residencia del padre</small>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="nm">Nombre de la madre *</label>
                                            <input type="text" v-model="alu.familiares.nombre_madre" name="nombre_madre" id="nm" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Nombre de la madre" required>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.familiares.nombre_madre==null || alu.familiares.nombre_madre=="" '>Colocar nombre de la madre</small>
                                        </div>
                                        <div class="tw:w-full tw:md:w-2/12 tw:px-2">
                                            <label for="edadM">Edad</label>
                                            <input type="number" v-model="alu.familiares.edad_madre" name="edad_madre" id="edadM" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Edad">
                                        </div>
                                        <div class="tw:w-full tw:md:w-2/12 tw:px-2">
                                            <label for="ocupacionM">Ocupación</label>
                                            <input id="ocupacionM" v-model="alu.familiares.ocupacion_madre" name="ocupacion_madre" type="text" placeholder="Ocupación" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="LRM">Lugar de residencia *</label>
                                            <input id="LRM" v-model="alu.familiares.lugar_residencia_madre" name="lugar_residencia_madre" type="text" placeholder="Lugar de residencia" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.familiares.lugar_residencia_madre==null || alu.familiares.lugar_residencia_madre=="" '>Colocar un lugar de residencia de la madre</small>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="nh">Número de hermanos, incluyéndote:</label>
                                            <input type="number" v-model="alu.familiares.no_hermanos" id="nh" name="no_hermanos" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="No. de Hermanos">
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="loe">¿Qué lugar que ocupas entre ellos?</label>
                                            <input type="number" v-model="alu.familiares.lugar_ocupas" id="loe" name="lugar_que_ocupas" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Lugar que ocupas entre ellos">
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="av">Actualmente vives con: *</label>
                                            <select name="actualmente_vives" id="av" v-model="alu.familiares.id_opc_vives" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option v-bind:value="viv.id_opc_vives" v-for="viv in vive">@{{viv.desc_opc}}</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.familiares.id_opc_vives==null || alu.familiares.id_opc_vives=="null"'>Elija una opción</small>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-6/12 tw:px-2">
                                            <label for="nop">Número total de personas con las que vives</label>
                                            <input type="number"  v-model="alu.familiares.no_personas" name="no_persona" id="nop" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="No. de personas">
                                        </div>
                                        <div class="tw:w-full tw:md:w-6/12 tw:px-2">
                                            <label for="etnia">Perteneces a una etnia indígena *</label>
                                            <select name="etnia" id="etnia" v-model="alu.familiares.etnia_indigena" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2" @click="alu.familiares.cual_etnia=null">No</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.familiares.etnia_indigena==null || alu.familiares.etnia_indigena=="null"'>Elija una opción</small>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2" id="cualetnia" v-if="alu.familiares.etnia_indigena==1">
                                            <label for="cualetnia">¿Cual etnia?</label>
                                            <input type="text" v-model="alu.familiares.cual_etnia" name="cual_etnia" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="¿Cual?">
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-6/12 tw:px-2">
                                            <label for="hablas">Hablas una lengua indígena *</label>
                                            <select  id="hablas" v-model="alu.familiares.hablas_lengua_indigena" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2">No</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.familiares.hablas_lengua_indigena==null || alu.familiares.hablas_lengua_indigena=="null"'>Elija una opción</small>
                                        </div>
                                        <div class="tw:w-full tw:md:w-6/12 tw:px-2">
                                            <label for="sostiene">¿Quién sostiene económicamente tu hogar?</label>
                                            <input type="text" v-model="alu.familiares.sostiene_economia_hogar" id="sostiene" name="sosten_hogar" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="¿Quién sostiene económicamente tu hogar?">
                                        </div>
                                    </div>

                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="consideras">Consideras a tu familia *</label>
                                            <select id="consideras" name="consideras_a_familia" v-model="alu.familiares.id_familia_union" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option v-bind:value="uni.id_familia_union" v-for="uni in union">@{{uni.desc_union}}</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.familiares.id_familia_union==null || alu.familiares.id_familia_union=="null"'>Elija una opción</small>
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="nt">Nombre del tutor *</label>
                                            <input type="text" v-model="alu.familiares.nombre_tutor" name="nombre_tutor" id="nt" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Nombre del tutor" required>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.familiares.nombre_tutor==null || alu.familiares.nombre_tutor==""'>Nombre del tutor</small>
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="parentesco">Parentesco *</label>
                                            <select name="parentesco" id="" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  v-model="alu.familiares.id_parentesco" required>
                                                <option value="null">Elija un parentesco</option>
                                                <option v-bind:value="par.id_parentesco" v-for="par in parentesco">@{{par.desc_parentesco}}</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.familiares.id_parentesco==null || alu.familiares.id_parentesco=="null"'>Elija una opción</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="tw:w-full tw:pt-6 tw:px-2" v-if="llenofam==false">
                                    <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700 tw:text-center">
                                        Por favor, llena todos los campos requeridos para poder pasar al llenado de la siguiente área del expediente. Gracias.
                                    </div>
                                </div>
                                <div class="tw:w-full tw:pt-6 tw:px-2">
                                    <button class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:w-full tw:px-2 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" @click="siguiente('estudio')">Siguiente</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" v-bind:class="{show:actestudio,active:actestudio}" id="exp-habitos" role="tabpanel" aria-labelledby="exp-habitos-tab">
                            <div class="" >
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:pt-4 tw:pr-4 tw:pl-4">
                                    <div class="tw:w-full tw:content-center tw:px-2">
                                        <h4 class="tw:text-center tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-brand-200 tw:bg-brand-50 tw:text-brand-700 tw:pt-6"><b>Hábitos de Estudio</b></h4>
                                    </div>
                                </div>
                                <div class="tw:p-5 tw:sm:p-6">
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-6/12 tw:px-2">
                                            <label for="tiempo">Tiempo dedicado a estudiar diariamente fuera de clase *</label>
                                            <select v-model="alu.estudio.tiempo_empleado_estudiar" id="tiempo" type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option v-bind:value="tiemp.id_opc_tiempo" v-for="tiemp in tiempo">@{{tiemp.desc_opc}}</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.estudio.tiempo_empleado_estudiar==null || alu.estudio.tiempo_empleado_estudiar=="null"'>Elija una opción</small>
                                        </div>
                                        <div class="tw:w-full tw:md:w-6/12 tw:px-2">
                                            <label for="fti">¿Cómo es tú forma de trabajo intelectual? *</label>
                                            <select  id="fti" v-model="alu.estudio.id_opc_intelectual" type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                                <option value="null" selected>Elija una Opción</option>
                                                <option v-bind:value="int.id_opc_intelectual" v-for="int in intelectual">@{{int.desc_opc}}</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.estudio.id_opc_intelectual==null || alu.estudio.id_opc_intelectual=="null"'>Elija una opción</small>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2">
                                            <label for="formaes">Tu forma de estudio mas utilizada *</label>
                                            <input name="forma_estudio" v-model="alu.estudio.forma_estudio" id="formaes" type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Tu forma de estudio mas utilizada" required>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.estudio.forma_estudio==null || alu.estudio.forma_estudio=="" '>Colocar una forma de estudio</small>
                                        </div>
                                        <div class="tw:w-full tw:md:w-full tw:px-2">
                                            <label for="empleas">¿Cómo empleas tu tiempo libre?</label>
                                            <input type="text" v-model="alu.estudio.tiempo_libre" name="tiempo_libre" id="empleas" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="¿Cómo empleas tu tiempo libre?">
                                        </div>
                                        <div class="tw:w-full tw:md:w-full tw:px-2">
                                            <label for="asignap">Asignaturas preferidas</label>
                                            <input type="text" v-model="alu.estudio.asignatura_preferida" name="asigna_preferida" id="asignap" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Asignaturas preferidas">
                                        </div>
                                        <div class="tw:w-full tw:md:w-full tw:px-2">
                                            <label for="pqap">¿Por qué?</label>
                                            <input name="porque_asignatura" v-model="alu.estudio.porque_asignatura" id="pqap" type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="¿Por qué?">
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2">
                                            <label for="asigdif">Asignaturas que te han sido difíciles</label>
                                            <input type="text" v-model="alu.estudio.asignatura_dificil" id="asigdif" name="asignatura_dificil" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Asignaturas que te han sido difíciles">
                                        </div>
                                        <div class="tw:w-full tw:md:w-full tw:px-2">
                                            <label for="pqdifi">¿Por qué?</label>
                                            <input name="porque_asignatura_dificil" v-model="alu.estudio.porque_asignatura_dificil" id="pqdifi" type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="¿Por qué?">
                                        </div>
                                        <div class="tw:w-full tw:md:w-full tw:px-2">
                                            <label for="qopin">¿Qué opinión tienes de ti mismo como estudiante?</label>
                                            <input type="text" v-model="alu.estudio.opinion_tu_mismo_estudiante" name="opinion_tu_mismo_estudiante" id="qopin" placeholder="¿Qué opinión tienes de ti mismo como estudiante?" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                        </div>
                                    </div>
                                </div>
                                <div class="tw:w-full tw:pt-6 tw:px-2" v-if="llenohab==false">
                                    <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700 tw:text-center">
                                        Por favor, llena todos los campos requeridos para poder pasar al llenado de la siguiente área del expediente. Gracias.
                                    </div>
                                </div>
                                <div class="tw:w-full tw:pt-6 tw:px-2">
                                    <button class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:w-full tw:px-2 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" @click="siguiente('integral')">Siguiente</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" v-bind:class="{show:actintegral,active:actintegral}" id="exp-formacion" role="tabpanel" aria-labelledby="formacion-tab">
                            <div class="" >
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:pt-4 tw:pr-4 tw:pl-4">
                                    <div class="tw:w-full tw:content-center tw:px-2">
                                        <h4 class="tw:text-center tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-brand-200 tw:bg-brand-50 tw:text-brand-700 tw:pt-6"><b>Formación Integral/Salud</b></h4>
                                    </div>
                                </div>
                                <div class="tw:p-5 tw:sm:p-6">
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2">
                                            <label for="depo">¿Practicas regularmente algún deporte? *</label>
                                            <select name="depo" id="depo" v-model="alu.integral.practica_deporte" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2" @click="alu.integral.especifica_deporte=null">No</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.integral.practica_deporte==null || alu.integral.practica_deporte=="null"'>Elija una opción</small>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2" id="especifica1" v-if="alu.integral.practica_deporte==1">
                                            <label for="especifica1">Especificar deporte</label>
                                            <input type="text" v-model="alu.integral.especifica_deporte" placeholder="Especificar deporte" name="especifica1" id="especifica1" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" >
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2">
                                            <label for="artistica">¿Practicas alguna actividad artística? *</label>
                                            <select name="artistica" id="artistica" v-model="alu.integral.practica_artistica" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2" @click="alu.integral.especifica_artistica=null">No</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.integral.practica_artistica==null || alu.integral.practica_artistica=="null"'>Elija una opción</small>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2" id="especifica2" v-if="alu.integral.practica_artistica==1">
                                            <label for="especifica2">Especificar actividad artística</label>
                                            <input type="text" v-model="alu.integral.especifica_artistica" placeholder="Especificar actividad artística" name="especifica2" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" >
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2">
                                            <label for="actC">¿Participas en actividades culturales o sociales? *</label>
                                            <select  id="actC" name="actC" v-model="alu.integral.actividades_culturales" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2" @click="alu.integral.cuales_act=null">No</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.integral.actividades_culturales==null || alu.integral.actividades_culturales=="null"'>Elija una opción</small>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2" id="cualesAc" v-if="alu.integral.actividades_culturales==1">
                                            <label for="cualesAc">¿Cuáles actividades culturales, sociales?</label>
                                            <input type="text" v-model="alu.integral.cuales_act" name="cualesAc" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Cuáles actividades culturales, sociales">
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="pasatiempo">Tu pasatiempo favorito</label>
                                            <input  name="pasatiempo"  v-model="alu.integral.pasatiempo" id="pasatiempo" placeholder="Pasatiempo" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="escala">¿Ingiere bebidas alcoholicas?</label>
                                            <select name="id_escala" id="id_escala" v-model="alu.integral.id_expbebidas" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                                <option value="null" selected>Elija una opción</option>
                                                <option v-bind:value="bebi.id_expbebidas" v-for="bebi in bebidas">@{{bebi.descripcion_bebida}}</option>
                                            </select>
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="estSalud">¿Cómo consideras tu estado de salud?</label>
                                            <select name="estSalud" v-model="alu.integral.estado_salud" id="estSalud" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="1">Excelente</option>
                                                <option value="2">Buena</option>
                                                <option value="3">Regular</option>
                                                <option value="4">Mala</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2">
                                            <label for="enferCron">¿Padeces alguna enfermedad crónica? *</label>
                                            <select name="enferCron" v-model="alu.integral.enfermedad_cronica" id="enferCron" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2" @click="alu.integral.especifica_enf_cron=null">No</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.integral.enfermedad_cronica==null || alu.integral.enfermedad_cronica=="null"'>Elija una opción</small>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2" id="especificarEnf" v-if="alu.integral.enfermedad_cronica==1">
                                            <label for="especificarEnf">Especificar enfermedad crónica</label>
                                            <input type="text" v-model="alu.integral.especifica_enf_cron" name="especificarEnf" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Especificar enfermedad crónica">
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2">
                                            <label for="EnfPa">¿Tus padres padecen alguna enfermedad crónica? *</label>
                                            <select id="EnfPa" name="EnfPa" v-model="alu.integral.enf_cron_padre"  class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2" @click="alu.integral.especifica_enf_cron_padres=null">No</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.integral.enf_cron_padre==null || alu.integral.enf_cron_padre=="null"'>Elija una opción</small>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2" id="especificarEnfPa" v-if="alu.integral.enf_cron_padre==1">
                                            <label for="especificarEnfPa">Especificar enfermedad crónica de los padres</label>
                                            <input type="text" v-model="alu.integral.especifica_enf_cron_padres" name="especificarEnfPa" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Especificar enfermedad crónica de los padres">
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2">
                                            <label for="operacion">¿Te han realizado alguna cirugía? *</label>
                                            <select id="operacion" name="operacion" v-model="alu.integral.operacion" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2" @click="alu.integral.deque_operacion=null">No</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.integral.operacion==null || alu.integral.operacion=="null"'>Elija una opción</small>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2"id="especificarOpe" v-if="alu.integral.operacion==1">
                                            <label for="especificarOpe">Especificar la cirugía</label>
                                            <input type="text" v-model="alu.integral.deque_operacion" id="especificarOpe" name="especificarOpe" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Especificar la operación médico-quirúrgica">
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2">
                                            <label for="EnVisual">¿Padeces alguna enfermedad visual? *</label>
                                            <select name="EnVisual" v-model="alu.integral.enfer_visual" id="EnVisual" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2" @click="alu.integral.especifica_enf=null">No</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.integral.enfer_visual==null || alu.integral.enfer_visual=="null"'>Elija una opción</small>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2" id="especificarEnVisual" v-if="alu.integral.enfer_visual==1">
                                            <label for="especificarEnVisual">Especificar la enfermedad visual</label>
                                            <input type="text" v-model="alu.integral.especifica_enf" name="especificarEnVisual" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Especificar la enfermedad visual">
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="lentes">¿Usas lentes? *</label>
                                            <select name="lentes" id="lentes" v-model="alu.integral.usas_lentes" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2">No</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.integral.usas_lentes==null || alu.integral.usas_lentes=="null"'>Elija una opción</small>
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="estatura">Estatura</label>
                                            <input type="number" step="0.001" name="estatura" v-model="alu.integral.estatura"  id="estatura" placeholder="Estatura" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="peso">Peso</label>
                                            <input type="number" v-model="alu.integral.peso" id="peso" name="peso" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Peso">
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2">
                                            <label for="mediContro">¿Tomas medicamento controlado? *</label>
                                            <select name="mediContro" v-model="alu.integral.medicamento_controlado" id="mediContro" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2" @click="alu.integral.especifica_medicamento=null">No</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.integral.medicamento_controlado==null || alu.integral.medicamento_controlado=="null"'>Elija una opción</small>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2" id="especificarMed" v-if="alu.integral.medicamento_controlado==1">
                                            <label for="especificarMed">Especificar el medicamento</label>
                                            <input type="text"  v-model="alu.integral.especifica_medicamento"  name="especificarMed" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Especificar el medicamento">
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2">
                                            <label for="accidente">¿Haz tenido algún accidente grave?</label>
                                            <select name="accidente"  v-model="alu.integral.accidente_grave" id="accidente" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                                <option value="null" selected>Elija una Opción</option>
                                                <option value="1">Si</option>
                                                <option value="2" @click="alu.integral.relata_breve=null">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-full tw:px-2" id="relata" v-if="alu.integral.accidente_grave==1">
                                            <label for="relata">Relata brevemente</label>
                                            <input type="text"  v-model="alu.integral.relata_breve" name="relata" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Relata">
                                        </div>
                                    </div>
                                </div>
                                <div class="tw:w-full tw:pt-6 tw:px-2" v-if="llenofor==false">
                                    <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700 tw:text-center">
                                        Por favor, llena todos los campos requeridos para poder pasar al llenado de la siguiente área del expediente. Gracias.
                                    </div>
                                </div>
                                <div class="tw:w-full tw:pt-6 tw:px-2">
                                    <button class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:w-full tw:px-2 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" @click="siguiente('area')">Siguiente</button>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" v-bind:class="{show:actarea,active:actarea}" id="exp-area" role="tabpanel" aria-labelledby="exp-area-tab">
                            <div class="" >
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:pt-4 tw:pr-4 tw:pl-4">
                                    <div class="tw:w-full tw:content-center tw:px-2">
                                        <h4 class="tw:text-center tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-brand-200 tw:bg-brand-50 tw:text-brand-700 tw:pt-6"><b>Área Psicopedagógica</b></h4>
                                    </div>
                                </div>
                                <div class="tw:p-5 tw:sm:p-6">
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-3/12 tw:px-2">
                                            <label for="rendEsco">Rendimiento escolar *</label>
                                            <select name="rendimiento_escolar" v-model="alu.area.rendimiento_escolar" id="rendEsco" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option v-bind:value="esc.id_escala" v-for="esc in escala">@{{esc.desc_escala}}</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.area.rendimiento_escolar==null || alu.area.rendimiento_escolar=="null"'>Elija una opción</small>
                                        </div>
                                        <div class="tw:w-full tw:md:w-3/12 tw:px-2">
                                            <label for="dominio">Dominio del propio idioma</label>
                                            <select name="dominio" id="dominio" v-model="alu.area.dominio_idioma" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                                <option value="null" selected>Elija una opción</option>
                                                <option v-bind:value="esc.id_escala" v-for="esc in escala">@{{esc.desc_escala}}</option>
                                            </select>
                                        </div>
                                        <div class="tw:w-full tw:md:w-3/12 tw:px-2">
                                            <label for="otro">Otro idioma *</label>
                                            <select name="otro_idioma" id="otro" v-model="alu.area.otro_idioma" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option v-bind:value="esc.id_escala" v-for="esc in escala">@{{esc.desc_escala}}</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.area.otro_idioma==null || alu.area.otro_idioma=="null"'>Elija una opción</small>
                                        </div>
                                        <div class="tw:w-full tw:md:w-3/12 tw:px-2">
                                            <label for="conComp">Conocimentos en cómputo *</label>
                                            <select name="conocimiento_computo" id="conComp" v-model="alu.area.conocimiento_compu" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option v-bind:value="esc.id_escala" v-for="esc in escala">@{{esc.desc_escala}}</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.area.conocimiento_compu==null || alu.area.conocimiento_compu=="null"'>Elija una opción</small>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="aptitudes">Aptitudes especiales</label>
                                            <select name="aptitudes" id="aptitudes" v-model="alu.area.aptitud_especial" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                                <option value="null" selected>Elija una opción</option>
                                                <option v-bind:value="esc.id_escala" v-for="esc in escala">@{{esc.desc_escala}}</option>
                                            </select>
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="comprension">Comprensión y retención en clase *</label>
                                            <select name="comprension" id="comprension" v-model="alu.area.comprension" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option v-bind:value="esc.id_escala" v-for="esc in escala">@{{esc.desc_escala}}</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.area.comprension==null || alu.area.comprension=="null"'>Elija una opción</small>
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="preparacion">Preparación y presentación de exámenes *</label>
                                            <select name="preparacion" id="preparacion" v-model="alu.area.preparacion" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option v-bind:value="esc.id_escala"  v-for="esc in escala">@{{esc.desc_escala}}</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.area.preparacion==null || alu.area.preparacion=="null"'>Elija una opción</small>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-5/12 tw:px-2">
                                            <label for="estrategias">Aplicación de estrategias de aprendizaje</label>
                                            <select name="estrategias" id="estrategias" v-model="alu.area.estrategias_aprendizaje" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                                <option value="null" selected>Elija una opción</option>
                                                <option v-bind:value="esc.id_escala"  v-for="esc in escala">@{{esc.desc_escala}}</option>
                                            </select>
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="actEst">Organización en actividades de estudio</label>
                                            <select name="organizacion_actividades" v-model="alu.area.organizacion_actividades" id="actEst" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                                <option value="null" selected>Elija una opción</option>
                                                <option v-bind:value="esc.id_escala" v-for="esc in escala">@{{esc.desc_escala}}</option>
                                            </select>
                                        </div>
                                        <div class="tw:w-full tw:md:w-3/12 tw:px-2">
                                            <label for="concentracion">Concentración durante el estudio *</label>
                                            <select name="concentracion" id="concentracion" v-model="alu.area.concentracion" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option v-bind:value="esc.id_escala" v-for="esc in escala">@{{esc.desc_escala}}</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.area.concentracion==null || alu.area.concentracion=="null"'>Elija una opción</small>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-5/12 tw:px-2">
                                            <label for="solucion">Solución de problemas y aprendizaje de las matemáticas*</label>
                                            <select name="solucion" id="solucion" v-model="alu.area.solucion_problemas" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option v-bind:value="esc.id_escala" v-for="esc in escala">@{{esc.desc_escala}}</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.area.solucion_problemas==null || alu.area.solucion_problemas=="null"'>Elija una opción</small>
                                        </div>
                                        <div class="tw:w-full tw:md:w-4/12 tw:px-2">
                                            <label for="condiciones">Condiciones ambientales durante el estudio</label>
                                            <select name="condiciones" id="condiciones" v-model="alu.area.condiciones_ambientales" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                                <option value="null" selected>Elija una opción</option>
                                                <option v-bind:value="esc.id_escala"  v-for="esc in escala">@{{esc.desc_escala}}</option>
                                            </select>
                                        </div>
                                        <div class="tw:w-full tw:md:w-3/12 tw:px-2">
                                            <label for="equipo">Trabajo en equipo *</label>
                                            <select name="equipo" id="equipo" v-model="alu.area.trabajo_equipo" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option v-bind:value="esc.id_escala" v-for="esc in escala">@{{esc.desc_escala}}</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.area.trabajo_equipo==null || alu.area.trabajo_equipo=="null"'>Elija una opción</small>
                                        </div>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:md:w-5/12 tw:px-2">
                                            <label for="bibliografica">Búsqueda bibliografica e integración de información *</label>
                                            <select name="bibliografica" id="bibliografica" v-model="alu.area.busqueda_bibliografica" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="null" selected>Elija una opción</option>
                                                <option v-bind:value="esc.id_escala"  v-for="esc in escala">@{{esc.desc_escala}}</option>
                                            </select>
                                            <small class="tw:mt-1 tw:block tw:text-xs tw:text-red-600" v-if='alu.area.busqueda_bibliografica==null || alu.area.busqueda_bibliografica=="null"'>Elija una opción</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="tw:w-full tw:pt-6 tw:px-2" v-if="llenoare==false">
                                    <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700 tw:text-center">
                                        Por favor, llena todos los campos requeridos para poder finalizar el llenado del expediente. Gracias.
                                    </div>
                                </div>
                                <div class="tw:w-full tw:pt-6 tw:px-2" v-if="lleno==false">
                                    <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800 tw:text-center">
                                        Tus cambios se han guardado correctamente. Gracias.
                                    </div>
                                </div>
                                <div class="tw:w-full tw:pt-6 tw:px-2">
                                    <button class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:w-full tw:px-2 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" @click="Guardar()">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include("tutorias.alumnos.partial.modalNSE")
    </div>
    </x-panel.tarjeta>
    <script type="application/javascript">
        new Vue({
            el: "#expediente",
            created: function () {
                this.getDatos();
            },
            data: {
                rut: "/tutorias/getAlumno",
                ruta:'/tutorias/actualiza',
                datos:[],
                periodos:[],
                semestres:[],
                carreras:[],
                grupo:[],
                estadociv:[],
                bachiller:[],
                vive:[],
                union:[],
                turno:[],
                becas:[],
                tiempo:[],
                intelectual:[],
                parentesco:[],
                escala:[],
                bebidas:[],
                actacademico:false,
                disacademico:true,
                actgenerales:true,
                actfamiliares:false,
                disfamiliares:true,
                actestudio:false,
                disestudio:true,
                actintegral:false,
                disintegral:true,
                actarea:false,
                disarea:true,
                alu:{
                    generales:{
                        id_exp_general:null,
                        id_periodo:null,
                        nombre:null,
                        edad:null,
                        sexo:null,
                        fecha_nacimientos:null,
                        lugar_nacimientos:null,
                        id_semestre:null,
                        id_estado_civil:null,
                        no_hijos:null,
                        direccion:null,
                        correo:null,
                        tel_casa:null,
                        cel:null,
                        trabaja:null,
                        nivel_economico:null,
                        ocupacion:null,
                        horario:null,
                        no_cuenta:null,
                        beca:null,
                        estado:null,
                        turno:null,
                        id_expbeca:null,
                        id_grupo:null,
                        id_carrera:null,
                        poblacion:null,
                        ant_inst:null,
                        satisfaccion_c:null,
                        materias_repeticion:null,
                        tot_repe:null,
                        materias_especial:null,
                        tot_espe:null,
                        gen_espe:null,
                        id_alumno:null,
                        foto:null
                    },
                    academicos:{
                        id_exp_antecedentes_academicos:null,
                        id_bachillerato:null,
                        otros_estudios:null,
                        anos_curso_bachillerato:null,
                        ano_terminacion:null,
                        escuela_procedente:null,
                        promedio:null,
                        materias_reprobadas:null,
                        otra_carrera_ini:null,
                        institucion:null,
                        semestres_cursados:null,
                        interrupciones_estudios:null,
                        razones_interrupcion:null,
                        razon_descide_estudiar_tesvb:null,
                        sabedel_perfil_profesional:null,
                        otras_opciones_vocales:null,
                        cuales_otras_opciones_vocales:null,
                        tegusta_carrera_elegida:null,
                        porque_carrera_elegida:null,
                        suspension_estudios_bachillerato:null,
                        razones_suspension_estudios:null,
                        teestimula_familia:null,
                        id_alumno:null,
                    },
                    familiares:{
                        id_exp_datos_familiares:null,
                        nombre_padre:null,
                        edad_padre:null,
                        ocupacion_padre:null,
                        lugar_residencia_padre:null,
                        nombre_madre:null,
                        edad_madre:null,
                        ocupacion_madre:null,
                        lugar_residencia_madre:null,
                        no_hermanos:null,
                        lugar_ocupas:null,
                        id_opc_vives:null,
                        no_personas:null,
                        etnia_indigena:null,
                        cual_etnia:null,
                        hablas_lengua_indigena:null,
                        sostiene_economia_hogar:null,
                        id_familia_union:null,
                        nombre_tutor:null,
                        id_parentesco:null,
                        id_alumno:null
                        ,                    },
                    estudio:{
                        id_exp_habitos_estudio:null,
                        tiempo_empleado_estudiar:null,
                        id_opc_intelectual:null,
                        forma_estudio:null,
                        tiempo_libre:null,
                        asignatura_preferida:null,
                        porque_asignatura:null,
                        asignatura_dificil:null,
                        porque_asignatura_dificil:null,
                        opinion_tu_mismo_estudiante:null,
                        id_alumno:null
                        ,                    },
                    integral:{
                        id_exp_formacion_integral:null,
                        practica_deporte:null,
                        especifica_deporte:null,
                        practica_artistica:null,
                        especifica_artistica:null,
                        pasatiempo:null,
                        actividades_culturales:null,
                        cuales_act:null,
                        estado_salud:null,
                        enfermedad_cronica:null,
                        especifica_enf_cron:null,
                        enf_cron_padre:null,
                        especifica_enf_cron_padres:null,
                        operacion:null,
                        deque_operacion:null,
                        enfer_visual:null,
                        especifica_enf:null,
                        usas_lentes:null,
                        medicamento_controlado:null,
                        especifica_medicamento:null,
                        estatura:null,
                        peso:null,
                        accidente_grave:null,
                        relata_breve:null,
                        id_expbebidas:null,
                        id_alumno:null,
                    },
                    area:{
                        id_exp_area_psicopedagogica:null,
                        rendimiento_escolar:null,
                        dominio_idioma:null,
                        otro_idioma:null,
                        conocimiento_compu:null,
                        aptitud_especial:null,
                        comprension:null,
                        preparacion:null,
                        estrategias_aprendizaje:null,
                        organizacion_actividades:null,
                        concentracion:null,
                        solucion_problemas:null,
                        condiciones_ambientales:null,
                        busqueda_bibliografica:null,
                        trabajo_equipo:null,
                        id_alumno:null,
                    }
                },
                llenogen:true,
                llenofam:true,
                llenohab:true,
                llenoant:true,
                llenofor:true,
                llenoare:true,
                lleno:true,
                test:{
                    p1:null,
                    p2:null,
                    p3:null,
                    p4:null,
                    p5:null,
                    p6:null,
                    suma:null,
                    testlleno:true,
                },
                imagen:null,
                imagenMiniatura:null,
            },
            methods: {
                getDatos: function () {
                    axios.get(this.rut).then(response => {
                        this.alu.generales.id_exp_general=response.data.generales[0].id_exp_general;
                        this.alu.generales.id_alumno=response.data.datos[0].id_alumno;
                        this.alu.generales.nombre=response.data.datos[0].nombre +' '+response.data.datos[0].apaterno+' '+response.data.datos[0].amaterno;
                        this.alu.generales.no_cuenta=response.data.datos[0].cuenta;
                        this.alu.generales.id_periodo= {{ \Illuminate\Support\Facades\Session::get('periodo_actual')}};
                            this.alu.generales.sexo=response.data.datos[0].genero;
                        this.alu.generales.fecha_nacimientos=response.data.datos[0].fecha_nac;
                        this.alu.generales.edad=response.data.datos[0].edad;
                        this.alu.generales.correo=response.data.email;
                        this.alu.generales.tel_casa=response.data.datos[0].tel_fijo_al;
                        this.alu.generales.cel=response.data.datos[0].cel_al;
                        this.alu.generales.id_carrera=response.data.datos[0].id_carrera;
                        this.alu.generales.id_semestre=response.data.datos[0].id_semestre;
                        this.alu.generales.id_grupo=response.data.datos[0].grupo;
                        this.alu.academicos.id_exp_antecedentes_academicos=response.data.academicos[0].id_exp_antecedentes_academicos;
                        this.alu.academicos.id_alumno=response.data.datos[0].id_alumno;
                        this.alu.familiares.id_exp_datos_familiares=response.data.familiares[0].id_exp_datos_familiares;
                        this.alu.familiares.id_alumno=response.data.datos[0].id_alumno;
                        this.alu.estudio.id_exp_habitos_estudio=response.data.estudio[0].id_exp_habitos_estudio;
                        this.alu.estudio.id_alumno=response.data.datos[0].id_alumno;
                        this.alu.integral.id_exp_formacion_integral=response.data.integral[0].id_exp_formacion_integral;
                        this.alu.integral.id_alumno=response.data.datos[0].id_alumno;
                        this.alu.area.id_exp_area_psicopedagogica=response.data.area[0].id_exp_area_psicopedagogica;
                        this.alu.area.id_alumno=response.data.datos[0].id_alumno;
                        ///CATALOGOS
                        this.periodos=response.data.periodos;
                        this.semestres=response.data.semestres;
                        this.carreras=response.data.carreras;
                        this.grupo=response.data.grupos;
                        this.estadociv=response.data.estadocivil;
                        /*this.nivel=response.data.nivel;*/
                        this.bachiller=response.data.bachillerato;
                        this.vive=response.data.vive;
                        this.union=response.data.unionfam;
                        this.turno=response.data.turno;
                        this.tiempo=response.data.tiempoestudia;
                        this.intelectual=response.data.intelectual;
                        this.parentesco=response.data.parentesco;
                        this.escala=response.data.escala;
                        this.bebidas=response.data.bebidas;
                        this.becas=response.data.becas;
                    }).catch(error => {
                    });
                },
                borra_institucion:function(){
                    this.alu.academicos.institucion=null;
                    this.alu.academicos.semestres_cursados=null;
                },
                borra_trabaja:function(){
                    this.alu.generales.ocupacion=null;
                    this.alu.generales.horario=null;
                },
                borra_beca:function(){
                    this.alu.generales.id_expbeca=null
                },
                siguiente:function (cat) {
                    /*condiciones*/
                    switch ( cat) {
                        case 'academico':
                            if(this.alu.generales.estado!=null
                                && this.alu.generales.nivel_economico!=null
                                && this.alu.generales.materias_especial!=null
                                && this.alu.generales.materias_repeticion!=null
                                && this.alu.generales.direccion!=null
                                && this.alu.generales.id_periodo!=null
                                && this.alu.generales.no_hijos!=null
                                && this.alu.generales.id_grupo!=null
                                && this.alu.generales.sexo!=null
                                && this.alu.generales.id_estado_civil!=null
                                && this.alu.generales.trabaja!=null
                                && this.imagenMiniatura!=null)
                            {
                                if(this.alu.generales.turno==null)
                                {
                                    this.llenogen=false;
                                }
                                else if (this.alu.generales.beca==1 && this.alu.generales.id_expbeca!=null){
                                    this.actacademico=true;
                                    this.disacademico=false;
                                    this.actgenerales=false;
                                    this.llenogen=true;
                                }
                                else if (this.alu.generales.beca==1 && this.alu.generales.id_expbeca==null){
                                    this.llenogen=false;
                                }
                                else  if(this.alu.generales.beca==2 && this.alu.generales.id_expbeca==null)
                                {
                                    this.actacademico=true;
                                    this.disacademico=false;
                                    this.actgenerales=false;
                                    this.llenogen=true;
                                }
                            }
                            else
                            {
                                this.llenogen=false;
                            }
                            break;
                        case 'familiares':
                            if(this.alu.academicos.teestimula_familia!=null
                                && this.alu.academicos.tegusta_carrera_elegida!=null
                                && this.alu.academicos.otra_carrera_ini!=null)
                            {
                                this.actfamiliares=true;
                                this.disfamiliares=false;
                                this.actacademico=false;
                                this.llenoant=true;
                            }
                            else
                            {
                                this.llenoant=false;
                            }
                            break;
                        case 'estudio':
                            if(this.alu.familiares.nombre_padre!=null
                                && this.alu.familiares.nombre_madre!=null
                                && this.alu.familiares.lugar_residencia_madre!=null
                                && this.alu.familiares.lugar_residencia_padre!=null
                                && this.alu.familiares.etnia_indigena!=null
                                && this.alu.familiares.hablas_lengua_indigena!=null
                                && this.alu.familiares.id_opc_vives!=null
                                && this.alu.familiares.id_familia_union!=null
                                && this.alu.familiares.nombre_tutor!=null
                                && this.alu.familiares.id_parentesco!=null)
                            {
                                this.actfamiliares=false;
                                this.actestudio=true;
                                this.disestudio=false;
                                this.llenofam=true;
                            }
                            else
                            {
                                this.llenofam=false;
                            }
                            break;
                        case 'integral':
                            if(this.alu.estudio.forma_estudio!=null && this.alu.estudio.tiempo_empleado_estudiar!=null
                                && this.alu.estudio.id_opc_intelectual!=null)
                            {
                                this.actestudio=false;
                                this.actintegral=true;
                                this.disintegral=false;
                                this.llenohab=true;
                            }
                            else
                            {
                                this.llenohab=false;
                            }
                            break;
                        case 'area':
                            if(this.alu.integral.enfermedad_cronica!=null
                                && this.alu.integral.enf_cron_padre!=null
                                && this.alu.integral.operacion!=null
                                && this.alu.integral.enfer_visual!=null
                                && this.alu.integral.medicamento_controlado!=null
                                && this.alu.integral.practica_deporte!=null
                                && this.alu.integral.practica_artistica!=null
                                && this.alu.integral.actividades_culturales!=null
                                && this.alu.integral.usas_lentes!=null)
                            {
                                this.actintegral=false;
                                this.actarea=true;
                                this.disarea=false;
                                this.llenofor=true;
                            }
                            else
                            {
                                this.llenofor=false;
                            }
                            break;
                    }
                },
                categoria:function (cat) {
                    switch (cat) {
                        case 'generales':
                            this.actgenerales=true;
                            this.actacademico=false;
                            this.actfamiliares=false;
                            this.actestudio=false;
                            this.actintegral=false;
                            this.actarea=false;
                            break;
                        case 'academico':
                            this.actacademico=true;
                            this.actfamiliares=false;
                            this.actgenerales=false;
                            this.actestudio=false;
                            this.actintegral=false;
                            this.actarea=false;
                            break;
                        case 'familiares':
                            this.actfamiliares=true;
                            this.actacademico=false;
                            this.actgenerales=false;
                            this.actestudio=false;
                            this.actintegral=false;
                            this.actarea=false;
                            break;
                        case 'estudio':
                            this.actestudio=true;
                            this.actacademico=false;
                            this.actfamiliares=false;
                            this.actgenerales=false;
                            this.actintegral=false;
                            this.actarea=false;
                            break;
                        case 'integral':
                            this.actintegral=true;
                            this.actacademico=false;
                            this.actfamiliares=false;
                            this.actgenerales=false;
                            this.actestudio=false;
                            this.actarea=false;
                            break;
                        case 'area':
                            this.actarea=true;
                            this.actacademico=false;
                            this.actfamiliares=false;
                            this.actgenerales=false;
                            this.actintegral=false;
                            this.actestudio=false;
                            break;
                    }
                },
                Guardar:function () {
                    if (this.alu.area.trabajo_equipo!=null
                        && this.alu.area.rendimiento_escolar!=null
                        && this.alu.area.conocimiento_compu!=null
                        && this.alu.area.comprension!=null
                        && this.alu.area.concentracion!=null
                        && this.alu.area.otro_idioma!=null
                        && this.alu.area.solucion_problemas!=null
                        && this.alu.area.preparacion!=null
                        && this.alu.area.busqueda_bibliografica!=null)
                    {
                        this.lleno=true;
                        let formData = new FormData();
                        formData.append('imagen', this.imagen);
                        formData.append('nombre',this.alu.generales.no_cuenta);
                        formData.append('ext',this.alu.generales.foto);
                        //console.log(formData);
                        axios.post('/tutorias/imagen',formData).then(response=>{
                            //window.location='inicioalu';
                        }).catch(error=>{  });
                        axios.post(this.ruta,{alu:this.alu}).then(response=>{
                            window.location='/tutorias/inicioalu';
                        }).catch(error=>{  });
                    }
                    else
                    {
                        this.llenoare=false;
                    }
                },
                CalculaNivel:function () {
                    if(this.test.p1!=null &&
                        this.test.p2!=null &&
                        this.test.p3!=null &&
                        this.test.p4!=null &&
                        this.test.p5!=null &&
                        this.test.p6!=null)
                    {
                        this.test.testlleno=true;
                        this.test.suma=(this.test.p1)+(this.test.p2)+(this.test.p3)+(this.test.p4)+(this.test.p5)+(this.test.p6);
                        if(this.test.suma>204 && this.test.suma<=300)
                        {
                            this.alu.generales.nivel_economico="A/B";
                        }
                        else if(this.test.suma>=166 && this.test.suma<=204)
                        {
                            this.alu.generales.nivel_economico="C+";
                        }
                        else if(this.test.suma>=136 && this.test.suma<=165)
                        {
                            this.alu.generales.nivel_economico="C";
                        }
                        else if(this.test.suma>=112 && this.test.suma<=135)
                        {
                            this.alu.generales.nivel_economico="C-";
                        }
                        else if(this.test.suma>=90 && this.test.suma<=111)
                        {
                            this.alu.generales.nivel_economico="D+";
                        }
                        else if(this.test.suma>=48 && this.test.suma<=89)
                        {
                            this.alu.generales.nivel_economico="D";
                        }
                        else if(this.test.suma>=0 && this.test.suma<=47)
                        {
                            this.alu.generales.nivel_economico="E";
                        }
                        $('#modalNSE').modal('hide');
                    }
                    else
                    {
                        this.test.testlleno=false;
                    }
                },
                ObtenerImagen:function (img) {
                    let file=img.target.files[0];
                    this.imagen=file;
                    this.alu.generales.foto=this.imagen.type;
                    this.CargarImagen(file);
                },
                CargarImagen:function (file) {
                    let reader= new FileReader();
                    reader.onload=(e)=>{
                        this.imagenMiniatura= e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            }
        });
    </script>

@endsection
