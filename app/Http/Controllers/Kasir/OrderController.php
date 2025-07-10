<?php

namespace App\Http\Controllers\Kasir;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderIn()
    {
        $orders = Order::with(['table', 'items.menu', 'payment'])
            ->whereIn('status', ['pending', 'process'])
            ->latest()
            ->get();

        return view('kasir.pesanan.masuk', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:process,finished',
        ]);
    
        // Update payment status (jika ingin otomatis jadi "paid")
        $order->payment->update([
            'status_pembayaran' => 'paid',
            'waktu_bayar' => now(),
        ]);
    
        // Update order status
        $order->update([
            'status' => $request->status
        ]);
    
        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function index(Request $request)
    {
        $query = Order::with(['table', 'payment']);
    
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_pesanan', $request->tanggal);
        }
    
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        $orders = $query->latest()->paginate(10);
    
        return view('kasir.pesanan.index', compact('orders'));
    }
    

    public function show(Order $order)
    {
        $order->load(['items.menu', 'table', 'payment']);
        return view('kasir.pesanan.detail', compact('order'));
    }

    public function edit(Order $pesanan)
    {
        return view('kasir.pesanan.edit', compact('pesanan'));
    }

    public function update(Request $request, Order $pesanan)
    {
        $request->validate([
            'status_pembayaran' => 'required|string'
        ]);

        $pesanan->payment->update([
            'status_pembayaran' => $request->status_pembayaran,
            'waktu_bayar' => now()
        ]);

        return redirect()->route('pesanan.index')->with('success', 'Status pembayaran diperbarui.');
    }

    public function destroy(Order $pesanan)
    {
        $pesanan->delete();
        return back()->with('success', 'Pesanan berhasil dihapus.');
    }

    public function cetak($id)
    {
        $order = Order::with(['table', 'items.menu', 'payment'])->findOrFail($id);
    
        return view('kasir.pesanan.cetak', compact('order'));
    }
    
    
}
