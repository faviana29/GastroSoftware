<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;

class ProveedorController extends Controller
{
    // Muestra los proveedores
    public function index()
    {
        $proveedores = Proveedor::all(); // O tu lógica para obtener los proveedores
        return view('admin.proveedor', compact('proveedores'));
    }
    

    // Guarda un nuevo proveedor
    public function store(Request $request)
    {
        // Validar los datos del proveedor
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
        ]);

        // Crear un nuevo proveedor
        Proveedor::create($request->all());

        return redirect()->back()->with('status', 'Proveedor agregado exitosamente');
    }

    public function destroy($id)
{
    $proveedor = Proveedor::findOrFail($id);
    $proveedor->delete();

    return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado correctamente.');
}

public function edit($id)
{
    $proveedor = Proveedor::findOrFail($id);
    return response()->json($proveedor);
}
public function update(Request $request, $id)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'telefono' => 'required|string|max:15',
        'email' => 'required|email|max:255',
    ]);

    $proveedor = Proveedor::findOrFail($id);
    $proveedor->update($request->all());

    return response()->json($proveedor);
}
public function create()
{
    return view('admin.proveedor_create'); // La vista donde estará el formulario para agregar un proveedor
}
}
