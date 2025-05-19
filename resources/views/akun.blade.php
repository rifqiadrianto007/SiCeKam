    @vite(['resources/css/app.css', 'resources/js/akun.js'])

    @extends('layout.adm')
    {{-- Main --}}
    @section('content')
        <div class="ml-64 p-6">
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
                            <input type="text" id="searchUser" placeholder="Cari pengguna..."
                                class="w-full px-4 py-2 pl-10 pr-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400">
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
                                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-500 uppercase">Nama
                                    </th>
                                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-500 uppercase">Email
                                    </th>
                                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-500 uppercase">Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-4 px-4">{{ $user->id }}</td>
                                        <td class="py-4 px-4 font-medium">{{ $user->name }}</td>
                                        <td class="py-4 px-4">{{ $user->email }}</td>
                                        <td class="py-4 px-4">
                                            <button class="text-blue-500 hover:text-blue-700 mr-2 btnEdit"
                                                data-id="{{ $user->id }}" data-nama="{{ $user->name }}"
                                                data-email="{{ $user->email }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700 btnHapus"
                                                data-id="{{ $user->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- <div class="flex justify-between items-center mt-4">
                        <div class="text-sm text-gray-500">
                            Menampilkan <span id="displayedUsers">5</span> dari <span id="totalUsers">5</span> pengguna
                        </div>
                        <div class="flex">
                            <button
                                class="px-3 py-1 border border-gray-300 rounded-l-md bg-white text-gray-500 hover:bg-gray-100">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button
                                class="px-3 py-1 border border-gray-300 rounded-r-md bg-white text-gray-500 hover:bg-gray-100">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        </div>

        <!-- Modal Edit Pengguna -->
        <div id="modalPengguna" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex hidden items-center justify-center">
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
                            <label for="namaPengguna" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                Lengkap</label>
                            <input type="text" id="namaPengguna"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" id="email" class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                required>
                        </div>

                        <div class="flex justify-end mt-6">
                            <button type="button" id="btnCancel"
                                class="bg-gray-200 text-gray-700 py-2 px-4 rounded-md mr-2 hover:bg-gray-300">Batal</button>
                            <button type="submit" id="btnSimpan"
                                class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600">Simpan</button>
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
                    <p class="text-gray-500 mb-6">Apakah Anda yakin ingin menghapus pengguna ini?</p>

                    <div class="flex justify-end">
                        <button id="btnBatalHapus"
                            class="bg-gray-200 text-gray-700 py-2 px-4 rounded-md mr-2 hover:bg-gray-300">Batal</button>
                        <button id="btnKonfirmasiHapus"
                            class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
