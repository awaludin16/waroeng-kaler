@props(['breadcrumbs' => []])

<!-- start: Navbar -->
<div
    class="sticky top-0 left-0 z-30 flex items-center px-6 py-2 bg-white shadow dark:bg-gray-900 dark:text-white shadow-black/5">
    <button type="button" class="text-lg text-gray-600 sidebar-toggle">
        <i class="ri-menu-line"></i>
    </button>

    {{-- Breadcrumb --}}
    <ul class="flex items-center ml-4 text-sm">
        @foreach ($breadcrumbs as $index => $breadcrumb)
            @if (isset($breadcrumb['url']))
                <li class="mr-2">
                    <a href="{{ $breadcrumb['url'] }}" class="font-medium text-gray-400 hover:text-gray-600">
                        {{ $breadcrumb['label'] }}
                    </a>
                </li>
            @else
                <li aria-current="page" class="mr-2 font-medium text-gray-600 before:content-['/']">
                    {{ $breadcrumb['label'] }}</li>
            @endif
        @endforeach
    </ul>

    <ul class="flex items-center p-2 ml-auto">
        <button id="toggleDarkMode"
            class="flex items-center justify-center w-8 h-8 text-gray-400 rounded dropdown-toggle hover:bg-gray-50 hover:text-gray-600">
            <i class="ri-moon-line"></i>
        </button>

        <li class="dropdown">
            <button type="button"
                class="flex items-center justify-center w-8 h-8 text-gray-400 rounded dropdown-toggle hover:bg-gray-50 hover:text-gray-600">
                <i class="ri-notification-3-line"></i>
            </button>
            <div
                class="z-30 hidden w-full max-w-xs bg-white border border-gray-100 rounded-md shadow-md dropdown-menu shadow-black/5">
                <div class="flex items-center px-4 pt-4 border-b border-b-gray-100 notification-tab">
                    <button type="button" data-tab="notification" data-tab-page="notifications"
                        class="text-gray-400 font-medium text-[13px] hover:text-gray-600 border-b-2 border-b-transparent mr-4 pb-1 active">Notifications</button>
                    <button type="button" data-tab="notification" data-tab-page="messages"
                        class="text-gray-400 font-medium text-[13px] hover:text-gray-600 border-b-2 border-b-transparent mr-4 pb-1">Messages</button>
                </div>
                <div class="my-2">
                    <ul class="overflow-y-auto max-h-64" data-tab-for="notification" data-page="notifications">
                        <li>
                            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-50 group">
                                <img src="https://placehold.co/32x32" alt=""
                                    class="block object-cover w-8 h-8 align-middle rounded">
                                <div class="ml-2">
                                    <div
                                        class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">
                                        New order</div>
                                    <div class="text-[11px] text-gray-400">from a user</div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-50 group">
                                <img src="https://placehold.co/32x32" alt=""
                                    class="block object-cover w-8 h-8 align-middle rounded">
                                <div class="ml-2">
                                    <div
                                        class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">
                                        New order</div>
                                    <div class="text-[11px] text-gray-400">from a user</div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-50 group">
                                <img src="https://placehold.co/32x32" alt=""
                                    class="block object-cover w-8 h-8 align-middle rounded">
                                <div class="ml-2">
                                    <div
                                        class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">
                                        New order</div>
                                    <div class="text-[11px] text-gray-400">from a user</div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-50 group">
                                <img src="https://placehold.co/32x32" alt=""
                                    class="block object-cover w-8 h-8 align-middle rounded">
                                <div class="ml-2">
                                    <div
                                        class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">
                                        New order</div>
                                    <div class="text-[11px] text-gray-400">from a user</div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-50 group">
                                <img src="https://placehold.co/32x32" alt=""
                                    class="block object-cover w-8 h-8 align-middle rounded">
                                <div class="ml-2">
                                    <div
                                        class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">
                                        New order</div>
                                    <div class="text-[11px] text-gray-400">from a user</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <ul class="hidden overflow-y-auto max-h-64" data-tab-for="notification" data-page="messages">
                        <li>
                            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-50 group">
                                <img src="https://placehold.co/32x32" alt=""
                                    class="block object-cover w-8 h-8 align-middle rounded">
                                <div class="ml-2">
                                    <div
                                        class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">
                                        John Doe</div>
                                    <div class="text-[11px] text-gray-400">Hello there!</div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-50 group">
                                <img src="https://placehold.co/32x32" alt=""
                                    class="block object-cover w-8 h-8 align-middle rounded">
                                <div class="ml-2">
                                    <div
                                        class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">
                                        John Doe</div>
                                    <div class="text-[11px] text-gray-400">Hello there!</div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-50 group">
                                <img src="https://placehold.co/32x32" alt=""
                                    class="block object-cover w-8 h-8 align-middle rounded">
                                <div class="ml-2">
                                    <div
                                        class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">
                                        John Doe</div>
                                    <div class="text-[11px] text-gray-400">Hello there!</div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-50 group">
                                <img src="https://placehold.co/32x32" alt=""
                                    class="block object-cover w-8 h-8 align-middle rounded">
                                <div class="ml-2">
                                    <div
                                        class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">
                                        John Doe</div>
                                    <div class="text-[11px] text-gray-400">Hello there!</div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-50 group">
                                <img src="https://placehold.co/32x32" alt=""
                                    class="block object-cover w-8 h-8 align-middle rounded">
                                <div class="ml-2">
                                    <div
                                        class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">
                                        John Doe</div>
                                    <div class="text-[11px] text-gray-400">Hello there!</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </li>
        <li class="ml-3 dropdown">
            <button type="button" class="flex items-center dropdown-toggle">
                <img src="https://placehold.co/32x32" alt=""
                    class="block object-cover w-8 h-8 align-middle rounded">
            </button>
            <ul
                class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                <li class="flex">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Logout') }}
                        </x-dropdown-link>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</div>
<!-- end: Navbar -->
