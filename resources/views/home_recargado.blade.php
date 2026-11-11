@extends('layouts.app')
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
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">

					@if($jefe_division == true || $directivo == true)
						<div class="panel panel-success">
							<div class="panel-heading" style="text-align: center">ATENCION: !!!!El modulo de RETICULA y DOCENTE se cambio a Generales en el submenu ACADEMICO!!</div>
						</div>
					@endif
					@if($profesor_men==true)
						<div class="panel-heading">{{$men}}</div>
						<div class="panel-heading">NOTA:
							La última fecha de liberación de Actividades Complementarias es el {{$fecha}}</div>
					@else
						<div class="panel-heading">{{$men}} </div>
					@endif
				</div>
			</div>
		</div>
		@if($es_tutor_reprobacion && $periodo_reprobacion_tutor && (int) $total_alumnos_reprobacion_tutor > 0)
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="panel panel-warning">
						<div class="panel-heading" style="text-align:center; font-weight:bold;">
							Canalización por reprobación
						</div>
						<div class="panel-body" style="text-align:center;">
							<p>
								Tienes asignación activa como tutor.
								@if(isset($periodo_reprobacion_tutor) && $periodo_reprobacion_tutor)
									<br>
									<strong>Periodo:</strong> {{ $periodo_reprobacion_tutor->periodo }}
								@endif
								<br>
								<strong>Estudiantes con reprobación detectados:</strong>
								{{ isset($total_alumnos_reprobacion_tutor) ? $total_alumnos_reprobacion_tutor : 0 }}
							</p>
							<a href="{{ url('/canalizacion-reprobacion-principal') }}" class="btn btn-warning btn-lg">
								<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
								Canalizar estudiantes con reprobación
							</a>
						</div>
					</div>
				</div>
			</div>
		@endif

		@if(request()->get('debug_tutor') == 1)
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="alert alert-info">
						<strong>Diagnóstico tutor reprobación</strong><br>
						Es tutor: {{ $es_tutor_reprobacion ? 'SI' : 'NO' }}<br>
						Total reprobados: {{ isset($total_alumnos_reprobacion_tutor) ? $total_alumnos_reprobacion_tutor : 0 }}<br>
						@if(isset($debug_tutor_reprobacion['id_personal']))
							ID personal: {{ $debug_tutor_reprobacion['id_personal'] }}<br>
						@endif
						@if(isset($debug_tutor_reprobacion['metodo']))
							Método: {{ $debug_tutor_reprobacion['metodo'] }}<br>
						@endif
						@if(isset($debug_tutor_reprobacion['motivo']))
							Motivo: {{ $debug_tutor_reprobacion['motivo'] }}<br>
						@endif
					</div>
				</div>
			</div>
		@endif

		@if($palumno == true)
			@if($estado_encuesta1 == 1 || $estado_encuesta2 == 1 || $estado_encuesta3 == 1 || $estado_encuesta4 == 1)
				<div class="row" style="">
					<div class="col-md-12">
						<div class="panel panel-success">
							<div class="panel-heading">Encuestas de satisfacion al cliente</div>
							<div class="panel-body">
								@if($estado_inscripcion == 1)
									<div class="row">
										<div class="col-md-12">
											<p style="text-align: center"><button type="button" class="btn btn-primary" onclick="window.location='{{ url('/encuestas_satisfaccion/encuesta_incripcion/' ) }}'">Encuesta de Inscripción</button></p>
										</div>
									</div>
								@endif
								@if($estado_reinscripcion == 1)
									<div class="row">
										<div class="col-md-12">
											<p style="text-align: center"><button type="button" class="btn btn-primary" onclick="window.location='{{ url('/encuestas_satisfaccion/encuesta_reincripcion/' ) }}'">Encuesta de Reinscripción</button></p>
										</div>
									</div>
								@endif
								@if($estado_servicio == 1)
									<div class="row">
										<div class="col-md-12">
											<p style="text-align: center"><button type="button" class="btn btn-primary" onclick="window.location='{{ url('/encuestas_satisfaccion/encuesta_servicio_social/' ) }}'">Encuesta de Servicio Social</button></p>
										</div>
									</div>
								@endif
								@if($estado_residencia == 1)
									<div class="row">
										<div class="col-md-12">
											<p style="text-align: center"><button type="button" class="btn btn-primary" onclick="window.location='{{ url('/encuestas_satisfaccion/encuesta_residencia/' ) }}'">Encuesta de Residencia Profesional</button></p>
										</div>
									</div>
								@endif
							</div>
						</div>

					</div>
				</div>
			@endif
		@endif
		@if($palumno  == true)
			@if($adeudo  == 1)
				<!-- Modal adeudo en los departamentos -->
				<div class="modal fade" id="modal_adeudo"  role="dialog">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title " style="text-align: center">Alerta</h4>
							</div>
							<div class="modal-body">
								<p>	<strong>Contacta al o a los siguientes Departamentos o Jefaturas, porque cuentas con un adeudo (por ejemplo: préstamo de material o instrumentos, o un documento):</strong></p>
								@foreach($departamento_carrera as $departamento)
									<div class="alert alert-danger">
										<strong>Nombre del departamento o jefatura: {{ $departamento['nombre'] }}</strong><br> <b>¿Que es lo que adeudas en el departamento?</b> {{ $departamento['comentario'] }}
									</div>
								@endforeach
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</div>
				</div>
			@endif
		@endif
	</div>
	<script type="text/javascript">
		$(document).ready(function (){
			var alumno = "<?php echo $palumno  ?>";
			if(alumno == true){
				var adeudo = "<?php echo $adeudo ?>"
				if(adeudo ==1) {
					$('#modal_adeudo').modal('show');
				}
			}
		});
	</script>
@endsection
