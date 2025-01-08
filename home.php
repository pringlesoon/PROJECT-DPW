<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WiFi.id Home</title>
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
            <a class="navbar-brand" href="#">WiFi.id</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pricing">Pricing</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
                <a href="login.php" class="btn login-btn ms-3">Login</a>
            </div>
        </div>
    </nav>

    <div class="hero">
        <div>
            <h1>Welcome to WiFi.id</h1>
            <p>Fast and Reliable Internet for Everyone</p>
            <a href="#" class="btn btn-light">Get Started</a>
        </div>
    </div>

    <div class="container feature text-center" id="features">
        <h2>Our Features</h2>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="feature-icon mb-3">📶</div>
                <h5>High-Speed Internet</h5>
                <p>Enjoy blazing-fast internet anywhere.</p>
            </div>
            <div class="col-md-4">
                <div class="feature-icon mb-3">🌍</div>
                <h5>Wide Coverage</h5>
                <p>Access the internet in thousands of locations.</p>
            </div>
            <div class="col-md-4">
                <div class="feature-icon mb-3">🔒</div>
                <h5>Secure Connection</h5>
                <p>Stay safe with our encrypted network.</p>
            </div>
        </div>
    </div>

    <div class="container text-center" id="pricing">
        <h2>Pricing Plans</h2>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Basic</h5>
                        <p class="card-text">Free for basic use</p>
                        <a href="#" class="btn btn-primary">Select</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Standard</h5>
                        <p class="card-text">$5/month</p>
                        <a href="#" class="btn btn-primary">Select</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Premium</h5>
                        <p class="card-text">$10/month</p>
                        <a href="#" class="btn btn-primary">Select</a>
                    </div>
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
