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
        SET collation_connection = utf8mb3_general_ci;
        CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `tu_eva_analisis_tutores` AS select 1 AS `id_jefe_periodo`,1 AS `nombre`,1 AS `sexo`,1 AS `descripcion`,1 AS `fecha`,1 AS `antiguiedad`,1 AS `escolaridad`,1 AS `gestion`,1 AS `actitud`,1 AS `disponibilidad_confianza`,1 AS `servicios_del_programa_de_tutoria`,1 AS `tus_logros_y_avances`,1 AS `Name_exp_13`,1 AS `promedio`;
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
        DB::statement('DROP VIEW IF EXISTS `tu_eva_analisis_tutores`');
    }
};
