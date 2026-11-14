<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Pantallas que trabajan con "el alumno de la sesión" (buscan gnral_alumnos por el usuario conectado).
 * Con otro perfil esa búsqueda no encuentra nada y la página fallaba con error 500;
 * ahora responde 403 con un mensaje claro.
 */
class SoloAlumnos
{
    public function handle(Request $request, Closure $next)
    {
        $usuario = Auth::user();
        if ($usuario && (int) $usuario->tipo_usuario !== 1) {
            abort(403, 'Esta sección está disponible solo para alumnos.');
        }
        return $next($request);
    }
}
