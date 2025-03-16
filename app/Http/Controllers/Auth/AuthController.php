<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class AuthController extends Controller
{
    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesar el login
    public function login(Request $request)
    {
        $credentials = $request->only('nombre_usuario', 'contrasena');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $rol = $user->rol->nombre_rol;

            // Redirección basada en el rol
            switch ($rol) {
                case 'Administrador':
                    return redirect()->route('admin.dashboard');
                case 'Monitor':
                    return redirect()->route('monitor.dashboard');
                case 'Supervisor':
                    return redirect()->route('supervisor.dashboard');
                default:
                    return redirect()->route('login')->withErrors(['error' => 'Rol no válido']);
            }
        }

        return redirect()->route('login')->withErrors(['error' => 'Credenciales incorrectas']);
    }

    // Cerrar sesión
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
