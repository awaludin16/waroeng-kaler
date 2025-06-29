<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\TableCafe as Meja;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function form($nomor_meja)
    {
        $cartKey = "cart_$nomor_meja";
        $cart = session()->get($cartKey, []);

        if (empty($cart)) {
            return redirect()->route('pelanggan.menu', $nomor_meja)
                ->with('error', 'Keranjang kosong.');
        }

        $meja = Meja::where('nomor_meja', $nomor_meja)->firstOrFail();

        $menuIds = array_keys($cart);
        $menus = Menu::whereIn('id', $menuIds)->get();

        return view('pelanggan.order', compact('menus', 'cart', 'meja'));
    }

    public function store(Request $request, $nomor_meja)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'payment_method' => 'required|string'
        ]);

        $cartKey = "cart_$nomor_meja";
        $cart = session()->get($cartKey, []);

        if (empty($cart)) {
            return redirect()->route('pelanggan.menu', $nomor_meja)
                ->with('error', 'Keranjang tidak ditemukan.');
        }

        $meja = Meja::where('nomor_meja', $nomor_meja)->firstOrFail();

        $order = Order::create([
            'meja_id' => $meja->id,
            'nama_pelanggan' => $request->nama_pelanggan,
            'tanggal_pesanan' => now(),
            'total_harga' => 0,
            'status' => 'Pending',
        ]);

        $total = 0;

        foreach ($cart as $menuId => $item) {
            $menu = Menu::findOrFail($menuId);
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
        session()->forget("cart_$nomor_meja");

        if ($request->payment_method === 'Pembayaran Online') {
            return redirect()->route('payment.xendit', $order->id);
        } else {
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
        return view('pelanggan.order-detail', compact('order'));
    }
}
