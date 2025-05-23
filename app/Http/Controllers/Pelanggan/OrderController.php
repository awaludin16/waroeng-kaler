<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'meja_id' => 'required|exists:meja,id',
            'items' => 'required|array',
            'items.*.menu_id' => 'required|exists:menu,id',
            'items.*.jumlah' => 'required|integer|min:1'
        ]);

        DB::beginTransaction();
        try {
            $pesanan = Order::create([
                'nama_pelanggan' => $request->nama_pelanggan,
                'meja_id' => $request->meja_id,
                'status' => 'menunggu'
            ]);

            foreach ($request->items as $item) {
                OrderItem::create([
                    'pesanan_id' => $pesanan->id,
                    'menu_id' => $item['menu_id'],
                    'jumlah' => $item['jumlah']
                ]);
            }

            DB::commit();
            return redirect()->route('pelanggan.menu', $pesanan->meja->qr_code)
                ->with('success', 'Pesanan berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors('Terjadi kesalahan. Silakan coba lagi.');
        }
    }
}
