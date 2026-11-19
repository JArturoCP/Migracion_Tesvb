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
        Schema::create('gnral_personales', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_personal', true);
            $table->string('nombre', 60)->nullable();
            $table->integer('id_perfil')->nullable();
            $table->integer('id_situacion')->nullable();
            $table->text('esc_procedencia');
            $table->string('origen_nac', 30)->nullable();
            $table->string('fch_nac', 10)->nullable();
            $table->string('direccion', 100)->nullable();
            $table->string('fch_ingreso_tesvb', 10)->nullable();
            $table->string('nombramiento', 10)->nullable();
            $table->string('rfc', 13)->nullable();
            $table->string('fch_recontratacion', 10)->nullable();
            $table->string('escolaridad', 15)->nullable();
            $table->integer('id_cargo')->nullable();
            $table->string('clave', 11)->nullable();
            $table->integer('horas_maxima');
            $table->string('correo', 40);
            $table->string('telefono', 20);
            $table->string('celular', 20);
            $table->integer('cedula');
            $table->string('sexo', 5);
            $table->integer('maximo_horas_ingles');
            $table->string('numero_empleado', 100);
            $table->integer('tipo_usuario')->nullable();
            $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->integer('id_departamento');
            $table->integer('estado_docente_inv')->nullable();

            $table->primary(['id_personal']);
            $table->index(['correo'], 'idx_ar_personales_correo');
        });

        Schema::table('gnral_personales', function (Blueprint $table) {
            $table->foreign(['id_cargo'], 'fk_gnral_personales_id_cargo')->references(['id_cargo'])->on('gnral_cargos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_departamento'], 'fk_gnral_personales_id_departamento')->references(['id_departamento'])->on('gnral_departamentos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_perfil'], 'fk_gnral_personales_id_perfil')->references(['id_perfil'])->on('gnral_perfiles')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gnral_personales');
    }
};
