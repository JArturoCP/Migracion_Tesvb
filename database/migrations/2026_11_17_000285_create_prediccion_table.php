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
        Schema::create('prediccion', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_prediccion', true);
            $table->string('nom', 100)->nullable();
            $table->string('ap', 30)->nullable();
            $table->string('am', 30)->nullable();
            $table->string('no_cuenta', 20)->nullable();
            $table->integer('id_carrera')->nullable();
            $table->double('id_carrera_v')->nullable();
            $table->string('sexo', 30)->nullable();
            $table->double('sexo_v')->nullable();
            $table->integer('id_estado_civil')->nullable();
            $table->double('id_estado_civil_v')->nullable();
            $table->integer('no_hijos')->nullable();
            $table->double('no_hijos_v')->nullable();
            $table->integer('no_hermanos')->nullable();
            $table->double('no_hermanos_v')->nullable();
            $table->integer('enfermedad_cronica')->nullable();
            $table->double('enfermedad_cronica_v')->nullable();
            $table->integer('trabaja')->nullable();
            $table->double('trabaja_v')->nullable();
            $table->integer('practica_deporte')->nullable();
            $table->double('practica_deporte_v')->nullable();
            $table->integer('actividades_culturales')->nullable();
            $table->double('actividades_culturales_v')->nullable();
            $table->integer('etnia_indigena')->nullable();
            $table->double('etnia_indigena_v')->nullable();
            $table->string('lugar_nacimientos', 50)->nullable();
            $table->double('lugar_nacimientos_v')->nullable();
            $table->string('nivel_economico', 11)->nullable();
            $table->double('nivel_economico_v')->nullable();
            $table->string('sostiene_economia_hogar', 30)->nullable();
            $table->double('sostiene_economia_hogar_v')->nullable();
            $table->integer('tegusta_carrera_elegida')->nullable();
            $table->double('tegusta_carrera_elegida_v')->nullable();
            $table->integer('beca')->nullable();
            $table->double('beca_v')->nullable();
            $table->integer('estado')->nullable();
            $table->double('estado_v')->nullable();
            $table->integer('id_expbebidas')->nullable();
            $table->double('id_expbebidas_v')->nullable();
            $table->string('poblacion', 11)->nullable();
            $table->double('poblacion_v')->nullable();
            $table->string('ant_inst', 50)->nullable();
            $table->double('ant_inst_v')->nullable();
            $table->string('satisfaccion_c', 50)->nullable();
            $table->double('satisfaccion_c_v')->nullable();
            $table->integer('materias_repeticion')->nullable();
            $table->double('materias_repeticion_v')->nullable();
            $table->integer('tot_repe')->nullable();
            $table->double('tot_repe_v')->nullable();
            $table->integer('materias_especial')->nullable();
            $table->double('materias_especial_v')->nullable();
            $table->integer('tot_espe')->nullable();
            $table->double('tot_espe_v')->nullable();
            $table->integer('gen_espe')->nullable();
            $table->double('gen_espe_v')->nullable();
            $table->double('total')->nullable();

            $table->primary(['id_prediccion']);
        });

        Schema::table('prediccion', function (Blueprint $table) {
            $table->foreign(['id_carrera'], 'fk_prediccion_id_carrera')->references(['id_carrera'])->on('gnral_carreras')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_estado_civil'], 'fk_prediccion_id_estado_civil')->references(['id_estado_civil'])->on('exp_civil_estados')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_expbebidas'], 'fk_prediccion_id_expbebidas')->references(['id_expbebidas'])->on('exp_bebidas')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prediccion');
    }
};
