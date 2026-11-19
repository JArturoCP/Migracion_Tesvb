<?php

namespace Tests\Unit;

use App\Gnral_Cargos;
use Database\Seeders\GnralCargosSeeder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CargosPlantillaTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        DB::purge('sqlite');
        Schema::create('gnral_cargos', function (Blueprint $table) {
            $table->increments('id_cargo');
            $table->string('cargo');
            $table->string('abre')->nullable();
            $table->timestamps();
        });
        (new GnralCargosSeeder)->run();
    }

    public function test_selector_groups_seeded_duplicates_without_deleting_them(): void
    {
        $options = Gnral_Cargos::opcionesPlantilla();
        $this->assertCount(5, $options);
        $this->assertSame(5, $options->pluck('cargo')->unique()->count());
        $this->assertSame(15, DB::table('gnral_cargos')->count());
        $this->assertSame(3, $options->firstWhere('cargo', 'DOCENTE')->id_cargo);
    }

    public function test_filter_includes_all_equivalent_ids_including_old_links(): void
    {
        Schema::create('horarios_prueba', function (Blueprint $table) {
            $table->integer('id_cargo');
        });
        foreach ([1, 3, 8, 13] as $id) {
            DB::table('horarios_prueba')->insert(['id_cargo' => $id]);
        }
        foreach ([3, 8, 13] as $selected) {
            $rows = DB::select('SELECT id_cargo FROM horarios_prueba WHERE id_cargo IN '.Gnral_Cargos::IDS_EQUIVALENTES_SQL.' ORDER BY id_cargo', [$selected]);
            $this->assertSame([3, 8, 13], array_column($rows, 'id_cargo'));
        }
    }

    public function test_same_name_with_different_abbreviation_remains_separate(): void
    {
        DB::table('gnral_cargos')->insert(['id_cargo' => 16, 'cargo' => 'DOCENTE', 'abre' => 'OTRO']);
        $options = Gnral_Cargos::opcionesPlantilla();
        $this->assertCount(6, $options);
        $this->assertContains('DOCENTE (DOC)', $options->pluck('cargo'));
        $this->assertContains('DOCENTE (OTRO)', $options->pluck('cargo'));
        $this->assertSame([16], DB::table('gnral_cargos')->whereRaw('id_cargo IN '.Gnral_Cargos::IDS_EQUIVALENTES_SQL, [16])->pluck('id_cargo')->all());
    }

    public function test_unknown_id_does_not_match_any_cargo(): void
    {
        $this->assertSame(0, DB::table('gnral_cargos')->whereRaw('id_cargo IN '.Gnral_Cargos::IDS_EQUIVALENTES_SQL, [999])->count());
    }
}
