<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\TableCafe as Meja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function form()
    {
        $cart = session('cart', []);
        $nomorMeja = session('nomor_meja');


        if (!$nomorMeja || empty($cart)) {
            return redirect()->route('pelanggan.menu', $nomorMeja)->with('error', 'Keranjang kosong atau nomor meja tidak ditemukan.');
        } else {
            $meja = Meja::where('nomor_meja', $nomorMeja)->firstOrFail();
        }

        $menuIds = array_keys($cart);
        $menus = Menu::whereIn('id', $menuIds)->get();

        return view('pelanggan.order', compact('menus', 'cart', 'meja'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'payment_method' => 'required|string'
        ]);

        $cart = session('cart', []);
        $nomorMeja = session('nomor_meja');

        if (!$nomorMeja || empty($cart)) {
            return redirect()->route('pelanggan.menu')->with('error', 'Nomor meja atau keranjang tidak ditemukan.');
        }

        $meja = Meja::where('nomor_meja', $nomorMeja)->firstOrFail();

        $order = Order::create([
            'meja_id' => $meja->id,
            'nama_pelanggan' => $request->nama_pelanggan,
            'tanggal_pesanan' => now(),
            'total_harga' => 0, // akan dihitung di bawah
            'status' => 'Pending',
        ]);

        $total = 0;

        foreach ($cart as $menuId => $item) {
            $menu = Menu::query()->findOrFail($menuId);
            $quantity = $item['quantity'];
            $subtotal = $menu->harga * $quantity;

            $order->items()->create([
                'pesanan_id' => $order->id,
                'menu_id' => $menu->id,
                'jumlah' => $quantity,
                'subtotal' => $subtotal,
            ]);

            $total += $subtotal;
        }

        $order->update(['total_harga' => $total]);

        session()->forget('cart'); // bersihkan keranjang

        // 🚀 Arahkan ke Xendit jika metode pembayaran online
        if ($request->payment_method === 'Pembayaran Online') {
            return redirect()->route('payment.xendit', $order->id);
        } else {
            // Simpan data pembayaran
            $order->payment()->create([
                'pesanan_id' => $order->id,
                'waktu_bayar' => null,
                'metode_pembayaran' => $request->payment_method,
                'total_bayar' => $order->total_harga,
                'status' => 'Pending'
            ]);
        }

        return redirect()->route('order.detail', $order->id)->with('success', 'Pesanan berhasil dibuat.');
    }


    public function showDetail($id)
    {
        $order = Order::with(['items.menu', 'table', 'payment'])->findOrFail($id);
        $payment = $order->payment;

        return view('pelanggan.order-detail', compact('order'));
    }
}
