<x-guest-layout>
    <div class="max-w-full p-4 mx-auto">
        <h1 class="mb-4 text-2xl font-bold">Menu - {{ $meja->nomor_meja }}</h1>

        @if (session('success'))
            <div class="p-3 mb-4 text-green-800 bg-green-100 rounded">{{ session('success') }}</div>
        @endif

        <form action="{{ route('pelanggan.pesan') }}" method="POST">
            @csrf
            <input type="hidden" name="meja_id" value="{{ $meja->id }}">

            <div class="grid grid-cols-2 gap-4 md:grid-cols-2">
                @foreach ($menus as $menu)
                    <div class="p-4 border rounded shadow">
                        <h2 class="font-bold">{{ $menu->nama_menu }}</h2>
                        <p class="text-sm text-gray-600">{{ $menu->category->nama_kategori }}</p>
                        <p class="text-lg font-semibold">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                        <label class="block mt-2 text-sm">Jumlah:</label>
                        <input type="number" name="items[{{ $loop->index }}][jumlah]" min="0" value="0"
                            class="w-20 px-2 py-1 border rounded">
                        <input type="hidden" name="items[{{ $loop->index }}][menu_id]" value="{{ $menu->id }}">
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                <label class="block mb-1">Nama Anda:</label>
                <input type="text" name="nama_pelanggan" class="w-full px-4 py-2 border rounded" required>
            </div>

            <div class="mt-4 text-right">
                <button type="submit" class="px-6 py-2 text-white bg-green-600 rounded hover:bg-green-700">
                    Pesan Sekarang
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
