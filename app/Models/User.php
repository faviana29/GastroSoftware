<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Agregamos el rol a los atributos asignables
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relación de un usuario (admin o mesero) con los pedidos que ha realizado.
     */
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    /**
     * Relación de un usuario (admin o mesero) con las ventas que ha realizado.
     */
    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }

    /**
     * Método para verificar si el usuario es un admin.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Método para verificar si el usuario es un mesero.
     */
    public function isMesero()
    {
        return $this->role === 'mesero';
    }
}
