<?php

use App\calEvaluaciones;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\Support\EscenariosPanel;

beforeEach(function () {
    expect(config('database.default'))->toBe('sqlite')
        ->and(config('database.connections.sqlite.database'))->toBe(':memory:');
    $this->withoutVite();
    EscenariosPanel::crearEsquema();
    foreach ([
        'gnral_materias' => 'id_materia,nombre,unidades,id_semestre,creditos,clave',
        'eva_status_materia' => 'id_status_materia,nombre_status',
        'eva_tipo_curso' => 'id_tipo_curso,nombre_curso',
        'gnral_grupos' => 'id_grupo',
        'gnral_materias_perfiles' => 'id_materia_perfil,id_materia',
        'gnral_horas_profesores' => 'id_hrs_profesor,id_materia_perfil,id_horario_profesor,grupo',
        'cal_unidades' => 'id_unidad,abreviacion',
        'cal_servicio_social' => 'id_servicio_social,id_alumno,calificacion',
        'resi_anteproyecto' => 'id_anteproyecto,id_alumno',
        'resi_asesores' => 'id_anteproyecto,id_periodo',
        'resi_promedio_general_residencia' => 'id_anteproyecto,promedio_general',
        'cal_residencia' => 'id_cal_residencia,id_alumno',
        'cal_actividades_complementarias' => 'id_actividades_comple,id_alumno',
        'gnral_unidad_personal' => 'id_personal,id_unidad_admin',
        'in_periodos' => 'id_periodo_ingles,periodo_ingles',
        'in_niveles_ingles' => 'id_niveles_ingles,descripcion',
        'in_carga_academica_ingles' => 'id_carga_ingles,id_alumno,id_periodo_ingles,id_nivel,id_grupo,estado_nivel',
        'in_evaluar_calificacion' => 'id_carga_ingles,id_unidad,calificacion',
    ] as $tabla => $columnas) {
        if (!Schema::hasTable($tabla)) {
            $columnas = preg_replace('/\bid_\w+\b/', '$0 INTEGER', $columnas);
            DB::statement("CREATE TABLE $tabla ($columnas)");
        }
    }
    foreach ([
        'eva_carga_academica' => ['id_materia', 'id_tipo_curso', 'grupo'],
        'cal_evaluaciones' => ['id_unidad', 'esc'],
    ] as $tabla => $columnas) {
        Schema::table($tabla, function (Blueprint $definicion) use ($columnas) {
            foreach ($columnas as $columna) {
                $definicion->integer($columna)->nullable();
            }
        });
    }
    Schema::table('gnral_periodos', function (Blueprint $tabla) {
        $tabla->string('siglas')->nullable();
        $tabla->integer('year')->nullable();
    });
    Schema::table('eva_carga_academica', function (Blueprint $tabla) {
        $tabla->string('tipo_alumno')->nullable();
    });
    Schema::table('cal_evaluaciones', function (Blueprint $tabla) {
        $tabla->timestamps();
    });
    Schema::table('gnral_alumnos', function (Blueprint $tabla) {
        foreach (['nombre', 'apaterno', 'amaterno', 'cuenta', 'folio'] as $columna) {
            $tabla->string($columna)->nullable();
        }
    });
    DB::table('eva_status_materia')->insert(['id_status_materia' => 1, 'nombre_status' => 'Prueba']);
    DB::table('gnral_grupos')->insert(['id_grupo' => 1]);
    foreach (['NORMAL', 'REPETICION', 'ESPECIAL', 'GLOBAL'] as $indice => $curso) {
        DB::table('eva_tipo_curso')->insert(['id_tipo_curso' => $indice + 1, 'nombre_curso' => $curso]);
    }
    foreach ([1 => 92, 2 => 34, 3 => 57, 4 => 76] as $unidad => $id) {
        DB::table('cal_unidades')->insert(['id_unidad' => $id, 'abreviacion' => "U$unidad"]);
    }

    $this->alumnoCalificaciones = EscenariosPanel::preparar('alumno', ['semestre' => 5]);
    $this->alumnoCalificaciones->tipo_usuario = 1;
    $this->idAlumnoCalificaciones = DB::table('gnral_alumnos')
        ->where('id_usuario', $this->alumnoCalificaciones->id)->value('id_alumno');
    DB::table('eva_validacion_de_cargas')->insert([
        'id_alumno' => $this->idAlumnoCalificaciones, 'id_periodo' => 10, 'estado_validacion' => 2,
    ]);
    $this->withSession(['ip' => 'http://localhost', 'usuario' => 'PRUEBA']);
});

function materiaDePrueba(int $alumno, array $notas, int $curso = 1, int $materia = 100, int $unidades = 3): void
{
    DB::table('gnral_materias')->insert([
        'id_materia' => $materia, 'nombre' => "Materia de prueba $materia",
        'unidades' => $unidades, 'id_semestre' => 5, 'creditos' => 5,
    ]);
    DB::table('eva_carga_academica')->insert([
        'id_carga_academica' => $materia, 'id_alumno' => $alumno, 'id_periodo' => 10,
        'id_materia' => $materia, 'id_status_materia' => 1, 'id_tipo_curso' => $curso, 'grupo' => 1,
    ]);
    foreach ($notas as [$unidad, $nota, $esc]) {
        calEvaluaciones::create([
            'id_carga_academica' => $materia, 'id_unidad' => $unidad,
            'calificacion' => $nota, 'esc' => $esc,
        ]);
    }
}

function celdasCalificaciones(string $html): array
{
    $dom = new DOMDocument();
    @$dom->loadHTML('<?xml encoding="UTF-8">'.$html);
    $filas = (new DOMXPath($dom))->query('//table[@aria-label="Calificaciones por materia y unidad"]/tbody/tr');
    $resultado = [];
    foreach ($filas as $fila) {
        $celdas = [];
        foreach ($fila->childNodes as $celda) {
            if ($celda instanceof DOMElement) {
                $celdas[] = trim(preg_replace('/\s+/u', ' ', $celda->textContent));
            }
        }
        $resultado[] = $celdas;
    }

    return $resultado;
}

it('ubica las unidades por ordinal y distingue los estados con las mismas fórmulas', function ($notas, $unidades, $promedio, $curso, $tipo, $interno) {
    materiaDePrueba($this->idAlumnoCalificaciones, $notas, $curso);
    $respuesta = $this->actingAs($this->alumnoCalificaciones)->get('/calificaciones')
        ->assertOk()->assertSee('tabindex="0"', false);
    expect(celdasCalificaciones($respuesta->getContent()))->toBe([
        ['Materia de prueba 100', ...$unidades, $promedio, $tipo],
    ])->and($respuesta->viewData('array_materias')[0]['promedio'])->toBe($interno);
})->with([
    'completas fuera de orden, 70 y 100' => [[[57,100,0],[92,70,0],[34,81,0]], ['70','81','100'], '84', 1, 'O', 84],
    '69' => [[[92,69,0],[34,80,0],[57,90,0]], ['N.A.','80','90'], 'N.A.', 1, 'ESC', 0],
    'cero registrado con huecos' => [[[92,0,0]], ['N.A.','Pend.','Pend.'], 'N.A. Evaluaciones pendientes', 1, 'ESC', 0],
    'sin evaluaciones' => [[], ['Pend.','Pend.','Pend.'], 'Sin evaluaciones', 1, 'O', 0],
    'falta la primera' => [[[34,81,0]], ['Pend.','81','Pend.'], '81 Evaluaciones pendientes', 1, 'O', 81],
    'falta la intermedia' => [[[92,80,0],[57,90,0]], ['80','Pend.','90'], '85 Evaluaciones pendientes', 2, 'O2', 85],
    'falta la última' => [[[92,70,0],[34,71,0]], ['70','71','Pend.'], '71 Evaluaciones pendientes', 2, 'O2', 71],
    'complementación' => [[[92,80,1],[34,90,0],[57,100,0]], ['80','90','100'], '90', 1, 'ESC', 90],
    'complementación en repetición' => [[[92,80,1],[34,90,0],[57,100,0]], ['80','90','100'], '90', 2, 'ESC2', 90],
    'duplicado' => [[[34,80,0],[34,90,0]], ['Pend.','Por verificar','Pend.'], 'Por verificar', 1, 'O', 85],
    'unidad sin entrada de catálogo' => [[[99,80,0]], ['Pend.','Pend.','Pend.'], 'Por verificar', 1, 'O', 80],
    'nota nula en un registro heredado' => [[[92,null,0]], ['Por verificar','Pend.','Pend.'], 'Por verificar', 1, 'ESC', 0],
    'excedente' => [[[92,80,0],[76,90,0]], ['80','Pend.','Pend.'], 'Por verificar', 1, 'O', 85],
    'curso especial' => [[[92,80,0]], ['80','Pend.','Pend.'], '80 Evaluaciones pendientes', 3, 'CE', 80],
    'examen global' => [[[92,80,0]], ['80','Pend.','Pend.'], '80 Evaluaciones pendientes', 4, 'EG', 80],
]);

it('conserva la media general y diferencia una unidad no aplicable', function () {
    materiaDePrueba($this->idAlumnoCalificaciones, [[92, 90, 0]], unidades: 1);
    materiaDePrueba($this->idAlumnoCalificaciones, [], materia: 101);
    $respuesta = $this->actingAs($this->alumnoCalificaciones)->get('/calificaciones')
        ->assertOk()->assertSee('45.00')->assertSee('No hay docentes para mostrar');
    expect(celdasCalificaciones($respuesta->getContent())[0])->toBe([
        'Materia de prueba 100', '90', '—', '—', '90', 'O',
    ]);
});

it('muestra docentes aunque la materia se separe como residencia', function () {
    materiaDePrueba($this->idAlumnoCalificaciones, [], materia: 773);
    DB::table('gnral_personales')->insert(['id_personal' => 800, 'nombre' => 'Docente ficticio']);
    DB::table('gnral_periodo_carreras')->insert(['id_periodo_carrera' => 81, 'id_periodo' => 10, 'id_carrera' => 1]);
    DB::table('gnral_horarios')->insert(['id_horario_profesor' => 81, 'id_periodo_carrera' => 81, 'id_personal' => 800]);
    DB::table('gnral_materias_perfiles')->insert(['id_materia_perfil' => 81, 'id_materia' => 773]);
    DB::table('gnral_horas_profesores')->insert(['id_hrs_profesor' => 81, 'id_horario_profesor' => 81, 'id_materia_perfil' => 81, 'grupo' => 1]);
    $this->actingAs($this->alumnoCalificaciones)->get('/calificaciones')->assertOk()
        ->assertSee('Sin materias para mostrar')->assertSee('Docente ficticio')
        ->assertSee('Registro de autorización del anteproyecto');
});

it('conserva el promedio de servicio social y su estado sin registro', function () {
    materiaDePrueba($this->idAlumnoCalificaciones, [], materia: 2258);
    $this->actingAs($this->alumnoCalificaciones)->get('/calificaciones')
        ->assertOk()->assertSee('Pendiente de registro');
    DB::table('cal_servicio_social')->insert([
        'id_servicio_social' => 1, 'id_alumno' => $this->idAlumnoCalificaciones, 'calificacion' => 94,
    ]);
    $this->get('/calificaciones')->assertOk()->assertSee('94.00')->assertDontSee('Pendiente de registro');
});

it('restringe la consulta al estudiante autenticado y su ficha', function () {
    $this->get('/calificaciones')->assertRedirect();
    $otro = User::factory()->create();
    $otro->tipo_usuario = 2;
    $this->actingAs($otro)->get('/calificaciones')->assertForbidden();
    $otro->tipo_usuario = 1;
    $this->get('/calificaciones')->assertForbidden();
    $fichaAjena = DB::table('gnral_alumnos')->insertGetId(['id_usuario' => $otro->id]);
    DB::table('eva_validacion_de_cargas')->insert(['id_alumno' => $fichaAjena, 'id_periodo' => 10, 'estado_validacion' => 2]);
    materiaDePrueba($fichaAjena, [[92, 99, 0]], materia: 201);
    $this->actingAs($this->alumnoCalificaciones)->withSession(['usuario_alumno' => $otro->id])
        ->get('/calificaciones?id_alumno='.$fichaAjena)->assertOk()->assertDontSee('Materia de prueba 201')
        ->assertSee('Sin materias para mostrar')->assertSee('No hay docentes para mostrar');
    $this->get('/periodo/999999')->assertNotFound()->assertSessionHas('periodo_actual', 10);
    $this->withSession(['periodo_actual' => 999999])->get('/calificaciones')->assertForbidden();
});

it('mantiene los estados de validación de carga del periodo', function (int $estado, bool $visible) {
    materiaDePrueba($this->idAlumnoCalificaciones, [[92, 100, 0]], unidades: 1);
    DB::table('eva_validacion_de_cargas')->update(['estado_validacion' => $estado]);
    $respuesta = $this->actingAs($this->alumnoCalificaciones)->get('/calificaciones')->assertOk();
    if ($visible) {
        $respuesta->assertSee('Materia de prueba 100');
    } else {
        $respuesta->assertSee('Carga académica pendiente')->assertDontSee('Materia de prueba 100');
    }
})->with([[2, true], [8, true], [9, true], [10, false]]);

it('renderiza los diez identificadores de carrera ficticios', function (int $carrera) {
    DB::table('gnral_alumnos')->where('id_alumno', $this->idAlumnoCalificaciones)->update(['id_carrera' => $carrera]);
    materiaDePrueba($this->idAlumnoCalificaciones, [[92, 100, 0]], unidades: 1);
    $this->actingAs($this->alumnoCalificaciones)->withSession(['carrera' => $carrera, 'id_carrera' => $carrera])
        ->get('/calificaciones')->assertOk()->assertSee('100.00');
})->with(range(1, 10));

it('reserva la boleta de inglés al titular y a su coordinación', function () {
    $alumno = $this->idAlumnoCalificaciones;
    DB::table('gnral_alumnos')->where('id_alumno', $alumno)->update([
        'nombre' => 'Estudiante', 'apaterno' => 'Ficticio', 'amaterno' => 'Prueba', 'cuenta' => 'FICTICIA', 'folio' => '123',
    ]);
    DB::table('gnral_carreras')->insert(['id_carrera' => 1, 'nombre' => 'Carrera ficticia']);
    DB::table('in_periodos')->insert(['id_periodo_ingles' => 12, 'periodo_ingles' => 'Periodo ficticio']);
    DB::table('in_niveles_ingles')->insert(['id_niveles_ingles' => 1, 'descripcion' => 'Nivel ficticio']);
    DB::table('in_carga_academica_ingles')->insert([
        'id_carga_ingles' => 1, 'id_alumno' => $alumno, 'id_periodo_ingles' => 12,
        'id_nivel' => 1, 'id_grupo' => 1, 'estado_nivel' => 1,
    ]);
    $url = "/ingles/imprimir_calificacion_ingles_alumno/$alumno";
    $this->actingAs($this->alumnoCalificaciones)->get($url)->assertOk()->assertHeader('Content-Type', 'application/pdf');
    $otro = User::factory()->create();
    $otro->tipo_usuario = 1;
    $this->actingAs($otro)->withSession(['id_unidad_admin' => 19])->get($url)->assertForbidden();
    $otro->tipo_usuario = 2;
    $this->withSession(['id_unidad_admin' => 1])->get($url)->assertForbidden();
    $this->withSession(['id_unidad_admin' => 19])->get($url)->assertForbidden();
    DB::table('gnral_personales')->insert(['id_personal' => 801, 'tipo_usuario' => $otro->id]);
    DB::table('gnral_unidad_personal')->insert(['id_personal' => 801, 'id_unidad_admin' => 19]);
    $this->get($url)->assertOk()->assertHeader('Content-Type', 'application/pdf');
});

it('requiere el rol de control escolar para consultar un historial y controla fichas inexistentes', function () {
    $url = '/servicios_escolares/historial_academico/pdf_historial_academico/999999/1/1/1';
    $this->actingAs($this->alumnoCalificaciones)->withSession(['escolar' => true])->get($url)->assertForbidden();
    $personal = User::factory()->create();
    $personal->tipo_usuario = 2;
    $this->actingAs($personal)->withSession(['escolar' => false])->get($url)->assertForbidden();
    $this->withSession(['escolar' => true])->get($url)->assertForbidden();
    DB::table('gnral_personales')->insert(['id_personal' => 803, 'tipo_usuario' => $personal->id, 'id_departamento' => 5]);
    $this->get($url)->assertNotFound();

    $alumno = $this->idAlumnoCalificaciones;
    DB::table('gnral_alumnos')->where('id_alumno', $alumno)->update([
        'nombre' => 'Estudiante', 'apaterno' => 'Ficticio', 'amaterno' => 'Prueba', 'cuenta' => 'FICTICIA', 'folio' => '123',
    ]);
    DB::table('gnral_carreras')->insert(['id_carrera' => 1, 'nombre' => 'Carrera ficticia']);
    $this->withSession(['periodotrabaja' => 21])
        ->get("/servicios_escolares/historial_academico/pdf_historial_academico/$alumno/Plan/Especialidad/1")
        ->assertOk()->assertHeader('Content-Type', 'application/pdf');
});
