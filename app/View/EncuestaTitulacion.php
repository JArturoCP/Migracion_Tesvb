<?php

namespace App\View;

final class EncuestaTitulacion
{
    public const PREGUNTAS = [
        'resp_preg4' => 'Se me comentó dónde debo realizar el trámite de titulación',
        'resp_preg5' => 'Se me brindó la información acerca de cómo debo realizar el trámite de titulación',
        'resp_preg6' => 'Se me dieron a conocer las opciones de titulación',
        'resp_preg7' => 'La persona que me atendió respondió a mis dudas',
        'resp_preg8' => 'Se me informó en tiempo y forma si se realizaron cambios en el proceso de titulación',
        'resp_preg9' => 'Creo que tener una plática de titulación antes de egresar es',
        'resp_preg10' => 'Me informaron sobre la plática de titulación',
        'resp_preg11' => 'Asistí a la plática de titulación',
        'resp_preg12' => 'Fue clara la plática de titulación',
        'resp_preg13' => 'Se respetó mi turno',
        'resp_preg14' => 'Me atendieron adecuadamente',
        'resp_preg15' => 'El tiempo del proceso de titulación fue',
        'resp_preg16' => 'El trámite fue sencillo',
        'resp_preg17' => 'El proceso es claro',
        'resp_preg18' => 'Fui tratado con respeto, cortesía y amabilidad',
    ];

    public const SI_NO = [1 => 'Sí', 2 => 'No'];

    public const ESCALAS = [
        'resp_preg9' => [5 => 'Muy importante', 4 => 'Importante', 3 => 'Me da igual', 2 => 'Poca importancia', 1 => 'Sin importancia'],
        'resp_preg15' => [5 => 'Muy extenso', 4 => 'Extenso', 3 => 'Adecuado', 2 => 'Corto', 1 => 'Muy corto'],
    ];
}
