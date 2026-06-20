<!DOCTYPE html>
<html>
<head>
    <title>Buat Support Ticket</title>

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
        }

        input, textarea, select{
            width:100%;
            padding:10px;
            margin-top:5px;
            margin-bottom:15px;
            border:1px solid #ccc;
            border-radius:5px;
            box-sizing:border-box;
        }

        textarea{
            resize:vertical;
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
        }

        .btn-back:hover{
            background:#5c636a;
        }

        .button-group{
            margin-top:20px;
        }

        .error{
            color:red;
            margin-bottom:15px;
        }
    </style>

</head>
<body>

<div class="header">
    <h1>🚖 Ride Hailing App</h1>
    <h3>Buat Support Ticket</h3>
</div>

<div class="container">

    <h2>Form Pengaduan</h2>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('support-tickets.store') }}" method="POST">

        @csrf

        <label>User ID</label>
        <input type="number"
               name="user_id"
               value="{{ old('user_id') }}"
               required>

        <label>Subject</label>
        <input type="text"
               name="subject"
               value="{{ old('subject') }}"
               placeholder="Masukkan judul pengaduan"
               required>

        <label>Deskripsi Pengaduan</label>
        <textarea
            name="description"
            rows="6"
            placeholder="Jelaskan masalah yang Anda alami..."
            required>{{ old('description') }}</textarea>

        <div class="button-group">

            <button type="submit" class="btn">
                📩 Kirim Pengaduan
            </button>

            <a href="{{ route('support-tickets.index') }}" class="btn btn-back">
                ← Kembali
            </a>

        </div>

    </form>

</div>

</body>
</html>