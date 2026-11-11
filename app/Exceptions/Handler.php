<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
        \Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        /*
         * Protección general para SGOE.
         *
         * Evita que el sistema aborte cuando un documento, evidencia,
         * PDF o archivo físico ya no existe en producción.
         *
         * En lugar de usar solamente redirect()->back()->with(...),
         * se devuelve una pantalla directa de aviso, porque no todas
         * las vistas del sistema imprimen los mensajes de sesión.
         */
        if ($this->esErrorArchivoNoDisponible($exception) && $this->esRutaSgoe($request)) {
            $mensaje = 'El documento no se encuentra disponible. Contacte al líder o al administrador del sistema.';

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $mensaje,
                ], 404);
            }

            $urlRegreso = url()->previous();

            if (!$urlRegreso || $urlRegreso === $request->fullUrl()) {
                $urlRegreso = url('/inicio');
            }

            return response()->view('errors.documento_no_disponible', [
                'mensaje' => $mensaje,
                'urlRegreso' => $urlRegreso,
            ], 200);
        }

        return parent::render($request, $exception);
    }

    /**
     * Indica si la ruta pertenece al flujo SGOE / Auditorías.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    private function esRutaSgoe($request)
    {
        return $request->is('auditorias')
            || $request->is('auditorias/*')
            || $request->is('sgoe')
            || $request->is('sgoe/*')
            || $request->is('archivo_alumno/*')
            || $request->is('archivo_docente/*');
    }

    /**
     * Identifica errores comunes cuando un archivo físico no existe.
     *
     * @param  \Exception  $exception
     * @return bool
     */
    private function esErrorArchivoNoDisponible(Exception $exception)
    {
        if ($exception instanceof FileNotFoundException) {
            return true;
        }

        $mensaje = strtolower($exception->getMessage());

        if (strpos($mensaje, 'file does not exist') !== false) {
            return true;
        }

        if (strpos($mensaje, 'no such file or directory') !== false) {
            return true;
        }

        if (strpos($mensaje, 'failed to open stream') !== false) {
            return true;
        }

        if (strpos($mensaje, 'the file "') !== false && strpos($mensaje, '" does not exist') !== false) {
            return true;
        }

        if (strpos($mensaje, 'unable to read file') !== false) {
            return true;
        }

        if (strpos($mensaje, 'is not readable') !== false) {
            return true;
        }

        return false;
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }
}
