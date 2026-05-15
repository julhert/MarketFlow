<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    // definir una sola imagen como portada por producto
    protected static function booted()
    {
        static::saving(function ($imagen) {
            // Si la imagen que se está guardando es portada...
            if ($imagen->portada) {
                // Ponemos todas las demás imágenes de ESTE producto en false
                static::where('id_producto', $imagen->id_producto)
                    ->where('id_imagen', '!=', $imagen->id_imagen)
                    ->update(['portada' => false]);
            }
        });
    }

    public function producto()
    {
        // Imagen pertenece a un producto
        // En la tabla 'imagenes' se llama 'id_producto'
        // En la tabla 'productos' se llama 'id_producto'
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }

    public function getUrlAttribute()
    {
        if (Str::startsWith($this->rutaImagen, 'http'))
        {
            return $this->rutaImagen;
        }

        if (Str::startsWith($this->rutaImagen, 'storage/'))
        {
            return asset($this->rutaImagen);
        }

        return asset('storage/' . $this->rutaImagen);
    }
}
