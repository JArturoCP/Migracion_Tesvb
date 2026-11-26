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
        Schema::create('cal_actividades_complementarias', function (Blueprint $tabla) {
            $tabla->integer('id_alumno');
            $tabla->string('cal');
            $tabla->string('clave');
        });
        $this->withoutVite();
    }

    #[DataProvider('carreras')]
    public function test_muestra_el_tema_y_los_accesos(int $carrera, string $nombre, string $huron, string $logo, bool $disponible = true): void
    {
        $usuario = EscenariosPanel::preparar('alumno', ['carrera_alumno' => $carrera]);
        $usuario->tipo_usuario = 1;
        DB::table('gnral_alumnos')->where('id_usuario', $usuario->id)->update([
            'cuenta' => 'PRUEBA-001',
            'nombre' => 'Estudiante',
            'apaterno' => 'De Prueba',
            'id_semestre' => 42,
        ]);
        DB::table('gnral_carreras')->insert(['id_carrera' => $carrera, 'nombre' => $nombre, 'siglas' => 'PR']);
        DB::table('gnral_semestres')->insert(['id_semestre' => 42, 'descripcion' => 'Semestre de prueba']);
        $ficha = DB::table('gnral_alumnos')->where('id_usuario', $usuario->id)->value('id_alumno');
        DB::table('cal_actividades_complementarias')->insert([
            ['id_alumno' => $ficha, 'cal' => 'ACA', 'clave' => 'ACC-0001'],
            ['id_alumno' => $ficha + 1, 'cal' => 'OTRO', 'clave' => 'OTRA'],
        ]);
        session(['usuario' => 'PRUEBA-001', 'carrera' => 99]);

        if (!$disponible) {
            config(['tesvb_themes.careers.2.logo' => 'img/logos_carreras/ausente.webp']);
        }

        $respuesta = $this->actingAs($usuario)->get('/inicio')
            ->assertOk()
            ->assertViewIs('panel.dashboard.estudiante.inicio')
            ->assertSee('Estudiante De Prueba')
            ->assertSee($nombre)
            ->assertSee('AGO-DIC 2026')
            ->assertSee($huron)
            ->assertSee('Semestre de prueba')
            ->assertSee('Mi progreso académico')
            ->assertSeeText('260 créditos requeridos')
            ->assertSeeText('5 de 5 acreditados')
            ->assertSee('Avance por verificar')
            ->assertSee('No hay notificaciones para mostrar.')
            ->assertSee('href="'.route('checar_carga.index').'"', false)
            ->assertSee('href="'.route('alumno.horario').'"', false)
            ->assertSee('href="'.url('/calificaciones').'"', false)
            ->assertSee('href="'.route('tutorias.index').'"', false);

        if ($disponible) {
            $respuesta->assertSee('src="'.asset('img/logos_carreras/'.$logo).'" class="td-logo"', false);
            $this->assertSame(IMAGETYPE_WEBP, getimagesize(public_path('img/logos_carreras/'.$logo))[2]);
        } else {
            $respuesta->assertDontSee('class="td-logo"', false)
                ->assertDontSee('ausente.webp');
        }
    }

    #[DataProvider('acreditaciones')]
    public function test_distingue_ausencia_de_acreditacion_y_registros_inconsistentes(array $registros, string $estado): void
    {
        $usuario = EscenariosPanel::preparar('alumno', ['carrera_alumno' => 4]);
        $usuario->tipo_usuario = 1;
        $ficha = DB::table('gnral_alumnos')->where('id_usuario', $usuario->id)->value('id_alumno');
        DB::table('gnral_carreras')->insert(['id_carrera' => 4, 'nombre' => 'Ingeniería Electrónica', 'siglas' => 'IE']);
        foreach ($registros as [$calificacion, $clave]) {
            DB::table('cal_actividades_complementarias')->insert([
                'id_alumno' => $ficha, 'cal' => $calificacion, 'clave' => $clave,
            ]);
        }
        DB::table('cal_actividades_complementarias')->insert([
            'id_alumno' => $ficha + 1, 'cal' => 'ACA', 'clave' => 'ACC-0001',
        ]);

        $this->actingAs($usuario)->get('/inicio')
            ->assertOk()
            ->assertSee('Ingeniería Electrónica')
            ->assertSee($estado)
            ->assertDontSee('ingenieria-electrica.webp')
            ->assertDontSeeText('5 de 5 acreditados');
    }

    public static function acreditaciones(): array
    {
        return [
            'sin registro' => [[], 'Sin acreditación registrada'],
            'valor no reconocido' => [[['Cal actividades complementarias 1', 'CLV-001']], 'Acreditación por verificar'],
            'duplicada' => [[['ACA', 'ACC-0001'], ['ACA', 'ACC-0001']], 'Acreditación por verificar'],
        ];
    }

    public static function carreras(): array
    {
        return [
            [1, 'INGENIERÍA EN SISTEMAS COMPUTACIONALES', 'ingenieria-sistemas.webp', 'sistemas.webp'],
            [2, 'Ingeniería en Sistemas Computacionales', 'ingenieria-sistemas.webp', 'sistemas.webp'],
            [3, 'Arquitectura', 'arquitectura.webp', 'arquitectura.webp'],
            [31, 'Licenciatura en Administración', 'administracion.webp', 'administracion.webp'],
            [32, 'Ingeniería Eléctrica', 'ingenieria-electrica.webp', 'electrica.webp'],
            [33, 'Ingeniería Industrial', 'ingenieria-industrial.webp', 'industrial.webp'],
            [34, 'Ingeniería Forestal', 'ingenieria-forestal.webp', 'forestal.webp'],
            [35, 'Licenciatura en Gastronomía', 'gastronomia.webp', 'gastronomia.webp'],
            [36, 'Licenciatura en Turismo', 'turismo.webp', 'turismo.webp'],
            [37, 'Ingeniería Mecatrónica', 'ingenieria-mecatronica.webp', 'mecatronica.webp'],
            [38, 'Ingeniería Civil', 'ingenieria-civil.webp', 'civil.webp'],
            'logo ausente' => [2, 'Ingeniería en Sistemas Computacionales', 'ingenieria-sistemas.webp', 'sistemas.webp', false],
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
