<?php

namespace Tests\Support;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

/**
 * Examen EGEL (admin y alumno) migrado al panel: datos sintéticos de cada vista y comparación con su
 * versión anterior (tests/Fixtures/vistas_antes): formularios (action, method, _token, name), campos,
 * ids, clases que usan los scripts y textos. Lo usa tests/Feature/Panel/ExamenEgelVistasTest.php.
 */
class CasosExamenEgel
{
    /** Tablas que consulta el dashboard del alumno (y Egel_periodosController::enAplicacion/enPublicacion). */
    public static function crearTablas(): void
    {
        $tablas = [
            'egel_periodo_examen' => function (Blueprint $t) {
                $t->increments('id_periodo_examen');
                $t->string('periodo')->nullable();
                $t->date('fecha_inicio')->nullable();
                $t->date('fecha_fin')->nullable();
                $t->integer('estado')->nullable();
            },
            'egel_periodo_resultados_examen' => function (Blueprint $t) {
                $t->increments('id_periodo_resultado');
                $t->date('fecha_inicio')->nullable();
                $t->date('fecha_fin')->nullable();
                $t->integer('estado')->nullable();
            },
            'egel_examenes' => function (Blueprint $t) {
                $t->increments('id_examen_egel');
                $t->integer('id_carrera')->nullable();
                $t->string('nombre')->nullable();
                $t->integer('estado')->nullable();
            },
            'egel_secciones' => function (Blueprint $t) {
                $t->increments('id_seccion');
                $t->integer('id_examen_egel')->nullable();
                $t->string('nombre')->nullable();
            },
            'egel_secciones_estado' => function (Blueprint $t) {
                $t->increments('id');
                $t->integer('id_alumno')->nullable();
                $t->integer('id_seccion')->nullable();
                $t->integer('completada')->nullable();
            },
            'egel_resultados' => function (Blueprint $t) {
                $t->increments('id_resultado');
                $t->integer('id_alumno')->nullable();
                $t->decimal('calificacion_general', 5, 2)->nullable();
                $t->string('nivel')->nullable();
            },
        ];
        foreach ($tablas as $tabla => $definicion) {
            Schema::dropIfExists($tabla);
            Schema::create($tabla, $definicion);
        }
    }

    /** nombre => [vista, rol, datos, sesión] */
    public static function vistas(): array
    {
        $o = fn (array $a) => (object) $a;
        $alumnos = [
            $o(['nombre' => 'ANA', 'apaterno' => 'LÓPEZ', 'amaterno' => 'RUIZ', 'cuenta' => '2020123', 'correo_al' => 'ana@tesvb.edu.mx', 'calificacion_general' => 88, 'nivel' => 'Sobresaliente', 'id_carrera' => '8']),
            $o(['nombre' => 'LUIS', 'apaterno' => 'PÉREZ', 'amaterno' => 'GIL', 'cuenta' => '2020456', 'correo_al' => null, 'calificacion_general' => 61, 'nivel' => 'Satisfactorio', 'id_carrera' => '6']),
            $o(['nombre' => 'EVA', 'apaterno' => 'LUNA', 'amaterno' => 'RÍOS', 'cuenta' => '2020789', 'correo_al' => 'eva@tesvb.edu.mx', 'calificacion_general' => 40, 'nivel' => 'Aún no satisfactorio', 'id_carrera' => '8']),
        ];
        $paginador = fn (array $items) => new LengthAwarePaginator(collect($items), 25, 10, 2, ['path' => '/examen_egel/admin/alumno']);
        $carreras = [$o(['id_carrera' => 8, 'nombre' => 'LICENCIATURA EN TURISMO']), $o(['id_carrera' => 6, 'nombre' => 'INGENIERÍA FORESTAL'])];
        $examen = $o(['id_examen_egel' => 3, 'id_carrera' => 8, 'carrera' => 'LICENCIATURA EN TURISMO', 'nombre' => 'EGEL TURISMO 2026']);
        $respuestas = collect([
            $o(['id_respuesta' => 1, 'respuesta' => 'SETENTA POR CIENTO', 'es_correcta' => 1]),
            $o(['id_respuesta' => 2, 'respuesta' => 'SESENTA POR CIENTO', 'es_correcta' => 0]),
        ]);
        $preguntas = collect([$o(['id_pregunta' => 7, 'id_examen_egel' => 3, 'id_modulo' => 10, 'numero_pregunta' => 39, 'pregunta' => 'Un hotel tiene 50 habitaciones y 35 ocupadas.', 'respuestas' => $respuestas])]);
        $modulos = collect([$o(['id_modulo' => 10, 'id_seccion' => 1, 'nombre' => 'LEGISLACIÓN TURÍSTICA']), $o(['id_modulo' => 11, 'id_seccion' => 1, 'nombre' => 'GESTIÓN HOTELERA'])]);
        $periodos = collect([$o(['id_periodo_examen' => 4, 'periodo' => 'EGEL 2026-1', 'fecha_inicio' => '2026-01-10', 'fecha_fin' => '2026-02-10'])]);
        $porModulo = [$o(['nombre' => 'LEGISLACIÓN TURÍSTICA', 'puntos' => 12.5, 'total_valor' => 20, 'porcentaje' => 62.5])];
        $porSeccion = [$o(['id_seccion' => 1, 'puntos' => 30, 'total_valor' => 40, 'porcentaje' => 75])];
        $resultado = $o(['calificacion_general' => 81.4, 'nivel' => 'Satisfactorio']);
        $faltantes = (new ViewErrorBag)->put('default', new MessageBag(['respuestas' => 'Faltan']));

        return [
            'admin: menú' => ['examen_egel.admin.dashboard', 'directivo', [], []],
            'admin: alumnos (paginados)' => ['examen_egel.admin.alumno', 'directivo', ['alumnos_sin_examen' => $paginador($alumnos), 'alumnos_con_examen' => $paginador($alumnos)], []],
            'admin: alumnos (vacío)' => ['examen_egel.admin.alumno', 'directivo', ['alumnos_sin_examen' => $paginador([]), 'alumnos_con_examen' => $paginador([])], []],
            'admin: resultados' => ['examen_egel.admin.resultados', 'directivo', ['alumnos' => collect($alumnos)], []],
            'admin: exámenes' => ['examen_egel.admin.examenes.index', 'directivo', ['examenes' => collect([$examen])], []],
            // create/edit/edit_pregunta/edit_respuesta son modales: el controlador devuelve index o preguntas con $ver.
            'admin: nuevo examen' => ['examen_egel.admin.examenes.index', 'directivo', ['examenes' => collect([$examen]), 'carreras' => $carreras, 'ver' => 'create'], []],
            'admin: editar examen' => ['examen_egel.admin.examenes.index', 'directivo', ['examenes' => collect([$examen]), 'examen' => $examen, 'carreras' => $carreras, 'ver' => 'edit'], []],
            // examen_egel.admin.examenes.completo no se incluye: usa route('admin.examen.guardarCompleto'), que no está
            // definida en routes/web.php, así que no se puede renderizar (ni antes ni ahora).
            'admin: carga rápida' => ['examen_egel.admin.examenes.rapido', 'directivo', ['examen' => $examen], []],
            'admin: preguntas' => ['examen_egel.admin.examenes.preguntas', 'directivo', ['examen' => $examen, 'secciones' => collect([$o(['id_seccion' => 1, 'nombre' => 'SECCIÓN 1'])]), 'modulos' => $modulos, 'preguntas' => $preguntas], []],
            'admin: editar pregunta' => ['examen_egel.admin.examenes.preguntas', 'directivo', ['examen' => $examen, 'secciones' => collect([$o(['id_seccion' => 1, 'nombre' => 'SECCIÓN 1'])]), 'modulos' => $modulos, 'preguntas' => $preguntas, 'pregunta' => $preguntas[0], 'modulos_pregunta' => $modulos, 'ver' => 'pregunta'], []],
            'admin: editar respuesta' => ['examen_egel.admin.examenes.preguntas', 'directivo', ['examen' => $examen, 'secciones' => collect([$o(['id_seccion' => 1, 'nombre' => 'SECCIÓN 1'])]), 'modulos' => $modulos, 'preguntas' => $preguntas, 'respuesta' => $o(['id_respuesta' => 1, 'id_examen_egel' => 3, 'numero_pregunta' => 39, 'respuesta' => 'SETENTA POR CIENTO', 'es_correcta' => 1]), 'ver' => 'respuesta'], []],
            'admin: periodos' => ['examen_egel.admin.periodos.index', 'directivo', ['periodosExamen' => $periodos, 'periodosResultados' => $periodos], ['success' => 'Periodo guardado']],
            'admin: periodos con errores' => ['examen_egel.admin.periodos.index', 'directivo', ['periodosExamen' => collect(), 'periodosResultados' => collect(), 'errors' => (new ViewErrorBag)->put('default', new MessageBag(['periodo' => 'El periodo es obligatorio']))], []],
            'admin: editar periodo' => ['examen_egel.admin.periodos.edit', 'directivo', ['periodoExamen' => $periodos[0], 'periodoResultado' => $periodos[0]], ['success' => 'Periodo actualizado']],
            'alumno: resultados detallados' => ['examen_egel.dashboard-resultados', 'alumno', ['resultado' => $resultado, 'porModulo' => $porModulo, 'porSeccion' => $porSeccion], []],
            'alumno: resultados sin generar' => ['examen_egel.dashboard-resultados', 'alumno', ['resultado' => null, 'porModulo' => [], 'porSeccion' => []], []],
            'alumno: reporte final' => ['examen_egel.reporte_resultados', 'alumno', ['alumno' => $alumnos[0], 'resultado' => $resultado, 'porModulo' => $porModulo], []],
            'alumno: reporte sin resultado' => ['examen_egel.reporte_resultados', 'alumno', ['alumno' => $alumnos[0], 'resultado' => null, 'porModulo' => []], []],
            'alumno: instrucciones' => ['examen_egel.seccion1.index', 'alumno', ['id_seccion' => 1], []],
            'alumno: pregunta' => ['examen_egel.seccion1.pregunta', 'alumno', ['moduloActual' => $modulos[0], 'paginaActual' => 1, 'id_seccion' => 1, 'preguntas' => $preguntas, 'respuestas' => [7 => $respuestas]], []],
            'alumno: pregunta sin responder' => ['examen_egel.seccion1.pregunta', 'alumno', ['errors' => $faltantes, 'moduloActual' => null, 'paginaActual' => 2, 'id_seccion' => 1, 'preguntas' => $preguntas, 'respuestas' => [7 => $respuestas]], []],
            'alumno: transición' => ['examen_egel.seccion1.transicion', 'alumno', ['moduloActual' => $modulos[0], 'id_seccion' => 1, 'nextPage' => 2], []],
            'alumno: sección finalizada' => ['examen_egel.seccion1.finalizada', 'alumno', ['id_seccion' => 1], []],
        ];
    }

    /** nombre => [en aplicación, en publicación, secciones completadas, con resultado] */
    public static function ramasDashboard(): array
    {
        return [
            'fuera de aplicación' => [false, false, [], false],
            'en aplicación, ninguna sección' => [true, false, [], false],
            'en aplicación, sección 1 completa' => [true, false, [1], false],
            'todo completo, sin publicación' => [true, false, [1, 2], false],
            'todo completo, publicado sin resultado' => [true, true, [1, 2], false],
            'todo completo, publicado con resultado' => [false, true, [1, 2], true],
        ];
    }

    /** Llena las tablas EGEL para una rama del dashboard del alumno. */
    public static function prepararDashboard(int $idUsuario, bool $aplicacion, bool $publicacion, array $completadas, bool $conResultado): void
    {
        $hoy = now()->toDateString();
        $idAlumno = DB::table('gnral_alumnos')->where('id_usuario', $idUsuario)->value('id_alumno');

        DB::table('gnral_carreras')->where('id_carrera', 8)->delete();
        DB::table('gnral_carreras')->insert(['id_carrera' => 8, 'nombre' => 'LICENCIATURA EN TURISMO']);
        DB::table('egel_periodo_examen')->insert(['estado' => (int) $aplicacion, 'fecha_inicio' => $hoy, 'fecha_fin' => $hoy]);
        DB::table('egel_periodo_resultados_examen')->insert(['estado' => (int) $publicacion, 'fecha_inicio' => $hoy, 'fecha_fin' => $hoy]);
        $idExamen = DB::table('egel_examenes')->insertGetId(['id_carrera' => 8, 'nombre' => 'EGEL', 'estado' => 1]);
        foreach ([1, 2] as $n) {
            $idSeccion = DB::table('egel_secciones')->insertGetId(['id_examen_egel' => $idExamen, 'nombre' => "Sección $n"]);
            if (in_array($n, $completadas, true)) {
                DB::table('egel_secciones_estado')->insert(['id_alumno' => $idAlumno, 'id_seccion' => $idSeccion, 'completada' => 1]);
            }
        }
        if ($conResultado) {
            DB::table('egel_resultados')->insert(['id_alumno' => $idAlumno, 'calificacion_general' => 81.4, 'nivel' => 'Satisfactorio']);
        }
    }

    /**
     * Renderiza la vista nueva y la anterior con los mismos datos y devuelve las diferencias
     * (lista vacía si la vista nueva conserva todo). $html recibe la página nueva.
     */
    public static function comparar(string $vista, array $datos, ?string &$html = null): array
    {
        $datos += ['errors' => new ViewErrorBag];
        View::flushState();
        $nuevo = $html = view($vista, $datos)->render();
        View::flushState();
        $viejo = view('antes::' . $vista, $datos)->render();

        $fallas = [];
        foreach (['data-panel-contenido', 'window.PanelModal'] as $marca) {
            if (! str_contains($nuevo, $marca)) {
                $fallas[] = "no usa el panel ($marca)";
            }
        }
        foreach (BalanceHtml::errores($nuevo) as $e) {
            $fallas[] = "HTML: $e";
        }
        foreach (CompararVistas::recursos($nuevo) as $r) {
            if (preg_match('/bootstrap(\.min)?\.(css|js)|\/css\/app\.css|estilos\.css/i', $r)) {
                $fallas[] = "carga Bootstrap: $r";
            }
        }
        if (preg_match('#<main.*</main>#s', $nuevo, $m) && preg_match('/class="(?:[^"]* )?(btn|form-control|panel|col-md-\d+|row|glyphicon)(?: [^"]*)?"/', $m[0], $bs)) {
            $fallas[] = 'clases de Bootstrap: ' . $bs[0];
        }

        $a = CompararVistas::regionApp($viejo);
        $b = CompararVistas::region($nuevo, '//*[@data-panel-contenido]');
        if (CompararVistas::formulariosNavegador($nuevo, 'data-panel-contenido', 'data-panel-pie') != CompararVistas::formulariosNavegador($viejo, 'class="tesvb-contenido"', '<footer')) {
            $fallas[] = 'formularios distintos: ' . json_encode([
                'antes' => CompararVistas::formulariosNavegador($viejo, 'class="tesvb-contenido"', '<footer'),
                'ahora' => CompararVistas::formulariosNavegador($nuevo, 'data-panel-contenido', 'data-panel-pie'),
            ], JSON_UNESCAPED_UNICODE);
        }
        if (CompararVistas::camposNavegador($nuevo, 'data-panel-contenido', 'data-panel-pie') != CompararVistas::camposNavegador($viejo, 'class="tesvb-contenido"', '<footer')) {
            $fallas[] = 'campos distintos: ' . json_encode([
                'antes' => CompararVistas::camposNavegador($viejo, 'class="tesvb-contenido"', '<footer'),
                'ahora' => CompararVistas::camposNavegador($nuevo, 'data-panel-contenido', 'data-panel-pie'),
            ], JSON_UNESCAPED_UNICODE);
        }
        foreach (array_diff(CompararVistas::ids($a), CompararVistas::ids($b)) as $id) {
            $fallas[] = "falta el id $id";
        }
        $clasesUsadas = array_intersect(CompararVistas::clasesDeScripts($a), CompararVistas::clases($a));
        foreach (array_diff($clasesUsadas, CompararVistas::clases($b)) as $c) {
            $fallas[] = "falta la clase de script $c";
        }
        // La paginación por defecto de Laravel (textos en inglés: « Previous, Showing… results) se cambió por
        // pagination::panel; se compara aparte: si antes había paginación, ahora también.
        $paginacion = '#<nav role="navigation" aria-label="Pagination Navigation".*?</nav>#s';
        if (preg_match($paginacion, $viejo) && ! str_contains($nuevo, 'aria-label="Paginación"')) {
            $fallas[] = 'falta la paginación';
        }
        $texto = CompararVistas::textoPlano(CompararVistas::region($nuevo, '//body'));
        foreach (CompararVistas::textos(CompararVistas::regionApp(preg_replace($paginacion, '', $viejo))) as $t) {
            if (! str_contains($texto, $t)) {
                $fallas[] = "falta el texto «{$t}»";
            }
        }

        return array_values(array_unique($fallas));
    }
}
