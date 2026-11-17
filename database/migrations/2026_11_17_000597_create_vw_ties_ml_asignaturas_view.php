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
        CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vw_ties_ml_asignaturas` AS select `u`.`id_carga` AS `id_carga`,max(`u`.`id_alumno`) AS `id_alumno`,max(`u`.`id_periodo`) AS `id_periodo`,max(`u`.`id_carrera_padron_actual`) AS `id_carrera_padron_actual`,max(`u`.`id_materia`) AS `id_materia`,max(`u`.`clave_materia`) AS `clave_materia`,max(`u`.`id_reticula_catalogo`) AS `id_reticula_catalogo`,max(`u`.`semestre_catalogo`) AS `semestre_catalogo`,max(`u`.`creditos_materia`) AS `creditos_materia`,max(`u`.`id_tipo_curso`) AS `id_tipo_curso`,max(`u`.`unidades_esperadas`) AS `unidades_esperadas`,count(0) AS `unidades_catalogadas`,sum(`u`.`estado_unidad` = 'ACREDITADA_O') AS `unidades_acreditadas_o`,sum(`u`.`estado_unidad` = 'ACREDITADA_ESC') AS `unidades_recuperadas_esc`,sum(`u`.`estado_unidad` = 'REPROBADA_ESC') AS `unidades_reprobadas_esc`,sum(`u`.`estado_unidad` in ('SIN_O','O_AMBIGUA','ESC_SIN_REGISTRO','ESC_AMBIGUA')) AS `unidades_pendientes_o_ambiguas`,sum(`u`.`registros_esc` > 1) AS `unidades_esc_duplicadas`,case when count(0) <> max(`u`.`unidades_esperadas`) then 'INDETERMINADA' when sum(`u`.`estado_unidad` = 'REPROBADA_ESC') > 0 then 'REPROBADA' when sum(`u`.`estado_unidad` in ('ACREDITADA_O','ACREDITADA_ESC')) = count(0) then 'ACREDITADA' else 'INDETERMINADA' end AS `estado_asignatura`,case when count(0) <> max(`u`.`unidades_esperadas`) then NULL when sum(`u`.`estado_unidad` = 'REPROBADA_ESC') > 0 then 1 when sum(`u`.`estado_unidad` in ('ACREDITADA_O','ACREDITADA_ESC')) = count(0) then 0 else NULL end AS `y_reprobacion_provisional` from `vw_ties_ml_unidades` `u` group by `u`.`id_carga`;
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
        DB::statement('DROP VIEW IF EXISTS `vw_ties_ml_asignaturas`');
    }
};
