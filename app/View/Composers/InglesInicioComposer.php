<?php

namespace App\View\Composers;

use App\Services\Panel\DatosIngles;
use Illuminate\View\View;

/**
 * Entrega a ingles/inicio_ingles/inicio_ingles.blade.php (/ingles) los datos del dashboard, igual que
 * PanelInicioComposer lo hace para /inicio. In_inicioController@index no cambia (sigue sin enviar datos).
 *
 * Por ahora solo el PROFESOR DE INGLÉS (bandera profesor_ingles de HomeController) tiene dashboard;
 * el alumno y la coordinación (unidad 19) ven bienvenida, avisos y accesos.
 */
class InglesInicioComposer
{
    public function compose(View $view): void
    {
        $tablero = null;
        $perfilTablero = null; // vista resources/views/panel/dashboard/{perfil}.blade.php

        if (session()->has('profesor_ingles')) {
            $perfilTablero = 'profesor_ingles';
            $tablero = DatosIngles::paraProfesor(session('id_profesor_ingles'), session('periodo_ingles'));
        }

        $view->with('tablero', $tablero)->with('perfilTablero', $perfilTablero);
    }
}
