{{--
    Panel de inicio del nuevo diseño (/inicio). COPIA de home_recargado.blade.php:
    el bloque PHP (L4-125) es idéntico y se conservan las mismas condiciones, avisos, encuestas
    y modal de adeudos, con los mismos datos de HomeController2@index. Solo cambia el diseño
    (TailAdmin) y los acentos de los textos; se agrega arriba una tarjeta de bienvenida con datos
    que ya están en la sesión. No se copia el diagnóstico ?debug_tutor=1 (L173-191).

    MANTENIMIENTO DOBLE: cualquier cambio en home_recargado.blade.php debe repetirse aquí
    (ver docs/panel.md) y verificarse con: php artisan test --filter=Avisos
--}}
@extends('layouts.panel')
@section('title', 'Inicio')
@section('content')
	<?php
	$men=Session::get('men');
	$fecha=Session::get('fecha');
	$profesor_men=session()->has('profesor_men')?session()->has('profesor_men'):false;
	$jefe_division=session()->has('jefe_division')?session()->has('jefe_division'):false;
	$directivo=session()->has('directivo')?session()->has('directivo'):false;
	$palumno = session()->has('palumno') ? session()->has('palumno') : false;

	/*
    |--------------------------------------------------------------------------
    | Aviso de Canalización por Reprobación - solo periodo vigente
    |--------------------------------------------------------------------------
    | La fecha del sistema determina el periodo académico vigente. Se recalculan
    | siempre las variables, aunque el controlador las haya enviado, para evitar
    | mostrar periodos históricos o conteos desactualizados.
    | El aviso solo aparece cuando el tutor tiene estudiantes reprobados (> 0).
    */
	$es_tutor_reprobacion = false;
	$total_alumnos_reprobacion_tutor = 0;
	$periodo_reprobacion_tutor = null;
	$debug_tutor_reprobacion = array(
			'es_tutor' => false,
			'origen' => 'validacion_en_vista',
			'motivo' => 'No se ha encontrado una asignación de tutoría en el periodo vigente.',
	);

	if (\Illuminate\Support\Facades\Auth::check()) {
		$id_personal_reprobacion = Session::get('id_perso');
		$metodo_reprobacion = $id_personal_reprobacion ? 'sesion' : '';

		if (!$id_personal_reprobacion) {
			$id_usuario_reprobacion = \Illuminate\Support\Facades\Auth::id();
			$personal_tipo_usuario = \Illuminate\Support\Facades\DB::table('gnral_personales')
					->where('tipo_usuario', $id_usuario_reprobacion)
					->first();

			if ($personal_tipo_usuario) {
				$id_personal_reprobacion = $personal_tipo_usuario->id_personal;
				$metodo_reprobacion = 'tipo_usuario';
			}
		}

		if (!$id_personal_reprobacion) {
			$usuario_reprobacion = \Illuminate\Support\Facades\DB::table('users')
					->where('id', \Illuminate\Support\Facades\Auth::id())
					->first();

			if ($usuario_reprobacion && isset($usuario_reprobacion->email) && trim($usuario_reprobacion->email) != '') {
				$correo_reprobacion = trim(strtolower($usuario_reprobacion->email));
				$personal_correo = \Illuminate\Support\Facades\DB::table('gnral_personales')
						->whereRaw('LOWER(TRIM(correo)) = ?', array($correo_reprobacion))
						->first();

				if ($personal_correo) {
					$id_personal_reprobacion = $personal_correo->id_personal;
					$metodo_reprobacion = 'correo';
				}
			}
		}

		$fecha_actual_reprobacion = \Carbon\Carbon::today(config('app.timezone'))->toDateString();
		$periodo_vigente_reprobacion = \Illuminate\Support\Facades\DB::table('gnral_periodos')
				->whereDate('fecha_inicio', '<=', $fecha_actual_reprobacion)
				->whereDate('fecha_termino', '>=', $fecha_actual_reprobacion)
				->orderBy('fecha_inicio', 'desc')
				->orderBy('id_periodo', 'desc')
				->first();

		if (!$periodo_vigente_reprobacion) {
			$debug_tutor_reprobacion['motivo'] = 'No existe un periodo académico vigente para la fecha del sistema.';
		} elseif (!$id_personal_reprobacion) {
			$debug_tutor_reprobacion['motivo'] = 'No se pudo identificar el registro de personal del usuario.';
		} else {
			$asignacion_tutor_reprobacion = \Illuminate\Support\Facades\DB::table('exp_asigna_tutor as et')
					->join('exp_asigna_generacion as eg', 'eg.id_asigna_generacion', '=', 'et.id_asigna_generacion')
					->join('gnral_jefes_periodos as jp', 'jp.id_jefe_periodo', '=', 'eg.id_jefe_periodo')
					->where('et.id_personal', $id_personal_reprobacion)
					->where('jp.id_periodo', $periodo_vigente_reprobacion->id_periodo)
					->whereNull('et.deleted_at')
					->whereNull('eg.deleted_at')
					->exists();

			if ($asignacion_tutor_reprobacion) {
				$es_tutor_reprobacion = true;
				$periodo_reprobacion_tutor = $periodo_vigente_reprobacion;

				$total_alumnos_reprobacion_tutor = \Illuminate\Support\Facades\DB::table('exp_asigna_tutor as et')
						->join('exp_asigna_generacion as eg', 'eg.id_asigna_generacion', '=', 'et.id_asigna_generacion')
						->join('exp_asigna_alumnos as ea', 'ea.id_asigna_generacion', '=', 'eg.id_asigna_generacion')
						->join('gnral_jefes_periodos as jp', 'jp.id_jefe_periodo', '=', 'eg.id_jefe_periodo')
						->join('eva_carga_academica as ca', function ($join) {
							$join->on('ca.id_alumno', '=', 'ea.id_alumno')
									->on('ca.id_periodo', '=', 'jp.id_periodo');
						})
						->join('cal_evaluaciones as ev', 'ev.id_carga_academica', '=', 'ca.id_carga_academica')
						->where('et.id_personal', $id_personal_reprobacion)
						->where('jp.id_periodo', $periodo_vigente_reprobacion->id_periodo)
						->whereNull('et.deleted_at')
						->whereNull('eg.deleted_at')
						->whereNull('ea.deleted_at')
						->where('ea.estado', 1)
						->where('ev.calificacion', '<', 70)
						->distinct()
						->count('ea.id_alumno');

				$debug_tutor_reprobacion = array(
						'es_tutor' => true,
						'id_personal' => $id_personal_reprobacion,
						'metodo' => $metodo_reprobacion,
						'origen' => 'validacion_en_vista',
						'motivo' => $total_alumnos_reprobacion_tutor > 0
								? 'El aviso puede mostrarse: hay estudiantes reprobados en el periodo vigente.'
								: 'No hay estudiantes reprobados en el periodo vigente; se oculta el aviso.',
				);
			} else {
				$debug_tutor_reprobacion['motivo'] = 'El docente no tiene asignación como tutor en el periodo vigente.';
			}
		}
	}

	?>
	<div class="container">
	<div class="grid grid-cols-12 gap-4 md:gap-6">

		{{-- Bienvenida (nuevo): nombre y periodo de la sesión --}}
		<div class="col-span-12" data-panel-bienvenida>
			<div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6 dark:border-gray-800 dark:bg-white/3">
				<p class="text-sm text-gray-500 dark:text-gray-400">Bienvenido(a)</p>
				<h2 class="mt-1 text-xl font-semibold text-gray-800 md:text-2xl dark:text-white/90">{{ Session::get('nombre') }}</h2>
				<p class="mt-3 inline-flex items-center gap-2 rounded-full bg-brand-50 px-3 py-1 text-sm font-medium text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">
					<svg class="size-4" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M8 2.75v2m8-2v2M3.75 9.25h16.5M5.25 4.75h13.5a1.5 1.5 0 011.5 1.5v12.5a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V6.25a1.5 1.5 0 011.5-1.5z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /></svg>
					Periodo actual: {{ Session::get('nombre_periodo') }}
				</p>
			</div>
		</div>

		{{-- [home_recargado L127-143] Avisos generales --}}
		<div class="col-span-12 flex flex-col gap-4" data-panel-avisos>
			@if($jefe_division == true || $directivo == true)
				<div class="rounded-xl border border-green-500 bg-green-50 p-4 dark:border-green-500/30 dark:bg-green-500/15" data-panel-aviso="reticula">
					<p class="text-center text-sm font-medium text-green-700 dark:text-green-400">ATENCIÓN: !!!!El módulo de RETÍCULA y DOCENTE se cambió a Generales en el submenú ACADÉMICO!!</p>
				</div>
			@endif
			@if($profesor_men==true)
				<div class="rounded-xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/3" data-panel-aviso="men">
					<p class="text-sm text-gray-700 dark:text-gray-300">{{$men}}</p>
					<p class="mt-2 text-sm text-gray-700 dark:text-gray-300" data-panel-aviso="fecha">NOTA:
						La última fecha de liberación de Actividades Complementarias es el {{$fecha}}</p>
				</div>
			@else
				<div class="rounded-xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/3" data-panel-aviso="men">
					<p class="text-sm text-gray-700 dark:text-gray-300">{{$men}} </p>
				</div>
			@endif
		</div>

		{{-- [home_recargado L145-171] Aviso de canalización por reprobación (tutores) --}}
		@if($es_tutor_reprobacion && $periodo_reprobacion_tutor && (int) $total_alumnos_reprobacion_tutor > 0)
			<div class="col-span-12" data-panel-aviso="tutor">
				<div class="rounded-2xl border border-amber-500 bg-amber-50 p-5 md:p-6 dark:border-amber-500/30 dark:bg-amber-500/15">
					<h3 class="text-center text-base font-semibold text-amber-700 dark:text-amber-400">
						Canalización por reprobación
					</h3>
					<p class="mt-3 text-center text-sm text-gray-700 dark:text-gray-300">
						Tienes asignación activa como tutor.
						@if(isset($periodo_reprobacion_tutor) && $periodo_reprobacion_tutor)
							<br>
							<strong>Periodo:</strong> {{ $periodo_reprobacion_tutor->periodo }}
						@endif
						<br>
						<strong>Estudiantes con reprobación detectados:</strong>
						<span data-panel-total-reprobacion>{{ isset($total_alumnos_reprobacion_tutor) ? $total_alumnos_reprobacion_tutor : 0 }}</span>
					</p>
					<div class="mt-4 text-center">
						<a href="{{ url('/canalizacion-reprobacion-principal') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-amber-500 px-5 py-3.5 text-sm font-medium text-white shadow-theme-xs transition hover:bg-amber-600">
							Canalizar estudiantes con reprobación
						</a>
					</div>
				</div>
			</div>
		@endif

		{{-- [home_recargado L194-235] Encuestas de satisfacción del alumno --}}
		@if($palumno == true)
			@if($estado_encuesta1 == 1 || $estado_encuesta2 == 1 || $estado_encuesta3 == 1 || $estado_encuesta4 == 1)
				<div class="col-span-12" data-panel-encuestas>
					<div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6 dark:border-gray-800 dark:bg-white/3">
						<h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Encuestas de satisfacción al cliente</h3>
						<div class="mt-4 flex flex-col items-center gap-3 sm:flex-row sm:flex-wrap sm:justify-center">
							@if($estado_inscripcion == 1)
								<a href="{{ url('/encuestas_satisfaccion/encuesta_incripcion/' ) }}" class="inline-flex items-center justify-center rounded-lg bg-brand-500 px-5 py-3.5 text-sm font-medium text-white shadow-theme-xs transition hover:bg-brand-600">Encuesta de Inscripción</a>
							@endif
							@if($estado_reinscripcion == 1)
								<a href="{{ url('/encuestas_satisfaccion/encuesta_reincripcion/' ) }}" class="inline-flex items-center justify-center rounded-lg bg-brand-500 px-5 py-3.5 text-sm font-medium text-white shadow-theme-xs transition hover:bg-brand-600">Encuesta de Reinscripción</a>
							@endif
							@if($estado_servicio == 1)
								<a href="{{ url('/encuestas_satisfaccion/encuesta_servicio_social/' ) }}" class="inline-flex items-center justify-center rounded-lg bg-brand-500 px-5 py-3.5 text-sm font-medium text-white shadow-theme-xs transition hover:bg-brand-600">Encuesta de Servicio Social</a>
							@endif
							@if($estado_residencia == 1)
								<a href="{{ url('/encuestas_satisfaccion/encuesta_residencia/' ) }}" class="inline-flex items-center justify-center rounded-lg bg-brand-500 px-5 py-3.5 text-sm font-medium text-white shadow-theme-xs transition hover:bg-brand-600">Encuesta de Residencia Profesional</a>
							@endif
						</div>
					</div>
				</div>
			@endif
		@endif
	</div>

	{{-- [home_recargado L236-273] Modal de adeudos del alumno: se abre al cargar (antes con jQuery, ahora con Alpine) --}}
	@if($palumno  == true)
		@if($adeudo  == 1)
			<div x-data="{ abierto: true }" data-panel-adeudos>
				<div x-cloak x-show="abierto" x-transition.opacity class="fixed inset-0 z-99999 flex items-center justify-center overflow-y-auto p-5" role="dialog" aria-modal="true" aria-labelledby="panel-adeudo-titulo">
					<div class="fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]" @click="abierto = false"></div>
					<div class="relative w-full max-w-3xl rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-8">
						<h4 id="panel-adeudo-titulo" class="text-center text-lg font-semibold text-gray-800 dark:text-white/90">Alerta</h4>
						<p class="mt-4 text-sm text-gray-700 dark:text-gray-300"><strong>Contacta al o a los siguientes Departamentos o Jefaturas, porque cuentas con un adeudo (por ejemplo: préstamo de material o instrumentos, o un documento):</strong></p>
						<div class="mt-4 flex flex-col gap-3">
							@foreach($departamento_carrera as $departamento)
								<div class="rounded-xl border border-red-500 bg-red-50 p-4 text-sm text-red-700 dark:border-red-500/30 dark:bg-red-500/15 dark:text-red-400" data-panel-adeudo>
									<strong>Nombre del departamento o jefatura: {{ $departamento['nombre'] }}</strong><br> <b>¿Qué es lo que adeudas en el departamento?</b> {{ $departamento['comentario'] }}
								</div>
							@endforeach
						</div>
						<div class="mt-6 flex justify-end">
							<button type="button" @click="abierto = false" class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/3">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
		@endif
	@endif
@endsection
