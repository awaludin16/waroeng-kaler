<?php

namespace App\Http\Controllers\Kasir;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\Menu;

use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $ordersPerDay = Order::select(DB::raw('DATE(tanggal_pesanan) as tanggal'), DB::raw('count(*) as total'))
            ->whereBetween('tanggal_pesanan', [Carbon::now()->subDays(6), Carbon::now()])
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        // Format data untuk Chart.js
        $labels = $ordersPerDay->pluck('tanggal')->map(function ($date) {
            return Carbon::parse($date)->format('d M');
        });

        $data = $ordersPerDay->pluck('total');

        $today = Carbon::today();

        $totalHarian = Order::whereDate('tanggal_pesanan', $today)
        ->whereHas('payment', function ($query) {
            $query->where('status_pembayaran', 'paid');
        })
        ->sum('total_harga');

        $totalMenu = Menu::count();
        $pesananMasuk = \App\Models\Order::where('status', 'pending')->count();
        $jumlahPesanan = \App\Models\Order::count();

        return view('kasir.dashboard', compact('totalMenu', 'pesananMasuk', 'jumlahPesanan', 'totalHarian', 'labels', 'data'));
    }
}
