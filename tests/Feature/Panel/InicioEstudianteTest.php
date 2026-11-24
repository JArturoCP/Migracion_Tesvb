<?php

namespace Tests\Feature\Panel;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Support\EscenariosPanel;
use Tests\TestCase;

final class InicioEstudianteTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:', 'database.connections.sqlite.url' => null]);
        DB::purge('sqlite');
        Schema::create('users', function (Blueprint $tabla) {
            $tabla->id();
            $tabla->string('email');
            $tabla->string('name');
            $tabla->string('password');
            $tabla->integer('tipo_usuario')->nullable();
            $tabla->timestamp('email_verified_at')->nullable();
            $tabla->rememberToken();
            $tabla->timestamps();
        });
        EscenariosPanel::crearEsquema();
        Schema::table('gnral_alumnos', function (Blueprint $tabla) {
            foreach (['cuenta', 'nombre', 'apaterno', 'amaterno'] as $campo) {
                $tabla->string($campo)->nullable();
            }
        });
        $this->withoutVite();
    }

    #[DataProvider('carreras')]
    public function test_muestra_el_tema_y_los_accesos(int $carrera, string $nombre, string $huron): void
    {
        $usuario = EscenariosPanel::preparar('alumno', ['carrera_alumno' => $carrera]);
        $usuario->tipo_usuario = 1;
        DB::table('gnral_alumnos')->where('id_usuario', $usuario->id)->update([
            'cuenta' => 'PRUEBA-001',
            'nombre' => 'Estudiante',
            'apaterno' => 'De Prueba',
        ]);
        DB::table('gnral_carreras')->insert(['id_carrera' => $carrera, 'nombre' => $nombre, 'siglas' => 'PR']);
        session(['usuario' => 'PRUEBA-001', 'carrera' => 99]);

        $this->actingAs($usuario)->get('/inicio')
            ->assertOk()
            ->assertViewIs('panel.dashboard.estudiante.inicio')
            ->assertSee('Estudiante De Prueba')
            ->assertSee($nombre)
            ->assertSee('AGO-DIC 2026')
            ->assertSee($huron)
            ->assertSee('No hay notificaciones para mostrar.')
            ->assertSee('href="'.route('checar_carga.index').'"', false)
            ->assertSee('href="'.route('alumno.horario').'"', false)
            ->assertSee('href="'.url('/calificaciones').'"', false)
            ->assertSee('href="'.route('tutorias.index').'"', false);
    }

    public static function carreras(): array
    {
        return [
            [2, 'Ingeniería en Sistemas Computacionales', 'ingenieria-sistemas.webp'],
            [3, 'Arquitectura', 'arquitectura.webp'],
        ];
    }

    #[DataProvider('vinculosInvalidos')]
    public function test_muestra_un_estado_seguro_con_ficha_invalida(bool $duplicada): void
    {
        $usuario = EscenariosPanel::preparar('alumno', []);
        $usuario->tipo_usuario = 1;
        if ($duplicada) {
            DB::table('gnral_alumnos')->insert(['id_usuario' => $usuario->id, 'nombre' => 'Dato privado']);
        } else {
            DB::table('gnral_alumnos')->where('id_usuario', $usuario->id)->delete();
    }

    $this->actingAs($usuario)->get('/inicio')
        ->assertOk()
        ->assertSee('No pudimos verificar tu registro estudiantil')
        ->assertDontSee('Dato privado')
        ->assertDontSee('Accesos rápidos')
        ->assertDontSee('panel-notificaciones-estudiante');
    }

    public static function vinculosInvalidos(): array
    {
        return [[false], [true]];
    }

    #[DataProvider('otrosPerfiles')]
    public function test_mantiene_el_inicio_para_otros_perfiles(string $rol): void
    {
        $usuario = EscenariosPanel::preparar($rol, []);
        $usuario->tipo_usuario = 2;
        session(['palumno' => true]);

        $this->actingAs($usuario)->get('/inicio')
            ->assertOk()
            ->assertViewIs('panel.inicio')
            ->assertDontSee('data-panel-estudiante', false)
            ->assertDontSee('panel-notificaciones-estudiante');
    }

    public static function otrosPerfiles(): array
    {
        return [['docente'], ['escolar']];
    }
}
