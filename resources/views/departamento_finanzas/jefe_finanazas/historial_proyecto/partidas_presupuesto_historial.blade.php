@extends('layouts.panel')
@section('title', 'Historial del presupuesto autorizado')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <p>
                <span class="fa fa-arrow-right"></span>
                <a class="tw:text-brand-500 tw:hover:underline" href="{{url("/presupuesto_autorizado/inicio_presupuesto_autorizado_historial")}}">Años de los historiales de los presupuestos autorizados</a>
                <span class="fa fa-arrow-right"></span>
                <a class="tw:text-brand-500 tw:hover:underline" href="{{url("/presupuesto_autorizado/menu_presupuesto_autorizado_historial/".$id_year)}}">Historial del presupuesto autorizado del {{ $year }} </a>
                <span class="fa fa-chevron-right"></span>
                <span>Presupuesto autorizado del {{ $year }}</span>
            </p>
        </div>
    </div>
    <x-panel.encabezado :titulo="'Historial del presupuesto autorizado del '.$year" :migas="['Finanzas' => null]" />



        <style type="text/css">
            #tabla_presupuesto thead tr th {
                position: sticky;
                top: 0;
                z-index: 10;



            }


        </style>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" id="tabla_presupuesto">
                    <thead>
                    <tr>
                        <th class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90">Partida</th>
                        <th class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90">Denominaciòn</th>
                        <th class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90">Total</th>
                        <th class="tw:bg-sky-100 tw:dark:bg-sky-500/15 tw:text-gray-800 tw:dark:text-white/90">Enero</th>
                        <th class="tw:bg-sky-100 tw:dark:bg-sky-500/15 tw:text-gray-800 tw:dark:text-white/90">Febrero</th>
                        <th class="tw:bg-sky-100 tw:dark:bg-sky-500/15 tw:text-gray-800 tw:dark:text-white/90">Marzo</th>
                        <th class="tw:bg-sky-100 tw:dark:bg-sky-500/15 tw:text-gray-800 tw:dark:text-white/90">Abril</th>
                        <th class="tw:bg-sky-100 tw:dark:bg-sky-500/15 tw:text-gray-800 tw:dark:text-white/90">Mayo</th>
                        <th class="tw:bg-sky-100 tw:dark:bg-sky-500/15 tw:text-gray-800 tw:dark:text-white/90">Junio</th>
                        <th class="tw:bg-sky-100 tw:dark:bg-sky-500/15 tw:text-gray-800 tw:dark:text-white/90">Julio</th>
                        <th class="tw:bg-sky-100 tw:dark:bg-sky-500/15 tw:text-gray-800 tw:dark:text-white/90">Agosto</th>
                        <th class="tw:bg-sky-100 tw:dark:bg-sky-500/15 tw:text-gray-800 tw:dark:text-white/90">Septiembre</th>
                        <th class="tw:bg-sky-100 tw:dark:bg-sky-500/15 tw:text-gray-800 tw:dark:text-white/90">Octubre</th>
                        <th class="tw:bg-sky-100 tw:dark:bg-sky-500/15 tw:text-gray-800 tw:dark:text-white/90">Noviembre</th>
                        <th class="tw:bg-sky-100 tw:dark:bg-sky-500/15 tw:text-gray-800 tw:dark:text-white/90">Diciembre</th>

                    </tr>

                    </thead>
                    <tbody>
                    <tr>
                        <th class="tw:text-center" colspan="2">Total autorizado</th>
                        <th class="tw:text-right">{{number_format($total_presupuesto, 2, '.', ',') }}</th>
                        <th class="tw:text-right">{{number_format($total_enero, 2, '.', ',') }}</th>
                        <th class="tw:text-right">{{number_format($total_febrero, 2, '.', ',') }}</th>
                        <th class="tw:text-right">{{number_format($total_marzo, 2, '.', ',') }}</th>
                        <th class="tw:text-right">{{number_format($total_abril, 2, '.', ',') }}</th>
                        <th class="tw:text-right">{{number_format($total_mayo, 2, '.', ',') }}</th>
                        <th class="tw:text-right">{{number_format($total_junio, 2, '.', ',') }}</th>
                        <th class="tw:text-right">{{number_format($total_julio, 2, '.', ',') }}</th>
                        <th class="tw:text-right">{{number_format($total_agosto, 2, '.', ',') }}</th>
                        <th class="tw:text-right">{{number_format($total_septiembre, 2, '.', ',') }}</th>
                        <th class="tw:text-right">{{number_format($total_octubre, 2, '.', ',') }}</th>
                        <th class="tw:text-right">{{number_format($total_noviembre, 2, '.', ',') }}</th>
                        <th class="tw:text-right">{{number_format($total_diciembre, 2, '.', ',') }}</th>
                    </tr>
                    <tr>

                        <td class="tw:text-right"></td>
                        <td class="tw:text-right"></td>
                        <td class="tw:text-right"></td>
                        <td class="tw:text-right"></td>
                        <td class="tw:text-right"></td>
                        <td class="tw:text-right"></td>
                        <td class="tw:text-right"></td>
                        <td class="tw:text-right"></td>
                        <td class="tw:text-right"></td>
                        <td class="tw:text-right"></td>
                        <td class="tw:text-right"></td>
                        <td class="tw:text-right"></td>
                        <td class="tw:text-right"></td>
                        <td class="tw:text-right"></td>
                        <td class="tw:text-right"></td>

                    </tr>
                    @foreach($array_partidas as $partida)
                        <tr>

                            <td class="tw:text-right">{{$partida['clave_presupuestal']}}</td>
                            <td class="tw:text-right">{{$partida['nombre_partida'] }}</td>
                            <td class="tw:text-right">{{number_format($partida['total_presupuesto'], 2, '.', ',') }}</td>
                            <td class="tw:text-right">{{number_format($partida['enero_pres'], 2, '.', ',') }}</td>
                            <td class="tw:text-right">{{number_format($partida['febrero_pres'], 2, '.', ',') }}</td>
                            <td class="tw:text-right">{{number_format($partida['marzo_pres'], 2, '.', ',') }}</td>
                            <td class="tw:text-right">{{number_format($partida['abril_pres'], 2, '.', ',') }}</td>
                            <td class="tw:text-right">{{number_format($partida['mayo_pres'], 2, '.', ',') }}</td>
                            <td class="tw:text-right">{{number_format($partida['junio_pres'], 2, '.', ',') }}</td>
                            <td class="tw:text-right">{{number_format($partida['julio_pres'], 2, '.', ',') }}</td>
                            <td class="tw:text-right">{{number_format($partida['agosto_pres'], 2, '.', ',') }}</td>
                            <td class="tw:text-right">{{number_format($partida['septiembre_pres'], 2, '.', ',') }}</td>
                            <td class="tw:text-right">{{number_format($partida['octubre_pres'], 2, '.', ',') }}</td>
                            <td class="tw:text-right">{{number_format($partida['noviembre_pres'], 2, '.', ',') }}</td>
                            <td class="tw:text-right">{{number_format($partida['diciembre_pres'], 2, '.', ',') }}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
</div>
            </div>
        </div>





        <script>
            $(document).ready(function() {
                $("#aceptar_terminar").click(function (){

                    $("#form_guardar_terminar_presupuesto").submit();
                    $("#aceptar_terminar").attr("disabled", true);

                });
                $("#aceptar_eliminar_partida").click(function (){
                    $("#form_eliminar_partida").submit();
                    $("#aceptar_eliminar_partida").attr("disabled", true);
                });
                $(".eliminar").click(function (){
                    var id_presupuesto_aut = $(this).attr('id');
                    $.get("/presupuesto_autorizado/eliminar_presupesto_partida/"+id_presupuesto_aut,function (request) {
                        $("#contenedor_eliminar_partida").html(request);
                        $("#modal_eliminar_partida").modal('show');
                    });
                });
                $(".editar").click(function (){
                    var id_presupuesto_aut = $(this).attr('id');
                    $.get("/presupuesto_autorizado/modificar_presupesto_partida/"+id_presupuesto_aut,function (request) {
                        $("#contenedor_mod_partida").html(request);
                        $("#modal_mod_partida").modal('show');
                    });
                });
                $("#enviar_presupuesto").click(function (){
                    var id_partida = $("#id_partida").val();
                    if(id_partida == null){
                        swal({
                            position: "top",
                            type: "error",
                            title: "Selecciona partida presupuestal",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }else {
                        var enero_pres = $("#enero_pres").val();
                        if (enero_pres == '') {
                            swal({
                                position: "top",
                                type: "error",
                                title: "Ingresa el presupuesto de enero",
                                showConfirmButton: false,
                                timer: 3500
                            });
                        } else {
                            var febrero_pres = $("#febrero_pres").val();
                            if (febrero_pres == '') {
                                swal({
                                    position: "top",
                                    type: "error",
                                    title: "Ingresa el presupuesto de febrero",
                                    showConfirmButton: false,
                                    timer: 3500
                                });
                            } else {
                                var marzo_pres = $("#marzo_pres").val();
                                if (marzo_pres == '') {
                                    swal({
                                        position: "top",
                                        type: "error",
                                        title: "Ingresa el presupuesto de marzo",
                                        showConfirmButton: false,
                                        timer: 3500
                                    });
                                } else {
                                    var abril_pres = $("#abril_pres").val();
                                    if (abril_pres == '') {
                                        swal({
                                            position: "top",
                                            type: "error",
                                            title: "Ingresa el presupuesto de abril",
                                            showConfirmButton: false,
                                            timer: 3500
                                        });
                                    } else {
                                        var mayo_pres = $("#mayo_pres").val();
                                        if (mayo_pres == '') {
                                            swal({
                                                position: "top",
                                                type: "error",
                                                title: "Ingresa el presupuesto de mayo",
                                                showConfirmButton: false,
                                                timer: 3500
                                            });
                                        } else {
                                            var junio_pres = $("#junio_pres").val();
                                            if (junio_pres == '') {
                                                swal({
                                                    position: "top",
                                                    type: "error",
                                                    title: "Ingresa el presupuesto de junio",
                                                    showConfirmButton: false,
                                                    timer: 3500
                                                });
                                            } else {
                                                var julio_pres = $("#julio_pres").val();
                                                if (julio_pres == '') {
                                                    swal({
                                                        position: "top",
                                                        type: "error",
                                                        title: "Ingresa el presupuesto de julio",
                                                        showConfirmButton: false,
                                                        timer: 3500
                                                    });
                                                } else {
                                                    var agosto_pres = $("#agosto_pres").val();
                                                    if (agosto_pres == '') {
                                                        swal({
                                                            position: "top",
                                                            type: "error",
                                                            title: "Ingresa el presupuesto de agosto",
                                                            showConfirmButton: false,
                                                            timer: 3500
                                                        });
                                                    } else {
                                                        var septiembre_pres = $("#septiembre_pres").val();
                                                        if (septiembre_pres == '') {
                                                            swal({
                                                                position: "top",
                                                                type: "error",
                                                                title: "Ingresa el presupuesto de septiembre",
                                                                showConfirmButton: false,
                                                                timer: 3500
                                                            });
                                                        } else {
                                                            var octubre_pres = $("#octubre_pres").val();
                                                            if (octubre_pres == '') {
                                                                swal({
                                                                    position: "top",
                                                                    type: "error",
                                                                    title: "Ingresa el presupuesto de octubre",
                                                                    showConfirmButton: false,
                                                                    timer: 3500
                                                                });
                                                            } else {
                                                                var noviembre_pres = $("#noviembre_pres").val();
                                                                if (noviembre_pres == '') {
                                                                    swal({
                                                                        position: "top",
                                                                        type: "error",
                                                                        title: "Ingresa el presupuesto de noviembre",
                                                                        showConfirmButton: false,
                                                                        timer: 3500
                                                                    });
                                                                } else {
                                                                    var diciembre_pres = $("#diciembre_pres").val();
                                                                    if (diciembre_pres == '') {
                                                                        swal({
                                                                            position: "top",
                                                                            type: "error",
                                                                            title: "Ingresa el presupuesto de diciembre",
                                                                            showConfirmButton: false,
                                                                            timer: 3500
                                                                        });
                                                                    } else {
                                                                        $("#form_guardar_partida").submit();
                                                                        $("#enviar_presupuesto").attr("disabled", true);

                                                                    }

                                                                }

                                                            }

                                                        }

                                                    }

                                                }

                                            }

                                        }


                                    }

                                }

                            }

                        }
                    }
                });
                $("#enero_pres").change(function (event) {
                    var p_enero = event.target.value;
                    if (isNaN(p_enero)) {
                        TNotify.alert("el presupuesto debe ser un numero");
                        $('#pesos_enero').empty();

                    } else {
                        var p_enero1 = new Intl.NumberFormat("es-MX", {
                            style: "currency",
                            currency: "MXN"
                        }).format(p_enero);
                        $('#pesos_enero').empty();
                        $('#pesos_enero').append('<h2>' + p_enero1 + '</option>');
                    }
                });

                $("#febrero_pres").change(function (event) {
                    var p_febrero = event.target.value;
                    if (isNaN(p_febrero)) {
                        TNotify.alert("el presupuesto debe ser un numero");
                        $('#pesos_febrero').empty();

                    } else {
                        var p_febrero1 = new Intl.NumberFormat("es-MX", {
                            style: "currency",
                            currency: "MXN"
                        }).format(p_febrero);
                        $('#pesos_febrero').empty();
                        $('#pesos_febrero').append('<h2>' + p_febrero1+ '</option>');
                    }
                });

                $("#marzo_pres").change(function (event) {
                    var p_marzo = event.target.value;
                    if (isNaN(p_marzo)) {
                        TNotify.alert("el presupuesto debe ser un numero");
                        $('#pesos_marzo').empty();

                    } else {
                        var p_marzo1 = new Intl.NumberFormat("es-MX", {
                            style: "currency",
                            currency: "MXN"
                        }).format(p_marzo);
                        $('#pesos_marzo').empty();
                        $('#pesos_marzo').append('<h2>' + p_marzo1+ '</option>');
                    }
                });

                $("#abril_pres").change(function (event) {
                    var p_abril = event.target.value;
                    if (isNaN(p_abril)) {
                        TNotify.alert("el presupuesto debe ser un numero");
                        $('#pesos_abril').empty();

                    } else {
                        var p_abril1 = new Intl.NumberFormat("es-MX", {
                            style: "currency",
                            currency: "MXN"
                        }).format(p_abril);
                        $('#pesos_abril').empty();
                        $('#pesos_abril').append('<h2>' + p_abril1+ '</option>');
                    }
                });

                $("#mayo_pres").change(function (event) {
                    var p_mayo = event.target.value;
                    if (isNaN(p_mayo)) {
                        TNotify.alert("el presupuesto debe ser un numero");
                        $('#pesos_mayo').empty();

                    } else {
                        var p_mayo1 = new Intl.NumberFormat("es-MX", {
                            style: "currency",
                            currency: "MXN"
                        }).format(p_mayo);
                        $('#pesos_mayo').empty();
                        $('#pesos_mayo').append('<h2>' + p_mayo1+ '</option>');
                    }
                });

                $("#junio_pres").change(function (event) {
                    var p_junio = event.target.value;
                    if (isNaN(p_junio)) {
                        TNotify.alert("el presupuesto debe ser un numero");
                        $('#pesos_junio').empty();

                    } else {
                        var p_junio1 = new Intl.NumberFormat("es-MX", {
                            style: "currency",
                            currency: "MXN"
                        }).format(p_junio);
                        $('#pesos_junio').empty();
                        $('#pesos_junio').append('<h2>' + p_junio1+ '</option>');
                    }
                });

                $("#julio_pres").change(function (event) {
                    var p_julio = event.target.value;
                    if (isNaN(p_julio)) {
                        TNotify.alert("el presupuesto debe ser un numero");
                        $('#pesos_julio').empty();

                    } else {
                        var p_julio1 = new Intl.NumberFormat("es-MX", {
                            style: "currency",
                            currency: "MXN"
                        }).format(p_julio);
                        $('#pesos_julio').empty();
                        $('#pesos_julio').append('<h2>' + p_julio1+ '</option>');
                    }
                });

                $("#agosto_pres").change(function (event) {
                    var p_agosto = event.target.value;
                    if (isNaN(p_agosto)) {
                        TNotify.alert("el presupuesto debe ser un numero");
                        $('#pesos_agosto').empty();

                    } else {
                        var p_agosto1 = new Intl.NumberFormat("es-MX", {
                            style: "currency",
                            currency: "MXN"
                        }).format(p_agosto);
                        $('#pesos_agosto').empty();
                        $('#pesos_agosto').append('<h2>' + p_agosto1+ '</option>');
                    }
                });

                $("#septiembre_pres").change(function (event) {
                    var p_septiembre = event.target.value;
                    if (isNaN(p_septiembre)) {
                        TNotify.alert("el presupuesto debe ser un numero");
                        $('#pesos_septiembre').empty();

                    } else {
                        var p_septiembre1 = new Intl.NumberFormat("es-MX", {
                            style: "currency",
                            currency: "MXN"
                        }).format(p_septiembre);
                        $('#pesos_septiembre').empty();
                        $('#pesos_septiembre').append('<h2>' + p_septiembre1+ '</option>');
                    }
                });

                $("#octubre_pres").change(function (event) {
                    var p_octubre = event.target.value;
                    if (isNaN(p_octubre)) {
                        TNotify.alert("el presupuesto debe ser un numero");
                        $('#pesos_octubre').empty();

                    } else {
                        var p_octubre1 = new Intl.NumberFormat("es-MX", {
                            style: "currency",
                            currency: "MXN"
                        }).format(p_octubre);
                        $('#pesos_octubre').empty();
                        $('#pesos_octubre').append('<h2>' + p_octubre1+ '</option>');
                    }
                });

                $("#noviembre_pres").change(function (event) {
                    var p_noviembre = event.target.value;
                    if (isNaN(p_noviembre)) {
                        TNotify.alert("el presupuesto debe ser un numero");
                        $('#pesos_noviembre').empty();

                    } else {
                        var p_noviembre1 = new Intl.NumberFormat("es-MX", {
                            style: "currency",
                            currency: "MXN"
                        }).format(p_noviembre);
                        $('#pesos_noviembre').empty();
                        $('#pesos_noviembre').append('<h2>' + p_noviembre1+ '</option>');
                    }
                });

                $("#diciembre_pres").change(function (event) {
                    var p_diciembre = event.target.value;
                    if (isNaN(p_diciembre)) {
                        TNotify.alert("el presupuesto debe ser un numero");
                        $('#pesos_diciembre').empty();

                    } else {
                        var p_diciembre1 = new Intl.NumberFormat("es-MX", {
                            style: "currency",
                            currency: "MXN"
                        }).format(p_diciembre);
                        $('#pesos_diciembre').empty();
                        $('#pesos_diciembre').append('<h2>' + p_diciembre1+ '</option>');
                    }
                });

                $("#guardar_mod_partida").click(function (){

                    var enero_pres = $("#enero_pres_mod").val();
                    if (enero_pres == '') {
                        swal({
                            position: "top",
                            type: "error",
                            title: "Ingresa el presupuesto de enero",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    } else {
                        var febrero_pres = $("#febrero_pres_mod").val();
                        if (febrero_pres == '') {
                            swal({
                                position: "top",
                                type: "error",
                                title: "Ingresa el presupuesto de febrero",
                                showConfirmButton: false,
                                timer: 3500
                            });
                        } else {
                            var marzo_pres = $("#marzo_pres_mod").val();
                            if (marzo_pres == '') {
                                swal({
                                    position: "top",
                                    type: "error",
                                    title: "Ingresa el presupuesto de marzo",
                                    showConfirmButton: false,
                                    timer: 3500
                                });
                            } else {
                                var abril_pres = $("#abril_pres_mod").val();
                                if (abril_pres == '') {
                                    swal({
                                        position: "top",
                                        type: "error",
                                        title: "Ingresa el presupuesto de abril",
                                        showConfirmButton: false,
                                        timer: 3500
                                    });
                                } else {
                                    var mayo_pres = $("#mayo_pres_mod").val();
                                    if (mayo_pres == '') {
                                        swal({
                                            position: "top",
                                            type: "error",
                                            title: "Ingresa el presupuesto de mayo",
                                            showConfirmButton: false,
                                            timer: 3500
                                        });
                                    } else {
                                        var junio_pres = $("#junio_pres_mod").val();
                                        if (junio_pres == '') {
                                            swal({
                                                position: "top",
                                                type: "error",
                                                title: "Ingresa el presupuesto de junio",
                                                showConfirmButton: false,
                                                timer: 3500
                                            });
                                        } else {
                                            var julio_pres = $("#julio_pres_mod").val();
                                            if (julio_pres == '') {
                                                swal({
                                                    position: "top",
                                                    type: "error",
                                                    title: "Ingresa el presupuesto de julio",
                                                    showConfirmButton: false,
                                                    timer: 3500
                                                });
                                            } else {
                                                var agosto_pres = $("#agosto_pres_mod").val();
                                                if (agosto_pres == '') {
                                                    swal({
                                                        position: "top",
                                                        type: "error",
                                                        title: "Ingresa el presupuesto de agosto",
                                                        showConfirmButton: false,
                                                        timer: 3500
                                                    });
                                                } else {
                                                    var septiembre_pres = $("#septiembre_pres_mod").val();
                                                    if (septiembre_pres == '') {
                                                        swal({
                                                            position: "top",
                                                            type: "error",
                                                            title: "Ingresa el presupuesto de septiembre",
                                                            showConfirmButton: false,
                                                            timer: 3500
                                                        });
                                                    } else {
                                                        var octubre_pres = $("#octubre_pres_mod").val();
                                                        if (octubre_pres == '') {
                                                            swal({
                                                                position: "top",
                                                                type: "error",
                                                                title: "Ingresa el presupuesto de octubre",
                                                                showConfirmButton: false,
                                                                timer: 3500
                                                            });
                                                        } else {
                                                            var noviembre_pres = $("#noviembre_pres_mod").val();
                                                            if (noviembre_pres == '') {
                                                                swal({
                                                                    position: "top",
                                                                    type: "error",
                                                                    title: "Ingresa el presupuesto de noviembre",
                                                                    showConfirmButton: false,
                                                                    timer: 3500
                                                                });
                                                            } else {
                                                                var diciembre_pres = $("#diciembre_pres_mod").val();
                                                                if (diciembre_pres == '') {
                                                                    swal({
                                                                        position: "top",
                                                                        type: "error",
                                                                        title: "Ingresa el presupuesto de diciembre",
                                                                        showConfirmButton: false,
                                                                        timer: 3500
                                                                    });
                                                                } else {
                                                                    $("#form_guardar_partida_mod").submit();
                                                                    $("#guardar_mod_partida").attr("disabled", true);

                                                                }

                                                            }

                                                        }

                                                    }

                                                }

                                            }

                                        }
                                    }
                                }

                            }
                        }
                    }
                });


            });
        </script>



        </div>
@endsection