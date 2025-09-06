<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Iniciar Sesión') }} - {{ config('app.name', 'GestorFinanzas') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('components.navbar')
    <div class="auth-container d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-6">
                    <div class="card auth-card">
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                <h1 class="h4 text-gray-900 mb-2">¡Bienvenido de nuevo!</h1>
                                <p class="text-muted">Inicia sesión en tu cuenta</p>
                            </div>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email Address -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                                    @error('email')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                                    <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password">
                                    @error('password')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Remember Me -->
                                <div class="mb-3 form-check">
                                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                    <label for="remember_me" class="form-check-label">
                                        {{ __('Recordarme') }}
                                    </label>
                                </div>

                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    @if (Route::has('password.request'))
                                        <a class="text-decoration-none small" href="{{ route('password.request') }}">
                                            {{ __('¿Olvidaste tu contraseña?') }}
                                        </a>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary w-100 mb-3">
                                    {{ __('Iniciar Sesión') }}
                                </button>

                                <div class="text-center">
                                    <span class="text-muted">¿No tienes cuenta? </span>
                                    <a href="{{ route('register') }}" class="text-decoration-none">
                                        {{ __('Regístrate') }}
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
