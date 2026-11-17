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
        CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vw_ties_ml_experimentos` AS select `p`.`id_alumno` AS `id_alumno_interno`,`p`.`id_periodo` AS `periodo_objetivo`,case when `p`.`id_periodo` between 20 and 29 then 'ENTRENAMIENTO' when `p`.`id_periodo` between 30 and 31 then 'VALIDACION' else 'PRUEBA' end AS `particion_temporal`,`p`.`carrera_padron_actual` AS `carrera_padron_actual_solo_analisis`,row_number() over ( partition by `p`.`id_alumno` order by `p`.`id_periodo`) - 1 AS `periodos_previos_observados`,lag(`p`.`id_periodo`,1) over ( partition by `p`.`id_alumno` order by `p`.`id_periodo`) AS `periodo_previo_observado`,coalesce(sum(`p`.`asignaturas_elegibles_esperadas`) over ( partition by `p`.`id_alumno` order by `p`.`id_periodo` rows between  unbounded  preceding  and 1 preceding ),0) AS `asignaturas_previas`,coalesce(sum(`p`.`asignaturas_acreditadas`) over ( partition by `p`.`id_alumno` order by `p`.`id_periodo` rows between  unbounded  preceding  and 1 preceding ),0) AS `asignaturas_acreditadas_previas`,coalesce(sum(`p`.`asignaturas_reprobadas`) over ( partition by `p`.`id_alumno` order by `p`.`id_periodo` rows between  unbounded  preceding  and 1 preceding ),0) AS `asignaturas_reprobadas_previas`,coalesce(sum(`p`.`asignaturas_indeterminadas`) over ( partition by `p`.`id_alumno` order by `p`.`id_periodo` rows between  unbounded  preceding  and 1 preceding ),0) AS `asignaturas_indeterminadas_previas`,coalesce(sum(`p`.`unidades_recuperadas_esc`) over ( partition by `p`.`id_alumno` order by `p`.`id_periodo` rows between  unbounded  preceding  and 1 preceding ),0) AS `unidades_recuperadas_esc_previas`,coalesce(sum(`p`.`cargas_repeticion`) over ( partition by `p`.`id_alumno` order by `p`.`id_periodo` rows between  unbounded  preceding  and 1 preceding ),0) AS `cargas_repeticion_previas`,coalesce(sum(`p`.`creditos_en_cargas_acreditadas`) over ( partition by `p`.`id_alumno` order by `p`.`id_periodo` rows between  unbounded  preceding  and 1 preceding ),0) AS `creditos_en_cargas_acreditadas_previas`,coalesce(sum(`p`.`creditos_en_cargas_reprobadas`) over ( partition by `p`.`id_alumno` order by `p`.`id_periodo` rows between  unbounded  preceding  and 1 preceding ),0) AS `creditos_en_cargas_reprobadas_previas`,lag(`p`.`asignaturas_reprobadas`,1) over ( partition by `p`.`id_alumno` order by `p`.`id_periodo`) AS `reprobadas_ultimo_periodo`,lag(`p`.`y_reprobo_periodo_provisional`,1) over ( partition by `p`.`id_alumno` order by `p`.`id_periodo`) AS `y_ultimo_periodo`,`p`.`asignaturas_elegibles_esperadas` AS `n_asignaturas_objetivo_NO_PREDICTOR`,`p`.`asignaturas_indeterminadas` AS `n_indeterminadas_objetivo_NO_PREDICTOR`,`p`.`y_reprobo_periodo_provisional` AS `y_reprobacion_objetivo`,case when `p`.`y_reprobo_periodo_provisional` is null then 'INDETERMINADA' else 'DETERMINADA_PROVISIONAL' end AS `calidad_etiqueta` from `vw_ties_ml_periodos` `p`;
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
        DB::statement('DROP VIEW IF EXISTS `vw_ties_ml_experimentos`');
    }
};
