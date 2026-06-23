<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#eef6ff;
        }

        .profile-card{
            width:650px;
            margin:50px auto;
            border:none;
            border-radius:20px;
            box-shadow:0 10px 25px rgba(0,0,0,.15);
        }

        .profile-header{
            background:#0d6efd;
            color:white;
            padding:25px;
            text-align:center;
            border-radius:20px 20px 0 0;
        }

        table td{
            padding:12px;
        }

        .btn{
            border-radius:30px;
        }

    </style>

</head>
<body>

<div class="card profile-card">

    <div class="profile-header">

        <h2>👤 My Profile</h2>

        <div style="text-align:center;margin-bottom:20px;">

    <img
    src="{{ asset('storage/profile/'.$user->photo) }}"
    alt="Foto Profil"
    width="150"
    height="150"
    style="width:150px;height:150px;border-radius:50%;object-fit:cover;border:5px solid #0d6efd;background:#fff;">


        <p>Informasi akun Anda</p>

    </div>

    <div class="card-body p-4">

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        <table class="table table-bordered">

            <tr>
                <th width="35%">Nama</th>
                <td>{{ $user->name }}</td>
            </tr>

            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>

            <tr>
                <th>Nomor Telepon</th>
                <td>
                    {{ $user->phone ?? 'Belum ditambahkan' }}
                </td>
            </tr>

            <tr>
                <th>Role</th>
                <td>{{ ucfirst($user->role) }}</td>
            </tr>

        </table>

        <div class="d-flex justify-content-between mt-4">

            <a href="{{ route('user_profile.edit') }}" class="btn btn-primary">

                ✏ Edit Profile

            </a>

            @if(auth()->user()->role == 'driver')

                <a href="{{ route('dashboard.driver') }}" class="btn btn-secondary">

                    ← Dashboard Driver

                </a>

            @else

                <a href="{{ route('dashboard') }}" class="btn btn-secondary">

                    ← Dashboard

                </a>

            @endif

        </div>

    </div>

</div>

</body>
</html>