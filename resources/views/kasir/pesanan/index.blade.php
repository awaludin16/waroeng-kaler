<x-admin-layout>
    <x-slot name="navbar">
        <x-tailadmin.navbar :breadcrumbs="[['label' => 'orders']]" />
    </x-slot>

    <div class="flex items-center justify-between mb-4 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <h4 class="text-2xl font-medium">Daftar Pesanan</h4>
        {{-- <a href="{{ route('menu.create') }}"
            class="inline-block px-5 py-3 text-xs font-semibold text-center text-white align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
            + Tambah Menu
        </a> --}}
    </div>

    <!-- component -->
    <div class="overflow-hidden border border-gray-200 rounded-lg shadow-md">
        <div class="px-6 py-3 bg-white">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="table-search"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search for items">
            </div>
        </div>
        <table class="w-full text-sm text-left text-gray-500 bg-white border-collapse">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900">OrderID</th>
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900">Created At</th>
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900">Customer</th>
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900">Meja</th>
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900">Total</th>
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900">Payment Status</th>
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900">Items</th>
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900">Order Status</th>
                </tr>
            </thead>
            <tbody class="border-t border-gray-100 divide-y divide-gray-100">
                @forelse ($orders as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 font-medium before:content-['#']">{{ $item->id }}</td>
                        <td class="px-6 py-3">{{ \Carbon\Carbon::parse($item->tanggal_pesanan)->format('d F Y') }}
                        <td class="px-6 py-3">{{ $item->nama_pelanggan }}</td>
                        <td class="px-6 py-3">{{ $item->table->nomor_meja }}</td>
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
                        <td class="px-6 py-3">{{ $item->items->sum('jumlah') }}
                            @if ($item->items->sum('jumlah') > 1)
                                items
                            @else
                                item
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
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-3 text-center text-gray-400">Tidak ada pesanan pending</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

</x-admin-layout>
