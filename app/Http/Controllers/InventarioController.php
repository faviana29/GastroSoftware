<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;

class InventarioController extends Controller
{
    // Muestra el inventario
    public function index()
    {
        $inventarios = Inventario::all(); // Obtener todos los productos en el inventario
        return view('admin.inventarios', compact('inventarios')); // Vista de inventarios
    }

    // Guarda un nuevo producto en el inventario
    public function store(Request $request)
    {
        // Validar los datos del inventario
        $request->validate([
            'producto' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1',
        ]);

        // Crear un nuevo producto en el inventario
        Inventario::create([
            'producto' => $request->producto,
            'cantidad' => $request->cantidad,
        ]);

        return redirect()->back()->with('status', 'Producto agregado al inventario');
    }
}
