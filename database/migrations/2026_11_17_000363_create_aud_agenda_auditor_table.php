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
        Schema::create('aud_agenda_auditor', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_agenda_auditor', true);
            $table->integer('id_agenda');
            $table->integer('id_auditor_auditoria');
            $table->timestamp('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();

            $table->primary(['id_agenda_auditor']);
        });

        Schema::table('aud_agenda_auditor', function (Blueprint $table) {
            $table->foreign(['id_agenda'], 'fk_aud_agenda_auditor_id_agenda')->references(['id_agenda'])->on('aud_agenda')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_auditor_auditoria'], 'fk_aud_agenda_auditor_id_auditor_auditoria')->references(['id_auditor_auditoria'])->on('aud_auditor_auditoria')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aud_agenda_auditor');
    }
};
