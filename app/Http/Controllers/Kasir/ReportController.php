<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\OrderItem;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanKategoriExport;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function laporanKategori(Request $request)
    {
        $bulan = $request->input('bulan') ?? now()->format('Y-m');
        $bulanCarbon = \Carbon\Carbon::parse($bulan);

        $results = OrderItem::selectRaw("
            categories.nama_kategori AS kategori_produk,
            SUM(order_items.jumlah) AS jumlah_terjual,
            AVG(order_items.subtotal) AS rata_rata_harga,
            SUM(order_items.jumlah * order_items.subtotal) AS total_penjualan
        ")
            ->join('orders', 'order_items.pesanan_id', '=', 'orders.id')
            ->join('menus', 'order_items.menu_id', '=', 'menus.id')
            ->join('categories', 'menus.kategori_id', '=', 'categories.id')
            ->whereMonth('orders.tanggal_pesanan', $bulanCarbon->month)
            ->whereYear('orders.tanggal_pesanan', $bulanCarbon->year)
            ->where('orders.status', 'finished')
            ->groupBy('kategori_produk')
            ->get();

        $totalKeseluruhan = $results->sum('total_penjualan');

        return view('kasir.laporan.index', compact('results', 'totalKeseluruhan', 'bulanCarbon'));
    }



    public function exportExcel(Request $request)
    {
        $bulan = $request->input('bulan') ?? now()->format('Y-m');
        return Excel::download(new LaporanKategoriExport($bulan), 'laporan-penjualan-kategori.xlsx');
    }
}
