<x-admin-layout>
    <x-slot name="navbar">
        <x-tailadmin.navbar :breadcrumbs="[['label' => 'user']]" />
    </x-slot>

    <div class="flex items-center justify-between mb-4 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <h4 class="text-2xl font-medium">Daftar User</h4>
        <a href="#"
            class="inline-block px-5 py-3 text-xs font-semibold text-center text-white align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
            New User
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
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900">#</th>
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900">Name</th>
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900">Role</th>
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900">Email</th>
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900">Created At</th>
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900">Last Login</th>
                    <th scope="col" class="px-6 py-3 font-medium text-gray-900"></th>
                </tr>
            </thead>
            <tbody class="border-t border-gray-100 divide-y divide-gray-100">
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3">{{ $user->name }}</td>
                        <td class="px-6 py-3">
                            @if ($user->role === 'kasir')
                                <span
                                    class="inline-flex items-center justify-center rounded-full bg-indigo-200 px-2.5 py-0.5 text-indigo-700">
                                    <p class="text-sm whitespace-nowrap">{{ Str::ucfirst($user->role) }}</p>
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center justify-center rounded-full bg-cyan-200 px-2.5 py-0.5 text-cyan-700">
                                    <p class="text-sm whitespace-nowrap">{{ Str::ucfirst($user->role) }}</p>
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-3">{{ $user->email }}</td>
                        <td class="px-6 py-3">{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</td>
                        <td class="px-6 py-3">
                            {{ $user->last_login_at ? \Carbon\Carbon::parse($user->last_login_at)->format('d/m/Y') : '-' }}
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex justify-end gap-4">
                                <a href="#">
                                    <i class="text-xl ri-edit-box-line hover:text-slate-700"></i>
                                </a>
                                <form action="#" method="POST" style="display:inline-block;"
                                    onsubmit="return confirm('Yakin ingin menghapus?')">
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
        {{ $users->links() }}
    </div>
</x-admin-layout>
