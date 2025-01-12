<?php
session_start();
$conn = new mysqli("localhost", "root", "", "akun");

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Ambil daftar voucher pengguna
$username = $_SESSION['user'];
$result = $conn->query("SELECT * FROM pembelian WHERE username = '$username'");

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

        <!-- Pesan Notifikasi -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['message']; unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Daftar Voucher -->
        <h2>Daftar Voucher Anda</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Voucher</th>
                    <th>Status</th>
                    <th>Masa Aktif</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['voucher_name']; ?></td>
                        <td><?= $row['status']; ?></td>
                        <td><?= $row['end_time'] ?? 'Tidak Aktif'; ?></td>
                        <td>
                            <form action="update_voucher.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                <select name="status" class="form-select form-select-sm">
                                    <option value="Pending" <?= $row['status'] === 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Completed" <?= $row['status'] === 'Completed' ? 'selected' : ''; ?>>Completed</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-warning">Update</button>
                            </form>
                            <form action="delete_voucher.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Tambah Voucher -->
        <h2 class="mt-4">Tambah Voucher Baru</h2>
        <form action="add_voucher.php" method="POST">
            <label for="voucher_code">Kode Voucher:</label>
            <input type="text" id="voucher_code" name="voucher_code" class="form-control" required>
            <button type="submit" class="btn btn-primary mt-2">Tambah</button>
        </form>
    </div>
</body>
</html>
