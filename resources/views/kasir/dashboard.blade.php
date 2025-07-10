<x-admin-layout>
    <x-slot name="navbar">
        <x-tailadmin.navbar :breadcrumbs="[['label' => 'dashboard']]" />
    </x-slot>

    {{-- Card Stats --}}
    <div class="grid mb-12 gap-y-10 gap-x-6 md:grid-cols-2 lg:grid-cols-4">
        <!-- Total Menu -->
        <div
            class="relative flex flex-col bg-white border shadow-md text-slate-700 dark:text-white dark:border-gray-700 dark:bg-gray-800 rounded-xl">
            <div
                class="absolute grid w-12 h-12 mx-4 mt-4 bg-gradient-to-tr from-indigo-700 to-indigo-500 rounded-xl place-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M9 2a1 1 0 00-.894.553L7.382 4H5a2 2 0 00-2 2v9a2 2 0 002 2h10a2 2 0 002-2V6a2 2 0 00-2-2h-2.382l-.724-1.447A1 1 0 0011 2H9z" />
                    <path d="M8 10h4M8 14h4M8 6h.01" />
                </svg>
            </div>
            <div class="p-4 text-right">
                <p class="text-sm dark:text-gray-300">Total Menu</p>
                <h4 class="text-2xl font-semibold">{{ $totalMenu }}</h4>
            </div>
            <div class="p-4 border-t dark:border-gray-700">
                <p class="text-base dark:text-gray-400">Data menu yang tersedia</p>
            </div>
        </div>

        <!-- Pesanan Masuk -->
        <div
            class="relative flex flex-col bg-white border shadow-md text-slate-700 dark:text-white dark:border-gray-700 dark:bg-gray-800 rounded-xl">
            <div
                class="absolute grid w-12 h-12 mx-4 mt-4 bg-gradient-to-tr from-pink-600 to-rose-500 rounded-xl place-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path
                        d="M16 11V9a4 4 0 00-8 0v2H5a1 1 0 000 2h1v4a1 1 0 001 1h6a1 1 0 001-1v-4h1a1 1 0 000-2h-1zM10 9a2 2 0 114 0v2h-4V9z" />
                </svg>
            </div>
            <div class="p-4 text-right">
                <p class="text-sm dark:text-gray-300">Pesanan Masuk</p>
                <h4 class="text-2xl font-semibold">{{ $pesananMasuk }}</h4>
            </div>
            <div class="p-4 border-t dark:border-gray-700">
                <p class="text-base dark:text-gray-400">Jumlah pesanan status <strong>Pending</strong></p>
            </div>
        </div>

        <!-- Total Daftar Pesanan -->
        <div
            class="relative flex flex-col bg-white border shadow-md text-slate-700 dark:text-white dark:border-gray-700 dark:bg-gray-800 rounded-xl">
            <div
                class="absolute grid w-12 h-12 mx-4 mt-4 bg-gradient-to-tr from-cyan-600 to-sky-500 rounded-xl place-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path
                        d="M9 2a1 1 0 00-.894.553L7.382 4H5a2 2 0 00-2 2v9a2 2 0 002 2h10a2 2 0 002-2V6a2 2 0 00-2-2h-2.382l-.724-1.447A1 1 0 0011 2H9z" />
                    <path d="M8 10h4M8 14h4M8 6h.01" />
                </svg>
            </div>
            <div class="p-4 text-right">
                <p class="text-sm dark:text-gray-300">Total Daftar Pesanan</p>
                <h4 class="text-2xl font-semibold">{{ $jumlahPesanan }}</h4>
            </div>
            <div class="p-4 border-t dark:border-gray-700">
                <p class="text-base dark:text-gray-400">Semua pesanan tercatat</p>
            </div>
        </div>

        <!-- Pendapatan Hari Ini -->
        <div
            class="relative flex flex-col bg-white border shadow-md text-slate-700 dark:text-white dark:border-gray-700 dark:bg-gray-800 rounded-xl">
            <div
                class="absolute grid w-12 h-12 mx-4 mt-4 bg-gradient-to-tr from-emerald-500 to-green-600 rounded-xl place-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a1 1 0 01-1-1v-1.27A4.987 4.987 0 016 11a5 5 0 015-5V4a1 1 0 112 0v1.27A4.987 4.987 0 0114 9a5 5 0 01-5 5v1a1 1 0 01-1 1z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="p-4 text-right">
                <p class="text-sm dark:text-gray-300">Pendapatan Hari Ini</p>
                <h4 class="text-2xl font-semibold">Rp{{ number_format($totalHarian, 0, ',', '.') }}</h4>
            </div>
            <div class="p-4 border-t dark:border-gray-700">
                <p class="text-base dark:text-gray-400">Pembayaran yang diterima</p>
            </div>
        </div>
    </div>

    {{-- Grafik Pesanan --}}
    <div class="w-full mb-12">
        <div class="p-6 bg-white border border-gray-300 shadow-md dark:bg-gray-900 dark:border-gray-700 rounded-xl">
            <h5 class="mb-4 text-lg font-semibold text-gray-800 dark:text-white">
                Grafik Orderan Masuk (7 Hari Terakhir)
            </h5>
            <canvas id="orderChart" height="120"></canvas>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('orderChart').getContext('2d');

            const lightTheme = {
                backgroundColor: 'rgba(16, 185, 129, 0.2)',
                borderColor: 'rgb(16, 185, 129)',
                pointBackgroundColor: 'rgb(16, 185, 129)',
                ticksColor: '#1e293b',
                gridColor: '#e2e8f0',
                legendColor: '#1e293b'
            };

            const darkTheme = {
                backgroundColor: 'rgba(16, 185, 129, 0.2)',
                borderColor: 'rgb(16, 185, 129)',
                pointBackgroundColor: 'rgb(16, 185, 129)',
                ticksColor: '#cbd5e1',
                gridColor: '#334155',
                legendColor: '#f1f5f9'
            };

            function getCurrentTheme() {
                return document.documentElement.classList.contains('dark') ? darkTheme : lightTheme;
            }

            function createChart(theme) {
                return new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($labels) !!},
                        datasets: [{
                            label: 'Pesanan Masuk',
                            data: {!! json_encode($data) !!},
                            fill: true,
                            backgroundColor: theme.backgroundColor,
                            borderColor: theme.borderColor,
                            tension: 0.4,
                            pointBackgroundColor: theme.pointBackgroundColor,
                            pointRadius: 5
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1,
                                    color: theme.ticksColor
                                },
                                grid: {
                                    color: theme.gridColor
                                }
                            },
                            x: {
                                ticks: {
                                    color: theme.ticksColor
                                },
                                grid: {
                                    color: theme.gridColor
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                labels: {
                                    color: theme.legendColor
                                }
                            }
                        }
                    }
                });
            }

            let currentTheme = getCurrentTheme();
            let orderChart = createChart(currentTheme);

            // Jika user mengganti mode (misalnya lewat toggle dark mode Tailwind)
            const observer = new MutationObserver(() => {
                const newTheme = getCurrentTheme();
                if (newTheme !== currentTheme) {
                    orderChart.destroy();
                    currentTheme = newTheme;
                    orderChart = createChart(currentTheme);
                }
            });

            observer.observe(document.documentElement, {
                attributes: true,
                attributeFilter: ['class']
            });
        </script>
    @endpush

</x-admin-layout>
