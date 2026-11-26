@extends('layouts.panel')
@section('title', 'Verificar correo electrónico')
@section('content')
<div class="tw:mx-auto tw:max-w-lg tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-6 tw:dark:border-gray-800 tw:dark:bg-gray-900" data-panel-auth>
    <div class="tw:mb-4 tw:text-sm tw:text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="tw:mb-4 tw:font-medium tw:text-sm tw:text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="tw:mt-4 tw:flex tw:items-center tw:justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="tw:underline tw:text-sm tw:text-gray-600 tw:hover:text-gray-900 tw:rounded-md tw:focus:outline-none tw:focus:ring-2 tw:focus:ring-offset-2 tw:focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</div>
@endsection
