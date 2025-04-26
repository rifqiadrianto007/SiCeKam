<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/png">
  <title>SiCekam</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <style>
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
        .animate-pulse {
            animation: pulse 1.5s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        .chart-container {
            height: calc(100vh - 400px);
            min-height: 350px;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased">
        <!-- Sidebar -->
        <div class="fixed flex flex-col top-0 left-0 w-64 bg-indigo-500 h-full shadow-lg sidebar">
            <div class="flex items-center justify-center h-14 border-b border-indigo-300">
                <div class="text-white text-xl font-bold">SiCekam</div>
            </div>
            <div class="overflow-y-auto overflow-x-hidden flex-grow">
                <ul class="flex flex-col space-y-1 py-4">
                    <li>
                        <a href="{{ route('admin') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-indigo-400 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-blue-500 pr-6 {{ request()->routeIs('admin') ? 'active-nav border-blue-500 bg-indigo-400' : '' }}">
                            <span class="inline-flex justify-center items-center ml-4">
                                <i class="fas fa-tachometer-alt"></i>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate text-white">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('ayam') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-indigo-400 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-blue-500 pr-6 {{ request()->routeIs('ayam*') ? 'active-nav border-blue-500 bg-indigo-400' : '' }}">
                            <span class="inline-flex justify-center items-center ml-4">
                                <i class="fas fa-warehouse"></i>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate text-white">
                                Blok Kandang
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('akun') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-indigo-400 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-blue-500 pr-6 {{ request()->routeIs('akun*') ? 'active-nav border-blue-500 bg-indigo-400' : '' }}">
                            <span class="inline-flex justify-center items-center ml-4">
                                <i class="fas fa-users-cog"></i>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate text-white">
                                Manajemen Pengguna
                            </span>
                        </a>
                    </li>
                    <li class="mt-auto">
                        <a href="{{ route('login') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-indigo-400 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-blue-500 pr-6">
                            <span class="inline-flex justify-center items-center ml-4">
                                <i class="fas fa-sign-out-alt"></i>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate text-white">
                                Keluar
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="ml-64 p-6">
            <!-- Header -->
            <div class="flex justify-between items-center pb-4">
                <h1 class="text-2xl font-semibold">Dashboard</h1>
                <div class="flex items-center space-x-4">
                    <div class="flex space-x-2">
                        <input type="date" id="dateFilter" class="border rounded-md px-3 py-1 text-sm">
                        <button id="filterButton" class="bg-indigo-500 hover:bg-indigo-300 text-white px-3 py-1 rounded-md text-sm">
                            <i class="fas fa-search mr-1"></i> Filter
                        </button>
                    </div>
                </div>
            </div>

            <div id="loadingSpinner" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-25 z-50">
                <div class="p-4 bg-white rounded-lg shadow-xl flex items-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Memuat data...</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-blue-500 summary-card">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                            <i class="fas fa-warehouse text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500 font-medium">Total Blok</p>
                            <p class="text-2xl font-semibold" id="totalBlok">6</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-green-500 summary-card">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-500">
                            <i class="fas fa-feather-alt text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500 font-medium">Total Ayam</p>
                            <p class="text-2xl font-semibold" id="totalAyam">3,892</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-yellow-500 summary-card">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-500">
                            <i class="fas fa-stethoscope text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500 font-medium">Ayam Diperiksa</p>
                            <p class="text-2xl font-semibold" id="ayamDiperiksa">2,819</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-red-500 summary-card">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-100 text-red-500">
                            <i class="fas fa-exclamation-triangle text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500 font-medium">Ayam Sakit</p>
                            <p class="text-2xl font-semibold" id="ayamSakit">88</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-4 mb-6">
                <h2 class="text-lg font-medium mb-3">Status Kesehatan Ayam</h2>
                <div class="w-full bg-gray-200 rounded-full h-4">
                    <div id="healthPercentage" class="bg-indigo-500 h-4 rounded-full" style="width: 97.7%"></div>
                </div>
                <div class="flex justify-between mt-2 text-sm text-gray-500">
                    <span>Total Ayam: <span class="font-medium text-gray-700">3,892</span></span>
                    <span id="healthPercentageText" class="font-medium text-indigo-500">97.7% Sehat</span>
                    <span>Ayam Sakit: <span class="font-medium text-red-500">88</span></span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow-md p-4">
                    <h2 class="text-lg font-medium mb-2">Distribusi Ayam per Blok</h2>
                    <div class="chart-container">
                        <canvas id="distributionChart"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-4">
                    <h2 class="text-lg font-medium mb-2">Status Pemeriksaan</h2>
                    <div class="chart-container">
                        <canvas id="healthChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Menunggu DOM selesai dimuat sebelum menjalankan script
    document.addEventListener('DOMContentLoaded', function() {
        // ===== FUNGSI FILTER TANGGAL =====
        const dateFilter = document.getElementById('dateFilter');
        const filterButton = document.getElementById('filterButton');

        if (dateFilter && filterButton) {
            // Set tanggal default ke hari ini
            const today = new Date().toISOString().split('T')[0];
            dateFilter.value = today;

            filterButton.addEventListener('click', function() {
                const selectedDate = dateFilter.value;
                console.log('Memfilter data untuk tanggal:', selectedDate);
                // Di sini nantinya akan ada kode untuk memuat data sesuai tanggal
                loadDashboardData(selectedDate);
            });
        }

        // ===== FUNGSI MUAT DATA DASHBOARD =====
        function loadDashboardData(date) {
            // Simulasi loading data
            showLoading();

            // Dalam implementasi nyata, ini akan diganti dengan API call
            // Contoh fetch API:
            // fetch('/api/dashboard-data?date=' + date)
            //   .then(response => response.json())
            //   .then(data => updateDashboard(data))
            //   .catch(error => console.error('Error loading dashboard data:', error))
            //   .finally(() => hideLoading());

            // Simulasi delay untuk demo
            setTimeout(() => {
                // Data dummy sesuai dengan screenshot
                const dummyData = {
                    totalBlok: 6,
                    totalAyam: 3892,
                    ayamDiperiksa: 2819,
                    ayamSakit: 88,
                    blokDistribution: [
                        { blok: 'Blok A', count: 433 },
                        { blok: 'Blok B', count: 425 },
                        { blok: 'Blok C', count: 611 },
                        { blok: 'Blok D', count: 576 },
                        { blok: 'Blok E', count: 811 },
                        { blok: 'Blok F', count: 807 }
                    ]
                };

                updateDashboard(dummyData);
                hideLoading();
            }, 800);
        }

        // ===== FUNGSI UPDATE UI DASHBOARD =====
        function updateDashboard(data) {
            // Update kartu ringkasan
            document.getElementById('totalBlok').textContent = data.totalBlok;
            document.getElementById('totalAyam').textContent = new Intl.NumberFormat('id-ID').format(data.totalAyam);
            document.getElementById('ayamDiperiksa').textContent = new Intl.NumberFormat('id-ID').format(data.ayamDiperiksa);
            document.getElementById('ayamSakit').textContent = new Intl.NumberFormat('id-ID').format(data.ayamSakit);

            // Update persentase kesehatan
            const healthPercentage = 100 - (data.ayamSakit / data.totalAyam * 100);
            document.getElementById('healthPercentage').style.width = `${healthPercentage.toFixed(1)}%`;
            document.getElementById('healthPercentageText').textContent = `${healthPercentage.toFixed(1)}% Sehat`;

            // Update grafik
            updateCharts(data);
        }

        // ===== FUNGSI UTILITAS =====
        function showLoading() {
            // Menampilkan indikator loading
            const cards = document.querySelectorAll('.summary-card');
            cards.forEach(card => {
                card.classList.add('opacity-50');
            });

            // Jika ada elemen loading spinner, tampilkan
            const spinner = document.getElementById('loadingSpinner');
            if (spinner) spinner.classList.remove('hidden');
        }

        function hideLoading() {
            // Menyembunyikan indikator loading
            const cards = document.querySelectorAll('.summary-card');
            cards.forEach(card => {
                card.classList.remove('opacity-50');
            });

            // Jika ada elemen loading spinner, sembunyikan
            const spinner = document.getElementById('loadingSpinner');
            if (spinner) spinner.classList.add('hidden');
        }

        // Menambahkan listener untuk resize chart ketika window di-resize
        window.addEventListener('resize', function() {
            if (distributionChart) distributionChart.resize();
            if (healthChart) healthChart.resize();
        });

        // Variabel untuk menyimpan instance chart
        let distributionChart = null;
        let healthChart = null;

        // ===== FUNGSI UPDATE GRAFIK =====
        function updateCharts(data) {
            // Persiapkan data untuk grafik distribusi per blok
            const blokLabels = data.blokDistribution.map(item => item.blok);
            const blokData = data.blokDistribution.map(item => item.count);

            // Persiapkan data untuk grafik status pemeriksaan
            const belumDiperiksa = data.totalAyam - data.ayamDiperiksa;
            const ayamSehat = data.ayamDiperiksa - data.ayamSakit;

            // Update grafik distribusi per blok
            updateDistributionChart(blokLabels, blokData);

            // Update grafik status pemeriksaan (pie chart)
            updateHealthChart(ayamSehat, data.ayamSakit, belumDiperiksa);
        }

        function updateDistributionChart(labels, data) {
            const ctx = document.getElementById('distributionChart').getContext('2d');

            // Hapus chart lama jika ada
            if (distributionChart) {
                distributionChart.destroy();
            }

            // Buat chart baru
            distributionChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Ayam',
                        data: data,
                        backgroundColor: 'rgba(63, 81, 181, 1)',
                        borderColor: 'rgba(63, 81, 181, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        title: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Ayam',
                                font: {
                                    size: 14
                                }
                            },
                            grid: {
                                drawBorder: false
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Blok Kandang',
                                font: {
                                    size: 14
                                }
                            },
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }

        function updateHealthChart(ayamSehat, ayamSakit, belumDiperiksa) {
            const ctx = document.getElementById('healthChart').getContext('2d');

            // Hapus chart lama jika ada
            if (healthChart) {
                healthChart.destroy();
            }

            // Buat chart baru
            healthChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Sehat', 'Sakit', 'Belum Diperiksa'],
                    datasets: [{
                        data: [ayamSehat, ayamSakit, belumDiperiksa],
                        backgroundColor: [
                            'rgba(63, 81, 181, 1)',
                            'rgba(159, 168, 218, 1)',
                            'rgba(201, 203, 207, 0.7)'
                        ],
                        borderColor: [
                            'rgba(63, 81, 181, 1)',
                            'rgba(159, 168, 218, 1)',
                            'rgba(201, 203, 207, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                font: {
                                    size: 14
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((acc, val) => acc + val, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });
        }

        // Load data awal
        loadDashboardData(new Date().toISOString().split('T')[0]);
    });
    </script>
</body>
</html>
