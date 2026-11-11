@extends('layouts.app')
@section('title', 'Incidencias')
@section('content')
    
<main class="col-md-12">
<div class="row">
        <div class="col-md-5 col-md-offset-4">
    <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title text-center">REPORTES</h3>
        </div>
    </div>  
  </div>
  </div>
  @if($estados == 0)
  
<div class="row">
  <div class="col-md-3 col-md-offset-2">
    <div class= "dropdown">
        <label for="Tipo_of">Artículo/Cláusula: </label>
          <select class="form-control" placeholder="Seleciona una opción" id="id_articulo" name="id_articulo" required>
              <option disabled selected hidden> Selecciona una opción </option>
              @foreach($art as $articulo)
                <option value="{{$articulo['estado']}}{{$articulo['id']}}" > {{$articulo['nombre']}} </option>
              @endforeach
              <option value="3200" > Todos </option>
          </select>
    </div>
  </div>
  <div class="col-md-2 ">
    <label for="fecha_req">Desde Fecha:</label>
                     <div class="form-group">
                         <input class="form-control datepicker id_desd_fech"   type="text"  id="id_desd_fech" name="id_desd_fech" data-date-format="yyyy/mm/dd" placeholder="AAAA/MM/DD" >
                     </div>
  </div>
  <div class="col-md-2 ">
    <label for="fecha_req">Hasta Fecha:</label>
                     <div class="form-group">
                         <input class="form-control datepicker id_hast_fech"   type="text"  id="id_hast_fech" name="id_hast_fech" data-date-format="yyyy/mm/dd" placeholder="AAAA/MM/DD" >
                     </div>
  </div>
  <div class="col-md-2">
    <label><br></label>
    <div class="form-group">
      <button id="buscar_registros" type="submit" class="btn btn-success">Buscar registros</button>
  </div> 
  </div>    
</div>

@endif
@if($estados == 1)
<div class="row">
<form id="form_buscar_reportes" action="{{url("/incidencias/reportes_incidencias_ver")}}" method="POST" role="form" >
  {{ csrf_field() }}
    <div class="col-md-3 col-md-offset-2">
        <div class= "dropdown">
            <label for="Tipo_of">Articulo/Cláusula:</label>
            <select class="form-control" placeholder="Seleciona una opción" id="id_articulo" name="id_articulo" required>
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
  <div class="col-md-2 ">
    <label for="fecha_req">Desde Fecha:</label>
                     <div class="form-group">
                         <input class="form-control datepicker id_desd_fech" value="{{$fecha_inicial}}"  type="text"  id="id_desd_fech" name="id_desd_fech" data-date-format="yyyy/mm/dd" placeholder="AAAA/MM/DD" >
                     </div>
  </div>
  <div class="col-md-2 ">
    <label for="fecha_req">Hasta Fecha:</label>
                     <div class="form-group">
                         <input class="form-control datepicker id_hast_fech"  value="{{$fecha_final}}" type="text"  id="id_hast_fech" name="id_hast_fech" data-date-format="yyyy/mm/dd" placeholder="AAAA/MM/DD" >
                     </div>
  </div>
</form> 
  <div class="col-md-2">
    <label><br></label>
    <div class="form-group">
      <button id="buscar_registros" type="submit" class="btn btn-success">Buscar registros</button>
  </div> 
  </div>    
</div>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <table id="tabla_reportes" class="table table-bordered table-resposive" align="center">
                          <thead >                                     
                            <th class="text-center">ID EMPLEADO</th>
                            <th class="text-center">SERVIDOR PÚBLICO DEL JUSTIFICANTE </th>
                            <th class="text-center">FECHA QUE JUSTIFICA </th>
                            <th class="text-center">NUMERO DE OFICIO Y/O DOCUMENTO</th>
                            <th class="text-center">DOCUMENTO </th>
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

<div class="row">
  
  
  <div class="row" style="display: inline" id="generar">
    <div class="col-md-2 col-md-offset-8">
    <button type="button" class="btn btn-primary center" onclick="window.open('{{url('/incidencias/excel_reportes_inc/'.$id_articulo.'/'.$fecha_inicial.'/'.$fecha_final.'/'.$estado)}}')">Generar reporte</button>
    </div>
  </div>
</div>
@endif
</div>
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
      //alert(fecha_inicial);
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
       // alert(hast_fech);
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
@endsection