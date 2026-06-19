<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ride Hailing App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                🚖 Ride Hailing App
            </a>

            <div class="ms-auto">
                <a href="/login" class="btn btn-light me-2">Login</a>
                <a href="/register" class="btn btn-outline-light">Register</a>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <div class="container mt-5">

        <div class="card shadow-sm">
            <div class="card-body text-center p-5">

                <h1 class="display-5 fw-bold">
                    Selamat Datang di Ride Hailing App
                </h1>

                <p class="text-muted mt-3">
                    Aplikasi sederhana untuk pemesanan perjalanan,
                    melihat driver, dan mengelola data perjalanan.
                </p>

                <div class="mt-4">
                    <a href="/login" class="btn btn-primary me-2">
                        Login
                    </a>

                    <a href="/register" class="btn btn-success">
                        Register
                    </a>
                </div>

            </div>
        </div>

        <!-- Fitur -->
        <div class="row mt-5">

            <div class="col-md-4 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <h3>🚗</h3>
                        <h5>Pesan Perjalanan</h5>
                        <p class="text-muted">
                            Memesan perjalanan dengan mudah melalui aplikasi.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <h3>📍</h3>
                        <h5>Lokasi Driver</h5>
                        <p class="text-muted">
                            Menampilkan lokasi driver yang tersedia.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <h3>⭐</h3>
                        <h5>Review</h5>
                        <p class="text-muted">
                            Memberikan penilaian setelah perjalanan selesai.
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <footer class="text-center mt-5 mb-3 text-muted">
        © {{ date('Y') }} Ride Hailing App
    </footer>

</body>
</html>