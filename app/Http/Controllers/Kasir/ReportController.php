<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanBulananExport;

class ReportController extends Controller
{
    public function laporanBulanan(Request $request)
    {
        $bulan = $request->input('bulan') ?? now()->format('Y-m');
        $tanggal = Carbon::today();
        $bulanCarbon = $tanggal->copy(); // tetap dipakai untuk tampilan di Blade
        
        $dataHarian = OrderItem::join('orders', 'order_items.pesanan_id', '=', 'orders.id')
            ->join('menus', 'order_items.menu_id', '=', 'menus.id')
            ->whereDate('orders.tanggal_pesanan', $tanggal->toDateString())
            ->where('orders.status', 'finished')
            ->selectRaw('menus.nama_menu, SUM(order_items.jumlah) as total_terjual, SUM(order_items.subtotal) as total_penjualan')
            ->groupBy('menus.nama_menu')      
            ->get();
        
        $jumlahTerjual = $dataHarian->sum('total_terjual');
        $totalPenjualan = $dataHarian->sum('total_penjualan');
        $menuTerlaris = $dataHarian->sortByDesc('total_terjual')->first()->nama_menu ?? '-';
        
        $laporanPerHari[$tanggal->toDateString()] = [
            'jumlah_terjual' => $jumlahTerjual,
            'total_penjualan' => $totalPenjualan,
            'menu_terlaris' => $menuTerlaris,
            'items' => $dataHarian,
            'total' => $totalPenjualan,
        ];
        
        $totalKeseluruhan = $totalPenjualan;
        

        $totalKeseluruhan = array_sum(array_column($laporanPerHari, 'total_penjualan'));

        return view('kasir.laporan.index', [
            'bulanCarbon' => $bulanCarbon,
            'laporanPerHari' => $laporanPerHari,
            'totalKeseluruhan' => $totalKeseluruhan,
            'items' => $dataHarian, // penting untuk view index.blade.php
            'total' => $totalPenjualan // penting juga
        ]);
    }

    public function exportExcel(Request $request)
    {
        $bulan = $request->input('bulan') ?? now()->format('Y-m');
        return Excel::download(new LaporanBulananExport($bulan), 'laporan-penjualan.xlsx');
    }
}
