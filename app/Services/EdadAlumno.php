<?php

namespace App\Services;

use DateTimeImmutable;
use DateTimeZone;
use Illuminate\Support\Carbon;

final class EdadAlumno
{
    public const ZONA_HORARIA = 'America/Mexico_City';

    public static function fecha(?string $valor): ?string
    {
        if ($valor === null || !preg_match('~^(?:[0-9]{4}-[0-9]{2}-[0-9]{2}|[0-9]{2}/[0-9]{2}/[0-9]{4})$~D', $valor)) {
            return null;
        }

        foreach (['Y-m-d', 'd/m/Y'] as $formato) {
            $fecha = DateTimeImmutable::createFromFormat('!' . $formato, $valor, new DateTimeZone(self::ZONA_HORARIA));
            if ($fecha && $fecha->format($formato) === $valor && (int) $fecha->format('Y') > 0) {
                return $fecha->format('Y-m-d');
            }
        }

        return null;
    }

    public static function calcular(?string $valor): ?int
    {
        $fecha = self::fecha($valor);
        $hoy = Carbon::today(self::ZONA_HORARIA)->toDateString();
        if ($fecha === null || $fecha > $hoy) {
            return null;
        }

        return (new DateTimeImmutable($fecha))->diff(new DateTimeImmutable($hoy))->y;
    }
}
