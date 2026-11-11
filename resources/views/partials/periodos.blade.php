@section('part_modal_periodos')

    <?php
    $arre_periodos = Session::get('arre_periodos');

    if ($arre_periodos instanceof \Illuminate\Support\Collection) {
        $arre_periodos = $arre_periodos;
    } elseif (is_array($arre_periodos)) {
        $arre_periodos = collect($arre_periodos);
    } else {
        $arre_periodos = collect();
    }

    $periodo_anterior = Session::get('periodo_anterior');
    $periodo_actual = Session::get('periodo_actual');

    $p1Session = Session::get('p1');
    $p2Session = Session::get('p2');

    $p1 = '';
    $p2 = '';

    if (is_object($p1Session) && isset($p1Session->periodo)) {
        $p1 = $p1Session->periodo;
    } elseif (is_array($p1Session) && isset($p1Session['periodo'])) {
        $p1 = $p1Session['periodo'];
    }

    if (is_object($p2Session) && isset($p2Session->periodo)) {
        $p2 = $p2Session->periodo;
    } elseif (is_array($p2Session) && isset($p2Session['periodo'])) {
        $p2 = $p2Session['periodo'];
    }

    if (!$periodo_actual && $arre_periodos->count() > 0) {
        $primerPeriodo = $arre_periodos->first();

        if (is_object($primerPeriodo) && isset($primerPeriodo->id_periodo)) {
            $periodo_actual = $primerPeriodo->id_periodo;
        }
    }

    $periodo_actual = (int) $periodo_actual;
    ?>

    @if($arre_periodos->count() > 0 && $periodo_actual > 0)

        <script>
            $(document).ready(function () {

                var id = {{ $periodo_actual }};
                var ante = id - 1;
                var actual = id;
                var sig = id + 1;
                var ocultar = 0;

                $("#periodo").click(function () {
                    $('#modal_periodo').modal('show');

                    @foreach($arre_periodos as $per)
                            @if(is_object($per) && isset($per->id_periodo))
                    if (ante == {{ (int) $per->id_periodo }} || actual == {{ (int) $per->id_periodo }} || sig == {{ (int) $per->id_periodo }}) {
                        $('#tr{{ (int) $per->id_periodo }}').show();
                    } else {
                        $('#tr{{ (int) $per->id_periodo }}').hide();
                    }
                    @endif
                    @endforeach
                });

                $('#arriba').click(function (e) {
                    e.preventDefault();

                    actual = actual - 1;
                    sig = actual + 1;
                    ante = actual - 1;
                    ocultar = actual + 2;

                    $('#tr' + actual).show();
                    $('#tr' + sig).show();
                    $('#tr' + ante).show();
                    $('#tr' + ocultar).hide();
                });

                $('#abajo').click(function (e) {
                    e.preventDefault();

                    actual = actual + 1;
                    ante = actual - 1;
                    sig = actual + 1;
                    ocultar = actual - 2;

                    $('#tr' + actual).show();
                    $('#tr' + ante).show();
                    $('#tr' + sig).show();
                    $('#tr' + ocultar).hide();
                });

                $('#modal_periodo').on('hidden.bs.modal', function () {
                    ante = id - 1;
                    actual = id;
                    sig = id + 1;
                    ocultar = 0;
                });

            });
        </script>

        <div id="modal_periodo" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">

                    <div class="modal-body">
                        <form action="" method="POST" role="form" id="form_delete">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}

                            Selecciona Periodo
                            <br>

                            <div class="col-md-2 col-md-offset-10">
                                <a href="#" id="arriba" aria-expanded="false">
                                    <span class="glyphicon glyphicon-arrow-up 5em" aria-hidden="true"></span>
                                </a>

                                <a href="#" id="abajo" aria-expanded="false">
                                    <span class="glyphicon glyphicon-arrow-down 5em" aria-hidden="true"></span>
                                </a>
                            </div>

                            <br>

                            <div class="col-md-12">
                                <style>
                                    .periodo:hover {
                                        background: rgb(219, 219, 219);
                                    }
                                </style>

                                <table class="table table-bordered" style="background: white;">
                                    <thead>
                                    </thead>

                                    <tbody>
                                    @foreach($arre_periodos as $per)
                                        @if(is_object($per) && isset($per->id_periodo) && isset($per->periodo))
                                            @if((int) $per->id_periodo === (int) $periodo_actual)
                                                <tr id="tr{{ $per->id_periodo }}"
                                                    class="periodo selected"
                                                    name="tr{{ $per->id_periodo }}"
                                                    style="background:rgb(51,122,183);">
                                                    <td>
                                                        <a href="/periodo/{{ $per->id_periodo }}"
                                                           id="seleccion"
                                                           style="color:white;font-weight:bold;"
                                                           class="dropdown-toggle"
                                                           aria-expanded="false">
                                                            {{ $per->periodo }}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @else
                                                <tr id="tr{{ $per->id_periodo }}"
                                                    class="periodo"
                                                    name="tr{{ $per->id_periodo }}">
                                                    <td>
                                                        <a href="/periodo/{{ $per->id_periodo }}"
                                                           id="seleccion"
                                                           class="dropdown-toggle"
                                                           aria-expanded="false">
                                                            {{ $per->periodo }}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    Cancelar
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    @endif

@endsection