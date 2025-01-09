<?php
session_start();

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "akun");

// Periksa koneksi database
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Periksa jika input kosong
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Username dan password harus diisi!";
        header("Location: login.php");
        exit;
    }

    // Gunakan prepared statement untuk keamanan
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['username']; // Simpan user ke session

            // Redirect ke home.php dengan jalur yang benar
            header("Location: ../home.php");
            exit;
        } else {
            // Password salah
            $_SESSION['error'] = "Password salah!";
            header("Location: login.php");
            exit;
        }
    } else {
        // Username tidak ditemukan
        $_SESSION['error'] = "Username tidak ditemukan!";
        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
</head>
<style>
    .navbar {
        background-color: #d32f2f;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 0;
        z-index: 1000;
    }
    .navbar-brand {
        color: #fff !important;
        font-weight: bold;
        font-size: 1.5rem;
    }
    .nav-link {
        color: #fff !important;
        font-weight: 500;
        padding: 0.5rem 1rem;
    }
    .nav-link:hover {
        color:rgb(0, 0, 0) !important;
    }
    .navbar-toggler {
        border: none;
    }
    .navbar-toggler-icon {
        background-color: #fff;
        border-radius: 5px;
    }
    .login-btn {
    color: #d32f2f !important;
    background-color: #fff;
    border: 2px solid #fff;
    }
    .login-btn:hover {
        color: #fff !important;
        background-color: #d32f2f;
        border: 2px solid #fff;
    }
</style>

<body class="bg-light">
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="../index.php">WiFi.an</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="voucherDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Voucher</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#pricing">Pricing</a></li>
                        <li><a class="dropdown-item" href="login.php">Buy Voucher</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
            <a href="login.php" class="btn login-btn ms-3">Login</a>
            </ul>
        </div>
    </div>
</nav>
    <div class="text-white text-center mb-8">
        <h1 class="text-4xl font-bold">Selamat datang di portal</h1>
        <h2 class="text-3xl font-semibold">WIFI.an</h2>
    </div>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg" style="width: 25rem;">
            <div class="card-body">
                <h1 class="card-title text-center mb-4">Login</h1>
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger text-center"> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?> </div>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                <div class="mt-3 text-center">
                    <p>Belum punya akun? <a href="register.php" class="text-primary">Daftar di sini</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
