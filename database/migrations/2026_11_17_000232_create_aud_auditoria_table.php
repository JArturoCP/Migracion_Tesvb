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
        Schema::create('aud_auditoria', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_auditoria', true);
            $table->text('objetivo')->nullable();
            $table->text('alcance')->nullable();
            $table->text('criterio');
            $table->date('fecha_i');
            $table->date('fecha_f');
            $table->integer('id_programa')->nullable();
            $table->date('created_at')->nullable();
            $table->date('updated_at')->nullable();
            $table->date('deleted_at')->nullable();
            $table->integer('asignado')->nullable();

            $table->primary(['id_auditoria']);
        });

        Schema::table('aud_auditoria', function (Blueprint $table) {
            $table->foreign(['id_programa'], 'fk_aud_auditoria_id_programa')->references(['id_programa'])->on('aud_programa')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aud_auditoria');
    }
};
