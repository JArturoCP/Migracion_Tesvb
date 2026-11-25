<?php

use App\Alumnos;
use App\Models\User;
use App\Services\EdadAlumno;
use App\Tutor;
use App\Tutorias_Exp_antecedentes_academico;
use App\Tutorias_Exp_area_psicopedagogica;
use App\Tutorias_Exp_datos_familiare;
use App\Tutorias_Exp_formacion_integral;
use App\Tutorias_Exp_generale;
use App\Tutorias_Exp_habitos_estudio;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

it('calcula años cumplidos con la fecha civil institucional', function (?string $fecha, ?int $edad) {
    $this->travelTo(Carbon::parse('2026-03-01 05:30:00', 'UTC'), function () use ($fecha, $edad) {
        expect(EdadAlumno::calcular($fecha))->toBe($edad);
    });
})->with([
    ['2000-02-27', 26],
    ['2000-02-28', 26],
    ['2000-03-01', 25],
    ['29/02/2004', 21],
    ['2001-02-29', null],
    ['2026-03-01', null],
    ['0000-00-00', null],
    ['', null],
    [null, null],
]);

it('guarda los datos propios y calcula la edad con las fechas autorizadas de cada formulario', function () {
    $secciones = [
        'generales' => new Tutorias_Exp_generale,
        'academicos' => new Tutorias_Exp_antecedentes_academico,
        'familiares' => new Tutorias_Exp_datos_familiare,
        'estudio' => new Tutorias_Exp_habitos_estudio,
        'integral' => new Tutorias_Exp_formacion_integral,
        'area' => new Tutorias_Exp_area_psicopedagogica,
    ];

    foreach ([new Alumnos, new Tutor, ...array_values($secciones)] as $modelo) {
        Schema::create($modelo->getTable(), function (Blueprint $tabla) use ($modelo) {
            $tabla->increments($modelo->getKeyName());
            foreach ($modelo->getFillable() as $campo) {
                $tabla->string($campo)->nullable();
            }
            $tabla->timestamps();
        });
    }

    Schema::create('users', function (Blueprint $tabla) {
        $tabla->id();
        $tabla->integer('info_ok')->nullable();
        $tabla->softDeletes();
        $tabla->timestamps();
    });

    $usuario = new User;
    $usuario->forceFill(['id' => 1, 'tipo_usuario' => 1, 'email' => 'demo@example.test']);
    DB::table('users')->insert(['id' => 1]);
    Alumnos::create(['id_usuario' => 1, 'fecha_nac' => '2004-02-29', 'edad' => 5, 'cuenta' => 'DEMO1',
        'correo_al' => 'demo@example.test', 'id_semestre' => 4]);
    Alumnos::create(['id_usuario' => 2, 'cuenta' => 'DEMO2']);
    Tutor::create(['id_alumno' => 1]);
    Tutor::create(['id_alumno' => 2]);

    $expediente = [];
    foreach ($secciones as $seccion => $modelo) {
        $propio = $modelo->create(['id_alumno' => 1]);
        $modelo->create(['id_alumno' => 2]);
        $expediente[$seccion] = [$modelo->getKeyName() => $propio->getKey()];
    }

    $this->actingAs($usuario)->withSession(['id_alumno' => 1, 'periodo_actual' => 3]);
    $this->travelTo(Carbon::parse('2026-03-01 12:00:00', 'America/Mexico_City'));
    $expediente['generales'] += [
        'id_alumno' => 2, 'edad' => 99, 'fecha_nacimientos' => '1990-01-01', 'no_cuenta' => 'OTRA',
        'id_periodo' => 9, 'id_semestre' => 9, 'direccion' => 'Domicilio ficticio',
    ];
    $ajeno = $expediente;
    $ajeno['area']['id_exp_area_psicopedagogica'] = 2;
    $this->postJson('/tutorias/actualiza', ['alu' => $ajeno])->assertNotFound();
    $this->assertDatabaseHas('exp_generales', ['id_alumno' => 1, 'direccion' => null]);

    $this->postJson('/tutorias/actualiza', ['alu' => $expediente])->assertOk();
    $this->assertDatabaseHas('exp_generales', [
        'id_alumno' => 1, 'edad' => 22, 'fecha_nacimientos' => '2004-02-29', 'no_cuenta' => 'DEMO1',
        'id_periodo' => 3, 'id_semestre' => 4, 'direccion' => 'Domicilio ficticio',
    ]);

    $datos = [
        'id' => 1, 'id_tutor' => 1, 'fecha_nac' => '01/03/2005', 'fecha_nac_tutor' => '1980-01-01',
        'cuenta' => 'OTRA', 'edadalu' => 99, 'correoalu' => 'otro@example.test', 'edad_tutor' => 99,
    ];
    $this->postJson('/datos_alumno', ['id' => 2] + $datos)->assertNotFound();
    $this->postJson('/datos_alumno', ['id_tutor' => 2] + $datos)->assertNotFound();
    $this->postJson('/datos_alumno', ['fecha_nac' => '2026-03-02'] + $datos)
        ->assertUnprocessable()->assertJsonValidationErrors('fecha_nac');
    $this->postJson('/datos_alumno', $datos)->assertOk();
    $this->assertDatabaseHas('gnral_alumnos', [
        'id_alumno' => 1, 'fecha_nac' => '2005-03-01', 'edad' => 21,
        'cuenta' => 'DEMO1', 'correo_al' => 'demo@example.test',
    ]);
    $this->assertDatabaseHas('eva_tutor', ['id_alumno' => 1, 'edad' => 46]);
    $this->travelBack();
});
