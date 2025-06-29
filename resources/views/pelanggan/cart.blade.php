<x-guest-layout>
    <x-slot name="title">Keranjang</x-slot>

    <div class="fixed left-0 right-0 z-50 mx-auto bg-white shadow-sm -top-1">
        <div class="flex items-center">
            <a href="{{ route('pelanggan.menu', $nomor_meja) }}" class="px-4 pr-3">
                <i class="my-auto text-2xl ri-arrow-left-line"></i>
            </a>
            <header class="p-4">
                <h1 class="text-xl font-bold text-slate-800 sm:text-3xl">Keranjang Saya</h1>
            </header>
        </div>
    </div>

    <div class="max-w-screen-xl mx-auto lg:px-8">
        <div class="max-w-3xl mx-auto">

            @php
                $cart = session("cart_$nomor_meja", []);
            @endphp

            @if (count($cart) > 0)
                <div class="mt-18">
                    <form method="POST" action="{{ route('cart.update', $nomor_meja) }}">
                        <ul class="p-4 mb-32 space-y-4 bg-white cart-item">
                            @csrf
                            @foreach ($cart as $id => $item)
                                <li class="flex items-center gap-6 text-slate-800">
                                    <div
                                        class="flex items-center justify-center w-1/4 overflow-hidden bg-gray-100 rounded-lg aspect-square h-1/w-1/4">
                                        <img class="object-cover object-center w-full h-full"
                                            src="{{ asset('storage/menu-images/' . $item['image']) }}" alt="">
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <div class="my-1.5">
                                            <div class="text-lg font-medium">{{ $item['name'] }}</div>
                                            <div class="mt-1 text-slate-600">Rp
                                                {{ number_format($item['price'], 0, ',', '.') }}
                                            </div>
                                        </div>
                                        <div class="flex items-center flex-1 gap-2">
                                            <div>
                                                <label for="Quantity" class="sr-only"> Quantity </label>

                                                <div class="flex items-center text-center">
                                                    <button type="button"
                                                        class="flex items-center justify-center leading-10 text-gray-600 transition border rounded-l cart-btn size-8 border-amber-400 hover:opacity-75"
                                                        data-action="decrease" data-id="{{ $id }}"
                                                        data-price="{{ $item['price'] }}">&minus;</button>
                                                    <span
                                                        class="flex items-center justify-center w-10 text-sm text-center bg-gray-100 border-gray-200 size-8 border-y"
                                                        id="qty-{{ $id }}"
                                                        data-price="{{ $item['price'] }}">{{ $item['quantity'] }}</span>
                                                    <button type="button"
                                                        class="flex items-center justify-center leading-10 text-white transition border-r rounded-r cart-btn bg-amber-400 border-y size-8 border-amber-400 hover:opacity-75"
                                                        data-action="increase" data-id="{{ $id }}"
                                                        data-price="{{ $item['price'] }}">&plus;</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <button type="button"
                                        class="flex justify-end ml-auto text-gray-600 transition cart-btn hover:text-red-600"
                                        data-action="remove" data-id="{{ $id }}">
                                        <span class="sr-only">Remove item</span>

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6 ">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </form>

                    <div
                        class="fixed bottom-0 left-0 right-0 flex items-center justify-between p-4 mt-4 bg-white border-t border-gray-100">
                        <p class="inline-block text-base font-normal text-slate-800">
                            Total:
                            <span class="block text-2xl font-bold text-center text-amber-600" id="total-display"> Rp
                                {{ number_format(array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart)), 0, ',', '.') }}</span>
                        </p>
                        <div class="flex items-center justify-end">
                            <a href="{{ route('order', $nomor_meja) }}"
                                class="block px-5 py-3 font-medium text-gray-100 transition rounded-lg bg-amber-500 hover:bg-amber-600 hover:shadow-lg">
                                Checkout(<span class="count-items ">{{ count($cart) }}</span>)
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="flex items-center justify-center h-screen">
                    <div class="text-center text-slate-500">
                        Keranjang masih kosong.
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.querySelectorAll('.cart-btn').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.dataset.id;
                const action = button.dataset.action;

                fetch('{{ route('cart.update', $nomor_meja) }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            id,
                            action
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            const totalDisplay = document.querySelector('#total-display');

                            if (action === 'remove') {
                                const row = button.closest('li');
                                const countItems = document.querySelector('.count-items');
                                const cartCount = Object.keys(data.cart).length;
                                countItems.innerHTML = cartCount;
                                row.remove();

                                // jika keranjang kosong, tampilkan pesan kosong
                                if (cartCount === 0) {
                                    const cartList = document.querySelector('.cart-item');
                                    if (cartList) cartList.remove();

                                    if (totalDisplay && totalDisplay.parentElement) {
                                        totalDisplay.parentElement.innerHTML = `
                                            <div class="flex items-center justify-center h-screen">
                                                <div class="text-center text-slate-500">
                                                    Keranjang masih kosong.
                                                </div>
                                            </div>
                                        `;
                                    }
                                    return; // tidak perlu lanjut update total
                                }
                            } else {
                                const qtyElement = document.querySelector(`#qty-${id}`);
                                const subtotalElement = document.querySelector(`#subtotal-${id}`);
                                const price = parseInt(qtyElement.dataset.price);

                                qtyElement.innerText = data.cart[id].quantity;

                                if (subtotalElement) {
                                    const subtotal = data.cart[id].quantity * price;
                                    subtotalElement.innerText = 'Rp ' + new Intl.NumberFormat('id-ID')
                                        .format(subtotal);
                                }
                            }

                            // update total
                            if (totalDisplay) {
                                totalDisplay.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(
                                    data.total);
                            }
                        }
                    });

            });
        });
    </script>
</x-guest-layout>
