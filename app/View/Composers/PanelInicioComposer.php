<?php

namespace App\View\Composers;

use App\Services\Panel\DatosDirectivo;
use Illuminate\View\View;

/**
 * Entrega a panel/inicio.blade.php los datos del dashboard según el perfil de la sesión.
 * No cambia la lógica de HomeController2 ni de HomeController: solo agrega la variable $tablero.
 *
 * Por ahora solo el DIRECTIVO tiene dashboard. Para otro perfil: crear su clase en
 * app/Services/Panel/ (misma forma de datos) y agregarla aquí (ver docs/panel.md).
 */
class PanelInicioComposer
{
    public function compose(View $view): void
    {
        $tablero = null;

        // Misma detección que el menú y el panel: la bandera se guarda como "directivo." (HomeController.php:537).
        if (session()->has('directivo')) {
            $tablero = DatosDirectivo::paraPeriodo((int) session('periodo_actual'));
        }

        $view->with('tablero', $tablero);
    }
}
