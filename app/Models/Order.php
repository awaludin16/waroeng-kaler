<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'meja_id',
        'nama_pelanggan',
        'tanggal_pesanan',
        'total_harga',
        'status'
    ];

    public function table()
    {
        return $this->belongsTo(TableCafe::class, 'meja_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'pesanan_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'pesanan_id');
    }
}
