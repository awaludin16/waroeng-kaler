<x-guest-layout>
    <x-slot name="title">Order</x-slot>

    <div class="fixed left-0 right-0 z-50 mx-auto bg-white shadow-sm -top-1">
        <div class="flex items-center">
            <a href="{{ route('cart.index') }}" class="px-4 pr-3">
                <i class="my-auto text-2xl ri-arrow-left-line"></i>
            </a>
            <header class="p-4">
                <h1 class="text-xl font-bold text-slate-800 sm:text-3xl">Checkout</h1>
            </header>
        </div>
    </div>
    </div>

    @if (session('error'))
        <div class="p-2 mb-4 text-red-700 bg-red-100 rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="container mx-auto mt-18">
        <div class="mb-4 bg-white">
            <div class="py-3 mb-2 border-b border-slate-200">
                <h1 class="block px-4 text-base font-medium text-slate-800" for="nama_pelanggan">Menu yang dipesan
                </h1>
            </div>
            @php $total = 0; @endphp
            @foreach ($menus as $menu)
                @php
                    $qty = $cart[$menu->id]['quantity'];
                    $subtotal = $menu->harga * $qty;
                    $total += $subtotal;
                @endphp
                <div class="flex items-center gap-4 px-4 py-2 text-slate-800">
                    <div
                        class="flex items-center justify-center w-1/6 overflow-hidden bg-gray-100 rounded-lg aspect-square h-1/w-1/6">
                        <img class="object-cover object-center w-full h-full"
                            src="{{ asset('storage/menu-images/' . $menu->gambar) }}" alt="">
                    </div>
                    <div class="my-1.5 text-slate-600 w-full">
                        <div class="flex items-center justify-between mb-1">
                            <h4 class="">{{ $menu->nama_menu }}</h4>
                            <p class="text-sm">x {{ $qty }}</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-sm">{{ $menu->harga }} / item</p>
                            <p class="text-sm">{{ $subtotal }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- form --}}
        <form method="POST" action="{{ route('order') }}">
            @csrf

            {{-- nama pelanggan input --}}
            <div class="mb-4 bg-white">
                <div class="py-3 border-b border-slate-200">
                    <label class="block px-4 text-base font-medium text-slate-800" for="nama_pelanggan">Nama
                        pelanggan</label>
                </div>
                <div class="p-4">
                    <input id="nama_pelanggan" name="nama_pelanggan"
                        class="border bg-slate-50 border-slate-300 rounded-lg focus:ring transition py-2.5 px-4 block w-full text-base text-slate-700 placeholder:text-sm placeholder:text-slate-400 focus:outline-1 focus:outline focus:outline-slate-400"
                        placeholder="Masukan nama" type="text" value="{{ old('nama_pelanggan') }}" />
                    @error('nama_pelanggan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- payments method --}}
            <div class="flex flex-col mb-32 bg-white">
                <div class="py-3 border-b border-slate-200">
                    <h1 class="px-4 text-base font-medium text-slate-800">Pilih metode pembayaran</h1>
                </div>
                @error('payment_method')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <div class="flex flex-col gap-3 px-4">
                    <label for="cash" class="flex items-center justify-between">
                        <div class="flex flex-row-reverse items-center">
                            <div class="py-4 ml-6 text-slate-700">
                                <h3 class="font-medium">Cash</h3>
                                <p class="mb-1 text-sm text-slate-500">Bayar di Kasir</p>
                            </div>
                            <img alt="Money Special Flat icon" loading="lazy" decoding="async" data-nimg="1"
                                class="_e0usu51 size-14"
                                src="https://cdn-icons-png.freepik.com/512/998/998662.png?uid=R151018612&amp;ga=GA1.1.178936179.1717067031"
                                style="color: transparent;">
                        </div>
                        <input id="cash" type="radio" name="payment_method" value="Cash" class="size-4"
                            required>
                    </label>
                    <label for="qris" class="flex items-center justify-between">
                        <div class="flex flex-row-reverse items-center">
                            <div class="py-4 ml-6 text-slate-700">
                                <h3 class="font-medium">Pembayaran Online</h3>
                                <p class="mb-1 text-sm text-slate-500">QRIS/E-Wallet/MBanking/dll</p>
                            </div>
                            <img alt="Online payment Flaticons Flat icon" loading="lazy" decoding="async" data-nimg="1"
                                class="_e0usu51 size-14" style="color:transparent"
                                src="https://cdn-icons-png.freepik.com/512/10551/10551890.png?uid=R151018612&amp;ga=GA1.1.178936179.1717067031">
                        </div>
                        <input id="qris" type="radio" name="payment_method" value="Pembayaran Online"
                            class="size-4" required>
                    </label>
                </div>
            </div>

            <div
                class="fixed bottom-0 left-0 right-0 flex items-center justify-between p-4 bg-white border-t border-gray-100">
                <p class="inline-block text-base font-normal text-slate-800">
                    Total:
                    <span class="block text-2xl font-bold text-center text-amber-600" id="total-display"> Rp
                        {{ number_format($total, 0, ',', '.') }}</span>
                </p>
                <div class="flex items-center justify-end">
                    <button type="submit"
                        class="block px-5 py-3 font-medium text-gray-100 transition rounded-lg bg-amber-500 hover:bg-amber-600 hover:shadow-lg">
                        Buat pesanan
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>
