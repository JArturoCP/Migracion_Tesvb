<?php

namespace App\Services\Panel;

use App\Services\TemaCarreraResolver;
use Illuminate\Contracts\Auth\Authenticatable;

final class TemaVisualEstudiantil
{
    public function __construct(private readonly TemaCarreraResolver $carreras)
    {
    }

    public function colorEfectivo(?Authenticatable $usuario): ?string
    {
        $temaPredeterminado = $this->carreras->para($usuario);
        $color = $temaPredeterminado['primary'] ?? null;

        return $temaPredeterminado['matched'] && is_string($color) && preg_match('/\A#[0-9a-f]{6}\z/i', $color)
            ? $color
            : null;
    }
}
