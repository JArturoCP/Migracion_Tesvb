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
        Schema::create('egel_nuevos_docentes', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->integer('id_egel_nuevo_docente', true);
            $table->string('nombre_docente', 250);
            $table->string('correo', 255);
            $table->string('password', 255);
            $table->integer('id_carrera')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->string('password_visible', 255)->nullable();

            $table->primary(['id_egel_nuevo_docente']);
        });

        Schema::table('egel_nuevos_docentes', function (Blueprint $table) {
            $table->foreign(['id_carrera'], 'fk_egel_nuevos_docentes_id_carrera')->references(['id_carrera'])->on('gnral_carreras')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egel_nuevos_docentes');
    }
};
