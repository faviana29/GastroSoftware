<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\MesaController;
use App\Models\Mesa;   

class AdminController extends Controller
{
    // Muestra el dashboard del admin
    public function index()
    {
        // Recuperamos todas las mesas desde la base de datos
        $mesas = Mesa::all();

        // Pasamos las mesas a la vista 'admin.dashboard'
        return view('admin.dashboard', compact('mesas'));
    }
    // Muestra el formulario para crear un nuevo usuario
    public function create()
    {
        return view('admin.create-user'); // Vista del formulario de creación de usuarios
    }

    // Guarda un nuevo usuario
    public function store(Request $request)
    {
        // Validar los datos ingresados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:mesero,admin', // Solo mesero o admin
        ]);

        // Crear un nuevo usuario
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hashear la contraseña
            'role' => $request->role, // Rol del usuario
        ]);

        return redirect()->route('admin.index')->with('status', 'Usuario creado exitosamente');
    }

    // Elimina un usuario (solo meseros pueden ser eliminados)
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->role == 'mesero') {
            $user->delete();
        }

        return redirect()->back()->with('status', 'Mesero eliminado exitosamente');
    }
}

