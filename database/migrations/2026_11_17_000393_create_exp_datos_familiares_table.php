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
        Schema::create('exp_datos_familiares', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_exp_datos_familiares', true);
            $table->string('nombre_padre', 255)->nullable();
            $table->integer('edad_padre')->nullable();
            $table->string('ocupacion_padre', 100)->nullable();
            $table->string('lugar_residencia_padre', 255)->nullable();
            $table->string('nombre_madre', 255)->nullable();
            $table->integer('edad_madre')->nullable();
            $table->string('ocupacion_madre', 100)->nullable();
            $table->string('lugar_residencia_madre', 255)->nullable();
            $table->integer('no_hermanos')->nullable();
            $table->string('lugar_ocupas', 45)->nullable();
            $table->integer('id_opc_vives')->nullable();
            $table->integer('no_personas')->nullable();
            $table->integer('etnia_indigena')->nullable();
            $table->string('cual_etnia', 45)->nullable();
            $table->integer('hablas_lengua_indigena')->nullable();
            $table->string('sostiene_economia_hogar', 45)->nullable();
            $table->integer('id_familia_union')->nullable();
            $table->string('nombre_tutor', 100)->nullable();
            $table->string('id_parentesco', 10)->nullable();
            $table->integer('id_alumno');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_exp_datos_familiares']);
            $table->index(['id_opc_vives'], 'viv_idx');
            $table->index(['id_familia_union'], 'uni_idx');
        });

        Schema::table('exp_datos_familiares', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_exp_datos_familiares_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_familia_union'], 'fk_exp_datos_familiares_id_familia_union')->references(['id_familia_union'])->on('exp_familia_union')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_opc_vives'], 'fk_exp_datos_familiares_id_opc_vives')->references(['id_opc_vives'])->on('exp_opc_vives')->onDelete('restrict')->onUpdate('cascade');
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
        CREATE TRIGGER `algoritmo_insert_t` AFTER INSERT ON `exp_datos_familiares`
         FOR EACH ROW BEGIN
           DECLARE no_hermanos_v double;
           DECLARE etnia_indigena_v double;
           DECLARE sostiene_economia_hogar_v double;
           
           IF NEW.no_hermanos is NULL THEN
              SET @no_hermanos_v:=0.0;
           ELSEIF NEW.no_hermanos=0 THEN
              SET @no_hermanos_v:=0.8;
           ELSEIF NEW.no_hermanos=1 THEN
              SET @no_hermanos_v:=1.5;
           ELSEIF NEW.no_hermanos=2 THEN
              SET @no_hermanos_v:=2.0;
           ELSEIF NEW.no_hermanos=3 THEN
              SET @no_hermanos_v:=2.8;
           ELSEIF NEW.no_hermanos=4 THEN
              SET @no_hermanos_v:=3.5;
           ELSEIF NEW.no_hermanos=5 THEN
              SET @no_hermanos_v:=3.5;
           ELSEIF NEW.no_hermanos=6 THEN
              SET @no_hermanos_v:=3.5;
           ELSEIF NEW.no_hermanos=7 THEN
              SET @no_hermanos_v:=3.5;
           END IF;
               
           IF NEW.etnia_indigena=1 THEN
              SET @etnia_indigena_v:=3.5;
           ELSEIF NEW.etnia_indigena=2 THEN
              SET @etnia_indigena_v:=1.5;
           END IF;
           
           SET @sostiene_economia_hogar_v:=3.5;
           IF NEW.sostiene_economia_hogar is NULL THEN
           SET @sostiene_economia_hogar_v:=3.5;
           END IF;
           
            UPDATE prediccion
            JOIN gnral_alumnos ON gnral_alumnos.cuenta=prediccion.no_cuenta
            SET no_hermanos=NEW.no_hermanos,no_hermanos_v=@no_hermanos_v,etnia_indigena=NEW.etnia_indigena,etnia_indigena_v=@etnia_indigena_v,
            sostiene_economia_hogar=NEW.sostiene_economia_hogar,sostiene_economia_hogar_v=@sostiene_economia_hogar_v
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
        CREATE TRIGGER `algoritmo_update_t` AFTER UPDATE ON `exp_datos_familiares`
         FOR EACH ROW BEGIN
           DECLARE no_hermanos_v double;
           DECLARE etnia_indigena_v double;
           DECLARE sostiene_economia_hogar_v double;
           
           IF NEW.no_hermanos is NULL THEN
              SET @no_hermanos_v:=0.0;
           ELSEIF NEW.no_hermanos=0 THEN
              SET @no_hermanos_v:=0.8;
           ELSEIF NEW.no_hermanos=1 THEN
              SET @no_hermanos_v:=1.5;
           ELSEIF NEW.no_hermanos=2 THEN
              SET @no_hermanos_v:=2.0;
           ELSEIF NEW.no_hermanos=3 THEN
              SET @no_hermanos_v:=2.8;
           ELSEIF NEW.no_hermanos=4 THEN
              SET @no_hermanos_v:=3.5;
           ELSEIF NEW.no_hermanos=5 THEN
              SET @no_hermanos_v:=3.5;
           ELSEIF NEW.no_hermanos=6 THEN
              SET @no_hermanos_v:=3.5;
           ELSEIF NEW.no_hermanos=7 THEN
              SET @no_hermanos_v:=3.5;
           END IF;
               
           IF NEW.etnia_indigena=1 THEN
              SET @etnia_indigena_v:=3.5;
           ELSEIF NEW.etnia_indigena=2 THEN
              SET @etnia_indigena_v:=1.5;
           END IF;
           
           SET @sostiene_economia_hogar_v:=3.5;
           IF NEW.sostiene_economia_hogar is NULL THEN
           SET @sostiene_economia_hogar_v:=3.5;
           END IF;
           
            UPDATE prediccion
            JOIN gnral_alumnos ON gnral_alumnos.cuenta=prediccion.no_cuenta
            SET no_hermanos=NEW.no_hermanos,no_hermanos_v=@no_hermanos_v,etnia_indigena=NEW.etnia_indigena,etnia_indigena_v=@etnia_indigena_v,
            sostiene_economia_hogar=NEW.sostiene_economia_hogar,sostiene_economia_hogar_v=@sostiene_economia_hogar_v
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
        Schema::dropIfExists('exp_datos_familiares');
    }
};
