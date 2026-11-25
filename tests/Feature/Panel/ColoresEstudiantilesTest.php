<?php

namespace Tests\Feature\Panel;

use Illuminate\Auth\GenericUser;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

final class ColoresEstudiantilesTest extends TestCase
{
    #[DataProvider('casos')]
    public function test_aplica_el_tema_automaticamente_solo_con_ficha_valida(
        int $tipo, ?string $carrera, ?string $color, bool $duplicada = false,
    ): void {
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:', 'database.connections.sqlite.url' => null]);
        DB::purge('sqlite');
        Schema::create('gnral_alumnos', function (Blueprint $tabla) {
            $tabla->id('id_alumno');
            $tabla->integer('id_usuario');
            $tabla->integer('id_carrera');
        });
        Schema::create('gnral_carreras', function (Blueprint $tabla) {
            $tabla->id('id_carrera');
            $tabla->string('nombre');
        });
        $this->actingAs(new GenericUser(['id' => 7, 'tipo_usuario' => $tipo]));
        if ($carrera !== null) {
            DB::table('gnral_carreras')->insert(['id_carrera' => 99, 'nombre' => $carrera]);
            DB::table('gnral_alumnos')->insert(['id_usuario' => 7, 'id_carrera' => 99]);
        }

        if ($duplicada) {
            DB::table('gnral_alumnos')->insert(['id_usuario' => 7, 'id_carrera' => 99]);
        }

        DB::enableQueryLog();
        $vista = "@include('partials.panel.tema_estudiantil')";
        $html = Blade::render($vista);
        self::assertSame($html, Blade::render($vista));
        self::assertCount($tipo === 1 ? 1 : 0, DB::getQueryLog());

        if ($color === null) {
            self::assertStringNotContainsString('tesvb-colores-estudiantiles', $html);
        } else {
            self::assertStringContainsString('--tema-visual-color: '.$color, $html);
        }
    }

    public function test_el_panel_no_publica_rutas_de_preferencias(): void
    {
        self::assertFalse(\Illuminate\Support\Facades\Route::has('alumno.apariencia.edit'));
        self::assertFalse(\Illuminate\Support\Facades\Route::has('alumno.apariencia.update'));
    }

    public static function casos(): iterable
    {
        $temas = require dirname(__DIR__, 3).'/config/tesvb_themes.php';
        foreach ($temas['careers'] as $tema) {
            yield $tema['key'] => [1, $tema['name'], $tema['primary']];
        }

        yield 'ficha duplicada' => [1, 'Ingeniería en Sistemas Computacionales', null, true];
        yield 'personal en una vista compartida' => [2, 'Ingeniería en Sistemas Computacionales', null];
        yield 'carrera desconocida' => [1, 'Ingeniería Electrónica', null];
        yield 'ficha ausente' => [1, null, null];
    }
}
