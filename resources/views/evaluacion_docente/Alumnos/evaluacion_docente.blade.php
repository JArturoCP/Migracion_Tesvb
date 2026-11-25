@extends('layouts.panel')
@section('title', 'Evaluación docente')
@include('evaluacion_docente.partials.recursos_panel')
@section('content')
    <?php
    $direccion=Session::get('ip');
    ?>
    {{--
        Mismas condiciones, ids, clases y campos que antes: los scripts de abajo no cambian.
        - .iniciar (docentes a evaluar) y .condicion (preguntas) se ocultan con las mismas reglas <style> de siempre;
          por eso esos contenedores no llevan clases de display.
        - Modales #mensaje, #fallo y #macep: x-panel.modal; $('#id').modal('show'|'hide') lo atiende el puente.
    --}}
    <x-panel.encabezado titulo="Evaluación docente" />

    <div class="tw-pantalla tw:space-y-6">

        @if($estado==1)

            <style type="text/css">
                .iniciar
                {
                    display:none;
                }
            </style>

            <x-panel.alerta tipo="error" class="tw:mx-auto tw:max-w-3xl">Podrás realizar la evaluación docente cuando se valide tu carga académica.</x-panel.alerta>
        @endif

        @if($no==0)


            <style type="text/css">
                .condicion
                {
                    display:none;


                }
            </style>

            <div class="iniciar" >
                <x-panel.tarjeta titulo="Docentes a evaluar" subtitulo="Estos son tus docentes y materias del periodo." sin-relleno>
                    <x-panel.tabla>
                        <thead>
                        <tr>
                            <th>DOCENTE</th>
                            <th>MATERIAS</th>
                            <th class="tw:text-center">GRUPO</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($docentes as $docentes)
                            <tr>
                                <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{$docentes->nombre}}</td>
                                <td>{{$docentes->materias}}</td>
                                <td class="tw:text-center">{{$docentes->id_semestre}}0{{$docentes->grupo}}</td>
                                <td style="display:none;" ><input checked type="checkbox" id="test1" value="{{$docentes->id_hrs_profesor}}" name="orderBox[]"/></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </x-panel.tabla>


                    @if($materiase==1)

                        <div class="tw:space-y-4 tw:border-t tw:border-gray-100 tw:p-5 tw:sm:p-6 tw:dark:border-gray-800">
                            <x-panel.alerta tipo="error">MATERIAS ESPECIALES : Solo se puede selccionar un docente por materia</x-panel.alerta>

                            <x-panel.tabla>
                                <thead>
                                <tr>
                                    <th>DOCENTE</th>
                                    <th>MATERIAS</th>
                                    <th class="tw:text-center">GRUPO</th>
                                    <th class="tw:text-center">    </th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($docentes_especial as $docee)
                                    <tr>
                                        <td>{{$docee->nombre}}</td>
                                        <td>{{$docee->materias}}</td>
                                        <td class="tw:text-center">{{$docee->id_semestre}}0{{$docee->grupo}}</td>
                                        <td class="tw:text-center"><input type="radio" class="tw:size-5 tw:cursor-pointer tw:accent-brand-500" name="{{$docee->id}}"  value="{{$docee->id_hrs_profesor}}"></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </x-panel.tabla>
                        </div>
                    @endif

                    <div class="tw:flex tw:justify-end tw:border-t tw:border-gray-100 tw:px-5 tw:py-4 tw:sm:px-6 tw:dark:border-gray-800">
                        <x-panel.boton variante="exito" id="iniciar" data-toggle="tab"><b>Iniciar Evaluación </b><i class="fa fa-pencil"></i> </x-panel.boton>
                    </div>
                </x-panel.tarjeta>
            </div>
        @endif
        @if($id_pregunta==49)


            <style type="text/css">
                .condicion
                {
                    display:none;


                }
            </style>
            <x-panel.alerta tipo="exito" class="tw:mx-auto tw:max-w-3xl">
                {{$pregunta}}
            </x-panel.alerta>

        @endif

        <div class="condicion" id="condicion" >
            <div class="alert tw:relative tw:mb-6 tw:rounded-xl tw:border tw:border-amber-300 tw:bg-amber-50 tw:p-4 tw:pr-12" role="alert">
                <a href="#" class="tw:absolute tw:top-3 tw:right-4 tw:text-2xl tw:leading-none tw:text-amber-600 tw:hover:text-amber-800" data-dismiss="alert" aria-label="Cerrar">&times;</a>
                <h4 class="tw:mb-2 tw:text-base"><b>Instrucciones</b></h4>
                <ul class="tw:list-disc tw:space-y-1 tw:pl-5 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300">
                    <li>Lee cada pregunta y responde de acuerdo con los criterios de evaluación.</li>
                    <li>En la última parte, agrega un comentario por cada docente para finalizar la evaluación.</li>
                </ul>
            </div>

            <div class="tw:mb-6">
                <input class="" id="tabla" style="display:none;" value="{{$id_tabla}}">
                <input class="" id="pregunta" style="display:none;" value="{{$id_pregunta}}">
                <p class="tw:rounded-2xl tw:bg-brand-500 tw:px-6 tw:py-5 tw:text-xl tw:font-medium tw:text-white tw:shadow-theme-md" >
                    {{$id_pregunta}} .- ¿ {{$pregunta}} ?
                </p>
                <!--contiene el numero de docentes evaluados-->
                <input id="ciclos" style="display:none;" value="{{$num}}">
            </div>

            <!-- Alerta de error cuando el comentario es obligatorio -->
            <div id="errorAlert" class="hidden tw:mb-6 tw:rounded-xl tw:border tw:border-red-200 tw:bg-red-50 tw:p-4 tw:text-center tw:text-sm tw:text-red-700" role="alert">
                <strong>¡Alerta!</strong> El comentario es obligatorio para esta evaluación docente.
            </div>

            <div class="tw:grid tw:grid-cols-1 tw:gap-6 tw:xl:grid-cols-4">
                <div class="tw:xl:col-span-3">
                    <form id="formulario_eva_docente" action="{{url("/evaluacion_alumno/guardar_comentario")}}" method="POST" role="form">
                        {{ csrf_field() }}
                        @if(session('success'))
                            <x-panel.alerta tipo="exito" class="tw:mb-4">
                                {{ session('success') }}
                            </x-panel.alerta>
                        @endif

                        <x-panel.tarjeta sin-relleno>
                            <x-panel.tabla>
                                <thead>
                                <tr>
                                    <th>MATERIA</th>
                                    <th>DOCENTE</th>
                                    <th class="tw:text-center">1</th>
                                    <th class="tw:text-center">2</th>
                                    <th class="tw:text-center">3</th>
                                    <th class="tw:text-center">4</th>
                                    <th class="tw:text-center">5</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($profesores as $profesor)
                                    <tr>
                                        <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{ $profesor->ma }}</td>
                                        <td>{{ $profesor->p }}</td>
                                        <td style="display:none;">
                                            <input checked type="checkbox" id="test1" value="{{ $profesor->id_alumno_materia }}" name="orderBoxx[]"/>

                                        </td>
                                        @for($i = 0; $i < 5; $i++)
                                            <td class="tw:text-center">
                                                <input type="radio" id="test1" class="tw:size-5 tw:cursor-pointer tw:accent-brand-500" name="radio{{ $profesor->indice }}" value="{{ $i + 1 }}"/>
                                            </td>
                                        @endfor
                                    </tr>
                                    @if($id_pregunta == 48)
                                        <tr id="commentsRow">
                                            <td colspan="7">
                                                <label for="comments">Comentarios al Docente<strong class="tw:text-red-600">*</strong></label>
                                                <input type="hidden" id="id_alumno_materia" name="id_alumno_materia[]" value="{{$profesor->id_alumno_materia}}">
                                                <textarea id="comments" name="comments[]" rows="3" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:dark:text-white/90 tw:dark:border-gray-700" placeholder="Porfavor escribe un comentario acerca del docente"></textarea>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </x-panel.tabla>

                            <div class="tw:flex tw:flex-wrap tw:justify-end tw:gap-3 tw:border-t tw:border-gray-100 tw:px-5 tw:py-4 tw:sm:px-6 tw:dark:border-gray-800">
                                <x-panel.boton id="sig"><b>Siguiente</b><i class="fa fa-exchange"></i> </x-panel.boton>
                                <x-panel.boton variante="exito" id="enviar_formulario"><b>Guardar Comentario</b> <i class="fa fa-exchange"></i> </x-panel.boton>
                            </div>
                        </x-panel.tarjeta>

                    </form>
                </div>

                <div id="rajita">
                    <x-panel.tarjeta titulo="CRITERIOS" sin-relleno>
                        <x-panel.tabla compacta>
                            <thead>
                            <tr>
                                <th class="tw:text-center">Valor</th>
                                <th>Criterio a Evaluar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="tw:text-center tw:font-semibold">1</td>
                                <td>Totalmente en desacuerdo</td>
                            </tr>
                            <tr>
                                <td class="tw:text-center tw:font-semibold">2</td>
                                <td>En desacuerdo</td>
                            </tr>
                            <tr>
                                <td class="tw:text-center tw:font-semibold">3</td>
                                <td>Indeciso</td>
                            </tr>
                            <tr>
                                <td class="tw:text-center tw:font-semibold">4</td>
                                <td>De acuerdo</td>
                            </tr>
                            <tr>
                                <td class="tw:text-center tw:font-semibold">5</td>
                                <td>Totalmente de acuerdo</td>
                            </tr>
                            </tbody>
                        </x-panel.tabla>
                    </x-panel.tarjeta>
                </div>
            </div>
        </div>

        <x-panel.modal id="mensaje" tamano="sm" aria-labelledby="mySmallModalLabel">
            <p class="tw:text-center tw:font-medium tw:text-red-600">
                <i class="fa fa-exclamation-triangle"></i>
                Aún no has evaluado a todos los docentes
                <i class="fa fa-exclamation-triangle"></i>
            </p>
        </x-panel.modal>


        <x-panel.modal id="fallo" tamano="sm" aria-labelledby="mySmallModalLabel">
            <p class="tw:text-center tw:font-bold" style="color:#BA0000;">Falta por seleccionar docente(s) de materia(s) Especial(es)</p>
        </x-panel.modal>

        <x-panel.modal id="macep" aria-labelledby="myModalLabel">
            <x-slot:encabezado>
                <h3 class="tw:text-lg tw:font-bold tw:text-red-600" id="myModalLabel"><strong>¡¡¡AVISO IMPORTANTE!!!</strong></h3>
            </x-slot:encabezado>
            <x-panel.alerta tipo="error">
                <span class="tw:font-semibold">Una vez iniciada la evaluación, no se podrá realizar ningún cambio.</span>
            </x-panel.alerta>
            <x-slot:pie>
                <x-panel.boton variante="secundario" data-dismiss="modal"><b>Cancelar</b></x-panel.boton>
                <x-panel.boton variante="exito" id="acep"><b>Aceptar</b></x-panel.boton>
            </x-slot:pie>
        </x-panel.modal>
    </div>

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
//      TNotify.alert(valor);
                    checkboxValues = [];

                    var id_pregunta = parseInt($('#pregunta').val());
                    var id_tabla = $('#tabla').val();
                    var arreglo = [];
                    id_pregunta++;
                    //  TNotify.alert(id_pregunta);
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
                    //TNotify.alert("no has seleccionado algun docente");
                    $('#mensaje').modal('show');
                    setTimeout(myFunction, 2000);

                    function myFunction() {
                        $('#mensaje').modal('hide');
                    }
                }
                //TNotify.alert(checkboxValues);
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
                    TNotify.alert("Error: los datos no coinciden en número.");
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
                        TNotify.alert('Comentarios guardados correctamente.');
                        console.log(response);
                    },
                    error: function(xhr) {
                        console.error("Error:", xhr.status, xhr.responseText);
                        TNotify.alert('Ocurrió un error al guardar los comentarios.');
                    }

                });
            });

        });
    </script>
@endsection
