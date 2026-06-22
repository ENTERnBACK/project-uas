<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Kirim Pesan</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { display: flex; height: 100vh; background-color: #f4f7f6; color: #333; overflow: hidden; }

        .sidebar { width: 260px; background-color: #ffffff; border-right: 1px solid #e0e0e0; display: flex; flex-direction: column; }
        .sidebar-brand { padding: 20px; font-size: 22px; font-weight: 800; color: #00aa5b; border-bottom: 1px solid #eee; letter-spacing: 0.5px; }
        .nav-menu { list-style: none; margin-top: 15px; }
        .nav-item { display: block; padding: 14px 25px; color: #555; text-decoration: none; font-weight: 600; transition: all 0.2s; border-left: 4px solid transparent; }
        .nav-item:hover, .nav-item.active { background-color: #e8fbed; color: #00aa5b; border-left: 4px solid #00aa5b; }

        .main-content { flex: 1; display: flex; flex-direction: column; overflow-y: auto; }
        .topbar { background-color: #ffffff; padding: 15px 30px; border-bottom: 1px solid #e0e0e0; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.02); }
        .topbar-title { font-size: 18px; font-weight: 600; color: #444; }
        
        .content-body { padding: 30px; }
        .card { max-width: 800px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); padding: 30px; border: 1px solid #eaeaea; }
        .card-header { margin-bottom: 25px; border-bottom: 1px solid #eee; padding-bottom: 15px; }

        .form-row { display: flex; gap: 20px; margin-bottom: 20px; }
        .form-group { flex: 1; margin-bottom: 20px; }
        .form-label { display: block; font-size: 14px; font-weight: 600; color: #444; margin-bottom: 8px; }
        .form-control { width: 100%; padding: 12px 15px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; transition: 0.3s; background-color: #fafafa; }
        .form-control:focus { outline: none; border-color: #00aa5b; background-color: #fff; box-shadow: 0 0 0 3px rgba(0,170,91,0.15); }
        textarea.form-control { resize: vertical; min-height: 100px; }
        
        .form-actions { margin-top: 30px; display: flex; justify-content: flex-end; gap: 15px; padding-top: 20px; border-top: 1px solid #eee; }
        
        .btn { padding: 12px 24px; border-radius: 6px; font-size: 14px; font-weight: bold; cursor: pointer; text-decoration: none; border: none; transition: 0.2s; }
        .btn-secondary { background-color: #e0e0e0; color: #555; }
        .btn-secondary:hover { background-color: #d5d5d5; }
        .btn-primary { background-color: #00aa5b; color: white; }
        .btn-primary:hover { background-color: #008f4c; box-shadow: 0 4px 8px rgba(0,170,91,0.3); }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-brand"> RideHailing Admin</div>
        <ul class="nav-menu">
            <li><a href="/trips" class="nav-item">Data Perjalanan</a></li>
            <li><a href="/drivers" class="nav-item">Kelola Driver</a></li>
            <li><a href="{{ route('chat-messages.index') }}" class="nav-item active">Riwayat Chat</a></li>
            <li><a href="{{ route('notifications.index') }}" class="nav-item">Notifikasi Sistem</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Simulasi Chat System</div>
            <div>Hi, Administrator</div>
        </div>

        <div class="content-body">
            <div class="card">
                <div class="card-header">
                    <h2 style="font-size: 22px; color: #333;">Kirim Pesan Simulasi</h2>
                    <p style="font-size: 14px; color: #777; margin-top: 5px;">Gunakan form ini untuk mensimulasikan pesan masuk ke database (Trigger Notifikasi).</p>
                </div>

                <form action="{{ route('chat-messages.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">ID Perjalanan (Trip ID)</label>
                            <input type="number" name="trip_id" class="form-control" required placeholder="Contoh: 1">
                        </div>
                        <div class="form-group">
                            <label class="form-label">ID Pengirim (Sender ID)</label>
                            <input type="number" name="sender_id" class="form-control" required placeholder="Contoh: 3">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status Pengirim</label>
                        <select name="sender_type" class="form-control" required>
                            <option value="" disabled selected>-- Pilih Siapa yang Mengirim --</option>
                            <option value="user">User / Penumpang</option>
                            <option value="driver">Driver Gojek</option>
                        </select>
                    </div>

                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Isi Pesan Chat</label>
                        <textarea name="message" class="form-control" rows="5" required placeholder="Ketik pesan chat di sini..."></textarea>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('chat-messages.index') }}" class="btn btn-secondary">Batalkan</a>
                        <button type="submit" class="btn btn-primary">Simpan & Kirim Pesan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</body>
</html>