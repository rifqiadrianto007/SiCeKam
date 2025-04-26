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
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="fixed flex flex-col top-0 left-0 w-64 bg-indigo-500 h-full shadow-lg">
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

        <!-- Content Area - Adjusted margin to accommodate sidebar -->
        <div class="ml-64 flex-1 p-6 w-full">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Blok Kandang</h1>
            </div>

            <!-- Distribusi Ayam per Blok Card -->
            <div class="bg-white rounded-lg shadow-sm mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-gray-700">Distribusi Ayam per Blok</h2>
                        <button id="btnTambahBlok" class="bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg px-4 py-2 flex items-center">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Blok
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b">
                                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-500 uppercase">ID</th>
                                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-500 uppercase">Nama Blok</th>
                                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-500 uppercase">Jumlah Ayam</th>
                                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-500 uppercase">Kapasitas</th>
                                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-500 uppercase">Status</th>
                                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tabelBlok">
                                <!-- Data akan diisi oleh JavaScript -->
                            </tbody>
                        </table>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <p class="text-blue-600 font-medium">Total Blok</p>
                            <p class="text-3xl font-bold text-gray-800" id="totalBlok">5</p>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <p class="text-green-600 font-medium">Total Ayam</p>
                            <p class="text-3xl font-bold text-gray-800" id="totalAyam">5800</p>
                        </div>
                        <div class="bg-purple-50 p-4 rounded-lg">
                            <p class="text-purple-600 font-medium">Kapasitas Total</p>
                            <p class="text-3xl font-bold text-gray-800" id="totalKapasitas">6500</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit Blok -->
    <div id="modalBlok" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900 text-center" id="modalTitle">Tambah Blok Baru</h3>
                    <button class="text-gray-400 hover:text-gray-500" id="btnCloseModal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form id="formBlok">
                    <input type="hidden" id="blokId">

                    <div class="mb-4">
                        <label for="namaBlok" class="block text-sm font-medium text-gray-700 mb-1">Nama Blok</label>
                        <input type="text" id="namaBlok" class="w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="Contoh: Blok A" required>
                    </div>

                    <div class="mb-4">
                        <label for="jumlahAyam" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Ayam</label>
                        <input type="number" id="jumlahAyam" class="w-full px-3 py-2 border border-gray-300 rounded-md" min="0" required>
                    </div>

                    <div class="mb-4">
                        <label for="kapasitas" class="block text-sm font-medium text-gray-700 mb-1">Kapasitas</label>
                        <input type="number" id="kapasitas" class="w-full px-3 py-2 border border-gray-300 rounded-md" min="1" required>
                    </div>

                    <div class="mb-4">
                        <label for="statusBlok" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select id="statusBlok" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Perawatan">Perawatan</option>
                            <option value="Kosong">Kosong</option>
                        </select>
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="button" id="btnCancel" class="bg-gray-200 text-gray-700 py-2 px-4 rounded-md mr-2 hover:bg-gray-300">Batal</button>
                        <button type="submit" id="btnSimpan" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Konfirmasi Hapus -->
    <div id="modalKonfirmasi" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-sm">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-3">Konfirmasi Hapus</h3>
                <p class="text-gray-500 mb-6">Apakah Anda yakin ingin menghapus blok ini? Tindakan ini tidak dapat dibatalkan.</p>

                <div class="flex justify-end">
                    <button id="btnBatalHapus" class="bg-gray-200 text-gray-700 py-2 px-4 rounded-md mr-2 hover:bg-gray-300">Batal</button>
                    <button id="btnKonfirmasiHapus" class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data awal blok kandang
            let dataBlok = [
                { id: 1, nama: 'Blok A', jumlah: 1250, kapasitas: 1500, status: 'Aktif' },
                { id: 2, nama: 'Blok B', jumlah: 1050, kapasitas: 1200, status: 'Aktif' },
                { id: 3, nama: 'Blok C', jumlah: 1500, kapasitas: 1500, status: 'Aktif' },
                { id: 4, nama: 'Blok D', jumlah: 850, kapasitas: 1000, status: 'Aktif' },
                { id: 5, nama: 'Blok E', jumlah: 1150, kapasitas: 1300, status: 'Aktif' }
            ];

            // Elements
            const tabelBlok = document.getElementById('tabelBlok');
            const totalBlok = document.getElementById('totalBlok');
            const totalAyam = document.getElementById('totalAyam');
            const totalKapasitas = document.getElementById('totalKapasitas');
            const modalBlok = document.getElementById('modalBlok');
            const modalKonfirmasi = document.getElementById('modalKonfirmasi');
            const formBlok = document.getElementById('formBlok');
            const modalTitle = document.getElementById('modalTitle');
            const blokId = document.getElementById('blokId');
            const namaBlok = document.getElementById('namaBlok');
            const jumlahAyam = document.getElementById('jumlahAyam');
            const kapasitas = document.getElementById('kapasitas');
            const statusBlok = document.getElementById('statusBlok');
            const btnTambahBlok = document.getElementById('btnTambahBlok');
            const btnCloseModal = document.getElementById('btnCloseModal');
            const btnCancel = document.getElementById('btnCancel');
            const btnBatalHapus = document.getElementById('btnBatalHapus');
            const btnKonfirmasiHapus = document.getElementById('btnKonfirmasiHapus');

            let idToDelete = null;

            // Render tabel dan update summary
            function renderData() {
                tabelBlok.innerHTML = '';

                dataBlok.forEach(blok => {
                    const row = document.createElement('tr');
                    row.className = 'border-b hover:bg-gray-50';

                    // Status class
                    let statusClass = '';
                    if (blok.status === 'Aktif') {
                        statusClass = 'bg-green-100 text-green-800';
                    } else if (blok.status === 'Perawatan') {
                        statusClass = 'bg-yellow-100 text-yellow-800';
                    } else {
                        statusClass = 'bg-gray-100 text-gray-800';
                    }

                    // Utilization percentage
                    const utilization = Math.round((blok.jumlah / blok.kapasitas) * 100);

                    row.innerHTML = `
                        <td class="py-4 px-4">${blok.id}</td>
                        <td class="py-4 px-4 font-medium">${blok.nama}</td>
                        <td class="py-4 px-4">${blok.jumlah} ekor</td>
                        <td class="py-4 px-4">
                            <div class="flex items-center">
                                <span>${blok.kapasitas} ekor</span>
                                <div class="w-24 bg-gray-200 rounded-full h-2.5 mx-2">
                                    <div class="bg-indigo-500 h-2.5 rounded-full" style="width: ${utilization}%"></div>
                                </div>
                                <span class="text-xs text-gray-500">${utilization}%</span>
                            </div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="px-2 py-1 rounded-full text-xs ${statusClass}">
                                ${blok.status}
                            </span>
                        </td>
                        <td class="py-4 px-4">
                            <button class="text-blue-500 hover:text-blue-700 mr-2 btnEdit" data-id="${blok.id}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-red-500 hover:text-red-700 btnHapus" data-id="${blok.id}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    `;

                    tabelBlok.appendChild(row);
                });
                // Update summary
                totalBlok.textContent = dataBlok.length;
                const sumAyam = dataBlok.reduce((sum, blok) => sum + blok.jumlah, 0);
                totalAyam.textContent = sumAyam;
                const sumKapasitas = dataBlok.reduce((sum, blok) => sum + blok.kapasitas, 0);
                totalKapasitas.textContent = sumKapasitas;
                // Add event listeners to edit and delete buttons
                document.querySelectorAll('.btnEdit').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const id = parseInt(this.getAttribute('data-id'));
                        editBlok(id);
                    });
                });

                document.querySelectorAll('.btnHapus').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const id = parseInt(this.getAttribute('data-id'));
                        showDeleteConfirmation(id);
                    });
                });
            }
            // Open modal for adding new block
            function showAddModal() {
                modalTitle.textContent = 'Tambah Blok Baru';
                blokId.value = '';
                formBlok.reset();
                modalBlok.classList.remove('hidden');
                modalBlok.classList.add('flex');
            }
            // Open modal for editing a block
            function editBlok(id) {
                const blok = dataBlok.find(b => b.id === id);
                if (blok) {
                    modalTitle.textContent = 'Edit Blok';
                    blokId.value = blok.id;
                    namaBlok.value = blok.nama;
                    jumlahAyam.value = blok.jumlah;
                    kapasitas.value = blok.kapasitas;
                    statusBlok.value = blok.status;

                    modalBlok.classList.remove('hidden');
                    modalBlok.classList.add('flex');
                }
            }
            // Show delete confirmation
            function showDeleteConfirmation(id) {
                idToDelete = id;
                modalKonfirmasi.classList.remove('hidden');
                modalKonfirmasi.classList.add('flex');
            }
            // Delete block
            function deleteBlok(id) {
                dataBlok = dataBlok.filter(blok => blok.id !== id);
                renderData();
                closeDeleteModal();
            }
            // Close modals
            function closeModal() {
                modalBlok.classList.add('hidden');
                modalBlok.classList.remove('flex');
            }

            function closeDeleteModal() {
                modalKonfirmasi.classList.add('hidden');
                modalKonfirmasi.classList.remove('flex');
                idToDelete = null;
            }
            // Save block data (add or edit)
            function saveBlok(e) {
                e.preventDefault();

                const id = blokId.value ? parseInt(blokId.value) : Math.max(...dataBlok.map(b => b.id), 0) + 1;
                const nama = namaBlok.value;
                const jumlah = parseInt(jumlahAyam.value);
                const kap = parseInt(kapasitas.value);
                const status = statusBlok.value;

                if (blokId.value) {
                    // Edit existing
                    const index = dataBlok.findIndex(b => b.id === parseInt(blokId.value));
                    if (index !== -1) {
                        dataBlok[index] = { id, nama, jumlah, kapasitas: kap, status };
                    }
                } else {
                    // Add new
                    dataBlok.push({ id, nama, jumlah, kapasitas: kap, status });
                }

                renderData();
                closeModal();
            }
            // Event listeners
            btnTambahBlok.addEventListener('click', showAddModal);
            btnCloseModal.addEventListener('click', closeModal);
            btnCancel.addEventListener('click', closeModal);
            formBlok.addEventListener('submit', saveBlok);
            btnBatalHapus.addEventListener('click', closeDeleteModal);
            btnKonfirmasiHapus.addEventListener('click', function() {
                if (idToDelete) {
                    deleteBlok(idToDelete);
                }
            });
            // Initial render
            renderData();
        });
    </script>
</body>
</html>
