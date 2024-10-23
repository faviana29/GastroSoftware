<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Muestra el dashboard después del login.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            return redirect()->route('admin.index'); // Redirigir al dashboard del admin
        } elseif ($user->role == 'mesero') {
            return redirect()->route('mesero.index'); // Redirigir al dashboard del mesero
        }

        // En caso de otros roles o usuarios no autorizados
        return redirect('/home')->with('error', 'No tienes acceso');
    }
}
