@extends('layouts.panel')
@section('title', 'Reticulas')
@include('partials.panel.recursos_app', ['validacion' => true])
@section('content')


<main class="tw:w-full tw:lg:w-full tw:px-2">

 <?php $jefe_division=session()->has('jefe_division')?session()->has('jefe_division'):false;
 $directivo=session()->has('directivo')?session()->has('directivo'):false;
 $consultas=session()->has('consultas')?session()->has('consultas'):false; 
?>

<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
	<div class="tw:w-full tw:lg:w-5/12 tw:lg:ml-[25%] tw:px-2">
		<div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:dark:bg-white/3 tw:dark:border-gray-800">
	  		<div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4 tw:dark:bg-white/3 tw:dark:border-gray-800">
	    		<h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center tw:dark:text-white/90">Reticulas</h3>
	  		</div>
	  					<div class="tw:p-5 tw:sm:p-6">
                @if($directivo==1 || $consultas==1)
                <input type="hidden" id="tipo" name="tipo" value="1"> 
                            <div class="tw:w-full tw:lg:w-5/12 tw:lg:ml-[8.3333%] tw:px-2">
                              <div class="dropdown">
                                <label for="dropdownMenu1">Carrera</label>
                                 <select name="selectCarrera" id="selectCarrera" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700">
                                  <option disabled selected>Selecciona carrera...</option>
                                    @foreach($carreras as $carrera)
                                      @if($carrera->id_carrera==$id_carrera2)
                                            <option value="{{$id_carrera}}" selected="selected">{{$carrera->nombre}}</option>
                                      @else
                                        <option value="{{$carrera->id_carrera}}" >{{$carrera->nombre}}</option>
                                      @endif
                                    @endforeach
                                </select>
                            </div>
                            </div> 
                                                        <div class="dropdown tw:w-full tw:lg:w-6/12 tw:md:w-6/12 tw:px-2" id="div_reticula" style="display:none">
                                                          <label for="dropdownMenu1">Reticula</label>
                                <select name="selectReticula" id="selectReticula" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700">
                                  <option disabled selected>Selecciona reticula...</option>
                                @foreach($reticulas as $reticula)
                                  @if($reticula->id_reticula==$id_reticula2)
                                  <option value="{{$reticula->id_reticula}}" selected="selected">{{$reticula->clave}}</option>
                                  @else
                                  <option value="{{$reticula->id_reticula}}" >{{$reticula->clave}}</option>
                                  @endif                                                             
                                @endforeach
                                </select>
                            </div>
                @else
                <input type="hidden" id="tipo" name="tipo" value="2"> 
                            <div class="dropdown tw:w-full tw:lg:w-6/12 tw:md:w-6/12 tw:px-2" id="div_reticula">
                                <select name="selectReticula" id="selectReticula" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700">
                                  <option disabled selected>Selecciona reticula...</option>
                                @foreach($reticulas as $reticula)
                                  @if($reticula->id_reticula==$id_reticula2)
                                  <option value="{{$reticula->id_reticula}}" selected="selected">{{$reticula->clave}}</option>
                                  @else
                                  <option value="{{$reticula->id_reticula}}" >{{$reticula->clave}}</option>
                                  @endif                                                             
                                @endforeach
                                <option value="00" >Agrega Reticula</option>
                                </select>
                            </div>
                @endif
	  				    </div>
		</div>	
	</div>
</div>	

<div id="contenedor_materias">

</div>

<!-- Modal para crear reticula-->
<form id="form_reticula">
<x-panel.modal id="agrega_reticula" tamano="md" sin-relleno>
      <div class="tw:px-6 tw:pt-6 tw:pr-14">
        
        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Agregar Reticulas</h4>
      </div>
      <div class="tw-modal-cuerpo">
              <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
          <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
              <div class="tw:mb-4">
                  <label for="nombre_reticula">Nombre:</label>
                  <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700" id="reti" name="nombre_reticula" placeholder="Materia" style="text-transform:uppercase">
                  @if($errors -> has ('nombre_reticula'))
                          <span style="color:red;">{{ $errors -> first('nombre_reticula') }}</span>
                         <style>
                          #reti
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
              </div>
          </div> 
      </div>
      </div>
      <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
        <button id="cierra" type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:dark:bg-white/3 tw:dark:text-gray-300" data-dismiss="modal">Cancelar</button>
        <button id="guarda_reticula" type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Guardar</button>
      </div>
    <!-- /.modal-content -->
  <!-- /.modal-dialog -->
</x-panel.modal><!-- /.modal -->
</form>

<!-- Modal para agregar materias-->
<form id="form_materia_crea" class="" role="form" method="POST">
  <x-panel.modal id="agrega_materias" tamano="md" sin-relleno aria-labelledby="myModalLabel">
        <div class="tw:px-6 tw:pt-6 tw:pr-14">
          
          <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Agregar Materias</h4>
        </div>
        <div class="tw-modal-cuerpo">
            <div id="warninn" class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" role="alert" style="display:none;">
              <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700 tw:dark:text-gray-500" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong>El número de hrs. es incorrecto</strong>
            </div>

          {{ csrf_field() }}
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
      <input name="reticula" type="hidden" id="reticula" value="">

      <div class="tw:w-full tw:lg:w-full tw:px-2">
          <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
              <div class="tw:mb-4">
                  <label for="nombre_materia">Nombre de la Materia:</label>
                  <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700" id="nombrem" name="nombre_materia" placeholder="Materia" style="text-transform:uppercase">
                  @if($errors -> has ('nombre_materia'))
                    <span style="color:red;">{{ $errors -> first('nombre_materia') }}</span>
                      <style>
                      #nombrem
                      {
                        border:solid 1px red;
                      }
                      </style>
                  @endif
              </div>
          </div> 
      </div>

      <div class="tw:w-full tw:lg:w-full tw:px-2">
          <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2" >
              <div class="tw:mb-4">
                  <label for="clave_materia">Clave de la Materia:</label>
                  <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700" maxlength="10" id="clavem" name="clave_materia" placeholder="Clave" style="text-transform:uppercase">
                  @if($errors -> has ('clave_materia'))
                    <span style="color:red;">{{ $errors -> first('clave_materia') }}</span>
                    <style>
                    #clavem
                    {
                      border:solid 1px red;
                    }
                    </style>
                  @endif
              </div>
          </div>
        </div>                           
    <div class="tw:w-full tw:lg:w-full tw:px-2">
        <div class="ml tw:w-full tw:lg:w-3/12 tw:lg:ml-[8.3333%] tw:px-2">
            <div class="tw:mb-4"> 
                <label for="semestre">Semestre</label> 
                <select name="semestre" id="sem" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700">
                <option disabled selected>Elige...</option>
                  @foreach($semestres as $semestre)
                  <option value="{{ $semestre->id_semestre }}">{{ $semestre->descripcion }}</option>
                  @endforeach
                </select> 
            </div>
        </div>
        <div class="ml tw:w-full tw:lg:w-3/12 tw:px-2">
            <div class="tw:mb-4">
                <label for="hrs_t">Hrs.Teoria</label>
                <select name="hrs_t" id="hrs_t"class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700">
                    <option disabled selected >Elige...</option>
                    @for ($i = 0; $i <=6; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="ml tw:w-full tw:lg:w-3/12 tw:px-2">
            <div class="tw:mb-4">
                <label for="hrs_p">Hrs.Practicas</label>
                <select name="hrs_p" id="hrs_p"class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700">
                    <option disabled selected>Elige...</option>
                    @for ($i = 0; $i <=6; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>
    </div>
    <div clas="col-md-12">
        <div class="ml tw:w-full tw:lg:w-3/12 tw:lg:ml-[8.3333%] tw:px-2">
            <div class="tw:mb-4">              
                <label for="uni">Unidades</label> 
                <select name="uni" id="unidades" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700">
                <option disabled selected>Elige...</option>
                  @for ($i = 1; $i <=10; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                  @endfor
                </select> 
            </div> 
        </div>
        <div class="ml tw:w-full tw:lg:w-3/12 tw:px-2"> 
            <div class="tw:mb-4">              
                <label for="especial">Especial</label> 
                <select name="especial" id="espe" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700">
                  <option disabled selected >Elige...</option>
                  <option value="1">Si</option>
                  <option value="0">No</option>
                 </select> 
            </div> 
        </div> 
        <div class="ml tw:w-full tw:lg:w-3/12 tw:px-2"> 
            <div class="tw:mb-4">              
                <label for="creditos">Creditos</label> 
                <select name="creditos" id="creditos" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700">
                  <option disabled selected >Elige...</option>
                  @for ($i = 1; $i <=10; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                  @endfor
                </select> 
            </div> 
        </div> 
    </div>
 </div>
        </div>
        <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:dark:bg-white/3 tw:dark:text-gray-300" data-dismiss="modal">Cancelar</button>
        <input id="guarda_materia" type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Guardar"/>
        </div>
      
  
</x-panel.modal>
</form>


</main>

    <script>
    var ret = '{{$id_reticula2}}';
    if(ret>0)
    {
      $.get("/ver/reticulas/"+ret,function(request)
            {
               $("#contenedor_materias").html(request);
            });
    }

$(document).ready(function() {


$("#selectCarrera").on('change',function(e){
  var carrera=$("#selectCarrera").val();
  $("#selectReticula").empty();

     $.get('/ver/reticulas/directivo/'+carrera,{},function(request){
        var datos=request['reticulas'];
        var retis1='<option disabled selected>Selecciona reticula...</option>';
        $("#selectReticula").append(retis1);
        for (var i=0; i<datos.length ; i++) 
        {
          var retis='<option value="'+datos[i].id_reticula+'">'+datos[i].clave+'</option>';
          $("#selectReticula").append(retis);
        }
           $("#div_reticula").show(1000);
      }); 
});

  $("#selectReticula").on('change',function(e){
    var tipo=$("#tipo").val();
    var id_reticula= $("#selectReticula").val();
    if(tipo==1)//directivo
    {
      var id_carrera= $("#selectCarrera").val();
      $.get("/ver/materias/directivo/"+id_carrera+'/'+id_reticula,function(request)
            {
               $("#contenedor_materias").html(request);
            });
    }
    else
    {
      if (id_reticula==00) 
        {
          $("#agrega_reticula").modal("show");
        }
        else
        {
          $.get("/ver/reticulas/"+id_reticula,function(request)
            {
               $("#contenedor_materias").html(request);
            });
        }
    }

    });

$("#guarda_reticula").click(function(){
  if($("#reti").valid())
  {
    var retii= $("#reti").val();
          window.location.href='/agrega/reticulas/'+retii;
  }
        });

$("#guarda_materia").click(function(event){

     if($("#nombrem").valid()&&$("#clavem").valid()&&$("#sem").valid()&&$("#hrs_p").valid()&&
    $("#hrs_t").valid()&&$("#unidades").valid()&&$("#espe").valid()&&$("#creditos").valid())
    {
        var hp=$("#hrs_p").val();
        var ht=$("#hrs_t").val();

      if(hp==0 && ht==0)
      {
        //TNotify.alert("deshabilitar");
        $('#warninn').show(1000);
      }
      else
      {
        $.post("/agregar_materias/", $("#form_materia_crea").serialize(),function(request)
          {
            $("#contenedor_materias").html(request);
            $("#warnin").hide(1000);
            $("#agrega_materias").modal("hide");
            $("#form_materia_crea")[0].reset();
            /*$('#nombrem').focus(
              function(){
                  $(this).val('');
              });
            $('#clavem').focus(
              function(){
                  $(this).val('');
              });
             $('#sem').focus(
              function(){
                  $(this).val('Elige...');
              });*/
          });
      }
    }
      });

  $("#form_reticula").validate(
  {
    rules: 
    {
      nombre_reticula: 
      {
        required: true,
      }
    },            
  });

    $("#form_materia_crea").validate(
  {
    rules: 
    {
      nombre_materia: 
      {
        required: true,
      },
      clave_materia:
      {
        required: true,
      },
      semestre : "required",
            hrs_p : "required",  
            hrs_t : "required",
            uni : "required",
            especial : "required" ,
            creditos: "required" 
    },            
  });

});
        </script>
@endsection
