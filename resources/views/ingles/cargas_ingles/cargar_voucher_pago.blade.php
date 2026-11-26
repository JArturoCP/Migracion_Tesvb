@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Cargar vouchers de pago')
@section('content')
    @include('ingles.alumno_ingles.estilos')
    <main class="ingles-estudiante ingles-voucher">
        <h1 class="ingles-titulo">Cargar voucher de pago</h1>

        @if($id_estado_carga_voucher==0)
            @if($estado_periodo==0)
                <p class="ingles-aviso ingles-aviso--error">El periodo no se encuentra activo para ingresar el voucher.</p>
            @else
                <div class="ingles-tarjeta">
                    <form action="{{url("/ingles_horarios/cargar_voucher_pago/")}}" method="post" enctype="multipart/form-data" id="formulario_guardar_voucher">
                        @csrf
                        <div class="ingles-campo">
                            <label for="voucher">Comprobante de pago</label>
                            <input type="file" id="voucher" name="voucher" class="form-control" accept="application/pdf" aria-describedby="ayuda-voucher" required/>
                            <p class="ingles-ayuda" id="ayuda-voucher">Archivo PDF de hasta 10 MB.</p>
                        </div>
    <script>
                        const MAXIMO_TAMANIO_BYTES = 10000000; // 1MB = 1 millón de bytes, se asigna de tamaño 10 MB

                        // Obtener referencia al elemento
                        const $voucher = document.querySelector("#voucher");

                        $voucher.addEventListener("change", function () {
                            // si no hay archivos, regresamos
                            if (this.files.length <= 0) return;

                            // Validar el archivo
                            const archivo = this.files[0];
                            if (archivo.size > MAXIMO_TAMANIO_BYTES) {
                                const tamanioEnMb = MAXIMO_TAMANIO_BYTES / 1000000;
                                TNotify.alert(`Tu archivo excede el tamaño permitido, el tamaño máximo de tu archivo debe ser de ${tamanioEnMb} MB`);
                                // Limpiar
                                $voucher.value = "";
                            } else {
                                // Validación pasada. Envía el formulario o haz lo que tengas que hacer
                            }
                        });
                        </script>
                        <div class="ingles-campo">
                            <label for="val_linea_voucher">Ingresa la línea de captura de tu voucher de pago</label>
                            <input type="text" id="val_linea_voucher" name="val_linea_voucher" placeholder="¡¡¡Ingrese los 27 digitos de su linea de captura!!!" class="form-control" required/>

                        </div>
                        <div class="ingles-campo">
                            <label for="fecha_cambio">Fecha de cambio del recibo</label>
                            <input type="date" id="fecha_cambio" name="fecha_cambio" class="form-control" {{--value="{{$fecha->format('Y-m-d')}}" readonly--}} required/>

                        </div>
                        <input id="linea_captura" type="hidden" class="form-control" name="linea_captura" value="">
                        <input id="id_tipo_voucher" type="hidden" class="form-control" name="id_tipo_voucher" value="">
                    </form>
                    <div class="ingles-acciones">
                        <button type="button" id="boton_rojo" class="btn ingles-boton ingles-boton--rojo">Cargar sello rojo (original)</button>
                        <button type="button" id="boton_azul" class="btn ingles-boton ingles-boton--azul">Cargar sello azul (copia)</button>
                    </div>
                </div>
            @endif
        @elseif($id_estado_carga_voucher==1)
            @if($dato_voucher->id_estado_valida_voucher==1)
                <p class="ingles-aviso ">Ya se envió tu voucher al Departamento de Actividades Complementarias.</p>
                <div class="ingles-acciones">
                    <a class="btn ingles-boton" onclick="window.open('{{url($ruta)  }}')" href="#">Ver voucher</a>
                </div>
            @elseif($dato_voucher->id_estado_valida_voucher==3)
                <p class="ingles-aviso ingles-aviso--error"><strong>Comentario de rechazo</strong><br>
                {{$dato_voucher->comentario}}</p>
                <div class="ingles-tarjeta">
                    <form action="{{url("/ingles_horarios/cargar_voucher_modificar/".$dato_voucher->id_voucher)}}" method="post" enctype="multipart/form-data" id="formulario_modificacion_voucher">
                        @csrf
                        <div class="ingles-campo">
                            <label for="voucher_mod">Comprobante de pago</label>
                            <input type="file" id="voucher_mod" name="voucher_mod" class="form-control" accept="application/pdf" aria-describedby="ayuda-voucher_mod" required/>
                            <p class="ingles-ayuda" id="ayuda-voucher_mod">Archivo PDF de hasta 10 MB.</p>
                        </div>
    <script>
                        const MAXIMO_TAMANIO_BYTES = 10000000; // 1MB = 1 millón de bytes, se asigna de tamaño 10 MB

                        // Obtener referencia al elemento
                        const $voucher = document.querySelector("#voucher_mod");

                        $voucher.addEventListener("change", function () {
                            // si no hay archivos, regresamos
                            if (this.files.length <= 0) return;

                            // Validar el archivo
                            const archivo = this.files[0];
                            if (archivo.size > MAXIMO_TAMANIO_BYTES) {
                                const tamanioEnMb = MAXIMO_TAMANIO_BYTES / 1000000;
                                TNotify.alert(`Tu archivo excede el tamaño permitido, el tamaño máximo de tu archivo debe ser de ${tamanioEnMb} MB`);
                                // Limpiar
                                $voucher.value = "";
                            } else {
                                // Validación pasada. Envía el formulario o haz lo que tengas que hacer
                            }
                        });
                        </script>
                        <div class="ingles-campo">
                            <label for="val_linea_voucher_mod">Ingresa la línea de captura de tu voucher de pago</label>
                            <input type="text" id="val_linea_voucher_mod" name="val_linea_voucher_mod" placeholder="¡¡¡Ingrese los 27 digitos de su linea de captura!!!" value="{{$dato_voucher->linea_captura}}" class="form-control" required/>

                        </div>
                        <div class="ingles-campo">
                            <label for="fecha_cambio_mod">Fecha de cambio del recibo</label>
                            <input type="date" id="fecha_cambio_mod" name="fecha_cambio_mod" class="form-control" value="{{$dato_voucher->fecha_cambio}}" required/>

                        </div>
                        <input id="linea_captura_mod" type="hidden" class="form-control" name="linea_captura_mod" value="{{$dato_voucher->linea_captura}}">
                        <input id="id_tipo_voucher_mod" type="hidden" class="form-control" name="id_tipo_voucher_mod" value="">
                    </form>
                    <div class="ingles-acciones">
                        <button type="button" id="boton_rojo_mod" class="btn ingles-boton ingles-boton--rojo">Cargar sello rojo (original)</button>
                        <button type="button" id="boton_azul_mod" class="btn ingles-boton ingles-boton--azul">Cargar sello azul (copia)</button>
                    </div>
                </div>
            @elseif($dato_voucher->id_estado_valida_voucher==2)
                <p class="ingles-aviso ingles-aviso--exito">Tu voucher ya fue autorizado por el coordinador de lenguas extranjeras. Llena tu carga académica.</p>
            @endif
        @endif
    </main>

    <script type="text/javascript">
        $(document).ready(function() {

            $("#boton_azul").click(function(){
            var voucher = $ ("#voucher").val();
            if (voucher != '') {
               var val_linea_voucher = $("#val_linea_voucher").val();
               
               if (val_linea_voucher != '') {
                    var val_linea_voucher = val_linea_voucher.replace(/ /g, "");

                    var contar_linea = val_linea_voucher.length;
                   // TNotify.alert(contar_linea);
                    if (contar_linea == 27) {
                        $ ("#linea_captura").val(val_linea_voucher);
                        $ ("#id_tipo_voucher").val(2);
                         var fecha_cambio = $ ("#fecha_cambio").val();
                         if (fecha_cambio != '') {
                            $ ("#formulario_guardar_voucher").submit();
                            $ ("#boton_azul").attr("disabled",true);
                            swal({
                            position: "top",
                            type: "success",
                            title: "Registro exitoso",
                            showConfirmButton: false,
                            timer: 3500
                            });
                         }
                         else{
                            swal({
                            position: "top",
                            type: "error",
                            title: "Ingresa la fecha de cambio",
                            showConfirmButton: false,
                            timer: 3500
                            });
                         }
                    }
                    else{
                    swal({
                    position: "top",
                    type: "error",
                    title: "La linea de captura no es correcta debe tener 27 digitos",
                    showConfirmButton: false,
                    timer: 3500
                });
                    }
               }
               else{
                swal({
                    position: "top",
                    type: "error",
                    title: "Ingresa la linea de captura sin espacio de tu voucher",
                    showConfirmButton: false,
                    timer: 3500
                });
               }
            }
            else{
                swal({
                    position: "top",
                    type: "error",
                    title: "selecciona documento pdf",
                    showConfirmButton: false,
                    timer: 3500
                });
            }
            });

            $("#boton_rojo").click(function(){
            var voucher = $ ("#voucher").val();
            if (voucher != '') {
               var val_linea_voucher = $("#val_linea_voucher").val();
               
               if (val_linea_voucher != '') {
                    var val_linea_voucher = val_linea_voucher.replace(/ /g, "");

                    var contar_linea = val_linea_voucher.length;
                    if (contar_linea == 27) {
                        $ ("#linea_captura").val(val_linea_voucher);
                        $ ("#id_tipo_voucher").val(1);
                         var fecha_cambio = $ ("#fecha_cambio").val();
                         if (fecha_cambio != '') {
                            $ ("#formulario_guardar_voucher").submit();
                            $ ("#boton_rojo").attr("disabled",true);
                            swal({
                            position: "top",
                            type: "success",
                            title: "Registro exitoso",
                            showConfirmButton: false,
                            timer: 3500
                            });
                         }
                         else{
                            swal({
                            position: "top",
                            type: "error",
                            title: "Ingresa la fecha de cambio",
                            showConfirmButton: false,
                            timer: 3500
                            });
                         }
                    }
                    else{
                    swal({
                    position: "top",
                    type: "error",
                    title: "La linea de captura no es correcta debe tener 27 digitos",
                    showConfirmButton: false,
                    timer: 3500
                });
                    }
               }
               else{
                swal({
                    position: "top",
                    type: "error",
                    title: "Ingresa la linea de captura sin espacio de tu voucher",
                    showConfirmButton: false,
                    timer: 3500
                });
               }
            }
            else{
                swal({
                    position: "top",
                    type: "error",
                    title: "selecciona documento pdf",
                    showConfirmButton: false,
                    timer: 3500
                });
            }
            });

             $("#boton_azul_mod").click(function(){
            var voucher = $ ("#voucher_mod").val();
            if (voucher != '') {
               var val_linea_voucher_mod = $("#val_linea_voucher_mod").val();
               
               if (val_linea_voucher_mod != '') {
                    var val_linea_voucher_mod = val_linea_voucher_mod.replace(/ /g, "");

                    var contar_linea_mod = val_linea_voucher_mod.length;
                    if (contar_linea_mod == 27) {
                        $ ("#linea_captura_mod").val(val_linea_voucher_mod);
                        $ ("#id_tipo_voucher_mod").val(2);
                         var fecha_cambio_mod = $ ("#fecha_cambio_mod").val();
                         if (fecha_cambio_mod != '') {
                            $ ("#formulario_modificacion_voucher").submit();
                            $ ("#boton_azul_mod").attr("disabled",true);
                            swal({
                            position: "top",
                            type: "success",
                            title: "Registro exitoso",
                            showConfirmButton: false,
                            timer: 3500
                            });
                         }
                         else{
                            swal({
                            position: "top",
                            type: "error",
                            title: "Ingresa la fecha de cambio",
                            showConfirmButton: false,
                            timer: 3500
                            });
                         }
                    }
                    else{
                    swal({
                    position: "top",
                    type: "error",
                    title: "La linea de captura no es correcta debe tener 27 digitos",
                    showConfirmButton: false,
                    timer: 3500
                });
                    }
               }
               else{
                swal({
                    position: "top",
                    type: "error",
                    title: "Ingresa la linea de captura sin espacio de tu voucher",
                    showConfirmButton: false,
                    timer: 3500
                });
               }
            }
            else{
                swal({
                    position: "top",
                    type: "error",
                    title: "selecciona documento pdf",
                    showConfirmButton: false,
                    timer: 3500
                });
            }
            });

            $("#boton_rojo_mod").click(function(){
            var voucher = $ ("#voucher_mod").val();
            if (voucher != '') {
               var val_linea_voucher_mod = $("#val_linea_voucher_mod").val();
               
               if (val_linea_voucher_mod != '') {
                    var val_linea_voucher_mod = val_linea_voucher_mod.replace(/ /g, "");

                    var contar_linea_mod = val_linea_voucher_mod.length;
                    if (contar_linea_mod == 27) {
                        $ ("#linea_captura_mod").val(val_linea_voucher_mod);
                        $ ("#id_tipo_voucher_mod").val(1);
                         var fecha_cambio_mod = $ ("#fecha_cambio_mod").val();
                         if (fecha_cambio_mod != '') {
                            $ ("#formulario_modificacion_voucher").submit();
                            $ ("#boton_rojo_mod").attr("disabled",true);
                            swal({
                            position: "top",
                            type: "success",
                            title: "Registro exitoso",
                            showConfirmButton: false,
                            timer: 3500
                            });
                         }
                         else{
                            swal({
                            position: "top",
                            type: "error",
                            title: "Ingresa la fecha de cambio",
                            showConfirmButton: false,
                            timer: 3500
                            });
                         }
                    }
                    else{
                    swal({
                    position: "top",
                    type: "error",
                    title: "La linea de captura no es correcta debe tener 27 digitos",
                    showConfirmButton: false,
                    timer: 3500
                });
                    }
               }
               else{
                swal({
                    position: "top",
                    type: "error",
                    title: "Ingresa la linea de captura sin espacio de tu voucher",
                    showConfirmButton: false,
                    timer: 3500
                });
               }
            }
            else{
                swal({
                    position: "top",
                    type: "error",
                    title: "selecciona documento pdf",
                    showConfirmButton: false,
                    timer: 3500
                });
            }
            });
        });
        
        
    </script>
@endsection
