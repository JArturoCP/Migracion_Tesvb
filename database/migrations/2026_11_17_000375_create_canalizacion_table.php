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
            Schema::create('canalizacion', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_canalizacion', true);
                $table->integer('id_alumno');
                $table->integer('id_personal');
                $table->date('fecha_canalizacion');
                $table->time('hora');
                $table->string('aspectos_sociologicos1', 3)->nullable();
                $table->string('aspectos_sociologicos2', 3)->nullable();
                $table->string('aspectos_sociologicos3', 3)->nullable();
                $table->string('aspectos_academicos1', 3)->nullable();
                $table->string('aspectos_academicos2', 3)->nullable();
                $table->string('aspectos_academicos3', 3)->nullable();
                $table->text('observaciones')->nullable();
                $table->text('otros')->nullable();
                $table->text('desc_area');
                $table->text('desc_subarea')->nullable();
                $table->text('status');
                $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('updated_at')->default('0000-00-00 00:00:00');

                $table->primary(['id_canalizacion']);
            });

            Schema::table('canalizacion', function (Blueprint $table) {
                $table->foreign(['id_alumno'], 'fk_canalizacion_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_personal'], 'fk_canalizacion_id_personal')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('canalizacion');
    }
};
