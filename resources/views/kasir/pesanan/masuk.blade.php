<x-admin-layout>
    <x-slot name="navbar">
        <x-tailadmin.navbar :breadcrumbs="[['label' => 'orders']]" />
    </x-slot>

    <div class="mb-4 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <h4 class="mb-1 text-2xl font-medium">Daftar Pesanan Masuk</h4>
        <p>Update status pesanan di laman ini</p>
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
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900">Status</th>
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900">Meja</th>
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900">Customer</th>
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900">Metode Pembayaran</th>
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900">Total Harga</th>
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900">Update Pesanan</th>
                </tr>
            </thead>
            <tbody class="border-t border-gray-100 divide-y divide-gray-100">
                @forelse ($orders as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 font-medium text-slate-700 before:content-['#']">{{ $item->id }}</td>
                        <td class="px-6 py-3">
                            @if ($item->status == 'process')
                                <span
                                    class="inline-flex items-center justify-center rounded-full bg-amber-100 px-2.5 py-0.5 text-amber-700">
                                    <p class="text-sm whitespace-nowrap">{{ Str::ucfirst($item->status) }}</p>
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center justify-center rounded-full bg-rose-100 px-2.5 py-0.5 text-rose-700">
                                    <p class="text-sm whitespace-nowrap">{{ Str::ucfirst($item->status) }}</p>
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-3">{{ $item->table->nomor_meja }}</td>
                        <td class="px-6 py-3">{{ $item->nama_pelanggan }}</td>
                        <td class="px-6 py-3">
                            @if ($item->payment->metode_pembayaran == 'Cash')
                                <span
                                    class="inline-flex items-center justify-center rounded-full border border-slate-500 px-2.5 py-0.5 text-slate-700">
                                    <p class="text-sm whitespace-nowrap">{{ $item->payment->metode_pembayaran }}</p>
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center justify-center rounded-full border border-indigo-500 px-2.5 py-0.5 text-indigo-700">
                                    <p class="text-sm whitespace-nowrap">Online</p>
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-3">Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-3">
                            <form action="{{ route('orders.updateStatus', $item->id) }}" method="POST"
                                class="inline-flex gap-2">
                                @csrf
                                @method('PUT')
                                <select name="status" class="text-sm border rounded">
                                    <option value="process" {{ $item->status == 'process' ? 'selected' : '' }}>Proses
                                    </option>
                                    <option value="finished"
                                        {{ $item->status == 'process' && $item->payment->status_pembayaran == 'paid' ? 'selected' : '' }}>
                                        Selesai
                                    </option>
                                </select>
                                <button type="submit"
                                    class="px-3 py-1 text-xs text-white bg-blue-600 rounded hover:bg-blue-700">
                                    Konfirmasi
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-3 text-center text-gray-400">Tidak ada pesanan pending</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

</x-admin-layout>
