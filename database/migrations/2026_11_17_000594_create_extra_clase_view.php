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
        SET character_set_client = utf8mb3;
        SET character_set_results = utf8mb3;
        SET collation_connection = utf8mb3_unicode_ci;
        CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `extra_clase` AS (select count(`gnral_carreras`.`id_carrera`) AS `num`,`gnral_carreras`.`nombre` AS `carrera`,`gnral_carreras`.`id_carrera` AS `id_carrera` from ((((((`gnral_horarios` join `hrs_extra_clase`) join `hrs_horario_extra_clase`) join `hrs_act_extra_clases`) join `gnral_periodos`) join `gnral_periodo_carreras`) join `gnral_carreras`) where `gnral_periodos`.`id_periodo` = 36 and `gnral_horarios`.`id_personal` = 315 and `hrs_extra_clase`.`id_act_extra_clase` = `hrs_act_extra_clases`.`id_act_extra_clase` and `hrs_extra_clase`.`id_horario_profesor` = `gnral_horarios`.`id_horario_profesor` and `gnral_carreras`.`id_carrera` = `gnral_periodo_carreras`.`id_carrera` and `gnral_periodo_carreras`.`id_periodo_carrera` = `gnral_horarios`.`id_periodo_carrera` and `gnral_periodos`.`id_periodo` = `gnral_periodo_carreras`.`id_periodo` and `hrs_horario_extra_clase`.`id_extra_clase` = `hrs_extra_clase`.`id_extra_clase` group by `gnral_carreras`.`id_carrera`,`gnral_carreras`.`nombre`);
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
        DB::statement('DROP VIEW IF EXISTS `extra_clase`');
    }
};
