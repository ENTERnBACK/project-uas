<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>

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

        .btn{
            border-radius:30px;
        }

    </style>

</head>
<body>

<div class="card profile-card">

    <div class="profile-header">

        <h2>✏ Edit Profile</h2>

        <p>Perbarui informasi akun Anda</p>

    </div>

    <div class="card-body p-4">

        <form method="POST"
            action="{{ route('user_profile.update') }}"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="text-center mb-4">

            @if($user->photo)

                <img src="{{ asset('storage/profile/'.$user->photo) }}"
                    width="140"
                    height="140"
                    style="border-radius:50%; object-fit:cover; border:4px solid #0d6efd;">

            @else

                <img src="https://via.placeholder.com/140"
                    width="140"
                    height="140"
                    style="border-radius:50%; border:4px solid #0d6efd;">

            @endif

            </div>

            <div class="mb-3">

                <label class="form-label">Nama</label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="{{ old('name',$user->name) }}"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">Email</label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email',$user->email) }}"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">Foto Profil</label>

                <input
                    type="file"
                    name="photo"
                    class="form-control"
                    accept="image/*">

                <small class="text-muted">
                    Format: JPG, JPEG, PNG (maksimal 2 MB)
                </small>

            </div>

            <div class="mb-3">

                <label class="form-label">Nomor Telepon</label>

                <input
                    type="text"
                    name="phone"
                    class="form-control"
                    value="{{ old('phone',$user->phone) }}"
                    placeholder="08xxxxxxxxxx">

            </div>

            <div class="d-flex justify-content-between">

                <button class="btn btn-primary">

                    💾 Simpan

                </button>

                <a href="{{ route('user_profile.index') }}" class="btn btn-secondary">

                    ← Kembali

                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>