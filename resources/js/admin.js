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
