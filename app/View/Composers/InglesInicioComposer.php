<?php

namespace App\View\Composers;

use App\Services\Panel\DatosProfesorIngles;
use Illuminate\View\View;

/**
 * Entrega a ingles/inicio_ingles/inicio_ingles.blade.php (/ingles) las métricas del profesor de inglés.
 * No cambia In_inicioController@index (sigue devolviendo la vista sin datos): solo agrega $tableroIngles,
 * y únicamente cuando la sesión es de profesor de inglés (bandera profesor_ingles de HomeController).
 */
class InglesInicioComposer
{
    public function compose(View $view): void
    {
        $tableroIngles = null;
        $esProfesorIngles = session()->has('profesor_ingles');

        if ($esProfesorIngles) {
            $tableroIngles = DatosProfesorIngles::para(session('id_profesor_ingles'), session('periodo_ingles'));
        }

        $view->with('tableroIngles', $tableroIngles)->with('esProfesorIngles', $esProfesorIngles);
    }
}
