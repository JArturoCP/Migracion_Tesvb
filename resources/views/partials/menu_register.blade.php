@section('menu')
<nav class="navbar navbar-default navbar-static-top" aria-label="Navegación pública">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-controls="app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Mostrar u ocultar navegación</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    @sectionMissing('login_home_link')
                    <a class="navbar-brand" href="{{ url('/') }}">
                       TESVB
                    </a>
                    @endif
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                 
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Registro</a></li>
                            <li><a class="link parpadea" href="#modal_guia" data-toggle="tooltip" data-placement="top" title="Ayuda Registro" aria-label="Guía de registro" aria-controls="modal_guia" aria-haspopup="dialog"><span class="glyphicon glyphicon-question-sign" aria-hidden="true" style="font-size: 18px; text-decoration: blink;"></span></a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <script>
  $(document).ready(function(){
$(".link").tooltip({html:true});

$(".link").click(function(event){
  event.preventDefault();
  var trigger = this;
  $("#modal_guia").one("hidden.bs.modal", function(){
    trigger.focus();
  }).modal("show");
});
    
    });

</script>
@endsection
