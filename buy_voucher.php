<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: auth/login.php");
    exit;
}

// Ambil data dari query string
$voucher_name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : 'Paket Tidak Diketahui';
$voucher_price = isset($_GET['price']) ? htmlspecialchars($_GET['price']) : '0';

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "akun"); // Ganti "akun" dengan nama database Anda

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Variabel untuk menyimpan status pembayaran dan kode voucher
$payment_success = false;
$generated_voucher_code = null;

// Cek jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $whatsapp = $_POST['whatsapp'];
    $payment_method = $_POST['payment_method'];

    // Validasi data
    if (!empty($email) && !empty($whatsapp) && !empty($payment_method)) {
        // Generate kode voucher unik
        $generated_voucher_code = strtoupper(uniqid("VCH-")); // Contoh: VCH-63F2A1C3ABCD

        // Simpan ke database
        $stmt = $conn->prepare("INSERT INTO pembelian_voucher (voucher_name, voucher_price, email, whatsapp_number, payment_method, voucher_code) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sdssss", $voucher_name, $voucher_price, $email, $whatsapp, $payment_method, $generated_voucher_code);

        if ($stmt->execute()) {
            // Tandai pembayaran berhasil
            $payment_success = true;
        } else {
            echo "<script>alert('Gagal menyimpan data: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Semua field harus diisi!');</script>";
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
    <style>
        body {
            background-color: #f9f9f9;
        }
        .container {
            margin-top: 50px;
        }
        .btn-buy {
            background-color: #d32f2f;
            color: white;
        }
        .btn-buy:hover {
            background-color: #b71c1c;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .success-message {
            font-size: 1.2rem;
            color: #28a745;
            text-align: center;
            margin-bottom: 20px;
        }
        .voucher-code {
            font-size: 1.5rem;
            font-weight: bold;
            color: #007bff;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <?php if ($payment_success && $generated_voucher_code): ?>
                        <div class="success-message">
                            Pembayaran Berhasil!
                        </div>
                        <hr>
                        <p class="text-center">Kode voucher Anda:</p>
                        <p class="voucher-code"><?php echo $generated_voucher_code; ?></p>
                        <hr>
                        <div class="text-center">
                            <a href="home.php" class="btn btn-primary">Kembali ke Beranda</a>
                        </div>
                    <?php else: ?>
                        <h5 class="card-title">Pembelian Voucher WiFi.id</h5>
                        <hr>
                        <form method="POST" action="">
                            <p><strong>1. Pilih Nominal</strong></p>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6><?php echo $voucher_name; ?></h6>
                                    <p>Rp. <?php echo $voucher_price; ?></p>
                                </div>
                            </div>
                            <hr>
                            <p><strong>2. Metode Pembayaran</strong></p>
                            <div class="mb-3">
                                <select id="payment-method" name="payment_method" class="form-select" required>
                                    <option value="">Pilih Metode Pembayaran</option>
                                    <option value="transfer">Transfer Via Bank</option>
                                    <option value="qris">QRIS</option>
                                </select>
                            </div>
                            <p><strong>3. Email</strong></p>
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Masukkan Email" required>
                            </div>
                            <p><strong>4. No. WhatsApp</strong></p>
                            <div class="mb-3">
                                <input type="text" name="whatsapp" class="form-control" placeholder="Masukkan No. WhatsApp" required>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <p><strong>Total:</strong></p>
                                <p><strong>Rp. <?php echo $voucher_price; ?></strong></p>
                            </div>
                            <button type="submit" class="btn btn-buy w-100">Bayar Sekarang</button>
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
