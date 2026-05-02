<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'Activo'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function productos()
    {
        // tiene muchos productos (hasMany)
        // En la tabla 'productos' se llama 'id_user'
        // En esta tabla 'users' se llama 'id'
        return $this->hasMany(Productos::class, 'id_user', 'id');
    }

    public function pedidos()
    {
        // tiene muchos pedidos (hasMany)
        // En la tabla 'pedidos' se llama 'id_user'
        // En esta tabla 'users' se llama 'id'
        return $this->hasMany(Pedidos::class, 'id_user', 'id');
    }

    public function direcciones()
    {
        // tiene muchas direcciones (hasMany)
        // En la tabla 'pedidos' se llama 'id_user'
        // En esta tabla 'users' se llama 'id'
        return $this->hasMany(Direcciones::class, 'id_user', 'id');
    }
}
