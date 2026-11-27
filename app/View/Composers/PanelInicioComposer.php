<?php

namespace App\View\Composers;

use App\Services\Panel\DatosComputo;
use App\Services\Panel\DatosConsultas;
use App\Services\Panel\DatosDesarrollo;
use App\Services\Panel\DatosDirectivo;
use App\Services\Panel\DatosDocente;
use App\Services\Panel\DatosEscolares;
use App\Services\Panel\DatosFinanzas;
use App\Services\Panel\DatosJefeDivision;
use App\Services\Panel\DatosRecursosHumanos;
use App\Services\Panel\DatosResidencia;
use App\Services\Panel\DatosTitulacion;
use App\Services\Panel\EncabezadoPersonal;
use Illuminate\View\View;

/**
 * Entrega a panel/inicio.blade.php los datos del dashboard según el perfil de la sesión.
 * No cambia la lógica de HomeController2 ni de HomeController: solo agrega variables.
 *
 * Perfiles con dashboard: DIRECTIVO, PLANEACIÓN Y CONSULTAS, FINANZAS, TITULACIÓN, RESIDENCIAS, CENTRO DE CÓMPUTO, RECURSOS HUMANOS, SERVICIOS ESCOLARES, DESARROLLO ACADÉMICO, JEFE DE DIVISIÓN y DOCENTE (siempre por bandera de rol). Para otro perfil: crear su clase en
 * app/Services/Panel/ (misma forma de datos) y agregarla aquí (ver docs/panel.md y docs/DASHBOARD_ROLES.md).
 */
class PanelInicioComposer
{
    public function compose(View $view): void
    {
        $tablero = null;
        $perfilTablero = null; // nombre de la vista resources/views/panel/dashboard/{perfil}.blade.php
        $encabezado = null;    // solo perfiles con el encabezado grande (x-panel.hero)

        // Misma detección que el menú y el panel: la bandera se guarda como "directivo." (HomeController.php:537).
        if (session()->has('directivo')) {
            $perfilTablero = 'directivo';
            $tablero = DatosDirectivo::paraPeriodo((int) session('periodo_actual'));
        } elseif (session()->has('consultas')) {
            // Planeación y Consultas (departamento 3, HomeController.php:589-597). Ver docs/DASHBOARD_CONSULTAS.md.
            $perfilTablero = 'consultas';
            $tablero = DatosConsultas::paraPeriodo((int) session('periodo_actual'));
            $encabezado = DatosConsultas::encabezado((int) session('id_perso') ?: null);
        } elseif (session()->has('finanzas')) {
            // Finanzas (departamento 10, HomeController.php:655-662). Sus pantallas trabajan por ejercicio fiscal
            // (año calendario), no por periodo escolar. Ver docs/DASHBOARD_FINANZAS.md.
            $perfilTablero = 'finanzas';
            $tablero = DatosFinanzas::paraAnio((int) now()->year);
            $encabezado = EncabezadoPersonal::datos((int) session('id_perso') ?: null);
        } elseif (session()->has('titulacion')) {
            // Titulación: misma bandera que usa el menú ($departamento_titulacion). HomeController solo la pone a personal
            // (tipo_usuario 2) con gnral_personales.id_departamento == 9 (HomeController.php:645-652). Se asigna por
            // rol, nunca por correo ni por id de usuario. Ver docs/DASHBOARD_TITULACION.md.
            $perfilTablero = 'titulacion';
            $tablero = DatosTitulacion::paraAnio((int) now()->year);
            $encabezado = EncabezadoPersonal::datos((int) session('id_perso') ?: null);
        } elseif (session()->has('residencia')) {
            // Residencias Profesionales: misma bandera que usa el menú ($jefe_residencia). HomeController solo la pone a
            // personal (tipo_usuario 2) con gnral_personales.id_departamento == 8 (HomeController.php:637-644). No la
            // reciben los docentes que solo son asesores o revisores (banderas "seguimiento_asesor" y "revisor").
            // Se asigna por rol, nunca por correo ni por id de usuario. Ver docs/DASHBOARD_RESIDENCIA.md.
            $perfilTablero = 'residencia';
            $tablero = DatosResidencia::paraPeriodo((int) session('periodo_actual'));
            $encabezado = EncabezadoPersonal::datos((int) session('id_perso') ?: null);
        } elseif (session()->has('computo')) {
            // Centro de Cómputo: misma bandera que usa el menú ($jefe_computo). HomeController solo la pone a personal
            // (tipo_usuario 2) con gnral_personales.id_departamento == 7 (HomeController.php:627-635). No depende de la
            // unidad administrativa. Se asigna por rol, nunca por correo ni por id de usuario. Ver docs/DASHBOARD_COMPUTO.md.
            $perfilTablero = 'computo';
            $tablero = DatosComputo::paraPeriodo((int) session('periodo_actual'), (int) now()->year);
            $encabezado = EncabezadoPersonal::datos((int) session('id_perso') ?: null);
        } elseif (session()->has('personal')) {
            // Recursos Humanos: misma bandera que usa el menú ($jefe_personal). HomeController solo la pone a personal
            // (tipo_usuario 2) con gnral_personales.id_departamento == 6 (HomeController.php:618-626). No confundir con
            // "personal_tesvb", que tiene todo el personal. Se asigna por rol, nunca por correo ni por id de usuario.
            // Ver docs/DASHBOARD_RH.md.
            $perfilTablero = 'rh';
            $tablero = DatosRecursosHumanos::paraAnio((int) now()->year);
            $encabezado = EncabezadoPersonal::datos((int) session('id_perso') ?: null);
        } elseif (session()->has('escolar')) {
            // Servicios Escolares: misma bandera que usa el menú ($escolar). HomeController solo la pone a personal
            // (tipo_usuario 2) con gnral_personales.id_departamento == 5 (HomeController.php:609-617). El directivo comparte el
            // grupo "Control Escolar" del menú, pero no tiene esta bandera y conserva su dashboard (rama anterior).
            // Se asigna por rol, nunca por correo ni por id de usuario. Ver docs/DASHBOARD_ESCOLARES.md.
            $perfilTablero = 'escolar';
            $tablero = DatosEscolares::paraPeriodo((int) session('periodo_actual'));
            $encabezado = EncabezadoPersonal::datos((int) session('id_perso') ?: null);
        } elseif (session()->has('desa')) {
            // Desarrollo Académico: misma bandera que usa el menú ($desa). HomeController solo la pone a personal
            // (tipo_usuario 2) con gnral_personales.id_departamento == 4 (HomeController.php:599-608). Ese bloque también pone
            // "jefe_division" (carrera 17), que tienen los jefes de división reales: por eso se usa "desa" y no esa bandera.
            // Se asigna por rol, nunca por correo ni por id de usuario. Ver docs/DASHBOARD_DESARROLLO.md.
            $perfilTablero = 'desarrollo';
            $tablero = DatosDesarrollo::paraPeriodo((int) session('periodo_actual'));
            $encabezado = EncabezadoPersonal::datos((int) session('id_perso') ?: null);
        } elseif (session()->has('jefe_division') && ! session()->has('desa')) {
            // Jefe de División: misma bandera que usa el menú ($jefe_division). HomeController la pone a personal
            // (tipo_usuario 2) con gnral_personales.id_departamento == 2 (HomeController.php:543-587) y guarda su carrera
            // (gnral_jefes_periodos) en session('carrera'), la que usan sus módulos. Desarrollo Académico también tiene
            // "jefe_division" (carrera 17): se excluye y su rama va antes. La carrera se valida contra gnral_jefes_periodos
            // por id_perso (nunca por correo); si no es suya, no se consulta nada. Ver docs/DASHBOARD_JEFE_DIVISION.md.
            $perfilTablero = 'jefe_division';
            $idCarrera = (int) session('carrera');
            $tablero = DatosJefeDivision::carreraPermitida((int) session('id_perso') ?: null, $idCarrera ?: null)
                ? DatosJefeDivision::paraCarrera($idCarrera, (int) session('periodo_actual'))
                : null;
            $encabezado = EncabezadoPersonal::datos((int) session('id_perso') ?: null);
        } elseif (session()->has('profesor_sinact') || session()->has('profesor_conact')) {
            // Docente: mismas banderas que usa el menú ($profesor_sinact / $profesor_conact). HomeController solo las pone a
            // personal (tipo_usuario 2) con gnral_personales.id_departamento == 0 (HomeController.php:411-527); un jefe de
            // división o un directivo que también dé clases sale antes por su departamento y no las recibe. Los datos son
            // del docente de la sesión (id_perso, nunca un id de la URL ni el correo). "Hoy" se calcula fuera de la caché.
            // Ver docs/DASHBOARD_DOCENTE.md.
            $perfilTablero = 'docente';
            $tablero = DatosDocente::paraDocente((int) session('id_perso'), (int) session('periodo_actual'));
            $tablero = $tablero === null ? null : DatosDocente::conHoy($tablero);
            $encabezado = EncabezadoPersonal::datos((int) session('id_perso') ?: null);
        }

        $view->with('tablero', $tablero)->with('perfilTablero', $perfilTablero)->with('encabezadoPerfil', $encabezado);
    }
}
