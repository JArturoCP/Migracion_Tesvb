<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use RuntimeException;

/** Datos aislados para probar Mi horario; requiere el esquema TESVB importado. */
class HorarioPruebaSistemasSeeder extends Seeder
{
    public const PASSWORD = 'Horario.Prueba2026!';

    public function run(): void
    {
        if (!app()->environment('local', 'testing')) {
            throw new RuntimeException('Este seeder solo se permite en local/testing.');
        }
        DB::transaction(function () {
            $hoy = today();
            $periodo = DB::table('gnral_periodos')->whereDate('fecha_inicio', '<=', $hoy)
                ->whereDate('fecha_termino', '>=', $hoy)->orderByDesc('fecha_inicio')->orderByDesc('id_periodo')->first();
            $inicio = $hoy->copy()->startOfMonth();
            $fin = $inicio->copy()->addMonths(5)->endOfMonth();
            $periodoId = $periodo?->id_periodo ?? $this->record('gnral_periodos', 'id_periodo',
                ['periodo' => 'DEMO HORARIO '.$inicio->format('Y-m')], [
                    'fecha_inicio' => $inicio->toDateString(), 'fecha_termino' => $fin->toDateString(),
                    'ciclo' => $inicio->year.'-'.$fin->year, 'year' => $inicio->year, 'siglas' => 'DEMO', 'estado' => 1,
                ]);
            if (!DB::table('in_periodos')->whereDate('fecha_inicial_periodo', '<=', $hoy)->whereDate('fecha_final_periodo', '>=', $hoy)->exists()) {
                $this->record('in_periodos', 'id_periodo_ingles', ['periodo_ingles' => 'DEMO HORARIO '.$inicio->format('Y-m')], [
                    'fecha_inicio_ingles' => $inicio->toDateString(), 'fecha_final_ingles' => $fin->toDateString(),
                    'fecha_inicial_periodo' => $inicio->toDateString(), 'fecha_final_periodo' => $fin->toDateString(),
                    'estado_actual' => 1, 'estado_historial' => 0,
                ]);
            }
            $this->record('men', 'id', ['id' => 1], ['des' => 'Entorno de pruebas']);
            foreach ([1, 2] as $id) {
                $this->record('eva_activa_evaluacion', 'id', ['id' => $id], ['estado' => 0]);
            }
            foreach ([1 => 'Alumno', 2 => 'Personal'] as $id => $description) {
                $this->record('gnral_tipos_usuario', 'id_tipo_usuario', ['id_tipo_usuario' => $id], ['descripcion' => $description]);
            }
            $this->record('gnral_semestres', 'id_semestre', ['id_semestre' => 1], ['descripcion' => 'PRIMERO']);
            $this->record('eva_status_materia', 'id_status_materia', ['id_status_materia' => 1], ['nombre_status' => 'NORMAL']);
            $this->record('eva_tipo_curso', 'id_tipo_curso', ['id_tipo_curso' => 1], ['nombre_curso' => 'NORMAL']);
            $carrera = $this->record('gnral_carreras', 'id_carrera', ['codigo_carrera' => 'DEMO-HORARIO-ISC'], [
                'nombre' => 'SISTEMAS COMPUTACIONALES - DEMO HORARIO', 'siglas' => 'DEMO-ISC', 'COLOR' => '#1565C0',
            ]);
            $reticula = $this->record('gnral_reticulas', 'id_reticula', ['clave' => 'DEMO-HORARIO', 'id_carrera' => $carrera]);
            $materia = $this->record('gnral_materias', 'id_materia', ['clave' => 'DEMO-CD', 'id_reticula' => $reticula], [
                'nombre' => 'CALCULO DIFERENCIAL - DEMO', 'id_semestre' => 1, 'hrs_teoria' => 3, 'hrs_practicas' => 2,
                'creditos' => 5, 'unidades' => 5, 'especial' => 0,
            ]);
            $departamento = $this->record('gnral_departamentos', 'id_departamento', ['nombre_departamento' => 'DEMO HORARIO']);
            $cargo = $this->record('gnral_cargos', 'id_cargo', ['cargo' => 'DOCENTE DEMO HORARIO', 'abre' => 'DEMO']);
            $perfil = $this->record('gnral_perfiles', 'id_perfil', ['descripcion' => 'DEMO HORARIO SISTEMAS']);
            $docenteUser = $this->user('docente@horario.test', 'DEMO HORARIO DOCENTE', 2);
            $docente = $this->record('gnral_personales', 'id_personal', ['tipo_usuario' => $docenteUser], [
                'nombre' => 'DOCENTE DEMO HORARIO', 'id_perfil' => $perfil, 'id_cargo' => $cargo,
                'id_departamento' => $departamento, 'esc_procedencia' => 'DEMO', 'horas_maxima' => 40,
                'correo' => 'docente@horario.test', 'telefono' => '', 'celular' => '', 'cedula' => 0,
                'sexo' => 'M', 'maximo_horas_ingles' => 0, 'numero_empleado' => 'DEMO-HORARIO',
            ]);
            $mp = $this->record('gnral_materias_perfiles', 'id_materia_perfil', ['id_personal' => $docente, 'id_materia' => $materia], ['mostrar' => 1]);
            $pc = $this->record('gnral_periodo_carreras', 'id_periodo_carrera', ['id_carrera' => $carrera, 'id_periodo' => $periodoId]);
            $h = $this->record('gnral_horarios', 'id_horario_profesor', ['id_personal' => $docente, 'id_periodo_carrera' => $pc], ['aprobado' => '0']);
            $edificio = $this->record('hrs_edificios', 'id_edificio', ['nombre' => 'EDIFICIO DEMO HORARIO']);
            $aula = $this->record('hrs_aulas', 'id_aula', ['nombre' => 'AULA DEMO HORARIO', 'id_carrera' => $carrera], ['id_edificio' => $edificio, 'comp' => 0]);
            $escuela = $this->record('gnral_escuela_procedencia', 'id_escuela_procedencia', ['nombre_escuela' => 'DEMO HORARIO'], ['estado' => 'DEMO', 'municipio' => 'DEMO']);
            $institucion = $this->record('gnral_instituciones_edu', 'id_institucion', ['cct' => 'DEMO-HORARIO'], [
                'nombre_escuela' => 'DEMO HORARIO', 'domicilio' => 'DEMO', 'municipio' => 'DEMO',
                'localidad' => 'DEMO', 'turno' => 'MATUTINO', 'servicio' => 'DEMO',
            ]);
            $seguro = $this->record('gnral_seguro_social', 'id_seguro_social', ['descripcion' => 'DEMO HORARIO']);
            foreach ([1 => '08:00-09:00', 2 => '09:00-10:00', 3 => null] as $grupo => $hora) {
                $this->record('gnral_grupos', 'id_grupo', ['grupo' => 100 + $grupo]);
                $usuario = $this->user('alumno'.$grupo.'@horario.test', 'DEMO HORARIO ALUMNO '.$grupo, 1);
                $alumno = $this->record('gnral_alumnos', 'id_alumno', ['id_usuario' => $usuario], [
                    'cuenta' => 'DEMO-HORARIO-'.$grupo, 'nombre' => 'Estudiante '.$grupo, 'apaterno' => 'Demo', 'amaterno' => 'Horario',
                    'id_carrera' => $carrera, 'id_semestre' => 1, 'grupo' => 100 + $grupo, 'estado' => 1,
                    'correo_al' => 'alumno'.$grupo.'@horario.test', 'discapacidad' => 0, 'descripcion_discapacidad' => '',
                    'lengua' => 0, 'descripcion_lengua' => '', 'id_seguro_social' => $seguro, 'numero_seguro_social' => '',
                    'id_escuela_procedencia' => $escuela, 'promedio_preparatoria' => 8, 'revalidacion' => 0,
                    'id_disponible' => 1, 's_a' => 1, 'id_institucion' => $institucion, 'folio' => 'DEMO-HORARIO-'.$grupo,
                ]);
                $this->record('eva_carga_academica', 'id_carga_academica', [
                    'id_alumno' => $alumno, 'id_materia' => $materia, 'id_periodo' => $periodoId, 'grupo' => $grupo,
                ], ['id_status_materia' => 1, 'id_tipo_curso' => 1, 'tipo_alumno' => 'DEMO HORARIO']);
                if ($hora === null) { continue; } // Caso de materia sin programación.
                $hp = $this->record('gnral_horas_profesores', 'id_hrs_profesor', [
                    'id_horario_profesor' => $h, 'id_materia_perfil' => $mp, 'grupo' => $grupo,
                ]);
                foreach (['LUNES', 'MARTES', 'MIÉRCOLES', 'JUEVES', 'VIERNES'] as $dia) {
                    // hrs_semanas no tiene AUTO_INCREMENT en el esquema original.
                    $bloque = DB::table('hrs_semanas')->where('dia', $dia)->where('hora', $hora)->value('id_semana');
                    if ($bloque === null) {
                        $bloque = (int) DB::table('hrs_semanas')->max('id_semana') + 1;
                        DB::table('hrs_semanas')->insert(['id_semana' => $bloque, 'dia' => $dia, 'hora' => $hora]);
                    }
                    $this->record('hrs_rhps', 'id_rhps', ['id_hrs_profesor' => $hp, 'id_semana' => $bloque], ['id_cargo' => $cargo, 'id_aula' => $aula]);
                }
            }
            foreach ([
                ['clave' => 'DEMO-FP', 'nombre' => 'FUNDAMENTOS DE PROGRAMACION - DEMO', 'docente' => 2,
                    'dias' => ['LUNES', 'MIÉRCOLES', 'VIERNES'], 'horas' => [1 => '10:00-11:00', 2 => '12:00-13:00']],
                ['clave' => 'DEMO-MD', 'nombre' => 'MATEMATICAS DISCRETAS - DEMO', 'docente' => 3,
                    'dias' => ['MARTES', 'JUEVES'], 'horas' => [1 => '11:00-12:00', 2 => '13:00-14:00']],
            ] as $demo) {
                $numero = $demo['docente'];
                $email = 'docente'.$numero.'@horario.test';
                $usuarioDocente = $this->user($email, 'DEMO HORARIO DOCENTE '.$numero, 2);
                $personal = $this->record('gnral_personales', 'id_personal', ['tipo_usuario' => $usuarioDocente], [
                    'nombre' => 'DOCENTE DEMO HORARIO '.$numero, 'id_perfil' => $perfil, 'id_cargo' => $cargo,
                    'id_departamento' => $departamento, 'esc_procedencia' => 'DEMO', 'horas_maxima' => 40,
                    'correo' => $email, 'telefono' => '', 'celular' => '', 'cedula' => 0, 'sexo' => 'M',
                    'maximo_horas_ingles' => 0, 'numero_empleado' => 'DEMO-HORARIO-'.$numero,
                ]);
                $asignatura = $this->record('gnral_materias', 'id_materia', ['clave' => $demo['clave'], 'id_reticula' => $reticula], [
                    'nombre' => $demo['nombre'], 'id_semestre' => 1, 'hrs_teoria' => count($demo['dias']),
                    'hrs_practicas' => 0, 'creditos' => count($demo['dias']), 'unidades' => 3, 'especial' => 0,
                ]);
                $perfilMateria = $this->record('gnral_materias_perfiles', 'id_materia_perfil',
                    ['id_personal' => $personal, 'id_materia' => $asignatura], ['mostrar' => 1]);
                $horario = $this->record('gnral_horarios', 'id_horario_profesor',
                    ['id_personal' => $personal, 'id_periodo_carrera' => $pc], ['aprobado' => '0']);
                $aulaDemo = $this->record('hrs_aulas', 'id_aula',
                    ['nombre' => 'AULA DEMO HORARIO '.$numero, 'id_carrera' => $carrera], ['id_edificio' => $edificio, 'comp' => 0]);
                foreach ([1, 2, 3] as $grupo) {
                    $usuarioAlumno = DB::table('users')->where('email', 'alumno'.$grupo.'@horario.test')->value('id');
                    $alumnoDemo = DB::table('gnral_alumnos')->where('id_usuario', $usuarioAlumno)->value('id_alumno');
                    $this->record('eva_carga_academica', 'id_carga_academica', [
                        'id_alumno' => $alumnoDemo, 'id_materia' => $asignatura, 'id_periodo' => $periodoId, 'grupo' => $grupo,
                    ], ['id_status_materia' => 1, 'id_tipo_curso' => 1, 'tipo_alumno' => 'DEMO HORARIO']);
                    if ($grupo === 3) { continue; }
                    $horasProfesor = $this->record('gnral_horas_profesores', 'id_hrs_profesor', [
                        'id_horario_profesor' => $horario, 'id_materia_perfil' => $perfilMateria, 'grupo' => $grupo,
                    ]);
                    foreach ($demo['dias'] as $dia) {
                        $hora = $demo['horas'][$grupo];
                        $bloque = DB::table('hrs_semanas')->where('dia', $dia)->where('hora', $hora)->value('id_semana');
                        if ($bloque === null) {
                            $bloque = (int) DB::table('hrs_semanas')->max('id_semana') + 1;
                            DB::table('hrs_semanas')->insert(['id_semana' => $bloque, 'dia' => $dia, 'hora' => $hora]);
                        }
                        $this->record('hrs_rhps', 'id_rhps', ['id_hrs_profesor' => $horasProfesor, 'id_semana' => $bloque],
                            ['id_cargo' => $cargo, 'id_aula' => $aulaDemo]);
                    }
                }
            }
        });
        $this->command?->info('Creados alumnos 1, 2 y 3 en @horario.test. Contraseña inicial: '.self::PASSWORD);
        $this->command?->info('Tres materias, tres docentes y veinte bloques semanales entre los grupos 1 y 2. Alumno 3: sin horario. Las contraseñas existentes se conservan.');
    }

    private function user(string $email, string $name, int $type): int
    {
        $existing = DB::table('users')->where('email', $email)->get();
        if ($existing->count() > 1 || ($existing->isNotEmpty() && ($existing[0]->name !== $name || (int) $existing[0]->tipo_usuario !== $type || $existing[0]->deleted_at !== null))) {
            throw new RuntimeException('Cuenta en conflicto: '.$email);
        }
        if ($existing->isNotEmpty()) { return (int) $existing[0]->id; }
        return $this->record('users', 'id', ['email' => $email], ['name' => $name, 'password' => Hash::make(self::PASSWORD), 'tipo_usuario' => $type, 'activated' => 1, 'info_ok' => 1]);
    }

    private function record(string $table, string $key, array $identity, array $values = []): int
    {
        $rows = DB::table($table)->where($identity)->get();
        if ($rows->count() > 1) { throw new RuntimeException('Identidad duplicada en '.$table); }
        if ($rows->isNotEmpty()) { return (int) $rows[0]->{$key}; }
        foreach (['created_at', 'updated_at'] as $column) {
            if (Schema::hasColumn($table, $column)) { $values[$column] = now(); }
        }
        $data = array_merge($values, $identity);
        if (array_key_exists($key, $identity)) {
            DB::table($table)->insert($data);
            return (int) $identity[$key];
        }
        return (int) DB::table($table)->insertGetId($data, $key);
    }
}
