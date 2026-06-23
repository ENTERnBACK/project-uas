<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Pantauan Chat</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { display: flex; height: 100vh; background-color: #f4f7f6; color: #333; overflow: hidden; }

        .sidebar { width: 260px; background-color: #ffffff; border-right: 1px solid #e0e0e0; display: flex; flex-direction: column; }
        .sidebar-brand { padding: 20px; font-size: 22px; font-weight: 800; color: #00aa5b; border-bottom: 1px solid #eee; }
        .nav-menu { list-style: none; margin-top: 15px; }
        .nav-item { display: block; padding: 14px 25px; color: #555; text-decoration: none; font-weight: 600; border-left: 4px solid transparent; }
        .nav-item:hover, .nav-item.active { background-color: #e8fbed; color: #00aa5b; border-left: 4px solid #00aa5b; }

        .main-content { flex: 1; display: flex; flex-direction: column; overflow-y: auto; }
        .topbar { background-color: #ffffff; padding: 15px 30px; border-bottom: 1px solid #e0e0e0; display: flex; justify-content: space-between; align-items: center; }
        .content-body { padding: 30px; }

        .card { background-color: #ffffff; border-radius: 8px; padding: 25px; border: 1px solid #eaeaea; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #f8f9fa; color: #777; font-size: 12px; text-transform: uppercase; padding: 14px 15px; text-align: left; border-bottom: 2px solid #ddd; }
        td { padding: 15px; border-bottom: 1px solid #eee; font-size: 14px; color: #555; }
        
        .badge { padding: 5px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; }
        .badge-driver { background-color: #fff3e0; color: #ef6c00; }
        .badge-user { background-color: #e3f2fd; color: #1565c0; }
        .btn-danger { background-color: #fff0f0; color: #d32f2f; padding: 6px 12px; border: 1px solid #ffcdd2; border-radius: 6px; cursor: pointer; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-brand"> RideHailing Admin</div>
        <ul class="nav-menu">
            <li><a href="/trips" class="nav-item">Data Perjalanan</a></li>
            <li><a href="{{ route('chat-messages.index') }}" class="nav-item active">Riwayat Chat</a></li>
            <li><a href="{{ route('notifications.index') }}" class="nav-item">Notifikasi Sistem</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="topbar">
            <div>Sistem Pemantauan Chat</div>
            <div>Administrator</div>
        </div>

        <div class="content-body">
            @if(session('success'))
                <div style="background: #e8fbed; border-left: 4px solid #00aa5b; padding: 15px; margin-bottom: 20px; color: #00773f;">{{ session('success') }}</div>
            @endif

            <div class="card">
                <h2 style="margin-bottom: 20px;">Daftar Pesan Masuk (Log Sistem)</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID Trip</th>
                            <th>Pengirim</th>
                            <th style="width: 50%;">Isi Pesan</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($chats as $chat)
                        <tr>
                            <td>TRIP-{{ $chat->trip_id }}</td>
                            <td>
                                <span class="badge {{ $chat->sender_type == 'driver' ? 'badge-driver' : 'badge-user' }}">{{ $chat->sender_type }}</span>
                                <div style="font-size: 12px; margin-top: 5px;">ID: {{ $chat->sender_id }}</div>
                            </td>
                            <td>{{ $chat->message }}</td>
                            <td>{{ $chat->created_at->format('d M Y, H:i') }}</td>
                            <td>
                                <form action="{{ route('chat-messages.destroy', $chat->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>