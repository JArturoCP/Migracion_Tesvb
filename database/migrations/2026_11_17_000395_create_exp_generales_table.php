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
        Schema::create('exp_generales', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_exp_general', true);
            $table->integer('id_periodo')->nullable();
            $table->string('nombre', 100)->nullable();
            $table->integer('edad')->nullable();
            $table->string('sexo', 10)->nullable();
            $table->date('fecha_nacimientos')->nullable();
            $table->string('lugar_nacimientos', 255)->nullable();
            $table->integer('id_semestre')->nullable();
            $table->integer('id_estado_civil')->nullable();
            $table->integer('no_hijos')->nullable();
            $table->string('direccion', 255)->nullable();
            $table->string('correo', 255)->nullable();
            $table->string('tel_casa', 10)->nullable();
            $table->string('cel', 10)->nullable();
            $table->string('nivel_economico', 11)->nullable();
            $table->integer('trabaja')->nullable();
            $table->string('ocupacion', 100)->nullable();
            $table->string('horario', 45)->nullable();
            $table->string('no_cuenta', 45)->nullable();
            $table->integer('beca')->nullable();
            $table->integer('id_expbeca')->nullable();
            $table->integer('estado')->nullable();
            $table->integer('turno')->nullable();
            $table->integer('id_alumno');
            $table->integer('id_grupo');
            $table->integer('id_carrera');
            $table->string('poblacion', 10)->nullable();
            $table->string('ant_inst', 255)->nullable();
            $table->string('satisfaccion_c', 255)->nullable();
            $table->integer('materias_repeticion')->nullable();
            $table->integer('tot_repe')->nullable();
            $table->integer('materias_especial')->nullable();
            $table->integer('tot_espe')->nullable();
            $table->integer('gen_espe')->nullable();
            $table->binary('foto')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_exp_general']);
            $table->index(['id_periodo'], 'per_idx');
            $table->index(['id_semestre'], 'sem_idx');
            $table->index(['id_estado_civil'], 'ec_idx');
        });

        Schema::table('exp_generales', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_exp_generales_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_carrera'], 'fk_exp_generales_id_carrera')->references(['id_carrera'])->on('gnral_carreras')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_estado_civil'], 'fk_exp_generales_id_estado_civil')->references(['id_estado_civil'])->on('exp_civil_estados')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_expbeca'], 'fk_exp_generales_id_expbeca')->references(['id_expbeca'])->on('exp_beca')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_grupo'], 'fk_exp_generales_id_grupo')->references(['id_grupo'])->on('gnral_grupos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_exp_generales_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_semestre'], 'fk_exp_generales_id_semestre')->references(['id_semestre'])->on('gnral_semestres')->onDelete('restrict')->onUpdate('cascade');
        });

        DB::unprepared(<<<'SQL'
        SET @saved_cs_client = @@character_set_client;
        SET @saved_cs_results = @@character_set_results;
        SET @saved_col_connection = @@collation_connection;
        SET character_set_client = utf8mb4;
        SET character_set_results = utf8mb4;
        SET collation_connection = utf8mb4_general_ci;
        SET @saved_sql_mode = @@SESSION.sql_mode;
        SET SESSION sql_mode = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
        SQL);
        DB::unprepared(<<<'SQL'
        CREATE TRIGGER `algoritmo_insert` AFTER INSERT ON `exp_generales`
         FOR EACH ROW BEGIN
           DECLARE id_carrera_v double;
           DECLARE sexo_v double ;
           DECLARE id_estado_civil_v double;
           DECLARE no_hijos_v double;
           DECLARE trabaja_v double;
           DECLARE lugar_nacimientos_v double;
           DECLARE nivel_economico_v double;
           DECLARE beca_v double;
           DECLARE estado_v double;
           DECLARE poblacion_v double;
           DECLARE ant_inst_v double;
           DECLARE satisfaccion_c_v double;
           DECLARE materias_repeticion_v double;
           DECLARE tot_repe_v double;
           DECLARE materias_especial_v double;
           DECLARE tot_espe_v double;
           DECLARE gen_espe_v double;
           DECLARE compara int;
           DECLARE nom varchar(30);
           DECLARE ap varchar(30);
           DECLARE am varchar(30);
           
           IF NEW.id_carrera=2 THEN
               SET @id_carrera_v:=3.5;
            END IF;    
            
            IF NEW.sexo='F' THEN
               SET @sexo_v:=3.0;
            ELSEIF NEW.sexo='M' THEN
               SET @sexo_v:=3.5;
            END IF;   
           
            IF NEW.id_estado_civil=1 THEN
              SET @id_estado_civil_v:=0.8;
            ELSEIF NEW.id_estado_civil=2 THEN
              SET @id_estado_civil_v:=3.5;
            ELSEIF NEW.id_estado_civil=3 THEN
              SET @id_estado_civil_v:= 2.0;
            ELSEIF NEW.id_estado_civil=4 THEN
              SET @id_estado_civil_v:= 2.5;
             ELSEIF NEW.id_estado_civil=5 THEN
              SET @id_estado_civil_v:=2.0;
            END IF;
            
            IF NEW.no_hijos=0 THEN
              SET @no_hijos_v:=0.8;
            ELSEIF NEW.no_hijos=1 THEN
              SET @no_hijos_v:=1.5;
            ELSEIF NEW.no_hijos=2 THEN
              SET @no_hijos_v:=2.5;
            ELSEIF NEW.no_hijos=3 THEN
              SET @no_hijos_v:=2.8;
            ELSEIF NEW.no_hijos=4 THEN
              SET @no_hijos_v:=3.5;
            ELSEIF NEW.no_hijos=5 THEN
              SET @no_hijos_v:=3.5;
            END IF;
            
            IF NEW.trabaja=1 THEN
              SET @trabaja_v:=3.5;
            ELSEIF NEW.trabaja=2 THEN
              SET @trabaja_v:=1.5;
            END IF;
            
            SET @lugar_nacimientos_v=3.5;
            IF NEW.lugar_nacimientos is NULL THEN
             SET @lugar_nacimientos_v=3.5;
            END IF;
            
            IF NEW.nivel_economico="A/B" THEN
              SET @nivel_economico_v:=1.5;
            ELSEIF NEW.nivel_economico="C+" THEN
              SET @nivel_economico_v:=2.5;
            ELSEIF NEW.nivel_economico="C" THEN
              SET @nivel_economico_v:=2.5;
            ELSEIF NEW.nivel_economico="C-" THEN
              SET @nivel_economico_v:=2.5;
            ELSEIF NEW.nivel_economico="D+" THEN
              SET @nivel_economico_v:=3.0;
            ELSEIF NEW.nivel_economico="D" THEN
              SET @nivel_economico_v:=3.0;
            ELSEIF NEW.nivel_economico="E" THEN
              SET @nivel_economico_v:=3.5;
            END IF;
            
             IF NEW.beca=1 THEN
              SET @beca_v:=1.5;
            ELSEIF NEW.beca=2 THEN
              SET @beca_v:=3.5;
            END IF;
           
            IF NEW.estado=1 THEN
              SET @estado_v:=1.5;
            ELSEIF NEW.estado=2 THEN
              SET @estado_v:=3.5;
            ELSEIF NEW.estado=3 THEN
              SET @estado_v:=0;
            ELSEIF NEW.estado=4 THEN
              SET @estado_v:=0;
            ELSEIF NEW.estado=5 THEN
              SET @estado_v:=0;
            END IF;
            
            IF NEW.poblacion is NULL THEN
              SET @poblacion_v:=0.0;
            ELSEIF NEW.poblacion="Rural" THEN
              SET @poblacion_v:=3.5;
            ELSEIF NEW.poblacion="Urbana" THEN
              SET @poblacion_v:=2.0;
            END IF;
            
            IF NEW.ant_inst is NULL THEN
              SET @ant_inst_v:=0;
            ELSEIF NEW.ant_inst="Continuación de estudios" THEN
              SET @ant_inst_v:=1.5;
            ELSEIF NEW.ant_inst="Cambio de carrera/institución" THEN
              SET @ant_inst_v:=2.0;
            END IF;
            
            
            IF NEW.satisfaccion_c is NULL THEN
              SET @satisfaccion_c_v:=0.0;
            ELSEIF NEW.satisfaccion_c="Muy satisfecho" THEN
              SET @satisfaccion_c_v:=0.8;
            ELSEIF NEW.satisfaccion_c="Satisfecho" THEN
              SET @satisfaccion_c_v:=1.5;
            ELSEIF NEW.satisfaccion_c="Regular" THEN
              SET @satisfaccion_c_v:=2.5;
            ELSEIF NEW.satisfaccion_c="Inconforme" THEN
              SET @satisfaccion_c_v:=3.5;
            END IF;
            
            IF NEW.materias_repeticion=1 THEN
              SET @materias_repeticion_v:=3.5;
            ELSEIF NEW.materias_repeticion=2 THEN
              SET @materias_repeticion_v:=0.5;
            END IF;
           
            IF NEW.tot_repe is NULL THEN
              SET @tot_repe_v:=0.1;
            ELSEIF NEW.tot_repe=1 THEN
              SET @tot_repe_v:=0.1;
            ELSEIF NEW.tot_repe=2 THEN
              SET @tot_repe_v:=1.5;
            ELSEIF NEW.tot_repe=3 THEN
              SET @tot_repe_v:=2.5;
            ELSEIF NEW.tot_repe=4 THEN
              SET @tot_repe_v:=3.5;
            END IF;
            
            IF NEW.materias_especial=1 THEN
              SET @materias_especial_v:=3.5;
            ELSEIF NEW.materias_especial=2 THEN
              SET @materias_especial_v:=0.5;
            END IF;
            
            IF NEW.tot_espe is NULL THEN
              SET @tot_espe_v:=0.1;
            ELSEIF NEW.tot_espe=1 THEN
              SET @tot_espe_v:=0.1;
            ELSEIF NEW.tot_espe=2 THEN
              SET @tot_espe_v:=1.5;
            ELSEIF NEW.tot_espe=3 THEN
              SET @tot_espe_v:=2.5;
            ELSEIF NEW.tot_espe=4 THEN
              SET @tot_espe_v:=3.5;
            END IF;
            
            IF NEW.gen_espe is NULL THEN
              SET @gen_espe_v:=0.1;
            ELSEIF NEW.gen_espe=1 THEN
              SET @gen_espe_v:=0.1;
            ELSEIF NEW.gen_espe=2 THEN
              SET @gen_espe_v:=1.5;
            ELSEIF NEW.gen_espe=3 THEN
              SET @gen_espe_v:=2.5;
            ELSEIF NEW.gen_espe=4 THEN
              SET @gen_espe_v:=3.5;
            END IF; 
            
            SET @nom:=(SELECT nombre FROM gnral_alumnos where cuenta=NEW.no_cuenta);
            SET @ap:=(SELECT apaterno FROM gnral_alumnos where cuenta=NEW.no_cuenta);
            SET @am:=(SELECT amaterno FROM gnral_alumnos where cuenta=NEW.no_cuenta);
            
            SET @compara=(SELECT COUNT(no_cuenta)FROM prediccion where no_cuenta=NEW.no_cuenta);  
            IF @compara=0 THEN
                INSERT INTO prediccion (nom,ap,am,no_cuenta,id_carrera,id_carrera_v,sexo,sexo_v,id_estado_civil,id_estado_civil_v,
                                        no_hijos,no_hijos_v,trabaja,trabaja_v,lugar_nacimientos,lugar_nacimientos_v,nivel_economico,nivel_economico_v
                                       ,beca,beca_v,estado,estado_v,poblacion,poblacion_v,ant_inst,ant_inst_v,satisfaccion_c,satisfaccion_c_v,
                                       materias_repeticion,materias_repeticion_v,tot_repe,tot_repe_v,materias_especial,materias_especial_v,
                                       tot_espe,tot_espe_v,gen_espe,gen_espe_v) 
                VALUES(@nom,@ap,@am,NEW.no_cuenta,NEW.id_carrera,@id_carrera_v,NEW.sexo,@sexo_v,NEW.id_estado_civil,@id_estado_civil_v,
                                        NEW.no_hijos,@no_hijos_v,NEW.trabaja,@trabaja_v,NEW.lugar_nacimientos,@lugar_nacimientos_v,
                       					NEW.nivel_economico,@nivel_economico_v,NEW.beca,@beca_v,NEW.estado,@estado_v,NEW.poblacion,@poblacion_v,
                       					NEW.ant_inst,@ant_inst_v,NEW.satisfaccion_c,@satisfaccion_c_v,
                                        NEW.materias_repeticion,@materias_repeticion_v,NEW.tot_repe,@tot_repe_v,
                       					NEW.materias_especial,@materias_especial_v,
                                        NEW.tot_espe,@tot_espe_v,NEW.gen_espe,@gen_espe_v);
            END IF;  
        END
        SQL);
        DB::unprepared(<<<'SQL'
        SET SESSION sql_mode = @saved_sql_mode;
        SET character_set_client = @saved_cs_client;
        SET character_set_results = @saved_cs_results;
        SET collation_connection = @saved_col_connection;
        SQL);

        DB::unprepared(<<<'SQL'
        SET @saved_cs_client = @@character_set_client;
        SET @saved_cs_results = @@character_set_results;
        SET @saved_col_connection = @@collation_connection;
        SET character_set_client = utf8mb4;
        SET character_set_results = utf8mb4;
        SET collation_connection = utf8mb4_general_ci;
        SET @saved_sql_mode = @@SESSION.sql_mode;
        SET SESSION sql_mode = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
        SQL);
        DB::unprepared(<<<'SQL'
        CREATE TRIGGER `algoritmo_update` AFTER UPDATE ON `exp_generales`
         FOR EACH ROW BEGIN
           DECLARE id_estado_civil_v double;
           DECLARE no_hijos_v double;
           DECLARE trabaja_v double;
           DECLARE lugar_nacimientos_v double;
           DECLARE nivel_economico_v double;
           DECLARE beca_v double;
           DECLARE estado_v double;
           DECLARE poblacion_v double;
           DECLARE ant_inst_v double;
           DECLARE satisfaccion_c_v double;
           DECLARE materias_repeticion_v double;
           DECLARE tot_repe_v double;
           DECLARE materias_especial_v double;
           DECLARE tot_espe_v double;
           DECLARE gen_espe_v double;
           DECLARE compara int;
           
            
            IF NEW.id_estado_civil=1 THEN
              SET @id_estado_civil_v:=0.8;
            ELSEIF NEW.id_estado_civil=2 THEN
              SET @id_estado_civil_v:=3.5;
            ELSEIF NEW.id_estado_civil=3 THEN
              SET @id_estado_civil_v:= 2.0;
            ELSEIF NEW.id_estado_civil=4 THEN
              SET @id_estado_civil_v:= 2.5;
             ELSEIF NEW.id_estado_civil=5 THEN
              SET @id_estado_civil_v:=2.0;
            END IF;
            
            IF NEW.no_hijos=0 THEN
              SET @no_hijos_v:=0.8;
            ELSEIF NEW.no_hijos=1 THEN
              SET @no_hijos_v:=1.5;
            ELSEIF NEW.no_hijos=2 THEN
              SET @no_hijos_v:=2.5;
            ELSEIF NEW.no_hijos=3 THEN
              SET @no_hijos_v:=2.8;
            ELSEIF NEW.no_hijos=4 THEN
              SET @no_hijos_v:=3.5;
            ELSEIF NEW.no_hijos=5 THEN
              SET @no_hijos_v:=3.5;
            END IF;
            
            IF NEW.trabaja=1 THEN
              SET @trabaja_v:=3.5;
            ELSEIF NEW.trabaja=2 THEN
              SET @trabaja_v:=1.5;
            END IF;
            
            SET @lugar_nacimientos_v=3.5;
            IF NEW.lugar_nacimientos is NULL THEN
             SET @lugar_nacimientos_v=3.5;
            END IF;
            
            IF NEW.nivel_economico="A/B" THEN
              SET @nivel_economico_v:=1.5;
            ELSEIF NEW.nivel_economico="C+" THEN
              SET @nivel_economico_v:=2.5;
            ELSEIF NEW.nivel_economico="C" THEN
              SET @nivel_economico_v:=2.5;
            ELSEIF NEW.nivel_economico="C-" THEN
              SET @nivel_economico_v:=2.5;
            ELSEIF NEW.nivel_economico="D+" THEN
              SET @nivel_economico_v:=3.0;
            ELSEIF NEW.nivel_economico="D" THEN
              SET @nivel_economico_v:=3.0;
            ELSEIF NEW.nivel_economico="E" THEN
              SET @nivel_economico_v:=3.5;
            END IF;
            
             IF NEW.beca=1 THEN
              SET @beca_v:=1.5;
            ELSEIF NEW.beca=2 THEN
              SET @beca_v:=3.5;
            END IF;
           
            IF NEW.estado=1 THEN
              SET @estado_v:=1.5;
            ELSEIF NEW.estado=2 THEN
              SET @estado_v:=3.5;
            ELSEIF NEW.estado=3 THEN
              SET @estado_v:=0;
            ELSEIF NEW.estado=4 THEN
              SET @estado_v:=0;
            ELSEIF NEW.estado=5 THEN
              SET @estado_v:=0;
            END IF;
            
            IF NEW.poblacion is NULL THEN
              SET @poblacion_v:=0.0;
            ELSEIF NEW.poblacion="Rural" THEN
              SET @poblacion_v:=3.5;
            ELSEIF NEW.poblacion="Urbana" THEN
              SET @poblacion_v:=2.0;
            END IF;
            
            IF NEW.ant_inst is NULL THEN
              SET @ant_inst_v:=0;
            ELSEIF NEW.ant_inst="Continuación de estudios" THEN
              SET @ant_inst_v:=1.5;
            ELSEIF NEW.ant_inst="Cambio de carrera/institución" THEN
              SET @ant_inst_v:=2.0;
            END IF;
            
            
            IF NEW.satisfaccion_c is NULL THEN
              SET @satisfaccion_c_v:=0.0;
            ELSEIF NEW.satisfaccion_c="Muy satisfecho" THEN
              SET @satisfaccion_c_v:=0.8;
            ELSEIF NEW.satisfaccion_c="Satisfecho" THEN
              SET @satisfaccion_c_v:=1.5;
            ELSEIF NEW.satisfaccion_c="Regular" THEN
              SET @satisfaccion_c_v:=2.5;
            ELSEIF NEW.satisfaccion_c="Inconforme" THEN
              SET @satisfaccion_c_v:=3.5;
            END IF;
            
            IF NEW.materias_repeticion=1 THEN
              SET @materias_repeticion_v:=3.5;
            ELSEIF NEW.materias_repeticion=2 THEN
              SET @materias_repeticion_v:=0.5;
            END IF;
           
            IF NEW.tot_repe is NULL THEN
              SET @tot_repe_v:=0.1;
            ELSEIF NEW.tot_repe=1 THEN
              SET @tot_repe_v:=0.1;
            ELSEIF NEW.tot_repe=2 THEN
              SET @tot_repe_v:=1.5;
            ELSEIF NEW.tot_repe=3 THEN
              SET @tot_repe_v:=2.5;
            ELSEIF NEW.tot_repe=4 THEN
              SET @tot_repe_v:=3.5;
            END IF;
            
            IF NEW.materias_especial=1 THEN
              SET @materias_especial_v:=3.5;
            ELSEIF NEW.materias_especial=2 THEN
              SET @materias_especial_v:=0.5;
            END IF;
            
            IF NEW.tot_espe is NULL THEN
              SET @tot_espe_v:=0.1;
            ELSEIF NEW.tot_espe=1 THEN
              SET @tot_espe_v:=0.1;
            ELSEIF NEW.tot_espe=2 THEN
              SET @tot_espe_v:=1.5;
            ELSEIF NEW.tot_espe=3 THEN
              SET @tot_espe_v:=2.5;
            ELSEIF NEW.tot_espe=4 THEN
              SET @tot_espe_v:=3.5;
            END IF;
            
            IF NEW.gen_espe is NULL THEN
              SET @tot_espe_v:=0.1;
            ELSEIF NEW.gen_espe=1 THEN
              SET @gen_espe_v:=0.1;
            ELSEIF NEW.gen_espe=2 THEN
              SET @gen_espe_v:=1.5;
            ELSEIF NEW.gen_espe=3 THEN
              SET @gen_espe_v:=2.5;
            ELSEIF NEW.gen_espe=4 THEN
              SET @gen_espe_v:=3.5;
            END IF; 
            
            UPDATE prediccion
            JOIN gnral_alumnos ON gnral_alumnos.cuenta=prediccion.no_cuenta
            SET id_estado_civil=NEW.id_estado_civil,id_estado_civil_v=@id_estado_civil_v,no_hijos=NEW.no_hijos,no_hijos_v=@no_hijos_v,
            trabaja=NEW.trabaja,trabaja_v=@trabaja_v,nivel_economico=NEW.nivel_economico,nivel_economico_v=@nivel_economico_v,
            beca=NEW.beca,beca_v=@beca_v,poblacion=NEW.poblacion,poblacion_v=@poblacion_v,prediccion.estado=NEW.estado,prediccion.estado_v=@estado_v,
            ant_inst=NEW.ant_inst,ant_inst_v=@ant_inst_v,satisfaccion_c=NEW.satisfaccion_c,satisfaccion_c_v=@satisfaccion_c_v,
            materias_repeticion=NEW.materias_repeticion,materias_repeticion_v=@materias_repeticion_v,tot_repe=NEW.tot_repe,
            tot_repe_v=@tot_repe_v,materias_especial=NEW.materias_especial,materias_especial_v=@materias_especial_v,
            tot_espe=NEW.tot_espe,tot_espe_v=@tot_espe_v,gen_espe=NEW.gen_espe,gen_espe_v=@gen_espe_v
            where gnral_alumnos.id_alumno=NEW.id_alumno
            and gnral_alumnos.cuenta=prediccion.no_cuenta;
        END
        SQL);
        DB::unprepared(<<<'SQL'
        SET SESSION sql_mode = @saved_sql_mode;
        SET character_set_client = @saved_cs_client;
        SET character_set_results = @saved_cs_results;
        SET collation_connection = @saved_col_connection;
        SQL);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exp_generales');
    }
};
