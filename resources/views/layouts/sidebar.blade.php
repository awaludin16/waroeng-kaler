<div
    class="fixed top-0 left-0 z-50 w-64 h-full p-4 transition-transform bg-gray-900 rounded-r-xl dark:bg-gray-900 dark:text-white sidebar-menu">
    <a href="#" class="flex items-center justify-center pt-2 pb-4 border-b border-b-gray-800">
        <img src="https://placehold.co/32x32" alt="" class="object-cover w-8 h-8 rounded">
        <span class="ml-3 text-lg font-semibold text-white">Kedai Uniko</span>
    </a>
    <ul class="mt-3">
        <x-tailadmin.navlink href="{{ route('dashboard') }}" icon="ri-home-2-line">
            Dashboard
        </x-tailadmin.navlink>
        <div class="py-2 mt-3 text-sm font-medium border-t border-t-gray-800 text-slate-600">
            <div class="mt-2">
                Interface
            </div>
            <li class="mt-2 mb-1 group">
                <a href="#"
                    class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                    <i class="mr-3 text-lg ri-restaurant-2-line"></i>
                    <span class="text-sm">Kelola Menu</span>
                    <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
                </a>
                <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                    <li class="mb-4">
                        <a href="./register.html"
                            class="text-gray-300 text-sm flex items-center hover:text-gray-100 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Kategori</a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('menus.index') }}"
                            class="text-gray-300 text-sm flex items-center hover:text-gray-100 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Menu</a>
                    </li>
                </ul>
            </li>
            <x-tailadmin.navlink href="{{ route('user.index') }}" icon="ri-user-3-line">
                Kelola User
            </x-tailadmin.navlink>
        </div>
        <div class="py-2 text-sm font-medium border-t border-t-gray-800 text-slate-600">
            <div class="mt-2">
                Services
            </div>
            <li class="mt-2 mb-1 group">
                <a href="#"
                    class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                    <i class="mr-3 text-lg ri-flashlight-line"></i>
                    <span class="text-sm">Manage Order</span>
                    <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
                </a>
                <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                    <li class="mb-4">
                        <a href="{{ route('orders.pending') }}"
                            class="text-gray-300 text-sm flex items-center hover:text-gray-100 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Order
                            Masuk</a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('orders.index') }}"
                            class="text-gray-300 text-sm flex items-center hover:text-gray-100 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Orders</a>
                    </li>
                </ul>
            </li>
            <x-tailadmin.navlink class="mt-2" href="{{ route('laporan.index') }}" icon="ri-file-list-2-line">
                Laporan
            </x-tailadmin.navlink>
        </div>
    </ul>
</div>
<div
    class="fixed top-0 left-0 z-40 w-full h-full dark:bg-gray-900 dark:text-white bg-black/50 md:hidden sidebar-overlay">
</div>
