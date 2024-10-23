<?php

namespace App\Http\Controllers;

use App\Models\Venta; // Asegúrate de importar tu modelo de Venta
use Illuminate\Http\Request;

class VentaController extends Controller
{
    // Método para mostrar todas las ventas
    public function index()
    {
        // Obtener todas las ventas con el usuario que las realizó
        $ventas = Venta::with('usuario')->get(); // Cargar la relación 'usuario'
    
        // Inicializar totales
        $totalEfectivo = 0;
        $totalDebito = 0;
        $totalTransferencia = 0;
    
        // Calcular totales por método de pago
        foreach ($ventas as $venta) {
            if ($venta->metodo_pago === 'efectivo') {
                $totalEfectivo += $venta->monto;
            } elseif ($venta->metodo_pago === 'debito') {
                $totalDebito += $venta->monto;
            } elseif ($venta->metodo_pago === 'transferencia') {
                $totalTransferencia += $venta->monto;
            }
        }
    
        // Pasar las ventas y los totales a la vista
        return view('admin.ventas', compact('ventas', 'totalEfectivo', 'totalDebito', 'totalTransferencia'));
    }
    

    // Método para cuadrar caja (puedes implementarlo según tu lógica)
    public function cuadrarCaja(Request $request)
    {
        // Aquí puedes implementar la lógica para cuadrar caja
        // Por ejemplo, podrías registrar la cantidad en caja o cualquier otra lógica necesaria

        return redirect()->route('ventas.index')->with('success', 'Caja cuadrada con éxito');
    }
}
