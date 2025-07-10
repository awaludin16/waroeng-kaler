<x-admin-layout>
    <x-slot name="navbar">
        <x-tailadmin.navbar :breadcrumbs="[['label' => 'Kategori']]"/>
    </x-slot>

    <div class="flex items-center justify-between mb-4 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <h4 class="text-2xl font-medium">Kelola Kategori</h4>
        <a href="#" class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded hover:bg-green-700">
            + Tambah Kategori
        </a>
    </div>

    <div class="overflow-hidden border border-gray-200 rounded-lg shadow-md">
        <table class="w-full text-sm text-left text-gray-500 bg-white border-collapse">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Nama Kategori</th>
                    <th class="px-6 py-3">Dibuat</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="border-t border-gray-100 divide-y divide-gray-100">
                @forelse ($categories as $kategori)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3">{{ $kategori->id }}</td>
                        <td class="px-6 py-3">{{ $kategori->nama_kategori }}</td>
                        <td class="px-6 py-3">{{ $kategori->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-3">
                            <div class="flex gap-2">
                                <a href="#" class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                                    Edit
                                </a>
                                <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-400">Belum ada kategori.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
