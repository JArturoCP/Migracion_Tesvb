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
            Schema::create('eva_tutor', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_tutor', true);
                $table->integer('id_alumno')->nullable();
                $table->string('nombre', 50)->nullable();
                $table->string('ap_paterno_T', 50)->nullable();
                $table->string('ap_mat_T', 50)->nullable();
                $table->string('puesto', 50)->nullable();
                $table->string('parentezco', 50)->nullable();
                $table->date('fecha_nac_T')->nullable();
                $table->integer('edad')->nullable();
                $table->string('genero', 1)->nullable();
                $table->string('edo_civil_t', 45)->nullable();
                $table->string('grado_est_t', 50)->nullable();
                $table->string('nacionalidad_t', 50)->nullable();
                $table->string('entidad_t', 50)->nullable();
                $table->string('curp', 50)->nullable();
                $table->string('calle', 50)->nullable();
                $table->string('n_ext_t', 20)->nullable();
                $table->string('n_int_t', 20)->nullable();
                $table->string('entre_calle_t', 50)->nullable();
                $table->string('y_calle_t', 50)->nullable();
                $table->string('otra_ref_t', 500)->nullable();
                $table->string('colonia_t', 50)->nullable();
                $table->string('localidad_t', 50)->nullable();
                $table->string('cp_t', 10)->nullable();
                $table->string('tel_fijo_t', 20)->nullable();
                $table->string('cel_t', 20)->nullable();
                $table->string('correo_t', 50)->nullable();
                $table->string('facebook_t', 50)->nullable();
                $table->string('twitter_t', 50)->nullable();
                $table->integer('estado_T')->nullable();
                $table->integer('municipio_T')->nullable();
                $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('updated_at')->default('0000-00-00 00:00:00');

                $table->primary(['id_tutor']);
            });

            Schema::table('eva_tutor', function (Blueprint $table) {
                $table->foreign(['id_alumno'], 'fk_eva_tutor_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('eva_tutor');
    }
};
