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
        CREATE OR REPLACE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `DataDesercion` AS (select `gnral_alumnos`.`id_alumno` AS `sujeto`,`gnral_alumnos`.`genero` AS `genero`,`gnral_alumnos`.`edad` AS `edad`,`gnral_alumnos`.`edo_civil` AS `edo_civil`,`gnral_alumnos`.`id_carrera` AS `carrera`,`gnral_alumnos`.`id_semestre` AS `semestre`,`gnral_alumnos`.`discapacidad` AS `discapacidad`,`gnral_alumnos`.`lengua` AS `lengua`,`gnral_alumnos`.`id_escuela_procedencia` AS `esc_proc`,`gnral_alumnos`.`promedio_preparatoria` AS `prom`,`exp_antecedentes_academicos`.`id_exp_antecedentes_academicos` AS `ant_aca`,`exp_antecedentes_academicos`.`tegusta_carrera_elegida` AS `gusto`,`exp_antecedentes_academicos`.`teestimula_familia` AS `familia`,`exp_datos_familiares`.`id_familia_union` AS `tipo_f`,`exp_datos_familiares`.`id_opc_vives` AS `vivienda` from (((`gnral_alumnos` join `actcomple_registro_alumnos`) join `exp_antecedentes_academicos`) join `exp_datos_familiares`) where `gnral_alumnos`.`id_alumno` = `exp_antecedentes_academicos`.`id_alumno` and `gnral_alumnos`.`id_alumno` = `exp_datos_familiares`.`id_alumno` and `gnral_alumnos`.`cuenta` = `actcomple_registro_alumnos`.`cuenta`);
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
        DB::statement('DROP VIEW IF EXISTS `DataDesercion`');
    }
};
