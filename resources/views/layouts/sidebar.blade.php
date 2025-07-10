<div class="fixed top-0 left-0 z-50 w-64 h-full p-4 transition-transform bg-white text-gray-800 dark:bg-gray-900 dark:text-white rounded-r-xl sidebar-menu">
    <a href="#" class="flex items-center justify-center pt-2 pb-4 border-b border-b-gray-200 dark:border-b-gray-800">
        <img src="{{ asset('assets/img/illustrations/logo.png') }}" alt="Logo" class="object-cover w-8 h-8 rounded">
        <span class="ml-3 text-lg font-semibold text-gray-800 dark:text-white">Kedai Uniko</span>
    </a>

    <ul class="mt-3">
        <li class="mt-2 mb-1 group">
            <a href="{{ route('dashboard') }}"
               class="flex items-center py-2 px-4 rounded-md text-sm text-gray-800 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-black dark:hover:text-white {{ request()->routeIs('dashboard') ? 'bg-gray-200 dark:bg-gray-800 font-semibold' : '' }}">
                <i class="mr-3 text-lg ri-home-line"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @if(auth()->user() && auth()->user()->role === 'kasir')
            <div class="py-2 mt-3 text-sm font-medium border-t border-t-gray-200 dark:border-t-gray-800 text-gray-600 dark:text-slate-300">
                <div class="mt-2">Interface</div>

                <li class="mt-2 mb-1 group">
                    <a href="#" class="flex items-center py-2 px-4 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-md sidebar-dropdown-toggle">
                        <i class="mr-3 text-lg ri-restaurant-2-line"></i>
                        <span class="text-sm">Kelola Menu</span>
                        <i class="ri-arrow-right-s-line ml-auto"></i>
                    </a>
                    <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                        <li class="mb-4">
                            <a href="{{ route('kategori.index') }}" class="text-sm flex items-center text-gray-700 dark:text-gray-300 hover:text-black dark:hover:text-white before:w-1 before:h-1 before:rounded-full before:bg-gray-400 dark:before:bg-gray-300 before:mr-3">
                                Kategori
                            </a>
                        </li>
                        <li class="mb-4">
                            <a href="{{ route('menus.index') }}" class="text-sm flex items-center text-gray-700 dark:text-gray-300 hover:text-black dark:hover:text-white before:w-1 before:h-1 before:rounded-full before:bg-gray-400 dark:before:bg-gray-300 before:mr-3">
                                Menu
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="mt-2 mb-1 group">
                    <a href="#" class="flex items-center py-2 px-4 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-md sidebar-dropdown-toggle">
                        <i class="mr-3 text-lg ri-flashlight-line"></i>
                        <span class="text-sm">Kelola Pesanan</span>
                        <i class="ri-arrow-right-s-line ml-auto"></i>
                    </a>
                    <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                        <li class="mb-4">
                            <a href="{{ route('orders.pending') }}" class="text-sm flex items-center text-gray-700 dark:text-gray-300 hover:text-black dark:hover:text-white before:w-1 before:h-1 before:rounded-full before:bg-gray-400 dark:before:bg-gray-300 before:mr-3">
                                Pesanan Masuk
                            </a>
                        </li>
                        <li class="mb-4">
                            <a href="{{ route('orders.index') }}" class="text-sm flex items-center text-gray-700 dark:text-gray-300 hover:text-black dark:hover:text-white before:w-1 before:h-1 before:rounded-full before:bg-gray-400 dark:before:bg-gray-300 before:mr-3">
                                Daftar Pesanan
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="mt-2 mb-1 group">
                    <a href="{{ route('laporan.index') }}" class="flex items-center py-2 px-4 rounded-md text-sm text-gray-800 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-black dark:hover:text-white {{ request()->routeIs('laporan.index') ? 'bg-gray-200 dark:bg-gray-800 font-semibold' : '' }}">
                        <i class="mr-3 text-lg ri-time-line"></i>
                        <span>Riwayat Pesanan</span>
                    </a>
                </li>
            </div>
        @endif

        @if(auth()->user() && auth()->user()->role === 'owner')
            <div class="py-2 mt-3 text-sm font-medium border-t border-t-gray-200 dark:border-t-gray-800 text-gray-600 dark:text-slate-300">
                <div class="mt-2">Manajemen</div>

                <li class="mt-2 mb-1 group">
                    <a href="{{ route('user.index') }}" class="flex items-center py-2 px-4 rounded-md text-sm text-gray-800 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-black dark:hover:text-white {{ request()->routeIs('user.index') ? 'bg-gray-200 dark:bg-gray-800 font-semibold' : '' }}">
                        <i class="mr-3 text-lg ri-user-3-line"></i>
                        <span>Kelola User</span>
                    </a>
                </li>

                <li class="mt-2 mb-1 group">
                    <a href="{{ route('laporan.index') }}" class="flex items-center py-2 px-4 rounded-md text-sm text-gray-800 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-black dark:hover:text-white {{ request()->routeIs('laporan.index') ? 'bg-gray-200 dark:bg-gray-800 font-semibold' : '' }}">
                        <i class="mr-3 text-lg ri-time-line"></i>
                        <span>Riwayat Penjualan</span>
                    </a>
                </li>
            </div>
        @endif
    </ul>
</div>

<div class="fixed top-0 left-0 z-40 w-full h-full bg-black/50 dark:bg-gray-900 md:hidden sidebar-overlay"></div>
