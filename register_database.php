<?php
$conn = new mysqli("localhost", "root", "", "connection");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $query_check = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $result_check = $conn->query($query_check);

    if ($result_check->num_rows > 0) {
        echo "Username atau email sudah digunakan.";
    } else {
        $query = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
        if ($conn->query($query)) {
            header("Location: login.php");
        } else {
            echo "Registrasi gagal: " . $conn->error;
        }
    }
}
?>
