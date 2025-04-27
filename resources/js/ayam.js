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
