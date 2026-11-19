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
        Schema::create('aud_informe', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_informe', true);
            $table->integer('id_auditoria')->nullable();
            $table->text('resumen')->nullable();
            $table->text('cierre')->nullable();
            $table->text('conclusiones')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->primary(['id_informe']);
        });

        Schema::table('aud_informe', function (Blueprint $table) {
            $table->foreign(['id_auditoria'], 'fk_aud_informe_id_auditoria')->references(['id_auditoria'])->on('aud_auditoria')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aud_informe');
    }
};
