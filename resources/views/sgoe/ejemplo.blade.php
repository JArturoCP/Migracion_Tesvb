@extends('sgoe.inicio')
@section('title', 'SGOE')
@section('content')



    <main>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Documentación del SGOE</h3>
                    </div>
                </div>
            </div>

            <div class="row col-md-11 col-md-offset-1">



                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#uno" aria-controls="home" role="tab" data-toggle="tab">Procedimientos</a></li>
                    <li role="presentation"><a href="#dos" aria-controls="dos" role="tab" data-toggle="tab">Formatos</a></li>
                    <li role="presentation"><a href="#tres" aria-controls="tres" role="tab" data-toggle="tab">Lista Maestra</a></li>
                  </ul>

                <!-- Tab panes -->
                <div class="tab-content ">
                    <div role="tabpanel" class="tab-pane active" id="uno">

                        <div class=" col-md-9 col-md-offset-1">

                            </br></br></br>

                            <table class="table table-bordered " Style="background: white;" id="autorizar_escolares">
                                <thead>
                                <tr>
                                    <th>CLAVE</th>
                                    <th>NOMBRE DEL PROCEDIMIENTO</th>
                                    <th>ARCHIVO</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($pro_ver as $proce_ver)
                                    @if(is_numeric($proce_ver->clave) )
                                    @else
                                    <tr>

                                        <?php   $clave=$proce_ver->clave; ?>
                                        <?php   $des_proceso=$proce_ver->des_proceso; ?>

                                        <td>{{ $proce_ver->clave }} </td>
                                        <td>{{ $proce_ver->des_proceso }} </td>
                                            @if($proce_ver->url == "")
                                                <td style="background: #953b39">No hay documento</td>
                                            @else
                                                <?php
                                                $extension = strtolower(pathinfo($proce_ver->url, PATHINFO_EXTENSION));
                                                ?>
                                                <td><a target="_blank" href={{asset($proce_ver->url)}}>Ver</a>
                                            @endif
                                                    @endif
                                        </td> </tr>
                                @endforeach


                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="dos">
                        <div class=" col-md-9 col-md-offset-1">

                            </br></br></br>

                            <table class="table table-bordered " Style="background: white;" id="rechazados_escolares">
                                <thead>
                                <tr>
                                    <th>CLAVE</th>
                                    <th>NOMBRE DEL FORMATO</th>
                                    <th>ARCHIVO</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php  $for_ver=DB::select('SELECT * FROM `ri_formatos` ORDER BY `ri_formatos`.`clave` ASC;');?>
                                @foreach($for_ver as $forma_ver)

                                    <tr>

                                        <?php   $clave=$forma_ver->clave; ?>
                                        <?php   $des_formato=$forma_ver->des_formato; ?>

                                        <td>{{ $forma_ver->clave }} </td>
                                        <td>{{ $forma_ver->des_formato }} </td>
                                            @if($forma_ver->url == "")
                                                <td style="background: #953b39">No hay documento</td>
                                            @else
                                                <?php
                                                $extension = strtolower(pathinfo($forma_ver->url, PATHINFO_EXTENSION));
                                                ?>
                                        <td><a target="_blank" href={{asset($forma_ver->url)}}>Ver</a></td>
                                            @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div role="tabpanel" class="tab-pane" id="tres">
                        <div class=" col-md-9 col-md-offset-1">

                            </br></br></br>

                            <table class="table table-bordered " Style="background: white;" id="rechazados_escolares">
                                <thead>
                                <tr>
                                    <th>NOMBRE DEL FORMATO</th>
                                    <th>ARCHIVO</th>

                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Lista Maestra de Documentos Autorizados</td>
                                        <td><a target="_blank" href="http://177.244.44.86/SGOE/lista_sgoe.pdf">Ver</a></td>

                                    </tr>
                               </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </main>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#autorizar_escolares').DataTable(  );

            $('#rechazados_escolares').DataTable(  );
        });

    </script>
@endsection
