<!DOCTYPE html>
<html>
<head>
    <title>Edit Driver Location</title>

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
            font-size:14px;
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
    <h3>Edit Driver Location</h3>
</div>

<div class="container">

    <h2>Form Edit Lokasi Driver</h2>

    @if($errors->any())

        <div class="error">

            <ul>

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form action="{{ route('driver-locations.update', $driverLocation->id) }}" method="POST">

        @csrf
        @method('PUT')

        <label>Driver</label>

        <select name="user_id" required>

            @foreach($users as $user)

                <option value="{{ $user->id }}"
                    {{ $driverLocation->user_id == $user->id ? 'selected' : '' }}>

                    {{ $user->name }}

                </option>

            @endforeach

        </select>

        <label>Latitude</label>

        <input
            type="number"
            step="any"
            name="latitude"
            value="{{ old('latitude', $driverLocation->latitude) }}"
            required>

        <label>Longitude</label>

        <input
            type="number"
            step="any"
            name="longitude"
            value="{{ old('longitude', $driverLocation->longitude) }}"
            required>

        <div class="button-group">

            <button type="submit" class="btn">
                💾 Simpan Perubahan
            </button>

            <a href="{{ route('driver-locations.index') }}" class="btn btn-back">
                ← Kembali
            </a>

        </div>

    </form>

</div>

</body>
</html>