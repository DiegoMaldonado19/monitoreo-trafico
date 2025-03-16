<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nombre_usuario' => 'required',
            'contrasena' => 'required',
        ]);

        $usuario = Usuario::where('nombre_usuario', $request->nombre_usuario)->first();

        if ($usuario && Hash::check($request->contrasena, $usuario->contrasena)) {
            auth()->login($usuario);

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

        return redirect()->route('login')->withErrors(['error' => 'Credenciales incorrectas.']);
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}