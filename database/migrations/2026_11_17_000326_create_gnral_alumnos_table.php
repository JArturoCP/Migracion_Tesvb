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
        Schema::create('gnral_alumnos', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_alumno', true);
            $table->string('cuenta', 20)->nullable();
            $table->string('nombre', 50)->nullable();
            $table->string('apaterno', 50)->nullable();
            $table->string('amaterno', 50)->nullable();
            $table->string('genero', 5)->nullable();
            $table->date('fecha_nac')->nullable();
            $table->integer('edad')->nullable();
            $table->string('curp_al', 18)->nullable();
            $table->string('edo_civil', 45)->nullable();
            $table->string('nacionalidad', 45)->nullable();
            $table->string('twiter_al', 45)->nullable();
            $table->string('correo_al', 45)->nullable();
            $table->string('facebook_al', 45)->nullable();
            $table->string('cel_al', 45)->nullable();
            $table->string('tel_fijo_al', 45)->nullable();
            $table->string('entidad_nac_al', 45)->nullable();
            $table->string('grado_estudio_al', 45)->nullable();
            $table->integer('id_carrera')->nullable();
            $table->integer('id_semestre')->nullable();
            $table->integer('grupo')->nullable();
            $table->double('promedio')->nullable();
            $table->integer('estado')->nullable();
            $table->integer('id_municipio')->nullable();
            $table->string('calle_al', 50)->nullable();
            $table->string('n_ext_al', 50)->nullable();
            $table->string('n_int_al', 50)->nullable();
            $table->string('entre_calle', 50)->nullable();
            $table->string('y_calle', 50)->nullable();
            $table->string('otra_ref', 500)->nullable();
            $table->string('colonia_al', 50)->nullable();
            $table->string('localidad_al', 50)->nullable();
            $table->string('cp', 10)->nullable();
            $table->integer('id_usuario');
            $table->integer('sesion')->nullable();
            $table->integer('discapacidad');
            $table->text('descripcion_discapacidad');
            $table->integer('lengua');
            $table->text('descripcion_lengua');
            $table->integer('id_seguro_social');
            $table->string('numero_seguro_social', 12);
            $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
            $table->timestamp('updated_at')->nullable();
            $table->integer('id_escuela_procedencia');
            $table->double('promedio_preparatoria');
            $table->integer('revalidacion');
            $table->integer('id_disponible');
            $table->integer('s_a');
            $table->integer('id_institucion');
            $table->string('folio', 60);
            $table->string('tipo_admision', 45)->nullable();

            $table->primary(['id_alumno']);
            $table->index(['id_carrera', 'estado', 'grupo', 'id_semestre', 'id_alumno'], 'idx_ar_alumnos_carrera_estado_grupo');
            $table->index(['id_usuario'], 'idx_ar_alumnos_usuario');
            $table->index(['cuenta'], 'idx_ar_alumnos_cuenta');
        });

        Schema::table('gnral_alumnos', function (Blueprint $table) {
            $table->foreign(['id_carrera'], 'fk_gnral_alumnos_id_carrera')->references(['id_carrera'])->on('gnral_carreras')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_escuela_procedencia'], 'fk_gnral_alumnos_id_escuela_procedencia')->references(['id_escuela_procedencia'])->on('gnral_escuela_procedencia')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_institucion'], 'fk_gnral_alumnos_id_institucion')->references(['id_institucion'])->on('gnral_instituciones_edu')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_municipio'], 'fk_gnral_alumnos_id_municipio')->references(['id_municipio'])->on('gnral_municipios')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_seguro_social'], 'fk_gnral_alumnos_id_seguro_social')->references(['id_seguro_social'])->on('gnral_seguro_social')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_semestre'], 'fk_gnral_alumnos_id_semestre')->references(['id_semestre'])->on('gnral_semestres')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gnral_alumnos');
    }
};
