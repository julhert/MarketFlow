<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    /** @use HasFactory<\Database\Factories\CarritoFactory> */
    use HasFactory;

    protected $table = 'carrito';

    protected $primaryKey = 'id_carrito';

    protected $fillable = [
        'id_producto',
        'id_user',
        'cantidad',
    ];

    public function user()
    {
        // pertenece a un usuario (belongsTo)
        // En la tabla 'carrito' se llama 'id_users'
        // En la tabla 'users' se llama 'id'
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function producto()
    {
        // un item del carrito pertenece a un producto (belongsTo)
        // En la tabla 'carrito' se llama 'id_producto'
        // En la tabla 'productos' se llama 'id_producto'
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}
