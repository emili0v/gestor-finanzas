<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GestorFinanzas') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- User Sidebar -->
    <nav class="sidebar">
        <div class="p-3">
            <h4 class="text-primary fw-bold mb-4">GestorFinanzas</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('app.mi-sueldo') ? 'active' : '' }}" href="{{ route('app.mi-sueldo') }}">
                        <i class="bi bi-cash-coin me-2"></i>
                        Mi Sueldo
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('app.historial') ? 'active' : '' }}" href="{{ route('app.historial') }}">
                        <i class="bi bi-clock-history me-2"></i>
                        Historial
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('app.gastos.*') ? 'active' : '' }}" href="{{ route('app.gastos') }}">
                        <i class="bi bi-receipt me-2"></i>
                        Mis Gastos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('app.metas') ? 'active' : '' }}" href="{{ route('app.metas') }}">
                        <i class="bi bi-target me-2"></i>
                        Metas de Ahorro
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('app.perfil') ? 'active' : '' }}" href="{{ route('app.perfil') }}">
                        <i class="bi bi-person me-2"></i>
                        Perfil
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                            <i class="bi bi-box-arrow-right me-2"></i>
                            Cerrar Sesión
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>
</body>
</html>
