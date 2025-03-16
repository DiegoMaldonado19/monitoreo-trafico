<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Calle;
use App\Models\Semaforo;
use App\Models\Rol;

class AdminController extends Controller
{
    // Mostrar lista de usuarios
    public function indexUsuarios()
    {
        $usuarios = Usuario::with('rol')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    // Crear un nuevo usuario
    public function createUsuario()
    {
        $roles = Rol::all();
        return view('admin.usuarios.create', compact('roles'));
    }

    // Guardar un nuevo usuario
    public function storeUsuario(Request $request)
    {
        $request->validate([
            'nombre_usuario' => 'required|unique:usuario',
            'contrasena' => 'required',
            'id_rol' => 'required|exists:rol,id_rol',
        ]);

        Usuario::create($request->all());
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creado correctamente');
    }

    // Mostrar lista de calles
    public function indexCalles()
    {
        $calles = Calle::with('tipoCalle')->get();
        return view('admin.calles.index', compact('calles'));
    }

    // Crear una nueva calle
    public function createCalle()
    {
        $tiposCalle = TipoCalle::all();
        return view('admin.calles.create', compact('tiposCalle'));
    }

    // Guardar una nueva calle
    public function storeCalle(Request $request)
    {
        $request->validate([
            'nombre_calle' => 'required',
            'id_tipo_calle' => 'required|exists:tipo_calle,id_tipo_calle',
        ]);

        Calle::create($request->all());
        return redirect()->route('admin.calles.index')->with('success', 'Calle creada correctamente');
    }

    // Mostrar lista de semáforos
    public function indexSemaforos()
    {
        $semaforos = Semaforo::with('calle')->get();
        return view('admin.semaforos.index', compact('semaforos'));
    }

    // Crear un nuevo semáforo
    public function createSemaforo()
    {
        $calles = Calle::all();
        return view('admin.semaforos.create', compact('calles'));
    }

    // Guardar un nuevo semáforo
    public function storeSemaforo(Request $request)
    {
        $request->validate([
            'id_calle' => 'required|exists:calle,id_calle',
            'tiempo_verde' => 'required|integer',
            'tiempo_amarillo' => 'required|integer',
            'tiempo_rojo' => 'required|integer',
        ]);

        Semaforo::create($request->all());
        return redirect()->route('admin.semaforos.index')->with('success', 'Semáforo creado correctamente');
    }
}
