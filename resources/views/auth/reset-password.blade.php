@extends('layouts.panel')
@section('title', 'Crear nueva contraseña')
@section('content')
<div class="tw:mx-auto tw:max-w-lg tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-6 tw:dark:border-gray-800 tw:dark:bg-gray-900" data-panel-auth>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="tw:block tw:mt-1 tw:w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="tw:mt-2" />
        </div>

        <!-- Password -->
        <div class="tw:mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="tw:block tw:mt-1 tw:w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="tw:mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="tw:mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="tw:block tw:mt-1 tw:w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="tw:mt-2" />
        </div>

        <div class="tw:flex tw:items-center tw:justify-end tw:mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</div>
@endsection
