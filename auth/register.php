<?php
$conn = new mysqli("localhost", "root", "", "akun");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $query_check = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $result_check = $conn->query($query_check);

    if ($result_check->num_rows > 0) {
        echo "Username atau email sudah digunakan.";
    } else {
        $query = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
        if ($conn->query($query)) {
            header("Location: login.php"); // Pastikan jalur ke login.php benar
            exit;
        } else {
            echo "Registrasi gagal: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Register</title>
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
    .login-card button {
        background-color: #d32f2f;
        border: none;
    }
    .login-card button:hover {
        background-color: #a82323;
    }
    footer {
        background-color: #d32f2f;
        color: white;
        padding: 20px 0;
        text-align: center;
        margin-top: 50px;
    }
    footer a {
        color: #fff;
        text-decoration: underline;
    }
    footer a:hover {
        color: #000;
        text-decoration: none;
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
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg login-card" style="width: 25rem;">
        <div class="card-body">
            <h1 class="card-title text-center mb-4">Register</h1>
            <form action="register.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" required>
                </div>
                <button type="submit" class="btn btn-danger w-100">Register</button>
            </form>
            <div class="mt-3 text-center">
                <p>Sudah punya akun? <a href="login.php" class="text-primary">Login di sini</a></p>
            </div>
        </div>
    </div>
</div>
<footer>
    <div class="container">
        <p>&copy; 2025 WiFi.an | Contact us at <a href="mailto:support@wifian.com">support@wifian.com</a> | Call: +62-123-456-7890</p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
