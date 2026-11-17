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
        Schema::create('aud_normatividad_auditoria', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_normatividad_auditoria', true);
            $table->integer('id_normatividad');
            $table->integer('id_auditoria');
            $table->date('created_at');
            $table->date('updated_at');
            $table->date('deleted_at')->nullable();

            $table->primary(['id_normatividad_auditoria']);
        });

        Schema::table('aud_normatividad_auditoria', function (Blueprint $table) {
            $table->foreign(['id_auditoria'], 'fk_aud_normatividad_auditoria_id_auditoria')->references(['id_auditoria'])->on('aud_auditoria')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_normatividad'], 'fk_aud_normatividad_auditoria_id_normatividad')->references(['id_normatividad'])->on('aud_normatividad')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aud_normatividad_auditoria');
    }
};
