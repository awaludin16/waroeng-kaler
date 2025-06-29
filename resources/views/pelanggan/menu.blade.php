<x-guest-layout>
    <style>
        *,
        *:before,
        *:after {
            box-sizing: border-box;
        }

        .sendtocart::before {
            animation: yAxis 1s alternate forwards cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .sendtocart.cart-item {
            display: block;
            animation: xAxis 1s forwards cubic-bezier(1, 0.44, 0.84, 0.165);
        }

        .cart::before {
            content: attr(data-totalitems);
            font-size: 12px;
            font-weight: 600;
            position: absolute;
            top: -2px;
            right: 18px;
            background-color: #973c00;
            line-height: 24px;
            padding: 0 5px;
            height: 24px;
            min-width: 24px;
            color: white;
            text-align: center;
            border-radius: 24px;
        }

        .cart.shake {
            animation: shakeCart 0.4s ease-in-out forwards;
        }

        @keyframes xAxis {
            100% {
                transform: translateX(calc(50vw - 105px));
            }
        }

        @keyframes yAxis {
            100% {
                transform: translateY(calc(-50vh + 75px));
            }
        }

        @keyframes shakeCart {
            25% {
                transform: translateX(6px);
            }

            50% {
                transform: translateX(-4px);
            }

            75% {
                transform: translateX(2px);
            }

            100% {
                transform: translateX(0);
            }
        }
    </style>

    @if (session('error'))
        <div class="p-2 mb-4 text-red-700 bg-red-100 rounded">
            {{ session('error') }}
        </div>
    @endif

    {{-- heading --}}
    <div class="fixed left-0 right-0 z-50 px-2 pt-2 mx-auto bg-white shadow-sm -top-1">
        <form class="relative flex items-center">
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative w-full mr-4">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="simple-search"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search" required>
            </div>
            <a href="{{ route('cart.index', $meja->nomor_meja) }}" id="cart" data-totalitems="{{ $cartCount }}"
                class="{{ $cartCount ? 'cart' : '' }} "
                class="mx-4 font-medium rounded-lg cursor-pointer text-slate-700 hover:text-slate-500"><i
                    class="my-auto text-3xl ri-shopping-cart-2-line"></i></a>
        </form>
        @php
            $activeCategory = request()->get('highlight'); // Untuk highlight awal dari query string
        @endphp

        <div class="flex justify-around text-center text-slate-700 sticky top-[70px] bg-white z-50">
            @foreach ($categories as $cat)
                <a href="#section-{{ strtolower($cat->nama_kategori) }}"
                    class="grow py-3 transition duration-300 hover:bg-gray-50 category-link {{ strtolower($activeCategory) == strtolower($cat->nama_kategori) ? 'text-amber-500 font-normal border-b-2 border-amber-500' : '' }}"
                    data-category="{{ strtolower($cat->nama_kategori) }}">
                    {{ ucfirst($cat->nama_kategori) }}
                </a>
            @endforeach
        </div>
    </div>

    <div
        class="bg-amber-100 mt-28 font-normal text-center scroll-mt-28 text-slate-700 p-2.5 rounded-lg border mx-2 border-slate-200">
        <p class="text-base">Nomor meja: {{ $meja->nomor_meja }}</p>
    </div>

    <!-- card -->
    <div id="all" class="container flex flex-col gap-8 px-2 mt-4 mb-6 scroll-mt-28">
        @foreach ($menusByCategory as $categoryName => $menus)
            <div id="section-{{ strtolower($categoryName) }}" class="scroll-mt-28 mb-2.5"
                data-category="{{ strtolower($categoryName) }}">
                <h2 class="mb-2 text-lg font-medium capitalize text-slate-700">{{ $categoryName }}</h2>
                <div class="grid grid-cols-2 gap-2">
                    @foreach ($menus as $menu)
                        {{-- Card menu --}}
                        <div id="menu-{{ $menu->id }}"
                            class="relative transition duration-500 bg-white rounded-lg shadow-lg hover:shadow-xl">
                            <div class="aspect-[4/3] w-full overflow-hidden rounded-t-lg">
                                <img class="object-cover w-full h-full rounded-t-lg"
                                    src="{{ asset('storage/menu-images/' . $menu->gambar) }}" alt="" />
                            </div>
                            <div class="px-1 py-1 bg-white rounded-lg">
                                <h1 class="mb-1 font-medium text-slate-700 hover:text-gray-900 hover:cursor-pointer">
                                    {{ $menu->nama_menu }}</h1>
                                <p class="text-xs leading-3 text-slate-500">{{ $menu->deskripsi }}</p>
                                <div class="flex justify-between mt-4 mb-1 mr-1">
                                    <div class="my-auto text-lg font-medium text-amber-400"><span
                                            class="text-xs">Rp</span>{{ number_format($menu->harga, 0, ',', '.') }}
                                    </div>
                                    <button onclick="addToCart({{ $menu->id }})"
                                        class="flex items-center justify-center w-10 h-10 text-white transition duration-300 rounded-full shadow-md addtocart bg-amber-500 hover:shadow-lg hover:bg-amber-600">
                                        <span class="cart-item"></span>
                                        <i class="text-xl ri-shopping-cart-2-line"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryLinks = document.querySelectorAll('.category-link');
            const sections = document.querySelectorAll('[data-category]');

            // Scroll ke section
            categoryLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').replace('#', '');
                    const section = document.getElementById(targetId);

                    if (section) {
                        section.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Update highlight active link
            function setActiveCategory(category) {
                categoryLinks.forEach(link => {
                    link.classList.remove('text-amber-500', 'font-bold', 'border-b-2', 'border-amber-500');
                    if ((category === "" && link.getAttribute('href') === '#all') ||
                        link.dataset.category === category) {
                        link.classList.add('text-amber-500', 'font-bold', 'border-b-2', 'border-amber-500');
                    }
                });
            }

            const observer = new IntersectionObserver((entries) => {
                for (const entry of entries) {
                    if (entry.isIntersecting) {
                        const currentCategory = entry.target.dataset.category;
                        setActiveCategory(currentCategory);
                        break;
                    }
                }
            }, {
                rootMargin: "-30% 0px -60% 0px",
                threshold: 0.1
            });

            sections.forEach(section => observer.observe(section));
        });


        function addToCart(menuId) {
            fetch(`/cart/add/{{ $meja->nomor_meja }}/${menuId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const button = document.querySelector(`#menu-${menuId} .addtocart`);
                        const cart = document.getElementById('cart');
                        let cartTotal = parseInt(cart.dataset.totalitems);
                        let newCartTotal = cartTotal + 1;

                        console.log(data);

                        // Tambahkan animasi
                        button.classList.add('sendtocart');
                        setTimeout(() => {
                            button.classList.remove('sendtocart');
                            cart.classList.add('cart')
                            cart.classList.add('shake');
                            cart.setAttribute('data-totalitems', newCartTotal);
                            setTimeout(() => {
                                cart.classList.remove('shake');
                            }, 500);
                        }, 300);
                    }
                });
        }
    </script>
    <script src="//unpkg.com/alpinejs" defer></script>
</x-guest-layout>
