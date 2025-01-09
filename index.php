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
        }
        .navbar {
            background-color: #d32f2f;
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
        }
        .hero {
            background: url('https://example.com/hero-image.jpg') no-repeat center center;
            background-size: cover;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-align: center;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .feature {
            padding: 2rem 0;
        }
        .feature-icon {
            font-size: 3rem;
            color: #d32f2f;
        }
        .footer {
            background-color: #d32f2f;
            color: #fff;
            padding: 1rem 0;
            text-align: center;
        }
        .login-btn {
            color: #d32f2f !important;
            background-color: #fff;
            border: 2px solid #fff;
        }
        .login-btn:hover {
            color: #fff !important;
            background-color: #d32f2f;
            border: 2px solid #fff;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">WiFi.an</a>
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
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>

                <a href="auth/login.php" class="btn login-btn ms-3">Login</a>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="hero">
        <div>
            <h1>Welcome to WiFi.an</h1>
            <p>Fast and Reliable Internet for Everyone</p>
        </div>
    </div>

    <div class="container feature text-center" id="features">
    <h2>Our Features</h2>
        <div class="row justify-content-center mt-4">
            <div class="col-md-4 col-sm-6">
                <div class="card" style="width: 100%;">
                    <img src="/img/high-speed.jpg" class="card-img-top" alt="High-Speed Internet">
                    <div class="card-body">
                        <h5 class="card-title">High-Speed Internet</h5>
                        <p class="card-text">Enjoy blazing-fast internet anywhere.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="card" style="width: 100%;">
                    <img src="/img/wifi-map.jpg" class="card-img-top" alt="Wide Coverage">
                    <div class="card-body">
                        <h5 class="card-title">Wide Coverage</h5>
                        <p class="card-text">Access the internet in thousands of locations.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="card" style="width: 100%;">
                    <img src="/img/wifi-lock.jpg" class="card-img-top" alt="Secure Connection">
                    <div class="card-body">
                        <h5 class="card-title">Secure Connection</h5>
                        <p class="card-text">Stay safe with our encrypted network.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center" id="pricing">
        <h2>Pricing</h2>
        <div class="row mt-4">
            <div class="col-md-6 col-sm-12">
                <h5>Paket Harga Voucher WiFi.an</h5>
                <table class="table table-bordered">
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
                            <td><button class="btn btn-primary" onclick="window.location.href='buy_voucher.php?name=Paket+12+Jam&price=5000'">Beli</button></td>
                        </tr>
                        <tr>
                            <td>7 Hari</td>
                            <td>Rp. 20.000</td>
                            <td><button class="btn btn-primary" onclick="window.location.href='buy_voucher.php?name=Paket+7+Hari&price=20000'">Beli</button></td>
                        </tr>
                        <tr>
                            <td>30 Hari</td>
                            <td>Rp. 50.000</td>
                            <td><button class="btn btn-primary" onclick="window.location.href='buy_voucher.php?name=Paket+30+Hari&price=50000'">Beli</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>


    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 WiFi.id. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
