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
        Schema::create('aud_auditor_auditoria', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_auditor_auditoria', true);
            $table->integer('id_auditoria');
            $table->integer('id_personal');
            $table->integer('id_categoria');
            $table->date('created_at');
            $table->date('updated_at');
            $table->date('deleted_at')->nullable();

            $table->primary(['id_auditor_auditoria']);
        });

        Schema::table('aud_auditor_auditoria', function (Blueprint $table) {
            $table->foreign(['id_auditoria'], 'fk_aud_auditor_auditoria_id_auditoria')->references(['id_auditoria'])->on('aud_auditoria')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_categoria'], 'fk_aud_auditor_auditoria_id_categoria')->references(['id_categoria'])->on('aud_categoria')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_personal'], 'fk_aud_auditor_auditoria_id_personal')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aud_auditor_auditoria');
    }
};
