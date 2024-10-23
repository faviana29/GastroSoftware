<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use Illuminate\Http\Request;

class MesaController extends Controller
{
    // Muestra todas las mesas
    public function index()
    {
        // Obtener todas las mesas de la base de datos
        $mesas = Mesa::all();

        // Pasar las mesas a la vista
        return view('admin.dashboard', compact('mesas'));
    }

    // Crear una nueva mesa
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'numero' => 'required',
            'estado' => 'required',
        ]);

        // Crear la nueva mesa
        Mesa::create($request->all());

        return redirect()->back()->with('success', 'Mesa creada con éxito');
    }
}
