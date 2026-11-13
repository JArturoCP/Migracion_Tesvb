<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf as FPDF;
use Illuminate\Support\Facades\DB;
use Session;


/*
|--------------------------------------------------------------------------
| CLASE PDF
|--------------------------------------------------------------------------
*/

class PDF_Dual_PDF_Carga_Academica_Control extends FPDF
{
    /*
    |--------------------------------------------------------------------------
    | CABECERA
    |--------------------------------------------------------------------------
    */

    function Header()
    {
        /*
        |--------------------------------------------------------------------------
        | LOGO
        |--------------------------------------------------------------------------
        |
        | El logo queda arriba y centrado.
        |
        */

        $this->Image(
            'img/tes.png',
            119,
            4,
            40
        );


        /*
        |--------------------------------------------------------------------------
        | NOMBRE DE LA INSTITUCIÓN
        |--------------------------------------------------------------------------
        */

        $this->SetXY(
            7,
            20
        );

        $this->SetFont(
            'Arial',
            'B',
            8
        );

        $this->Cell(
            265,
            5,
            utf8_decode(
                'TECNOLÓGICO DE ESTUDIOS SUPERIORES DE VALLE DE BRAVO'
            ),
            0,
            1,
            'C'
        );


        /*
        |--------------------------------------------------------------------------
        | TÍTULO
        |--------------------------------------------------------------------------
        */

        $this->SetXY(
            7,
            26
        );

        $this->SetFont(
            'Arial',
            'B',
            13
        );

        $this->Cell(
            265,
            6,
            utf8_decode(
                'Carga Académica'
            ),
            0,
            1,
            'C'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PIE
    |--------------------------------------------------------------------------
    */

    function Footer()
    {
        $this->SetY(
            -8
        );

        $this->SetFont(
            'Arial',
            '',
            6.5
        );

        $this->Cell(
            0,
            4,
            utf8_decode(
                'FO-TESVB-39  V.1  14-08-2019'
            ),
            0,
            0,
            'R'
        );
    }
}


/*
|--------------------------------------------------------------------------
| CONTROLADOR
|--------------------------------------------------------------------------
*/

class Dual_PDF_Carga_Academica_Control extends Controller
{

    public function index($id)
    {

        /*
        |--------------------------------------------------------------------------
        | PERIODO
        |--------------------------------------------------------------------------
        */

        $periodo =
            Session::get(
                'periodo_actual'
            );


        /*
        |--------------------------------------------------------------------------
        | PDF
        |--------------------------------------------------------------------------
        */

        $pdf = new PDF_Dual_PDF_Carga_Academica_Control(
            'L',
            'mm',
            'Letter'
        );


        /*
        |--------------------------------------------------------------------------
        | MÁRGENES
        |--------------------------------------------------------------------------
        */

        $pdf->SetMargins(
            7,
            34,
            7
        );


        /*
        |--------------------------------------------------------------------------
        | MUY IMPORTANTE
        |--------------------------------------------------------------------------
        |
        | No permitir que FPDF cree páginas adicionales.
        |
        */

        $pdf->SetAutoPageBreak(
            false
        );


        /*
        |--------------------------------------------------------------------------
        | UNA SOLA HOJA
        |--------------------------------------------------------------------------
        */

        $pdf->AddPage();


        /*
        |--------------------------------------------------------------------------
        | COLORES
        |--------------------------------------------------------------------------
        */

        $pdf->SetDrawColor(
            0,
            0,
            0
        );

        $pdf->SetLineWidth(
            0.25
        );


        /*
        |--------------------------------------------------------------------------
        | VALIDACIÓN
        |--------------------------------------------------------------------------
        */

        $validacion =
            DB::selectOne(
                '
                SELECT
                    estado_validacion,
                    id_alumno
                FROM eva_validacion_de_cargas
                WHERE id = ?
                AND id_periodo = ?
                ',
                [
                    $id,
                    $periodo
                ]
            );


        /*
        |--------------------------------------------------------------------------
        | VALIDAR RESULTADO
        |--------------------------------------------------------------------------
        */

        if (!$validacion) {

            abort(404, 'No se encontró la validación de la carga académica.');
        }


        /*
        |--------------------------------------------------------------------------
        | ID ALUMNO
        |--------------------------------------------------------------------------
        */

        $id_usuario =
            $validacion->id_alumno;


        /*
        |--------------------------------------------------------------------------
        | DATOS ALUMNO
        |--------------------------------------------------------------------------
        */

        $datosalumno =
            DB::selectOne(
                '
                SELECT *
                FROM gnral_alumnos
                WHERE id_alumno = ?
                ',
                [
                    $id_usuario
                ]
            );


        if (!$datosalumno) {

            abort(404, 'No se encontró el alumno.');
        }


        /*
        |--------------------------------------------------------------------------
        | CARRERA
        |--------------------------------------------------------------------------
        */

        $carreralumno =
            DB::selectOne(
                '
                SELECT nombre
                FROM gnral_carreras
                WHERE id_carrera = ?
                ',
                [
                    $datosalumno->id_carrera
                ]
            );


        /*
        |--------------------------------------------------------------------------
        | PERIODO
        |--------------------------------------------------------------------------
        */

        $periodoc =
            DB::selectOne(
                '
                SELECT periodo
                FROM gnral_periodos
                WHERE id_periodo = ?
                ',
                [
                    $periodo
                ]
            );


        /*
        |--------------------------------------------------------------------------
        | DATOS DEL ALUMNO
        |--------------------------------------------------------------------------
        */

        $pdf->SetY(
            35
        );


        /*
        |--------------------------------------------------------------------------
        | ANCHO TOTAL
        |--------------------------------------------------------------------------
        |
        | Letter horizontal:
        |
        | 279.4 mm
        |
        | Márgenes:
        |
        | 7 + 7 = 14
        |
        | Área útil:
        |
        | 265.4 mm
        |
        */

        $anchoTotal = 265;


        /*
        |--------------------------------------------------------------------------
        | FILA 1
        |--------------------------------------------------------------------------
        */

        $pdf->SetFillColor(
            166,
            166,
            166
        );

        $pdf->SetFont(
            'Arial',
            'B',
            7.5
        );


        $pdf->Cell(
            27,
            5,
            'CICLO ESCOLAR',
            1,
            0,
            'C',
            true
        );


        $pdf->SetFont(
            'Arial',
            '',
            8
        );

        $pdf->Cell(
            55,
            5,
            $periodoc->periodo,
            1,
            0,
            'C'
        );


        $pdf->SetFont(
            'Arial',
            'B',
            7.5
        );

        $pdf->Cell(
            45,
            5,
            utf8_decode(
                'PROGRAMA ACADÉMICO'
            ),
            1,
            0,
            'C',
            true
        );


        /*
        | Carrera
        */

        $pdf->SetFont(
            'Arial',
            '',
            7.5
        );

        $pdf->Cell(
            138,
            5,
            utf8_decode(
                $carreralumno->nombre
            ),
            1,
            1,
            'L'
        );


        /*
        |--------------------------------------------------------------------------
        | FILA 2
        |--------------------------------------------------------------------------
        */

        $pdf->SetFont(
            'Arial',
            'B',
            7.5
        );

        $pdf->Cell(
            27,
            5,
            'NO. DE CUENTA',
            1,
            0,
            'C',
            true
        );


        $pdf->SetFont(
            'Arial',
            '',
            8
        );

        $pdf->Cell(
            55,
            5,
            $datosalumno->cuenta,
            1,
            0,
            'C'
        );


        $pdf->SetFont(
            'Arial',
            'B',
            7.5
        );

        $pdf->Cell(
            45,
            5,
            'NOMBRE DEL ESTUDIANTE',
            1,
            0,
            'C',
            true
        );


        $nombreAlumno =
            $datosalumno->nombre .
            ' ' .
            $datosalumno->apaterno .
            ' ' .
            $datosalumno->amaterno;


        $pdf->SetFont(
            'Arial',
            '',
            7.5
        );

        $pdf->Cell(
            138,
            5,
            utf8_decode(
                $nombreAlumno
            ),
            1,
            1,
            'L'
        );


        /*
        |--------------------------------------------------------------------------
        | ESPACIO ANTES DE LA TABLA
        |--------------------------------------------------------------------------
        */

        $pdf->Ln(
            3
        );


        /*
        |--------------------------------------------------------------------------
        | CONSULTA DE MATERIAS
        |--------------------------------------------------------------------------
        */

        $consulta =
            DB::select(
                '
                SELECT

                    eva_carga_academica.id_carga_academica,

                    gnral_materias.id_materia,

                    gnral_materias.clave,

                    gnral_materias.nombre,

                    gnral_materias.id_semestre,

                    gnral_materias.creditos,

                    eva_status_materia.nombre_status,

                    eva_tipo_curso.nombre_curso,

                    eva_carga_academica.grupo

                FROM
                    gnral_materias,
                    eva_status_materia,
                    eva_tipo_curso,
                    gnral_grupos,
                    eva_carga_academica,
                    gnral_periodos,
                    gnral_alumnos

                WHERE

                    eva_carga_academica.id_materia =
                    gnral_materias.id_materia

                    AND eva_carga_academica.id_status_materia =
                    eva_status_materia.id_status_materia

                    AND eva_carga_academica.id_tipo_curso =
                    eva_tipo_curso.id_tipo_curso

                    AND eva_carga_academica.id_periodo =
                    gnral_periodos.id_periodo

                    AND eva_carga_academica.grupo =
                    gnral_grupos.id_grupo

                    AND eva_carga_academica.id_alumno =
                    gnral_alumnos.id_alumno

                    AND gnral_periodos.id_periodo = ?

                    AND eva_carga_academica.id_alumno = ?

                ORDER BY
                    gnral_materias.id_semestre,
                    gnral_materias.clave
                ',
                [
                    $periodo,
                    $id_usuario
                ]
            );


        /*
        |--------------------------------------------------------------------------
        | TOTAL CRÉDITOS
        |--------------------------------------------------------------------------
        */

        $suma = 0;


        foreach (
            $consulta
            as $materia
        ) {

            if (
                $materia->id_materia != 2258
            ) {

                $suma +=
                    $materia->creditos;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | CANTIDAD
        |--------------------------------------------------------------------------
        */

        $cantidadMaterias =
            count(
                $consulta
            );


        /*
        |--------------------------------------------------------------------------
        | CONFIGURACIÓN DINÁMICA
        |--------------------------------------------------------------------------
        */

        if (
            $cantidadMaterias <= 9
        ) {

            $fontMateria = 7.5;
            $altoLinea = 4.5;

        } elseif (
            $cantidadMaterias <= 11
        ) {

            $fontMateria = 7;
            $altoLinea = 4;

        } elseif (
            $cantidadMaterias <= 13
        ) {

            $fontMateria = 6.5;
            $altoLinea = 3.7;

        } elseif (
            $cantidadMaterias <= 15
        ) {

            $fontMateria = 6;
            $altoLinea = 3.4;

        } else {

            $fontMateria = 5.5;
            $altoLinea = 3.2;
        }


        /*
        |--------------------------------------------------------------------------
        | ENCABEZADO DE TABLA
        |--------------------------------------------------------------------------
        */

        /*
        | SUMA EXACTA:
        |
        | 27 + 105 + 22 + 43 + 40 + 28 = 265
        |
        */

        $pdf->SetFillColor(
            166,
            166,
            166
        );

        $pdf->SetFont(
            'Arial',
            'B',
            7
        );


        /*
        | CLAVE
        */

        $pdf->Cell(
            27,
            8,
            utf8_decode(
                'CLAVE DE LA MATERIA'
            ),
            1,
            0,
            'C',
            true
        );


        /*
        | NOMBRE
        */

        $pdf->Cell(
            105,
            8,
            'NOMBRE DE LA MATERIA',
            1,
            0,
            'C',
            true
        );


        /*
        | CREDITOS
        */

        $pdf->Cell(
            22,
            8,
            'CREDITOS',
            1,
            0,
            'C',
            true
        );


        /*
        | STATUS
        */

        $pdf->Cell(
            43,
            8,
            'STATUS DE LA MATERIA',
            1,
            0,
            'C',
            true
        );


        /*
        | TIPO
        */

        $pdf->Cell(
            40,
            8,
            'TIPO CURSO',
            1,
            0,
            'C',
            true
        );


        /*
        | GRUPO
        */

        $pdf->Cell(
            28,
            8,
            'GRUPO',
            1,
            1,
            'C',
            true
        );


        /*
        |--------------------------------------------------------------------------
        | POSICIÓN INICIAL
        |--------------------------------------------------------------------------
        */

        $y =
            $pdf->GetY();


        /*
        |--------------------------------------------------------------------------
        | MATERIAS
        |--------------------------------------------------------------------------
        */

        foreach (
            $consulta
            as $materia
        ) {

            /*
            |--------------------------------------------------------------------------
            | FUENTE
            |--------------------------------------------------------------------------
            */

            $pdf->SetFont(
                'Arial',
                '',
                $fontMateria
            );


            /*
            |--------------------------------------------------------------------------
            | ALTURA DE LA FILA
            |--------------------------------------------------------------------------
            */

            $nombreMateria =
                utf8_decode(
                    $materia->nombre
                );


            /*
            | Calcular número aproximado de líneas.
            */

            $palabras =
                explode(
                    ' ',
                    $nombreMateria
                );


            $linea =
                '';

            $lineas =
                1;


            foreach (
                $palabras
                as $palabra
            ) {

                $prueba =
                    trim(
                        $linea .
                        ' ' .
                        $palabra
                    );


                if (
                    $pdf->GetStringWidth(
                        $prueba
                    ) > 101
                ) {

                    $lineas++;

                    $linea =
                        $palabra;

                } else {

                    $linea =
                        $prueba;
                }
            }


            /*
            |--------------------------------------------------------------------------
            | ALTURA
            |--------------------------------------------------------------------------
            */

            $altura =
                $lineas *
                $altoLinea;


            /*
            | Máximo de altura por fila.
            */

            if (
                $altura > 8
            ) {

                $altura = 8;
            }


            /*
            |--------------------------------------------------------------------------
            | CLAVE
            |--------------------------------------------------------------------------
            */

            $pdf->SetXY(
                7,
                $y
            );

            $pdf->Cell(
                27,
                $altura,
                utf8_decode(
                    $materia->clave
                ),
                1,
                0,
                'C'
            );


            /*
            |--------------------------------------------------------------------------
            | NOMBRE
            |--------------------------------------------------------------------------
            */

            $pdf->SetXY(
                34,
                $y
            );

            /*
            | Usamos MultiCell solamente
            | para la columna del nombre.
            */

            $pdf->MultiCell(
                105,
                $altoLinea,
                $nombreMateria,
                1,
                'L'
            );


            /*
            |--------------------------------------------------------------------------
            | CRÉDITOS
            |--------------------------------------------------------------------------
            */

            $pdf->SetXY(
                139,
                $y
            );


            if (
                $materia->id_materia == 2258
            ) {

                $creditos = '';

            } else {

                $creditos =
                    $materia->creditos;
            }


            $pdf->Cell(
                22,
                $altura,
                $creditos,
                1,
                0,
                'C'
            );


            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            $pdf->Cell(
                43,
                $altura,
                utf8_decode(
                    $materia->nombre_status
                ),
                1,
                0,
                'C'
            );


            /*
            |--------------------------------------------------------------------------
            | TIPO DE CURSO
            |--------------------------------------------------------------------------
            */

            $pdf->Cell(
                40,
                $altura,
                utf8_decode(
                    $materia->nombre_curso
                ),
                1,
                0,
                'C'
            );


            /*
            |--------------------------------------------------------------------------
            | GRUPO
            |--------------------------------------------------------------------------
            */

            if (
                $materia->id_materia == 2258
            ) {

                $grupo = '';

            } else {

                $grupo =
                    $materia->id_semestre .
                    '0' .
                    $materia->grupo;
            }


            $pdf->Cell(
                28,
                $altura,
                $grupo,
                1,
                1,
                'C'
            );


            /*
            |--------------------------------------------------------------------------
            | SIGUIENTE FILA
            |--------------------------------------------------------------------------
            */

            $y +=
                $altura;
        }


        /*
        |--------------------------------------------------------------------------
        | TOTAL DE CRÉDITOS
        |--------------------------------------------------------------------------
        */

        $totalY =
            $y + 2;


        $pdf->SetY(
            $totalY
        );


        $pdf->SetFont(
            'Arial',
            'B',
            8
        );


        /*
        | Alineación del total
        */

        $pdf->Cell(
            132,
            5,
            '',
            0,
            0
        );


        $pdf->Cell(
            22,
            5,
            'TOTAL DE CREDITOS',
            0,
            0,
            'R'
        );


        $pdf->Cell(
            22,
            5,
            $suma,
            1,
            1,
            'C'
        );


        /*
        |--------------------------------------------------------------------------
        | FIRMAS
        |--------------------------------------------------------------------------
        */

        /*
        | Dejamos espacio entre total y firmas.
        */

        $firmaY =
            $totalY + 7;


        /*
        |--------------------------------------------------------------------------
        | ALTURA DE FIRMAS
        |--------------------------------------------------------------------------
        */

        $firmaH =
            17;


        /*
        |--------------------------------------------------------------------------
        | RECUADRO ESTUDIANTE
        |--------------------------------------------------------------------------
        */

        $pdf->SetFillColor(
            230,
            230,
            230
        );


        $pdf->Rect(
            35,
            $firmaY,
            90,
            $firmaH,
            'DF'
        );


        /*
        |--------------------------------------------------------------------------
        | RECUADRO SUBDIRECCIÓN
        |--------------------------------------------------------------------------
        */

        $pdf->Rect(
            145,
            $firmaY,
            100,
            $firmaH,
            'DF'
        );


        /*
        |--------------------------------------------------------------------------
        | LÍNEA ESTUDIANTE
        |--------------------------------------------------------------------------
        */

        $pdf->Line(
            50,
            $firmaY + 11,
            110,
            $firmaY + 11
        );


        /*
        |--------------------------------------------------------------------------
        | LÍNEA SUBDIRECCIÓN
        |--------------------------------------------------------------------------
        */

        $pdf->Line(
            160,
            $firmaY + 11,
            230,
            $firmaY + 11
        );


        /*
        |--------------------------------------------------------------------------
        | TEXTO SUPERIOR
        |--------------------------------------------------------------------------
        */

        $pdf->SetFont(
            'Arial',
            'B',
            7
        );


        $pdf->Text(
            72,
            $firmaY + 4,
            'ELABORO'
        );


        $pdf->Text(
            188,
            $firmaY + 4,
            'AUTORIZO'
        );


        /*
        |--------------------------------------------------------------------------
        | TEXTO INFERIOR
        |--------------------------------------------------------------------------
        */

        $pdf->SetFont(
            'Arial',
            '',
            6.5
        );


        $pdf->Text(
            67,
            $firmaY + 15,
            'ESTUDIANTE'
        );


        $pdf->Text(
            157,
            $firmaY + 15,
            utf8_decode(
                'SUBDIRECCIÓN DE SERVICIOS ESCOLARES'
            )
        );


        /*
        |--------------------------------------------------------------------------
        | GENERAR
        |--------------------------------------------------------------------------
        */

        $pdf->Output();

        exit();
    }
}
