@extends('layouts.panel')
@section('title', 'Empresa')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
<main class="tw:w-full tw:lg:w-full tw:px-2">
    <x-panel.encabezado titulo="Agregar empresa y asesor externo" :migas="['Residencia profesional' => null]" />
    @if($reg_empresa == 0)
    <form action="{{url("/residencia/registrar_empresa_asesor/")}}" role="form" method="POST" >
        {{ csrf_field() }}
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <input type="hidden" id="id_anteproyecto" name="id_anteproyecto" value="{{ $anteproyecto->id_anteproyecto }}">

            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
            <div class="tw:mb-4">
                <label for="asesor">Nombre del asesor externo</label>
                <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  id="asesor" name="asesor"  placeholder="Ingresa el asesor externo "  required></input>
            </div>
        </div>
        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
            <div class="tw:mb-4">
                <label for="asesor">Puesto del asesor externo</label>
                <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  id="puesto_asesor" name="puesto_asesor"  placeholder="Ingresa el puesto del asesor externo "  required></input>
            </div>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4">
                <label for="exampleInputEmail1">Elige empresa<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="empresa" name="empresa" required>
                    <option disabled selected hidden>Selecciona una opción</option>
                    @foreach($empresa as $empresa)
                        <option value="{{$empresa->id_empresa}}" data-esta="{{$empresa->nombre}}">{{$empresa->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                <div class="tw:mb-4">
                    <label for="exampleInputEmail1">Sector de  la empresa<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="sector" name="sector" required>
                        <option disabled selected hidden>Selecciona una opción</option>
                        @foreach($sectores as $sector)
                                <option value="{{$sector->id_sector}}" data-esta="{{$sector->descripcion}}">{{$sector->descripcion}}</option>

                        @endforeach
                    </select>
                </div>
            </div>
            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                <div class="tw:mb-4">
                    <label for="exampleInputEmail1">Giro de la empresa<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="giro" name="giro" required>
                        <option disabled selected hidden>Selecciona una opción</option>
                        @foreach($giros as $giro)
                                <option value="{{$giro->id_giro}}" data-esta="{{$giro->descripcion}}">{{$giro->descripcion}}</option>

                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-full tw:px-2" id="empre">

        </div>
    </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw:mb-4">
                    <label for="dependencia">Información de la empresa</label>
                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="informacion_empresa" name="informacion_empresa" rows="15"  placeholder="Ingresa informacion de la empresa" maxlength="1200"></textarea>
                </div>
            </div>
        </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Guardar</button>

            </div>
        </div>
    </form>
        @endif
    @if($reg_empresa == 1)
        <form action="{{url("/residencia/modificar_empresa_asesor/")}}" role="form" method="POST" >
            {{ csrf_field() }}
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <input type="hidden" id="id_anteproyecto" name="id_anteproyecto" value="{{ $anteproyecto->id_anteproyecto }}">

                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                    <div class="tw:mb-4">
                        <label for="asesor">Nombre del asesor externo</label>
                        <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  id="asesor" name="asesor"  placeholder="Ingresa el asesor externo " value="{{ $proyecto_empresa->asesor }}" required></input>
                    </div>
                </div>
                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                    <div class="tw:mb-4">
                        <label for="asesor">Puesto del asesor externo</label>
                        <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  id="puesto_asesor" name="puesto_asesor"  placeholder="Ingresa el puesto del asesor externo " value="{{ $proyecto_empresa->puesto }}"  required></textarea>
                    </div>
                </div>
            </div>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4">
                        <label for="exampleInputEmail1">Elige empresa<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="empresa" name="empresa" required>
                            <option disabled selected hidden>Selecciona una opción</option>
                            @foreach($empresa as $empresa)
                                @if($proyecto_empresa->id_empresa == $empresa->id_empresa)
                                <option value="{{$empresa->id_empresa}}" selected="selected">{{$empresa->nombre}}</option>
                                @else
                                    <option value="{{$empresa->id_empresa}}" data-esta="{{$empresa->nombre}}">{{$empresa->nombre}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                    <div class="tw:mb-4">
                        <label for="exampleInputEmail1">Sector de la empresa<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="sector" name="sector" required>
                            <option disabled selected hidden>Selecciona una opción</option>
                            @foreach($sectores as $sector)
                                @if($proyecto_empresa->id_sector == $sector->id_sector)
                                    <option value="{{$sector->id_sector}}" selected="selected">{{$sector->descripcion}}</option>
                                @else
                                    <option value="{{$sector->id_sector}}" data-esta="{{$sector->descripcion}}">{{$sector->descripcion}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                    <div class="tw:mb-4">
                        <label for="exampleInputEmail1">Giro de la empresa<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="giro" name="giro" required>
                            <option disabled selected hidden>Selecciona una opción</option>
                            @foreach($giros as $giro)
                                @if($proyecto_empresa->id_giro == $giro->id_giro)
                                    <option value="{{$giro->id_giro}}" selected="selected">{{$giro->descripcion}}</option>
                                @else
                                    <option value="{{$giro->id_giro}}" data-esta="{{$giro->descripcion}}">{{$giro->descripcion}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:lg:w-full tw:px-2" id="empre">
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="tabla_envioss" class="tw-tabla tw-tabla-bordes">
                        <thead>
                        <tr>
                            <th>Nombre de la empresa</th>
                            <th>Domicilio </th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Director General</th>

                        </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>{{$emp->nombre}}</td>
                                <td>{{$emp->domicilio}}</td>
                                <td>{{$emp->tel_empresa}}</td>
                                <td>{{$emp->correo }}</td>
                                <td>{{$emp->dir_gral}}</td>


                            </tr>
                        </tbody>
                    </table>
</div>
                </div>
            </div>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4">
                        <label for="dependencia">Información de la empresa</label>
                        <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="informacion_empresa" name="informacion_empresa" rows="15"  placeholder="Ingresa informacion de la empresa" maxlength="1200">{{ $proyecto_empresa->informacion_empresa }}</textarea>
                    </div>
                </div>
            </div>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Guardar</button>

                </div>
            </div>
        </form>
        @endif
</main>
<script type="text/javascript">
    $(document).ready( function() {

        $("#empresa").change(function(e){

            var id_empresa= e.target.value;
//TNotify.alert(id_empresa);
            $.get("/residencia/datos_empresa/"+id_empresa,function(response,state){
               // TNotify.alert(response);
                $("#empre").empty();

                  //  TNotify.alert(subcatObj);
                    $('#empre').append("<h3>Datos de la empresa</h3><table class='tw-tabla tw-tabla-bordes'> <thead> <tr><th>Nombre de la empresa</th><th>Domicilio</th>" +
                        "<th>Tel_empresa</th> <th>Correo</th><th>Director General</th> </tr> </thead><tbody><tr>"+"<td>" +response.nombre+ "</td><td> "+response.domicilio+ "</td><td>"+response.tel_empresa+ "</td><td>"+response.correo+ "</td><td>"+response.dir_gral + "</td>"+"</tr> </tbody> </table>");

            });



        });
    });



</script>
</div>
@endsection