<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Ride Hailing</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>

        body{
            background: linear-gradient(135deg,#4facfe,#00f2fe);
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .register-card{
            width:420px;
            border:none;
            border-radius:20px;
            box-shadow:0 10px 30px rgba(0,0,0,.2);
        }

        .form-control,
        .form-select{
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

        a{
            text-decoration:none;
        }

        a:hover{
            text-decoration:underline;
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

<div class="card register-card p-4">

    <div class="text-center mb-4">
        <h2>🚖 Ride Hailing</h2>
        <p class="text-muted">Buat akun baru</p>
    </div>

    @if($errors->any())

    <div class="alert alert-danger">

        <ul class="mb-0">

            @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

    @endif

    <form method="POST" action="{{ route('register') }}">

        @csrf

        <div class="mb-3">

            <label class="form-label">Daftar Sebagai</label>

            <select name="role" class="form-select" required>

                <option value="">-- Pilih Role --</option>

                <option value="user"
                    {{ old('role')=='user' ? 'selected' : '' }}>
                    User
                </option>

                <option value="driver"
                    {{ old('role')=='driver' ? 'selected' : '' }}>
                    Driver
                </option>

            </select>

        </div>

        <div class="mb-3">

            <label>Nama</label>

            <input
                type="text"
                name="name"
                class="form-control"
                value="{{ old('name') }}"
                required>

        </div>

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

                <span class="toggle-password"
                    onclick="togglePassword('password','icon1')">

                    <i class="bi bi-eye" id="icon1"></i>

                </span>

            </div>

        </div>

        <div class="mb-3">

            <label>Konfirmasi Password</label>

            <div class="password-wrapper">

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    class="form-control"
                    required>

                <span class="toggle-password"
                      onclick="togglePassword('password_confirmation','icon2')">

                    <i class="bi bi-eye" id="icon2"></i>

                </span>

            </div>

        </div>

        <button class="btn btn-primary w-100 btn-register">
            Register
        </button>

        <div class="text-center mt-3">
            Sudah punya akun?
            <a href="{{ route('login') }}">Login</a>
        </div>

    </form>

</div>

<script>

function togglePassword(inputId, iconId){

    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if(input.type === "password"){

        input.type = "text";

        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");

    }else{

        input.type = "password";

        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");

    }

}

</script>

</body>
</html>