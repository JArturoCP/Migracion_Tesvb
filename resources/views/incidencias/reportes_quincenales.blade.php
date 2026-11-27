@extends('layouts.panel')
@section('title', 'Incidencias')
@include('partials.panel.recursos_app', ['datatables' => true, 'datepicker' => true])
@section('content')
<div class="tw-pantalla">
    
<main class="tw:w-full tw:lg:w-full tw:px-2">
<x-panel.encabezado titulo="Reportes" :migas="['Incidencias' => null]" />
  @if($estados == 0)
  
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
  <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2">
    <div class= "dropdown">
        <label for="Tipo_of">Artículo/Cláusula: </label>
          <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Seleciona una opción" id="id_articulo" name="id_articulo" required>
              <option disabled selected hidden> Selecciona una opción </option>
              @foreach($art as $articulo)
                <option value="{{$articulo['estado']}}{{$articulo['id']}}" > {{$articulo['nombre']}} </option>
              @endforeach
              <option value="3200" > Todos </option>
          </select>
    </div>
  </div>
  <div class="tw:w-full tw:lg:w-2/12 tw:lg:grow tw:px-2">
    <label for="fecha_req">Desde Fecha:</label>
                     <div class="tw:mb-4">
                         <input class="datepicker id_desd_fech tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   type="text"  id="id_desd_fech" name="id_desd_fech" data-date-format="yyyy/mm/dd" placeholder="AAAA/MM/DD" >
                     </div>
  </div>
  <div class="tw:w-full tw:lg:w-2/12 tw:lg:grow tw:px-2">
    <label for="fecha_req">Hasta Fecha:</label>
                     <div class="tw:mb-4">
                         <input class="datepicker id_hast_fech tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   type="text"  id="id_hast_fech" name="id_hast_fech" data-date-format="yyyy/mm/dd" placeholder="AAAA/MM/DD" >
                     </div>
  </div>
  <div class="tw:w-full tw:lg:w-2/12 tw:lg:grow tw:px-2">
    <label><br></label>
    <div class="tw:mb-4">
      <button id="buscar_registros" type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Buscar registros</button>
  </div> 
  </div>    
</div>

@endif
@if($estados == 1)
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
<form class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4" id="form_buscar_reportes" action="{{url("/incidencias/reportes_incidencias_ver")}}" method="POST" role="form" >
  {{ csrf_field() }}
    <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2">
        <div class= "dropdown">
            <label for="Tipo_of">Articulo/Cláusula:</label>
            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Seleciona una opción" id="id_articulo" name="id_articulo" required>
                <option disabled selected hidden> Selecciona una opción </option>
                @foreach($art as $articulo)
                    <?php $id_art=$articulo['estado'].''.$articulo['id']; ?>
                    <?php $id_arti=$estado.''.$id_articulo; ?>
                    @if($id_art==$id_arti)
                        <option value="{{$articulo['estado']}}{{$articulo['id']}}" selected="selected" >{{$articulo['nombre']}}</option>
                    @else
                        <option value="{{$articulo['estado']}}{{$articulo['id']}}"> {{$articulo['nombre']}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
  <div class="tw:w-full tw:lg:w-2/12 tw:lg:grow tw:px-2">
    <label for="fecha_req">Desde Fecha:</label>
                     <div class="tw:mb-4">
                         <input class="datepicker id_desd_fech tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" value="{{$fecha_inicial}}"  type="text"  id="id_desd_fech" name="id_desd_fech" data-date-format="yyyy/mm/dd" placeholder="AAAA/MM/DD" >
                     </div>
  </div>
  <div class="tw:w-full tw:lg:w-2/12 tw:lg:grow tw:px-2">
    <label for="fecha_req">Hasta Fecha:</label>
                     <div class="tw:mb-4">
                         <input class="datepicker id_hast_fech tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  value="{{$fecha_final}}" type="text"  id="id_hast_fech" name="id_hast_fech" data-date-format="yyyy/mm/dd" placeholder="AAAA/MM/DD" >
                     </div>
  </div>
</form> 
  <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
    <label><br></label>
    <div class="tw:mb-4">
      <button id="buscar_registros" type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Buscar registros</button>
  </div> 
  </div>    
</div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="tabla_reportes" class="tw-tabla tw-tabla-bordes" align="center">
                          <thead >                                     
                            <th class="tw:text-center">ID EMPLEADO</th>
                            <th class="tw:text-center">SERVIDOR PÚBLICO DEL JUSTIFICANTE </th>
                            <th class="tw:text-center">FECHA QUE JUSTIFICA </th>
                            <th class="tw:text-center">NUMERO DE OFICIO Y/O DOCUMENTO</th>
                            <th class="tw:text-center">DOCUMENTO </th>
                          </thead>
                          <tbody>

                      @foreach($articulos as $fecha)
                      <tr>
                        <td>{{$fecha->numero_empleado}}</td>
                        <td>{{$fecha->servidor}}</td>
                          @if($fecha->estado == 1)

                          @if($fecha->no_fecha == 2)
                              <td>{{$fecha->fecha_i }} al {{$fecha->fecha_f }}</td>
                              @else
                              <td>{{$fecha->fecha_i }} </td>
                           @endif
                              <td>{{$fecha->id_solicitud }} </td>
                          @elseif($fecha->estado == 2)

                              @if($fecha->no_fecha == 2 )
                                  <td>{{$fecha->fecha_i }} al {{$fecha->fecha_f }}</td>
                              @else
                                  <td>{{$fecha->fecha_i }} </td>
                              @endif
                                  @if($fecha->id == 1 || $fecha->id == 3 ||  $fecha->id == 5  ||  $fecha->id == 6)
                                    <td>{{ $fecha->no_folio }}</td>
                                  @else
                                      <td></td>
                                      @endif

                          @endif

                        <td>{{$fecha->documento}}</td>
                      </tr>
                      @endforeach
                          </tbody>
          </table>
</div>                   
    </div>
</div>

<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
  
  
  <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" style="display: inline" id="generar">
    <div class="tw:w-full tw:px-2">
    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" onclick="window.open('{{url('/incidencias/excel_reportes_inc/'.$id_articulo.'/'.$fecha_inicial.'/'.$fecha_final.'/'.$estado)}}')">Generar reporte</button>
    </div>
  </div>
</div>
@endif

  <script>
$(document).ready( function() {

    $('#tabla_reportes').DataTable( {

    } );

  
  $( '.id_desd_fech').datepicker({
                pickTime: false,
                autoclose: true,
                language: 'es',
               // startDate: '+0d',
            });
  $( '.id_hast_fech').datepicker({
                pickTime: false,
                autoclose: true,
                language: 'es',
               // startDate: '+0d',
            });

    $("#buscar_registros").click(function(){  
      var id_articulo = $('#id_articulo').val();

      if(id_articulo == null){
      swal({
        position: "top",
        type: "error",
        title: "Selecciona articulo/cláusula a buscar",
        showConfirmButton: false,
        timer: 3500
      });
     }
     ///////////////////////////////////////////////
    else{
      var desd_fech = $('#id_desd_fech').val();
      var fecha_inicial = desd_fech.split("/").join("-");
      //TNotify.alert(fecha_inicial);
      if(desd_fech == ''){
        swal({
          position:"top",
          type:"error",
          title:"Selecciona la fecha de inicio de la búsqueda",
          showConfirmButton:false,
          timer:3500
        });
      }
    else{
        var hast_fech = $('#id_hast_fech').val();

        var fecha_final = hast_fech.split("/").join("-");
       // TNotify.alert(hast_fech);
        if(hast_fech == ''){
          swal({
            position:"top",
            type:"error",
            title:"Selecciona la fecha de termino de la búsqueda",
            showConfirmButton:false,
            timer:3500
          });
        }
        else{
            var estado = id_articulo.charAt(0);
            var id_articulo = id_articulo.slice(1);

               $("#buscar_registros").attr("disabled", true);
               window.location.href='/incidencias/reportes_incidencias_ver/'+id_articulo+'/'+fecha_inicial+'/'+fecha_final+'/'+estado ;

               swal({
                   position: "top",
                   type: "success",
                   title: "Búsqueda exitosa",
                   showConfirmButton: false,
                   timer: 3500
               });


          } 
        
      }
     }
    

      
      });

    });

  </script>

  </main>
</div>
@endsection