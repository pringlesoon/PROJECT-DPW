<?php
session_start();
$conn = new mysqli("localhost", "root", "", "connection");

// Periksa koneksi database
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['username'];
            
            header("Location: home.php");
            exit;
        } else {
            echo "<script>
                    alert('Password salah!');
                    window.location.href = 'login.php';
                </script>";
        }
    } else {
        echo "<script>
                alert('Username tidak ditemukan!');
                window.location.href = 'login.php';
            </script>";
    }
}
?>
