<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\Calle;
use App\Models\Semaforo;
use App\Models\Rol;
use App\Models\TipoCalle;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Métodos para gestionar usuarios
    public function indexUsuarios()
    {
        $usuarios = Usuario::with('rol')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function createUsuario()
    {
        $roles = Rol::all();
        return view('admin.usuarios.create', compact('roles'));
    }

    public function storeUsuario(Request $request)
    {
        $request->validate([
            'nombre_usuario' => 'required|unique:usuario',
            'contrasena' => 'required|min:6',
            'id_rol' => 'required|exists:rol,id_rol',
        ]);

        Usuario::create([
            'nombre_usuario' => $request->nombre_usuario,
            'contrasena' => bcrypt($request->contrasena),
            'id_rol' => $request->id_rol,
        ]);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    public function editUsuario($id)
    {
        $usuario = Usuario::findOrFail($id);
        $roles = Rol::all();
        return view('admin.usuarios.edit', compact('usuario', 'roles'));
    }

    public function updateUsuario(Request $request, $id)
    {
        $request->validate([
            'nombre_usuario' => 'required|unique:usuario,nombre_usuario,' . $id . ',id_usuario',
            'contrasena' => 'nullable|min:6',
            'id_rol' => 'required|exists:rol,id_rol',
        ]);

        $usuario = Usuario::findOrFail($id);
        $usuario->nombre_usuario = $request->nombre_usuario;
        if ($request->contrasena) {
            $usuario->contrasena = bcrypt($request->contrasena);
        }
        $usuario->id_rol = $request->id_rol;
        $usuario->save();

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroyUsuario($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }

    // Métodos para gestionar calles
    public function indexCalles()
    {
        $calles = Calle::with('tipoCalle')->get();
        return view('admin.calles.index', compact('calles'));
    }

    public function createCalle()
    {
        $tiposCalle = TipoCalle::all();
        return view('admin.calles.create', compact('tiposCalle'));
    }

    public function storeCalle(Request $request)
    {
        $request->validate([
            'nombre_calle' => 'required',
            'id_tipo_calle' => 'required|exists:tipo_calle,id_tipo_calle',
        ]);

        Calle::create($request->all());

        return redirect()->route('admin.calles.index')->with('success', 'Calle creada correctamente.');
    }

    public function editCalle($id)
    {
        $calle = Calle::findOrFail($id);
        $tiposCalle = TipoCalle::all();
        return view('admin.calles.edit', compact('calle', 'tiposCalle'));
    }

    public function updateCalle(Request $request, $id)
    {
        $request->validate([
            'nombre_calle' => 'required',
            'id_tipo_calle' => 'required|exists:tipo_calle,id_tipo_calle',
        ]);

        $calle = Calle::findOrFail($id);
        $calle->update($request->all());

        return redirect()->route('admin.calles.index')->with('success', 'Calle actualizada correctamente.');
    }

    public function destroyCalle($id)
    {
        $calle = Calle::findOrFail($id);
        $calle->delete();

        return redirect()->route('admin.calles.index')->with('success', 'Calle eliminada correctamente.');
    }

    // Métodos para gestionar semáforos
    public function indexSemaforos()
    {
        $semaforos = Semaforo::with('calle')->get();
        return view('admin.semaforos.index', compact('semaforos'));
    }

    public function createSemaforo()
    {
        $calles = Calle::all();
        return view('admin.semaforos.create', compact('calles'));
    }

    public function storeSemaforo(Request $request)
    {
        $request->validate([
            'id_calle' => 'required|exists:calle,id_calle',
            'tiempo_verde' => 'required|integer|min:1',
            'tiempo_amarillo' => 'required|integer|min:1',
            'tiempo_rojo' => 'required|integer|min:1',
        ]);

        Semaforo::create($request->all());

        return redirect()->route('admin.semaforos.index')->with('success', 'Semáforo creado correctamente.');
    }

    public function editSemaforo($id)
    {
        $semaforo = Semaforo::findOrFail($id);
        $calles = Calle::all();
        return view('admin.semaforos.edit', compact('semaforo', 'calles'));
    }

    public function updateSemaforo(Request $request, $id)
    {
        $request->validate([
            'id_calle' => 'required|exists:calle,id_calle',
            'tiempo_verde' => 'required|integer|min:1',
            'tiempo_amarillo' => 'required|integer|min:1',
            'tiempo_rojo' => 'required|integer|min:1',
        ]);

        $semaforo = Semaforo::findOrFail($id);
        $semaforo->update($request->all());

        return redirect()->route('admin.semaforos.index')->with('success', 'Semáforo actualizado correctamente.');
    }

    public function destroySemaforo($id)
    {
        $semaforo = Semaforo::findOrFail($id);
        $semaforo->delete();

        return redirect()->route('admin.semaforos.index')->with('success', 'Semáforo eliminado correctamente.');
    }
}