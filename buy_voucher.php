<?php
session_start();
if (isset($_SESSION['user'])) {
    $username = $_SESSION['user'];
} else {
    $username = 'Guest';
}

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: auth/login.php");
    exit;
}

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "akun");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Variabel untuk status pembayaran
$payment_success = false;
$payment_stage = "selection"; // "selection", "confirmation", atau "success"
$countdown_time = 5 * 60; // 5 menit dalam detik
$payment_method = null;
$payment_info = null;

// Ambil data dari query string
$voucher_name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : 'Paket Tidak Diketahui';
$voucher_price = isset($_GET['price']) ? htmlspecialchars($_GET['price']) : '0';

// Cek apakah form pemilihan pembayaran disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cancel'])) {
        // Jika pembatalan pembayaran
        if (isset($_SESSION['payment_id'])) {
            $stmt = $conn->prepare("DELETE FROM pembelian WHERE id = ?");
            $stmt->bind_param("i", $_SESSION['payment_id']);
            $stmt->execute();
            $stmt->close();
        }
        unset($_SESSION['payment'], $_SESSION['payment_id']);
        $payment_stage = "selection";
    } elseif (isset($_POST['confirm_payment'])) {
        // Jika konfirmasi pembayaran berhasil
        $payment_success = true;
        $payment_stage = "success";

        // Update status pembayaran menjadi completed
        $stmt = $conn->prepare("UPDATE pembelian SET status = 'completed' WHERE id = ?");
        $stmt->bind_param("i", $_SESSION['payment_id']);
        $stmt->execute();
        $stmt->close();

        // Generate username dan password
        $generated_username = substr(md5(uniqid()), 0, 5);
        $generated_password = substr(md5(uniqid()), 0, 3);

        // Tentukan waktu mulai dan berakhir
        $start_time = new DateTime();
        $end_time = clone $start_time;

        switch ($voucher_price) {
            case '5000':
                $end_time->modify('+12 hours');
                break;
            case '20000':
                $end_time->modify('+7 days');
                break;
            case '50000':
                $end_time->modify('+30 days');
                break;
            default:
                die("Paket tidak valid.");
        }

        $start_time_formatted = $start_time->format('Y-m-d H:i:s');
        $end_time_formatted = $end_time->format('Y-m-d H:i:s');

        // Update data dengan username dan password
        $stmt = $conn->prepare("UPDATE pembelian SET username = ?, password = ?, start_time = ?, end_time = ? WHERE id = ?");
        $stmt->bind_param(
            "ssssi",
            $generated_username,
            $generated_password,
            $start_time_formatted,
            $end_time_formatted,
            $_SESSION['payment_id']
        );

        if (!$stmt->execute()) {
            echo "<script>alert('Gagal menyimpan data: " . $stmt->error . "');</script>";
        }

        $stmt->close();
        unset($_SESSION['payment'], $_SESSION['payment_id']);
    } else {
        // Jika memilih metode pembayaran
        $email = $_POST['email'];
        $whatsapp = $_POST['whatsapp'];
        $payment_method = $_POST['payment_method'];

        if (!empty($email) && !empty($whatsapp) && !empty($payment_method)) {
            // Simpan ke database
            $stmt = $conn->prepare("INSERT INTO pembelian (voucher_name, voucher_price, email, whatsapp_number, payment_method, status) VALUES (?, ?, ?, ?, ?, 'pending')");
            $stmt->bind_param(
                "sdsss",
                $voucher_name,
                $voucher_price,
                $email,
                $whatsapp,
                $payment_method
            );

            if ($stmt->execute()) {
                $_SESSION['payment_id'] = $stmt->insert_id;
                $_SESSION['payment'] = [
                    'voucher_name' => $voucher_name,
                    'voucher_price' => $voucher_price,
                    'email' => $email,
                    'whatsapp' => $whatsapp,
                    'payment_method' => $payment_method,
                    'time_limit' => time() + $countdown_time
                ];
                $payment_stage = "confirmation";
            } else {
                echo "<script>alert('Gagal menyimpan data ke database: " . $stmt->error . "');</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Semua field harus diisi!');</script>";
        }
    }
}

// Jika di tahap konfirmasi pembayaran, ambil metode pembayaran dari sesi
if ($payment_stage === "confirmation" && isset($_SESSION['payment'])) {
    $payment_method = $_SESSION['payment']['payment_method'];
    if ($payment_method === "transfer") {
        $payment_info = "Silakan transfer ke nomor rekening: 3901087832183748.";
    } elseif ($payment_method === "qris") {
        $payment_info = "Silakan scan barcode QRIS untuk pembayaran.";
    }
    $countdown_time = max(0, $_SESSION['payment']['time_limit'] - time());
    if ($countdown_time <= 0) {
        // Hapus data pembayaran jika waktu habis
        if (isset($_SESSION['payment_id'])) {
            $stmt = $conn->prepare("DELETE FROM pembelian WHERE id = ?");
            $stmt->bind_param("i", $_SESSION['payment_id']);
            $stmt->execute();
            $stmt->close();
        }
        unset($_SESSION['payment'], $_SESSION['payment_id']);
        $payment_stage = "selection";
        echo "<script>alert('Waktu pembayaran telah habis!');</script>";
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembelian Voucher</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        let timeLeft = <?= $countdown_time ?>;
        function updateCountdown() {
            const countdownElement = document.getElementById('countdown');
            if (timeLeft > 0) {
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                countdownElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
                timeLeft--;
            } else {
                clearInterval(timerInterval);
                alert('Waktu pembayaran telah habis!');
                document.getElementById('cancel-form').submit();
            }
        }
        const timerInterval = setInterval(updateCountdown, 1000);
    </script>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Arial', sans-serif;
        }
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
            color: #ffc107 !important;
        }
        .navbar-toggler {
            border: none;
        }
        .navbar-toggler-icon {
            background-color: #fff;
            border-radius: 5px;
        }
    </style>
</head>
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="home.php">WiFi.an</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" href="home.php">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="voucherDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Voucher</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#pricing">Pricing</a></li>
                        <li><a class="dropdown-item" href="buy.php">Buy Voucher</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Hello, <?php echo htmlspecialchars($username); ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="my_voucher.php">My Voucher</a></li>
                        <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <?php if ($payment_stage === "selection"): ?>
                        <h5 class="text-center">Konfirmasi Pembelian Voucher</h5>
                        <hr>
                        <p><strong>Paket:</strong> <?= $voucher_name ?> - Rp. <?= $voucher_price ?></p>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Metode Pembayaran</label>
                                <select name="payment_method" id="payment_method" class="form-select" required>
                                    <option value="">Pilih Metode</option>
                                    <option value="transfer">Transfer Bank</option>
                                    <option value="qris">QRIS</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="whatsapp" class="form-label">No. WhatsApp</label>
                                <input type="text" name="whatsapp" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-danger w-100">Bayar Sekarang</button>
                        </form>
                    <?php elseif ($payment_stage === "confirmation"): ?>
                        <h5 class="text-center">Konfirmasi Pembayaran</h5>
                        <hr>
                        <div class="alert alert-info text-center"><?= $payment_info ?></div>
                        <?php if ($payment_method === "qris"): ?>
                            <img src="img/qris_barcode.png" alt="QRIS Barcode" class="img-fluid mb-3" style="max-width: 300px;">
                        <?php endif; ?>
                        <p>Waktu pembayaran: <span id="countdown">05:00</span></p>
                        <form method="POST" id="cancel-form">
                            <button type="submit" name="cancel" class="btn btn-danger w-100 mt-3">Batalkan Pembayaran</button>
                        </form>
                        <form method="POST">
                            <button type="submit" name="confirm_payment" class="btn btn-success w-100 mt-3">Saya Sudah Membayar</button>
                        </form>
                    <?php elseif ($payment_stage === "success"): ?>
                        <h5 class="text-center text-success">Pembayaran Berhasil!</h5>
                        <hr>
                        <p><strong>Username:</strong> <?= $generated_username ?></p>
                        <p><strong>Password:</strong> <?= $generated_password ?></p>
                        <p><strong>Waktu Mulai:</strong> <?= $start_time_formatted ?></p>
                        <p><strong>Waktu Berakhir:</strong> <?= $end_time_formatted ?></p>
                        <a href="home.php" class="btn btn-primary w-100">Kembali ke Beranda</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
