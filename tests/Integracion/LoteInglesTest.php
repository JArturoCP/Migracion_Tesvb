<?php

/*
 * Lote 1 de Inglés (vistas del PROFESOR DE INGLÉS) contra la MySQL local (.env), dentro de una transacción
 * que se revierte (también los datos extra que se agregan). Mismo procedimiento que LoteDirectivoTest: cada
 * pantalla responde 200 con la cuenta del profesor, usa el panel sin Bootstrap y con el HTML balanceado, y se
 * compara con su versión anterior (tests/Fixtures/vistas_antes) renderizada con los mismos datos del controlador.
 * Solo GET (más el POST /login).
 */

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Tests\Support\BalanceHtml;
use Tests\Support\CompararVistas;

uses(Tests\TestCase::class);

beforeEach(function () {
    $env = \Dotenv\Dotenv::parse(@file_get_contents(base_path('.env')) ?: '');
    if (($env['DB_CONNECTION'] ?? '') !== 'mysql') {
        $this->markTestSkipped('No hay base MySQL configurada en .env');
    }
    config([
        'database.connections.mysql' => array_merge(config('database.connections.mysql'), [
            'host' => $env['DB_HOST'] ?? '127.0.0.1', 'port' => $env['DB_PORT'] ?? '3306', 'database' => $env['DB_DATABASE'] ?? '',
            'username' => $env['DB_USERNAME'] ?? '', 'password' => $env['DB_PASSWORD'] ?? '',
        ]),
        'database.default' => 'mysql',
        'cache.default' => 'array',
    ]);
    DB::purge('mysql');
    try {
        DB::connection('mysql')->getPdo();
    } catch (\Throwable $e) {
        $this->markTestSkipped('MySQL local no disponible');
    }
    DB::beginTransaction();
    $this->withoutVite();
    View::addNamespace('antes', base_path('tests/Fixtures/vistas_antes'));
});

afterEach(function () {
    if (DB::transactionLevel() > 0) {
        DB::rollBack();
    }
});

/** Abre la ruta, compara con la versión anterior y devuelve el HTML nuevo. */
function loteInglesComparar($prueba, string $ruta): string
{
    $_SERVER['REQUEST_URI'] = $ruta;
    // datos que el controlador entrega a la vista principal (para reproducir un error de la vista con la versión anterior)
    $capturada = null;
    View::creator('*', function ($v) use (&$capturada) {
        if ($capturada === null && ! str_starts_with($v->name(), 'partials.') && ! str_starts_with($v->name(), 'components.') && ! str_starts_with($v->name(), 'layouts.')) {
            $capturada = [$v->name(), $v->getData()];
        }
    });
    $respuesta = $prueba->get($ruta);
    if ($respuesta->getStatusCode() === 500 && $capturada && $respuesta->exception instanceof \Illuminate\View\ViewException) {
        // La vista nueva falla: la anterior debe fallar igual con los mismos datos (error heredado de los datos o del controlador).
        $mensaje = $respuesta->exception->getPrevious()?->getMessage();
        View::flushState();
        try {
            view('antes::' . $capturada[0], $capturada[1])->render();
            $anterior = null;
        } catch (\Throwable $e) {
            $anterior = $e->getPrevious()?->getMessage() ?? $e->getMessage();
        }
        expect($anterior)->toBe($mensaje, "$ruta falla en la vista nueva pero no igual en la anterior");
        fwrite(STDERR, "\n  [aviso] $ruta: falla igual que antes con los datos de prueba: $mensaje\n");

        return '';
    }
    $respuesta->assertOk();
    $vista = $respuesta->original;
    expect($vista)->toBeInstanceOf(\Illuminate\View\View::class);
    $nuevo = $respuesta->getContent();

    // página del panel, sin Bootstrap, HTML balanceado
    expect($nuevo)->toContain('data-panel-contenido')->toContain('window.PanelModal')
        // se aceptan solo los cierres implícitos válidos de HTML en tablas (</td> por </tr>, </tr> por </tbody>), que
        // arman las vistas originales según los datos (p. ej. la tabla de horarios con su contador de celdas)
        ->and(array_values(array_filter(BalanceHtml::errores($nuevo), fn ($e) => ! preg_match('#^<(td|th|tr)> de la línea \d+ sin cerrar \(lo cierra </(td|th|tr|tbody|thead|table)>#', $e))))->toBe([]);
    foreach (CompararVistas::recursos($nuevo) as $r) {
        expect($r)->not->toMatch('/bootstrap(\.min)?\.(css|js)|\/css\/app\.css|dataTables\.bootstrap/i');
    }

    // misma vista anterior con los mismos datos
    View::flushState();
    $viejo = view('antes::' . $vista->name(), $vista->getData())->render();
    $a = CompararVistas::regionApp($viejo);
    $b = CompararVistas::region($nuevo, '//*[@data-panel-contenido]');

    // formularios como los arma el navegador (los originales tienen <form> anidados o cruzados con </div>)
    expect(CompararVistas::formulariosNavegador($nuevo, 'data-panel-contenido', 'data-panel-pie'))
        ->toEqual(CompararVistas::formulariosNavegador($viejo, 'class="tesvb-contenido"', '<footer'), "formularios de $ruta")
        ->and(CompararVistas::camposNavegador($nuevo, 'data-panel-contenido', 'data-panel-pie'))
        ->toEqual(CompararVistas::camposNavegador($viejo, 'class="tesvb-contenido"', '<footer'), "campos de $ruta")
        ->and(array_values(array_diff(CompararVistas::ids($a), CompararVistas::ids($b))))->toBe([], "ids de $ruta");
    $clasesUsadas = array_intersect(CompararVistas::clasesDeScripts($a), CompararVistas::clases($a));
    expect(array_values(array_diff($clasesUsadas, CompararVistas::clases($b))))->toBe([], "clases de scripts en $ruta");
    $textoNuevo = CompararVistas::textoPlano(CompararVistas::region($nuevo, '//body'));
    expect(array_values(array_filter(CompararVistas::textos($a), fn ($t) => ! str_contains($textoNuevo, $t))))->toBe([], "textos de $ruta");

    return $nuevo;
}

/** Fragmento que la pantalla carga por AJAX: se compara con su versión anterior renderizada con los mismos datos. */
function loteInglesFragmento($prueba, string $ruta): string
{
    $respuesta = $prueba->get($ruta)->assertOk();
    $vista = $respuesta->original;
    expect($vista)->toBeInstanceOf(\Illuminate\View\View::class);
    $nuevo = $respuesta->getContent();
    View::flushState();
    $viejo = view('antes::' . $vista->name(), $vista->getData())->render();

    expect(CompararVistas::formulariosNavegador($nuevo, '', ''))->toEqual(CompararVistas::formulariosNavegador($viejo, '', ''), "formularios de $ruta")
        ->and(CompararVistas::camposNavegador($nuevo, '', ''))->toEqual(CompararVistas::camposNavegador($viejo, '', ''), "campos de $ruta")
        ->and(preg_match('/class="(btn|form-control|modal fade|panel )[^"]*"/', $nuevo, $resto) ? $resto[0] : '')->toBe('', "clases de Bootstrap en $ruta");
    $envolver = fn ($h) => '<html><body><div id="f">' . $h . '</div></body></html>';
    $a = CompararVistas::region($envolver($viejo), '//div[@id="f"]');
    $b = CompararVistas::region($envolver($nuevo), '//div[@id="f"]');
    expect(array_values(array_diff(CompararVistas::ids($a), CompararVistas::ids($b))))->toBe([], "ids de $ruta");
    $clasesUsadas = array_intersect(CompararVistas::clasesDeScripts($a), CompararVistas::clases($a));
    expect(array_values(array_diff($clasesUsadas, CompararVistas::clases($b))))->toBe([], "clases de scripts en $ruta");
    $texto = CompararVistas::textoPlano($b);
    expect(array_values(array_filter(CompararVistas::textos($a), fn ($t) => ! str_contains($texto, $t))))->toBe([], "textos de $ruta");

    return $nuevo;
}

function entrarProfesorIngles($prueba): void
{
    if (! DB::table('users')->where('email', 'ingles01@example.com')->exists()) {
        $prueba->markTestSkipped('No existe la cuenta ingles01@example.com');
    }
    $prueba->post('/login', ['email' => 'ingles01@example.com', 'password' => \Database\Seeders\UsersSeeder::PASSWORD_PRUEBA]);
    $prueba->get('/home');
}

/** Primer grupo del profesor en el periodo de inglés de la sesión (como /ingles/Calificaciones). */
function grupoProfesorIngles(): ?object
{
    return DB::table('in_hrs_ingles_profesor')
        ->where('id_profesor', session('id_profesor_ingles'))
        ->where('id_periodo', session('periodo_ingles'))
        ->orderBy('id_nivel')->orderBy('id_grupo')
        ->first(['id_nivel', 'id_grupo']);
}

it('Datos P. › Editar se abre en el panel con el mismo formulario', function () {
    entrarProfesorIngles($this);
    $html = loteInglesComparar($this, '/profesores_ingles/modificar/' . session('id_usuario'));
    expect($html)->toContain('id="form_modificar_profesores_ingles"')->toContain('datepicker/js/bootstrap-datepicker.js');
});

it('Calificaciones (inicio) se abre en el panel con los mismos grupos y enlaces', function () {
    entrarProfesorIngles($this);
    $html = loteInglesComparar($this, '/ingles/Calificaciones');
    $g = grupoProfesorIngles();
    if ($g) {
        expect($html)->toContain("/ingles/Calificaciones/periodos_ingles/{$g->id_nivel}/{$g->id_grupo}")
            ->toContain("/ingles/Calificaciones/mostrar_alumnos/{$g->id_nivel}/{$g->id_grupo}");
    }
});

it('Periodos de calificaciones se abre en el panel con sus modales y fragmentos', function () {
    entrarProfesorIngles($this);
    $g = grupoProfesorIngles() ?? $this->markTestSkipped('El profesor no tiene grupos en el periodo');
    $html = loteInglesComparar($this, "/ingles/Calificaciones/periodos_ingles/{$g->id_nivel}/{$g->id_grupo}");
    expect($html)->toContain('id="modal_registro"')->toContain('id="modal_modificar_per"')->toContain('data-panel-modal');

    loteInglesFragmento($this, "/ingles/registro_periodo_ingles/2/{$g->id_nivel}/{$g->id_grupo}");
    $unidad = DB::table('in_cal_periodo')->where('id_periodo', session('periodo_ingles'))
        ->where('id_nivel', $g->id_nivel)->where('id_grupo', $g->id_grupo)->value('id_unidad');
    if ($unidad) {
        loteInglesFragmento($this, "/ingles/modificar_per/$unidad/{$g->id_nivel}/{$g->id_grupo}");
    }
});
