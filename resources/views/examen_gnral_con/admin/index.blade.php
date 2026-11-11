@extends('layouts.app')
@section('title', 'Inicio')

@section('content')

<div class="container dashboard-container">

    <div class="page-header dashboard-header">
        <h2>
            <span class="glyphicon glyphicon-dashboard"></span>
            Panel de Administración
        </h2>
    </div>

    <div class="row">

        <div class="col-xs-12 col-sm-6 col-md-3">
            <a href="{{route('admin.examen_general.ver_resultados_docentes')}}" class="dashboard-card bg-primary">
                <div class="dashboard-content">
                    <h4>Examenes</h4>
                    <small>Ver Resultados</small>
                </div>
                <span class="glyphicon glyphicon-stats"></span>
            </a>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-3">
            <a href="{{ route('admin.examen_general.resultados') }}" class="dashboard-card bg-success">
                <div class="dashboard-content">
                    <h4>Docentes</h4>
                    <small>Lista de Docentes</small>
                </div>
                <span class="glyphicon glyphicon-user"></span>
            </a>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-3">
            <a href="{{ route('admin.examenes_generales.index') }}" class="dashboard-card bg-warning">
                <div class="dashboard-content">
                    <h4>Exámenes</h4>
                    <small>Administrar Exámenes</small>
                </div>
                <span class="glyphicon glyphicon-file"></span>
            </a>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-3">
            <a class="dashboard-card bg-info" href="{{ route('admin.examen_general.periodos.index') }}">
                <div class="dashboard-content">
                    <h4>Periodos</h4>
                    <small>Configurar Periodos</small>
                </div>
                <span class="glyphicon glyphicon-calendar"></span>
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

.dashboard-header .glyphicon{
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

.dashboard-card .glyphicon{
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

    .dashboard-card .glyphicon{
        font-size:34px;
    }
}

</style>

@endsection 