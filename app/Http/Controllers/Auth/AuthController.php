<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

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
        // Validar los datos del formulario
        $request->validate([
            'nombre_usuario' => 'required',
            'contrasena' => 'required',
        ]);

        // Buscar al usuario en la base de datos
        $usuario = Usuario::where('nombre_usuario', $request->nombre_usuario)->first();

        // Verificar si el usuario existe y la contraseña es correcta
        if ($usuario && Hash::check($request->contrasena, $usuario->contrasena)) {
            // Autenticar al usuario manualmente
            auth()->login($usuario);

            // Redirigir según el rol
            switch ($usuario->rol->nombre_rol) {
                case 'Administrador':
                    return redirect()->route('admin.usuarios.index');
                case 'Monitor':
                    return redirect()->route('monitor.flujo-vehicular.index');
                case 'Supervisor':
                    return redirect()->route('supervisor.reportes.index');
                default:
                    return redirect()->route('login')->withErrors(['error' => 'Rol no válido.']);
            }
        }

        // Si la autenticación falla, redirigir al login con un mensaje de error
        return redirect()->route('login')->withErrors(['error' => 'Credenciales incorrectas.']);
    }

    // Cerrar sesión
    public function logout()
    {
        // Cerrar la sesión manualmente
        auth()->logout();

        // Redirigir al login
        return redirect()->route('login');
    }
}