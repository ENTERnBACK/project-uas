<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kotak Masuk Notifikasi</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f4f7f6; color: #333; padding: 40px 20px; display: flex; justify-content: center; }
        
        .notification-container {
            width: 100%;
            max-width: 600px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            overflow: hidden;
            border: 1px solid #eaeaea;
        }

        .header {
            background-color: #00aa5b;
            color: white;
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h2 { font-size: 18px; font-weight: 600; letter-spacing: 0.5px; }
        .back-btn { color: white; text-decoration: none; font-size: 14px; opacity: 0.9; }
        .back-btn:hover { opacity: 1; text-decoration: underline; }

        .notif-list { list-style: none; }
        
        .notif-item {
            padding: 20px 25px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            gap: 15px;
            transition: background-color 0.2s;
        }
        .notif-item:last-child { border-bottom: none; }
        .notif-item:hover { background-color: #fafafa; }
        
        /* Indikator Belum Dibaca */
        .notif-item.unread { background-color: #f2fcf6; }
        .notif-item.unread .notif-title { color: #00aa5b; font-weight: 700; }
        
        .icon-circle {
            width: 40px;
            height: 40px;
            background-color: #e8fbed;
            color: #00aa5b;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .notif-content { flex: 1; }
        .notif-title { font-size: 15px; font-weight: 600; color: #222; margin-bottom: 4px; display: block; }
        .notif-message { font-size: 13.5px; color: #666; line-height: 1.5; }
        .notif-time { font-size: 11px; color: #999; margin-top: 8px; display: block; }

        .empty-state { text-align: center; padding: 50px 20px; color: #888; }
    </style>
</head>
<body>

    <div class="notification-container">
        <div class="header">
            <h2>🔔 Notifikasi Sistem</h2>
            <a href="/" class="back-btn">Tutup &times;</a>
        </div>

        <ul class="notif-list">
            @forelse($notifications as $notif)
                <li class="notif-item {{ !$notif->is_read ? 'unread' : '' }}">
                    <div class="icon-circle">
                        @if(str_contains(strtolower($notif->title), 'pembayaran') || str_contains(strtolower($notif->title), 'saldo'))
                            💸
                        @elseif(str_contains(strtolower($notif->title), 'driver') || str_contains(strtolower($notif->title), 'perjalanan'))
                            🚗
                        @else
                            📢
                        @endif
                    </div>
                    
                    <div class="notif-content">
                        <span class="notif-title">{{ $notif->title }}</span>
                        <p class="notif-message">{{ $notif->message }}</p>
                        <span class="notif-time">{{ $notif->created_at->diffForHumans() }}</span>
                    </div>
                </li>
            @empty
                <div class="empty-state">
                    <div style="font-size: 40px; margin-bottom: 15px; opacity: 0.5;">📭</div>
                    <p>Belum ada notifikasi untukmu saat ini.</p>
                </div>
            @endforelse
        </ul>
    </div>

</body>
</html>