<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'cantidad',
        'proveedor_id'
    ];

    public function proveedor(){
        return $this->belongsTo(Proveedor::class);
    }
}
