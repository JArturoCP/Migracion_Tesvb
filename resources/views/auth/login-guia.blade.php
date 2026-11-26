@extends('layouts.panel')
@include('partials.panel.recursos_app')
@section('title', 'Iniciar sesión | TESVB')
@section('guia_registro', '1')
@include('partials.panel.guia_registro')
@section('content')
<div class="tw:w-full" id="container">
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
       
        
            <?php $controles=session()->has('controles')?session()->has('controles'):false;

if($controles==false)
{
    $controles=true;
    Session::put('controles',$controles);
    $acti=1;
    Session::put('acti',$acti);
}
else
{
     $acti=2;
    Session::put('acti',$acti);
}
 $activar=Session::get('acti');
 ?>
    @if (session('status'))
    <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800">
        {{ session('status') }}
    </div>
    @endif
    @if (session('warning'))
        <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-amber-200 tw:bg-amber-50 tw:text-amber-800">
            {{ session('warning') }}
        </div>
    @endif


<div id="modal_guia" class="modal fade bs-example-modal-lg tw-modal-compat" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-panel-modal hidden>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
            
            <div class="item active col">
                    <img src="img/1.png">
              
              <div class="tw:text-center" style="color:black;">
                <strong><h3 class="tw:mb-4 tw:text-lg tw:font-semibold">Si aún no tienes una cuenta, selecciona «Registro» en la parte superior derecha.</h3></strong>
              </div>
          </br>
            </div>
              
          
            


            <div class="item">
              <img src="img/2.png" >
              <div class="" style="color:black;">
                <strong><h3>En el formulario de registro, ingresa tu correo electrónico y una contraseña. Después, selecciona el tipo de usuario. Tu correo será tu nombre de usuario.</h3></strong>
              </div>
            </div>
            <div class="item">
              <img src="img/3.png" >
              <div class="" style="color:black;">
                <strong><h3>El sistema enviará un enlace de autentificación al correo que haya sido registrado con la finalidad de verificar que el usuario registrado exista.</h3></strong>
              </div>
            </div>
                        <div class="item">
              <img src="img/4.png" >
              <div class="carousel-caption" style="color:black;">
                <strong><h3> Abre el mensaje de verificación, haz clic derecho en el enlace y ábrelo en una nueva pestaña.</h3></strong>
              </div>
            </div>
                                    <div class="item">
              <img src="img/5.png" >
              <div class="" style="color:black;">
               <strong><h3>  Dependiendo del tipo de usuario que haya seleccionado en el registro aparecerá un formulario, el cuál se deberá llenar con los datos respectivos.</h3></strong>
              </div>
            </div>
            <div class="item">
              <img src="img/6.png" >
              <div class="" style="color:black;">
                <strong><h3>En caso de que haya seleccionado el tipo de usuario Empleado y haya concluido el registro 
                   solo se podra tener acceso al menu una vez que sea asignado(a) como docente.</h3></strong>
              </div>
            </div>
          </div>

          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="fa fa-chevron-left" aria-hidden="true"></span>
            <span class="tw:sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="fa fa-chevron-right" aria-hidden="true"></span>
            <span class="tw:sr-only">Next</span>
          </a>
        </div>

        <div class="modal-footer">
        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Omitir</button>
      </div>
    </div>
  </div>
</div>


        <div class="tw:w-full tw:lg:w-8/12 tw:lg:ml-[16.6667%] tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">Iniciar sesión</div>
                <div class="tw:p-5 tw:sm:p-6">
                    <form class="" role="form" method="POST" action="{{ url('/login') }}">
                        <!-- action="{{ url('/login') }}"  -->
                        {{ csrf_field() }}

                        <div class="tw:mb-4 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="tw:w-full tw:lg:w-4/12 tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:px-2">Correo electrónico</label>

                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                <input id="email" type="email" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="tw:mt-1 tw:block tw:text-xs tw:text-gray-500">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="tw:mb-4 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="tw:w-full tw:lg:w-4/12 tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:px-2">Contraseña</label>

                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                <input id="password" type="password" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="tw:mt-1 tw:block tw:text-xs tw:text-gray-500">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="tw:mb-4">
                            <div class="tw:w-full tw:lg:w-6/12 tw:lg:ml-[33.3333%] tw:px-2">
                                <div class="tw:flex tw:items-center tw:gap-2">
                                    <label>
                                        <input type="checkbox" name="remember"> Recordarme
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="tw:mb-4">
                            <div class="tw:w-full tw:lg:w-8/12 tw:lg:ml-[33.3333%] tw:px-2">
                                <button type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">
                                    Entrar
                                </button>

                                <a class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:text-brand-500 tw:hover:underline tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" href="{{ url('/password/reset') }}">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
  $(document).ready(function(){

@if ($activar==1)
    $("#modal_guia").modal("show");
@endif
  });
  
</script>
@endsection
