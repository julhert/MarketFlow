<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    /** @use HasFactory<\Database\Factories\DireccionFactory> */
    use HasFactory;

    protected $table = 'direcciones';

    protected $primaryKey = 'id_direccion';

    protected $fillable = [
        'id_user',
        'ciudad',
        'calle',
        'codigo_postal',
        'numero_interior',
        'numero_exterior',
        'estado',
        'colonia',
        'refencias',
    ];

    public function user()
    {
        // pertenece a un usuario (belongsTo)
        // En la tabla 'direccion' se llama 'id_user'
        // En la tabla 'users' se llama 'id'
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function pedidos()
    {
        // tiene muchos pedidos (hasMany)
        // En la tabla 'pedidos' se llama 'id_direccion'
        // En esta tabla 'direccion' se llama 'id_direccion'
        return $this->hasMany(Pedidos::class, 'id_direccion', 'id_direccion');
    }
}
