@extends('layouts.app')
@section('title', 'Iniciar sesión | Sistema Integral TESVB')
@section('body_class', 'tesvb-login-page')
@section('login_home_link', '1')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/tesvb-login.css') }}?v={{ filemtime(public_path('css/tesvb-login.css')) }}">
@endpush

@section('content')
<main class="tesvb-login" id="container" aria-labelledby="tesvb-login-title">
    <div class="tesvb-login__stage">
        <div class="tesvb-login__mascots" aria-hidden="true">
            <div class="tesvb-login__mascot-side tesvb-login__mascot-side--left">
                <img class="tesvb-login__mascot tesvb-login__mascot--administracion" src="{{ asset('img/login/hurones/administracion.webp') }}"
                     width="278" height="247" alt="" aria-hidden="true" loading="lazy" decoding="async" fetchpriority="low">
                <img class="tesvb-login__mascot tesvb-login__mascot--arquitectura" src="{{ asset('img/login/hurones/arquitectura.webp') }}"
                     width="178" height="145" alt="" aria-hidden="true" loading="lazy" decoding="async" fetchpriority="low">
                <img class="tesvb-login__mascot tesvb-login__mascot--gastronomia" src="{{ asset('img/login/hurones/gastronomia.webp') }}"
                     width="213" height="219" alt="" aria-hidden="true" loading="lazy" decoding="async" fetchpriority="low">
                <img class="tesvb-login__mascot tesvb-login__mascot--ingenieria-civil" src="{{ asset('img/login/hurones/ingenieria-civil.webp') }}"
                     width="292" height="269" alt="" aria-hidden="true" loading="lazy" decoding="async" fetchpriority="low">
                <img class="tesvb-login__mascot tesvb-login__mascot--ingenieria-electrica" src="{{ asset('img/login/hurones/ingenieria-electrica.webp') }}"
                     width="216" height="221" alt="" aria-hidden="true" loading="lazy" decoding="async" fetchpriority="low">
            </div>
            <div class="tesvb-login__mascot-side tesvb-login__mascot-side--right">
                <img class="tesvb-login__mascot tesvb-login__mascot--ingenieria-forestal" src="{{ asset('img/login/hurones/ingenieria-forestal.webp') }}"
                     width="253" height="259" alt="" aria-hidden="true" loading="lazy" decoding="async" fetchpriority="low">
                <img class="tesvb-login__mascot tesvb-login__mascot--ingenieria-industrial" src="{{ asset('img/login/hurones/ingenieria-industrial.webp') }}"
                     width="193" height="259" alt="" aria-hidden="true" loading="lazy" decoding="async" fetchpriority="low">
                <img class="tesvb-login__mascot tesvb-login__mascot--ingenieria-mecatronica" src="{{ asset('img/login/hurones/ingenieria-mecatronica.webp') }}"
                     width="267" height="249" alt="" aria-hidden="true" loading="lazy" decoding="async" fetchpriority="low">
                <img class="tesvb-login__mascot tesvb-login__mascot--ingenieria-sistemas" src="{{ asset('img/login/hurones/ingenieria-sistemas.webp') }}"
                     width="285" height="240" alt="" aria-hidden="true" loading="lazy" decoding="async" fetchpriority="low">
                <img class="tesvb-login__mascot tesvb-login__mascot--turismo" src="{{ asset('img/login/hurones/turismo.webp') }}"
                     width="223" height="293" alt="" aria-hidden="true" loading="lazy" decoding="async" fetchpriority="low">
            </div>
        </div>

        <section class="tesvb-login__card" aria-labelledby="tesvb-login-title">
            <div class="tesvb-login__intro">
                <p class="tesvb-login__system">Sistema Integral TESVB</p>
                <h1 id="tesvb-login-title">Iniciar sesión</h1>
                <p class="tesvb-login__welcome">Ingresa con tu correo y contraseña.</p>
            </div>

            @if (session('status'))
                <div class="alert alert-success tesvb-login__notice" role="status">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('warning'))
                <div class="alert alert-warning tesvb-login__notice" role="alert">
                    {{ session('warning') }}
                </div>
            @endif

            <form class="tesvb-login__form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <div class="tesvb-login__field{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Correo electrónico</label>
                    <input id="email" type="email" class="form-control" name="email"
                           value="{{ old('email') }}" autocomplete="username" required autofocus
                           @if ($errors->has('email')) aria-invalid="true" aria-describedby="email-error" @endif>
                    @if ($errors->has('email'))
                        <p class="tesvb-login__error" id="email-error" role="alert">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>

                <div class="tesvb-login__field{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Contraseña</label>
                    <div class="tesvb-login__password">
                        <input id="password" type="password" class="form-control" name="password"
                               autocomplete="current-password" required
                               @if ($errors->has('password')) aria-invalid="true" aria-describedby="password-error" @endif>
                        <button type="button" class="tesvb-login__password-toggle" aria-label="Mostrar contraseña"
                                aria-controls="password" aria-pressed="false" hidden>
                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        </button>
                    </div>
                    @if ($errors->has('password'))
                        <p class="tesvb-login__error" id="password-error" role="alert">
                            {{ $errors->first('password') }}
                        </p>
                    @endif
                </div>

                <div class="tesvb-login__options">
                    <label class="tesvb-login__remember" for="remember">
                        <input id="remember" type="checkbox" name="remember" @checked(old('remember'))>
                        <span>Recordarme</span>
                    </label>
                    <a class="tesvb-login__recovery" href="{{ url('/password/reset') }}">¿Olvidaste tu contraseña?</a>
                </div>

                <button type="submit" class="btn btn-primary tesvb-login__submit">Entrar</button>
            </form>
        </section>
    </div>

    <section class="tesvb-login__privacy" aria-labelledby="tesvb-login-privacy-title">
        <h2 id="tesvb-login-privacy-title">Aviso de privacidad</h2>
        <p>El Tecnológico de Estudios Superiores de Valle de Bravo, comprometido con la protección de datos personales,
            prohíbe la distribución de información que se pudiera generar o recabar durante el uso del Sistema de Gestión Institucional,
            sin previo aviso a los titulares de los datos personales guardados dentro de este último.</p>
        <p>Usted puede conocer los términos y alcances de nuestros Avisos de Privacidad Integral en:</p>
        <a href="http://tesvb.edomex.gob.mx/proteccion-datos-personales">http://tesvb.edomex.gob.mx/proteccion-datos-personales</a>
    </section>
</main>

<div id="modal_guia" class="modal bs-example-modal-lg tesvb-login__guide" tabindex="-1" role="dialog" aria-labelledby="tesvb-login-guide-title" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar guía de registro"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title" id="tesvb-login-guide-title">Guía de registro</h2>
            </div>

            <div id="carousel-example-generic" class="carousel" data-interval="false" role="region" aria-label="Pasos para registrarse">
                <div class="carousel-inner" aria-live="polite">
                    <div class="item active">
                        <img src="{{ asset('img/1.png') }}" alt="Ubicación del enlace Registro en el menú público." loading="lazy" decoding="async">
                        <p>Si no eres usuario registrado, da clic en el botón Registro ubicado en la parte superior derecha.</p>
                    </div>
                    <div class="item">
                        <img src="{{ asset('img/2.png') }}" alt="Formulario de registro con correo, contraseña y tipo de usuario." loading="lazy" decoding="async">
                        <p>En el formulario de registro deberás ingresar tu correo, que será tu identificación de usuario, contraseña y el tipo de usuario.</p>
                    </div>
                    <div class="item">
                        <img src="{{ asset('img/3.png') }}" alt="Mensaje de verificación enviado al correo registrado." loading="lazy" decoding="async">
                        <p>El sistema enviará un enlace de autenticación al correo registrado para verificar al usuario.</p>
                    </div>
                    <div class="item">
                        <img src="{{ asset('img/4.png') }}" alt="Enlace de verificación que debe abrirse desde el correo electrónico." loading="lazy" decoding="async">
                        <p>Una vez que accedas a tu correo, selecciona el enlace y ábrelo en una nueva pestaña.</p>
                    </div>
                    <div class="item">
                        <img src="{{ asset('img/5.png') }}" alt="Formulario de datos correspondiente al tipo de usuario seleccionado." loading="lazy" decoding="async">
                        <p>Dependiendo del tipo de usuario que hayas seleccionado en el registro, aparecerá un formulario que deberás llenar con tus datos.</p>
                    </div>
                    <div class="item">
                        <img src="{{ asset('img/6.png') }}" alt="Indicaciones de acceso para usuarios registrados como empleados." loading="lazy" decoding="async">
                        <p>Si seleccionaste el tipo de usuario Empleado y concluiste el registro, podrás acceder al menú una vez que se te asigne como docente.</p>
                    </div>
                </div>

                <div class="tesvb-login__guide-controls">
                    <button type="button" data-target="#carousel-example-generic" data-slide="prev">Anterior</button>
                    <button type="button" data-target="#carousel-example-generic" data-slide="next">Siguiente</button>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<script>
(function () {
    var password = document.getElementById('password');
    var toggle = document.querySelector('.tesvb-login__password-toggle');
    var icon = toggle.querySelector('.glyphicon');

    function setPasswordVisibility(visible) {
        password.type = visible ? 'text' : 'password';
        toggle.setAttribute('aria-label', visible ? 'Ocultar contraseña' : 'Mostrar contraseña');
        toggle.setAttribute('aria-pressed', visible ? 'true' : 'false');
        icon.classList.toggle('glyphicon-eye-open', !visible);
        icon.classList.toggle('glyphicon-eye-close', visible);
    }

    setPasswordVisibility(false);
    toggle.hidden = false;
    toggle.addEventListener('click', function () {
        setPasswordVisibility(password.type === 'password');
    });
    window.addEventListener('pageshow', function () {
        setPasswordVisibility(false);
    });
})();
</script>
@endsection
