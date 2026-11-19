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
        Schema::create('ti_preparatatoria', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_preparatoria', true);
            $table->text('preparatoria');
            $table->integer('id_entidad_federativa');
            $table->integer('id_tipo_estudio_antecedente');
            $table->string('fecha_registro', 100);

            $table->primary(['id_preparatoria']);
        });

        Schema::table('ti_preparatatoria', function (Blueprint $table) {
            $table->foreign(['id_entidad_federativa'], 'fk_ti_preparatatoria_id_entidad_federativa')->references(['id_entidad_federativa'])->on('ti_entidades_federativas')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_tipo_estudio_antecedente'], 'fk_ti_preparatatoria_id_tipo_estudio_antecedente')->references(['id_tipo_estudio_antecedente'])->on('ti_tipo_estudio_antecedente')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ti_preparatatoria');
    }
};
