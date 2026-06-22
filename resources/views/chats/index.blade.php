<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Riwayat Chat</title>
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

        .card { background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); padding: 25px; border: 1px solid #eaeaea; }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 15px; }
        .btn { padding: 10px 18px; border-radius: 6px; font-size: 14px; font-weight: bold; text-decoration: none; cursor: pointer; border: none; transition: 0.2s; }
        .btn-primary { background-color: #00aa5b; color: white; }
        .btn-primary:hover { background-color: #008f4c; box-shadow: 0 2px 6px rgba(0,170,91,0.3); }
        .btn-danger { background-color: #fff0f0; color: #d32f2f; padding: 6px 12px; font-size: 12px; border: 1px solid #ffcdd2; }
        .btn-danger:hover { background-color: #ffe0e0; }

        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #f8f9fa; color: #777; font-size: 12px; text-transform: uppercase; padding: 14px 15px; text-align: left; border-bottom: 2px solid #ddd; }
        td { padding: 15px; border-bottom: 1px solid #eee; font-size: 14px; color: #555; vertical-align: top; }
        tr:hover { background-color: #fafafa; }
        .trip-id { font-family: monospace; font-weight: bold; color: #333; background: #f0f0f0; padding: 3px 6px; border-radius: 4px; }

        .badge { padding: 5px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; display: inline-block; }
        .badge-driver { background-color: #fff3e0; color: #ef6c00; }
        .badge-user { background-color: #e3f2fd; color: #1565c0; }
        .sender-id { font-size: 12px; color: #999; margin-top: 4px; display: block; }

        .alert { background-color: #e8fbed; border-left: 4px solid #00aa5b; color: #00773f; padding: 15px; margin-bottom: 20px; border-radius: 4px; font-weight: 500; }
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
            <div class="topbar-title">Sistem Pemantauan Chat</div>
            <div>Hi, Administrator</div>
        </div>

        <div class="content-body">
            
            @if(session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 style="font-size: 20px; color: #333;">Daftar Pesan Masuk</h2>
                        <p style="font-size: 13px; color: #777; margin-top: 5px;">Memantau seluruh komunikasi antara driver dan penumpang</p>
                    </div>
                    <a href="{{ route('chat-messages.create') }}" class="btn btn-primary">+ Kirim Pesan Manual</a>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Trip</th>
                            <th>Pengirim</th>
                            <th style="width: 40%;">Isi Pesan</th>
                            <th>Waktu</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($chats as $chat)
                        <tr>
                            <td><strong>{{ $loop->iteration }}</strong></td>
                            <td><span class="trip-id">TRIP-{{ str_pad($chat->trip_id, 4, '0', STR_PAD_LEFT) }}</span></td>
                            <td>
                                @if($chat->sender_type == 'driver')
                                    <span class="badge badge-driver">Driver</span>
                                @else
                                    <span class="badge badge-user">Penumpang</span>
                                @endif
                                <span class="sender-id">ID Akun: {{ $chat->sender_id }}</span>
                            </td>
                            <td style="line-height: 1.5;">{{ $chat->message }}</td>
                            <td style="font-size: 12px; color: #888;">{{ $chat->created_at->format('d M Y, H:i') }}</td>
                            <td style="text-align: center;">
                                <form action="{{ route('chat-messages.destroy', $chat->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini secara permanen?');">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px; color: #999;">Belum ada riwayat percakapan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>