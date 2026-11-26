@extends('layouts.panel')
@section('title', 'Inicio')

@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Panel de administración" :migas="['Examen general de conocimientos' => null]" />

<div class="dashboard-container tw:w-full">


    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:md:w-6/12 tw:lg:w-3/12 tw:px-2">
            <a href="{{route('admin.examen_general.ver_resultados_docentes')}}" class="dashboard-card tw:bg-brand-500 tw:text-white">
                <div class="dashboard-content">
                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-white">Examenes</h4>
                    <small>Ver Resultados</small>
                </div>
                <span class="fa fa-bar-chart"></span>
            </a>
        </div>

        <div class="tw:w-full tw:md:w-6/12 tw:lg:w-3/12 tw:px-2">
            <a href="{{ route('admin.examen_general.resultados') }}" class="dashboard-card tw:bg-green-600 tw:text-white">
                <div class="dashboard-content">
                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-white">Docentes</h4>
                    <small>Lista de Docentes</small>
                </div>
                <span class="fa fa-user"></span>
            </a>
        </div>

        <div class="tw:w-full tw:md:w-6/12 tw:lg:w-3/12 tw:px-2">
            <a href="{{ route('admin.examenes_generales.index') }}" class="dashboard-card tw:bg-amber-500 tw:text-white">
                <div class="dashboard-content">
                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-white">Exámenes</h4>
                    <small>Administrar Exámenes</small>
                </div>
                <span class="fa fa-file"></span>
            </a>
        </div>

        <div class="tw:w-full tw:md:w-6/12 tw:lg:w-3/12 tw:px-2">
            <a class="dashboard-card tw:bg-sky-600 tw:text-white" href="{{ route('admin.examen_general.periodos.index') }}">
                <div class="dashboard-content">
                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-white">Periodos</h4>
                    <small>Configurar Periodos</small>
                </div>
                <span class="fa fa-calendar"></span>
            </a>
        </div>

    </div>

</div>

<style>

.dashboard-container{
    margin-top:30px;
    margin-bottom:40px;
}

.dashboard-header{
    margin-top:0;
    margin-bottom:25px;
    border-bottom:1px solid #ddd;
}

.dashboard-header h2{
    margin:0;
    color:#555;
    font-size:34px;
    font-weight:300;
}

.dashboard-header .fa{
    margin-right:10px;
}

.dashboard-card{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:22px;
    min-height:110px;
    border-radius:8px;
    color:#fff !important;
    text-decoration:none !important;
    margin-bottom:20px;
    box-shadow:0 3px 8px rgba(0,0,0,.15);
    transition:all .25s ease;
}

.dashboard-card:hover{
    color:#fff;
    text-decoration:none;
    transform:translateY(-4px);
    box-shadow:0 8px 18px rgba(0,0,0,.20);
}

.dashboard-content h4{
    margin:0;
    font-size:22px;
    font-weight:600;
}

.dashboard-content small{
    display:block;
    margin-top:8px;
    font-size:14px;
    color:rgba(255,255,255,.95);
}

.dashboard-card .fa{
    font-size:42px;
    opacity:.45;
}

.bg-primary{
    background:#2f76b7;
}

.bg-success{
    background:#5cb85c;
}

.bg-warning{
    background:#f0ad4e;
}

.bg-info{
    background:#5bc0de;
}

@media (max-width:768px){

    .dashboard-header h2{
        font-size:28px;
    }

    .dashboard-card{
        min-height:95px;
        padding:18px;
    }

    .dashboard-card .fa{
        font-size:34px;
    }
}

</style>

</div>
@endsection 