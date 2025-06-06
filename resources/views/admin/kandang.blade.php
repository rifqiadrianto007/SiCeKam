@vite(['resources/css/app.css'])

@extends('layout.adm')

@section('content')
<div class="ml-64 p-8 bg-gray-50 min-h-screen">
    <div class="mb-8">
        <div class="flex items-center space-x-3 mb-2">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Blok Kandang</h1>
            </div>
        </div>
    </div>

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-700">Data Blok Kandang</h2>
            <button id="btnTambahBlok"
                class="bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg px-4 py-2 flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Tambah Blok
            </button>
        </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-8 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <span>Nama Blok</span>
                                    <i class="fas fa-sort text-gray-400"></i>
                                </div>
                            </th>
                            <th class="px-8 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <span>Jumlah Ayam</span>
                                    <i class="fas fa-sort text-gray-400"></i>
                                </div>
                            </th>
                            <th class="px-8 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <span>Ayam Sakit</span>
                                    <i class="fas fa-sort text-gray-400"></i>
                                </div>
                            </th>
                            <th class="px-8 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Status Kesehatan
                            </th>
                            <th class="px-8 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($scans as $scan)
                            @php
                                $totalAyam = $scan->jumlah_ayam ?? 0;
                                $ayamSakit = $scan->ayam_sakit ?? 0;
                                $ayamSehat = $totalAyam - $ayamSakit;
                                $persentaseSehat = $totalAyam > 0 ? ($ayamSehat / $totalAyam) * 100 : 0;
                            @endphp
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-8 py-6">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12">
                                            <div class="h-12 w-12 rounded-full bg-gradient-to-r from-blue-400 to-blue-500 flex items-center justify-center">
                                                <i class="fas fa-home text-white text-lg"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900">Blok {{ $scan->blok }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center">
                                        <i class="fas fa-kiwi-bird text-gray-400 mr-2"></i>
                                        <span class="text-sm font-semibold text-gray-900">{{ number_format($totalAyam) }}</span>
                                        <span class="text-xs text-gray-500 ml-1">ekor</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center">
                                        <i class="fas fa-heartbeat text-red-400 mr-2"></i>
                                        <span class="text-sm font-semibold text-red-600">{{ number_format($ayamSakit) }}</span>
                                        <span class="text-xs text-gray-500 ml-1">ekor</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    @if($persentaseSehat >= 90)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle text-green-500 mr-1 text-xs"></i>
                                            Sangat Baik ({{ number_format($persentaseSehat, 1) }}%)
                                        </span>
                                    @elseif($persentaseSehat >= 75)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <i class="fas fa-info-circle text-blue-500 mr-1 text-xs"></i>
                                            Baik ({{ number_format($persentaseSehat, 1) }}%)
                                        </span>
                                    @elseif($persentaseSehat >= 50)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-exclamation-circle text-yellow-500 mr-1 text-xs"></i>
                                            Perlu Perhatian ({{ number_format($persentaseSehat, 1) }}%)
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-times-circle text-red-500 mr-1 text-xs"></i>
                                            Kritis ({{ number_format($persentaseSehat, 1) }}%)
                                        </span>
                                    @endif
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <div class="flex justify-center space-x-2">
                                        <button onclick="editBlok({{ $scan->id }})"
                                            class="bg-blue-100 text-blue-600 hover:bg-blue-200 p-2 rounded-lg transition-colors duration-200"
                                            title="Edit Blok">
                                            <i class="fas fa-edit text-sm"></i>
                                        </button>
                                        <button onclick="deleteBlok({{ $scan->id }})"
                                            class="bg-red-100 text-red-600 hover:bg-red-200 p-2 rounded-lg transition-colors duration-200"
                                            title="Hapus Blok">
                                            <i class="fas fa-trash text-sm"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="bg-gray-100 p-4 rounded-full mb-4">
                                            <i class="fas fa-home text-gray-400 text-2xl"></i>
                                        </div>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data blok kandang</h3>
                                        <p class="text-gray-500 mb-4">Mulai dengan menambahkan blok kandang pertama Anda</p>
                                        <button onclick="document.getElementById('btnTambahBlok').click()"
                                            class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
                                            <i class="fas fa-plus mr-2"></i>Tambah Blok Kandang
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Blok -->
<div id="modalTambahBlok" class="fixed inset-0 z-50 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center hidden p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all">

        <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 rounded-t-2xl">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="bg-white bg-opacity-20 p-2 rounded-lg">
                        <i class="fas fa-plus text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white">Tambah Blok Kandang</h3>
                </div>
                <button onclick="tutupModal()" class="text-white hover:text-gray-200 transition-colors p-1">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
        </div>

        <div class="p-8">
            <form action="{{ route('blok.store') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="blok" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-home text-gray-400 mr-2"></i>Nama Blok
                    </label>
                    <input type="text" name="blok" id="blok"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        placeholder="Contoh: A, B, C dst..." required>
                </div>

                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                    <button type="button" onclick="tutupModal()"
                        class="px-6 py-3 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors font-medium">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all font-medium shadow-sm">
                        <i class="fas fa-save mr-2"></i>Simpan Blok
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Blok -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden z-50 p-4">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6 rounded-t-2xl">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white bg-opacity-20 p-2 rounded-lg">
                            <i class="fas fa-edit text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white">Edit Blok Kandang</h3>
                    </div>
                    <button onclick="closeEditModal()" class="text-white hover:text-gray-200 transition-colors p-1">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
            </div>

            <div class="p-8">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-home text-gray-400 mr-2"></i>Nama Blok
                            </label>
                            <input type="text" id="editBlok" name="blok"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                placeholder="Nama blok kandang" required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-kiwi-bird text-gray-400 mr-2"></i>Jumlah Ayam
                            </label>
                            <input type="number" id="editJumlahAyam" name="jumlah_ayam"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                placeholder="0" min="0">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-heartbeat text-gray-400 mr-2"></i>Ayam Sakit
                            </label>
                            <input type="number" id="editAyamSakit" name="ayam_sakit"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                placeholder="0" min="0">
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                        <button type="button" onclick="closeEditModal()"
                            class="px-6 py-3 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors font-medium">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all font-medium shadow-sm">
                            <i class="fas fa-save mr-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function editBlok(id) {
    // Show modal
    document.getElementById('editModal').classList.remove('hidden');

    // Set form action URL - adjust this according to your route
    document.getElementById('editForm').action = `/admin/kandang/${id}`;

    // Fetch current data and populate form
    fetch(`/admin/kandang/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('editBlok').value = data.blok || '';
            document.getElementById('editJumlahAyam').value = data.jumlah_ayam || '';
            document.getElementById('editAyamSakit').value = data.ayam_sakit || '';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal memuat data blok');
        });
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}

// Validasi: Ayam sakit tidak boleh lebih dari jumlah ayam
document.getElementById('editAyamSakit').addEventListener('input', function () {
    const jumlahAyam = parseInt(document.getElementById('editJumlahAyam').value) || 0;
    const ayamSakit = parseInt(this.value) || 0;

    if (ayamSakit > jumlahAyam) {
        alert('Jumlah ayam sakit tidak boleh melebihi jumlah ayam!');
        this.value = jumlahAyam;
    }
});

function deleteBlok(id) {
    // Create custom confirmation modal content
    const confirmationHtml = `
        <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm transform transition-all">
                <div class="p-6 text-center">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                        <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Konfirmasi Hapus</h3>
                    <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus blok kandang ini? Tindakan ini tidak dapat dibatalkan.</p>

                    <div class="flex space-x-3">
                        <button onclick="this.closest('.fixed').remove()"
                            class="flex-1 px-4 py-3 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors font-medium">
                            Batal
                        </button>
                        <button onclick="confirmDelete(${id})"
                            class="flex-1 px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl hover:from-red-600 hover:to-red-700 transition-all font-medium shadow-sm">
                            <i class="fas fa-trash mr-2"></i>Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;

    document.body.insertAdjacentHTML('beforeend', confirmationHtml);
}

function confirmDelete(id) {
    // Create form for DELETE request
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = `/admin/kandang/${id}`;

    // Add CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = csrfToken;
    form.appendChild(csrfInput);

    // Add method override for DELETE
    const methodInput = document.createElement('input');
    methodInput.type = 'hidden';
    methodInput.name = '_method';
    methodInput.value = 'DELETE';
    form.appendChild(methodInput);

    // Submit form
    document.body.appendChild(form);
    form.submit();
}

function tutupModal() {
    document.getElementById('modalTambahBlok').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditModal();
    }
});

document.getElementById('modalTambahBlok').addEventListener('click', function(e) {
    if (e.target === this) {
        tutupModal();
    }
});

document.getElementById('btnTambahBlok').addEventListener('click', function () {
    document.getElementById('modalTambahBlok').classList.remove('hidden');
});
</script>
@endsection
