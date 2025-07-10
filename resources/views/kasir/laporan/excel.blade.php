<table>
    <tr>
        <td colspan="4" style="font-size: 18px; font-weight: bold; text-align: center;">LAPORAN PENJUALAN</td>
    </tr>
    <tr>
        <td colspan="4" style="text-align: center;">Bulan: {{ $bulanCarbon->translatedFormat('F Y') }}</td>
    </tr>
    <tr><td colspan="4"></td></tr> {{-- Spacer --}}

    <thead>
        <tr style="background-color: #f0f0f0;">
            <th><strong>Tanggal</strong></th>
            <th><strong>Total Produk Terjual</strong></th>
            <th><strong>Menu Terlaris</strong></th>
            <th><strong>Total Penjualan (Rp)</strong></th>
        </tr>
    </thead>
    <tbody>
    @foreach ($laporanPerHari as $tanggal => $data)
        <tr>
            <td>{{ \Carbon\Carbon::parse($tanggal)->format('d/m/Y') }}</td>
            <td>{{ $data['total_produk'] ?? 0 }}</td>
            <td>{{ $data['menu_terlaris'] ?? '-' }}</td>
            <td>Rp {{ number_format($data['total_penjualan'] ?? 0, 0, ',', '.') }}</td>
        </tr>
        @endforeach

        <tr>
            <td colspan="3" style="text-align: right; font-weight: bold;">Total Keseluruhan</td>
            <td style="font-weight: bold;">Rp {{ number_format($totalKeseluruhan, 0, ',', '.') }}</td>
        </tr>
    </tbody>
</table>
