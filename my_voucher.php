<?php
session_start();
if (isset($_SESSION['user'])) {
    $username = $_SESSION['user'];
} else {
    $username = 'Guest';
}
$conn = new mysqli("localhost", "root", "", "akun");

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Ambil daftar voucher dari database
$result = $conn->query("SELECT * FROM pembelian");
$vouchers = $result->fetch_all(MYSQLI_ASSOC);

// Notifikasi
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Voucher</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <div class="container mt-5">
        <h1 class="text-center">My Voucher</h1>

        <!-- Notifikasi -->
        <?php if ($message): ?>
            <div class="alert alert-success">
                <?= $message; ?>
            </div>
        <?php endif; ?>

        <!-- Daftar Voucher -->
        <h2>Daftar Voucher Anda</h2>
        <table class="table table-bordered" id="voucherTable">
            <thead>
                <tr>
                    <th>Voucher</th>
                    <th>Status</th>
                    <th>Masa Aktif</th>
                    <th>Voucher Name</th>
                    <th>Status Voucher</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vouchers as $voucher): ?>
                    <tr>
                        <td><?= $voucher['username'] . '-' . $voucher['password']; ?></td>
                        <td><?= $voucher['status']; ?></td>
                        <td><?= $voucher['end_time']; ?></td>
                        <td><?= $voucher['voucher_name']; ?></td>
                        <td><?= $voucher['status_voucher']; ?></td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="redeemVoucher('<?= $voucher['username']; ?>')">Redeem</button>
                            <button class="btn btn-danger btn-sm" onclick="deleteVoucher('<?= $voucher['username']; ?>')">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Modal Redeem -->
        <div class="modal fade" id="redeemModal" tabindex="-1" aria-labelledby="redeemModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="redeemModalLabel">Redeem Voucher</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="redeemForm">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="redeemUsername" class="form-label">Username</label>
                                <input type="text" class="form-control" id="redeemUsername" name="redeemUsername" required>
                            </div>
                            <div class="mb-3">
                                <label for="redeemPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="redeemPassword" name="redeemPassword" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Redeem</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function redeemVoucher(username) {
            const modal = new bootstrap.Modal(document.getElementById('redeemModal'));
            document.getElementById('redeemUsername').value = username;
            modal.show();
        }

        function deleteVoucher(username) {
            if (!confirm("Apakah Anda yakin ingin menghapus voucher ini?")) return;

            const formData = new FormData();
            formData.append('username', username);

            fetch('my_voucher.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => location.reload())
            .catch(err => console.error(err));
        }

        document.getElementById('redeemForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch('my_voucher.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                location.reload();
            })
            .catch(err => console.error(err));
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Redeem Voucher
if (isset($_POST['redeemUsername']) && isset($_POST['redeemPassword'])) {
    $username = $_POST['redeemUsername'];
    $password = $_POST['redeemPassword'];

    $result = $conn->query("SELECT * FROM pembelian WHERE username = '$username' AND password = '$password'");

    if ($result->num_rows > 0) {
        $conn->query("UPDATE pembelian SET status_voucher = 'Sudah digunakan' WHERE username = '$username'");
        echo "Voucher berhasil diredeem!";
    } else {
        echo "Username atau Password salah!";
    }
    exit;
}

// Delete Voucher
if (isset($_POST['username'])) {
    $username = $_POST['username'];

    $conn->query("DELETE FROM pembelian WHERE username = '$username'");
    echo "Voucher berhasil dihapus!";
    exit;
}
?>
