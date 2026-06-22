<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ride Hailing</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        .error-message{
            background:#f8d7da;
            color:#842029;
            border:1px solid #f5c2c7;
            padding:10px;
            margin-bottom:20px;
            border-radius:5px;
            text-align:center;
        }

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

        /* Password */

        .password-wrapper{
            position:relative;
        }

        .password-wrapper input{
            padding-right:45px;
        }

        .toggle-password{
            position:absolute;
            top:50%;
            right:15px;
            transform:translateY(-50%);
            cursor:pointer;
            color:#6c757d;
            font-size:20px;
        }

        .toggle-password:hover{
            color:#0d6efd;
        }

    </style>

</head>
<body>

<div class="card login-card p-4">

    <div class="text-center mb-4">
        <h2>🚖 Ride Hailing</h2>
        <p class="text-muted">Silakan login terlebih dahulu</p>
    </div>

    @if(session('error'))

        <div class="error-message">
            {{ session('error') }}
        </div>

    @endif

    <form method="POST" action="{{ route('login') }}">

        @csrf

        <div class="mb-3">
            <label>Email</label>

            <input
                type="email"
                name="email"
                class="form-control"
                value="{{ old('email') }}"
                required>
        </div>

        <div class="mb-3">

            <label>Password</label>

            <div class="password-wrapper">

                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    required>

                <span class="toggle-password" onclick="togglePassword()">

                    <i class="bi bi-eye" id="toggleIcon"></i>

                </span>

            </div>

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

<script>

function togglePassword() {

    const password = document.getElementById("password");
    const icon = document.getElementById("toggleIcon");

    if (password.type === "password") {

        password.type = "text";

        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");

    } else {

        password.type = "password";

        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");

    }

}

</script>

</body>
</html>