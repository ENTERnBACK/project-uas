<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ride Hailing</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background: linear-gradient(135deg,#4facfe,#00f2fe);
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .login-card{
            width:420px;
            border:none;
            border-radius:20px;
            box-shadow:0 10px 30px rgba(0,0,0,.2);
        }

        .btn-login{
            border-radius:50px;
            padding:12px;
            font-weight:bold;
        }

        .form-control{
            border-radius:10px;
        }

        h2{
            font-weight:bold;
        }
    </style>
</head>
<body>

<div class="card login-card p-4">

    <div class="text-center mb-4">
        <h2>🚖 Ride Hailing</h2>
        <p class="text-muted">Silakan login terlebih dahulu</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

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

        <button class="btn btn-primary w-100 btn-login">
            Login
        </button>

        <div class="text-center mt-3">
            Belum punya akun?
            <a href="{{ route('register') }}">Register</a>
        </div>

    </form>

</div>

</body>
</html>