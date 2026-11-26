<?php

namespace App\View;

final class EncuestaEscolar
{
    public const PREGUNTAS = [
        1 => '¿Considerando que el personal de la Subdirección de Servicios Escolares atiende ventanillas en un horario 9:00 a 18:00 horas, el tiempo es?',
        '¿El tiempo de espera para ser atendido en ventanilla es adecuado?',
        '¿El tiempo de respuesta a mi solicitud es eficiente, cuando me presento con mi documentación completa?',
        '¿La disponibilidad del personal para consultar dudas de tipo académico es adecuada?',
        'Me atienden de forma adecuada cuando solicito su apoyo.',
        '¿Cómo consideras el trámite de inscripción, reinscripción y afiliación al IMSS de manera presencial?',
        '¿Conoces los requisitos para realizar tus trámites?',
        '¿Son claros los requisitos solicitados en las convocatorias para la inscripción, reinscripción y afiliación al IMSS?',
        '¿Cómo consideras el trámite de inscripción, reinscripción y afiliación al IMSS en línea?',
        'Si tu tramite fue rechazado, menciona el motivo o requisito que te hizo falta.',
        'En términos generales el servicio recibido fue',
    ];

    public const ESCALA = [4 => 'Excelente', 3 => 'Buena', 2 => 'Regular', 1 => 'Mala'];

    public const RECHAZADO = [2 => 'No', 1 => 'Sí'];
}
