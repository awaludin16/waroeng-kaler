<x-admin-layout>
    <x-slot name="navbar">
        <x-tailadmin.navbar :breadcrumbs="[['label' => 'orders']]" />
    </x-slot>

    <div class="flex items-center justify-between mb-4 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <h4 class="text-2xl font-medium">Daftar Pesanan</h4>
    </div>

    <div class="overflow-hidden border border-gray-200 rounded-lg shadow-md">
        <!-- Search dan Filter -->
        <div class="flex flex-wrap items-center justify-between gap-4 px-6 py-4 bg-white border-b">
            {{-- Search (kiri) --}}
            <div>
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="text" id="table-search"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-80 pl-10 p-2.5"
                        placeholder="Cari pesanan...">
                </div>
            </div>

            {{-- Filter (kanan) --}}
            <form method="GET" action="{{ route('orders.index') }}" class="flex items-center gap-3">
                <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                    class="px-2 py-1 text-sm border border-gray-300 rounded">
                <select name="status" class="px-2 py-1 text-sm border border-gray-300 rounded">
                    <option value="">Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="process" {{ request('status') == 'process' ? 'selected' : '' }}>Process</option>
                    <option value="finished" {{ request('status') == 'finished' ? 'selected' : '' }}>Finished</option>
                </select>
                <button type="submit" class="px-4 py-1.5 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                    Filter
                </button>
            </form>
        </div>

        <!-- Table -->
        <table class="w-full text-sm text-left text-gray-500 bg-white border-collapse">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3">OrderID</th>
                    <th class="px-6 py-3">Tanggal Pemesanan</th>
                    <th class="px-6 py-3">Nama Pelanggan</th>
                    <th class="px-6 py-3">Meja</th>
                    <th class="px-6 py-3">Total</th>
                    <th class="px-6 py-3">Payment Status</th>
                    <th class="px-6 py-3">Order Status</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="border-t border-gray-100 divide-y divide-gray-100">
                @forelse ($orders as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 font-medium">ORDR-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-3">{{ \Carbon\Carbon::parse($item->tanggal_pesanan)->format('d F Y, H:i') }}
                        </td>
                        <td class="px-6 py-3">{{ $item->nama_pelanggan }}</td>
                        <td class="px-6 py-3">Meja No {{ $item->table->nomor_meja }}</td>
                        <td class="px-6 py-3">Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-3">
                            @if ($item->payment->status_pembayaran == 'pending')
                                <span
                                    class="inline-flex items-center justify-center rounded-full bg-slate-100 px-2.5 py-0.5 text-slate-700">
                                    <p class="text-sm whitespace-nowrap">Unpaid</p>
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center justify-center rounded-full bg-emerald-100 px-2.5 py-0.5 text-emerald-700">
                                    <p class="text-sm whitespace-nowrap">Paid</p>
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-3">
                            @if ($item->status == 'process')
                                <span
                                    class="inline-flex items-center justify-center rounded-full border border-amber-500 px-2.5 py-0.5 text-amber-700">
                                    <p class="text-sm whitespace-nowrap">Process</p>
                                </span>
                            @elseif ($item->status == 'finished')
                                <span
                                    class="inline-flex items-center justify-center rounded-full border border-emerald-500 px-2.5 py-0.5 text-emerald-700">
                                    <p class="text-sm whitespace-nowrap">Finished</p>
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center justify-center rounded-full border border-rose-400 px-2.5 py-0.5 text-rose-700">
                                    <p class="text-sm whitespace-nowrap">Pending</p>
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-3">
                            <a href="{{ route('orders.show', $item->id) }}"
                                class="inline-block px-3 py-1 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-3 text-center text-gray-400">Tidak ada pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 bg-white">
            {{ $orders->links() }}
        </div>

    </div>
</x-admin-layout>
