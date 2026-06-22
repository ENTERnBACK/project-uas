<!DOCTYPE html>
<html>
<head>
    <title>Tambah Driver Location</title>

    <style>
        body{
            margin:0;
            font-family:Arial, Helvetica, sans-serif;
            background:#eef5ff;
        }

        .header{
            background:#0d6efd;
            color:white;
            text-align:center;
            padding:20px;
        }

        .container{
            width:50%;
            margin:40px auto;
            background:white;
            padding:30px;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,0.2);
        }

        h2{
            text-align:center;
            color:#0d6efd;
            margin-bottom:20px;
        }

        label{
            font-weight:bold;
            display:block;
            margin-top:15px;
        }

        input,
        select{
            width:100%;
            padding:10px;
            margin-top:5px;
            border:1px solid #ccc;
            border-radius:5px;
            box-sizing:border-box;
        }

        .button-group{
            margin-top:25px;
        }

        .btn{
            background:#0d6efd;
            color:white;
            border:none;
            padding:10px 20px;
            border-radius:5px;
            cursor:pointer;
            text-decoration:none;
            font-size:15px;
        }

        .btn:hover{
            background:#0b5ed7;
        }

        .btn-back{
            background:#6c757d;
            margin-left:10px;
        }

        .btn-back:hover{
            background:#5c636a;
        }

        .error{
            background:#f8d7da;
            color:#842029;
            padding:10px;
            border-radius:5px;
            margin-bottom:20px;
        }
    </style>

</head>

<body>

<div class="header">
    <h1>🚖 Ride Hailing App</h1>
    <h3>Tambah Driver Location</h3>
</div>

<div class="container">

    <h2>Form Lokasi Driver</h2>

    @if($errors->any())

        <div class="error">

            <ul>

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form action="{{ route('driver-locations.store') }}" method="POST">

        @csrf

        <label>Driver</label>

        <select name="user_id" required>

            <option value="">-- Pilih Driver --</option>

            @foreach($users as $user)

                <option value="{{ $user->id }}">

                    {{ $user->name }}

                </option>

            @endforeach

        </select>

        <label>Latitude</label>

        <input
            type="number"
            step="any"
            name="latitude"
            placeholder="-6.200000"
            value="{{ old('latitude') }}"
            required>

        <label>Longitude</label>

        <input
            type="number"
            step="any"
            name="longitude"
            placeholder="106.816666"
            value="{{ old('longitude') }}"
            required>

        <div class="button-group">

            <button type="submit" class="btn">
                💾 Simpan Lokasi
            </button>

            <a href="{{ route('driver-locations.index') }}" class="btn btn-back">
                ← Kembali
            </a>

        </div>

    </form>

</div>

</body>
</html>