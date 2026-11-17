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
        Schema::create('exp_antecedentes_academicos', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_exp_antecedentes_academicos', true);
            $table->integer('id_bachillerato')->nullable();
            $table->string('otros_estudios', 100)->nullable();
            $table->integer('anos_curso_bachillerato')->nullable();
            $table->string('ano_terminacion', 10)->nullable();
            $table->string('escuela_procedente', 100)->nullable();
            $table->float('promedio', null)->nullable();
            $table->string('materias_reprobadas', 255)->nullable();
            $table->string('otra_carrera_ini', 255)->nullable();
            $table->string('institucion', 45)->nullable();
            $table->integer('semestres_cursados')->nullable();
            $table->integer('interrupciones_estudios')->nullable();
            $table->string('razones_interrupcion', 100)->nullable();
            $table->string('razon_descide_estudiar_tesvb', 255)->nullable();
            $table->string('sabedel_perfil_profesional', 100)->nullable();
            $table->integer('otras_opciones_vocales')->nullable();
            $table->string('cuales_otras_opciones_vocales', 255)->nullable();
            $table->integer('tegusta_carrera_elegida')->nullable();
            $table->string('porque_carrera_elegida', 255)->nullable();
            $table->integer('suspension_estudios_bachillerato')->nullable();
            $table->string('razones_suspension_estudios', 255)->nullable();
            $table->string('teestimula_familia', 255)->nullable();
            $table->integer('id_alumno');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_exp_antecedentes_academicos']);
            $table->index(['id_bachillerato'], 'bac_idx');
        });

        Schema::table('exp_antecedentes_academicos', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_exp_antecedentes_academicos_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_bachillerato'], 'fk_exp_antecedentes_academicos_id_bachillerato')->references(['id_bachillerato'])->on('exp_bachillerato')->onDelete('restrict')->onUpdate('cascade');
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
        CREATE TRIGGER `algoritmo_insert_d` AFTER INSERT ON `exp_antecedentes_academicos`
         FOR EACH ROW BEGIN
           DECLARE tegusta_carrera_elegida_v double;
           DECLARE variable double;
            DECLARE variable_dos double;
         
           IF NEW.tegusta_carrera_elegida=1 THEN
              SET @tegusta_carrera_elegida_v:=1.5;
            ELSEIF NEW.tegusta_carrera_elegida=2 THEN
              SET @tegusta_carrera_elegida_v:=3.5;
            END IF;
            
            UPDATE prediccion
            JOIN gnral_alumnos ON gnral_alumnos.cuenta=prediccion.no_cuenta
            SET prediccion.tegusta_carrera_elegida=NEW.tegusta_carrera_elegida,prediccion.tegusta_carrera_elegida_v=@tegusta_carrera_elegida_v
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
        CREATE TRIGGER `algoritmo_update_d` AFTER UPDATE ON `exp_antecedentes_academicos`
         FOR EACH ROW BEGIN
           DECLARE tegusta_carrera_elegida_v double;
           
           IF NEW.tegusta_carrera_elegida=1 THEN
              SET @tegusta_carrera_elegida_v:=1.5;
            ELSEIF NEW.tegusta_carrera_elegida=2 THEN
              SET @tegusta_carrera_elegida_v:=3.5;
            END IF;
            
            UPDATE prediccion
            JOIN gnral_alumnos ON gnral_alumnos.cuenta=prediccion.no_cuenta
            SET tegusta_carrera_elegida=NEW.tegusta_carrera_elegida,tegusta_carrera_elegida_v=@tegusta_carrera_elegida_v
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
        Schema::dropIfExists('exp_antecedentes_academicos');
    }
};
