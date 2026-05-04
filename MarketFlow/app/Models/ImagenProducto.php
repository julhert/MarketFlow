<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenProducto extends Model
{
    /** @use HasFactory<\Database\Factories\ImagenProductoFactory> */
    use HasFactory;

    protected $table = 'imagen_productos';

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
