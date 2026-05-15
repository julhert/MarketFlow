<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    /** @use HasFactory<\Database\Factories\ComentarioFactory> */
    use HasFactory;

    protected $table = 'comentarios';

    protected $primaryKey = 'id_comentario';

    protected $fillable = [
        'id_user',
        'id_producto',
        'comentario',
    ];

    public function user()
    {
        // pertenece a un usuario (belongsTo)
        // En la tabla 'comentarios' se llama 'id_user'
        // En la tabla 'users' se llama 'id'
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function producto()
    {
        // pertenece a un producto (belongsTo)
        // En la tabla 'comentarios' se llama 'id_producto'
        // En la tabla 'productos' se llama 'id_producto'
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }

}
