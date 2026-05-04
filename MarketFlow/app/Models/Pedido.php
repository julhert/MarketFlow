<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    /** @use HasFactory<\Database\Factories\PedidoFactory> */
    use HasFactory;

    protected $table = 'pedidos';

    protected $primaryKey = 'id_pedido';

    protected $fillable = [
        'id_user',
        'id_direccion',
        'folio',
        'metodoPago',
        'totalCompra',
    ];

    public function user()
    {
        // pertenece a un usuario (belongsTo)
        // En la tabla 'pedidos' se llama 'id_user'
        // En la tabla 'users' se llama 'id'
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function direccion()
    {
        // pertenece a una direccion (belongsTo)
        // En la tabla 'pedidos' se llama 'id_direccion'
        // En la tabla 'direcciones' se llama 'id_direccion'
        return $this->belongsTo(Direcciones::class, 'id_direccion', 'id_direccion');
    }

    public function detallePedidos()
    {
        // tiene muchos detalles de pedido (productos) (hasMany)
        // En la tabla 'detalle_pedidos' se llama 'id_pedido'
        // En esta tabla 'pedidos' se llama 'id_pedido'
        return $this->hasMany(DetallePedido::class, 'id_pedido', 'id_pedido');
    }
}
