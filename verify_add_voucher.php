<?php
session_start();
$conn = new mysqli("localhost", "root", "", "akun");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi username dan password
    $stmt = $conn->prepare("SELECT * FROM pembelian WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Tambahkan voucher baru
        $voucher_name = 'Voucher Baru ' . date('Y-m-d H:i:s');
        $status = 'Pending';
        $end_time = date('Y-m-d H:i:s', strtotime('+30 days'));

        $insert = $conn->prepare("INSERT INTO pembelian (username, voucher_name, status, end_time) VALUES (?, ?, ?, ?)");
        $insert->bind_param("ssss", $username, $voucher_name, $status, $end_time);
        
        if ($insert->execute()) {
            $_SESSION['message'] = "Voucher berhasil ditambahkan!";
        } else {
            $_SESSION['error'] = "Gagal menambahkan voucher.";
        }
    } else {
        $_SESSION['error'] = "Username atau password salah.";
    }
    $stmt->close();
    $conn->close();

    header("Location: my_voucher.php");
    exit;
}
?>
