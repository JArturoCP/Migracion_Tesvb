@extends('layouts.app')
@section('title', 'Inicio')
@section('content')

    <main>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Solicitud de desempeño escolar</h3>
                    </div>
                </div>
            </div>

            <div class="row col-md-11 col-md-offset-1">

                @if(count($autorizar_escolares) > 0)
                    <div class="col-md-12" style="margin-bottom: 15px;">
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <strong><span class="glyphicon glyphicon-flash"></span>
                                Validación automática por convocatoria</strong>
                            </div>
                            <div class="panel-body">
                                <p>
                                    Hay <strong>{{ count($autorizar_escolares) }}</strong>
                                    solicitud(es) pendiente(s) de revisión.
                                    Puedes validarlas automáticamente según los criterios
                                    de la convocatoria enero–julio 2026.
                                </p>  
                                <a href="{{ url('/beca_estimulo/escolares/auto_verificar') }}"
                                   class="btn btn-warning"
                                   onclick="return confirm('¿Validar automáticamente las {{ count($autorizar_escolares) }} solicitudes pendientes según la convocatoria? Esta acción no se puede deshacer.')">
                                    <span class="glyphicon glyphicon-flash"></span>
                                    Validar automáticamente ({{ count($autorizar_escolares) }} pendientes)
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Mensaje de resultado de validación automática --}}
                @if(session('mensaje_auto'))
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong><span class="glyphicon glyphicon-ok-circle"></span> Listo.</strong>
                            {{ session('mensaje_auto') }}
                        </div>
                    </div>
                @endif

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#uno" aria-controls="home" role="tab" data-toggle="tab">
                            Autorizar por la S. de S. E.
                            @if(count($autorizar_escolares) > 0)
                                <span class="badge">{{ count($autorizar_escolares) }}</span>
                            @endif
                        </a>
                    </li>
                    <li role="presentation"><a href="#dos" aria-controls="dos" role="tab" data-toggle="tab">Rechazados por la S. de S. E.</a></li>
                    <li role="presentation"><a href="#tres" aria-controls="dos" role="tab" data-toggle="tab">Autorizar por la S. de E. P.</a></li>
                    <li role="presentation"><a href="#cuatro" aria-controls="dos" role="tab" data-toggle="tab">Rechazados por la S. de E. P.</a></li>
                    <li role="presentation"><a href="#cinco" aria-controls="dos" role="tab" data-toggle="tab">Autorizados por la S. de E. P.</a></li>
                </ul>

               
                <div class="tab-content">

                    {{-- ── TAB 1: PENDIENTES (S. de S. E.) ─────────────────── --}}
                    <div role="tabpanel" class="tab-pane active" id="uno">
                        <div class="col-md-9 col-md-offset-1">
                            <br><br><br>
                            <table class="table table-bordered" style="background: white;" id="autorizar_escolares">
                                <thead>
                                    <tr>
                                        <th>ESTADO DEL ESTUDIANTE</th>
                                        <th>No. CUENTA</th>
                                        <th>NOMBRE DE ALUMNO(A)</th>
                                        <th>CURP</th>
                                        <th>CORREO</th>
                                        <th>CARRERA</th>
                                        <th>DESCUENTO</th>
                                        <th>PROMEDIO</th>
                                        <th>SEMESTRE</th>
                                        <th>AUTORIZAR</th>
                                        <th>RECHAZAR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($autorizar_escolares as $autorizar_escolar)
                                    <tr>
                                        @if($autorizar_escolar->id_estado == 3)
                                            <th style="background: #6cb2eb">NORMAL</th>
                                        @elseif($autorizar_escolar->id_estado == 2)
                                            <th style="background: #fbb450">CONDICIÓN DE DISCAPACIDAD</th>
                                        @elseif($autorizar_escolar->id_estado == 1)
                                            <th style="background: #e4d354">MADRE DE FAMILIA</th>
                                        @endif
                                        <th>{{ $autorizar_escolar->cuenta }}</th>
                                        <td>{{ $autorizar_escolar->nombre }} {{ $autorizar_escolar->apaterno }} {{ $autorizar_escolar->amaterno }}</td>
                                        <td>{{ $autorizar_escolar->curp_al }}</td>
                                        <td>{{ $autorizar_escolar->correo_al }}</td>
                                        <td>{{ $autorizar_escolar->carrera }}</td>
                                        <td>{{ $autorizar_escolar->descuento }}</td>
                                        <td>{{ $autorizar_escolar->promedio }}</td>
                                        <td>{{ $autorizar_escolar->semestre }}</td>
                                        <td>
                                            <a onclick="window.location='{{ url('/beca_estimulo/escolares/verificar_beca/'.$autorizar_escolar->id_autorizar.'/1') }}'"
                                               class="btn btn-info btn-sm">
                                                <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Autorizar
                                            </a>
                                        </td>
                                        <td>
                                            <a onclick="window.location='{{ url('/beca_estimulo/escolares/verificar_beca/'.$autorizar_escolar->id_autorizar.'/2') }}'"
                                               class="btn btn-danger btn-sm">
                                                <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> Rechazar
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center text-muted">
                                            <span class="glyphicon glyphicon-ok-circle"></span>
                                            No hay solicitudes pendientes.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- ── TAB 2: RECHAZADOS (S. de S. E.) ─────────────────── --}}
                    <div role="tabpanel" class="tab-pane" id="dos">
                        <div class="col-md-9 col-md-offset-1">
                            <br><br><br>
                            <table class="table table-bordered" style="background: white;" id="rechazados_escolares">
                                <thead>
                                    <tr>
                                        <th>ESTADO DEL ESTUDIANTE</th>
                                        <th>No. CUENTA</th>
                                        <th>NOMBRE DE ALUMNO(A)</th>
                                        <th>CURP</th>
                                        <th>CORREO</th>
                                        <th>CARRERA</th>
                                        <th>DESCUENTO</th>
                                        <th>PROMEDIO</th>
                                        <th>SEMESTRE</th>
                                        <th>MOTIVO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($rechazados_escolares as $rechazado)
                                    <tr>
                                        @if($rechazado->id_estado == 3)
                                            <th style="background: #6cb2eb">NORMAL</th>
                                        @elseif($rechazado->id_estado == 2)
                                            <th style="background: #fbb450">CONDICIÓN DE DISCAPACIDAD</th>
                                        @elseif($rechazado->id_estado == 1)
                                            <th style="background: #e4d354">MADRE DE FAMILIA</th>
                                        @endif
                                        <th>{{ $rechazado->cuenta }}</th>
                                        <td>{{ $rechazado->nombre }} {{ $rechazado->apaterno }} {{ $rechazado->amaterno }}</td>
                                        <td>{{ $rechazado->curp_al }}</td>
                                        <td>{{ $rechazado->correo_al }}</td>
                                        <td>{{ $rechazado->carrera }}</td>
                                        <td>{{ $rechazado->descuento }}</td>
                                        <td>{{ $rechazado->promedio }}</td>
                                        <td>{{ $rechazado->semestre }}</td>
                                        <td class="text-danger">No cumple requisitos de convocatoria</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-muted">Sin rechazados.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- ── TAB 3: PENDIENTES (S. de E. P.) ─────────────────── --}}
                    <div role="tabpanel" class="tab-pane" id="tres">
                        <div class="col-md-9 col-md-offset-1">
                            <br><br><br>
                            <table class="table table-bordered" style="background: white;" id="autorizar_profesionales">
                                <thead>
                                    <tr>
                                        <th>ESTADO DEL ESTUDIANTE</th>
                                        <th>No. CUENTA</th>
                                        <th>NOMBRE DE ALUMNO(A)</th>
                                        <th>CURP</th>
                                        <th>CORREO</th>
                                        <th>CARRERA</th>
                                        <th>DESCUENTO</th>
                                        <th>PROMEDIO</th>
                                        <th>SEMESTRE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($autorizar_profesionales as $ap)
                                    <tr>
                                        @if($ap->id_estado == 3)
                                            <th style="background: #6cb2eb">NORMAL</th>
                                        @elseif($ap->id_estado == 2)
                                            <th style="background: #fbb450">CONDICIÓN DE DISCAPACIDAD</th>
                                        @elseif($ap->id_estado == 1)
                                            <th style="background: #e4d354">MADRE DE FAMILIA</th>
                                        @endif
                                        <th>{{ $ap->cuenta }}</th>
                                        <td>{{ $ap->nombre }} {{ $ap->apaterno }} {{ $ap->amaterno }}</td>
                                        <td>{{ $ap->curp_al }}</td>
                                        <td>{{ $ap->correo_al }}</td>
                                        <td>{{ $ap->carrera }}</td>
                                        <td>{{ $ap->descuento }}</td>
                                        <td>{{ $ap->promedio }}</td>
                                        <td>{{ $ap->semestre }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">Sin solicitudes en esta etapa.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- ── TAB 4: RECHAZADOS (S. de E. P.) ─────────────────── --}}
                    <div role="tabpanel" class="tab-pane" id="cuatro">
                        <div class="col-md-9 col-md-offset-1">
                            <br><br><br>
                            <table class="table table-bordered" style="background: white;" id="rechazados_profesionales">
                                <thead>
                                    <tr>
                                        <th>ESTADO DEL ESTUDIANTE</th>
                                        <th>No. CUENTA</th>
                                        <th>NOMBRE DE ALUMNO(A)</th>
                                        <th>CURP</th>
                                        <th>CORREO</th>
                                        <th>CARRERA</th>
                                        <th>DESCUENTO</th>
                                        <th>PROMEDIO</th>
                                        <th>SEMESTRE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($rechazados_profesionales as $rp)
                                    <tr>
                                        @if($rp->id_estado == 3)
                                            <th style="background: #6cb2eb">NORMAL</th>
                                        @elseif($rp->id_estado == 2)
                                            <th style="background: #fbb450">CONDICIÓN DE DISCAPACIDAD</th>
                                        @elseif($rp->id_estado == 1)
                                            <th style="background: #e4d354">MADRE DE FAMILIA</th>
                                        @endif
                                        <th>{{ $rp->cuenta }}</th>
                                        <td>{{ $rp->nombre }} {{ $rp->apaterno }} {{ $rp->amaterno }}</td>
                                        <td>{{ $rp->curp_al }}</td>
                                        <td>{{ $rp->correo_al }}</td>
                                        <td>{{ $rp->carrera }}</td>
                                        <td>{{ $rp->descuento }}</td>
                                        <td>{{ $rp->promedio }}</td>
                                        <td>{{ $rp->semestre }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">Sin rechazados.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- ── TAB 5: AUTORIZADOS FINALES (S. de E. P.) ────────── --}}
                    <div role="tabpanel" class="tab-pane" id="cinco">
                        <div class="col-md-9 col-md-offset-1">
                            <br><br><br>
                            <table class="table table-bordered" style="background: white;" id="autorizados_profesionales">
                                <thead>
                                    <tr>
                                        <th>ESTADO DEL ESTUDIANTE</th>
                                        <th>No. CUENTA</th>
                                        <th>NOMBRE DE ALUMNO(A)</th>
                                        <th>CURP</th>
                                        <th>CORREO</th>
                                        <th>CARRERA</th>
                                        <th>DESCUENTO</th>
                                        <th>PROMEDIO</th>
                                        <th>SEMESTRE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($autorizados_profesionales as $apf)
                                    <tr>
                                        @if($apf->id_estado == 3)
                                            <th style="background: #6cb2eb">NORMAL</th>
                                        @elseif($apf->id_estado == 2)
                                            <th style="background: #fbb450">CONDICIÓN DE DISCAPACIDAD</th>
                                        @elseif($apf->id_estado == 1)
                                            <th style="background: #e4d354">MADRE DE FAMILIA</th>
                                        @endif
                                        <th>{{ $apf->cuenta }}</th>
                                        <td>{{ $apf->nombre }} {{ $apf->apaterno }} {{ $apf->amaterno }}</td>
                                        <td>{{ $apf->curp_al }}</td>
                                        <td>{{ $apf->correo_al }}</td>
                                        <td>{{ $apf->carrera }}</td>
                                        <td>{{ $apf->descuento }}</td>
                                        <td>{{ $apf->promedio }}</td>
                                        <td>{{ $apf->semestre }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">Sin autorizados finales aún.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>{{-- fin .tab-content --}}
            </div>
        </div>
    </main>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#autorizar_escolares').DataTable();
            $('#rechazados_escolares').DataTable();
            $('#autorizar_profesionales').DataTable();
            $('#rechazados_profesionales').DataTable();
            $('#autorizados_profesionales').DataTable();
        });
    </script>

@endsection


