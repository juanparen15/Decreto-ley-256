@extends('voyager::auth.master')
@section('content')
    <a class="navbar-brand" href="{{ route('voyager.dashboard') }}">
        <div class="logo-icon-container">
            <?php $admin_logo_img = Voyager::setting('admin.icon_image', ''); ?>
            @if ($admin_logo_img == '')
                <img src="{{ voyager_asset('images/logo-icon-light.png') }}" alt="Logo Icon">
            @else
                <img src="{{ Voyager::image($admin_logo_img) }}" alt="Logo Icon">
            @endif
        </div>
    </a>
    <div class="login-container">
        <x-guest-layout>
            <x-authentication-card>
                {{-- <x-slot name="logo">
                    <x-authentication-card-logo />
                </x-slot> --}}

                <div class="mb-4 text-sm text-gray-600">
                    {{ __('¿Olvidaste tu contraseña? Simplemente háganos saber tu número de identificación y le enviaremos un enlace para restablecer su contraseña que le permitirá elegir una nueva.') }}
                </div>

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="block">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                            required autofocus autocomplete="username" />
                        {{-- <x-label for="username" value="{{ __('Numero de Identificación') }}" />
                        <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')"
                            required autofocus autocomplete="username" pattern="[0-9]*"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" /> --}}
                    </div>

                    <div class="mt-4">
                        <x-button>
                            {{ __('Restablecer contraseña') }}
                        </x-button>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        {{-- <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            href="{{ route('login') }}">
                            {{ __('Iniciar Sesión') }}
                        </a> --}}

                        @if (Route::has('login'))
                            <a href="{{ route('login') }}"
                                class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Iniciar Sesión</a>
                        @endif
                    </div>
                </form>
            </x-authentication-card>
        </x-guest-layout>
    </div> <!-- .login-container -->
@endsection
