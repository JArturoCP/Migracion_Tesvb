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
        Schema::create('aud_programa', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_programa', true);
            $table->date('fecha_i');
            $table->date('fecha_f');
            $table->text('lugar');
            $table->text('alcance');
            $table->text('objetivo');
            $table->text('metodos');
            $table->text('responsabilidades');
            $table->text('recursos');
            $table->text('requisitos');
            $table->text('criterios');
            $table->boolean('estado')->default(1);
            $table->date('created_at');
            $table->date('updated_at');
            $table->date('deleted_at')->nullable();
            $table->tinyInteger('active');
            $table->text('observaciones')->nullable();
            $table->text('justificacion')->nullable();

            $table->primary(['id_programa']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aud_programa');
    }
};
