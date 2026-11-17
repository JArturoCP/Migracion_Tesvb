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
        $sqlMode = DB::scalar('SELECT @@SESSION.sql_mode');
        DB::statement('SET SESSION sql_mode = ?', [implode(',', array_diff(explode(',', $sqlMode), ['NO_ZERO_DATE', 'NO_ZERO_IN_DATE']))]);

        try {
            Schema::create('in_profesores_ingles', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_profesores', true);
                $table->string('nombre', 100);
                $table->string('apellido_paterno', 100);
                $table->string('apellido_materno', 100);
                $table->integer('id_nivel_ingles');
                $table->integer('id_tipo_titulo');
                $table->date('fecha_emision_titulo');
                $table->integer('horas_maximas');
                $table->integer('id_sexo');
                $table->integer('id_tipo_usuario');
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('created_at')->default('0000-00-00 00:00:00');
                $table->text('estado_eliminacion');

                $table->primary(['id_profesores']);
            });

            Schema::table('in_profesores_ingles', function (Blueprint $table) {
                $table->foreign(['id_nivel_ingles'], 'fk_in_profesores_ingles_id_nivel_ingles')->references(['id_nivel_ingles'])->on('in_nivel_ingles')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_sexo'], 'fk_in_profesores_ingles_id_sexo')->references(['id_sexo'])->on('in_sexo')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_tipo_usuario'], 'fk_in_profesores_ingles_id_tipo_usuario')->references(['id_tipo_usuario'])->on('gnral_tipos_usuario')->onDelete('restrict')->onUpdate('cascade');
            });
        } finally {
            DB::statement('SET SESSION sql_mode = ?', [$sqlMode]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('in_profesores_ingles');
    }
};
