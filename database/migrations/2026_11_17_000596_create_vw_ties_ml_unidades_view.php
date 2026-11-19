<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared(<<<'SQL'
        SET @saved_cs_client = @@character_set_client;
        SET @saved_cs_results = @@character_set_results;
        SET @saved_col_connection = @@collation_connection;
        SET character_set_client = utf8mb4;
        SET character_set_results = utf8mb4;
        SET collation_connection = utf8mb4_general_ci;
        CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vw_ties_ml_unidades` AS select `ca`.`id_carga_academica` AS `id_carga`,`ca`.`id_alumno` AS `id_alumno`,`ca`.`id_periodo` AS `id_periodo`,`a`.`id_carrera` AS `id_carrera_padron_actual`,`ca`.`id_materia` AS `id_materia`,`m`.`clave` AS `clave_materia`,`m`.`nombre` AS `nombre_materia`,`m`.`id_reticula` AS `id_reticula_catalogo`,`m`.`id_semestre` AS `semestre_catalogo`,`m`.`creditos` AS `creditos_materia`,`m`.`unidades` AS `unidades_esperadas`,`ca`.`id_tipo_curso` AS `id_tipo_curso`,`u`.`id_unidad` AS `id_unidad`,count(distinct `o`.`id_evaluacion`) AS `registros_o`,min(`o`.`calificacion`) AS `nota_o_min`,max(`o`.`calificacion`) AS `nota_o_max`,min(`o`.`esc`) AS `marca_o_min`,max(`o`.`esc`) AS `marca_o_max`,count(distinct `s`.`id_evaluacion`) AS `registros_esc`,min(`s`.`calificacion`) AS `nota_esc_min`,max(`s`.`calificacion`) AS `nota_esc_max`,min(`s`.`esc`) AS `marca_esc_min`,max(`s`.`esc`) AS `marca_esc_max`,case when count(distinct `o`.`id_evaluacion`) = 0 then 'SIN_O' when count(distinct `o`.`id_evaluacion`) <> 1 or min(`o`.`calificacion`) <> max(`o`.`calificacion`) or min(`o`.`calificacion`) not between 0 and 100 then 'O_AMBIGUA' when min(`o`.`calificacion`) >= 70 then 'ACREDITADA_O' when count(distinct `s`.`id_evaluacion`) = 0 then 'ESC_SIN_REGISTRO' when count(distinct `s`.`id_evaluacion`) <> 1 or min(`s`.`calificacion`) <> max(`s`.`calificacion`) or min(`s`.`calificacion`) not between 0 and 100 then 'ESC_AMBIGUA' when min(`s`.`calificacion`) >= 70 then 'ACREDITADA_ESC' else 'REPROBADA_ESC' end AS `estado_unidad`,case when count(distinct `o`.`id_evaluacion`) = 0 then NULL when min(`o`.`calificacion`) >= 70 then 'O' when min(`o`.`calificacion`) < 70 and count(distinct `s`.`id_evaluacion`) > 0 then 'ESC' else 'O' end AS `T.E.` from (((((`eva_carga_academica` `ca` join `gnral_alumnos` `a` on(`a`.`id_alumno` = `ca`.`id_alumno`)) join `gnral_materias` `m` on(`m`.`id_materia` = `ca`.`id_materia`)) join `cal_unidades` `u` on(`u`.`id_unidad` between 1 and `m`.`unidades`)) left join `cal_evaluaciones` `o` on(`o`.`id_carga_academica` = `ca`.`id_carga_academica` and `o`.`id_unidad` = `u`.`id_unidad`)) left join `cal_evaluaciones_sumativa` `s` on(`s`.`id_carga_academica` = `ca`.`id_carga_academica` and `s`.`id_unidad` = `u`.`id_unidad`)) where `ca`.`id_periodo` between 20 and 33 and `ca`.`id_status_materia` = 1 and `a`.`id_carrera` in (1,2,3,4,5,6,7,8,13,14) and `ca`.`id_tipo_curso` in (1,2) and `m`.`unidades` > 0 and `ca`.`id_materia` <> 1265 and coalesce(trim(`m`.`clave`),'') <> 'RES-001' group by `ca`.`id_carga_academica`,`ca`.`id_alumno`,`ca`.`id_periodo`,`a`.`id_carrera`,`ca`.`id_materia`,`m`.`clave`,`m`.`nombre`,`m`.`id_reticula`,`m`.`id_semestre`,`m`.`creditos`,`m`.`unidades`,`ca`.`id_tipo_curso`,`u`.`id_unidad`;
        SET character_set_client = @saved_cs_client;
        SET character_set_results = @saved_cs_results;
        SET collation_connection = @saved_col_connection;
        SQL);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS `vw_ties_ml_unidades`');
    }
};
