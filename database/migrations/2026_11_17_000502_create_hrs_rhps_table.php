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
        $sqlMode = DB::scalar('SELECT @@SESSION.sql_mode');
        DB::statement('SET SESSION sql_mode = ?', [implode(',', array_diff(explode(',', $sqlMode), ['NO_ZERO_DATE', 'NO_ZERO_IN_DATE']))]);

        try {
            Schema::create('hrs_rhps', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_rhps', true);
                $table->integer('id_hrs_profesor')->nullable();
                $table->integer('id_semana')->nullable();
                $table->string('id_cargo', 20);
                $table->integer('id_aula');
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('created_at')->default('0000-00-00 00:00:00');

                $table->primary(['id_rhps']);
                $table->index(['id_hrs_profesor'], 'idx_hrs_profesor');
                $table->index(['id_semana'], 'idx_semana');
                $table->index(['id_aula'], 'idx_aula');
            });

            Schema::table('hrs_rhps', function (Blueprint $table) {
                $table->foreign(['id_aula'], 'fk_hrs_rhps_id_aula')->references(['id_aula'])->on('hrs_aulas')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_hrs_profesor'], 'fk_hrs_rhps_id_hrs_profesor')->references(['id_hrs_profesor'])->on('gnral_horas_profesores')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_semana'], 'fk_hrs_rhps_id_semana')->references(['id_semana'])->on('hrs_semanas')->onDelete('restrict')->onUpdate('cascade');
            });
        } finally {
            DB::statement('SET SESSION sql_mode = ?', [$sqlMode]);
        }

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
        CREATE TRIGGER `elimina_rhps` AFTER DELETE ON `hrs_rhps`
         FOR EACH ROW INSERT INTO bitacora_elimina(tabla,fecha) VALUES ('hrs_rhps',now())
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
        Schema::dropIfExists('hrs_rhps');
    }
};
