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
        Schema::create('aud_reportes', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_reporte', true);
            $table->integer('id_agenda');
            $table->integer('id_auditado');
            $table->date('fecha');
            $table->date('created_at');
            $table->date('updated_at');
            $table->date('deleted_at')->nullable();

            $table->primary(['id_reporte']);
        });

        Schema::table('aud_reportes', function (Blueprint $table) {
            $table->foreign(['id_agenda'], 'fk_aud_reportes_id_agenda')->references(['id_agenda'])->on('aud_agenda')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aud_reportes');
    }
};
