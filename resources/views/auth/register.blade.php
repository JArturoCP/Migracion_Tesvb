@extends('layouts.panel')
@include('partials.panel.recursos_app')
@section('title', 'Registro TESVB')
@section('content')
<div class="tw:w-full">
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-8/12 tw:lg:ml-[16.6667%] tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">Registro</div>
                <div class="tw:p-5 tw:sm:p-6">
                    <form class="" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                   <!-- <div class="tw:mb-4 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="tw:w-full tw:lg:w-4/12 tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:px-2">Nombre de usuario</label>

                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                <input id="name" type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="tw:mt-1 tw:block tw:text-xs tw:text-gray-500">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->

                        <div class="tw:mb-4 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="tw:w-full tw:lg:w-4/12 tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:px-2">Correo electrónico</label>

                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                <input id="email" type="email" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="email" value="{{ old('email') }}" required>

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
                            <label for="password-confirm" class="tw:w-full tw:lg:w-4/12 tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:px-2">Confirmar contraseña</label>

                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                <input id="password-confirm" type="password" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="password_confirmation" required>
                            </div>
                        </div>



                        <div class="tw:mb-4">
                            <div class="tw:w-full tw:lg:w-6/12 tw:lg:ml-[33.3333%] tw:px-2">
                                <button type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
