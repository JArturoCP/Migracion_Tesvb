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
        Schema::create('rm_bienes', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb3');
            $table->collation('utf8mb3_unicode_ci');

            $table->bigInteger('id', true, true);
            $table->string('nombre', 100);
            $table->string('caracteristicas', 255);
            $table->string('num_inventario', 45);
            $table->string('nick', 15);
            $table->string('serie', 255)->nullable();
            $table->double('costo');
            $table->integer('stock');
            $table->bigInteger('id_color', false, true);
            $table->bigInteger('id_tipob', false, true);
            $table->bigInteger('id_tipoadqui', false, true);
            $table->date('fechadqui');
            $table->boolean('condicion')->default(1);
            $table->bigInteger('id_categoria', false, true);
            $table->bigInteger('id_provedor', false, true);
            $table->bigInteger('id_modelo', false, true);
            $table->bigInteger('id_estado', false, true);
            $table->bigInteger('id_marca', false, true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('factura', 35);

            $table->primary(['id']);
        });

        // Tipos sin equivalente exacto en Schema Builder (ancho de despliegue, BIT, DOUBLE(M,D))
        DB::statement('ALTER TABLE `rm_bienes` MODIFY `costo` double(12,2) NOT NULL');

        Schema::table('rm_bienes', function (Blueprint $table) {
            $table->foreign(['id_categoria'], 'fk_rm_bienes_id_categoria')->references(['id'])->on('rm_categorias')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_color'], 'fk_rm_bienes_id_color')->references(['id'])->on('rm_colores')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_estado'], 'fk_rm_bienes_id_estado')->references(['id'])->on('rm_estadousos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_marca'], 'fk_rm_bienes_id_marca')->references(['id'])->on('rm_marcas')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_modelo'], 'fk_rm_bienes_id_modelo')->references(['id'])->on('rm_modelos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_provedor'], 'fk_rm_bienes_id_provedor')->references(['id'])->on('rm_provedores')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_tipoadqui'], 'fk_rm_bienes_id_tipoadqui')->references(['id'])->on('rm_tipoadqui')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_tipob'], 'fk_rm_bienes_id_tipob')->references(['id'])->on('rm_tipobienes')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rm_bienes');
    }
};
