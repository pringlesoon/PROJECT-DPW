<?php
session_start();

// // // Periksa apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: auth/login.php");
    exit;
}

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "akun");

// Ambil data pengguna
$username = $_SESSION['user'];
$stmt = $conn->prepare("SELECT id, username, email FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Hapus akun jika tombol Delete diklik
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_account'])) {
    $delete_stmt = $conn->prepare("DELETE FROM users WHERE username = ?");
    $delete_stmt->bind_param("s", $username);
    if ($delete_stmt->execute()) {
        // Akun berhasil dihapus, keluar dari sesi dan redirect ke halaman login
        session_destroy();
        header("Location: auth/login.php?message=account_deleted");
        exit;
    } else {
        $error = "Gagal menghapus akun. Silakan coba lagi.";
    }
}
// ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Profile Settings</h1>

        <!-- Tampilkan Informasi Pengguna -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">User Details</h5>
                <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>Password:</strong> ******</p>
                <a href="update_password.php" class="btn btn-primary mt-3">Update Password</a>
                <a href="home.php" class="btn btn-secondary mt-3">Back to Home</a>
                
                <!-- Tombol Delete Account -->
                <form method="POST" class="mt-3">
                    <button type="submit" name="delete_account" class="btn btn-danger float-end"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus akun Anda? Data tidak dapat dikembalikan.')">
                        Delete Account
                    </button>
                </form>
            </div>
        </div>

        <!-- Tampilkan Pesan Error (jika ada) -->
        <?php if (isset($error)): ?>
            <div class="alert alert-danger mt-3">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
