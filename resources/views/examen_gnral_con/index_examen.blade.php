@extends('layouts.panel')
@include('partials.panel.recursos_app')
@section('title', 'Inicio')
@section('content')

@php
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Examen_GnralC_PeriodoController;

$carreras = DB::table('gnral_carreras')
            ->where('id_carrera', '!=', 11)
            ->where('id_carrera', '!=', 15)
            ->pluck('id_carrera');
           

        $usuario = auth()->user();

        $nuevoDocente = DB::table('egel_nuevos_docentes')
            ->where('correo', $usuario->email)
            ->whereIn('id_carrera', $carreras)
            ->first();
//dd($nuevoDocente);
if ($nuevoDocente) {
    // Es aspirante
    $esAspirante = true;

    $docente = (object)[
        'id_personal' => $nuevoDocente->id_egel_nuevo_docente,
        'id_carrera' => $nuevoDocente->id_carrera ?? 'General',
        'estado_docente_inv' => 1
    ];
//dd($docente);
    // ================= VALIDACIONES =================
$enAplicacion = Examen_GnralC_PeriodoController::enAplicacion();
$enPublicacion = Examen_GnralC_PeriodoController::enPublicacion();

// ================= EXAMEN =================
$id_examen_egel = null;

if ($docente && $docente->estado_docente_inv == 1) {
    $id_examen_egel = DB::table('egel_examenes')
        ->where('estado', 1)
        ->value('id_examen_egel');
}

// ================= SECCIONES =================
$secciones = DB::table('egel_secciones')
    ->where('id_examen_egel', $id_examen_egel)
    ->get();

    //dd($secciones);

$estados = [];

if ($docente) {
    foreach ($secciones as $sec) {
        $estados[$sec->id_seccion] = DB::table('egel_secciones_estado_docentes')
            ->where('id_docente', $docente->id_personal)
            ->where('id_seccion', $sec->id_seccion)
            ->where('completada', 1)
            ->exists();
    }
}

 $todasCompletadas = !in_array(false, $estados, true);

    // ================= RESULTADOS =================
    $resultado = null;

    if ($todasCompletadas && $docente && $enPublicacion) {
        $resultado = DB::table('egel_resultados_docentes')
            ->where('id_docente', $docente->id_personal)
            ->first();

            //dd($resultado);
    }

} else {
    // Es docente del sistema
    $esAspirante = false;

$id_docente = Session::get('id_perso');

// ================= VALIDACIONES =================
$enAplicacion = Examen_GnralC_PeriodoController::enAplicacion();
$enPublicacion = Examen_GnralC_PeriodoController::enPublicacion();


// ================= DOCENTE =================
$docente = DB::table('gnral_personales as p')
    ->join('gnral_horarios as h', 'h.id_personal', '=', 'p.id_personal')
    ->join('gnral_periodo_carreras as pc', 'pc.id_periodo_carrera', '=', 'h.id_periodo_carrera')
    ->join('gnral_carreras as c', 'c.id_carrera', '=', 'pc.id_carrera')
    ->where('p.id_personal', $id_docente)
    ->select('p.*', 'c.nombre as carrera')
    ->first();

// ================= EXAMEN =================
$id_examen_egel = null;

if ($docente && $docente->estado_docente_inv == 1) {
    $id_examen_egel = DB::table('egel_examenes')
        ->where('estado', 1)
        ->value('id_examen_egel');
}

// ================= SECCIONES =================
$secciones = DB::table('egel_secciones')
    ->where('id_examen_egel', $id_examen_egel)
    ->get();

$estados = [];

if ($docente) {
    foreach ($secciones as $sec) {
        $estados[$sec->id_seccion] = DB::table('egel_secciones_estado_docentes')
            ->where('id_docente', $docente->id_personal)
            ->where('id_seccion', $sec->id_seccion)
            ->where('completada', 1)
            ->exists();
    }
}

 $todasCompletadas = !in_array(false, $estados, true);

    // ================= RESULTADOS =================
    $resultado = null;

    if ($todasCompletadas && $docente && $enPublicacion) {
        $resultado = DB::table('egel_resultados_docentes')
            ->where('id_docente', $docente->id_personal)
            ->first();

            //dd($resultado);
    }

}
@endphp

<style>
body { background-color: #f5f7fa; }

.main { padding: 40px 0; }

.exam-panel {
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.exam-panel:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.exam-title {
    font-size: 18px;
    font-weight: 600;
    color: #337ab7;
    margin-bottom: 10px;
}

.exam-section {
    color: #5cb85c;
    margin-bottom: 15px;
}

.btn-exam {
    border-radius: 20px;
    padding: 6px 18px;
}

.locked {
    opacity: 0.7;
}
</style>

<div class="main tw:w-full">

    {{-- ================= MENSAJE ================= --}}
    @if(!$enAplicacion)
        <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:text-center"
             style="background:crimson; color:white; padding:15px 20px; border-radius:10px;">
            ⚠️ El examen no está disponible en este momento.
        </div>
    @endif

    {{-- ================= SECCIONES ================= --}}
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        @foreach($secciones as $index => $seccion)

            @php
                $completada = $estados[$seccion->id_seccion] ?? false;

                $bloqueada = false;

                if ($index > 0) {
                    $prev = $secciones[$index - 1];
                    $bloqueada = !($estados[$prev->id_seccion] ?? false);
                }
            @endphp

            <div class="tw:w-full tw:md:w-6/12 tw:px-2">

                <div class="exam-panel {{ $completada ? 'locked' : '' }} tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">

                    <div class="tw:p-5 tw:sm:p-6 tw:text-center">

                        <div class="exam-title">Examen General de Conocimientos</div>

                        <div class="exam-section">
                            Cuadernillo - Sección {{ $index + 1 }}
                        </div>

                        {{-- ================= BOTONES ================= --}}
                        @if($completada)

                            <button class="btn-exam tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" disabled>
                                🔒 Sección finalizada
                            </button>

                        @elseif($bloqueada)

                            <button class="btn-exam tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" disabled>
                                ⛔ Bloqueada
                            </button>

                        @elseif(!$enAplicacion)

                            <button class="btn-exam tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" disabled>
                                ⏳ Fuera de periodo
                            </button>

                        @else

                            <a href="{{ route('examen_general.seccion', $seccion->id_seccion) }}"
                               class="btn-exam tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">
                                📘 Iniciar Sección
                            </a>

                        @endif

                    </div>
                </div>

            </div>

        @endforeach

    </div>
</div>

@endsection