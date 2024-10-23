<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;

class PedidoController extends Controller
{
    public function guardarVenta(Request $request)
    {
        // Obtener el usuario autenticado
        $usuario = auth()->user();

        // Guardar la venta
        $venta = new Venta();
        $venta->usuario_id = $usuario->id; // Quién tomó el pedido
        $venta->total = 100; // Aquí puedes calcular el total real basado en los pedidos
        $venta->metodo_pago = $request->input('metodo_pago'); // Método de pago seleccionado
        $venta->save();

        return redirect()->back()->with('status', 'Venta registrada correctamente');
    }
}
