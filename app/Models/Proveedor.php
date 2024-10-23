<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores'; // Nombre de la tabla en plural correcto

    protected $fillable = [
        'nombre',
        'telefono',
        'email',
        'direccion',
    ];

    /**
     * Relación de un proveedor con el inventario que suministra.
     */
    public function inventarios()
    {
        return $this->hasMany(Inventario::class);
    }
}
