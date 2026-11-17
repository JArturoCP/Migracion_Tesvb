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
        Schema::create('lb_profesores_materia', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_profesores_materia', true);
            $table->integer('id_semana');
            $table->integer('id_laboratorio');
            $table->text('descripcion');
            $table->integer('id_profesor');
            $table->integer('id_periodo');

            $table->primary(['id_profesores_materia']);
        });

        Schema::table('lb_profesores_materia', function (Blueprint $table) {
            $table->foreign(['id_laboratorio'], 'fk_lb_profesores_materia_id_laboratorio')->references(['id_laboratorio'])->on('lb_laboratorios')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_lb_profesores_materia_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_semana'], 'fk_lb_profesores_materia_id_semana')->references(['id_semana'])->on('hrs_semanas')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lb_profesores_materia');
    }
};
