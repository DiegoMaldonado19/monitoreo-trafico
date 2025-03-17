<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Monitoreo de Tráfico')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="container">
                <a href="{{ url('/') }}" class="navbar-brand">Monitoreo de Tráfico</a>
                <div class="navbar-links">
                    @auth
                        <a href="{{ route('dashboard') }}">Dashboard</a>

                        <!-- Enlaces según el rol -->
                        @if (auth()->user()->rol->nombre_rol === 'Administrador')
                            <a href="{{ route('admin.usuarios.index') }}">Usuarios</a>
                            <a href="{{ route('admin.calles.index') }}">Calles</a>
                            <a href="{{ route('admin.semaforos.index') }}">Semáforos</a>
                        @elseif (auth()->user()->rol->nombre_rol === 'Monitor')
                            <a href="{{ route('monitor.pruebas.index') }}">Pruebas</a>
                        @elseif (auth()->user()->rol->nombre_rol === 'Supervisor')
                            <a href="{{ route('supervisor.reportes.index') }}">Reportes</a>
                        @endif

                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn-logout">Cerrar Sesión</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <main class="container">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Sistema de Monitoreo de Tráfico</p>
        </div>
    </footer>
</body>
</html>