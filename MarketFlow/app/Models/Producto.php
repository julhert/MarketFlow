<?php

namespace App\Models;

use App\Models\ImagenProducto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;

    protected $table = 'productos';

    protected $primaryKey = 'id_producto';

    protected $fillable = [
        'id_categoria',
        'id_user',
        'nombre',
        'descripcion',
        'stock',
        'precio',
        'activo',
    ];

    public function categoria()
    {
        // pertenece a una categoria (belongsTo)
        // En la tabla 'categorias' se llama 'id_categoria'
        // En esta tabla 'productos' se llama 'id_categoria'
        return $this->belongsTo(Categorias::class, 'id_categoria', 'id_categoria');
    }

    public function user()
    {
        // pertenece a un usuario (belongsTo)
        // En la tabla 'users' se llama 'id'
        // En esta tabla 'productos' se llama 'id_user'
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function imagenes()
    {
        // tiene muchas imagenes (hasMany)
        // En la tabla 'imagenes' se llama 'id_producto'
        // En esta tabla 'productos' se llama 'id_producto'
        return $this->hasMany(ImagenProducto::class, 'id_producto', 'id_producto');
    }

    public function portada()
    {
        // Trae solo una imagen donde portada sea true (1)
        return $this->hasOne(ImagenProducto::class, 'id_producto')->where('portada', 1);
    }
}
