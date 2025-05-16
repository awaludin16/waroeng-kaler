<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'pesanan_id',
        'menu_id',
        'jumlah',
        'subtotal'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'pesanan_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
