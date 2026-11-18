@extends('layouts.panel')
@section('title', 'Inicio')
@include('evaluacion_docente.partials.recursos_panel', ['graficas' => true])
@section('content')

<script type="text/javascript">


  ///prueba cambios
	var opcion;
 var arreglorrubross;
 var seriesData_global;
 var yAxis;
 var ponderacion_general;
 var valores=[];

 var data2;

valores[0]=1;
valores[1]=2;
valores[2]=3;
valores[3]=4;
valores[4]=5;
valores[5]=6;
valores[6]=7;
valores[7]=8;
valores[8]=9;
valores[9]=10;
/////////////////////////////////////////////////////////////////////////GRAFICA GENERAL
    @if (isset($grafica1)||isset($grafica3))
      var titulografica="{{$grafica_condicion}}";
       var rubros="";
       var puntos="";
      var cadena;
       var arreglorubros=[];
       var arreglopuntos=[];
       //var series=[];    
      // console.log(promedios);
''
      @foreach($rubros as $rubro)
       
        rubros+="'{{$rubro->rubros}}',";
        arreglorubros[arreglorubros.length]="{{$rubro->rubros}}";

      @endforeach
 arreglorrubross=arreglorubros;
  
   // cadena='{!!$cadena!!}';
  //TNotify.alert(cadena);

       $(function () {

var seriesData={!!$cadena!!};
seriesData_global=seriesData;
//console.log(seriesData);

var ponderacion = ["0","No Suficiente","1","Suficiente","2","Bien","3","Muy Bien","4", "Excelente","5"];
ponderacion_general=ponderacion;

Highcharts.chart('mostrar_graficas', {
        chart: {
            type: 'column'
        },
        exporting:{url:'/img'},
        title: {
            text:titulografica
        },
        xAxis: {
            categories:arreglorubros
        },
        yAxis: {
            min: 0,



               max:seriesData.length*5,
            tickInterval: seriesData.length/2,
             labels: {
                 formatter: function() {
                 //console.log(this.value/seriesData.length);
                return( ponderacion[this.value/seriesData.length*2]);
                }
            },



            title: {
                text: 'Total fruit consumption'
            },
            stackLabels: {
                enabled: true,


                  formatter: function() {
                        
                        return (this.total/ seriesData.length).toPrecision(3) ;
                          
                    },





                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            align: 'center',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: false,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
           
            formatter:function(){
              //  console.log(this.series)
                  return('<b>'+this.x+'</b><br/>'+this.series.name+': '+((this.y).toPrecision(3))+'<br>Promedio: '+(this.total/seriesData.length).toPrecision(3))
                }
            },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
        series: seriesData

    },function(data){

      console.log(data);
    });

 

      
     
            
  

opcion= {
        chart: {
            type: 'column'
        },
        exporting:{url:'/img'},
        title: {
            text:titulografica
        },
        xAxis: {
            categories:arreglorubros


        },
        yAxis: {
            min: 0,

//console.log(data.series);

               max:seriesData.length*5,
            tickInterval: seriesData.length/2,
             labels: {
                 formatter: function() {
                 //console.log(this.value/seriesData.length);
                return( ponderacion[this.value/seriesData.length*2]);
                }
            },







            title: {
                text: 'Total fruit consumption'
            },
            stackLabels: {
                enabled: true,


                  formatter: function() {
                        
                        return (this.total/ seriesData.length).toPrecision(3) ;
                       
                    },





                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            align: 'center',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: false,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
      
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
        }



});
    @endif





    //////////////////////////////////////////////////////////////////POR MATERIAS


    @if (isset($grafica2))
    


       var rubros="";
       var puntos="";

       var arreglorubros=[];
       var seriesData=[];
      var materia="";
       materia+="{{$grafica_condicion}}"
//TNotify.alert(materia);
      @foreach($rubros as $rubro)
       
        rubros+="'{{$rubro->rubros}}',";
        arreglorubros[arreglorubros.length]="{{$rubro->rubros}}";

      @endforeach
        @foreach($arreglofinal as $arreglofin)
       // console.log("{{$arreglofin}}");
         seriesData[seriesData.length]=({{$arreglofin}});


      @endforeach
//TNotify.alert(seriesData.length);

      $(function () {


      var ponderacion = ["0","No Suficiente","1","Suficiente","2","Bien","3","Muy Bien","4", "Excelente","5"];
    Highcharts.chart('mostrar_graficas', {
        chart: {
            type: 'column'
        },
        title: {
            text:materia
        },
        xAxis: {
            categories:arreglorubros
        },
        yAxis: {
            min: 0,

             max:seriesData.length*5,
            tickInterval: seriesData.length/2,
             labels: {
                 formatter: function() {
                 console.log(this.value/seriesData.length);
                return(ponderacion[this.value/seriesData.length*2]);
                }
            },





            title: {
                text: 'Total fruit consumption'
            },
            stackLabels: {
                enabled: true,
                formatter: function() {
                        
                        return (this.total) ;
                            
                    },
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
       tooltip: {
           
            formatter:function(){
              //  console.log(this.series)
                  return('<b>'+this.x+'</b><br/>'+this.series.name+': '+((this.y).toPrecision(3))+'<br>Promedio: '+(this.total).toPrecision(3))
                }
            },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
        series: [{
           name: 'Criterio',
            data:seriesData
        }]
    });
});
//TNotify.alert(arreglorubros);

    @endif





$(document).ready(function() {

$('#imprime').click(function () {


var opcion={
     chart: {
            type: 'column'
        },

    exporting: {
        url: 'http://localhost'
    },
   
   
    plotOptions:{
        column:{
          stacking:'normal'
        }
    },
    xAxis: {
        categories:arreglorrubross
    },
     
     yAxis:{
             stackLabels: {
                enabled: true,


                  format:"x",
                  },
     },


     

     
              plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
     

    series:seriesData_global
    
};
  console.log(opcion)



});




$('#exportar').click(function(){


  var chart=$('#mostrar_graficas').highcharts();
  console.log(chart.getSVG());




    var obj = {},
    exportUrl = 'http://export.highcharts.com/';
    obj.type = 'image/png';
    obj.async = true;
    obj.svg=chart.getSVG();

    $.ajax({
        type: 'post',
        url: exportUrl,
        data: obj,
        success: function (data) {
          console.log(exportUrl+data);
         // TNotify.alert('ok');
            var imgContainer = $("#imgContainer");
            $('<img>').attr('src', exportUrl + data).attr('width', '250px').appendTo(imgContainer);
            $('<a>or Download Here</a>').attr('href', exportUrl + data).appendTo(imgContainer);

        }
    });


});
  /////////////////////////////////////////////////////////////////



} );



</script>

    <x-panel.encabezado titulo="REPORTE EVALUACIÓN DOCENTE" :migas="['Profesores' => url('/buscar_profesores')]" />

<div class="tw-pantalla tw:space-y-6">

<div class="tw:flex tw:flex-wrap tw:items-center tw:gap-3">
    <x-panel.boton variante="secundario" tamano="sm" id="export">get image</x-panel.boton>
    <input id="exportar" type="button" class="tw:h-9 tw:w-9 tw:cursor-pointer tw:rounded-lg tw:bg-white tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:hover:bg-gray-50" title="Exportar">
</div>
<div id="imgContainer" class="tw:flex tw:flex-wrap tw:items-center tw:gap-3"></div>

<div class="tw:grid tw:grid-cols-1 tw:gap-6 tw:xl:grid-cols-3">

        <div class="tw:space-y-4">
          <div class="tw:flex tw:flex-wrap tw:gap-3">
            <x-panel.boton tamano="sm" href="/reportes/{{$solo_id_profesor}}">GRAFICA GENERAL<span class="fa fa-list-alt 5em" aria-hidden="true" ></span></x-panel.boton>
            <x-panel.boton variante="secundario" tamano="sm" href="#" id="imprime">Imprimir<span class="fa fa-list-alt 5em" aria-hidden="true" ></span></x-panel.boton>
          </div>

            <div class="tw:space-y-3" id="accordion">
              @foreach($carreras as $carrera)
              <div class="tw:overflow-hidden tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                    <div class="tw:px-5 tw:py-4">
                        <h4 class="tw:flex tw:items-center tw:justify-between tw:gap-3 tw:text-sm">
                            <a data-toggle="collapse" data-parent="#accordion" href="#{{ $carrera ["id_carrera"] }}" class="tw:inline-flex tw:items-center tw:gap-2 tw:text-gray-800 tw:hover:text-brand-500"><span class="fa fa-chevron-down tw:text-xs tw:text-gray-400" aria-hidden="true">
                            </span>{{$carrera["nombre_carrera"]}}</a> <a href="/promedio_carrera/{{$carrera["id_carrera"]}},{{$solo_id_profesor}}" class="tw:text-brand-500" title="Gráfica de la carrera"><span class="fa fa-list-alt 5em" aria-hidden="true" ></span></a>
                        </h4>
                    </div>

                    <div id="{{ $carrera ["id_carrera"] }}" class="panel-collapse collapse ">
                        <div class="tw:border-t tw:border-gray-100">

                            <x-panel.tabla id="example" compacta>
                                   <thead>
                                          <tr>
                                                  <th>Materias</th>
                                                  <th>GRUPO</th>
                                                  <th class="tw:text-center">CONSULTAR</th>
                                           </tr>
                                    </thead>
                                    <tbody>
                                             @foreach($carrera["materias"] as $materia)
                                          <tr>
                                                  <td>{{$materia["nombre_materia"]}}</td>
                                                  <td>{{$materia["nombre_grupo"]}}</td>
                                                  <td class="tw:text-center"><a href="/promedio/{{$materia["id_hrs"]}},{{$solo_id_profesor}},{{$materia["nombre_materia"]}},{{$materia["nombre_grupo"]}},{{$materia["idcarrera"]}}" class="tw:text-brand-500" title="Consultar"><span class="fa fa-list-alt 5em" aria-hidden="true" ></span></a></td>

                                          </tr>
                                          @endforeach
                                   </tbody>
                            </x-panel.tabla>

                        </div>
                    </div>

                </div>
   @endforeach
             </div>
          </div>

          <x-panel.tarjeta class="tw:xl:col-span-2" titulo="Resultado gráfico">
              <div class="tw:overflow-x-auto">
                  <div id="mostrar_graficas" >

                  </div>
              </div>
          </x-panel.tarjeta>

</div>

<x-panel.tarjeta titulo="Detalle por criterio" sin-relleno>
 <x-panel.tabla class="tw-tabla-bordes" id="aceptados">
     <tr>
        <th>Criterio</th>
        <th>Pregunta</th>
        <th class="tw:text-center">Calificacion</th>
         <th>Observacion</th>
    </tr>
@foreach($preguntas2 as $pre)
    <tr>
        <th scope="rowgroup" rowspan="{{$pre['cantidad']}}" class="tw:bg-gray-50 tw:align-middle">
          <div style="text-align:center;" class="tw:text-sm tw:font-semibold tw:text-gray-800">{{$pre["nombre_criterio"]}}</div>
          <div style="text-align:center;" class="tw:mt-3 tw:text-lg tw:font-semibold tw:text-brand-500">{{$pre["calificacion"]}}</div>
          <div style="text-align:center;" class="tw:mt-2 tw:text-xs tw:text-gray-500">{{$pre["observacioncri"]}}</div>
        </th>

    </tr>

     @foreach($pre["preguntas"] as $preg)
     <tr>
        <td scope="col">{{$preg['pregunta']}}</td>
        <td scope="col" class="tw:text-center">{{$preg['calificacion']}}</td>
        <td scope="col">{{$preg['observacion']}}</td>
    </tr>


     @endforeach


@endforeach
 </x-panel.tabla>
</x-panel.tarjeta>
</div>
@endsection
