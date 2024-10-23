<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    protected $fillable = [
        'numero_mesa',
        'estado', // Estado de la mesa: libre, ocupada, etc.
    ];

    /**
     * Relación de una mesa con los pedidos que se realizan en ella.
     */
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
