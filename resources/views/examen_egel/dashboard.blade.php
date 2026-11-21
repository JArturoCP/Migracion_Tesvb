@extends('layouts.panel')
@section('title', 'Examen EGEL')
@include('partials.panel.recursos_app')
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

<main class="tw-pantalla">
    <x-panel.encabezado titulo="Examen EGEL" />

    {{-- ================= MENSAJE GLOBAL ================= --}}
    @if(!$enAplicacion)
        <x-panel.alerta tipo="error" class="tw:mb-5">
            ⚠️ El examen no está disponible en este momento (fuera del periodo de aplicación).
        </x-panel.alerta>
    @endif


    {{-- ================= RESULTADOS ================= --}}
    @if($todasCompletadas)

        {{-- MENSAJE SI NO ESTÁ EN PERIODO DE PUBLICACIÓN --}}
        @if(!$enPublicacion)
            <x-panel.alerta tipo="advertencia" class="tw:mb-5">
                ⚠️ Los resultados aún no están disponibles. Espere a que el periodo de publicación inicie.
            </x-panel.alerta>
        @endif

        {{-- RESULTADO --}}
        @if($enPublicacion)
            <x-panel.tarjeta class="tw:mb-6 tw:text-center">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">📊 Resultado EGEL</h3>

                @if($resultado)
                    <p class="tw:my-4 tw:text-6xl tw:font-bold tw:text-brand-500">
                        {{ $resultado->calificacion_general }}%
                    </p>
                    <p class="tw:text-lg tw:text-gray-700 tw:dark:text-gray-300">
                        Nivel: <b>{{ $resultado->nivel }}</b>
                    </p>
                @else
                    <p class="tw:mt-3 tw:text-gray-500 tw:dark:text-gray-400">Resultado en proceso de generación...</p>
                @endif

                <div class="tw:mt-5 tw:flex tw:flex-wrap tw:justify-center tw:gap-3">
                    <x-panel.boton variante="info" tamano="lg" href="{{ route('egel.resultados.dashboard') }}">
                        📈 Ver resultados detallados
                    </x-panel.boton>

                    <x-panel.boton variante="exito" tamano="lg" href="{{ route('egel.resultados.reporte') }}">
                        📄 Reporte final
                    </x-panel.boton>
                </div>
            </x-panel.tarjeta>
        @endif

    @endif


    {{-- ================= SECCIONES ================= --}}
    <div class="tw:grid tw:gap-5 tw:sm:grid-cols-2">

        @foreach($secciones as $index => $seccion)

            @php
                $completada = $estados[$seccion->id_seccion] ?? false;

                $bloqueada = false;

                if ($index > 0) {
                    $prev = $secciones[$index - 1];
                    $bloqueada = !($estados[$prev->id_seccion] ?? false);
                }
            @endphp

            <x-panel.tarjeta class="tw:text-center tw:transition tw:hover:-translate-y-1 tw:hover:shadow-theme-md tw:motion-reduce:transition-none tw:motion-reduce:hover:translate-y-0 {{ $completada ? 'tw:opacity-70' : '' }}">

                <div class="tw:mb-2.5 tw:text-lg tw:font-semibold tw:text-brand-500">
                    Examen General de Conocimientos<br>
                    {{ $carrera->nombre ?? 'Carrera' }} EGEL
                </div>

                <div class="tw:mb-4 tw:font-medium tw:text-green-600">
                    Cuadernillo - Sección {{ $index + 1 }}
                </div>


                {{-- ================= BOTONES ================= --}}
                @if($completada)

                    <x-panel.boton variante="secundario" class="tw:rounded-full" disabled>
                        🔒 Sección finalizada
                    </x-panel.boton>

                @elseif($bloqueada)

                    <x-panel.boton variante="advertencia" class="tw:rounded-full" disabled>
                        ⛔ Bloqueada
                    </x-panel.boton>

                @elseif(!$enAplicacion)

                    <x-panel.boton variante="secundario" class="tw:rounded-full" disabled>
                        ⏳ Fuera de periodo
                    </x-panel.boton>

                @else

                    <x-panel.boton class="tw:rounded-full" href="{{ route('egel.seccion', $seccion->id_seccion) }}">
                        📘 Iniciar Sección
                    </x-panel.boton>

                @endif

            </x-panel.tarjeta>

        @endforeach

    </div>
</main>


@endsection
