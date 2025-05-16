<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableCafe extends Model
{
    protected $table = 'tables'; // paksa ke nama tabel asli

    protected $fillable = [
        'nomor_meja',
        'qr_code'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'meja_id');
    }
}
