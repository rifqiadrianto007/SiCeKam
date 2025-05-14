document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modalPengguna');
    const form = document.getElementById('formPengguna');
    const modalHapus = document.getElementById('modalKonfirmasi');

    let idToDelete = null;

    // Buka modal edit
    document.querySelectorAll('.btnEdit').forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-nama');
            const email = button.getAttribute('data-email');

            document.getElementById('penggunaId').value = id;
            document.getElementById('namaPengguna').value = name;
            document.getElementById('email').value = email;

            modal.classList.remove('hidden');
        });
    });

    // Tutup modal edit
    document.getElementById('btnCloseModal').addEventListener('click', () => {
        modal.classList.add('hidden');
    });
    document.getElementById('btnCancel').addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    // Submit update user
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const id = document.getElementById('penggunaId').value;
        const name = document.getElementById('namaPengguna').value;
        const email = document.getElementById('email').value;

        fetch(`/admin/akun/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                _method: 'PUT',
                name: name,
                email: email,
            }),
        })
        .then(response => {
            if (response.ok) {
                location.reload();
            } else {
                alert('Gagal mengupdate data.');
            }
        });
    });

    // Buka modal konfirmasi hapus
    document.querySelectorAll('.btnHapus').forEach(button => {
        button.addEventListener('click', () => {
            idToDelete = button.getAttribute('data-id');
            modalHapus.classList.remove('hidden');
        });
    });

    // Batal hapus
    document.getElementById('btnBatalHapus').addEventListener('click', () => {
        modalHapus.classList.add('hidden');
        idToDelete = null;
    });

    // Konfirmasi hapus
    document.getElementById('btnKonfirmasiHapus').addEventListener('click', () => {
        fetch(`/admin/akun/${idToDelete}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                _method: 'DELETE',
            }),
        })
        .then(response => {
            if (response.ok) {
                location.reload();
            } else {
                alert('Gagal menghapus data.');
            }
        });
    });
});
