<table>
    <thead>
        <tr>
            <th>Bulan</th>
            <th>Kategori Produk</th>
            <th>Jumlah Terjual</th>
            <th>Rata-Rata Harga</th>
            <th>Total Penjualan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($results as $row)
            <tr>
                <td>{{ $bulanCarbon->translatedFormat('F Y') }}</td>
                <td>{{ $row->kategori_produk }}</td>
                <td>{{ $row->jumlah_terjual }}</td>
                <td>Rp.{{ number_format($row->rata_rata_harga, 0, ',', '.') }}</td>
                <td>Rp.{{ number_format($row->total_penjualan, 0, ',', '.') }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4"><strong>Total Penjualan</strong></td>
            <td><strong>Rp.{{ number_format($totalKeseluruhan, 0, ',', '.') }}</strong></td>
        </tr>
    </tbody>
</table>
