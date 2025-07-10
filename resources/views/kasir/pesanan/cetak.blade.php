<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Struk - ORDR-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</title>
    <style>
        @page {
            size: 105mm 148mm;
            margin: 10mm;
        }

        body {
            width: 85mm;
            margin: 0 auto;
            font-family: 'Courier New', monospace;
            font-size: 12px;
            color: #000;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .info-table, .payment-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td,
        .payment-table td {
            padding: 2px 0;
            vertical-align: top;
        }

        .info-table td:first-child,
        .payment-table td:first-child {
            width: 40%;
            font-weight: bold;
        }

        table.menu-table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        .menu-table th, .menu-table td {
            padding: 4px 0;
            border-bottom: 1px dashed #aaa;
        }

        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 6px;
        }

        .thank-you {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
        }
    </style>
</head>
<body onload="window.print()">

    <h2>Struk Pesanan</h2>

    <!-- Informasi Umum -->
    <table class="info-table">
        <tr>
            <td>No Order</td>
            <td>ORDR-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>{{ \Carbon\Carbon::parse($order->tanggal_pesanan)->format('d M Y H:i') }}</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>{{ $order->nama_pelanggan }}</td>
        </tr>
        <tr>
            <td>Meja</td>
            <td>{{ $order->table->nomor_meja }}</td>
        </tr>
    </table>

    <!-- Rincian Menu -->
    <h4 style="margin-top: 10px;">Detail Pesanan:</h4>
    <table class="menu-table">
        <thead>
            <tr>
                <th align="left">Menu</th>
                <th align="center">Qty</th>
                <th align="right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->menu->nama_menu }}</td>
                    <td align="center">{{ $item->jumlah }}</td>
                    <td align="right">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Informasi Pembayaran -->
    <h4 style="margin-top: 10px;">Pembayaran</h4>
    <table class="payment-table">
        <tr>
            <td>Metode</td>
            <td>{{ $order->payment->metode_pembayaran ?? '-' }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>
                @if ($order->payment->status_pembayaran == 'pending')
                    Belum Bayar
                @else
                    Lunas
                @endif
            </td>
        </tr>
        <tr>
            <td>Total Bayar</td>
            <td>Rp{{ number_format($order->payment->total_bayar, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Waktu</td>
            <td>
                {{ $order->payment->waktu_bayar ? \Carbon\Carbon::parse($order->payment->waktu_bayar)->format('d M Y H:i') : '-' }}
            </td>
        </tr>
    </table>

    <div class="thank-you">--- Terima kasih telah berbelanja ---</div>
</body>
</html>
