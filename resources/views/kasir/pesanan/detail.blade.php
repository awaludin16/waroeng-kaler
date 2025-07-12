<x-admin-layout>
    <x-slot name="navbar">
        <x-tailadmin.navbar :breadcrumbs="[['label' => 'Detail Pesanan']]" />
    </x-slot>

    <div class="max-w-2xl mx-auto my-8">
        @if (session('success'))
            <div class="p-3 mb-4 text-sm text-green-800 bg-green-100 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="p-6 space-y-6 bg-white rounded-lg shadow">
            <!-- Header -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Detail Pesanan - ORDR-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Tanggal: {{ \Carbon\Carbon::parse($order->tanggal_pesanan)->format('d F Y') }}
                </p>
            </div>

            <!-- Informasi Umum -->
            <div>
                <h3 class="mb-2 text-lg font-semibold text-gray-700">Informasi Umum</h3>
                <ul class="text-sm text-gray-600">
                    <li class="grid grid-cols-3 mb-2">
                        <span class="font-semibold">Nama Pelanggan</span>
                        <span>: {{ $order->nama_pelanggan }}</span>
                    </li>
                    <li class="grid grid-cols-3 mb-2">
                        <span class="font-semibold">No Meja</span>
                        <span>: {{ $order->table->nomor_meja }}</span>
                    </li>

                    <li class="grid grid-cols-3 mb-2">
                        <span class="font-semibold">Status Pesanan</span>
                        <span>
                            @if ($order->status == 'process')
                                <!-- Form Ubah Status Langsung di Sini -->
                                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST"
                                    id="ubahStatusForm">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" id="status"
                                        class="text-sm border-gray-300 rounded form-select">
                                        <option value="process" selected>Diproses</option>
                                        <option value="finished">Selesai</option>
                                    </select>
                                </form>
                            @else
                                : {{ ucfirst($order->status) }}
                            @endif
                        </span>
                    </li>
                </ul>
            </div>

            <!-- Rincian Menu -->
            <div>
                <h3 class="mb-2 text-lg font-semibold text-gray-700">Rincian Menu</h3>
                <table class="w-full text-sm text-left text-gray-600 border-t">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Menu</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr class="border-b">
                                <td class="py-2">{{ $item->menu->nama_menu }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Informasi Pembayaran -->
            <div>
                <h3 class="mb-2 text-lg font-semibold text-gray-700">Informasi Pembayaran</h3>
                <ul class="text-sm text-gray-600">
                    <li class="grid grid-cols-3 mb-2">
                        <span class="font-semibold">Metode Pembayaran</span>
                        <span>: {{ $order->payment->metode_pembayaran ?? '-' }}</span>
                        <span></span>
                    </li>
                    <li class="grid grid-cols-3 mb-2">
                        <span class="font-semibold">Status Pembayaran</span>
                        <span>
                            @if ($order->payment->status_pembayaran == 'pending')
                                <span class="font-semibold text-rose-500">: Unpaid</span>
                            @else
                                <span class="font-semibold text-emerald-500">: Paid</span>
                            @endif
                        </span>
                    </li>
                    <li class="grid grid-cols-3 mb-2">
                        <span class="font-semibold">Waktu Transaksi </span>
                        <span>
                            :
                            {{ $order->payment->waktu_bayar ? \Carbon\Carbon::parse($order->payment->waktu_bayar)->format('d F Y H:i') : '-' }}
                        </span>
                    </li>
                    <li class="grid grid-cols-3 mb-2">
                        <span class="font-semibold">Total Bayar:</span>
                        <span>: Rp {{ number_format($order->payment->total_bayar, 0, ',', '.') }}</span>
                    </li>
                </ul>

                <!-- Tombol Aksi -->
                <div class="flex justify-end gap-2 pt-6 mt-6 border-t">
                    <a href="{{ url()->previous() }}"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                        ← Kembali
                    </a>

                    @if ($order->status == 'process')
                        <button type="submit" form="ubahStatusForm"
                            onclick="return confirm('Yakin mengubah status pesanan ini menjadi selesai?')"
                            class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded hover:bg-green-700">
                            Simpan Status
                        </button>
                    @endif

                    @if ($order->status == 'finished')
                        <a href="{{ route('orders.cetak', $order->id) }}" target="_blank"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                            Cetak Struk
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
