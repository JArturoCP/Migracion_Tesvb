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
        Schema::create('inc_evidencias', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_evid', true);
            $table->integer('id_tipo_evid')->nullable();
            $table->text('arch_evidencia')->nullable();
            $table->timestamp('fecha_envio')->useCurrent()->useCurrentOnUpdate();
            $table->integer('id_solicitud')->nullable();
            $table->integer('id_personal')->nullable();
            $table->integer('id_jefe')->nullable();
            $table->date('fecha_solicita');
            $table->date('fecha_solicita_2');
            $table->string('no_folio', 100);
            $table->integer('no_fecha');
            $table->integer('id_autorizado');

            $table->primary(['id_evid']);
        });

        Schema::table('inc_evidencias', function (Blueprint $table) {
            $table->foreign(['id_personal'], 'fk_inc_evidencias_id_personal')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_solicitud'], 'fk_inc_evidencias_id_solicitud')->references(['id_solicitud'])->on('inc_solicitudes')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_tipo_evid'], 'fk_inc_evidencias_id_tipo_evid')->references(['id_tipo_evid'])->on('inc_tipo_evidencia')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inc_evidencias');
    }
};
