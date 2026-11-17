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
        Schema::create('lb_registro_laboratorio', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_reg_laboratorio', true);
            $table->string('id_usuario', 100);
            $table->integer('id_semana');
            $table->text('descripcion_utilizar');
            $table->integer('id_laboratorio');
            $table->string('fecha_registro', 100);

            $table->primary(['id_reg_laboratorio']);
        });

        Schema::table('lb_registro_laboratorio', function (Blueprint $table) {
            $table->foreign(['id_laboratorio'], 'fk_lb_registro_laboratorio_id_laboratorio')->references(['id_laboratorio'])->on('lb_laboratorios')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_semana'], 'fk_lb_registro_laboratorio_id_semana')->references(['id_semana'])->on('hrs_semanas')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lb_registro_laboratorio');
    }
};
