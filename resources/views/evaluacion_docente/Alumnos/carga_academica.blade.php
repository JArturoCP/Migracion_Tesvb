
@extends('layouts.panel')
@section('title', 'Inicio')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
        @if($status_per ==0)
            <x-panel.encabezado titulo="Registrar carga académica" :migas="['Estudiantes' => null]" />
            <x-panel.alerta tipo="error" class="tw:mb-4">El periodo que seleccionaste no es el requerido.</x-panel.alerta>
        @else
        @if($adeudo == 0)
        <?php
          $direccion=Session::get('ip');
        ?>

        <script>
         $(document).ready(function(){

                 $("#enviar").click(function () {

                   var checkboxValues=[];
                   var tu_array=[];
                   $('input[name="orderBox[]"]:checked').each(function() {

                       checkboxValues[checkboxValues.length] = $(this).val();
                   // TNotify.alert(checkboxValues);

                       tu_array[tu_array.length]=$(this).parent().closest("p").children("select").val();

                     });
                     var $marcados =$("input:checked");
                     var numero= $marcados.length;
                     var suma=numero+numero;
                      // TNotify.alert(numero);
                     var arreglo=[];
                     var j=0;

                    for (var i = 0; i < numero; i++) {

                              arreglo[i]=checkboxValues[i];
                    };

                  for (var e = numero; e < suma; e++) {

                          arreglo[e]=tu_array[j];
                          j++;
                   };
                    if ($marcados.length > 0)
                    {
                         var direccion="{{$direccion}}";
                              window.location.href = "/ajax/"+arreglo;
                          // TNotify.alert("SELECCIONADOS " +$marcados.length);
                         }
                        else {
                         TNotify.alert("NINGUNA SELECCION");
                        }
                   });
                   /////////////////////////////////////reticula
                    $("#reti").on('change',function(e){
                            var reti=$('#reti').val();
                            var direccion="{{$direccion}}";
                            //$("#form_reticulas").submit();
                          window.location.href = "/reticulas/"+reti;
                         });
                    });
 </script>
<main>
    <x-panel.encabezado titulo="Registrar carga académica" :migas="['Estudiantes' => null]" />
    <div clas="row">
      <div class="text_algin tw:w-full tw:lg:w-full tw:text-center tw:px-2 tw:text-center" id="rajita" >
        <h6 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300 tw:text-gray-800 tw:dark:text-white/90" >{{$carre}}</h6>
      </div>
    </div>
   <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:px-2">
  <!-- Nav tabs -->
    <ul class="tw:w-full tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200 tw:dark:border-gray-800" role="tablist">
                <li role="presentation" class="active"><a href="#uno" aria-controls="home" role="tab" data-toggle="tab">Primero</a></li>
                <li role="presentation"><a href="#dos" aria-controls="dos" role="tab" data-toggle="tab">Segundo</a></li>
                <li role="presentation"><a href="#tres" aria-controls="tres" role="tab" data-toggle="tab">Tercero</a></li>
                <li role="presentation"><a href="#cuatro" aria-controls="cuatro" role="tab" data-toggle="tab">Cuarto</a></li>
                <li role="presentation"><a href="#sinco" aria-controls="sinco" role="tab" data-toggle="tab">Quinto</a></li>
                <li role="presentation"><a href="#seis" aria-controls="seis" role="tab" data-toggle="tab">Sexto</a></li>
                <li role="presentation"><a href="#siete" aria-controls="siete" role="tab" data-toggle="tab">Séptimo</a></li>
                <li role="presentation"><a href="#ocho" aria-controls="ocho" role="tab" data-toggle="tab">Octavo</a></li>
                <li role="presentation"><a href="#nueve" aria-controls="nueve" role="tab" data-toggle="tab">Noveno</a></li>
                @if($datos_alumn->id_carrera == 3)
                   <li role="presentation"><a href="#decimo" aria-controls="decimo" role="tab" data-toggle="tab">Décimo</a></li>
                @endif
   </ul>

  <!-- Tab panes -->
    <div class="tab-content tw:w-full">
         <div role="tabpanel" class="tab-pane active tw:flex tw:flex-wrap tw:gap-y-4" id="uno">
             <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-center" >
                 <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-gray-800 tw:dark:text-white/90" >Primer semestre</h4>
             </div>
             <div class="tw:w-full tw:lg:w-full tw:px-2 tw:text-center" >

             </div>
             <?php $i=0; ?>
              @foreach($materias as $materias)
                 <?php $i++; ?>
                  <div class="carmaterias tw:w-full tw:lg:w-4/12 tw:lg:grow tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03] tw:px-2 tw:text-center tw:bg-gray-200 tw:dark:bg-gray-700"  id="carmaterias">
                  <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300 tw:text-gray-800 tw:dark:text-white/90"  values="{{$materias->id_materia}}">{{$materias->nombre}}</h5>
                  <p>
                    <input type="checkbox" id="test1" value="{{$materias->id_materia}}" class="tw:w-full tw:lg:w-full tw:px-2" name="orderBox[]"/>
                    <br>
                     <select name="color1[]" class="input-field tw:w-full tw:px-2">
                     <option value="1">Normal</option>
                     <option value="2">Repeticion</option>
                     <option value="3">Epecial</option>
                     <option value="4">Global</option>
                     </select>
                      <br>
                   </p>
                 </div>
                 @if($i == 2)
                     <div class="tw:w-full tw:lg:w-full tw:px-2">
                     </div>
                     <?php $i=0; ?>
                 @endif
                 @endforeach
                 @if($i == 1)
                     <div class="tw:w-full tw:lg:w-full tw:px-2">
                     </div>
                     <?php $i=0; ?>
                 @endif

        </div>

        <div role="tabpanel" class="tab-pane tw:flex tw:flex-wrap tw:gap-y-4" id="dos">
                  <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-center" >
                      <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-gray-800 tw:dark:text-white/90" >Segundo semestre</h4>
                  </div>
                    <div class="tw:w-full tw:lg:w-full tw:px-2 tw:text-center" >

                    </div>
                  <?php $i=0; ?>
                  @foreach($materias2 as $materias2)
                    <?php $i++; ?>
                   <div class="cardd carmaterias tw:w-full tw:lg:w-4/12 tw:lg:grow tw:px-2 tw:text-center tw:bg-gray-200 tw:dark:bg-gray-700"   id="carmaterias">
                      <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300" values="{{$materias2->id_materia}}">{{$materias2->nombre}}</h5>
                         <p>
                             <input type="checkbox" id="test1" value="{{$materias2->id_materia}}" class="tw:w-full tw:lg:w-full tw:px-2" name="orderBox[]"/>
                             <br>
                             <select name="color1[]" class="input-field tw:w-full tw:px-2">
                             <option value="1">Normal</option>
                             <option value="2">Repeticion</option>
                             <option value="3">Epecial</option>
                             <option value="4">Global</option>
                             </select>
                             <br>
                         </p>
                   </div>
                        @if($i == 2)
                             <div class="tw:w-full tw:lg:w-full tw:px-2">
                             </div>
                            <?php $i=0; ?>
                        @endif
                 @endforeach
                @if($i == 1)
                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                    </div>
                    <?php $i=0; ?>
                @endif

        </div>

        <div role="tabpanel" class="tab-pane tw:flex tw:flex-wrap tw:gap-y-4" id="tres">
                <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-center" >
                    <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-gray-800 tw:dark:text-white/90" >Tercer semestre</h4>
                </div>
                <div class="tw:w-full tw:lg:w-full tw:px-2 tw:text-center" >

                </div>
                <?php $i=0; ?>
                @foreach($materias3 as $materias3)
                    <?php $i++; ?>
               <div class="cardd carmaterias tw:w-full tw:lg:w-4/12 tw:lg:grow tw:px-2 tw:text-center tw:bg-gray-200 tw:dark:bg-gray-700"  id="carmaterias">

                  <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300" values="{{$materias3->id_materia}}">{{$materias3->nombre}}</h5>
                  <p>
                    <input type="checkbox" id="test1" value="{{$materias3->id_materia}}" class="tw:w-full tw:lg:w-full tw:px-2" name="orderBox[]"/>
                    <br>
                     <select name="color1[]" class="input-field tw:w-full tw:px-2">
                     <option value="1">Normal</option>
                     <option value="2">Repeticion</option>
                     <option value="3">Epecial</option>
                     <option value="4">Global</option>
                     </select>
                      <br>
                  </p>
               </div>
                        @if($i == 2)
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                            </div>
                            <?php $i=0; ?>
                        @endif
                @endforeach
                @if($i == 1)
                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                    </div>
                    <?php $i=0; ?>
                @endif
        </div>
         <div role="tabpanel" class="tab-pane tw:flex tw:flex-wrap tw:gap-y-4" id="cuatro">
                 <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-center" >
                     <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-gray-800 tw:dark:text-white/90" >Cuarto semestre</h4>
                 </div>
                 <div class="tw:w-full tw:lg:w-full tw:px-2 tw:text-center" >
                 </div>
                 <?php $i=0; ?>
                 @foreach($materias4 as $materias4)
                     <?php $i++; ?>
                     <div class="cardd carmaterias tw:w-full tw:lg:w-4/12 tw:lg:grow tw:px-2 tw:text-center tw:bg-gray-200 tw:dark:bg-gray-700"  id="carmaterias">

                         <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300" values="{{$materias4->id_materia}}">{{$materias4->nombre}}</h5>
                         <p>
                         <input type="checkbox" id="test1" value="{{$materias4->id_materia}}" class="tw:w-full tw:lg:w-full tw:px-2" name="orderBox[]"/>
                         <br>
                         <select name="color1[]" class="input-field tw:w-full tw:px-2">
                         <option value="1">Normal</option>
                         <option value="2">Repeticion</option>
                         <option value="3">Epecial</option>
                         <option value="4">Global</option>
                         </select>
                             <br>
                       </p>
                     </div>
                         @if($i == 2)
                             <div class="tw:w-full tw:lg:w-full tw:px-2">
                             </div>
                             <?php $i=0; ?>
                         @endif
                 @endforeach
                 @if($i == 1)
                     <div class="tw:w-full tw:lg:w-full tw:px-2">
                     </div>
                     <?php $i=0; ?>
                 @endif
        </div>

        <div role="tabpanel" class="tab-pane tw:flex tw:flex-wrap tw:gap-y-4" id="sinco">
                 <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-center" >
                     <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-gray-800 tw:dark:text-white/90" >Quinto semestre</h4>
                 </div>
                 <div class="tw:w-full tw:lg:w-full tw:px-2 tw:text-center" >
                 </div>
                 <?php $i=0; ?>
                   @foreach($materias5 as $materias5)
                     <?php $i++; ?>
                   <div class="cardd carmaterias tw:w-full tw:lg:w-4/12 tw:lg:grow tw:px-2 tw:text-center tw:bg-gray-200 tw:dark:bg-gray-700"  id="carmaterias">

                      <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300" values="{{$materias5->id_materia}}">{{$materias5->nombre}}</h5>
                      <p>
                        <input type="checkbox" id="test1" value="{{$materias5->id_materia}}" class="tw:w-full tw:lg:w-full tw:px-2" name="orderBox[]"/>
                        <br>
                         <select name="color1[]" class="input-field tw:w-full tw:px-2">
                         <option value="1">Normal</option>
                         <option value="2">Repeticion</option>
                         <option value="3">Epecial</option>
                         <option value="4">Global</option>
                         </select>
                          <br>
                      </p>
                   </div>
                         @if($i == 2)
                             <div class="tw:w-full tw:lg:w-full tw:px-2">
                             </div>
                             <?php $i=0; ?>
                         @endif
                    @endforeach
                     @if($i == 1)
                         <div class="tw:w-full tw:lg:w-full tw:px-2">
                         </div>
                         <?php $i=0; ?>
                     @endif
        </div>
     <div role="tabpanel" class="tab-pane tw:flex tw:flex-wrap tw:gap-y-4" id="seis">
             <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-center" >
                 <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-gray-800 tw:dark:text-white/90" >Sexto semestre</h4>
             </div>
             <div class="tw:w-full tw:lg:w-full tw:px-2 tw:text-center" >
             </div>
             <?php $i=0; ?>
            @foreach($materias6 as $materias6)
             <?php $i++; ?>
           <div class="cardd carmaterias tw:w-full tw:lg:w-4/12 tw:lg:grow tw:px-2 tw:text-center tw:bg-gray-200 tw:dark:bg-gray-700"  id="carmaterias">

              <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300" values="{{$materias6->id_materia}}">{{$materias6->nombre}}</h5>
              <p>
                <input type="checkbox" id="test1" value="{{$materias6->id_materia}}" class="tw:w-full tw:lg:w-full tw:px-2" name="orderBox[]"/>
                <br>

                 <select name="color1[]" class="input-field tw:w-full tw:px-2">
                 <option value="1">Normal</option>
                 <option value="2">Repeticion</option>
                 <option value="3">Epecial</option>
                 <option value="4">Global</option>
                 </select>
                  <br>
              </p>
           </div>
                 @if($i == 2)
                     <div class="tw:w-full tw:lg:w-full tw:px-2">
                     </div>
                     <?php $i=0; ?>
                 @endif
            @endforeach
             @if($i == 1)
                 <div class="tw:w-full tw:lg:w-full tw:px-2">
                 </div>
                 <?php $i=0; ?>
             @endif

    </div>
     <div role="tabpanel" class="tab-pane tw:flex tw:flex-wrap tw:gap-y-4" id="siete">
             <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-center" >
                 <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-gray-800 tw:dark:text-white/90" >Séptimo semestre</h4>
             </div>
             <div class="tw:w-full tw:lg:w-full tw:px-2 tw:text-center" >
             </div>
             <?php $i=0; ?>
                 @foreach($materias7 as $materias7)
                 <?php $i++; ?>
               <div class="cardd carmaterias tw:w-full tw:lg:w-4/12 tw:lg:grow tw:px-2 tw:text-center tw:bg-gray-200 tw:dark:bg-gray-700"  id="carmaterias">

                  <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300" values="{{$materias7->id_materia}}">{{$materias7->nombre}}</h5>
                  <p>
                    <input type="checkbox" id="test1" value="{{$materias7->id_materia}}" class="tw:w-full tw:lg:w-full tw:px-2" name="orderBox[]"/>
                    <br>
                     <select name="color1[]" class="input-field tw:w-full tw:px-2">
                     <option value="1">Normal</option>
                     <option value="2">Repeticion</option>
                     <option value="3">Epecial</option>
                     <option value="4">Global</option>
                     </select>
                      <br>
                  </p>
               </div>
                     @if($i == 2)
                         <div class="tw:w-full tw:lg:w-full tw:px-2">
                         </div>
                         <?php $i=0; ?>
                     @endif
                @endforeach
                 @if($i == 1)
                     <div class="tw:w-full tw:lg:w-full tw:px-2">
                     </div>
                     <?php $i=0; ?>
                 @endif

    </div>
     <div role="tabpanel" class="tab-pane tw:flex tw:flex-wrap tw:gap-y-4" id="ocho">
             <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-center" >
                 <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-gray-800 tw:dark:text-white/90" >Octavo semestre</h4>
             </div>
             <div class="tw:w-full tw:lg:w-full tw:px-2 tw:text-center" >
             </div>
             <?php $i=0; ?>
            @foreach($materias8 as $materias8)
                 <?php $i++; ?>
               <div class="cardd carmaterias tw:w-full tw:lg:w-4/12 tw:lg:grow tw:px-2 tw:text-center tw:bg-gray-200 tw:dark:bg-gray-700"  id="carmaterias">

                <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300" values="{{$materias8->id_materia}}">{{$materias8->nombre}}</h5>
                  <p>
                    <input type="checkbox" id="test1" value="{{$materias8->id_materia}}" class="tw:w-full tw:lg:w-full tw:px-2" name="orderBox[]"/>
                    <br>
                     <select name="color1[]" class="input-field tw:w-full tw:px-2">
                     <option value="1">Normal</option>
                     <option value="2">Repeticion</option>
                     <option value="3">Epecial</option>
                     <option value="4">Global</option>
                     </select>
                      <br>
                   </p>
                </div>
                     @if($i == 2)
                         <div class="tw:w-full tw:lg:w-full tw:px-2">
                         </div>
                         <?php $i=0; ?>
                     @endif
                @endforeach
                 @if($i == 1)
                     <div class="tw:w-full tw:lg:w-full tw:px-2">
                     </div>
                     <?php $i=0; ?>
                 @endif
     </div>
     <div role="tabpanel" class="tab-pane tw:flex tw:flex-wrap tw:gap-y-4" id="nueve">
             <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-center" >
                 <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-gray-800 tw:dark:text-white/90" >Noveno semestre</h4>
             </div>
             <div class="tw:w-full tw:lg:w-full tw:px-2 tw:text-center" >
             </div>
             <?php $i=0; ?>
                 @foreach($materias9 as $materias9)
                 <?php $i++; ?>
               <div class="cardd carmaterias tw:w-full tw:lg:w-4/12 tw:lg:grow tw:px-2 tw:text-center tw:bg-gray-200 tw:dark:bg-gray-700"  id="carmaterias">
                
                  <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300" values="{{$materias9->id_materia}}">{{$materias9->nombre}}</h5>
                  <p>
                    <input type="checkbox" id="test1" value="{{$materias9->id_materia}}" class="tw:w-full tw:lg:w-full tw:px-2" name="orderBox[]"/>
                    <br>
                     <select name="color1[]" class="input-field tw:w-full tw:px-2">
                     <option value="1">Normal</option>
                     <option value="2">Repeticion</option>
                     <option value="3">Epecial</option>
                     <option value="4">Global</option>
                     </select>
                      <br>
                  </p>
               </div>
                     @if($i == 2)
                         <div class="tw:w-full tw:lg:w-full tw:px-2">
                         </div>
                         <?php $i=0; ?>
                     @endif
                @endforeach
                 @if($i == 1)
                     <div class="tw:w-full tw:lg:w-full tw:px-2">
                     </div>
                     <?php $i=0; ?>
                 @endif

    </div>
        @if($datos_alumn->id_carrera == 3)
        <div role="tabpanel" class="tab-pane tw:flex tw:flex-wrap tw:gap-y-4" id="decimo">
            <div class="tw:w-full tw:lg:w-3/12 tw:lg:grow tw:px-2 tw:text-center" >
                <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-gray-800 tw:dark:text-white/90" >Décimo semestre</h4>
            </div>
            <div class="tw:w-full tw:lg:w-full tw:px-2 tw:text-center" >
            </div>
            <?php $i=0; ?>
            @foreach($materias10 as $materias10)
                <?php $i++; ?>
                <div class="cardd carmaterias tw:w-full tw:lg:w-4/12 tw:lg:grow tw:px-2 tw:text-center tw:bg-gray-200 tw:dark:bg-gray-700"  id="carmaterias">

                    <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300" values="{{$materias10->id_materia}}">{{$materias10->nombre}}</h5>
                    <p>
                        <input type="checkbox" id="test1" value="{{$materias10->id_materia}}" class="tw:w-full tw:lg:w-full tw:px-2" name="orderBox[]"/>
                        <br>
                        <select name="color1[]" class="input-field tw:w-full tw:px-2">
                            <option value="1">Normal</option>
                            <option value="2">Repeticion</option>
                            <option value="3">Epecial</option>
                            <option value="4">Global</option>
                        </select>
                        <br>
                    </p>
                </div>
                @if($i == 2)
                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                    </div>
                    <?php $i=0; ?>
                @endif
            @endforeach
            @if($i == 1)
                <div class="tw:w-full tw:lg:w-full tw:px-2">
                </div>
                <?php $i=0; ?>
            @endif

        </div>
@endif





</div>
    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
       <p class="tw:w-full"><br></p>
    </div>
</div>
    @if($des == 0 || $des == 3 || $des == 4 )

     <div>
  
    <a class="flotante tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" id="enviar" type="button" ><span class="fa fa-check" aria-hidden="true"/></a>
     </div>
        @else
        <div>

            <a class="flotante tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"  type="button" disabled><span class="fa fa-check" aria-hidden="true"/></a>
        </div>
    @endif

</main>
        @else
            <x-panel.encabezado titulo="Registrar carga académica" :migas="['Estudiantes' => null]" />
            <x-panel.alerta tipo="error" class="tw:mb-4">Contacta a los siguientes Departamentos o Jefaturas porque cuentas con un adeudo (por ejemplo: préstamo de material o instrumentos, o un documento), por lo contrario, no podrás registrar tu carga académica:<br>
                        @foreach($departamento_carrera as $departamento_carrera)
                            <p><strong>Nombre del departamento o jefatura : {{$departamento_carrera['nombre']}}</strong><br> <b>¿Qué  es lo que adeudas en el departamento? </b>{{$departamento_carrera['comentario']}}</p><hr>
                        @endforeach</x-panel.alerta>
        @endif
@endif
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <p class="tw:w-full"><br></p>
        </div>
</div>
@endsection
