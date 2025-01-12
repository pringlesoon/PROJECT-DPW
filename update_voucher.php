<?php
session_start();
$conn = new mysqli("localhost", "root", "", "akun");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Update status voucher
    $stmt = $conn->prepare("UPDATE pembelian SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();

    $_SESSION['message'] = "Voucher berhasil diperbarui!";
    header("Location: home.php");
    exit;
}
?>
