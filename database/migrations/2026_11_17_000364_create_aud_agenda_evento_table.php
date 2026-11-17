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
        Schema::create('aud_agenda_evento', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_agenda_evento', true);
            $table->integer('id_agenda');
            $table->integer('id_auditoria_proceso');
            $table->integer('id_auditor_auditoria');
            $table->date('created_at');
            $table->date('updated_at');
            $table->date('deleted_at');

            $table->primary(['id_agenda_evento']);
        });

        Schema::table('aud_agenda_evento', function (Blueprint $table) {
            $table->foreign(['id_agenda'], 'fk_aud_agenda_evento_id_agenda')->references(['id_agenda'])->on('aud_agenda')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_auditor_auditoria'], 'fk_aud_agenda_evento_id_auditor_auditoria')->references(['id_auditor_auditoria'])->on('aud_auditor_auditoria')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_auditoria_proceso'], 'fk_aud_agenda_evento_id_auditoria_proceso')->references(['id_auditoria_proceso'])->on('aud_auditoria_proceso')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aud_agenda_evento');
    }
};
