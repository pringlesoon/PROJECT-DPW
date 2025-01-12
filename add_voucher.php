<?php
session_start();
$conn = new mysqli("localhost", "root", "", "akun");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $voucher_code = trim($_POST['voucher_code']);
    $username = $_SESSION['user'];

    // Validasi kode voucher
    $result = $conn->query("SELECT * FROM voucher WHERE id = '$voucher_code'");
    if ($result->num_rows > 0) {
        $voucher = $result->fetch_assoc();
        $stmt = $conn->prepare("INSERT INTO pembelian (voucher_name, username, status) VALUES (?, ?, 'Pending')");
        $stmt->bind_param("ss", $voucher['nama'], $username);
        $stmt->execute();

        $_SESSION['message'] = "Voucher berhasil ditambahkan!";
    } else {
        $_SESSION['error'] = "Kode voucher tidak valid!";
    }
    header("Location: home.php");
    exit;
}
?>
