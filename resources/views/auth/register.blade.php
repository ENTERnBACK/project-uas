<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Ride Hailing</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:linear-gradient(135deg,#43cea2,#185a9d);
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .register-card{
            width:450px;
            border-radius:20px;
            border:none;
            box-shadow:0 10px 30px rgba(0,0,0,.25);
        }

        .form-control{
            border-radius:10px;
        }

        .btn-register{
            border-radius:50px;
            padding:12px;
            font-weight:bold;
        }

        h2{
            font-weight:bold;
        }

    </style>

</head>
<body>

<div class="card register-card p-4">

    <div class="text-center mb-4">
        <h2>🚖 Ride Hailing</h2>
        <p class="text-muted">Buat akun baru</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input
                type="text"
                name="name"
                class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input
                type="email"
                name="email"
                class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input
                type="password"
                name="password"
                class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label>Konfirmasi Password</label>
            <input
                type="password"
                name="password_confirmation"
                class="form-control"
                required>
        </div>

        <button class="btn btn-success w-100 btn-register">
            Register
        </button>

        <div class="text-center mt-3">
            Sudah punya akun?
            <a href="{{ route('login') }}">Login</a>
        </div>

    </form>

</div>

</body>
</html>