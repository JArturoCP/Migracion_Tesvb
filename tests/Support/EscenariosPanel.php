<?php

namespace Tests\Support;

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

/**
 * Escenarios por rol y variante para comparar el menú viejo (partials/menu_admin) con el
 * sidebar nuevo (partials/panel/sidebar), y home_recargado con panel/inicio.
 *
 * Crea en SQLite (memoria) solo las tablas que consultan esas vistas y HomeController2@index,
 * y arma la sesión como la deja HomeController@index para cada perfil.
 */
class EscenariosPanel
{
    public const ID_PERSONAL = 500;

    /** Tablas mínimas que consultan los menús, los paneles y HomeController2@index. */
    public static function crearEsquema(): void
    {
        $tablas = [
            'gnral_personales' => function (Blueprint $t) {
                $t->increments('id_personal');
                $t->string('nombre')->nullable();
                $t->string('correo')->nullable();
                $t->integer('tipo_usuario')->nullable();
                $t->integer('id_departamento')->nullable();
                $t->integer('estado_docente_inv')->nullable();
            },
            'gnral_periodos' => function (Blueprint $t) {
                $t->increments('id_periodo');
                $t->string('periodo')->nullable();
                $t->date('fecha_inicio')->nullable();
                $t->date('fecha_termino')->nullable();
            },
            'gnral_jefes_periodos' => function (Blueprint $t) {
                $t->increments('id_jefe_periodo');
                $t->integer('id_carrera')->nullable();
                $t->integer('id_personal')->nullable();
                $t->integer('id_periodo')->nullable();
            },
            'exp_asigna_generacion' => function (Blueprint $t) {
                $t->increments('id_asigna_generacion');
                $t->integer('id_jefe_periodo')->nullable();
                $t->softDeletes();
            },
            'exp_asigna_tutor' => function (Blueprint $t) {
                $t->increments('id_asigna_tutor');
                $t->integer('id_asigna_generacion')->nullable();
                $t->integer('id_personal')->nullable();
                $t->integer('id_jefe_periodo')->nullable();
                $t->softDeletes();
            },
            'exp_asigna_alumnos' => function (Blueprint $t) {
                $t->increments('id_asigna_alumno');
                $t->integer('id_asigna_generacion')->nullable();
                $t->integer('id_alumno')->nullable();
                $t->integer('estado')->nullable();
                $t->softDeletes();
            },
            'eva_carga_academica' => function (Blueprint $t) {
                $t->increments('id_carga_academica');
                $t->integer('id_alumno')->nullable();
                $t->integer('id_periodo')->nullable();
                $t->integer('id_status_materia')->nullable();
            },
            'cal_evaluaciones' => function (Blueprint $t) {
                $t->increments('id_evaluacion');
                $t->integer('id_carga_academica')->nullable();
                $t->integer('calificacion')->nullable();
            },
            'ar_areas_atencion' => function (Blueprint $t) {
                $t->increments('id_area_atencion');
                $t->integer('activo')->default(1);
            },
            'ar_area_responsables_periodo' => function (Blueprint $t) {
                $t->increments('id');
                $t->integer('id_area_atencion')->nullable();
                $t->integer('id_personal')->nullable();
                $t->integer('activo')->default(1);
            },
            'gnral_alumnos' => function (Blueprint $t) {
                $t->increments('id_alumno');
                $t->integer('id_usuario')->nullable();
                $t->integer('id_carrera')->nullable();
                $t->integer('id_semestre')->nullable();
                $t->string('genero')->nullable();
            },
            'ar_casos_estudiantes' => function (Blueprint $t) {
                $t->increments('id_ar_caso');
                $t->integer('id_alumno')->nullable();
            },
            'ar_caso_canalizaciones' => function (Blueprint $t) {
                $t->increments('id');
                $t->integer('id_ar_caso')->nullable();
            },
            'aud_auditores' => function (Blueprint $t) {
                $t->increments('id_auditor');
                $t->integer('id_personal')->nullable();
                $t->integer('id_categoria')->nullable();
                $t->timestamps();
                $t->softDeletes();
            },
            'aud_lider_acciones' => function (Blueprint $t) {
                $t->increments('id');
                $t->integer('id_personal')->nullable();
                $t->softDeletes();
            },
            'aud_seguimiento_auditorias' => function (Blueprint $t) {
                $t->increments('id');
                $t->integer('id_personal_seguimiento')->nullable();
                $t->integer('activo')->default(1);
                $t->softDeletes();
            },
            'gnral_carreras' => function (Blueprint $t) {
                $t->increments('id_carrera');
                $t->string('nombre')->nullable();
                $t->string('siglas')->nullable();
                $t->string('COLOR')->nullable();
            },
            // Dashboard del directivo (App\Services\Panel\DatosDirectivo)
            'eva_validacion_de_cargas' => function (Blueprint $t) {
                $t->increments('id');
                $t->integer('id_alumno')->nullable();
                $t->integer('id_periodo')->nullable();
                $t->integer('estado_validacion')->nullable();
            },
            'gnral_semestres' => function (Blueprint $t) {
                $t->increments('id_semestre');
                $t->string('descripcion')->nullable();
            },
            'gnral_periodo_carreras' => function (Blueprint $t) {
                $t->increments('id_periodo_carrera');
                $t->integer('id_carrera')->nullable();
                $t->integer('id_periodo')->nullable();
            },
            'gnral_horarios' => function (Blueprint $t) {
                $t->increments('id_horario_profesor');
                $t->integer('id_periodo_carrera')->nullable();
                $t->integer('id_personal')->nullable();
            },
            // HomeController2@index (alumno)
            'adeudo_departamento' => function (Blueprint $t) {
                $t->increments('id_adeudo_departamento');
                $t->integer('id_alumno')->nullable();
                $t->integer('id_departamento')->nullable();
                $t->string('comentario')->nullable();
            },
            'gnral_unidad_administrativa' => function (Blueprint $t) {
                $t->increments('id_unidad_admin');
                $t->string('nom_departamento')->nullable();
            },
            'enc_incripcion' => function (Blueprint $t) {
                $t->increments('id_incripcion');
                $t->integer('id_alumno')->nullable();
                $t->integer('id_periodo')->nullable();
                $t->integer('id_estado')->nullable();
            },
            'enc_reinscripcion' => function (Blueprint $t) {
                $t->increments('id_reinscripcion');
                $t->integer('id_alumno')->nullable();
                $t->integer('id_periodo')->nullable();
                $t->integer('id_estado')->nullable();
            },
            'enc_servicio_social' => function (Blueprint $t) {
                $t->increments('id_servicio');
                $t->integer('id_alumno')->nullable();
                $t->integer('id_estado')->nullable();
            },
            'enc_residencia_profesional' => function (Blueprint $t) {
                $t->increments('id');
                $t->integer('id_alumno')->nullable();
                $t->integer('id_estado')->nullable();
            },
        ];

        foreach ($tablas as $nombre => $definicion) {
            if (! Schema::hasTable($nombre)) {
                Schema::create($nombre, $definicion);
            }
        }

        // Periodos: el anterior, el vigente (contiene la fecha de hoy) y el siguiente.
        DB::table('gnral_periodos')->insert([
            ['id_periodo' => 9, 'periodo' => 'FEB-JUL 2026', 'fecha_inicio' => now()->subMonths(8)->toDateString(), 'fecha_termino' => now()->subMonths(2)->toDateString()],
            ['id_periodo' => 10, 'periodo' => 'AGO-DIC 2026', 'fecha_inicio' => now()->subMonth()->toDateString(), 'fecha_termino' => now()->addMonth()->toDateString()],
            ['id_periodo' => 11, 'periodo' => 'FEB-JUL 2027', 'fecha_inicio' => now()->addMonths(2)->toDateString(), 'fecha_termino' => now()->addMonths(7)->toDateString()],
        ]);
    }

    /** Vacía las tablas de datos (para recorrer varios escenarios en una misma prueba). */
    public static function vaciar(): void
    {
        foreach (['users', 'gnral_personales', 'gnral_periodos', 'gnral_jefes_periodos', 'exp_asigna_generacion',
            'exp_asigna_tutor', 'exp_asigna_alumnos', 'eva_carga_academica', 'cal_evaluaciones', 'ar_areas_atencion',
            'ar_area_responsables_periodo', 'gnral_alumnos', 'ar_casos_estudiantes', 'ar_caso_canalizaciones',
            'aud_auditores', 'aud_lider_acciones', 'aud_seguimiento_auditorias', 'gnral_carreras',
            'gnral_periodo_carreras', 'gnral_horarios', 'eva_validacion_de_cargas', 'gnral_semestres'] as $tabla) {
            if (Schema::hasTable($tabla)) {
                DB::table($tabla)->delete();
            }
        }
    }

    /**
     * Lista de escenarios: clave => [rol base, opciones].
     * Las opciones se combinan con el rol base en preparar().
     */
    public static function escenarios(): array
    {
        $unidades = [1, 2, 3, 5, 6, 8, 10, 14, 16, 17, 19, 20, 22, 23, 24, 25, 26, 28, 40];
        $e = [
            // Alumno y sus variantes
            'alumno semestre 1' => ['alumno', ['semestre' => 1]],
            'alumno semestre 6 con evaluación y carga' => ['alumno', ['semestre' => 6, 'ver_eva' => true, 'ver_carga' => true]],
            'alumno semestre 9 registrar residencia' => ['alumno', ['semestre' => 9, 'registrar_residencia' => true, 'estado_reg_anteproyecto' => true, 'anteproyecto_aceptado' => true, 'registro_empresa' => true, 'seguimiento_alumno' => true]],
            'alumno semestre 9 sin periodo de registro' => ['alumno', ['semestre' => 9, 'estado_reg_anteproyecto' => true, 'anteproyecto_aceptado' => true, 'registro_empresa' => true]],
            'alumno titulación 3 etapas' => ['alumno', ['semestre' => 9, 'reg_alum_ti' => true, 'ti_segunda_etapa' => true, 'ti_tercera_parte' => true, 'estado_cuenta' => true]],
            'alumno carrera 2' => ['alumno', ['semestre' => 4, 'carrera_alumno' => 2]],
            'alumno carrera 6' => ['alumno', ['semestre' => 4, 'carrera_alumno' => 6]],
            'alumno carrera 8' => ['alumno', ['semestre' => 4, 'carrera_alumno' => 8]],
            'alumno con canalización PIASE' => ['alumno', ['semestre' => 3, 'alumno_piase' => true]],
            // Roles base del personal
            'docente con actividad' => ['docente_actividad', []],
            'docente con actividad I.S.C.' => ['docente_actividad', ['isc' => true]],
            'docente con actividad, academia y revisor' => ['docente_actividad', ['personal_academia' => true, 'revisor' => true, 'seguimiento_asesor' => true]],
            'docente sin actividad' => ['docente', []],
            'docente sin actividad, academia, revisor y asesor' => ['docente', ['personal_academia' => true, 'revisor' => true, 'seguimiento_asesor' => true]],
            'docente sin actividad con unidad 3' => ['docente', ['unidad' => 3]],
            'docente investigador' => ['docente', ['docente_investigador' => true]],
            'jefe de división (1 carrera)' => ['jefe_division', []],
            'jefe de división (2 carreras)' => ['jefe_division', ['dos_carreras' => true]],
            'desarrollo académico' => ['desarrollo', []],
            'desarrollo académico con unidad 5' => ['desarrollo', ['unidad' => 5]],
            'directivo' => ['directivo', []],
            'consultas' => ['consultas', []],
            'servicios escolares' => ['escolar', []],
            'recursos humanos' => ['rh', []],
            'centro de cómputo' => ['computo', []],
            'residencias' => ['residencias', []],
            'titulación' => ['titulacion', []],
            'finanzas' => ['finanzas', []],
            // Relaciones en BD y sesión
            'directivo auditor (sesión isAuditor)' => ['directivo', ['isAuditor' => true]],
            'directivo auditor líder' => ['directivo', ['auditor_lider' => true]],
            'docente auditor responsable' => ['docente', ['auditor' => true]],
            'docente líder de acciones' => ['docente', ['lider_acciones' => true]],
            'docente con seguimiento asignado' => ['docente', ['seguimiento_asignado' => true]],
            'docente tutor de reprobación' => ['docente', ['tutor' => true]],
            'directivo tutor' => ['directivo', ['tutor' => true]],
            'docente responsable de área' => ['docente', ['responsable_area' => true]],
            'docente encargado ambiental' => ['docente', ['encargado_ambiental' => true]],
            // Ids fijos
            'usuario 2630 (con unidad)' => ['docente', ['unidad' => 1, 'id_usuario' => 2630]],
            'usuario 2630 (sin unidad)' => ['docente', ['id_usuario' => 2630]],
            'usuario 2662 (sin unidad)' => ['docente', ['id_usuario' => 2662]],
            'escolar con unidad 16' => ['escolar', ['unidad' => 16]],
            // Botón de periodo solo por la condición de unidad 14/20 (menu_admin L1570/L1590)
            'centro de cómputo con unidad 14' => ['computo', ['unidad' => 14]],
            'residencias con unidad 20' => ['residencias', ['unidad' => 20]],
            'profesor de inglés' => ['ingles', []],
        ];
        foreach ($unidades as $u) {
            $e["directivo con unidad $u"] = ['directivo', ['unidad' => $u]];
            $e["docente con actividad y unidad $u"] = ['docente_actividad', ['unidad' => $u]];
        }

        return $e;
    }

    /** Crea el usuario y los datos, y deja la sesión como HomeController@index. Devuelve el usuario. */
    public static function preparar(string $rol, array $o): User
    {
        $usuario = User::factory()->create(array_filter([
            'id' => $o['id_usuario'] ?? null,
            'email' => 'usuario' . ($o['id_usuario'] ?? '') . '@prueba.test',
        ]));
        $idPersonal = self::ID_PERSONAL;

        $sesion = [
            'usuario_alumno' => $usuario->id,
            'nombre' => 'NOMBRE DE PRUEBA',
            'nombre_periodo' => 'AGO-DIC 2026',
            'periodo_actual' => 10,
            'periodo_anterior' => 9,
            'periodo_siguiente' => 11,
            'arre_periodos' => DB::table('gnral_periodos')->get()->all(),
            'p1' => DB::table('gnral_periodos')->where('id_periodo', 9)->first(),
            'p2' => DB::table('gnral_periodos')->where('id_periodo', 10)->first(),
            'men' => 'MENSAJE GLOBAL DE PRUEBA',
        ];

        if ($rol === 'alumno') {
            $sesion += ['palumno' => true, 'tipo_persona' => 1, 'permiso' => 0, 'semestre' => $o['semestre'] ?? 1, 'carrera' => $o['carrera_alumno'] ?? 1];
            $idAlumno = DB::table('gnral_alumnos')->insertGetId(['id_usuario' => $usuario->id, 'id_carrera' => $o['carrera_alumno'] ?? 1]);
            if (! empty($o['alumno_piase'])) {
                $caso = DB::table('ar_casos_estudiantes')->insertGetId(['id_alumno' => $idAlumno]);
                DB::table('ar_caso_canalizaciones')->insert(['id_ar_caso' => $caso]);
            }
            foreach (['ver_eva', 'ver_carga', 'registrar_residencia', 'estado_reg_anteproyecto', 'anteproyecto_aceptado', 'registro_empresa', 'seguimiento_alumno', 'reg_alum_ti', 'ti_segunda_etapa', 'ti_tercera_parte', 'estado_cuenta'] as $bandera) {
                if (! empty($o[$bandera])) {
                    $sesion[$bandera] = true;
                }
            }
        } elseif ($rol === 'ingles') {
            $sesion += ['profesor_ingles' => true, 'tipo_persona' => 3, 'nombre_ingles' => 'PROFESOR DE INGLÉS', 'nombre_periodo_ingles' => 'INGLÉS 2026'];
        } else {
            // Personal (tipo_usuario = 2)
            DB::table('gnral_personales')->insert([
                'id_personal' => $idPersonal,
                'nombre' => 'NOMBRE DE PRUEBA',
                'correo' => $usuario->email,
                'tipo_usuario' => $usuario->id,
                'id_departamento' => 0,
                'estado_docente_inv' => ! empty($o['docente_investigador']) ? 1 : 0,
            ]);
            $sesion += ['tipo_persona' => 2, 'personal_tesvb' => true, 'id_perso' => $idPersonal];

            $banderasRol = [
                'docente_actividad' => ['profesor_conact' => true, 'profesor_men' => true, 'permiso' => 5, 'fecha' => '20 de Agosto del 2026'],
                'docente' => ['profesor_sinact' => true],
                'jefe_division' => ['jefe_division' => true, 'permiso' => 3, 'carrera' => 2, 'id_carrera' => 2, 'nombre_carrera' => 'INGENIERÍA EN SISTEMAS', 'cambio_carreras' => 0],
                'desarrollo' => ['desa' => true, 'jefe_division' => true, 'id_carrera' => 17],
                'directivo' => ['directivo.' => true, 'permiso' => 2],
                'consultas' => ['consultas' => true, 'nombre_carrera' => 'PLANEACIÓN Y CONSULTAS'],
                'escolar' => ['escolar' => true],
                'rh' => ['personal' => true],
                'computo' => ['computo' => true],
                'residencias' => ['residencia' => true],
                'titulacion' => ['titulacion' => true],
                'finanzas' => ['finanzas' => true],
            ][$rol];
            $sesion = array_merge($sesion, $banderasRol);
            if ($rol === 'desarrollo') {
                unset($sesion['men']); // HomeController.php:601-604 está comentado: desarrollo no tiene "men"
            }

            if (! empty($o['dos_carreras'])) {
                $sesion['cambio_carreras'] = 1;
                $sesion['carreras'] = [(object) ['id_carrera' => 2, 'nombre' => 'SISTEMAS'], (object) ['id_carrera' => 3, 'nombre' => 'CIVIL']];
            }
            if (isset($o['unidad'])) {
                $sesion['id_unidad_admin'] = $o['unidad'];
            }
            foreach (['isAuditor', 'revisor', 'seguimiento_asesor', 'personal_academia', 'encargado_ambiental'] as $bandera) {
                if (! empty($o[$bandera])) {
                    $sesion[$bandera] = true;
                }
            }
            if (! empty($o['isc'])) {
                DB::table('gnral_carreras')->insert(['id_carrera' => 2, 'nombre' => 'SISTEMAS', 'siglas' => 'I.S.C.']);
                DB::table('gnral_periodo_carreras')->insert(['id_periodo_carrera' => 1, 'id_carrera' => 2, 'id_periodo' => 10]);
                DB::table('gnral_horarios')->insert(['id_periodo_carrera' => 1, 'id_personal' => $idPersonal]);
            }
            if (! empty($o['auditor_lider'])) {
                DB::table('aud_auditores')->insert(['id_personal' => $idPersonal, 'id_categoria' => 1]);
            }
            if (! empty($o['auditor'])) {
                DB::table('aud_auditores')->insert(['id_personal' => $idPersonal, 'id_categoria' => 2]);
            }
            if (! empty($o['lider_acciones'])) {
                DB::table('aud_lider_acciones')->insert(['id_personal' => $idPersonal]);
            }
            if (! empty($o['seguimiento_asignado'])) {
                DB::table('aud_seguimiento_auditorias')->insert(['id_personal_seguimiento' => $idPersonal, 'activo' => 1]);
            }
            if (! empty($o['responsable_area'])) {
                $area = DB::table('ar_areas_atencion')->insertGetId(['activo' => 1]);
                DB::table('ar_area_responsables_periodo')->insert(['id_area_atencion' => $area, 'id_personal' => $idPersonal, 'activo' => 1]);
            }
            if (! empty($o['tutor'])) {
                self::asignarTutor($idPersonal, $o['reprobados'] ?? 0);
            }
        }

        session()->flush();
        session($sesion);

        return $usuario;
    }

    /** Asigna al personal como tutor en el periodo vigente (10) con N alumnos reprobados. */
    public static function asignarTutor(int $idPersonal, int $reprobados): void
    {
        $jefe = DB::table('gnral_jefes_periodos')->insertGetId(['id_carrera' => 2, 'id_personal' => 1, 'id_periodo' => 10]);
        $generacion = DB::table('exp_asigna_generacion')->insertGetId(['id_jefe_periodo' => $jefe]);
        DB::table('exp_asigna_tutor')->insert(['id_asigna_generacion' => $generacion, 'id_personal' => $idPersonal, 'id_jefe_periodo' => $jefe]);
        for ($i = 1; $i <= $reprobados; $i++) {
            $alumno = 900 + $i;
            DB::table('exp_asigna_alumnos')->insert(['id_asigna_generacion' => $generacion, 'id_alumno' => $alumno, 'estado' => 1]);
            $carga = DB::table('eva_carga_academica')->insertGetId(['id_alumno' => $alumno, 'id_periodo' => 10]);
            DB::table('cal_evaluaciones')->insert(['id_carga_academica' => $carga, 'calificacion' => 60]);
        }
    }

    /** Renderiza el menú viejo (sección "menu" de partials/menu_admin). */
    public static function menuViejo(): string
    {
        return self::conSesionIntacta(function () {
            View::flushState();

            return Blade::render("@include('partials.menu_admin')@yield('menu')");
        });
    }

    /** Renderiza el sidebar nuevo. */
    public static function sidebarNuevo(): string
    {
        return self::conSesionIntacta(function () {
            View::flushState();

            return view('partials.panel.sidebar')->render();
        });
    }

    /** Renderiza el header nuevo (botón de periodo y cerrar sesión viven aquí). */
    public static function headerNuevo(): string
    {
        return self::conSesionIntacta(function () {
            View::flushState();

            return view('partials.panel.header')->render();
        });
    }

    /**
     * Ejecuta el render y deja la sesión como estaba: el bloque del docente con actividad
     * escribe id_carrera en la sesión, y cada vista debe renderizarse con la sesión original.
     */
    private static function conSesionIntacta(callable $render): string
    {
        $antes = session()->all();
        $html = $render();
        $cambios = [];
        foreach (session()->all() as $clave => $valor) {
            if (! array_key_exists($clave, $antes) || serialize($antes[$clave]) !== serialize($valor)) {
                $cambios[$clave] = $valor;
            }
        }
        session()->flush();
        session()->put($antes);

        // El efecto en la sesión debe ser el mismo en ambas vistas; se devuelve junto al HTML.
        return $html . "\n<!--sesion:" . json_encode($cambios) . "-->";
    }

    /**
     * Extrae los enlaces de un HTML: "MÉTODO url [oculto]" con repeticiones, ordenados.
     * Incluye href, window.open(...) y action de formularios. Excluye anclas (#…) y los
     * elementos propios del diseño nuevo (data-panel-propio).
     */
    public static function enlaces(string $html): array
    {
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="utf-8"?><div>' . $html . '</div>');
        libxml_clear_errors();
        $xp = new \DOMXPath($dom);

        $lista = [];
        foreach ($xp->query('//a') as $a) {
            if ($a->hasAttribute('data-panel-propio')) {
                continue;
            }
            $href = trim($a->getAttribute('href'));
            if (preg_match("/window\\.open\\('([^']+)'\\)/", $a->getAttribute('onclick'), $m)) {
                $href = $m[1];
            }
            if ($href === '' || str_starts_with($href, '#')) {
                continue;
            }
            $lista[] = 'GET ' . $href . (self::oculto($a) ? ' [oculto]' : '');
        }
        foreach ($xp->query('//form') as $form) {
            $lista[] = strtoupper($form->getAttribute('method') ?: 'GET') . ' ' . $form->getAttribute('action');
        }
        sort($lista);

        return $lista;
    }

    /** Número de botones o íconos de cambio de periodo. */
    public static function botonesPeriodo(string $html): int
    {
        return substr_count($html, 'id="periodo"') + substr_count($html, 'data-panel-periodo');
    }

    /** Efecto en la sesión que dejó el render (ver conSesionIntacta). */
    public static function efectoSesion(string $html): string
    {
        return preg_match('/<!--sesion:(.*?)-->/s', $html, $m) ? $m[1] : '';
    }

    private static function oculto(\DOMNode $nodo): bool
    {
        for ($n = $nodo; $n instanceof \DOMElement; $n = $n->parentNode) {
            if ($n->nodeName !== 'form' && preg_match('/display:\s*none/', $n->getAttribute('style'))) {
                return true;
            }
        }

        return false;
    }
}
