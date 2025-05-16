<x-admin.layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">Daftar Pesanan</h2>
    </x-slot>

    <div class="px-4 py-6">
        <div class="p-6 bg-white rounded-lg shadow">
            @if (session('success'))
                <div class="mb-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <table class="w-full text-sm text-left">
                <thead class="text-gray-600 uppercase bg-gray-100">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Meja</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr class="border-b">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->nama_pelanggan }}</td>
                            <td>{{ $order->table->nomor_meja }}</td>
                            <td>Rp{{ number_format($order->total_harga) }}</td>
                            <td>
                                <span
                                    class="text-sm px-2 py-1 rounded
                                    {{ $order->payment->status_pembayaran === 'lunas' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ ucfirst($order->payment->status_pembayaran) }}
                                </span>
                            </td>
                            <td>{{ $order->tanggal_pesanan }}</td>
                            <td class="flex mt-2 space-x-2">
                                <a href="{{ route('pesanan.show', $order->id) }}"
                                    class="text-blue-600 hover:underline">Lihat</a>
                                <form method="POST" action="{{ route('pesanan.destroy', $order->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin hapus pesanan ini?')"
                                        class="text-red-600 hover:underline">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-4 text-center">Belum ada pesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin.layout>
