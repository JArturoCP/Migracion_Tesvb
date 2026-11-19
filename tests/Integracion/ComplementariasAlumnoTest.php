<?php

/*
 * Complementarias del ALUMNO contra la MySQL local (.env), dentro de una transacción que se revierte.
 * Mismo procedimiento que LoteDirectivoTest: cada pantalla responde 200 con la cuenta del alumno, usa el panel
 * sin Bootstrap y con el HTML balanceado, y se compara con su versión anterior (tests/Fixtures/vistas_antes)
 * renderizada con los mismos datos del controlador. Solo GET (más el POST /login).
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

/**
 * Ids del original que el navegador nunca creaba: <form id="agregar_actividad_alu"> estaba anidado dentro de otro
 * <form> (el parser de HTML lo ignora; el de libxml de las pruebas sí lo conserva). Ver consulta_reg_actividades.
 */
const IDS_FORM_ANIDADO_IGNORADO = ['agregar_actividad_alu'];

/** Abre la ruta, compara con la versión anterior y devuelve el HTML nuevo. */
function complementariasComparar($prueba, string $ruta): string
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
        ->and(array_values(array_diff(CompararVistas::ids($a), CompararVistas::ids($b), IDS_FORM_ANIDADO_IGNORADO)))->toBe([], "ids de $ruta");
    $clasesUsadas = array_intersect(CompararVistas::clasesDeScripts($a), CompararVistas::clases($a));
    expect(array_values(array_diff($clasesUsadas, CompararVistas::clases($b))))->toBe([], "clases de scripts en $ruta");
    $textoNuevo = CompararVistas::textoPlano(CompararVistas::region($nuevo, '//body'));
    expect(array_values(array_filter(CompararVistas::textos($a), fn ($t) => ! str_contains($textoNuevo, $t))))->toBe([], "textos de $ruta");

    return $nuevo;
}

function entrarAlumnoComplementarias($prueba, string $email = 'alumno02@example.com'): void
{
    if (! DB::table('users')->where('email', $email)->exists()) {
        $prueba->markTestSkipped("No existe la cuenta $email");
    }
    $prueba->post('/login', ['email' => $email, 'password' => \Database\Seeders\UsersSeeder::PASSWORD_PRUEBA]);
    $prueba->get('/home');
}

dataset('complementarias_alumno', [
    'Registrar' => ['/consulta_actividades'],
    'Evidencias' => ['/evidencias_alumnos'],
    'Liberación' => ['/liberacion_alumno'],
    'Créditos' => ['/creditos'],
]);

it('se abre en el panel con la misma lógica que antes', function (string $ruta) {
    entrarAlumnoComplementarias($this);
    $html = complementariasComparar($this, $ruta);
    expect($html)->toContain('data-panel-contenido');
})->with('complementarias_alumno');

it('Registrar conserva los formularios de registro y eliminación', function () {
    entrarAlumnoComplementarias($this, 'alumno01@example.com');
    $html = complementariasComparar($this, '/consulta_actividades');
    expect($html)->toContain('id="form_confirma"')->toContain('id="form_delete"')->toContain('id="agrega_actalu"')
        ->toContain('/js/validate.min.js');
});

it('Modificar actividad (edit) se abre con el modal de edición y el mismo formulario PUT', function () {
    entrarAlumnoComplementarias($this);
    $registro = DB::table('actcomple_registro_alumnos')->where('cuenta', DB::table('gnral_alumnos')->where('id_usuario', auth()->id())->value('cuenta'))->value('id_registro_alumno');
    if (! $registro) {
        $this->markTestSkipped('El alumno no tiene registros');
    }
    $html = complementariasComparar($this, "/consulta_actividades/$registro/edit");
    if ($html !== '') {
        expect($html)->toContain('id="modal_edit_actalu"')->toContain('action="/consulta_actividades/' . $registro . '"')->toContain('name="_method" value="PUT"');
    }
});

it('Evidencias con la actividad aún no aceptada muestra el mensaje en el panel', function () {
    entrarAlumnoComplementarias($this, 'alumno01@example.com');
    $html = complementariasComparar($this, '/evidencias_alumnos');
    expect($html)->toContain('AÚN NO HA SIDO ACEPTADA TU ACTIVIDAD')->toContain('data-panel-mensaje')
        ->not->toContain('alert alert-danger');
});
