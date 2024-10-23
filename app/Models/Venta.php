<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = ['monto', 'metodo_pago', 'fecha', 'usuario_id']; // Asegúrate de incluir 'usuario_id'

    // Relación con el modelo User
    public function usuario() // Cambia 'user' por 'usuario'
    {
        return $this->belongsTo(User::class, 'usuario_id'); // Especificamos el campo 'usuario_id'
    }
}

