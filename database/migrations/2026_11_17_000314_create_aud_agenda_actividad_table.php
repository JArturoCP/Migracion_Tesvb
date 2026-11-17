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
        Schema::create('aud_agenda_actividad', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_agenda_actividad', true);
            $table->integer('id_actividad');
            $table->integer('id_auditoria');
            $table->date('fecha');
            $table->time('hora_i');
            $table->time('hora_f');
            $table->timestamp('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();

            $table->primary(['id_agenda_actividad']);
        });

        Schema::table('aud_agenda_actividad', function (Blueprint $table) {
            $table->foreign(['id_actividad'], 'fk_aud_agenda_actividad_id_actividad')->references(['id_actividad'])->on('aud_actividad')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_auditoria'], 'fk_aud_agenda_actividad_id_auditoria')->references(['id_auditoria'])->on('aud_auditoria')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aud_agenda_actividad');
    }
};
