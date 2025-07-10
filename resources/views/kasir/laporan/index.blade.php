<x-admin-layout>
    <x-slot name="navbar">
        <x-tailadmin.navbar :breadcrumbs="[['label' => 'Laporan Penjualan']]" />
    </x-slot>

    <div class="bg-white dark:bg-gray-800 border rounded-xl shadow p-6">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-4">
            <div>
                <h2 class="text-2xl font-bold mb-1">Laporan Penjualan</h2>
                <p class="text-gray-600 dark:text-gray-300">Bulan: {{ $bulanCarbon->translatedFormat('F Y') }}</p>
            </div>
            <a href="{{ route('laporan.export.excel', ['bulan' => $bulanCarbon->format('Y-m')]) }}"
                class="px-4 py-2 text-sm font-semibold text-white bg-green-600 rounded hover:bg-green-700">
                Unduh Excel
            </a>
        </div>

        {{-- Tabel per Hari --}}
        @foreach ($laporanPerHari as $tanggal => $dataHarian)
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-white">
                    Tanggal: {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}
                </h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 border">Nama Menu</th>
                                <th class="px-4 py-2 border text-center">Jumlah Terjual</th>
                                <th class="px-4 py-2 border text-right">Total Penjualan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataHarian['items'] as $item)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                    <td class="px-4 py-2 border">{{ $item['nama_menu'] }}</td>
                                    <td class="px-4 py-2 border text-center">{{ $item->total_terjual }}</td>
                                    <td class="px-4 py-2 border text-right">Rp {{ number_format($item->total_penjualan, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                            <tr class="font-semibold bg-gray-100 dark:bg-gray-700">
                                <td colspan="2" class="px-4 py-2 border text-right">Total Hari Ini</td>
                                <td class="px-4 py-2 border text-right">Rp {{ number_format($dataHarian['total'], 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach

        {{-- Total Keseluruhan --}}
        <div class="mt-6 text-right font-bold text-lg">
            Total Keseluruhan: Rp {{ number_format($totalKeseluruhan, 0, ',', '.') }}
        </div>
    </div>
</x-admin-layout>
