<?php
session_start();
$conn = new mysqli("localhost", "root", "", "akun");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Hapus voucher
    $stmt = $conn->prepare("DELETE FROM pembelian WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $_SESSION['message'] = "Voucher berhasil dihapus!";
    header("Location: home.php");
    exit;
}
?>
x