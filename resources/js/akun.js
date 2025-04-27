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
