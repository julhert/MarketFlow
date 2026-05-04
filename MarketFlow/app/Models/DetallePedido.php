<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    /** @use HasFactory<\Database\Factories\DetallePedidoFactory> */
    use HasFactory;

    protected $table = 'detalle_pedidos';

    protected $primaryKey = 'id_detalle_pedido';

    protected $fillable = [
        'id_pedido',
        'id_producto',
        'cantidad',
        'precio_unitario',
    ];

    public function pedido()
    {
        // pertenece a un pedido (belongsTo)
        // En la tabla 'detalle_pedido' se llama 'id_pedido'
        // En la tabla 'pedido' se llama 'id_pedido'
        return $this->belongsTo(Pedidos::class, 'id_pedido', 'id_pedido');
    }
}
