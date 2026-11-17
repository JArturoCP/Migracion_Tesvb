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
        Schema::create('plan_pdf_validaciones', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_unicode_ci');

            $table->bigInteger('id', true, true);
            $table->bigInteger('pdf_id', false, true)->nullable();
            $table->bigInteger('id_plan_encabezado', false, true)->nullable();
            $table->bigInteger('id_materia', false, true)->nullable();
            $table->string('grupo', 20)->nullable();
            $table->tinyInteger('estado_anterior', false, true)->nullable();
            $table->tinyInteger('estado_nuevo', false, true);
            $table->text('comentario')->nullable();
            $table->bigInteger('id_usuario', false, true)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id']);
            $table->index(['pdf_id'], 'plan_pdf_validaciones_pdf_id_index');
            $table->index(['id_plan_encabezado'], 'plan_pdf_validaciones_id_plan_encabezado_index');
            $table->index(['id_materia'], 'plan_pdf_validaciones_id_materia_index');
            $table->index(['grupo'], 'plan_pdf_validaciones_grupo_index');
            $table->index(['id_usuario'], 'plan_pdf_validaciones_id_usuario_index');
        });

        Schema::table('plan_pdf_validaciones', function (Blueprint $table) {
            $table->foreign(['id_plan_encabezado'], 'fk_plan_pdf_validaciones_id_plan_encabezado')->references(['id_encabezado'])->on('plan_encabezado')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['pdf_id'], 'fk_plan_pdf_validaciones_pdf_id')->references(['id'])->on('pdfs')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_pdf_validaciones');
    }
};
