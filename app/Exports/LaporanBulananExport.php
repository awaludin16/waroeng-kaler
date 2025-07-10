<?php

namespace App\Exports;

use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanBulananExport implements FromView, ShouldAutoSize
{
    protected $bulan;

    public function __construct($bulan)
    {
        $this->bulan = $bulan;
    }

    public function view(): View
    {
        // ✅ pastikan $bulanCarbon diparse dengan benar
        $bulanCarbon = Carbon::parse($this->bulan);
        $start = $bulanCarbon->copy()->startOfMonth();
        $end = $bulanCarbon->copy()->endOfMonth();

        $laporanPerHari = [];

        for ($tanggal = $start->copy(); $tanggal->lte($end); $tanggal->addDay()) {
            $dataHarian = OrderItem::join('orders', 'order_items.pesanan_id', '=', 'orders.id')
                ->join('menus', 'order_items.menu_id', '=', 'menus.id')
                ->whereDate('orders.tanggal_pesanan', $tanggal->toDateString())
                ->where('orders.status', 'finished')
                ->select(
                    'menus.nama_menu',
                    DB::raw('SUM(order_items.jumlah) as total_terjual'),
                    DB::raw('SUM(order_items.subtotal) as total_penjualan')
                )
                ->groupBy('menus.nama_menu')
                ->get();

            $totalProduk = $dataHarian->sum('total_terjual');
            $totalPenjualan = $dataHarian->sum('total_penjualan');
            $menuTerlaris = $dataHarian->sortByDesc('total_terjual')->first()->nama_menu ?? '-';

            $laporanPerHari[$tanggal->format('Y-m-d')] = [
                'total_produk' => $totalProduk,
                'menu_terlaris' => $menuTerlaris,
                'total_penjualan' => $totalPenjualan,
            ];
        }

        $totalKeseluruhan = array_sum(array_column($laporanPerHari, 'total_penjualan'));

        return view('kasir.laporan.excel', [
            'bulanCarbon' => $bulanCarbon,
            'laporanPerHari' => $laporanPerHari,
            'totalKeseluruhan' => $totalKeseluruhan,
        ]);
    }
}
