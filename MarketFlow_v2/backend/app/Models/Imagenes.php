<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagenes extends Model
{
    /** @use HasFactory<\Database\Factories\ImagenesFactory> */
    use HasFactory;

    protected $table = 'imagenes';

    protected $primaryKey = 'id_imagen';

    protected $fillable = [
        'id_producto',
        'portada',
        'rutaImagen',
    ];

    public function producto()
    {
        // Imagen pertenece a un producto
        // En la tabla 'imagenes' se llama 'id_producto'
        // En la tabla 'productos' se llama 'id_producto'
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}
