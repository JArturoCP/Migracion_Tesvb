<?php

namespace Tests\Unit;

use App\Http\Controllers\HorarioEstudianteController;
use App\Models\User;
use Database\Seeders\HorarioPruebaSistemasSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

class HorarioEstudianteTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        DB::purge('sqlite');
        DB::unprepared(file_get_contents(base_path('tests/Fixtures/horario-schema.sqlite.sql')));
        (new HorarioPruebaSistemasSeeder)->run();
    }

    private function horario(string $email): array
    {
        $user = User::where('email', $email)->firstOrFail();
        // Intentar suplantar al alumno/grupo mediante parámetros no debe funcionar.
        $request = Request::create('/alumno/horario?alumno=999&grupo=2');
        $request->setUserResolver(fn () => $user);
        return (new HorarioEstudianteController)->index($request)->getData();
    }

    public function test_demo_is_repeatable_and_passwords_work(): void
    {
        $before = [];
        foreach (['users', 'gnral_alumnos', 'eva_carga_academica', 'hrs_rhps', 'gnral_materias', 'gnral_horarios'] as $table) {
            $before[$table] = DB::table($table)->count();
        }
        $hash = DB::table('users')->where('email', 'alumno1@horario.test')->value('password');
        (new HorarioPruebaSistemasSeeder)->run();
        foreach ($before as $table => $count) { $this->assertSame($count, DB::table($table)->count()); }
        $this->assertSame(20, DB::table('hrs_rhps')->count());
        $this->assertSame($hash, DB::table('users')->where('email', 'alumno1@horario.test')->value('password'));
        $this->assertTrue(Hash::check(HorarioPruebaSistemasSeeder::PASSWORD, $hash));
    }

    public function test_each_student_sees_only_their_enrolled_group(): void
    {
        $one = $this->horario('alumno1@horario.test');
        $two = $this->horario('alumno2@horario.test');
        $this->assertSame(['08:00-09:00', '10:00-11:00', '11:00-12:00'], array_keys($one['tabla']));
        $this->assertSame(['09:00-10:00', '12:00-13:00', '13:00-14:00'], array_keys($two['tabla']));
        $this->assertCount(5, $one['tabla']['08:00-09:00']);
        $this->assertCount(5, $two['tabla']['09:00-10:00']);
        $this->assertCount(0, $one['pendientes']);
    }

    public function test_unscheduled_student_gets_an_empty_schedule_and_pending_subject(): void
    {
        $data = $this->horario('alumno3@horario.test');
        $this->assertSame([], $data['tabla']);
        $this->assertCount(3, $data['pendientes']);
    }

    public function test_teacher_cannot_use_student_endpoint(): void
    {
        try { $this->horario('docente@horario.test'); $this->fail('Debió rechazar al docente.'); }
        catch (HttpException $exception) { $this->assertSame(403, $exception->getStatusCode()); }
    }

    public function test_old_period_classes_are_not_shown(): void
    {
        DB::table('gnral_periodos')->update(['fecha_inicio' => '2000-01-01', 'fecha_termino' => '2000-06-30']);
        $data = $this->horario('alumno1@horario.test');
        $this->assertNull($data['periodo']);
        $this->assertSame([], $data['tabla']);
    }

    public function test_reference_grid_keeps_empty_hours_and_only_adds_sunday_when_needed(): void
    {
        $data = $this->horario('alumno1@horario.test');
        $this->assertCount(15, $data['horas']);
        $this->assertContains('21:00-22:00', $data['horas']);
        $this->assertNotContains('DOMINGO', $data['dias']);
        $this->assertCount(3, $data['materiasDocentes']);
        DB::table('hrs_semanas')->where('dia', 'LUNES')->where('hora', '08:00-09:00')
            ->update(['dia' => 'DOMINGO', 'hora' => '06:00-07:00']);
        $data = $this->horario('alumno1@horario.test');
        $this->assertContains('DOMINGO', $data['dias']);
        $this->assertSame('06:00-07:00', $data['horas'][0]);
        $html = view('alumnos.partials.horario-cuadricula', $data)->render();
        $this->assertStringContainsString('06:00-07:00', $html);
        $this->assertStringContainsString('Materias y docentes de tu horario', $html);
    }
}
