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
        CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vw_ties_ml_periodos` AS select `ca`.`id_alumno` AS `id_alumno`,`ca`.`id_periodo` AS `id_periodo`,max(`a`.`id_carrera`) AS `carrera_padron_actual`,count(0) AS `cargas_activas_total`,sum(case when `ca`.`id_tipo_curso` = 2 then 1 else 0 end) AS `cargas_repeticion`,sum(case when `ca`.`id_tipo_curso` = 3 then 1 else 0 end) AS `cargas_especial`,sum(case when `ca`.`id_tipo_curso` = 4 then 1 else 0 end) AS `cargas_global`,sum(`ca`.`id_materia` = 1265 or coalesce(trim(`m`.`clave`),'') = 'RES-001') AS `cargas_residencia`,sum(case when `ca`.`id_tipo_curso` in (1,2) and `m`.`unidades` > 0 and `ca`.`id_materia` <> 1265 and coalesce(trim(`m`.`clave`),'') <> 'RES-001' then 1 else 0 end) AS `asignaturas_elegibles_esperadas`,count(`am`.`id_carga`) AS `asignaturas_elegibles_con_unidades`,sum(case when `am`.`estado_asignatura` = 'ACREDITADA' then 1 else 0 end) AS `asignaturas_acreditadas`,sum(case when `am`.`estado_asignatura` = 'REPROBADA' then 1 else 0 end) AS `asignaturas_reprobadas`,sum(case when `am`.`estado_asignatura` = 'INDETERMINADA' then 1 else 0 end) AS `asignaturas_indeterminadas`,sum(coalesce(`am`.`unidades_recuperadas_esc`,0)) AS `unidades_recuperadas_esc`,sum(coalesce(`am`.`unidades_reprobadas_esc`,0)) AS `unidades_reprobadas_esc`,sum(coalesce(`am`.`unidades_esc_duplicadas`,0)) AS `unidades_esc_duplicadas`,sum(case when `am`.`estado_asignatura` = 'ACREDITADA' then `am`.`creditos_materia` else 0 end) AS `creditos_en_cargas_acreditadas`,sum(case when `am`.`estado_asignatura` = 'REPROBADA' then `am`.`creditos_materia` else 0 end) AS `creditos_en_cargas_reprobadas`,case when sum(case when `am`.`estado_asignatura` = 'REPROBADA' then 1 else 0 end) > 0 then 1 when sum(case when `ca`.`id_tipo_curso` in (1,2) and `m`.`unidades` > 0 and `ca`.`id_materia` <> 1265 and coalesce(trim(`m`.`clave`),'') <> 'RES-001' then 1 else 0 end) > 0 and sum(case when `ca`.`id_tipo_curso` in (1,2) and `m`.`unidades` > 0 and `ca`.`id_materia` <> 1265 and coalesce(trim(`m`.`clave`),'') <> 'RES-001' then 1 else 0 end) = sum(case when `am`.`estado_asignatura` = 'ACREDITADA' then 1 else 0 end) then 0 else NULL end AS `y_reprobo_periodo_provisional` from (((`eva_carga_academica` `ca` join `gnral_alumnos` `a` on(`a`.`id_alumno` = `ca`.`id_alumno`)) join `gnral_materias` `m` on(`m`.`id_materia` = `ca`.`id_materia`)) left join `vw_ties_ml_asignaturas` `am` on(`am`.`id_carga` = `ca`.`id_carga_academica`)) where `ca`.`id_periodo` between 20 and 33 and `ca`.`id_status_materia` = 1 and `a`.`id_carrera` in (1,2,3,4,5,6,7,8,13,14) group by `ca`.`id_alumno`,`ca`.`id_periodo`;
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
        DB::statement('DROP VIEW IF EXISTS `vw_ties_ml_periodos`');
    }
};
