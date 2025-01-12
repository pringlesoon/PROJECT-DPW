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
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'akun';

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Inisialisasi variabel
$success = false;
$error = "";
$payment_info = "";
$payment_stage = "selection";
$qris_image = "";
$confirmation_step = false;
$order_id = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm_payment'])) {
        $order_id = $_SESSION['order_id'] ?? null;
        if ($order_id) {
            $generated_username = substr(md5(uniqid()), 0, 5);
            $generated_password = substr(md5(uniqid()), 0, 3);

            $_SESSION['generated_username'] = $generated_username;
            $_SESSION['generated_password'] = $generated_password;

            $stmt = $conn->prepare("UPDATE pembelian SET status = 'completed', username = ?, password = ? WHERE id = ?");
            $stmt->bind_param("ssi", $generated_username, $generated_password, $order_id);
            $stmt->execute();
            $stmt->close();

            $success = true;
        }

        $start_time_formatted = $_SESSION['start_time'] ?? "";
        $end_time_formatted = $_SESSION['end_time'] ?? "";
    } elseif (isset($_POST['cancel_payment'])) {
        $order_id = $_SESSION['order_id'] ?? null;
        if ($order_id) {
            $stmt = $conn->prepare("DELETE FROM pembelian WHERE id = ?");
            $stmt->bind_param("i", $order_id);
            $stmt->execute();
            $stmt->close();
        }

        unset($_SESSION['generated_username'], $_SESSION['generated_password'], $_SESSION['order_id']);
        header("Location: buy.php");
        exit;
    } else {
        $voucher_price = $_POST['voucher_price'];
        $payment_method = $_POST['payment_method'];
        $email = $_POST['email'];
        $whatsapp = $_POST['whatsapp'];

        if (empty($voucher_price) || empty($payment_method) || empty($email) || empty($whatsapp)) {
            $error = "Semua bidang wajib diisi.";
        } else {
            $voucher_name = "";
            $start_time = new DateTime();
            $end_time = clone $start_time;

            switch ($voucher_price) {
                case '5000':
                    $voucher_name = 'Paket 12 Jam';
                    $end_time->modify('+12 hours');
                    break;
                case '20000':
                    $voucher_name = 'Paket 7 Hari';
                    $end_time->modify('+7 days');
                    break;
                case '50000':
                    $voucher_name = 'Paket 30 Hari';
                    $end_time->modify('+30 days');
                    break;
                default:
                    $error = "Harga voucher tidak valid.";
            }

            $start_time_formatted = $start_time->format('Y-m-d H:i:s');
            $end_time_formatted = $end_time->format('Y-m-d H:i:s');

            $_SESSION['start_time'] = $start_time_formatted;
            $_SESSION['end_time'] = $end_time_formatted;

            if ($payment_method === 'transfer') {
                $payment_info = "Silakan transfer ke nomor rekening: 3901087832183748.";
            } elseif ($payment_method === 'qris') {
                $payment_info = "Silakan scan barcode QRIS untuk pembayaran.";
                $qris_image = "img/qris_barcode.png";
            }

            if (empty($error)) {
                $stmt = $conn->prepare("INSERT INTO pembelian (voucher_name, voucher_price, email, whatsapp_number, payment_method, start_time, end_time) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sdsssss", $voucher_name, $voucher_price, $email, $whatsapp, $payment_method, $start_time_formatted, $end_time_formatted);

                if ($stmt->execute()) {
                    $confirmation_step = true;
                    $_SESSION['order_id'] = $stmt->insert_id;
                } else {
                    $error = "Terjadi kesalahan saat menyimpan data: " . $stmt->error;
                }

                $stmt->close();
            }
        }
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
    
</head>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="home.php">WiFi.an</a>
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
    <div class="container form-container">
        <div class="card">
            <div class="card-body">
                <?php if ($success): ?>
                    <div class="alert alert-success">Pembayaran berhasil dikonfirmasi!</div>
                    <p>Username: <strong><?php echo htmlspecialchars($generated_username); ?></strong></p>
                    <p>Password: <strong><?php echo htmlspecialchars($generated_password); ?></strong></p>
                    <p>Waktu Mulai: <strong><?php echo htmlspecialchars($start_time_formatted); ?></strong></p>
                    <p>Waktu Berakhir: <strong><?php echo htmlspecialchars($end_time_formatted); ?></strong></p>

                    <a href="home.php" class="btn btn-primary">Kembali ke Beranda</a>
                <?php elseif ($confirmation_step): ?>
                    <div class="alert alert-info">
                        <p><?php echo $payment_info; ?></p>
                        <?php if ($payment_method === 'qris'): ?>
                            <img src="<?php echo htmlspecialchars($qris_image); ?>" alt="QRIS" class="img-fluid">
                        <?php endif; ?>
                    </div>
                    <p>Waktu pembayaran: <span id="countdown">05:00</span></p>
                    <form method="POST" class="d-flex gap-2">
                        <input type="hidden" name="confirm_payment" value="1">
                        <button type="submit" class="btn btn-success w-50">Saya Sudah Membayar</button>
                    </form>
                    <form method="POST" class="mt-2">
                        <button type="submit" name="cancel_payment" class="btn btn-danger w-100">Batalkan Pembayaran</button>
                    </form>
                <?php else: ?>
                    <h5 class="card-title text-center">Pembelian Voucher</h5>
                    <form method="POST">
                        <?php if (!empty($error)): ?>
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

    <script>
        let countdownElement = document.getElementById('countdown');
        let timeLeft = 300; // 5 menit dalam detik

        function updateCountdown() {
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            countdownElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

            if (timeLeft > 0) {
                timeLeft--;
            } else {
                alert('Waktu pembayaran telah habis. Silakan coba lagi.');
                window.location.href = 'buy.php';
            }
        }

        if (countdownElement) {
            setInterval(updateCountdown, 1000);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
