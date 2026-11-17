<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class EditarDocenteTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        DB::purge('sqlite');
        Schema::create('gnral_personales', function (Blueprint $table) {
            $table->increments('id_personal');
            foreach (['tipo_usuario', 'id_perfil', 'id_situacion', 'id_cargo', 'id_departamento', 'horas_maxima', 'maximo_horas_ingles', 'cedula'] as $column) {
                $table->integer($column)->nullable();
            }
            foreach (['nombre', 'clave', 'rfc', 'esc_procedencia', 'direccion', 'correo', 'origen_nac', 'fch_nac', 'fch_ingreso_tesvb', 'nombramiento', 'fch_recontratacion', 'escolaridad', 'telefono', 'celular', 'sexo', 'numero_empleado'] as $column) {
                $table->string($column)->nullable();
            }
            $table->timestamps();
        });
        foreach (['gnral_perfiles' => 'id_perfil', 'hrs_situaciones' => 'id_situacion', 'abreviaciones' => 'id_abreviacion'] as $name => $key) {
            Schema::create($name, function (Blueprint $table) use ($key) { $table->increments($key); });
            DB::table($name)->insert([$key => 1]);
        }
        Schema::create('abreviaciones_prof', function (Blueprint $table) {
            $table->increments('id_abreviacion_prof');
            $table->integer('id_personal');
            $table->integer('id_abreviacion');
            $table->timestamps();
        });
        DB::table('gnral_personales')->insert([
            'id_personal' => 7, 'tipo_usuario' => 42, 'nombre' => 'Original',
            'id_cargo' => 5, 'id_departamento' => 0, 'horas_maxima' => 30, 'maximo_horas_ingles' => 10,
        ]);
        $user = new User;
        $user->id = 42;
        $this->actingAs($user);
    }

    private function payload(): array
    {
        return [
            'nombre_docente' => 'Docente prueba', 'clave_docente' => '123', 'rfc' => 'TEST900101ABC',
            'esc_p' => 'Escuela', 'dir' => 'Calle 1', 'correo' => 'prueba@example.com',
            'selectPerfil' => 1, 'selectSituacion' => 1, 'o_nac' => 'Valle de Bravo',
            'f_nac' => '1990/01/01', 'f_ingreso' => '2020/01/01', 'f_contrata' => '2020/01/01',
            'selectNombra' => 'D', 'selectEsc' => 'Licenciatura', 'telefono' => '0123456789',
            'celular' => '5512345678', 'cedula' => '12345', 'selectSexo' => 'M',
            'selectAbreviacion' => 1, 'numero_empleado' => '001',
        ];
    }

    public function test_invalid_fields_return_422_without_writing(): void
    {
        $data = $this->payload();
        $data['correo'] = 'invalido';
        $data['nombre_docente'] = '';
        $data['selectPerfil'] = 999;
        $data['f_nac'] = '2026/02/31';
        $this->putJson('/docente/7', $data)->assertUnprocessable()
            ->assertJsonValidationErrors(['correo', 'nombre_docente', 'selectPerfil', 'f_nac']);
        $this->assertSame('Original', DB::table('gnral_personales')->value('nombre'));
        $this->assertSame(0, DB::table('abreviaciones_prof')->count());
    }

    public function test_saves_only_own_profile_and_preserves_administrative_fields(): void
    {
        $data = array_merge($this->payload(), ['id_cargo' => 999, 'horas_maxima' => 999, 'id_departamento' => 999]);
        $this->putJson('/docente/7', $data)->assertOk()->assertJson(['message' => 'Datos actualizados correctamente.']);
        $row = DB::table('gnral_personales')->first();
        $this->assertSame('DOCENTE PRUEBA', $row->nombre);
        $this->assertSame('00000123', $row->clave);
        $this->assertSame('0123456789', $row->telefono);
        $this->assertSame(5, $row->id_cargo);
        $this->assertSame(0, $row->id_departamento);
        $this->assertSame(30, $row->horas_maxima);
        $this->putJson('/docente/7', $data)->assertOk();
        $this->assertSame(1, DB::table('abreviaciones_prof')->count());
    }

    public function test_rejects_editing_another_person_even_with_a_forged_session(): void
    {
        DB::table('gnral_personales')->where('id_personal', 7)->update(['tipo_usuario' => 99]);
        $this->withSession(['id_usuario' => 99])->putJson('/docente/7', $this->payload())->assertForbidden();
        $this->assertSame('Original', DB::table('gnral_personales')->value('nombre'));
    }

    public function test_rolls_back_profile_when_abbreviation_cannot_be_saved(): void
    {
        DB::statement("CREATE TRIGGER reject_test_abbreviation BEFORE INSERT ON abreviaciones_prof BEGIN SELECT RAISE(ABORT, 'test failure'); END");
        $response = $this->putJson('/docente/7', $this->payload());
        $response->assertStatus(500)->assertJsonStructure(['message']);
        $this->assertStringNotContainsString('SQLSTATE', $response->getContent());
        $this->assertSame('Original', DB::table('gnral_personales')->value('nombre'));
    }

    public function test_missing_profile_returns_404(): void
    {
        $this->putJson('/docente/999', $this->payload())->assertNotFound();
    }
}
