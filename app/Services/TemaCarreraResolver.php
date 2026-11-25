<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Container\Attributes\Scoped;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Database\ConnectionResolverInterface;
use Illuminate\Database\QueryException;

/**
 * Identidad visual, nunca autorización. Recibir el usuario autenticado del servidor.
 * No lee parámetros del navegador ni modifica sesiones, modelos o registros.
 */
#[Scoped]
final class TemaCarreraResolver
{
    private readonly array $themes;

    /** @var array<int, array<string, mixed>> */
    private array $resolved = [];

    public function __construct(
        private readonly ConnectionResolverInterface $database,
        Repository $configuration,
    ) {
        $themes = $configuration->get('tesvb_themes');
        // Permite usar el nuevo catálogo incluso si una caché anterior no incluye esta clave.
        $this->themes = is_array($themes)
            ? $themes
            : require dirname(__DIR__, 2).'/config/tesvb_themes.php';
    }

    /**
     * Devuelve los colores y la ruta de una única imagen, junto con el motivo de resolución.
     * El resultado se reutiliza por cuenta durante esta petición; no se guarda en sesión.
     *
     * @return array<string, mixed>
     */
    public function para(?Authenticatable $user): array
    {
        if ($user === null || ! in_array($user->tipo_usuario ?? null, [1, '1'], true)) {
            return $this->neutral('not_student');
        }

        $userId = $this->positiveInteger($user->getAuthIdentifier());
        if ($userId === null) {
            return $this->neutral('invalid_user_id');
        }

        if (array_key_exists($userId, $this->resolved)) {
            return $this->resolved[$userId];
        }

        try {
            $students = $this->database->connection()
                ->table('gnral_alumnos as a')
                ->leftJoin('gnral_carreras as c', 'c.id_carrera', '=', 'a.id_carrera')
                ->where('a.id_usuario', $userId)
                ->limit(2)
                ->get(['a.id_alumno', 'a.id_carrera', 'c.id_carrera as catalogo_id', 'c.nombre']);
        } catch (QueryException) {
            return $this->resolved[$userId] = $this->neutral('database_error');
        }

        if ($students->isEmpty()) {
            return $this->resolved[$userId] = $this->neutral('missing_student');
        }

        if ($students->count() !== 1) {
            return $this->resolved[$userId] = $this->neutral('ambiguous_student');
        }

        $student = $students->first();
        if ($this->positiveInteger($student->id_alumno ?? null) === null) {
            return $this->resolved[$userId] = $this->neutral('incomplete_student');
        }

        $careerId = $this->positiveInteger($student->id_carrera ?? null);
        if ($careerId === null || $this->positiveInteger($student->catalogo_id ?? null) !== $careerId) {
            return $this->resolved[$userId] = $this->neutral('missing_career');
        }

        return $this->resolved[$userId] = $this->paraCarrera($careerId, $student->nombre ?? null);
    }

    public function paraCarrera(mixed $id, mixed $nombre): array
    {
        $careerId = $this->positiveInteger($id);
        if ($careerId === null) {
            return $this->neutral('missing_career');
        }

        $name = $this->normalizeName($nombre);
        if ($name === null) {
            return $this->neutral('missing_career_name');
        }

        $matched = null;
        foreach ($this->themes['careers'] as $theme) {
            $acceptedNames = array_map($this->normalizeName(...), [$theme['name'], ...($theme['aliases'] ?? [])]);
            if (! in_array($name, $acceptedNames, true)) {
                continue;
            }
            if ($matched !== null) {
                return $this->neutral('ambiguous_career_theme');
            }
            $matched = $theme;
        }

        if ($matched === null) {
            return $this->neutral('career_name_mismatch');
        }
        unset($matched['aliases']);

        return [...$matched, 'career_id' => $careerId, 'matched' => true, 'reason' => 'matched'];
    }

    private function neutral(string $reason): array
    {
        return [...$this->themes['neutral'], 'matched' => false, 'reason' => $reason];
    }

    private function normalizeName(mixed $name): ?string
    {
        if (! is_string($name) || ! mb_check_encoding($name, 'UTF-8')) {
            return null;
        }

        $name = strtr(mb_strtolower($name, 'UTF-8'), [
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o',
            'ú' => 'u', 'ü' => 'u', 'ñ' => 'n',
        ]);
        // También contempla acentos Unicode descompuestos y espacios no separables.
        $name = preg_replace('/\p{M}+/u', '', $name);
        $name = trim(preg_replace('/[\p{Z}\s]+/u', ' ', $name));

        return $name === '' ? null : $name;
    }

    private function positiveInteger(mixed $value): ?int
    {
        if (is_int($value)) {
            return $value > 0 ? $value : null;
        }

        if (! is_string($value) || ! preg_match('/\A[1-9][0-9]*\z/', $value)) {
            return null;
        }

        $integer = filter_var($value, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

        return $integer === false ? null : $integer;
    }
}
