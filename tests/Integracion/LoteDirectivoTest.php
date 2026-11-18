<?php

/*
 * Lote 1 del directivo (Generales, Formatos, Horarios, Plantilla) contra la MySQL local (.env),
 * dentro de una transacción que se revierte. Solo GET (más el POST /login).
 *
 * Para cada pantalla: responde 200 con la cuenta del directivo, usa el panel sin Bootstrap y con el
 * HTML balanceado, y se compara con su versión anterior (tests/Fixtures/vistas_antes, "antes::")
 * renderizada con LOS MISMOS datos que devolvió el controlador: formularios (action, method,
 * _token, name), campos, ids, clases que usan los scripts y textos. Si la pantalla tiene enlaces de
 * edición (/…/{id}/edit), también se abre el primero (modal de edición).
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

/** Abre la ruta, compara con la versión anterior y devuelve el HTML nuevo. */
function loteComparar($prueba, string $ruta): string
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

dataset('lote1_directivo', [
    // Generales (M158-M170)
    'Generales › Edificios' => ['/generales/edificios'],
    'Generales › Aulas' => ['/generales/aulas'],
    'Generales › Situación Profesional' => ['/generales/situaciones'],
    'Generales › Perfil' => ['/generales/perfiles'],
    'Generales › Carreras' => ['/generales/carreras'],
    'Generales › Extra Clase' => ['/generales/extra_clases'],
    'Generales › Categoría Docente' => ['/generales/cargos'],
    'Generales › Jefaturas de División' => ['/generales/jefaturas'],
    'Generales › Unidades Administrativas' => ['/generales/unidad_administrativa'],
    'Generales › Jefes Unidades Administrativas' => ['/generales/jefe_unidad_administrativa'],
    'Generales › Académico › Retículas' => ['/reticulass'],
    'Generales › Académico › Docentes' => ['/docente'],
    'Generales › Asignación de Permisos' => ['/personales'],
    // Formatos (M152-M155)
    'Formatos › Concentrado Estructura Educ.' => ['/formatos/con_edu'],
    'Formatos › Distrib. de hrs. frente a grupo' => ['/formatos/distribucion'],
    'Formatos › Distrib. de hrs. (carrera 1)' => ['/distribucion/1'],
    'Formatos › Relación de personal docente' => ['/formatos/relacion'],
    'Formatos › Relación de personal docente (carrera 1)' => ['/relacion/ver/1'],
    'Formatos › Horas por docentes' => ['/formatos/horas_docentes'],
    // Horarios (M148-M151): también el horario de un docente, grupo o aula (modal) y la tabla por categoría
    'Horarios › Ver Horarios Docentes' => ['/horarios/horarios_docentes', '#href="(/horarios_docentes/\d+)"#'],
    'Horarios › Ver Horarios Grupos' => ['/horarios/hrs_grupos', '#href="(/horarios_grupos/\d+/\d+/\d+)"#'],
    'Horarios › Ver Horarios Aulas' => ['/horarios/hrs_aulas', '#href="(/horarios_aulas/\d+/\d+)"#'],
    'Horarios › Horas por carrera' => ['/hrs_carrera'],
    'Horarios › Horas por carrera (categoría 1)' => ['/hrs_carrera/categoria/1'],
]);

it('se abre en el panel con la misma lógica que antes', function (string $ruta, ?string $enlace = null) {
    $this->post('/login', ['email' => 'directivo@example.com', 'password' => \Database\Seeders\UsersSeeder::PASSWORD_PRUEBA]);
    $this->get('/home');

    $html = loteComparar($this, $ruta);

    // modal de edición: primer enlace /…/{id}/edit de la pantalla
    if (preg_match('#href="(/[a-z_/]+/\d+/edit)"#', $html, $m)) {
        $edicion = loteComparar($this, $m[1]);
        expect($edicion)->toContain('data-panel-modal');
    }
    // otra vista a la que lleva un enlace de la pantalla (p. ej. el horario de un docente)
    if ($enlace !== null && preg_match($enlace, $html, $m)) {
        loteComparar($this, html_entity_decode($m[1]));
    }
})->with('lote1_directivo');

/** Fragmento que la pantalla carga por AJAX: se compara con su versión anterior renderizada con los mismos datos. */
function loteFragmento($prueba, string $ruta): string
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

it('los fragmentos que cargan Retículas y Docentes por AJAX conservan su lógica', function () {
    $this->post('/login', ['email' => 'directivo@example.com', 'password' => \Database\Seeders\UsersSeeder::PASSWORD_PRUEBA]);
    $this->get('/home');

    $reticula = DB::table('gnral_reticulas')->orderBy('id_reticula')->value('id_reticula');
    $materia = DB::table('gnral_materias')->orderBy('id_materia')->value('id_materia');
    $personal = DB::table('gnral_personales')->orderBy('id_personal')->value('id_personal');
    if (! $reticula || ! $materia || ! $personal) {
        $this->markTestSkipped('Faltan datos de retículas, materias o personal');
    }
    loteFragmento($this, "/ver/reticulas/$reticula");            // reticulas.partialsg.partial_materias
    loteFragmento($this, "/reticulasmo/$materia/edit");          // reticulas.partialsg.partial_mo_reticula
    loteFragmento($this, "/datos_academicos/$personal");         // docentes.partials.partial_mo_docente
    loteFragmento($this, "/docentes/materias/$personal");        // docentes.partials.materias_perfil
});
