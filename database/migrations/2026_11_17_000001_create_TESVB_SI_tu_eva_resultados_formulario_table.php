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
        DB::statement(<<<'SQL'
        CREATE TABLE `TESVB_SI.tu_eva_resultados_formulario` (
          `id_eva_resultado` int(11) NOT NULL,
          `id_asigna_alumno` int(11) NOT NULL,
          `id_asigna_tutor` int(11) NOT NULL,
          `feccha_de_registro` datetime DEFAULT NULL,
          `gestion` int(11) NOT NULL,
          `actitud` int(11) NOT NULL,
          `disponibilidad_confianza` int(11) NOT NULL,
          `servicios_del_programa_de_tutoria` int(11) NOT NULL,
          `tus_logros_y_avances` int(11) NOT NULL,
          `comentario` varchar(300) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci
        SQL);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TABLE IF EXISTS `TESVB_SI.tu_eva_resultados_formulario`');
    }
};
