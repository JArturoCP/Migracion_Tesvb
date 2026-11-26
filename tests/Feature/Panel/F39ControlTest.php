<?php

namespace Tests\Feature\Panel;

use Illuminate\Auth\GenericUser;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Process\Process;

final class F39ControlTest extends TestCase
{
    public static function casos(): array
    {
        return [
            'sin sesión' => ['invitado', 403],
            'estudiante titular' => ['titular', 403],
            'estudiante ajeno' => ['ajeno', 403],
            'personal de otro departamento' => ['departamento', 403],
            'departamento asignado a otra cuenta' => ['otroPersonal', 403],
            'sin periodo activo' => ['sinSesionPeriodo', 422],
            'id inválido' => ['idInvalido', 404],
            'sin validación del periodo' => ['otraValidacion', 404],
            'carga pendiente' => ['pendiente', 403],
            'sin alumno' => ['sinAlumno', 404],
            'sin programa' => ['sinCarrera', 404],
            'sin ciclo' => ['sinCiclo', 404],
            'departamento 1 y estado 2' => ['aceptada', 200],
            'departamento 5 y estado 8' => ['estado8', 200],
            'estado 9' => ['estado9', 200],
        ];
    }

    #[DataProvider('casos')]
    public function test_acceso_y_formato(string $caso, int $estado): void
    {
        // El controlador institucional finaliza con exit después de enviar el PDF.
        $programa = 'require "vendor/autoload.php"; require $argv[1]; '
            . 'Tests\Feature\Panel\F39ControlTest::imprimir($argv[2]);';
        $proceso = new Process([PHP_BINARY, '-r', $programa, __FILE__, $caso], dirname(__DIR__, 3));
        $proceso->mustRun();
        $salida = $proceso->getOutput();
        if ($estado !== 200) {
            self::assertSame((string) $estado, $salida);
            return;
        }

        self::assertStringStartsWith('%PDF-', $salida);
        // Huella del F39 restaurado en 5619122, incluida su imagen institucional.
        $estable = preg_replace("~(/CreationDate \\(D:)[^)]*\\)~", '$1FECHA)', $salida, 1, $fechas);
        self::assertSame(1, $fechas);
        self::assertSame('65a5473cbcac6b906fe1de5b8da4516cdbeebd4364048f09e478f6a7a2e46541', hash('sha256', $estable));
    }

    public static function imprimir(string $caso): void
    {
        $app = require 'bootstrap/app.php';
        $app->make(Kernel::class)->bootstrap();
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:',
            'database.connections.sqlite.url' => null, 'session.driver' => 'array']);
        DB::purge('sqlite');
        $db = DB::connection('sqlite');
        $db->unprepared(<<<'SQL'
            CREATE TABLE gnral_personales (tipo_usuario INTEGER, id_departamento INTEGER);
            CREATE TABLE gnral_alumnos (id_alumno INTEGER, id_usuario INTEGER, id_carrera INTEGER, cuenta TEXT, nombre TEXT, apaterno TEXT, amaterno TEXT);
            CREATE TABLE gnral_periodos (id_periodo INTEGER, periodo TEXT);
            CREATE TABLE gnral_carreras (id_carrera INTEGER, nombre TEXT);
            CREATE TABLE eva_validacion_de_cargas (id_alumno INTEGER, id_periodo INTEGER, estado_validacion INTEGER);
            CREATE TABLE etiqueta (id_etiqueta INTEGER);
            CREATE TABLE gnral_materias (id_materia INTEGER, clave TEXT, nombre TEXT, id_semestre INTEGER, creditos INTEGER);
            CREATE TABLE eva_status_materia (id_status_materia INTEGER, nombre_status TEXT);
            CREATE TABLE eva_tipo_curso (id_tipo_curso INTEGER, nombre_curso TEXT);
            CREATE TABLE gnral_grupos (id_grupo INTEGER);
            CREATE TABLE eva_carga_academica (id_carga_academica INTEGER, id_materia INTEGER, id_status_materia INTEGER, id_tipo_curso INTEGER, grupo INTEGER, id_periodo INTEGER, id_alumno INTEGER);
            INSERT INTO gnral_personales VALUES (10,1);
            INSERT INTO gnral_alumnos VALUES (7,20,1,'DEMO','Alumno','De','Prueba');
            INSERT INTO gnral_periodos VALUES (1,'Ciclo de prueba');
            INSERT INTO gnral_carreras VALUES (1,'Programa de prueba');
            INSERT INTO eva_validacion_de_cargas VALUES (7,1,2);
            INSERT INTO gnral_materias VALUES (1,'MAT-1','Materia con créditos',1,5),(2258,'SS','Servicio social',1,0);
            INSERT INTO eva_status_materia VALUES (1,'Regular');
            INSERT INTO eva_tipo_curso VALUES (1,'Ordinario');
            INSERT INTO gnral_grupos VALUES (1);
            INSERT INTO eva_carga_academica VALUES (1,1,1,1,1,1,7),(2,2258,1,1,1,1,7);
            SQL);
        match ($caso) {
            'sinAlumno' => $db->table('gnral_alumnos')->delete(),
            'sinCarrera' => $db->table('gnral_carreras')->delete(),
            'sinCiclo' => $db->table('gnral_periodos')->delete(),
            'otraValidacion' => $db->table('eva_validacion_de_cargas')->update(['id_periodo' => 2]),
            'otroPersonal' => $db->table('gnral_personales')->update(['tipo_usuario' => 99]),
            'departamento' => $db->table('gnral_personales')->update(['id_departamento' => 99]),
            'estado8' => $db->table('gnral_personales')->update(['id_departamento' => 5]),
            default => null,
        };
        $db->table('eva_validacion_de_cargas')->update(['estado_validacion' => match ($caso) {
            'pendiente' => 0, 'estado8' => 8, 'estado9' => 9, default => 2,
        }]);
        if ($caso !== 'sinSesionPeriodo') {
            Session::put('periodo_actual', 1);
        }
        if ($caso !== 'invitado') {
            $alumno = in_array($caso, ['titular', 'ajeno'], true);
            Auth::setUser(new GenericUser(['id' => $alumno ? ($caso === 'titular' ? 20 : 21) : 10,
                'tipo_usuario' => $alumno ? 1 : 2]));
        }
        $id = $caso === 'idInvalido' ? 'abc' : '7';
        $ruta = $app['router']->getRoutes()->match(Request::create('/imprime_control/'.$id));
        self::assertContains('auth', $ruta->gatherMiddleware());
        chdir(public_path());
        try {
            $ruta->run();
        } catch (HttpExceptionInterface $e) {
            echo $e->getStatusCode();
        }
    }
}
