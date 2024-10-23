<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $fillable = [
        'producto',
        'cantidad',
        'proveedor_id',
    ];

    /**
     * Relación de un inventario con su proveedor.
     */
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    /**
     * Relación de un inventario con los platillos que usan estos productos.
     */
    public function platillos()
    {
        return $this->hasMany(Platillo::class);
    }
}
