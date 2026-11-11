@extends('layouts.app')
@section('title', 'Inicio')
@section('content')

@php
    

    $id_usuario = session('usuario_alumno');
    //dd(session()->all());

 use Illuminate\Support\Facades\DB;
    use App\Http\Controllers\Egel_periodosController;

    // ================= VALIDACIONES DE PERIODO =================
    $enAplicacion = Egel_periodosController::enAplicacion();
    $enPublicacion = Egel_periodosController::enPublicacion();


$alumno = DB::table('gnral_alumnos')
    ->where('id_usuario', $id_usuario)
    ->first();

    //dd($alumno);

    $carrera = null;
    $id_examen_egel = null;

    if ($alumno) {
        $carrera = DB::table('gnral_carreras')
            ->where('id_carrera', $alumno->id_carrera)
            ->first();

        $id_examen_egel = DB::table('egel_examenes')
            ->where('estado', 1)
            ->where('id_carrera', $alumno->id_carrera)
            ->value('id_examen_egel');
    }
    //dd($id_examen_egel);

    // ================= SECCIONES =================
    $secciones = DB::table('egel_secciones')
        ->where('id_examen_egel', $id_examen_egel)
        ->get();
//dd($secciones);
    $estados = [];

    if ($alumno) {
        foreach ($secciones as $sec) {
            $estados[$sec->id_seccion] = DB::table('egel_secciones_estado')
                ->where('id_alumno', $alumno->id_alumno)
                ->where('id_seccion', $sec->id_seccion)
                ->where('completada', 1)
                ->exists();
        }
    }

    $todasCompletadas = !in_array(false, $estados, true);

    // ================= RESULTADOS =================
    $resultado = null;

    if ($todasCompletadas && $alumno && $enPublicacion) {
        $resultado = DB::table('egel_resultados')
            ->where('id_alumno', $alumno->id_alumno)
            ->first();
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

    .resultado-box {
        background: #fff;
        border-radius: 12px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        margin-bottom: 30px;
    }
</style>

<div class="container main">

    {{-- ================= MENSAJE GLOBAL ================= --}}
    @if(!$enAplicacion)
     <div class="alert text-center" 
     style="background:crimson; color:white; padding:15px 20px; border-radius:10px; font-weight:600; box-shadow:0 4px 10px rgba(0,0,0,0.15);">
    ⚠️ El examen no está disponible en este momento (fuera del periodo de aplicación).
</div>
    @endif


  {{-- ================= RESULTADOS ================= --}}
@if($todasCompletadas)
    <div class="row">
        <div class="col-md-12">

            {{-- MENSAJE SI NO ESTÁ EN PERIODO DE PUBLICACIÓN --}}
            @if(!$enPublicacion)
                 <div class="alert text-center" 
     style="background:crimson; color:white; padding:15px 20px; border-radius:10px; font-weight:600; box-shadow:0 4px 10px rgba(0,0,0,0.15);">
                    ⚠️ Los resultados aún no están disponibles. Espere a que el periodo de publicación inicie.
                </div>
            @endif

            {{-- RESULTADO --}}
            @if($enPublicacion)
                <div class="resultado-box">
                    <h3>📊 Resultado EGEL</h3>

                    @if($resultado)
                        <h1 style="font-size:60px;">
                            {{ $resultado->calificacion_general }}%
                        </h1>
                        <h4>
                            Nivel: <b>{{ $resultado->nivel }}</b>
                        </h4>
                    @else
                        <p>Resultado en proceso de generación...</p>
                    @endif

                    <div style="margin-top:20px;">
                        <a href="{{ route('egel.resultados.dashboard') }}" class="btn btn-info btn-lg">
                            📈 Ver resultados detallados
                        </a>

                        <a href="{{ route('egel.resultados.reporte') }}" class="btn btn-success btn-lg">
                            📄 Reporte final
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endif


    {{-- ================= SECCIONES ================= --}}
    <div class="row">

        @foreach($secciones as $index => $seccion)

            @php
                $completada = $estados[$seccion->id_seccion] ?? false;

                $bloqueada = false;

                if ($index > 0) {
                    $prev = $secciones[$index - 1];
                    $bloqueada = !($estados[$prev->id_seccion] ?? false);
                }
            @endphp

            <div class="col-sm-6">
                <div class="panel panel-default exam-panel {{ $completada ? 'locked' : '' }}">

                    <div class="panel-body text-center">

                        <div class="exam-title">
                            Examen General de Conocimientos<br>
                            {{ $carrera->nombre ?? 'Carrera' }} EGEL
                        </div>

                        <div class="exam-section">
                            Cuadernillo - Sección {{ $index + 1 }}
                        </div>


                        {{-- ================= BOTONES ================= --}}
                        @if($completada)

                            <button class="btn btn-default btn-exam" disabled>
                                🔒 Sección finalizada
                            </button>

                        @elseif($bloqueada)

                            <button class="btn btn-warning btn-exam" disabled>
                                ⛔ Bloqueada
                            </button>

                        @elseif(!$enAplicacion)

                            <button class="btn btn-default btn-exam" disabled>
                                ⏳ Fuera de periodo
                            </button>

                        @else

                            <a href="{{ route('egel.seccion', $seccion->id_seccion) }}"
                               class="btn btn-primary btn-exam">
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