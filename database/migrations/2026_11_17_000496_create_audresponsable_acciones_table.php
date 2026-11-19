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
        Schema::create('audresponsable_acciones', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_responsable', true);
            $table->integer('id_personal')->nullable();
            $table->integer('id_notas')->nullable();
            $table->integer('estado')->nullable();
            $table->integer('viable')->nullable();
            $table->integer('requiere_accion')->nullable();
            $table->integer('requiere_correccion')->nullable();
            $table->text('causa_raiz')->nullable();
            $table->text('accion_correctiva')->nullable();
            $table->text('analisis')->nullable();
            $table->integer('actualizacion_riesgos')->nullable();
            $table->integer('cambios_sistema')->nullable();
            $table->text('valor_actr')->nullable();
            $table->text('valor_cambios')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->text('observaciones')->nullable();
            $table->text('observaciones_lider')->nullable();
            $table->string('folio_requisicion', 100)->nullable();
            $table->date('fecha_requisicion')->nullable();
            $table->tinyInteger('estado_cierre', false, true)->default(0);
            $table->integer('cerrado_por')->nullable();
            $table->timestamp('cerrado_at')->nullable();
            $table->text('observaciones_cierre')->nullable();
            $table->boolean('integrar_informe')->default(1);

            $table->primary(['id_responsable']);
        });

        Schema::table('audresponsable_acciones', function (Blueprint $table) {
            $table->foreign(['id_notas'], 'fk_audresponsable_acciones_id_notas')->references(['id_notas'])->on('aud_notas')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_personal'], 'fk_audresponsable_acciones_id_personal')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audresponsable_acciones');
    }
};
