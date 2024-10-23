<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Platillo extends Model
{
    protected $fillable = [
        'nombre',
        'precio',
        'inventario_id',
    ];

    /**
     * Relación de un platillo con su inventario.
     */
    public function inventario()
    {
        return $this->belongsTo(Inventario::class);
    }

    /**
     * Relación de un platillo con los pedidos que lo contienen.
     */
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
