<?php
session_start();
$conn = new mysqli("localhost", "root", "", "akun");

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Ambil data pengguna untuk verifikasi
$result = $conn->query("SELECT username, password, end_time, voucher_name FROM pembelian");
$users = [];
while ($row = $result->fetch_assoc()) {
    $users[$row['username']] = [
        'password' => $row['password'],
        'end_time' => $row['end_time'],
        'voucher_name' => $row['voucher_name'],
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Voucher</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">My Voucher</h1>

        <!-- Daftar Voucher -->
        <h2>Daftar Voucher Anda</h2>
        <table class="table table-bordered" id="voucherTable">
            <thead>
                <tr>
                    <th>Voucher</th>
                    <th>Status</th>
                    <th>Masa Aktif</th>
                    <th>Voucher Name</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dinamis diisi oleh JavaScript -->
            </tbody>
        </table>

        <!-- Tambah Voucher -->
        <h2 class="mt-4">Tambah Voucher Baru</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#authModal">Tambah</button>

        <!-- Modal Verifikasi -->
        <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="authModalLabel">Verifikasi Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="verifyButton">Verifikasi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Data pengguna untuk verifikasi (diambil dari PHP)
        const users = <?= json_encode($users); ?>;

        // Tombol Verifikasi
        document.getElementById('verifyButton').addEventListener('click', function () {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            if (users[username] && users[username]['password'] === password) {
                // Tambahkan voucher baru ke tabel
                const tableBody = document.querySelector('#voucherTable tbody');
                const newRow = `
                    <tr>
                        <td>${username}-${password}</td>
                        <td>Pending</td>
                        <td>${users[username]['end_time']}</td>
                        <td>${users[username]['voucher_name']}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="updateVoucher('${username}')">Update</button>
                            <button class="btn btn-danger btn-sm" onclick="deleteVoucher(this)">Delete</button>
                        </td>
                    </tr>
                `;
                tableBody.innerHTML += newRow;

                // Tutup modal
                document.querySelector('.btn-close').click();
            } else {
                alert('Username atau Password salah!');
            }
        });

        // Fungsi Update Voucher
        function updateVoucher(username) {
            const password = prompt("Masukkan Password baru:");
            if (!password) return alert("Password baru tidak boleh kosong!");

            if (users[username]) {
                if (users[username]['password'] !== password) {
                    const newEndDate = new Date();
                    newEndDate.setDate(newEndDate.getDate() + 30); // Tambah durasi 30 hari
                    users[username]['end_time'] = newEndDate.toISOString().split('T')[0];
                    alert("Voucher berhasil diperbarui!");
                    location.reload(); // Untuk menyegarkan tabel
                } else {
                    alert("Password baru tidak boleh sama dengan yang sebelumnya!");
                }
            } else {
                alert("Username tidak ditemukan!");
            }
        }

        // Fungsi Delete Voucher
        function deleteVoucher(button) {
            if (confirm("Apakah Anda yakin ingin menghapus voucher ini?")) {
                const row = button.closest('tr');
                row.remove();
                alert("Voucher berhasil dihapus!");
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
