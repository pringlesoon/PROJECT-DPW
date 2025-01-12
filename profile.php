<?php
session_start();

// Periksa apakah pengguna sudah login
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            font-size: 2rem;
            color: #495057;
        }

        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .card-title {
            font-size: 1.25rem;
            margin-bottom: 10px;
            color: #212529;
        }

        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5c636a;
            border-color: #545b62;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #842029;
            border-color: #f5c2c7;
        }

        .card-body p {
            font-size: 1rem;
            margin-bottom: 8px;
        }

        button:focus,
        .btn:focus {
            outline: none;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        form {
            display: flex;
            justify-content: flex-end;
        }
    </style>

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
