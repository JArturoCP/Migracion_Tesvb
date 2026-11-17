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
        Schema::create('tu_eva_fo40', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_fo40', true)->comment('Id principal de la tabla PK ');
            $table->integer('periodo')->comment('Periodo de evaluación');
            $table->integer('id_personal')->comment('FK de tabla general personales de tipo de usuario');
            $table->integer('id_asigna_coordinador')->comment('FK de asigna coordinador');
            $table->integer('se1')->nullable()->comment('Calificación de la sección 1');
            $table->integer('se2')->nullable()->comment('Calificación de la sección 2');
            $table->string('com', 200)->charset('utf32')->collation('utf32_spanish2_ci')->comment('comentario');
            $table->string('com2', 100);
            $table->timestamp('fecha_registro')->useCurrent()->comment('fecha de registro');
            $table->timestamp('fecha_registro2')->default('1970-01-01 06:00:00')->comment('fecha de registro');
            $table->string('res1', 200);
            $table->string('res2', 100);
            $table->integer('con')->default(1);

            $table->primary(['id_fo40']);
        });

        Schema::table('tu_eva_fo40', function (Blueprint $table) {
            $table->foreign(['id_asigna_coordinador'], 'fk_tu_eva_fo40_id_asigna_coordinador')->references(['id_asigna_coordinador'])->on('exp_asigna_coordinador')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_personal'], 'fk_tu_eva_fo40_id_personal')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tu_eva_fo40');
    }
};
