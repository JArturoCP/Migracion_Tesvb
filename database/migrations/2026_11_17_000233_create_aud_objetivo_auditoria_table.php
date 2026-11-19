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
        Schema::create('aud_objetivo_auditoria', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_objetivo_programa', true);
            $table->integer('id_objetivo');
            $table->integer('id_programa');
            $table->date('created_at');
            $table->date('updated_at');
            $table->date('deleted_at')->nullable();

            $table->primary(['id_objetivo_programa']);
        });

        Schema::table('aud_objetivo_auditoria', function (Blueprint $table) {
            $table->foreign(['id_objetivo'], 'fk_aud_objetivo_auditoria_id_objetivo')->references(['id_objetivo'])->on('aud_objetivo')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_programa'], 'fk_aud_objetivo_auditoria_id_programa')->references(['id_programa'])->on('aud_programa')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aud_objetivo_auditoria');
    }
};
