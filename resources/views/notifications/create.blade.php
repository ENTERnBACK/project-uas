<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alat Uji Notifikasi</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f4f7f6; color: #333; padding: 40px 20px; display: flex; justify-content: center; }
        
        .card {
            width: 100%;
            max-width: 500px;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid #eaeaea;
        }

        h2 { font-size: 20px; color: #222; margin-bottom: 5px; }
        p { font-size: 13px; color: #777; margin-bottom: 25px; line-height: 1.5; }

        .form-group { margin-bottom: 15px; }
        label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; color: #444; }
        
        .form-control {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            background-color: #fafafa;
        }
        .form-control:focus { outline: none; border-color: #00aa5b; background-color: #fff; }
        
        button {
            width: 100%;
            padding: 12px;
            background-color: #00aa5b;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.2s;
        }
        button:hover { background-color: #008f4c; }
        
        .alert { background-color: #e8fbed; border-left: 4px solid #00aa5b; color: #00773f; padding: 12px; margin-bottom: 20px; border-radius: 4px; font-size: 13px;}
    </style>
</head>
<body>

    <div class="card">
        <h2>🛠️ Panel Simulasi Notifikasi</h2>
        <p>Gunakan form ini untuk mengirim notifikasi tes langsung ke kotak masuk pengguna tanpa harus membuat order.</p>

        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <form action="{{ route('notifications.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label>Kirim Ke (Tipe Akun)</label>
                <select name="notifiable_type" class="form-control" required>
                    <option value="" disabled selected>-- Pilih Target --</option>
                    <option value="App\Models\User">Akun Penumpang (User)</option>
                    <option value="App\Models\Driver">Akun Driver</option>
                </select>
            </div>

            <div class="form-group">
                <label>ID Pengguna Terdaftar</label>
                <input type="number" name="notifiable_id" class="form-control" required placeholder="Contoh: 1">
            </div>

            <div class="form-group">
                <label>Judul Notifikasi</label>
                <input type="text" name="title" class="form-control" required placeholder="Contoh: Promo Spesial Khusus Hari Ini!">
            </div>

            <div class="form-group">
                <label>Isi Pesan</label>
                <textarea name="message" class="form-control" rows="4" required placeholder="Tulis pesan lengkapnya di sini..."></textarea>
            </div>

            <input type="hidden" name="is_read" value="0">

            <button type="submit">Tembakkan Notifikasi &rarr;</button>
        </form>
    </div>

</body>
</html>