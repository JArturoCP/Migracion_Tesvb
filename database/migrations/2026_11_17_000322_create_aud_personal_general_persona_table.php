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
        Schema::create('aud_personal_general_persona', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_personal_general_persona', true);
            $table->integer('id_personal_general')->nullable();
            $table->integer('id_personal')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();

            $table->primary(['id_personal_general_persona']);
        });

        Schema::table('aud_personal_general_persona', function (Blueprint $table) {
            $table->foreign(['id_personal'], 'fk_aud_personal_general_persona_id_personal')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_personal_general'], 'fk_aud_personal_general_persona_id_personal_general')->references(['id_personal_general'])->on('aud_personal_general')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aud_personal_general_persona');
    }
};
