<x-admin-layout>
    <x-slot name="navbar">
        <x-tailadmin.navbar :breadcrumbs="[['label' => 'Laporan Penjualan']]" />
    </x-slot>

    <a href="{{ route('kasir.laporan.export', ['bulan' => $bulanCarbon->format('Y-m')]) }}"
        class="inline-block px-4 py-2 mb-4 text-white bg-green-600 rounded hover:bg-green-700">
        Unduh Excel
    </a>


    <h3 class="mb-4 text-xl font-semibold">Laporan Penjualan</h3>

    <h2 class="mb-4 text-xl font-bold">LAPORAN PENJUALAN BULANAN PRODUK</h2>

    <p>Bulan: {{ $bulanCarbon->translatedFormat('F Y') }}</p>

    <table class="w-full mt-4 text-sm border border-collapse table-auto">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border">Waktu Transaksi</th>
                <th class="px-4 py-2 border">Kategori Produk</th>
                <th class="px-4 py-2 border">Jumlah Unit Terjual</th>
                <th class="px-4 py-2 border">Rata-Rata Harga Jual per Unit (Rp)</th>
                <th class="px-4 py-2 border">Total Penjualan (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $row)
                <tr>
                    <td class="px-4 py-2 border">{{ $bulanCarbon->translatedFormat('F Y') }}</td>
                    <td class="px-4 py-2 border">{{ $row->kategori_produk }}</td>
                    <td class="px-4 py-2 text-center border">{{ $row->jumlah_terjual }}</td>
                    <td class="px-4 py-2 text-right border">Rp {{ number_format($row->rata_rata_harga, 0, ',', '.') }}
                    </td>
                    <td class="px-4 py-2 text-right border">Rp {{ number_format($row->total_penjualan, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
            <tr class="font-bold bg-gray-100">
                <td class="px-4 py-2 text-center border" colspan="4">Total Penjualan</td>
                <td class="px-4 py-2 text-right border">Rp {{ number_format($totalKeseluruhan, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

</x-admin-layout>
