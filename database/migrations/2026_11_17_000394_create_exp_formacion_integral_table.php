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
        Schema::create('exp_formacion_integral', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_exp_formacion_integral', true);
            $table->integer('practica_deporte')->nullable();
            $table->string('especifica_deporte', 100)->nullable();
            $table->integer('practica_artistica')->nullable();
            $table->string('especifica_artistica', 100)->nullable();
            $table->string('pasatiempo', 100)->nullable();
            $table->integer('actividades_culturales')->nullable();
            $table->string('cuales_act', 100)->nullable();
            $table->integer('estado_salud')->nullable();
            $table->integer('enfermedad_cronica')->nullable();
            $table->string('especifica_enf_cron', 100)->nullable();
            $table->integer('enf_cron_padre')->nullable();
            $table->string('especifica_enf_cron_padres', 100)->nullable();
            $table->integer('operacion')->nullable();
            $table->string('deque_operacion', 255)->nullable();
            $table->integer('enfer_visual')->nullable();
            $table->string('especifica_enf', 100)->nullable();
            $table->integer('usas_lentes')->nullable();
            $table->integer('medicamento_controlado')->nullable();
            $table->string('especifica_medicamento', 100)->nullable();
            $table->string('estatura', 10)->nullable();
            $table->string('peso', 10)->nullable();
            $table->integer('accidente_grave')->nullable();
            $table->string('relata_breve', 255)->nullable();
            $table->integer('id_expbebidas')->nullable();
            $table->integer('id_alumno');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_exp_formacion_integral']);
        });

        Schema::table('exp_formacion_integral', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_exp_formacion_integral_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_expbebidas'], 'fk_exp_formacion_integral_id_expbebidas')->references(['id_expbebidas'])->on('exp_bebidas')->onDelete('restrict')->onUpdate('cascade');
        });

        DB::unprepared(<<<'SQL'
        SET @saved_cs_client = @@character_set_client;
        SET @saved_cs_results = @@character_set_results;
        SET @saved_col_connection = @@collation_connection;
        SET character_set_client = utf8mb4;
        SET character_set_results = utf8mb4;
        SET collation_connection = utf8mb4_general_ci;
        SET @saved_sql_mode = @@SESSION.sql_mode;
        SET SESSION sql_mode = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
        SQL);
        DB::unprepared(<<<'SQL'
        CREATE TRIGGER `algoritmo_insert_c` AFTER INSERT ON `exp_formacion_integral`
         FOR EACH ROW BEGIN
           DECLARE enfermedad_cronica_v double;
           DECLARE practica_deporte_v double;
           DECLARE actividades_culturales_v double;
           DECLARE id_expbebidas_v double;
           
           IF NEW.enfermedad_cronica=1 THEN
              SET @enfermedad_cronica_v:=3.5;
           ELSEIF NEW.enfermedad_cronica=2 THEN
              SET @enfermedad_cronica_v:=1.5;
           END IF;
          
           IF NEW.practica_deporte=1 THEN
              SET @practica_deporte_v:=1.5;
           ELSEIF NEW.practica_deporte=2 THEN
              SET @practica_deporte_v:=3.5;
           END IF;
            
           IF NEW.actividades_culturales=1 THEN
              SET @actividades_culturales_v:=1.5;
           ELSEIF NEW.actividades_culturales=2 THEN
              SET @actividades_culturales_v:=3.5;
           END IF;
           
           IF NEW.id_expbebidas is NULL THEN
              SET @id_expbebidas_v:=0.8;
            ELSEIF NEW.id_expbebidas=1 THEN
              SET @id_expbebidas_v:=0.8;
           ELSEIF NEW.id_expbebidas=2 THEN
              SET @id_expbebidas_v:=1.5;
           ELSEIF NEW.id_expbebidas=3 THEN
              SET @id_expbebidas_v:=2.5;
           ELSEIF NEW.id_expbebidas=4 THEN
              SET @id_expbebidas_v:=3.5;
           END IF;
           
            UPDATE prediccion
            JOIN gnral_alumnos ON gnral_alumnos.cuenta=prediccion.no_cuenta
            SET enfermedad_cronica=NEW.enfermedad_cronica,enfermedad_cronica_v=@enfermedad_cronica_v,practica_deporte=NEW.practica_deporte,
            practica_deporte_v=@practica_deporte_v,actividades_culturales=NEW.actividades_culturales,actividades_culturales_v=@actividades_culturales_v,
            id_expbebidas=NEW.id_expbebidas,id_expbebidas_v=@id_expbebidas_v
            where gnral_alumnos.id_alumno=NEW.id_alumno
            and gnral_alumnos.cuenta=prediccion.no_cuenta;
        END
        SQL);
        DB::unprepared(<<<'SQL'
        SET SESSION sql_mode = @saved_sql_mode;
        SET character_set_client = @saved_cs_client;
        SET character_set_results = @saved_cs_results;
        SET collation_connection = @saved_col_connection;
        SQL);

        DB::unprepared(<<<'SQL'
        SET @saved_cs_client = @@character_set_client;
        SET @saved_cs_results = @@character_set_results;
        SET @saved_col_connection = @@collation_connection;
        SET character_set_client = utf8mb4;
        SET character_set_results = utf8mb4;
        SET collation_connection = utf8mb4_general_ci;
        SET @saved_sql_mode = @@SESSION.sql_mode;
        SET SESSION sql_mode = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
        SQL);
        DB::unprepared(<<<'SQL'
        CREATE TRIGGER `algoritmo_update_c` AFTER UPDATE ON `exp_formacion_integral`
         FOR EACH ROW BEGIN
           DECLARE enfermedad_cronica_v double;
           DECLARE practica_deporte_v double;
           DECLARE actividades_culturales_v double;
           DECLARE id_expbebidas_v double;
           
           IF NEW.enfermedad_cronica=1 THEN
              SET @enfermedad_cronica_v:=3.5;
           ELSEIF NEW.enfermedad_cronica=2 THEN
              SET @enfermedad_cronica_v:=1.5;
           END IF;
          
           IF NEW.practica_deporte=1 THEN
              SET @practica_deporte_v:=1.5;
           ELSEIF NEW.practica_deporte=2 THEN
              SET @practica_deporte_v:=3.5;
           END IF;
            
           IF NEW.actividades_culturales=1 THEN
              SET @actividades_culturales_v:=1.5;
           ELSEIF NEW.actividades_culturales=2 THEN
              SET @actividades_culturales_v:=3.5;
           END IF;
           
           IF NEW.id_expbebidas is NULL THEN
              SET @id_expbebidas_v:=0.8;
            ELSEIF NEW.id_expbebidas=1 THEN
              SET @id_expbebidas_v:=0.8;
           ELSEIF NEW.id_expbebidas=2 THEN
              SET @id_expbebidas_v:=1.5;
           ELSEIF NEW.id_expbebidas=3 THEN
              SET @id_expbebidas_v:=2.5;
           ELSEIF NEW.id_expbebidas=4 THEN
              SET @id_expbebidas_v:=3.5;
           END IF;
           
            UPDATE prediccion
            JOIN gnral_alumnos ON gnral_alumnos.cuenta=prediccion.no_cuenta
            SET enfermedad_cronica=NEW.enfermedad_cronica,enfermedad_cronica_v=@enfermedad_cronica_v,practica_deporte=NEW.practica_deporte,
            practica_deporte_v=@practica_deporte_v,actividades_culturales=NEW.actividades_culturales,actividades_culturales_v=@actividades_culturales_v,
            id_expbebidas=NEW.id_expbebidas,id_expbebidas_v=@id_expbebidas_v
            where gnral_alumnos.id_alumno=NEW.id_alumno
            and gnral_alumnos.cuenta=prediccion.no_cuenta;
        END
        SQL);
        DB::unprepared(<<<'SQL'
        SET SESSION sql_mode = @saved_sql_mode;
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
        Schema::dropIfExists('exp_formacion_integral');
    }
};
