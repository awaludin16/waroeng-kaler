@props(['title' => ''])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ? $title . ' | Cafe Admin' : 'Cafe Admin' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="text-gray-800 bg-gray-100">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md">
            <div class="p-4 text-2xl font-bold border-b">Cafe Admin</div>
            <nav class="mt-4 space-y-1">
                <a href="{{ route('pesanan.index') }}" class="block px-4 py-2 hover:bg-gray-200">Pesanan</a>

                @if (auth()->user()->isOwner())
                    <a href="{{ route('owner.laporan') }}" class="block px-4 py-2 hover:bg-gray-200">Laporan</a>
                @endif

                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 text-left text-red-600 hover:bg-red-100">
                        Logout
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main content -->
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>
    </div>

</body>

</html>
