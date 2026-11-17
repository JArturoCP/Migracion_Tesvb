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
        Schema::create('ar_accesos_datos_sensibles', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->bigInteger('id_ar_acceso', true, true);
            $table->integer('id_usuario')->nullable();
            $table->integer('id_personal')->nullable();
            $table->string('modulo', 100);
            $table->string('accion', 100);
            $table->bigInteger('id_referencia', false, true)->nullable();
            $table->string('tabla_referencia', 100)->nullable();
            $table->dateTime('fecha_acceso');
            $table->string('ip', 50)->nullable();
            $table->string('user_agent', 500)->nullable();
            $table->timestamp('created_at')->nullable();

            $table->primary(['id_ar_acceso']);
            $table->index(['id_usuario'], 'idx_ar_acceso_usuario');
            $table->index(['id_personal'], 'idx_ar_acceso_personal');
            $table->index(['fecha_acceso'], 'idx_ar_acceso_fecha');
            $table->index(['tabla_referencia', 'id_referencia'], 'idx_ar_acceso_referencia');
        });

        Schema::table('ar_accesos_datos_sensibles', function (Blueprint $table) {
            $table->foreign(['id_personal'], 'fk_ar_accesos_datos_sensibles_id_personal')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ar_accesos_datos_sensibles');
    }
};
