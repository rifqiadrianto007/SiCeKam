@vite(['resources/css/app.css'])

@extends('layout.adm')

@section('content')
    <div class="ml-64 p-8 bg-gradient-to-br from-slate-50 to-slate-100 min-h-screen">
        <div class="flex justify-between items-center pb-8">
            <div class="space-y-1">
                <h1 class="text-3xl font-bold bg-gradient-to-r from-slate-800 to-slate-600 bg-clip-text text-transparent">
                    Dashboard Peternakan
                </h1>
                <p class="text-slate-500 text-sm">Kelola dan pantau peternakan ayam Anda</p>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-home text-blue-600 text-lg"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Blok</p>
                        <p class="text-2xl font-bold text-gray-900" id="totalBlok">{{ $totalBlok }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-kiwi-bird text-green-600 text-lg"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Ayam</p>
                        <p class="text-2xl font-bold text-gray-900" id="totalAyam">{{ number_format($totalAyam) }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="bg-red-100 p-3 rounded-full">
                        <i class="fas fa-exclamation-triangle text-red-600 text-lg"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Ayam Sakit</p>
                        <p class="text-2xl font-bold text-gray-900" id="ayamSakit">{{ number_format($ayamSakit) }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <i class="fas fa-chart-line text-yellow-600 text-lg"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Tingkat Kesehatan</p>
                        <p class="text-2xl font-bold text-gray-900"
                        id="healthPercentageText">{{ $persentaseSehat }}%
                        </p>
                    </div>
                </div>
            </div>
        </div>


        <!-- Chart Section dengan desain premium -->
        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-xl border border-white/20 p-8 hover:shadow-2xl transition-all duration-300">
            <div class="flex items-center justify-between mb-6">
                <div class="space-y-1">
                    <h2 class="text-2xl font-bold text-slate-800">Distribusi Ayam per Blok</h2>
                    <p class="text-slate-500 text-sm">Analisis distribusi populasi</p>
                </div>
            </div>

            <div class="relative">
                <div class="h-[400px] lg:h-[450px]">
                    <canvas id="distributionChart"></canvas>
                </div>

                <!-- Chart Overlay untuk efek premium -->
                <div class="absolute top-0 left-0 w-full h-full pointer-events-none">
                    <div class="w-full h-full bg-gradient-to-t from-white/5 to-transparent rounded-2xl"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Animasi loading
        document.addEventListener('DOMContentLoaded', function() {
            // Animate summary cards
            const cards = document.querySelectorAll('.group');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease-out';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });

        const ctx = document.getElementById('distributionChart').getContext('2d');

        // Gradient untuk chart
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(79, 70, 229, 0.8)');
        gradient.addColorStop(0.5, 'rgba(124, 58, 237, 0.6)');
        gradient.addColorStop(1, 'rgba(79, 70, 229, 0.3)');

        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($distribusi->pluck('blok')) !!},
                datasets: [{
                    label: 'Jumlah Ayam',
                    data: {!! json_encode($distribusi->pluck('jumlah_ayam')) !!},
                    backgroundColor: gradient,
                    borderColor: 'rgba(79, 70, 229, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: 'rgba(79, 70, 229, 1)',
                        borderWidth: 1,
                        cornerRadius: 12,
                        displayColors: false,
                        callbacks: {
                            title: function(context) {
                                return 'Blok ' + context[0].label;
                            },
                            label: function(context) {
                                return 'Jumlah: ' + context.parsed.y.toLocaleString() + ' ekor';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false,
                        },
                        ticks: {
                            color: '#64748b',
                            font: {
                                size: 12,
                                weight: '500'
                            },
                            callback: function(value) {
                                return value.toLocaleString();
                            }
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Ayam (ekor)',
                            color: '#475569',
                            font: {
                                size: 14,
                                weight: '600'
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                        },
                        ticks: {
                            color: '#64748b',
                            font: {
                                size: 12,
                                weight: '500'
                            }
                        },
                        title: {
                            display: true,
                            text: 'Blok Kandang',
                            color: '#475569',
                            font: {
                                size: 14,
                                weight: '600'
                            }
                        }
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart'
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
    </script>

    <style>
        /* Custom animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .summary-card {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        /* Glassmorphism effect */
        .backdrop-blur-xl {
            backdrop-filter: blur(16px);
        }

        /* Hover effects */
        .group:hover .fas {
            transform: scale(1.1);
            transition: transform 0.2s ease;
        }

        /* Progress bar animation */
        #healthPercentage {
            background-size: 200% 100%;
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
    </style>
@endsection
