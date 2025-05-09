<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/png">
    <title>SiCekam</title>
    @vite(['resources/css/app.css', 'resources/js/admin.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <style>
        @keyframes pulse {

            0%,
            100% {
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
        <x-sidebar-admin />

        <div class="ml-64 p-6">
            <!-- Header -->
            <div class="flex justify-between items-center pb-4">
                <h1 class="text-2xl font-semibold">Dashboard</h1>
                <div class="flex items-center space-x-4">
                    <div class="flex space-x-2">
                        <input type="date" id="dateFilter" class="border rounded-md px-3 py-1 text-sm">
                        <button id="filterButton"
                            class="bg-indigo-500 hover:bg-indigo-300 text-white px-3 py-1 rounded-md text-sm">
                            <i class="fas fa-search mr-1"></i> Filter
                        </button>
                    </div>
                </div>
            </div>

            <div id="loadingSpinner" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-25 z-50">
                <div class="p-4 bg-white rounded-lg shadow-xl flex items-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
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
</body>

</html>
