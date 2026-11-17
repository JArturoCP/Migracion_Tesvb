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
        Schema::create('egel_modulos', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->integer('id_modulo', true);
            $table->integer('id_seccion');
            $table->string('nombre', 150);
            $table->integer('orden')->nullable()->default(0);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->integer('id_examen_egel')->nullable();

            $table->primary(['id_modulo']);
            $table->index(['id_seccion'], 'fk_modulos_seccion');
        });

        Schema::table('egel_modulos', function (Blueprint $table) {
            $table->foreign(['id_examen_egel'], 'fk_egel_modulos_id_examen_egel')->references(['id_examen_egel'])->on('egel_examenes')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_seccion'], 'fk_egel_modulos_id_seccion')->references(['id_seccion'])->on('egel_secciones')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egel_modulos');
    }
};
