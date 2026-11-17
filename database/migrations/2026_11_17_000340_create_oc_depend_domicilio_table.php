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
        Schema::create('oc_depend_domicilio', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_depend_domicilio', true);
            $table->text('dependencia');
            $table->text('domicilio');
            $table->integer('id_oficio');
            $table->integer('id_municipio');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->primary(['id_depend_domicilio']);
            $table->unique(['id_depend_domicilio'], 'id_depend_domicilio');
        });

        Schema::table('oc_depend_domicilio', function (Blueprint $table) {
            $table->foreign(['id_municipio'], 'fk_oc_depend_domicilio_id_municipio')->references(['id_municipio'])->on('gnral_municipios')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_oficio'], 'fk_oc_depend_domicilio_id_oficio')->references(['id_oficio'])->on('oc_oficio')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oc_depend_domicilio');
    }
};
