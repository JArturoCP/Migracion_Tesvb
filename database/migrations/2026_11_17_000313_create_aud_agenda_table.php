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
        Schema::create('aud_agenda', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_agenda', true);
            $table->date('fecha');
            $table->time('hora_i');
            $table->time('hora_f');
            $table->text('criterios')->nullable();
            $table->date('created_at');
            $table->date('updated_at');
            $table->date('deleted_at')->nullable();
            $table->integer('id_auditoria');

            $table->primary(['id_agenda']);
        });

        Schema::table('aud_agenda', function (Blueprint $table) {
            $table->foreign(['id_auditoria'], 'fk_aud_agenda_id_auditoria')->references(['id_auditoria'])->on('aud_auditoria')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aud_agenda');
    }
};
