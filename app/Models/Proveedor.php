<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    /** @use HasFactory<\Database\Factories\ProveedorFactory> */
    use HasFactory;

    protected $table = 'proveedors';
    
    protected $fillable = [
        'empresa',
        'direccion',
        'nombre',
        'telefono',
        'email',
    ];

    public function lotes()
    {
        return $this->hasMany(Lote::class);
    }

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }
}
