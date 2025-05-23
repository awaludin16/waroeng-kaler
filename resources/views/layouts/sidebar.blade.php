<div
    class="fixed top-0 left-0 z-50 w-64 h-full p-4 transition-transform bg-gray-900 rounded-r-2xl dark:bg-gray-900 dark:text-white sidebar-menu">
    <a href="#" class="flex items-center justify-center pt-2 pb-4 border-b border-b-gray-800">
        <img src="https://placehold.co/32x32" alt="" class="object-cover w-8 h-8 rounded">
        <span class="ml-3 text-lg font-semibold text-white">Waroeng Kaler</span>
    </a>
    <ul class="mt-4">
        <x-tailadmin.navlink href="{{ route('dashboard') }}" icon="ri-home-2-line">
            Dasbhboard
        </x-tailadmin.navlink>
        <x-tailadmin.navlink href="{{ route('menu.index') }}" icon="ri-drinks-line">
            Menu
        </x-tailadmin.navlink>
        <li class="mb-1 group">
            <a href="#"
                class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                <i class="mr-3 text-lg ri-instance-line"></i>
                <span class="text-sm">Auth</span>
                <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
            </a>
            <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                <li class="mb-4">
                    <a href="./login.html"
                        class="text-gray-300 text-sm flex items-center hover:text-gray-100 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Login</a>
                </li>
                <li class="mb-4">
                    <a href="./register.html"
                        class="text-gray-300 text-sm flex items-center hover:text-gray-100 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Register</a>
                </li>
                <li class="mb-4">
                    <a href="#"
                        class="text-gray-300 text-sm flex items-center hover:text-gray-100 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Canceled
                        order</a>
                </li>
            </ul>
        </li>
        <li class="mb-1 group">
            <a href="#"
                class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                <i class="mr-3 text-lg ri-flashlight-line"></i>
                <span class="text-sm">Services</span>
                <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
            </a>
            <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                <li class="mb-4">
                    <a href="#"
                        class="text-gray-300 text-sm flex items-center hover:text-gray-100 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Manage
                        services</a>
                </li>
            </ul>
        </li>
        <li class="mb-1 group">
            <a href="#"
                class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class="mr-3 text-lg ri-settings-2-line"></i>
                <span class="text-sm">Settings</span>
            </a>
        </li>
    </ul>
</div>
<div
    class="fixed top-0 left-0 z-40 w-full h-full dark:bg-gray-900 dark:text-white bg-black/50 md:hidden sidebar-overlay">
</div>
