{{-- Encabezado del layout original de Tutorías (antes en tutorias/app_tutorias.blade.php L48-70). Con el marco no se muestra: lo sustituye el header del panel. --}}
<header id="header" >
    <div  class="colorheader col-12 card "  >
        {{-- Bootstrap 4 no tiene clases col-xs-*: en celular cada bloque ocupaba todo el ancho y el logo quedaba
             debajo del título, más alto que el encabezado. Ahora título y logo van lado a lado en celular;
             desde 576px las proporciones son las mismas de antes. --}}
        <div class="row">
            <div class="d-none d-sm-block col-sm-1 col-md-1"></div>
            <div class="d-none d-sm-block col-sm-1 col-md-1">
                {{-- <img id="logo1" src="{{ asset('img/logos/gem.png') }}" /> --}}
            </div>
            <div class="d-none d-sm-block col-sm-1 col-md-1">
                {{--<img id="logo2" src="{{ asset('img/logos/EdoMEXvertical.png') }}" /> --}}
            </div>
            <div class="col-8 col-sm-6 col-md-6 lineas text-center pt-3">
                <h5 class="font-weight-bold">Sistema de Seguimiento al Programa Institucional de Tutorias para Educación Superior</h5>
            </div>
            <div class="col-4 col-sm-2 col-md-2">
                <img id="logo3" src="{{ asset ('assets/img/tes.png') }}" />
            </div>
        </div>
    </div>
</header>
<br>
