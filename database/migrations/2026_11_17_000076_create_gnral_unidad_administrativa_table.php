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
            Schema::create('gnral_unidad_administrativa', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->bigInteger('id_unidad_admin', true);
                $table->string('nom_departamento', 100)->nullable();
                $table->string('jefe_descripcion', 200);
                $table->string('clave', 20)->nullable();
                $table->integer('cod')->nullable();
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('created_at')->default('0000-00-00 00:00:00');

                $table->primary(['id_unidad_admin']);
            });

            // Tipos sin equivalente exacto en Schema Builder (ancho de despliegue, BIT, DOUBLE(M,D))
            DB::statement('ALTER TABLE `gnral_unidad_administrativa` MODIFY `id_unidad_admin` bigint(10) NOT NULL AUTO_INCREMENT');
        } finally {
            DB::statement('SET SESSION sql_mode = ?', [$sqlMode]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gnral_unidad_administrativa');
    }
};
