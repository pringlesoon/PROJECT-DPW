<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: auth/login.php");
    exit;
}

<<<<<<< HEAD
// Koneksi ke database
$host = 'localhost'; // Sesuaikan dengan konfigurasi Anda
$username = 'root'; // Sesuaikan dengan username database Anda
$password = ''; // Sesuaikan dengan password database Anda
$database = 'akun'; // Nama database sesuai file pembelian.sql

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Inisialisasi variabel
$success = false;
$error = "";
$generated_username = "";
$generated_password = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $voucher_price = $_POST['voucher_price'];
    $payment_method = $_POST['payment_method'];
    $email = $_POST['email'];
    $whatsapp = $_POST['whatsapp'];

    // Validasi input
    if (empty($voucher_price) || empty($payment_method) || empty($email) || empty($whatsapp)) {
        $error = "Semua bidang wajib diisi.";
    } else {
        // Generate username dan password unik
        $generated_username = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
        $generated_password = substr(str_shuffle("0123456789"), 0, 3);

        // Tentukan nama voucher berdasarkan harga
        $voucher_name = "";
        switch ($voucher_price) {
            case '5000':
                $voucher_name = 'Paket 12 Jam';
                break;
            case '20000':
                $voucher_name = 'Paket 7 Hari';
                break;
            case '50000':
                $voucher_name = 'Paket 30 Hari';
                break;
            default:
                $error = "Harga voucher tidak valid.";
        }

        if (empty($error)) {
            // Simpan ke database
            $stmt = $conn->prepare("INSERT INTO pembelian (voucher_name, voucher_price, email, whatsapp_number, payment_method, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sdsssss", $voucher_name, $voucher_price, $email, $whatsapp, $payment_method, $generated_username, $generated_password);

            if ($stmt->execute()) {
                $success = true;
            } else {
                $error = "Terjadi kesalahan saat menyimpan data: " . $stmt->error;
            }

            $stmt->close();
        }
    }
}

$conn->close();
=======
>>>>>>> 8900afbd296141882bf1b95773dfaac9712c47cc
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembelian Voucher</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
<<<<<<< HEAD
=======
        .voucher-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }
        .voucher-item {
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, background-color 0.3s;
            cursor: pointer;
        }
        .voucher-item:hover {
            transform: scale(1.05);
            background-color: #f1f1f1;
        }
        .voucher-item.selected {
            background-color: #007bff;
            color: white;
        }
>>>>>>> 8900afbd296141882bf1b95773dfaac9712c47cc
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
<<<<<<< HEAD
                <?php if ($success): ?>
=======
                <?php if (isset($success) && $success): ?>
>>>>>>> 8900afbd296141882bf1b95773dfaac9712c47cc
                        <div class="alert alert-success">Pembayaran berhasil!</div>
                        <p>Username: <strong><?php echo $generated_username; ?></strong></p>
                        <p>Password: <strong><?php echo $generated_password; ?></strong></p>
                        <a href="home.php" class="btn btn-primary">Kembali ke Beranda</a>
                    <?php else: ?>
                        <h5 class="card-title">Pembelian Voucher</h5>
                        <form method="POST">
<<<<<<< HEAD
                            <?php if (!empty($error)): ?>
=======
                            <?php if (isset($error)): ?>
>>>>>>> 8900afbd296141882bf1b95773dfaac9712c47cc
                                <div class="alert alert-danger"><?php echo $error; ?></div>
                            <?php endif; ?>

                            <div class="mb-3">
                                <label for="voucher_price" class="form-label">Harga Voucher</label>
                                <select name="voucher_price" id="voucher_price" class="form-select" required>
                                    <option value="">Pilih Harga</option>
                                    <option value="5000">Rp. 5.000 (12 Jam)</option>
                                    <option value="20000">Rp. 20.000 (7 Hari)</option>
                                    <option value="50000">Rp. 50.000 (30 Hari)</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Metode Pembayaran</label>
                                <select name="payment_method" id="payment_method" class="form-select" required>
                                    <option value="">Pilih Metode Pembayaran</option>
                                    <option value="transfer">Transfer Via Bank</option>
                                    <option value="qris">QRIS</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan Email" required>
                            </div>

                            <div class="mb-3">
                                <label for="whatsapp" class="form-label">No. WhatsApp</label>
                                <input type="text" name="whatsapp" id="whatsapp" class="form-control" placeholder="Masukkan No. WhatsApp" required>
                            </div>

                            <button type="submit" class="btn btn-danger w-100">Bayar Sekarang</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
