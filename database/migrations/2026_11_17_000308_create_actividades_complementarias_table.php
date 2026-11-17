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
            Schema::create('actividades_complementarias', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('utf8mb3');
                $table->collation('utf8mb3_unicode_ci');

                $table->integer('id_actividad_comple', true);
                $table->string('descripcion', 100)->nullable();
                $table->integer('horas')->nullable();
                $table->integer('creditos')->nullable();
                $table->integer('id_categoria')->nullable();
                $table->integer('id_jefatura')->nullable();
                $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('updated_at')->default('0000-00-00 00:00:00');
                $table->integer('estado')->nullable();

                $table->primary(['id_actividad_comple']);
            });

            Schema::table('actividades_complementarias', function (Blueprint $table) {
                $table->foreign(['id_categoria'], 'fk_actividades_complementarias_id_categoria')->references(['id_categoria'])->on('actcomple_categorias')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_jefatura'], 'fk_actividades_complementarias_id_jefatura')->references(['id_jefatura'])->on('actcomple_jefaturas')->onDelete('restrict')->onUpdate('cascade');
            });
        } finally {
            DB::statement('SET SESSION sql_mode = ?', [$sqlMode]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actividades_complementarias');
    }
};
