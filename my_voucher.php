<?php
session_start();
$conn = new mysqli("localhost", "root", "", "akun");

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Ambil daftar voucher dari database
$result = $conn->query("SELECT * FROM pembelian");
$vouchers = $result->fetch_all(MYSQLI_ASSOC);

// Notifikasi
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']);
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

        <!-- Notifikasi -->
        <?php if ($message): ?>
            <div class="alert alert-success">
                <?= $message; ?>
            </div>
        <?php endif; ?>

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
                <?php foreach ($vouchers as $voucher): ?>
                    <tr>
                        <td><?= $voucher['username'] . '-' . $voucher['password']; ?></td>
                        <td><?= $voucher['status']; ?></td>
                        <td><?= $voucher['end_time']; ?></td>
                        <td><?= $voucher['voucher_name']; ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="updateVoucher('<?= $voucher['username']; ?>')">Update</button>
                            <button class="btn btn-danger btn-sm" onclick="deleteVoucher('<?= $voucher['username']; ?>')">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>


        <!-- Modal Verifikasi -->
        <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="authModalLabel">Verifikasi Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="my_voucher.php" method="POST">
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
                            <button type="submit" name="addVoucher" class="btn btn-primary">Verifikasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    
        // Fungsi Delete Voucher
        function deleteVoucher(username) {
            if (!confirm("Apakah Anda yakin ingin menghapus voucher ini?")) return;

            const formData = new FormData();
            formData.append('username', username);

            fetch('my_voucher.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => location.reload())
            .catch(err => console.error(err));
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Tambah Voucher Baru
if (isset($_POST['addVoucher'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn->query("INSERT INTO pembelian (username, password, status, end_time, voucher_name) 
                  VALUES ('$username', '$password', 'Pending', DATE_ADD(NOW(), INTERVAL 30 DAY), 'Voucher Baru')");
    $_SESSION['message'] = "Voucher berhasil ditambahkan!";
    header("Location: my_voucher.php");
    exit;
}

// Update Voucher
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn->query("UPDATE pembelian 
                  SET password = '$password', end_time = DATE_ADD(end_time, INTERVAL 30 DAY) 
                  WHERE username = '$username'");
    echo "Voucher berhasil diperbarui!";
    exit;
}

// Delete Voucher
if (isset($_POST['username'])) {
    $username = $_POST['username'];

    $conn->query("DELETE FROM pembelian WHERE username = '$username'");
    echo "Voucher berhasil dihapus!";
    exit;
}
?>
