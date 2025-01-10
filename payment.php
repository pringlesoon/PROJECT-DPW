<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: auth/login.php");
    exit;
}

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "akun");

// Ambil ID paket dari URL
$pricing_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Periksa apakah ID paket valid
$stmt = $conn->prepare("SELECT * FROM pricing WHERE id = ?");
$stmt->bind_param("i", $pricing_id);
$stmt->execute();
$result = $stmt->get_result();
$pricing = $result->fetch_assoc();

if (!$pricing) {
    die("Invalid plan selected!");
}

// Proses pembayaran
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("INSERT INTO payments (pricing_id, customer_name, email, status) VALUES (?, ?, ?, 'Pending')");
    $stmt->bind_param("iss", $pricing_id, $customer_name, $email);
    if ($stmt->execute()) {
        $message = "Payment initiated successfully! Please complete the payment.";
    } else {
        $message = "Failed to initiate payment.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay Voucher</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Pay for <?php echo htmlspecialchars($pricing['name']); ?> Plan</h1>
        <?php if (isset($message)): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($pricing['name']); ?> Plan</h5>
                <p class="card-text"><?php echo htmlspecialchars($pricing['description']); ?></p>
                <p><strong>Price:</strong> Rp <?php echo htmlspecialchars($pricing['price']); ?></p>
            </div>
        </div>
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="customer_name" class="form-label">Name</label>
                <input type="text" name="customer_name" id="customer_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Pay Now</button>
        </form>
        <a href="home.php" class="btn btn-secondary mt-3 w-100">Back to Home</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
