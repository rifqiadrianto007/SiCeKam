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
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Pengguna</h1>
            </div>

            <!-- User Management Card -->
            <div class="bg-white rounded-lg shadow-sm mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-gray-700">Daftar Pengguna</h2>
                    </div>

                    <!-- Search Box -->
                    <div class="mb-4">
                        <div class="relative">
                            <input type="text" id="searchUser" placeholder="Cari pengguna..." class="w-full px-4 py-2 pl-10 pr-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <div class="absolute left-3 top-2.5 text-gray-400">
                                <i class="fas fa-search"></i>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b">
                                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-500 uppercase">ID</th>
                                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-500 uppercase">Nama</th>
                                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-500 uppercase">Username</th>
                                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-500 uppercase">Email</th>
                                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tabelPengguna">
                                <!-- Data akan diisi oleh JavaScript -->
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-between items-center mt-4">
                        <div class="text-sm text-gray-500">
                            Menampilkan <span id="displayedUsers">5</span> dari <span id="totalUsers">5</span> pengguna
                        </div>
                        <div class="flex">
                            <button class="px-3 py-1 border border-gray-300 rounded-l-md bg-white text-gray-500 hover:bg-gray-100">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="px-3 py-1 border border-gray-300 rounded-r-md bg-white text-gray-500 hover:bg-gray-100">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Pengguna -->
    <div id="modalPengguna" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Edit Pengguna</h3>
                    <button class="text-gray-400 hover:text-gray-500" id="btnCloseModal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form id="formPengguna">
                    <input type="hidden" id="penggunaId">

                    <div class="mb-4">
                        <label for="namaPengguna" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" id="namaPengguna" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    </div>

                    <div class="mb-4">
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                        <input type="text" id="username" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
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
    <div id="modalKonfirmasi" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-sm">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-3">Konfirmasi Hapus</h3>
                <p class="text-gray-500 mb-6">Apakah Anda yakin ingin menghapus pengguna ini?</p>

                <div class="flex justify-end">
                    <button id="btnBatalHapus" class="bg-gray-200 text-gray-700 py-2 px-4 rounded-md mr-2 hover:bg-gray-300">Batal</button>
                    <button id="btnKonfirmasiHapus" class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data awal pengguna
            let dataPengguna = [
                { id: 1, nama: 'Ahmad Fauzi', username: 'fauziadmin', email: 'ahmad.fauzi@sicekam.com' },
                { id: 2, nama: 'Budi Santoso', username: 'budipeternak', email: 'budi.santoso@sicekam.com' },
                { id: 3, nama: 'Citra Dewi', username: 'citradmin', email: 'citra.dewi@sicekam.com' },
                { id: 4, nama: 'Dian Pratama', username: 'dianpengawas', email: 'dian.pratama@sicekam.com' },
                { id: 5, nama: 'Eka Saputra', username: 'ekapeternak', email: 'eka.saputra@sicekam.com' }
            ];

            // Elements
            const tabelPengguna = document.getElementById('tabelPengguna');
            const modalPengguna = document.getElementById('modalPengguna');
            const modalKonfirmasi = document.getElementById('modalKonfirmasi');
            const formPengguna = document.getElementById('formPengguna');
            const penggunaId = document.getElementById('penggunaId');
            const namaPengguna = document.getElementById('namaPengguna');
            const username = document.getElementById('username');
            const email = document.getElementById('email');
            const btnCloseModal = document.getElementById('btnCloseModal');
            const btnCancel = document.getElementById('btnCancel');
            const btnBatalHapus = document.getElementById('btnBatalHapus');
            const btnKonfirmasiHapus = document.getElementById('btnKonfirmasiHapus');
            const searchUser = document.getElementById('searchUser');
            const displayedUsers = document.getElementById('displayedUsers');
            const totalUsers = document.getElementById('totalUsers');

            let idToDelete = null;
            let filteredUsers = [...dataPengguna];

            // Render tabel
            function renderData() {
                tabelPengguna.innerHTML = '';

                filteredUsers.forEach(pengguna => {
                    const row = document.createElement('tr');
                    row.className = 'border-b hover:bg-gray-50';

                    row.innerHTML = `
                        <td class="py-4 px-4">${pengguna.id}</td>
                        <td class="py-4 px-4 font-medium">${pengguna.nama}</td>
                        <td class="py-4 px-4">${pengguna.username}</td>
                        <td class="py-4 px-4">${pengguna.email}</td>
                        <td class="py-4 px-4">
                            <button class="text-blue-500 hover:text-blue-700 mr-2 btnEdit" data-id="${pengguna.id}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-red-500 hover:text-red-700 btnHapus" data-id="${pengguna.id}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    `;

                    tabelPengguna.appendChild(row);
                });

                // Update counter
                displayedUsers.textContent = filteredUsers.length;
                totalUsers.textContent = dataPengguna.length;

                // Add event listeners to edit and delete buttons
                document.querySelectorAll('.btnEdit').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const id = parseInt(this.getAttribute('data-id'));
                        editPengguna(id);
                    });
                });

                document.querySelectorAll('.btnHapus').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const id = parseInt(this.getAttribute('data-id'));
                        showDeleteConfirmation(id);
                    });
                });
            }

            // Filter users
            function filterUsers() {
                const searchTerm = searchUser.value.toLowerCase();
                filteredUsers = dataPengguna.filter(pengguna =>
                    pengguna.nama.toLowerCase().includes(searchTerm) ||
                    pengguna.username.toLowerCase().includes(searchTerm) ||
                    pengguna.email.toLowerCase().includes(searchTerm)
                );
                renderData();
            }

            // Open modal for editing a user
            function editPengguna(id) {
                const pengguna = dataPengguna.find(p => p.id === id);
                if (pengguna) {
                    penggunaId.value = pengguna.id;
                    namaPengguna.value = pengguna.nama;
                    username.value = pengguna.username;
                    email.value = pengguna.email;

                    modalPengguna.classList.remove('hidden');
                    modalPengguna.classList.add('flex');
                }
            }

            // Show delete confirmation
            function showDeleteConfirmation(id) {
                idToDelete = id;
                modalKonfirmasi.classList.remove('hidden');
                modalKonfirmasi.classList.add('flex');
            }

            // Delete user
            function deleteUser(id) {
                dataPengguna = dataPengguna.filter(p => p.id !== id);
                filterUsers();
                closeDeleteModal();
            }

            // Close modals
            function closeModal() {
                modalPengguna.classList.add('hidden');
                modalPengguna.classList.remove('flex');
            }

            function closeDeleteModal() {
                modalKonfirmasi.classList.add('hidden');
                modalKonfirmasi.classList.remove('flex');
                idToDelete = null;
            }

            // Save user data
            function savePengguna(e) {
                e.preventDefault();

                const id = parseInt(penggunaId.value);
                const nama = namaPengguna.value;
                const user = username.value;
                const mail = email.value;

                const index = dataPengguna.findIndex(p => p.id === id);
                if (index !== -1) {
                    dataPengguna[index] = {
                        id,
                        nama,
                        username: user,
                        email: mail
                    };
                }

                filterUsers();
                closeModal();
            }

            // Event listeners
            btnCloseModal.addEventListener('click', closeModal);
            btnCancel.addEventListener('click', closeModal);
            formPengguna.addEventListener('submit', savePengguna);
            btnBatalHapus.addEventListener('click', closeDeleteModal);
            btnKonfirmasiHapus.addEventListener('click', function() {
                if (idToDelete) {
                    deleteUser(idToDelete);
                }
            });
            searchUser.addEventListener('input', filterUsers);

            // Initial render
            renderData();
        });
    </script>
</body>
</html>
