<x-admin-layout>
    <x-slot name="navbar">
        <x-tailadmin.navbar :breadcrumbs="[['label' => 'menu']]" />
    </x-slot>

    <div class="flex items-center justify-between mb-4 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <h4 class="text-2xl font-medium">Daftar Menu</h4>
        <a href="{{ route('menus.create') }}"
            class="inline-block px-5 py-3 text-xs font-semibold text-center text-white align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
            New Menu
        </a>
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
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900">Gambar</th>
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900">Nama Menu</th>
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900">Harga</th>
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900">Kategori</th>
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900"></th>
                </tr>
            </thead>
            <tbody class="border-t border-gray-100 divide-y divide-gray-100">
                @foreach ($menus as $menu)
                    <tr class="hover:bg-gray-50">
                        <td class="flex gap-3 px-6 py-3 font-normal text-gray-900">
                            <div class="relative">
                                @if ($menu->gambar)
                                    <img src="{{ asset('storage/menu-images/' . $menu->gambar) }}" alt=""
                                        class="object-cover w-10 h-10 rounded">
                                @else
                                    <img src="https://placehold.co/32x32" alt=""
                                        class="object-cover w-10 h-10 rounded">
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-3">{{ $menu->nama_menu }}</td>
                        <td class="px-6 py-3">Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-3">{{ $menu->category->nama_kategori }}</td>
                        <td class="px-6 py-3">
                            <div class="flex justify-end gap-4">
                                <a href="{{ route('menus.edit', $menu->id) }}">
                                    <i class="text-xl ri-edit-box-line hover:text-slate-700"></i>
                                </a>
                                <form action="{{ route('menus.destroy', $menu->id) }}" method="POST"
                                    style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <i class="text-xl hover:text-red-500 ri-delete-bin-line"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $menus->links() }}
    </div>

</x-admin-layout>
