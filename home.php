<?php
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = 'Guest';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WiFi.an Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .carousel {
            margin-top: 20px;
        }
        .carousel-inner img {
            height: 500px;
            object-fit: cover;
        }
        .carousel-caption {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            text-align: center;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
        .carousel-caption h1 {
            font-size: 4rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .carousel-caption p {
            font-size: 1.5rem;
        }
        .feature {
            padding: 4rem 0;
            background-color: #fff;
        }
        .feature h2 {
            color: #d32f2f;
            font-weight: bold;
            margin-bottom: 2rem;
        }
        .feature .card {
            border: none;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .feature .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }
        .feature .card-img-top {
            height: 380px;
            object-fit: fill;
        }
        .pricing {
            padding: 4rem 0;
            background-color: #f8f9fa;
        }
        .pricing h2 {
            color: #d32f2f;
            font-weight: bold;
            margin-bottom: 2rem;
        }

        .pricing h5 {
            text-align: center;
        }
        .pricing table {
            margin-top: 2rem;
            width: 900px;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }
        .pricing .btn {
            font-weight: bold;
            background-color: #d32f2f;
            color: #fff;
        }
        .pricing .btn:hover {
            background-color: #ffc107;
            color: #d32f2f;
        }
        .footer {
            background-color: #d32f2f;
            color: #fff;
            padding: 1.5rem 0;
            text-align: center;
        }
        .footer p {
            margin: 0;
        }
        .scroll-offset {
        scroll-margin-top: 70px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="home.php">WiFi.an</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" href="home.php">
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
                        <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="img/city.jpg" class="d-block w-100" alt="Slide 1">
            <div class="carousel-caption">
                <h1>Welcome to WiFi.an</h1>
                <p>Fast and Reliable Internet for Everyone</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="img/person1.jpg" class="d-block w-100" alt="Slide 2">
        </div>
        <div class="carousel-item">
            <img src="img/speed.jpg" class="d-block w-100" alt="Slide 3">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="container text-left my-5">
    <h2>Nikmati Internet Cepat dan Terjangkau di WiFi.an!</h2>
    <p>WiFi.an hadir untuk memberikan pengalaman internet terbaik dengan kecepatan tinggi, koneksi aman, dan jangkauan luas. Baik untuk bekerja, belajar, atau hiburan, layanan kami dirancang untuk memenuhi kebutuhan Anda. Pilih paket yang sesuai dengan anggaran Anda, mulai dari harian hingga bulanan, dengan harga terjangkau. Nikmati kemudahan pembelian voucher online hanya dalam beberapa klik. Bersama WiFi.an, tetap terhubung kapan saja dan di mana saja. Segera bergabung dan rasakan kenyamanan internet tanpa batas. Klik sekarang dan mulai jelajahi dunia bersama kami!</p>
    <h3>Kecepatan dan Keamanan Terjamin</h3>
    <p>WiFi.an memahami pentingnya koneksi internet yang stabil dan cepat di era digital. Dengan jaringan berkualitas tinggi, kami memastikan setiap aktivitas online Anda, seperti streaming, gaming, atau bekerja, berjalan tanpa hambatan. Tidak hanya itu, sistem keamanan kami menggunakan enkripsi tingkat tinggi, sehingga data Anda tetap aman dari ancaman siber. Anda bisa berselancar di internet dengan tenang tanpa khawatir tentang privasi.</p>
    <h3>Fleksibilitas untuk Setiap Kebutuhan</h3>
    <p>WiFi.an menawarkan berbagai pilihan paket yang fleksibel, mulai dari 12 jam hingga 30 hari, sehingga Anda dapat memilih sesuai kebutuhan dan anggaran. Proses pembelian voucher sangat mudah melalui platform online kami, memungkinkan Anda mengakses internet tanpa ribet. Selain itu, layanan pelanggan kami siap membantu kapan saja, memastikan pengalaman Anda bersama WiFi.an selalu memuaskan. Jadikan WiFi.an solusi utama untuk kebutuhan internet Anda!</p>
</div>

<div class="container feature text-center" id="features">
    <h2>Our Features</h2>
        <div class="row justify-content-center mt-4">
            <div class="col-md-4 col-sm-6">
                <div class="card" style="width: 100%;">
                    <a href="#speedinternet">
                    <img src="img/high-speed.jpg" class="card-img-top" alt="High-Speed Internet">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">High-Speed Internet</h5>
                        <p class="card-text">Enjoy blazing-fast internet anywhere.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="card" style="width: 100%;">
                    <a href="#widecoverage">
                    <img src="img/wifi-map.jpg" class="card-img-top" alt="Wide Coverage">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Wide Coverage</h5>
                    <p class="card-text">Access the internet in thousands of locations.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="card" style="width: 100%;">
                    <a href="#keamanankoneksi">
                    <img src="img/wifi-lock.jpg" class="card-img-top" alt="Secure Connection">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">Secure Connection</h5>
                        <p class="card-text">Stay safe with our encrypted network.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="container text-left my-5">
    <h2 id="speedinternet" class="scroll-offset">High-Speed Internet: Solusi Koneksi Cepat untuk Kebutuhan Digital Anda</h2>
    <p>Nikmati pengalaman internet tanpa hambatan dengan kecepatan tinggi yang dirancang untuk mendukung semua aktivitas online Anda. Mulai dari streaming video berkualitas tinggi, bermain game online, hingga melakukan video call tanpa gangguan, High-Speed Internet memastikan koneksi yang stabil dan responsif. Tidak hanya itu, kecepatan internet yang kami tawarkan memungkinkan pengunduhan file besar dalam waktu singkat, membantu Anda tetap produktif sepanjang hari. Dengan teknologi terbaru, jaringan kami dirancang untuk memberikan performa maksimal di berbagai perangkat. Pilih High-Speed Internet dan rasakan kemudahan berselancar di dunia digital tanpa batas.</p>
    <br>
    <h3 id="widecoverage" class="scroll-offset">Wide Coverage: Akses Internet di Mana Saja</h3>
    <p>Dengan jangkauan luas, layanan internet kami memungkinkan Anda tetap terhubung di berbagai lokasi. Apakah Anda di rumah, di tempat kerja, atau bahkan di area publik, Wide Coverage memastikan akses internet yang stabil tanpa batasan geografis. Jaringan kami dirancang untuk menjangkau daerah-daerah terpencil sekalipun, memberikan kemudahan bagi siapa saja untuk tetap produktif dan terhibur kapan saja.</p>
    <br>
    <h3 id="keamanankoneksi" class="scroll-offset">Secure Connection: Keamanan Koneksi Tanpa Kompromi</h3>
    <p>Kami mengutamakan privasi dan keamanan data Anda dengan menyediakan koneksi yang dienkripsi. Secure Connection melindungi informasi pribadi Anda dari ancaman siber saat berselancar di internet. Baik untuk transaksi online, komunikasi penting, atau aktivitas lainnya, Anda bisa merasa tenang dengan perlindungan yang kami tawarkan. Aman, cepat, dan handal untuk semua kebutuhan digital Anda</p>
</div>

    <div class="container pricing text-center" id="pricing">
    <h2>Pricing</h2>
    <div class="row mt-4 justify-content-center">
        <div class="col-12">
            <h5>Paket Harga Voucher WiFi.an</h5>
            <div class="d-flex justify-content-center align-items-center">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Paket</th>
                            <th>Harga</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>12 Jam</td>
                            <td>Rp. 5.000</td>
                            <td><button class="btn" onclick="window.location.href='buy_voucher.php?name=Paket+12+Jam&price=5000'">Beli</button></td>
                        </tr>
                        <tr>
                            <td>7 Hari</td>
                            <td>Rp. 20.000</td>
                            <td><button class="btn" onclick="window.location.href='buy_voucher.php?name=Paket+7+Hari&price=20000'">Beli</button></td>
                        </tr>
                        <tr>
                            <td>30 Hari</td>
                            <td>Rp. 50.000</td>
                            <td><button class="btn" onclick="window.location.href='buy_voucher.php?name=Paket+30+Hari&price=50000'">Beli</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 WiFi.id. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
