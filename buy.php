<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: auth/login.php");
    exit;
}
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
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .voucher-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }
        .voucher-item {
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, background-color 0.3s;
            cursor: pointer;
        }
        .voucher-item:hover {
            transform: scale(1.05);
            background-color: #f1f1f1;
        }
        .voucher-item.selected {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pembelian Voucher WiFi.id</h5>
                    <hr>
                    <p><strong>1. Pilih Paket Voucher WiFi.an</strong></p>
                    <div class="voucher-grid">
                        <div class="voucher-item" onclick="selectVoucher(this, 5000)">
                            <p>12 Jam</p>
                            <p>Rp. 5.000</p>
                        </div>
                        <div class="voucher-item" onclick="selectVoucher(this, 20000)">
                            <p>7 Hari</p>
                            <p>Rp. 20.000</p>
                        </div>
                        <div class="voucher-item" onclick="selectVoucher(this, 50000)">
                            <p>30 Hari</p>
                            <p>Rp. 50.000</p>
                        </div>
                    </div>
                    <hr>
                    <p><strong>2. Metode Pembayaran</strong></p>
                    <div class="mb-3">
                        <select id="payment-method" class="form-select">
                            <option value="">Pilih Metode Pembayaran</option>
                            <option value="transfer">Transfer Via Bank</option>
                            <option value="qris">QRIS</option>
                        </select>
                    </div>
                    <p><strong>3. Email</strong></p>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Masukkan Email">
                    </div>
                    <p><strong>4. No. WhatsApp</strong></p>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Masukkan No. WhatsApp">
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <p><strong>Total:</strong></p>
                        <p id="total-price"><strong>Rp. 0</strong></p>
                    </div>
                    <button class="btn btn-danger w-100 mt-3" onclick="processPayment()">Bayar Sekarang</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let total = 0;
    let selectedElement = null;

    function selectVoucher(element, price) {
        // Hapus kelas 'selected' dari elemen sebelumnya
        if (selectedElement) {
            selectedElement.classList.remove('selected');
        }

        // Tambahkan kelas 'selected' ke elemen yang baru dipilih
        element.classList.add('selected');
        selectedElement = element;

        // Perbarui total harga
        total = price;
        document.getElementById('total-price').innerHTML = `<strong>Rp. ${total.toLocaleString()}</strong>`;
    }

    function processPayment() {
        const paymentMethod = document.getElementById('payment-method').value;

        if (total === 0) {
            alert('Silakan pilih voucher terlebih dahulu!');
        } else if (!paymentMethod) {
            alert('Silakan pilih metode pembayaran terlebih dahulu!');
        } else {
            alert(`Anda akan membayar Rp. ${total.toLocaleString()} menggunakan metode ${paymentMethod === 'transfer' ? 'Transfer Via Bank' : 'QRIS'}.`);
            // Tambahkan logika untuk pembayaran di sini
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
