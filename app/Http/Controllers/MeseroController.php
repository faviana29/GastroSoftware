<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 


class MeseroController extends Controller
{
    public function index()
    {
        // Obtener todos los usuarios con el rol 'mesero'
        $meseros = User::where('role', 'mesero')->get();
        
        // Enviar la variable $meseros a la vista 'create-user'
        return view('admin.create-user', compact('meseros'));
    }
    
    

    public function edit(User $mesero)
    {
        return view('admin.meseros.edit', compact('mesero')); // Muestra el formulario de edición
    }

    public function update(Request $request, User $mesero)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $mesero->id,
        ]);

        $mesero->update($request->only(['name', 'email']));
        return redirect()->route('meseros.index')->with('success', 'Mesero actualizado correctamente');
    }

    public function destroy(User $mesero)
    {
        $mesero->delete();
        return redirect()->route('meseros.index')->with('success', 'Mesero eliminado correctamente');
    }

 
 public function create()
    {
        // Obtener todos los usuarios
        $usuarios = User::all(); // Cambia a este si quieres todos los usuarios
    
        // Enviar la variable $usuarios a la vista 'user-create'
        return view('admin.user-create', compact('usuarios'));
    }
    
    public function store(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string',
        ]);
    
        // Crear el nuevo usuario
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);
    
        return redirect()->route('meseros.create')->with('success', 'Mesero creado correctamente');
    }
    
}
