@extends('layouts.panel')
@include('partials.panel.recursos_app')
@section('title', 'Incidencias')
@section('content')
    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-6/12 tw:lg:ml-[25%] tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                        <h1 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">SUBIR EVIDENCIA DE CONOCIMIENTO QUE NO REQUIERE AUTORIZACIÓN DE JEFE INMEDIATO</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-6/12 tw:lg:ml-[25%] tw:px-2">
        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:lg:w-8/12 tw:lg:ml-[16.6667%] tw:px-2">
                        <div class= "dropdown">
                            <label for="Tipo_evi">Tipo de evidencia: </label>
                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Seleciona una opción" id="id_tipo_evid" name="id_tipo_evid" required>
                                <option disabled selected hidden> Selecciona una opción </option>
                                @foreach($tipo_evidencia as $tipo_evidencia)
                                    <option value="{{$tipo_evidencia->id_tipo_evid}}" data-evid="{{$tipo_evidencia->nombre_evidencia}}"> {{$tipo_evidencia->nombre_evidencia}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <p><br></p>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:lg:w-5/12 tw:lg:ml-[16.6667%] tw:px-2">
                        <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input type="radio" id="optradio1" name="optradio" value="1" >La incidencia es en una fecha determinada</label>
                    </div>
                    <div class="tw:w-full tw:lg:w-5/12 tw:px-2">
                        <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input type="radio" id="optradio2" name="optradio" value="2">La incidencia es un periodo determinado</label>
                    </div>
                </div>


            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
                <br>
                <div class="tw:w-full tw:lg:w-4/12 tw:lg:ml-[41.6667%] tw:px-2">
                    <button id="siguiente" type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Siguiente</button>
                </div>
            </div>
        </div>
        <script>
            $(document).ready( function() {



                $("#siguiente").click(function(){

                    var id_tipo_evid= $('#id_tipo_evid').val();
//TNotify.alert(id_tipo_evid);
                    if(id_tipo_evid == null)
                    {
                        swal({
                            position: "top",
                            type: "error",
                            title: "Selecciona tipo de evidencia",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }
                    else{

                        var seleccionado = document.querySelector('input[name="optradio"]:checked');

                            if (seleccionado) {

                                var tipo_fecha= seleccionado.value;

                                window.location.href='/incidencias/cargar_evidencia_tipo_fecha/'+id_tipo_evid+'/'+tipo_fecha;

                            } else {
                                swal({
                                    position: "top",
                                    type: "error",
                                    title: "Selecciona tipo de fecha",
                                    showConfirmButton: false,
                                    timer: 3500
                                });
                            }



                    }


///////seecion de evidencia////
                });
            });
        </script>
    </main>
@endsection