<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'pesanan_id',
        'metode_pembayaran',
        'status_pembayaran',
        'total_bayar',
        'waktu_bayar'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'pesanan_id');
    }
}
