<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/png">
  <title>SiCekam</title>
  @vite(['resources/css/app.css', 'resources/js/ayam.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <x-sidebar-admin />

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
                                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-500 uppercase">Hasil Scan</th>
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
    <div id="modalBlok" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex hidden items-center justify-center">
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
                        <label for="scan" class="block text-sm font-medium text-gray-700 mb-1">Hasil Scan</label>
                        <input type="number" id="scan" class="w-full px-3 py-2 border border-gray-300 rounded-md" min="0" required>
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
    <div id="modalKonfirmasi" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex hidden items-center justify-center">
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
</body>
</html>
