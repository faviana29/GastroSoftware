<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'usuario_id',
        'mesa_id',
        'platillo_id',
        'cantidad',
        'total',
        'estado',
    ];

    /**
     * Relación de un pedido con el usuario (mesero o admin) que lo realizó.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación de un pedido con la mesa en la que se realizó.
     */
    public function mesa()
    {
        return $this->belongsTo(Mesa::class);
    }

    /**
     * Relación de un pedido con el platillo ordenado.
     */
    public function platillo()
    {
        return $this->belongsTo(Platillo::class);
    }
}
