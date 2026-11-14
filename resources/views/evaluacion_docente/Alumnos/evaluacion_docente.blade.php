
@extends('layouts.app')
@section('title', 'Inicio')
@section('content')
    <?php
    $direccion=Session::get('ip');
    ?>

    <main>

        @if($estado==1)

            <style type="text/css">
                .iniciar
                {
                    display:none;
                }
            </style>

            <div class="col-md-12 " >
                <div class="col-md-6 col-md-offset-3">
                    <label class=" alert alert-danger"  data-toggle="tab" >Mientras tu carga academica no este validada no podras relizar evaluacion</label>
                </div>
            </div>
        @endif

        @if($no==0)


            <style type="text/css">
                .condicion
                {
                    display:none;


                }
            </style>

            <div class="col-md-12 iniciar " >
                <div class="col-md-8 col-md-offset-2">
                    <table class="table table-bordered " Style="background: white;">
                        <thead class="bg-info">
                        <tr>
                            <th class="col-md-4 " style="text-align: center">DOCENTE</th>
                            <th class="col-md-7 " style="text-align: center">MATERIAS</th>
                            <th class="col-md-1 " style="text-align: center">GRUPO</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($docentes as $docentes)
                            <tr>
                                <td style="text-align: center">{{$docentes->nombre}}</td>
                                <td style="text-align: center">{{$docentes->materias}}</td>
                                <td style="text-align: center">{{$docentes->id_semestre}}0{{$docentes->grupo}}</td>
                                <td style="display:none;" ><input checked type="checkbox" id="test1" value="{{$docentes->id_hrs_profesor}}" class="col-md-12" name="orderBox[]"/></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>


                    @if($materiase==1)

                        <div><p class="bg-danger">MATERIAS ESPECIALES : Solo se puede selccionar un docente por materia</p></div>

                        <table class="table table-bordered " Style="background: white;">
                            <thead>
                            <tr>
                                <th class="col-md-4 ">DOCENTE</th>
                                <th class="col-md-6 ">MATERIAS</th>
                                <th class="col-md-1 ">GRUPO</th>
                                <th class="col-md-1 ">    </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($docentes_especial as $docee)
                                <tr>
                                    <td>{{$docee->nombre}}</td>
                                    <td>{{$docee->materias}}</td>
                                    <td>{{$docee->id_semestre}}0{{$docee->grupo}}</td>
                                    <td><input type="radio" name="{{$docee->id}}"  value="{{$docee->id_hrs_profesor}}"></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif

                </div>


                <div class="col-md-2 col-md-offset-5" style="padding:15px">
                    <button type="button" class="btn btn-success" id="iniciar" data-toggle="tab" ><b>Iniciar Evaluación </b><span class="glyphicon glyphicon-pencil"></span> </button>
                </div>
                <br><br><br>
            </div>
        @endif
        @if($id_pregunta==49)


            <style type="text/css">
                .condicion
                {
                    display:none;


                }
            </style>
            <div class="col-md-12 " >
                <div class="col-md-2 col-md-offset-5">
                    {{$pregunta}}
                </div>
            </div>
            </br></br></br>

        @endif

        <div class="condicion" id="condicion" >

            </br></br>
            <div class="col-md-12">
                <div class="alert alert-warning alert-dismissible fade in"">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <h4><b>Instrucciones</b></h4>
                <ul>
                    <li>Lee las siguientes preguntas y responde de manera correcta de acuerdo a los criterios</li>
                    <li>En la ultima parte de la evaluación docente por favor de agregar un comentario por docente para poder finalizarla</li>
                </ul>
            </div>
        </div>
        </br></br>
        <div class="col-md-12">
            <input class="" id="tabla" style="display:none;" value="{{$id_tabla}}">
            <input class="" id="pregunta" style="display:none;" value="{{$id_pregunta}}">
            <p class="bg-primary" style="font-size: 20px;" >
                {{$id_pregunta}} .- ¿ {{$pregunta}} ?
            </p>
            <!--contiene el numero de docentes evaluados-->
            <input id="ciclos"class="bg-primary" style="font-size: 16px; display:none;" value="{{$num}}">

            </input>
        </div>

        </br></br></br>

        <div class="col-md-12">
            <!-- Alerta de error cuando el comentario es obligatorio -->
            <div id="errorAlert" class="alert alert-danger hidden" role="alert" style="text-align: center">
                <strong>¡Alerta!</strong> El comentario es obligatorio para esta evaluación docente.
            </div>
        </div>

        <form id="formulario_eva_docente" action="{{url("/evaluacion_alumno/guardar_comentario")}}" method="POST" role="form">
            {{ csrf_field() }}
            <div class="col-md-9">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-bordered" style="background: white;">
                    <thead class="bg-success">
                    <tr>
                        <th class="col-md-5" style="text-align: center">MATERIA</th>
                        <th class="col-md-4" style="text-align: center">DOCENTE</th>
                        <th style="text-align: center">1</th>
                        <th style="text-align: center">2</th>
                        <th style="text-align: center">3</th>
                        <th style="text-align: center">4</th>
                        <th style="text-align: center">5</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($profesores as $profesor)
                        <tr>
                            <th style="text-align: center">{{ $profesor->ma }}</th>
                            <th style="text-align: center">{{ $profesor->p }}</th>
                            <td style="display:none;">
                                <input checked type="checkbox" id="test1" value="{{ $profesor->id_alumno_materia }}" class="col-md-12" name="orderBoxx[]"/>

                            </td>
                            @for($i = 0; $i < 5; $i++)
                                <th>
                                    <input type="radio" id="test1" class="col-md-12" name="radio{{ $profesor->indice }}" value="{{ $i + 1 }}"/>
                                </th>
                            @endfor
                        </tr>
                        @if($id_pregunta == 48)
                            <tr id="commentsRow">
                                <td colspan="7" style="text-align: padding-top: 10px;">
                                    <label for="comments">Comentarios al Docente<strong style="color: red;font-size: 20px">*</strong></label>
                                    <input type="hidden" id="id_alumno_materia" name="id_alumno_materia[]" value="{{$profesor->id_alumno_materia}}">
                                    <textarea id="comments" name="comments[]" class="form-control" placeholder="Porfavor escribe un comentario acerca del docente"></textarea>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>

                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="col-md-offset-8">
                            <button type="button" class="btn btn-primary" id="sig"><b>Siguiente</b><span class="glyphicon glyphicon-transfer"></span> </button>
                            <button type="button" class="btn btn-success" id="enviar_formulario"><b>Guardar Comentario</b> <span class="glyphicon glyphicon-transfer"></span> </button>
                        </div>
                    </div>
                    </br> </br> </br> </br> </br> </br> </br>
                </div>

        </form>
        </div>



        <div id="rajita" class="col-md-3">
            <div class="col-md-12">
                <h5 style="text-align: center"><strong>CRITERIOS</strong></h5>
            </div>
            <table class="table table-bordered">
                <thead class="bg-success">
                <tr>
                    <th style="text-align: center">Valor</th>
                    <th style="text-align: center">Criterio a Evaluar</th>
                </tr>
                </thead>
                <tbody>
                <tr style="text-align: center">
                    <td>1</td>
                    <td>Totalmente en desacuerdo</td>
                </tr>
                <tr style="text-align: center">
                    <td>2</td>
                    <td>En desacuerdo</td>
                </tr>
                <tr style="text-align: center">
                    <td>3</td>
                    <td>Indeciso</td>
                </tr>
                <tr style="text-align: center">
                    <td>4</td>
                    <td>De acuerdo</td>
                </tr>
                <tr style="text-align: center">
                    <td>5</td>
                    <td>Totalmente de acuerdo</td>
                </tr>
                </tbody>
            </table>
        </div>

        </br></br></br>
        </br></br>
        <div class="col-md-12 ">
            </br>
            </br>
        </div>

        </div>

        <div id="mensaje" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <p style="text-align: center;color: red">
                            <span class="glyphicon glyphicon-alert"></span>
                            Aún no has evaluado a todos los docentes
                            <span class="glyphicon glyphicon-alert"></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>


        <div id="fallo" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body text-warning">
                        <p style="font-weight: bold; color:#BA0000; text-align:center;">Falta por seleccionar docente(s) de materia(s) Especial(es)</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="modal fade" id="macep" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">


                            <div class="modal-header" style="background: crimson">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h3 class="modal-title text-center" id="myModalLabel" style="color:whitesmoke;"><strong>¡¡¡AVISO IMPORTANTE!!!</strong></h3>
                            </div>
                            <div class="modal-body">
                                <div class="panel panel-info">
                                    <div class="panel-body">
                                        <label class="alert alert-danger text-center">UNA VEZ INICIADA LA EVALUACION NO SE PODRA REALIZAR NINGUN CAMBIO</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer" >
                                <button type="button" class="btn btn-success" href="" id="acep"><b>Aceptar</b></button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><b>Cancelar</b></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript">
        $(document).ready(function() {
            const enviar_form = $("#enviar_formulario"); // El botón "enviar formulario"
            const pregunta_48 = $("#id_pregunta"); // id de la pregunta 48
            const comentarios = document.querySelectorAll("textarea[name='comments[]']"); // Todos los comentarios
            const mensaje_alert = document.getElementById("errorAlert"); // Mensaje de error
            const boton_sig = $("#sig"); // El botón "Siguiente"
            //const question_48 = $("#id_pregunta"); //id para la pregunta 48'

            // Mostrar el botón al inicio
            boton_sig.show();

            // Verificar cuando la pregunta 48 se vuelva visible
            $(window).on('scroll', function () {
                if ("{{ $id_pregunta }}" == 48) {
                    boton_sig.show(); // Ocultar el botón si la pregunta 48 está visible
                } else {
                    boton_sig.show(); // Mostrar el botón si la pregunta 48 no está visible
                }
            });

            if (pregunta_48.is(":visible")) {
                boton_sig.show();
            }

            $("#sig").click(function () {
                //obtiene el puntaje que se le asigno a cada docente
                var valor = [];
                var ciclos = $("#ciclos").val();
                var total = $("input:checked").length;
                var condicion = total - ciclos;

                if (condicion == ciclos) {
                    for (var i = 0; i < ciclos; i++) {
                        valor[i] = $('input:radio[name=radio' + (i + 1) + ']:checked').val();
                    }
//      alert(valor);
                    checkboxValues = [];

                    var id_pregunta = parseInt($('#pregunta').val());
                    var id_tabla = $('#tabla').val();
                    var arreglo = [];
                    id_pregunta++;
                    //  alert(id_pregunta);
                    arreglo[0] = id_pregunta;
                    arreglo[1] = id_tabla;
                    //los primeros 2 valores de checkbox values seran la pregunta y el id que se modificaran
                    checkboxValues[checkboxValues.length] = arreglo[0];
                    checkboxValues[checkboxValues.length] = arreglo[1];
                    $('input[name="orderBoxx[]"]:checked').each(function () {
                        checkboxValues[checkboxValues.length] = $(this).val();
                        // tu_array[tu_array.length]=$(this).parent().closest("p").children("select").val();
                    });

                    for (var i = 0; i < ciclos; i++) {
                        checkboxValues[checkboxValues.length] = valor[i];
                    }
                    var direccion = "{{$direccion}}";
                    window.location.href = "/insertar/" + checkboxValues;
                    $("#sig").attr("disabled", true);
                } else {
                    //alert("no has seleccionado algun docente");
                    $('#mensaje').modal('show');
                    setTimeout(myFunction, 2000);

                    function myFunction() {
                        $('#mensaje').modal('hide');
                    }
                }
                //alert(checkboxValues);
                //
            });


            $("#iniciar").click(function () {
                $('#macep').modal('show');
            });
            $("#acep").click(function () {
                $("#acep").attr("disabled", true);
                $('#macep').modal('hide');
                var direccion = "{{$direccion}}";
                checkboxValues = [];
                checkboxRadio = [];
                var id_pregunta = $('#pregunta').val();
                var id_tabla = $('#tabla').val();//contiene el id de la tabla validacion alumno para poder saber que alumno se modificara
                var arreglo = [];
                arreglo[0] = id_pregunta;
                arreglo[1] = id_tabla;
                checkboxValues[checkboxValues.length] = arreglo[0];
                checkboxValues[checkboxValues.length] = arreglo[1];
                var fallo = 0;
                $('input[name="orderBox[]"]:checked').each(function () {
                    checkboxValues[checkboxValues.length] = $(this).val();
                    // tu_array[tu_array.length]=$(this).parent().closest("p").children("select").val();
                });
                /*
{{-- @foreach($condicion as $con)
                     if($("input:radio[name={{$con->id_materia}}]").is(':checked'))
                     {
                      checkboxRadio[checkboxRadio.length]=($('input:radio[name={{$con->id_materia}}]:checked').val());

                     }
                     else
                     {
                       fallo=fallo+1;
                     }


                    @endforeach
                    --}}
                */
                if (fallo == 0) {
                    for (var i = 0; i < checkboxRadio.length; i++) {
                        checkboxValues[checkboxValues.length] = checkboxRadio[i];
                    }
                    window.location.href = "/insertaralumno_materia/" + checkboxValues;
                } else {
                    $('#fallo').modal('show');
                    setTimeout(myFunction, 3000);

                    function myFunction() {
                        $('#fallo').modal('hide');
                    }
                }
            });


            // Ocultar el botón al inicio
            enviar_form.hide();

            // Verificar cuando la pregunta 48 se vuelva visible
            $(window).on('scroll', function ()
            {
                if ("{{ $id_pregunta }}" == 48)
                {
                    enviar_form.show(); // Mostrar el botón si la pregunta 48 está visible
                }
                else
                {
                    enviar_form.hide(); // Ocultar el botón si la pregunta 48 no está visible
                }
                // Asegurar que si la pregunta 48 está visible al cargar la página, el botón se muestre
                if (pregunta_48.is(":visible")) {
                    enviar_form.show();
                }
            });


            // Función para validar los comentarios
            function validar_comentarios() {
                let coment_regist = true; // Bandera para verificar si todos los comentarios están llenos
                comentarios.forEach((comment) => {
                    if (comment.value.trim() === "") {
                        coment_regist = false; // Si un comentario está vacío, la bandera se vuelve falsa
                    }
                });

                if (coment_regist) {
                    enviar_form.prop("disabled", false); // Habilitar el botón "enviar formulario"
                    mensaje_alert.classList.add("hidden"); // Ocultar alerta de error
                } else {
                    enviar_form.prop("disabled", true); // Deshabilitar el botón "enviar formulario"
                    mensaje_alert.classList.remove("hidden"); // Mostrar alerta de error
                }
            }

            // Agregar evento "input" a cada campo de comentario para validar en tiempo real
            comentarios.forEach((comentario) => {
                comentario.addEventListener("input", validar_comentarios);
            });

            // Llamar a la validación al cargar la página (en caso de que haya datos prellenados)
            validar_comentarios();

            $('#enviar_formulario').click(function (e) {
                e.preventDefault();

                // Validar que los comentarios estén llenos
                let comentarios = $("textarea[name='comments[]']").map(function() {
                    return $(this).val().trim();
                }).get();

                let id_alumno_materia = $("input[name='id_alumno_materia[]']").map(function() {
                    return $(this).val();
                }).get();

                // Validar que hay igual cantidad de elementos
                if (comentarios.length !== id_alumno_materia.length) {
                    alert("Error: los datos no coinciden en número.");
                    return;
                }

                // Enviar los datos al backend con AJAX
                $.ajax({
                    url: '/evaluacion_alumno/guardar_comentario',
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id_alumno_materia: id_alumno_materia,
                        comments: comentarios
                    },
                    success: function(response) {
                        alert('Comentarios guardados correctamente.');
                        console.log(response);
                    },
                    error: function(xhr) {
                        console.error("Error:", xhr.status, xhr.responseText);
                        alert('Ocurrió un error al guardar los comentarios.');
                    }

                });
            });

        });
    </script>

@endsection