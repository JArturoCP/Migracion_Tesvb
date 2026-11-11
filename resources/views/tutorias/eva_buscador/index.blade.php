@extends('tutorias.app_tutorias')
@section('content')
<form>
    <table class="table table-bordered">
        <thead>
            <th>Total alumnos</th>
            <th>Hombres</th>
            <th>Mujeres</th>
            <th>Discapacidad</th>
            <th>Lengua</th>
            <th>Padres</th>
            <th>Becados</th>
            <th>Etnia</th>
        </thead>
        <tbody>
            <td>{{$datos_a->total}}</td>
            <td>{{$datos_a->t_m}}</td>
            <td>{{$datos_a->t_f}}</td>
            <td>{{$datos_a->discapacidad}}</td>
            <td>{{$datos_a->lengua}}</td>
            <td>{{$datos_a->padres}}</td>
            <td>{{$datos_a->beca}}</td>
            <td>{{$datos_a->etina}}</td>
        </tbody>
    </table>
    <table class="table table-bordered">
        <tr>
            <th><label for="busqueda">Buscar:</label></th>
            <td><input type="text" id="busqueda" name="busqueda" value="" oninput="buscar()"></td>
        </tr>
    </table>
    <table  class="table table-bordered">
        <thead>
            <th>Genero </th>
            <th>Discapacidad</th>
            <th>Estado Civil</th>
        </thead>
        <tbody>
            <td>
                <table class="table table-borderless">
                    <thead>
                        <th>M</th>
                        <th>F</th>
                    </thead>
                    <tbody>
                        <td>
                            <input type="checkbox" id="sexoM" name="sexoM" value="M" class="filtro" >
                        </td>
                        <td>
                            <input type="checkbox" id="sexoF" name="sexoF" value="F" class="filtro">
                        </td>
                    </tbody>
                </table>
            </td>
            <td>
                <table class="table table-borderless">
                    <thead>
                    <th>Si</th>
                    <th>No</th>
                    </thead>
                    <tbody>
                    <td>
                        <input type="checkbox" id="disSi" name="disSi" value="2" class="filtro" >
                    </td>
                    <td>
                        <input type="checkbox" id="disNo" name="disNo" value="1" class="filtro">
                    </td>
                    </tbody>
                </table>
            </td>

            <td>
                <table class="table table-borderless">
                    <thead>
                    <th>SOLTERO</th>
                    <th>CASADO</th>
                    <th>DIVORCIADO</th>
                    <th>UNION LIBRE</th>
                    </thead>
                    <tbody>
                    <td>
                        <input type="checkbox" id="ecSol" name="ecSol" value="SOLTERO" class="filtro" >
                    </td>
                    <td>
                        <input type="checkbox" id="ecCas" name="ecCas" value="CASADO" class="filtro">
                    </td>
                    <td>
                        <input type="checkbox" id="ecDiv" name="ecDiv" value="DIVORCIADO" class="filtro">
                    </td>
                    <td>
                        <input type="checkbox" id="ecDiv" name="ecDiv" value="UNION LIBRE" class="filtro">
                    </td>
                    </tbody>
                </table>
            </td>
        </tbody>
    </table>

        {{--<button type="button" onclick="buscar()">Buscar</button>--}}
	</form>
	<table id="tabla" class='table table-bordered table-responsive-lg'>
		<thead>
			<tr>
                <th>Cuenta</th>
				<th>Nombre</th>
                <th>Genero</th>
                <th>Fecha de Nacimiento</th>
				<th>Edad</th>
				<th>Correo</th>
                <th>Estado Civil</th>
                <th>Discapacidad</th>
                <th>Etnia</th>
			</tr>
		</thead>
		<tbody>
			<!-- Los resultados de la búsqueda se mostrarán aquí -->
		</tbody>
	</table>
<script type="text/javascript">
var cadena = '{{$json}}';
cadena = cadena.replace(/&quot;/g,'"');

datos = JSON.parse(cadena);

console.log(datos);

// Obtén la tabla y el campo de búsqueda
var tabla = document.getElementById("tabla");
var campoBusqueda = document.getElementById("busqueda");
var campoSexo = document.getElementById('sexo');
var resultados = [];
// Define la función para buscar los datos
function buscar() {
  // Obtén el término de búsqueda
  var termino = campoBusqueda.value.toLowerCase();

  // Crea un arreglo para almacenar los resultados de la búsqueda
  resultados = [];

  // Recorre el arreglo de datos y verifica si cada elemento coincide con el término de búsqueda
  for (var i = 0; i < datos.length; i++) {
    var dato = datos[i];
    if (dato.nombre.toLowerCase().indexOf(termino) >= 0 || dato.cuenta.toLowerCase().indexOf(termino) >= 0) {
      resultados.push(dato);
    }
  }
    console.log(resultados);
  // Limpia la tabla y agrega los resultados de la búsqueda
  limpiarTabla();
  agregarResultados(resultados);
}

// Define la función para limpiar la tabla
function limpiarTabla() {
  var tbody = tabla.getElementsByTagName("tbody")[0];
  tbody.innerHTML = "";
}

// Define la función para agregar los resultados de la búsqueda a la tabla
function agregarResultados(resultados) {
  var tbody = tabla.getElementsByTagName("tbody")[0];
  for (var i = 0; i < resultados.length; i++) {
    var dato = resultados[i];
    var fila = document.createElement("tr");
    var celdaCuenta = document.createElement("td");
    var celdaNombre = document.createElement("td");
    var celdaGenero = document.createElement("td");
    var celdaFechaNacimiento = document.createElement("td");
    var celdaEdad = document.createElement("td");
    var celdaCorreo = document.createElement("td");
    var celdaEstadoC = document.createElement("td");
    var celdaDis = document.createElement("td");
    var celdaEtnia = document.createElement('td');
    celdaCuenta.textContent = dato.cuenta;
    celdaNombre.textContent = dato.nombre;
    celdaGenero.textContent = dato.genero;
    celdaFechaNacimiento.textContent = dato.fecha_nac;
    celdaEdad.textContent = dato.edad;
    celdaCorreo.textContent = dato.correo;
    celdaEstadoC.textContent = dato.estado;

    if(dato.discapacidad == 1 || dato.discapacidad == 1 )
        celdaDis.textContent = "No";
    else
        celdaDis.textContent = "Si";

    if(dato.etnia_indigena == 1)
        celdaEtnia.textContent = 'Si';
    else
        celdaEtnia.textContent = 'No';

    fila.appendChild(celdaCuenta);
    fila.appendChild(celdaNombre);
    fila.appendChild(celdaGenero);
    fila.appendChild(celdaFechaNacimiento);
    fila.appendChild(celdaEdad);
    fila.appendChild(celdaCorreo);
    fila.appendChild(celdaEstadoC);
    fila.appendChild(celdaDis);
    fila.appendChild(celdaEtnia);
    tbody.appendChild(fila);
  }
}
$(document).ready(function () {
    $(".filtro").click(function (){
       var datos = [];
       $(".filtro").each(function (){
           if($(this).is(":checked")){
               var dato = $(this).val();
               datos.push(dato);
           }
       });
        //console.log(datos);
        limpiarTabla();
        buscaFiltros(datos);
    });
});

function buscaFiltros(datos){
    var resultadosF = [];
   datos.forEach(function (dato){
       resultados.forEach(function (resultado) {
           //console.log(dato);
           var discapacidad = 0;
           if(resultado.discapacidad == 2)
               discapacidad = 2;
           else
               discapacidad = 1;
           if (resultado.genero == dato  || discapacidad == dato || resultado.estado == dato  ) {
               resultadosF.push(resultado);
           }
       });
   });
    limpiarTabla();
    agregarResultados(resultadosF);
    console.log(resultadosF);
}
buscar();
</script>

@endsection


