@vite(['resources/css/app.css'])

@extends('layout.adm')

@section('content')
<div class="ml-64 p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Blok Kandang</h1>
    </div>

    <div class="bg-white rounded-lg shadow-sm mb-6">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-700">Data Blok Kandang</h2>
                <button id="btnTambahBlok"
                    class="bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg px-4 py-2 flex items-center">
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
                            <th class="py-3 px-4 text-left text-sm font-medium text-gray-500 uppercase">Ayam Sakit</th>
                            <th class="py-3 px-4 text-left text-sm font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($scans as $scan)
                            <tr class="border-b">
                                <td class="py-2 px-4">{{ $scan->id }}</td>
                                <td class="py-2 px-4">Blok {{ $scan->blok }}</td>
                                <td class="py-2 px-4">{{ $scan->jumlah_ayam ?? '-' }}</td>
                                <td class="py-2 px-4">{{ $scan->ayam_sakit ?? '-' }}</td>
                                <td class="py-2 px-4">
                                    <div class="flex space-x-2">
                                        <button onclick="editBlok({{ $scan->id }})"
                                            class="text-blue-500 hover:text-blue-700 mr-2"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="deleteBlok({{ $scan->id }})"
                                            class="text-red-500 hover:text-red-700"
                                            title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-gray-500 py-4">Belum ada data scan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Edit Blok -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Edit Blok Kandang</h3>
                    <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Blok</label>
                        <input type="text" id="editBlok" name="blok"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Ayam</label>
                        <input type="number" id="editJumlahAyam" name="jumlah_ayam"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            min="0">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Ayam Sakit</label>
                        <input type="number" id="editAyamSakit" name="ayam_sakit"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            min="0">
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeEditModal()"
                            class="px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                            class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg transition-colors">
                            Simpan
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

function deleteBlok(id) {
    if (confirm('Apakah Anda yakin ingin menghapus blok ini?')) {
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
}

// Close modal when clicking outside
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditModal();
    }
});
</script>
@endsection
