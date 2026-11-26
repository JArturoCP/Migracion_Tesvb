<?php

namespace App\View;

final class EncuestaMantenimiento
{
    public const PREGUNTAS = [
        1 => 'El tiempo de respuesta a su solicitud fue el adecuado.',
        'La atención proporcionada por el personal de mantenimiento fue la adecuada.',
        'El personal técnico resolvió sus necesidades y dio respuesta a sus requerimientos.',
        'El equipo al que se dio mantenimiento se le entregó limpio.',
    ];

    public const OPCIONES = [5 => 'Excelente', 4 => 'Muy bueno', 3 => 'Bueno', 2 => 'Regular', 1 => 'Malo'];
}
