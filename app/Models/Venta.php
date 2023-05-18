<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';

    protected $fillable = [
        'producto_id',
        'cantidad',
        'total',
    ];

    public function product()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function item()
    {
        return $this->belongsTo(CartItem::class, 'cart_item_id');
    }
}
