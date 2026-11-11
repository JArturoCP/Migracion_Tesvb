<style>
    .no-wrap {
        white-space: nowrap;
    }
</style>
@extends('tutorias.app_tutorias')
@section('content')
    <div class="row d-flex justify-content-center">
        <div class="row">
            <div class="col-10 offset-1">
                <table class="table  table-bordered table-responsive-lg">
                    <tr>
                        <th class="no-wrap">Evaluación</th>
                        <th class="no-wrap">PDF {{$per1->per}}                  </th>
                        <th class="no-wrap">PDF {{$per2->per}}                  </th>

                    </tr>
                    <tr>
                        <th>
                            @if($c->c == 1)
                                <a class="btn btn btn-success" href="/tutorias/FO_40/">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                        <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                    </svg>
                                </a>
                            @endif
                            @if($c->c == 0)
                                    Evaluación no activa
                            @endif
                        </th>
                        <th>
                            @if($existen->con !=0)
                                <a  class="btn btn-warning" href="{{url('/tutorias/FO-40/pdf/1/'.$periodo.'/') }}"> Imprimir
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                                    </svg>
                                </a>
                            @endif
                            @if($existen->con == 0)
                                No hay evaluación {{$per1->per}}
                            @endif
                        </th>
                        <th>
                            @if($existen->con !=0)
                                @if($con->con == 2)
                                    <a  class="btn btn-warning" href="{{url('/tutorias/FO-40/pdf/'.$periodo.'/') }}"> Imprimir
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                                        </svg>
                                    </a>
                                @endif
                                    @if($con->con == 1)
                                        No hay evaluación {{$per2->per}}
                                    @endif
                            @endif
                            @if($existen->con == 0)
                                No hay evaluación {{$per2->per}}
                            @endif
                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
