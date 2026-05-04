<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    /** @use HasFactory<\Database\Factories\CategoriaFactory> */
    use HasFactory;

    protected $table = 'categorias';

    protected $primaryKey = 'id_categoria';

    protected $fillable = [
        'nombre',
        'descripcion',
        'activo',
    ];

    public function productos()
    {
        // tiene muchos productos (hasMany)
        // En la tabla 'productos' se llama 'id_categoria'
        // En esta tabla 'categorias' se llama 'id_categoria'
        return $this->hasMany(Productos::class, 'id_categoria', 'id_categoria');
    }
}
