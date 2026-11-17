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
        Schema::create('plan_control_admins', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_control_admin', true);
            $table->integer('id_unidad');
            $table->integer('grupo');
            $table->date('fecha_evaluacion');
            $table->date('fecha_revision');
            $table->date('fecha_entrega');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('id_encabezado')->nullable();
            $table->integer('habilitado')->nullable();

            $table->primary(['id_control_admin']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_control_admins');
    }
};
