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
        Schema::create('aud_auditoria_proceso', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_auditoria_proceso', true);
            $table->integer('id_auditoria');
            $table->integer('id_proceso');
            $table->date('created_at');
            $table->date('updated_at');
            $table->date('deleted_at');
            $table->text('observacion')->nullable();

            $table->primary(['id_auditoria_proceso']);
        });

        Schema::table('aud_auditoria_proceso', function (Blueprint $table) {
            $table->foreign(['id_auditoria'], 'fk_aud_auditoria_proceso_id_auditoria')->references(['id_auditoria'])->on('aud_auditoria')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_proceso'], 'fk_aud_auditoria_proceso_id_proceso')->references(['id_proceso'])->on('ri_proceso')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aud_auditoria_proceso');
    }
};
