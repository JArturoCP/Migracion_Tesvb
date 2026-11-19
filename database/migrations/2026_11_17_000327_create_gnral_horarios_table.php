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
        Schema::create('gnral_horarios', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_horario_profesor', true);
            $table->integer('id_periodo_carrera')->nullable();
            $table->integer('id_personal')->nullable();
            $table->string('aprobado', 2)->nullable();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->timestamp('created_at')->useCurrent();

            $table->primary(['id_horario_profesor']);
            $table->index(['id_personal'], 'idx_personal');
            $table->index(['id_periodo_carrera'], 'idx_periodo_carrera');
            $table->index(['id_periodo_carrera', 'id_personal', 'aprobado', 'id_horario_profesor'], 'idx_ar_horarios_periodo_personal');
        });

        Schema::table('gnral_horarios', function (Blueprint $table) {
            $table->foreign(['id_periodo_carrera'], 'fk_gnral_horarios_id_periodo_carrera')->references(['id_periodo_carrera'])->on('gnral_periodo_carreras')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_personal'], 'fk_gnral_horarios_id_personal')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
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
        CREATE TRIGGER `elimina_horarios` AFTER DELETE ON `gnral_horarios`
         FOR EACH ROW INSERT INTO bitacora_elimina(tabla,fecha) VALUES ('gnral_horarios',now())
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
        Schema::dropIfExists('gnral_horarios');
    }
};
