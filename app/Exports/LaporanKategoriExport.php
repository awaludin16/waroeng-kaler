<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanKategoriExport implements FromView
{
    protected $bulan;

    public function __construct($bulan)
    {
        $this->bulan = $bulan;
    }

    public function view(): View
    {
        $bulanCarbon = Carbon::parse($this->bulan);

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

        return view('kasir.laporan.excel', [
            'results' => $results,
            'totalKeseluruhan' => $totalKeseluruhan,
            'bulanCarbon' => $bulanCarbon,
        ]);
    }
}
