@extends('layouts.panel')
@section('title', 'Estudiante')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

    <x-panel.encabezado :titulo="'Carga académica del estudiante: '.$nombre_estudiante.' Numero de cuenta: '.$no_cuenta.' '.$grup_sem" :migas="['Jefatura de división' => null]" />
    @if($correcciones != "")
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <x-panel.alerta tipo="error" class="tw:mb-4">
                Comentario de correcion: <b>{{ $correcciones }}</b>
            </x-panel.alerta>
        </div>
    </div>
    @endif
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

            <div  class="tw:w-full tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800 tw:px-2" >
                <form role="form" method="POST" action="/validacion_de_jefe_estudiante/{{ $id }}" novalidate id="formupdate">
                    <input type="hidden" name="_method" value="PUT" />
                    {{ csrf_field() }}
                <p class="tw:text-center"><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input type="radio" id="optradio1" name="optradio" value="1" >Autorizar</label>
                    <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input type="radio" id="optradio2" name="optradio" value="2">No autorizar</label>
                </p>
                <p id="observacion" style="display: none">
                    <label for="exampleFormControlTextarea2">Observaciones:</label>
                    <textarea class="rounded-0 tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="obser" rows="2"  name="obser" ></textarea>
                    <br>
                </p>
             </form>
                <p class="tw:text-center" >
                    <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="aceptar">Aceptar</button>
                </p>
            </div>
        </div>

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" Style="background: white;">
                <thead>
                <tr>
                    <th>NOMBRE DEL PROFESOR</th>
                    <th>CLAVE DE LA MATERIA</th>
                    <th>NOMBRE DE LA MATERIA</th>
                    <th>CREDITOS</th>
                    <th>STATUS</th>
                    <th>TIPO CURSA</th>
                    <th>GRUPO</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datos_carga as $consulta)
                    @if($consulta['id_materia'] == 2258)
                        <tr>
                            <th></th>
                            <th>{{$consulta['clave']}}</th>
                            <td>{{$consulta['nombre']}}</td>
                            <td></td>
                            <td>ALTA</td>
                            <td></td>
                            <td></td>
                        </tr>
                    @else
                        <tr>
                            <th>
                                @foreach($consulta['profesores'] as $profesor)
                                    <p>{{ $profesor['titulo'] }}  {{ $profesor['nombre_profesor'] }}</p>
                                @endforeach
                            </th>
                            <th>{{$consulta['clave']}}</th>
                            <td>{{$consulta['nombre']}}</td>
                            <td>{{$consulta['creditos']}}</td>
                            <td>{{$consulta['nombre_status']}}</td>
                            <td>{{$consulta['nombre_curso']}}</td>
                            <td>{{$consulta['id_semestre']}}0{{$consulta['grupo']}}</td>

                        </tr>
                    @endif
                @endforeach
                <tr>
                    <th></th>
                    <th></th>
                    <td>Total de creditos:</td>
                    <td>{{$suma}}</td>
                    <td></td>
                </tr>

                </tbody>
            </table>
</div>


        </div>
    </div>
    <script>
        $(document).ready(function(){

            $("#optradio2").change(function() {
                var validez=$(this).val();
                $("#observacion").css("display", "inline");
                $("#status").css("display", "none");
            });
            $("#aceptar").click(function (){
                var radioSeleccionado = document.querySelector('input[name="optradio"]:checked');

                if(radioSeleccionado == null){
                    swal({
                        position:"top",
                        type: "error",
                        title: "Selecciona una opción",
                        showConfirmButton: false,
                        timer: 3000
                    });
                }else{
                    var boton=radioSeleccionado.value;
                     if(boton == 1){
                         $("#aceptar").attr("disabled", true);
                         $("#formupdate").submit();
                         swal({
                             position: "top",
                             type: "success",
                             title: "Autorización exitosa.",
                             showConfirmButton: false,
                             timer: 3500
                         });

                     }else{
                         var obser = $("#obser").val();
                         if(obser == ""){
                             swal({
                                 position:"top",
                                 type: "error",
                                 title: "Ingresa una observación",
                                 showConfirmButton: false,
                                 timer: 3000
                             });
                         }else{
                             $("#aceptar").attr("disabled", true);
                             $("#formupdate").submit();
                             swal({
                                 position: "top",
                                 type: "success",
                                 title: "Observación enviada exitosamente.",
                                 showConfirmButton: false,
                                 timer: 3500
                             });
                         }
                     }
                }

            });
        });
    </script>

</div>
@endsection