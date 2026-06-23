<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatroom - Trip #{{ $trip->id }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f0f2f5; display: flex; justify-content: center; align-items: center; height: 100vh; }

        .mobile-container {
            width: 100%;
            max-width: 400px;
            height: 100vh;
            background-color: #e5ddd5;
            display: flex;
            flex-direction: column;
            position: relative;
        }
        @media (min-width: 450px) {
            .mobile-container { height: 90vh; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        }

        .chat-header {
            background-color: #00aa5b;
            color: white;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            z-index: 10;
        }
        .back-btn { color: white; text-decoration: none; font-size: 20px; margin-right: 15px; font-weight: bold; }
        .contact-info { flex: 1; }
        .contact-name { font-size: 16px; font-weight: 600; }
        .contact-status { font-size: 12px; opacity: 0.8; margin-top: 2px; }

        .chat-body {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .message { max-width: 80%; padding: 10px 14px; border-radius: 12px; font-size: 14px; line-height: 1.4; position: relative; box-shadow: 0 1px 1px rgba(0,0,0,0.05); }
        .message-time { font-size: 10px; color: #888; text-align: right; margin-top: 4px; }
        
        .message.mine { align-self: flex-end; background-color: #dcf8c6; border-bottom-right-radius: 0; }
        .message.other { align-self: flex-start; background-color: #ffffff; border-bottom-left-radius: 0; }

        .chat-footer {
            background-color: #f0f0f0;
            padding: 10px 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .chat-input {
            flex: 1;
            padding: 12px 15px;
            border-radius: 24px;
            border: none;
            outline: none;
            font-size: 14px;
        }
        .send-btn {
            background-color: #00aa5b;
            color: white;
            border: none;
            border-radius: 50%;
            width: 42px;
            height: 42px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            font-weight: bold;
            transition: 0.2s;
        }
        .send-btn:hover { background-color: #008f4c; }
    </style>
</head>
<body>

    <div class="mobile-container">
        <div class="chat-header">
            <a href="javascript:history.back()" class="back-btn">&#8592;</a>
            <div class="contact-info">
                @if($current_role == 'user')
                    <div class="contact-name">Driver #{{ $trip->driver_id ?? 'Menunggu...' }}</div>
                    <div class="contact-status">Mitra Pengemudi</div>
                @else
                    <div class="contact-name">Penumpang #{{ $trip->user_id }}</div>
                    <div class="contact-status">Pelanggan</div>
                @endif
            </div>
        </div>

        <div class="chat-body" id="chatContainer">
            <div class="message other" style="align-self: center; background: #fffde7; text-align: center; border-radius: 8px; font-size: 12px; color: #666; max-width: 90%;">
                Pesan terenkripsi. Hindari membagikan informasi pribadi atau rahasia perbankan.
            </div>

            @foreach($messages as $msg)
                <div class="message {{ $msg->sender_type === $current_role ? 'mine' : 'other' }}">
                    <div>{{ $msg->message }}</div>
                    <div class="message-time">{{ $msg->created_at->format('H:i') }}</div>
                </div>
            @endforeach
        </div>

        <form action="{{ route('trips.chat.store', $trip->id) }}" method="POST" class="chat-footer">
            @csrf
            <input type="text" name="message" class="chat-input" placeholder="Ketik pesan..." required autocomplete="off" autofocus>
            <button type="submit" class="send-btn">&#10148;</button>
        </form>
    </div>

    <script>
        const chatContainer = document.getElementById('chatContainer');
        chatContainer.scrollTop = chatContainer.scrollHeight;
    </script>
</body>
</html>