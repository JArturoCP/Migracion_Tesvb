@extends('layouts.panel')
@section('title', 'Datos del alumno')
@include('partials.panel.recursos_app', ['validacion' => true, 'datatables' => true])
@include('partials.panel.formularios')
@section('content')
    <main>
        <x-panel.encabezado titulo="Datos del alumno" />
        @if ($errors->any())
            <x-panel.alerta tipo="error" class="tw:mb-4">
                <ul class="tw:list-disc tw:pl-5">
                    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </x-panel.alerta>
        @endif

        @php
            $pasosAlumno = [
                'cero' => ['Escuela', 'Escuela de procedencia', 'Revisa la información de tu bachillerato o preparatoria.'],
                'uno' => ['Personales', 'Datos personales', 'Actualiza tus datos de identificación, contacto e inscripción.'],
                'dos' => ['Domicilio', 'Domicilio del alumno', 'Indica dónde vives y agrega las referencias de tu domicilio.'],
                'tres' => ['Tutor', 'Datos del tutor', 'Registra la información y los medios de contacto de tu tutor.'],
                'cuatro' => ['Domicilio del tutor', 'Domicilio del tutor', 'Completa la dirección de tu tutor antes de guardar.'],
            ];
            $estiloPasoAlumno = 'tab-pane tw:space-y-5 tw:motion-safe:animate-in tw:motion-safe:fade-in-0 tw:motion-safe:slide-in-from-bottom-1 tw:motion-safe:duration-200';
        @endphp

        <div id="stepper_alumno" class="tw:space-y-5">
            <x-panel.tarjeta>
                <div class="tw:mb-4 tw:flex tw:items-center tw:justify-between tw:gap-3 tw:text-sm">
                    <span class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">Secciones del formulario</span>
                    <span data-alumno-posicion class="tw:shrink-0 tw:font-medium tw:text-brand-600 tw:dark:text-brand-400" aria-live="polite">Paso 1 de {{ count($pasosAlumno) }}</span>
                </div>
                <div data-alumno-progreso role="progressbar" aria-label="Avance por secciones" aria-valuemin="0" aria-valuemax="{{ count($pasosAlumno) }}" aria-valuenow="1" aria-valuetext="Paso 1 de {{ count($pasosAlumno) }}: Escuela"
                    class="tw:mb-4 tw:h-2 tw:overflow-hidden tw:rounded-full tw:bg-gray-100 tw:dark:bg-gray-800">
                    <div data-alumno-barra data-paso="1" class="tw:h-full tw:rounded-full tw:bg-brand-500 tw:motion-safe:transition-[width] tw:motion-safe:duration-300 tw:data-[paso=1]:w-1/5 tw:data-[paso=2]:w-2/5 tw:data-[paso=3]:w-3/5 tw:data-[paso=4]:w-4/5 tw:data-[paso=5]:w-full"></div>
                </div>
                <ol role="tablist" aria-label="Pasos de Datos del alumno" class="tw:grid tw:grid-cols-5 tw:gap-1 tw:sm:gap-2">
                    @foreach ($pasosAlumno as $idPaso => [$nombrePaso, $tituloPaso])
                        <li role="presentation" @class(['active' => $loop->first])>
                            <a id="paso-alumno-{{ $idPaso }}" href="#{{ $idPaso }}" role="tab" data-toggle="tab"
                                aria-controls="{{ $idPaso }}" aria-describedby="estado-paso-{{ $idPaso }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}" tabindex="{{ $loop->first ? 0 : -1 }}"
                                data-estado="{{ $loop->first ? 'completado' : 'pendiente' }}"
                                class="tw:group tw:flex tw:min-h-16 tw:min-w-0 tw:flex-col tw:items-center tw:justify-start tw:gap-1 tw:rounded-lg tw:px-0.5 tw:py-2 tw:text-center tw:text-[0.65rem] tw:leading-tight tw:text-gray-600 tw:hover:bg-gray-50 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:aria-selected:bg-brand-50 tw:aria-selected:font-semibold tw:aria-selected:text-brand-700 tw:sm:min-h-12 tw:sm:flex-row tw:sm:justify-center tw:sm:gap-2 tw:sm:px-2 tw:sm:text-sm tw:dark:text-gray-300 tw:dark:hover:bg-white/5 tw:dark:aria-selected:bg-brand-500/10 tw:dark:aria-selected:text-brand-300">
                                <span aria-hidden="true" class="tw:inline-flex tw:size-6 tw:shrink-0 tw:items-center tw:justify-center tw:rounded-full tw:bg-gray-100 tw:text-xs tw:font-semibold tw:group-aria-selected:bg-brand-500 tw:group-aria-selected:text-white tw:dark:bg-gray-800">{{ $loop->iteration }}</span>
                                <span class="tw:flex tw:min-w-0 tw:items-center tw:justify-center tw:gap-1">
                                    <span data-alumno-etiqueta class="tw:wrap-break-word">{{ $nombrePaso }}</span>
                                    <svg aria-hidden="true" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="tw:hidden tw:size-3.5 tw:shrink-0 tw:text-amber-700 tw:group-data-[estado=error]:inline-block tw:dark:text-amber-400">
                                        <path d="M8.8 3.7 2.2 15.2a1.4 1.4 0 0 0 1.2 2.1h13.2a1.4 1.4 0 0 0 1.2-2.1L11.2 3.7a1.4 1.4 0 0 0-2.4 0Z"/><path d="M10 7.5v3.6m0 2.9h.01"/>
                                    </svg>
                                    <svg aria-hidden="true" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="tw:hidden tw:size-3.5 tw:shrink-0 tw:text-green-700 tw:group-data-[estado=completado]:inline-block tw:dark:text-green-400">
                                        <path d="m4.5 10.5 3.5 3.5 7.5-8"/>
                                    </svg>
                                </span>
                                <span id="estado-paso-{{ $idPaso }}" data-alumno-estado class="tw:sr-only">{{ $loop->first ? 'Completado' : 'Pendiente' }}</span>
                            </a>
                        </li>
                    @endforeach
                </ol>
            </x-panel.tarjeta>

            <form method="POST" action="{{ url('/datos_alumno') }}" id="formgeneral" data-panel-seguimiento="alumno"
                class="tw:[&_[aria-invalid=true]]:border-amber-500"
                data-alumno-errores="{{ json_encode($errors->getBag('default')->messages()) }}">
                @csrf
                <x-panel.tarjeta>
                    <div class="tab-content">
                        <section class="{{ $estiloPasoAlumno }} active" id="cero" role="tabpanel" aria-labelledby="paso-alumno-cero">
                            @include('evaluacion_docente.Alumnos.encabezado_paso', ['paso' => $pasosAlumno['cero']])
                            <div class="tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800">
                                <div class="tw:flex tw:flex-wrap tw:items-start tw:justify-between tw:gap-3 tw:border-b tw:border-gray-100 tw:p-4 tw:dark:border-gray-800">
                                    <div class="tw:min-w-0">
                                        <p class="tw:text-xs tw:font-medium tw:text-gray-500 tw:dark:text-gray-400">Plantel registrado</p>
                                        <p data-escuela-campo="nombre_escuela" class="tw:mt-1 tw:wrap-break-word tw:font-semibold tw:text-gray-900 tw:dark:text-white">{{ $institucion->nombre_escuela }}</p>
                                    </div>
                                    <x-panel.boton id="abrir_escuela_cct" variante="contorno-primario" data-toggle="modal" data-target="#editar_escuela_cct" aria-haspopup="dialog">
                                        Modificar escuela
                                    </x-panel.boton>
                                </div>
                                <dl class="tw:grid tw:grid-cols-1 tw:gap-x-6 tw:gap-y-4 tw:p-4 tw:text-sm tw:sm:grid-cols-2 tw:lg:grid-cols-3">
                                    @foreach (['cct' => 'CCT', 'turno' => 'Turno', 'servicio' => 'Servicio', 'domicilio' => 'Domicilio', 'municipio' => 'Municipio', 'localidad' => 'Localidad'] as $campo => $etiqueta)
                                        <div class="tw:min-w-0">
                                            <dt class="tw:text-gray-500 tw:dark:text-gray-400">{{ $etiqueta }}</dt>
                                            <dd data-escuela-campo="{{ $campo }}" class="tw:mt-1 tw:wrap-break-word tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{ $institucion->{$campo} }}</dd>
                                        </div>
                                    @endforeach
                                </dl>
                            </div>
                            <p id="resultado_escuela_cct" role="status" class="tw:empty:hidden tw:text-sm tw:text-green-700 tw:dark:text-green-400"></p>
                        </section>
                    <section class="{{ $estiloPasoAlumno }}" id="uno" role="tabpanel" aria-labelledby="paso-alumno-uno">
                            @include('evaluacion_docente.Alumnos.encabezado_paso', ['paso' => $pasosAlumno['uno']])
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4">
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-2/12 tw:px-2">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">No. de Cuenta<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                                <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" name="id" value="{{$datos->id_alumno}}" style="display:none;">
                                <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" name="id_tutor" value="{{$datos_t->id_tutor}}" style="display:none;">
                                <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" name="existe" value="{{$existe}}" style="display:none;">
                                <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" name="cuentao" value="{{$datos->cuenta}}" style="display:none;">
                                @if($dat ==0)
                                    <input type="text" class="@error('cuenta') tw:ring-1 tw:ring-red-500 @enderror tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="Ejem: 201207017" name="cuenta" id="cuenta"
                                           value="{{$datos->cuenta}}" >
                                @else
                                    <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  readonly="readonly" name="cuenta" id="cuenta"
                                           value="{{$datos->cuenta}}" >
                                @endif
                                @if($errors->has('cuenta'))
                                    <span class="tw:text-sm tw:text-red-600 tw:dark:text-red-400">{{$errors->first('cuenta')}}</span>

                                @else
                                @endif
                            </div>
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Nombre(s)<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                                <input type="text" class="@error('nomalu') tw:ring-1 tw:ring-red-500 @enderror tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" onkeyup="javascript:this.value=this.value.toUpperCase();" name="nomalu" id="nomalu" value="{{$datos->nombre}}" >
                                @if($errors->has('nomalu'))
                                    <span class="tw:text-sm tw:text-red-600 tw:dark:text-red-400">{{$errors->first('nomalu')}}</span>


                                @else
                                @endif
                            </div>
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Apellido Paterno<a class="tw:text-red-600 tw:dark:text-red-400">*</a></h4>
                                <input type="text" class="@error('appalu') tw:ring-1 tw:ring-red-500 @enderror tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" name="appalu" id="appalu" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$datos->apaterno}}">
                                @if($errors->has('appalu'))
                                    <span class="tw:text-sm tw:text-red-600 tw:dark:text-red-400">{{$errors->first('appalu')}} </span>


                                @else
                                @endif

                            </div>

                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Apellido Materno<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                                <input type="text" class="@error('apmalu') tw:ring-1 tw:ring-red-500 @enderror tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" onkeyup="javascript:this.value=this.value.toUpperCase();" name="apmalu" id="apmalu" value="{{$datos->amaterno}}">
                                @if($errors->has('apmalu'))
                                    <span class="tw:text-sm tw:text-red-600 tw:dark:text-red-400">{{$errors->first('appalu')}} </span>

                                @endif
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4">
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-2/12 tw:px-2">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Fecha De Nacimiento<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                                <input type="date" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="fecha_nac" id="fecha_nac" value="{{ str_contains((string) old('fecha_nac', $datos->fecha_nac), '/') ? implode('-', array_reverse(explode('/', old('fecha_nac', $datos->fecha_nac)))) : old('fecha_nac', $datos->fecha_nac) }}">
                            </div>
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-1/12 tw:px-2" id="fecha_nacimiento">
                                @if($ed == 0)
                                    <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Edad<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                                <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" name="edadalu" value="{{$datos->edad}}" >
                                @else
                                    <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Edad<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                                    <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" name="edadalu" value="{{$edad}}" readonly="readonly">
                                @endif
                            </div>
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">

                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Genero<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  name="generoalu" value="{{$datos->genero}}">
                                        @if($datos->genero == null)
                                            <option disabled selected hidden>Selecciona una opción</option>
                                            <option  value="F">FEMENINO</option>
                                            <option  value="M">MASCULINO</option>
                                        @else
                                        @if($genero=="M")
                                            <option value="F" selected="selected">FEMENINO</option>
                                        @else
                                            <option  value="M" selected="selected">MASCULINO</option>
                                        @endif
                                        @endif
                                </select>
                            </div>
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Curp<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                                <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="" name="curpalu" oninput="validarInput(this)" value="{{$datos->curp_al}}">
                                <p id="resultado" aria-live="polite" class="tw:text-sm tw:font-medium tw:text-red-700 tw:dark:text-red-400 tw:data-[valido=true]:text-green-700 tw:dark:data-[valido=true]:text-green-400"></p>
                            </div>
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Nacionalidad<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" name="nacioalu" >
                                    @if($existe==0)
                                        <option disabled selected hidden>Selecciona una opción</option>
                                        <option  value="MEXICANA">MEXICANA</option>
                                        <option  value="EXTRANJERA">EXTRANJERA</option>
                                    @else
                                        @if($datos->nacionalidad == null)
                                            <option disabled selected hidden>Selecciona una opción</option>
                                            <option  value="MEXICANA">MEXICANA</option>
                                            <option  value="EXTRANJERA">EXTRANJERA</option>

                                        @elseif($datos->nacionalidad=="MEXICANA"||$datos->nacionalidad=="")
                                            <option value="MEXICANA" selected="selected">MEXICANA</option>
                                            <option  value="EXTRANJERA">EXTRANJERA</option>
                                        @else
                                            <option value="MEXICANA" >MEXICANA</option>
                                            <option  value="EXTRANJERA" selected="selected">EXTRANJERA</option>
                                        @endif

                                    @endif
                                </select>
                            </div>

                        </div>
                        <h3 class="tw:border-t tw:border-gray-100 tw:pt-4 tw:text-sm tw:font-semibold tw:text-gray-900 tw:dark:border-gray-800 tw:dark:text-white/90">Contacto del alumno</h3>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4">
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Estado Civil<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" name="estadoalu" >
                                    @if($existe==0)
                                        <option disabled selected hidden>Selecciona una opción</option>
                                        <option  value="SOLTERO">SOLTERO</option>
                                        <option  value="CASADO">CASADO</option>
                                        <option  value="DIVORCIADO">DIVORCIADO</option>
                                        <option  value="UNION LIBRE">UNION LIBRE</option>
                                        <option  value="VIUDO">VIUDO</option>
                                    @else
                                        @if($datos->edo_civil == null)
                                            <option disabled selected hidden>Selecciona una opción</option>
                                            <option  value="SOLTERO">SOLTERO</option>
                                            <option  value="CASADO">CASADO</option>
                                            <option  value="DIVORCIADO">DIVORCIADO</option>
                                            <option  value="UNION LIBRE">UNION LIBRE</option>
                                            <option  value="VIUDO">VIUDO</option>

                                        @elseif($datos->edo_civil=="SOLTERO")
                                            <option  value="SOLTERO" selected="selected">SOLTERO</option>
                                            <option  value="CASADO">CASADO</option>
                                            <option  value="DIVORCIADO">DIVORCIADO</option>
                                            <option  value="UNION LIBRE">UNION LIBRE</option>
                                            <option  value="VIUDO">VIUDO</option>
                                        @endif
                                        @if($datos->edo_civil=="CASADO")
                                            <option  value="SOLTERO" >SOLTERO</option>
                                            <option  value="CASADO" selected="selected">CASADO</option>
                                            <option  value="DIVORCIADO">DIVORCIADO</option>
                                            <option  value="UNION LIBRE">UNION LIBRE</option>
                                            <option  value="VIUDO">VIUDO</option>
                                        @endif
                                        @if($datos->edo_civil=="DIVORCIADO")
                                            <option  value="SOLTERO" >SOLTERO</option>
                                            <option  value="CASADO" >CASADO</option>
                                            <option  value="DIVORCIADO" selected="selected">DIVORCIADO</option>
                                            <option  value="UNION LIBRE">UNION LIBRE</option>
                                            <option  value="VIUDO">VIUDO</option>
                                        @endif
                                        @if($datos->edo_civil=="UNION LIBRE")
                                            <option  value="SOLTERO" >SOLTERO</option>
                                            <option  value="CASADO" >CASADO</option>
                                            <option  value="DIVORCIADO" >DIVORCIADO</option>
                                            <option  value="UNION LIBRE" selected="selected">UNION LIBRE</option>
                                            <option  value="VIUDO">VIUDO</option>
                                        @endif
                                        @if($datos->edo_civil=="VIUDO")
                                            <option  value="SOLTERO" >SOLTERO</option>
                                            <option  value="CASADO" >CASADO</option>
                                            <option  value="DIVORCIADO" >DIVORCIADO</option>
                                            <option  value="UNION LIBRE" >UNION LIBRE</option>
                                            <option  value="VIUDO" selected="selected">VIUDO</option>
                                        @endif
                                    @endif
                                </select>

                            </div>
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Correo<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                                <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="Email" readonly="readonly" name="correoalu" value="{{$datos->correo_al}}">
                                <span id="emailOK"></span>
                            </div>

                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">

                                <label for="exampleInputEmail1">TwitTer<b class="tw:sr-only">*</b></label>
                                <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="twiteralu" placeholder="" value="{{$datos->twiter_al}}">
                            </div>

                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                <label for="exampleInputEmail1">Facebook<b class="tw:sr-only">*</b></label>
                                <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="facealu" placeholder="" value="{{$datos->facebook_al}}">
                            </div>

                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4">
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Celular<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                                <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="celalu" placeholder="Ejem: 7221232323"
                                       onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
                                       maxlength="10" value="{{$datos->cel_al}}">
                            </div>
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                <label>Tel. Fijo<b class="tw:sr-only">*</b></label>
                                <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="telalu" placeholder=""
                                       onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
                                       maxlength="10" value="{{$datos->tel_fijo_al}}">

                            </div>

                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Entidad de Nacimiento<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="entidadalu" name="entidadalu" >
                                    @if($existe==0)
                                        <option disabled selected hidden>Selecciona una opción</option>
                                        @foreach($entidadnac as $entidadnac)
                                            <option value="{{$entidadnac->id_estado}}" data-esta="{{$entidadnac->nombre_estado}}">{{$entidadnac->nombre_estado}}</option>
                                        @endforeach

                                    @else
                                        <option disabled selected hidden>Selecciona una opción</option>
                                        @foreach($entidadnac as $entidadnac)
                                            @if($entidadnac->id_estado == $datos->entidad_nac_al)
                                                <option value="{{$entidadnac->id_estado}}" data-esta="{{$entidadnac->nombre_estado}}" selected="selected">{{$entidadnac->nombre_estado}}</option>
                                            @else
                                                <option value="{{$entidadnac->id_estado}}" data-esta="{{$entidadnac->nombre_estado}}" >{{$entidadnac->nombre_estado}}</option>

                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        {{--
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4">
                            <div class="tw:w-full tw:lg:w-10/12 tw:px-2" >
                                <h3 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200"><b>Escuela de procedencia</b><b class="tw:text-red-600 tw:dark:text-red-400"></b></h3>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="selecciona una Opcion" id="escuela" name="escuela" >
                                    <option disabled selected hidden>Selecciona una opción</option>
                                    @foreach($escuelas as $escuela)
                                        @if($datos->id_escuela_procedencia == $escuela->id_escuela_procedencia)
                                            <option value="{{$escuela->id_escuela_procedencia}}"  selected="selected" data-toggle="tooltip" data-placement="top" title="DE {{  $escuela->municipio}},{{  $escuela->estado}}">{{$escuela->nombre_escuela}}</option>
                                        @else
                                            <option value="{{$escuela->id_escuela_procedencia}}" data-toggle="tooltip" data-placement="top" title="DE {{ $escuela->municipio }},{{  $escuela->estado}}" >{{$escuela->nombre_escuela}} <b>UBICADA: {{ $escuela->municipio }},{{  $escuela->estado}}</b></option>

                                        @endif
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        --}}

                        <h3 class="tw:border-t tw:border-gray-100 tw:pt-4 tw:text-sm tw:font-semibold tw:text-gray-900 tw:dark:border-gray-800 tw:dark:text-white/90">Información académica</h3>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4">
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-4/12 tw:px-2">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Carrera<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="carreras" value="{{$datos->id_carrera}}">
                                    @if($existe==0)

                                        <option  disabled selected hidden>Selecciona una carrera</option>
                                        @foreach($carreras as $carreras)
                                            <option value="{{$carreras->id_carrera}}">{{$carreras->nombre}}</option>
                                        @endforeach
                                    @else

                                        <option  disabled selected hidden>Selecciona una carrera</option>
                                        @foreach($carreras as $carreras)
                                            @if($carreras->id_carrera == $datos->id_carrera)
                                                <option value="{{$carreras->id_carrera}}" selected="selected">{{$carreras->nombre}}</option>

                                            @else
                                                  <option value="{{$carreras->id_carrera}}" >{{$carreras->nombre}}</option>
                                            @endif
                                        @endforeach

                                    @endif
                                </select>

                            </div>
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Semestre<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" name="semestre" value="{{$datos->id_semestre}}">
                                    @if($existe==0)
                                        <option disabled selected hidden>Selecciona semestre</option>
                                        @foreach($semestres as $semestres)
                                            <option value="{{$semestres->id_semestre}}">{{$semestres->descripcion}}</option>
                                        @endforeach

                                    @else
                                        <option disabled selected hidden>Selecciona semestre</option>
                                        @foreach($semestres as $semestres)
                                            @if($semestres->id_semestre == $sem)
                                                <option value="{{$semestres->id_semestre}}" selected="selected">{{$semestres->descripcion}}</option>

                                            @else

                                                <option value="{{$semestres->id_semestre}}" >{{$semestres->descripcion}}</option>
                                            @endif
                                        @endforeach


                                    @endif
                                </select>

                            </div>

                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-2/12 tw:px-2">

                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Grupo<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" name="grupoalu" id="grupoalu">

                                    @if($existe==0)

                                        <option disabled selected hidden>Selecciona grupo</option>
                                        @foreach($grados as $grado)
                                            <option value="{{$grado->id_grado}}"  >{{$grado->des}}</option>
                                        @endforeach

                                    @else

                                        <option disabled selected hidden>Selecciona grupo</option>
                                        @foreach($grados as $grado)
                                            @if($grado->id_grado == $datos->grupo )
                                                <option value="{{$grado->id_grado}}"  selected="selected">{{$grado->des}}</option>
                                            @else
                                                <option value="{{$grado->id_grado}}"  >{{$grado->des}}</option>

                                            @endif
                                        @endforeach


                                    @endif
                                </select>
                            </div>
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-2/12 tw:px-2">


                            </div>
                        </div>
                        <h3 class="tw:border-t tw:border-gray-100 tw:pt-4 tw:text-sm tw:font-semibold tw:text-gray-900 tw:dark:border-gray-800 tw:dark:text-white/90">Salud y apoyos</h3>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4">
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">

                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Tienes alguna discapacidad<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="discapacidad" name="discapacidad" >
                                    @if($existe==0)

                                        <option disabled selected hidden>Selecciona una opción</option>
                                        @foreach($respuesta as $respuestas)
                                            <option value="{{$respuestas->id_respuesta}}"  >{{$respuestas->respuesta}}</option>
                                        @endforeach

                                    @else

                                        <option disabled selected hidden>Selecciona una opción</option>
                                        @foreach($respuesta as $respuestas)
                                            @if($respuestas->id_respuesta == $datos->discapacidad)
                                                <option value="{{$respuestas->id_respuesta}}"  selected="selected">{{$respuestas->respuesta}}</option>
                                            @else
                                                <option value="{{$respuestas->id_respuesta}}"  >{{$respuestas->respuesta}}</option>

                                            @endif
                                        @endforeach


                                    @endif
                                </select>

                            </div>
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2" id="descripcion_discapacidad">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Cual es?<b class="tw:text-red-600 tw:dark:text-red-400"></b></h4>
                                <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="descripcion_discapacidad" name="descripcion_discapacidad" placeholder="" value="{{$datos->descripcion_discapacidad}}" re>
                            </div>
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Hablas alguna lengua indigena<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="lengua" name="lengua" >
                                    @if($existe==0)

                                        <option disabled selected hidden>Selecciona una opción</option>
                                        @foreach($respuesta as $respuestas)
                                            <option value="{{$respuestas->id_respuesta}}"  >{{$respuestas->respuesta}}</option>
                                        @endforeach

                                    @else

                                        <option disabled selected hidden>Selecciona una opción</option>
                                        @foreach($respuesta as $respuestas)
                                            @if($respuestas->id_respuesta == $datos->lengua)
                                                <option value="{{$respuestas->id_respuesta}}"  selected="selected">{{$respuestas->respuesta}}</option>
                                            @else
                                                <option value="{{$respuestas->id_respuesta}}"  >{{$respuestas->respuesta}}</option>

                                            @endif
                                        @endforeach


                                    @endif
                                </select>

                            </div>
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2" id="descripcion_lengua">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Cual es?<b class="tw:text-red-600 tw:dark:text-red-400"></b></h4>
                                <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="descripcion_lengua" name="descripcion_lengua" placeholder="" value="{{$datos->descripcion_lengua }}">
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4">
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                <h5 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">En que  Institucion de Salud Pública<br> estas afiliado?<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h5>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="seguro" name="seguro" >
                                    @if($existe==0)

                                        <option disabled selected hidden>Selecciona una opción</option>
                                        @foreach($seguro as $seguro)
                                            <option value="{{$seguro->id_seguro_social}}"  >{{$seguro->descripcion}}</option>
                                        @endforeach

                                    @else

                                        <option disabled selected hidden>Selecciona una opción</option>
                                        @foreach($seguro as $seguro)
                                            @if($seguro->id_seguro_social == $datos->id_seguro_social)
                                                <option value="{{$seguro->id_seguro_social}}"  selected="selected">{{$seguro->descripcion}}</option>
                                            @else
                                                <option value="{{$seguro->id_seguro_social}}"  >{{$seguro->descripcion}}</option>

                                            @endif
                                        @endforeach


                                    @endif
                                </select>
                            </div>

                                 @if($datos->id_seguro_social == 1 || $datos->id_seguro_social == 2 || $datos->id_seguro_social == 3 || $datos->id_seguro_social == 4 || $datos->id_seguro_social == 5)
                                <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                    <div id="seguro_s" >

                                        <h5 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200" >Numero de Seguro social<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h5>
                                        <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="seguro_social" id="seguro_social"    value="{{$datos->numero_seguro_social }}">
                                    </div>
                                </div>
                                     @else
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                <div id="seguro_s" style="display: none;">

                                    <h5 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200" >Numero de Seguro social<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h5>
                                <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="seguro_social" id="seguro_social"    value="{{$datos->numero_seguro_social }}">
                                </div>
                            </div>
                            @endif

                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">

                                <?php $num = number_format($datos->promedio_preparatoria, 1, '.', ''); ?>
                               <h5 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200" >Promedio de la Preparatoria<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h5>
                                @if($num==0.0)

                                <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="Ejemplo: 8.6" name="promedio_preparatoria"
                                       value="">
                                    @else
                                    <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="Ejemplo: 8.6" name="promedio_preparatoria"
                                           value="{{$num}}">
                                @endif

                            </div>

                           <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                <h5 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">
                                    Tipo de Admisión <b class="tw:text-red-600 tw:dark:text-red-400">*</b>
                                </h5>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="tipo_admision">
                                    <option disabled hidden {{ empty($datos->tipo_admision) ? 'selected' : '' }}>
                                        Selecciona una opción
                                    </option>
                                    <option value="EXAMEN" {{ $datos->tipo_admision == 'EXAMEN' ? 'selected' : '' }}>
                                        Examen de Admisión
                                    </option>
                                    <option value="PROMEDIO" {{ $datos->tipo_admision == 'PROMEDIO' ? 'selected' : '' }}>
                                        Promedio
                                    </option>
                                    <option value="UAMEX" {{ $datos->tipo_admision == 'UAMEX' ? 'selected' : '' }}>
                                        Ingreso UAMEX
                                    </option>
                                </select>
                            </div>
                        </div>



                    </section>


                    <section class="{{ $estiloPasoAlumno }}" id="dos" role="tabpanel" aria-labelledby="paso-alumno-dos">
                            @include('evaluacion_docente.Alumnos.encabezado_paso', ['paso' => $pasosAlumno['dos']])
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4">
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Estado<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="estados_alu" name="estados_alu" >
                                    @if($existe==0)

                                        <option disabled selected hidden>Selecciona una opción</option>
                                        @foreach($estados_alu as $estados_alu)
                                            <option value="{{$estados_alu->id_estado}}" data-esta="{{$estados_alu->nombre_estado}}">{{$estados_alu->nombre_estado}}</option>
                                        @endforeach

                                    @else

                                        <option disabled selected hidden>Selecciona una opción</option>
                                        @foreach($estados_alu as $estados_alu)
                                            @if($estados_alu->id_estado == $datos->estado)
                                                <option value="{{$estados_alu->id_estado}}" data-esta="{{$estados_alu->nombre_estado}}" selected="selected">{{$estados_alu->nombre_estado}}</option>
                                            @else
                                                <option value="{{$estados_alu->id_estado}}" data-esta="{{$estados_alu->nombre_estado}}" >{{$estados_alu->nombre_estado}}</option>

                                            @endif
                                        @endforeach


                                    @endif
                                </select>

                            </div>
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Municipio<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="municipios_alu" name="municipios_alu" value="">

                                </select>
                            </div>
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Calle<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" name="calle_alu" id="calle_alu" value="{{$datos->calle_al}}">
                            </div>
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-2/12 tw:px-2">
                            <label for="exampleInputEmail1">No. Exterior<b class="tw:sr-only">*</b></label>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" name="n_exterior_alu" id="n_exterior_alu" value="{{$datos->n_ext_al}}">
                            </div>

                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4">
                                <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-2/12 tw:px-2">
                            <label for="exampleInputEmail1">No. Interior<b class="tw:sr-only">*</b></label>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" name="n_interior_alu" id="n_interior_alu" value="{{$datos->n_int_al}}">
                                </div>
                        <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                            <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Entre Calle<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" name="entre_calle_alu" id="entre_calle_alu" value="{{$datos->entre_calle}}">
                        </div>
                        <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                            <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Y Calle<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="" name="y_calle_alu" id="y_calle_alu" value="{{$datos->y_calle}}">
                        </div>
                        <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                            <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Otra referencia<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" name="otra_ref_alu" id="otra_ref_alu" value="{{$datos->otra_ref}}">
                        </div>
                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4">
                        <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-2/12 tw:px-2">
                            <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">C. Postal<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" maxlength="5" placeholder="" name="CP_alu" id="CP_alu" value="{{$datos->cp}}">
                        </div>
                        <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                            <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Colonia<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" name="colonia_alu" id="colonia_alu" value="{{$datos->colonia_al}}">
                        </div>
                        <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                            <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Localidad<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" name="localidad_alu" id="localidad_alu" value="{{$datos->localidad_al}}">
                        </div>
                    </div>



                    </section>
                <section class="{{ $estiloPasoAlumno }}" id="tres" role="tabpanel" aria-labelledby="paso-alumno-tres">
                            @include('evaluacion_docente.Alumnos.encabezado_paso', ['paso' => $pasosAlumno['tres']])
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4">
                        <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                            <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Nombre(s)<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" name="nombre_tutor" id="nombre_tutor" value="{{$datos_t->nombre}}">
                        </div>
                        <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                            <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Apellido Paterno<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" name="ap_tutor" id="ap_tutor" value="{{$datos_t->ap_paterno_T}}">
                        </div>
                        <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                            <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Apellido Materno<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" name="am_tutor" id="am_tutor" value="{{$datos_t->ap_mat_T}}">
                        </div>
                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4">
                        <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                            <label for="exampleInputEmail1">Ocupación<b class="tw:sr-only">*</b></label>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="" name="puesto_tutor" id="puesto_tutor" value="{{$datos_t->puesto}}">
                        </div>
                        <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                            <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Parentezco<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" name="parentesco_tutor" id="parentesco_tutor" value="{{$datos_t->parentezco}}">
                        </div>
                        <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                            <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Fecha de Nacimiento<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                            <input type="date" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" name="fecha_nac_tutor" id="fecha_nac_tutor" value="{{ str_contains((string) old('fecha_nac_tutor', $datos_t->fecha_nac_T), '/') ? implode('-', array_reverse(explode('/', old('fecha_nac_tutor', $datos_t->fecha_nac_T)))) : old('fecha_nac_tutor', $datos_t->fecha_nac_T) }}">
                        </div>

                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4">
                    <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-1/12 tw:px-2" id="edad_tutor">
                        <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Edad<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                        <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder=""  name="edad_tutor" id="edad_tutor" value="{{$datos_t->edad}}" readonly="readonly">
                    </div>
                        <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                            <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Genero<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="genero_tutor" id="genero_tutor">
                                @if($existe==0)
                                    <option disabled selected hidden>Selecciona una opción</option>
                                    <option  value="1">FEMENINO</option>
                                    <option  value="2">MASCULINO</option>
                                @else
                                    @if($datos_t->genero==null)
                                        <option disabled selected hidden>Selecciona una opción</option>
                                        <option  value="1">FEMENINO</option>
                                        <option  value="2">MASCULINO</option>
                                    @elseif($datos_t->genero==1)
                                        <option value="1" selected="selected">FEMENINO</option>
                                        <option  value="2">MASCULINO</option>
                                    @else
                                        <option value="1" >FEMENINO</option>
                                        <option  value="2" selected="selected">MASCULINO</option>
                                    @endif

                                @endif
                            </select>
                        </div>
                        <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                            <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Estado Civil<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" name="estado_civ_t" id="estado_civ_t" >
                                @if($existe==0)
                                    <option disabled selected hidden>Selecciona una opción</option>
                                    <option  value="SOLTERO">SOLTERO</option>
                                    <option  value="CASADO">CASADO</option>
                                    <option  value="DIVORCIADO">DIVORCIADO</option>
                                    <option  value="UNION LIBRE">UNION LIBRE</option>
                                    <option  value="VIUDO">VIUDO</option>
                                @else
                                    @if($datos_t->edo_civil_t == null)
                                        <option disabled selected hidden>Selecciona una opción</option>
                                        <option  value="SOLTERO">SOLTERO</option>
                                        <option  value="CASADO">CASADO</option>
                                        <option  value="DIVORCIADO">DIVORCIADO</option>
                                        <option  value="UNION LIBRE">UNION LIBRE</option>
                                        <option  value="VIUDO">VIUDO</option>
                                   @elseif($datos_t->edo_civil_t=="SOLTERO")
                                       <option  value="SOLTERO" selected="selected">SOLTERO</option>
                                       <option  value="CASADO">CASADO</option>
                                       <option  value="DIVORCIADO">DIVORCIADO</option>
                                       <option  value="UNION LIBRE">UNION LIBRE</option>
                                       <option  value="VIUDO">VIUDO</option>
                                   @else
                                       @if($datos_t->edo_civil_t=="CASADO")
                                           <option  value="SOLTERO" >SOLTERO</option>
                                           <option  value="CASADO" selected="selected">CASADO</option>
                                           <option  value="DIVORCIADO">DIVORCIADO</option>
                                           <option  value="UNION LIBRE">UNION LIBRE</option>
                                           <option  value="VIUDO">VIUDO</option>
                                       @else
                                           @if($datos_t->edo_civil_t=="UNION LIBRE")
                                               <option  value="SOLTERO" >SOLTERO</option>
                                               <option  value="CASADO" >CASADO</option>
                                               <option  value="DIVORCIADO" >DIVORCIADO</option>
                                               <option  value="UNION LIBRE" selected="selected">UNION LIBRE</option>
                                               <option  value="VIUDO">VIUDO</option>

                                           @else
                                               @if($datos_t->edo_civil_t=="DIVORCIADO")
                                                <option  value="SOLTERO" >SOLTERO</option>
                                                <option  value="CASADO" >CASADO</option>
                                                <option  value="DIVORCIADO" selected="selected">DIVORCIADO</option>
                                                <option  value="UNION LIBRE">UNION LIBRE</option>
                                                <option  value="VIUDO">VIUDO</option>
                                                @else
                                                    @if($datos_t->edo_civil_t=="VIUDO")
                                                        <option  value="SOLTERO" >SOLTERO</option>
                                                        <option  value="CASADO" >CASADO</option>
                                                        <option  value="DIVORCIADO" >DIVORCIADO</option>
                                                        <option  value="UNION LIBRE" >UNION LIBRE</option>
                                                        <option  value="VIUDO" selected="selected">VIUDO</option>
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                @endif
                            </select>
                        </div>
                        <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                            <label for="exampleInputEmail1">Grado de Estudios<b class="tw:sr-only">*</b></label>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" name="estudios_tutor" id="estudios_tutor" value="{{$datos_t->grado_est_t}}">
                        </div>
                    </div>

                    <h3 class="tw:border-t tw:border-gray-100 tw:pt-4 tw:text-sm tw:font-semibold tw:text-gray-900 tw:dark:border-gray-800 tw:dark:text-white/90">Identificación y contacto del tutor</h3>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4">

                        <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                            <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Nacionalidad<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>

                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" name="nacioanalidad_turor" id="nacioanalidad_turor" >
                                @if($existe==0)
                                    <option disabled selected hidden>Selecciona una opción</option>
                                    <option  value="MEXICANA">MEXICANA</option>
                                    <option  value="EXTRANJERA">EXTRANJERA</option>
                                @else
                                    @if($datos_t->nacionalidad_t== null)
                                        <option disabled selected hidden>Selecciona una opción</option>
                                        <option  value="MEXICANA">MEXICANA</option>
                                        <option  value="EXTRANJERA">EXTRANJERA</option>
                                    @elseif($datos_t->nacionalidad_t=="MEXICANA")
                                        <option value="MEXICANA" selected="selected">MEXICANA</option>
                                        <option  value="EXTRANJERA">EXTRANJERA</option>
                                    @else
                                        <option value="MEXICANA" >MEXICANA</option>
                                        <option  value="EXTRANJERA" selected="selected">EXTRANJERA</option>
                                    @endif

                                @endif
                            </select>
                        </div>
                        <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                            <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Curp<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" onkeyup="javascript:this.value=this.value.toUpperCase();"  oninput="validarcurp(this)" placeholder="" name="curp_tutor" id="curp_tutor" value="{{$datos_t->curp}}">
                            <p id="result" aria-live="polite" class="tw:text-sm tw:font-medium tw:text-red-700 tw:dark:text-red-400 tw:data-[valido=true]:text-green-700 tw:dark:data-[valido=true]:text-green-400"></p>
                        </div>
                        <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                            <label for="exampleInputEmail1">Correo<b class="tw:sr-only">*</b></label>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" name="correo_tutor" id="correo_tutor" value="{{$datos_t->correo_t}}">
                        </div>
                    </div>

                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4">
                        <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                            <label for="exampleInputEmail1">Twitter<b class="tw:sr-only">*</b></label>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="exampleInputEmail1" placeholder="" name="twiter_tutor" id="twiter_tutor" value="{{$datos_t->twitter_t}}">
                        </div>
                        <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                            <label for="exampleInputEmail1">Facebook<b class="tw:sr-only">*</b></label>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" name="facebook_tutor" id="facebook_tutor" value="{{$datos_t->facebook_t}}">
                        </div>
                        <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                            <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Celular<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="exampleInputEmail1" nKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
                                   maxlength="10" placeholder="Ejem: 7221232323" name="cel_tutor" id="cel_tutor" value="{{$datos_t->cel_t}}">
                        </div>

                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4">
                    <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                        <label for="exampleInputEmail1">Tel Fijo<b class="tw:sr-only">*</b></label>
                        <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" name="tel_fijo_tutor" id="tel_fijo_tutor" value="{{$datos_t->tel_fijo_t}}">
                    </div>
                    </div>


                    </section>
                    <section class="{{ $estiloPasoAlumno }}" id="cuatro" role="tabpanel" aria-labelledby="paso-alumno-cuatro">
                            @include('evaluacion_docente.Alumnos.encabezado_paso', ['paso' => $pasosAlumno['cuatro']])
                       {{--
                          <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4">
                              <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-5/12 tw:px-2">
                        <h5>El Domicilio del Padre o Tutor es el mismo que el del Alumno?</h5>

                            <p class="tw:text-center" >
                                <input type="checkbox" value="" id="direccion_igual">
                                Si
                            </p>

                              </div>
                          </div>
                          --}}

                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4">
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Estado<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="" id="estado_tutorinput" name="estado_tutorinput" value="" style="display:none;">
                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="estados_tutor" value="" name="estados_tutor">

                                @if($existe==0||$datos_t->estado_T==0)


                                    <option  disabled selected hidden>Selecciona una opción</option>
                                    @foreach($estados_tutor as $estados_tutor)
                                        <option value="{{$estados_tutor->id_estado}}" data-esta="{{$estados_tutor->nombre_estado}}">{{$estados_tutor->nombre_estado}}</option>
                                    @endforeach

                                @else

                                    <option  disabled selected hidden>Selecciona una carrera</option>
                                    @foreach($estados_tutor as $estados_tutor)
                                        @if($estados_tutor->id_estado == $datos_t->estado_T)
                                            <option value="{{$estados_tutor->id_estado}}" data-esta="{{$estados_tutor->nombre_estado}}" selected="selected">{{$estados_tutor->nombre_estado}}</option>
                                        @else

                                            <option value="{{$estados_tutor->id_estado}}" data-esta="{{$estados_tutor->nombre_estado}}" >{{$estados_tutor->nombre_estado}}</option>

                                        @endif
                                    @endforeach


                                @endif
                            </select>
                            </div>
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Municipio<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                            <input type="text" name="municipios_tutorinput" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="" id="municipio_tutorinput" value="" style="display:none;">
                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="municipios_tutor" value="" name="municipios_tutor">
                                <option disabled selected hidden>Selecciona una opcion</option>
                            </select>
                            </div>
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">calle<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="" id="calle_tutor" name="calle_tutor" value="{{$datos_t->calle}}">
                            </div>
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-2/12 tw:px-2">
                            <label for="exampleInputEmail1">No. Exterior<b class="tw:sr-only">*</b></label>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="" id="no_exterior_tutor" name="no_exterior_tutor" value="{{$datos_t->n_ext_t}}">
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4">
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-2/12 tw:px-2">
                            <label for="exampleInputEmail1">No. Interior<b class="tw:sr-only">*</b></label>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="" id="no_interior_tutor" name="no_interior_tutor" value="{{$datos_t->n_int_t}}">
                            </div>
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Entre Calle<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" id="entre_calle_tutor" name="entre_calle_tutor" value="{{$datos_t->entre_calle_t}}">
                            </div>
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Y Calle<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" id="y_calle_tutor" name="y_calle_tutor" value="{{$datos_t->y_calle_t}}">
                            </div>
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Otra referencia<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" id="otra_ref_tutor" name="otra_ref_tutor" value="{{$datos_t->otra_ref_t}}">
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4">
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-2/12 tw:px-2">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">C. Postal<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" id="cp_tutor" name="cp_tutor" value="{{$datos_t->cp_t}}">
                            </div>
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Colonia<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder="" id="colonia_tutor" name="colonia_tutor" value="{{$datos_t->colonia_t}}">
                            </div>
                            <div class="tw:min-w-0 tw:w-full tw:sm:w-1/2 tw:lg:w-3/12 tw:px-2">
                                <h4 class="tw:mb-1.5 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Localidad<b class="tw:text-red-600 tw:dark:text-red-400">*</b></h4>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="" id="localidad_tutor" name="localidad_tutor" value="{{$datos_t->localidad_t}}">
                            </div>
                        <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="" id="igual" name="igual" value="2" style="display:none;">

                        </div>

                        </section>
                    </div>

                    <div class="tw:mt-6 tw:flex tw:flex-wrap tw:items-center tw:justify-between tw:gap-3 tw:border-t tw:border-gray-100 tw:pt-4 tw:dark:border-gray-800">
                        <x-panel.boton id="paso_alumno_anterior" variante="secundario" disabled>Anterior</x-panel.boton>
                        <div id="paso_alumno_continuar">
                            <x-panel.boton id="paso_alumno_siguiente">Siguiente</x-panel.boton>
                        </div>
                        <div id="paso_alumno_fin" hidden>
                            <x-panel.boton id="guardar" type="submit">Guardar cambios</x-panel.boton>
                        </div>
                    </div>
                </x-panel.tarjeta>
            </form>
        </div>

    </main>
    @include('evaluacion_docente.Alumnos.modal_escuela_cct')

    <script >

        /*var seguro=$("#seguro").val();
        var seguro_social=$("#seguro_social").val();

        if(seguro == 1){
            if(seguro_social.length == 11) {

            }
            else
            {
                $("#seguro_social").val('');
                swal({
                    position: "top",
                    type: "error",
                    title: "El número de seguro social del IMSS es de 11 digitos",
                    showConfirmButton: false,
                    timer: 3500
                });
            }

        }
        else if(seguro == 2){
            if(seguro_social.length == 11) {

            }
            else
            {
                $("#seguro_social").val('');
                swal({
                    position: "top",
                    type: "error",
                    title: "El número de seguro social del ISSSTE es de 11 digitos",
                    showConfirmButton: false,
                    timer: 3500
                });
            }

        }
        else if(seguro == 3){
            if(seguro_social.length == 9) {

            }
            else
            {
                $("#seguro_social").val('');
                swal({
                    position: "top",
                    type: "error",
                    title: "El número de seguro social del ISEMMYM es de 9 digitos",
                    showConfirmButton: false,
                    timer: 3500
                });
            }

        }
        else if(seguro == 4){
            if(seguro_social.length == 10 || seguro_social.length == 11) {

            }
            else
            {
                $("#seguro_social").val('');
                swal({
                    position: "top",
                    type: "error",
                    title: "El número de seguro social del seguro popular ahora INSABI es de 10 a 11 digitos",
                    showConfirmButton: false,
                    timer: 3500
                });
            }

        }*/
        var lenguas=$("#lengua").val();

        if(lenguas == 1) {
            $('#descripcion_lengua').empty();
            $('#descripcion_lengua').append('<label for="exampleInputEmail1">Cual es?<b class="tw:text-red-600 tw:dark:text-red-400"></b></label> <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="descripcion_lengua" name="descripcion_lengua"  value=""  readonly="readonly">\n' +
                '                          ');
        }
        var disc=$("#discapacidad").val();
        if(disc == 1) {
            $('#descripcion_discapacidad').empty();
            $('#descripcion_discapacidad').append(' <label for="exampleInputEmail1">Cual es?<b class="tw:text-red-600 tw:dark:text-red-400"></b></label> <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="descripcion_discapacidad" name="descripcion_discapacidad" placeholder="" value="" readonly="readonly">\n' +
                '                          ');
        }


        var d = new Date();

        function avisarCampoAlumno(input, mensaje) {
            $(input.form).triggerHandler('alumno:campo', [input.name, mensaje]);
        }

        function validarcurp(input) {
            var curp = input.value.toUpperCase(),
                resultado = document.getElementById("result"),
                valido = "No válido";

            if (curpValida(curp)) {
                valido = "Válido";
                resultado.dataset.valido = "true";
            } else {
                resultado.dataset.valido = "false";
            }

            resultado.innerText = "Formato: " + valido;
            avisarCampoAlumno(input, valido === 'Válido' ? null : 'Revisa el formato de la CURP.');
        }
        function validarInput(input) {
            var curp = input.value.toUpperCase(),
                resultado = document.getElementById("resultado"),
                valido = "No válido";

            if (curpValida(curp)) {
                valido = "Válido";
                resultado.dataset.valido = "true";
            } else {
                resultado.dataset.valido = "false";
            }

            resultado.innerText = "Formato: " + valido;
            avisarCampoAlumno(input, valido === 'Válido' ? null : 'Revisa el formato de la CURP.');
        }

        function curpValida(curp) {
            var re = /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0\d|1[0-2])(?:[0-2]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
                validado = curp.match(re);

            if (!validado)  //Coincide con el formato general?
                return false;

            //Validar que coincida el dígito verificador
            function digitoVerificador(curp17) {
                //Fuente https://consultas.curp.gob.mx/CurpSP/
                var diccionario  = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ",
                    lngSuma      = 0.0,
                    lngDigito    = 0.0;
                for(var i=0; i<17; i++)
                    lngSuma= lngSuma + diccionario.indexOf(curp17.charAt(i)) * (18 - i);
                lngDigito = 10 - lngSuma % 10;
                if(lngDigito == 10)
                    return 0;
                return lngDigito;
            }
            if (validado[2] != digitoVerificador(validado[1]))
                return false;

            return true; //Validado
        }

        function calculateAge(birthday) {
            var birthday_arr = birthday.split("-").reverse();
            var birthday_date = new Date(birthday_arr[2], birthday_arr[1] - 1, birthday_arr[0]);
            var ageDifMs = Date.now() - birthday_date.getTime();
            var ageDate = new Date(ageDifMs);
            return Math.abs(ageDate.getUTCFullYear() - 1970);
        }


        $(document).ready(function(){

            $("#seguro").change(function(e) {

                $("#seguro_s").css("display", "inline");
                $("#seguro_social").val('');
                avisarCampoAlumno(document.getElementById('seguro_social'), null);
            });
            $("#seguro_social").change(function(e) {

                var seguro=$("#seguro").val();
                var seguro_social=$("#seguro_social").val();
                avisarCampoAlumno(this, null);

                if(seguro == 1){
                    if(seguro_social.length == 11) {

                    }
                    else
                    {
                        $("#seguro_social").val('');
                        avisarCampoAlumno(this, "El número de seguro social del IMSS es de 11 digitos");
                        swal({
                            position: "top",
                            type: "error",
                            title: "El número de seguro social del IMSS es de 11 digitos",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }

                }
                else if(seguro == 2){
                    if(seguro_social.length == 11) {

                    }
                    else
                    {
                        $("#seguro_social").val('');
                        avisarCampoAlumno(this, "El número de seguro social del ISSSTE es de 11 digitos");
                        swal({
                            position: "top",
                            type: "error",
                            title: "El número de seguro social del ISSSTE es de 11 digitos",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }

                }
                else if(seguro == 3){
                    if(seguro_social.length == 9 || seguro_social.length == 8 || seguro_social.length == 7 ) {

                    }
                    else
                    {
                        $("#seguro_social").val('');
                        avisarCampoAlumno(this, "El número de seguro social del ISEMMYM es de 7 a 9  digitos");
                        swal({
                            position: "top",
                            type: "error",
                            title: "El número de seguro social del ISEMMYM es de 7 a 9  digitos",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }

                }
                else if(seguro == 4){
                    if(seguro_social.length == 10 || seguro_social.length == 11) {

                    }
                    else
                    {
                        $("#seguro_social").val('');
                        avisarCampoAlumno(this, "El número de seguro social del seguro popular ahora INSABI  es de 10 a 11 digitos");
                        swal({
                            position: "top",
                            type: "error",
                            title: "El número de seguro social del seguro popular ahora INSABI  es de 10 a 11 digitos",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }

                }
                else if(seguro == 5){
                    if(seguro_social.length >= 8) {

                    }
                    else
                    {
                        $("#seguro_social").val('');
                        avisarCampoAlumno(this, "El número de seguro social del ISSFAM   es de 8 digitos");
                        swal({
                            position: "top",
                            type: "error",
                            title: "El número de seguro social del ISSFAM   es de 8 digitos",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }

                }

            });


            $("#fecha_nac_tutor").change(function (e) {
                var fecha_nacimiento_tutor = e.target.value;
                if (!fecha_nacimiento_tutor) { return; }
                var fecha_tutor= calculateAge(fecha_nacimiento_tutor);
                $('#edad_tutor').empty();
                $('#edad_tutor').append(' <label for="exampleInputEmail1">Edad<b class="tw:text-red-600 tw:dark:text-red-400">*</b></label>\n' +
                    '                <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  placeholder=""  name="edad_tutor" id="edad_tutor" value="'+fecha_tutor+'" readonly="readonly">\n' +
                    '               ');

            });

            $("#lengua").change(function(e) {

                var lengua = e.target.value;
                if(lengua == 1) {
                    $('#descripcion_lengua').empty();
                    $('#descripcion_lengua').append('<label for="exampleInputEmail1">Cual es?<b class="tw:text-red-600 tw:dark:text-red-400"></b></label> <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="descripcion_lengua" name="descripcion_lengua"  value=""  readonly="readonly">\n' +
                        '                          ');
                }
                if(lengua == 2) {
                    $('#descripcion_lengua').empty();
                    $('#descripcion_lengua').append('<label for="exampleInputEmail1">Cual es?<b class="tw:text-red-600 tw:dark:text-red-400"></b></label> <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="descripcion_lengua" name="descripcion_lengua" value="{{$datos->descripcion_lengua }}" required>\n' +
                        '                          ');
                }
            });
            $("#discapacidad").change(function(e) {

                var discapacidad = e.target.value;
                if(discapacidad == 1) {
                    $('#descripcion_discapacidad').empty();
                    $('#descripcion_discapacidad').append(' <label for="exampleInputEmail1">Cual es?<b class="tw:text-red-600 tw:dark:text-red-400"></b></label> <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="descripcion_discapacidad" name="descripcion_discapacidad" placeholder="" value="" readonly="readonly">\n' +
                        '                          ');
                }
                if(discapacidad == 2) {
                    $('#descripcion_discapacidad').empty();
                    $('#descripcion_discapacidad').append(' <label for="exampleInputEmail1">Cual es?<b class="tw:text-red-600 tw:dark:text-red-400"></b></label> <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-gray-100 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="descripcion_discapacidad"  name="descripcion_discapacidad" placeholder="" value="{{$datos->descripcion_discapacidad}}" required>\n' +
                        '                          ');
                }
            });
            $("#cuenta").change(function () {
                const input = this;
                const cuenta = input.value;
                if (!cuenta) { return; }
                $.get("/cuenta_alumno/" + encodeURIComponent(cuenta), function (response) {
                    if (input.value !== cuenta) { return; }
                    if (response == 1) {
                        const mensaje = "El número de cuenta ya está registrado.";
                        input.value = '';
                        avisarCampoAlumno(input, mensaje);
                        PanelFormularios.alerta('warning', 'Revisa el número de cuenta', mensaje);
                    } else {
                        avisarCampoAlumno(input, null);
                    }
                });
            });
            $("#formgeneral").validate({
                ignore:[],
                rules:{
                    cuenta:"required",
                    nomalu:"required",
                    appalu:"required",
                    apmalu:"required",
                    fecha_nac:"required",
                    edadalu:{required:true, digits:true,minlength: 2},
                    generoalu:"required",
                    curpalu:"required",
                    nacioalu:"required",
                    estadoalu:"required",
                    correoalu:{required:true,email:true},
                    entidadalu:"required",
                   // escuela:"required",
                  //  estudiosalu:"required",
                    carreras:"required",
                    semestre:"required",
                    promedio_preparatoria:{required:true},
                    grupoalu:"required",
                    celalu:{required:true, digits:true,minlength: 10},
                    estados_alu:"required",
                    municipios_alu:"required",
                    calle_alu:"required",
                    entre_calle_alu:"required",
                    y_calle_alu:"required",
                    otra_ref_alu:"required",
                    CP_alu:{required:true, digits:true,minlength: 5},
                    colonia_alu:"required",
                    localidad_alu:"required",
                    discapacidad:"required",
                    lengua:"required",
                    seguro:"required",
                    seguro_social:{required:{depends: () => ['1', '2', '3', '4', '5'].includes($('#seguro').val())}},



                    nombre_tutor:"required",
                    ap_tutor:"required",
                    am_tutor:"required",
                    parentesco_tutor:"required",
                    fecha_nac_tutor:"required",
                    edad_tutor:{required:true, digits:true,minlength: 2},
                    genero_tutor:"required",
                    estado_civ_t:"required",
                    nacioanalidad_turor:"required",
                    curp_tutor:"required",
                    cel_tutor:{required:true, digits:true,minlength: 10},

                    estados_tutor:"required",
                    calle_tutor:"required",
                    entre_calle_tutor:"required",
                    y_calle_tutor:"required",
                    otra_ref_tutor:"required",
                    cp_tutor:{required:true, digits:true,minlength: 5},
                    colonia_tutor:"required",
                    localidad_tutor:"required",


                },

                focusInvalid: false,
                messages: {
                    correoalu: { email: 'Escribe un correo válido.' },
                    fecha_nac: { required: 'Completa la fecha de nacimiento del alumno.' },
                    fecha_nac_tutor: { required: 'Completa la fecha de nacimiento del tutor.' },
                },
                invalidHandler: function (event, validator) {
                    const errores = Object.fromEntries(validator.errorList.map(({element, message}) => {
                        const etiqueta = element.labels?.[0]?.textContent.trim()
                            || element.closest('div')?.querySelector('h4, h5')?.textContent.trim()
                            || element.name;
                        return [element.name, etiqueta.replace(/\*+$/, '').trim() + ': ' + message];
                    }));
                    PanelFormularios.errores(this, errores);
                },
                showErrors: function () {
                    // El stepper muestra los errores de las secciones revisadas.
                },
                submitHandler: function (form) {
                    PanelFormularios.enviar(form, document.getElementById('guardar'));
                }
            });
//TNotify.alert("{{$datos->id_carrera}}");
                    @if($existe==1)



            var id_estado={!!$x=$datos->estado==null?0:$datos->estado!!};
            var id_municipio={!!$y=$datos->id_municipio==null?0:$datos->id_municipio!!};
            //console.log(id_estado);
            //console.log(id_municipio);




            $.get('/ajax-subcat?id_estado=' + id_estado,function(data){

                $('#municipios_alu').empty();
                $.each(data,function(datos_alumno,subcatObj){


                    if(subcatObj.id_municipio==id_municipio)
                    {
                        $('#municipios_alu').append(' <option selected="selected" value="'+subcatObj.id_municipio+'" data-muni="'+subcatObj.nombre_municipio+'" >'+subcatObj.nombre_municipio+'</option>'
                        );
                    }
                    else
                    {
                        $('#municipios_alu').append(' <option value="'+subcatObj.id_municipio+'" data-muni="'+subcatObj.nombre_municipio+'" >'+subcatObj.nombre_municipio+'</option>'
                        );
                    }

                });
            });


                    @endif

                    @if($existe==1)
            var id_estadot={!!$x=$datos_t->estado_T==null?0:$datos_t->estado_T!!};
            var id_municipiot={!!$y=$datos_t->municipio_T==null?0:$datos_t->municipio_T!!};
            // var id_municipiot={{$datos_t->municipio_T}};
            //console.log(id_estadot);
            //console.log(id_municipiot);


            $.get('/ajax-subcat?id_estado=' + id_estadot,function(data){

                $('#municipios_tutor').empty();
                $.each(data,function(datos_alumno,subcatObj){


                    if(subcatObj.id_municipio==id_municipiot)
                    {
                        $('#municipios_tutor').append(' <option selected="selected" value="'+subcatObj.id_municipio+'" data-muni="'+subcatObj.nombre_municipio+'" >'+subcatObj.nombre_municipio+'</option>'
                        );
                    }
                    else
                    {
                        $('#municipios_tutor').append(' <option value="'+subcatObj.id_municipio+'" data-muni="'+subcatObj.nombre_municipio+'" >'+subcatObj.nombre_municipio+'</option>'
                        );
                    }

                });
            });


            @endif



            $("#direccion_igual").click(function(){


                if($('#direccion_igual').is(':checked') )
                {

                    var selected = $("#estados_alu").find('option:selected');
                    var selected2 = $("#municipios_alu").find('option:selected');
                    var direccion=1;

                    var es=selected.data('esta');
                    var mu=selected2.data('muni');

                    $('#igual').val(direccion);
                    $('#estado_tutorinput').val(es);
                    document.getElementById('estado_tutorinput').style.display="";
                    document.getElementById('estado_tutorinput').disabled="true";
                    document.getElementById('estados_tutor').style.display="none";


                    $('#municipio_tutorinput').val(mu);
                    document.getElementById('municipio_tutorinput').style.display="";
                    document.getElementById('municipio_tutorinput').disabled="true";
                    document.getElementById('municipios_tutor').style.display="none";




                    $('#calle_tutor').val($("#calle_alu").val());
                    document.getElementById('calle_tutor').disabled="true";
                    $('#no_exterior_tutor').val($("#n_exterior_alu").val());
                    document.getElementById('no_exterior_tutor').disabled="true";
                    $('#no_interior_tutor').val($("#n_interior_alu").val());
                    document.getElementById('no_interior_tutor').disabled="true";
                    $('#entre_calle_tutor').val($("#entre_calle_alu").val());
                    document.getElementById('entre_calle_tutor').disabled="true";
                    $('#y_calle_tutor').val($("#y_calle_alu").val());
                    document.getElementById('y_calle_tutor').disabled="true";
                    $('#otra_ref_tutor').val($("#otra_ref_alu").val());
                    document.getElementById('otra_ref_tutor').disabled="true";
                    $('#colonia_tutor').val($("#colonia_alu").val());
                    document.getElementById('colonia_tutor').disabled="true";
                    $('#localidad_tutor').val($("#localidad_alu").val());
                    document.getElementById('localidad_tutor').disabled="true";
                    $('#cp_tutor').val($("#CP_alu").val());
                    document.getElementById('cp_tutor').disabled="true";



                }
                else
                {
                    var direccion=2;

                    document.getElementById('estado_tutorinput').style.display="none";
                    document.getElementById('municipio_tutorinput').style.display="none";
                    document.getElementById('estados_tutor').style.display="";
                    document.getElementById('municipios_tutor').style.display="";

                    document.getElementById('estado_tutorinput').disabled="";
                    document.getElementById('municipio_tutorinput').disabled="";
                    document.getElementById('calle_tutor').disabled="";
                    document.getElementById('no_exterior_tutor').disabled="";
                    document.getElementById('no_interior_tutor').disabled="";
                    document.getElementById('entre_calle_tutor').disabled="";
                    document.getElementById('y_calle_tutor').disabled="";
                    document.getElementById('otra_ref_tutor').disabled="";
                    document.getElementById('colonia_tutor').disabled="";
                    document.getElementById('localidad_tutor').disabled="";
                    document.getElementById('cp_tutor').disabled="";
                    $('#igual').val(direccion);
                    //  $('#estados_tutor').val("");
                    $('#municipios_tutor').val("");
                    $('#calle_tutor').val("");
                    $('#no_exterior_tutor').val("");
                    $('#no_interior_tutor').val("");
                    $('#entre_calle_tutor').val("");
                    $('#y_calle_tutor').val("");
                    $('#otra_ref_tutor').val("");
                    $('#colonia_tutor').val("");
                    $('#localidad_tutor').val("");
                    $('#cp_tutor').val("");
                }
            });


///////////////////////////////////////trae los municipios para la parte del alumno

            $("#estados_alu").change(function(e){
                console.log(e);

                var id_estado= e.target.value;
                //TNotify.alert(id_estado);

                $.get('/ajax-subcat?id_estado=' + id_estado,function(data){

                    $('#municipios_alu').empty();
                    $.each(data,function(datos_alumno,subcatObj){


                        //  TNotify.alert(subcatObj);
                        $('#municipios_alu').append('<option value="'+subcatObj.id_municipio+'" data-muni="'+subcatObj.nombre_municipio+'" >'+subcatObj.nombre_municipio+'</option>');
                    });
                });
            });

///////////////////////////////////trae los municipios para la parte del tutor
            $("#estados_tutor").on('change',function(e){
                console.log(e);
                var id_estado= e.target.value;
                //TNotify.alert(id_estado);
                $.get('/ajax-subcat?id_estado=' + id_estado,function(data){
                    $('#municipios_tutor').empty();
                    $.each(data,function(datos_alumno,subcatObj){
                        //  TNotify.alert(subcatObj);
                        $('#municipios_tutor').append('<option value="'+subcatObj.id_municipio+'" data-muni="'+subcatObj.nombre_municipio+'" >'+subcatObj.nombre_municipio+'</option>');
                    });
                });
            });


        });
    </script>
@endsection

@push('scripts')
    <script src="{{ asset('js/alumnos/datos-stepper.js') }}?v={{ filemtime(public_path('js/alumnos/datos-stepper.js')) }}"></script>
@endpush
