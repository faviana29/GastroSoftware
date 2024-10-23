<?php

namespace App\Http\Controllers;

use App\Models\Platillo; // Asegúrate de importar tu modelo de Platillo
use Illuminate\Http\Request;

class PlatilloController extends Controller
{
    // Método para mostrar todos los platillos
    public function index(Request $request)
    {
        // Obtener el término de búsqueda si existe
        $search = $request->input('search');
    
        // Filtrar platillos por nombre si se proporciona un término de búsqueda
        $platillos = Platillo::when($search, function ($query, $search) {
            return $query->where('nombre', 'like', '%' . $search . '%');
        })->get();
    
        return view('admin.platillos', compact('platillos', 'search'));
    }
    

    // Método para crear un nuevo platillo
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
        ]);

        Platillo::create($request->all()); // Crear el platillo
        return redirect()->route('platillos.index')->with('success', 'Platillo creado con éxito');
    }

    // Método para editar un platillo
    public function edit($id)
    {
        $platillo = Platillo::findOrFail($id);
        return response()->json($platillo); // Devuelve el platillo para editar
    }

    // Método para actualizar un platillo
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
        ]);
    
        $platillo = Platillo::findOrFail($id);
        $platillo->update($request->all());
    
        return response()->json($platillo);
    }
    
    // Método para eliminar un platillo
    public function destroy($id)
    {
        $platillo = Platillo::findOrFail($id);
        $platillo->delete(); // Eliminar el platillo
        return redirect()->route('platillos.index')->with('success', 'Platillo eliminado con éxito');
    }
}
