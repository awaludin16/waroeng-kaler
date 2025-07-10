<x-admin-layout>
    <x-slot name="navbar">
        <x-tailadmin.navbar :breadcrumbs="[['label' => 'menu']]" />
    </x-slot>

    <div class="flex items-center justify-between mb-4 border-b-0 rounded-t-2xl">
        <h4 class="text-2xl font-medium">Daftar Menu</h4>
        <a href="{{ route('menus.create') }}"
            class="px-5 py-3 text-xs font-semibold text-white transition-all rounded-lg shadow bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-md hover:scale-105">
            Tambah Menu
        </a>
    </div>

    <div class="px-6 py-3 bg-white dark:bg-gray-800">
        <form method="GET" action="{{ route('menus.index') }}">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" name="search" id="table-search" value="{{ request('search') }}"
                    class="block w-80 p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:placeholder-gray-400"
                    placeholder="Cari menu...">
            </div>
        </form>
    </div>


    <table class="w-full text-sm text-left text-gray-500 border-collapse dark:text-gray-300">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-6 py-3 font-medium text-gray-900 dark:text-white">Gambar</th>
                <th class="px-6 py-3 font-medium text-gray-900 dark:text-white">Nama Menu</th>
                <th class="px-6 py-3 font-medium text-gray-900 dark:text-white">Harga</th>
                <th class="px-6 py-3 font-medium text-gray-900 dark:text-white">Kategori</th>
                <th class="px-6 py-3 font-medium text-gray-900 dark:text-white">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white border-t border-gray-100 divide-y dark:border-gray-700">
            @foreach ($menus as $menu)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                    <td class="px-6 py-3">
                        @if ($menu->gambar)
                            <img src="{{ asset('storage/menu-images/' . $menu->gambar) }}" alt="Gambar"
                                class="object-cover w-10 h-10 rounded">
                        @else
                            <img src="https://placehold.co/32x32" alt="Placeholder"
                                class="object-cover w-10 h-10 rounded">
                        @endif
                    </td>
                    <td class="px-6 py-3">{{ $menu->nama_menu }}</td>
                    <td class="px-6 py-3">Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                    <td class="px-6 py-3">{{ $menu->category->nama_kategori }}</td>
                    <td class="px-6 py-3">
                        <div class="flex gap-2">
                            <a href="{{ route('menus.edit', $menu->id) }}"
                                class="inline-flex items-center px-3 py-1 text-xs font-medium text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300">
                                <i class="mr-1 ri-edit-box-line"></i>Edit
                            </a>
                            <form action="{{ route('menus.destroy', $menu->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-1 text-xs font-medium text-white bg-red-600 rounded hover:bg-red-700 focus:outline-none focus:ring focus:ring-red-300">
                                    <i class="mr-1 ri-delete-bin-line"></i>Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $menus->links() }}
    </div>
    </div>


    <script>
        document.getElementById('table-search').addEventListener('input', function() {
            this.form.submit();
        });
    </script>

</x-admin-layout>
